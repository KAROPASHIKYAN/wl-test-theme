<?php

require_once 'core/class-create-taxonomies.php';
require_once 'core/class-kama-post-meta-box.php';

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