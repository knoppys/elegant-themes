<?php get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-8" id="<?php echo get_the_ID(); ?>">
				<main>
					<?php 
						if ( have_posts() ) :
						while ( have_posts() ) : the_post(); ?>

						<div class="blog-item">
							<div class="row">
													
								<div class="col-3 post-thumbnail">
									<?php if( has_post_thumbnail() ){
										the_post_thumbnail('medium');
									} else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/no-image.png" alt="no-image" />
									<?php }; ?>						
								</div>
								<div class="col-9">
									<p><strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong></p>
									<p><?php the_excerpt(); ?></p>
									<strong>Posted on : <?php echo get_the_date(); ?></strong>								    
								</div>
								
								
							</div>
							<a href="<?php the_permalink(); ?>" class="btn btn-primary">More</a>
						</div>

					<?php endwhile; else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>						 
					<?php endif; ?>
					<?php posts_nav_link(); ?> 
				</main>
			</div>			
		</div>
	</div>

<?php get_footer();