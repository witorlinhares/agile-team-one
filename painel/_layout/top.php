<div class="header">

	<div class="top top-painel">

		<div class="container">

			<div class="row align-middle hidden-sm hidden-xs">

				<div class="col-md-3">

					<div class="brand">
						<a href="<?php panel_url(); ?>">
							<img src="<?php echo thumber( ($_SESSION['estabelecimento']['perfil']), 150 ); ?>" alt="<?php echo ($_SESSION['estabelecimento']['nome']); ?>"/>
							<span><?php echo ($_SESSION['estabelecimento']['nome']); ?><strong class="colored"></strong></span>
						</a>
					</div>

				</div>

				<div class="col-md-6">

					<div class="search-bar">

						<div class="clear"></div>

					</div>

				</div>

				<div class="col-md-3">

					<div class="user-info pull-right">

						<div class="user-info-login">
							<a href="<?php panel_url(); ?>/configuracoes" title="Minha conta">
								<i class="lni lni-user"></i>
								<span><?php echo limitchar( user_info("email"), "18" ); ?></span>
							</a>
						</div>
						<div class="user-info-config">
							<a href="<?php echo panel_url(); ?>/configuracoes" title="Configurações">
								<i class="lni lni-cog"></i>
							</a>
						</div>
						<div class="user-info-logout">
							<a href="<?php echo just_url(); ?>/logout" title="Sair">
								<i class="lni lni-power-switch"></i>
							</a>
						</div>

					</div>

				</div>

			</div>

			<div class="row align-middle-mobile visible-sm visible-xs">

				<div class="col-md-3 col-sm-3 col-xs-3">

					<div class="user-menu pull-left">
						<a href="#" class="sidrLeft" href="#sidebarLeft" title="Menu">
							<i class="lni lni-menu"></i>
						</a>
					</div>

				</div>

				<div class="col-md-6 col-sm-6 col-xs-6 nopadd">


				</div>

				<div class="col-md-3 col-sm-3 col-xs-3">

					<div class="user-info pull-right">

						<div class="user-info-login">
							<a href="#" class="sidrRight" href="#sidebarRight" title="Minha conta">
								<i class="lni lni-user"></i>
							</a>
						</div>

					</div>

				</div>

			</div>


		</div>

	</div>

	<div class="navigator naver hidden-sm hidden-xs">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<?php include('navigation.php'); ?>

				</div>

			</div>

		</div>

	</div>

	<div class="header-interna">

		<div class="locked-bar visible-xs visible-sm">

			<div class="avatar">
				<div class="holder">
					<a href="<?php echo panel_url(); ?>">
						<img src="<?php echo thumber( $_SESSION['estabelecimento']['perfil'], 120 ); ?>"/>
					</a>
				</div>	
			</div>

		</div>

		<div class="holder-interna holder-interna-nopadd visible-xs visible-sm"></div>

	</div>

</div>