<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/compiler/';

$title = 'Alan McKay | Project | Compiler';

$meta['title'] = 'Alan McKay | Compiler';

$meta['description'] = 'Project description detailing the process and specification of a compiler which translates Klein programs to an equivalent TM assembly language program.';

$meta['url'] = 'https://alanmckay.blog/project/compiler/';

$relative_path = "../../";

include('../../header.php');

?>
        <section id='writingsWrapper'>
            <section>
                <article>
                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>
                            Deciding to go to university was motivated by a want to understand how to program at the hardware-level. This was accomplished early in the curriculum by means of taking Computer Organization.  The course satisfied my curiosity in this regard, but it opened up a new avenue of curiosity that would continue to inspire me to succeed. Computer Organization showed me a mapping of two different languages. The mathematics of propositional logic were used to scaffold assembly.
                        </p>
                        <p>
                            My time learning to program up to that point had an undercurrent of realizing that given a single problem, there are many, (if not infinite), solutions. The scaffolding shown through Computer Organization confirmed this intuition and highlighted the fact that this sentiment also applies to how a given problem can be represented as well. The Algorithms course I took the following semester generalized the concept of an algorithm and made it programming-language agnostic. This would serve as a prerequisite for the course that would synthesize these concepts.
                        </p>
                        <p>
                            I took Translation of Programming Languages during the fall semester of 2019. Students of the course were tasked with building a compiler that Translates a high-level functional language to a low-level assembly language. Lectures consisted of covering the various components and steps in the process of translation. Despite the effort required to succeed, I look back on this course as a favorite. It helped me understand programming languages as an abstraction and thus helped trivialize the notion of learning a new programming language or framework.
                        </p>
                        <p>
                            Detailed below is documentation of the project. A repository for the compiler can be found via <a href='https://github.com/alanmmckay/KLEINcompiler' target="_blank" rel="noopener noreferrer">GitHub</a>.
                        </p>
                        <hr>
                    </section>
                    <header>
                        <h1>Project: Klein Compiler</h1>
                    </header>

                    <p>
                        The following acts both as documentation and as a progress journal for a compiler written in Python. The compiler's input language is a language called Klein which operates in the functional paradigm. The target language is an assembly language called Tiny Machine. Specifications of these two languages can be found in the <a href='#conclusion'>concluding notes</a> section of this page.
                    </p>
                    <p>
                        This implementation of the compiler includes all features described in the language specification except:
                        <ul>
                            <li>Arithmetic operations operate from right to left when stringed with operations within their respective set: <code>({+,-},{*,/})</code>.
                                <ul>
                                    <li>This likely stems from a flaw in the evaluation of a resultant abstract syntax tree</li>
                                    <li>This can be prevented by taking full advantage of parenthesis to group respective operands.</li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <h4>The Repository</h4>
                    <p>
                        It's worth noting the structure of the repository for this implementation of the compiler. The key directories are as follows:
                        <ul>
                            <li>
                                The home directory is <code>KLEINcompiler/</code>
                                <ul>
                                    <li>
                                        Error logs are output at this level</li>
                                    <li>
                                        Various shell scripts are housed here to test the stages of the compiler. Each represents running the compiler for each implementation stage, or phase, of the project:
                                        <ul>
                                            <li><code>./kleins</code> : scanner; creation of a set of tokens</li>
                                            <li><code>./kleinf</code> : parse table lookups</li>
                                            <li><code>./kleinp</code> : abstract syntax tree creation</li>
                                            <li><code>./kleinv</code> : type checker</li>
                                            <li><code>./kleinc</code> : code generation; the completed compiler</li>
                                        </ul>
                                        To run each script run the following command:
                                        <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px;margin-top:5px;margin-left:5px;'>
    sh &lt;script name&gt; &lt;program to be tested&gt;
</pre>
                                        </code>
                                        For example:
                                        <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px;margin-top:5px;margin-left:5px;'>
    sh kleinc programs/exclusive_or.kln
