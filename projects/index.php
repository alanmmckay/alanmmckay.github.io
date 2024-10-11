<?php

$canonical = 'https://alanmckay.blog/projects/';

$title = 'Alan McKay | Projects';

$meta['title'] = 'Alan McKay | Projects';

$meta['description'] = "Index of articles detailing various programming projects worked on. All related to Computer Science from the context of assessment, freelance, and/or interest.";

$meta['url'] = 'https://alanmckay.blog/projects/';

$relative_path = "../";

include('../header.php');

?>
        <div id='homeWrapper'>
            <header id='breadNav' style='overflow:hidden'>
                <h1><a href='./' class='currentLink'>&nbsp;&gt; Projects</a>
                <h1><a href='../'>Home</a></h1>
            </header>
            <nav>
                <div class='currentLink'>
                    <a href='./'>
                        <img src='../images/description.svg' alt='Icon for blog link'>
                    Projects
                    </a>
                </div>
                <div class='writing'>
                    <a href="form_input_field/"> Ruby Gem: form_input_field</a>
                </div>
                <div class='writing'>
                    <a href='gallery/'> Javascript: Balanced Image Gallery</a>
                </div>
                <div class='writing'>
                    <a href='dataflow/'> Research: Privacy and Dataflow</a>
                </div>
                <div class='writing'>
                    <a href='social/'> Data Science: Social Computing</a>
                </div>
                <div class='writing'>
                    <a href="form/"> Ruby on Rails: Developing DRY Forms</a>
                </div>
                <div class='writing'>
                    <a href='aquatint/'> Web Development: Aquatint Image Processor</a>
                </div>
                <div class='writing'>
                    <a href='safety/'> Data ETL: Cycling Safety Database</a>
                </div>
                <div class='writing'>
                    <a href='organization/'> Teaching: Computer Organization</a>
                </div>
                <div class='writing'>
                    <a href='protocol/'> Research: Population Protocol</a>
                </div>
                <div class='writing'>
                    <a href='compiler/'> Project: Klein Compiler</a>
                </div>
                <div class='writing'>
                    <a href='cup/'> Web Development: Cup of Joe</a>
                </div>
                <div class='writing'>
                    <a href='grid/'> Javascript: Hexagon Grid</a>
                </div>
            </nav>
        </div>
    </body>
    <script src='../js/index_functions.js' ></script>
    <script>

        var isMobile = window.matchMedia || window.msMatchMedia;
        isMobile = isMobile("(pointer:coarse)").matches;

        if(isMobile){

            let scroll_end = null;

            window.onscroll = function(ev){
                if(scroll_end != null){clearTimeout(scroll_end);}
                applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                scroll_end = setTimeout(function(){
                    primeClassTransitions("writing","border-left","solid 2px","2s",true);
                },750);
            }

            window.onscrollend = function(ev){
                primeClassTransitions("writing","border-left","solid 2px","2s",true);
            }

            window.addEventListener('load', function () {
                setTimeout(function(){
                    primeClassTransitions("writing","border-left","solid 2px","2s",false);
                },100);
            });

        }

    </script>
</html>
