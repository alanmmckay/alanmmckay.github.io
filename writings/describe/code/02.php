<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
function inViewRange(elementID,inPosition,outPosition){
    element = document.getElementById(elementID);
    bounding = element.getBoundingClientRect();
    if ( ((window.innerHeight/2) - bounding.top > 0) && (bounding.top > 0) )
    {
        element.style['object-position'] = inPosition;
    } else{
        element.style['object-position'] = outPosition;
    }
}
<?php
    require($root_directory."code_footer.html");
?>
