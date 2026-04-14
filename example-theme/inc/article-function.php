<?php

/**
 * Generates and prints product/service articles from a WP_Query result.
 */
function generate_article($products)
{
	if (! ($products instanceof WP_Query)) {
		return;
	}

	if (! $products->have_posts()) {
		echo '<p class="text-muted mb-0">' . esc_html__('No featured products found.', 'example-theme') . '</p>';
		return;
	}

	while ($products->have_posts()) {
		$products->the_post();

		$title   = get_the_title();
		$url     = get_permalink();
		$excerpt = get_the_excerpt();

		if (! $excerpt) {
			$excerpt = wp_strip_all_tags(get_the_content());
		}

		$excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
		$short   = mb_substr($excerpt, 0, 50);
		if (mb_strlen($excerpt) > 50) {
			$short = rtrim($short) . '...';
		}

		echo '<article class="product bg-white rounded-3 shadow-sm">';

		if (has_post_thumbnail()) {
			echo '<div class="mb-2">';
			the_post_thumbnail('medium_large', array('class' => 'img-fluid rounded'));
			echo '</div>';
		}

		echo '<h3 class="h5">' . esc_html($title) . '</h3>';
		echo '<p>' . esc_html($short) . '</p>';
		echo '<a class="btn btn-outline-dark" href="' . esc_url($url) . '">' . esc_html__('Learn more', 'example-theme') . '</a>';
		echo '</article>';
	}

	wp_reset_postdata();
}
