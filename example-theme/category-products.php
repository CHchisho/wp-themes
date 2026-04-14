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
	$images = get_uploaded_header_images();
	$hero   = '';
	if (is_array($images) && count($images) >= 2) {
		array_shift($images);
		$second = array_shift($images);
		if (is_array($second) && isset($second['url'])) {
			$hero = $second['url'];
		}
	}
	$w = (int) get_custom_header()->width;
	$h = (int) get_custom_header()->height;
	?>

	<?php if ($hero) : ?>
		<img
			src="<?php echo esc_url($hero); ?>"
			alt="Hero"
			width="<?php echo esc_attr($w); ?>"
			height="<?php echo esc_attr($h); ?>"
		>
	<?php elseif (function_exists('the_custom_header_markup') && get_header_image()) : ?>
		<?php the_custom_header_markup(); ?>
	<?php else : ?>
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/map.svg" alt="Hero">
	<?php endif; ?>
</section>

<main>
	<?php
	$main_category_id = get_queried_object_id();
	$sub_categories   = get_categories(
		array(
			'parent'     => $main_category_id,
			'hide_empty' => false,
		)
	);
	?>

	<?php foreach ($sub_categories as $sub_category) : ?>
		<section class="products mb-4">
			<h2 class="h4 w-100 mb-3"><?php echo esc_html($sub_category->name); ?></h2>

			<?php
			$args                  = array(
				'post_type'      => 'post',
				'cat'            => $sub_category->term_id,
				'posts_per_page' => 2,
			);
			$sub_category_products = new WP_Query($args);

			generate_article($sub_category_products);
			?>

			<article class="product all">
				<a href="<?php echo esc_url(get_category_link($sub_category->term_id)); ?>">
					<?php echo esc_html__('View All', 'example-theme'); ?>
				</a>
			</article>
		</section>
	<?php endforeach; ?>

	<?php wp_reset_postdata(); ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

