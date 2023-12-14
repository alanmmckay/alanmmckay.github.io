<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/cup/';

$title = 'Alan McKay | Project | Cup of Joe';

$meta['title'] = 'Alan McKay | Cup of Joe';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/projects/cup/';

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>
                    <header>
                        <h1>Web Development: Cup of Joe</h1>
                    </header>
                    <p>
                        Having concluded a semester involving both Intermediate Computing and Design &amp; Analysis of Algorithms, time was spent going back to my roots as a web developer during the winter transition from the Fall 2018 semester.
                    </p>
                    <p>
                        A local coffee shop, Cup of Joe, was a frequent spot of study; this fact helped contribute to my successful grades. So what better way to give back by doing a redesign of the current website making it mobile friendly?
                    </p>
                    <div style='clear:both;'>
                    <figure style='float:right;width:25%;margin-left:5%;margin-right:1%;margin-top:1%;margin-bottom:2%'>
                        <img src='../../images/cup_story_mobile.png' alt='' />
                        <figcaption>
                            Mobile variant of the Story page.
                        </figcaption>
                    <hr>
                    </figure>
                    <p>
                        This entailed a rebuild of the HTML and CSS - motivated specifically to rid the site of the usage and nesting of rigid table tags and their various elements. More modern semantic tags were used instead of the table tags: an aside to note tangential information, lists to designate groupings of links, article to note groupings of paragraphs, sections to differentiate these major components, etc.
                    </p>
                    <p>
                        The foundation of this implementation was built upon a mobile-first design. Here, media queries would kick a certain layout into view dependent on window size where the initial template being considered was designed for mobile devices. This involved careful consideration to maintaining the website's aesthetic, which does a good job adhering to the aesthetic of the shop proper. One key facet in accomplishing this was the decision to maintain the site's identity with the navigation bar. Instead of leveraging a hamburger button to splay navigational options, the navigation bar is fixed to the left where the size of its selections maintain a good compromise between easy interaction while not obscuring too much of the view, (regardless of view-screen size). This further differs from prior implementation as the navigation bar now stays in view as a user scrolls through a given page.
                    </p>
                    <p>
                        In terms of layout, there were two different types of pages that the Cup of Joe website contained. The main page had a unique layout in the sense that the majority of the display emphasized on a slideshow of images from the shop. The other pages consisted of textual content with an image banner and occasionally information placed as an aside. The responsive redesign would determine both the sizes of these pieces of each page, but also where and if they would be drawn.
                    </p>
                    </div>
                    <hr>
                    <figure>
                        <ul class='image-collage'>

                            <li style='width:60%;'>
                                <img src='../../images/cup_story_desktop.png' alt='' />
                            </li>

                            <li style='width:35%'>
                                <img src='../../images/cup_story_tablet.png' alt='' />
                            </li>

                        </ul>
                        <figcaption>
                            Comparison of desktop variant and tablet variant of the website. Note the repositioning of elements which emphasizes on key components which lend well to the browsing context.
                        </figcaption>
                    </figure>
                    <hr>
                    <p>
                        Once implementing the redesign for the main page and the story page, I showed them to Dawn, the proprietor of Cup of Joe. She was impressed! More importantly, I had good timing. This was due to the fact that her website was built upon a framework that was about to have its support revoked; if I recall correctly, it involved Microsoft's Silverlight. The host of her website did not have the time to redesign and re-implement the website using some other framework.
                    </p>
                    <p>
                        What's been shown thus far has been static in nature. There indeed was a non-static element in place, though. There was a music page where Dawn could post announcements of music events that would happen in her store. This had its own set of controls that she had access to. My initial intention of mobile redesign would balloon into including the development of a simple content management system where she could post information about events to her pages.
                    </p>
                    <p>
                        Implementation of the content management system would be through a PHP back-end interacting with a MySQL database. Here, user accounts could be created, events could be posted and edited, and a new set of control was provided as shop integration where Dawn could post products being sold via an online retail service. All this control was provided through a set of control pages that she could access using any browser. These control pages would leverage a simple bootstrap theme to allow mobile access for her and her employees; I was not shy to use the hamburger button in the context of using these control pages.
                    </p>
                    <hr>
                    <figure class='slide-deck'>
                        <ul>

                            <li class='slide'>
                                <figure>
                                    <img src='../../images/cup_control_01.png' />
                                    <figcaption>
                                        Slide 1/5: Selecting a menu item.
                                    </figcaption>
                                </figure>
                            </li>

                            <li class='slide'>
                                <figure>
                                    <img src='../../images/cup_control_02.png' />
                                    <figcaption>
                                        Slide 2/5: Filling out an event creation form.
                                    </figcaption>
                                </figure>
                            </li>

                            <li class='slide'>
                                <figure>
                                    <img src='../../images/cup_control_03.png' />
                                    <figcaption>
                                        Slide 3/5: Receiving feedback for event created. Selecting an event to edit.
                                    </figcaption>
                                </figure>
                            </li>

                            <li class='slide'>
                                <figure>
                                    <img src='../../images/cup_control_04.png' />
                                    <figcaption>
                                        Slide 4/5: Viewing event edit form; Selecting a new Date of event.
                                    </figcaption>
                                </figure>
                            </li>

                            <li class='slide'>
                                <figure>
                                    <img src='../../images/cup_control_05.png' />
                                    <figcaption>
                                        Slide 5/5: Receiving feedback for event edited.
                                    </figcaption>
                                </figure>
                            </li>

                        </ul>

                        <figcaption>
                            <ul>
                                <li>
                                    <a class='prev' onclick="plusSlides(-1)"> ❮ </a>
                                </li>
                                <li>
                                    Slides: Typical use-case of controls.
                                </li>

                                <li>
                                    <a class='next' onclick='plusSlides(1)'> ❯ </a>
                                </li>
                        </figcaption>
                    </figure>
                    <hr>
                    <p>
                        The public-facing pages of the Cup of Joe website were then templated using PHP and thus integrated access to the database to allow the display of events and shop links. The mobile redesign was made easier through the modularity provided through this template.
                    </p>
                    <p>
                        It's worth reflecting on the work done here. While looking through the archive of this website, I'm drawn to the difference between what was then called the music page and what is currently called the event page. This was a place where I decided to introduce new styling in an attempt to make the website more coherent in style. The new styling bore similarity to how the aside blurbs were displayed within the various pages, providing a more cohesive experience with respect to the aesthetic.
                    </p>
                    <hr>
                    <figure>

                        <figcaption>

                        </figcaption>
                    </figure>
                    <hr>
                    <p>
                        The result of my efforts can be viewed on Dawn's domain: <a href='https://www.cupofjoe-cedarfalls.com/'>www.cupofjoe-cedarfalls.com</a>. It seems that events are no longer being hosted at the location, thus the events page has been removed altogether. My personal domain is hosting a live demo of the website as well. It can be viewed <a href='demo/index.php'>here</a>. A demo control page can also be viewed <a href='demo.php'>here</a>.
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
            showSlides(slideIndex,true);

            function plusSlides(n){
                showSlides(slideIndex += n,false);
            }

            function currentSlide(n){
                showSlides(slideIndex = n,true);
            }

            function showSlides(n,init){
                let i;
                let slides = document.getElementsByClassName("slide");
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

            window.onresize = function(){
                currentSlide(slideIndex);
            }

        </script>
    </body>
</html>
