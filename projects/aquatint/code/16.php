<?php
    $root_directory = "../../../";
    require($root_directory."code_header.php");
?>
query = function(filestring){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            result = this.responseText;
            finished = JSON.parse(result)[0];
            total = JSON.parse(result)[1];
            ratio = (finished/total) * 100;
            new_width = '' + ratio + "%";
            document.getElementById('progress-bar').style.width = new_width;
            progress_text_object = document.getElementById('progress-text');
            if(finished == 0){
                progress = JSON.parse(result)[2];
                progress_text_object.innerHTML = 'Step 1/'+total+'; Resizing and applying greyscale to original image: ' + Math.ceil(progress * 100) + '% complete.';
            }else if(finished == 1){
                progress_text_object.innerHTML = 'Step 2/'+total+'; Original image resized - Applying greycut...';
            }else if(finished == 2){
                progress_text_object.innerHTML = 'Step 3/'+total+'; Greycut applied - Applying temperature...';
            }else if(finished == 3){
                progress = JSON.parse(result)[2];
                progress_text_object.innerHTML = 'Step 4/'+total+'; Greycut and Temperature applied - Applying first sweep: ' + Math.ceil(progress * 100) + '% complete.';
            }else if(finished >= 4){
                progress = JSON.parse(result)[2];
                progress_text_object.innerHTML = 'Step '+(finished+1)+'/'+total+'; Applying sweep: ' + Math.ceil(progress * 100) + '% complete.';
            }
        }
    };
    xmlhttp.open("GET","status.php?id="+filestring,true);
    xmlhttp.send();
}
<?php
    require($root_directory."code_footer.html");
?>
