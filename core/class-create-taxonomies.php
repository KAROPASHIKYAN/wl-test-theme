<?php

namespace WL_Test_Theme\Core;

class create_taxonomies {
	public static function create_taxonomy( $title, $internalname, $posttype, $public = true ) {

		$labels = array(
			'name'              => $title,
			'singular_name'     => 'Наименование ',
			'search_items'      => 'Поиск ',
			'all_items'         => 'Все ',
			'edit_item'         => 'Редактировать ',
			'update_item'       => 'Сохранить ',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новая ',
			'menu_name'         => $title
		);


		$args = array(
			'labels'                => $labels,
			'public'                => $public,
			'publicly_queryable'    => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_tagcloud'         => true,
			'hierarchical'          => false,
			'update_count_callback' => '',
			'rewrite'               => true,
			'query_var'             => $internalname,
			'capabilities'          => array(),
		);


		register_taxonomy( $internalname, '', $args );

		register_taxonomy_for_object_type($internalname, $posttype);
	}
}
