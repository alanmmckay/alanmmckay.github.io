<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/writings/';

$title = 'Alan McKay | Writings';

$meta['title'] = 'Alan McKay | Writings';

$meta['description'] = "Various writings of Alan McKay. Writings of the some observations of people and the places they exist; Wrtings of the various happenings within these spaces.";

$meta['url'] = 'https://alanmckay.blog/writings/';

include('../header.php');

?>
        <div id='homeWrapper'>
            <header>
                <h1><a href='../'>Alan McKay</a></h1>
            </header>
            <nav>
                <a href='./'>
                    <img src='../images/text-logo-grey.png' alt='Icon for blog link'>
                    Writings
                </a>
                <a href='describe/' class='writing'> Describing Elsewhere</a>
                <a href='elsewhere/' class='writing'> Experiencing Elsewhere</a>
                <a href='bench/' class='writing'> The Bench</a>
                <a href='flow/' class='writing'> Flow</a>
                <a href='sound/' class='writing'> The Connectivity of Sound</a>
                <a href='social/' class='writing'> Social Media</a>
                <a href='leaf/' class='writing'> Leaves</a>
                <a href='statement/' class='writing'> Statement of Purpose</a>
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
