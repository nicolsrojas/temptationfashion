	<footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info text-center">
                <?php 
                    esc_html_e( 'All rights reserved', 'ecommerce' ); 
                    printf(
                        esc_html__( '%1$s - %2$s', 'ecommerce' ),
                        date( 'Y' ),
                        get_bloginfo( 'name' )
                    );
                ?>
                <span class="sep"> | </span>
                    <?php
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'ecommerce' ), 'ecommerce', '<a href="https://nicolsrojas.dev">Nicols Rojas</a>' );
                    ?>
            </div>
        </div>
	</footer>
</div>
<?php wp_footer(); ?>
</div>
</div>
</body>
</html>
