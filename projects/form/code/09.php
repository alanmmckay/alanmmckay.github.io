<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
&lt;section class="container"&gt;
  &lt;h1&gt;&lt;%= post.title %&gt;&lt;/h1&gt;
  &lt;h2&gt;&lt;%= post.subtitle %&gt;&lt;/h2&gt;
  &lt;div class="content"&gt;
    &lt;%= post.content %&gt;
  &lt;/div&gt;
&lt;/section&gt;

<?php
    require($root_directory."code_footer.html");
?>
