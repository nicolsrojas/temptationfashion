<?php
/* template name: Homepage */
get_header();
?>
<main id="primary" class="site-main">
    <?php if(have_rows('hero')): the_row();?>
        <section class="hero">
            <div class="container">
                <div class="content flex">
                    <div class="text-container flex-column justify-center">
                        <h1>
                            <?= get_sub_field('title'); ?>
                        </h1>
                        <p>
                            <?= get_sub_field('subtitle'); ?>
                        </p>
                        <?php if(get_sub_field('button')): ?>
                            <?= render_button(get_sub_field('button')); ?>
                        <?php endif; ?>
                    </div>
                    <div class="image-container flex justify-center">
                        <?php 
                            $hero_image = get_sub_field('image');
                            if ($hero_image) :
                                echo wp_get_attachment_image(
                                    $hero_image,
                                    "medium_large",
                                    false,
                                    ['fetch-priority' => 'high']
                                );
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php if(have_rows('trending')): the_row(); ?>
        <section class="trending">
            <div class="container">
                <h2 class="section-title">
                    <?= get_sub_field('title'); ?>
                </h2>
            </div>
            <?php $carousel = get_sub_field('carousel'); ?>
            <?php if ($carousel && !empty($carousel['slides'])) : ?>
                <?= render_carousel($carousel['slides'], function($slide){
                    return render_product_card($slide['product']);
                }); ?>
            <?php endif; ?>
        </section>
    <?php endif; ?>
    <?php if(have_rows('categories')): the_row(); ?>
        <section class="categories">
            <div class="container">
                <h2 class="section-title">
                    <?= get_sub_field('title'); ?>
                </h2>
                <?php if(have_rows('categories_list')): ?>
                    <div class="categories-grid">
                        <?php while(have_rows('categories_list')): the_row(); ?>
                            <?php 
                                $term_id = get_sub_field('category');
                            ?>
                            <?php if($term_id): ?>
                                <?php $term = get_term($term_id) ?>
                                <a class="category-item" href="<?=  get_term_link($term); ?>">
                                    <?php 
                                         $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
                                          $image_html   = $thumbnail_id 
                                            ? wp_get_attachment_image($thumbnail_id, 'full', false, ['loading' => 'lazy'])
                                            : wc_placeholder_img('full');
                                    ?>
                                     <div class="category-image">
                                        <?= $image_html; ?>
                                    </div>
                                    <h3>
                                        <?= esc_html($term->name); ?>
                                    </h3>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php if(have_rows('product_gallery')): the_row();?>
        <section>
            <div class="container">
                <h2 class="section-title">
                    <?= get_sub_field('title'); ?>
                </h2>
                <?= render_product_gallery(); ?>
            </div>
        </section>
    <?php endif; ?>
    <section class="test">
        <div class="container">
            <?php
                echo do_shortcode('[carrot_ajax_product_filter limit="8" columns="4" category="all"]');
            ?>
        </div>
    </section>
</main>
<?php
get_footer();
