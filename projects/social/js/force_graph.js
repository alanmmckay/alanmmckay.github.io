/* --- Globals: --- */
// svg parameters:
var width = 1048;
var height = 800;

// force graph parameters:
var set_color = d3.scaleLog([6,60,144],["brown","orange","red"]);
var links;
var nodes;
var simulation;
var link;
var node;
var force_array = {
    "0":-2,
    "1":-2,
    "2": -5,
    "3": -7,
    "4": -10,
    "5": -15,
    "6": -25,
    "7": -30,
    "8": -35,
    "9": -45,
    "10": -55,
    "11": -60,
    "12": -65,
    "13": -75,
    "14": -85,
    "15": -95,
    "16": -105
}

/* --- Function to create force graph within existing svg: --- */
function kickoff(filter,link_strength,collision_strength,force_strength){
    let svg = d3.select("#force-graph-svg");
    links = data.links.filter(d => (d.source_strength >= filter && d.target_strength >= filter)).map(d => ({...d}));
    nodes = data.nodes.filter(d => d.inbound >= filter).map(d => ({...d}));

    simulation = d3.forceSimulation(nodes)
    .force("charge", d3.forceManyBody().strength(force_strength))
    .force("link", d3.forceLink(links).id(d=>d.id).distance(d=>d.strength*link_strength))
    .force("collide",d3.forceCollide(d => collision_strength(d)))
    .force("center", d3.forceCenter(width/2,height/2))
    .force("x", d3.forceX())
    .force("y", d3.forceY())
    .alphaTarget(0.0);

    link = svg.append("g")
    .attr("stroke", "#999")
    .attr("stroke-opacity", 0.6)
    .selectAll("line")
    .data(links)
    .join("line")
    .attr("stroke-width",0.25);

    node = svg.append("g")
    .attr("stroke", "brown")
    .attr("stroke-width", 1)
    .selectAll("circle")
    .data(nodes)
    .join("circle")
    .attr("r", (d => d.inbound/4))
    .attr("fill", d => set_color(d.inbound));

    node.append("title")
    .text(d => "User: " +d.id + ";\nInbound Degree: " + d.inbound + ";");

    simulation.on("tick", () => {
    link
        .attr("x1", d => d.source.x)
        .attr("y1", d => d.source.y)
        .attr("x2", d => d.target.x)
        .attr("y2", d => d.target.y);

    node
        .attr("cx", d => d.x)
        .attr("cy", d => d.y);
    });

    function drag(simulation) {
        function dragstarted(event) {
            if (!event.active) simulation.alphaTarget(0.05).restart();
            event.subject.fx = event.subject.x;
            event.subject.fy = event.subject.y;
        }
        function dragged(event) {
            event.subject.fx = event.x;
            event.subject.fy = event.y;
        }
        function dragended(event) {
            if (!event.active) simulation.alphaTarget(0.00).restart();
            event.subject.fx = null;
            event.subject.fy = null;
        }
        return d3.drag().on('start', dragstarted).on('drag', dragged).on('end', dragended);
    }
    node.call(drag(simulation));
}

/* --- Function to expand and retract link strength for force graph --- */
function explode_graph(use_switch){
    if(use_switch == true){
        simulation.force("link", d3.forceLink(links).id(d=>d.id).distance(d=>d.strength*2.5*1));
        simulation.alphaTarget(0.3).restart();
        document.getElementById("explode_button").value = "Retract Nodes";
        document.getElementById("explode_button").setAttribute("onclick","explode_graph(false)");
    }else{
        simulation.force("link", d3.forceLink(links).id(d=>d.id).distance(d=>d.strength*.5*1));
        simulation.alphaTarget(0.3).restart();
        document.getElementById("explode_button").value = "Expand Nodes";
        document.getElementById("explode_button").setAttribute("onclick","explode_graph(true)");
    }
    setTimeout(function(){simulation.alphaTarget(0).restart();},3000);
}

/* --- Clears and replaces existing svg element for new force graph --- */
function prime_svg(){
    // --- Wipe existing svg element
    node.remove();
    link.remove();
    node = false;
    link = false;
    nodes = false;
    links = false;
    simulation = false;
    document.getElementById("force-graph-svg").remove();

    // --- Create replacement svg element
    let new_svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    new_svg.setAttribute("id","force-graph-svg");
    new_svg.setAttribute("viewBox","0 0 1048 800");
    new_svg.setAttribute("preserveAspectRatio","xMidYMid meet");
    new_svg.setAttribute("style","width:100%;");
    document.getElementById("social_graph_container").insertBefore(new_svg,document.getElementById("social_graph_container").children[0]);
}

