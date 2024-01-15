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
                        <hr>
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
                            <figcaption>
                            The hidden form input has an id of "file_name". Expand the following sections to see the relevant code-block for each tier of validation.
                            </figcaption>
                            <hr>
                        </figure>

                        <h3>Providing feedback</h3>
                        <p>
                            Once the validation check passes, <code>move_uploaded_files</code> is called such that the receiving file is given the random name generated within the hidden form. This new file's name will be used in concatenating a string to use for an <code>exec</code> call:
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$script = 'python3 aquatintScript.py "'.$target_file.'" '.$greycut.' '.$temperature.' '.$totalsweeps;
exec($script,$output,$result);
                            </pre>
                        </code>
                        <p>
                            All the user has to do now is wait for the aquatint script to complete; And wait they shall! Dependent on resolution, it may take a good amount of time for an image to process. The algorithm itself is at least quadratic in runtime, ignoring unknown runtime of any library method calls embedded within the iteration of pixels. This is compounded by the measly 1 gigabyte of ram and 2Ghz single core CPU that my LAMP server has access to. It is necessary to let the user know how far along the aquatint process is.
                        </p>
                        <p>
                            Some would rightfully claim that using exec is a code smell. It took a bit to convince myself that the steps described in the previous section are adequate to scrub input of malicious intent. In terms of running the aquatint script, a string is being passed that has been stripped of any POSIX compliant command. The same can be said in terms of the Python code embedded in the script itself.
                        </p>
                        <p>
                            Initial intuition for supplying a user progress-feedback was to leverage print statements in the aquatint script to expose progress through stdout. These print statements would occur upon the completion of significant steps within the script, such as when grey-scaling is finished. The problem here is the exec call is an atomic operation in the eyes of PHP. One could skirt around this by instead of leveraging a call to proc_open, but programming intuition has me believe this is an even greater code smell than using exec in the first place.
                        </p>
                        <p>
                            The propensity to lean towards leveraging stdout is likely related to the opening discussion of this article; it is influenced by experiences of studying computer science which has been heavily guided by interpretation of the stdout environment. Program state still can be relayed through other mechanisms, though. The solution to this problem was leveraging the ability to write to file instead of standard output.
                        </p>
                        <p>
                            The decision to write state to some file to be read by the app aligns more with the intuit of a web developer. Development of a Restful API has been the cornerstone of one significant projects throughout my studies. This was by means of a PHP project whilst attending community college. The span of time since then once again warranted practice for the sake of refilling a gap of knowledge. The process is as follows:
                        </p>
                        <p>
                          When the submission form is loaded, ensure the back-end automatically generates a filename. It's necessary to know the file-name before the submission is posted to the server. Write this string to the hidden form and write it to a json file that only the back-end may access. This file will serve as a map for the API endpoint to use.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
$file_name = '';
for($i = 0; $i &lt;= rand(10,20); $i++){
    $new_ord = rand(87,122);
    if($new_ord &gt;= 97){
        $file_name = $file_name . chr($new_ord);
    }else{
        $file_name = $file_name . $new_ord;
    }
}
$json = file_get_contents("map.json");
$json_data = json_decode($json,true);
$json_data[$file_name] = array("status" =&gt; 0, "time" =&gt; time());
file_put_contents("map.json",json_encode($json_data));
                            </pre>
                        </code>
                        <p>
                            Once the submit button is pressed, PHP will only serve the resulting page once all the program statements are completed. This includes the execution of the exec statement. This necessitates the need to have a filename pre-generated. Thus, add a Javascript event listener to the submission button to know when it is pressed. This event listener must know the string that represents the filename.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
&lt;div class='form-group'&gt;
    &lt;input type='submit' value='Upload Image' name='submit' onclick="submit_process('&lt;?php echo $file_name; ?&gt;');" /&gt;
    &lt;p id='wait' style='visibility:hidden;'&gt;&lt;b&gt;Please wait...&lt;/b&gt;&lt;/p&gt;
&lt;/div&gt;

&lt;div class="progress"&gt;
    &lt;div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 0%" &gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;div id='progress-text' class='alert alert-light'&gt;
&lt;/div&gt;
                            </pre>
                        </code>
                        <p>
                            Once submit is pressed, toggle a visual prompt for the user that they should wait. Trigger an interval loop which runs an AJAX query to the server's API endpoint to query for status. This query occurs once every three seconds.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
submit_process = function(filestring){
    document.getElementById("wait").style.visibility = "visible";
    setInterval(function(){
        query("&lt;?php echo $file_name;?&gt;");
    },3000);
}
                            </pre>
                        </code>
                        <p>
                            Once submit is pressed, the aquatint script will be run via the PHP script's exec command. Within the aquatint script, create a json file that resides in the uploads folder. This json file is prefixed with the name of the file to be written. It will contain entry points to indicate when a certain step of the algorithm is completed. It will also have a spot to indicate the progress of the current step being executed.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
status_dict = {"origin":False,"greycut":False,"temperature":False,"sweeps":dict(),"finished":0,"total":3+totalsweeps,"progress":0}

for i in range(0,totalsweeps):
    status_dict['sweeps']["sweep"+str(i)] = False

