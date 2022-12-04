<!DOCTYPE html>
<html lang="en">

<head>
	<title>Soft Solutions Inc test</title>
	<meta charset="UTF-8" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" href="css/style.min.css?_v=20221128203357" />
	<!-- <link rel="shortcut icon" href="favicon.ico"> -->
	<!-- <meta name="robots" content="noindex, nofollow"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>

</head>

<body>
	<div class="wrapper">
		<header class="header">
			<div class="header__container">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo logo">
					<picture>
						<img class="logo__desc" src="<?php echo get_template_directory_uri() ?>/assets/img/logo.png" alt="Logo" />
					</picture>
					<picture>
						<img class="logo__mob" src="<?php echo get_template_directory_uri() ?>/assets/img/logo-mob.png" alt="Logo" />
					</picture>
				</a>
				<div class="header__menu menu">
					<nav class="menu__body">
						<?php
						wp_nav_menu([
							'theme_location' => 'header_menu',
							'container'  => false,
							'items_wrap' => '<ul class="%2$s">%3$s</ul>',
							'menu_class' => 'menu__list'

						]);
						?>
					</nav>
				</div>

				<a href="https://vitaliidiakin.adamax.com.ua/" class="header__button button" target="_blank">I am Button</a>
				<button type="button" class="menu__icon icon-menu"><span></span></button>
			</div>
		</header>
