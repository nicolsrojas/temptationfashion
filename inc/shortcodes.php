<?php

function gsap_carousel_shortcode($atts) {
    // Optional: attributes support
    $atts = shortcode_atts([
        'total_cards' => 12, // Total number of cards
    ], $atts, 'gsap_carousel');

    ob_start();
    ?>
    <div class="swiper-container">
        <div class="gsap-carousel swiper" data-carousel>
            <div class="swiper-wrapper">
                <?php for ($i = 1; $i <= $atts['total_cards']; $i++) : ?>
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <h3>Card <?php echo $i; ?></h3>
                            <p>This is content for card <?php echo $i; ?>.</p>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="navigation button-prev">
            <?php echo load_inline_svg('arrow-left') ?>
        </div>
        <div class="navigation button-next">
            <?php echo load_inline_svg('arrow-right') ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('gsap_carousel', 'gsap_carousel_shortcode');

function maybe_enqueue_swiper_assets() {
    global $post;

    if (!isset($post) || !is_a($post, 'WP_Post')) return;

    if (has_shortcode($post->post_content, 'gsap_carousel')) {
        add_action('wp_enqueue_scripts', 'enqueue_swiper_assets');
    }
}
add_action('wp', 'maybe_enqueue_swiper_assets');

function enqueue_swiper_assets() {
    $uri = get_template_directory_uri();
    wp_enqueue_style('swiper', $uri . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('swiper-custom', $uri . '/assets/css/swiper.css', array('swiper'));
    wp_enqueue_script('swiper', $uri . '/assets/js/swiper-bundle.min.js', [], null, true);
}