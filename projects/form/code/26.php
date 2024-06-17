<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  = create_form_input_field :text_field, :user, "email", "Email", {:class => "form-control", :placeholder => "Your Email", :disabled => false}, {:class => "input-group-text"}
  = create_form_error :user, "email", :login, {:class => "alert-danger input-group-text"}

<?php
    require($root_directory."code_footer.html");
?>
