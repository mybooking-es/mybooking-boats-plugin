<?php

/**
 * MYBOOKING BOATS PLUGIN
 * ---------------------
 *
 * @link              https://mybooking.es
 * @since             1.0.0
 * @package           Mybooking Boats
 *
 * @wordpress-plugin
 * Plugin Name:       Mybooking Boats
 * Plugin URI:        https://mybooking.es
 * Description:       Simple plugin to create a Custom Post Type to show boat pages
 * Version:           1.0.0
 * Author:            Mybooking Team
 * Author URI:        https://mybooking.es
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mybooking-boats
 * Domain Path:       /languages
 */


// Reject direct requests for this file
if ( ! defined( 'WPINC' ) ) { die; }


/**
 * Enqueue styles
 *
 * @since 1.0.0
 */
function mybooking_boat_styles( ) {
	wp_register_style(
		'mybooking-boats-styles',
		plugins_url( '/style.css', __FILE__ )
	);
	wp_enqueue_style(
	 'mybooking-boats-styles',
	 plugin_dir_url( __FILE__ ) . 'style.css'
	);
}
add_action( 'wp_enqueue_scripts', 'mybooking_boat_styles' );


/**
 * Includes boat post type
 *
 * @since 1.0.0
 */
include_once('includes/boat-post-type.php');


/**
 * Includes boat meta boxes
 *
 * @since 1.0.0
 */
include_once('includes/boat-metaboxes.php');


/**
 * Includes plugin breadcrumbs
 *
 * @since 1.0.0
 */
include_once('includes/plugin-breadcrumbs.php');

/**
 * Add class 'mybooking-product' to custom post type
 *
 * @since 1.0.0
 */
function mybooking_boats_body_class ( $classes ) {

    if ( 'boat' == get_post_type() ):
        $classes[] = 'mybooking-product';
    endif;

    return $classes;

}
add_filter( 'body_class', 'mybooking_boats_body_class' );

/**
 * Load microtemplates
 *
 * @since 1.0.0
 */
function mybooking_boats_include_micro_templates ( $classes ) {

    if ( 'boat' == get_post_type() ):
        if ( function_exists('mybooking_engine_get_template') ):
            mybooking_engine_get_template('mybooking-plugin-product-widget-tmpl.php');
        endif;
    endif;

}
add_action( 'wp_footer',  'mybooking_boats_include_micro_templates' );

/**
 * Create sidebars for templates
 *
 * @since 1.0.2
 */
function mybooking_boats_sidebars() {
    register_sidebar( array(
        'name'          => __( 'Boats Archive Top', 'mybooking-boats' ),
        'id'            => 'sidebar-top',
        'description'   => __( 'Widgets in this area will be shown on boats archives page.', 'mybooking-boats' ),
        'before_widget' => '<div id="%1$s" class="mybooking-boats_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-boats_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Boats Archive Bottom', 'mybooking-boats' ),
        'id'            => 'sidebar-bottom',
        'description'   => __( 'Widgets in this area will be shown on boats archives page.', 'mybooking-boats' ),
        'before_widget' => '<div id="%1$s" class="mybooking-boats_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-boats_widget-title">',
        'after_title'   => '</h2>',
    ) );

		register_sidebar( array(
        'name'          => __( 'Boats Post', 'mybooking-boats' ),
        'id'            => 'sidebar-post',
        'description'   => __( 'Widgets in this area will be shown on boats single page.', 'mybooking-boats' ),
        'before_widget' => '<div id="%1$s" class="mybooking-boats_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="mybooking-boats_widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mybooking_boats_sidebars' );
