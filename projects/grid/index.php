<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/grid/';

$title = 'Alan McKay | Project | HexGrid';

$meta['title'] = 'Alan McKay | HexGrid';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/projects/grid/';

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            Having recently finished my Master's degree, it's good to look back and reflect on all the pieces that compose this accomplishment. My educational journey began January 2015. The first semester consisted of my working on prerequisite courses to begin working on the degree I was seeking - an Associates of Applied Sciences for web development and programming. Motivation for pursuing this was simply to learn how to code. Skill was quickly formed from that motivation.
                        </p>
                        <p>
                            Fall 2016 had me taking a Web Scripting course. The only dynamic programming language I had prior experience with was PhP. This course would introduce Javascript. Web Scripting had us implementing simple things such as client-side form validation or simple canvas animation.
                        </p>
                        <p>
                            It was during this course that I started and finished a project that I am still proud of to this day. It was the first time I dug real deep to become intimate with a language while applying another facet of my studies - a Trigonometry mathematics course. The mathematics functions studied provided the atom used to produce the result.
                        </p>
                        <p>
                            This project went beyond the expectations of a student of Web Scripting. It produced something tangible in terms representing data in a dynamic way. It involved implementing a lot of components that would produce components to build the larger framework.
                        </p>
                        <p>
                            What is this project? It is a dynamicly generated hexagonal grid which can be interacted with. Think of the layer on the map of the user-interface for a game like Civilization. The end result of my efforts cumulated in a Javascript file getting close to 800 lines of code - something significant for an Alan who only had one semester prior of proper programming!
                        </p>
                        <p>
                            I've learned a lot since then. This hex-grid was developed before a time I even knew what object-oriented programming was. The patterns I employed to solve this task were based on the primitive approaches I knew at the time. I have an old writing designed for an older portfolio which describes how it works. Not understanding the prototyping nature of javascript, I tried my best to describe it as a set of function calls operating on a set of arrays; a lot of what was written here showed wider lack of understanding.
                        </p>
                        <p>
                            The design of the script itself shows a lack of regard for modularity. Indeed, I've done a little bit of refactoring to open options for hosting it on this page. Viewing the unedited version of the script can happen via this web pages repository, specifically <a href='https://github.com/alanmmckay/alanmmckay.github.io/commit/644aa335a106aba0725e68d13a50913cf96acedd' target="_blank" rel="noopener noreferrer">here</a> at commit hash 644aa33. Note that the refactoring I've done since is fairly minimal. A key reason for this is that this project warrants a fresh start.
                        </p>
                        <p>
                            A live version of the script is below this preface. I've left in place some buttons that act as a tool to show how it works through interaction. These tools will inform the user that a brute-force application of the closest pair algorithm is in use. If I decide to reimplement this project, I'll certainly be taking advantage of the divide and conquer algorithm that I've since learned.
                        </p>
                        <p>
                            This page may be revisted in the future. I would like to add a section describing the logical sequence of events in terms of how it works, (just described broadly/ambiguously). Until then, note that the grid responds to mouse input on both mouse-over and through tapping/clicking the grid, in addition to the buttons included below the visual panel.
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Implementation of a Hexagon Grid</h1>
                    </header>

                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>
