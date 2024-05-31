<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
INSERT INTO cycling.traffic_vol (gid,route_id, aadt, aadt_year, effective_start_date,
effective_end_date,geom)
    SELECT distinct gid,route_id, aadt, aadt_year, effective_, effectiv_1,
    <mark>ST_Force2D(ST_Transform(geom,4326))</mark> FROM cycling.traffic_vol_staging WHERE <mark>effective_ is
    not null ORDER BY effective_ DESC;</mark>
<?php
    require($root_directory."code_footer.html");
?>
