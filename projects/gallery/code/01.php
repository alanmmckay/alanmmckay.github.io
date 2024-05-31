<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
function isFigureBottom(fig_object){
    var fig_height = fig_object.getBoundingClientRect().height;
    var fig_top = fig_object.getBoundingClientRect().top;
    if((window.innerHeight * .95)-fig_top &gt; 0){
        return true;
    }else{
        return false;
    }
}
<?php
    require($root_directory."code_footer.html");
?>
