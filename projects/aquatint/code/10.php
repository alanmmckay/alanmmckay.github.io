<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
$script = 'python3 aquatintScript.py "'.$target_file.'" '.$greycut.' '.$temperature.' '.$totalsweeps;
exec($script,$output,$result);
<?php
    require($root_directory."code_footer.html");
?>
