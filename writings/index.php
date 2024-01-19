<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/writings/';

$title = 'Alan McKay | Writings';

$meta['title'] = 'Alan McKay | Writings';

$meta['description'] = "Various writings of Alan McKay. Writings of the some observations of people and the places they exist; Wrtings of the various happenings within these spaces.";

$meta['url'] = 'https://alanmckay.blog/writings/';

$relative_path = "../";

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
    <script src='../js/index_functions.js' ></script>
    <script>
        var isMobile = window.matchMedia || window.msMatchMedia;
        isMobile = isMobile("(pointer:coarse)").matches;

        if(isMobile){

            if(typeof window.onscrollend == "object"){

                window.onscroll = function(ev){
                    applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                }

                window.onscrollend = function(ev){
                    primeClassTransitions("writing","border-left","solid 2px","2s",true);
                }

            }else{

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
