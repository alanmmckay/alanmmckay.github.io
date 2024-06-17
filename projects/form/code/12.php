<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  <mark>- value = {}</mark>
  <mark>- if flash[:info] and flash[:info]["email"]</mark>
    <mark>- value = {:value => flash[:info]["email"]}</mark>
  = label_tag model.to_s+'_email', 'Email', {:class => "input-group-text"}
  = text_field model, :email, {:class => "form-control", :placeholder => "Your Email", :disabled => false}<mark>.merge(value)</mark>
  <mark>- if (flash[:login] and flash[:login]["email"])</mark>
    <mark>= label_tag model.to_s + '_email', flash[:login]["email"][0], {:class => "alert-danger input-group-text"}</mark>

<?php
    require($root_directory."code_footer.html");
?>
