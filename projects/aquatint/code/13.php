<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
submit_process = function(filestring){
    document.getElementById("wait").style.visibility = "visible";
    setInterval(function(){
        query("&lt;?php echo $file_name;?&gt;");
    },3000);
}
<?php
    require($root_directory."code_footer.html");
?>
