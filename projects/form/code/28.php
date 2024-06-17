<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
- model = :user
= form_tag users_create_path, {:class => 'card'} do
  %h2.card-header Please fill the following:
  %div.card-body
    %div.input-group
      = create_form_input_field :text_field, model, "email", "Email", {:class => "form-control", :placeholder => "Your Email", :disabled => false}, {:class => "input-group-text"}
      = create_form_error model, "email", :login, {:class => "alert-danger input-group-text"}
    %div.input-group
      = create_form_input_field :password_field, model, "password", "Password", {:class => "form-control", :placeholder => "Password", :disabled => false}, {:class => "input-group-text"}
      = create_form_error model, "password", :login, {:class => "alert-danger input-group-text"}
    %div.input-group
      = create_form_input_field :password_field, model, "password_confirmation", "Verify Password", {:class => "form-control", :placeholder => "Verify Password", :disabled => false}, {:class => "input-group-text"}
      = create_form_error model, "password_confirmation", :login, {:class => "alert-danger input-group-text"}
    %br
    %div.input-group
      = create_form_input_field :text_field, model, "fname", "First Name", {:class => "form-control", :placeholder => "First Name", :disabled => false}, {:class => "input-group-text"}
      = create_form_error model, "fname", :login, {:class => "alert-danger input-group-text"}
    %div.input-group
      = create_form_input_field :text_field, model, "lname", "Last Name", {:class => "form-control", :placeholder => "Last Name", :disabled => false}, {:class => "input-group-text"}
      = create_form_error model, "lname", :login, {:class => "alert-danger input-group-text"}
    %div.input-group
      = create_form_input_field :text_field, model, "phone", "Phone Number", {:class => "form-control", :placeholder => "Phone Number", :disabled => false}, {:class => "input-group-text"}
    %br
    %div.input-group
      = submit_tag 'Create Account', {:class => "btn btn-alternative", :type =>"submit", :disabled => false}

<?php
    require($root_directory."code_footer.html");
?>
