<?php 
function load_inline_svg($filename, $class = '') {
    
    $file = get_template_directory() . '/assets/icons/' . $filename . '.svg';
    if (!file_exists($file)) return '';
    $svg = file_get_contents($file);
    if ($class) {
        $svg = preg_replace('/<svg\s/', '<svg class="' . esc_attr($class) . '" ', $svg, 1);
    }
    return $svg;
}