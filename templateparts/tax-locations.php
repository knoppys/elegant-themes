<?php $term = get_queried_object(); ?>
<section>
	<div class="container">		
			<div class="row">
				<?php $i = 1; foreach ($wp_query->posts as $property) { ?>				
					<div class="col-md-4">
			            <div class="property-grid-content <?php if(get_post_meta($property->ID, 'special_offer_price',true)){echo 'specialoffer';} ?>">				
				            <a href="<?php echo get_permalink($property->ID); ?>">
				            	<span class="goldtext"><h2><?php echo $property->post_title; ?></h2></span>
				            	<ul class="main_features">
				            		<!-- Number of Bathrooms -->	
									<li><i class="fa fa-arrow-circle-right"></i> <?php echo knoppys_accomodates($id); ?></li>
									<!-- Sleeps -->
									<?php if(get_post_meta($property->ID,'sleeps',true)){ ?>
										<li><i class="fa fa-arrow-circle-right"></i> Sleeps: <?php echo get_post_meta($property->ID,'sleeps',true); ?> </li>
									<?php } ?>											
									<li><i class="fa fa-arrow-circle-right"></i> Bathrooms: <?php echo get_post_meta($property->ID,'number_of_baths',true); ?></li>
				            		<img src="<?php echo knoppys_property_header($property->ID,get_post_meta($property->ID,'image_1',true)); ?>">
				            		<?php if(get_post_meta($property->ID, 'special_offer_price',true)){ ?>
				            			<p class="offertext">On Special Offer</p>
				            		<?php } ?>
				            	</ul>														
							</a>
						</div>
					</div>
					<?php if($i % 3==0){echo '</div><div class="row">';} ?>
				<?php $i++;} ?>
			</div>
		<?php echo knoppys_pagination(); ?>	
	</div>
</section>
<section class="content archive-header">
	<article>
		<div class="container">
			<div class="row">
				<div class="col-md-12">					
					<h3 class="widget-title"><?php single_term_title(); ?></h3>
					<?php echo get_field('term_long_description', $term); ?>
				</div>					
			</div>
		</div>
	</article>
</section>
<section class="content other-locations">
	<aside>
		<div class="container">			
			<div class="row">
				<h3 class="widget-title">Other Locations</h3>
				<?php echo do_shortcode('[locations_grid]'); ?>
			</div>
		</div>
	</aside>
</section>