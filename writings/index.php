<?php

$canonical = 'https://alanmckay.blog/writings/';

$title = 'Alan McKay | Writings';

$meta['title'] = 'Alan McKay | Writings';

$meta['description'] = "Various writings of Alan McKay. Writings of the some observations of people and the places they exist; Wrtings of the various happenings within these spaces.";

$meta['url'] = 'https://alanmckay.blog/writings/';

$relative_path = "../";

include('../header.php');

?>
        <div id='homeWrapper'>
            <header id='breadNav' style='overflow:hidden'>
                <h1><a href='./' class='currentLink'>&nbsp;&gt; Writings</a>
                <h1><a href='../'>Home</a></h1>
            </header>
            <nav>
                <a href='./' class='currentLink'>
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
