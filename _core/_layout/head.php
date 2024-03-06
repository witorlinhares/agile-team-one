<?php
global $app;
global $seo_subtitle;
global $seo_description;
global $seo_keywords;
global $seo_image;
$insubdominiourl = ((explode('.', $_SERVER['HTTP_HOST'])));
// $insubdominiourl = array_shift((explode('.', $_SERVER['HTTP_HOST'])));

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php seo( "title" ); ?></title>
    <meta name="description" content="<?php seo( "description" ); ?>">
    <meta name="keywords" content="<?php seo( "keywords" ); ?>">
    <meta property="og:title" content="<?php echo seo_app( $seo_subtitle ); ?>">
    <meta property="og:description" content="<?php echo $seo_description; ?>">
    <meta property="og:image" content="<?php just_url(); ?>/_core/_cdn/img/favicon.png">
    <link rel="shortcut icon" href="<?php just_url(); ?>/_core/_cdn/img/favicon.png"/>
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/class.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/forms.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/typography.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/template.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/theme.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/default.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/lineicons/css/LineIcons.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/avatarPreview/css/filepreview.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/autocomplete/css/autocomplete.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/sidr/css/jquery.sidr.light.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/steps/css/jquery.steps.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/multiUpload/css/image-uploader.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/spectrum/css/spectrum.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/fonts/style.min.css">
    <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/fonts/logo/logofont.css">

    <?php system_header(); ?>

  </head>
  <body>

  <div class="processing">

    <div class="fullfit align">

        <div class="center">

            <i class="lni lni-reload rotating"></i>
            <span>
                Processando seu pedido...<br/>
                Por favor aguarde!
            </span>

        </div>

    </div>

  </div>

  <?php

  if(isset( $_GET['afiliado']) ) {
    $_SESSION['afiliado'] = mysqli_real_escape_string( $db_con, $_GET['afiliado'] );
  }

  ?>