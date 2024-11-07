<?php

$meta['title'] = 'Alan McKay | Home';

$meta['description'] = 'Homepage of Alan Mckay. Directory for writings, projects, and social media. Computer Scientist and graduate student at the University of Iowa.';

include('header.php');

?>

<div id='homeWrapper'>
            <header id='breadNav' style='overflow:hidden'>
                <h1><a href='about/'>&nbsp;About</a>
                <h1><a id='home_link' href='./' style='font-size:20px;'>Alan McKay |</a></h1>
            </header>
            <nav>
                <div>
                    <a href='writings/'>
                        <img src='images/text-logo-grey.png' alt='Icon for blog link'>
                        <span style='margin-left:10px;'>Writings</span>
                    </a>
                </div>
                <div>
                    <a href='projects/'>
                        <img src='images/description.svg' alt='Icon for projects link'>
                        <span style='margin-left:10px;'>Projects</span>
                    </a>
                </div>
                <div>
                    <a href='notes/'>
                        <img src='images/notes.svg' alt='Icon for notes link'>
                        <span style='margin-left:10px;'>Notes</span>
                    </a>
                </div>
                <div>
                    <a href='photography/' style='overflow-wrap: break-word;hyphens: manual;'>
                        <img src='images/shutter-cut.png' alt='Icon for a camera shutter'>
                        <span style='margin-left:10px;'>Photo&shy;graphy</span>
                    </a>
                </div>
                <div>
                    <a href='https://github.com/alanmmckay' target="_blank" rel="noopener noreferrer">
                        <img src='images/github-logo-grey.png' alt='Icon for Github Link'>
                        <span style='margin-left:10px;'>GitHub</span>
                    </a>
                </div>
                <div>
                    <a href='https://www.linkedin.com/in/alan-mckay-701b4a1b8/' target="_blank" rel="noopener noreferrer">
                        <img src='images/linkedin-logo-grey.png' alt='Icon for linked-in Link'>
                        <span style='margin-left:10px;'>LinkedIn</span>
                    </a>
                </div>
            </nav>
        </div>
        <script>
            var isMobile = window.matchMedia || window.msMatchMedia;
            isMobile = isMobile("(pointer:coarse)").matches;

            if(isMobile){
                anchor_object = document.getElementById('home_link');
                anchor_object.setAttribute("href","about/");
            }

        </script>
    </body>
</html>
