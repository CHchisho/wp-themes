        <footer class="w-100 mt-5">
            <div class="py-4">
				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<nav class="mb-3">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'container'      => false,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				<?php endif; ?>
                <p class="mb-0">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
            </div>
        </footer>
    </div>
    <?php wp_footer(); ?>
</body>
</html>