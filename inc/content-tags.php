<?php
/******************
This is the locations grid shortcode
**************************************/
function locations_shortcode(){	
	$terms = get_terms(array('taxonomy'=>'locations','hide_empty' => false,));	
	ob_start(); ?>	
	<div class="locations-grid">
		<div class="row">
			<?php $i = 1; foreach ($terms as $term) { ?>				
				<div class="col-md-4 locations-grid-content whitetext">
		            <div class="overlay" style=" 
				background: url(<?php echo wp_get_attachment_url( get_term_thumbnail_id( $term->term_id ) ); ?>) no-repeat center center scroll; 
	            -webkit-background-size: cover;
	            -moz-background-size: cover;
	            -o-background-size: cover;
	            background-size: cover;">
			            <a href="<?php echo get_term_link($term->term_id); ?>">
							<h2><?php echo $term->name; ?></h2>
							<p><?php echo substr(get_field('slogan',$term),0,200); ?>[...]</p>
						</a>
					</div>
				</div>
				<?php if($i % 3==0){echo '</div><div class="row">';} ?>
			<?php $i++;} ?>
		</div>
	</div>
	<?php $content = ob_get_clean();
	return $content;
}
add_shortcode('locations_grid','locations_shortcode');


/******************
This idecides which images to use for the property thubnail
***********************************************************/
function property_thumbnail($ID,$size){

	if (get_the_post_thumbnail_url($ID)) {
		$url = get_the_post_thumbnail_url($ID);
	} elseif (!get_the_post_thumbnail_url($ID) && get_field('image_1',$ID)) {
		$url = get_field('image_1',$ID);
	} elseif (!get_the_post_thumbnail_url($ID) && !get_field('image_1',$ID)){
		$url = get_template_directory_uri().'/images/no-image'.$size.'.png';
	}
	return $url;
}

/****************************
Get the right property header image
This is for legacy properties as the old images were stored
as fixed URLs where as now they are stored as ID's
***************************************************************/
function knoppys_property_header($ID, $image){

	if (has_post_thumbnail($ID)) {
		$url = get_the_post_thumbnail_url($ID);
	} else {
		$url = get_template_directory_uri().'/images/property-images/'.str_replace(' ', '%20', $image);
	}
	return $url;
}

/*******************
Get the right details for pricing
*************************************/
function knoppys_pricing($id){

  $saleorrent = get_term('servicetype',$id);
  $price = strip_tags(get_field('price',$id));  

  if ($saleorrent == 'Rent' || $saleorrent == 'Rental') {
    echo '<div class="prices-from">Prices start from: &euro;'.$price.' a Week</div>';
  } else {
    echo '<div class="prices-from">Prices start from: &euro;'.$price.'</div>';
  }

} 

/*******************
Get the right details for sleeps display
*************************************/
function knoppys_accomodates($id){

  $saleorrent = get_term('servicetype',$id);
  $bed = get_field('number_of_beds',$id);
  $sleeps = get_field('sleeps',$id);  

    if ($saleorrent == 'Rent' || $saleorrent == 'Rental') {      
     
      if($bed > 1) {
        echo 'Bedrooms: '.$bed.' '. knoppys_sleeps($id);
      } else {
        echo $bed.' Bedroom '. knoppys_sleeps($id);
      }

    } else {

      if($bed > 1) {
        echo 'Bedrooms: '.$bed;
      } else {
        echo $bed.' Bedroom';
      }

    }

  }
function knoppys_sleeps($id){

  $saleorrent = get_term('servicetype',$id);
  $sleeps = get_field('sleeps',$id);

  if ($saleorrent == 'Rent' || $saleorrent == 'Rental') {
    echo '(Sleeps '.$sleeps.')';
  } else {
    echo '';
  }

}

/*********************
Pagination for archive pages
*******************************/
function knoppys_pagination(){
	ob_start(); ?>
		<nav role="navigation" aria-label="Pagination">
			<div class="knoppys_pagination">
			  <div class="row">
			  	<div class="col-xs-6 linkleft">
				    <?php previous_posts_link(); ?>
				  </div>
				<div class="col-xs-6 linkright">
					<?php next_posts_link(); ?>
				</div>
			  </div>
			</div>
		</nav>
	<?php $content = ob_get_clean();
	return $content;
}


/**********************
This gets the location name for the property header
****************************************************/
function knoppys_location_name($ID){

	$terms = get_the_terms($ID,'locations');
	ob_start();
	foreach ($terms as $term) {		
		echo $term->name;
	}
	$content = ob_get_clean();
	return $content;

}

