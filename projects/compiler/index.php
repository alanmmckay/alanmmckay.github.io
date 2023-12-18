<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'http://alanmckay.blog/projects/compiler/';

$title = 'Alan McKay | Project | Compiler';

$meta['title'] = 'Alan McKay | Compiler';

$meta['description'] = '';

$meta['url'] = 'http://alanmckay.blog/project/compiler/';

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
                            Detailed below is documentation of the project. A repository for the compiler can be found via GitHub.
                        </p>
                        <hr>
                    </section>
                    <header>
                        <h1>Project: Klein Compiler</h1>
                    </header>

                    <p>

                    </p>

                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <h3 id='k_spec_header' onclick='reveal("k_spec")'> [ + ] Klein Language Specification</h3>
                        <article id='k_spec' style='display:none;'>
                            <p>Klein is a small, mostly functional language that is designed specifically to be used as a manageable source language in a course on compiler design and implementation. Though small and simple, the language is Turing-complete.</p>

                            <h4>Grammar</h4>
                            <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:45em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:35em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:35em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
     x + y
     x - y
     x * y
     x / y
</pre>
                                    </code>
                                </li>
                                <li>
                                    <h5>Boolean Comparisons</h5>
                                    Compares two integers, yielding one of the boolean values <code>true</code> or <code>false</code>. <code>&lt;</code> yields <code>true</code> if its left operand is less than its right operand, and <code>false</code> otherwise. <code>=</code> yields true if its left operand has the same value as its right operand, and <code>false</code> otherwise.                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
     x &lt; y
     x = y
</pre>
                                    </code>
                                </li>
                                <li>
                                    <h5>Boolean Connectives</h5>
                                    Negates a single boolean value, or computes the disjunction or conjunction of two boolean values. The unary <code>not</code> yields <code>true</code> if its operand is <code>false</code>, and <code>false</code> otherwise. <code>or</code> yields <code>true</code> if either its left operand or its right operand yields <code>true</code>, and <code>false</code> otherwise. <code>and</code> yields <code>true</code> if both its left operand and its right operand yield <code>true</code>, and <code>false</code> otherwise.                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:15em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:35em;padding-left:10px'>
     function main( n : integer ) : integer
        if n &lt; 0
           then -n
           else n
</pre>
                                    </code>
                                    If this program were compiled into an executable file named <code>abs</code>, then running it under Unix might look something like this:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:35em;padding-left:10px'>
    mac os x > abs -3
    3
</pre>
                                    </code>
                                </li>
                            </ul>
                        </article>

                        <h3 id='tm_spec_header' onclick='reveal("tm_spec")'>[ + ] TM Machine Specification</h3>
                        <article id='tm_spec' style='display:none;'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:25em;padding-left:10px'>
    opcode r1,r2,r3
</pre>
                                    </code>
                                where the <code>ri</code> are legal registers.
                            </li>
                            <li>
                                These are the RO opcodes:
                                    <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:45em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:25em;padding-left:10px'>
    opcode r1,offset(r2)
</pre>
                                </code>
                                Where the <code>ri</code> are legal registers and <code>offset</code> is an integer offset. <code>offset</code> may be negative. With the exception of the <code>LDC</code> instruction, the expression <code>offset(r2)</code> is used to compute the address of a memory at location:
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:25em;padding-left:10px'>
    address = (contents of r2) + offset
</pre>
                                </code>
                            </li>
                            <li>
                                There are four RM opcodes for memory manipulation:
                                <code>
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:45em;padding-left:10px'>
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
<pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:90vw;max-width:45em;padding-left:10px'>
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
            let status = {"k_spec":false,"tm_spec":false};
            let status_map = {false:"none",true:"block"};
            let inner_html_map = {"k_spec":{false:"[ + ] Klein Language Specification",true:"[ - ] Klein Language Specification"}, "tm_spec":{false:"[ + ] TM Machine Specification", true:"[ - ] TM Machine Specification"}}
            function reveal(id){
                status[id] = !status[id];
                document.getElementById(id).style.display = status_map[status[id]];
                document.getElementById(id+"_header").innerHTML = inner_html_map[id][status[id]];
            }
        </script>
    </body>
</html>
