<?php
//Get the nav menu items
$items = wp_get_nav_menu_items( 'primary' );
//responsive nav toggle
echo '<div class="menu-cont">';
echo '<ul>';
	foreach ($items as $item){
		echo '<li>'.$item->post_title.'</li>';
	}
echo '</ul>';
//close the ul container
echo '</div>';