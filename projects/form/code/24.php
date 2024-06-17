<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
def create_form_error(object,method, flash_key = false, options = {:class => "alert-danger"})
    if flash_key and flash[flash_key] and flash[flash_key][method]
        label_tag (object.to_s + "_" + method.to_s).to_sym, flash[flash_key][method][0], options
    end
end
<?php
    require($root_directory."code_footer.html");
?>
