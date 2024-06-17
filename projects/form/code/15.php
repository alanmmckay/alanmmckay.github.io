<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%div.input-group
  - value = {}
  - if flash[:info] and flash[:info]["&lt;Model Attribute&gt;"]
    - value = {:value => flash[:info]["&lt;Model Attribute&gt;"]}
  = label_tag &lt;Model&gt;.to_s+'_&lt;Model Attribute&gt;', '&lt;Natural Statement of attribute&gt;', &lt;Options for ActionView Helper&gt;
  = <mark>&lt;Helper Method&gt;</mark> &lt;Model&gt;, :&lt;Model Attribute&gt;, &lt;Options for ActionView Helper&gt;.merge(value)
  - if (flash[:&lt;Controller Action&gt;] and flash[:&lt;Controller Action&gt;]["&lt;Model Attribute&gt;"])
    = label_tag &lt;Model&gt;.to_s + '_&lt;Model Attribute&gt;', flash[:&lt;Controller Action&gt;]["&lt;Model Attribute&gt;"][0], &lt;Options for ActionView Helper&gt;

<?php
    require($root_directory."code_footer.html");
?>
