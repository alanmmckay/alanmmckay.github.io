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
            <nav>
                <a href='./'>
                    <img src='../images/description.svg' alt='Icon for blog link'>
                    Projects
                </a>
                <a href='gallery/' class='writing'> Javascript: Balanced Image Gallery</a>
                <a href='dataflow/' class='writing'> Research: Privacy and Dataflow</a>
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
