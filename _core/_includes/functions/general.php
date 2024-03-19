<?php

function system_url() {

	global $system_url;
	echo $system_url;

}

function get_system_url() {

	global $system_url;
	return $system_url;

}

function admin_url() {

	global $admin_url;
	echo $admin_url;

}

function get_admin_url() {

	global $admin_url;
	return $admin_url;

}

function panel_url() {

	global $panel_url;
	echo $panel_url;

}

function get_panel_url() {

	global $panel_url;
	return $panel_url;

}

function just_url() {

	global $just_url;
	echo $just_url;

}

function just_url_subdomain($sub) {

	global $httprotocol;
	global $just_url;
	if($sub == "veloximports") {
		$sub = "";
	}
	if($sub) {
		$url = str_replace($httprotocol, "", $just_url);
		$url = $sub.".".$url;
		$url = $httprotocol.$url;
	} else {
		$url = $just_url;
	}
	echo $url;

}

function get_just_url() {

	global $just_url;
	return $just_url;

}

function app_url() {

	global $app_url;
	echo $app_url;

}

function get_app_url() {

	global $app_url;
	return $app_url;

}

function seo( $modo ) {

	global $seo_title;
	global $seo_subtitle;

	if( $modo == "title" ) {

		$return = $seo_title." - ".$seo_subtitle;
		echo $return;

	}
	
}

function seo_app( $str ) {

	global $seo_title;

	$return = $str." - ".$seo_title;

	return $return;
	
}

function limitchar($texto, $limite, $quebra = true) {

	$tamanho = strlen($texto);
	
	if ($tamanho <= $limite) {

		$novo_texto = $texto;

	} else {

		if ($quebra == true) {
			$novo_texto = trim(substr($texto, 0, $limite)).' ...';
		} else {
			$ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
			$novo_texto = trim(substr($texto, 0, $ultimo_espaco)).' ...';
		}

	}

	return $novo_texto;

}


function limitlogo($texto, $limite, $quebra = true) {

	$tamanho = strlen($texto);
	
	if ($tamanho <= $limite) {

		$novo_texto = $texto;

	} else {

		if ($quebra == true) {
			$novo_texto = trim(substr($texto, 0, $limite)).' <strong class="colored">..</strong>';
		} else {
			$ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
			$novo_texto = trim(substr($texto, 0, $ultimo_espaco)).' <strong class="colored">..</strong>';
		}

	}

	return $novo_texto;

}

function notnull($a) {

	if( strlen($a) > 0 ) {
	
		return true;
	
	} else {

		return false;
	
	}

}

function random_key($a) {

	$size = $a;
	$chars[1] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','x','y','z');
	$chars[2] = array('0','1','2','3','4','5','6','7','8','9');

	$value = "";
	while( strlen($value) != $size ) {

		$rand1 = rand(1,2);

		if( $rand1 == "1" ) {

			$rand2 = "10";

		} else {

			$rand2 = "25";

		}

		$value .= isset($chars[ $rand1 ][ rand(0,$rand2) ]);
	}

	return $value;

}

function nl2brfull($str) {

	$str = str_replace("\\r\\n", "<br/>", $str);
	$str = nl2br($str);

	return $str;

}

function databr($data) {

	$data_mysql = $data;
	$timestamp = strtotime($data_mysql);
	$year = date('Y', $timestamp);

	if( $year > 1990 ) {

		$data_mysql = $data;
		$timestamp = strtotime($data_mysql);
		return date('d/m/Y \à\s H:i \H\r\s', $timestamp); 

	}

}

function databr_min($data) {

	$data = explode("-",$data);
	$data = $data[2]."/".$data[1]."/".$data[0];
	return $data;

}

function databr_hora($data) {

	$data_mysql = $data;
	$timestamp = strtotime($data_mysql);
	$year = date('Y', $timestamp);

	if( $year > 1990 ) {

		$data_mysql = $data;
		$timestamp = strtotime($data_mysql);
		return date('H:i:s', $timestamp); 

	}

}

function datausa_min($data) {

    $data_mysql = explode("/", $data);

    // Verifique se o array possui pelo menos 3 elementos
    if (count($data_mysql) >= 3) {
        $data_mysql = $data_mysql[2] . "-" . $data_mysql[1] . "-" . $data_mysql[0];
        return $data_mysql;
    } else {
        // Lide com o caso da data inválida, por exemplo:
        return null;  // Ou lance uma exceção
    }

}

