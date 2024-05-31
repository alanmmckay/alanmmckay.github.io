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
$json = file_get_contents("map.json");
$json_data = json_decode($json,true);
$json_data[$file_name] = array("status" =&gt; 0, "time" =&gt; time());
file_put_contents("map.json",json_encode($json_data));
<?php
    require($root_directory."code_footer.html");
?>
