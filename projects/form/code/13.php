<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  - value = {}
  - if flash[:info] and flash[:info]["<mark>&lt;Model Attribute&gt;</mark>"]
    - value = {:value => flash[:info]["<mark>&lt;Model Attribute&gt;</mark>"]}
  = label_tag model.to_s+'_<mark>&lt;Model Attribute&gt;</mark>', '<mark>&lt;Natural Statement of attribute&gt;</mark>', {:class => "input-group-text"}
  = text_field model, :<mark>&lt;Model Attribute&gt;</mark>, {:class => "form-control", :placeholder => "<mark>&lt;Natural Statement of attribute&gt;</mark>", :disabled => false}.merge(value)
  - if (flash[:<mark>&lt;Controller Action&gt;</mark>] and flash[:<mark>&lt;Controller Action&gt;</mark>]["<mark>&lt;Model Attribute&gt;</mark>"])
    = label_tag model.to_s + '_<mark>&lt;Model Attribute&gt;</mark>', flash[:<mark>&lt;Controller Action&gt;</mark>]["<mark>&lt;Model Attribute&gt;</mark>"][0], {:class => "alert-danger input-group-text"}

<?php
    require($root_directory."code_footer.html");
?>
