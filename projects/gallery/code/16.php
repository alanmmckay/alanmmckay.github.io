<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
var isMobile = window.matchMedia || window.msMatchMedia;
isMobile = isMobile("(pointer:coarse)").matches;

var old_height = 0;
var initial_gallery_position;

window.addEventListener('load', function () {
    initial_gallery_position = document.getElementById('galleries').getBoundingClientRect().top;
    <mark>readjust_caller();</mark>
    grids[active_grid-1].style['overflow'] = 'inherit';
    grids[active_grid-1].style['height'] = 'inherit';
    grid_load_agent(active_grid);
    for(let i=1;i&lt;=max_column_size;i++){
        if(i != active_grid){
            grid_load_agent(i);
        }
    }
    old_height = window.innerHeight;
});

window.onresize = function(){
    <mark>readjust_caller();</mark>
    if(old_height &lt; window.innerHeight){
        grid_display_agent(active_grid);
    }
    old_height = window.innerHeight;
}
<?php
    require($root_directory."code_footer.html");
?>
