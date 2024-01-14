<?php

$normalize = '../../normalize.css';

$style = '../../style.css';

$canonical = 'https://alanmckay.blog/projects/aquatint/';

$title = 'Alan McKay | Project | Aquatint';

$meta['title'] = 'Alan McKay | Aquatint';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/projects/aquatint/';

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
                            An appreciated facet of my life has been the happenstance connections I've made with a wide range of individuals. Despite having studied computer sciences for so long, most friendships and acquaintances were formed outside of the domain. This has been a strong theme in many of my writings, which often revolve around experiencing moments with this ever growing assorted group of individuals. During my graduate years, effort was spent casting a wider net.
                        </p>

                        <p>
                            The casting of the social net would land upon the university's bouldering wall. One thing that impressed me about the wall were the people who attended it. If one were to walk through the rec center a glance to the right would show isolated individuals trying their best to ignore each other taking silent turns taking advantage of equipment made for individual use. A glance to the left was stark; a climbing wall with a vibrant splay holds and groups of people accompanied by a positive murmur of discussion. Highlights of discussion include group strategy for approaching a given route and cheerful encouragement of one who was about finish a particular one.
                        </p>

                        <p>
                            Discussion would typically occur amongst pockets of individuals who were college aged - early to mid 20s. Fortunately, this wasn't a rule. Being a non-traditional student in their early 30s, it was easy for me to integrate. Considering social norms, I could understand how it would be a bit daunting to step into - especially if one were to look at the opposite side of the rec center. For this reason, I was sure to put effort forth to reciprocate the ease of experiencing the social perks of the climbing wall.
                        </p>

                        <p>
                            One such individual met through these circumstances was someone who seemed to be from a generation or two beyond me; an older gentleman who seemed to be learning the art of bouldering whilst enjoying the benefits the body-weight exercise and the associated skills of body awareness. Conversation was spurred by discussing a how to climb particular route.
                        </p>

                        <p>
                            Turns out this individual was a physics professor. Continued discussion would reveal that he was looking for a software engineer to make a user interface wrapper for an image processing script he had finished making. Providence would have it that I'm a computer scientist with a good amount of experience in software development with user interface design.
                        </p>

                        <p>
                            The script would reprocess an image to one that had the appearance of being produced using the aquatint printmaking technique. The product would be the same image with a more old-time aesthetic to it; the image would be more grainy with a warm temperature reminiscent of early photography.
                        </p>

                        <p>
                            The professor's script, through the web app I would end up building, would be used to produce three pieces of building art for the Physics Research Center at the University of Chicago. It's fitting that a serendipitous connection at a climbing wall would manifest on a wall at an educational institution elsewhere.
                        </p>

                        <p>
                            The main body of this page discusses three primary facets of the web app that I find interesting: handling of the original script, upload security, and supplying feedback to a user.
                        </p>
                    <hr>
                    </section>
                    <header>
                        <h1>Web Development: Aquatint Image Processor</h1>
                    </header>
                    <h2>Interpretation of the original Python script</h2>
                    <p>
                            It seems to be typical for other academic domains to produce code within in a Jupyter notebook. The advantage here is it allows the output of running the code to be interspersed within the script itself; contrary to being produced in a mutually exclusive environment, (such as stdout or some log file). This makes sense given the context of a computer scientist as someone who is moulded in such a manner to think a like a machine - one that is able to easily parse through such output.
                        </p>
                        <p>
                            An advantage to being provided a script within a Jupyter notebook is that it's easier to discern the sections the developer finds important. The script received from Professor Meurice took advantage of matplotlib to display the reprocessed images. Within the notebook, each significant step was capped by a display of the reprocessed image as-in progress. For example, the first significant step of the algorithm was to apply a grey-scale to each individual pixel. A given image would be read in using the imageio library then processed as such:
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
im2 = imageio.imread(filename)
Nix=im2.shape[0]
Niy=im2.shape[1]
grayimage=np.zeros([Nix,Niy])
for i in range(0,Nix):
        for j in range(0,Niy):
            blueComponent = im2[i][j][0]
            greenComponent = im2[i][j][1]
            redComponent = im2[i][j][2]
            grayValue = 0.07 * blueComponent + 0.72 * greenComponent + 0.21 * redComponent
            grayimage[i][j] = grayValue
            pass
