<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
for(let i=0;i&lt;max_column_size;i++){
    col_map = [];
    for(let j=0;j&lt;(i+1);j++){
        col_map[j] = [];
        col_map[j]['loaded'] = 0;
        col_map[j]['displayed'] = 0;
    }
    col_maps.push(col_map);
}
<?php
    require($root_directory."code_footer.html");
?>
