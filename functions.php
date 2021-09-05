<?php

require_once 'core/class-create-taxonomies.php';
require_once 'core/class-kama-post-meta-box.php';

wp_enqueue_style('main', get_stylesheet_directory_uri() . '/style.css');

add_action('after_setup_theme', function (){
	add_theme_support('title-tag', );
	add_theme_support( 'custom-logo', array(
		'width'         => 60,
		'height'        => 60
	) );
});
add_action( 'customize_register', 'true_customizer_init' );

function true_customizer_init( $wp_customize ) {


	$wp_customize->add_setting( 'phone_number', array(
		'type' => 'theme_mod',
		'default'=> '380999999999'

	) );
	$wp_customize->add_control( 'phone_number',
		array(
			'section'=> 'title_tagline',
			'label'=>'Введите номер телефона',
			'type'=> 'number'
		) );

}

add_action('init', function (){
	$args = array('public'    => true,
	              'supports'  => array('title', 'editor'),
	              'menu_icon' => 'dashicons-car',
	              'labels'    => array(
		              'name'          => 'Car',
		              'singular_name' => 'Car',
		              'add_new'       => 'add car',
		              'edit_new_item' => 'add new car',
		              'edit_item'     => 'edit car',
		              'new_item'      => 'new car',
		              'view_item'     => 'view car'
	              ),
	              'map_meta_cap'      => true,
	              'rewrite'           => array(
		              'slug'       => 'car',
		              'with_front' => false,
		              'pages'      => false
	              )

	);
	register_post_type('car', $args);

});
$iso_my_thm = array(
	"Є" => "EH",
	"є" => "eh",
	"І" => "I",
	"і" => "i",
	"Ї" => "i",
	"ї" => "i",
	"А" => "A",
	"Б" => "B",
	"В" => "V",
	"Г" => "G",
	"Д" => "D",
	"Е" => "E",
	"Ё" => "JO",
	"Ж" => "ZH",
	"З" => "Z",
	"И" => "I",
	"Й" => "JJ",
	"К" => "K",
	"Л" => "L",
	"М" => "M",
	"Н" => "N",
	"О" => "O",
	"П" => "P",
	"Р" => "R",
	"С" => "S",
	"Т" => "T",
	"У" => "U",
	"Ф" => "F",
	"Х" => "KH",
	"Ц" => "C",
	"Ч" => "CH",
	"Ш" => "SH",
	"Щ" => "SHH",
	"Ъ" => "'",
	"Ы" => "Y",
	"Ь" => "",
	"Э" => "EH",
	"Ю" => "YU",
	"Я" => "YA",
	"а" => "a",
	"б" => "b",
	"в" => "v",
	"г" => "g",
	"д" => "d",
	"е" => "e",
	"ё" => "jo",
	"ж" => "zh",
	"з" => "z",
	"и" => "i",
	"й" => "jj",
	"к" => "k",
	"л" => "l",
	"м" => "m",
	"н" => "n",
	"о" => "o",
	"п" => "p",
	"р" => "r",
	"с" => "s",
	"т" => "t",
	"у" => "u",
	"ф" => "f",
	"х" => "kh",
	"ц" => "c",
	"ч" => "ch",
	"ш" => "sh",
	"щ" => "shh",
	"ъ" => "",
	"ы" => "y",
	"ь" => "",
	"э" => "eh",
	"ю" => "yu",
	"я" => "ya",
	"—" => "-",
	"«" => "",
	"»" => "",
	"…" => "",
	"№" => "#"
);

function url_translit_iso($title){
	global $iso_my_thm;
	return strtr($title, $iso_my_thm);
}

add_action('sanitize_title', 'url_translit_iso', 0);

function add_custom_tax() {
	\WL_Test_Theme\Core\create_taxonomies::create_taxonomy( 'Brand', 'brand', 'car' );
	\WL_Test_Theme\Core\create_taxonomies::create_taxonomy( 'Country manufacturer', 'country', 'car' );
}

add_action( 'init', 'add_custom_tax' );

add_action( 'init', 'my_new_metabox' );
function my_new_metabox() {
	class_exists( '\WL_Test_Theme\Core\Kama_Post_Meta_Box' ) && new \WL_Test_Theme\Core\Kama_Post_Meta_Box(
		array(
			'id'         => 'my',
			'title'      => 'Мои произвольные поля',
			'post_type' => 'car',

			'theme' => array(
				'css'        => '.kama_meta_box_my>.inside{ display:grid; grid-template-columns: repeat(2, 1fr);grid-template-rows: repeat(2, 4em);margin-bottom:3em; margin-left:1em; ,margin-right:1em; } .my_field_desc{ opacity:1; } .my_field_tit{ font-weight:bold; margin-bottom:.3em; }',
				'fields_wrap' => '%s',
				'field_wrap' => '<span class="my_field_wrap %1$s">%2$s</span>', // '%2$s' будет заменено на html поля
				'title_patt' => '<span class="my_field_tit">%s</span>', // '%s' будет заменено на заголовок
				'field_patt'  => '%s',
				'desc_patt'  => '<span class="my_field_desc"> %s</span>', // '%s' будет заменено на текст описания
			),

			'fields'     => array(
				'power_field'    => array(
					'type'=>'number', 'title'=>'Мощность', 'desc'=>'Л.С.', 'attr'=>'min="0"'
				),
				'price_field'    => array(
					'type'=>'number', 'title'=>'Цена', 'desc'=>'$', 'attr'=>'min="0"'
				),
				'fuel_field'    => array(
					'type'=>'select', 'title'=>'Тип топлива', 'options'=>array(''=>'Ничего не выбрано', 'Бензин'=>'Бензин', 'Дизельное топливо'=>'Дизельное топливо')
				),
				'color_field'    => array(
					'type'=>'color', 'title'=>'Цвет'
				),
				'image_field'    => array(
					'type'=>'image', 'title'=>'Фото', 'options'=>'url'
				),

			),
		)
	);

}
function phoneMask(string $number){
	$number = substr_replace($number, " ", 2, 0);
	$number = substr_replace($number, "(", 3, 0);
	$number = substr_replace($number, ")", 7, 0);
	$number = substr_replace($number, " ", 8, 0);
	$number = substr_replace($number, "-", 11, 0);
	$number = substr_replace($number, "-", 14, 0);

	$result = '+'.$number;
	return $result;
}

function get_clear_phone( string $phone, bool $plus = true ) {
	$pattern = ( $plus ) ? '![^0-9]!' : '![^0-9+]!';

	return preg_replace( $pattern, '', $phone );
}function remove_tag($string){
	$string = str_replace('<pre>', '', $string );
	$string = str_replace('</pre>', '', $string );
	$string = str_replace('<p>', '', $string );
	$string = str_replace('</p>', '', $string );
	$string = str_replace('<h1>', '', $string );
	$string = str_replace('</h1>', '', $string );
	$string = str_replace('<h2>', '', $string );
	$string = str_replace('</h2>', '', $string );
	$string = str_replace('<h3>', '', $string );
	$string = str_replace('</h3>', '', $string );
	$string = str_replace('<h4>', '', $string );
	$string = str_replace('</h4>', '', $string );
	$string = str_replace('<h5>', '', $string );
	$string = str_replace('</h5>', '', $string );
	$string = str_replace('<h6>', '', $string );
	$string = str_replace('</h6>', '', $string );
	return $string;
}