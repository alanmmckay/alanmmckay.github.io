<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
<mark>&lt;% model = 'user' %&gt;</mark>

&lt;form class="card" action="<mark>&lt;%= users_create_path %&gt;</mark>" method="post"&gt;
  &lt;input id='authenticity_token' name='authenticity_token' type='hidden' value="<mark>&lt;%= form_authenticity_token %&gt;</mark>" /&gt;
  &lt;h2 class="card-header"&gt;Please fill the following:&lt;/h2&gt;
  &lt;div class="card-body"&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_email"&gt;Email&lt;/label&gt;
      &lt;input class="form-control" placeholder="Your Email" type="text" name="<mark>&lt;%= model %&gt;</mark>[email]" id="<mark>&lt;%= model %&gt;</mark>_email"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_password"&gt;Password&lt;/label&gt;
      &lt;input class="form-control" placeholder="Password" type="text" name="<mark>&lt;%= model %&gt;</mark>[password]" id="<mark>&lt;%= model %&gt;</mark>_password"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_password_confirmation"&gt;Verify Password&lt;/label&gt;
      &lt;input class="form-control" placeholder="Verify Password" type="text" name="<mark>&lt;%= model %&gt;</mark>[email]" id="<mark>&lt;%= model %&gt;</mark>_password_confirmation"&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_fname"&gt;First Name&lt;/label&gt;
      &lt;input class="form-control" placeholder="First Name" type="text" name="<mark>&lt;%= model %&gt;</mark>[fname]" id="<mark>&lt;%= model %&gt;</mark>_fname"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_lname"&gt;Last Name&lt;/label&gt;
      &lt;input class="form-control" placeholder="Last Name" type="text" name="<mark>&lt;%= model %&gt;</mark>[lname]" id="<mark>&lt;%= model %&gt;</mark>_lname"&gt;
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      &lt;label class="input-group-text" for="<mark>&lt;%= model %&gt;</mark>_phone"&gt;Phone Number&lt;/label&gt;
      &lt;input class="form-control" placeholder="Phone Number" type="text" name="<mark>&lt;%= model %&gt;</mark>[phone]" id="<mark>&lt;%= model %&gt;</mark>_phone"&gt;
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