dsqin=1-grayimage/255.0
hsimage=plt.imshow(dsqin,cmap='Greys',aspect=1,interpolation='none')
plt.colorbar(hsimage)
plt.show(hsimage)
                            </pre>
                        </code>
                        <p>
                            An import of matplotlib.pyplot as plt preceded this block. Knowing this, take note of the usage of pyplot's show method near the end of the code snippet.
                        </p>
                        <p>
                            The set of images produced in the notebook, along with various textual/comment blocks, made it easy to discover a set of variables that can be chosen by a user to tune the appearance of an image that has been processed by the aquatint script. These variables are a greycut, temperature, and the amount of sweeps to be applied.
                        </p>
                        <p>
                            Greycut was well defined within the documentation of the notebook:
                            <blockquote>
                                The output image will have only black and white pixels so it is a good exercise to convert the original one to this form. Provide a greycut (contrast) number between 0 and 1. This converts the grey pixels into black (above greycut) and white (below greycut).
                            </blockquote>
                        </p>
                        <p>
                            The other values weren't clearly defined within the notebook itself. Since the product of the script is of visual nature, this provided an opportunity to produce something which visually informs one what the variance in these values can produce. This would require a combinatoric production of the same image using a valid range of values of these variables. I refactored the code from the Jupyter notebook into an external python file and ran the following bash script:
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
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
                            </pre>
                        </code>
                        <p>
                            The ranges of the loops were restricted to keep a reasonable runtime of this process. A lot of the image processing is dependent on the amount of pixels contained in a given image, so the input image size was kept low enough whilst ensuring enough pixels were available to gauge the differences the other input parameters bring to the process.
                        </p>
                        <p>
                            One-hundred and twenty-five images in total were produced on account of running the bash script. Those who have javascript enabled for this page can view the effect of each variable, (with respect to the values set for the others), within the following figure:
                        </p>
                        <figure>
                            <div id='image-bucket'>
                            </div>
                            <figcaption>
                                <label for='greycutSlider'>Greycut:</label>
                                <input type="range" min="0.1" max="0.9" id="greycutSlider" value="0.5" step="0.2" style='width:95%;' oninput="setSliderVal('greycutSlider',0,false)"/>

                                <p style='margin-top:0px'>Value: <span id='greycutSliderVal'> </span></p>

                                <label for='temperatureSlider'>Temperature:</label>
                                <input type="range" min="1" max="9" id="temperatureSlider" value="5" step="2" style='width:95%;' oninput="setSliderVal('temperatureSlider',0,false)"/>

                                <p style='margin-top:0px'>Value: <span id='temperatureSliderVal'> </span></p>

                                <label for='sweepSlider' style='text-align:left'>Sweeps:</label>
                                <input type="range" min="1" max="5" id="sweepSlider" value="1" step="1" style='width:95%;' oninput="setSliderVal('sweepSlider',0,false)"/>

                                <p style='margin-top:0px'>Value: <span id='sweepSliderVal'> </span></p>

                            </figcaption>
                        </figure>
                        <p>
                            The view provided here helps establish the set of user controls needed to actually implement the web app.
                        </p>
                        <h2>The Web App</h2>
                        <p>
                            What's been discussed so far has involved Jupyter notebooks, python, and bash scripting. These are technologies not often associated with the core of web development. A utilitarian product needed to be produced with a hint of time constraint. Thus, I opted for using the Bootstrap framework to handle the front-end styling. The view provided by the previous figure implies that Javascript is also at play for the web app. Finally, an engine was needed to process the uploads.
                        </p>
                        <p>
                            My experience using Python as a web server back-end is minimal. It is likely that using Python here would lend well to the situation considering the aquatint scripts were written in the language. At the time, I had no experience handling file uploads. The back-end most familiar to me was PHP. Thus I decided to take the opportunity to shore up that gap in my experience with the language.
                        </p>
                        <h3>Upload Security</h3>
                        <p>
                            The upload form consists of three sliders and a file upload box. It needs to be ensured that the selections for the sliders are numbers that reside in a specific range. It also needs to be ensured that the file being uploaded is indeed an image with an applicable type. It is not sufficient to rely on the constraints set forth by the front-end in general. Any individual can change the arbitrary restrictions by these mechanisms through the element inspector or by circumventing a browser environment altogether by means of an http post with some other program.
                        </p>
                        <p>
                            The assurance of valid slider input is trivial through the back-end logic. Each slider has an id associated with the control. On submission post, PHP will check whether the posted values are numeric and whether they exist in the expected range. Assurance that a given file is indeed an image is another story.
                        </p>
                        <p>
                            An individual who is used to operating in computing environments which abstract away file information from the user may think it's sufficient to simply check the extension as its given in the file name. Any power user, (or any user of a linux distribution), will know this is lacking.
                        </p>
                        <p>
                            The key methods used to ensure image upload are <code>basename</code>, <code>pathinfo</code>, <code>exif_imagetype</code>, and <code>image_type_to_mime_type</code>.
                        </p>
                        <p>
                            The <code>basename</code> function is used to truncate any attempts to submit a filename that attempts to traverse the server's file system. Consider a post variable with the identifier of uploadImage:
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$origin_file = $target_dir . basename($_FILES['uploadImage']['name']);
                            </pre>
                        </code>
                        <p>
                            The <code>pathinfo</code> function is used to isolate the extension of the filename string. Contrary to sentiment posed in paragraphs prior, this is still worthy of checking to provide useful feedback for those who are making sincere attempts at using the application.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$imageFileType = strtolower(pathinfo($target_dir . $origin_file,PATHINFO_EXTENSION));
                            </pre>
                        </code>
                        <p>
                            The <code>exif_imagetype</code> function provides a means within PHP to drill down into byte-level to validate file structure. This is validated further by <code>image_type_to_mime_type</code> which makes use of Apache's <code>mime_magic</code> module to make the same assurance.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$target_file = $target_dir . $file_name  . "." . $imageFileType;
                            </pre>
                        </code>
                        <p>
                            These functions are used in conjunction with safe system administration procedure. Within the linux environment, proper(ly strict) permissions are granted to the upload folder and Apache configuration restricts file-type access to the folder to only allow access to what is relevant.
                        </p>
                        <p>
                            Slider and file selection input has been validated. A keen observer will discover a hidden input form. A decision was made to assign a random name to the uploaded file as it is placed into the upload folder. This is an attempt to decouple any malicious attempts at file system traversal and malicious script execution vectors that the previous measures may have missed. The back-end generates this random string as the template for the submission page is built.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$check = exif_imagetype($_FILES['uploadImage']['tmp_name']);
