<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/photography/';

$title = 'Alan McKay | Photography';

$meta['title'] = 'Alan McKay | Photography';

$meta['description'] = 'Image gallery of photos taken by Alan McKay; Photography sharing interesting places, people, and experiences starting from 2018.';

$meta['url'] = 'https://alanmckay.blog/photography/';

$relative_path = "../";

include('../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>

                    <section class='info'>
                        <header>
                            <h2>On VSCO</h2>
                        </header>
                        <p>
                            From the homepage, navigating to my photography portal used to take a visitor to my <a href='https://vsco.co/alanmckay/gallery' target="_blank" rel="noopener noreferrer">VSCO profile</a>. The VSCO platform has recently made a change forcing a vistor to sign into their service in order to view the entirety of a given profile's image gallery. This has effectively siloed their users into a walled garden, which has encouraged me to stop paying an optional subscription and develop my own image gallery.
                        </p>
                        <p>
                            This is the result of my efforts. Feel free to take a look at the various photographs I've taken since 2018. There is no obligation to sign in here. Interacting with an image will take you to the relevant photo within the VSCO platform. This will be changed once the gate is locked for individual images as well.
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Photography</h1>
                    </header>
                    <script src='manifest.js'></script>
<?php
    $json = file_get_contents("manifest.json");
    $json_data = json_decode($json,true);
    $image_count = 9;
    $image_index = 0;
    $images_quantity = count($json_data);
    $max_page_number = ceil($images_quantity / $image_count);
    if(isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] <= $max_page_number) && ($_GET['page'] > 0)){
        $initial_index = $image_count * ((int)$_GET['page'] - 1);
        $image_index = $initial_index;
    }
    echo "<div  id='static-image-gallery' style='max-width:720px;margin:auto;display: grid; grid-template-columns: repeat(auto-fit, minmax(min(170px, 100%), 1fr)); align-items: center; column-gap: 15px; row-gap:15px;'>";
        echo "<script> document.getElementById('static-image-gallery').remove();</script>";
    for($i = 0; $i < min(($images_quantity - $initial_index),$image_count); $i++){
        echo "<a href='".$json_data[$image_index]['share_link']."' target='_blank' rel='noopener noreferrer'>";
        echo "<figure>";
        echo "<img load='lazy' src='thumbnails/".$json_data[$image_index]['webp_file']."'?static/>";
        $image_index = $image_index + 1;
        echo "</figure>";
        echo "</a>";
    }
    echo "</div>";
    if(!isset($_GET['page'])){
        $current_page = 1;
    }else{
        $current_page = $_GET['page'];
    }
    echo "<nav id='static-gallery-control' style='padding-top:15px;'>";
        echo "<script>document.getElementById('static-gallery-control').remove();</script>";
        echo "Current Page: ".$current_page;
        echo "<ul style='padding-left:0px;'>";
            if($current_page > 1){
                $first_display = 'visible;';
            }else{
                $first_display = 'hidden;';
            }
            if($current_page < $max_page_number){
                $last_display = 'visible;';
            }else{
                $last_display = 'hidden;';
            }
            echo "<li style='visibility:".$first_display."'>";
                echo "<a href='index.php?page=1'>&lt;&lt; First</a>";
            echo "</li>";
            echo "<li style='visibility:".$first_display."'>";
                echo "<a href='index.php?page=".($current_page-1)."'>&lt; Previous</a>";
            echo "</li>";
            echo "<li style='visibility:".$last_display."'>";
                echo "<a href='index.php?page=".($current_page+1)."'>Next &gt;</a>";
            echo "</li>";
            echo "<li style='visibility:".$last_display."'>";
                echo "<a href='index.php?page=".$max_page_number."'>Last &gt;&gt;</a>";
            echo "</li>";
        echo "</ul>";
    echo "</nav>";
