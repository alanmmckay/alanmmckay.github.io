<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
- model = :user
= form_tag users_create_path, {:class => 'card'} do
  %h2.card-header Please fill the following:
  %div.card-body
    %div.input-group
      = label_tag model.to_s+'_email', 'Email', {:class => "input-group-text"}
      = text_field model, :email, {:class => "form-control", :placeholder => "Your Email", :disabled => false}
    %div.input-group
      = label_tag model.to_s+'_password', 'Password', {:class => "input-group-text"}
      = text_field model, :password, {:class => "form-control", :placeholder => "Password", :disabled => false}
    %div.input-group
      = label_tag model.to_s+'_password_confirmation', 'Verify Password', {:class => "input-group-text"}
      = text_field model, :password_confirmation, {:class => "form-control", :placeholder => "Verify Password", :disabled => false}
    %br
    %div.input-group
      = label_tag model.to_s+'_fname', 'First Name', {:class => "input-group-text"}
      = text_field model, :fname, {:class => "form-control", :placeholder => "First Name", :disabled => false}
    %div.input-group
      = label_tag model.to_s+'_lname', 'Last Name', {:class => "input-group-text"}
      = text_field model, :lname, {:class => "form-control", :placeholder => "Last Name", :disabled => false}
    %div.input-group
      = label_tag model.to_s+'_phone', 'Phone Number', {:class => "input-group-text"}
      = text_field model, :phone, {:class => "form-control", :placeholder => "Phone Number", :disabled => false}
    %br
    %div.input-group
      = submit_tag 'Create Account', {:class => "btn btn-alternative", :type =>"submit", :disabled => false}

<?php
    require($root_directory."code_footer.html");
?>