</pre>
                                        </code>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                The <code>doc</code> directory houses various forms of documentation, housed in folders with respect to the component of the compiler they belong.
                            </li>
                            <li>
                                The <code>programs</code> directory houses a small handful of Klein programs that were created for use of the compiler. It also houses a set of programs provided by Dr. Wallingford within the class-programs folder.
                            </li>
                            <li>
                                The <code>tests</code> directory houses various Klein programs used for testing the various stages of the complier.
                            </li>
                            <li>
                                The <code>src</code> directory houses all files used for implementation of the compiler.
                                <ul>
                                    <li><code>src/drivers</code> houses files used to run the shell scripts, noted above.</li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                    <h4>Flaws in implementation</h4>
                    <p>It's worth noting flaws of implementation. These illuminate steps that should be taken to fine-tune the compiler as a future project. They ultimately are a reflection of the result of the project and mark lessons learned.</p>
                    <ul>
                        <li>
                            A lot of the logic is loaded into AST_node.py. This is the file which houses the class information for the abstract syntax tree. The layout itself is quite clever, but type-check and code-generation methods are added to them. This poses a problem in terms of separation of responsibility. The logic in AST_node.code_gen() is specific to outputting code in TM. Provided more time, exploration should occur here as a means to refactor theser methods into some exterior mechanism beside the abstract syntax tree.
                        </li>
                        <li>
                            The TM code being output is not efficient, ignoring the lack of any optimizer implementation. Most instructions that are output have the value stored in some memory position. This produces a lot of redundant instructions to <code>IMEM</code> and a lot of redundant data to <code>DMEM</code>. The most egregious lack of optimization comes from the IdentifierNode outputing a load instruction. This was an adhoc fix to print statements having no means to access an argument.
                        </li>
                        <li>
                            The error handling needs to be expanded upon. Effort was strong in the beginning of the project, but stalled out when time started becoming more of a premium and workload was shifted away from this effort. Error returns pertaining to parse errors do not help the user of a compiler as they are more geared for compiler debugging.
                        </li>
                    </ul>
                    <h2>Implementation of Compiler: Progress Checks</h2>

                    <p>The following list of phases represent a step of progress implementing each component of the compiler. Interact with the header to expand its details.</p>

                    <h3 id='phase_1_header' onclick='reveal("phase_1")' class='expandable'>[ - ] Phase 1: Scanner</h3>
                    <section id='phase_1'>
                    <ul>
                        <li>Associated files of implementation:
                            <ul class=filelist>
                                <li><code>kleins</code></li>
                                <li><code>src/k_token.py</code></li>
                                <li><code>src/scanner.py</code></li>
                            </ul>
                        </li>

                        <li>Scanner Description:
                            <p>
                                The scanner is the portion of the compiler which takes input a Klein program as a single string and splits the string into a set of tokens. The token class is described in <code>k_token.py</code>. The scanner steps through each character of the program string and uses a set of conditions to determine if a resultant character, (or string of characters), is a valid token. These conditions are based on the possible terminals present in the language specification. These may either be a single character, such as the case of the unary and binary operators, or can be a string, such as any identifier or number. Thus, these conditions are based on a set of regular expressions, as noted in the scanner portion of the documents folder. These regular expressions are used to build the conditions in place, represented by the FSA diagram which is also housed in the same folder.
                            </p>
                        </li>

                        <li>Associated files of documentation:
                            <ul class='filelist'>
                                <li><code>doc/scanner/regex.txt</code></li>
                                <li><code>doc/scanner/regex_FSA.jpg</code>
                                    <ul>
                                        <li><code>doc/regex_FSA.jff</code> is the jflapfile used to create the above jpeg</li>
                                    </ul>
                                </li>
                                <!--right here-->
                                <li><code>doc/scanner/scanner_status_check.txt</code></li>
                            </ul>
                        </li>
                        <li>Date of completion: 09-20-2019</li>
                    </ul>
                    </section>

                    <h3 id='phase_2_header' onclick='reveal("phase_2")' class='expandable'>[ - ] Phase 2: Parser - Syntactic Analyzer</h3>
                    <section id='phase_2'>
                    <ul>
                        <li>
                            Associated files of implementation:
                            <ul class='filelist'>
                                <li><code>kleinf</code></li>
                                <li><code>src/parser.py</code></li>
                                <li><code>src/parse_table.py</code></li>
                            </ul>
                        </li>

                        <li>Syntactic Analyzer Description:
                            <p>
                                The first phase of the parser is the implementation of the component which decides if a program is syntactically correct. That is, the component makes sure that any given combination of tokens are in valid order. This is determined by the grammar of the Klein language, which has been refactored to eliminate the need for the parser to have to read-in more than one token at a time from the scanner to decide whether or not a combination of tokens is valid.
                            </p>

                            <p>
                                The validity is determined by a parse table, which is determined by the first and follow sets of every declaration statement within the refactored grammar. These first and follow sets help us know every possible token which leads a nonterminal and every possible token that ends a terminal. With this information we can surmise all possible combinations while considering nonterminal composition (including nonterminals composed of other nonterminals). This is then mapped to a table using a specific algorithm which considers whether or not a grammar statement has an empty character in its first set.
                            </p>

                            <p>
                                Thus, the parser has a parse stack which assumes an end of file token exists in addition to a nonterminal which represents the program as a whole. It takes a look at the top element of the stack and uses it to look up the valid combination of preceding tokens while considering the current token that is being read by the scanner. The parser walks the table using this logic, pushing terminals and nonterminals onto the parse stack based on the result of the current index of the parse table until either an invalid combination of tokens is discovered or the end-of-file token is reached.
                            </p>
                        </li>

                        <li>Associated files of documentation:
                            <ul class='filelist'>
                                <li><code>doc/parser/extended_grammar.txt</code></li>
                                <li><code>doc/parser/first_and_follow_sets.txt</code></li>
                                <li><code>doc/parser/parse_table.pdf</code>
                                    <ul>
                                        <li><code>doc/parser/parse_table.ods</code></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>Date of completion: 10-04-2019</li>
                    </ul>
                    </section>

                    <h3 id='phase_3_header' onclick='reveal("phase_3")' class='expandable'>[ - ] Phase 3: Parser - Abstract Syntax Tree</h3>
                    <section id='phase_3'>
                    <ul>
                        <li>
                            Associated files of implementation:
                            <ul class='filelist'>
                                <li><code>kleinp</code></li>
                                <li><code>src/parser.py</code></li>
                                <li><code>src/parse_table.py</code></li>
                                <li><code>src/AST_node.py</code></li>
                            </ul>
                        </li>

                        <li>Abstract Syntax Tree Description:
                            <p>
                                The second phase of the parser is to build an abstract syntax tree which represents the various expressions and operations of the input program, (in the most general sense). These expressions and the resultant operations are put into data structures which will later be used to convert the statements into their equivalents during code generation.
                            </p>
                        </li>

                        <li>What was finished:
                            <ul>
                                <li>The inclusion of the semantic stack and the implementation of the parse algorithm to communicate between the parse stack and the semantic stack.</li>
                                <li>The inclusion of semantic actions within the parse table.</li>
                                <li>An enumeration class in the parse table which is used to evaluate the semantic actions returned on the parse table.</li>
                                <li>When the semantic action is evaluated with respect to the parse algorithm, it is used to index into a dictionary called object_factory:
                                    <ul>
                                        <li>The object factory returns the relevant AST_node class which is used to construct the relevant node object within the parse algorithm.</li>
                                        <li>The resultant node is then pushed onto the semantic stack. The resultant node is also passed the semantic stack upon construction. Logic will exist within the node's constructor to know what to do with the stack and the various nodes and relevant tokens that reside in it.</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>What is not finished:
                            <ul>
                                <li>The AST nodes themselves are not done. A couple of simple nodes have been finished; those that only really need to house a value - such as an identifier.</li>
                                <li>No error handling is in place once the AST nodes are ready for testing.</li>
                            </ul>
                        </li>

                        <li>What else has been accomplished:
                            <ul>
                                <li>Errors regarding the previous phase with the parse table have been fixed.</li>
                                <li>Error classes have been expanded upon. Each error writes to a relevant text file the initial program and the associated stdout error message.
                                    <ul>
                                        <li>Lexical errors append the remaining program string to its error log.</li>
                                        <li>Parse errors append the parse stack trace to its error log.</li>
                                    </ul>
                                </li>
                                <li>The scanner returning a none value when evaluating comments has been fixed.
                                    <ul>
                                        <li>Existing logic was extended to accomplish this. This has resulted in some messy code that needs to be refactored.</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>Date of completion: 10-18-2019</li>
                    </ul>
                    </section>

                    <h3 id='phase_4_header' onclick='reveal("phase_4")' class='expandable'>[ - ] Phase 4: Type Checker</h3>
                    <section id='phase_4'>
                    <ul>
                        <li>Associated files of implementation:
                            <ul class='filelist'>
                                <li><code>kleinp</code>
                                    <ul>
                                        <li>To run, feed a program through <code>kleinp</code>. It will print back node information as the AST is being built. If there is a type error, a Semantic Error will be thrown.</li>
                                    </ul>
                                </li>
                                <li><code>src/parser.py</code></li>
                                <li><code>src/AST_node.py</code></li>
                            </ul>
                        </li>

                        <li>Type Checker Description:
                            <p>
                                The next phase of the project was to augment the abstract syntax tree with type information. This is used to make sure a user is inputting the correct type of data for a program to execute. This was handled by adding type checking methods to the <code>ASTnode</code> class within <code>AST_node.py</code> and made changes to a subclass' method where applicable. The type check occurs after the parser builds the abstract syntax tree, where the parser grabs the outer node off the semantic stack and calls <code>process_node()</code> which recursively descends into the composition of nodes, calling <code>typeCheck()</code> when applicable.
                            </p>
                            <p>
                                When a type error is found, the recursive function starts to back-track, sending the error information as an error object back to the parser. If the error object exists on the semantic stack when the parser tries to call <code>process_node()</code>, it will instead raise an exception, feeding extra information about the program to it.
                            </p>
                        </li>

                        <li>What is not finished:
                            <ul>
                                <li>Error handling needs to be expanded upon. As of now, the error messages are pretty slim.</li>
                                <li>
                                    Some code cleanup would be nice. This includes implementing correct OOP design such as making sure accessors are correctly called, as opposed to directly referring to an object's property. Some of the lines of code also need to be line-wrapped/escaped to allow easier viewing on smaller screen resolutions.
                                    <ul>
                                        <li>There exists some duplicate code within <code>AST_node.py</code>. Note the inclusion of the list functions. There is also some ad-hoc code duplication wihtin <code>process_node()</code>. This is in place to allow the recursive function to back-track once an error is found. The flag which causes this is the inclusion of 'errob' (an object class which needs to be renamed...) on the function_record list.</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>Date of completion: 11-01-2019</li>
                    </ul>
                    </section>

                    <h3 id='phase_5_header' onclick='reveal("phase_5")' class='expandable'>[ - ] Phase 5: Code Generator - Environment</h3>
                    <section id='phase_5'>
                    <ul>
                        <li>Associated files of implementation:
                            <ul class='filelist'>
                                <li><code>kleinc</code></li>
                                <li><code>AST_node.py</code></li>
                                <li><code>code-generator.py</code></li>
                            </ul>
                        </li>
                        <li>Code Generator Description:
                            <p>The first phase of implementing the code generator involved priming behavior. What's meant by this is that the state of the generator was to set up the environment such that the address space for a main function is added to the runtime stack and relevant information is saved to the relevant registers. The body of the main is executed and registers are restored as per the TM specification. Lastly, functionality was put in place with respect to evaluating literals and print statements.</p>
                        </li>
                        <li>Schema of environment:
                            <ul>
                                <li>The Stack Frame:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
