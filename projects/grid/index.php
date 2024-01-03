<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/grid/';

$title = 'Alan McKay | Project | HexGrid';

$meta['title'] = 'Alan McKay | HexGrid';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/projects/grid/';

include('../../header.php');

?>
        <section id='writingsWrapper'>
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
                            It was during this course that I started and finished a project that I am still proud of to this day. It was the first time I dug real deep to become intimate with a language while applying some other facet of my studies - The functions learned through the trigonometry course I was also taking. These functions provided the framework to scaffold atop to the task.
                        </p>
                        <p>
                            This project went beyond the expectations of a student of Web Scripting. It produced something tangible in terms representing data in a dynamic way. It involved implementing a lot of components that would in turn produce more components to build the larger framework.
                        </p>
                        <p>
                            What is this project? It is a dynamically generated hexagonal grid which can be interacted with via mouse input. Think of the layer on the map of the user-interface for a video game like Civilization. The end result of my efforts cumulated in a Javascript file getting close to 800 lines of code - something significant for an Alan who only had one semester prior of proper programming!
                        </p>
                        <p>
                            A live version of the script is below. In addition to the buttons included below the visual panel, note that the grid responds to mouse input on both mouse-over and by tapping/clicking on it.
                        </p>

                    <hr>
                    </section>
                    <header>
                        <h1>Javascript: Hexagon Grid</h1>
                    </header>
                    <figure style='border:solid #5F666D 1px;overflow:auto;clear:both'>
                        <canvas id='myCanvas' width='500' height='275' style='width:100%;float:left;clear:right;'></canvas>
                    </figure>
                    <form id='grid-control'>
                        <h4> Grid Controls: </h4>
                        <div style='clear:both;overflow:auto'>
                            <ul style='margin-bottom:0px;'>
                                <li>
                                    <label for='sizeslider'>Size of Hexagon:</label><br>
                                    <input type='range' id='sizeslider' min='10' max='50' value='35' oninput='slider_function(hexV)' style='width:95%;'><br>
                                </li>
                            </ul>
                            <ul class='horizontal'>
                                <li>
                                    <label for='addHex'>Add a hexagon to the grid</label><br>
                                    <input type='button' id='addHex' value='Add hex' onclick='add_Hex(hexV)'>
                                </li>

                                <li>
                                    <label for='addNullHex'>Add an invisible (null) hex to the grid</label><br>
                                    <input type='button' id='addNullHex' value='Add Null hex' onclick='add_Hex(hexV,null)'>
                                </li>

                                <li>
                                    <label for='removeHex'>Remove a hexagon from the grid</label><br>
                                    <input type='button' id='removeHex' value='Remove hex' onclick='remove_Hex(hexV)'><br>
                                </li>
                            </ul>

                            <ul class='horizontal'>
                                <li>
                                    <label for='addColumn'>Increase amount of columns</label><br>
                                    <input type='button' id='addColumn' value='Add Column' onclick='add_Column(hexV)'>
                                </li>

                                <li>
                                    <label for='removeColumn'>Decrease amount of columns</label><br>
                                    <input type='button' id='removeColumn' value='Remove Column' onclick='remove_Column(hexV)'><br>
                                </li>

                                <li>
                                    <label for='originDisplay'>Display/Hide all points of origin</label><br>
                                    <input type='button' id='originDisplay' value='Show Points of Origin' onclick='draw_Origin(hexV)'>
                                </li>
                            </ul>
                        </div>
                            <ul>
                                <li>
                                    <label for='traceOrig'>Toggle trace lines from any visible hexagon's point of origin to the mouse cursor</label><br>
                                    <input type='button' id='traceOrig' value='Trace Origin lines' onclick='trace_Orig(hexV)'>
                                </li>

                                <li>
                                    <label for='traceAdjOrig'>Toggle trace lines from any non-visible hexagons point of origin to the mouse cursor</label><br>
                                    <input type='button' id='traceAdjOrig' value='Trace Adjacency lines' onclick='trace_Adj(hexV)'>
                                </li>
                            </ul>
                </form>
                <script src='hex.js'></script>
                <script>
                    var hexV = grid_producer("myCanvas",35,3,25,25);

                    var hexContainer = [];
                        hexContainer[0] = new hex(hexV,"tile1");
                        hexContainer[1] = new hex(hexV,"tile1");
                        hexContainer[2] = new hex(hexV,"tile1");
                        drawHexes(0,hexV);

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
    </body>
</html>
