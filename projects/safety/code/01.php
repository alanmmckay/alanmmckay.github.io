<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
https://www.strava.com/oauth/authorize?client_id=&lt;CLIENT_ID&gt;response_type=code&amp;redirect_uri=&lt;APPLICATION_LOCATION&gt;/exchange_token&amp;approval_prompt=force&amp;scope=activity:&lt;SCOPE&gt;
<?php
    require($root_directory."code_footer.html");
?>
