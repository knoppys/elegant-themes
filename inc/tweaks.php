<?php
/***************************
* Some WP performance tweaks
****************************/
/***************************
* Deque Jquery Migrate
****************************/
function dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );

/***************************
* Remove some pesky code from the header that we dotn need. 
****************************/
function removeHeadLinks() {
  remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
  remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
  remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
  remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
  remove_action( 'wp_head', 'index_rel_link' ); // index link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
  remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
  remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');
add_filter('show_admin_bar', '__return_false');

/***************************
* Disable XMLRPC
****************************/
add_filter('xmlrpc_enabled', '__return_false');

/***************************
* Remove Wp Version Number
****************************/
function wpb_remove_version() {
  return '';
}
add_filter('the_generator', 'wpb_remove_version');

/***************************
* Credit in the admin footer
****************************/
function remove_footer_admin () {
  echo 'Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Theme By: <a href="http://www.knoppys.co.uk" target="_blank">Knoppys Digital</a></p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/***************************
* Custom login error message
****************************/
function no_wordpress_errors(){
  return 'Something is wrong! But we wont tell you what, the force is stronger with us.';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

/***************************
* Remove the welcome to WordPress stuff from teh dashboard, like we dont already know we're here.
****************************/
remove_action('welcome_panel', 'wp_welcome_panel');

/***************************
* Custom Excerpt Length
****************************/
function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*************************
Remove those peski emojis
*************************/
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
add_filter( 'emoji_svg_url', '__return_false' );

/***************************
* Add a logo to the wp customiser
****************************/
function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

/*************************************
Add the company logo to the WP Login
*************************************/
add_action( 'login_head', 'ilc_custom_login');
function ilc_custom_login() {
  $custom_logo_id = get_theme_mod( 'custom-logo' );
  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  echo '<style type="text/css">
  h1 a { background-image:url('.$logo[0].') !important; margin-bottom: 10px; }
  padding: 20px;}
  </style>
  <script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. home_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
}

/***************************
* Ditch the comments style added to the head
****************************/
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');

/***************************
* Ditch the wp-embed script
****************************/
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

/***********
Ditch the standard dashboard widgets
*************************************/
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );



