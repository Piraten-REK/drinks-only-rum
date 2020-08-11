<?php

function odr_init() {
	$labels = [
		'name'                  => _x( 'Steckbriefe', 'Post type general name', 'piraten_odr' ),
		'singular_name'         => _x( 'Steckbrief', 'Post type singular name', 'piraten_odr' ),
		'menu_name'             => _x( 'Steckbriefe', 'Admin Menu text', 'piraten_odr' ),
		'name_admin_bar'        => _x( 'Steckbrief', 'Add New on Toolbar', 'piraten_odr' ),
		'add_new'               => __( 'Anlegen', 'piraten_odr' ),
		'add_new_item'          => __( 'Neuen Steckbrief anlegen', 'piraten_odr' ),
		'new_item'              => __( 'Neuer Steckbrief', 'piraten_odr' ),
		'edit_item'             => __( 'Steckbrief barbeiten', 'piraten_odr' ),
		'view_item'             => __( 'Steckbrief ansehen', 'piraten_odr' ),
		'all_items'             => __( 'Alle Steckbriefe', 'piraten_odr' ),
		'search_items'          => __( 'Steckbriefe durchsuchen', 'piraten_odr' ),
		'not_found'             => __( 'Keine Steckbriefe gefunden', 'piraten_odr' ),
		'featured_image'        => _x( 'Potrait', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'piraten_odr' ),
		'set_featured_image'    => _x( 'Potrait setzen', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'piraten_odr' ),
		'remove_featured_image' => _x( 'Potrait entfernen', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'piraten_odr' ),
		'use_featured_image'    => _x( 'Als Portrait setzen', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'piraten_odr' ),
		'archives'              => _x( 'Steckbriefe', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'piraten_odr' ),
		'insert_into_item'      => _x( 'Zu Steckbrief hinzufügen', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'piraten_odr' ),
		'uploaded_to_this_item' => _x( 'Zu Steckbrief hinzugefügt', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'piraten_odr' ),
		'filter_items_list'     => _x( 'Steckbriefe filtern', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'piraten_odr' )
	];

	$args = [
		'labels'             => $labels,
		'description'        => 'Piraten-Steckbriefe',
		'public'             => true,
		'hierarchical'       => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-id-alt',
		'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'has_archive'        => true,
		'rewrite'            => [ 'slug' => 'steckbriefe', 'feeds' => false ],
		'capability_type'    => 'page',
	];

	if (taxonomy_exists('municipality')) {
		$args['taxonomies'] = 'municipality';
	}

	register_post_type( 'signalment', $args );
}