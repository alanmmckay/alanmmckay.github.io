<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
//Validate numeric form controls:
if($uploadOk == 1){

    //Greycut:
    try{
        $greycut = (float) $_POST['greycut'];
        if($greycut &lt; 0 || $greycut &gt; 1){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
            $uploadOk = 0;
        }else{
            $greycut = (string) $greycut;
        }
    }catch (Exception $ex){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
        $uploadOk = 0;
    }

    //Temperature:
    try{
        $temperature = (float) $_POST['temperature'];
        if($temperature &lt; 0.1 || $temperature &gt; 10){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
            $uploadOk = 0;
        }else{
            $temperature = (string) $temperature;
        }
    }catch (Exception $ex){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
        $uploadOk = 0;
    }

    //Total Sweeps:
    try{
        $totalsweeps = (float) $_POST['totalsweeps'];
        if($totalsweeps &lt; 1 || $totalsweeps &gt; 10){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
            $uploadOk = 0;
        }else{
            $totalsweeps = (string) $totalsweeps;
        }
    }catch (Exception $ex){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from changing form values with the element inspector.&lt;/div&gt;';
        $uploadOk = 0;
    }

}
<?php
    require($root_directory."code_footer.html");
?>
