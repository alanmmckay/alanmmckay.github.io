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
                        <h1>Ruby on Rails - DRYing form_tags</h1>
                    </header>
                    <h2>Framework Context</h2>
                    <p>
                        The Rails framework for Ruby acts as a layer of abstraction to help expedite the development process of building web applications using the Model-View-Controller software pattern. It takes a programming-by-convention approach in which the mere existence of a given object will infer the existence of some other object or subroutine without the developer's explicit declaration of said other object or subroutine. These implicit connections are often scaffolded by a generative commands within the framework where a developer can explicitly declare a model or controller name and the framework stubs the required files and routes for the framework to operate on.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/01.php'></iframe>
                    </figure>
                    <p>
                        The usage of these commands and the subsequent stubbing of files doesn't necessarily expose the implicit logic. A good example of this is the mere existence of a some model and a generic route for the model allows for the usage of an implicit variable that acts as a URL path for some action to take. Generically, if some <code>&lt;model&gt;</code> exists, and a <code>&lt;route&gt;</code> for the model is declared in the routes configuration file, then the framework allows a developer to leverage a reference of <code>&lt;model&gt;_&lt;route&gt;_path</code> which will tell a given controller action to take a user the indicated controller action.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/02.php'></iframe>
                    </figure>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/03.php'></iframe>
                    </figure>
                    <p>
                        This programming-by-convention approach requires a developer to be keen on the implications and how they approach to leverage and/or scaffold features of the framework. Deciding to generate a model where the developer gives a name that's plural, for example, is an example where convention can cause pain. Consider the above example in reference to <code>users_create_path</code>. When the user model was generated, the singular form of the noun was given. From it, the plural form of the noun was used to build a controller and a view. What occurs when the plural of user is given during generation? While pondering this question, the reader is invited to look into the <code>--force-plural</code> flag for the rails generate command whilst also considering the <a href='https://api.rubyonrails.org/classes/ActiveSupport/Inflector/Inflections.html' target="_blank" rel="noopener noreferrer"><code>ActiveSupport::Inflector::Inflections</code></a> class.
                    </p>
                    <p>
                        A team which is aware of these conventions can be very efficient. A team which is not can lead to a heap of problems. This necessitates clear communication and documentation. Sometimes, communication and documentation alone aren't sufficient. In these cases, another layer of abstraction can be introduced to make the development process even easier.
                    </p>
                    <p>
                        The "view" in Model-View-Controller is a means to untangle output of front-end markup from controller logic. An alternative to leveraging a view template would be to intersperse output statements, (likely via the print call), within the controller itself. This likely cannot be done within the Rails framework as it would break the expected convention. Thus, this would be implemented within a ruby script that has access to some database component/abstraction. This software pattern is commonly referred to as Model-View-View-Model (MVVM).*
                    </p>
                    <p>
                        When it comes to producing a templates, Rails opts to leverage a declared route and subsequent action to present a view whilst interacting with a model. The default template format is <code>ERB</code> (Embedded Ruby). An <code>ERB</code> file allows a developer to place normal html expressions. Any dynamic logic that needs to be generated from Ruby scripting is placed between a set of special tags:
                    </p>
                    <blockquote>
                        Within an <code>ERB</code> template, Ruby code can be included using both <code>&lt;% %&gt;</code> and <code>&lt;%= %&gt;</code> tags. The <code>&lt;% %&gt;</code> tags are used to execute Ruby code that does not return anything, such as conditions, loops, or blocks, and the <code>&lt;%= %&gt;</code> tags are used when you want output. <cite> - <a href='https://guides.rubyonrails.org/action_view_overview.html' target="_blank" rel="noopener noreferrer">Action View Overview - Rails Guides</a>
                    </blockquote>
                    <h3>Building a Template</h3>
                    <p>
                        Consider a registration form for a web app. The information submitted through this form is applied to a user model. This is established through the users controller by taking the new action. The model, controller, and route is as declared as follows:
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/04.php'></iframe>
                    </figure>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/05.php'></iframe>
                    </figure>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/06.php'></iframe>
                    </figure>
                    <p>
                        The controller action operates on a hash map arbitrarily called info. info is filled by a function called user_params. Here, the require and permit methods are chained to produce a one dimensional hash-map which contains a set of keys associated with the symbols provided in the permit method. Both the require and permit methods include validation features abstracted away from the developer, in addition to the production of the hash-maps used within the action controller.
                    </p>
                    <p>
                        These chained methods assume the existence of a hash-map of a certain structure. This hash-map reflects what is posted to the controller action. Based on these method calls and the user model, it can be assumed that a user's email, password, a password confirmation, first name, last name, and phone number should be posted through an HTML form. The Rails framework expects the posted form data to be in a hash-map within <code>params[:user]</code>. <code>params</code> contains all post information, which can encapsulate information pertaining to different models. An input field which posts to <code>&lt;model&gt;[&lt;attribute&gt;]</code> will be placed into <code>params[:&lt;model&gt;][:&lt;attribute&gt;]</code>. Knowing this, an initial template can be built.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/07.php'></iframe>
                    </figure>
                    <p>
                        This above template is the view which will be presented should the new controller action be invoked. Submission of this form will invoke the create controller action through an HTTP post. This template is close to minimum in terms of interacting with the Rails framework. These interactions are highlighted, and can also be noticed by the usage of the <code>&lt;% %&gt;</code> tags.
                    </p>
                    <p>
                        The decision to use a variable to represent the <code>model</code> name is a weak contingency for the case in which the model's name is changed, (via a migration, for example). This allows a maintainer of this view to quickly adapt to the change by having a single entry point of value designation. Using this category of value declaration is an early lesson to learn in both the study of Computer Science and coding which serves as a starting point to transition into more elaborate means of DRYing out this code.
                    </p>
                    <p>
                        Two other values are being output into this form via evaluation of some Ruby expression. The general concept of <code>users_create_path</code> has been discussed within the context section. The value of <code>form_authenticity_token</code> is assigned by the Rails framework and is required for validating the session state of a visitor to the website.
                    </p>
                    <h4>Introducing Rails Helpers</h4>
                    <p>
                        The natural evolution of this template will introduce the usage of built-in helpers such as those included in <code><a href='https://api.rubyonrails.org/classes/ActionView/Helpers.html' target="_blank" rel="noopener noreferrer">ActionView::Helpers</a></code>. Specifically, the <code>FormHelper</code> and <code>FormTagHelper</code> namespaces. Specifically <code>form_tag</code>, <code>label_tag</code>, and <code>text_field</code> are used.
                    </p>
                    <figure class='code-figure'>
                        <iframe frameborder="0" style='width:100%;max-height:150px;overflow:auto' max-height='150' src='code/08.php'></iframe>
                    </figure>
                    <p>
                        The <code>form_tag</code> helper puts into place the <code>&lt;form&gt;</code> opening and closing tags while also placing a couple of hidden <code>input</code> fields which take care of the session token authentication previously discussed. The <code>label_tag</code> helper creates a relevant set of <code>&lt;label&gt;</code> tags while the <code>text_field</code> helper creates a relevant set of <code>input</code> tags whose <code>type</code> is set to text. It should be observed that the initial assignment of <code>model</code> has been turned into a <code>symbol</code> as a means to adhere to the conventions set place within the documentation of these methods. That is, the <code>text_field</code> expects a <code>symbol</code> to be supplied as an argument for its <code>object</code> and <code>method</code> parameters. This is contrary to the <code>label_tag</code> helper which expects a <code>string</code>.
                    </p>
                    <p>
                        The <code>object</code> parameter for <code>text_field</code> refers to the object in which the view presumably exists. In this case, it's the <code>User</code> object. The <code>method</code> parameter refers to the attribute in which the input will be applied. The term <code>method</code> refers to the mutator/accessor method which will be invoked upon submission of the form. Note that the <code>name</code> property of the resultant HTML element will maintain the form of <code>&lt;model&gt;[&lt;attribute&gt;]</code>; the output of this updated template will be the same as that was output from the first naively built template!
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

