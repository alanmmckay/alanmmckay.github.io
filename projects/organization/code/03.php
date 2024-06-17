<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
01    # --- --- --- --- --- --- #
02    sum:
03    # Two arguments $a0 (memory address of list) and $a1 (length value of list)
04
05    li $s0  0         #total &lt;- 0
06    li $s1  0         #index &lt;- 0
07    li $s2  $a0       #point to the base address of the array
08
09    # ---
10    sum_loop_condition:
11
12    bge $s1 $a1 end_loop
13
14    mult $s2 $s1 4    #adjust index offset
15    add  $s2 $s2 $a0  #point to the next value of the array
16
17    lw $s2 0($s2)     #access the value within array
18
19    add $s0 $s0 $s2   #add value to the total
20
21    addi $s1 $s1 1    #increment index
22
23    j sum_loop_condition
24
25    # ---
26    end_loop:
27    move $v0 $s0      #place total into return register
28    jr $ra            #return to caller
29    # --- --- --- --- --- --- #
<?php
    require($root_directory."code_footer.html");
?>
