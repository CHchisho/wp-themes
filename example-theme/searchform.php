<?php
/**
 * Theme search form template.
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html__('Search for:', 'example-theme'); ?></span>
		<input
			type="search"
			class="search-field"
			placeholder="<?php echo esc_attr__('Search …', 'example-theme'); ?>"
			value="<?php echo esc_attr(get_search_query()); ?>"
			name="s"
		>
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr__('Search', 'example-theme'); ?>">
</form>

