<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
&lt;div class='form-group'&gt;
    &lt;input type='submit' value='Upload Image' name='submit' onclick="submit_process('&lt;?php echo $file_name; ?&gt;');" /&gt;
    &lt;p id='wait' style='visibility:hidden;'&gt;&lt;b&gt;Please wait...&lt;/b&gt;&lt;/p&gt;
&lt;/div&gt;
<?php
    require($root_directory."code_footer.html");
?>
