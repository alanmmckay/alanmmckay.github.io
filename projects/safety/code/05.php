<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
CREATE TABLE cycling.activities_staging
(
    activity_id BIGINT,
    athlete_id BIGINT,
    route_id varchar,
    <mark>encoded_route text COLLATE pg_catalog."default",</mark>
    activity_type char(8),
    location_country varchar,
    start_date timestamp,
    start_date_local timestamp,
    timezone varchar,
    PRIMARY KEY(activity_id)
);
<?php
    require($root_directory."code_footer.html");
?>
