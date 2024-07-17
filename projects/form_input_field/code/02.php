<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  = form_input_field :text_field, :user, :email, "Email", {:class => "form-control", :placeholder => "Your Email", :disabled => false}, {:class => "input-group-text"}
  = form_error_field :user, :email, {:class => "alert-danger input-group-text"}
<?php
    require($root_directory."code_footer.html");
?>
