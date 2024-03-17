<?php
// CORE
include('../_core/_includes/config.php');

global $httprotocol;
global $simple_url;
// SEO
$seo_subtitle = "Catálogo Online!";
$seo_description = "";
$seo_keywords = "";
// HEADER
$system_header = "";

if( isset($_COOKIE['cidade']) ) {
	$cidade = mysqli_real_escape_string( $db_con, $_COOKIE['cidade'] );
	$subdominio = data_info( "cidades",$cidade,"subdominio" );
	if( $subdominio ) {
		$gourl = $httprotocol.$subdominio.".".$simple_url;
		header("Location: ".$gourl);
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
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/class.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/forms.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/typography.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/template.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/theme.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/panel/css/default.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/lineicons/css/LineIcons.css">
		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/fonts/style.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php just_url(); ?>/_core/_cdn/sidr/css/jquery.sidr.light.css">

		<?php system_header(); ?>
	
	</head>

	<body>

		<div class="bg-gray fullfit">

			<div class="container">

				<div class="row">

					<div class="col-md-12">

						<div class="login">

							<div class="container">

								<div class="row align-center row-cidade">

									<!-- Login Box -->

										<div class="login-box box-white">

											<div class="row">

												<div class="col-md-12">

													<div class="brand brand-login text-center">
														<img src="<?php just_url(); ?>/_core/_cdn/img/logo.png"/>
													</div>

												</div>

											</div>

											<div class="row">

												<div class="col-md-12">

													<span class="text-escolha">
														Escolha a sua cidade
													</span>

												</div>

											</div>

											<div class="row">

							                  <div class="col-md-12">

							                  	<div class="holder-noventa">

								                    <div class="form-field-default">

								                        <div class="fake-select">
								                          <i class="lni lni-chevron-down"></i>
								                          <select id="input-estado-choose" name="estado">

								                              <option value="">Estado</option>
								                              <?php 
																$query_estados = 
																"
																SELECT estados.id,estados.nome, count(*) as total, estados.nome as estado_nome, estados.id as estado_id
																FROM estados AS estados 

																INNER JOIN cidades AS cidades 
																ON cidades.estado = estados.id 

																INNER JOIN estabelecimentos AS estabelecimentos 
																ON estabelecimentos.cidade = cidades.id 

																WHERE 
																estabelecimentos.funcionalidade_marketplace = '1' AND 
																estabelecimentos.status = '1' AND 
																estabelecimentos.status_force != '1' AND 
																estabelecimentos.excluded != '1' 

																GROUP BY estados.id 
																ORDER BY estados.nome ASC
																";
																$query_estados = mysqli_query( $db_con, $query_estados );
																while ( $data_estado = mysqli_fetch_array( $query_estados ) ) {
								                              ?>

								                                <option <?php if( isset($_POST['estado']) == $data_estado['estado_id'] ) { echo "SELECTED"; }; ?> value="<?php echo $data_estado['estado_id']; ?>"><?php echo $data_estado['estado_nome']; ?></option>

								                              <?php } ?>

								                          </select>
								                          <div class="clear"></div>
								                      </div>

								                    </div>

							                	</div>

							                  </div>

							                </div>

							                <div class="row">

							                  <div class="col-md-12">

							                  	<div class="holder-noventa">

								                    <div class="form-field-default">

								                        <div class="fake-select">
								                          <i class="lni lni-chevron-down"></i>
								                          <select id="input-cidade-choose" name="cidade">

								                            <option value="">Cidade</option>
							
								                          </select>
								                          <div class="clear"></div>
								                      </div>

								                    </div>

							                	</div>

							                  </div>

							                </div>

											<div class="row">

												<div class="col-md-12">

													<div class="form-field form-field-icon form-field-entrar">

														<button>
															<span>Quero comprar</span>
															<i class="icone icone-sacola"></i>
														</button>

													</div>

												</div>

											</div>

											<div class="row">

												<div class="col-md-12">

													<div class="forgetpass">

														<span>
															Não encontrou sua cidade?<br/>
															Seja o primeiro e saia na frente.
														</span>

														<a href="<?php just_url(); ?>/comece" class="text-center"><i class="lni lni-rocket"></i> Comece a vender</a>
														<a href="<?php just_url(); ?>/login" class="text-center"><i class="lni lni-lock"></i> Fazer login</a>

													</div>

												</div>

											</div>

										</div>

									<!-- / Login Box -->

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</body>

</html>

<script src="<?php just_url(); ?>/_core/_cdn/jquery/js/jquery.min.js"></script>
<script src="<?php just_url(); ?>/_core/_cdn/panel/js/template.js"></script>

<script>

$( "#input-estado-choose" ).change(function() {
	var estado = $("#input-estado-choose").children("option:selected").val();
	$("#input-cidade-choose").html("<option>-- Carregando cidades --</option>");
	$("#input-cidade-choose").load("<?php just_url(); ?>/_core/_ajax/cidades_filled.php?estado="+estado);
});


$( ".form-field-entrar button" ).click(function() {
	var url = $("#input-cidade-choose").val();
	document.location.href = url;
});

</script>