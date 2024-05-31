<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
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
    <mark>col_maps[grid_selection-1][i]['loaded'] += 1;</mark>
    <mark>load_count += 1;</mark>
}//end loop
<mark>load_counts[grid_selection-1] = load_count;</mark>

<mark>figure_height_list.sort(function(a,b){</mark>
    <mark>return b-a;</mark>
<mark>});</mark>
<?php
    require($root_directory."code_footer.html");
?>
