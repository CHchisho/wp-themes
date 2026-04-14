<?php get_header(); ?>

<section class="hero">
	<div class="hero-text">
		<h1><?php single_cat_title(); ?></h1>
		<?php
		$desc = category_description();
		if ($desc) {
			echo wp_kses_post($desc);
		}
		?>
	</div>

	<?php
	$category_id = get_queried_object_id();
	$random_img  = get_random_post_image($category_id);
	?>

	<?php if ($random_img) : ?>
		<img src="<?php echo esc_url($random_img); ?>" alt="<?php echo esc_attr(single_cat_title('', false)); ?>">
	<?php elseif (function_exists('the_custom_header_markup') && get_header_image()) : ?>
		<?php the_custom_header_markup(); ?>
	<?php else : ?>
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/map.svg" alt="Hero">
	<?php endif; ?>
</section>

<main>
	<section class="products">
		<?php
		global $wp_query;
		generate_article($wp_query);
		?>
	</section>
</main>

<?php get_footer(); ?>

