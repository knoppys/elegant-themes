<?php
//get the header
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
<section class="content">
	<div class="container">
		<div class="row">
			<article>
				<div class="col-md-9">
					<?php echo get_template_part('templateparts/content'); ?>
				</div>
			</article>
			<aside>
				<div class="col-md-3">
					<?php dynamic_sidebar('sidebar-blog'); ?>
				</div>
			</aside>
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
