<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
Rails.application.routes.draw do
    .
    .
    .
    get 'users/new', to: 'users#new'
    post 'users/create', to: 'users#create'
    .
    .
    .
end
<?php
    require($root_directory."code_footer.html");
?>
