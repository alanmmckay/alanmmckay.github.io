<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
function create_new_figure(file_name,init_style,vsco_url,source_grid,image_number){
    var anchor = document.createElement('a');
    anchor.setAttribute('target','_blank');
    anchor.setAttribute('rel','noopener noreferrer');
    anchor.setAttribute('href',vsco_url);

    var figure = document.createElement('figure');
    figure.style['border-top'] = init_style['border-top'];
    figure.style['opacity'] = init_style['opacity'];
    var id_string = source_grid+'-'+image_number;
    figure.id = 'figure-'+id_string;
    figure.setAttribute('loaded',false);

    var image = document.createElement('img');
    image.src = 'thumbnails/'+file_name;
    image.id = 'image-'+id_string;
    <mark>image.onload = function(){</mark>
        <mark>document.getElementById('figure-'+id_string).setAttribute('loaded',true);</mark>
    <mark>}</mark>

    figure.appendChild(image);
    anchor.appendChild(figure);
    return anchor;
}
<?php
    require($root_directory."code_footer.html");
?>
