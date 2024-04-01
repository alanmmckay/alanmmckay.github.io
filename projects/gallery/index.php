<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/gallery/';

$title = 'Alan McKay | Project | Balanced Image Gallery';

$meta['title'] = 'Alan McKay | Balanced Image Gallery';

$meta['description'] = '';

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
                    <hr>
                    </section>
                    <header>
                        <h1>Javascript: Image Gallery</h1>
                    </header>
                    <div class='aside'>
                    <figure style='max-width:175px;'>
                        <img src='images/instagram_blurred.png'>
                        <figcaption> Take note of the shape of the thumbnails.</figcaption>
                    </figure>
                    <p>
                        One thing that pushes VSCO above Instagram is its image gallery. As a web developer, it's not lost that the view of an image gallery within Instagram is fixed. That is, every image given in the view of a profile, (regardless of dimension), is fitted to a certain aspect ratio. It doesn't matter whether the uploaded image is a portrait or a landscape; when viewing the image in a profile's gallery, the image is fitted within a 1:1 frame.
                    </p>
                    <figure class='responsive_aside' style='max-width:140px;'>
                        <img src='images/instagram_blurred.png'>
                        <figcaption> Take note of the shape of the thumbnails.</figcaption>
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
                        The image gallery I've developed improves upon the VSCO gallery by using the shortest column as a trigger for loading in new images. It also diverges from the temporal priority; It is more loose in terms of chronological ordering than the algorithm used by VSCO. Here, the a set of images are grabbed in chronological order, but are then sorted by size. This occurs such that the shortest image in a batch is placed in the column with the largest height, and the tallest image in a batch is placed within the shortest column. This approach helps keep columns balanced.
                    </p>
                    <figure style='max-width:400px'>
                        <img src='images/bottom_of_gallery.png'>
                        <figcaption> An image gallery whose columns are balanced.</figcaption>
                    </figure>
                    <p>
                        Many organizations use lazy loading for image content. What this does is tell the browser to only fetch a resource once it is brought into the viewport. In the realm of near-endless scrolling, it would be too much to ask a visitor to download all the resources required in preparation of viewing a page. Thus, an image locator that is placed inside an image tag is only acted upon once the bounding box of the image is near the bottom of the viewport.
                    </p>
                    <p>
                        It is not clear what is meant by "near the bottom" of a viewport. This value probably varies between web browsers and even a browsers' version. My experience using web services, (services which use lazy loading), has exposed what I like to call jagged loading artifacts for the individual elements involved. These artifacts are spurred by the fact it takes time to load a resource. There are two important facets of time here: the amount of time it takes to download the resource and the amount of time it takes the web browser to render the downloaded resource.
                    </p>
                    <p>
                        The amount of time it takes to download a resource is represented by the empty space that acts as a place holder before anything is displayed. This space is very apparent on VSCO since their loading algorithm allocates the space required and fills it with a random color that fits their platform's color pallet. To allocate this space and then fill it with a color is a trivial operation from a browser's perspective, thus it is a task that completes quickly and is given priority over any other step of loading/rendering an image. This was a deliberate design choice on the platform's part. To fill these placeholder spaces with an appealing color, given the context of the platform, is a means to make the process appear more seamless*.
                    </p>
                    <p>
                        The amount of time it takes the web browser to render the downloaded resource is represented by the partial fill of the actual image. How this is reflected is dependent on the usage environment and image format. Within my web browser, swaths of the image are rendered from the bottom-up. Typically, the bottom half is rendered before the first half. This usually takes less than a second, but can be noticeable. The half-rendering is why the term "jagged rendering" is used in this context. From the perspective of a user, a small span of time occurs, the first half of an image pops into view, then the next half pops into view. After an image is loaded, repeat the process for the next image to be loaded. The mental imagery I conjure for this process is a timeline describing when a new chunk of visual information is loaded in - a timeline which has a jagged saw-tooth like appearance.
                    </p>
                    <figure>
                        <img id='gif-frame' src='images/firstframe.png' style='display:none'>
                        <img id='gif' src='images/02_resize.gif'>
                        <script>
                            toggle = true;
                            document.getElementById('gif').style['display'] = 'none';
                            document.getElementById('gif-frame').style['display'] = 'inherit';
                            function play_gif(){
                                if(toggle){
                                    document.getElementById('gif').style['display'] = 'inherit';
                                    document.getElementById('gif-frame').style['display'] = 'none';
                                }else{
                                    document.getElementById('gif').style['display'] = 'none';
                                    document.getElementById('gif-frame').style['display'] = 'inherit';
                                }
                                toggle = !toggle;
                            }
                        </script>
                        <figcaption>
                            Animated gif showing how images pop into view within VSCO. Note the attempt in obscuring this pop-in by placing a random background color from the site's color palette before an image load. Press <a onclick='play_gif();' style='text-decoration:underline'>here</a> to toggle playing the animated gif.
                        </figcaption>
                    </figure>
                    <p>
                        Obscuring the jaggedness of this loading procedure was another primary facet of this project; I wanted to substitute the partial on-screen loading behavior with a transition effect that is more smooth. Knowing this goal, a practitioner of CSS will take note of the term "transition". Such an intuition is accurate to what is happening.
                    </p>
                    <p>
                        The implementation of the image gallery has two primary routines. One loads a set of images into an off-screen buffer. The images that are loaded into this buffer are initially set with an opacity value of 0. The other routine enables transition styling for the set of images that have been loaded into said buffer. This is done by adding a new set of CSS styles to an image that is in the buffer-zone where opacity is changed to to 1, (in addition to setting other transition effects). A class to which the image belongs contains transition effects within an external style sheet, which are in place after the document load and thus are active once the routine calls for a figure to be displayed.
                    </p>
                    <figure>

                    </figure>
                    <p>
                        When exactly does this transition occur? "Near the bottom" of the viewport is defined explicitly within this implementation. Consider the following function that returns true should a figure reach the threshold to trigger a transition:
                    </p>
                    <code>
