<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
Q = {L,H}
Σ = {L,H}
ι(x) = x
ω(x) = x
δ = {
    (L,L) -> (L,L),
    (L,H) -> (H,H),
    (H,L) -> (H,H),
    (H, H) -> (H,H)
    }
<?php
    require($root_directory."code_footer.html");
?>
