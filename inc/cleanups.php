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
