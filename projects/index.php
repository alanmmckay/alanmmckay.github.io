<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/projects/';

$title = 'Alan McKay | Projects';

$meta['title'] = 'Alan McKay | Projects';

$meta['description'] = "Index of articles detailing various programming projects worked on. All related to Computer Science from the context of assessment, freelance, and/or interest.";

$meta['url'] = 'https://alanmckay.blog/projects/';

$relative_path = "../";

include('../header.php');

?>
        <div id='homeWrapper'>
            <header>
                <h1><a href='../'>Alan McKay</a></h1>
            </header>
            <p id='debug' style='position:fixed'>here</p>
            <nav>
                <a href='./'>
                    <img src='../images/description.svg' alt='Icon for blog link'>
                    Projects
                </a>
                <a href='social/' class='writing'> Project: Social Computing</a>
                <a href='aquatint/' class='writing'> Web Development: Aquatint Image Processor</a>
                <a href='safety/' class='writing'> PostgreSQL GIS: Cycling Safety Database</a>
                <a href='organization/' class='writing'> Teaching: Computer Organization</a>
                <a href='protocol/' class='writing'> Research: Population Protocol</a>
                <a href='compiler/' class='writing'> Project: Klein Compiler</a>
                <a href='cup/' class='writing'> Web Development: Cup of Joe</a>
                <a href='grid/' class='writing'> Javascript: Hexagon Grid</a>
            </nav>
        </div>
    </body>
    <script src='../js/index_functions.js' ></script>
    <script>
        var isMobile = window.matchMedia || window.msMatchMedia;
        isMobile = isMobile("(pointer:coarse)").matches;
        debug_output = function(string){
            document.getElementById('debug').innerHTML = string;
        }
        if(isMobile){

            if(typeof window.onscrollend == "object"){
                debug_output("detected");
                window.onscroll = function(ev){
                    body = document.getElementsByTagName('body')[0];
                    perimeter_bool = body.getBoundingClientRect().top >= 0;
                    perimeter_bool = perimeter_bool || ( (window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight )
                    if(perimeter_bool){
                        debug_output("reached the perimeter");
                        primeClassTransitions("writing","border-left","solid 2px","2s",true);
                    }else{
                        debug_output("scrolling " + body.getBoundingClientRect().top);
                        applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                    }

                }

                window.onscrollend = function(ev){
                    debug_output("onscrollend");
                    primeClassTransitions("writing","border-left","solid 2px","2s",true);
                }

            }else{
                debug_output("not detected");
                window.ontouchstart = function(ev){
                    applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                }

                window.ontouchmove = function(ev){
                    applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                }

                window.ontouchend = function(ev){
                    primeClassTransitions("writing","border-left","solid 2px","2s",true);
                }

            }

            window.addEventListener('load', function () {
                setTimeout(function(){
                    primeClassTransitions("writing","border-left","solid 2px","2s",false);
                },100);
            });

        }

    </script>
</html>
