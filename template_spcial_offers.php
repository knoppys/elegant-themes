<?php
/*
Template Name: Special Offers
*/
get_header(); 
//start the page loop
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="page-header" style=" background: url(<?php echo the_field('header_background_image'); ?>) no-repeat center center scroll; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="header-title">
					<?php if (get_field('header_title_text')) { echo the_field('header_title_text'); } else { echo the_title(); } ?>				
				</h1>
				<?php if (get_field('header_slogan_text')) { echo '<h2 class="header-slogan">'; echo the_field('header_slogan_text'); echo '</h2>'; 
				} ?>	
			</div>
		</div>		
	</div>	
</section>
<?php echo knoppys_property_search(); ?>
<section class="content">
	<div class="container">		
		<div class="row">
			<?php $args = array(
				'post_type' => 'properties',
				'meta_key' => 'on_special_offer',
				'meta_value' => '1'	
			);
			$offers = get_posts($args); ?>
			<?php $i = 1; foreach ($offers as $offer) { ?>				
				<div class="col-md-4">
					<div class="property-grid-content <?php if(get_post_meta($offer->ID, 'on_special_offer',true) == '1'){echo 'specialoffer';} ?>">				
					    <a href="<?php echo get_permalink($offer->ID); ?>">
					    	<span class="goldtext"><h2><?php echo $offer->post_title; ?></h2></span>
					    	<ul class="main_features">
					    		<!-- Number of Bathrooms -->	
								<li><i class="fa fa-arrow-circle-right"></i> <?php echo knoppys_accomodates($id); ?></li>
								<!-- Sleeps -->
								<?php if(get_post_meta($offer->ID,'sleeps',true)){ ?>
									<li><i class="fa fa-arrow-circle-right"></i> Sleeps: <?php echo get_post_meta($offer->ID,'sleeps',true); ?> </li>
								<?php } ?>											
								<li><i class="fa fa-arrow-circle-right"></i> Bathrooms: <?php echo get_post_meta($offer->ID,'number_of_baths',true); ?></li>
					    		<img src="<?php echo knoppys_property_header($offer->ID,get_post_meta($offer->ID,'image_1',true)); ?>">					    		
					    	</ul>														
						</a>
					</div>
				</div>
				<?php if($i % 3==0){echo '</div><div class="row">';} ?>
			<?php $i++;} ?>
		</div>
	</div>
</section>

<?php endwhile; else : 
//if there isnt any content, show this.	
echo '<p> Sorry, no posts matched your criteria. </p>';
//end the loop
endif;
//get the footer
get_footer();