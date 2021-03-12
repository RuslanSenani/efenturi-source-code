<!DOCTYPE html>
<html lang='<?php echo get_lang('url_tag'); ?>' xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset='utf-8'>
  <title><?= $title; ?></title>
  <meta property="og:locale" content="<?php echo get_lang('url_tag'); ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?= $title; ?>" />
  <meta property="og:description" content="<?= $description; ?>" />
  <meta property="og:url" content="<?= rtrim(base_url(), '/') . $_SERVER['REQUEST_URI']; ?>" />
  <meta property="og:site_name" content="Efenturi" />
  <meta property="article:publisher" content="<?php echo $contact['facebook']; ?>" />
  <meta property="article:author" content="<?php echo $contact['facebook']; ?>" />
  <meta property="og:image" content="<?= $og_image; ?>" />
  <meta property="og:image:secure_url" content="<?= $og_image; ?>" />
  <meta property="og:image:width" content="500" />
  <meta property="og:image:height" content="500" />
  <meta property="og:image:alt" content="<?= $description; ?>" />
  <meta name="description" content="<?= $description; ?>" />
  <meta name="author" content="Efenturi Team" />
  <meta name="robots" content="<?= $seo_index == true ? 'index,follow' : 'noindex,nofollow'; ?>" />

  <meta name="googlebot" content="index,follow,all" />
  <meta name="resource-type" content="document" />
  <meta name="distribution" content="global" />
  <meta name="copyright" content="Saytlarin Hazirlanmasi" />
  <meta name="revisit-after" content="7" />

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0" />
  <meta name="google-site-verification" content="9wbOumUAvrozl7MTlZKoGdFTkHwYzDXkIBwrOb0pYuk" />
  <meta name="keywords" content="<?php echo $keywords; ?>" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@publisher_handle" />
  <meta name="twitter:title" content="<?= $title; ?>" />
  <meta name="twitter:description" content="<?= $description; ?>" />
  <meta name="twitter:creator" content="@author_handle" />
  <meta name="theme-color" content="#004052" />

  <link rel='icon' href='/assets/img/logo.ico' />
  <link rel="canonical" href="<?= rtrim(base_url(), '/') . $_SERVER['REQUEST_URI']; ?>" />
  <link rel='stylesheet' type='text/css' media="none" onload="if(media!='all')media='all'" href='<?= get_script('word/css/froala_style.css'); ?>' />
  <link rel="stylesheet" href="css/aos.css">
  <!-- fontawesome link -->
  <link rel="stylesheet" href="<?= get_script('css/all.css'); ?>">
  <!-- bootstrap link -->
  <link rel="stylesheet" href="<?= get_script('css/bootstrap.min.css'); ?>">
  <!-- font-family link -->
  <link rel="stylesheet" href="<?= get_script('css/css2.css'); ?>">
  <!-- modal js -->
  <link rel="stylesheet" href="<?= get_script('css/modal-video.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= get_script('css/style.css'); ?>">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/froala_editor.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/froala_style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/code_view.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/draggable.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/colors.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/emoticons.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/image_manager.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/image.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/line_breaker.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/table.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/char_counter.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/video.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/fullscreen.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/file.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/quick_insert.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/help.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/word/css/plugins/special_characters.css">

  <?= $css; ?>


</head>

<body itemscope itemtype="http://schema.org/WebPage" class="header_sticky">
  <input type="hidden" id="base_url" value="<?= base_url(); ?>" />