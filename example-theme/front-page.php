<?php get_header(); ?>

<section class="hero w-100 mb-4">
	<div class="hero-text">
		<h1 class="mb-3"><?php echo esc_html(get_bloginfo('name')); ?></h1>
		<p class="lead mb-0">
			<?php echo esc_html(get_bloginfo('description') ? get_bloginfo('description') : 'Small business. Big results.'); ?>
		</p>
	</div>

	<?php if (function_exists('the_custom_header_markup') && get_header_image()) : ?>
		<?php the_custom_header_markup(); ?>
	<?php else : ?>
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/map.svg" alt="Hero">
	<?php endif; ?>
</section>

<main class="w-100">
	<section class="mb-4">
		<div class="p-4 bg-white rounded-3 shadow-sm">
			<h2 class="h4 mb-3"><?php echo esc_html__('About us', 'example-theme'); ?></h2>
			<p class="mb-0">
				We are a fictional small business providing services such as consulting, installation, and ongoing support.
				This website is built with WordPress without a pre-made theme, using custom functionality, custom database tables, and AJAX.
			</p>
		</div>
	</section>

	<section class="products">
		<h2 class="h4 w-100 mb-3"><?php echo esc_html__('Popular services', 'example-theme'); ?></h2>

		<?php
		$q = new WP_Query(
			array(
				'post_type'      => 'service',
				'posts_per_page' => 3,
			)
		);
		?>

		<?php if ($q->have_posts()) : ?>
			<?php while ($q->have_posts()) : ?>
				<?php $q->the_post(); ?>
				<article class="product bg-white rounded-3 shadow-sm">
					<?php if (has_post_thumbnail()) : ?>
						<div class="mb-2">
							<?php the_post_thumbnail('medium_large', array('class' => 'img-fluid rounded')); ?>
						</div>
					<?php endif; ?>
					<h3 class="h5"><?php the_title(); ?></h3>
					<p><?php echo esc_html(get_the_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 18)); ?></p>
					<a class="btn btn-outline-dark" href="<?php the_permalink(); ?>"><?php echo esc_html__('Learn more', 'example-theme'); ?></a>
				</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="text-muted mb-0"><?php echo esc_html__('No services yet.', 'example-theme'); ?></p>
		<?php endif; ?>
	</section>

	<section class="products mt-4">
		<h2 class="h4 w-100 mb-3"><?php echo esc_html__('Featured services', 'example-theme'); ?></h2>

		<?php
		$featured = new WP_Query(
			array(
				'post_type'      => 'service',
				'posts_per_page' => 3,
				'tag'            => 'featured',
			)
		);

		generate_article($featured);
		?>
	</section>

	<section class="products mt-4">
		<h2 class="h4 w-100 mb-3"><?php echo esc_html__('Latest products', 'example-theme'); ?></h2>

		<?php
		$latest_products = new WP_Query(
			array(
				'post_type'      => 'post',
				'category_name'  => 'products',
				'posts_per_page' => 2,
			)
		);

		generate_article($latest_products);
		?>
	</section>
</main>

<?php get_footer(); ?>