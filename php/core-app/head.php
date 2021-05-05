<?php include('config.php');?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
        <title><?= (isset(PAGE['TITLE']))?@PAGE['TITLE']:""?></title>
        
        <?php if(isset(PAGE['description'])){?><meta name="description" content='<?= (isset(PAGE['description']))?@PAGE['description']:""?>' /><?php }?> 
        <?php if(isset(PAGE['keywords'])){?><meta name="keywords" content='<?= (isset(PAGE['keywords']))?@PAGE['keywords']:""?>' /><?php }?> 
        
        <!-- Facebook -->
        <?php if(isset(PAGE['TITLE'])){?><meta property="og:title" content='<?= (isset(PAGE['TITLE']))?@PAGE['TITLE']:""?>' /><?php }?> 
        <?php if(isset(PAGE['description'])){?><meta property="og:description" content='<?= (isset(PAGE['description']))?@PAGE['description']:""?>' /><?php }?> 
        
        <!-- Twitter -->
        <?php if(isset(PAGE['TITLE'])){?><meta name="twitter:title" content='<?= (isset(PAGE['TITLE']))?@PAGE['TITLE']:""?>'><?php }?> 
        <?php if(isset(PAGE['description'])){?><meta name="twitter:description" content='<?= (isset(PAGE['description']))?@PAGE['description']:""?>'><?php }?> 

        <meta name="theme-color" content="#000000">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="Universe Business">
        <meta name="apple-mobile-web-app-status-bar-style" content="white">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="format-detection" content="telephone=no">

        <meta name="google" content="notranslate">
        <meta name="author" content="Website author">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@Website">
        <meta name="twitter:creator" content="@Website">
        <meta property="twitter:url" content="Website Url">
        <meta property="twitter:image" content="Website images">
        
        <!-- Facebook -->
        <meta property="og:url" content="Website Url">
        <meta property="og:image" content="Website images">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Website name">
        
        <!-- Preconnect to CDNs -->
        <link rel="preconnect" href="https://code.jquery.com" crossorigin="anonymous">
        
        <!-- fancybox -->
        <link href="<?=getUrl('assets/css/jquery.fancybox.min.css')?>" rel="stylesheet" type="text/css">
        
        <!-- favicon.ico -->
        <link rel="icon" sizes="192x192" href="<?=getUrl('assets/images/favicon.png')?>">
        <link rel="apple-touch-icon" href="<?=getUrl('assets/images/favicon.png')?>">
        <link rel="mask-icon" href="<?=getUrl('assets/images/favicon.png')?>" color="#000000">
        
        <!-- Custom CSS -->
        <link href="<?=getUrl('assets/css/print.css')?>" rel="stylesheet" type="text/css">
        <link href="<?=getUrl('assets/css/style.css')?>" rel="stylesheet" type="text/css">
        
        <script type="text/javascript">
            var BASE_URL = "<?=getBaseUrl()?>";
        </script>
    </head>
    