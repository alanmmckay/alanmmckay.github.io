<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
window.onscroll = function(){
    if(display_counts[active_grid - 1] &lt;= load_counts[active_grid - 1] - active_grid){
        setTimeout(function(){
            <mark>grid_display_agent(active_grid);</mark>
            let base = load_counts[active_grid - 1];
            for(let i=1;i&lt;=max_column_size;i++){
                let is_not_active_column = i != active_grid;
                let has_less_loaded = load_counts[i-1] &lt; base;
                let is_multiple_of = (base % i) == 0;
                if(is_not_active_column && has_less_loaded && is_multiple_of){
                    while(load_counts[i-1] &lt;= base && load_counts[i-1] &lt; manifest_size){
                        <mark>grid_load_agent(i);</mark>
                    }
                }
            }
        }, (100 * active_grid));
    }
}
<?php
    require($root_directory."code_footer.html");
?>
