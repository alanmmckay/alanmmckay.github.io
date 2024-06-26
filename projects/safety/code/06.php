<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
CREATE TABLE cycling.activities
(
    activity_id BIGINT,
    athlete_id BIGINT,
    route_id varchar,
    encoded_route text COLLATE pg_catalog."default",
    activity_type char(8),
    location_country varchar,
    start_date timestamp,
    start_date_local timestamp,
    timezone varchar,
    user_id BIGINT,
    <mark>route geometry(linestring,4326),</mark>
    PRIMARY KEY(activity_id),
    CONSTRAINT fk_athlete
    FOREIGN KEY(user_id)
    REFERENCES cycling.athletes(user_id)
);
<?php
    require($root_directory."code_footer.html");
?>
