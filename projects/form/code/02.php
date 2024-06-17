<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
Rails.application.routes.draw do
    .
    .
    .
    get 'users/new', to: 'users#new'
    .
    .
    .
end
<?php
    require($root_directory."code_footer.html");
?>
