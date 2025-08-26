<?php
/* template name: Homepage */
    get_header();
?>
	<main id="primary" class="site-main">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			endwhile;
			?>
            <?php $carousel = get_field('carousel');?>
            <?php if ( $carousel && !empty($carousel['slides']) ) : ?>
                <section>
                    <div class="full-container">
                        <div class="inner-container">
                            <?php echo render_carousel( $carousel['slides'] ); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
		</div>
	</main>
<?php
get_footer();
