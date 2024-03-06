<?php 
include('../../_core/_includes/config.php');
$token = mysqli_real_escape_string( $db_con, $_GET['token'] );
$eid = mysqli_real_escape_string( $db_con, $_GET['eid'] );
// session_id($token);
?>

<?php if (isset( $_SESSION['estabelecimento']['id']) == $eid ) { ?>

	<?php
	if( data_info( "estabelecimentos", $_SESSION['estabelecimento']['id'], "funcionamento" ) == "1" ) { 
	mysqli_query( $db_con, "UPDATE estabelecimentos SET funcionamento = '2' WHERE id = '$eid'" );
	?>
		<div class="fechado">

			<div class="lista-menus-menu">
				<div class="bt">
					<i class="open-status"></i>
					<span>Fechado</span>
					<i class="lni lni-shuffle"></i>
					<div class="clear"></div>
				</div>
			</div>
			<span class="funcionamento-msg">O seu estabelecimento não está disponível<br class="hidden-xs hidden-sm"/> para receber pedidos</span>

		</div>

	<?php
	} else {
	mysqli_query( $db_con, "UPDATE estabelecimentos SET funcionamento = '1' WHERE id = '$eid'" );
	?>

		<div class="aberto">

			<div class="lista-menus-menu">
				<div class="bt">
					<i class="open-status"></i>
					<span>Aberto</span>
					<i class="lni lni-shuffle"></i>
					<div class="clear"></div>
				</div>
			</div>
			<span class="funcionamento-msg">O seu estabelecimento está disponível<br class="hidden-xs hidden-sm"/> para receber pedidos</span>

		</div>

	<?php } ?>

<?php } ?>