<pre class='code info-code' >
function isFigureBottom(fig_object){
    var fig_height = fig_object.getBoundingClientRect().height;
    var fig_top = fig_object.getBoundingClientRect().top;
    if((window.innerHeight * .95)-fig_top &gt; 0){
        return true;
    }else{
        return false;
    }
}
</pre>
                    </code>
                    <p>
                        This is a simple function - The point of transition is noted as being a ratio of the window's inner height. When the top of a figure reaches this point, the transition is applied. The application of this transition occurs within the routine in which we've been discussing - grid_display_agent. It is here that is_figure_bottom is applied. Before stepping into this function, it is important to understand a set of global variables. Consider the following declarations:
                        <ul>
                            <li>
                                var max_column_size = 4; //some arbitrary value - The image gallery consists of a set of divs representative of a view of a certain column count. Each of these divs contain a set of divs equal to the column count representative of the grid in question. Thus, there exists a div that contains one column (one div), another that contains two columns (two divs), and so on. The max_column_size sets an upper limit to this. The advantage of having this set of structures is to save computing power when a screen resizes necessitating the view of a grid with a certain amount of columns. Here, logic will simply hide the current set and show the other.
                                <ul>
                                    <li>
                                        The declaration region of this script includes logic which creates this nested div structure. It operates with respect to this global. To get a closer feel of this structure, one only need to consider the following block:
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <code>
<pre class='code info-code' >
grids_html = document.getElementById('galleries');
for(let i=0;i&lt;max_column_size;i++){
    const grid = document.createElement('div');
    grid.setAttribute('class','image-gallery');
    // TODO: Create a css class for the folowing properties:
    grid.style['display'] = 'grid';
    grid.style['grid-template-columns'] = 'repeat('+(i+1)+', minmax(0px,1fr))';
    grid.style['align-items'] = 'start';
    grid.style['height'] = '0px';
    grid.style['overflow'] = 'scroll';
    for(let j=0;j&lt;=i;j++){
        const column = document.createElement('div');
        column.setAttribute('class','image-col');
        column.style['display'] = 'grid';
        column.style['grid-template-columns'] = 'minmax(0px,1fr)';
        grid.appendChild(column);
    }
    grids_html.appendChild(grid);
}
delete grids_html;
</pre>
                    </code>
                    <p>
                        <ul>
                            <li>
                                var load_counts = []; - Contains a max_column_size amount of integer values which indicate how many images have been *loaded* for a given column. This number is incremented every time an image gets placed into the buffer zone.
                            </li>
                            <li>
                                var display_counts = []; - Contains a max_column_size amount of integer values which indicate how many images have been *displayed* for a given column. This number is incremented every time it causes is_figure_bottom to return a true.
                            </li>
                            <li>
                                var col_maps = []; - This is an array of arrays. An index into the outer array is indicative of a grid with the quantity of columns equal to the value of the index + 1. Contained in these sub-arrays is another set of associative arrays which indicate the column number with respect to the sub-index + 1. The values of the associative array are values which track the amount of figures loaded and the amount of figures displayed within that specific column.
                                <ul>
                                    <li>
                                        col_maps[1][1] points to information of the 2nd column within a gallery consisting of 2 columns. col_maps[2][1] points to information of the 2nd column within a gallery consisting of 3 columns. The logic which primes this structure is also based on max_column_size. The code which does this is as follows:
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <code>
<pre class='code info-code' >
for(let i=0;i&lt;max_column_size;i++){
    col_map = [];
    for(let j=0;j&lt;(i+1);j++){
        col_map[j] = [];
        col_map[j]['loaded'] = 0;
        col_map[j]['displayed'] = 0;
    }
    col_maps.push(col_map);
}
</pre>
                    </code>
                    <p>
                        <ul>
                            <li style='list-style-type:none'>
                                <ul>
                                    <li>
                                        The associative array contained in each column index has two keys: 'displayed' and 'loaded'. The values are simply the amount of images in a column that have been loaded and displayed. Indeed, the sum of the 'loaded' values within col_maps[i] will be equivalent to load_counts[i]. The same can be said for the sum of 'displayed' values within col_maps[i] being equivalent to display_counts[i]. A choice was made to keep track of the explicit counts within load_counts and display_counts instead. This acts as a means to minimize the amount of computation it would take to sum up the values from the inferred data structure.
                                    </li>
                                </ul>
                            </li>
                            <li>
                                var grids = document.getElementsByClassName('image-gallery'); - an array of the html objects representative of a gallery of a certain column count.
                            </li>
                        </ul>
                    </p>
                    <p>
                        <code>grid_display_agent</code> can now be examined. It receives one argument which is indicative of the amount of columns for a view. The function uses this value to retrieve a gallery from the grids global. The function then iterates through each column contained in the grid taken from grids and looks at each image contained in the buffer zone. If an image is found to trigger a display transition, set a flag indicating that more images should be placed into the buffer zone. Once each column for the given grid selection is examined, if the flag has been triggered, start loading images into the buffer zone by means of the routine that has yet to be discussed.
                    </p>
                    <code>
