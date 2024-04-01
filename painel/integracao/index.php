<?php
// CORE
include('../../_core/_includes/config.php');
// RESTRICT
restrict(2);
atualiza_estabelecimento( $_SESSION['estabelecimento']['id'], "online" );
// SEO
$seo_subtitle = "Integração";
$seo_description = "";
$seo_keywords = "";
// HEADER
$system_header .= "";
include('../_layout/head.php');
include('../_layout/top.php');
include('../_layout/sidebars.php');
include('../_layout/modal.php');

global $db_con;
$eid = $_SESSION['estabelecimento']['id'];
$meudominio = $httprotocol.data_info("estabelecimentos",$_SESSION['estabelecimento']['id'],"subdominio").".".$simple_url;

?>

<div class="middle minfit bg-gray">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<div class="title-icon pull-left">
					<i class="lni lni-database"></i>
					<span>Integração</span>
				</div>

				<div class="bread-box pull-right">
					<div class="bread">
						<a href="<?php panel_url(); ?>"><i class="lni lni-home"></i></a>
						<span>/</span>
						<a href="<?php panel_url(); ?>/integracao">Integração</a>
					</div>
				</div>

			</div>

		</div>

		<div class="integracao">

			<div class="data box-white mt-16">

	            <div class="row">

	              <div class="col-md-12">

	                <div class="title-line pd-0">
	                  <i class="lni lni-instagram"></i>
	                  <span>Facebook / Instagram Shopping</span>
	                  <div class="clear"></div>
	                </div>

	              </div>

	            </div>

<!-- 	            <div class="row">

	              <div class="col-md-12">

		              <div class="form-field-default">

		                  <label>Tutorial (Passo a passo):</label>
		                  <span class="form-tip">Assista o vídeo abaixo para aprender como importar os seus produtos automaticamente par ao seu facebook / instagram shopping.</span>
		                  <iframe></iframe>

		              </div>

	              </div>

	            </div> -->

	          <div class="row">

	            <div class="col-md-9">

	              <div class="form-field-default">

	                  <label>URL de importação:</label>
	                  <input id="copyme" type="text" value="<?php echo $meudominio; ?>/shopping.xml" DISABLED/>

	              </div>

	            </div>

	            <div class="col-md-3">
	            	<label></label>
	              	<button class="fullwidth" data-clipboard-text="<?php echo $meudominio; ?>/shopping.xml">
	              		<span>
	              			<i class="lni lni-clipboard"></i> Copiar
	              		</span>
	              	</button>
	              </div>

	          </div>

			</div>

		</div>

	</div>

</div>

<?php 
// FOOTER
$system_footer .= "";
include('../_layout/rdp.php');
include('../_layout/footer.php');
?>