/*****************************
Create an array of images from both the old legacy urls and
the new ACF repeater field for use within the new image slider
***************************************************************/
function knoppys_property_slider($ID) {

	$images = array(
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_1',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_2',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_3',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_4',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_5',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_6',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_7',true),
		get_template_directory_uri().'/images/property-images/'.get_post_meta($ID,'image_8',true)
	);			
		
	if (get_field('property_image_gallery',$ID)) {
        $rows = get_field('property_image_gallery',$ID);
      foreach ($rows as $row) {
          array_push($images,$row['property_image']);
      }
    }

	ob_start();
	?>

	<div class="slider">
		<?php foreach ($images as $image){ ?>
			<img src="<?php echo $image; ?>">
		<?php } ?>
	</div>

	<div class="slider-for">
		<?php foreach ($images as $image){ ?>
			<img src="<?php echo $image; ?>">
		<?php } ?>
	</div>

<?php 
$content = ob_get_clean();
return $content;
}



/*********
Return an array of Similar property ID's
*****************************************/
function knoppys_similar_properties($id){

	$terms = wp_get_post_terms($id,'locations');
	$numberofbeds = get_post_meta($id,'number_of_beds',true);
	$termsarray = array();
	foreach ($terms as $term) {
		array_push($termsarray, $term->term_id);
	}

	$args = array(
		'post_type' => 'properties',
		'tax_query' => array(
			array(
				'taxonomy' => 'locations',
				'field' => 'term_id',
				'terms' => $termsarray
			)
		),
		'meta_key' => 'number_of_beds',
		'meta_value' => $numberofbeds,
		'posts_per_page' => 4
	);
	$properties = get_posts($args);	
	if (count($properties) == 1) {
		$columns = 'col-md-12';
	} elseif (count($properties) == 2) {
		$columns = 'col-md-3';	
	}elseif (count($properties) == 3) {
		$columns = 'col-md-4';
	}elseif (count($properties == 4)) {
		$columns = 'col-md-3';
	}

	$ob_start;
	foreach ($properties as $property) { 
		$header_image = knoppys_property_header($property->ID,get_post_meta($property->ID,'image_1',true)); ?>
		<div class="related-property <?php echo $columns; ?>">
			<a class="" href="<?php echo get_permalink($property->ID); ?>">
				<img src="<?php echo $header_image; ?>">			
				<h4><?php echo get_the_title($property->ID); ?></h4>
				<ul class="main_features">				
					<li><i class="fa fa-arrow-circle-right"></i> <?php echo knoppys_accomodates($property->ID); ?></li>				
					<?php if(get_post_meta($property->ID,'sleeps',true)){ ?>
						<li><i class="fa fa-arrow-circle-right"></i> Sleeps: <?php echo get_post_meta($property->ID,'sleeps',true); ?> </li>
					<?php } ?>											
					<li><i class="fa fa-arrow-circle-right"></i> Bathrooms: <?php echo get_post_meta($property->ID,'number_of_baths',true); ?></li>
					
				</ul>				
			</a>
		</div>

	<?php }
	$content = ob_get_clean();
	return $content;
}


/***********************
Search form to search all properties
****************************************/
function knoppys_property_search(){ ?>

<section class="property-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="widget-title">Property Search</h3>
				<?php echo knoppys_search_form(); ?>				
			</div>
		</div>
	</div>
</section>
<center>				
	<div id="search-open" class="search-header btn btn-primary"><i class="fa fa-search"></i>  Property Search</div>
</center>

<?php }

/*****************************************
Search properteis form
******************************************/
function knoppys_search_form() { ?>

	<form id="propertySearch" name="propertySearch" action="<?php echo get_post_type_archive_link('properties'); ?>" method="post" enctype="multipart/form-data" >
    	<div class="form-group">
    		<label>Select Accomodation Type</label>
			<select class="form-control" name="type"> 
				<option></option>        
				<option value="Apartment">Apartment</option>
				<option value="Villa">Villa</option>
				<option value="Hotel">Hotel</option>
			</select>
    	</div>
		<div class="form-group">
			<label>Select Location</label>
			<select class="form-control" name="location">
				<?php $termsArgs = array( 'taxonomy' => 'locations' ); 
				$terms = get_terms($termsArgs);
				?>        
				<option></option>  
				<?php foreach ($terms as $term) { ?>
					<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
				<?php } ?>
			</select>
		</div>
	    <div class="form-group">
	    	<label>Min Beds</label>
	      	<input class="form-control" type="number" name="bedfrom" placeholder="Bed From">
	    </div>
	    <div class="form-group">
	    	<label>Max Beds</label>
	      	<input class="form-control" type="number" name="bedto" placeholder="Bed To">
	    </div>	   
    	<input type="hidden" name="issearch" value="1">
    	<center><button class="btn btn-primary search-header" type="submit"><i class="fa fa-search"></i> Refine Search</button></center>
  </form>

<?php }
