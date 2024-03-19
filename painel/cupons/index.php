<?php
// CORE
include('../../_core/_includes/config.php');
// RESTRICT
restrict_estabelecimento();
restrict_expirado();
// SEO
$seo_subtitle = "Cupons";
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

// $estabelecimento = mysqli_real_escape_string( $db_con, $_GET['estabelecimento_id'] );
$estabelecimento_id = $myArray['estabelecimento_id'] ?? 0;

// $codigo = mysqli_real_escape_string( $db_con, $_GET['codigo'] );
$codigo = $myArray['codigo'] ?? 0;


$getdata = "";

foreach($_GET as $query_string_variable => $value) {
  if( $query_string_variable != "pagina" ) {
    $getdata .= "&$query_string_variable=".htmlclean($value);
  }
}

// Config

$limite = 20;
// $pagina = $_GET["pagina"] == "" ? 1 : $_GET["pagina"];
$pagina = isset($myArray['pagina']) ? $myArray['pagina'] : 1;

$inicio = ($pagina * $limite) - $limite;

// Query
$query = "";

$query .= "SELECT * FROM cupons ";

$query .= "WHERE 1=1 ";

$query .= "AND rel_estabelecimentos_id = '$eid' ";

if( $codigo ) {
  $query .= "AND codigo LIKE '$codigo%' ";
}

$query_full = $query;

$query .= "ORDER BY id DESC LIMIT $inicio,$limite";

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

<?php if(isset( $_GET['msg']) == "erro" ) { ?>

<?php modal_alerta("Erro, tente novamente!","erro"); ?>

<?php } ?>

<?php if(isset( $_GET['msg']) == "sucesso" ) { ?>

<?php modal_alerta("Ação efetuada com sucesso!","sucesso"); ?>

<?php } ?>

