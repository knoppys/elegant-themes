<?php
/**********************
Register property post type
**********************/
function properties_post_type() {

	$labels = array(
		'name'                  => _x( 'Properties', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Property', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Properties', 'text_domain' ),
		'name_admin_bar'        => __( 'Property', 'text_domain' ),
		'archives'              => __( 'Property Archives', 'text_domain' ),
		'attributes'            => __( 'Property Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Property:', 'text_domain' ),
		'all_items'             => __( 'All Properties', 'text_domain' ),
		'add_new_item'          => __( 'Add New Property', 'text_domain' ),
		'add_new'               => __( 'Add Property', 'text_domain' ),
		'new_item'              => __( 'New Property', 'text_domain' ),
		'edit_item'             => __( 'Edit Property', 'text_domain' ),
		'update_item'           => __( 'Update Property', 'text_domain' ),
		'view_item'             => __( 'View Property', 'text_domain' ),
		'view_items'            => __( 'View Properties', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Property Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Property image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Property image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Property image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Property', 'text_domain' ),
		'items_list'            => __( 'Properties list', 'text_domain' ),
		'items_list_navigation' => __( 'Properties list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Properties list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Property', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'location' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'properties', $args );

}
add_action( 'init', 'properties_post_type', 0 );

/**********************
Register locations taxonomy
**********************/
function locations_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Locations', 'text_domain' ),
		'all_items'                  => __( 'All Locations', 'text_domain' ),
		'parent_item'                => __( 'Parent Location', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Location Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Location', 'text_domain' ),
		'edit_item'                  => __( 'Edit Location', 'text_domain' ),
		'update_item'                => __( 'Update Location', 'text_domain' ),
		'view_item'                  => __( 'View Location', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Locations with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Locations', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Locations', 'text_domain' ),
		'search_items'               => __( 'Search Locations', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Locations', 'text_domain' ),
		'items_list'                 => __( 'Locations list', 'text_domain' ),
		'items_list_navigation'      => __( 'Locations list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'locations', array( 'properties' ), $args );

}
add_action( 'init', 'locations_taxonomy', 0 );

/**********************
Register propertyAgent taxonomy
**********************/
function propertyagent_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Agents', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Agent', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Agents', 'text_domain' ),
		'all_items'                  => __( 'All Agents', 'text_domain' ),
		'parent_item'                => __( 'Parent Agent', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Agent Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Agent', 'text_domain' ),
		'edit_item'                  => __( 'Edit Agent', 'text_domain' ),
		'update_item'                => __( 'Update Agent', 'text_domain' ),
		'view_item'                  => __( 'View Agent', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Agents with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Agents', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Agents', 'text_domain' ),
		'search_items'               => __( 'Search Agents', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Agents', 'text_domain' ),
		'items_list'                 => __( 'Agents list', 'text_domain' ),
		'items_list_navigation'      => __( 'Agents list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'propertyagent', array( 'properties' ), $args );

}
add_action( 'init', 'propertyagent_taxonomy', 0 );

/**********************
Register propertyService Type taxonomy
**********************/
function servicetype_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Service Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Service Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Service Types', 'text_domain' ),
		'all_items'                  => __( 'All Service Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Service Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Service Type Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Service Type', 'text_domain' ),
		'edit_item'                  => __( 'Edit Service Type', 'text_domain' ),
		'update_item'                => __( 'Update Service Type', 'text_domain' ),
		'view_item'                  => __( 'View Service Type', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Service Types with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Service Types', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Service Types', 'text_domain' ),
		'search_items'               => __( 'Search Service Types', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Service Types', 'text_domain' ),
		'items_list'                 => __( 'Service Types list', 'text_domain' ),
		'items_list_navigation'      => __( 'Service Types list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'servicetype', array( 'properties' ), $args );

}
add_action( 'init', 'servicetype_taxonomy', 0 );
