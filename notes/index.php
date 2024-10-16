<?php

$canonical = 'https://alanmckay.blog/projects/';

$title = 'Alan McKay | Projects';

$meta['title'] = 'Alan McKay | Projects';

$meta['description'] = "Index of articles detailing various programming projects worked on. All related to Computer Science from the context of assessment, freelance, and/or interest.";

$meta['url'] = 'https://alanmckay.blog/projects/';

$relative_path = "../";

include('../header.php');

$json_str = file_get_contents("catalog.js");
$json = json_decode($json_str,true);

?>
        <div id='homeWrapper' class='descriptive'>
            <header id='breadNav' style='overflow:hidden'>
                <h1><a href='./' class='currentLink'>&nbsp;&gt; Notes</a></h1>
                <h1><a href='../'>Home</a></h1>
            </header>
            <nav>
                <div class='currentLink'>
                    <a href='./'>
                        <img src='../images/notes.svg' alt='Icon for blog link'>
                        Notes
                    </a>
                </div>
<?php
    foreach($json as $key){
        if(is_array($key)){
            /* Schema:
             * {
             *   "location":String,
             *   "name":String,
             *   "date_published":String,
             *   "description":String,
             *   "tags":Array,
             *   "parent":
             *    {
             *      "name":Sring,
             *      "url":"subfolders_from_notes_excluding_notes/"
             *    }
             * }
            */
            $info = $key;
            $key = $info['location'];
        }else{
            $info_str = file_get_contents($key."/meta.js");
            $info = json_decode($info_str,true);
        }
?>
                <div class='writing'>
                    <a href="<?php echo $key ?>/" style='display:inherit;'>
                        <span><?php echo $info['name'] ?></span>
                        <p>
                            <?php echo $info['description'] ?>
                        </p>
<?php
        if(isset($info['tags']) && count($info) > 0){
?>
                    <ul>
<?php
            foreach($info['tags'] as $tag){
?>
                        <li><?php echo $tag; ?></li>
<?php
            }
?>
                    </ul>
<?php
        }
?>
                    <p><?php echo $info['date_published']; ?></p>
                </div>
<?php
    }
?>
                    </a>
            </nav>
        </div>
    </body>
    <script src='../js/index_functions.js' ></script>
    <script>

        var isMobile = window.matchMedia || window.msMatchMedia;
        isMobile = isMobile("(pointer:coarse)").matches;

        if(isMobile){

            let scroll_end = null;

            window.onscroll = function(ev){
                if(scroll_end != null){clearTimeout(scroll_end);}
                applyClassTransitionEffects('writing', 'border-left', 'solid white 10px', '.5s', 'solid #778088 2px', '1s', 35);
                scroll_end = setTimeout(function(){
                    primeClassTransitions("writing","border-left","solid 2px","2s",true);
                },750);
            }

            window.onscrollend = function(ev){
                primeClassTransitions("writing","border-left","solid 2px","2s",true);
            }

            window.addEventListener('load', function () {
                setTimeout(function(){
                    primeClassTransitions("writing","border-left","solid 2px","2s",false);
                },100);
            });

        }

    </script>
</html>