:----------------------:
:     return addr      : 0
:----------------------:
:     return value     : 1
:----------------------:
:     arg  0           :
:----------------------:
:     args             :
:----------------------:
: register values(0-6) : - can update to only save whats modified
:----------------------:
:     temp space       :
:----------------------:
</pre>
                                    </code>
                                </li>
                                <li>Registers:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
   :------------------:
r0 :                  :
   :------------------:
 1 :                  :
   :------------------:
 2 :                  :
   :------------------:
 3 :                  :
   :------------------:
 4 :                  :
   :------------------:
 5 :                  :
   :------------------:
 6 :   top  (stack)   :
   :------------------:
 7 :    PC            :
   :------------------:
</pre>
                                    </code>
                                </li>
                                <li>DMEM:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
0 :-------------------:
| :                   :
| :-------------------:
V :                   :
. :-------------------:
. :                   :
  :-------------------: Top (R6)
  :        |          :
  :        |          :
  :        |          :
  :        |  Grows   :
  :        V          :
  :                   :
  :                   :
  :-------------------:
</pre>
                                    </code>
                                </li>
                                <li>IMEM:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
0 :---------------------:
  : LDA 7 , &lt;main addr&gt; :
  :---------------------:
  :         .           :
  :         .           :
  :         .           :
  :         .           :
  :         .           :
  :---------------------: main
  : / / / / / / / / / / :
  : / / / / / / / / / / :
  :---------------------:
