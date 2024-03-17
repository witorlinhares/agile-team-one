<?php
// CORE
include($virtualpath.'/_layout/define.php');
// include('/_core/_includes/config.php');

// APP
global $app;
is_active( $app['id'] );
global $seo_title;
// Querys
$busca = mysqli_real_escape_string( $db_con, $_GET['busca'] );
$categoria = mysqli_real_escape_string( $db_con, $_GET['categoria'] );
// SEO
$seo_subtitle = $app['title'];
$seo_description = $app['description_clean'];
$seo_keywords = $app['title'].", ".$seo_title;
$seo_image = thumber( $app['avatar_clean'], 400 );
// HEADER
$system_header .= "";
include($virtualpath.'/_layout/head.php');
include($virtualpath.'/_layout/top.php');
include($virtualpath.'/_layout/sidebars.php');
include($virtualpath.'/_layout/modal.php');
instantrender();

//URL
$pegaurlx =  "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<div class="sceneElement">

    <div class="container nopadd visible-xs visible-sm">

        <div class="cover" style="background: url(<?php echo $app['cover']; ?>) no-repeat top center;">
            <?php if( data_info( "estabelecimentos", $app['id'], "capa" ) ) { ?>
            <img src="<?php echo $app['cover']; ?>" />
            <?php } ?>
        </div>

        <div class="grudado">

            <div class="avatar">
                <div class="holder">
                    <a href="<?php echo $app['url']; ?>">
                        <img src="<?php echo $app['avatar']; ?>" alt="<?php echo $app['title']; ?>"
                            title="<?php echo $app['title']; ?>" />
                    </a>
                </div>
            </div>

        </div>

        <div class="app-infos">
            <div class="row">
                <div class="col-md-12">
                    <span class="title"><?php echo $app['title']; ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <span class="description"><?php echo $app['description']; ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div align="center">
                        <span>
                            <?php if( data_info( "estabelecimentos", $app['id'], "funcionamento" ) == "1" ) { ?>
                            <button class="btn btn-success btn-sm"><i class="lni lni-restaurant"
                                    style="color:#FFFFFF"></i> Aberto para Pedidos</button>
                            <?php } else { ?>
                            <button class="btn btn-danger btn-sm"><i class="lni lni-cross-circle"
                                    style="color:#FFFFFF"></i> Fechado para Pedidos</button>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-12">
                    <div class="info-badges flex">
                        <?php if( $app['pedido_minimo'] ) { ?>
                        <div class="info-badge">
                            <i class="lni lni-money-protection"></i>
                            <span>
                                Pedido minímo:<br />
                                <?php echo $app['pedido_minimo']; ?>
                            </span>
                            <div class="clear"></div>
                        </div>
                        <?php } ?>


                        <div class="info-badge">
                            <i class="lni lni-whatsapp"></i>
                            <span><a href="https://api.whatsapp.com/send?text=*Abre%20ai*%20e%20confere%20e%20confere%20essa%20novidade.%20%20<?php print $pegaurlx; ?>"
                                    target="_blank">

                                    Compartilhe<br />
                                    no WhatsAPP
                                </a></span>

                            <div class="clear"></div>
                        </div>




                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="middle minfit">

        <div class="container">

            <div class="row visible-xs visible-sm">
                <div class="col-md-12">
                    <div class="clearline"></div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="search-bar-mobile visible-xs visible-sm">

                        <form class="align-middle" action="<?php echo $app['url']; ?>/categoria" method="GET">

                            <input type="text" name="busca" placeholder="Digite sua busca..."
                                value="<?php echo htmlclean( $_GET['busca'] ); ?>" />
                            <input type="hidden" name="categoria" value="<?php echo $categoria; ?>" />
                            <button>
                                <i class="lni lni-search-alt"></i>
                            </button>
                            <div class="clear"></div>

                        </form>

                    </div>

                </div>

            </div>

            <?php if( $app['funcionalidade_banners'] ) { ?>

            <?php
				$eid = $app['id'];
				$query_banners = mysqli_query( $db_con, "SELECT * FROM banners WHERE rel_estabelecimentos_id = '$eid' AND status = '1' ORDER BY id DESC LIMIT 8" );
				$has_banners = mysqli_num_rows( $query_banners );
				if( $has_banners && $app['funcionalidade_banners'] == 1 ) {
				?>

            <div class="banners">

                <div id="carouselbanners" class="carousel slide">

                    <div class="carousel-inner">

                        <?php
							$actual = 0;
							while ( $data_banners = mysqli_fetch_array( $query_banners ) ) {
							$desktop = $data_banners['desktop'];
							$mobile = $data_banners['mobile'];
							if( !$mobile ) {
								$mobile = $desktop;
							}
							?>

                        <div class="item <?php if( $actual == 0 ) { echo 'active'; }; ?>">

                            <?php if( $data_banners['link'] ) { ?>
                            <a href="<?php echo linker( $data_banners['link'] ); ?>">
                                <?php } ?>

                                <img class="hidden-xs hidden-sm" src="<?php echo imager( $desktop ); ?>" />
                                <img class="visible-xs visible-sm" src="<?php echo imager( $mobile ); ?>" />

                                <?php if( $data_banners['link'] ) { ?>
                            </a>
                            <?php } ?>

                        </div>

                        <?php $actual++; } ?>

                    </div>

                    <?php if( $has_banners >= 1 && $actual >= 2 ) { ?>

                    <a class="left seta seta-esquerda carousel-control" href="#carouselbanners" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right seta seta-direita carousel-control" href="#carouselbanners" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <?php } ?>

                </div>

            </div>

            <?php } ?>

            <?php } ?>

            <div class="categorias">

                <?php
				$app_id = $app['id'];
				$query_categoria = 
				"
				SELECT *, count(*) as total, categorias.nome as categoria_nome, categorias.id as categoria_id, count(produtos.id) as produtos_total
				FROM categorias AS categorias 

				INNER JOIN produtos AS produtos 
				ON produtos.rel_categorias_id = categorias.id 

				WHERE categorias.rel_estabelecimentos_id = '$app_id' 
				AND categorias.visible = '1' 
				AND categorias.status = '1' 

				GROUP BY categorias.id 
				ORDER BY categorias.ordem ASC

				LIMIT 20
				";
				$query_categoria = mysqli_query( $db_con, $query_categoria );
				while ( $data_categoria = mysqli_fetch_array( $query_categoria ) ) {
				?>

                <div class="categoria">

                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-10">
                            <span class="title"><?php echo htmlclean( $data_categoria['categoria_nome'] ); ?></span>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <a class="vertudo"
                                href="<?php echo $app['url']; ?>/categoria/<?php echo $data_categoria['categoria_id']; ?>"><i
                                    class="lni lni-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="produtos">

                        <div class="row">


                            <?php if($app['exibicao'] ==1){ ?>
                            <div class="tv-infinite">
                                <?php } ?>

                                <?php if($app['exibicao'] ==2){ ?>
                                <div class="novalistagem">
                                    <?php } ?>



                                    <?php
								$exibir = "8";
								$cat_id = $data_categoria['categoria_id'];
								$query_produtos = mysqli_query( $db_con, "SELECT * FROM produtos ORDER BY id DESC LIMIT 8" );
								$query_produtos = mysqli_query( $db_con, "SELECT * FROM produtos WHERE rel_categorias_id = '$cat_id' AND visible = '1' AND status = '1' ORDER BY last_modified DESC LIMIT $exibir" );
								while ( $data_produtos = mysqli_fetch_array( $query_produtos ) ) {
									// Seta valor
									if( $data_produtos['oferta'] == "1" ) {
										$valor_final = $data_produtos['valor_promocional'];
									} else {
										$valor_final = $data_produtos['valor'];
									}
								?>

                                    <?php if($app['exibicao'] ==2){ ?>

                                    <div class="col-md-6 col-sm-12 col-xs-12">

                                        <div class="novoproduto">

                                            <a href="<?php echo $app['url']; ?>/produto/<?php echo $data_produtos['id']; ?>"
                                                title="<?php echo $data_produtos['nome']; ?>">

                                                <div class="row">

                                                    <div class="col-md-9 col-sm-7 col-xs-7 npr">

                                                        <span
                                                            class="nome"><?php echo htmlclean( $data_produtos['nome'] ); ?></span>
                                                        <span
                                                            class="descricao"><?php echo htmlclean( $data_produtos['descricao'] ); ?></span>
                                                        <div class="preco">
                                                            <?php if( $valor_final > 0 ) { ?>
                                                            <?php if( $data_produtos['oferta'] == "1" ) { ?>
                                                            <span class="valor_anterior"
                                                                style="text-decoration: line-through;">De R$:
                                                                <?php echo dinheiro( $data_produtos['valor'], "BR" ); ?></span>
                                                            <span class="valor valor-green">Por R$
                                                                <?php echo dinheiro( $valor_final, "BR" ); ?></span>
                                                            <?php } else { ?>
                                                            <span class="blank_valor_anterior"></span>
                                                            <span class="valor valor-green">R$:
                                                                <?php echo dinheiro( $valor_final, "BR" ); ?></span>
                                                            <?php } ?>
                                                            <?php } else { ?>
                                                            <span class="blank_valor_anterior"></span>
                                                            <span class="valor ">Selecione os opcionais</span>
                                                            <?php } ?>


                                                        </div>

                                                    </div>

                                                    <div class="col-md-3 col-sm-5 col-xs-5">

                                                        <div class="capa">
                                                            <img
                                                                src="<?php echo thumber( $data_produtos['destaque'], 450 ); ?>" />
                                                        </div>

                                                    </div>

                                                </div>

                                            </a>

                                        </div>

                                    </div>

                                    <?php } ?>

                                    <?php if($app['exibicao'] ==1){ ?>


                                    <div class="col-md-3 col-infinite">

                                        <div class="produto">

                                            <a href="<?php echo $app['url']; ?>/produto/<?php echo $data_produtos['id']; ?>"
                                                title="<?php echo $data_produtos['nome']; ?>">

                                                <div class="capa"
                                                    style="background: url(<?php echo thumber( $data_produtos['destaque'], 450 ); ?>) no-repeat center center;">
                                                    <span
                                                        class="nome"><?php echo htmlclean( $data_produtos['nome'] ); ?></span>
                                                </div>
                                                <?php if( $valor_final > 0 ) { ?>
                                                <?php if( $data_produtos['oferta'] == "1" ) { ?>
                                                <span class="valor_anterior" style="color:#FF0000">De:
                                                    <?php echo dinheiro( $data_produtos['valor'], "BR" ); ?></span>
                                                <?php } ?>
                                                <span
                                                    class="apenas <?php if( $data_produtos['oferta'] != "1" ) { echo 'apenas-single'; }; ?>">
                                                    <?php if( has_variacao( $data_produtos['id'] ) ) { echo "Por apenas"; } else { echo "Por <br/> apenas"; }; ?>
                                                </span>
                                                <span class="valor">R$
                                                    <?php echo dinheiro( $valor_final, "BR" ); ?></span>
                                                <div class="detalhes"><i class="icone icone-sacola"></i>
                                                    <span>Comprar</span></div>
                                                <?php } else { ?>
                                                <span class="apenas">Este item possui</span>
                                                <span class="apenas">opcionais</span>
                                                <span class="valor" style="color:#FFFFFF">.</span>
                                                <div class="detalhes"><i class="icone icone-sacola"></i>
                                                    <span>Selecione</span></div>
                                                <?php } ?>

                                            </a>

                                        </div>

                                    </div>


                                    <?php } ?>

                                    <?php } ?>

                                    <?php if($app['exibicao'] ==1){ ?>
                                    <div class="col-md-3 col-infinite col-infinite-last visible-xs visible-sm">
                                        <a class="vertudo"
                                            href="<?php echo $app['url']; ?>/categoria/<?php echo $data_categoria['categoria_id']; ?>">Ver
                                            tudo <i class="lni lni-arrow-right"></i></a>
                                    </div>
                                    <?php } ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <?php } ?>


                </div>

            </div>

        </div>

    </div>

    <?php 
// FOOTER
$system_footer .= "";
include($virtualpath.'/_layout/rdp.php');
include($virtualpath.'/_layout/footer.php');
?>