function clean_str($str) {

	$str = str_replace("-", "", $str);
	$str = str_replace("/", "", $str);
	$str = str_replace(".", "", $str);
	$str = str_replace("_", "", $str);
	$str = str_replace(" ", "", $str);
	$str = str_replace("(", "", $str);
	$str = str_replace(")", "", $str);
	$str = str_replace("\n", "", $str);

	return $str;

}

function dinheiro($str,$formato = "") {

	$stroriginal = $str;
	$str = str_replace("R$ ","",$str);
	$str = str_replace(".","",$str);
	$str = str_replace(",",".",$str);

	if( $formato == "BR" ) {
		$str = $stroriginal;
		$str = number_format($str,2,',','.');
	}

	if( $formato == "US" ) {
		$str = number_format($str,2,'.',',');
	}

	return $str;

}

function xml_entities($string) {

    return str_replace(
        array("&",     "<",    ">",    '"',      "'"),
        array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"), 
        $string
    );
    
}

function mask($val, $mask) {

// echo mask($cnpj,'##.###.###/####-##');
// echo mask($cpf,'###.###.###-##');
// echo mask($cep,'#####-###');
// echo mask($data,'##/##/####');

 $maskared = '';
 $k = 0;
 for($i = 0; $i<=strlen($mask)-1; $i++)
 {
 if($mask[$i] == '#')
 {
 if(isset($val[$k]))
 $maskared .= $val[$k++];
 }
 else
 {
 if(isset($mask[$i]))
 $maskared .= $mask[$i];
 }
 }
 return $maskared;

}

function list_errors() {

	global $errormessage;

	echo '<div class="list-errors">';

        echo '<div class="title-line mt-0 pd-0">';
		echo '	<i class="lni lni-close"></i>';
		echo '		<span>Erro:</span>';
		echo '	<div class="clear"></div>';
		echo '</div>';

		// echo '<h4 class="title">Erro:</h4>';

		for( $x=0; $x < count( $errormessage ); $x++ ) {

			echo '<div class="error-info"><i class="lni lni-close"></i> '.$errormessage[$x].'</div>';

		}

	echo '</div>';

}

function system_footer() {

	global $system_footer;
	echo $system_footer;

}

function system_header() {

	global $system_header;
	echo $system_header;

}

function modal_alerta($msg,$type) {

	global $system_footer;

	$system_footer .= "<script>";
	$system_footer .= "\n";
	$system_footer .= "$( document ).ready(function() {";
	$system_footer .= "\n";

		$iconsuccess = "<i class='alerta-icone-sucesso alerta-icone lni lni-checkmark'></i>";
		$iconerror = "<i class='alerta-icone-erro alerta-icone lni lni-close'></i>";

		if( $type == "sucesso" ) {
			$system_footer .= '$("#modalalerta .modal-body").html("'.$iconsuccess.'");';
			$system_footer .= "\n";
		}
		if( $type == "erro" ) {
			$system_footer .= '$("#modalalerta .modal-body").html("'.$iconerror.'");';
			$system_footer .= "\n";
		}
		$system_footer .= '$("#modalalerta .modal-body").append("<span>'.$msg.'</span>");';
		$system_footer .= "\n";
		$system_footer .= '$("#modalalerta").modal("show");';
		$system_footer .= "\n";

	$system_footer .= "});";
	$system_footer .= "\n";
	$system_footer .= "</script>";
	$system_footer .= "\n";

}

function htmlclean($str) {

	$str = htmlspecialchars($str);
	return $str;

}

function htmlcleanbb($str) {

	$str = strip_tags($str);
	return $str;

}

function jsonsave($str) {

	$str = base64_encode( $str );
	return $str;

}

function htmljson($str) {

	$str = htmlentities( base64_decode( $str ) );
	return $str;

}

function linker($str) {

	if( substr($str, 0,7) == "http://" ) {
		$protocolo = "http://";
	}

	if( substr($str, 0,8) == "https://" ) {
		$protocolo = "https://";
	}

	if( !$protocolo ) {
		$protocolo = "http://";
	}

	$str = str_replace("http://", "", $str);
	$str = str_replace("https://", "", $str);

	return strtolower( $protocolo.$str );

}

function subdomain($str) {
	$regex = "@[^a-zA-Z0-9\-]@i";
	$str = preg_replace($regex,"",$str);
	return strtolower( $str );
}

