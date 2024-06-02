<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
%section.container
  %h1= post.title
  %h2= post.subtitle
  .content
    = post.content

<?php
    require($root_directory."code_footer.html");
?>
