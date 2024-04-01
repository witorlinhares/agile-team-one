<?php
header("Content-type: application/javascript");
include('../../../_core/_includes/config.php');
$insubdominiourl = isset($_GET['$insubdominiourl']) ? mysqli_real_escape_string( $db_con, $_GET['insubdominiourl'] ) : '';
var_dump("Subdominio URL: ".$insubdominiourl);
?>

function sacola_count(eid,token) {
	
	var modo = "contagem";
	$.post( "<?php echo $app['url']; ?>/app/estabelecimento/_ajax/sacola.php", { token: token, eid: eid, modo: modo })
	.done(function( data ) {
		$( ".shop-bag .counter" ).html( data );
	});

}

function subtotal_count(eid,token,valor) {
	
	var valor = parseInt( valor );

	var modo = "subtotal";
	$.post( "<?php echo $app['url']; ?>/app/estabelecimento/_ajax/sacola.php", { token: token, eid: eid, modo: modo })
	.done(function( data ) {
		$( ".subtotal span" ).html( data );
	});

	var modo = "subtotal_clean";
	$.post( "<?php echo $app['url']; ?>/app/estabelecimento/_ajax/sacola.php", { token: token, eid: eid, modo: modo })
	.done(function( data ) {
		var valor_subtotal = parseInt( data );
		if(valor_subtotal >= valor ) {
			$( "input[name='pedido_minimo']" ).val("1");
		} else {
			$( "input[name='pedido_minimo']" ).val("");
		}
	});

}

function atualiza_comprovante(eid,token) {
	
	var modo = "comprovante";
	$.post( "<?php echo $app['url']; ?>/app/estabelecimento/_ajax/sacola.php", { token: token, eid: eid, modo: modo })
	.done(function( data ) {
		$( ".comprovante .content" ).html( data );
		$( window ).trigger("resize");
	});

}