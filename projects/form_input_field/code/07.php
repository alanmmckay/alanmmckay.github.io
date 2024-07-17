<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
form_input_field(:password_field, :user, :password, "Enter Password")
# =&gt; &lt;label for="user_password"&gt;Enter Password&lt;/label&gt;&lt;input type="password" name="user[password]" id="user_password" /&gt;

form_input_field(:password_field, :user, :password)
# =&gt; &lt;input type="password" name="user[password]" id="user_password" /&gt;

form_input_field(:text_field, :login, :name, false, { :class =&gt; 'tag-class'})
# =&gt; &lt;input class="tag-class" type="text" name="login[name]" id="login_name" /&gt;

form_input_field(:text_area, :applicant, :statement, label_text: "Tell us why you're interested:", options: { :class =&gt; 'form-input' }, label_options: { style: "font-weight:bold;color:grey;"})
# =&gt; &lt;label style="font-weight:bold;color:grey;" for="applicant_statement"&gt;Tell us why you&#39;re interested:&lt;/label&gt;&lt;textarea class="form-input" name="applicant[statement]" id="applicant_statement"&gt;n&lt;/textarea&gt;

# The following three examples produce the same output:
form_input_field(:email_field, "user", "email", "Input Email", {:class =&gt; "form-control", :placeholder =&gt; "Your Email", :disabled =&gt; false}, {:class =&gt; "input-group-text"})
# =&gt; &lt;label class="input-group-text" for="user_email"&gt;Input Email&lt;/label&gt;&lt;input class="form-control" placeholder="Your Email" type="email" name="user[email]" id="user_email" /&gt;

form_input_field(:email_field, :user, :email, label_text: "Input Email", options: {:class =&gt; "form-control", :placeholder =&gt; "Your Email", :disabled =&gt; false}, label_options: {:class =&gt; "input-group-text"})
# =&gt; &lt;label class="input-group-text" for="user_email"&gt;Input Email&lt;/label&gt;&lt;input class="form-control" placeholder="Your Email" type="email" name="user[email]" id="user_email" /&gt;

form_input_field(:email_field, :user, :email, label_options: {:class =&gt; "input-group-text"}, options: {:class =&gt; "form-control", :placeholder =&gt; "Your Email", :disabled =&gt; false}, label_text: "Input Email")
# =&gt; &lt;label class="input-group-text" for="user_email"&gt;Input Email&lt;/label&gt;&lt;input class="form-control" placeholder="Your Email" type="email" name="user[email]" id="user_email" /&gt;"
#--- --- ---

form_input_field(:url_field, :user, :home_page)
# if flash[:values] contains {:home_page =&gt; "www.example.com"} OR if flash[:values] contains "www.example.com":
# =&gt; &lt;input value="www.example.com" type="url" name="user[home_page]" id="user_home_page" /&gt;

form_input_field(:url_field, :user, :home_page, value_key: :info)
# if flash[:info] contains {:home_page =&gt; "www.example.com"} OR if flash[:info] contains "www.example.com":
# =&gt; &lt;input value="www.example.com" type="url" name="user[home_page]" id="user_home_page" /&gt;
<?php
    require($root_directory."code_footer.html");
?>