/* --- Handler for the kickoff function to interact with the range slider --- */
var kickoff_switch = true;
function slider_kickoff(){

    slider = document.getElementById('node_range');
    value_indicator = document.getElementById('nodeSliderVal');
    confirmation_button = document.getElementById("confirm_button");
    confirmation_label = document.getElementById('confirm_label');

    if(slider.value < node_threshold){
        document.getElementById('confirm_wrapper').style.display = "flex";
        kickoff_switch = false;
        confirmation_button.disabled = false;
        confirmation_label.style.color = '#7b869d';
        value_indicator.innerHTML = slider_value + " -> " + slider.value;
    }else{
        kickoff_switch = true;
        confirmation_button.disabled = true;
        confirmation_label.style.color = "#c4c9d4";
    }

    if(kickoff_switch == true){
        prime_svg();
        slider_value = slider.value;
        value_indicator.innerHTML = slider_value
        kickoff(slider.value,.5,col_func,force_array[String(slider.value)]);
        explode_button = document.getElementById("explode_button");
        explode_button.value = "Expand Nodes";
        explode_button.setAttribute("onclick","explode_graph(true)");

        document.getElementById("node_counter").innerHTML = String(nodes.length) + " node(s) with inbound links >= "+String(slider.value);

        if(document.getElementById('range-wrapper').getBoundingClientRect().width <= 500){
            document.getElementById('confirm_wrapper').style['display'] = 'none';
        }
    }
}

/* --- Handler for kickoff function to interact with the confirmation button --- */
function button_kickoff(){
    prime_svg();
    slider = document.getElementById('node_range');
    slider_value = slider.value;
    document.getElementById('nodeSliderVal').innerHTML = slider_value
    kickoff(slider.value,.5,col_func,force_array[String(slider.value)]);
    document.getElementById('confirm_button').disabled = true;
    kickoff_switch = true;
    document.getElementById('confirm_label').style.color = "#c4c9d4";
    explode_button = document.getElementById("explode_button");
    explode_button.value = "Expand Nodes";
    explode_button.setAttribute("onclick","explode_graph(true)");

    document.getElementById("node_counter").innerHTML = String(nodes.length) + " nodes with inbound links >= "+String(slider.value);

    if(document.getElementById('range-wrapper').getBoundingClientRect().width <= 500){
        document.getElementById('confirm_wrapper').style['display'] = 'none';
    }
}

/* Handler for the kickoff function to interact with the dropdown menu */
function change_graph(graph){
    slider = document.getElementById('node_range');
    if(kickoff_switch == false){
        old_threshold = node_threshold;
    }else{
        old_threshold = slider.value;
    }
    kickoff_switch = true;
    if(graph == "reddit"){
        data = socialdata;
        if(isMobile){
            node_threshold = 16;
        }else{
            node_threshold = 6;
        }
        slider.max = 16;
        slider.style['width'] = "95%";
        kickoff_val = Math.min(old_threshold,16);
    }else if(graph == "random"){
        data = randomdata;
        if(isMobile){
            node_threshold = 6;
        }else{
            node_threshold = 5;
        }
        slider.max = 11;
        slider.style['width'] = "65%";
        kickoff_val = Math.min(old_threshold,11);
    }

    prime_svg();
    kickoff(kickoff_val,.5,col_func,force_array[String(kickoff_val)]);
    document.getElementById('nodeSliderVal').innerHTML = kickoff_val;
    slider.value = kickoff_val;

    document.getElementById("node_counter").innerHTML = String(nodes.length) + " nodes with inbound links >= "+String(kickoff_val);
}

/* --- Logic to create initial graph --- */
var isMobile = window.matchMedia || window.msMatchMedia;
isMobile = isMobile("(pointer:coarse)").matches;

if(isMobile){
    var node_threshold = 16;
}else{
    var node_threshold = 6;
}

var data = socialdata; //socialdata  is declared in script-tag import of social_dataset.js

var col_func = function(obj){ //passed as an argument to kickoff
    return (obj.inbound / 4)+3;
}

var slider_value = node_threshold;
document.getElementById('nodeSliderVal').innerHTML = slider_value;
document.getElementById('node_range').value = slider_value;
kickoff(slider_value,.5,col_func,force_array[String(slider_value)]);

document.getElementById("node_counter").innerHTML = String(nodes.length) + " nodes with inbound links >= "+String(slider_value);
