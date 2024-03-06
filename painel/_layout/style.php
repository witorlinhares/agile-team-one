<?php
header("Content-type: text/css");
include('../../_core/_includes/config.php');
$id = mysqli_real_escape_string( $db_con, $_GET['id'] );
$define_query = mysqli_query( $db_con, "SELECT cor FROM estabelecimentos WHERE id = '$id' LIMIT 1");
$define_data = mysqli_fetch_array( $define_query );
$cor = $define_data['cor'];
if( !$cor ) {
	$cor = "#27293E";
}
?>
<style>
.naver {
background: transparent;
}

.naver .navbar a {
color: #052336;
}

.lista-menus .bt i,
.search-bar button i,
.user-info i, .user-menu i, .user-badge i {
color: <?php echo $cor; ?> !important;
}

.top {
border-color: <?php echo $cor; ?> !important;
border-bottom: 0;
border: 0;
}

.navigator {
border: 0;
background: <?php echo $cor; ?> !important;
}

.footer-info,
.categoria .produto .detalhes,
.carousel-indicators .active,
.botao-acao,
.sidebar .sidebar-header,
.minitop,
.opcoes .opcao.active .check,
.floatbar,
.title-icon i,
.copyright,
.panel-default > .panel-heading a {
background: <?php echo $cor; ?> !important;
}

.colored,
.lista-menus .bt i, 
.naver .navbar ul .dropdown-menu i,
.naver .navbar ul a:hover i,
.naver .navbar ul .active i,
.title-line i,
.bread i,
.sidebar .naver .navbar ul a i,
.fake-select i,
.panel-filters .panel-heading i,
.lista-menus .bt i, 
.plano .titulo-min i,
.backbutton i,
.form-field-default button i,
.add-new a i {
color: <?php echo $cor; ?> !important;
}

.naver .navbar ul a i,
.title-icon i,
.panel-filters .panel-heading i,
button i,
.voucher .form-field-default button i {
color: #fff !important;
}

.pagination > li > a:hover, .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
background: <?php echo $cor; ?> !important;
color: #fff;
}

.wizard > .steps .current a,
.wizard > .steps .current a:hover,
.wizard > .steps .current a.active,
.wizard .actions a,
button,
.add-new a:hover {
background: <?php echo $cor; ?> !important;
}

.add-new a:hover i {
color: #fff !important;
}

.search-bar button,
button.close {
background: transparent !important;
}

.panel-default > .panel-heading + .panel-collapse > .panel-body {
border-top: 0;
}

.naver .navbar a {
color: #fff;
}

.bg-gray {
background: transparent;
}

.lista-menus .bt i.lni-shuffle,
.sidebar a {
color: #333 !important;
}

.form-field-default button {
background: rgba(0,0,0,.05) !important;
}

.panel-pendentes .panel-title a {
background: #e67e22 !important
}

.variacoes .variacao .title { 
border-top: 1px solid rgba(255,255,255,.15);
background: rgba(0,0,0,.1) !important;
filter: brightness(120%) grayscale(20%);
}

.variacoes .variacao .title label,
.variacoes .variacao .title input {
color: #333;
}

.variacoes .variacao .remover i {
background: transparent;
}

.pagination a:hover i,
.botao-whatsapp,.botao-whatsapp:hover, .botao-whatsapp:active, .botao-whatsapp:focus,
.botao-whatsapp i {
color: #fff !important;
}

#collapse-voucher .form-field-default button {
border: 0;
background: <?php echo $cor; ?> !important;
}

/* ALL MOBILE */

@media (max-width: 991px) {

	.sidebar .search-bar {
	margin-bottom: 5px;
	width: 100%;
	}

	.user-info i, 
	.user-menu i,
	.sidebar .sidebar-header .close-sidebar {
	color: #fff !important;
	}

	.shop-bag i {
	color: #fff !important;
	}

	.top {
	border-top: 0;
	background: <?php echo $cor; ?> !important;
	}

	.naver {
	background: transparent !important;
	}

}



/* ALL DESK */

@media (min-width: 991px) {

}

</style>