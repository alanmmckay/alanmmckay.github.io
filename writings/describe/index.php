<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/writings/describe/';

$title = 'Alan McKay | Writing | Describing Elsewhere';

$meta['title'] = 'Alan McKay | Describing Elsewhere';

$meta['description'] = 'A conversation once had a friend observing that too many people are reliant on showing the detail of a story being told. That is, instead of...';

$meta['url'] = 'http://alanmckay.blog/writings/describe/';

include('../../header.php');

?>

        <section id='writingsWrapper'>
            <section>
                <article>
                    <header>
                    <h1>
                        Describing Elsewhere
                    </h1>
                    </header>
                   <p>
                        A conversation once had a friend observing that too many people are reliant on showing the detail of a story being told. That is, instead of taking the time to describe some pertinent visual information, a typical person seems to be more apt to draw upon their smartphone and simply show the scene as they captured it in the moment.
                    </p>
                    <p>
                        I've previously <a href='../flow/' target='_blank' rel='noopener noreferrer'>touched upon my thoughts</a> of observing the moment while not getting lost in the act of taking a photo. Almost in contradiction, <a href='../social/' target='_blank' rel='noopener noreferrer'>I've also discussed</a> how I enjoy capturing these things through photography. My friend's observation certainly has been effective regardless of this contradiction. It has made me especially cognizant of how I frame any subject that I may be discussing.
                    </p>
                    <p>
                        Previous writing on this website is of <a href='../elsewhere/' target='_blank' rel='noopener noreferrer'>experiencing elsewhere</a>. The initial goal was to textually describe a beautiful scene that two friends and I found ourselves as we were hiking in the Black Hills. This goal diverged as it was decided to use photography to augment the text.
                    </p>
                    <p>
                        The term augment is used strictly here. Effort was taken to ensure any photography followed the text that abstractly describes the photograph's contents. Note that not a lot of detail was put into any textual description. Only the various elements of the photograph that were important were elaborated upon. Elements such as the juxtaposition describing the scale of a person and the scale of the environment or elements such as the ice forming on the pine needle. Each facet was described in a nebulous manner such that the intention was to allow the reader to paint the scene in their mind; allowing the reader to imagine the scene at their own discretion while calling upon what they may think beauty in this context is. Hopefully by doing this the eventual reveal of the photographs augmented this notion of beauty.
                    </p>
                    <p>
                        I don't think the page can be successful in trying to convey the effect of the story without the associated imagery. Especially since effort was put into how the images themselves were presented.
                    </p>
                    <br>
                    <hr>
                    <a href='../../images/mike-black-elk.jpg' target="_blank" rel="noopener noreferrer">
                        <figure>
                            <img src='../../images/mike-black-elk.jpg' id='mike-black-elk' class='animate' alt="" style='transition:object-position 4s;object-position:0 45%;' />
                            <figcaption>
                                Michael reaching the summit of Black Elk Peak.
                            </figcaption>
                        </figure>
                    </a>
                    <hr>
                    <br>
                    <p>
                        Most of the images on the page were taken with an aspect ratio where the height overwhelms the width. The containers of these images are set with an aspect ratio that is wider than not. This decision was because the wide aspect ratio ensures the imagery does not dominate the text.
                    </p>
                    <p>
                        Unfortunately, the conversion from one aspect ratio to the other entails cropping some of the affected image. I found the amount of cropping to be a bit too much. Thus, the idea for a gradual scan of the image within its container.
                    </p>
                    <br>
                    <hr>
                    <a href='../../images/connor-grimes.jpg' target="_blank" rel="noopener noreferrer">
                        <figure>
                            <img src='../../images/connor-grimes.jpg' id='connor-grimes' class='animate' alt="" style='transition:object-position 4s;object-position:0 70%;' />
                            <figcaption>
                                Connor working on a project at Climb Iowa.
                            </figcaption>
                        </figure>
                    </a>
                    <hr>
                    <br>
                    <p>
                        Not only does this solve the issue of cropping out too much detail, but also allows seamless piecemeal viewing. The rate at which the varity of an image is revealed is set programmatically. This forces a patient viewer to take more time to observe the image and its details. This hopefully helps bring the imagery meaningfully closer to the text in terms of rate of consumption.
                    </p>
                    <br>
                    <hr>
                    <a href='../../images/anon-sidecar.jpg' target="_blank" rel="noopener noreferrer">
                        <figure>
                            <img src='../../images/anon-sidecar.jpg' id='anon-sidecar' class='animate' alt="" style='transition:object-position 4s;object-position:0 20%;' />
                            <figcaption>
                                A stranger doing some work at Sidecar Coffee.
                            </figcaption>
                        </figure>
                    </a>
                    <hr>
                    <br>
                    <p>
                        In terms of technical detail, a CSS class was set for all the affected elements. Here, the width is set to 100%, the height to some fixed pixel value, and the object-fit attribute set to cover. Inline styling is then applied to each of these image tags where the object-position attribute is set to define the position in which an image will be centered with respect to the cropped container. Then, also within the inline styling, the transition property of the object-position attribute is set to define how long it will take for an image to scan to a position.
                    </p>
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
img.animate{
    width:100%;
    height:300px;
    object-fit:cover;
}
</pre>
                    </code>
                    <p>
                        When and where the image scans is determined by JavaScript. A function was made to detect how far along an element has scrolled into the viewport. Should this threshold be met, the object-position CSS property changes; a new position is centered with respect to the cropped container and the previously set transition attribute enacts which causes the smooth scrolling effect.
                    </p>
                    <!--- JAVASCRIPT EXAMPLE! --->
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
function inViewRange(elementID,inPosition,outPosition){
    element = document.getElementById(elementID);
    bounding = element.getBoundingClientRect();
    if ( ((window.innerHeight/2) - bounding.top > 0) && (bounding.top > 0) )
    {
        element.style['object-position'] = inPosition;
    } else{
        element.style['object-position'] = outPosition;
    }
}
</pre>

                    </code>
                    <p>
                        The logic described above is called upon by some event handler that detects when the window is scrolled.
                    </p>
                    <!--- JAVASCRIPT EXAMPLE! --->
                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2'>
