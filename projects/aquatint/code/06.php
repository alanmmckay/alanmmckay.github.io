<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
$file_name = '';
for($i = 0; $i &lt;= rand(10,20); $i++){
    $new_ord = rand(87,122);
    if($new_ord &gt;= 97){
        $file_name = $file_name . chr($new_ord);
    }else{
        $file_name = $file_name . $new_ord;
    }
}
<?php
    require($root_directory."code_footer.html");
?>
