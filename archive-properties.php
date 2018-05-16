<?php get_header(); ?>

<header>
	<section class="page-header" style=" background: url(<?php echo get_site_url(); ?>/wp-content/uploads/2018/05/cruise-ship-334846_1280-1.jpg) no-repeat center center scroll; 
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="header-title">
						Luxury Properties in Barbados
					</h1>					
				</div>
			</div>				
		</div>
	</section>
</header>
<?php echo knoppys_property_search(); ?>	

<section class="content">
	<div class="container">		
			<div class="row">
				<?php $i = 1; foreach ($wp_query->posts as $property) { ?>				
					<div class="col-md-4">
			            <div class="property-grid-content <?php if(get_post_meta($offer->ID, 'on_special_offer',true) == '1'){echo 'specialoffer';} ?>">				
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
				            		<?php if(get_post_meta($property->ID, 'on_special_offer',true) == '1')){ ?>
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

<?php get_footer();