</pre>
                                    </code>
                                </li>
                            </ul>
                        </li>
                        <li>What is not finished:
                            <ul>
                                <li>Better register management is still under consideration.</li>
                                <li>Setting up three-address-code templates for each node.</li>
                            </ul>
                        </li>
                        <li>Date of completion: 11-15-2019</li>
                    </ul>
                    </section>


                    <h3 id='phase_6_header' onclick='reveal("phase_6")' class='expandable'>[ - ] Phase 6: Code Generator - Operations and Functions</h3>
                    <section id='phase_6'>
                    <ul>
                        <li>Associated files of implementation:
                            <ul class='filelist'>
                                <li><code>AST_node.py</code></li>
                                <li><code>code-generator.py</code></li>
                                <li><code>kleinc</code></li>
                            </ul>
                        </li>
                        <li>Phase 6 expands on the functionality of phase 5. The goal was to complete what wasn't finished. The following has been implemented:
                            <ul>
                                <li>Function Calls</li>
                                <li>Arithmetic Operations
                                    <ul>
                                        <li>Addition Operation</li>
                                        <li>Subtraction Operation</li>
                                        <li>Division Operation</li>
                                        <li>Multiplication Operation</li>
                                    </ul>
                                <li>Boolean Connective Operations
                                    <ul>
                                        <li>And Operation</li>
                                        <li>Or Operation</li>
                                    </ul>
                                </li>
                                <li>Boolean Comparison Operations
                                    <ul>
                                        <li>Less-Than Operation</li>
                                        <li>Equal-To Operation</li>
                                    </ul>
                                </li>
                                <li>Unary Operations
                                    <ul>
                                        <li>Not Operation</li>
                                        <li>Negation Operation</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>What needs to be implemented:
                            <ul>
                                <li>Grabbing arguments from the initial TM execution
                                    <ul>
                                        <li>The compiler does have logic that places the initial <code>DMEM</code> arguments into the control stack.</li>
                                    </ul>
                                </li>
                                <li>There currently exists a logical error that allows klein programs to have arguments with the same name.</li>
                                <li>Some more clear error handling</li>
                            </ul>
                        </li>
                        <li>Date of completion: 12-06-2019</li>
                    </ul>
                    </section>


                    <h3 id='phase_7_header' onclick='reveal("phase_7")' class='expandable'>[ - ] Phase 7: Project Conclusion</h3>
                    <section id='phase_7'>
                    <ul>
                        <li> What was completed:
                            <ul>
                                <li>TM programs now allow arguments to be fed in through the command line.
                                    <ul>
                                        <li>The <code>DMEM</code> allocated to the initial main function call now factors the arguments that may exist when the TM machine runs.</li>
                                        <li>Function declaration output no longer saves and restores register values for temporary register usage.</li>
                                        <li>Negation and Not operation TM output is fixed.</li>
                                        <li>Type checking error messages have been refined and are more informative.</li>
                                        <li>A whole slew of klein programs have been created for testing purposes.</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>Date of completion: 12-13-2019</li>
                    </ul>
                    </section>


                    <section class='info'>
                        <hr>
                        <h3 id='conclusion'>Concluding notes</h3>
                        <p>
                            The Klein language specification was written by <a href='https://www.cs.uni.edu/~wallingf/' target="_blank" rel="noopener noreferrer">Professor Eugene Wallingford</a> of the University of Northern Iowa.

                        <blockquote>
                            I chose the name to indicate the size of the language. klein is the German word for "small" or "little". It is one of the first German words I learned back in the eighth grade.
                            <cite> - Eugene Wallingford</cite>
                        </blockquote>
                            My looking back favorably on this course has a lot to do with having Dr. Wallingford as a professor. He was well equipped to teach the course and I always felt that he was very engaging with my level of curiosity.
                        </p>
                        <p>
                            Tiny Machine (TM) is an assembly language written by <a href='https://www.cs.sjsu.edu/faculty/louden/' target="_blank" rel="noopener noreferrer">Kenneth Louden</a>. The specifications for both languages are in the following expandable sections.
                        </p>
                        <h3 id='k_spec_header' onclick='reveal("k_spec")' class='expandable'> [ - ] Klein Language Specification</h3>
                        <article id='k_spec'>
                            <p>Klein is a small, mostly functional language that is designed specifically to be used as a manageable source language in a course on compiler design and implementation. Though small and simple, the language is Turing-complete.</p>

                            <h4>Grammar</h4>
                            <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:45em;padding-left:10px'>
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
</pre>
                            </code>
                            <h4>Syntax Features</h4>
                            <ul>
                                <li>
                                    These are the reserved words of Klein:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px'>
    integer     boolean
    true        false
    if          then       else
    not         and        or
    function    print
