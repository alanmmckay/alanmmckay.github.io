<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
$target_dir = 'uploads/';
$uploadOk = 1;

//Validate string form controls:
if(isset($_POST['hidden_file_name']) &amp;&amp; isset($_FILES['uploadImage']['name'])){
    if(strlen($_FILES['uploadImage']['name']) &lt;= 0 || strlen($_POST['hidden_file_name']) &lt;= 0){
        $uploadOk = 0;
    }else{
        $preg_result = preg_match("/\A([a-z0-9]+)\z/",$_POST['hidden_file_name']);
        if($preg_result == 0){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from altering hidden form.&lt;/div&gt;';
            $uploadOk = 0;
        }
    }

    if($uploadOk == 1){
        $file_name = $_POST['hidden_file_name'];
        $origin_file = $target_dir . basename($_FILES['uploadImage']['name']);
        $imageFileType = strtolower(pathinfo($target_dir . $origin_file,PATHINFO_EXTENSION));
        $target_file = $target_dir . $file_name  . "." . $imageFileType;
        $check = exif_imagetype($_FILES['uploadImage']['tmp_name']);
        $mimeType = image_type_to_mime_type($check);
    }
}else{
    $uploadOk = 0;
}
<?php
    require($root_directory."code_footer.html");
?>
