<?php
add_action('admin_init', function () {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Disable comments & trackbacks support for all post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments menu & admin bar item
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});

// 2. Hide widget admin menu (but keep widget functions like the_widget())
add_action('admin_menu', function () {
    remove_menu_page('widgets.php');
});

// Disable block-based widget editor (WP 5.8+)
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');

// Optional: Hide Widgets panel from Customizer
add_action('customize_register', function($wp_customize) {
    $wp_customize->remove_panel('widgets');
});

function remove_wp_admin_bar_margin() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_wp_admin_bar_margin');

/* plugin */

add_filter( 'aws_searchbox_markup', function( $markup, $params ) {
    $old_svg = '<svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px">';
    $old_svg .= '<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>';
    $old_svg .= '</svg>';

    $new_svg = load_inline_svg('search');

    $markup = str_replace(
        $old_svg, 
        $new_svg, 
        $markup
    );
    return $markup;
}, 10, 2 );