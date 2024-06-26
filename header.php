<?php

if(!isset($canonical)){
    $canonical = 'https://alanmckay.blog';
}

if(!isset($title)){
    $title = 'Alan McKay';
}

// $meta = [];

if(!isset($meta['title'])){
    $meta['title'] = 'Alan McKay | Blog';
}

if(!isset($meta['description'])){
    $meta['description'] = 'Blog site of Alan McKay. Directory for writings, projects, and social media. Computer Scientist and graduate student at the University of Iowa.';
}

if(!isset($meta['image'])){
    $meta['image'] = 'https://live.staticflickr.com/65535/51670361446_68f298f9fd_b.jpg';
}

if(!isset($meta['imageH'])){
    $meta['imageH'] = '627';
}

if(!isset($meta['imageW'])){
    $meta['imageW'] = '1200';
}

if(!isset($meta['url'])){
    $meta['url'] = 'https://alanmckay.blog/';
}

if(!isset($relative_path)){
    $relative_path = "";
}

if(!isset($style)){
    $style = $relative_path.'style.css?v=061424';
}

if(!isset($normalize)){
    $normalize = $relative_path.'normalize.css';
}
?>
<!DOCTYPE html>
<html prefix="og: https://ogp.me/ns#">
    <head>
        <meta charset='UTF-8' />
        <link rel='stylesheet' href='<?php echo $normalize;?>' />
        <link rel='stylesheet' href='<?php echo $style;?>' />
        <link rel='canonical' href='<?php echo $canonical;?>'/>
        <link rel='icon' type='image/x-icon' href='<?php echo $relative_path; ?>images/text-logo-grey.ico'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
        <title><?php echo $title;?></title>
        <meta name="author" content="Alan McKay" />
        <meta name='title' property='og:title' content='<?php echo $meta['title']?>' />
        <meta name='description'  property='og:description' content='<?php echo $meta['description'];?>' />
        <meta name='image' property='og:image' content='<?php echo $meta['image'];?>' />
        <meta property='og:image:height' content='<?php echo $meta['imageH'];?>' />
        <meta property='og:image:width' content='<?php echo $meta['imageW'];?>' />
        <meta property='og:type' content='website' />
        <meta property='og:url' content='<?php echo $meta['url'];?>' />
        <meta name='keywords' content='Alan McKay, Iowa, Iowa City, Cedar Falls, University of Iowa, University of Northern Iowa, UofI, UNI, Computer Science' />
    </head>
    <body>
