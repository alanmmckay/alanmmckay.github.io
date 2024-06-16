<?php

$canonical = 'https://alanmckay.blog/writings/flow/';

$title = 'Alan McKay | Project | placeholder';

$meta['title'] = 'Alan McKay | placeholder';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/projects/form/';

$relative_path = "../../";

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <header id='breadNav' class='writingNav' style='overflow:hidden;'>
                <h1 class='breadCurrent'><a href='./' class='currentLink'>&nbsp;&gt; placeholder</a>
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
                            This page discusses the motivations, development, and implementation of a new set of helper functions as a means to DRY out production of input forms. The task of DRYing components of a program should be intuitive for any developer. What sets this project apart is the usage of key features from the Ruby language to accomplish the task in an elegant manner.
                        </p>
                        <p>
                            The result of this project produces code that is easy for any developer to digest at a glance. These helper functions untangle both the logic required to persist input values between posts and the logic required to present error messages to a user. It essentially transforms code such as the following:
                        </p>
                        <br>
                        <figure class='code-figure'>
                            <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/25.php'></iframe>
                            <figcaption>A Ruby on Rails view template built using HAML.</figcaption>
                        </figure>
                        <br>
                        <p>
                            ...into something easier to implement and more informative at a glance:
                        </p>
                        <br>
                        <figure class='code-figure'>
                            <iframe frameborder="0" style='width:100%;overflow:auto;max-height:190px' max-height='190' src='code/26.php'></iframe>
                            <figcaption>A Rails view template which produces the same markup as the prior figure.</figcaption>
                        </figure>
                        <br>
                        <p>
                            This documentation describes the thought process of determining which pieces of the originating code can be abstracted into a function or set of functions. This begins with a brief discussion of the Rails framework and then transitions into the process of generalization. Using the generalized terms, the relevant methods are built and their components discussed.
                        </p>
                        <p>
                            Through this documentation, code blocks are given. Some code blocks have highlighted sections. These highlighted snippets emphasize the point being made within the textual content currently being discussed. This may be further emphasized within a code block's caption.
                        </p>
                        <p>
                            Care was taken to correctly use terms to a point of pedantry. Sometimes, this care was not enough to prevent potential confusion. For example, it may be hard to discern what is being conveyed in the statement, "The correct value is assigned to the value attribute." To help make this digestible, any term that refers to some literal code string will be marked up using a set of code-blocks. These terms will appear to the reader in a font type that looks mechanical.
                        </p>
                        <blockquote>
                            The correct value is assigned to the <code style='background-color:#f7f7f7'>value</code> attribute.
                        </blockquote>
                        <p>
                            Some of the code strings that are embedded within textual content are quite long. Because of this, a word wrap needs to occur within these strings to ensure that this page can be viewed on a wide range of device sizes. This will introduce a hyphen within these strings. Be wary of this; any code reference within a paragraph of textual content does not actually include the hyphen character.
                        </p>
                        <!--<p>
                            The table of contents for this page is as follows:
                        </p>
                        <ul>
                            <li>Ruby on Rails - Developing DRY forms
                                <ul>
                                    <li>Framework Context
                                        <ul>
                                            <li>Building a Template
                                                <ul>
                                                    <li>Introducing Rails Helpers</li>
                                                    <li>Introducing HAML</li>
                                                </ul>
                                            </li>
                                            <li>Extending Functionality

                                            </li>
                                        </ul>
                                    </li>
                                    <li>Developing New Form Helpers
                                        <ul>
                                            <li>Generalizing calls to Action&shy;View::Hel&shy;p&shy;ers</li>
                                            <li>Extracting generalized values into implementation</li>
                                            <li>Factoring more helpers from Action&shy;View::Hel&shy;p&shy;ers
                                                <ul>
                                                    <li>Valid and invalid symbols for create_&shy;form_&shy;input_&shy;field</li>
                                                    <li>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Tag&shy;Helper</li>
                                                    <li>Helpers expecting a collection</li>
                                                </ul>
                                            </li>
                                            <li>Helpers expecting error handling</li>
                                        </ul>
                                    </li>
                                    <li>Using the new form helpers</li>
                                </ul>
                            </li>
                        </ul>-->
                    <hr>
                    </section>
                    <header>
                        <h1>Ruby on Rails - Developing DRY forms</h1>
                    </header>
                    <h2>Framework Context</h2>
                    <p>
                        The Rails framework for Ruby acts as a layer of abstraction to help expedite the development process of building web applications which use the Model-View-Controller software pattern. It takes a programming-by-convention approach where the mere existence of a given object will infer the existence of some other object or subroutine without the developer's explicit definition. These implicit connections are often scaffolded by a generative commands within the framework where a developer can declare a model or controller name and the framework stubs the required files and routes for the framework to operate on.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:95px' max-height='95' src='code/01.php'></iframe>
                        <figcaption>Example of a scaffold command.</figcaption>
                    </figure>
                    <p>
                        The usage of these commands, (and the subsequent stubbing of files), does not necessarily expose the implicit logic. A good example of this is in creating some model and a declaration of some route for said model will create the ability to use an implicit variable that acts as a URL path for some action to take. Generically, if some <code>&lt;model&gt;</code> exists, and a <code>&lt;route&gt;</code> for the model is declared in the routes configuration file, the framework allows a developer to leverage a name reference of <code>&lt;model&gt;_&lt;route&gt;_path</code> which which can be used elsewhere. An example is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:305px' max-height='305' src='code/02.php'></iframe>
                        <figcaption>Declaration of a route within <code>config/routes.rb</code>.</figcaption>
                    </figure>
                    <br>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:255px' max-height='255' src='code/03.php'></iframe>
                        <figcaption>Usage of implicit <code>users_new_path</code> within a view.</figcaption>
                    </figure>
                    <hr>
                    <p>
                        This programming-by-convention approach requires a developer to be keen on the existence of these implications; It requires a developer to be keen on how these implications effect and scaffold features of the framework.
                    </p>
                    <p>
                        Deciding to generate a model where the developer gives a name that's plural is a case where convention can cause pain. Consider the prior usage of <code>users_create_path</code>. When the <code>User</code> model was generated, the singular form of the noun was given. From it, Rails used the plural form of the noun to build a controller and a view. What occurs when the plural of user is given during generation? While pondering this question, the reader is invited to look into the <code>--force-plural</code> flag for the <code>rails generate</code> command whilst also considering the <a href='https://api.rubyonrails.org/classes/ActiveSupport/Inflector/Inflections.html' target="_blank" rel="noopener noreferrer"><code>Active&shy;Support::Inf&shy;lect&shy;or::Inf&shy;lect&shy;ions</code></a> class.
                    </p>
                    <p>
                        A team which is aware of these conventions can be very efficient. A team which is not can lead to a heap of problems. This necessitates clear communication and documentation. Sometimes, communication and documentation alone aren't sufficient. In these cases, another layer of abstraction can be introduced to make the development process even easier.
                    </p>
                    <p>
                        The "view" in Model-View-Controller is a means to untangle the output of front-end markup from controller logic. An alternative to leveraging a view template would be to intersperse output statements, (likely via the print call), within the controller itself. This likely cannot be done within the Rails framework as it would break the expected convention. Thus, this would be implemented within a ruby script that has some other access to some database component/abstraction. This software pattern is commonly referred to as Model-View-View-Model (MVVM).
                    </p>
                    <p>
                        When it comes to producing a templates, Rails opts to leverage a declared route and subsequent action to present a view whilst interacting with a model. The default template format is <code>ERB</code> (Embedded Ruby). An <code>ERB</code> file allows a developer to place normal HTML expressions. Any dynamic logic that needs to be generated from Ruby scripting is placed between a set of special tags:
                    </p>
                    <blockquote>
                        Within an <code>ERB</code> template, Ruby code can be included using both <code>&lt;% %&gt;</code> and <code>&lt;%= %&gt;</code> tags. The <code>&lt;% %&gt;</code> tags are used to execute Ruby code that does not return anything, such as conditions, loops, or blocks, and the <code>&lt;%= %&gt;</code> tags are used when you want output. <cite> - <a href='https://guides.rubyonrails.org/action_view_overview.html' target="_blank" rel="noopener noreferrer">Action View Overview - Rails Guides</a>
                    </blockquote>
                    <h3>Building a Template</h3>
                    <p>
                        Consider a registration form for a web app. The information submitted through this form is applied to a <code>User</code> model. This is established through the <code>UsersController</code> by taking the new action. The model, controller, and route are all declared as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:820px' max-height='820' src='code/04.php'></iframe>
                        <figcaption>Full definition of a <code>User</code> model within <code>app/models/user.rb</code>.</figcaption>
                    </figure>
                    <br>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1270px' max-height='1270' src='code/05.php'></iframe>
                        <figcaption>Partial definition of the <code>UsersController</code> within <code>app/&shy;controllers/&shy;users_&shy;controller&shy;.rb</code>.</figcaption>
                    </figure>
                    <br>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:335px' max-height='335' src='code/06.php'></iframe>
                        <figcaption>Introduction of <code>users_create_path</code> within <code>config/routes.rb</code>.</figcaption>
                    </figure>
                    <p>
                        The controller action operates on a hash map arbitrarily called <code>info</code>. <code>info</code> is filled by a method called <code>user_params</code>. Here, the <code>require</code> and <code>permit</code> methods are chained to produce a one dimensional hash-map which contains a set of keys associated with the symbols provided in the <code>permit</code> method. Both the <code>require</code> and <code>permit</code> methods include validation features abstracted away from the developer of the view, in addition to the production of the hash-maps used within the action controller.
                    </p>
                    <p>
                        These chained methods assume the existence of a hash-map of a certain structure. This hash-map reflects what is posted to the controller action. Based on these method calls and the <code>user</code> model, it can be assumed that a user's email, password, a password confirmation, first name, last name, and phone number should be posted through an HTML form. The Rails framework expects the posted form data to be in a hash-map within <code>params[:user]</code>. <code>params</code> contains all post information, which can encapsulate information pertaining to different models. An input field which posts to <code>&lt;model&gt;[&lt;attribute&gt;]</code> will be placed into <code>params[:&lt;model&gt;][:&lt;attribute&gt;]</code>. Knowing this, an initial template can be built.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1085px' max-height='1085' src='code/07.php'></iframe>
                        <figcaption>Initial ERB template contained within <code>app/views/users/new.erb</code>. This was built with respect to some of the model properties established in the <code>User</code> model.
                    </figure>
                    <p>
                        The template above is the view which will be presented should the <code>new</code> controller action be invoked. Submission of this form will invoke the <code>create</code> controller action through an HTTP post. This template is close to minimum in terms of explicitly interacting with the Rails framework. These interactions are highlighted, and can also be noticed by the usage of the <code>&lt;% %&gt;</code> tags.
                    </p>
                    <p>
                        The decision to use a variable to represent the <code>model</code> name is a weak contingency for the case in which the model's name is changed, (via a migration, for example). This allows a maintainer of this view to quickly adapt to the change by having a single entry point of value designation. Using this category of value declaration is an early lesson to learn both in the study of Computer Science and coding which serves as a starting point to transition into more elaborate means of DRYing out this code.
                    </p>
                    <p>
                        Two other values are being output into this form via evaluation of some Ruby expression. The general concept of <code>users_create_path</code> has been discussed within the context section. The value of <code>form_authenticity_token</code> is assigned by the Rails framework and is required for validating the session state of a visitor to the website.
                    </p>
                    <h4>Introducing Rails Helpers</h4>
                    <p>
                        The natural evolution of this template will introduce the usage of built-in helpers such as those included in <code><a href='https://api.rubyonrails.org/classes/ActionView/Helpers.html' target="_blank" rel="noopener noreferrer">Action&shy;View::Helpers</a></code>. Specifically, the <code>FormHelper</code> and <code>FormTagHelper</code> namespaces. Specifically <code>form_tag</code>, <code>label_tag</code>, <code>text_field</code>, and <code>password_field</code> are used.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1060px' max-height='1060' src='code/08.php'></iframe>
                        <figcaption>Prior view template which has had certain HTML elements replaced with helper methods that are defined within the Rails framework. These are highlighted in addition to a change in the datatype assigned to the <code>model</code> variable.
                    </figure>
                    <p>
                        The <code>form_tag</code> helper puts into place the <code>&lt;form&gt;</code> opening and closing tags while also placing a couple of hidden <code>input</code> fields which take care of the session token authentication previously discussed. The <code>label_tag</code> helper creates a relevant set of <code>&lt;label&gt;</code> tags while the <code>text_field</code> and <code>password_field</code> helpers create a relevant set of <code>input</code> tags whose <code>type</code> attributes are set to text and password, respectively. It should be observed that the initial assignment of <code>model</code> has been turned into a <code>symbol</code> as a means to adhere to the conventions set place within the documentation of these methods. That is, <code>text_field</code> and <code>password_field</code> both expect a <code>symbol</code> to be supplied as an argument for their <code>object</code> and <code>method</code> parameters. This is contrary to the <code>label_tag</code> helper which expects a <code>string</code>.
                    </p>
                    <p>
                        The <code>object</code> parameter for these <code>_field</code> helpers refer to the object in which the view presumably exists. In this case, it's the <code>User</code> object. The <code>method</code> parameter refers to the attribute in which the input will be applied. The term <code>method</code> refers to the mutator/accessor method which will be invoked upon submission of the form. Note that the <code>name</code> attribute of the resultant HTML element will maintain the form of <code>&lt;model&gt;[&lt;attribute&gt;]</code>; the output of this updated template will be the same as that was output from the first naively built template!
                    </p>
                    <p>
                        What is the advantage of using these helpers? They begin to abstract away the syntax required of HTML. One needs not worry about closing open HTML tags for each call to these helpers. Possible mistakes of typing a tag's set of attributes and their values are mitigated; no longer does a developer need to type out <code>class="..."</code>, <code>placeholder="..."</code>, <code>for="..."</code>, <code>id="..."</code>, etc. The aspects of markup that are important, such as assigning a class to an element, are isolated for the developer as an argument to the relevant helper.
                    </p>
                    <h4>Introducing HAML</h4>
                    <p>
                        The above approach doesn't completely eliminate these syntactic aspects. The template includes a set of <code>div</code> and header tags, (i.e., <code>h1</code> and <code>h2</code>), that are vulnerable to being opened but not closed. The helper methods themselves need to be enclosed in a set of tags which act as a mechanism for the <code>ERB</code> template to know that a Ruby expression should be evaluated. How can these HTML elements be abstracted away?
                    </p>
                    <p>
                        Luckily, such a technology already exists. <a href="https://haml.info/" target="_blank" rel="noopener noreferrer">HAML</a> was created precisely for these reasons:
                    </p>
                    <figure class='code-figure'>
                        <div class='adjacentcodeframes'>
                            <iframe frameborder="0" style='overflow:auto;max-height:280px' max-height='280' src='code/09.php'></iframe>
                            <iframe frameborder="0" style='overflow:auto;max-height:280px' max-height='280' src='code/10.php'></iframe>
                        </div>
                        <figcaption>
                            Both these code blocks produce the same content. The <code>HAML</code> block (second) is more concise than the <code>ERB</code> block (first).
                        </figcaption>
                    </figure>
                    <p>
                        HAML stands for HTML Abstraction Markup Language. Usage of HAML using Ruby on Rails requires its gem to be bundled with the project. Doing so will allow a controller to route to a view whose extension is <code>.html.haml</code> instead of <code>.html.erb</code>. Here, the markup abstractions can be leveraged to clean up a view's code and to prevent common mistakes that come from code reuse of literal strings. Converting the template to HAML will produce the following template:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:795px' max-height='795' src='code/11.php'></iframe>
                    </figure>
                    <figcaption>A more concise <code>HAML</code> view template.</figcaption>
                    <hr>
                    <h3>Extending Functionality</h3>
                    <p>
                        A key part of the model used in these examples is that some facet of the value placed in the HTML input needs to be true in order for a post to succeed. That is, server-side validation is in in place for certain attributes of the model.
                    </p>
                    <p>
                        The helper functions provided through <code>Action&shy;View::Helpers</code> do not account for this. It is up to the developer to check for these cases where an invalid post is made. The developer also needs to decide if and how to provide the feedback that a breach of validation has occurred.
                    </p>
                    <p>
                        The required feedback manifests itself in two ways. The first is that an error message should be presented informing the user what went wrong. These messages are declared within the model's class. Using the controller, the message should be placed into the <code>flash</code> hash-map whenever a violation occurs. Which key each message is associated with is up to the developer and is defined within the relevant controller action. In the example of the <code>create</code> controller action, <code>flash</code> is occupied dependent on whether or not <code>@user.valid?</code> returns <code>true</code>. In the case where it returns <code>false</code>, <code>@user.errors</code> is placed into <code>flash[:login]</code>. The schema of <code>@user.errors</code> is <code>{:&lt;model attribute&gt; =&gt; &lt;error message&gt;, ... }</code>.
                    </p>
                    <p>
                        The other facet where feedback manifests itself is by repopulating input elements with the values the visitor had previously placed. For example, if a visitor who is registering tries to post a form where their password fields don't match, it would be annoying if they were presented with a blank form where they need to retype their email, first name, last name, and phone number.
                    </p>
                    <p>
                        A look at the <code>create</code> controller action informs us that this information is grabbed from a call to <code>user_params</code>. The resultant hash map is placed into <code>flash[:info]</code> and can be used to repopulate an input tag's value attribute.
                    </p>
                    <p>
                        In order to present these two tiers of feedback requires a set of conditionals to determine whether or not these values need to be placed. Consider the input associated with the email property of the <code>User</code> model:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/12.php'></iframe>
                        <figcaption> Introduction of validation logic. The first group of highlighted lines ensures the value previously submitted is maintained within the form. The last group of highlighted lines is responsible for displaying an error message related to the failed validation.</figcaption>
                    </figure>
                    <p>
                        The first three highlighted lines denote the logic of occupying an input element's value attribute. Observe the <code>merge</code> method in use within the <code>text_field</code> helper which merges the <code>value</code> hash-map with the hash-map that is initially being supplied as an argument to the helper's option parameter. Usage of a hash-map for <code>value</code> allows the case where an empty hash-map is evaluated by Rails which will be recognized as a <code>nil</code> and thus not set the HTML elements's <code>value</code> attribute. This is contrary to the potential behavior of supplying an empty string which may visually override the placeholder's value with said empty string.
                    </p>
                    <p>
                        The last two highlighted lines denote the logic of displaying an error message. This occurs inline as per the bootstrap classes being used whilst being placed in the parent <code>div</code> element. That is, the <code>label</code> HTML element produced from the initial <code>label_tag</code> helper, the <code>input</code> HTML element produced from the <code>text_field</code> helper, and the optional <code>label</code> HTML element produced from the second <code>label_tag</code> helper are placed in the same container horizontally. Both of these <code>label</code> tags point to the same <code>input</code> tag, allowing a user to select either to place the cursor into the relevant <code>input</code> form.
                    </p>
                    <figure>
                        <img src='images/email01.png' style='max-width:430px;border:solid #f0f0f0 1px;'/>
                        <div style='max-width:430px; margin:auto; padding-left:20px;'>
                            <p style='text-align:start'>
                                <b>POST</b> upon entering test#example.com:
                            </p>
                        </div>
                        <img src='images/email02.png' style='max-width:430px;border:solid #f0f0f0 1px;'/>
                        <figcaption>
                            Top image is the production of the two <code>ActionView</code> helpers: <code>label_tag</code> and <code>text_field</code>, in addition to the <code>submit_tag</code> and <code>form_tag</code>. The bottom image reflects the result of a form submission with invalid data being supplied. Take extra note that the invalid value of <i>test#example.com</i> is maintained after submission post.
                        </figcaption>
                    </figure>
                    <p>
                        The inclusion of this logic introduces 5 new lines of code for each <code>input</code> element required of the form. This can balloon in size for forms which require a larger quantity of <code>input</code> tags. For the template that has been pieced together on this page, this would require a total of 30 new lines of code. This presents an opportunity to DRY out this code by introducing a new set of helper methods.
                    </p>
                    <hr>
                    <h2>Developing New Form Helpers</h2>
                    <h3>Generalizing calls to ActionView::Helpers</h3>
                    <p>
                        It's surprising the HTML pattern of bundling label and input elements isn't addressed within the Rails framework. A lot of effort is put in the framework to abstract away these type of details. The <code>Action&shy;View::Helpers</code> namespace is good evidence of this.
                    </p>
                    <p>
                        Let's consider the case in which a developer wants to create a form input element and its associated label. Also consider the prior code-block example in which an input and its label is created for the email attribute of the <code>User</code> model. Generalizing this code will help expose patterns which will make it easy to DRY:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/13.php'></iframe>
                        <figcaption>
                            Beginning the process of abstracting common traits from the behaviors of the view logic.
                        </figcaption>
                    </figure>
                    <p>
                        The first surface-level observation of this generalized code is that a <code>&lt;Model Attribute&gt;</code> is a common element between the <code>text_field</code> helper and the <code>label_tag</code> helper. Peering past the surface, it is less obvious that the value assigned to <code>model</code> is another commonality between the two. This is less obvious simply because it's not highlighted in the code above.
                    </p>
                    <p>
                        Both of the <code>ActionView</code> helpers also contain a <code>&lt;Natural Statement of Attribute&gt;</code>. These represent some string which a visitor can read. These are not necessarily the same strings, thus should be considered distinct from each other.
                    </p>
                    <p>
                        Another piece of generalization involves the <code>&lt;Controller Action&gt;</code> access within the flash hash-map. A glance will lead a reader of this code to believe that the notion of a controller action is only associated with the case where an error message needs to be output. A look at the controller which fills the hash-map will disprove this claim. The controller action is filling two values within the hash-map. Both <code>:login</code> and <code>:info</code>.
                    </p>
                    <p>
                        Furthermore, the <code>value</code> property of the HTML <code>input</code> element could be manipulated by JavaScript if need be. The fact that <code>value</code> is handled similarly to a nullable object where it is merged to the option parameter of <code>text_field</code> allows this namespace, (within the <code>flash</code> hash-map), to technically be exclusive from any controller action. If this were a namespace which adheres to a more general convention leveraged by Rails, it would realistically be labeled something like <code>:values</code> instead of <code>:info</code>.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/14.php'></iframe>
                        <figcaption>
                            Continuing the process of abstraction.
                        </figcaption>
                    </figure>
                    <p>
                        One more abstraction can be made. Each call to a <code>ActionView</code> helper allows an argument of some set of options. These options are received as a hash-map where each key represents some property of the helper. These are typically HTML attributes, such as an element's style attribute. Both <code>ActionView</code> helpers in this context may require a different set of options which requires distinction.
                    </p>
                    <p>
                        To begin developing a new helper, the production of an HTML input element and its direct label element will be isolated from a potential error message being produced by an access to <code>flash[:&lt;Controller Action&gt;]</code>. This means that the first helper method will require a <code>&lt;Model&gt;</code>, <code>&lt;Model Attribute&gt;</code>, <code>&lt;Natural Statement for Attribute&gt;</code>, <code>&lt;Options for ActionView Helper&gt;</code>, <code>&lt;Options for ActionView Label&gt;</code>.
                    </p>
                    <p>
                        It should be observed that <code>&lt;Options for ActionView Helper&gt;</code> is more generic than <code>&lt;Options for ActionView Label&gt;</code>. We've derived the more generic <code>&lt;ActionView Helper&gt;</code> from a call to the <code>text_field</code> method. Using the example of the template built thus far, a call to the <code>password_field</code> method is also used. Indeed, a wider set of methods should be allowed. This implies one last abstraction:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/15.php'></iframe>
                        <figcaption>The final significant piece of generalization. Observing that the helper method's name can be abstracted.</figcaption>
                    </figure>
                    <h3>Extracting generalized values into implementation</h3>
                    <p>
                        Each <code>&lt;Helper Method&gt;</code> will ultimately be derived from <code><a href='https://api.rubyonrails.org/classes/ActionView/Helpers/FormHelper.html' target="_blank" rel="noopener noreferrer">Action&shy;View::Hel&shy;per&shy;s::For&shy;m&shy;Hel&shy;per</a></code>. Specifically, those with the <code>_field</code> suffix. This will manifest itself in the namespace of <code>Application&shy;Helper::create_&shy;form_&shy;input_&shy;field</code> within <code>app/&shy;helpers/&shy;application_&shy;helper&shy;.rb</code>. Considering the generalization process in the previous section, the implementation of the new helper method is defined as such:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:850px' max-height='850' src='code/16.php'></iframe>
                        <figcaption>
                            The almost complete <code>create_&shy;form_&shy;input_&shy;field</code> helper method developed within <code>app/&shy;helpers/&shy;application_helper&shy;.rb</code>. Missing logic is highlighted.
                        </figcaption>
                    </figure>
                    <p>
                        Initially, <code>StandardError</code> is extended to help inform a developer if an invalid symbol was provided as an argument. Whether or not this error is flagged hinges on the evaluation of the helper's first parameter - <code>helper_sym</code>. This evaluation occurs through a call to the <code>suffix?</code> method to determine whether the <code>field</code> suffix is being used, as noted prior.
                    </p>
                    <p>
                        The helper <code>create_&shy;form_&shy;input_&shy;field</code> initially receives a symbol to represent the name of the <code>ActionView</code> helper that needs to be called. The next two parameters adhere to the parameter naming convention of the <code>_field</code> methods established within <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Helper</code>. The <code>object</code> parameter correlates to a view's model and the <code>method</code> parameter correlates to a model's attribute.
                    </p>
                    <p>
                        Near the end of the helper function, the <code>label_tag</code> helper is called to create the HTML string representative of the label element. The resultant string is assigned to a local variable. An inexperienced Ruby developer may struggle here in terms of knowing how to invoke the required helper represented by <code>helper_sym</code>. <i>This is where the beauty of Ruby as a programming language comes into play.</i>
                    </p>
                    <p>
                        A key to understanding how to solve this problem is that everything in Ruby is an object. <b>Everything</b>. Literals are objects. Class definitions are objects. More importantly, syntactic abstractions are object method calls. For example, using the assignment operator is transcribed to an invocation of that object's mutator method.
                    </p>
                    <p>
                        Invocation of an object's method is an abstraction on providing that object's <code>send</code> method the symbol of the method that needs to be called! This is a bit wordy, but is easy to understand through an example: The expression <code>"Hello" + "World!"</code> is equivalent to <code style='hyphenate-character: ""'>"Hello".&shy;+("World!")</code> which is also equivalent to <code style='hyphenate-character: ""'>"Hello".&shy;send(:+, "World!")</code>. This allows the implementation of a method which allows a caller to ask some object to invoke some unknown method. In the context of <code>create_&shy;form_&shy;input_&shy;field</code>, this allows for the following expression:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:120px' max-height='120' src='code/17.php'></iframe>
                        <figcaption>
                            Invocation of the <code>send</code> method on some unknown object.
                        </figcaption>
                    </figure>
                    <p>
                        For which object should this <code>send</code> method be invoked? Ruby on Rails documentation is not clear enough to personally find whether it addresses this question. This method is defined within a module which is invoked within a logical space that handles view rendering. Does this method definition exist outside this logical space? Personal intuition does not ignore the fact that some object exclusive from whatever is governing view rendering is responsible for governing the helpers. Does the object reference of that which manages <code>ActionView</code> need to be passed? What about the object reference of that which manages <code>ApplicationHelper</code>?
                    </p>
                    <p>
                        Documentation may lack, but Ruby's features can help in this regard. Recalling that everything is an object, every object inherits from some base class. This class allows for object introspection in which objects retain information about themselves. The first step into discovering which Rails object(s) govern these logical spaces is to simply ask each relevant scope what its class name is. That is, to execute a debugging print statement within the logic of both <code>create_&shy;form_&shy;input_&shy;field</code> and the view template itself.
                    </p>
                    <p>
                        Within the view template, these statements were output to the page itself:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:175px' max-height='175' src='code/18.php'></iframe>
                        <figcaption>
                            Simple/Lazy debugging statements within <code>app/&shy;views/&shy;users/&shy;new.&shy;html.&shy;haml</code>.
                        </figcaption>
                    </figure>
                    <p>
                        Within the helper function, these statements were output to some text file:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:240px' max-height='240' src='code/19.php'></iframe>
                        <figcaption>
                            Simple/Lazy debugging statements within <code>app/&shy;helpers/&shy;application_&shy;helper.rb</code>'s <code>Application&shy;Helper::create_&shy;form_&shy;input_&shy;field</code>.
                        </figcaption>
                    </figure>
                    <p>
                        Unfortunately, an empty string was produced for both calls to <code>self.class.name</code>. It seems the object(s) handling both these spaces was not given a class name. Fortunately, the preceding print statement asks to print the object for each space. These <code>puts self</code> expressions return the memory address of each object. Serendipitously, both spaces return the same memory address, meaning the same object handles both these logical spaces. This allows a reference to <code>self</code> to finish out the helper function:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:400px' max-height='400' src='code/20.php'></iframe>
                        <figcaption>
                            The <code>self</code> object is the entity in which the parameterized method of <code>helper_sym</code> should be called.
                        </figcaption>
                    </figure>
                    <h3>Factoring more helpers from <code>Action&shy;View::Hel&shy;p&shy;ers</code></h3>
                    <h4>Valid and invalid symbols for <code>create_&shy;form_&shy;input_&shy;field</code></h4>
                    <p>
                        The above helper allows the creation of various HTML input elements. These elements are produced by calls to <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Hel&shy;per</code>'s methods which have the <code>_field</code> suffix. The means of validating the method symbol (<code>:helper_sym</code>) which <code>create_&shy;form_&shy;input_&shy;field</code> receives is not robust. Indeed, if one sends a symbol with a suffix of <code>_field</code> which does not exist in <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Hel&shy;per</code> which coincidentally also receives the same amount of arguments whose datatypes correlate to the order expected of the <code>FormHelper</code> methods <b>then</b> the method will be evaluated which may lead to unexpected behavior.
                    </p>
                    <p>
                        To account for this, Ruby object introspection can be leveraged. A call to <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Hel&shy;per</code>'s <code>public_&shy;instance_&shy;methods</code> method can be made where it can be determined if the symbol exists within this lot.
                    </p>
                    <p>
                        Looking at the return of <code>public_&shy;instance_&shy;methods</code> shows us a list of helper functions which correlates to the documentation for this module. Each entry with the <code>_field</code> suffix essentially behaves the same as far as the back-end is concerned. This was explored through the process of generalizing the usage of these helpers. There are a few helpers that exist in this namespace that do not adhere to this generalized behavior. <code>form_for</code> and <code>convert_to_model</code> are two such examples. These are intentionally caught by the validation in place in which the symbol is evaluated to contain the <code>_field</code> suffix.
                    </p>
                    <p>
                        There is a helper here that is caught by argument validation which behaves functionally the same as the others: <code>text_area</code>. This is caught on account of not having the <code>_field</code> suffix. Despite this, the set of parameters aligns with that of the other helper functions and the production of a call to <code>text_area</code> behaves the the same with respect to how it's processed on the back-end.
                    </p>
                    <p>
                        Realistically, <code>text_area</code> should be handled correctly with respect to <code>create_&shy;form_&shy;input_&shy;field</code>'s validation process by adapting the valid symbol check for <code>:helper_sym</code>. For the sake of the project which spurred the development of these helper methods, an alternative approach was taken.
                    </p>
                    <h4>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Tag&shy;Hel&shy;per</h4>
                    <p>
                        An astute developer will notice the use of <code>label_tag</code> within <code>create_&shy;form_&shy;input_&shy;field</code>. They will have been correlating what's been said on this page with the documentation for <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Hel&shy;per</code> and observe that <code>label_tag</code> does not exist within this module. In its place is <code>label</code>, which would not pass the valid symbol check discussed for <code>create_form_input_field</code>. What's the difference between these two modules? What's the difference between <code>label</code> and <code>label_tag</code>?
                    </p>
                    <blockquote>
                        Provides a number of methods for creating form tags that don’t rely on an Active Record object assigned to the template like FormHelper does. Instead, you provide the names and values manually. <cite> - <a href='https://api.rubyonrails.org/classes/ActionView/Helpers/FormTagHelper.html' target="_blank" rel="noopener noreferrer">Action View Form Tag Helpers - Rails Docs</a>
                    </blockquote>
                    <p>
                       The decision to leverage <code>label_tag</code> whilst building the template and the resultant helper function was to make the above equivalence more intuitive for the reader of this article. A reader of the documentation for <code>FormTagHelper</code> will take note that all the instance methods have the <code>_tag</code> suffix. This includes a <code>text_area_tag</code>.
                    </p>
                    <p>
                        The project which spurred the development of these new helper functions was influenced by the convenience of abstracting away markup from back-end development. This as in an effort to minimize differences in front-end developmental styles and approaches. Minimization that occurs by development and implementation of these new helper functions. A decision was ultimately made to prioritize usage of <code>ActionView</code> helper functions with the <code>_tag</code> suffix instead of the <code>_field</code> suffix. The primary motivator for this was the fact that all the instance methods for <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Tag&shy;Hel&shy;per</code> have the <code>_tag</code> suffix, making argument validation an easier task. This leads to the next helper function:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:530px' max-height='530' src='code/21.php'></iframe>
                        <figcaption>
                            New helper method <code>create_&shy;form_&shy;input_&shy;tag</code> which operates with the context of the instance methods contained in <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Tag&shy;Hel&shy;per</code>.
                        </figcaption>
                    </figure>
                    <p>
                        Like <code>create_&shy;form_&shy;input_&shy;field</code> being derived from <code>FormHelper</code>, <code>create_&shy;form_&shy;input_&shy;tag</code> adheres to the parameter naming convention of the instance methods within <code>FormTagHelper</code>. The above implementation applies more strict argument validation whilst attempting to guide a misuse by supplying the method an argument for <code>helper_sym</code> with the <code>_field</code> suffix.
                    </p>
                    <p>
                        It should be noted that all of the instance methods within <code>FormTagHelper</code> are functionally equivalent. Consider the entry for <code>select_tag</code>. This instance method has an important optional parameter for a collection of <code>option_tags</code>. Likewise, <code>label_tag</code> helper has an optional parameter which can be used to place a value which gets placed between the resultant HTML tags. The documentation labels the usage of this parameter as "content". Other instance methods, such as <code>number_&shy;field_&shy;tag</code>, will label this optional parameter as <code>value</code>.
                    </p>
                    <p>
                        A conventional conundrum occurs where the term value is used with these optional parameters. The <code>value</code> parameter is used to occupy the <code>value</code> attribute of the resultant HTML element. Here, the developer has a choice of supplying the value of this attribute using this helper argument or by using the options parameter as is done in the preceding conditional involving the <code>flash</code> hash-map. This value impasse is why the decision was made to <code>nil</code> this argument for the method call of <code>helper_sym</code> so that the intended behavior associated with the <code>flash</code> hash-map is not lost.
                    </p>
                    <p>
                        Deciding to provide a <code>nil</code> value to the call to <code>helper_sym</code> means that more argument validation needs to be put in place for <code>create_&shy;form_&shy;input_&shy;tag</code>. This should catch the usage of the instance methods which should have a value provided as an argument to this parameter. A good example here is <code>select_tag</code>, which is composed of option tags provided as a hash-map to this argument.
                    </p>
                    <p>
                        The implementation of this validation is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:400px' max-height='400' src='code/22.php'></iframe>
                        <figcaption>
                            New validation check to ensure proper values are being passed to <code>helper_sym</code>.
                        </figcaption>
                    </figure>
                    <h4>Helpers expecting a collection</h4>
                    <p>
                        The decision was made to continue using a helper function which supplies a <code>nil</code> argument to the third parameter to a call to an instance method within <code>FormHelper</code> or <code>FormTagHelper</code>. This results in needing to implement a set of conditionals that evaluate the value given for the <code>helper_sym</code> parameter which informs the user of the mistake and a potential path to take to fix said mistake. One of these messages will be returned upon a call where the value for <code>helper_sym</code> is <code>:select_tag</code>.
                    </p>
                    <p>
                        To address this, a helper method called <code>create_&shy;form_&shy;input_&shy;select</code> was developed. This helper method reflects the same pattern that <code>create_&shy;form_&shy;input_&shy;field</code> and <code>create_&shy;form_&shy;input_&shy;tag</code> establishes, but expects an extra parameter that is a collection of attributes which can be used within a call to <code>Action&shy;View::Hel&shy;p&shy;ers::Form&shy;Options&shy;Hel&shy;per</code>'s  <code>options_&shy;from_&shy;collec&shy;tion_&shy;for_&shy;select</code>. It should be noted that <code>create_&shy;form_&shy;input_&shy;select</code> no longer needs a <code>helper_sym</code> parameter on account of the fact that it is specialized to always produce a pair of select tags. That is, there is no need for a <code>self.send</code> as <code>select_tag</code> is used in its stead.
                    </p>
                    <h3>Helpers expecting error handling</h3>
                    <p>
                        Recall that with the latest iteration of the <code>HAML</code> template a set of conditionals are in place which check whether or not a post to the model succeeded. In the event that posting validation failed, a set of error messages were placed into the <code>flash</code> hash-map. A decision was made to implement this error functionality as a separate helper function. This decision was made to account for the fact that not every input element requires validation. An example of this to optionally require a phone number upon registration.
                    </p>
                    <p>
                        The resultant helper function has been labeled <code>create_&shy;form_&shy;error</code>. The internal logic is trivial as it simply checks the existence of a value representative of the validation's error message established in the relevant model. Recall that this message is placed in the <code>flash</code> hash-map within the relevant controller. In the example used thus far, error messages are placed into <code>flash[:login]</code>. If this helper method was inherit in the Rails framework, this realistically would be associated with a more generic key, such as <code>:error</code> instead of <code>:login</code>.
                    </p>
                    <p>
                        As is the case with <code>create_&shy;form_&shy;input_&shy;select</code>, <code>create_&shy;form_&shy;error</code> does not require a <code>helper_sym</code> parameter. This method is only responsible for producing a <code>label_tag</code> should it need to be produced. The parameter for <code>helper_sym</code> is essentially replaced with a parameter to represent the key to the hash-map contained in <code>flash</code>. In this example, the key is <code>:login</code>.
                    </p>
                    <p>
                        A resultant call to <code>create_&shy;form_&shy;error</code> is as such:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:110px' max-height='110' src='code/23.php'></iframe>
                        <figcaption>
                            A call to <code>create_&shy;form_&shy;error</code> within a <code>HAML</code> view template.
                        </figcaption>
                    </figure>
                    <p>
                        ... where <code>create_&shy;form_&shy;error</code> is defined as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:215px' max-height='215' src='code/24.php'></iframe>
                    </figure>
                    <hr>
                    <h2>Using the new form helpers</h2>
                    <p>
                        Reconsider the initial template pertaining to creating the first input element:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/25.php'></iframe>
                    </figure>
                    <p>
                        With the new set of helper methods in place, the code can be reduced to the following:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:190px' max-height='190' src='code/26.php'></iframe>
                    </figure>
                    <p>
                        Consider the initial HAML template. Consider this template with all the conditionals required for a view to remember its prior value and the set of conditionals used to display a validation error message:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1535px' max-height='1535' src='code/27.php'></iframe>
                    </figure>
                    <p>
                        With the new form helpers in place, the above view can be reduced to the following:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:770px' max-height='770' src='code/28.php'></iframe>
                    </figure>
                    <p>
                        This effectively DRYs out the code to a production that is easy for any developer to digest at a glance.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>
                            It should be emphasized that the usage example above is not completely DRY. Indeed, a variable can be used to represent the various hash-maps being supplied as an argument to these helper functions. It is acknowledged that this would be the next course of action to take in terms of making general behavior easier to digest at a glance. For example, assigning <code>{:class => "alert-danger input-group-text"}</code> to a variable called <code>error_styling</code> would make it very easy for a back-end developer to plug data into a helper call. A front-end developer could assign these attributes to this variable at the top of the view or within some partial. This would further untangle responsibility and be generally more efficient.
                        </p>
                        <p>
                            Addressing this is trivial. What is important for this use-case is that the behavior is clearly communicated within the front matter of each statement through the method's name. <code>create_&shy;form_&shy;input_&shy;field</code> and <code>create_&shy;form_&shy;error</code> does a good job indicating what each line is accomplishing.
                        </p>
                        <h5>Source Repository</h5>
                        <p>
                            The repository of the originating project is located <a href='https://github.com/alanmmckay/graduate-app' target="_blank" rel="noopener noreferrer">here</a>. It'll be easy to observe that the work done here was published at an earlier time. Indeed, some of the implementation differs from what's offered within the documentation provided here. This is due to the fact that, as this page was written out, some new ideas came to mind to improve the overall implementation.
                        </p>
                        <h4>Future Development</h4>
                        <p>
                            Facets of non-trivial improvement stem from how to make this set of helper functions more modular. Addressing these routes of improvement will lead to the development and packaging of a gem such that other developers can easily use these features. The road-map for this development is as follows:
                        </p>
                        <ul>
                            <li>
                                Allow for the acceptance of an optional parameter to accept collections and/or extraneous values within <code>create_&shy;form_&shy;input_&shy;field</code> and <code>create_&shy;form_&shy;input_&shy;tag</code>. For example, allow <code>:select_tag</code> to be a valid argument for <code>create_&shy;form_&shy;input_&shy;tag</code>. This will require investigation in to how the existing helper functions within <code>Action&shy;View</code> handle their optional parameters.
                            </li>
                            <li>
                                Create helper methods to act as wrappers for the symbols that are filtered within the <code>incompatible?</code> sub-method.
                            </li>
                            <li>
                                Provide a means for <code>create_&shy;form_&shy;error</code> to be implicit within the helper methods developed; make it so that a call to <code>create_&shy;form_&shy;error</code> within a view is not necessary as a means to produce an error.
                                <ul>
                                    <li>
                                        Intuition which leans into an easy solution for this problem is to have a simple boolean flag in place within <code>create_&shy;form_&shy;input_&shy;tag</code> or <code>create_&shy;form_&shy;input_&shy;field</code> which determines whether <code>create_&shy;form_&shy;error</code> should be called within. A more elegant solution would be to explore providing create_form_error as a callback to these helpers.
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <p>
                            Action on this road-map will be presented once the gem is complete. Documentation pertaining to this gem will be provided in a new project page. This project page will link to this documentation and vice-versa.
                        </p>
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
            setCodeSizeSliders(14);
        </script>
    </body>
</html>

