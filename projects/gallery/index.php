<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/gallery/';

$title = 'Alan McKay | Project | Balanced Image Gallery';

$meta['title'] = 'Alan McKay | Balanced Image Gallery';

$meta['description'] = 'Project description detailing facets of interest pertaining to building a responsive and balanced image gallery as an alternative to options given through social media.';

$meta['url'] = 'https://alanmckay.blog/projects/gallery/';

$relative_path = "../../";

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
                            The image gallery hosted within this website was self-made using pure Javascript. Prior to this implementation, the home page would send a visitor to my VSCO profile. There, they would be able to view every photo within my portfolio by navigating a gallery through the platform. This has recently changed, (noticed as-of February 2024), such that one needs to sign into the platform in order to navigate said gallery.
                        </p>
                        <p>
                            I'm not a fan of being put into a silo like this. Especially considering the fact I was paying an optional subscription to use the service. Life has been filled with negative circumstances of which I have spun into something more positive. This is such a circumstance; I've taken the opportunity to develop something that fits more closely to the aesthetic of my personal site whilst also functionally being more seamless.
                        </p>
                        <p>
                            This project page will discuss the differences between the behaviors of my gallery and the gallery hosted on VSCO. This will transition into discussion of implementation, followed by discussion of how to improve.
                        </p>
                        <p>
                            A working implementation can be viewed <a href='../../photography/index.php?intro'>here</a>.
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Javascript: Balanced Image Gallery</h1>
                    </header>
                    <div class='aside'>
                    <figure style='max-width:175px;'>
                        <img src='images/instagram.png'>
                        <figcaption> Instagram gallery view with square thumbnails.</figcaption>
                    </figure>
                    <p>
                        One thing that pushes VSCO above Instagram is its image gallery. As a web developer, it's not lost that the view of an image gallery within Instagram is fixed. That is, every image given in the view of a profile, (regardless of dimension), is fitted to a certain aspect ratio. It doesn't matter whether the uploaded image is a portrait or a landscape; when viewing the image in a profile's gallery, the image is fitted within a 1:1 frame.
                    </p>
                    <figure class='responsive_aside' style='max-width:200px;'>
                        <img src='images/instagram.png'>
                        <figcaption> Instagram gallery view with square thumbnails.</figcaption>
                    </figure>
                    <p>
                        VSCO differs by maintaining an image's aspect ratio within a profile's gallery view. This allows an extra visual dimension that can help one profile feel apart from another. In the past, I've seen profiles of creators who create a sense of coherency through a deliberate choice of color palette within their images. This is something witnessed within both platforms. VSCO goes beyond by inviting deliberate usage of shape.
                    </p>
                    </div>
                    <figure style='max-width:400px'>
                        <img src='images/vsco_grid_view.png'>
                        <figcaption> The VSCO image gallery does force image thumbnails to be square in shape.</figcaption>
                    </figure>
                    <p>
                        Another facet that used to set VSCO apart from Instagram was the fact a visitor need not sign in to view the entirety of a profile. Unfortunately, this is no longer the case. Thus the ultimate motive of creating my own.
                    </p>
                    <figure style='max-width:400px'>
                        <img src='images/vsco_sign-in.png'>
                        <figcaption> An attempt at scrolling through an image gallery within VSCO forces a user to sign in</figcaption>
                    </figure>
                    <p>
                        In creating an image gallery, maintaining the aspect ratio of an image within the gallery view is a primary goal. There exists built-in functionality for CSS to help accomplish this. Images can be scaled by their aspect ratio to fit within a container. Furthermore, modern browsers provide functionality for grid support such that each column of a grid has the same length regardless of the size of its individual items. This is accomplished by providing padding for items that exist in a given row that have a lesser height than the item with the maximum height.
                    </p>
                    <figure style='max-width:400px'>
                        <img src='images/static_gallery.png'>
                        <figcaption> An implementation of a grid-view image gallery. Note the inconsistent white-space margins surrounding each image.</figcaption>
                    </figure>
                    <p>
                        An observer of the VSCO gallery will notice the margins between images are fixed regardless of the aspect ratio of an image. Due to the temporal prioritization of displaying images within the gallery, this poses a potential problem: images can be uploaded in such a manner that the height of one column can completely overwhelm another. This creates situations within the platform where a given column is blank while another introduces more images. This can be apparent looking at the end of an image gallery for a profile which has inconsistent image sizes.
                    </p>
                    <figure style='max-width:400px'>
                        <img src='images/vsco_bottom.png'>
                        <figcaption> The bottom of an image gallery on VSCO. Notice the left column completely overwhelms the others. This column continues downward for a few more screens-worth of space.</figcaption>
                    </figure>
                    <p>
                        As indicated, this anomaly can occur whilst scrolling through the gallery. It seems this behavior is exacerbated by employing an algorithm which decides to load in new images based on having the bottom of the largest column reaching the bottom of the viewport. When this is triggered, a set amount of images is loaded for each column, which will lead to the gaps of the shorter columns being filled in. This creates situations where a user must scroll back up to view new images. Why the developers decided to use the column height of the largest column is beyond me. Ultimately this creates a subpar viewing experience within web browsers where more than two columns can exist.
                    </p>
                    <p>
                        The image gallery I've developed improves upon the VSCO gallery by using the shortest column as a trigger for loading in new images. It also diverges from the temporal priority; It is more loose in terms of chronological ordering than the algorithm used by VSCO. Here, the a set of images are grabbed in chronological order, but are then sorted by size. This occurs such that the shortest image in a batch is placed in the column with the largest height, and the tallest image in a batch is placed within the shortest column. This approach helps keep columns balanced in size.
                    </p>
                    <figure style='max-width:400px'>
                        <img src='images/bottom_of_gallery.png'>
                        <figcaption> An image gallery whose columns are balanced in size.</figcaption>
                    </figure>
                    <p>
                        Many organizations use lazy loading for image content. This tells the browser to only fetch a resource once it is brought into the viewport. In the realm of near-endless scrolling, it would be too much to ask a visitor to download all the resources required in preparation of viewing a page. Thus, an image resource locator that is placed inside an image tag is only acted upon once the bounding box of the image is near the bottom of the viewport.
                    </p>
                    <p>
                        It is not clear what is meant by "near the bottom" of a viewport. This value probably varies between web browsers and even a browsers' version. My experience using web services, (services which use lazy loading), has exposed what I like to call jagged loading artifacts for the individual elements involved. These artifacts are spurred by the fact it takes time to load a resource. There are two important facets of time here: the amount of time it takes to download the resource and the amount of time it takes the web browser to render the downloaded resource.
                    </p>
                    <p>
                        The amount of time it takes to download a resource is represented by the empty space that acts as a placeholder before anything is displayed. This space is very apparent on VSCO since their loading algorithm allocates the space required and fills it with a random color that fits their platform's color palette. To allocate this space and then fill it with a color is a trivial operation from a browser's perspective, thus it is a task that completes quickly and is given priority over any other step of loading/rendering an image. This was a deliberate design choice on the platform's part. To fill these placeholder spaces with an appealing color, (given the context of the platform), is a means to make the process appear more seamless*.
                    </p>
                    <p>
                        The amount of time it takes the web browser to render the downloaded resource is represented by the partial fill of the actual image. How this is reflected is dependent on the usage environment and image format. Within my web browser, swaths of the image are rendered from the bottom-up. Typically, the bottom half is rendered before the first half. This usually takes less than a second, but can be noticeable. The half-rendering is why the term "jagged rendering" is used in this context. From the perspective of a user, a small span of time occurs, the first half of an image pops into view, then the next half pops into view. After an image is loaded, repeat the process for the next image to be loaded. The mental imagery I conjure for this process is a timeline describing when a new chunk of visual information is loaded in - a timeline which has a jagged saw-tooth like appearance.
                    </p>
                    <figure>
                        <img id='gif-frame02' src='images/firstframe.png' style='display:none' toggle='true'>
                        <img id='gif02' src='images/02_resize.gif' toggle='true'>
                        <script>
                            document.getElementById('gif02').style['display'] = 'none';
                            document.getElementById('gif-frame02').style['display'] = 'inherit';
                            function play_gif(id){
                                let aniEle = document.getElementById('gif'+id);
                                let frameEle = document.getElementById('gif-frame'+id);
                                let toggle = aniEle.getAttribute('toggle');
                                console.log(toggle);
                                if(toggle == 'true'){
                                    aniEle.style['display'] = 'inherit';
                                    frameEle.style['display'] = 'none';
                                    toggle = false;
                                }else{
                                    aniEle.style['display'] = 'none';
                                    frameEle.style['display'] = 'inherit';
                                    toggle = true;
                                }
                                aniEle.setAttribute('toggle',toggle);
                                frameEle.setAttribute('toggle',toggle);
                            }
                        </script>
                        <figcaption>
                            Animated gif showing how images pop into view within VSCO. Note the attempt in obscuring this pop-in by placing a random background color from the site's color palette before an image load. Press <a onclick='play_gif("02");' style='text-decoration:underline'>here</a> to toggle playing the animated gif.
                        </figcaption>
                    </figure>
                    <p>
                        Obscuring the jaggedness of this loading procedure was another primary facet of this project; I wanted to substitute the partial on-screen loading behavior with a transition effect that is more smooth. Knowing this goal, a practitioner of CSS will take note of the term "transition". Such an intuition is accurate to what is happening.
                    </p>
                    <p>
                        The implementation of the image gallery has two primary routines. One loads a set of images into an off-screen buffer. The images that are loaded into this buffer are initially set with an opacity value of 0. The other routine enables transition styling for the set of images that have been loaded into said buffer. This is done by adding a new set of CSS styles to an image that is in the buffer-zone where opacity is changed to to 1, (in addition to setting other transition effects). A class to which the image belongs contains transition effects within an external style sheet, which are in place after the document load and thus are active once the routine calls for a figure to be displayed.
                    </p>
                    <figure>
                        <img id='gif-frame03' src='images/03_firstframe.png' style='display:none' toggle='true'>
                        <img id='gif03' src='images/03_resize.gif' toggle='true'>
                        <script>
                            document.getElementById('gif03').style['display'] = 'none';
                            document.getElementById('gif-frame03').style['display'] = 'inherit';
                        </script>
                        <figcaption>
                            Animated gif showing how images transition into view within this website's image gallery implementation. Press <a onclick='play_gif("03");' style='text-decoration:underline'>here</a> to toggle playing the animated gif.
                        </figcaption>
                    </figure>
                    <p>
                        When exactly does this transition occur? "Near the bottom" of the viewport is defined explicitly within this implementation. Consider the following function that returns true should a figure reach the threshold to trigger a transition:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:310px;overflow:auto' src='code/01.html'>
                    </iframe>
                    <p>
                        This is a simple function - The point of transition is noted as being a ratio of the window's inner height. When the top of a figure reaches this point, the transition is applied. The application of this transition occurs within the routine in which we've been discussing - <code>grid_display_agent</code>. It is here that <code>isFigureBottom</code> is applied. Before stepping into this function, it is important to understand a set of global variables. Consider the following declarations:
                        <ul>
                            <li>
                                <code>var max_column_size = 4; //some arbitrary value</code> - The image gallery consists of a set of <code>div</code>s representative of a view of a certain column count. Each of these <code>div</code>s contain a set of <code>div</code>s equal to the column count representative of the grid in question. Thus, there exists a <code>div</code> that contains one column (one <code>div</code>), another that contains two columns (two <code>div</code>s), and so on. The <code>max_column_size</code> global sets an upper limit to this. The advantage of having this set of structures is to save computing power when a screen resizes - necessitating the view of a grid with a certain amount of columns. Here, logic will simply hide the current set and show the other.
                                <ul>
                                    <li>
                                        The declaration region of this script includes logic which creates this nested <code>div</code> structure. It operates with respect to this global. To get a closer feel of this structure, one only need to consider the following block:
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <iframe frameborder="0" style='width:100%;height:600px;overflow:auto' src='code/02.html'>
                    </iframe>
                    <p>
                        <ul>
                            <li>
                                <code>var load_counts = [];</code> - Contains a <code>max_column_size</code> amount of integer values which indicate how many images have been <i>loaded</i> for a given column. This number is incremented every time an image gets placed into the buffer zone.
                            </li>
                            <li>
                                <code>var display_counts = [];</code> - Contains a <code>max_column_size</code> amount of integer values which indicate how many images have been <i>displayed</i> for a given column. This number is incremented every time it causes <code>isFigureBottom</code> to return a true.
                            </li>
                            <li>
                                <code>var col_maps = [];</code> - This is an array of arrays. An index into the outer array is indicative of a grid with the quantity of columns equal to the value of the index + 1. Contained in these sub-arrays is another set of associative arrays which indicate the column number with respect to the sub-index + 1. The values of the associative array are values which track the amount of figures loaded and the amount of figures displayed within that specific column.
                                <ul>
                                    <li>
                                        <code>col_maps[1][1]</code> points to information of the 2nd column within a gallery consisting of 2 columns. <code>col_maps[2][1]</code> points to information of the 2nd column within a gallery consisting of 3 columns. The logic which primes this structure is also based on <code>max_column_size</code>. The code which does this is as follows:
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <iframe frameborder="0" style='width:100%;height:300px;overflow:auto' src='code/03.html'>
                    </iframe>
                    <p>
                        <ul>
                            <li style='list-style-type:none'>
                                <ul>
                                    <li>
                                        The associative array contained in each column index has two keys: 'displayed' and 'loaded'. The values are simply the amount of images in a column that have been loaded and displayed. Indeed, the sum of the 'loaded' values within <code>col_maps[i]</code> will be equivalent to <code>load_counts[i]</code>. The same can be said for the sum of 'displayed' values within <code>col_maps[i]</code> being equivalent to <code>display_counts[i]</code>. A choice was made to keep track of the explicit counts within <code>load_counts</code> and <code>display_counts</code> instead. This acts as a means to minimize the amount of computation it would take to sum up the values from the inferred data structure.
                                    </li>
                                </ul>
                            </li>
                            <li>
                            <code>var grids = document.getElementsBy&shy;ClassName('image-gallery');</code> - an array of the html objects representative of a gallery of a certain column count. The value of this global variable is equivalent to <code>document.getElementsBy&shy;Id('galleries').children</code>.
                            </li>
                        </ul>
                    </p>
                    <p>
                        <code>grid_display_agent</code> can now be examined. It receives one argument which is indicative of the amount of columns for a view. The function uses this value to retrieve a gallery from the <code>grids</code> global. The function then iterates through each column contained in the grid taken from <code>grids</code> and looks at each image contained in the buffer zone. If an image is found to trigger a display transition, set a flag indicating that more images should be placed into the buffer zone. Once each column for the given grid selection is examined then, if the flag has been triggered, start loading images into the buffer zone by means of the routine that has yet to be discussed.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:865px;overflow:auto' src='code/04.html'>
                    </iframe>
                    <p>
                        Note the highlighted block above. This block-level declaration is essentially a lambda. Here, an attribute called 'loaded' is read on the figure. This attribute exists with the html element. Initially, it is set to false. The element also has a function bound to its onload event handler which will switch it to true - signifying that the entire image has been loaded within the web browser. Once this attribute is switched to true, the correct display properties are set such that it will transition into view. This ensures that no jagged loading occurs.
                    </p>
                    <p>
                        Below the highlighted block, near the end of the function, the <code>setTimeout</code> which triggers a call to the <code>grid_load_agent</code> acts as usage buffer to ensure the server isn't overwhelmed with resource requests. This scales with the size of the grid in question. It is within <code>grid_load_agent</code> that logic exists to start loading in the next batch of images into the buffer zone, which will then be primed in a manner that can be enacted upon by the <code>grid_display_agent</code>.
                    </p>
                    <p>
                        The g<code>rid_load_agent</code> is a bit more complicated than the display agent. This is where the placement of figures into columns exists. The logic is predicated on the fact that there exists another global data structure that acts as an image manifest. This <code>manifest</code> is a json structure which contains pruned data obtained from VSCO's CCPA-compliant information request. The data in the context of the gallery contains only information pertinent to an image. The schema is as follows:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:270px;overflow:auto' src='code/05.html'>
                    </iframe>
                    <p>
                        This data structure has a size; there is a quantity of images that need to be loaded in. Naturally, the logic of <code>grid_load_agent</code> begins by ensuring that a quantity of images that's beyond this maximum size isn't attempted to be retrieved. Whilst contemplating this and taking a look at the code itself, don't lose sight on the fact that the data structures at play operate on the fact that multiple column views exist different ranges of view-port sizes. A screen of a certain size may be concerned with a view consisting of two columns. Another screen of a different size may be concerned with a view consisting of 4 columns. This is handled through the access of these data structures, such as <code>load_counts</code>.
                    </p>
                    <p>
                        While that is in mind, note that the amount of images that may exist is a number that isn't easily divisible by a certain column count. Will all columns be filled with the same amount of images in a case where the column count is 4 and the total amount of images is some odd number? No. Thus, this base case needs to be considered before beginning the core logic of this subroutine.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:285px;overflow:auto' src='code/06.html'>
                    </iframe>
                    <p>
                        Before jumping into the core logic of <code>grid_load_agent</code>, the structure of the markup needs to be discussed. Inspection of the html that's in place before any javascript is executed will discover one html tag: <code>&lt;div id='galleries'&gt;&lt;/div&gt;</code>. When the html document is executed by the browser, a script tag will fill this tag based on the maximum amount of columns whomever is deploying the gallery wants in place. Ultimately, sub <code>div</code> containers will be placed into this tag which represents a grid of a certain column count. Contained within these sub-<code>div</code> tags are <code>div</code> tags that are representative of the individual columns. Contained within the columns are figure tags which also contain <code>img</code> tags. The figures are embedded in a clickable anchor tag. The logic for filling out the super-<code>div</code> tag was noted with the discussion of the <code>max_column_size</code> global.
                    </p>
                    <p>
                        What is missing from the code snippet related to filling "galleries" <code>div</code> is insight of what constitutes the <code>div</code> representative of a given column. This logic is contained within a helper function. This helper function receives information from the <code>manifest</code> in addition to a grouping of styles. The nesting occurs here and the figure object is returned. It should be noted that this is where the logic is placed to allow an img tag to know when it is fully loaded. This is highlighted below:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:705px;overflow:auto' src='code/07.html'>
                    </iframe>
                    <p>
                        Pivoting back to the core of the logic contained in <code>grid_load_agent</code>, it's important to remind ourselves that when <code>grid_load_agent</code> is called, it is supplied a single argument. That argument is <code>grid_selection</code> which is a mechanism to select a specific grid view of a certain column length - the length determined by the argument given for the parameter. Much of the machination in place selects the grid of the supplied column count, then iterates through these columns. The variable labeled <code>boundary</code> indicates the amount of images to be pulled in through the current call. It is bounded by the column size of the <code>grid_selection</code>. It can be lower than this by reasons previously discussed and shown by the set of conditions to get into the core set of logic.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:1050px;overflow:auto' src='code/08.html'>
                    </iframe>
                    <p>
                        Recall the general logic of placing figures into columns. The image of lesser height needs to be paired with the column with the largest height. The image of greater height needs to be paired with the column of the smallest height. Image heights need to be known and considered in a certain order. Column heights need to be known and considered in a certain order. Let's start with the images.
                    </p>
                    <p>
                        The image information is first retrieved from the manifest and then used to create a new figure.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:365px;overflow:auto' src='code/09.html'>
                    </iframe>
                    <p>
                        Recall that images can be placed within the markup environment and the browser will take liberty to adjust the size of the object. In this case, we are using display properties that force the maximum size of an image to conform to the size of a given column. Within the <code>manifest</code>, height and width values of the originating image are stored. These can be used to calculate the proportion. It is not enough to strictly use the height value. Two images may share the same height value, but one may be significantly wider than the other, forcing a resize within the context of an html column. This resizing will in turn change its rendered height value. Thus, the image needs to have some ratio be calculated:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:310px;overflow:auto' src='code/10.html'>
                    </iframe>
                    <p>
                        We now have an object representative of an image and a ratio representative of the amount of space it takes up within a column. These need to be placed somewhere on account of the fact this process is within an iterative structure.
                    </p>
                    <p>
                        Above this iterative structure exists a set of declarations. Relevant to the problem at hand is the following:
                        <ul>
                            <li>
                                <code>var figure_height_list = [];</code> - A list of heights which are a calculated ratio which represent the amount of space a figure takes up within a column. There may be repeat values within this list. This object will be sorted by magnitude and in turn will act as a stack whose values may be popped when filling a column. These values are also representative of keys to the following data structure.
                            </li>
                            <li>
                            <code>var figure_height_map = {};</code> - An associative array of figure objects. These objects are a result of a call to create_new_figure. A key of figure_height_map is a height provided by the previously discussed data structure. Each key points to a list of objects. The total amount of keys for this associative array is in the range of [1,amount of columns]. In the case of one entry, this means that each image has the same height. In the case of an amount of entries equal to the amount of columns in the selected grid, this means that each figure has a separate height.
                            </li>
                        </ul>
                    </p>
                    <iframe frameborder="0" style='width:100%;height:470px;overflow:auto' src='code/11.html'>
                    </iframe>
                    <p>
                        All that's left is to account for global info and to sort the list of keys, highlighted below.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:600px;overflow:auto' src='code/12.html'>
                    </iframe>
                    <p>
                        The same logic needs to applied to the grouping of columns being considered. The current height of the columns in place need to be considered and placed into a list. This list should be sorted in the opposite order of the <code>figure_height_list</code> so that its values may be popped in tandem with the height list of the figures for correct pairing. These data structures reflect the data structures with the figure prefix, and exist within the same scope and proximity. Noting these declarations, the familiar logic is as follows:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:495px;overflow:auto' src='code/13.html'>
                    </iframe>
                    <p>
                        With the maps in place, all that needs to be done is to iterate an amount of times equal to the amount of images being placed. For each iteration, pop a height key from both height lists. Use these keys to access their respective associative arrays and get the the relevant objects to make a figure-column pairing.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:550px;overflow:auto' src='code/14.html'>
                    </iframe>
                    <p>
                        Note that the value for <code>iteration_index</code> allows for a case where subsequent images can be placed into the same column. This occurs when a group of images whose combined height isn't great enough to cause a column's height to overwhelm the others.
                    </p>
                    <p>
                        All these pieces are brought together to make the whole of the subroutine:
                    </p>
                    <iframe frameborder="0" style='width:100%;height:2630px;overflow:auto' src='code/15.html'>
                    </iframe>
                    <p>
                        Taking a step back, a higher look will expose a key relationship. This relationship is based on the existence of two separate abstractions which recursively interact with each other. One piece is the buffer zone in which new images are placed but hidden. The other piece is the complement where the images have been revealed. The transition from one abstraction to the other is whether or not one of their components (an image-figure) has reached the threshold described by <code>isFigureBottom</code>. This transition ceases once all available images have been placed from the buffer zone into its complement.
                    </p>
                    <p>
                        Taking a higher look on top of these relationships, one can make the claim there exists a third abstraction - images which have not been placed in the buffer zone or its complement. A transition occurs from here into the buffer zone. The transitions cease here once there are no more images to be placed. The mutual recursion between <code>grid_load_agent</code> and <code>grid_display_agent</code> allows for continual placement of images into these abstract spaces. It is through this discussion that the base cases are also highlighted. Recursion stops when <code>isFigureBottom</code> produces a set of false values and when there are no more images to be placed into the buffer zone.
                    </p>
                    <p>
                        The recursion involved needs to be initiated by something, though. What this is is fairly obvious - when the page finishes loading, kick off the process. The first thing this process needs to ask itself is, "how many columns should initially be displayed?" This question is answered through a subroutine called <code>readjust_caller</code> which sets a global variable called <code>active_grid</code>. This variable indicates how many columns should exist dependent on the width of the screen. This subroutine is also called within a simple event handler for the window on resize.
                    </p>
                    <iframe frameborder="0" style='width:100%;height:785px;overflow:auto' src='code/16.html'>
                    </iframe>
                    <p>
                        It is within the call stack of <code>readjust_caller</code> that a the display properties of <code>document.getElement&shy;ById('galleries')</code>'s children is handled; the children which represent a grid view of a certain column quantity. For example, should <code>readjust_caller</code> determine the width of the device's screen necessitate 3 columns, it hides the grids of column sizes 1, 2, and 4, and enables the display of the grid of column size 3.
                    </p>
                    <p>
                        The result of the window's load event handler, shown above, will allow the image grid to display a set amount of images based on the height of the window. It will also place the images into each buffer zone. If one were to scroll, no more action would occur; <code>isFigureBottom</code> would not be called upon again. To address this, another event needs to be considered: when the screen scrolls!
                    </p>
                    <iframe frameborder="0" style='width:100%;height:550px;overflow:auto' src='code/17.html'>
                    </iframe>
                    <p>
                        The set of booleans that scaffold the conditional within this subroutine's loop really emphasizes on a common pattern that has not been explicitly discussed thus far. Recall that both <code>grid_load_agent</code> and <code>grid_display_agent</code> have a single parameter which represents a certain grid view. A single call will determine the transitional state for a grid of the size given as an argument and decide whether an image should move from one state of display to another. As a user scrolls through the gallery, it's obvious what is occurring for the current grid view. It is not obvious that the same decisions are being made for the grids which are out of view.
                    </p>
                    </p>
                        Thus, when a user scrolls while the <code>active_grid</code> is 3, (for example), checks need to be in place to determine whether or not images should be placed into the buffer zone for the other grids.
                    <p>
                    <p>
                        The mutually recursive structure in place will also determine whether these hidden grid views move a given figure from this zone as well. This is done by some css trickery. Instead of setting the display property of these grids to <code>none</code>, the height is instead set to zero and an overflow property is set to obscure a scroll-bar that may be displayed as a result. This allows the calculation of the height values of the columns within this hidden state - the calculations that occur within <code>grid_load_agent</code>. It also allows <code>isFigureBottom</code> to work in this context as well.
                    </p>
                    <p>
                        Ultimately, this is a code smell. This code smell has the consequence of being affected by the whims of web browser should it decide to change rendering behavior. Future work on this script will remove the reliance of the calculation of a columns height via <code>getBoundingClientRect()</code> and instead populate a data structure with the height information calculated by the the <code>new_figure_ratio</code> within <code>grid_load_agent</code>.
                    </p>
                    <p>
                        A closer look at this code smell reveals the unintended behavior of the fact that grids of differing column lengths reveal images at differing rates. This is because <code>isFigureBottom</code> may flag true for images that are scaled differently on account of the amount of space afforded by a column. The consequence of this is when a user resizes the window, (and the resize presents a different grid-view), they may have to witness the transition effect of an image being brought into view again. This may give the false impression that the image has been reloaded into the browser and/or that may gaslight a user into thinking they have not viewed that image yet.
                    </p>
                    <p>
                        Taking a look at the deployment of the image gallery, (as of date in which this writing is published - April 2024), will show that this is not an issue. Some patches have been made to the code which can be viewed via this site's github repository.
                    </p>
                    <p>
                        A closer look at the repository will also reveal additional code in place. What's not been discussed here is how to differentiate transition effects for images that are a part of the initial batch of images loaded in upon page view and the subsequent images that are loaded upon scroll. Ultimately this is a trivial adaptation, so it's encouraged the reader of this article investigate the repository's code or think of their own solution on the matter.
                    </p>
                    <p>
                        Another side effect related to the flaws discussed so far is that a user with a slower internet speed will be required to commit to a larger amount of files upon the initial load. The reason of this is because it takes more time for the rendering environment to allocate space within each individual column. This allows for a greater amount of calls to <code>isFigureBottom</code> to pass, which in turn will prompt the script to load in more assets. This primarily becomes an issue when the time it takes to get a response to the server is measured around 1 second (1000ms) or higher.
                    </p>
                    <p>
                        This implementation works for my use-case. To fix these issues will require some code refactoring. Anyone who has been able to keep up to speed with the architecture and code discussed thus far will likely have seen places in which a good refactor can be helpful. These refactors, and any subsequent cleaning up of logical errors, will be the next step in terms of this project. The goal is to eventually have a package that can be used as a web component elsewhere. Any progress made on this front will be cataloged within the concluding notes section of this writing. Eventually a repository dedicated to this component will be produced along with documentation in terms of how to deploy it.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>
                            Check back later for updates. - Alan
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
</html>
