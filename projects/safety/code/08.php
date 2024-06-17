<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
CREATE TABLE cycling.traffic_vol
(
    gid INT,
    route_id varchar,
    aadt BIGINT,
    aadt_year SMALLINT,
    effective_start_date date,
    effective_end_date date,
    geom geometry(multilinestring,4326),
    PRIMARY KEY(gid)
);
<?php
    require($root_directory."code_footer.html");
?>
