<?php

$meta['title'] = 'Alan McKay | Home';

$meta['description'] = 'Homepage of Alan Mckay. Directory for writings, projects, and social media. Computer Scientist and graduate student at the University of Iowa.';

include('header.php');

?>

<div id='homeWrapper'>
            <header style='overflow:hidden'>
                <h1 style='float:right'><a href='about/'>&nbsp;About</a>
                <h1 style='float:right'><a id='home_link' href='./'>Alan McKay |</a></h1>
            </header>
            <nav>
                <a href='writings/'>
                    <img src='images/text-logo-grey.png' alt='Icon for blog link'>
                    Writings
                </a>
                <a href='projects/'>
                    <img src='images/description.svg' alt='Icon for projects link'>
                    Projects
                </a>
                <a href='https://vsco.co/alanmckay/gallery' target="_blank" rel="noopener noreferrer">
                    <img src='images/vsco-logo-grey.png' alt='Icon for VSCO link'>
                    VSCO
                </a>
                <a href='https://github.com/alanmmckay' target="_blank" rel="noopener noreferrer">
                    <img src='images/github-logo-grey.png' alt='Icon for Github Link'>
                    GitHub
                </a>
                <a href='https://www.linkedin.com/in/alan-mckay-701b4a1b8/' target="_blank" rel="noopener noreferrer">
                    <img src='images/linkedin-logo-grey.png' alt='Icon for linked-in Link'>
                    LinkedIn
                </a>
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
