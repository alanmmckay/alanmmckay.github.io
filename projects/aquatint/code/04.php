<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
$imageFileType = strtolower(pathinfo($target_dir . $origin_file,PATHINFO_EXTENSION));
<?php
    require($root_directory."code_footer.html");
?>
