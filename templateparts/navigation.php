<?php $items = wp_get_nav_menu_items( 'primary' ); ?>
<span class="hidden menu-toggle">Menu</span>
<div class="menu-cont">
	<nav role="navigation">
		<?php foreach ($items as $item){ echo '<a href="'.$item->url.'">'.$item->title.'</a>'; } ?>
		<div class="contact">
			<a href="tel:+441244629963">TEL: +44 (0) 1244 629 963</a>
			<a href="">EMAIL ELEGANT ADDRESS</a>
		</div>
	</nav>
</div>