<pre class='code info-code' >
async function grid_display_agent(grid_selection){
    var load_flag = false;
    for(let i=0;i&lt;grid_selection;i++){
        let col = grids[grid_selection-1].children[i];
        let figures = col.getElementsByTagName('figure');

        for(let j=col_maps[grid_selection-1][i]['displayed'];j&lt;figures.length;j++){
            let figure = figures[j];
            if(isFigureBottom(figure)){
                let figureDisplayLambda = function(){
                    if(figure.getAttribute('loaded') == 'true'){
                        figure.style['opacity'] = 1;
                        figure.style['border-top'] = 'solid white 5px';
                    }else{
                        setTimeout(figureDisplayLambda,400);
                    }
                }
                figureDisplayLambda();
                load_flag = true;
                col_maps[grid_selection-1][i]['displayed'] += 1;
                display_counts[grid_selection-1] += 1;
            }else{
                load_flag = load_flag || false;
            }
        }
    }
    if(load_flag === true){
        setTimeout(function(){grid_load_agent(grid_selection)},(grid_selection * 100));
    }
}
</pre>
                    </code>
                    <p>
                        Note the highlighted block above. This block-level declaration is essentially a lambda. Here, an attribute called 'loaded' is read on the figure. This attribute exists on the html element. Initially, it is set to false. The element also has a function bound to its onload event handler which will switch it to true - signifying that the entire image has been loaded within the web browser. Once this attribute is switched to true, the correct display properties are set such that it will transition into view.
                    </p>
                    <p>
                        Below the highlighted block, near the end of the function, the setTimeout which triggers a call to the grid_load_agent acts as usage buffer to ensure the server isn't overwhelmed with resource requests. This scales with the size of the grid in question. It is within grid_load_agent that logic exists to start loading in the next batch of images into the buffer zone, which will then be primed in a manner that can be enacted upon by the grid_display_agent.
                    </p>
                    <p>
                        The grid_load_agent is a bit more complicated than the display agent. This is where the placement logic of figures into columns exists. The logic is predicated on the fact that there exists another global data structure that acts as an image manifest. This manifest is a json structure which contains pruned data obtained from VSCO's CCPA-compliant information request. The data in the context of the gallery contains only information pertinent to an image. The schema is as follows:
                    </p>
                    <code>
