<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
curl -X POST https://www.strava.com/oauth/token \
-F client_id=&lt;CLIENT_ID&gt; \
-F client_secret=&lt;CLIENT_SECRET&gt; \
-F code=&lt;AUTHORIZATION_CODE&gt; \
-F grant_type=authorization_code
<?php
    require($root_directory."code_footer.html");
?>
