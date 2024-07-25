<?php

$canonical = 'https://alanmckay.blog/writings/form_input_field/';

$title = 'Alan McKay | Project | Ruby Gem: form_input_field';

$meta['title'] = 'Alan McKay | Ruby Gem: form_input_field';

$meta['description'] = 'Description of installation, usage, progress, and change-log of the form_input_field Ruby Gem for Rails; A gem which consolidates label and input element generation whilst maintaining values related to failed model validation.';

$meta['url'] = 'https://alanmckay.blog/projects/form_input_field/';

$relative_path = "../../";

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <header id='breadNav' class='writingNav' style='overflow:hidden;'>
                <h1 class='breadCurrent'><a href='./' class='currentLink'>&nbsp;&gt; form_input_field</a>
                <h1><a href='../'>&nbsp;&gt; Projects</a>
                <h1><a href='../../'>Home</a></h1>
            </header>
            <section class='domcode'>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            This page contains documentation pertaining to a Ruby Gem that I've created: <code>form_&shy;input_&shy;field</code>. This gem is an extension to <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code> within Ruby on Rails' <code>ActionPack</code> framework. <code>form_&shy;input_&shy;field</code> essentially wraps up functionality of maintaining values for forms to factor cases where a POST fails model validation. It also provides a means to succinctly produce relevant error messages for said failed validations.
                        </p>
                        <p>
                            Consider a simple form which is primarily defined by an HTML input element and its label:
                        </p>
                        <figure style='max-width:500px'>
                            <img src='./images/email_form_2.png'>
                        </figure>
                        <p>
                            Consider added functionality which presents a new label informing the user any errors discovered upon POST whilst also maintaining the value the user had previously submitted:
                        </p>
                        <figure style='max-width:500px'>
                            <img src='./images/email_form_3.png'>
                        </figure>
                        <p>
                            It's important to validate such fields on the server, even if JavaScript is doing this work on the front-end. Within Ruby on Rails, (using HAML), the logic may look like the following:
                        </p>
                        <figure class='code-figure'>
                            <iframe frameborder="0" style='width:100%;overflow:auto;max-height:295px' max-height='295' src='code/01.php'></iframe>
                            <figcaption></figcaption>
                        </figure>
                        <p>
                            This gem condenses the above into a more concise set of method calls:
                        </p>
                        <figure class='code-figure'>
                            <iframe frameborder="0" style='width:100%;overflow:auto;max-height:165px' max-height='165' src='code/02.php'></iframe>
                            <figcaption></figcaption>
                        </figure>
                        <p>
                            This makes a view much more clean and easier to digest at a glance.
                        </p>
                        <hr>
                        <p>
                            This gem was influenced by work done in a collaborative Ruby on Rails project. The goal was to abstract away code related to the front-end as much as possible in an effort to create a coding standard. Details pertaining to why and how can be found within the project writing within this website called <a href="../form/">Developing DRY Forms</a>.
                        </p>
                        <p>
                            The source code of this gem is found within its <a href="https://github.com/alanmmckay/form_input_field" target="_blank" rel="noopener noreferrer">GitHub repository</a>. The primary body of this project page will act as a hub for the documentation found within this repository where the contents of the <code>README</code> file and the <code>CHANGELOG</code> file will be presented in tandem with a checklist of current and future progress.
                        </p>
                        <p>
                            The location of the gem is on <a href="https://www.rubygems.org" target="_blank" rel="noopener noreferrer">RubyGems.org</a>, located here: <a href="https://rubygems.org/gems/form_input_field" target="_blank" rel="noopener noreferrer">https://&shy;ruby&shy;gems.org/&shy;gems/&shy;form_&shy;input_&shy;field</a>
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Ruby Gem - form_input_field</h1>
                    </header>
                    <h2>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per::Form&shy;In&shy;put&shy;Field</h2>
                    <h3>Installation</h3>
                    <p>
                        Add this line to your application's Gemfile:
                    </p>
                    <p>
                        - <code>&nbsp;gem 'form_input_field'&nbsp;</code>
                    </p>
                    <p>
                        And then execute:
                    </p>
                    <p>
                        - <code>&nbsp;$ bundle&nbsp;</code>
                    </p>
                    <p>
                        Or install it yourself as:
                    </p>
                    <p>
                        - <code>&nbsp;$ gem install form_&shy;input_&shy;field&nbsp;</code>
                    </p>
                    <h3>Usage</h3>
                    <p>
                        This gem places two helper methods into <a href='https://api.rubyonrails.org/classes/ActionView/Helpers/FormHelper.html' target="_blank" rel="noopener noreferrer">Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</a>. These methods are <code>form_input_field</code> and <code>form_error_field</code>.
                    </p>
                    <p>
                        These methods are described below. Examples of their usage are located in the Examples Section of this document.
                    </p>
                    <h4>form_input_field</h4>
                    <p>
                        <code>form_input_field</code> is an abstraction on the software pattern which encapsulates some input element and its label. Additionally, it has built in functionality which helps ensure the input element's value attribute is filled should the flash hash-map contain the presence of this value.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:110px' max-height='110' src='code/03.php'></iframe>
                    </figure>
                    <ul>
                        <li>
                            Outputs two html tags - a label HTML element pointing to its corresponding input HTML element. The term "input HTML element" here is ambiguous; it's not meant to be taken literally. "Input" in this context is meant to be interpreted as any output produced by the following list of helper functions within <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code>:
                            <ul>
                                <li> <!-- That comma is important ;) -->
                                    <i>color_field</i>, <i>date_field</i>, <i>datetime_field</i>, <i>datetime_local_field</i>, <i>email_field</i>, <i>file_field</i>, <i>hidden_field</i>, <i>month_field</i>, <i>number_field</i>, <i>password_field</i>, <i>phone_field</i>, <i>range_field</i>, <i>search_field</i>, <i>telephone_field</i>, <i>text_area</i>, <i>text_field</i>, <i>time_field</i>, <i>url_field</i>, <i>week_field</i>
                                </li>
                                <li>
                                    In addition to the above list of <code>Form&shy;Helper</code> method calls, <code>form_&shy;input_&shy;field</code> captures two special cases - <i>check_box</i> and <i>radio_button</i>. These are described later.
                                </li>
                            </ul>
                        </li>
                        <li>
                            The <code>helper_sym</code> argument describes the relevant helper method to be called. It expects the method name as a symbol. I.e., if one needs a call to <i>text_field</i>, pass <code>:text_field</code>; If one needs a call to <i>password_field</i>, supply a value of <code>:password_field</code>, etc.
                        </li>
                        <li>
                            The <code>object_name</code> and <code>method</code> arguments correspond to the equivalently named arguments as described in <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code>.
                        </li>
                        <li>
                            The <code>label_text</code> argument expects a string for the associated label of the generated input HTML element described by </code>helper_sym</code>. Supplying a false will instead not produce a label HTML element; an empty string is produced for the label.
                        </li>
                        <li>
                            The <code>options</code> argument corresponds to a hash-map representing the set of options to be passed with <code>helper_sym</code>; these are the options to be given to a method call from the above set of helper methods. Esentially a hash-map of html properties and attributes. I.e., <code>{:style => "color:red;"}</code>.
                        </li>
                        <li>
                            The <code>label_options</code> argument corresponds to a hash-map representing the set of options to be passed with the call to the label helper method from <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code>. Essentially a hash-map of html properties and attributes to be applied to the label. I.e., <code>{:style => "color:red;"}</code>.
                        </li>
                        <li>
                            The <code>value_key</code> argument is a symbol that acts as a key for the flash hash-map that contains the relevant value filled by the controller. If the value associated with said key within flash is a string, then the string will occupy the <code>value</code> attribute for the produced input HTML element. If it is a hash-map, it will then assume that the value given for method is the key to the string within this embedded hash-map. Consider the following example:
                            <ul>
                                <li style='text-align:start;'>
                                    For a view that contains the following call: <code style='display:inline-block;'>&nbsp;form_&shy;input_&shy;field :person, :name, "Please input a name: "&nbsp;</code>, the controller contains either <code style='display:inline-block;'>flash[:values] = params[:user][:name]</code> or <code style='display:inline-block;'>flash[:values] = params[:user]</code> when <code style='display:inline-block;'>User.new(params[:user][:name]).valid?</code> returns a false.
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <h4>:check_box helper_sym</h4>
                    <p>
                        When using the value of <code>:check_box</code> for <code>helper_sym</code>, the argument set is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:110px' max-height='110' src='code/04.php'></iframe>
                    </figure>
                    <ul>
                        <li>
                            The <code>checked_value</code> and <code>unchecked_value</code> arguments correspond to the value sent to the server upon post, dependent whether or not the check box is checked.
                        </li>
                        <li>
                            The other arguments are unchanged from their descriptions above.
                        </li>
                    </ul>
                    <h4>:radio_button helper_sym</h4>
                    <p>
                        When using the value of <code>:radio_button</code> for <code>helper_sym</code>, the argument set is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:110px' max-height='110' src='code/05.php'></iframe>
                    </figure>
                    <ul>
                        <li>
                            The <code>tag_value</code> argument corresponds to the value that will be sent to the server upon post, dependent whether or not the radio_button is selected.
                        </li>
                        <li>
                            The other arguments are unchanged from their descriptions above.
                        </li>
                    </ul>
                    <h4>form_error_field</h4>
                    <p>
                        <code>form_error_field</code> is an abstraction on the software pattern which encapsulates the presentation of a validation error. This produces a label HTML element which points to the originating input field. The text of the label is the error message associated with the failed validation. These errors are typically captured from the model by the controller and then sent to the view where this method call is enacted.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:100px' max-height='110' src='code/06.php'></iframe>
                    </figure>
                    <ul>
                        <li>
                            Outputs a label HTML tag whose textual value is located in the flash-hash map corresponding to <code>error_key</code>. If the value associated with said key is a string, then this string value will be used. If it is a hash-map, it will then assume that the value given for <code>method</code> is the key to the string within this embedded hash-map. Consider the following example:
                            <ul>
                                <li style='text-align:start'>
                                    For a view that contains the following call: <code style='display:inline-block;'>form_&shy;error_&shy;field :person, :name</code>, the controller contains either <code style='display:inline-block;'>flash[:errors] = @user.errors[:name]</code> or <code style='display:inline-block;'>flash[:errors] = @user.errors</code>, where <code>@user</code> is defined by <code style='display:inline-block;'>User.new(params[:user][:name])</code> and <code>User.valid?</code> returns a <code>false</code>.
                                </li>
                            </ul>
                        </li>
                        <li>
                            The <code>label_options</code> argument corresponds to a hash-map representing the set of options to be passed with the call to the label helper function from <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code>. Essentially a hash-map of html properties and attributes. I.e., <code>{:style => "color:red;"}</code>.
                        </li>
                    </ul>
                    <h3>Examples</h3>
                    <h4>form_input_field</h4>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:875px' max-height='875' src='code/07.php'></iframe>
                    </figure>
                    <h4>form_error_field:</h4>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:375px' max-height='375' src='code/08.php'></iframe>
                    </figure>
                    <h3>Finished Work</h3>
                    <ul>
                        <li>
                             Base definition of <code>form_input_field</code> such that its optional keyword arguments can be supplied in any order.
                        </li>
                        <li>
                             Base definition of <code>form_error_field</code> such that its optional keyword arguments can be supplied in any order.
                        </li>
                    </ul>
                    <h3>Future Work</h3>
                    <ul>
                        <li>
                            A mechanism to set flash key defaults.
                        </li>
                        <li>
                            Extend these helpers to be compatible with <code>Action&shy;View::Hel&shy;per&shy;s::Form&shy;Builder</code>.
                        </li>
                        <li style='text-align:start'>
                            Create function wrappers specific to the required <code>Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</code> method. I.e., <code style='display:inline-block;'>form_text_field(:model, :object_name)</code> which calls <code style='display:inline-block;'>form_&shy;input_&shy;field(&shy;:text_field, :model, :object_name)</code>
                        </li>
                    </ul>
                    <p>
                        Other avenues of future work will be listed in the <a href='https://github.com/alanmmckay/form_input_field/issues' target="_blank" rel="noopener noreferrer">issues</a> section of the repository
                    </p>
                    <section class='info'>
                        <hr>
                        <h3 id='id-changelog'>Change Log</h3>
                            <ul>
                                <li>
                                    <a href='https://rubygems.org/gems/form_input_field/versions/0.8.56' target="_blank" rel="noopener noreferrer"><b>0.8.56</b></a> - Fixed output error pertaining to concatenation of label string and input string for <code>form_input_field</code>. Inclusion of an initial suite of tests capturing the examples given in ActionView docs.
                                </li>
                                <li>
                                    <a href='https://rubygems.org/gems/form_input_field/versions/0.8.55' target="_blank" rel="noopener noreferrer"><b>0.8.55</b></a> - Initial push to RubyGems.org. Implementation of <code>form_input_field</code> and <code>form_error_field</code>. Implementation of a suite of tests with respect to an instantiation of an ActionView object.
                                </li>
                            </ul>
                        <hr>
                    </section>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <script src='../../js/project_functions.js?04'></script>
        <script>
            window.addEventListener('load', function(){setCodeSizeSliders(14)});
        </script>
    </body>
</html>