</pre>
                                    </code>
                                </li>
                                <li>
                                    <code>print</code> is a primitive identifier. <code>true</code> and <code>false</code> are boolean literals. The rest are keywords.
                                </li>
                                <li>
                                    Klein reserved words may not be used as user-defined names of functions or formal parameters.
                                </li>
                                <li>
                                    Klein reserved words and identifiers are case-sensitive.
                                </li>
                                <li>
                                    Identifiers must be no longer than 256 characters.
                                </li>
                                <li>
                                    The following are the primitive operators and punctuation marks of Klein:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px'>
    +           -          *        /
    &lt;           =          (        )
    ,           :          (*       *)
</pre>
                                    </code>
                                </li>
                                <li>
                                    Klein operators and punctuation are self-delimiting.
                                </li>
                                <li>
                                    Integer Literals must be in the range from 0 to 2<sup>31</sup>-1, inclusive.
                                </li>
                                <li>
                                    A comment in Klein begins with the characters (* and continues up to the next occurrence of the characters *). Any characters inside a comment are ignored.
                                </li>
                                <li>
                                    A function many have zero or more formal parameters. The scope of a formal parameter is the body of the function. Arguments are passed by value.
                                </li>
                                <li>
                                    Binary operators and function calls evaluate their arguments from left to right.
                                </li>
                                <li>
                                    Whitespace consists only of blanks, tabs, and the end-of-line characters \n and \r. Whitespace characters may not appear inside a literal, identifier, keyword, or operator. Otherwise, whitespace is insignificant.
                                </li>
                            </ul>

                            <h4>Data</h4>
                            <p>
                                All data in Klein is an integer or a boolean, and nearly every element in a program is an expression that produces an integer result or a boolean result.
                            </p>

                            <h4>Atomic Expressions</h4>
                            <ul>
                                <li>
                                    There are only two boolean values. The two primitive boolean literals are <code>true</code> and <code>false</code>.
                                </li>
                                <li>
                                    Integer literals are strings of digits. There are no leading plus or minus signs to indicate positive or negative values; all integer literals are positive. Leading zeros are not permitted for non-zero integer literals.
                                </li>
                                <li>
                                    Klein supports integer values in the range of -2<sup>31</sup> to 2<sup>31</sup>-1.
                                </li>
                                <li>
                                    User-defined identifiers are strings beginning with a letter and consisting of letters, digits, and the underscore.
                                </li>
                            </ul>

                            <h4>Compound Expressions</h4>
                            <p>The language provides the following kinds of expression:</p>
                            <ul>
                                <li>
                                    <h5>Arithmetic</h5>
                                    Adds, subtracts, multiplies, or divides two integers.
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     x + y
     x - y
     x * y
     x / y
