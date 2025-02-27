function switch_scatter(reveal_id, origin_container, selector_id = false){
    let figures = document.getElementById(origin_container).children
    let index = 0;
    while(index < figures.length){
        let figure = figures[index];
        let id = figure.getAttribute("id");
        if(id != reveal_id){
            figure.style['display'] = "none";
        }else{
            figure.style['display'] = 'inherit';
        }
        index += 1;
    }
    if(selector_id != false){
        document.getElementById(selector_id).value = reveal_id;
    }
}

function toggle_scatter_view(origin_switch_id,container_id){
    current_dialog = container_id;
    let origin_switch_element = document.getElementById(origin_switch_id);
    let state = origin_switch_element.getAttribute("value");
    let html_element = document.getElementsByTagName("html")[0];
    let body_element = html_element.getElementsByTagName("body")[0];
    if(state == 0){
        origin_switch_element.setAttribute("value",1);
        origin_switch_element.value = 1;
        html_element.style['overflow'] = 'hidden';
        body_element.style['overflow'] = 'hidden';
        document.getElementById(container_id).showModal();
        origin_switch_element.parentNode.style['visibility'] = 'hidden';
        resize_scatter_view(container_id);
    }else{
        origin_switch_element.setAttribute("value",0);
        origin_switch_element.value = 0;
        html_element.style['overflow'] = 'inherit';
        body_element.style['overflow'] = 'inherit';
        document.getElementById(container_id).close();
        origin_switch_element.parentNode.style['visibility'] = 'inherit';
    }
}

var enacted = false;
function resize_scatter_view(container_id){
    current_dialog = container_id;
    let dialog = document.getElementById(container_id);
    let content = dialog.getElementsByClassName("dialog-content")[0];
    dialog.style['max-height'] = content.getBoundingClientRect().height+20+"px";
    let figure_content = content.getElementsByTagName("div")[1];
    let figure_position = figure_content.getBoundingClientRect();
    figure_content.datawidth = 100
    figure_content.style['margin'] = 'auto';
    let svg_content = figure_content.getElementsByTagName("svg")[0];
    let svg_position;
    let window_height = window.innerHeight;

    function expand(){
        while(figure_position.bottom > window_height){
            figure_content.datawidth -= 1;
            figure_content.style['width'] = figure_content.datawidth + "%";
            figure_position = figure_content.getBoundingClientRect();
            window_height = window.innerHeight;
        }
        return [svg_content.getBoundingClientRect(),false];
    }

    function retract(callback){
        if(enacted == false){
            enacted = true;
            result = expand()
            let height = result[0].height
            enacted = result[1]
            if(height < 300){
                figure_content.style['width'] = '85%';
            }
        }
    }

    if(window.innerHeight > 350){
        retract(expand);
    }

}


function create_scatter(dataset,type,element_id,x_domain,y_domain,x_tick_values = [],y_tick_values = []){
    let margin = {top: 10, right:30, bottom: 30, left: 60}, width = 600 - margin.left - margin.right, height = 500 - margin.top - margin.bottom;

    let svg_width = width + margin.left + margin.right;
    let svg_height = height + margin.top + margin.bottom;
    let figure = d3.select("#"+element_id)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top +")");

    let x;
    let y;
    let xAxis;
    let yAxis;

    if(type == "log"){

        x = d3.scaleLog().domain(x_domain).range([0, width]);
        y = d3.scaleLog().domain(y_domain).range([height,0]);

        xAxis = figure.append("g")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(x)
                    .tickValues(x_tick_values)
                    .ticks(10,
                            function(d){
                                return 10 + "^" + Math.round(Math.log(d) / Math.LN10);
                            }));

        yAxis = figure.append("g")
            .call(d3.axisLeft(y)
                    .tickValues(y_tick_values)
                    .ticks(10,
                            function(d){
                                return 10 + "^" + Math.round(Math.log(d) / Math.LN10);
                            }));

    }else if(type == "linear"){

        x = d3.scaleLinear().domain(x_domain).range([0, width]);
        y = d3.scaleLinear().domain(y_domain).range([height,0]);
        xAxis = figure.append("g").attr("transform","translate(0," + height + ")").call(d3.axisBottom(x));
        yAxis = figure.append("g").call(d3.axisLeft(y));

    }

    //viewBox="0 0 600 500" preserveAspectRatio="xMidYMid meet" style="width:100%"
    var clip = figure.append("defs").append("SVG:clipPath")
        .attr("id", "clip"+String(element_id))
        .append("SVG:rect")
        .style("width", "98%")
        .style("height", "92%")
        .attr("x",0)
        .attr("y",0);

    var scatter = figure.append('g')
        .attr("clip-path", "url(#clip"+String(element_id)+")");

    scatter.append('g')
        .selectAll("circle")
        .data(dataset.filter(function(d) { return d.key > x_domain[0]}))
        .enter()
        .append("circle")
        .attr("cx", function(d) { return x(d.key);})
        .attr("cy", function(d) { return y(d.value/8029)})
        .attr("r",7)
        .style("fill","#1F78B4")
        .style("opacity",0.75)
        .append("title")
        .text(d => d.value + " node(s) with degree " + d.key + "\nDistribution: " + (d.value/8029).toFixed(4));

    figure.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 0 -margin.left)
        .attr("x",0 - (height / 2))
        .attr("dy", "1em")
        .style("text-anchor", "middle")
        .style('fill',"#5f666d")
        .style("font-size", "14px")
        .text("Proportion of nodes with degree (k)");

    var zoom = d3.zoom()
        .scaleExtent([-20,200])
        .extent([[0,0], [width,height]])
        .on("zoom",updateChart);

    figure.append("rect")
        .style("width", "98%")
        .style("height", "92%")
        .style("fill", "none")
        .style("pointer-events","all")
        .call(zoom);

    function updateChart(e){
        var newX = e.transform.rescaleX(x);
        var newY = e.transform.rescaleY(y);
        if(type == "linear"){
            xAxis.call(d3.axisBottom(newX))
            yAxis.call(d3.axisLeft(newY))
        }else if(type == "log"){
            xAxis.call(d3.axisBottom(newX)
                        /*.tickValues(x_tick_values)
                        .ticks(10,
                                function(d){
                                    return 10 + "^" + Math.round(Math.log(d) / Math.LN10);
                                })*/);
            yAxis.call(d3.axisLeft(newY)
                        /*.tickValues(y_tick_values)
                        .ticks(10,
                        function(d){
                            return 10 + "^" + Math.round(Math.log(d) / Math.LN10);
                        })*/);
        }

        scatter.selectAll("circle")
            .attr('cx',function(d) {return newX(d.key)})
            .attr('cy',function(d) {return newY(d.value/8029)});
    }
    }
