<?php get_header(); ?>

<main>
	<section class="products">
		<h1><?php echo esc_html__('Search results', 'example-theme'); ?></h1>

		<?php
		global $wp_query;
		generate_article($wp_query);
		?>
	</section>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