<pre class='code info-code' >
&lt;images&gt; ::= &lt;image_id&gt; &lt;images&gt; | ∅
&lt;image_id&gt; ::= {
    "upload_date": &lt;integer&gt;,
    "height": &lt;integer&gt;,
    "width": &lt;integer&gt;,
    "file_name": &lt;string&gt;,
    "share_link": &lt;string&gt;,
}
</pre>
                    </code>
                    <p>
                        This data structure has a size; there is a quantity of images that need to be loaded in. Naturally, the logic of grid_load_agent begins by ensuring that a quantity of images that's beyond this maximum size isn't attempted to be retrieved. Whilst contemplating this and taking a look at the code itself, don't lose sight on the fact that the data structures at play operate on the fact that multiple column views exist for a given view-port. A screen of a certain size may be concerned with a view consisting of two columns. Another screen of a different size may be concerned with a view consisting of 4 columns. This is handled by the access of these data structures, such as load_counts.
                    </p>
                    <p>
                        While that is in mind, note that the amount of images that may exist is a number that isn't easily divisible by a certain column count. Will all columns be filled with the same amount of images in a case where the column count is 4 and the total amount of images is some odd number? No. Thus, this base case needs to be considered before beginning the core logic of this subroutine.
                    </p>
                    <code>
<pre class='code info-code' >
var load_count = load_counts[grid_selection-1];

//Check whether we've run out of images to load:
if(load_count &lt; manifest_size){
    .
    .
    .
}
</pre>
                    </code>
                    <p>
                        Before jumping into the core logic of grid_load_agent, the structure of the markup needs to be discussed. Inspection of the html that's in place before any javascript is executed will discover one html tag: [simple code of div]. When the html document is executed by the browser, a script tag will fill this tag based on the maximum amount of columns whomever is deploying the gallery wants in place. Ultimately, sub div containers will be placed into this tag which represents a grid of a certain column count. Contained within these sub-div tags are div tags that are representative of the individual columns. Contained within the columns are figure tags which also contain img tags. The figures are embedded in a clickable anchor tag. The logic for filling out the super-div tag was noted with the discussion of the max_column_size global.
                    </p>
                    <p>
                        What is missing from the code snippet related to filling "galleries" div is insight of what constitutes the div representative of a given column. This logic is contained within a helper function. This helper function receives information from the manifest in addition to a grouping of styles. The nesting occurs here and the figure object is returned. It should be noted that this is where the logic is placed to allow an img tag to know when it is fully loaded. This is highlighted below:
                    </p>
                    <code>
<pre class='code info-code' >
function create_new_figure(file_name,init_style,vsco_url,source_grid,image_number){
    var anchor = document.createElement('a');
    anchor.setAttribute('target','_blank');
    anchor.setAttribute('rel','noopener noreferrer');
    anchor.setAttribute('href',vsco_url);

    var figure = document.createElement('figure');
    figure.style['border-top'] = init_style['border-top'];
    figure.style['opacity'] = init_style['opacity'];
    var id_string = source_grid+'-'+image_number;
    figure.id = 'figure-'+id_string;
    figure.setAttribute('loaded',false);

    var image = document.createElement('img');
    image.src = 'thumbnails/'+file_name;
    image.id = 'image-'+id_string;
    image.onload = function(){
        document.getElementById('figure-'+id_string).setAttribute('loaded',true);
    }

    figure.appendChild(image);
    anchor.appendChild(figure);
    return anchor;
}
</pre>

                    </code>
                    <p>
                        Pivoting back to the core of the logic contained in grid_load_agent, it's important to remind ourselves that when grid_load_agent is called, it is supplied a single argument. That argument is grid_selection which is a mechanism to select a specific grid view of a certain column length - the length determined by the argument given for the parameter. Much of the machination in place selects the grid of the supplied column count, then iterates through these columns. The variable labeled boundary indicates the amount of images to be pulled in through the current call. It is bounded by the column size of the grid_selection. It can be lower than this by reasons previously discussed and shown by the set of conditions to get into the core set of logic.
                    </p>
                    <code>
