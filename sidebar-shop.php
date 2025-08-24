<aside id="secondary">
    <div>
        <h3>Search Products</h3>
        <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
            <div>
                <input type="search" 
                       name="s" 
                       placeholder="Search products..." 
                       value="<?php echo get_search_query(); ?>" 
                       class="search-input">
                <input type="hidden" name="post_type" value="product">
                <button type="submit" class="search-button">Search</button>
            </div>
        </form>
    </div>

</aside>