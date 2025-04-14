<?php

$canonical = 'https://alanmckay.blog/'.substr(__DIR__,14,strlen(__DIR__)-14);

$title = "Alan McKay | Projects | Graduate Application Portal";

$meta['title'] = "Alan McKay | Graduate Application Portal";

$meta['description'] = 'Description and motivation of a Ruby on Rails project developing an application portal for a graduate school.';

$meta['url'] = 'https://alanmckay.blog/'.substr(__DIR__,14,strlen(__DIR__)-14);

$internal_styles = "
        .one-half{
            width:50%;
            margin:auto;
        }

        @media screen and (max-width:600px){
            .one-half{
                width:100%;
            }
        }
        .note li p:has(> code), .note li:has(> code){
            display:inherit;
            text-align:inherit;
        }
";

$GLOBALS['relative_path'] = "../../";
$origin_path = substr($GLOBALS['relative_path'],3,strlen($GLOBALS['relative_path'])-3);
include($relative_path.'header.php');

produce_front_matter("Graduate Application Portal","Projects",array("id"=>"'writingsWrapper'","class"=>"'note'"));

$info_str = file_get_contents("meta.js");
$info = json_decode($info_str,true);

?>
                    <section class='info'>
                        <header>
                            <h2>Metadata:</h2>
                        </header>
                        <p>
                            <?php echo $info['description']; ?> <br>- Initially published on <?php echo $info['date_published']; ?>.
                            <?php
                                if(isset($info['date_updated'])){
                                    echo " Last updated on ".$origin_path.$info['date_updated'].".";
                                }
                                if(isset($info['parent'])){
                                    echo "<br>- <i>Parent note</i>: <a href='".$origin_path.$info['parent']['url']."'>".$info['parent']['name']."</a>";
                                }
                            ?>
                        </p>
                        <hr>
                    </section>
<?php

$file_ref = "index.md";
include($origin_path.'../markdown_converter.php');

?>
                </article>
                <nav>
                    <a href='<?php echo $origin_path;?>'>Back</a>
                </nav>
            </section>
        </section>
    <script src='<?php echo $relative_path; ?>js/project_functions.js'></script>
    <script>
        window.addEventListener('load', function(){setCodeSizeSliders(16)});
    </script>
    </body>
</html>
