<?php
//get the header
get_header(); 
$id = get_the_id();
$meta = get_post_meta($id);
$header_image = knoppys_property_header($id,$meta['image_1'][0]);

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="page-header" style="background: url(<?php echo $header_image; ?>) no-repeat center center scroll; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
  	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="header-title post-title">
					<?php the_title(); ?>					
				</h1>
				<h2 class="header-slogan">
					Luxury <?php echo $meta['type_name'][0]; ?> in <?php echo knoppys_location_name($post->ID); ?>					
				</h2>	
			</div>
		</div>		
	</div>	
</section>
<?php echo knoppys_property_search(); ?>	
<section class="content single-properties">
	<div class="container">
		<div class="row">
			<article>
				<div class="col-md-8">				
					<?php echo knoppys_property_slider($id); ?>							
					<?php the_content(); ?>							
				</div>
			</article>	
			<aside>
				<div class="col-md-4">
					<?php if (isset($meta['on_special_offer'][0])) { ?>
						<div class="widget specialoffer">
							<h3 class="widget-title">Special Offer</h3>
							<p class="prices-from"><?php echo $meta['special_offer_price'][0]; ?></p>
							<?php echo $meta['special_offer_descrption'][0]; ?>							
						</div>
					<?php } ?>
					<div class="widget features">
						<h3 class="widget-title">At a Glance</h3>						
						<?php echo knoppys_pricing($id); ?>				
						<ul class="main_features">
							<!-- Number of Bathrooms -->	
							<li><?php echo knoppys_accomodates($id); ?></li>
							<!-- Sleeps -->
							<?php if($meta['sleeps'][0]){ ?>
								<li>Sleeps: <?php echo $meta['sleeps'][0]; ?> </li>
							<?php } ?>											
							<li>Bathrooms: <?php echo $meta['number_of_baths'][0]; ?></li>

							<!-- Air Con -->
							<?php if($meta['air_con_full'][0] == 1 && $meta['air_con_partial'][0] == 0){ ?>
								<li>Full Air Con</li>
							<?php } elseif($meta['air_con_full'][0] == 0 && $meta['air_con_partial'][0] == 1){?>
								<li>Partial Air Con</li>
							<?php } ?>
							<!-- Beach Access -->
							<?php if($meta['beach_access'][0] == 1){ ?>
								<li>Beach Access</li>
							<?php } ?>
							<!-- Guardian -->
							<?php if($meta['guardian'][0] == 1){ ?>
								<li>Guardian</li>
							<?php } ?>
							<!-- Gym -->
							<?php if($meta['gym'][0] == 1){ ?>
								<li>Gym</li>
							<?php } ?>
							<!-- Heated Pool -->
							<?php if($meta['gym'][0] == 1){ ?>
								<li>Heated Pool</li>
							<?php } ?>
							<!-- Heli Pad -->
							<?php if($meta['helipad'][0] == 1){ ?>
								<li>Heli Pad</li>
							<?php } ?>
							<!-- Indoor Pool -->
							<?php if($meta['indoor_pool'][0] == 1){ ?>
								<li>Indoor Pool</li>
							<?php } ?>
							<!-- Sea View -->
							<?php if($meta['sea_view'][0] == 1){ ?>
								<li>Sea View</li>
							<?php } ?>
							<!-- Panoramic Sea View -->
							<?php if($meta['panoramic_sea_view'][0] == 1){ ?>
								<li>Panoramic Sea View</li>
							<?php } ?>
							<!-- Parking -->
							<?php if($meta['parking'][0] == 1){ ?>
								<li>Parking</li>
							<?php } ?>
							<!-- Sky TV -->
							<?php if($meta['sky_tv'][0] == 1){ ?>
								<li>Sky TV</li>
							<?php } ?>
							<!-- Spa -->
							<?php if($meta['spa'][0] == 1){ ?>
								<li>Spa</li>
							<?php } ?>
							<!-- Tennis -->
							<?php if($meta['tennis'][0] == 1){ ?>
								<li>Tennis</li>
							<?php } ?>							
							<!-- Walk to Beach -->
							<?php if($meta['walk_to_beach'][0] == 1){ ?>
								<li>Walk to Beach</li>
							<?php } ?>
							<!-- Walk to Shop -->
							<?php if($meta['walk_to_shop'][0] == 1){ ?>
								<li>Walk to Shop</li>
							<?php } ?>
							<!-- WiFi -->
							<?php if($meta['wifi'][0] == 1){ ?>
								<li>WiFi</li>
							<?php } ?>						
						</ul>
						<form action="<?php echo get_site_url(); ?>/wp-admin/admin-post.php" method="POST">
							<input type="hidden" name="ID" value="<?php echo $id; ?>">
							<input type="hidden" name="action" value="knoppys_brochure_download">
							<input type="submit" name="submit" class="btn btn-primary" value="Download the brochure">
						</form>						
					</div>
					<div class="widget">
						<div class="quote-form">
							<h3 class="widget-title">Request a Quote</h3>
							<?php echo do_shortcode('[contact-form-7 id="1697" title="Request A Quote"]'); ?>
						</div>
					</div>					
				</div>
			</aside>		
		</div>
	</div>
</section>

<section class="content related">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="widget">
					<h3 class="widget-title">Related Properties</h3>
					<center style="padding-bottom:20px;"><h4>More luxury properteis in <?php echo knoppys_location_name($id); ?></h4></center>
					<center>
						<?php echo knoppys_similar_properties($id); ?>
					</center>
				</div>			
			</div>
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
