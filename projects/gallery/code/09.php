<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
for(let i=0;i&lt;boundary;i++){
    //Grab the next image from the manifest:
    var reference = manifest[load_count];
    var new_figure_data = {
        'object':create_new_figure(reference['file_name'],{'border-top':'solid 25px white','opacity':0},reference['share_link'],grid_selection,load_count),
        'height': reference['height']
    };
    .
    .
    .
}
<?php
    require($root_directory."code_footer.html");
?>
