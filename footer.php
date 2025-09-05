	
    <section class="free-shipping">
            <?=
                render_marquee();
            ?>
        </section>
        <?php if(have_rows('discount_banner','options')): the_row();?>
            <section class="discount-banner">
                <div class="container">
                    <div class="content flex">
                        <div class="text-container">
                            <p class="text-center">
                                <?= get_sub_field('top_text'); ?>
                            </p>
                            <div class="flex-center">
                                <?php 
                                    $image = get_sub_field('model');
                                    if ($image) :
                                        echo wp_get_attachment_image(
                                            $image,
                                            "full",
                                            false,
                                            ['load' => 'lazy']
                                        );
                                    endif;
                                ?>
                            </div>
                            <p class="text-center">
                                <?= get_sub_field('bottom_text'); ?>
                            </p>
                        </div>
                        <div class="image-container">
                            <?php 
                                $image = get_sub_field('image');
                                if ($image) :
                                    echo wp_get_attachment_image(
                                        $image,
                                        "full",
                                        false,
                                        ['load' => 'lazy']
                                    );
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
    <?php endif; ?>
    <footer id="colophon" class="site-footer">
        <section class="site-info">
            <div class="container">
                <div class="logo-container">
                    <?php if ( function_exists( 'the_custom_logo' ) ): ?>
                        <a href="<?= esc_url( home_url( '/' ) ); ?>">
                            <?=
						        wp_get_attachment_image( 
                                    get_theme_mod('custom_logo' ),
                                    'full',
                                    false,
                                    ['loading' => 'lazy'] 
                                );
                            ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if(have_rows('footer','options')): the_row(); ?>
                    <div class="flex">
                        <div>
                            <?php if(get_sub_field('menu')['title']): ?>
                                <h3>
                                    <?= get_sub_field('menu')['title']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if(have_rows('menu')): ?>
                                <ul class="unstyled-list">
                                    <?php while(have_rows('menu')): the_row(); ?>
                                        <?php if(have_rows('items')): ?>
                                            <?php while(have_rows('items')): the_row(); ?>
                                                <?php 
                                                    $link = get_sub_field('link');
                                                    if ($link):
                                                        $link_url = $link['url'];
                                                        $link_title = $link['title'];
                                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                                        ?>
                                                        <li>
                                                            <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>">
                                                                <?= esc_html($link_title); ?>
                                                            </a>
                                                        </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if(get_sub_field('customer_service')['title']): ?>
                                <h3>
                                    <?= get_sub_field('customer_service')['title']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if(have_rows('customer_service')): ?>
                                <ul class="unstyled-list">
                                    <?php while(have_rows('customer_service')): the_row(); ?>
                                        <?php if(have_rows('items')): ?>
                                            <?php while(have_rows('items')): the_row(); ?>
                                                <?php 
                                                    $link = get_sub_field('link');
                                                    if ($link):
                                                        $link_url = $link['url'];
                                                        $link_title = $link['title'];
                                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                                        ?>
                                                        <li>
                                                            <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>">
                                                                <?= esc_html($link_title); ?>
                                                            </a>
                                                        </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if(get_sub_field('information')['title']): ?>
                                <h3>
                                    <?= get_sub_field('information')['title']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if(have_rows('information')): ?>
                                <ul class="unstyled-list">
                                    <?php while(have_rows('information')): the_row(); ?>
                                        <?php if(have_rows('items')): ?>
                                            <?php while(have_rows('items')): the_row(); ?>
                                                <?php if (get_sub_field('info')): ?>
                                                    <li>
                                                        <p> <?= esc_html(get_sub_field('info')); ?> </p>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if(get_sub_field('social')['title']): ?>
                                <h3>
                                    <?= get_sub_field('social')['title']; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if(have_rows('social')): ?>
                                <ul class="unstyled-list">
                                    <?php while(have_rows('social')): the_row(); ?>
                                        <?php if(have_rows('items')): ?>
                                            <?php while(have_rows('items')): the_row(); ?>
                                                <?php 
                                                    $link = get_sub_field('link');
                                                    if ($link):
                                                        $link_url = $link['url'];
                                                        $link_title = $link['title'];
                                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                                        ?>
                                                        <li>
                                                            <a href="<?= esc_url($link_url); ?>" target="<?= esc_attr($link_target); ?>">
                                                                <?=
                                                                    wp_get_attachment_image(
                                                                        get_sub_field('icon'),
                                                                        'full',
                                                                        false,
                                                                        ['loading' => 'lazy', 'alt' => $link_title]
                                                                    );
                                                                ?>
                                                            </a>
                                                        </li>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="site-info">
                    <?php 
                        esc_html_e( 'Todos los derechos reservados. ', 'ecommerce' ); 
                    ?>
                    <span class="sep"> | </span>
                        <?php
                        printf( esc_html__( '%1$s por %2$s.', 'ecommerce' ), 'Temptation Fashion', '<a href="https://nicolsrojas.dev">Nicols Rojas</a>' );
                        ?>
                </div>
            </div>
        </section>
	</footer>
</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
