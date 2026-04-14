<?php get_header(); ?>

<main class="w-100">
	<section class="mb-4">
		<div class="p-4 bg-white rounded-3 shadow-sm">
			<h1 class="h3 mb-2"><?php echo esc_html__( 'Services', 'example-theme' ); ?></h1>
			<p class="mb-0 text-muted"><?php echo esc_html__( 'Choose a service to open its details page.', 'example-theme' ); ?></p>
		</div>
	</section>

	<section class="products">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article class="product bg-white rounded-3 shadow-sm">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="mb-2">
							<?php the_post_thumbnail( 'medium_large', array( 'class' => 'img-fluid rounded' ) ); ?>
						</div>
					<?php endif; ?>
					<h2 class="h5"><?php the_title(); ?></h2>
					<p><?php echo esc_html( get_the_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 22 ) ); ?></p>
					<a class="btn btn-outline-dark" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Open', 'example-theme' ); ?></a>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p class="text-muted"><?php echo esc_html__( 'No services yet.', 'example-theme' ); ?></p>
		<?php endif; ?>
	</section>
</main>

<?php get_footer(); ?>

