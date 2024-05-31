<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
<b>IN</b>      read an integer from stdin and place result in <b>r1</b>; ignore operands <b>r2</b> and <b>r3</b>
<b>OUT</b>     write contents of <b>r1</b> to stdout; ignore operands <b>r2</b> and <b>r3</b>
<b>ADD</b>     add contents of <b>r2</b> and <b>r3</b> and place result in <b>r1</b>
<b>SUB</b>     subtract contents of <b>r3</b> from contents of <b>r2</b> and place result in <b>r1</b>
<b>MUL</b>     multiply contents of <b>r2</b> and contents of <b>r3</b> and place result in <b>r1</b>
<b>DIV</b>     divide contents of <b>r2</b> by contents of <b>r3</b> and place result in <b>r1</b>
<b>HALT</b>    ignore operands and terminate the machine
<?php
    require($root_directory."code_footer.html");
?>
