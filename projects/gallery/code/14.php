<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
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
        <mark>columns[col_index].appendChild(figure);</mark>
        iteration_index += 1;
    }
    figure_key = figure_height_list[iteration_index];
    figure_group = figure_height_map[figure_key];
}
<?php
    require($root_directory."code_footer.html");
?>
