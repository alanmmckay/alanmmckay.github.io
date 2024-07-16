<?php

$canonical = 'https://alanmckay.blog/writings/form_input_field/';

$title = 'Alan McKay | Project | Ruby Gem: form_input_field';

$meta['title'] = 'Alan McKay | Ruby Gem: form_input_field';

$meta['description'] = '';

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
                            The location of the gem is on <a href="https://www.rubygems.org" target="_blank" rel="noopener noreferrer">RubyGems.org</a>, located here: <a href="https://rubygems.org/gems/form_input_field" target="_blank" rel="noopener noreferrer">https://rubygems.org/gems/form_input_field</a>
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Ruby Gem - form_input_field</h1>
                    </header>
                    <p>

                    </p>
                    <section class='info'>
                        <hr>
                        <h3 id='id-concludingNotes'>Concluding notes</h3>
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
        <script src='../../js/project_functions.js?04'></script>
        <script>
            setCodeSizeSliders(14);
        </script>
    </body>
</html>

