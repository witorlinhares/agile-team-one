<?php 
include('_core/_includes/config.php');

  // Globais
  $rootpath;
  $httprotocol;
  $simple_url;
  $gowww = $httprotocol.$simple_url;
  $firstdomain = explode(".", $simple_url);
  $firstdomain = $firstdomain[0];
//testando commit

  // Mapeando subdominio
  $insubdominio = parse_url(isset($_SERVER['HTTP_HOST']), PHP_URL_HOST);
  //var_dump( $insubdominio);
  if (strpos(isset($insubdominio), '.') !== false) {
    $insubdominio = substr($insubdominio, 0, strpos($insubdominio, '.'));
  }


  // Estabelecimento
  if( mysqli_num_rows( mysqli_query( $db_con, "SELECT id,subdominio FROM estabelecimentos WHERE subdominio = '$insubdominio' AND excluded != '1' LIMIT 1" ) ) ) {
    $query = mysqli_query( $db_con, "SELECT id,subdominio FROM estabelecimentos WHERE subdominio = '$insubdominio' LIMIT 1" );
    $data = mysqli_fetch_array( $query );
    $has_insubdominio = "1";
    $insubdominioid = $data['id'];
    $insubdominiotipo = "1";
  }

  // Cidade
  if( mysqli_num_rows( mysqli_query( $db_con, "SELECT id,subdominio FROM cidades WHERE subdominio = '$insubdominio' LIMIT 1" ) ) ) {
    $query = mysqli_query( $db_con, "SELECT id,subdominio FROM cidades WHERE subdominio = '$insubdominio' LIMIT 1" );
    $data = mysqli_fetch_array( $query );
    $has_insubdominio = "1";
    $insubdominioid = $data['id'];
    $insubdominiotipo = "2";
  }

  // Subdominio
  if( mysqli_num_rows( mysqli_query( $db_con, "SELECT * FROM subdominios WHERE subdominio = '$insubdominio' LIMIT 1" ) ) ) {
    $query = mysqli_query( $db_con, "SELECT * FROM subdominios WHERE subdominio = '$insubdominio' LIMIT 1" );
    $data = mysqli_fetch_array( $query );
    $has_insubdominio = "1";
    $insubdominioid = $data['rel_id'];
    $insubdominiotipo = $data['tipo'];
    if( $insubdominiotipo == "1" ) {
      if( data_info( "estabelecimentos",$insubdominioid,"excluded" ) == "1" ) {
        $has_insubdominio = "0";
        $insubdominioid = "";
        $insubdominiotipo = "";
      }
    }
  }

  // Se existe o subdominio
    if ($insubdominio) {

      // Tipo do subdominio
      switch ($insubdominio) {
        case 'estabelecimento':
          $insubdominiotipo = 1;
          break;
        case 'cidade':
          $insubdominiotipo = 2;
          break;
        default:
          $insubdominiotipo = 0;
      }



    // Roteando
    $router = isset($_GET['inrouter']);
    $router = explode('/', $router);
    $inacao = $router[0];
    $inparametro = $router[1];

    // Estabelecimento
    // Estabelecimento
    if ($insubdominiotipo == 1) {
      $virtualpath = $rootpath.'/app/estabelecimento';
      switch ($inacao) {
        case '':
          $chamar = $virtualpath.'/index.php';
          break;
        case 'categoria':
          $chamar = $virtualpath.'/categoria.php';
          break;
        case 'produto':
          $chamar = $virtualpath.'/produto.php';
          break;
        case 'sacola':
          $chamar = $virtualpath.'/sacola.php';
          break;
        case 'pedido':
          $chamar = $virtualpath.'/pedido.php';
          break;
        default:
          $chamar = $virtualpath.'/404.php';
      }
    }

    // Cidade

   // Cidade
    if ($insubdominiotipo == 2) {
      $virtualpath = $rootpath.'/app/cidade';
      switch ($inacao) {
        case '':
          $chamar = $virtualpath.'/index.php';
          break;
        case 'produtos':
          $chamar = $virtualpath.'/produtos.php';
          break;
        case 'estabelecimentos':
          $chamar = $virtualpath.'/estabelecimentos.php';
          break;
        case 'sacola':
          $chamar = $virtualpath.'/sacola.php';
          break;
        default:
          $chamar = $virtualpath.'/404.php';
      }
    }

  } else {

    if( $insubdominio ) {
      include("404.php");
    } else {
      include("localizacao/index.php");// DESMASCAR PARA USAR MARKETPLACE COMO PAGINA PADRAO
      //header("Location: https://conheca.ominichanel.redewe2m.com.br/");
    }

  }


?>