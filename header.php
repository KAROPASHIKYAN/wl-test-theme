<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<?php wp_head();?>
</head>
<body>
<header>
	<div>
		<?php $phone = get_theme_mod('phone_number'); ?>
		<span><?php the_custom_logo(); ?></span>
		<span class="head-text" c><?php echo get_bloginfo('name'); ?></span>
		<span class="head-text"><?php echo get_bloginfo('description'); ?></span>
		<span class="tel"><a href="tel:<?php echo get_clear_phone($phone);?>"><?php echo phoneMask($phone); ?></a></span>
	</div>
</header>