$mimeType = image_type_to_mime_type($check);
                            </pre>
                        </code>
                        <p>
                            A hidden input form was opted instead of using a query string to embed this information. The reason for this was to keep the submission url clean. Another reason involves the necessity to know the filename before any submission is made! This relates to giving the user feedback of progress once they've made a submission.
                        </p>
                        <figure>
                            <hr>
                            <h4 id='validation_group_1_header' onclick='reveal("validation_group_1")' class='expandable'>[ - ] Validation of strings</h4>
                            <code id='validation_group_1'>
                                <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$target_dir = 'uploads/';
$uploadOk = 1;

//Validate string form controls:
if(isset($_POST['file_name']) &amp;&amp; isset($_FILES['uploadImage']['name'])){
    if(strlen($_FILES['uploadImage']['name']) &lt;= 0 || strlen($_POST['file_name']) &lt;= 0){
        $uploadOk = 0;
    }else{
        $preg_result = preg_match("/\A([a-z0-9]+)\z/",$_POST['file_name']);
        if($preg_result == 0){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Please refrain from altering hidden form.&lt;/div&gt;';
            $uploadOk = 0;
        }
    }

    if($uploadOk == 1){
        $file_name = $_POST['file_name'];
        $origin_file = $target_dir . basename($_FILES['uploadImage']['name']);
        $imageFileType = strtolower(pathinfo($target_dir . $origin_file,PATHINFO_EXTENSION));
        $target_file = $target_dir . $file_name  . "." . $imageFileType;
        $check = exif_imagetype($_FILES['uploadImage']['tmp_name']);
        $mimeType = image_type_to_mime_type($check);
    }
}else{
    $uploadOk = 0;
}
                                </pre>
                            </code>
                            <h4 id='validation_group_2_header' onclick='reveal("validation_group_2")' class='expandable'>[ - ] Validation of filetype</h4>
                            <code id='validation_group_2'>
                                <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
//Validate filetype:
if($uploadOk == 1 ){
    if($check !== false){
        //$uploadOk = 1;
        if($_FILES['uploadImage']['size'] &gt; 1048576){
            echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Sorry, your file is too large.&lt;/div&gt;';
            $uploadOk = 0;
        }
    }else{
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; File is not an image.&lt;/div&gt;';
        $uploadOk = 0;
    }

    if( ($imageFileType != 'jpg') &amp;&amp; ($imageFileType != 'png') &amp;&amp; ($imageFileType != 'jpeg') &amp;&amp; ($imageFileType != 'gif') ){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Only jpg, jpeg, png, and gif files are allowed.&lt;/div&gt;';
        $uploadOk = 0;
    }else

    if( ($mimeType != 'image/gif') &amp;&amp; ($mimeType != 'image/jpeg') &amp;&amp; ($mimeType != 'image/png') ){
        echo '&lt;div class="alert alert-danger"&gt;&lt;strong&gt;Warning!&lt;/strong&gt; Only jpg, jpeg, png, and gif files are allowed.&lt;/div&gt;';
        $uploadOk = 0;
    }

}
                                </pre>
                            </code>
                            <h4 id='validation_group_3_header' onclick='reveal("validation_group_3")' class='expandable'>[ - ] Validation of numeric input</h4>
                            <code id='validation_group_3'>
                                <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
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
                                </pre>
                            </code>
                            <h4 id='validation_group_4_header' onclick='reveal("validation_group_4")' class='expandable'>[ - ] Validation success</h4>
                            <code id='validation_group_4'>
                                <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