write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
                            </pre>
                        </code>
                        <p>
                            As the aquatint program is running, it will write to the file once a significant step is completed. Within each significant step, (usually embedded in an outer-loop), it will write a value indicating the percentage of the step completed. This will only be written for every 3% completed to save the amount of times the progress is written to this file.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
# !!! This is the same loop described earlier in the reading.
#     It has been expanded to allow progress reporting.
#     Note that this is only a subsection of the Aquatint script.

im2 = imageio.imread(filename)
Nix=im2.shape[0]
Niy=im2.shape[1]
grayimage=np.zeros([Nix,Niy])

rewrite_switch = True
for i in range(0,Nix):
        for j in range(0,Niy):
            blueComponent = im2[i][j][0]
            greenComponent = im2[i][j][1]
            redComponent = im2[i][j][2]
            grayValue = 0.07 * blueComponent + 0.72 * greenComponent + 0.21 * redComponent
            grayimage[i][j] = grayValue
            pass
        status_dict['progress'] = i / Nix
        if round((i * 100) / Nix) % 3 == 0:
            if rewrite_switch == True:
                write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
                rewrite_switch = False
        else:
            rewrite_switch = True
status_dict["progress"] = 0

dsqin=1-grayimage/255.0
hsimage=plt.imshow(dsqin,cmap='Greys',aspect=1,interpolation='none')
#cb = plt.colorbar(hsimage)
plt.savefig(filename.split('.')[-2]+'-origin.jpg',dpi=300)

status_dict["origin"] = True
status_dict['finished'] += 1
write_to_json(filename.split('.')[-2]+'-status.json',json.dumps(status_dict))
                            </pre>
                        </code>
                        <p>
                            As the user's browser is waiting for a post response, the AJAX method will be querying the endpoint and receiving new state written by the python script. The ajax call will work through a set of states which represent the completion of a certain step of the aquatint process. Percentage of a given step will be reported, and once a step is completed, a progress bar will be filled in.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
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
                            </pre>
                        </code>
                        <p>
                            For every query to the API endpoint, the PHP script will then look up the relevant json status file and report the relevant status. The AJAX query will make use of the returned information to fill in the relevant html elements to give the user a sense of progress.
                        </p>
                        <code>
                            <pre class='code' style='overflow:scroll;background-color:#f2f2f2;width:65vw;max-width:40em;padding-left:10px'>
&lt;?php
$not_ready = json_encode(array(0,0));

if(isset($_GET['id'])){
    $result = preg_match("/\A([a-z0-9]+)\z/",$_GET['id']);
    $valid = 0;
    if($result == 1){
        $json = file_get_contents("map.json");
        $json_data = json_decode($json,true);
        if(isset($json_data[$_GET['id']])){
            $valid = 1;
        }else{
            echo $not_ready;
        }
    }else{
        echo $not_ready;
    }
}else{
    echo $not_ready;
}

if($valid == 1){
    try{
        $json = file_get_contents("uploads/".$_GET['id']."-status.json");
        $json_data = json_decode($json,true);
        $return = array($json_data["finished"],$json_data["total"],$json_data['progress']);
        echo json_encode($return);
    }catch(Exception $ex){
        echo $not_ready;
    }
}
?&gt;
                            </pre>
                        </code>
                        <p>
                            To clean-up things on the server-side, every time the submission page is accessed, the back end will take a look at the mapping json file and keep all the items that are less than 30 minutes old. A cronjob also works on the server-side and deletes all files within the uploads folder that meets this criteria as well.
                        </p>
                        <h3>Finished product</h3>
                        <p>
                            The rest of the web app isn't worth elaborating upon. If a reader has been able to track what's been said thus far, the remaining details are both trivial and intuitive.
                        </p>
                        <p>
                            A working version of the web app can be viewed here: <a href=''>Aquatint Image Processor</a>. To label this as a finished project is a mischaracterization. Future work includes a cancel button that allows a user to discontinue waiting for an image to process within a sweep stage which would then forward them to a page with the most recent applied sweep.
                        </p>
                        <p>
                            Another potential vector of future work is to add a mechanism to allow a user to bookmark a completion page and refer to it later. This would be a trivial endeavor by implementing a query string that the API can use to look up and return the relevant images in the uploads folder. There is hesitance in implementing this. It is at odds with the scheduled cleanup of the uploads folder. This scheduled cleanup is a security necessity from both a systems perspective and a social perspective - I cannot verify, in real time, the contents of an image and thus must assume the worse. The regularly scheduled deletion of the images helps moderate this.
                        </p>
                        <p>
                            If any progress is made for this web app, it will be posted in a concluding notes section.
                        </p>
                        <hr>
                    <!--section class='info'>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section-->
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
                                          "validation_group_3":{false:"[ + ] Validation of numeric input",true:"[ - ] Validation of numeric input"}
                    }

                    function reveal(id){
                        status[id] = !status[id];
                        document.getElementById(id).style.display = status_map[status[id]];
                        document.getElementById(id+"_header").innerHTML = inner_html_map[id][status[id]];
                    }
                    reveal("validation_group_1");
                    reveal("validation_group_2");
                    reveal("validation_group_3");
                </script>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>

