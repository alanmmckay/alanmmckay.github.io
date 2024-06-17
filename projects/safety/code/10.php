<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
SELECT crash.geom FROM cycling.crashes as crash, cycling.activities as activity
WHERE ST_DWithin(crash.geom,activity.route,0.01);
<?php
    require($root_directory."code_footer.html");
?>
