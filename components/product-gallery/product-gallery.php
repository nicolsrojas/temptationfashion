<?php 
    function render_product_gallery($args = []) {
         $defaults = [
            'limit'   => 8,
            'orderby' => 'date',
            'order'   => 'DESC',
            'status'  => 'publish',
        ];

        $args = wp_parse_args( $args, $defaults );
        $products = wc_get_products( $args );
        if ( ! $products ) return;

        ob_start(); ?>
            <div class="product-gallery">
               <?php foreach ($products as $product) : ?>
                    <?= render_product_card($product->get_id()) ?>
                <?php endforeach;?>
            </div>
        <?php 
        return ob_get_clean();
    }
?>