<pre class='code info-code' >
async function grid_load_agent(grid_selection){//grid_selection is not zero-based
    var load_count = load_counts[grid_selection-1];

    //Check whether we've run out of images to load:
    if(load_count &lt; manifest_size){
        //Ensure the amount of columns does not cause us to overdraft:
        if( (load_count+grid_selection) >= manifest_size){
            var boundary = manifest_size - load_count;
        }else{
            var boundary = grid_selection;
        }

        var display_count = display_counts[grid_selection-1];

        //A check to ensure that we don't grab too many images beyond the viewport boundary:
        load_condition_check = (load_count - display_count) &lt;= max_column_size);
        if(load_condition_check){
            .
            .
            .
            for(let i=0;i&lt;boundary;i++){
                .
                .
                .
            }
            .
            .
            .
        }
    .
    .
    .
    }
.
.
.
}
</pre>
                    </code>
                    <p>
                        Recall the general logic of placing figures into columns. The image of lesser height needs to be paired with the column with the largest height. The image of greater height needs to be paired with the column of the smallest height. Image heights need to be known and considered in a certain order. Column heights need to be known and considered in a certain order. Let's start with the images.
                    </p>
                    <p>
                        The image information is first retrieved from the manifest and then used to create a new figure.
                    </p>
                    <code>
<pre class='code info-code' >
for(let i=0;i&lt;boundary;i++){
    //Grab the next image from the manifest:
    var reference = manifest[load_count];
    var new_figure_data = {
        'object':create_new_figure(reference['webp_file'],{'border-top':'solid 25px white','opacity':0},reference['share_link'],grid_selection,load_count),
        'height': reference['height']
    };
    .
    .
    .
}
</pre>
                    </code>
                    <p>
                        Recall that images can be placed within the markup environment and the browser will take liberty to adjust the size of the object. In this case, we are using display properties that force the maximum size of an image to conform to the size of a given column. Within the manifest, height and width values of the originating image are stored. These can be used to calculate the proportion. It is not enough to strictly use the height value. Two images may share the same height value, but one may be significantly wider than the other, forcing a resize within the context of an html column. This resizing will in turn change its rendered height value. Thus, the image needs to have some ratio be calculated:
                    </p>
                    <code>
<pre class='code info-code' >
for(let i=0;i&lt;boundary;i++){
    .
    .
    .
    var new_figure_ratio = (100 * reference['height']) / reference['width'];
    .
    .
    .
}
</pre>
                    </code>
                    <p>
                        We now have an object representative of an image and a ratio representative of the amount of space it takes up within a column. These need to be placed somewhere on account of the fact this process is within an iterative structure.
                    </p>
                    <p>
                        Above this iterative structure exists a set of declarations. Relevant to the problem at hand is the following:
                        <ul>
                            <li>
                                var figure_height_list = []; - A list of heights which are a calculated ratio which represent the amount of space a figure takes up within a column. There may be repeat values within this list. This object will be sorted by magnitude and in turn will act as a stack whose values may be popped when filling a column. These values are also representative of keys to the following data structure.
                            </li>
                            <li>
                                var figure_height_map = {}; - An associative array of figure objects. These objects are a result of a call to create_new_figure. A key of figure_height_map is a height provided by the previously discussed data structure. Each key points to a list of objects. The total amount of keys for this associative array is in the range of [1,amount of columns]. In the case of one entry, this means that each image has the same height. In the case of an amount of entries equal to the amount of columns in the selected grid, this means that each figure has a separate height.
                            </li>
                        </ul>
                    </p>
                    <code>
<pre class='code info-code' >
for(let i=0;i&lt;boundary;i++){
    .
    .
    .
    if (Object.keys(figure_height_map).includes(new_figure_ratio.toString())){
        figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
    }else{
        figure_height_map[new_figure_ratio.toString()] = [];
        figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
    }
    figure_height_list.push(new_figure_ratio);
    .
    .
    .
}
</pre>
                    </code>
                    <p>
                        All that's left is to account for global info and to sort the list of keys, highlighted below.
                    </p>
                    <code>
