<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
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
<?php
    require($root_directory."code_footer.html");
?>
