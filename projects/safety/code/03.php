<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
http GET "https://www.strava.com/api/v3/athlete/activities" "Authorization: Bearer &lt;access token&gt;"
<?php
    require($root_directory."code_footer.html");
?>
