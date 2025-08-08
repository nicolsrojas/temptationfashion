<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="smooth-wrapper">
<div id="smooth-content">
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ecommerce' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="container flex justify-between">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$ecommerce_description = get_bloginfo( 'description', 'display' );
				if ( $ecommerce_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $ecommerce_description; ?></p>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation flex align-center">
				<button class="menu-toggle hide-desktop" aria-controls="primary-menu" aria-expanded="false">
					<?php esc_html_e( 'Primary Menu', 'ecommerce' ); ?>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class' => 'main-navigation__list',
						'walker'         => new Nav_Walker(),
					)
				);
				?>
			</nav>
		</div>
	</header>
