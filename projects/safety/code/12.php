<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
SELECT lp1.route_id, <mark>st_makeline(lp1.node, lp2.node)</mark> as line FROM <mark>list_points as lp1,
list_points as lp2</mark> WHERE lp2.path_index - lp1.path_index = 1 AND lp1.route_id = lp2.route_id;
<?php
    require($root_directory."code_footer.html");
?>
