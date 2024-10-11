<?php

$canonical = 'https://alanmckay.blog/projects/cup/';

$title = 'Alan McKay | Project | Cup of Joe';

$meta['title'] = 'Alan McKay | Cup of Joe';

$meta['description'] = 'Description of a freelance gig which involved the development of a website for a local coffee shop.';

$meta['url'] = 'https://alanmckay.blog/projects/cup/';

$relative_path = "../../";

include('../../header.php');

produce_front_matter("Cup of Joe","Projects");
?>
                    <header>
                        <h1>Web Development: Cup of Joe</h1>
                    </header>
                    <p>
                        Having concluded a semester involving both Intermediate Computing and Design &amp; Analysis of Algorithms, my time was spent going back to my roots as a web developer. This occurred during the winter transition from the semester of Fall 2018.
                    </p>
                    <p>
                        A local coffee shop, Cup of Joe, was a frequent spot of study; this fact helped contribute to successful grades. So what better way to give back by doing a redesign of the current website? A redesign which would make it mobile friendly.
                    </p>
                    <div class='aside'>
                    <figure id='cup-iframe-aside-mobile'>
                        <iframe style='width:340px;height:536px' frameborder="0" src='demo/story/index.php' style='padding-left:0px;'></iframe>
                        <figcaption>
                            Live instance of the mobile variant of the website through the Story page.
                        </figcaption>
                    <hr>
                    </figure>
                    <p style='margin-top:0px;'>
                        The redesign entailed a rebuild of the HTML and CSS - motivated specifically to rid the site of the usage and elaborate nesting of table tags. More modern semantic tags were used instead of the table tags: an aside to note tangential information, lists to designate groupings of links, article to note groupings of paragraphs, sections to differentiate these major components, etc.
                    </p>
                    <p>
                        The foundation of this implementation was built upon a mobile-first design. Here, media queries would kick a certain layout into view based on window size where the initial template being considered was designed for mobile devices. This involved careful consideration towards maintaining the website's aesthetic - an aesthetic which does a good job adhering to the aesthetic of the shop proper. One key facet in accomplishing this was the decision to maintain the site's identity with the navigation bar. Instead of leveraging a hamburger button to splay navigational options, the navigation bar is fixed to the left where the size of its selections maintain a good compromise between easy interaction while not obscuring too much of the view, (regardless of view-screen size). The redesign differentiated further by fixing the navigation bar into view as a user scrolls through a given page.
                    </p>
                    <figure id='cup-iframe-mobile' class='responsive_aside' style='width:95%;'>
                        <!--<a href='./images/cup_story_mobile.webp' target="_blank" rel="noopener noreferrer">
                            <img src='./images/cup_story_mobile.webp' alt='Screenshot of the layout of the Cup of Joe website using a mobile display.' />
                        </a>-->
                        <div style="width:95%;max-width:340px;margin:auto;overflow-y:hidden;height:536px;">
                            <iframe frameborder="0" src='demo/story/index.php' style='padding-left:0px;'></iframe>
                        </div>
                        <figcaption style='max-width:340px;margin:auto;padding-top:12px;'>
                            Live instance of the mobile variant of the website through the Story page.
                        </figcaption>
                        <hr>
                    </figure>
                    <p>
                        In terms of layout, there were two different types of pages that the Cup of Joe website contained. The main page had a unique layout in the sense that the majority of the display emphasized on a slideshow of images from the coffee shop. The other pages consisted of textual content with an image banner and occasionally information placed as an aside. The responsive redesign would not only determine the sizes of these elements, but the location they would be drawn.
                    </p>
                    </div>
                    <hr>
                    <figure class='image-collage'>
                        <ul>

                            <li id='sixty'>
                                <a href='./images/cup_story_desktop.webp' target="_blank" rel="noopener noreferrer">
                                <figure>
                                    <img src='./images/cup_story_desktop.webp' alt='Screenshot of the layout of the Cup of Joe website using a desktop display.' />
                                    <figcaption>
                                        The desktop variant of the Cup of Joe website. Not much was changed here; Things look mostly the same.
                                    </figcaption>
                                </figure>
                                </a>
                            </li>

                            <li id='thirty'>
                                <a href='./images/cup_story_tablet.webp' target="_blank" rel="noopener noreferrer">
                                <figure>
                                    <img src='./images/cup_story_tablet.webp' alt='Screenshot of the layout of the Cup of Joe website using a tablet display.' />
                                    <figcaption>
                                        The tablet layout of the Cup of Joe website. Note the repositioning and resizing of elements which lend well to the browsing context.
                                    </figcaption>
                                </figure>
                                </a>
                            </li>

                        </ul>
                        <figcaption>
                            Comparison of desktop variant and tablet variant of the website. Note the repositioning of elements which emphasizes on key components which lend well to the browsing context.
                        </figcaption>
                    </figure>
                    <hr>
                    <p>
                        Once implementing the redesign for the main page and the story page, I shared them with the proprietor of Cup of Joe. She was impressed! More importantly, I had good timing. This was due to the fact that her website was built upon a framework that was about to have its support revoked - (if I recall correctly, it involved Microsoft's Silverlight). The host of her website did not have the time to redesign and re-implement the website using some other framework.
                    </p>
                    <p>
                        What's been shown thus far has been static in nature. There indeed was a non-static feature in place. There was a music page which allowed the posting of related events. This had its own set of controls that the owner had access to. Thus, my initial intention of a straight-foward mobile redesign would balloon into the inclusion and implementation of a simple content management system.
                    </p>
                    <p>
                        Implementation of the content management system would be through a PHP back-end interacting with a MySQL database. Here, user accounts could be created, events could be posted and edited, and a new feature was provided with shop integration where products being sold could also be posted. All this control was provided through a set of pages that could be accessed using any browser. These control pages would leverage a simple bootstrap theme to allow mobile access; I was not shy to use the hamburger button in the context of using these control pages.
                    </p>
                    <div class='slide-deck'>
                    <hr>
                        <figure>
                            <ul>

                                <li class='control_slide'>
                                    <a href='./images/cup_control_01.webp' target="_blank" rel="noopener noreferrer">
                                        <figure>
                                            <img src='./images/cup_control_01.webp' alt='A screenshot of the Cup of Joe control page in which a user is navigating to an event creation page.'/>
                                            <figcaption>
                                                Slide 1/5: Selecting a menu item.
                                            </figcaption>
                                        </figure>
                                    </a>
                                </li>

                                <li class='control_slide'>
                                    <a href='./images/cup_control_02.webp' target="_blank" rel="noopener noreferrer">
                                        <figure>
                                            <img src='./images/cup_control_02.webp' alt='A screenshot of the Cup of Joe event creation page in which a user is filling out the relevant forms.'/>
                                            <figcaption>
                                                Slide 2/5: Filling out an event creation form.
                                            </figcaption>
                                        </figure>
                                    </a>
                                </li>

                                <li class='control_slide'>
                                    <a href='./images/cup_control_03.webp' target="_blank" rel="noopener noreferrer">
                                        <figure>
                                            <img src='./images/cup_control_03.webp' alt='A screenshot of the Cup of Joe control page in which a user is selecting an option to edit a current event.'/>
                                            <figcaption>
                                                Slide 3/5: Receiving feedback for event created. Selecting an event to edit.
                                            </figcaption>
                                        </figure>
                                    </a>
                                </li>

                                <li class='control_slide'>
                                    <a href='./images/cup_control_04.webp' target="_blank" rel="noopener noreferrer">
                                        <figure>
                                            <img src='./images/cup_control_04.webp' alt='A screenshot of the Cup of Joe edit event page in which a user is changing the date of an event.'/>
                                            <figcaption>
                                                Slide 4/5: Viewing event edit form; Selecting a new Date of event.
                                            </figcaption>
                                        </figure>
                                    </a>
                                </li>

                                <li class='control_slide'>
                                    <a href='./images/cup_control_05.webp' target="_blank" rel="noopener noreferrer">
                                        <figure>
                                            <img src='./images/cup_control_05.webp' alt='A screenshot of the Cup of Joe control page which is informing a user that the changes made in a prior edit have taken effect.'/>
                                            <figcaption>
                                                Slide 5/5: Receiving feedback for event edited.
                                            </figcaption>
                                        </figure>
                                    </a>
                                </li>

                            </ul>

                            <figcaption id='slideshow-control' style='display:none;'>
                                <ul>
                                    <li>
                                        <a class='prev' onclick="plusSlides(-1)"> ❮ </a>
                                    </li>
                                    <li>
                                        Slideshow Control
                                    </li>

                                    <li>
                                        <a class='next' onclick='plusSlides(1)'> ❯ </a>
                                    </li>
                                </ul>
                            </figcaption>
                        </figure>
                        <hr>
                    </div>
                    <p>
                        The public-facing pages of the Cup of Joe website were then templated using PHP and thus integrated access to the database to allow the display of events and shop links. The mobile redesign was made easier through the modularity provided through this template.
                    </p>
                    <p>
                        It's worth reflecting on the work done here. While looking through the <a href='https://web.archive.org/web/20181119220446/http://www.cupofjoe-cedarfalls.com/music' target="_blank" rel="noopener noreferrer">archive</a> of this website, I'm drawn to the difference between what was then called the music page and what is currently called the event page. This was a place where I decided to introduce new styling in an attempt to make the website more coherent in style. The new styling bore similarity to how the aside blurbs were displayed within the various pages, providing a more cohesive experience with respect to the aesthetic.
                    </p>
                    <hr>
                    <figure class='image-collage'>
                        <ul>

                            <li>
                                <a href='./images/cup_events_red.webp' target="_blank" rel="noopener noreferrer">
                                    <figure>
                                        <img src='./images/cup_events_red.webp' alt='A screenshot of the Cup of Joe events page.' />
                                        <figcaption>
                                            The events page as it currently exists.
                                        </figcaption>
                                    </figure>
                                </a>
                            </li>

                            <li>
                                <a href='./images/cup_music.webp' target="_blank" rel="noopener noreferrer">
                                    <figure>
                                        <img src='./images/cup_music.webp' alt='A screenshot of the Cup of Joe events page as it existed prior to the website rebuild.' />
                                        <figcaption>
                                            The variant of the events page as it existed prior to the overhaul.
                                        </figcaption>
                                    </figure>
                                </a>
                            </li>

                        </ul>
                        <figcaption>
                            Comparison between the new layout of the events page (left) and the old layout from what was called the music page (right).
                        </figcaption>
                    </figure>
                    <hr>
                    <p>
                        The result of my efforts can be viewed on the company's domain: <a href='https://www.cupofjoe-cedarfalls.com/' target="_blank" rel="noopener noreferrer">www.cupofjoe-cedarfalls.com</a>. It seems that events are no longer being hosted at the location, thus the events page has been removed altogether. My personal domain is hosting a live demo of the website as well. It can be viewed <a href='demo/index.php' target="_blank" rel="noopener noreferrer">here</a>. <!--A demo control page can also be viewed <a href='demo.php'>here</a>.-->
                    </p>
                    <!-- https://web.archive.org/web/20181119220446/http://www.cupofjoe-cedarfalls.com/music -->
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <script>

            let slideIndex = 1;
            function plusSlides(n){
                showSlides(slideIndex += n,false);
            }

            function currentSlide(n){
                showSlides(slideIndex = n,true);
            }

            function showSlides(n,init){
                let i;
                let slides = document.getElementsByClassName("control_slide");
                let max = 0;
                let caption_max = 0;
                let figure;
                let image;
                let height;
                let pad;
                if (n > slides.length) { slideIndex = 1;}
                if (n < 1) {slideIndex = slides.length}

                if (init == true){

                    // Finding maximum height for images:
                    for (i = 0; i < slides.length; i++){
                        slides[i].style.display = "block";
                        figure = slides[i].getElementsByTagName('figure')[0];
                        image = figure.getElementsByTagName('img')[0];
                        image.style["padding-bottom"] = "0px";
                        height = image.getBoundingClientRect()['height'];
                        if(height > max){
                            max = height;
                        }
                        caption = figure.getElementsByTagName('figcaption')[0];
                        caption.style['padding-bottom'] = '0px';
                        height = caption.getBoundingClientRect()['height'];
                        if(height > caption_max){
                            caption_max = height;
                        }
                    }
                    // Setting pad based on maximum height:
                    for (i = 0; i < slides.length; i++){
                        figure = slides[i].getElementsByTagName('figure')[0];
                        image = figure.getElementsByTagName('img')[0];
                        height = image.getBoundingClientRect()['height'];
                        pad = max - height;
                        image.style["padding-bottom"] = pad + 'px';
                        caption = figure.getElementsByTagName('figcaption')[0];
                        height = caption.getBoundingClientRect()['height'];
                        pad = caption_max - height;
                        caption.style['padding-bottom'] = pad + 'px';
                    }

                    //Disabling flag to discover pad size
                    init = false;
                }

                // Set all slides to be hidden
                for (i = 0; i < slides.length; i++){
                    slides[i].style.display = "none";
                }

                // Unhide relevant slide
                slides[slideIndex-1].style.display = "block";
            }

            window.onload = function(){
                showSlides(slideIndex,true);
                document.getElementById('slideshow-control').style.display = 'block';
            }
            window.onresize = function(){
                currentSlide(slideIndex);
            }

        </script>
    </body>
</html>
