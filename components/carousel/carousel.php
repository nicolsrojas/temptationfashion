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

// Reusable carousel renderer
function render_carousel($slides, $render_callback) {
    ob_start(); ?>
    
    <div class="swiper-container">
        <div class="gsap-carousel swiper" data-carousel>
            <div class="swiper-wrapper">
                <?php foreach ($slides as $slide): ?>
                    <div class="swiper-slide">
                        <div class="slide-content">
                            <?php 
                                if (is_callable($render_callback)) {
                                    echo call_user_func($render_callback, $slide);
                                }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php 
    return ob_get_clean();
}
