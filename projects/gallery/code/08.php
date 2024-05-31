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
<?php
    require($root_directory."code_footer.html");
?>