function counter( $estabelecimento,$tipo ) {

	global $db_con;

	if( $tipo == "categoria" ) {
		$sql = mysqli_query( $db_con, "SELECT id FROM categorias WHERE rel_estabelecimentos_id = '$estabelecimento'");
	  	$counter = mysqli_num_rows( $sql );
  	}

	if( $tipo == "produto" ) {
		$sql = mysqli_query( $db_con, "SELECT id FROM produtos WHERE rel_estabelecimentos_id = '$estabelecimento'");
	  	$counter = mysqli_num_rows( $sql );
  	}

	if( $tipo == "pedido" ) {
		$sql = mysqli_query( $db_con, "SELECT id FROM pedidos WHERE rel_estabelecimentos_id = '$estabelecimento' AND status = '1' ");
	  	$counter = mysqli_num_rows( $sql );
  	}

	if( $tipo == "banner" ) {
		$sql = mysqli_query( $db_con, "SELECT id FROM banners WHERE rel_estabelecimentos_id = '$estabelecimento' AND status = '1' ");
	  	$counter = mysqli_num_rows( $sql );
  	}

  	return $counter;

}

function color_name_to_hex($color_name){
    $colors  =  array(
        'aliceblue'=>'F0F8FF',
        'antiquewhite'=>'FAEBD7',
        'aqua'=>'00FFFF',
        'aquamarine'=>'7FFFD4',
        'azure'=>'F0FFFF',
        'beige'=>'F5F5DC',
        'bisque'=>'FFE4C4',
        'black'=>'000000',
        'blanchedalmond '=>'FFEBCD',
        'blue'=>'0000FF',
        'blueviolet'=>'8A2BE2',
        'brown'=>'A52A2A',
        'burlywood'=>'DEB887',
        'cadetblue'=>'5F9EA0',
        'chartreuse'=>'7FFF00',
        'chocolate'=>'D2691E',
        'coral'=>'FF7F50',
        'cornflowerblue'=>'6495ED',
        'cornsilk'=>'FFF8DC',
        'crimson'=>'DC143C',
        'cyan'=>'00FFFF',
        'darkblue'=>'00008B',
        'darkcyan'=>'008B8B',
        'darkgoldenrod'=>'B8860B',
        'darkgray'=>'A9A9A9',
        'darkgreen'=>'006400',
        'darkgrey'=>'A9A9A9',
        'darkkhaki'=>'BDB76B',
        'darkmagenta'=>'8B008B',
        'darkolivegreen'=>'556B2F',
        'darkorange'=>'FF8C00',
        'darkorchid'=>'9932CC',
        'darkred'=>'8B0000',
        'darksalmon'=>'E9967A',
        'darkseagreen'=>'8FBC8F',
        'darkslateblue'=>'483D8B',
        'darkslategray'=>'2F4F4F',
        'darkslategrey'=>'2F4F4F',
        'darkturquoise'=>'00CED1',
        'darkviolet'=>'9400D3',
        'deeppink'=>'FF1493',
        'deepskyblue'=>'00BFFF',
        'dimgray'=>'696969',
        'dimgrey'=>'696969',
        'dodgerblue'=>'1E90FF',
        'firebrick'=>'B22222',
        'floralwhite'=>'FFFAF0',
        'forestgreen'=>'228B22',
        'fuchsia'=>'FF00FF',
        'gainsboro'=>'DCDCDC',
        'ghostwhite'=>'F8F8FF',
        'gold'=>'FFD700',
        'goldenrod'=>'DAA520',
        'gray'=>'808080',
        'green'=>'008000',
        'greenyellow'=>'ADFF2F',
        'grey'=>'808080',
        'honeydew'=>'F0FFF0',
        'hotpink'=>'FF69B4',
        'indianred'=>'CD5C5C',
        'indigo'=>'4B0082',
        'ivory'=>'FFFFF0',
        'khaki'=>'F0E68C',
        'lavender'=>'E6E6FA',
        'lavenderblush'=>'FFF0F5',
        'lawngreen'=>'7CFC00',
        'lemonchiffon'=>'FFFACD',
        'lightblue'=>'ADD8E6',
        'lightcoral'=>'F08080',
        'lightcyan'=>'E0FFFF',
        'lightgoldenrodyellow'=>'FAFAD2',
        'lightgray'=>'D3D3D3',
        'lightgreen'=>'90EE90',
        'lightgrey'=>'D3D3D3',
        'lightpink'=>'FFB6C1',
        'lightsalmon'=>'FFA07A',
        'lightseagreen'=>'20B2AA',
        'lightskyblue'=>'87CEFA',
        'lightslategray'=>'778899',
        'lightslategrey'=>'778899',
        'lightsteelblue'=>'B0C4DE',
        'lightyellow'=>'FFFFE0',
        'lime'=>'00FF00',
        'limegreen'=>'32CD32',
        'linen'=>'FAF0E6',
        'magenta'=>'FF00FF',
        'maroon'=>'800000',
        'mediumaquamarine'=>'66CDAA',
        'mediumblue'=>'0000CD',
        'mediumorchid'=>'BA55D3',
        'mediumpurple'=>'9370D0',
        'mediumseagreen'=>'3CB371',
        'mediumslateblue'=>'7B68EE',
        'mediumspringgreen'=>'00FA9A',
        'mediumturquoise'=>'48D1CC',
        'mediumvioletred'=>'C71585',
        'midnightblue'=>'191970',
        'mintcream'=>'F5FFFA',
        'mistyrose'=>'FFE4E1',
        'moccasin'=>'FFE4B5',
        'navajowhite'=>'FFDEAD',
        'navy'=>'000080',
        'oldlace'=>'FDF5E6',
        'olive'=>'808000',
        'olivedrab'=>'6B8E23',
        'orange'=>'FFA500',
        'orangered'=>'FF4500',
        'orchid'=>'DA70D6',
        'palegoldenrod'=>'EEE8AA',
        'palegreen'=>'98FB98',
        'paleturquoise'=>'AFEEEE',
        'palevioletred'=>'DB7093',
        'papayawhip'=>'FFEFD5',
        'peachpuff'=>'FFDAB9',
        'peru'=>'CD853F',
        'pink'=>'FFC0CB',
        'plum'=>'DDA0DD',
        'powderblue'=>'B0E0E6',
        'purple'=>'800080',
        'red'=>'FF0000',
        'rosybrown'=>'BC8F8F',
        'royalblue'=>'4169E1',
        'saddlebrown'=>'8B4513',
        'salmon'=>'FA8072',
        'sandybrown'=>'F4A460',
        'seagreen'=>'2E8B57',
        'seashell'=>'FFF5EE',
        'sienna'=>'A0522D',
        'silver'=>'C0C0C0',
        'skyblue'=>'87CEEB',
        'slateblue'=>'6A5ACD',
        'slategray'=>'708090',
        'slategrey'=>'708090',
        'snow'=>'FFFAFA',
        'springgreen'=>'00FF7F',
        'steelblue'=>'4682B4',
        'tan'=>'D2B48C',
        'teal'=>'008080',
        'thistle'=>'D8BFD8',
        'tomato'=>'FF6347',
        'turquoise'=>'40E0D0',
        'violet'=>'EE82EE',
        'wheat'=>'F5DEB3',
        'white'=>'FFFFFF',
        'whitesmoke'=>'F5F5F5',
        'yellow'=>'FFFF00',
        'yellowgreen'=>'9ACD32');
    $color_name = strtolower($color_name);
    if (isset($colors[$color_name])){
        return ('#' . $colors[$color_name]);
    } else {
        return ($color_name);
    }
}

