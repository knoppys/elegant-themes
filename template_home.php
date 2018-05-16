<?php
/*
Template Name: Home Page
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
				<?php if (get_field('header_slogan_text')) { echo '<h2 class="header-slogan">'; echo the_field('header_slogan_text'); echo '</h2>'; } ?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<nav class="home-slider-nav">
					<?php $buttonarray = get_field('slider_buttons');
						foreach ($buttonarray as $button) { echo '<a class="btn btn-primary"href="'.$button['button_link'].'">'.$button['button_text'].'</a>'; }
					?>
				</nav>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php the_content(); ?>
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