<?php
//Add some handy dashboard widgets.

// Function used in the action hook
function add_dashboard_widgets() {
  wp_add_dashboard_widget('latest-properties', 'Latest Properties', 'latest_properties_function');
  wp_add_dashboard_widget('latest-offers', 'Latest Offers', 'latest_offers_function');
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );

// Function that outputs the contents of the dashboard widget
function latest_properties_function( $post, $callback_args ) {
  $properties = array(
  	'post_type' => 'properties',
  	'posts_per_page' => 10
  );
  $posts = get_posts($properties);
  echo '<table class="dashwidget">';
  echo '<thead><th>Edit</th><th>Name</th><th>Detail</th><th>Added By</th></thead>';
  foreach ($posts as $post) {   
  	?>  	
  		<tr>
  			<td>
  				<a class="edit-property" target="_blank" href="<?php echo admin_url(); ?>/post.php?post=<?php echo $post->ID; ?>&action=edit" title="Edit"><span class="dashicons dashicons-welcome-write-blog"></span></a>
  			</td>
  			<td>
  				<a href="<?php echo $post->guid;?>" target="_blank"><?php echo $post->post_title; ?></a>
  			</td>
  			<td>
  				<?php echo get_post_meta($post->ID,'number_of_beds',true); ?> Bed Property in <?php echo property_locations($post->ID); ?>
  			</td>
  			<td>
  				<?php echo get_the_author_meta('first_name',$post->post_author); ?>
  			</td>
  		</tr>  
  <?php }
  echo '</table>';
}

function latest_offers_function( $post, $callback_args ) {
  $properties = array(
  	'post_type' => 'properties',
  	'posts_per_page' => 10,
  	'meta_key' => 'on_special_offer',
  	'meta_value' => '1'
  );
  $posts = get_posts($properties);
  echo '<table class="dashwidget">';
  echo '<thead><th>Edit</th><th>Name</th><th>Detail</th><th>Added By</th></thead>';
  foreach ($posts as $post) {   
  	?>  	
  		<tr>
  			<td>
  				<a class="edit-property" target="_blank" href="<?php echo admin_url(); ?>/post.php?post=<?php echo $post->ID; ?>&action=edit" title="Edit"><span class="dashicons dashicons-welcome-write-blog"></span></a>
  			</td>
  			<td>
  				<a href="<?php echo $post->guid;?>" target="_blank"><?php echo $post->post_title; ?></a>
  			</td>
  			<td>
  				<?php echo get_post_meta($post->ID,'number_of_beds',true); ?> Bed Property in <?php echo property_locations($post->ID); ?>
  			</td>
  			<td>
  				<?php echo get_the_author_meta('first_name',$post->post_author); ?>
  			</td>
  		</tr>  
  <?php }
  echo '</table>';
}