</pre>
                                    </code>
                                </li>
                                <li>
                                    <h5>Boolean Comparisons</h5>
                                    Compares two integers, yielding one of the boolean values <code>true</code> or <code>false</code>. <code>&lt;</code> yields <code>true</code> if its left operand is less than its right operand, and <code>false</code> otherwise. <code>=</code> yields true if its left operand has the same value as its right operand, and <code>false</code> otherwise.
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     x &lt; y
     x = y
</pre>
                                    </code>
                                </li>
                                <li>
                                    <h5>Boolean Connectives</h5>
                                    Negates a single boolean value, or computes the disjunction or conjunction of two boolean values. The unary <code>not</code> yields <code>true</code> if its operand is <code>false</code>, and <code>false</code> otherwise. <code>or</code> yields <code>true</code> if either its left operand or its right operand yields <code>true</code>, and <code>false</code> otherwise. <code>and</code> yields <code>true</code> if both its left operand and its right operand yield <code>true</code>, and <code>false</code> otherwise.                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     not x
     x or y
     x and y
</pre>
                                    </code>
                                    <code>or</code> and <code>and</code> short-circuit evaluation when possible.
                                </li>
                                <li>
                                    <h5>Conditional Selection</h5>
                                    Evaluates a test expression, and uses its value to select one of two expressions to evaluate. Yields the value of the first of these expressions if the test expression produces a true value, and the value of the second if the test expression yields a false value. The <code>else</code> clause is required.<br>
                                    For example:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     if flag &lt; 0 then
        x + y
     else
        x - y
</pre>
                                    </code>
                                    produces the sum of x and y if flag is less than 0; otherwise, it produces their difference.
                                </li>
                                <li>
                                    <h5>Function call</h5>
                                    Applies a function to zero or more arguments, and yields the value of the expression in the body of the function. All functions return an integer value or a boolean value; Klein has no notion of a "void" function.<br>
                                    For example:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     f( x+y, 1 )
</pre>
                                    </code>
                                    computes the sum of x an dy, passes that value and a 1 to the function f, and produces the value returned by applying the function to its arguments.
                                </li>
                                <li>
                                    <h5>Miscellaneous</h5>
                                    Compound expressions can be nested to any depth.<br><br>
                                    Note that the only user-defined identifiers in Klein ar ethe names of functions and the names of formal parameters to functions. There are no "variables".
                                </li>
                            </ul>

                            <h4>User-Defined Functions</h4>
                            <ul>
                                <li>
                                    Each function declaration consists of the function's name, its formal parameters and their types, the type of the funtion, and its body.
                                </li>
                                <li>
                                    Function names are unique.
                                </li>
                                <li>
                                    A function may refer only to its formal parameters and to other functions.
                                </li>
                                <li>
                                    A Klein function may call itself.
                                </li>
                            </ul>

                            <h4>Primitive Functions</h4>
                            <ul>
                                <li>
                                    For the purposes of user interaction, Klein provides the primitive function <code>print(expression)</code>. For example:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:15em;padding-left:10px'>
     print( x+y )
