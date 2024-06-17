<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  - value = {}
  - if flash[:info] and flash[:info]["email"]
    - value = {:value => flash[:info]["email"]}
  = label_tag model.to_s+'_email', 'Email', {:class => "input-group-text"}
  = text_field model, :email, {:class => "form-control", :placeholder => "Your Email", :disabled => false}.merge(value)
  - if (flash[:login] and flash[:login]["email"])
    = label_tag model.to_s + '_email', flash[:login]["email"][0], {:class => "alert-danger input-group-text"}

<?php
    require($root_directory."code_footer.html");
?>
