<?php
include('../../../_core/_includes/config.php'); 
$token = mysqli_real_escape_string( $db_con, $_POST['token'] );
$modo = $_POST['modo'];
session_id( $token );
$eid = mysqli_real_escape_string( $db_con, $_POST['eid'] );
$pid = mysqli_real_escape_string( $db_con, $_POST['produto'] );
$produto = mysqli_real_escape_string( $db_con, $_POST['produto'] );
$parsedata = parse_str( $_POST['data'], $data );
$quantidade = $data['quantidade'];
$observacoes = $data['observacoes'];
$variacoes = $data['variacao'];

// CHECKOUT

$nome = mysqli_real_escape_string( $db_con, $_POST['nome'] );
$whatsapp = mysqli_real_escape_string( $db_con, clean_str( $_POST['whatsapp'] ) );
$forma_entrega = mysqli_real_escape_string( $db_con, $_POST['forma_entrega'] );
$estado = mysqli_real_escape_string( $db_con, $_POST['estado'] );
$cidade = mysqli_real_escape_string( $db_con, $_POST['cidade'] );
$endereco_cep = mysqli_real_escape_string( $db_con, $_POST['endereco_cep'] );
$endereco_numero = mysqli_real_escape_string( $db_con, $_POST['endereco_numero'] );
$endereco_bairro = mysqli_real_escape_string( $db_con, $_POST['endereco_bairro'] );
$endereco_rua = mysqli_real_escape_string( $db_con, $_POST['endereco_rua'] );
$endereco_complemento = mysqli_real_escape_string( $db_con, $_POST['endereco_complemento'] );
$endereco_referencia = mysqli_real_escape_string( $db_con, $_POST['endereco_referencia'] );
$forma_pagamento = mysqli_real_escape_string( $db_con, $_POST['forma_pagamento'] );
$forma_pagamento_informacao = mysqli_real_escape_string( $db_con, $_POST['forma_pagamento_informacao'] );

if( $token ) {

	if( $modo == "adicionar" ) {

		$query_content = mysqli_query( $db_con, "SELECT * FROM produtos WHERE id = '$pid' AND status = '1' ORDER BY id ASC LIMIT 1" );
		$has_content = mysqli_num_rows( $query_content );
		$data_content = mysqli_fetch_array( $query_content );
		if( $has_content ) {
		$eid = $data_content['rel_estabelecimentos_id'];
		$pid = $data_content['id'];

		sacola_adicionar( $eid,$pid,$quantidade,$observacoes,$variacoes );
		?>

			<div class="row">

				<div class="col-md-12">

					<div class="adicionado">

						<i class="checkicon lni lni-checkmark-circle"></i>
						<span class="title"><?php echo htmlclean( $data_content['nome'] ); ?></span>
						<span class="text">Adicionado a sacola com sucesso!</span>

					</div>

			  	</div>

			</div>

			<div class="row lowpadd">

				<div class="col-md-6">
					    <a href="#"  data-dismiss="modal" class="botao-acao botao-acao-gray"><i class="icone icone-sacola"></i> <span>Continuar comprando</span></a>
				</div>

				<div class="col-md-6">
					    <a href="<?php echo $app['url']; ?>/sacola" class="botao-acao"><i class="lni lni-checkmark-circle"></i> <span>Ver sacola</span></a>
				</div>

			</div>

		<?php } else { ?>

			<div class="row">

				<div class="col-md-12">

					<div class="adicionado">

						<i class="erroricon lni lni-close"></i>
						<span class="title">Erro!</span>
						<span class="text">Solicitação inválida!</span>

					</div>

			  	</div>

			</div>

			<div class="row lowpadd">

				<div class="col-md-12">
					    <a href="#"  data-dismiss="modal" class="botao-acao botao-acao-gray"><i class="icone icone-sacola"></i> <span>Fechar</span></a>
				</div>

			</div>

		<?php

		}

	} 

	if( $modo == "alterar" ) {

		sacola_alterar( $eid,$pid,$quantidade );
		echo "eid: ".$eid."\n";
		echo "pid: ".$pid."\n";
		echo "quantidade: ".$quantidade."\n";

	} 

	if( $modo == "remover" ) {

		sacola_remover( $eid,$pid );

	} 

	if( $modo == "contagem" ) {

		$contagem = count( $_SESSION['sacola'][$eid] );
		echo $contagem;

	}

	if( $modo == "subtotal" ) {

		$subtotal = array();

		foreach( $_SESSION['sacola'][$eid] AS $key => $value ) {
			$query_content = mysqli_query( $db_con, "SELECT * FROM produtos WHERE id = '$key' AND status = '1' ORDER BY id ASC LIMIT 1" );
			$data_content = mysqli_fetch_array( $query_content );
			if( $data_content['oferta'] == "1" ) {
				$valor_final = $data_content['valor_promocional'];
			} else {
				$valor_final = $data_content['valor'];
			}
			$valor_adicional = $_SESSION['sacola'][$eid][$key]['valor_adicional'];
			$subtotal[] = ( ( $valor_final + $valor_adicional ) * $_SESSION['sacola'][$eid][$key]['quantidade'] );
		}

		$subtotal = array_sum( $subtotal );
		echo "R$ ".dinheiro( $subtotal, "BR");

	}

	if( $modo == "subtotal_clean" ) {

		$subtotal = array();

		foreach( $_SESSION['sacola'][$eid] AS $key => $value ) {
			$query_content = mysqli_query( $db_con, "SELECT * FROM produtos WHERE id = '$key' AND status = '1' ORDER BY id ASC LIMIT 1" );
			$data_content = mysqli_fetch_array( $query_content );
			if( $data_content['oferta'] == "1" ) {
				$valor_final = $data_content['valor_promocional'];
			} else {
				$valor_final = $data_content['valor'];
			}
			$subtotal[] = ( ( $valor_final + $valor_adicional ) * $_SESSION['sacola'][$eid][$key]['quantidade'] );
		}

		$subtotal = array_sum( $subtotal );
		echo $subtotal;

	}

	if( $modo == "checkout" ) {

		checkout_salvar( $nome,$whatsapp,$forma_entrega,$estado,$cidade,$endereco_cep,$endereco_numero,$endereco_bairro,$endereco_rua,$endereco_complemento,$endereco_referencia,$forma_pagamento,$forma_pagamento_informacao, $pedido_status );

	}

	if( $modo == "comprovante" ) {

		echo gera_comprovante($eid,"html","2","");

	}

}

?>