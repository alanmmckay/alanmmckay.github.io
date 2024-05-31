<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
//Validate filetype:
if($uploadOk == 1 ){
    if($check !== false){
        //$uploadOk = 1;
        if($_FILES['uploadImage']['size'] &gt; 1048576){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Sorry, your file is too large.&lt;/div&gt;';
            $uploadOk = 0;
        }
    }else{
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; File is not an image.&lt;/div&gt;';
        $uploadOk = 0;
    }

    if( ($imageFileType != 'jpg') &amp;&amp; ($imageFileType != 'png') &amp;&amp; ($imageFileType != 'jpeg') &amp;&amp; ($imageFileType != 'gif') ){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Only jpg, jpeg, png, and gif files are allowed.&lt;/div&gt;';
        $uploadOk = 0;
    }else

    if( ($mimeType != 'image/gif') &amp;&amp; ($mimeType != 'image/jpeg') &amp;&amp; ($mimeType != 'image/png') ){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Only jpg, jpeg, png, and gif files are allowed.&lt;/div&gt;';
        $uploadOk = 0;
    }

}
<?php
    require($root_directory."code_footer.html");
?>
