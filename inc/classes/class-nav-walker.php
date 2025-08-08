<?php

    class Nav_Walker extends Walker_Nav_Menu {

        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $classes = array( 'main-navigation__submenu' );
             if ( $depth >= 1 ) {
                $classes[] = 'main-navigation__submenu--deep';
            }
            $class_attr = implode( ' ', $classes );
            $output .= "\n$indent<ul class=\"$class_attr\">\n";
        }

        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $classes[] = 'main-navigation__item';

            if (in_array('menu-item-has-children', $classes)) {
                $classes[] = 'main-navigation__item--has-children';
            }

            $class_names = join( ' ', array_filter( $classes ) );
            $class_names = ' class="' . esc_attr( $class_names ) . '"';

            $output .= '<li' . $class_names . '>';

            if ( $item->url === '#' ) {
                $output .= '<span class="main-navigation__link">' . esc_html( $item->title ) . '</span>';
            } else {
                $attributes  = ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
                $output .= '<a class="main-navigation__link"' . $attributes . '>';
                $output .= esc_html( $item->title );
                $output .= '</a>';
            }
        }

        public function end_el( &$output, $item, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
        }

        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= "</ul>\n";
        }
    }
