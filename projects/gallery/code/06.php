<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
var load_count = load_counts[grid_selection-1];

//Check whether we've run out of images to load:
if(load_count &lt; manifest_size){
    .
    .
    .
}
<?php
    require($root_directory."code_footer.html");
?>