window.onscroll = function(){
    inViewRange('image-tag-ID', '0 20%', '0 45%');
}
</pre>
                    </code>
                    <p>
                        The images can still be viewed in their entirety by clicking or tapping their containers. This is done by wrapping the figure tag up on an anchor tag which directs to the associated image.
                    </p>
                    <!--- HTML EXAMPLE! --->
                    <br>
                    <hr>
                    <a href='../../images/clayton-bear-butte.jpg' target="_blank" rel="noopener noreferrer">
                        <figure>
                            <img src='../../images/clayton-bear-butte.jpg' id='clayton-bear-butte' class='animate' alt="" style='transition:object-position 8s;object-position:0 0%;' />
                            <figcaption>
                                Clayton hiking up Bear Butte.
                            </figcaption>
                        </figure>
                    </a>
                    <hr>
                    <br>
                    <p>
                        It was mentioned that the writing which motivated this development likely cannot be successful in trying to convey the effect of the story without the associated imagery (and how it is presented). It feels necessary to point out the fact that the imagery is also incapable of doing this on its own. It only appeals to the visual sensory. It does not tap into the perception of those who were involved in the moment. These perceptions are fully formed through the synthesis of all the senses. This is encapsulated by the conclusion of the writing which emphasized the sounds of the hockey players, which was contrasted to a static image at the bottom of the page.
                    </p>
                    <section class='info'>
                        <hr>
                        <h2>Concluding notes</h2>
                        <p>
                            The divergence from the initial goal of describing elsewhere while only using text does not detract. Perhaps there is a lack of writing skill that keeps me from this goal, but I would argue my ability to effectively communicate has augmented this level of skill. The form of communication in this case is by leveraging photography and the code used to present the photography.
                        </p>
                        <hr>
                    </section>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
    <script>
        //Abstract this function to include range parameters
        function inViewRange(elementID,inPosition,outPosition){
            element = document.getElementById(elementID);
            bounding = element.getBoundingClientRect();
            if ( ((window.innerHeight/2) - bounding.top > 0) && (bounding.top > 0) )
            {
                element.style['object-position'] = inPosition;
            } else{
                element.style['object-position'] = outPosition;
            }
        }

        function setCodeContainerSize(){
            elements = document.getElementsByClassName('code');
            for(i=0;i<elements.length;i++){
                element = elements[i];
                width = window.outerWidth;
                if (width > 800){
                    width = 800;
                }
                element.style.width = width*.90 + "px";
            }
        }

        window.onresize = function(){
            setCodeContainerSize();
        }
        console.log('yes');
        window.onscroll = function(){
            inViewRange('mike-black-elk', '0 20%', '0 45%');
            inViewRange('connor-grimes', '0 20%', '0 70%');
            inViewRange('anon-sidecar', '0 60%', '0 20%');
            inViewRange('clayton-bear-butte', '0 80%', '0 0%');
        }

        inViewRange('mike-black-elk', '0 20%', '0 45%');
        inViewRange('connor-grimes', '0 20%', '0 70%');
        inViewRange('anon-sidecar', '0 60%', '0 20%');
        inViewRange('clayton-bear-butte', '0 80%', '0 0%');
        setCodeContainerSize();
    </script>
</html>
