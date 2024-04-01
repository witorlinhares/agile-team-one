<?php
global $insubdominioid;
global $insubdominiourl;
global $httprotocol;
var_dump("Subdominio ID: ".$insubdominioid);
var_dump("Subdominio URL: ".$insubdominiourl);
$define_query = mysqli_query( $db_con, "SELECT * FROM estabelecimentos WHERE id = '$insubdominioid' LIMIT 1");
$define_data = mysqli_fetch_array( $define_query );
// TODO: Investigar a ausência de $simple_url
$app['url'] = $httprotocol.$insubdominiourl.".".$simple_url;
var_dump("App URL: ".$app['url']);
$app['type'] = "1";
$app['id'] = $define_data['id'];

$app['avatar'] = thumber( $define_data['perfil'], 450 );
$app['avatar_clean'] = $define_data['perfil'];
$app['cover'] = thumber( $define_data['capa'], 450 );
$app['cor'] = $define_data['cor'];
$app['exibicao'] = $define_data['exibicao'];

$app['delivery']    = $define_data['delivery'];
$app['balcao']      = $define_data['balcao'];
$app['outros']      = $define_data['outros'];
$app['nomeoutros']  = $define_data['nomeoutros'];

$app['chave_pix'] = $define_data['chave_pix'];
$app['beneficiario_pix'] = $define_data['beneficiario_pix'];

$app['title'] = htmlclean( $define_data['nome'] );
$app['description'] = nl2br( htmlclean( $define_data['descricao'] ) );
$app['description_clean'] = htmlclean( $define_data['descricao'] );

$app['horario_funcionamento'] = htmlclean( $define_data['horario_funcionamento'] );

$app['pedido_minimo'] = "R$ ".dinheiro( $define_data['pedido_minimo'], "BR" );
$app['pedido_minimo_valor'] = $define_data['pedido_minimo'];

$app['entrega_entrega'] = $define_data['entrega_entrega'];
$app['entrega_entrega_tipo'] = $define_data['entrega_entrega_tipo'];
if( $app['entrega_entrega'] == "1" ) {
	if( $app['entrega_entrega_tipo'] == "1" ) {
		$app['entrega_entrega_valor'] = "R$ ".dinheiro( $define_data['entrega_entrega_valor'], "BR" );
	}
	if( $app['entrega_entrega_tipo'] == "2" ) {
		$app['entrega_entrega_valor'] = "a combinar";
	}
}

$app['entrega_retirada'] = "1";

$app['estado'] = $define_data['estado'];
$app['cidade'] = $define_data['cidade'];

// Endereço completo
$app['endereco_completo'] .= htmlclean( $define_data['endereco_rua'] ).", ";
$app['endereco_completo'] .= "Nº ".htmlclean( $define_data['endereco_numero'] ).", <br/>";
$app['endereco_completo'] .= "Bairro: ".htmlclean( $define_data['endereco_bairro'] ).", ";
$app['endereco_completo'] .= "CEP: ".htmlclean( $define_data['endereco_cep'] ).", ";
$app['endereco_completo'] .= data_info("cidades", $define_data['cidade'], "nome")."/".data_info("estados", $define_data['estado'], "nome")."<br/>";
if( $define_data['endereco_referencia'] ) {
	$app['endereco_completo'] .= $define_data['endereco_referencia'].".";
}
$app['contato_whatsapp'] = clean_str( $define_data['contato_whatsapp'] );
$app['contato_email'] = $define_data['contato_email'];
$app['contato_facebook'] = $define_data['contato_facebook'];
$app['contato_instagram'] = $define_data['contato_instagram'];
$app['contato_youtube'] = $define_data['contato_youtube'];

$app['analytics'] = $define_data['estatisticas_analytics'];
$app['pixel'] = $define_data['estatisticas_pixel'];

$app['html'] = $define_data['html'];

$app['funcionalidade_banners'] = $define_data['funcionalidade_banners'];
$app['funcionalidade_variacao'] = $define_data['funcionalidade_variacao'];
$app['funcionalidade_marketplace'] = $define_data['funcionalidade_marketplace'];

?>