<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  - value = {}
  - if flash[:info] and flash[:info]["&lt;Model Attribute&gt;"]
    - value = {:value => flash[:info]["&lt;Model Attribute&gt;"]}
  = label_tag <mark>&lt;Model&gt;</mark>.to_s+'_&lt;Model Attribute&gt;', '&lt;Natural Statement of attribute&gt;', <mark>&lt;Options for ActionView Helper&gt;</mark>
  = text_field <mark>&lt;Model&gt;</mark>, :&lt;Model Attribute&gt;, <mark>&lt;Options for ActionView Helper&gt;</mark>.merge(value)
  - if (flash[:&lt;Controller Action&gt;] and flash[:&lt;Controller Action&gt;]["&lt;Model Attribute&gt;"])
    = label_tag <mark>&lt;Model&gt;</mark>.to_s + '_&lt;Model Attribute&gt;', flash[:&lt;Controller Action&gt;]["&lt;Model Attribute&gt;"][0], <mark>&lt;Options for ActionView Helper&gt;</mark>

<?php
    require($root_directory."code_footer.html");
?>
