<?php
// CORE
include('../_core/_includes/config.php');
// SEO
$seo_subtitle = "Login";
$seo_description = "";
$seo_keywords = "";
// HEADER
$system_header = "";
// CHECK LOGGED
if( $_SESSION['user']['logged'] == "1" ) {

	if( $_SESSION['user']['level'] == "1" ) {
		header("Location: ../administracao/inicio");
	}

	if( $_SESSION['user']['level'] == "2" ) {
		header("Location: ../painel/inicio");
	}

}
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
		<link rel="manifest" href="<?php just_url(); ?>/login/manifest.json" />
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/class.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/forms.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/typography.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/template.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/theme.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/default.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/lineicons/css/LineIcons.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<!-- <link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/fonts/style.min.css"> -->
		<?php system_header(); ?>
	</head>
	<body>
	    
	    <script>
// This is the service worker with the Cache-first network
// Add this below content to your HTML page, or add the js file to your page at the very top to register service worker
// Check compatibility for the browser we're running this in
if ("serviceWorker" in navigator) {
 if (navigator.serviceWorker.controller) {
 console.log("[PWA Builder] active service worker found, no need to register");
 } else {
 // Register the service worker
 navigator.serviceWorker
 .register("<?php just_url(); ?>/login/pwabuilder-sw.js", {
 scope: "./"
 })
 .then(function (reg) {
 console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
 });
 }
}
</script>

		<?php

		$redirect = mysqli_real_escape_string( $db_con, $_GET['redirect'] );
		// if( !$redirect) {
		// 	$redirect = ($_SERVER['HTTP_REFERER']);
		// }
		$email = strtolower( mysqli_real_escape_string( $db_con, $_POST['email'] ) );
		$pass = mysqli_real_escape_string( $db_con, $_POST['pass'] );
		$keepalive = mysqli_real_escape_string( $db_con, $_POST['keepalive'] );
		if( !$keepalive ) {
			$keepalive = 0;
		}
		$method = "login";

		if( notnull($email) && notnull($pass) ) {

			if( make_login( $email,$pass,$method,$keepalive ) ) {

				if( $redirect ) {
					header("Location: ".$redirect);
				} else {
					header("Location: index.php");
				}

			} else {

				header("Location: index.php?msg=erro&email=".$email."&redirect=".$redirect);

			}

		}


		?>

		<div class="bg-gray fullfit">

			<div class="container">

				<div class="row">

					<div class="col-md-12">

						<div class="login">

							<form method="POST" action="<?php just_url(); ?>/login/index.php?redirect=<?php echo $redirect; ?>">

								<div class="container">

									<div class="row align-center">

										<!-- Login Box -->

											<div class="login-box box-white">

												<div class="row">

													<div class="col-md-12">

														<div class="brand brand-login text-center">
															<img src="<?php just_url(); ?>/_core/_cdn/img/logo.png"/>
														</div>

													</div>

												</div>

												<?php if(isset( $_GET['msg']) && $_GET['msg'] == "erro" ) { ?>

												<div class="row">

													<div class="col-md-12">

														<div class="msg msg-error bg-gray mt-10">
															<i class="lni lni-close"></i>
															<span>Dados incorretos, tente novamente!</span>
														</div>

													</div>

												</div>

												<?php } ?>

												<?php if(isset( $_GET['msg']) && $_GET['msg'] == "alterada" ) { ?>

												<div class="row">

													<div class="col-md-12">

														<div class="msg msg-done bg-gray mt-10">
															<i class="lni lni-checkmark"></i>
															<span>Senha alterada com sucesso, faça login para continuar!</span>
														</div>

													</div>

												</div>

												<?php } ?>

												<div class="row">

													<div class="col-md-12">

														<div class="form-field form-field-icon form-field-text">

															<i class="form-icon lni lni-user"></i>
															<input type="text" name="email" placeholder="E-mail" value="<?php echo htmlclean(isset( $_GET['email'])) ; ?>"/>

														</div>

													</div>

												</div>

												<div class="row">

													<div class="col-md-12">

														<div class="form-field form-field-icon form-field-password">

															<i class="form-icon lni lni-lock"></i>
															<input type="password" name="pass" placeholder="Senha"/>

														</div>

													</div>

												</div>

												<div class="row">

													<div class="col-md-8">

														<div class="form-field form-field-icon form-field-checkbox">

															<input type="checkbox" name="keepalive" value="1" checked>
															<span>Mantenha-me conectado</span>

														</div>

													</div>

													<div class="col-md-4">

														<div class="form-field form-field-icon form-field-submit">
															<button>
																<span>Entrar</span>
																<i class="lni lni-chevron-right"></i>
															</button>

														</div>

													</div>

												</div>

												<div class="row">

													<div class="col-md-12">

														<div class="forgetpass">

															<a href="<?php just_url(); ?>/esqueci" class="text-center"><i class="lni lni-question-circle"></i> Esqueci minha senha?</a>

															<a href="<?php just_url(); ?>" class="text-center"><i class="icone icone-sacola"></i> Voltar</a>

															<!-- <a href="<?php just_url(); ?>/comece" class="text-center"><i class="lni lni-rocket"></i> Quero vender</a> -->

														</div>

													</div>

												</div>


											</div>

										<!-- / Login Box -->

									</div>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>
		
	</body>

</html>

<script src="<?php just_url(); ?>/_core/_cdn/jquery/js/jquery.min.js"></script>
<script src="<?php just_url(); ?>/_core/_cdn/panel/js/template.js"></script>