?>

                    <div id='galleries'>
                    </div>
                    <p id='wait' style='visibility:hidden;text-align:center;'><i>Loading Images<span id='sf1'>.</span><span id='sf2'>.</span><span id='sf3'>.</span></i></p>
                    <hr>

                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>

        <script>
            document.getElementById('wait').style['visibility'] = 'inherit';

            // --- --- --- Declarations --- --- --- //

            // JSON object which houses image information:
            //var manifest; //This is now introduced via <script> source.

            var manifest_size = Object.keys(manifest).length;

            var max_column_size = 4;
            // Integer array to determine amount of entries of the manifest that have been considered for a given column:
            var manifest_trackers = [];
            // Integer array to determine how many images have been loaded for a given column:
            var load_counts = []
            // Integer array to determine how many images have been displayed for a given column:
            var display_counts = []
            // An array of booleans used to determine if the initial load is concluded for a given column:
            var preload_switches = [];
            // An array of integers that act as timing multipliers for a given column:
            var preload_multipliers = []
            // --- --- --- //
            // Priming the above arrays:
            for(let i=0;i<max_column_size;i++){
                manifest_trackers.push(0);
                load_counts.push(0);
                display_counts.push(0);
                preload_switches.push(true);
                preload_multipliers.push(0);
            }
            // -- -- -- //

            // Array to track quantity of figures that have been loaded and the quantity of figures that have been displayed for a given grid:
            var col_maps = [];

            // --- --- --- //
            // Priming col_maps:
            for(let i=0;i<max_column_size;i++){
                col_map = [];
                for(let j=0;j<(i+1);j++){
                    col_map[j] = [];
                    col_map[j]['loaded'] = 0;
                    col_map[j]['displayed'] = 0;
                }
                col_maps.push(col_map);
            }
            // -- -- -- //
            
            // --- --- --- //
            //Block of logic to create the divs that house the grids of each column length:
            grids_html = document.getElementById('galleries');
            for(let i=0;i<max_column_size;i++){
                const grid = document.createElement('div');
                grid.setAttribute('class','image-gallery');
                // TODO: Create a css class for the folowing properties:
                grid.style['display'] = 'grid';
                grid.style['grid-template-columns'] = 'repeat('+(i+1)+', minmax(0px,1fr))';
                grid.style['align-items'] = 'start';
                grid.style['height'] = '0px';
                grid.style['overflow'] = 'scroll';
                for(let j=0;j<=i;j++){
                    const column = document.createElement('div');
                    column.setAttribute('class','image-col');
                    column.style['display'] = 'grid';
                    column.style['grid-template-columns'] = 'minmax(0px,1fr)';
                    grid.appendChild(column);
                }
                grids_html.appendChild(grid);
            }
            delete grids_html;
            // -- -- -- //

            // Array of the html elements that act as grids for each set of columns:
            var grids = document.getElementsByClassName('image-gallery');
            // The current active grid; 1-based index:
            var active_grid;

            // --- --- --- ------------ --- --- --- //

            async function get_manifest(){ // currently unused function
                let manifest_response = await fetch("./manifest.json");
                if (manifest_response.ok){
                    let manifest_result = await manifest_response.json();
                    return manifest_result;
                }
            }

            function isFigureBottom(fig_object){
                var fig_height = fig_object.getBoundingClientRect().height;
                var fig_top = fig_object.getBoundingClientRect().top;
                if((window.innerHeight * .95)-fig_top > 0){
                    return true;
                }else{
                    return false;
                }
            }

            function create_new_figure(manifest_id,init_style,url,source_grid,image_number){
                var anchor = document.createElement('a');
                anchor.setAttribute('target','_blank');
                anchor.setAttribute('rel','noopener noreferrer');
                anchor.setAttribute('href',url);

                var figure = document.createElement('figure');
                figure.style['border-top'] = init_style['border-top'];
                figure.style['opacity'] = init_style['opacity'];
                var id_string = source_grid+'-'+image_number;
                figure.id = 'figure-'+id_string;
                figure.setAttribute('loaded',false);

                var image = document.createElement('img');
                image.src = 'thumbnails/'+manifest_id;
                image.id = 'image-'+id_string;
                image.onload = function(){
                    document.getElementById('figure-'+id_string).setAttribute('loaded',true);
                }

                figure.appendChild(image);
                anchor.appendChild(figure);
                return anchor;
            }

            // This agent does **batch** loading of images. It makes decisions based on
            //  the **grouping** of images being loaded in.
            async function grid_load_agent(grid_selection){//grid_selection is not zero-based
                //Manifest tracker keeps count of quantity of items pulled from manifest:
                var manifest_tracker = manifest_trackers[grid_selection-1];
                var columns = grids[grid_selection-1].children;

                //Check whether we've run out of images to load:
                if(manifest_tracker < manifest_size){
                    //Ensure the amount of columns does not cause us to overdraft:
                    if( (manifest_tracker+grid_selection) >= manifest_size){
                        var boundary = manifest_size - manifest_tracker;
                    }else{
                        var boundary = grid_selection;
                    }

                    var load_count = load_counts[grid_selection-1];
                    var display_count = display_counts[grid_selection-1];

                    //This initial boolean is a means to force loading for unactive grids; a code smell that implies a refactor of behavior is needed.
                    load_condition_check = active_grid != grid_selection;
                    //A check to ensure that we don't grab too many images beyond the viewport boundary:
                    load_condition_check = (load_condition_check || ((manifest_tracker - display_count) <= max_column_size)) && manifest_tracker < manifest_size;
                    //if not active grid then pass next condition; display_count is irrelevant
                    if(load_condition_check){
                        //Increment program's load_counter:
                        load_count = load_count + boundary;
                        load_counts[grid_selection-1] = load_count;
                        //A to-be-ordered list of height values for each figure loaded:
                        var height_list = [];
                        //A mapping of figure objects such that the key is it's height:
                        var figure_map = {};
                        //A to-be-ordered list of height values with respect to the columns being used for display:
                        var col_h_list = [];
                        //A mapping of column objects such that a key is a column's height:
                        var col_h_map = {};

                        //Iterate an amount of times equivalent to amount of images being buffered:
                        for(let i=0;i<boundary;i++){

                            //Grab the next image from the manifest:
                            var reference = manifest[manifest_tracker];

                            //Determine the initial state of an image (pre-grid_display_agent)
                            var preload_switch;
                            if(grid_selection != active_grid){
                                preload_switch = true;
                                preload_opacity = 1;
                            }else{
                                preload_switch = preload_switches[grid_selection - 1];
                                preload_opacity = 0;
                            }

                            if(preload_switch == true){
                                var new_figure_data = {
                                                    'object':create_new_figure(reference['webp_file'],{'border-top':'solid 5px white','opacity':preload_opacity},reference['share_link'],grid_selection,manifest_tracker),
                                                    'height':reference['height']
                                                };
                            }else{
                                var new_figure_data = {
                                                    'object':create_new_figure(reference['webp_file'],{'border-top':'solid 25px white','opacity':0},reference['share_link'],grid_selection,manifest_tracker),
                                                    'height': reference['height']
                                                };
                            }

                            //Create height buckets within the figure map - accounts for images that may have the same height:
                            var new_figure_ratio = (100 * reference['height']) / reference['width'];
                            if (Object.keys(figure_map).includes(new_figure_ratio.toString())){
                                figure_map[new_figure_ratio.toString()].push(new_figure_data['object']);
                            }else{
                                figure_map[new_figure_ratio.toString()] = [];
                                figure_map[new_figure_ratio.toString()].push(new_figure_data['object']);
                            }
                            height_list.push(new_figure_ratio);
                            col_maps[grid_selection-1][i]['loaded'] += 1; //col_map tracks amount of images loaded and displayed for each column.
                            manifest_tracker += 1;
                        }

                        manifest_trackers[grid_selection-1] = manifest_tracker;
                        //position the program to iterate through the figure height values by order of height values:
                        height_list.sort(function(a,b){
                            return b-a;
                        });

                        for(let i=0;i<grid_selection;i++){
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
                        var figure_index = height_list[iteration_index];
                        var height_selection = figure_map[figure_index];
                        while(iteration_index < boundary){
                            //allow iteration of multiple columns with the same height-tier:
                            for(let i=0;i<height_selection.length;i++){
                                //Grab the height-value of the next-smallest colulmn:
                                let col_index = col_h_list[iteration_index];
                                //Get the index of the column with respect to the columns collection:
                                col_index = col_h_map[col_index].pop();
                                //Grab the next figure of the current height-tier:
                                figure = height_selection[i];
                                columns[col_index].appendChild(figure);
                                iteration_index += 1;
                            }
                            figure_index = height_list[iteration_index];
                            height_selection = figure_map[figure_index];
                        }
                        setTimeout(function(){
                            grid_display_agent(grid_selection);
                        },(preload_multipliers[grid_selection - 1] * grid_selection * 100));
                    }
                }
            }
            
            function preload_handler(grid_selection, col_object){
                let col_height = col_object.getBoundingClientRect().height;
                if(col_height + initial_gallery_position > (window.innerHeight * .80)){
                    preload_switches[grid_selection - 1] = false;
                    preload_multipliers[grid_selection - 1] = 1;
                }
            }

            async function grid_display_agent(grid_selection){
                var load_flag = false;
                for(let i=0;i<grid_selection;i++){
                    let col = grids[grid_selection-1].children[i];

                    if(preload_switches[grid_selection - 1] == true){
                        preload_handler(grid_selection, col);
                    }

                    let figures = col.getElementsByTagName('figure');
                    for(let j=Math.max(0,col_maps[grid_selection-1][i]['displayed']);j<Math.min(figures.length,col_maps[grid_selection-1][i]['loaded']);j++){
                        let figure = figures[j];
                        if(isFigureBottom(figure)){
                            let figureDisplayLambda = function(){
                                if(figure.getAttribute('loaded') == 'true'){
                                    //console.log(figure.id + '- done');
                                    figure.style['opacity'] = 1;
                                    figure.style['border-top'] = 'solid white 5px';
                                }else{
                                    //console.log('not done - ' + figure.id);
                                    setTimeout(figureDisplayLambda,500);
                                }
                            }
                            figureDisplayLambda();
                            col_maps[grid_selection-1][i]['displayed'] += 1;
                            load_flag = true;
                            display_counts[grid_selection-1] = display_counts[grid_selection-1] + 1;
                        }else{
                            load_flag = load_flag || false;
                        }
                    }
                }
                if(load_flag === true){
                    if(load_counts[max_column_size-1] >= manifest_size){
                        document.getElementById('wait').style['visibility'] = 'hidden';
                    }
                    setTimeout(function(){grid_load_agent(grid_selection)},(preload_multipliers[grid_selection - 1] * grid_selection * 100));
                }
                
            }

            window.onscroll = function(){
                setTimeout(function(){
                    grid_display_agent(active_grid);
                    let base = manifest_trackers[active_grid - 1];
                    for(let i=1;i<=max_column_size;i++){
                        let is_not_active_column = i != active_grid;
                        let has_less_loaded = load_counts[i-1] < base;
                        let is_multiple_of = base % i == 0;
                        if(is_not_active_column && has_less_loaded && is_multiple_of){
                            while(manifest_trackers[i-1] <= base && manifest_trackers[i-1] < manifest_size){
                                grid_load_agent(i);
                            }
                        }
                    }
                }, (preload_multipliers[active_grid - 1] * 100 * active_grid));
            }


            function readjust_columns(grid_selection){
                if(grid_selection != active_grid){
                    active_grid = grid_selection;
                    for(let i=0;i<max_column_size;i++){
                        let grid = grids[i];
                        if((i+1) == active_grid){
                            grid.style.height = null;
                            grid.style.overflow = null;;
                        }else{
                            grid.style.height = '0px';
                            grid.style.overflow = 'scroll';
                        }
                    }
                    grid_display_agent(grid_selection);
                }
            }

            var size_thresholds = {'mobile':[300,542],'desktop':[400,542,768]};
            function readjust_caller(){
                var container = document.getElementById('writingsWrapper');
                var container_width = container.getBoundingClientRect().width;
                let mobile = size_thresholds['mobile'];
                let desktop = size_thresholds['desktop'];
                if(isMobile){
                    max_column_size = 3;
                    if(container_width <= mobile[0]){
                        readjust_columns(1);
                    }else if(container_width > mobile[0] && container_width <= mobile[1]){
                        readjust_columns(2);
                    }else if(container_width > mobile[1]){
                        readjust_columns(3);
                    }
                }else
                if(container_width <= desktop[0]){
                    readjust_columns(1);
                }else if(container_width > desktop[0] && container_width <= desktop[1]){
                    readjust_columns(2);
                }else if(container_width > desktop[1] && container_width <= desktop[2]){
                    readjust_columns(3);
                }else if(container_width > desktop[2]){
                    readjust_columns(4);
                }
            }

            window.onresize = function(){
                readjust_caller();
                if(old_height < window.innerHeight){
                    grid_display_agent(active_grid);
                }
                old_height = window.innerHeight;
            }

            var old_height = 0;
            var initial_gallery_position;

            var isMobile = window.matchMedia || window.msMatchMedia;
            isMobile = isMobile("(pointer:coarse)").matches;

            window.addEventListener('load', function () {
                initial_gallery_position = document.getElementById('galleries').getBoundingClientRect().top;
                readjust_caller();
                grids[active_grid-1].style['overflow'] = 'inherit';
                grids[active_grid-1].style['height'] = 'inherit';
                grid_load_agent(active_grid);
                for(let i=1;i<=max_column_size;i++){
                    if(i != active_grid){
                        grid_load_agent(i);
                    }
                }
                old_height = window.innerHeight;
            });

        </script>
    </body>
</html>

