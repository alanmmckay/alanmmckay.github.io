<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
async function grid_display_agent(grid_selection){
    var load_flag = false;
    for(let i=0;i&lt;grid_selection;i++){
        let col = grids[grid_selection-1].children[i];
        let figures = col.getElementsByTagName('figure');

        for(let j=col_maps[grid_selection-1][i]['displayed'];j&lt;figures.length;j++){
            let figure = figures[j];
            if(isFigureBottom(figure)){
                <mark>let figureDisplayLambda = function(){</mark>
                    <mark>if(figure.getAttribute('loaded') == 'true'){</mark>
                        <mark>figure.style['opacity'] = 1;</mark>
                        <mark>figure.style['border-top'] = 'solid white 5px';</mark>
                    <mark>}else{</mark>
                        <mark>setTimeout(figureDisplayLambda,400);</mark>
                        <mark>}</mark>
                    <mark>}</mark>
                        <mark>figureDisplayLambda();</mark>
                load_flag = true;
                col_maps[grid_selection-1][i]['displayed'] += 1;
                display_counts[grid_selection-1] += 1;
            }else{
                load_flag = load_flag || false;
            }
        }
    }
    if(load_flag === true){
        setTimeout(function(){grid_load_agent(grid_selection)},(grid_selection * 100));
    }
}
<?php
    require($root_directory."code_footer.html");
?>
