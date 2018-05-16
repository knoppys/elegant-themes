<!DOCTYPE html>
<html>
<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

	<?php
	/*
	Dont forget to add your favicon and touch icong into the images directory. You can
	generate these from a png on loads of different websites
	*/
	?>
	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="home-naviagtion" id="sticky">		
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<?php echo get_template_part('templateparts/headerlogo'); ?>
			</div>
			<div class="col-md-10 dark">
				<?php echo get_template_part('templateparts/navigation'); ?>
			</div>
		</div>	
	</div>	
</header>
<main>


