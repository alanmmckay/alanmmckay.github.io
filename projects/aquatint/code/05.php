<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
$target_file = $target_dir . $file_name  . "." . $imageFileType;
$check = exif_imagetype($_FILES['uploadImage']['tmp_name']);
$mimeType = image_type_to_mime_type($check);
<?php
    require($root_directory."code_footer.html");
?>
