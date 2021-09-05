<?php get_header(); ?>
<h1><?php
	$model = get_the_title();
	$cur_terms = get_the_terms( $post->ID, 'brand' );
	if ( is_array( $cur_terms ) ) {
		foreach ( $cur_terms as $cur_term ) {
			echo  $cur_term->name . ' ' . $model;
		}
	}
	?></h1>
<div class="content"><?php
	$text= get_the_content();
	echo remove_tag($text); ?></div>
<div class="fields">
	<div>
		<img src="<?php  $meta = new stdClass;
		foreach( (array) get_post_meta( $post->ID ) as $k => $v ) $meta->$k = $v[0];

		echo $meta->my_image_field;?>" width="280" height="210">
	</div>
	<div class="fields">
		<span>Цена: <?php echo $meta->my_price_field; ?>$</span>
		<span>Мощность <?php echo $meta->my_power_field; ?> Л.С.</span>
		<span>Цвет:</span>
		<span class="ic-color" style="background-color: <?php echo $meta->my_color_field; ?>"></span>
		<span>Тип топлива: <?php echo $meta->my_fuel_field; ?></span>
		<span>Страна производитель: <?php
			$cur_terms = get_the_terms( $post->ID, 'country' );
			if ( is_array( $cur_terms ) ) {
				foreach ( $cur_terms as $cur_term ) {
					echo  $cur_term->name;
				}
			} ?></span>
	</div>
</div>
</body>
</html>