<pre class='code info-code' >
for(let i=0;i&lt;boundary;i++){
    .
    .
    .
    var new_figure_ratio = (100 * reference['height']) / reference['width'];
    if (Object.keys(figure_height_map).includes(new_figure_ratio.toString())){
        figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
    }else{
        figure_height_map[new_figure_ratio.toString()] = [];
        figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
    }
    figure_height_list.push(new_figure_ratio);
    col_maps[grid_selection-1][i]['loaded'] += 1; //col_map tracks amount of images loaded and displayed for each column.
    load_count += 1;
}//end loop
load_counts[grid_selection-1] = load_count;

//position the program to iterate through the figure height values by order of height values:
figure_height_list.sort(function(a,b){
    return b-a;
});

</pre>
                    </code>
                    <p>
                        The same logic needs to applied to the grouping of columns being considered. The current height of the columns in place need to be considered and placed into a list. This list should be sorted in the opposite order of the figure_height_list so that its values may be popped in tandem with the height list of the figures for correct pairing. These data structures reflect the data structures with the figure prefix, and exist within the same scope and proximity. Noting these declarations, the familiar logic is as follows:
                    </p>
                    <code>
<pre class='code info-code' >
var columns = grids[grid_selection-1].children;
for(let i=0;i&lt;grid_selection;i++){
    let column_height = columns[i].getBoundingClientRect().height
    col_h_list.push(column_height);
    if(Object.keys(col_h_map).includes(column_height.toString())){
        col_h_map[column_height.toString()].push(i);
    }else{
        col_h_map[column_height.toString()] = [];
        col_h_map[column_height.toString()].push(i);
    }
}

// TODO: create an insertion subroutine in place of what these sorts accomplish.
col_h_list.sort(function(a,b){
    return a-b;
});
</pre>
                    </code>
                    <p>
                        With the maps in place, all that needs to be done is to iterate an amount of times equal to the amount of images being placed. For each iteration, pop a height key from both height lists. Use these keys to access their respective associative arrays and get the the relevant objects to make a figure-column pairing.
                    </p>
                    <code>
<pre class='code info-code' >
var iteration_index = 0;
var figure_key = figure_height_list[iteration_index];
var figure_group = figure_height_map[figure_key];
while(iteration_index &lt; boundary){
    //allow iteration of multiple columns with the same height-tier:
    for(let i=0;i&lt;figure_group.length;i++){
        //Grab the height-value of the next-smallest colulmn:
        let col_key = col_h_list[iteration_index];
        //Get the index of the column with respect to the columns collection:
        col_index = col_h_map[col_key].pop();
        //Grab the next figure of the current height-tier:
        figure = figure_group[i];
        columns[col_index].appendChild(figure);
        iteration_index += 1;
    }
    figure_key = figure_height_list[iteration_index];
    figure_group = figure_height_map[figure_key];
}
</pre>
                    </code>
                    <p>
                        Note that the value for iteration_index allows for a case where subsequent images can be placed into the same column. This occurs when a group of images whose combined height isn't great enough to cause a column's height to overwhelm the others.
                    </p>
                    <p>
                        All these pieces are brought together to make the whole of the subroutine:
                    </p>
                    <code>
