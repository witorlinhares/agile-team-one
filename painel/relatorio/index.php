<?php
// CORE
include('../../_core/_includes/config.php');
// RESTRICT
restrict_estabelecimento();
restrict_expirado();
// SEO
$seo_subtitle = "Pedidos";
$seo_description = "";
$seo_keywords = "";
// HEADER
$system_header .= "";
include('../_layout/head.php');
include('../_layout/top.php');
include('../_layout/sidebars.php');
include('../_layout/modal.php');
?>

<?php

global $db_con;
$eid = $_SESSION['estabelecimento']['id'];

// Variables

$estabelecimento = mysqli_real_escape_string( $db_con, $_GET['estabelecimento_id'] );
$numero = mysqli_real_escape_string( $db_con, $_GET['numero'] );
$nome = mysqli_real_escape_string( $db_con, $_GET['nome'] );
$status = mysqli_real_escape_string( $db_con, $_GET['status'] );
$cupom = mysqli_real_escape_string( $db_con, $_GET['cupom'] );

$getdata = "";

foreach($_GET as $query_string_variable => $value) {
  if( $query_string_variable != "pagina" ) {
    $getdata .= "&$query_string_variable=".htmlclean($value);
  }
}

// Config

$limite = 20;
$pagina = $_GET["pagina"] == "" ? 1 : $_GET["pagina"];
$inicio = ($pagina * $limite) - $limite;

// Query

$query .= "SELECT * FROM pedidos ";

$query .= "WHERE 1=1 ";

if( $numero ) {
  $query .= "AND id = '$numero' ";
}

if( $nome ) {
  $query .= "AND nome LIKE '%$nome%' ";
}

if( $status ) {
	$query .= "AND status = '$status' ";
} else {
	$query .= "AND (status = '1' OR status = '4' OR status = '5' OR status = '6') ";
}

if( $cupom ) {
  $query .= "AND cupom = '$cupom' ";
}

$data_inicial = mysqli_real_escape_string( $db_con, $_GET['data_inicial'] );
if( !$data_inicial ) { $data_inicial = date("d/m/").(date('Y')-1); }
$data_inicial_sql = datausa_min( $data_inicial );
$data_inicial_sql = $data_inicial_sql." 00:00:00";

$data_final = mysqli_real_escape_string( $db_con, $_GET['data_final'] );
if( !$data_final ) { $data_final = date("d/m/Y"); }
$data_final_sql = datausa_min( $data_final );
$data_final_sql = $data_final_sql." 23:59:59";

if( strlen( $data_inicial ) >= 1 OR strlen( $data_final ) >= 1 ) {
  $query .= "AND (data_hora > '$data_inicial_sql' AND data_hora < '$data_final_sql') ";
}

$query .= "AND rel_estabelecimentos_id = '$eid' ";

$query_full = $query;

$query .= "ORDER BY id ASC LIMIT $inicio,$limite";

// Run

$sql = mysqli_query( $db_con, $query );

$total_results = mysqli_num_rows( $sql );

$sql_full = mysqli_query( $db_con, $query_full );

$total_results_full = mysqli_num_rows( $sql_full );

$total_paginas = Ceil($total_results_full / $limite) + ($limite / $limite);

if( !$pagina OR $pagina > $total_paginas OR !is_numeric($pagina) ) {

    $pagina = 1;

}

?>

<?php if( $_GET['msg'] == "erro" ) { ?>

<?php modal_alerta("Erro, tente novamente!","erro"); ?>

<?php } ?>

<?php if( $_GET['msg'] == "sucesso" ) { ?>

<?php modal_alerta("Ação efetuada com sucesso!","sucesso"); ?>

<?php } ?>

<div class="middle minfit bg-gray">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<div class="title-icon pull-left">
					<i class="lni lni-ticket-alt"></i>
					<span>Gerar Relatório</span>
				</div>

				<div class="bread-box pull-right">
					<div class="bread">
						<a href="<?php panel_url(); ?>"><i class="lni lni-home"></i></a>
						<span>/</span>
						<a href="<?php panel_url(); ?>/pedidos">Relatório</a>
					</div>
				</div>

			</div>

		</div>

		<!-- Filters -->

		<div class="row">

			<div class="col-md-12">

				<div class="panel-group panel-filters">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a>
									<span class="desc">Filtrar</span>
									<i class="lni lni-funnel"></i>
									<div class="clear"></div>
								</a>
							</h4>
						</div>
						<div class="panel-collapse <?php if( $_GET['filtered'] ) { echo 'in'; }; ?>">
							<div class="panel-body">

								<form class="form-filters form-100" method="GET" action="<?php panel_url(); ?>/relatorio/relatorio.php" target="_blank">
								    <input type="hidden" name="estabelecimento_id" value="<?php echo $eid; ?>"/>
								    <input type="hidden" name="numero" value=""/>
								    <input type="hidden" name="status" value=""/>
								    <input type="hidden" name="nome" value=""/>
								    <input type="hidden" name="cupom" value=""/>
 
							 
									
									
									<div class="row">
										
										
										
										<div class="clear visible-xs visible-sm"></div>
										<div class="col-md-4 half-left col-sm-6 col-xs-6">
											<div class="form-field-default">
												<label>Data inicial:</label>
												<input class="maskdate datepicker" type="text" name="data_inicial" placeholder="Data inicial" value="<?php echo htmlclean( $data_inicial ); ?>"/>
											</div>
										</div>
										<div class="col-md-4 half-right col-sm-6 col-xs-6">
											<div class="form-field-default">
												<label>Data final:</label>
												<input class="maskdate datepicker" type="text" name="data_final" placeholder="Data inicial" value="<?php echo htmlclean( $data_final ); ?>"/>
											</div>
										</div>
										<div class="clear visible-xs visible-sm"></div>
										<div class="col-md-4">
											<div class="form-field-default">
												<label class="hidden-xs hidden-sm"></label>
												<input type="hidden" name="filtered" value="1"/>
												<button>
													<span>Buscar</span>
													<i class="lni lni-search-alt"></i>
												</button>
											</div>
										</div>
									</div>
									<?php if( $_GET['filtered'] ) { ?>
									<div class="row">
										<div class="col-md-12">
										    <a href="<?php panel_url(); ?>/pedidos" class="limpafiltros"><i class="lni lni-close"></i> Limpar filtros</a>
										</div>
									</div>
									<?php } ?>
								</form>

							</div>
						</div>
					</div>
				</div> 

			</div>

		</div>

		<!-- / Filters -->

		 

 

	</div>

</div>

<?php 
// FOOTER
$system_footer .= "";
include('../_layout/rdp.php');
include('../_layout/footer.php');
?>

<script>

$( document ).ready(function() {

	$( "input[name=estabelecimento]" ).change(function() {
		$( "input[name=estabelecimento_id]" ).trigger("change");
	});

	$( "input[name=estabelecimento_id]" ).change(function() {
	    var estabelecimento = $(this).val();
	    $("#input-categoria").html("<option>-- Carregando categorias --</option>");
	    $("#input-categoria").load("<?php just_url(); ?>/_core/_ajax/categorias.php?estabelecimento="+estabelecimento);
	});

});


</script>