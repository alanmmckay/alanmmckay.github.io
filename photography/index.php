<?php

$normalize = '../normalize.css';

$style = '../style.css';

$canonical = 'https://alanmckay.blog/photography/';

$title = 'Alan McKay | Photography';

$meta['title'] = 'Alan McKay | Photography';

$meta['description'] = '';

$meta['url'] = 'https://alanmckay.blog/photography/';

$relative_path = "../";

include('../header.php');

//vsco: width == 1012 kicks into displaying 5 in a row
//      width ==  768 kicks into displaying 4 in a row
//      width ==  543 kicks into displaying 3 in a row
//    Each column has display:grid; There exists a container of the columns that
//      has the same display property. The width of these columns sets the width
//      of the images via percentages and application of max-width.

// . Do a preliminary load of n images, where n is the max amount of columns.
// . Calculate the height of the smallest column
//      - This is a compound measurement of the height values of each image
//          within the column.
// . When a resize occurs which adds a new column, recalculate height of the
//      smallest column.
//      - Rebucket the images in the grid with respect to new quantity of cols
// . When the viewport is determined to be at a point where more images should
//      be loaded, add the next image to the col with the smallest height, re-
//      calculate the smallest column.

//I want to have fade-in animations for the new images being loaded. This can
//  be accomplished by creating a new figure tag whose display is initially set
//  to none.

//Would like to have a buffer of images loaded in which aren't displayed, and
//  the view-port trigger displays these images then loads in a new buffer.

//Need to consider the images.json file with respect to finding the order to
//  to load in these images. Should also create my own manifest datastructure.
?>
        <section id='writingsWrapper'>
            <section>
                <article>

                    <section class='info'>
                        <header>
                            <h2>Preface</h2>
                        </header>
                        <p>

                        </p>
                    <hr>
                    </section>

                    <header>
                        <h1>Photography</h1>
                    </header>
                    <div class='image-gallery' style='display:grid;grid-template-columns: repeat(3, minmax(0px,1fr));align-items:start;'>
                        <div class='image-col' style='display:grid;grid-template-columns: minmax(0px,1fr);'>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/01.jpg'/>
                            </figure>
                            <figure id='test' style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/02.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/03.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/04.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/12.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/13.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/14.jpg'/>
                            </figure>
                        </div>
                        <div class='image-col' style='display:grid'>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/05.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/06.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/07.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/08.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/15.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/16.jpg'/>
                            </figure>
                        </div>
                        <div class='image-col' style='display:grid'>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/09.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/10.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/11.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/18.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/19.jpg'/>
                            </figure>
                            <figure style='border-top:solid white 25px;opacity:0;'>
                                <img src='images/17.jpg'/>
                            </figure>
                        </div>
                    </div>
                    <section class='info'>
                        <hr>
                        <h3>Concluding notes</h3>
                        <p>

                        </p>
                        <hr>
                    </section>

                </article>
                <nav>
                    <a href='../'>Back</a>
                </nav>
            </section>
        </section>
        <script>
            var manifest;
            var manifest_tracker = 0;
            var columns = document.getElementsByClassName('image-col');
            var grid = document.getElementsByClassName('image-gallery')[0];

            async function get_manifest(){
                let manifest_response = await fetch("./manifest.json");
                if (manifest_response.ok){
                    let manifest_result = await manifest_response.json();
                    return manifest_result;
                }
            }

            function isFigureBottom(fig_object){
                fig_height = fig_object.getBoundingClientRect().height;
                fig_top = fig_object.getBoundingClientRect().y;
                if((window.pageYOffset + window.innerHeight) > (fig_top + (window.innerHeight * .1))){ 
                    return true;
                }else{
                    return false;
                }
            }

            function isColBottom(col_object){
                col_height = col_object.getBoundingClientRect().height;
                if((window.pageYOffset + window.innerHeight) > (grid.getBoundingClientRect().y + col_height)){
                    return true;
                }else{
                    return false;
                }
            }

            /* Adding this logic:
            var col_map = [];
            for(i=0;i<columns.length;i++){
                col_map[i] = [];
                col_map[i]['loaded'] = -1;
                col_map[i]['displayed'] = -1;
            }

            function grid_load_agent(){
                for(i=0;i<columns.length;i++){
                    if(col_map[i]['loaded'] = -1){
                        const figure = document.createElement('figure');
                        figure.style['border-top'] = 'solid 25px white';
                        figure.style['opacity'] = 0;
                        const image = document.createElement('img');
                        image.src = 'images/01.jpg';
                        figure.appendChild(image);
                        columns[i].appendChild(figure);
                        col_map[i]['loaded'] += 1;
                    }
                }
            }
            grid_load_agent();
            */

            function grid_display_agent(){
                for(i=0;i<3;i++){
                    col = columns[i];
                    figures = col.getElementsByTagName('figure');
                    for(j=0;j<figures.length;j++){
                        figure = figures[j];
                        if(isFigureBottom(figure)){
                            figure.style['opacity'] = 1;
                            figure.style['border-top'] = 'solid white 0px';
                        }else{
                            break;
                        }
                    }
                }
            }



            var parse_manifest;

            window.onscroll = function(){
                grid_display_agent();
            }

            window.addEventListener('load', function () {
                grid_display_agent();
                get_manifest().then(function(result){
                    manifest = result;
                    parse_manifest = function(){

                    }
                    parse_manifest();
                 });
            });



        </script>
    </body>
</html>

