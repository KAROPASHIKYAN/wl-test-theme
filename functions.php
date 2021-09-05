<?php
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
