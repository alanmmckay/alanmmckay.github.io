<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
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
<?php
    require($root_directory."code_footer.html");
?>
