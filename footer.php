</main>
<section class="footercontact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
				<h3 class="widget-title">Contact Us</h3>
					<?php echo do_shortcode('[contact-form-7 id="450" title="Contact form 1"]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container footerlogo">
	<div class="row">		
		<div class="col-md-12">
			<img src="<?php echo get_template_directory_uri(); ?>/images/updated-footer-logos.png">
		</div>
	</div>
</div>
<footer>
	<div class="container">
		<div class="row">	
			<?php dynamic_sidebar('sidebar-footer'); ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>