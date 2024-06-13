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
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>

                        </p>
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
                        The usage of these commands, (and the subsequent stubbing of files), does not necessarily expose the implicit logic. A good example of this is in creating some model and a declaration of some route for said model creates the ability to use an implicit variable that acts as a URL path for some action to take. Generically, if some <code>&lt;model&gt;</code> exists, and a <code>&lt;route&gt;</code> for the model is declared in the routes configuration file, the framework allows a developer to leverage a reference of <code>&lt;model&gt;_&lt;route&gt;_path</code> which which can be used elsewhere.
                    </p>
                    <hr><br>
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
                        This programming-by-convention approach requires a developer to be keen on the existence of these implications and how these implications effect and scaffold features of the framework. Deciding to generate a model where the developer gives a name that's plural, for example, is an example where convention can cause pain. Consider the prior usage of <code>users_create_path</code>. When the user model was generated, the singular form of the noun was given. From it, Rails used the plural form of the noun to build a controller and a view. What occurs when the plural of user is given during generation? While pondering this question, the reader is invited to look into the <code>--force-plural</code> flag for the rails generate command whilst also considering the <a href='https://api.rubyonrails.org/classes/ActiveSupport/Inflector/Inflections.html' target="_blank" rel="noopener noreferrer"><code>ActiveSupport::Inflector::Inflections</code></a> class.
                    </p>
                    <p>
                        A team which is aware of these conventions can be very efficient. A team which is not can lead to a heap of problems. This necessitates clear communication and documentation. Sometimes, communication and documentation alone aren't sufficient. In these cases, another layer of abstraction can be introduced to make the development process even easier.
                    </p>
                    <p>
                        The "view" in Model-View-Controller is a means to untangle the output of front-end markup from controller logic. An alternative to leveraging a view template would be to intersperse output statements, (likely via the print call), within the controller itself. This likely cannot be done within the Rails framework as it would break the expected convention. Thus, this would be implemented within a ruby script that has some other access to some database component/abstraction. This software pattern is commonly referred to as Model-View-View-Model (MVVM).*
                    </p>
                    <p>
                        When it comes to producing a templates, Rails opts to leverage a declared route and subsequent action to present a view whilst interacting with a model. The default template format is <code>ERB</code> (Embedded Ruby). An <code>ERB</code> file allows a developer to place normal HTML expressions. Any dynamic logic that needs to be generated from Ruby scripting is placed between a set of special tags:
                    </p>
                    <blockquote>
                        Within an <code>ERB</code> template, Ruby code can be included using both <code>&lt;% %&gt;</code> and <code>&lt;%= %&gt;</code> tags. The <code>&lt;% %&gt;</code> tags are used to execute Ruby code that does not return anything, such as conditions, loops, or blocks, and the <code>&lt;%= %&gt;</code> tags are used when you want output. <cite> - <a href='https://guides.rubyonrails.org/action_view_overview.html' target="_blank" rel="noopener noreferrer">Action View Overview - Rails Guides</a>
                    </blockquote>
                    <h3>Building a Template</h3>
                    <p>
                        Consider a registration form for a web app. The information submitted through this form is applied to a user model. This is established through the users controller by taking the new action. The model, controller, and route is as declared as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:820px' max-height='820' src='code/04.php'></iframe>
                        <figcaption>Full definition of a <code>User</code> model within <code>app/models/user.rb</code>.</figcaption>
                    </figure>
                    <br>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1270px' max-height='1270' src='code/05.php'></iframe>
                        <figcaption>Partial definition of the <code>UsersController</code> within <code>app/controllers/users_controller.rb</code>.</figcaption>
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
                        These chained methods assume the existence of a hash-map of a certain structure. This hash-map reflects what is posted to the controller action. Based on these method calls and the user model, it can be assumed that a user's email, password, a password confirmation, first name, last name, and phone number should be posted through an HTML form. The Rails framework expects the posted form data to be in a hash-map within <code>params[:user]</code>. <code>params</code> contains all post information, which can encapsulate information pertaining to different models. An input field which posts to <code>&lt;model&gt;[&lt;attribute&gt;]</code> will be placed into <code>params[:&lt;model&gt;][:&lt;attribute&gt;]</code>. Knowing this, an initial template can be built.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1085px' max-height='1085' src='code/07.php'></iframe>
                    </figure>
                    <p>
                        This above template is the view which will be presented should the <code>new</code> controller action be invoked. Submission of this form will invoke the create controller action through an HTTP post. This template is close to minimum in terms of interacting with the Rails framework. These interactions are highlighted, and can also be noticed by the usage of the <code>&lt;% %&gt;</code> tags.
                    </p>
                    <p>
                        The decision to use a variable to represent the <code>model</code> name is a weak contingency for the case in which the model's name is changed, (via a migration, for example). This allows a maintainer of this view to quickly adapt to the change by having a single entry point of value designation. Using this category of value declaration is an early lesson to learn in both the study of Computer Science and coding which serves as a starting point to transition into more elaborate means of DRYing out this code.
                    </p>
                    <p>
                        Two other values are being output into this form via evaluation of some Ruby expression. The general concept of <code>users_create_path</code> has been discussed within the context section. The value of <code>form_authenticity_token</code> is assigned by the Rails framework and is required for validating the session state of a visitor to the website.
                    </p>
                    <h4>Introducing Rails Helpers</h4>
                    <p>
                        The natural evolution of this template will introduce the usage of built-in helpers such as those included in <code><a href='https://api.rubyonrails.org/classes/ActionView/Helpers.html' target="_blank" rel="noopener noreferrer">ActionView::Helpers</a></code>. Specifically, the <code>FormHelper</code> and <code>FormTagHelper</code> namespaces. Specifically <code>form_tag</code>, <code>label_tag</code>, <code>text_field</code>, and <code>password_field</code> are used.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1060px' max-height='1060' src='code/08.php'></iframe>
                    </figure>
                    <p>
                        The <code>form_tag</code> helper puts into place the <code>&lt;form&gt;</code> opening and closing tags while also placing a couple of hidden <code>input</code> fields which take care of the session token authentication previously discussed. The <code>label_tag</code> helper creates a relevant set of <code>&lt;label&gt;</code> tags while the <code>text_field</code> and <code>password_field</code> helpers create a relevant set of <code>input</code> tags whose <code>type</code> attributes are set to text and password, respectively. It should be observed that the initial assignment of <code>model</code> has been turned into a <code>symbol</code> as a means to adhere to the conventions set place within the documentation of these methods. That is, <code>text_field</code> and <code>password_field</code> both expect a <code>symbol</code> to be supplied as an argument for their <code>object</code> and <code>method</code> parameters. This is contrary to the <code>label_tag</code> helper which expects a <code>string</code>.
                    </p>
                    <p>
                        The <code>object</code> parameter for these <code>_field</code> helpers refer to the object in which the view presumably exists. In this case, it's the <code>User</code> object. The <code>method</code> parameter refers to the attribute in which the input will be applied. The term <code>method</code> refers to the mutator/accessor method which will be invoked upon submission of the form. Note that the <code>name</code> attribute of the resultant HTML element will maintain the form of <code>&lt;model&gt;[&lt;attribute&gt;]</code>; the output of this updated template will be the same as that was output from the first naively built template!
                    </p>
                    <p>
                        What is the advantage of using these helpers? They begin to abstract away the syntax required of HTML. One needs not worry about closing open HTML tags for each call. Possible mistakes of typing a tag's attributes and their values are mitigated; no longer does a developer need to type out <code>class="..."</code>, <code>placeholder="..."</code>, <code>for="..."</code>, <code>id="..."</code>, etc. The aspects of markup that are important, such as assigning a class to an element, are isolated for the developer as an argument to the relevant helper.
                    </p>
                    <h4>Introducing HAML</h4>
                    <p>
                        The above approach doesn't completely eliminate these syntactic aspects. The template includes a set of <code>div</code> and header tags that are vulnerable to being opened but not closed. The helper methods themselves need to be enclosed in a set of tags which act as a mechanism for the <code>ERB</code> template to know that a Ruby expression should be evaluated. How can these HTML elements be abstracted away?
                    </p>
                    <p>
                        Luckily, such a technology already exists. <code><a href="https://haml.info/" target="_blank" rel="noopener noreferrer">HAML</a></code> was created precisely for these reasons:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:280px' max-height='280' src='code/09.php'></iframe>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:280px' max-height='280' src='code/10.php'></iframe>
                    </figure>
                    <p>
                        HAML stands for HTML Abstraction Markup Language. Usage of HAML using Ruby on Rails requires its gem to be bundled with the project. Doing so will allow a controller to route to a view whose extension is <code>.html.haml</code> instead of <code>.html.erb</code>. Here, the markup abstractions can be leveraged to clean up a view's code and to prevent common mistakes that come from code reuse of literal strings. Converting the template to HAML will produce the following template:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:795px' max-height='795' src='code/11.php'></iframe>
                    </figure>
                    <hr>
                    <h3>Extending Functionality</h3>
                    <p>
                        A key part of the model description used in examples so far is that some facet of the value placed in the HTML input needs to be true in order for a post to succeed. That is, validation is in in place for certain attributes of the model.
                    </p>
                    <p>
                        The helper functions provided through <code>ActionView::Helpers</code> do not account for this. It is up to the developer to check for these cases where an invalid post is made. The developer also needs to decide if and how to provide feedback that a breach of validation has occurred.
                    </p>
                    <p>
                        The feedback required manifests itself in two ways. The first is that an error message should be presented informing the user what went wrong. These messages are declared within the model's class. Using the controller, the message should be placed into the <code>flash</code> hash-map whenever a violation occurs. Which key each message is associated is up to the developer and defined within the relevant controller action. In the example of the <code>create</code> controller action, <code>flash</code> is occupied dependent on whether or not <code>@user.valid?</code> returns true. In the case where it returns <code>false</code>, <code>@user.errors</code> is placed into <code>flash[:login]</code>. The schema of <code>@user.errors</code> is <code>{:&lt;model attribute&gt; =&gt; &lt;error message&gt;, ... }</code>.
                    </p>
                    <p>
                        The other means where feedback manifests itself is by repopulating input elements with the values the visitor had previously placed. For example, if a visitor who is registering tries to post a form where their password fields don't match it would be annoying if they were presented with a blank form where they need to retype their email, first name, last name, and phone number.
                    </p>
                    <p>
                        A look at the create controller action informs us that this information is grabbed from a call to <code>user_params</code>. The resultant hash map is placed into <code>flash[:info]</code> and can be used to repopulate an input tag's value attribute.
                    </p>
                    <p>
                        To present these two tiers of feedback requires a set of conditionals to determine whether or not these values need to be placed. Consider the input associated with the email property of the User model:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/12.php'></iframe>
                    </figure>
                    <p>
                        The first three highlighted lines denote the logic of occupying an input element's value attribute. Observe the <code>merge</code> method in use within the <code>text_field</code> helper which merges the <code>value</code> hash-map with the hash-map that is initially being supplied as an argument to the helper's option parameter. Usage of a hash-map for <code>value</code> allows the case where an empty hash-map is evaluated by Rails which will be recognized as a nil and thus not set the HTML elements's <code>value</code> attribute. This is contrary to the potential behavior of supplying an empty string which may visually override the placeholder's value with said empty string.
                    </p>
                    <p>
                        The last two highlighted lines denote the logic of displaying an error message. This occurs inline as per the bootstrap classes being used whilst being placed in the parent <code>div</code> element. That is, the <code>label</code> HTML element produced from the initial <code>label_tag</code> helper, the <code>input</code> HTML element produced from the <code>text_field</code> helper, and the optional <code>label</code> HTML element produced from the second <code>label_tag</code> helper are placed in the same container horizontally. Both of these <code>label</code> tags point to the same <code>input</code> tag, allowing a user to select either to place the cursor into the relevant <code>input</code> form.
                    </p>
                    <p>
                        The inclusion of this logic introduces 5 new lines of code for each <code>input</code> element required of the form. This can balloon in size for forms which require a larger quantity of <code>input</code> tags. For the template that has been pieced together on this page, this would require a total of 30 new lines of code. This presents an opportunity to DRY out this code by introducing a new set of helper methods.
                    </p>
                    <hr>
                    <h2>Developing New Form Helpers</h2>
                    <h3>Generalizing calls to ActionView::Helpers</h3>
                    <p>
                        It's surprising the HTML pattern of bundling label and input elements isn't addressed within the Rails framework. A lot of effort is put in the framework to abstract away these type of details. The <code>ActionView::Helpers</code> namespace is good evidence of this.
                    </p>
                    <p>
                        Let's consider the case in which a developer wants to create a form input element and its associated label. Also consider the prior code-block example in which an input and its label is created for the email attribute of the User model. Generalizing this code will help expose patterns which will make it easy to DRY:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/13.php'></iframe>
                    </figure>
                    <p>
                        The first surface-level observation of this generalized code is that a <code>&lt;Model Attribute&gt;</code> is a common element between the <code>text_field</code> helper and the <code>label_tag</code> helper. Peering past the surface, it is less obvious that the value assigned to <code>model</code> is another commonality between the two. This is less obvious simply because it's not highlighted in the code above.
                    </p>
                    <p>
                        Both the <code>ActionView</code> helpers used also contain a <code>&lt;Natural Statement of Attribute&gt;</code>. These represent some string which a visitor can read. These are not necessarily the same strings, thus should be considered distinct from each other.
                    </p>
                    <p>
                        Another piece of generalization involves the <code>&lt;Controller Action&gt;</code> access within the flash hash-map. A glance will lead a reader of this code to believe that the notion of a controller action is only associated with the case where an error message needs to be output. A look at the controller which fills the hash-map will disprove this claim. The controller action is filling two values within the hash-map. Both <code>:login</code> and <code>:info</code>.
                    </p>
                    <p>
                        Furthermore, the <code>value</code> property of the HTML <code>input</code> element would be manipulated by JavaScript if need be. The fact that <code>value</code> is handled similarly to a nullable object where it is merged to the option parameter of <code>text_field</code> allows this namespace within the flash hash-map to technically be exclusive from any controller action. If this were a namespace which adheres to a more general convention leveraged by Rails, it would realistically be labeled something like <code>:values</code> instead of <code>:info</code>.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:320px' max-height='320' src='code/14.php'></iframe>
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
                    </figure>
                    <p>
                        Each <code>&lt;Helper Method&gt;</code> will ultimately be derived from <code><a href='https://api.rubyonrails.org/classes/ActionView/Helpers/FormHelper.html' target="_blank" rel="noopener noreferrer">ActionView::Helpers::FormHelper</a></code>. Specifically, those with the <code>_field</code> suffix. This will manifest itself in the namespace of <code>ApplicationHelper::create_form_input_field</code> within <code>app/helpers/application_helper.rb</code>:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:850px' max-height='850' src='code/16.php'></iframe>
                    </figure>
                    <p>
                        Initially, <code>StandardError</code> is extended to help inform a developer if an invalid symbol was provided as an argument. Whether or not this error is flagged hinges on the evaluation of the helper's first parameter - <code>helper_sym</code>. This evaluation occurs through a call to the <code>suffix?</code> method to determine whether the <code>field</code> suffix is being used, as noted prior.
                    </p>
                    <p>
                        The helper <code>create_form_input_field</code> initially receives a symbol to represent the name of the <code>ActionView</code> helper that needs to be called. The next two parameters adhere to the parameter naming convention of the <code>_field</code> methods established within <code>ActionView::Helpers::ssFormHelper</code>. The <code>object</code> parameter correlates to a view's model and the <code>method</code> parameter correlates to a model's attribute.
                    </p>
                    <p>
                        Near the end of the helper function, the <code>label_tag</code> helper is called to create the HTML string representative of the label element. The resultant string is assigned to a local variable. An inexperienced Ruby developer may struggle here in terms of knowing how to invoke the required helper represented by <code>helper_sym</code>. <i>This is where the beauty of Ruby as a programming language comes into play.</i>
                    </p>
                    <p>
                        A key to understanding how to solve this problem is that everything in Ruby is an object. <b>Everything</b>. Literals are objects. Class definitions are objects. More importantly, syntactic abstractions are object method calls. For example, using the assignment operator is transcribed to an invocation of that object's mutator method.
                    </p>
                    <p>
                        Invocation of an object's method is an abstraction on providing that object's <code>send</code> method the symbol of the method that needs to be called! This is a bit wordy, but is easy to understand through an example: The expression <code>"Hello" + "World!"</code> is equivalent to <code>"Hello".+("World!")</code> which is also equivalent to <code>"Hello".send(:+, "World!")</code>. This allows the implementation of a method which allows a caller to ask some object to invoke some unknown method. In the context of <code>create_form_input_field</code>, this allows for the following expression:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:120px' max-height='120' src='code/17.php'></iframe>
                    </figure>
                    <p>
                        What now needs to be asked is for which object should this <code>send</code> method be invoked? Ruby on Rails documentation is not clear enough to personally figure this out. This method is defined within a module which is invoked within a logical space that handles view rendering. Does this method definition exist outside this logical space? Personal intuition does not ignore the fact that some object exclusive from whatever is governing view rendering is responsible for governing the helpers. Does the object reference of that which manages <code>ActionView</code> need to be passed? What about the object reference of that which manages <code>ApplicationHelper</code>?
                    </p>
                    <p>
                        Documentation may lack, but Ruby's features can help in this regard. Recalling that everything is an object, every object inherits from some base class. This class allows for object introspection in which objects retain information about themselves. The first step into discovering which Rails object(s) govern these logical spaces is to simply ask each relevant scope what its class name is. That is, to execute a debugging print statement within the logic of both <code>create_form_input_field</code> and the view template itself.
                    </p>
                    <p>
                        Within the view template, these statements were output to the page itself:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:175px' max-height='175' src='code/18.php'></iframe>
                    </figure>
                    <p>
                        Within the helper function, these statements were output to some text file:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:240px' max-height='240' src='code/19.php'></iframe>
                    </figure>
                    <p>
                        Unfortunately, an empty string was produced for both calls to <code>self.class.name</code>! It seems the object(s) handling both these spaces was not given a class name. Fortunately, the preceding print statement asks to print the object for each space. These <code>puts self</code> expressions return the memory address of each object. Serendipitously, both spaces return the same memory address, meaning the same object handles both these logical spaces. This allows a reference to <code>self</code> to finish out the helper function:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:400px' max-height='400' src='code/20.php'></iframe>
                    </figure>
                    <h3>Factoring more helpers from <code>ActionView::Helpers</code></h3>
                    <h4>Valid and invalid symbols for <code>create_form_input_field</code></h4>
                    <p>
                        The above helper allows the creation of various HTML input elements. These elements are produced by calls to <code>ActionView::Helpers::FormHelper</code>'s methods which have the _field suffix. The means of validating the method symbol (<code>:helper_sym</code>) which <code>create_form_input_field</code> receives is not robust. Indeed, if one sends a symbol with a suffix of <code>_field</code> which does not exist in <code>ActionView::Helpers::FormHelper</code> which coincidentally also receives the same amount of arguments whose datatypes correlate to the order expected of the <code>FormHelper</code> methods <b>then</b> the method will be evaluated which may lead to unexpected behavior.
                    </p>
                    <p>
                        To account for this, Ruby object introspection can be leveraged. A call to <code>ActionView::Helpers::FormHelper</code>'s <code>public_instance_methods</code> method can be made where it can be determined if the symbol exists within this lot.
                    </p>
                    <p>
                        Looking at the return of <code>public_instance_methods</code> shows us a list of helper functions which correlates to the documentation for this module. Each entry with the <code>_field</code> suffix essentially behaves the same as far as the back-end is concerned. This was explored through the process of generalizing the usage of these helpers. There are a few helpers that exist in this namespace that do not adhere to this generalized behavior. <code>form_for</code> and <code>convert_to_model</code> are two such examples. These are intentionally caught by the validation in place in which the symbol is evaluated to contain the <code>_field</code> suffix.
                    </p>
                    <p>
                        There is a helper here that is caught by argument validation which behaves functionally the same as the others: <code>text_area</code>. This is caught on account of not having the <code>_field</code> suffix. Despite this, the set of parameters aligns with that of the other helper functions and the production of a call to <code>text_area</code> behaves the the same with respect to how it's processed on the back-end.
                    </p>
                    <p>
                        Realistically, <code>text_area</code> should be handled correctly with respect to <code>create_form_input_field</code>'s validation process by adapting the valid symbol check for <code>:helper_sym</code>. For the sake of the project which spurred the development of these helper methods, an alternative approach was taken.
                    </p>
                    <h4>ActionView::Helpers::FormTagHelper</h4>
                    <p>
                        An astute developer will notice the use of <code>label_tag</code> within <code>create_form_input_field</code>. They will have been correlating what's been said on this page with the documentation for <code>ActiveView::Helpers::FormHelper</code> and observe that <code>label_tag</code> does not exist within this module. In its place is <code>label</code>, which would not pass the valid symbol check discussed for <code>create_form_input_field</code>. What's the difference between these two modules? What's the difference between <code>label</code> and <code>label_tag</code>?
                    </p>
                    <blockquote>
                        Provides a number of methods for creating form tags that don’t rely on an Active Record object assigned to the template like FormHelper does. Instead, you provide the names and values manually. <cite> - <a href='https://api.rubyonrails.org/classes/ActionView/Helpers/FormTagHelper.html' target="_blank" rel="noopener noreferrer">Action View Form Tag Helpers - Rails Docs</a>
                    </blockquote>
                    <p>
                       The decision to leverage <code>label_tag</code> whilst building the template and the resultant helper function was to make the above equivalence more intuitive for the reader of this article. A reader of the documentation for <code>FormTagHelper</code> will take note that all the instance methods have the <code>_tag</code> suffix. This includes a <code>text_area_tag</code>.
                    </p>
                    <p>
                        The project which spurred the development of these new helper functions was influenced by the convenience of abstracting away markup from back-end development. This as in an effort to minimize differences in front-end developmental styles and approaches. Minimization occurred by development and implementation of these new helper functions. A decision was ultimately made to prioritize usage of <code>ActionView</code> helper functions with the <code>_tag</code> suffix instead of the <code>_field</code> suffix. The primary motivator for this was the fact that all the instance methods for <code>ActionView::Helpers::FormTagHelper</code> have the <code>_tag</code> suffix, making argument validation an easier task. This leads to the next helper function:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:530px' max-height='530' src='code/21.php'></iframe>
                    </figure>
                    <p>
                        Like <code>create_form_input_field</code> being derived from <code>FormHelper</code>, <code>create_form_input_tag</code> adheres to the parameter naming convention of the instance methods within <code>FormTagHelper</code>. The above implementation applies more strict argument validation whilst attempting to guide a misuse by supplying the method an argument for <code>helper_sym</code> with the <code>_field</code> suffix.
                    </p>
                    <p>
                        It should be noted that all of the instance methods within <code>FormTagHelper</code> are functionally equivalent. Consider the entry for <code>select_tag</code>. This instance method has an important optional parameter for a collection of <code>option_tags</code>. Likewise, <code>label_tag</code> helper has an optional parameter which can be used to place a value which gets placed between the resultant HTML tags. The documentation labels the usage of this parameter as "content". Other instance methods, such as <code>number_field_tag</code>, will label this optional parameter as <code>value</code>.
                    </p>
                    <p>
                        A conventional conundrum occurs where the term value is used with these optional parameters. The <code>value</code> parameter is used to occupy the <code>value</code> attribute of the resultant HTML element. Here, the developer has a choice of supplying the value of this attribute using this helper argument or by using the options parameter as is done in the preceding conditional involving the <code>flash</code> hash-map. This value impasse is why the decision was made to <code>nil</code> this argument for the method call of <code>helper_sym</code> so that the intended behavior associated with the <code>flash</code> hash-map is not lost.
                    </p>
                    <p>
                        Deciding to provide a nil value to the call to <code>helper_sym</code> means that more argument validation needs to be put in place for <code>create_form_input_tag</code>. This should catch the usage of the instance methods which should have a value provided as an argument to this parameter. A good example here is <code>select_tag</code>, which is composed of option tags provided as a hash-map to this argument.
                    </p>
                    <p>
                        The implementation of this validation is as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:400px' max-height='400' src='code/22.php'></iframe>
                    </figure>
                    <h4>Helpers expecting a collection</h4>
                    <p>
                        The decision was made to maintain using a helper function which supplies a <code>nil</code> argument to the third parameter to a call to an instance method within <code>FormHelper</code> or <code>FormTagHelper</code>. This results in needing to implement a set of conditionals that evaluate the value given for the <code>helper_sym</code> parameter which informs the user of the mistake and a potential path to take to fix said mistake. One of these messages will be returned upon a call where the value for <code>helper_sym</code> is <code>:select_tag</code>.
                    </p>
                    <p>
                        To address this, a helper method called <code>create_form_input_select</code> was developed. This helper method reflects the same pattern that <code>create_form_input_field</code> and <code>create_form_input_tag</code> establishes, but expects an extra parameter that is a collection of attributes which can be used within a call to <code>ActionView::Helpers::FormOptionsHelper</code>'s  <code>options_from_collection_for_select</code>. It should be noted that <code>create_form_input_select</code> no longer needs a <code>helper_sym</code> parameter on account of the fact that it is specialized to always produce a pair of select tags. That is, there is no need for a <code>self.send</code> as <code>select_tag</code> is used in its stead.
                    </p>
                    <h3>Helpers expecting error handling</h3>
                    <p>
                        Recall that in the latest iteration of the <code>HAML</code> template a set of conditionals are in place which check whether or not a post to the model succeeded. In the event posting validation failed, a set of error messages were placed into the flash hash-map. The decision was made to implement this error functionality as a separate helper function. This decision was made to account for the fact that not every input element requires validation. An example of this to optionally require a phone number upon registration.
                    </p>
                    <p>
                        This helper function has been labeled <code>create_form_error</code>. The internal logic is trivial as it simply checks the existence of of a value representative of the validation's error message established in the relevant model. Recall that this message is placed in the <code>flash</code> hash-map within the relevant controller. In the example used thus far, error messages are placed into <code>flash[:login]</code>. If this helper method was inherit in the Rails framework, this realistically would be associated with a more generic key, such as <code>:error</code> instead of <code>:login</code>.
                    </p>
                    <p>
                        As is the case with <code>create_form_input_select</code>, <code>create_form_error</code> does not require a <code>helper_sym</code> parameter. This method is only responsible for producing a <code>label_tag</code> should it need to be produced. The parameter for <code>helper_sym</code> is essentially replaced with a parameter to represent the key to the hash-map contained in <code>flash</code>. In this example, the key is <code>:login</code>.
                    </p>
                    <p>
                        A resultant call to <code>create_form_error</code> is as such:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:110px' max-height='110' src='code/23.php'></iframe>
                    </figure>
                    <p>
                        ... where <code>create_form_error</code> is defined as follows:
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
                        With the new helper functions in place, the code can be reduced to the following:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:190px' max-height='190' src='code/26.php'></iframe>
                    </figure>
                    <p>
                        Consider the initial HAML template. Consider this with all the conditionals required for a view to remember its prior value and any error message that needs to be communicated to a user if the post should fail:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:1535px' max-height='1535' src='code/27.php'></iframe>
                    </figure>
                    <p>
                        With the new form helpers in place, the above view can be reduced to the following:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;overflow:auto;max-height:690px' max-height='690' src='code/28.php'></iframe>
                    </figure>
                    <p>
                        This effectively DRYs out the code to a production that is easy for any developer to digest.
                    </p>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section>
                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>

