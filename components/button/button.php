<?php 
    function render_button($link){
        ob_start(); ?>
            <a href="<?= esc_url($link['url']); ?>" class="btn" <?php if($link['target']) echo 'target="_blank"'; ?> >
                <?= esc_html($link['title']); ?>
            </a>
        <?php 
        return ob_get_clean();
    }
?>