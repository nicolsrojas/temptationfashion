<?php 
    function enqueue_product_card_assets() {
        $uri = get_template_directory_uri();

        // Custom styles/scripts
        wp_enqueue_style('product-card', $uri . '/components/product-card/product-card.css', ['swiper']);
    }
    function wc_get_product_discount_percentage( $product ) {
        if ( ! $product || ! $product->is_type( array( 'simple', 'variable' ) ) ) {
            return false;
        }

        if ( $product->is_type( 'simple' ) ) {
            $regular = (float) $product->get_regular_price();
            $sale    = (float) $product->get_sale_price();
        } elseif ( $product->is_type( 'variable' ) ) {
            $regular = (float) $product->get_variation_regular_price( 'max' );
            $sale    = (float) $product->get_variation_sale_price( 'min' );
        }

        if ( $regular > 0 && $sale > 0 && $sale < $regular ) {
            return round( ( ( $regular - $sale ) / $regular ) * 100 );
        }

        return false;
    }

    function render_product_card($post_id){
        $product = wc_get_product($post_id);
        ob_start(); ?>
        <div class="product-card">
            <a href="<?= get_permalink($product->get_id()); ?>" class="product-link">
                <div class="product-image flex-center">
                    <?php 
                        $image = $product->get_image_id();
                        if ($image) :
                            echo wp_get_attachment_image(
                                $image,
                                "medium",
                                false,
                                ['loading' => 'lazy', 'alt' => $product->get_name()]
                            );
                        else :
                            echo wc_placeholder_img( 'medium' );
                        endif;
                    ?>
                </div>
                <div class="product-info">
                    <h3 class="product-title">
                        <?= esc_html($product->get_name()); ?>
                    </h3>
                    <span class="product-price">
                        <?= $product->get_price_html(); ?>
                        <?php if ( $discount = wc_get_product_discount_percentage( $product ) ) : ?>
                            <span class="product-discount">(-<?= $discount; ?>%)</span>
                        <?php endif; ?>
                    </span>
                </div>
            </a>
        </div>
        <?php 
        return ob_get_clean();
    } 
?>