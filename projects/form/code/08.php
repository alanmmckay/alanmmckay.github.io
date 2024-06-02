<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
<mark>&lt;% model = :user %&gt;</mark>

<mark>&lt;%= form_tag users_create_path, {:class =&gt; 'card'} do %&gt;</mark>
  &lt;h2 class="card-header"&gt;Please fill the following:&lt;/h2&gt;
  &lt;div class="card-body"&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_email', 'Email', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :email, {:class =&gt; "form-control", :placeholder =&gt; "Your Email", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_password', 'Password', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :password, {:class =&gt; "form-control", :placeholder =&gt; "Password", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_password_confirmation', 'Verify Password', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :password_confirmation, {:class =&gt; "form-control", :placeholder =&gt; "Verify Password", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_fname', 'First Name', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :fname, {:class =&gt; "form-control", :placeholder =&gt; "First Name", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_lname', 'Last Name', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :lname, {:class =&gt; "form-control", :placeholder =&gt; "Last Name", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= label_tag model.to_s+'_phone', 'Phone Number', {:class =&gt; "input-group-text"} %&gt;</mark>
      <mark>&lt;%= text_field model, :phone, {:class =&gt; "form-control", :placeholder =&gt; "Phone Number", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class="input-group"&gt;
      <mark>&lt;%= submit_tag 'Create Account', {:class =&gt; "btn btn-alternative", :type =&gt;"submit", :disabled =&gt; false} %&gt;</mark>
    &lt;/div&gt;
  &lt;/div&gt;
<mark>&lt;% end %&gt;</mark>

<?php
    require($root_directory."code_footer.html");
?>
