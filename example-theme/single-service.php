<?php get_header(); ?>

<main class="w-100">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<article class="bg-white rounded-3 shadow-sm p-4 mb-4">
				<h1 class="h3 mb-3"><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mb-3">
						<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="content mb-3">
					<?php the_content(); ?>
				</div>

				<div class="d-flex align-items-center gap-2">
					<?php if ( shortcode_exists( 'like_button' ) ) : ?>
						<?php echo do_shortcode( '[like_button]' ); ?>
					<?php endif; ?>
					<a class="btn btn-outline-secondary" href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>">
						<?php echo esc_html__( 'All services', 'example-theme' ); ?>
					</a>
				</div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>

