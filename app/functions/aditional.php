<?php
//Funcao foi transformada em 2 Classes separando as responsabilidades e transformando em entidades
//app/models/FreteManager.php e CupomManager.php

function new_fretec( $estabelecimento,$nome,$valor,$outros) {

	global $db_con;
	global $_SESSION;

	if( mysqli_query( $db_con, "INSERT INTO frete (rel_estabelecimentos_id,nome,valor,outros) VALUES ('$estabelecimento','$nome','$valor','$outros');") ) {

		return true;
	
	} else {

		return false;

	}

}

function edit_fretec( $id,$nome,$valor ) {

	global $db_con;

	$updatedquery = "UPDATE frete SET nome = '$nome',valor = '$valor' WHERE id = '$id'";

	if( mysqli_query( $db_con, $updatedquery ) ) {

		return true;
	
	} else {

		return false;

	}

}

function delete_fretec( $id ) {

	global $db_con;

	if( mysqli_query( $db_con, "DELETE FROM frete WHERE id = '$id'") ) {

		return true;

	} else {

		return false;

	}

}

function new_frete( $estabelecimento,$nome,$valor) {

	global $db_con;
	global $_SESSION;

	if( mysqli_query( $db_con, "INSERT INTO frete (rel_estabelecimentos_id,nome,valor) VALUES ('$estabelecimento','$nome','$valor');") ) {

		return true;
	
	} else {

		return false;

	}

}

function edit_frete( $id,$nome,$valor ) {

	global $db_con;

	$updatedquery = "UPDATE frete SET nome = '$nome',valor = '$valor' WHERE id = '$id'";

	if( mysqli_query( $db_con, $updatedquery ) ) {

		return true;
	
	} else {

		return false;

	}

}

function delete_frete( $id ) {

	global $db_con;

	if( mysqli_query( $db_con, "DELETE FROM frete WHERE id = '$id'") ) {

		return true;

	} else {

		return false;

	}

}

function new_cupom( $estabelecimento,$nome,$descricao,$codigo,$tipo,$desconto_porcentagem,$desconto_fixo,$valor_maximo,$quantidade,$validade ) {

	global $db_con;
	global $_SESSION;

	if( mysqli_query( $db_con, "INSERT INTO cupons (rel_estabelecimentos_id,nome,descricao,codigo,tipo,desconto_porcentagem,desconto_fixo,valor_maximo,quantidade,validade) VALUES ('$estabelecimento','$nome','$descricao','$codigo','$tipo','$desconto_porcentagem','$desconto_fixo','$valor_maximo','$quantidade','$validade');") ) {

		return true;
	
	} else {

		return false;

	}

}

function edit_cupom( $id,$nome,$descricao,$codigo,$tipo,$desconto_porcentagem,$desconto_fixo,$valor_maximo,$quantidade,$validade ) {

	global $db_con;

	$updatedquery = "UPDATE cupons SET nome = '$nome',descricao = '$descricao',codigo = '$codigo',tipo = '$tipo',desconto_porcentagem = '$desconto_porcentagem',desconto_fixo = '$desconto_fixo',valor_maximo = '$valor_maximo',quantidade = '$quantidade',validade = '$validade' WHERE id = '$id'";

	if( mysqli_query( $db_con, $updatedquery ) ) {

		return true;
	
	} else {

		return false;

	}

}

function delete_cupom( $id ) {

	global $db_con;

	if( mysqli_query( $db_con, "DELETE FROM cupons WHERE id = '$id'") ) {

		return true;

	} else {

		return false;

	}

}

function conta_pedidos_cupom( $codigo,$rel_estabelecimentos_id ) {

	global $db_con;

	$checkcount = mysqli_query( $db_con, "SELECT * FROM pedidos WHERE cupom = '$codigo' AND rel_estabelecimentos_id = '$rel_estabelecimentos_id'");
	$count = mysqli_num_rows( $checkcount );
	return $count;

}