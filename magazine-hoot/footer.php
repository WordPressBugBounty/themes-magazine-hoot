<?php
		// Template modification Hook
		do_action( 'maghoot_template_main_wrapper_end' );
		?>
		</div><!-- #main -->

		<?php get_template_part( 'template-parts/footer', 'subfooter' ); // Loads the template-parts/footer-subfooter.php template. ?>

		<?php get_template_part( 'template-parts/footer', 'footer' ); // Loads the template-parts/footer-footer.php template. ?>

		<?php get_template_part( 'template-parts/footer', 'postfooter' ); // Loads the template-parts/footer-postfooter.php template. ?>

	</div><!-- #page-wrapper -->

	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>