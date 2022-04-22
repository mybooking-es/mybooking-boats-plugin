<?php
/**
*		BOATS LOOP PART
*  	---------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Boats Plugin
*   @since 1.0.3
*
*   @see https://wordpress.stackexchange.com/a/232879
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Register shortcodes
 *
 */
function register_shortcodes() {
  add_shortcode( 'mybooking_boats_loop', 'mybooking_boats_shortcode' );
}
add_action( 'init', 'register_shortcodes' );


/**
 * Boats shortcode callback
 *
 */
function mybooking_boats_shortcode() {
    global $wp_query,
           $post;

    $boats_loop = new WP_Query( array(
        'posts_per_page'    => 6,
        'post_type'         => 'boat',
    ) );

    if( ! $boats_loop->have_posts() ) {
        return false;
    } ?>

    <div class="mb-shortcode mybooking-boats">
    	<div class="container">
    		<div class="mb-row">
    			<div class="mb-col-md-12">
            <div class="mybooking-boats_grid">

              <?php while( $boats_loop->have_posts() ) {
                  $boats_loop->the_post();
                  include('templates/loop-part.php');
              } ?>

            </div>
          </div>
        </div>
      </div>
    </div>

  <?php  wp_reset_postdata();
}
