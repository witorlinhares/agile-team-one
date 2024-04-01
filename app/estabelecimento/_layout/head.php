<?php
global $app;
global $seo_subtitle;
global $seo_description;
global $seo_keywords;
global $seo_image;
var_dump("Subdominio URL: ".$insubdominiourl);
// $local = "0";
$local = isset($_GET['local']) ? $_GET['local'] : '0';

if( $local > 0 ) {
$_SESSION["local"] = $local;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    
    <title><?php echo seo_app( $seo_subtitle ); ?></title>
    <meta name="description" content="<?php echo $seo_description; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">

    <meta property="og:title" content="<?php echo seo_app( $seo_subtitle ); ?>">
    <meta property="og:description" content="<?php echo $seo_description; ?>">
    <meta property="og:image" content="<?php echo $seo_image; ?>">
    
    <link rel="shortcut icon" href="<?php echo $app['avatar']; ?>"/>

    <link rel="manifest" href="manifest.webmanifest">
   
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/class.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/forms.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/typography.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/template.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/theme.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/default.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/app/css/novo.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/lineicons/css/LineIcons.min.css">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/fonts/style.min.css">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/_core/_cdn/sidr/css/jquery.sidr.light.min.css">
    <link  href="<?php echo $app['url']; ?>/_core/_cdn/fancybox/css/jquery.fancybox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $app['url']; ?>/app/estabelecimento/css/style.php?id=<?php echo $app['id']; ?>">
    <script src="<?php echo $app['url']; ?>/_core/_cdn/jquery/js/jquery.min.js"></script>
    <script src="<?php echo $app['url']; ?>/_core/_cdn/fancybox/js/jquery.fancybox.min.js"></script>
    <!-- <script src="<?php echo $app['url']; ?>/_core/_cdn/instantclick/js/instantclick.min.js"></script> -->
    <script src="<?php echo $app['url']; ?>/app/estabelecimento/js/script.php?insubdominiourl=<?php echo $insubdominiourl; ?>&virtualpath=<?php echo $virtualpath; ?>"></script>
    <!-- TODO: inserir o script de integração do mercado pago -->
    <!-- Mercado Pago -->
    <script src="https://sdk.mercadopago.com/js/v2">
    </script>
    
    <?php system_header(); ?>

    <?php 
    if( $app['analytics'] ) { 
    $id_analytics = htmlentities( $app['analytics'] );
    ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id_analytics; ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?php echo $id_analytics; ?>');
    </script>

    <?php } ?>

    <?php 
    if( $app['pixel'] ) { 
    $id_pixel = htmlentities( $app['pixel'] );
    ?>

    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?php echo $id_pixel; ?>');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=<?php echo $id_pixel; ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

    <?php } ?>

    <?php 
    if( $app['html'] ) { 
    ?>

    <!-- HTML adicional -->

    <?php echo $app['html']; ?>

    <!-- / HTML adicional -->

    <?php } ?>

  </head>
  
  <body>

  <div id="main" class="body-estabelecimento">