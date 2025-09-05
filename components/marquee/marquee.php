<?php
    function enqueue_marquee_assets() {
        wp_enqueue_style('marquee', get_template_directory_uri() . '/components/marquee/marquee.css');
        wp_enqueue_script('marquee', get_template_directory_uri() . '/components/marquee/marquee.js', array('gsap'), null, true );
    }
    function render_marquee(){
        ob_start(); ?>
            <div class="marquee">
                <div class="marquee-wrapper">
                    <span class="marquee-content">
                        ENVÍO GRATIS (SEGÚN DESTINO) 
                    </span>        
                </div>  
            </div>
        <?php return ob_get_clean();
    }   
?>