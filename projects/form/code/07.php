<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
&lt;% model = 'user' %&gt;

&lt;form class="card" action="&lt;%= users_create_path %&gt;" method="post"&gt;
  &lt;input id='authenticity_token' name='authenticity_token' type='hidden' value="&lt;%= form_authenticity_token %&gt;" /&gt;
  &lt;h2 class="card-header"&gt;Please fill the following:&lt;/h2&gt;
  &lt;div class="card-body"&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_email"&gt;Email&lt;/label&gt;
      &lt;input class="form-control" placeholder="Your Email" type="text" name="&lt;%= model %&gt;[email]" id="&lt;%= model %&gt;_email"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_password"&gt;Password&lt;/label&gt;
      &lt;input class="form-control" placeholder="Password" type="text" name="&lt;%= model %&gt;[password]" id="&lt;%= model %&gt;_password"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_password_confirmation"&gt;Verify Password&lt;/label&gt;
      &lt;input class="form-control" placeholder="Verify Password" type="text" name="&lt;%= model %&gt;[email]" id="&lt;%= model %&gt;_password_confirmation"&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_fname"&gt;First Name&lt;/label&gt;
      &lt;input class="form-control" placeholder="First Name" type="text" name="&lt;%= model %&gt;[fname]" id="&lt;%= model %&gt;_fname"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_lname"&gt;Last Name&lt;/label&gt;
      &lt;input class="form-control" placeholder="Last Name" type="text" name="&lt;%= model %&gt;[lname]" id="&lt;%= model %&gt;_lname"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="&lt;%= model %&gt;_phone"&gt;Phone Number&lt;/label&gt;
      &lt;input class="form-control" placeholder="Phone Number" type="text" name="&lt;%= model %&gt;[phone]" id="&lt;%= model %&gt;_phone"&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class="input-group"&gt;
      &lt;input type="submit" name="commit" value="Create Account" class="btn btn-alternative"&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/form&gt;

<?php
    require($root_directory."code_footer.html");
?>
