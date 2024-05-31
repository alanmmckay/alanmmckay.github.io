<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
SELECT route_id, <mark>(dp).path[1]</mark> As path_index, ST_AsTEXT(<mark>(dp).geom</mark>) AS node
FROM (SELECT route_id, <mark>ST_DumpPoints(route) AS dp</mark> FROM cycling.activities) as segments;
<?php
    require($root_directory."code_footer.html");
?>