</pre>
                                    </code>
                                    <code>print</code> writes its argument on standard output, followed by a new line character.
                                </li>
                                <li>
                                    Unlike all user-defined functions, the value of a call to <code>print</code> is undefined. For this reason, if a function contains a call to <code>print</code>, that call must come at the top of the function body.
                                </li>
                            </ul>

                            <h4>Programs</h4>
                            <ul>
                                <li>
                                    A Klein program consists of a sequence of function definitions. Every program must define a function named <code>main</code>, which is called first when the program runs.
                                </li>
                                <li>
                                    Users may provide arguments to <code>main</code> on the command line. The result returned by <code>main</code> is printed on standard output.
                                </li>
                                <li>
                                    For example, here is a complete Klein program that computes the absolute value of its argument:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px'>
     function main( n : integer ) : integer
        if n &lt; 0
           then -n
           else n
</pre>
                                    </code>
                                    If this program were compiled into an executable file named <code>abs</code>, then running it under Unix might look something like this:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:35em;padding-left:10px'>
    mac os x > abs -3
    3
</pre>
                                    </code>
                                </li>
                            </ul>
                        </article>

                        <h3 id='tm_spec_header' onclick='reveal("tm_spec")' class='expandable'>[ - ] TM Machine Specification</h3>
                        <article id='tm_spec'>
                        <p>
                            TM is a simple target machine that has an architecture and instruction set complex enough to illustrate the important issues faced when writing a compiler, yet simple enough to not distract with unnecessary details.
                        </p>

                        <h4>Architecture</h4>
                        <ul>
                            <li>
                                TM provides two kinds of memory:
                                <ul>
                                    <li>instruction memory, which is read-only</li>
                                    <li>data memory</li>
                                </ul>
                            </li>
                            <li>
                                Memory addresses are non-negative integers. When the machine is started, all data memory is set to 0, except for the first memory location. That location contains the value of the highest legal address.
                            </li>
                            <li>
                                An extended version of the TM interpreter is used which accepts command-line arguments to the TM program and stores them in memory locations 1 through n.
                            </li>
                            <li>
                                TM provides eight registers, numbered 0 through 7. Register 7 is the program counter. The other seven registers are available for program use. WHen the machine is started, all registers are set to 0.
                            </li>
                            <li>
                                When the machine is started, after memory and registers have been initialized, TM begins execution of the program beginning in the first location of instruction memory. The machine follows a standard fetch-execute cycle:
                                <ul>
                                    <li>fetch the current instruction from the address indicated by the program counter</li>
                                    <li>increment the program counter</li>
                                    <li>execute the instruction</li>
                                </ul>
                            </li>
                            <li>
                                The loop terminates when it reaches a <code>HALT</code> instruction or when an error occurs. TM has three native error conditions:
                                <ul>
                                    <li><code>IMEM_ERR</code>, which occurs in the fetch step whenever the address of the next instruction to be executed is out of bounds</li>
                                    <li><code>DMEM_ERR</code>, which occurs in the execute step whenever the address of a memory access is out of bounds</li>
                                    <li><code>ZERO_DIV</code>, which occurs in the execute step whenever the divisor to a <code>div</code> is zero</li>
                                </ul>
                            </li>
                        </ul>

                        <h4>Instruction Set</h4>
                        <ul>
                            <li>
                                TM provides two kinds of instructions: register-only and register-memory.
                            </li>
                            <li>
                                Register-only (RO) instructions are of the form
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:25em;padding-left:10px'>
    opcode r1,r2,r3
</pre>
                                    </code>
                                where the <code>ri</code> are legal registers.
                            </li>
                            <li>
                                These are the RO opcodes:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:45em;padding-left:10px'>
<b>IN</b>      read an integer from stdin and place result in <b>r1</b>; ignore operands <b>r2</b> and <b>r3</b>
<b>OUT</b>     write contents of <b>r1</b> to stdout; ignore operands <b>r2</b> and <b>r3</b>
<b>ADD</b>     add contents of <b>r2</b> and <b>r3</b> and place result in <b>r1</b>
<b>SUB</b>     subtract contents of <b>r3</b> from contents of <b>r2</b> and place result in <b>r1</b>
<b>MUL</b>     multiply contents of <b>r2</b> and contents of <b>r3</b> and place result in <b>r1</b>
<b>DIV</b>     divide contents of <b>r2</b> by contents of <b>r3</b> and place result in <b>r1</b>
<b>HALT</b>    ignore operands and terminate the machine
</pre>
                                    </code>
                            </li>
                            <li>
                                Register-memory (RM) instructions are of the form
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:25em;padding-left:10px'>
    opcode r1,offset(r2)
