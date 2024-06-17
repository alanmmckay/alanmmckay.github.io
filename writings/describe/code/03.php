<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
window.onscroll = function(){
    inViewRange('image-tag-ID', '0 20%', '0 45%');
}
<?php
    require($root_directory."code_footer.html");
?>
