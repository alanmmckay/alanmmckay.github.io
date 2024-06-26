<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
        &lt;PROGRAM&gt; ::= &lt;DEFINITIONS&gt;

        &lt;DEFINITIONS&gt; ::= ε
                        | &lt;DEF&gt; &lt;DEFINITIONS&gt;

                &lt;DEF&gt; ::= function &lt;IDENTIFIER&gt; ( &lt;FORMALS&gt; ) : &lt;TYPE&gt;
                             &lt;BODY&gt;

            &lt;FORMALS&gt; ::= ε
                        | &lt;NONEMPTYFORMALS&gt;

    &lt;NONEMPTYFORMALS&gt; ::= &lt;FORMAL&gt;
                        | &lt;FORMAL&gt; , &lt;NONEMPTYFORMALS&gt;

             &lt;FORMAL&gt; ::= &lt;IDENTIFIER&gt; : &lt;TYPE&gt;

               &lt;BODY&gt; ::= &lt;PRINT-STATEMENT&gt; &lt;BODY&gt;
                        | &lt;EXPR&gt;

               &lt;TYPE&gt; ::= integer
                        | boolean

               &lt;EXPR&gt; ::= &lt;EXPR&gt; &lt; &lt;SIMPLE-EXPR&gt;
                        | &lt;EXPR&gt; = &lt;SIMPLE-EXPR&gt;
                        | &lt;SIMPLE-EXPR&gt;

        &lt;SIMPLE-EXPR&gt; ::= &lt;SIMPLE-EXPR&gt; or &lt;TERM&gt;
                        | &lt;SIMPLE-EXPR&gt; + &lt;TERM&gt;
                        | &lt;SIMPLE-EXPR&gt; - &lt;TERM&gt;
                        | &lt;TERM&gt;

               &lt;TERM&gt; ::= &lt;TERM&gt; and &lt;FACTOR&gt;
                        | &lt;TERM&gt; * &lt;FACTOR&gt;
                        | &lt;TERM&gt; / &lt;FACTOR&gt;
                        | &lt;FACTOR&gt;

             &lt;FACTOR&gt; ::= if &lt;EXPR&gt; then &lt;EXPR&gt; else &lt;EXPR&gt;
                        | not &lt;FACTOR&gt;
                        | &lt;IDENTIFIER&gt; ( &lt;ACTUALS&gt; )
                        | &lt;IDENTIFIER&gt;
                        | &lt;LITERAL&gt;
                        | - &lt;FACTOR&gt;
                        | ( &lt;EXPR&gt; )

            &lt;ACTUALS&gt; ::= ε
                        | &lt;NONEMPTYACTUALS&gt;

    &lt;NONEMPTYACTUALS&gt; ::= &lt;EXPR&gt;
                        | &lt;EXPR&gt; , &lt;NONEMPTYACTUALS&gt;

            &lt;LITERAL&gt; ::= &lt;NUMBER&gt;
                        | &lt;BOOLEAN&gt;

    &lt;PRINT-STATEMENT&gt; ::= print ( &lt;EXPR&gt; )
<?php
    require($root_directory."code_footer.html");
?>