<div class="middle minfit bg-gray">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<div class="title-icon pull-left">
					<i class="lni lni-ticket"></i>
					<span>Cupons</span>
				</div>

				<div class="bread-box pull-right">
					<div class="bread">
						<a href="<?php panel_url(); ?>"><i class="lni lni-home"></i></a>
						<span>/</span>
						<a href="<?php panel_url(); ?>/cupons">Cupons</a>
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
								<a data-toggle="collapse" href="#collapse-filtros">
									<span class="desc">Filtrar</span>
									<i class="lni lni-funnel"></i>
									<div class="clear"></div>
								</a>
							</h4>
						</div>
						<div id="collapse-filtros" class="panel-collapse collapse <?php if( $_GET['filtered'] ) { echo 'in'; }; ?>">
							<div class="panel-body">

								<form class="form-filters form-100" method="GET">

									<div class="row">
										<div class="col-md-10">
											<div class="form-field-default">
												<label>Código:</label>
												<input type="text" name="nome" placeholder="Código" value="<?php echo htmlclean( $nome ); ?>"/>
											</div>
										</div>
										<div class="col-md-2">
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
										    <a href="<?php panel_url(); ?>/cupons" class="limpafiltros"><i class="lni lni-close"></i> Limpar filtros</a>
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

		<!-- Content -->

		<div class="listing">

			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<span class="listing-title"><strong class="counter"><?php echo $total_results_full; ?></strong> Registros:</span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<div class="add-new pull-right">

						<a href="<?php panel_url(); ?>/cupons/adicionar">
							<span>Adicionar</span>
							<i class="lni lni-plus"></i>
						</a>

					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-md-12">

					<table class="listing-table normal-table">
						<thead>
							<th class="hidden-xs hidden-sm"></th>
							<th>Código</th>
							<th class="hidden-xs hidden-sm">Quantidade</th>
							<th>Pedidos</th>
							<th class="hidden-xs hidden-sm">Válido até</th>
							<th></th>
						</thead>
						<tbody>

							<?php
                            while ( $data = mysqli_fetch_array( $sql ) ) {
                            ?>

							<tr>
								<td class="hidden-xs hidden-sm">
                                    <div class="fake-table-data"><i class="rep-icon lni lni-ticket"></i></div>
                                    <div class="fake-table-break"></div>
								</td>
								<td>
                                    <span class="fake-table-title">Código</span>
                                    <div class="fake-table-data"><?php echo htmlclean( $data['codigo'] ); ?></div>
                                    <div class="fake-table-break"></div>
								</td>
								<td class="hidden-xs hidden-sm">
                                    <span class="fake-table-title">Quantidade</span>
                                    <div class="fake-table-data"><?php echo htmlclean( $data['quantidade'] ); ?></div>
                                    <div class="fake-table-break"></div>
								</td>
								<td class="hidden-xs hidden-sm">
                                    <span class="fake-table-title">Pedidos</span>
                                    <div class="fake-table-data">
                                    	<a href="<?php panel_url(); ?>/pedidos?cupom=<?php echo $data['codigo']; ?>&filtered=1"><?php echo conta_pedidos_cupom( $data['codigo'],$eid ); ?> pedidos</a>
                                    </div>
                                    <div class="fake-table-break"></div>
								</td>
								<td class="hidden-xs hidden-sm">
                                    <span class="fake-table-title">Valido até</span>
                                    <div class="fake-table-data"><?php echo databr( $data['validade'] ); ?></div>
                                    <div class="fake-table-break"></div>
								</td>
								<td>
									<span class="fake-table-title">Ações</span>
                                    <div class="fake-table-data">
										<div class="form-actions pull-right">
											<a class="color-yellow" href="<?php panel_url(); ?>/cupons/editar?id=<?php echo $data['id']; ?>" title="Editar"><i class="lni lni-pencil"></i></a>
											<a class="color-red" onclick="if(confirm('Tem certeza que deseja remover este cupom?')) document.location = '<?php panel_url(); ?>/cupons/deletar/?id=<?php echo $data['id']; ?>'" href="#" title="Excluir"><i class="lni lni-trash"></i></a>
										</div>
                                    </div>
                                    <div class="fake-table-break"></div>
								</td>
							</tr>

                            <?php } ?>

                            <?php if( $total_results == 0 ) { ?>

                               <tr>
                                <td colspan="6">
                                  <div class="fake-table-data">
                                    <span class="nulled">Nenhum registro cadastrado ou compatível com a sua filtragem!</span>
                                  </div>
                                  <div class="fake-table-break"></div>
                                </td>
                               </tr>

                            <?php } ?>

						</tbody>
					</table>

				</div>

			</div>

		</div>

		<!-- / Content -->

		<!-- Pagination -->

        <div class="paginacao">

          <ul class="pagination">

            <?php
            $paginationpath = "cupons";
            if($pagina > 1) {
              $back = $pagina-1;
              echo '<li class="page-item pagination-back"><a class="page-link" href=" '.get_panel_url().'/'.$paginationpath.'/?pagina='.$back.$getdata.' "><i class="lni lni-chevron-left"></i></a></li>';
            }
     
              for($i=$pagina-1; $i <= $pagina-1; $i++) {

                  if($i > 0) {
                  
                      echo '<li class="page-item pages-before"><a class="page-link" href=" '.get_panel_url().'/'.$paginationpath.'/?pagina='.$i.$getdata.' ">'.$i.'</a></li>';
                  }

              }

              if( $pagina >= 1 ) {

                echo '<li class="page-item active"><a class="page-link" href=" '.get_panel_url().'/'.$paginationpath.'/?pagina='.$i.$getdata.'" class="page-link">'.$i.'</a></li>';

              }

              for($i=$pagina+1; $i <= $pagina+1; $i++) {

                  if($i >= $total_paginas) {
                    break;
                  }  else {
                      echo '<li class="page-item pages-after"><a class="page-link" href=" '.get_panel_url().'/'.$paginationpath.'/?pagina='.$i.$getdata.' ">'.$i.'</a></li> ';
                  }
              
              }

            if($pagina < $total_paginas-1) {
              $next = $pagina+1;
              echo '<li class="page-item pagination-next"><a class="page-link" href=" '.get_panel_url().'/'.$paginationpath.'/?pagina='.$next.$getdata.' "><i class="lni lni-chevron-right"></i></a></li>';
            }

            ?>

          </ul>

        </div>

		<!-- / Pagination -->

	</div>

</div>

<?php 
// FOOTER
$system_footer .= "";
include('../_layout/rdp.php');
include('../_layout/footer.php');
?>