<?php
/**
 * Register Mybooking Boats Custom Post Type
 *
 * @since 1.0.1
 */
function mybooking_boat() {

	$labels = array(
		'name'                  => _x( 'Boats', 'Post Type General Name', 'mybooking-boats' ),
		'singular_name'         => _x( 'Boats', 'Post Type Singular Name', 'mybooking-boats' ),
		'menu_name'             => __( 'Boats', 'mybooking-boats' ),
		'name_admin_bar'        => __( 'Boats', 'mybooking-boats' ),
		'archives'              => __( 'Boat Archives', 'mybooking-boats' ),
		'attributes'            => __( 'Boat Attributes', 'mybooking-boats' ),
		'parent_item_colon'     => __( 'Parent Boat:', 'mybooking-boats' ),
		'all_items'             => __( 'All Boats', 'mybooking-boats' ),
		'add_new_item'          => __( 'Add New Boat', 'mybooking-boats' ),
		'add_new'               => __( 'Add New', 'mybooking-boats' ),
		'new_item'              => __( 'New Boat', 'mybooking-boats' ),
		'edit_item'             => __( 'Edit Boat', 'mybooking-boats' ),
		'update_item'           => __( 'Update Boat', 'mybooking-boats' ),
		'view_item'             => __( 'View Boat', 'mybooking-boats' ),
		'view_items'            => __( 'View Boats', 'mybooking-boats' ),
		'search_items'          => __( 'Search Boat', 'mybooking-boats' ),
		'not_found'             => __( 'Not found', 'mybooking-boats' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'mybooking-boats' ),
		'featured_image'        => __( 'Boat Catalog Image', 'mybooking-boats' ),
		'set_featured_image'    => __( 'Set boat image', 'mybooking-boats' ),
		'remove_featured_image' => __( 'Remove boat image', 'mybooking-boats' ),
		'use_featured_image'    => __( 'Use as boat image', 'mybooking-boats' ),
		'insert_into_item'      => __( 'Insert into Boat', 'mybooking-boats' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Boat', 'mybooking-boats' ),
		'items_list'            => __( 'Boat list', 'mybooking-boats' ),
		'items_list_navigation' => __( 'Boat list navigation', 'mybooking-boats' ),
		'filter_items_list'     => __( 'Filter Boat list', 'mybooking-boats' ),
	);
	$rewrite = array(
		'slug'                  => 'boat',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Boats', 'mybooking-boats' ),
		'description'           => __( 'Mybooking Boats.', 'mybooking-boats' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-sos',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'boat', $args );

}
add_action( 'init', 'mybooking_boat', 0 );

/**
 * Register taxonomies for Mybooking Boats Custom Post Type
 *
 * @since 1.0.0
 */
function mybooking_boat_taxonomies() {
    register_taxonomy(
        'boats',
        'boat',
        array(
            'labels' => array(
                'name' 					=> __( 'Boat category', 'mybooking-boats' ),
                'add_new_item' 	=> __( 'Add Boat category', 'mybooking-boats' ),
                'new_item_name' => __( 'New Boat category', 'mybooking-boats' )
            ),
            'show_ui' 					=> true,
						'show_in_rest' 			=> true,
						'show_admin_column' => true,
            'show_tagcloud' 		=> false,
            'hierarchical' 			=> true,

        )
    );
}
add_action( 'init', 'mybooking_boat_taxonomies', 0 );


/**
 * Add templates for new taxonomies
 *
 * @since 1.0.0
 */

// Boats
function mybooking_boat_single_template( $single_boat_template ){
 	global $post;

	if ( $post->post_type == 'boat' ) {
	  $single_boat_template = plugin_dir_path(__FILE__) . 'templates/single-boat.php';
	}
	return $single_boat_template;
}
add_filter( 'single_template','mybooking_boat_single_template' );

function mybooking_boat_archives_template( $archive_boat_template ){
  global $post;

  if ( $post->post_type == 'boat' ) {
    $archive_boat_template = plugin_dir_path(__FILE__) . 'templates/archives-boat.php';
  }
  return $archive_boat_template;
}
add_filter( 'archive_template','mybooking_boat_archives_template' );
