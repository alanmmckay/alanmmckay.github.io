<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
- model = :user
= form_tag users_create_path, {:class => 'card'} do
  %h2.card-header Please fill the following:
  %div.card-body
    %div.input-group
      - value = {}
      - if flash[:info] and flash[:info]["email"]
        - value = {:value => flash[:info]["email"]}
      = label_tag model.to_s+'_email', 'Email', {:class => "input-group-text"}
      = text_field model, :email, {:class => "form-control", :placeholder => "Your Email", :disabled => false}.merge(value)
      - if (flash[:login] and flash[:login]["email"])
        = label_tag model.to_s + '_email', flash[:login]["email"][0], {:class => "alert-danger input-group-text"}
    %div.input-group
      - value = {}
        - if flash[:info] and flash[:info]["password"]
          - value = {:value => flash[:info]["password"]}
      = label_tag model.to_s+'_password', 'Password', {:class => "input-group-text"}
      = text_field model, :password, {:class => "form-control", :placeholder => "Password", :disabled => false}.merge(value)
      - if (flash[:login] and flash[:login]["password"])
        = label_tag model.to_s + '_password', flash[:login]["password"][0], {:class => "alert-danger input-group-text"}
    %div.input-group
      - value = {}
        - if flash[:info] and flash[:info]["password_confirmation"]
          - value = {:value => flash[:info]["password_confirmation"]}
      = label_tag model.to_s+'_password_confirmation', 'Verify Password', {:class => "input-group-text"}
      = text_field model, :password_confirmation, {:class => "form-control", :placeholder => "Verify Password", :disabled => false}.merge(value)
      - if (flash[:login] and flash[:login]["password_confirmation"])
        = label_tag model.to_s + '_password_confirmation', flash[:login]["password_confirmation"][0], {:class => "alert-danger input-group-text"}
    %br
    %div.input-group
      - value = {}
        - if flash[:info] and flash[:info]["fname"]
          - value = {:value => flash[:info]["fname"]}
      = label_tag model.to_s+'_fname', 'First Name', {:class => "input-group-text"}
      = text_field model, :fname, {:class => "form-control", :placeholder => "First Name", :disabled => false}.merge(value)
      - if (flash[:login] and flash[:login]["fname"])
        = label_tag model.to_s + '_fname', flash[:login]["fname"][0], {:class => "alert-danger input-group-text"}
    %div.input-group
      - value = {}
        - if flash[:info] and flash[:info]["lname"]
          - value = {:value => flash[:info]["lname"]}
      = label_tag model.to_s+'_lname', 'Last Name', {:class => "input-group-text"}
      = text_field model, :lname, {:class => "form-control", :placeholder => "Last Name", :disabled => false}.merge(value)
      - if (flash[:login] and flash[:login]["lname"])
        = label_tag model.to_s + '_lname', flash[:login]["lname"][0], {:class => "alert-danger input-group-text"}
    %div.input-group
      - value = {}
        - if flash[:info] and flash[:info]["phone"]
          - value = {:value => flash[:info]["phone"]}
      = label_tag model.to_s+'_phone', 'Phone Number', {:class => "input-group-text"}
      = text_field model, :phone, {:class => "form-control", :placeholder => "Phone Number", :disabled => false}.merge(value)
    %br
    %div.input-group
      = submit_tag 'Create Account', {:class => "btn btn-alternative", :type =>"submit", :disabled => false}

<?php
    require($root_directory."code_footer.html");
?>
