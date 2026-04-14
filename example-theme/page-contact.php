<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>

<main class="w-100">
	<section class="mb-4">
		<div class="p-4 bg-white rounded-3 shadow-sm">
			<h1 class="h3 mb-2"><?php echo esc_html__( 'Contact', 'example-theme' ); ?></h1>
			<p class="mb-0 text-muted"><?php echo esc_html__( 'This form is submitted via AJAX and stored in a separate database table.', 'example-theme' ); ?></p>
		</div>
	</section>

	<section class="bg-white rounded-3 shadow-sm p-4">
		<div class="row g-4">
			<div class="col-12 col-lg-5">
				<h2 class="h5 mb-3"><?php echo esc_html__( 'Contact details', 'example-theme' ); ?></h2>
				<ul class="list-unstyled mb-0">
					<li><strong>Email:</strong> info@example.local</li>
					<li><strong>Phone:</strong> +358 40 123 4567</li>
					<li><strong>Address:</strong> Helsinki, Finland</li>
				</ul>
			</div>
			<div class="col-12 col-lg-7">
				<h2 class="h5 mb-3"><?php echo esc_html__( 'Send us a message', 'example-theme' ); ?></h2>

				<form data-contact-form>
					<div class="mb-3">
						<label class="form-label" for="c-name"><?php echo esc_html__( 'Name', 'example-theme' ); ?></label>
						<input class="form-control" id="c-name" name="name" required>
					</div>
					<div class="mb-3">
						<label class="form-label" for="c-email"><?php echo esc_html__( 'Email', 'example-theme' ); ?></label>
						<input class="form-control" id="c-email" type="email" name="email" required>
					</div>
					<div class="mb-3">
						<label class="form-label" for="c-message"><?php echo esc_html__( 'Message', 'example-theme' ); ?></label>
						<textarea class="form-control" id="c-message" rows="5" name="message" required></textarea>
					</div>
					<button class="btn btn-dark" type="submit"><?php echo esc_html__( 'Send', 'example-theme' ); ?></button>
					<div data-contact-status></div>
				</form>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>

