<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
form_error_field(:user, :name)
# if flash[:errors] contains {:name =&gt; "Please input a valid name"} OR if flash[:errors] contains "Please input a valid name":
# =&gt; &lt;label for="user_name"&gt;Please input a valid name&lt;/label&gt;

form_error_field(:user, :name, { :class =&gt; "alert-danger"})
# if flash[:errors] contains {:name =&gt; "Please input a valid name"} OR if flash[:errors] contains "Please input a valid name":
# =&gt; &lt;label class="alert-danger" for="user_name"&gt;Please input a valid name&lt;/label&gt;

form_error_field(:user, :email, { style: "color:red;"}, :err_msg)
# if flash[:err_msg] contains {:email =&gt; "Please input a valid email"} OR if flash[:err_msg] contains "Please input a valid email":
# =&gt; &lt;label style="color:red;" for="user_email"&gt;Please input a valid email&lt;/label&gt;
<?php
    require($root_directory."code_footer.html");
?>
