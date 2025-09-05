<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="smooth-wrapper">
<div id="smooth-content">

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ecommerce' ); ?></a>
	<header id="masthead" class="site-header">
		<?php if(get_field('header', 'options')): $header = get_field('header', 'options') ?>
			<?php if($header['banner']): $banner = $header['banner']; ?>
				<section class="promo-banner">
					<div class="container">
						<p class="text-center">
							<b><?= $banner['accent'] ?></b>
							<?= $banner['message'] ?>
						</p>
					</div>
				</section>
			<?php endif; ?>
		<?php endif; ?>
		<section class="brading">
			<div class="container flex-center">
				<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						echo wp_get_attachment_image( 
							get_theme_mod('custom_logo' ),
							'full',
							false,
							['fetch-priority' => 'high'] 
						);
					}
				?>
			</div>
		</section>
		<section>
			<div class="container flex justify-between">
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
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<div class="flex align-center">
					<?php aws_get_search_form( true ); ?>
					<a class="cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'Ver carrito', 'ecommerce' ); ?>">
						<?php echo load_inline_svg('cart'); ?>
						<span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</section>
	</header>
