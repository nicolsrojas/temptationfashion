<?php  

function enqueue_carousel_assets() {
    $uri = get_template_directory_uri();

    // Swiper core
    wp_enqueue_style('swiper', $uri . '/components/carousel/swiper-bundle.min.css');
    wp_enqueue_script('swiper', $uri . '/components/carousel/swiper-bundle.min.js', [], null, true);

    // Custom styles/scripts
    wp_enqueue_style('carousel', $uri . '/components/carousel/carousel.css', ['swiper']);
    wp_enqueue_script('carousel', $uri . '/components/carousel/carousel.js', ['swiper'], null, true);
}
function load_inline_asset($filename, $path = 'assets/icons', $class = '') {
    $file = get_template_directory() . '/' . trim($path, '/') . '/' . $filename . '.svg';

    if (!file_exists($file)) {
        return '';
    }

    $svg = file_get_contents($file);

    if ($class) {
        $svg = preg_replace('/<svg\s/', '<svg class="' . esc_attr($class) . '" ', $svg, 1);
    }

    return $svg;
}

// Reusable carousel renderer
function render_carousel($slides) {
    ob_start(); ?>
    
    <div class="swiper-container">
        <div class="gsap-carousel swiper" data-carousel>
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide): ?>
                    <div class="swiper-slide">
                        <?php echo load_inline_asset('shape', 'components/carousel', 'shape'); ?>
                        <div class="slide-content">
                            <p>
                                <?php echo esc_html($slide['content']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Navigation -->
        <button class="navigation button-prev">
            <?php echo load_inline_asset('arrow-left', 'components/carousel', 'carousel-arrow'); ?>
        </button>
        <button class="navigation button-next">
            <?php echo load_inline_asset('arrow-right', 'components/carousel', 'carousel-arrow'); ?>
        </button>
    </div>

    <?php 
    return ob_get_clean();
}
