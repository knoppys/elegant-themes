<?php get_header(); ?>
<?php 
//Variables for page header and term object.
$term = get_queried_object(); 
?>
<header>
	<section class="page-header" style=" background: url(<?php echo wp_get_attachment_url( get_term_thumbnail_id( $term->term_id ) ); ?>) no-repeat center center scroll; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="header-title">
						<?php single_term_title(); ?> 					
					</h1>
					<?php if (get_field('slogan',$term)) { echo '<h2 class="header-slogan">'; echo get_field('slogan',$term); echo '</h2>'; 
					} ?>	
				</div>
			</div>				
		</div>
	</section>
	<?php echo knoppys_property_search(); ?>	
</header>
<?php 
/* Get the correct archive layout */
if ($term->taxonomy == 'locations') {	
	get_template_part('templateparts/tax-locations'); 
} else { 
	get_template_part('templateparts/archive-posts'); 
} 
get_footer();