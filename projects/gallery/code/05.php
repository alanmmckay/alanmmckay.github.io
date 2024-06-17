<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
&lt;images&gt; ::= &lt;image_id&gt; &lt;images&gt; | ∅
&lt;image_id&gt; ::= {
    "upload_date": &lt;integer&gt;,
    "height": &lt;integer&gt;,
    "width": &lt;integer&gt;,
    "file_name": &lt;string&gt;,
    "share_link": &lt;string&gt;,
}
<?php
    require($root_directory."code_footer.html");
?>