<pre class='code info-code' >
async function grid_load_agent(grid_selection){//grid_selection is not zero-based
    var load_count = load_counts[grid_selection-1];

    //Check whether we've run out of images to load:
    if(load_count &lt; manifest_size){
        //Ensure the amount of columns does not cause us to overdraft:
        if( (load_count+grid_selection) >= manifest_size){
            var boundary = manifest_size - load_count;
        }else{
            var boundary = grid_selection;
        }

        var display_count = display_counts[grid_selection-1];

        //A check to ensure that we don't grab too many images beyond the viewport boundary:
        load_condition_check = (load_count - display_count) &lt;= max_column_size);
        if(load_condition_check){
            //A to-be-ordered list of height values for each figure loaded:
            var figure_height_list = [];
            //A mapping of figure objects such that the key is it's height:
            var figure_height_map = {};
            //A to-be-ordered list of height values with respect to the columns being used for display:
            var col_h_list = [];
            //A mapping of column objects such that a key is a column's height:
            var col_h_map = {};

            //Iterate an amount of times equivalent to amount of images being buffered:
            for(let i=0;i&lt;boundary;i++){

                //Grab the next image from the manifest:
                var reference = manifest[load_count];


                var new_figure_data = {
                                    'object':create_new_figure(reference['webp_file'],{'border-top':'solid 25px white','opacity':0},reference['share_link'],grid_selection,load_count),
                                    'height': reference['height']
                                    };

                var new_figure_ratio = (100 * reference['height']) / reference['width'];
                if (Object.keys(figure_height_map).includes(new_figure_ratio.toString())){
                    figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
                }else{
                    figure_height_map[new_figure_ratio.toString()] = [];
                    figure_height_map[new_figure_ratio.toString()].push(new_figure_data['object']);
                }
                figure_height_list.push(new_figure_ratio);
                col_maps[grid_selection-1][i]['loaded'] += 1; //col_map tracks amount of images loaded and displayed for each column.
                load_count += 1;
            }
            load_counts[grid_selection-1] = load_count;

            //position the program to iterate through the figure height values by order of height values:
            figure_height_list.sort(function(a,b){
                return b-a;
            });

            var columns = grids[grid_selection-1].children;
            for(let i=0;i&lt;grid_selection;i++){
                let column_height = columns[i].getBoundingClientRect().height
                col_h_list.push(column_height);
                if(Object.keys(col_h_map).includes(column_height.toString())){
                    col_h_map[column_height.toString()].push(i);
                }else{
                    col_h_map[column_height.toString()] = [];
                    col_h_map[column_height.toString()].push(i);
                }
            }

            // TODO: create an insertion subroutine in place of what these sorts accomplish.
            col_h_list.sort(function(a,b){
                return a-b;
            });

            var iteration_index = 0;
            var figure_key = figure_height_list[iteration_index];
            var figure_group = figure_height_map[figure_key];
            while(iteration_index &lt; boundary){
                //allow iteration of multiple columns with the same height-tier:
                for(let i=0;i&lt;figure_group.length;i++){
                    //Grab the height-value of the next-smallest colulmn:
                    let col_key = col_h_list[iteration_index];
                    //Get the index of the column with respect to the columns collection:
                    col_index = col_h_map[col_key].pop();
                    //Grab the next figure of the current height-tier:
                    figure = figure_group[i];
                    columns[col_index].appendChild(figure);
                    iteration_index += 1;
                }
                figure_key = figure_height_list[iteration_index];
                figure_group = figure_height_map[figure_key];
            }
            setTimeout(function(){
                grid_display_agent(grid_selection);
            },(grid_selection * 100));
        }
    }
}
</pre>
                    </code>
                    <p>
                        Taking a step back, a higher look will expose a key relationship. This relationship is based on the existence of two separate abstractions which recursively interact with each other. One piece is the buffer zone in which new images are placed but hidden. The other piece is the complement where the images have been revealed. The transition from one abstraction to the other is whether or not one of their components (an image-figure) has reached the threshold described by isFigureBottom. This transition ceases once all available images have been placed from the buffer zone into its complement.
                    </p>
                    <p>
                        Taking a higher look on top of these relationships, one can make the claim there exists a third abstraction - images which have not been placed in the buffer zone or its complement. A transition occurs from here into the buffer zone. The transitions cease here once there are no more images to be placed. The mutual recursion between grid_load_agent and grid_display_agent allows for continual placement of images into these abstract spaces. It is through this discussion that the base cases are also highlighted. Recursion stops when isFigureBottom produces a set of false values and when there are no more images to be placed into the buffer zone.
                    </p>
                    <p>
                        The recursion involved needs to be initiated by something, though. What this is is fairly obvious - when the page finishes loading, kick off the process. The first thing this process needs to ask itself is, "how many columns should initially be displayed?" This question is answered through a subroutine called readjust_caller which sets a global variable called active_grid. This variable indicates how many columns should exist dependent on the width of the screen. This subroutine is also called within a simple event handler for the window on resize.
                    </p>
                    <code>
<pre class='code info-code' >
var isMobile = window.matchMedia || window.msMatchMedia;
isMobile = isMobile("(pointer:coarse)").matches;

var old_height = 0;
var initial_gallery_position;

window.addEventListener('load', function () {
    initial_gallery_position = document.getElementById('galleries').getBoundingClientRect().top;
    readjust_caller();
    grids[active_grid-1].style['overflow'] = 'inherit';
    grids[active_grid-1].style['height'] = 'inherit';
    grid_load_agent(active_grid);
    for(let i=1;i&lt;=max_column_size;i++){
        if(i != active_grid){
            grid_load_agent(i);
        }
    }
    old_height = window.innerHeight;
});

