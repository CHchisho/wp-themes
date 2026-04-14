<?php get_header(); ?>

<main class="full-width">
	<section class="single">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php else : ?>
			<?php _e('Sorry, no posts matched your criteria.', 'example-theme'); ?>
		<?php endif; ?>
	</section>
</main>

<?php get_footer(); ?>

