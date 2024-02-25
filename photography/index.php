<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/photography/';

$title = 'Alan McKay | Photography';

$meta['title'] = 'Alan McKay | Photography';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/photography/';

$relative_path = "../";

include('../header.php');

//vsco: width == 1012 kicks into displaying 5 in a row
//      width ==  768 kicks into displaying 4 in a row
//      width ==  543 kicks into displaying 3 in a row
//    Each column has display:grid; There exists a container of the columns that
//      has the same display property. The width of these columns sets the width
//      of the images via percentages and application of max-width.

// . Do a preliminary load of n images, where n is the max amount of columns.
// . Calculate the height of the smallest column
//      - This is a compound measurement of the height values of each image
//          within the column.
// . When a resize occurs which adds a new column, recalculate height of the
//      smallest column.
//      - Rebucket the images in the grid with respect to new quantity of cols
// . When the viewport is determined to be at a point where more images should
//      be loaded, add the next image to the col with the smallest height, re-
//      calculate the smallest column.

//I want to have fade-in animations for the new images being loaded. This can
//  be accomplished by creating a new figure tag whose display is initially set
//  to none.

//Would like to have a buffer of images loaded in which aren't displayed, and
//  the view-port trigger displays these images then loads in a new buffer.

//Need to consider the images.json file with respect to finding the order to
//  to load in these images. Should also create my own manifest datastructure.
?>
        <section id='writingsWrapper'>
            <section>
                <article>

                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>

                        </p>
                    <hr>
                    </section>

                    <header>
                        <h1>Photography</h1>
                    </header>
                    <div id='image-gallery-1' class='image-gallery' style='display:none;grid-template-columns: repeat(1, minmax(0px,1fr));align-items:start;'>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                    </div>
                    <div id='image-gallery-2' class='image-gallery' style='display:none;grid-template-columns: repeat(2, minmax(0px,1fr));align-items:start;'>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                    </div>
                    <div class='image-gallery' style='display:grid;grid-template-columns: repeat(3, minmax(0px,1fr));align-items:start;'>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                        </div>
                    </div>
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
        <script>
            // JSON object which houses image information:
            var manifest;
            // Integer to determine amount of entries of the manifest that have been considered:
            var manifest_tracker = 0;
            // Switch to determine whether or not more images should be loaded:
            var load_flag = true;
            // Array to keep track of the heights of each column context:
            var column_heights = {'1':[0], '2': [0,0], '3': [0,0,0]};
            // Array of the html elements that act as grids for each set of columns:
            var grids = document.getElementsByClassName('image-gallery');
            // The current active grid:
            var active_grid = 3;
            // The html element of the current actie grid:
            var grid = grids[(active_grid)-1];
            // The columns contained in the currently active grid:
            var columns = grid.children;

            var max_column_size = 3;

            async function get_manifest(){
                let manifest_response = await fetch("./manifest.json");
                if (manifest_response.ok){
                    let manifest_result = await manifest_response.json();
                    return manifest_result;
                }
            }

            function isFigureBottom(fig_object){
                fig_height = fig_object.getBoundingClientRect().height;
                fig_top = fig_object.getBoundingClientRect().top;
                if((window.innerHeight * .95)-fig_top > 0){ 
                    return true;
                }else{
                    return false;
                }
            }

            var col_maps = []
            console.log('col_maps');
            for(i=0;i<max_column_size;i++){
                console.log(i);
                col_map = [];
                for(j=0;j<(i+1);j++){
                    col_map[j] = []
                    col_map[j]['loaded'] = 0;
                    col_map[j]['displayed'] = -1;
                }
                col_maps.push(col_map);
                console.log(col_maps);
            }

            function create_new_figure(manifest_id,init_style){
                const figure = document.createElement('figure');
                figure.style['border-top'] = init_style['border-top'];
                figure.style['opacity'] = init_style['opacity'];

                const image = document.createElement('img');
                image.src = 'images/'+manifest_id;
                figure.appendChild(image);

                return figure;
            }

            var load_count = 0;
            var display_count = 0;
            
            // This agent does **batch** loading of images. It makes decisions based on
            //  the **grouping** of images being loaded in. This is to refute the notion
            //  of abstracting responsibilities of creation to something more finite.
            function grid_load_agent(){
                //Manifest tracker keeps count of quantity of items pulled from manifest:
                let init_manifest = (manifest_tracker);
                //Grab the size of the manifest regardless of pull:
                manifest_size = Object.keys(manifest).length;
                //Check whether we've run out of images to load:
                if(manifest_tracker < manifest_size){
                    //Ensure the amount of columns does not cause us to overdraft:
                    if( (manifest_tracker+active_grid) >= manifest_size){
                        boundary = manifest_size - manifest_tracker;
                    }else{
                        boundary = active_grid;
                    }

                    //If the grid_display_agent has flagged that we need to grab more images:
                    if(load_flag){
                        console.log('difference: ' + ((load_count) - display_count));
                        //A check to ensure that we don't grab too many images beyond the viewport boundary:
                        if((manifest_tracker - display_count) <= 6){
                            console.log('loading!');
                            //Increment program's load_counter:
                            load_count = load_count + boundary;

                            //A to-be-ordered list of height values for each figure loaded:
                            height_list = []
                            //A mapping of figure objects such that the key is it's height:
                            figure_map = [];
                            //A to-be-ordered list of height values with respect to the columns being used for display:
                            col_h_list = [];
                            //A mapping of column objects such that a key is a column's height:
                            col_h_map = [];

                            //Iterate an amount of times equivalent to amount of images being buffered:
                            for(i=0;i<boundary;i++){

                                //Grab the next image from the manifest:
                                reference = manifest[init_manifest+i];

                                //Unecessary check; simply forces the initial set of images to not have animated transition:
                                if(manifest_tracker - active_grid < 0){
                                    new_figure_data = {
                                                        'object':create_new_figure(reference['file_name'],{'border-top':'solid 0px white','opacity':0}),
                                                        'height':reference['height']
                                                    }
                                }else{
                                    new_figure_data = {
                                                        'object':create_new_figure(reference['file_name'],{'border-top':'solid 25px white','opacity':0}),
                                                        'height': reference['height']
                                                    }
                                }

                                //Create height buckets within the figure map - accounts for images that may have the same height:
                                if (Object.keys(figure_map).includes(new_figure_data['height'].toString())){
                                    figure_map[new_figure_data['height'].toString()].push(new_figure_data['object']);
                                }else{
                                    figure_map[new_figure_data['height'].toString()] = [];
                                    figure_map[new_figure_data['height'].toString()].push(new_figure_data['object']);
                                }
                                height_list.push(new_figure_data['height']);
                                col_maps[active_grid-1][i]['loaded'] += 1; //col_map tracks amount of images loaded and displayed for each column.
                                manifest_tracker += 1;
                            }
                            
                            //position the program to iterate through the figure height values by order of height values:
                            height_list.sort(function(a,b){
                                return b-a
                            });

                            for(i=0;i<active_grid;i++){
                                column_height = columns[i].getBoundingClientRect().height;
                                col_h_list.push(column_height);
                                if(Object.keys(col_h_map).includes(column_height.toString())){
                                    col_h_map[column_height].push(i);
                                }else{
                                    col_h_map[column_height] = [];
                                    col_h_map[column_height].push(i);
                                }
                            }

                            col_h_list.sort(function(a,b){
                                return a-b
                            });

                            //console.log(col_h_list);
                            iteration_index = 0;
                            figure_index = height_list[iteration_index];
                            height_selection = figure_map[figure_index];
                            while(iteration_index < boundary){
                                //allow iteration of multiple columns with the same height-tier:
                                for(i=0;i<height_selection.length;i++){
                                    //Grab the height-value of the next-smallest colulmn:
                                    col_index = col_h_list[iteration_index];
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

                            setTimeout(grid_display_agent,500);
                        }else{
                            console.log('no load!');
                        }
                    }
                }
            }
            
            function readjust_columns(direction){
                if(direction == false){ //gaining a column

                }else{//losing a column

                }
            }

            function grid_display_agent(){
                load_flag = false;
                for(i=0;i<active_grid;i++){
                    col = columns[i];
                    figures = col.getElementsByTagName('figure');
                    console.log('here')
                    for(j=Math.max(0,col_maps[active_grid-1][i]['displayed']);j<col_maps[active_grid-1][i]['loaded'];j++){
                        figure = figures[j];
                        if(isFigureBottom(figure)){
                            figure.style['opacity'] = 1;
                            figure.style['border-top'] = 'solid white 5px';
                            col_maps[active_grid-1][i]['displayed'] += 1;
                            load_flag = true;
                            display_count = display_count + 1;
                            console.log('display count: ' + display_count);
                            console.log('load count: ' + load_count);
                        }else{
                            load_flag = load_flag || false;
                        }
                    }
                }
                if(load_flag){
                    grid_load_agent();
                }
            }


            var parse_manifest;

            window.onscroll = function(){
                grid_display_agent();
                console.log(manifest_tracker);
                //need to add a logic that checks to see if a user has scrolled to the bottom of the page;
                //  if so, then switch the load_flag to true and call the load_agent.
            }

            window.addEventListener('load', function () {
                //grid_display_agent();
                get_manifest().then(function(result){
                    manifest = result;
                    parse_manifest = function(){
                        grid_load_agent();
                        grid_display_agent();
                    }
                    parse_manifest();
                 });
            });



        </script>
    </body>
</html>

