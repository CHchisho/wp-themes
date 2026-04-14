<?php

function example_theme_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-header');

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'main-menu'   => __('Main Menu', 'example-theme'),
			'footer-menu' => __('Footer Menu', 'example-theme'),
		)
	);

	set_post_thumbnail_size(800, 450, true);
	add_image_size('custom-header', 1400, 520, true);
}
add_action('after_setup_theme', 'example_theme_setup');

function example_theme_register_post_types()
{
	register_post_type(
		'service',
		array(
			'labels'       => array(
				'name'          => __('Services', 'example-theme'),
				'singular_name' => __('Service', 'example-theme'),
				'add_new_item'  => __('Add New Service', 'example-theme'),
				'edit_item'     => __('Edit Service', 'example-theme'),
			),
			'public'       => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-hammer',
			'show_in_rest' => true,
			'rewrite'      => array('slug' => 'services'),
			'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
		)
	);
}
add_action('init', 'example_theme_register_post_types');

function example_theme_enqueue_assets()
{
	wp_enqueue_style('example-theme-style', get_stylesheet_uri(), array(), '1.1');

	//  Bootstrap CSS/JS in theme.
	wp_enqueue_style(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
		array(),
		'5.3.3'
	);
	wp_enqueue_script(
		'bootstrap',
		'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
		array(),
		'5.3.3',
		true
	);

	wp_enqueue_script(
		'example-theme',
		get_template_directory_uri() . '/theme.js',
		array(),
		'1.1',
		true
	);

	wp_localize_script(
		'example-theme',
		'ExampleTheme',
		array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('example_theme_nonce'),
		)
	);
}
add_action('wp_enqueue_scripts', 'example_theme_enqueue_assets');

function example_theme_contact_table_name()
{
	global $wpdb;
	return $wpdb->prefix . 'contact_submissions';
}

function example_theme_create_contact_table()
{
	global $wpdb;
	$table_name      = example_theme_contact_table_name();
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		name varchar(191) NOT NULL,
		email varchar(191) NOT NULL,
		message text NOT NULL,
		ip varchar(64) DEFAULT '' NOT NULL,
		created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY  (id),
		KEY email (email),
		KEY created_at (created_at)
	) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($sql);
}

add_action('after_switch_theme', 'example_theme_create_contact_table');

function example_theme_ajax_submit_contact()
{
	check_ajax_referer('example_theme_nonce', 'nonce');

	$name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
	$email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

	if ($name === '' || $email === '' || ! is_email($email) || $message === '') {
		wp_send_json_error(
			array('message' => __('Please fill in all fields correctly.', 'example-theme')),
			400
		);
	}

	global $wpdb;
	$table = example_theme_contact_table_name();

	$ok = $wpdb->insert(
		$table,
		array(
			'name'       => $name,
			'email'      => $email,
			'message'    => $message,
			'ip'         => isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '',
			'created_at' => current_time('mysql'),
		),
		array('%s', '%s', '%s', '%s', '%s')
	);

	if (! $ok) {
		wp_send_json_error(
			array('message' => __('Server error. Please try again later.', 'example-theme')),
			500
		);
	}

	wp_send_json_success(
		array('message' => __('Thanks! We received your message.', 'example-theme'))
	);
}

add_action('wp_ajax_example_theme_submit_contact', 'example_theme_ajax_submit_contact');
add_action('wp_ajax_nopriv_example_theme_submit_contact', 'example_theme_ajax_submit_contact');
