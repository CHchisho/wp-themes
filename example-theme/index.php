<?php get_header(); ?>

<section class="hero">
    <div class="hero-text">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <?php _e( 'Sorry, no posts matched your criteria.', 'example-theme' ); ?>
        <?php endif; ?>
    </div>

    <?php if ( function_exists( 'the_custom_header_markup' ) && get_header_image() ) : ?>
        <?php the_custom_header_markup(); ?>
    <?php else : ?>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/map.svg" alt="Hero">
    <?php endif; ?>
</section>

<main>
    <section class="products">
        <h2>Featured Products</h2>
        <article class="product">
            <img src="//placehold.it/200x200?text=Product" alt="Product">
            <h3>Product 1</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.</p>
            <a href="#">Read More</a>
        </article>
        <article class="product">
            <img src="//placehold.it/200x200?text=Product" alt="Product">
            <h3>Product 2</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.</p>
            <a href="#">Read More</a>
        </article>
        <article class="product">
            <img src="//placehold.it/200x200?text=Product" alt="Product">
            <h3>Product 3</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quos.</p>
            <a href="#">Read More</a>
        </article>
    </section>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>