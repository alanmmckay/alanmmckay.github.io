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
                </script>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
    </body>
</html>

