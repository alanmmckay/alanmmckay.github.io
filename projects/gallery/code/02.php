<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
grids_html = document.getElementById('galleries');
for(let i=0;i&lt;max_column_size;i++){
    const grid = document.createElement('div');
    grid.setAttribute('class','image-gallery');
    // TODO: Create a css class for the folowing properties:
    grid.style['display'] = 'grid';
    grid.style['grid-template-columns'] = 'repeat('+(i+1)+', minmax(0px,1fr))';
    grid.style['align-items'] = 'start';
    grid.style['height'] = '0px';
    grid.style['overflow'] = 'scroll';
    for(let j=0;j&lt;=i;j++){
        const column = document.createElement('div');
        column.setAttribute('class','image-col');
        column.style['display'] = 'grid';
        column.style['grid-template-columns'] = 'minmax(0px,1fr)';
        grid.appendChild(column);
    }
    grids_html.appendChild(grid);
}
delete grids_html;
<?php
    require($root_directory."code_footer.html");
?>