</pre>
                                </code>
                                Where the <code>ri</code> are legal registers and <code>offset</code> is an integer offset. <code>offset</code> may be negative. With the exception of the <code>LDC</code> instruction, the expression <code>offset(r2)</code> is used to compute the address of a memory at location:
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:25em;padding-left:10px'>
    address = (contents of r2) + offset
</pre>
                                </code>
                            </li>
                            <li>
                                There are four RM opcodes for memory manipulation:
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:45em;padding-left:10px'>
<b>LDC</b>    place the constant <b>offset</b> in <b>r1</b>; ignore <b>r2</b>
<b>LDA</b>    place the address <b>address</b> in <b>r1</b>
<b>LD</b>     place the contents of data memory location <b>address</b> in <b>r1</b>
<b>ST</b>     place the contents of <b>r1</b> to data memory location <b>address</b>
</pre>
                                </code>
                            </li>
                            <li>
                                There are six RM opcodes for branching. If the value of <code>r1</code> satisfies the opcode's condition, then branch to the instruction at memory location <code>address</code>.
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:45em;padding-left:10px'>
<b>JEQ</b>    equal to 0
<b>JNE</b>    not equal to 0
<b>JLT</b>    less than 0
<b>JLE</b>    less than or equal to 0
<b>JGT</b>    greater than 0
<b>JGE</b>    greater than or equal to 0
</pre>
                                </code>
                            </li>
                            <li>
                                All arithmetic is done with registers (not memory locations) and on integers. Floating-point numbers must be simulated in the run-time system.
                            </li>
                            <li>
                                There are no restrictions on the usage of registers. For example, the source and target registers for an operation can be the same.
                            </li>
                            <li>
                                The note above is true of the program counter, Register 7. For example,
                                <ul>
                                    <li>To branch unconditionally to an instruction, a program can load the target address into the PC using an <code>LDA</code> instruction.</li>
                                    <li>To branch unconditionally to an instruction whose address is stored in data memory, a program can load the target address into the PC using an <code>LD</code> instruction.</li>
                                    <li>To branch conditionally to an instruction whose address is relative to the current position in the program, a program can use the PC as <code>r2</code> in any of the <code>jxx</code> instructions.</li>
                                </ul>
                            </li>
                        </ul>
                        </article>
                    <hr>
                    </section>
                </article>

                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <script>
            //Here's some code-smells for 'ya!
            let status = {"k_spec":true,"tm_spec":true,"phase_1":true,"phase_2":true,"phase_3":true,"phase_4":true,"phase_5":true,"phase_6":true,"phase_7":true};
            let status_map = {false:"none",true:"block"};
            let inner_html_map = {"k_spec":{false:"[ + ] Klein Language Specification",true:"[ - ] Klein Language Specification"}, "tm_spec":{false:"[ + ] TM Machine Specification", true:"[ - ] TM Machine Specification"}, "phase_1":{false:"[ + ] Phase 1: Scanner", true:"[ - ] Phase 1: Scanner"}, "phase_2":{false:"[ + ] Phase 2: Parser - Syntactic Analyzer", true:"[ - ] Phase 2: Parser - Syntactic Analyzer"}, "phase_3":{false:"[ + ] Phase 3: Parser - Abstract Syntax Tree", true:"[ - ] Phase 3: Parser - Abstract Syntax Tree"}, "phase_4":{false:"[ + ] Phase 4: Type Checker", true:"[ - ] Phase 4: Type Checker"}, "phase_5":{false:"[ + ] Phase 5: Code Generator - Environment", true:"[ - ] Phase 5: Code Generator - Environment"}, "phase_6":{false:"[ + ] Phase 6: Code Generator - Operations and Functions", true:"[ - ] Phase 6: Code Generator - Operations and Functions"}, "phase_7":{false:"[ + ] Phase 7: Project Conclusion", true:"[ - ] Phase 7: Project Conclusion"}}
            function reveal(id){
                status[id] = !status[id];
                document.getElementById(id).style.display = status_map[status[id]];
                document.getElementById(id+"_header").innerHTML = inner_html_map[id][status[id]];
            }

            reveal("k_spec");
            reveal("tm_spec");
            reveal("phase_1");
            reveal("phase_2");
            reveal("phase_3");
            reveal("phase_4");
            reveal("phase_5");
            reveal("phase_6");
            reveal("phase_7");
        </script>
    </body>
</html>
