<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  - value = {}
  - if flash[:values] and flash[:values][:email]
    - value = {:value => flash[:values][:email]}
  = label :user, :email, 'Email', {:class => "input-group-text"}
  = text_field :user, :email, {:class => "form-control", :placeholder => "Your Email", :disabled => false}.merge(value)
  - if (flash[:errors] and flash[:errors][:email])
    = label :user, :email', flash[:errors][:email][0], {:class => "alert-danger input-group-text"}
<?php
    require($root_directory."code_footer.html");
?>
