<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
### WITHIN /app/views/users/new.html.haml
%p #{puts self}
%p #{puts self.class.name}

<?php
    require($root_directory."code_footer.html");
?>
