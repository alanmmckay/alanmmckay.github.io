<?php

$canonical = 'https://alanmckay.blog/projects/grid/';

$title = 'Alan McKay | Project | HexGrid';

$meta['title'] = 'Alan McKay | HexGrid';

$meta['description'] = 'Project showcase and description of a dynamic hexagon grid written in core Javascript.';

$meta['url'] = 'https://alanmckay.blog/projects/grid/';

$relative_path = "../../";

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <header id='breadNav' class='writingNav' style='overflow:hidden;'>
                <h1 class='breadCurrent'><a href='./' class='currentLink'>&nbsp;&gt; Hexagon Grid</a>
                <h1><a href='../'>&nbsp;&gt; Projects</a>
                <h1><a href='../../'>Home</a></h1>
            </header>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            Having recently finished my Master's degree, it is good to look back and reflect on all the pieces that compose this accomplishment. My educational journey began January 2015. This first semester consisted of working on prerequisite courses to begin working on the degree I was seeking - an Associates of Applied Sciences for web development and programming. Motivation for pursuing this was simply to learn how to code. Skill was quickly formed from that motivation.
                        </p>
                        <p>
                            Fall 2016 had me taking a Web Scripting course. The only scripting programming language I had prior experience with was PhP. This course would introduce Javascript. Web Scripting had us implementing simple things such as client-side form validation or simple canvas animations.
                        </p>
                        <p>
                            It was during this course that I started and finished a project that I am still proud of to this day. It was the first time I dug real deep to become intimate with a language while applying some other facet of my studies - The trigonometric functions learned through a math course that I was also attending at the time. These functions provided the framework to scaffold atop.
                        </p>
                        <p>
                            This project went beyond the expectations of a student in the Web Scripting course. It produced something tangible in terms representing data in a dynamic way. It involved implementing a lot of components that would produce more components to build the larger framework.
                        </p>
                        <p>
                            What is this project? It is a dynamically generated hexagonal grid which can be interacted with via mouse input. Think of the layer on the map of a user-interface for a video game like Civilization. The end result of my efforts cumulated in a Javascript file getting close to 800 lines of code - something significant for an Alan who only had one semester prior of proper programming!
                        </p>
                        <p>
                            A live version of the script is below. In addition to the buttons included below the visual panel, note that the grid responds to mouse input on both mouse-over and by tapping/clicking on it.
                        </p>
                        <a href='#sandbox'>Jump to Sandbox</a>
                    <hr>
                    </section>
                    <header>
                        <h1>Javascript: Hexagon Grid</h1>
                    </header>
                    <h2>Drawing Hexagons</h2>
                    <p>
                        The assignment which influenced this project was a to find a simple JavaScript web component and include it on a page. This would be an exercise of navigating documentation and an API to massage said plugin into a place; A very simple exercise for someone with a lot of programming experience, but a bit more complex for someone new to development in general.
                    </p>
                    <p>
                        Unfortunately, there did not exist a plugin that satisfied the needs for the page I was constructing. I was looking for a dynamic hexagon grid to represent information pertaining to a tabletop campaign. The solution to this conundrum? Make my own. This would be done using JavaScript's canvas API.
                    </p>
                    <p>
                        Luckily I was taking trigonometry at the time. Generating a hexagon takes three key values. The length of any side - <code>S</code>, of the hexagon; and the two sides of the triangle whose hypotenuse is the length of any side which is drawn at an angle. The side which is adjacent to the 30 degree angle of the triangle is denoted as <code>r</code>, and the opposite side is denoted as </code>h</code>. Figure A represents these values.
                    </p>
                    <div class='aside'>
                        <script src='figure_a.js'></script>
                        <figure style='width:150px'>
                            <canvas id='myCanvasA1' width='150' height='130'></canvas>
                            <figcaption style='width:150px;text-align:center'>Figure A - The three trig variables</figcaption>
                            <script>create_fig_a("myCanvasA1");</script>
                        </figure>
                        <figure class='responsive_aside' style='width:inherit;'>
                            <div style='width:150px;margin:auto;'>
                                <canvas id='myCanvasA2' width='150' height='130'></canvas>
                                <figcaption style='width:150px;text-align:center'>Figure A - The three trig variables</figcaption>
                            </div>
                            <script>create_fig_a("myCanvasA2");</script>
                        </figure>
                        <p>
                            If one knows the value of <code>S</code>, the values of <code>h</code> and <code>r</code> are as follows:
                            <ul>
                                <li>
                                    <code>h = (sin(30)*PI/180)*S</code>
                                </li>
                                <li>
                                    <code>r = (cos(30)*PI/180)*S</code>
                                </li>
                            </ul>
                        </p>
                        <p style='margin-bottom:0px'>
                            Once these three values are calculated, drawing a hexagon is a matter of finding a starting point and walking around the perimeter using the three variables and enacting a set of canvas draw methods. This is where two more variables come in to represent the initial point of the perimeter of a given hexagon: some <code>X</code> and <code>Y</code> value on the two-dimensional plane. Following Figure A, the <code>X</code> and <code>Y</code> values are initially set to 25. This initial value represents the margin between the canvas tag and the hexagon's left-most point.
                        </p>
                    </div>
                    <p>
                        After the initialization of the <code>X</code> and <code>Y</code> values, the following logic is used to walk around the perimeter:
                        <ul>
                            <li>
                                From the initial vertex, increase the x-coordinate by <code>h</code> and increase the y-coordinate by <code>r</code>. This is the bottom-left vertex.
                            </li>
                            <li>
                                From the bottom-left vertex, increase the x-coordinate's value by <code>s</code>. This is the bottom-right vertex.
                            </li>
                            <li>
                                From the bottom-right vertex, increase <code>X</code> by <code>h</code> and decrease <code>Y</code> by <code>r</code>. This is the middle-right vertex.
                            </li>
                            <li>
                                From the middle-right vertex, decrease <code>X</code> by <code>h</code> and decrease <code>Y</code> by <code>r</code>. This is the top-right vertex.
                            </li>
                            <li>
                                From the top-right vertex, decrease <code>X</code> by <code>S</code> and maintain the value of <code>Y</code>. This is the top left-vertex.
                            </li>
                            <li>
                                From the top-left vertex, decrease <code>X</code> by <code>h</code> and increase <code>Y</code> by <code>r</code>. We are now at the initial vertex.
                            </li>
                        </ul>
                    </p>
                    <p>
                        More logic is needed to handle multiple hexagons to decide where they should lie on a grid. New values need to be established to organize this effort. The hexagons in this script are generated by establishing the amount of columns the grid has. Each subsequent hexagon is set down on a horizontal plane until the amount of hexagons in a row exceeds the amount of columns, wherein the next hexagon is kicked back to the starting x-coordinate and proper calculations are made to set it below the initial hexagon in the previous row. This is done by setting the y-coordinate to <code>2*r</code> below that very hexagon.
                    </p>
                    <p>
                        Note that offset needs to be handled too. Consider the every-other nature of the hex-grid. The first hexagon is drawn, then logic needs to be introduced to draw the next hexagon by shifting the corresponding vertices down by <code>r</code> and over by <code>h + s</code>. The third hexagon needs to have the opposite applied to the y-coordinate to bring it back up to the same plane as the original hexagon. One last contingency needs to be made during this process: to check whether or not there is an odd or even number columns. This is relevant when a new row of hexagons starts as the previously drawn hexagon may be shifted by his offset.
                    </p>
                    <figure style='width:100%;'>
                        <div style='width:100%;max-width:350px;margin:auto'>
                            <canvas id='myCanvasB' width='350' height='200' style='width:100%;'></canvas>
                        </div>
                        <script src='figure_b.js'></script>
                        <script>create_fig_b('myCanvasB');</script>
                        <figcaption style='max-width:350px;text-align:right;margin:auto'>
                            Figure B - Vertex Offset
                        </figcaption>
                    </figure>
                    <p>
                        This script was developed during a time before I knew what object oriented design was. A look at the source code will make this apparent. Interestingly, the prototyping nature of JavaScript provided a scaffold for me to implicitly use some of the ideas associated with this paradigm.
                    </p>
                    <p>
                        Minor effort was taken to refactor the code to allow it to easily be plugged into this very web page. This refactoring essentially encapsulates all the logic into a singular grid object. A grid object in this context is composed of a set of hexagons. Indeed, drilling through the logic of the source script will reveal a quasi-constructor to produce a hexagon:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:360px;overflow:auto' max-height='360' src='code/01.html'>
                        </iframe>
                    </figure>
                    <p>
                        Here, naivety can be gleaned. The parameter labeled <code>hexV</code> can be seen as a master record of values associated with the grid object in question. This was my way of of maintaining access to these set of values to help make the decisions required for generating the relevant values of a hexagon. Indeed, (before the minor set of refactors mentioned in the paragraph prior), this information was stored as a global. If I wanted to have multiple grids in the same page, multiple copies of the script's <code>.js</code> file would need to be named and the <code>hexV</code> value be renamed to something unique. A clear lack of understanding of what the <code>this</code> keyword means. This was changed through the minor refactor.
                    </p>
                    <p>
                        The lack of understanding of the <code>this</code> keyword is more obviously realized in the last two statements of the above function. The set of values calculated here are pushed into arrays which maintain the data. Within these arrays it's assumed that the first entry is related to the first hexagon of the grid, the second entry is related to the second hexagon of the grid, etc. Various other methods contained in this grid will operate upon these values and parse through these arrays under such an assumption.
                    </p>
                    <p>
                        What exactly are these set of values? The call to <code>hex_handler()</code> gains access to the set of values previously discussed. It allows access to the next point of origin for the next hexagon to be placed in a grid. From this point of origin, the set of vertices associated with this new hexagon are computed and returned as an associative array:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:930px;overflow:auto' max-height='930' src='code/02.html'>
                        </iframe>
                    </figure>
                    <p>
                        This is where the aforementioned walk around the perimeter of a hexagon exists. The initial call to <code>grid_handler</code> essentially primes the X and Y coordinate previously discussed; it contains the logic that knocks into place the vertex offset described in Figure B and then makes adjustments to these values dependent on the amount of columns contained in a grid.
                    </p>
                    <p>
                        The key takeaway to understanding how this script works is that there exists a master array of data which contains a set of arrays and attributes. The nested arrays contain information relevant to a given layering of a function call. Looking at the function which this recursive pathis instantiated, we see two primary arrays being filled within the master array - <code>hexV.grid</code> and <code>hexV.origin</code>. The center points of each vertex get placed within the origin array. The side vertices get placed into the grid array. These two arrays will have the same length as far as this hex method is concerned. These two arrays will be operated upon concurrently.
                    </p>
                    <p>
                        In terms of drawing the hexagons to a canvas element, this happens within a method called <code>drawHexes</code>. This method primarily iterates through the associative arrays contained in <code>hexV.grid</code> and enacts the relevant draw method calls from the canvas API; the associative arrays that contain the side vertices for each hexagon within the grid which was determined by both the <code>hex_handler</code> and <code>grid_handler</code> oracles.
                    </p>
                    <p>
                        This is a bit messy. It's good to look back on old work and reflect how one has progressed in experience and knowledge. Using a strictly object oriented paradigm of programming would encapsulate these ideas much more cleanly. Regardless, I will maintain that this is very advanced for someone new to programming - having only a single month of experience in JavaScript within the classroom setting. The inclusion of code snippets will cease for the remainder of this writing for this reason.
                    </p>
                    <h2>User Interaction</h2>
                    <p>
                        What's been discussed so far is the general logic to draw a hexagon and then to draw a grid of hexagons. This is done by storing vertex information for each hexagon in an array and then parsing through the array for each set of vertices while enacting a set of draw methods from the canvas API.
                    </p>
                    <p>
                        The fact a grid can adapt to arbitrary size values for the hexagons and column quantities for the grid isn't solely what makes it dynamic. It needs to react to user input. A grid in this context exists to display and return relevant information; the original goal of having a campaign map for a tabletop game would imply that selecting a grid should return some amount of geographic data.
                    </p>
                    <p>
                        Reaction to input implies a set of event handlers. The term "selecting" should key us into the usage of the <code>mousedown</code> event. What's also at play is a change of rendering whilst navigating the mouse through the grid to a target of for selection. The grid informs the user which hexagon <i>will be</i> selected based on their mouse position, as opposed to what <i>has been</i> selected. This is accomplished through the <code>mousemove</code> event.
                    </p>
                    <p>
                        Both event handlers for these two events have a general common principal. The event is attached to the html canvas element in which the grid exists. When the event is fired, the coordinates of the mouse position are retrieved from the event and then normalized with respect to the position of the canvas element and the size of the element as it currently exists in the <code>DOM</code>. These normalized mouse coordinate values are then passed to <code>drawHexes</code> along with a switch condition to allow it to know which event type should be acted on.
                    </p>
                    <p>
                        Before <code>drawHexes</code> is called in this context, the entire canvas is cleared such that it can be redrawn. In the case where the <code>mousedown</code> event was triggered, the fill color of the hexagon being selected will differ from the rest as the canvas is being redrawn. In the case where the <code>mousemove</code> event was triggered, the border of the hexagon will differ.
                    </p>
                    <p>
                        Both these cases take advantage of the normalized mouse coordinates being passed. Recall that the master record of a grid contains two arrays of vertex data: one which contains the side vertices of a hexagon and another that contains the points of origin. A method called <code>getselectedHex</code> was developed to leverage the array that houses these points of origin while comparing them to these normalized mouse coordinates.
                    </p>
                    <div class='aside'>
                        <figure style='overflow:auto;clear:both;width:175px'>
                            <canvas id='figure_ca' width='175' height='175' style='float:left;clear:right;width:100%;'></canvas>
                            <figcaption style='width:100%;text-align:left;margin:auto'>Figure C - Mouse-over distance formula illustration</figcaption>
                        </figure>
                        <p style='margin-top:0px;'>
                            What is the comparison being made in <code>getselectedHex</code>? This method runs through the points of origin applying the distance formula between each point and the normalized mouse coordinates whilst maintaining a minimum value along with the point of origin that generated it. After finding the minimum, the relevant point is annotated within the origin array. Recall that this array is an associative array where each key is a numeric value - making access for this annotation trivial.
                        </p>
                        <figure class='responsive_aside' style='width:inherit;'>
                            <div style='width:175px;margin:auto;'>
                                <canvas id='figure_cb' width='175' height='175'></canvas>
                            </div>
                            <figcaption style='width:95%;text-align:center'>Figure C - Mouse-over distance formula illustration</figcaption>
                        </figure>
                    </div>
                    <figure style='overflow:auto;clear:both;max-width:300px;'>
                        <div style='width:100%;max-width:275px;margin:auto'>
                            <canvas id='figure_d' width='275' height='275' style='float:left;clear:right;width:100%'></canvas>
                        </div>
                        <figcaption id='fig_d_output' style='max-width:275px;width:95%;text-align:right;'>Figure D - Select a hex...</figcaption>
                    </figure>

                    <h3 id='sandbox'> Sandbox: </h3>
                    <div id='gridContent'>
                        <figure style='border:solid #5F666D 1px;overflow:auto;clear:both'>
                            <canvas id='myCanvas' width='500' height='275' style='width:100%;float:left;clear:right;'></canvas>
                            <figcaption id='controlReveal' style='visibility:hidden;float:right'>
                                <button onclick='toggleDialog(true);'> Show Controls </button>
                            </figcaption>
                        </figure>
                        <form class='grid-control'>
                                <h4> Grid Controls: </h4>
                                <div style='clear:both;overflow:auto'>
                                    <ul style='margin-bottom:0px;'>
                                        <li>
                                            <label for='sizeslider1'>Size of Hexagon:</label><br>
                                            <input type='range' id='sizeslider1' min='10' max='50' value='35' oninput='slider_function(hexVs,"sizeslider1");consolidate_sliders("sizeslider1",["sizeslider2"]);' style='width:95%;'><br>
                                        </li>
                                    </ul>
                                    <ul class='horizontal'>
                                        <li>
                                            <label for='addHex'>Add a hexagon to the grid</label><br>
                                            <input type='button' id='addHex' value='Add hex' onclick='add_Hex(hexVs)'>
                                        </li>

                                        <li>
                                            <label for='addNullHex'>Add an invisible hex to the grid</label><br>
                                            <input type='button' id='addNullHex' value='Add Null hex' onclick='add_Hex(hexVs,null)'>
                                        </li>

                                        <li>
                                            <label for='removeHex'>Remove a hexagon from the grid</label><br>
                                            <input type='button' id='removeHex' value='Remove hex' onclick='remove_Hex(hexVs)'><br>
                                        </li>
                                    </ul>

                                    <ul class='horizontal'>
                                        <li>
                                            <label for='addColumn'>Increase amount of columns</label><br>
                                            <input type='button' id='addColumn' value='Add Column' onclick='add_Column(hexVs)'>
                                        </li>

                                        <li>
                                            <label for='removeColumn'>Decrease amount of columns</label><br>
                                            <input type='button' id='removeColumn' value='Remove Column' onclick='remove_Column(hexVs)'><br>
                                        </li>

                                        <li>
                                            <label for='originDisplay'>Display/Hide all points of origin</label><br>
                                            <input type='button' id='originDisplay' value='Show Points of Origin' onclick='draw_Origin(hexVs)'>
                                        </li>
                                    </ul>
                                </div>
                                <!--<ul>
                                    <li>
                                        <label for='traceOrig'>Toggle trace lines from any visible hexagon's point of origin to the mouse cursor</label><br>
                                        <input type='button' id='traceOrig' value='Trace Origin lines' onclick='trace_Orig(hexVs,"traceOrig")'>
                                    </li>

                                    <li>
                                        <label for='traceAdjOrig'>Toggle trace lines from any non-visible hexagons point of origin to the mouse cursor</label><br>
                                        <input type='button' id='traceAdjOrig' value='Trace Adjacency lines' onclick='trace_Adj(hexVs,"traceAdjOrig")'>
                                    </li>
                                </ul>-->
                            </form>
                        <dialog id='grid_control_dialog'>
                            <div id='dialog-content'>
                                <span style='float:right; clear:both;' onclick="toggleDialog(false)"> close [x] </span>
                                <form class='grid-control'>
                                    <h4> Grid Controls: </h4>
                                    <div style='clear:both;overflow:auto'>
                                        <ul style='margin-bottom:0px;'>
                                            <li>
                                                <label for='sizeslider2'>Size of Hexagon:</label><br>
                                                <input type='range' id='sizeslider2' min='10' max='50' value='35' oninput='slider_function(hexVs,"sizeslider2");consolidate_sliders("sizeslider2",["sizeslider1"]);' style='width:95%;'><br>
                                            </li>
                                        </ul>
                                        <ul class='horizontal'>
                                            <li>
                                                <label for='addHex'>Add a hexagon to the grid</label><br>
                                                <input type='button' id='addHex' value='Add hex' onclick='add_Hex(hexVs)'>
                                            </li>

                                            <li>
                                                <label for='addNullHex'>Add an invisible hex to the grid</label><br>
                                                <input type='button' id='addNullHex' value='Add Null hex' onclick='add_Hex(hexVs,null)'>
                                            </li>

                                            <li>
                                                <label for='removeHex'>Remove a hexagon from the grid</label><br>
                                                <input type='button' id='removeHex' value='Remove hex' onclick='remove_Hex(hexVs)'><br>
                                            </li>
                                        </ul>

                                        <ul class='horizontal'>
                                            <li>
                                                <label for='addColumn'>Increase amount of columns</label><br>
                                                <input type='button' id='addColumn' value='Add Column' onclick='add_Column(hexVs)'>
                                            </li>

                                            <li>
                                                <label for='removeColumn'>Decrease amount of columns</label><br>
                                                <input type='button' id='removeColumn' value='Remove Column' onclick='remove_Column(hexVs)'><br>
                                            </li>

                                            <li>
                                                <label for='originDisplay'>Display/Hide all points of origin</label><br>
                                                <input type='button' id='originDisplay' value='Show Points of Origin' onclick='draw_Origin(hexVs)'>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--<ul>
                                        <li>
                                            <label for='traceOrig'>Toggle trace lines from any visible hexagon's point of origin to the mouse cursor</label><br>
                                            <input type='button' id='traceOrig' value='Trace Origin lines' onclick='trace_Orig(hexVs,"traceOrig")'>
                                        </li>

                                        <li>
                                            <label for='traceAdjOrig'>Toggle trace lines from any non-visible hexagons point of origin to the mouse cursor</label><br>grid =
                                            <input type='button' id='traceAdjOrig' value='Trace Adjacency lines' onclick='trace_Adj(hexVs,"traceAdjOrig")'>
                                        </li>
                                    </ul>-->
                                </form>
                            </div>
                        </dialog>
                    </div>
                <script src='hex.js?v=050124'></script>

                <script>
                    var hexV1a = grid_producer("figure_ca",60,1,25,25);
                    var hexContainer1a = [];
                        hexContainer1a[0] = new hex(hexV1a,"tile1");
                        drawHexes(0,hexV1a);
                        trace_Adj(hexV1a);
                        trace_Orig(hexV1a);
                </script>

                <script>
                    var hexV1b = grid_producer("figure_cb",60,1,25,25);
                    var hexContainer1b = [];
                        hexContainer1b[0] = new hex(hexV1b,"tile1");
                        drawHexes(0,hexV1b);
                        trace_Adj(hexV1b);
                        trace_Orig(hexV1b);
                </script>

                 <script>
                    var hexV2 = grid_producer("figure_d",33,5,0,10)
                    var hexContainer2 = [];
                    for(b = 1; b <= 20;b++){
                        if(b%3===0){
                            hexContainer2[b] = new hex(hexV2,"tile"+b, null);
                        }else{
                            hexContainer2[b] = new hex(hexV2,"tile"+b);
                        }
                    }
                    drawHexes(0,hexV2);

                    hexV2.canvas.removeEventListener("mousedown", hexV2.defaultSelectHandler);
                    hexV2.canvas.addEventListener('mousedown', function(evt){
                        for (i = 0; i < hexV2.grid.length; i++){
                            this.vertices = hexV2.grid[i];//resume
                            this.selectedHex = getselectedHex(hexV2);
                            if(hexV2.origin[i] === this.selectedHex.selected && hexV2.origin[i].type !== null){
                                if(hexV2.grid['selected'] === this.vertices){
                                    document.getElementById("fig_d_output").innerHTML = 'Figure D - Hex Name... ';
                                    hexV2.grid['selected'] = null;
                                }else{
                                    document.getElementById("fig_d_output").innerHTML = 'Figure D - Hex Name: '+hexV2.origin[i].name;
                                    hexV2.grid['selected'] = this.vertices;
                                }
                                drawHexes(1,hexV2);
                            }
                        }
                    }, false);

                </script>

                <script>
                    var hexVs = grid_producer("myCanvas",35,3,25,25);

                    var hexContainer = [];
                        hexContainer[0] = new hex(hexVs,"tile1");
                        hexContainer[1] = new hex(hexVs,"tile1");
                        hexContainer[2] = new hex(hexVs,"tile1");
                        drawHexes(0,hexVs);
                </script>
                <script>

                    function toggleDialog(state){
                        if(state === true){
                            document.getElementById("grid_control_dialog").showModal()
                            document.getElementById('controlReveal').style['visibility'] = 'hidden';
                            document.getElementsByTagName('article')[0].style['filter'] = 'blur(.05rem)';
                        }else{
                            document.getElementById("grid_control_dialog").close();
                            document.getElementById('controlReveal').style['visibility'] = 'inherit';
                            document.getElementsByTagName('article')[0].style['filter'] = 'inherit';
                        }
                    }

                    var shrinking;
                    var growing;
                    function grid_control_handler(){
                        shrinking = false;
                        growing = false;
                        if(window.outerHeight > old_screen_height){
                            growing = true;
                        }else if(window.outerHeight < old_screen_height){
                            shrinking = true;
                        }
                        if(shrinking && form.style['position'] != 'fixed'){
                            if(grid.getBoundingClientRect().height + form.getBoundingClientRect().height > window.outerHeight){
                                form.style['position'] = 'fixed';
                                form.style['top'] = '-1000px';
                                document.getElementById('controlReveal').style['visibility'] = 'inherit';
                            }
                        }else
                        if(growing && form.style['position'] == 'fixed'){
                            if(grid.getBoundingClientRect().height + form.getBoundingClientRect().height < window.outerHeight){
                                form.style['position'] = 'inherit';
                                form.style['top'] = '0px';                                
                                document.getElementById('controlReveal').style['visibility'] = 'hidden';
                                document.getElementById("grid_control_dialog").close();
                                document.getElementsByTagName('article')[0].style['filter'] = 'inherit';
                            }
                        }else
                        if(!growing && !shrinking){
                            if(grid.getBoundingClientRect().height + form.getBoundingClientRect().height > window.outerHeight){
                                form.style['position'] = 'fixed';
                                form.style['top'] = '-1000px';
                                document.getElementById('controlReveal').style['visibility'] = 'inherit';
                            }else
                            if(grid.getBoundingClientRect().height + form.getBoundingClientRect().height < window.outerHeight){
                                form.style['position'] = 'inherit';
                                form.style['top'] = '0px';                                document.getElementById('controlReveal').style['visibility'] = 'hidden';
                                document.getElementById("grid_control_dialog").close();
                                document.getElementsByTagName('article')[0].style['filter'] = 'inherit';
                            }
                        }
                        old_screen_height = window.outerHeight;
                    }

                    window.onresize = function(){
                        grid_control_handler();
                    }

                    screen.orientation.addEventListener("change", (event) => {
                        grid_control_handler();
                    });

                    var old_screen_height;
                    var grid;
                    var form;
                    var modal;
                    window.addEventListener('load', function () {
                        old_screen_height = window.outerHeight;
                        wrapper = document.getElementById('gridContent');
                        grid = wrapper.getElementsByTagName('figure')[0];
                        form = wrapper.getElementsByTagName('form')[0];
                        modal = wrapper.getElementsByTagName('dialog')[0];
                        if(grid.getBoundingClientRect().height + form.getBoundingClientRect().height > old_screen_height){
                            form.style['position'] = 'fixed';
                            form.style['top'] = '-1000px';
                            document.getElementById('controlReveal').style['visibility'] = 'inherit';
                        }else{
                            document.getElementById('controlReveal').style['visibility'] = 'hidden';
                        }

                        window.onscroll = function(){
                            if(modal.open){
                                if(grid.getBoundingClientRect().top < -200){
                                    toggleDialog(false);
                                }
                                if(window.outerHeight - grid.getBoundingClientRect().bottom < -200){
                                    toggleDialog(false);
                                }
                            }
                        }

                        modal.addEventListener('click', function(){
                            modal.close();
                            document.getElementById('controlReveal').style['visibility'] = 'inherit';
                            document.getElementsByTagName('article')[0].style['filter'] = 'inherit';
                        });
                        let content = document.getElementById('dialog-content');
                        content.addEventListener('click', function(event){event.stopPropagation()});

                    });
                </script>
                <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>
                            I've learned a lot since initially making this script. This hex-grid was developed before a time I even knew what object-oriented programming was. The patterns I employed to solve the task were based on primitive approaches I only knew at the time. I have an old writing designed for an older portfolio website which describes how it works. Not understanding the prototyping nature of javascript, I tried my best to describe it as a set of function calls operating on a set of arrays; a lot of what was written here showed wider lack of understanding.
                        </p>
                        <p>
                            The design of the script itself shows a lack of regard for modularity. Indeed, I've done a little bit of refactoring to open options for hosting it on this page. Viewing the unedited version of the script can happen via this website's repository, specifically <a href='https://github.com/alanmmckay/alanmmckay.github.io/commit/644aa335a106aba0725e68d13a50913cf96acedd' target="_blank" rel="noopener noreferrer">here</a> at commit hash 644aa33. Note that the refactoring I've done is fairly minimal. A key reason for this is that this project warrants a fresh restart.
                        </p>
                        <p>
                            Through the live script, I've left in place some buttons that act as a tool to show how it works through interaction. These tools will inform the user that a brute-force application of the closest pair algorithm is in use. If I decide to re-implement this project, I'll certainly be taking advantage of the divide and conquer algorithm that I've since learned.
                        </p>
                        <p>
                            I may revisited this page in the future. I would like to add a section describing the logical sequence of events in terms of how it works, (just described broadly/ambiguously).
                        </p>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <script src='../../js/project_functions.js'></script>
        <script>
            setCodeSizeSliders();
        </script>
    </body>
</html>
