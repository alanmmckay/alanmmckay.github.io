<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
INSERT INTO cycling.activities(
    activity_id,
    athlete_id,
    route_id,
    encoded_route,
    activity_type,
    location_country,
    start_date,
    start_date_local,
    timezone,
    user_id,
    route)
SELECT staging.activity_id,
        staging.athlete_id,
        staging.route_id,
        staging.encoded_route,
        staging.activity_type,
        staging.location_country,
        staging.start_date,
        staging.start_date_local,
        staging.timezone,
        u.user_id,
        <mark>(SELECT ST_AsEWKT(ST_LineFromEncodedPolyline(staging.encoded_route)))</mark>
            FROM cycling.activities_staging as staging
            JOIN cycling.athletes as u ON strava_athlete_id = athlete_id
;
<?php
    require($root_directory."code_footer.html");
?>