window.onresize = function(){
    readjust_caller();
    if(old_height &lt; window.innerHeight){
        grid_display_agent(active_grid);
    }
    old_height = window.innerHeight;
}

</pre>
                    </code>
                    <p>
                        It is within the call stack of the readjust_caller that a the display properties of document.getElementById('galleries')'s children is handled; the children which represent a grid view of a certain column quantity. For example, should the readjust_caller determine the width of the device's screen necessitate 3 columns, it hides the grids of column sizes 1, 2, and 4, and enables the display of the grid of column size 3.
                    </p>
                    <p>
                        The result of the window's load event handler, shown above, will allow the image grid to display a set amount of images based on the height of the window. It will also place the images into each buffer zone. If one were to scroll, no more action would occur; isFigureBottom would not be called upon again. To address this, another event needs to be considered: when the screen scrolls!
                    </p>
                    <code>
<pre class='code info-code' >
window.onscroll = function(){
    if(display_counts[active_grid - 1] &lt;= load_counts[active_grid - 1] - active_grid){
        setTimeout(function(){
            grid_display_agent(active_grid);
            let base = load_counts[active_grid - 1];
            for(let i=1;i&lt;=max_column_size;i++){
                let is_not_active_column = i != active_grid;
                let has_less_loaded = load_counts[i-1] &lt; base;
                let is_multiple_of = (base % i) == 0;
                if(is_not_active_column && has_less_loaded && is_multiple_of){
                    while(load_counts[i-1] &lt;= base && load_counts[i-1] &lt; manifest_size){
                        grid_load_agent(i);
                    }
                }
            }
        }, (100 * active_grid));
    }
}
</pre>
                    </code>
                    <p>
                        The set of booleans that scaffold the conditional within this subroutine's loop really emphasizes on a common pattern that has not been explicitly discussed thus far. Recall that both grid_load_agent and grid_display agent have a single parameter which represents a certain grid view. A single call will determine the transitional state for a grid of the size given as an argument and decide whether an image should move from one state of display to another. As a user scrolls through the gallery, it's obvious what is occurring for the current grid view. It is not obvious that the same decisions are being made for the grids which are out of view.
                    </p>
                    </p>
                        Thus, when a user scrolls while the active_grid is 3, (for example), checks need to occur whether or not images should be placed into the buffer zone for the other grids.
                    <p>
                    <p>
                        The mutually recursive structure in place will also determine whether these hidden grid views move a given figure from this zone as well. This is done by some css trickery. Instead of setting the display property of these grids to none, the height is instead set to zero and an overflow property is set to obscure the scroll-bar that may be displayed as a result. This allows the calculation of the height values of the columns in place in this hidden state; the calculations that occur within grid_load_agent. It also allows isFigureBottom to work in this context as well.
                    </p>
                    <p>
                        Ultimately, this is a code smell. This code smell has the consequence of being affected by the whims of web browser if it decides to change rendering behavior. Future work on this script will remove the reliance of the calculation of a columns height via getBoundingClientRect() and instead populate a data structure with the height information calculated by the the new_figure_ratio within grid_load_agent().
                    </p>
                    <p>
                        A closer look at this code smell reveals the unintended behavior of the fact that grids of differing column lengths reveal images at differing rates. This is because isFigureBottom may flag true for images that are scaled differently on account of the amount of space afforded by a column. The consequence of this is when a user resizes the window, and the resize presents a different grid-view, they may have to witness the transition effect of an image being brought into view again. This may give the false impression that the image has been reloaded into the browser and/or that may gaslight a user into thinking they have not viewed that image yet.
                    </p>
                    <p>
                        Taking a look at the deployment of the image gallery, as of date in which this writing is published, will show that this is not an issue. Some patches have been made to the code which can be viewed via this site's github repository.
                    </p>
                    <p>
                        A closer look at the repository will also reveal additional code in place. What's not been discussed here is how to differentiate transition effects for images that are a part of the initial batch of images loaded in upon page view and the subsequent images that are loaded upon scroll. Ultimately this is a trivial adaptation, so it's encouraged the reader of this article investigate the repository's code or think of their own solution on the matter.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

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