if($uploadOk == 0){
    echo '&lt;div class="alert alert-warning"&gt;Your file was not uploaded.&lt;/div&gt;';
}else{
    echo '&lt;div class="alert alert-info"&gt;&lt;a href="submit.php" class="alert-link"&gt;Process a new image&lt;/a&gt;&lt;/div&gt;';
    if (move_uploaded_file($_FILES['uploadImage']['tmp_name'], $target_file)){

        $fileName = pathinfo($target_file);
        $prefix = $fileName['filename'];
        $suffix = $fileName['extension'];
        $new_file = $target_dir.$prefix.'-aquatint.jpg';

        $script = 'python3 aquatintScript.py "'.$target_file.'" ';
        $script = $script.$greycut.' ';
        $script = $script.$temperature.' ';
        $script = $script.$totalsweeps;

        exec($script,$output,$result);
        if(count($output) == 0 and $result == 0){
            ...
            ...
            ...
                                </pre>
                            </code>
                            <figcaption>
                                The hidden form input has an id of "file_name". Expand the following sections to see the relevant code-block for each tier of validation.
                            </figcaption>
                        <hr>
                        </figure>
                        <h3>Providing feedback</h3>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section>
                </article>
                <script>

                    var bucket = document.getElementById('image-bucket');
                    for(i=1;i<=9;i+=2){
                        greycut_value = "0."+i;
                        for(j=1;j<=9;j+=2){
                            temperature_value = j+".0";
                            for(k=1;k<=5;k++){
                                sweep_value = k;
                                file_name = greycut_value+"_"+temperature_value+"_"+sweep_value;
                                file_name = file_name + "-cycle_resize-aquatint.png";
                                new_image = document.createElement('img');
                                new_image.setAttribute('src','generate_png/'+file_name);
                                new_image.setAttribute('id',greycut_value+"_"+temperature_value+"_"+sweep_value);
                                if(!(i == 5 && j == 5 && k == 1)){
                                    new_image.style.display = 'none';
                                }
                                bucket.appendChild(new_image);
                            }
                        }
                    }

                    var current_greycut = 0.5;
                    var current_temp = 5.0;
                    var current_sweep = 1;
                    var current_file_name = greycut_value+"_"+temperature_value+"_"+sweep_value;
                    var current_file_name = current_file_name + "-cycle_resize-aquatint.png";

                    setSliderVal = function(sliderName,skew,init){
                        slider = document.getElementById(sliderName);
                        output = document.getElementById(sliderName+'Val');
                        output.innerHTML =  Number(slider.value)+skew;
                        old_id = current_greycut+"_"+current_temp+".0_"+current_sweep;
                        if(init == false){
                            document.getElementById(old_id).style.display = "none";
                        }
                        if(sliderName == 'greycutSlider'){
                            current_greycut = slider.value;
                        }else if(sliderName == 'temperatureSlider'){
                            current_temp = slider.value;
                        }else if(sliderName == 'sweepSlider'){
                            current_sweep = slider.value;
                        }
                        new_id = current_greycut+"_"+current_temp+".0_"+current_sweep;
                        document.getElementById(new_id).style.display = 'block';
                        return (Number(slider.value) + skew);
                    }

                    setSliderVal('greycutSlider',0,true);
                    setSliderVal('temperatureSlider',0,true);
                    setSliderVal('sweepSlider',0,true);

                    let status ={"validation_group_1":true,"validation_group_2":true,"validation_group_3":true,"validation_group_4":true};
                    let status_map = {false:"none",true:"block"};
                    let inner_html_map = {"validation_group_1":{false:"[ + ] Validation of strings",true:"[ - ] Validation of strings"},
                                          "validation_group_2":{false:"[ + ] Validation of filetype",true:"[ - ] Validation of filetype"},
                                          "validation_group_3":{false:"[ + ] Validation of numeric input",true:"[ - ] Validation of numeric input"},
                                          "validation_group_4":{false:"[ + ] Validation success",true:"[ - ] Validation success"}
                    }

                    function reveal(id){
                        status[id] = !status[id];
                        document.getElementById(id).style.display = status_map[status[id]];
                        document.getElementById(id+"_header").innerHTML = inner_html_map[id][status[id]];
                    }
                    reveal("validation_group_1");
                    reveal("validation_group_2");
                    reveal("validation_group_3");
                    reveal("validation_group_4");
                </script>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>

