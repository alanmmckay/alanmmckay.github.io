<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/projects/';

$title = 'Alan McKay | Projects';

$meta['title'] = 'Alan McKay | Projects';

$meta['description'] = "";

$meta['url'] = 'https://alanmckay.blog/projects/';

include('../header.php');

?>
        <div id='homeWrapper'>
            <header>
                <h1><a href='../'>Alan McKay</a></h1>
            </header>
            <nav>
                <a href='./'>
                    <img src='../images/text-logo-grey.png' alt='Icon for blog link'>
                    Projects
                </a>
                <a href='social/' class='writing'> Project: Social Computing</a>
                <a href='safety/' class='writing'> Postgres GIS: Cycling Safety Database</a>
                <a href='organization/' class='writing'> Teaching: Computer Organization</a>
                <a href='protocol/' class='writing'> Research: Population Protocol</a>
                <a href='compiler/' class='writing'> Project: Klein Compiler</a>
                <a href='cup/' class='writing'> Web Development: Cup of Joe</a>
                <a href='grid/' class='writing'> Javascript: Hexagon Grid</a>
            </nav>
        </div>
    </body>
    <script>
        var isMobile = window.matchMedia || window.msMatchMedia;
        /* Exercise: Need to abstract the styles being changed */
        function primeBorders(transition){
            if (isMobile("(pointer:coarse)").matches){
            writings = document.getElementsByClassName("writing");
                for (i = 0; i < writings.length; i++){
                    writing = writings[i];
                    if (transition == true){
                        writing.style['transition'] = 'border-left .20s';
                    }else{
                        writing.style['transition'] = 'border-left 0s';
                    }
                    bound = writing.getBoundingClientRect();
                    //if (bound.y > screen.height){
                        writing.style['border-left'] = 'solid 2px';
                    //}
                }
            }
        }

        function scrollEffect() {
            if (isMobile("(pointer:coarse)").matches){
                height = screen.height;
                threshold = 35;
                writings = document.getElementsByClassName("writing");
                for (i = 0; i < writings.length; i++){
                    writing = writings[i];
                    writing.style['transition'] = 'border-left .20s';
                    bound = writing.getBoundingClientRect();
                    if (bound.y < height - threshold){
                        writing.style['border-left'] = 'solid 3px';
                    }
                    if ((bound.y < 0) || (bound.y > height - threshold)){
                        writing.style['border-left'] = 'solid 2px';
                    }
                }
            }
        }

        primeBorders(false);

        /*window.onscroll = function(ev){
            scrollEffect();
        }*/

        window.ontouchmove = function(ev){
            scrollEffect();
        }

        window.ontouchstart = function(ev){
            scrollEffect();
        }

        window.ontouchend = function(ev){
            primeBorders(true);
        }
    </script>
</html>
