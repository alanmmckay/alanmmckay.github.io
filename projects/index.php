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
    <script>
        var isMobile = window.matchMedia || window.msMatchMedia;
        /* Exercise: Need to abstract the styles being changed */
        function primeBorders(transition){
            if (isMobile("(pointer:coarse)").matches){
            writings = document.getElementsByClassName("writing");
                for (i = 0; i < writings.length; i++){
                    writing = writings[i];
                    if (transition == true){
                        writing.style['transition'] = 'border-left 2s';
                    }else{
                        writing.style['transition'] = 'border-left 0s';
                    }
                    bound = writing.getBoundingClientRect();
                    writing.style['border-left'] = 'solid 2px';
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
                    bound = writing.getBoundingClientRect();
                    if (bound.y < height - threshold){
                        writing.style['transition'] = 'border-left .5s';
                        writing.style['border-left'] = 'solid white 10px';
                    }
                    if ((bound.y < 0) || (bound.y > height - threshold)){
                        writing.style['transition'] = 'border-left 1s';
                        writing.style['border-left'] = 'solid #778088 2px';
                    }
                }
            }
        }

        window.onscroll = function(ev){
            scrollEffect();
        }

        window.onscrollend = function(ev){
            primeBorders(true);
        }

        window.addEventListener('load', function () {
            setTimeout(function(){
                primeBorders(false);
            },100);

        });


       /*
        window.ontouchmove = function(ev){
            console.log('ontouchmove');
            scrollEffect();
        }

        window.ontouchstart = function(ev){
            console.log('ontouchstart');
            scrollEffect();
        }

        window.ontouchend = function(ev){
            console.log('ontouchend');
            primeBorders(true);
        }
        */

    </script>
</html>