function hex2rgba($color, $opacity = false) {

	$color = color_name_to_hex( $color );
	$default = 'rgb(0,0,0)';
	if(empty($color))
	      return $default; 
	    if ($color[0] == '#' ) {
	    	$color = substr( $color, 1 );
	    }
	    if (strlen($color) == 6) {
	            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	    } elseif ( strlen( $color ) == 3 ) {
	            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	    } else {
	            return $default;
	    }
	    $rgb =  array_map('hexdec', $hex);
	    if($opacity){
	    	if(abs($opacity) > 1)
	    		$opacity = 1.0;
	    	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	    } else {
	    	$output = 'rgb('.implode(",",$rgb).')';
	    }
	    return $output;
	}


function bbzap($orimessage) {
	$styles = array ( '*' => 'strong', '_' => 'i', '~' => 'strike');
	return preg_replace_callback('/(?<!\w)([*~_])(.+?)\1(?!\w)/',
	function($m) use($styles) { return '<'. $styles[$m[1]]. '>'. $m[2]. '</'. $styles[$m[1]]. '>';}, $orimessage);
}


function formato( $str, $modo ) {

	$str = clean_str($str);

	if( $modo == "whatsapp" ) {

		// Celular
		if( strlen($str) == 11 ) {
			$str = "(".substr($str, 0,2).") ".substr($str, 2,1).".".substr($str, 3,4)."-".substr($str, 7,4);
		}

		// Fixo
		if( strlen($str) == 10 ) {

		}

		return $str;

	}

}

function instantrender() {

	flush();
	ob_flush();

}

function slugify($string) {

	$table = array(
	    'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
	    'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
	    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
	    'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
	    'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
	    'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
	    'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
	    'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
	);

	$string = strtr($string, $table);
	$slug = strtolower( trim( preg_replace('/[^A-Za-z0-9-]+/', '-', $string) ) );
	$slug = str_replace("-", "", $slug);
	return $slug;

}

function remoter($url) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($ch);

}

?>