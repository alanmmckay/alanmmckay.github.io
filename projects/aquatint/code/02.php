<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
sweeps=1
while [ $sweeps -le 5 ]
do
    greycut=1
    while [ $greycut -le 9 ]
    do
        greycut_float=`bc &lt;&lt;&lt; "scale=2; ${greycut}/10"`
        temperature=1
        while [ $temperature -le 9 ]
        do
            `python3 "aquatintScript.py" "cycle.png" $greycut_float $temperature $sweeps`
            temperature=`expr $temperature + 2`
        done
        greycut=`expr $greycut + 2`
    done
    sweeps=`expr $sweeps + 1`
done
<?php
    require($root_directory."code_footer.html");
?>
