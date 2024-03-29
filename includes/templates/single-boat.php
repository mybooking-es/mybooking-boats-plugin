<?php
/**
*		BOATS SINGLE
*  	------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Boats Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div id="content">
	<?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    	<div class="post_content mybooking-boats mybooking-boats_post">
    		<div class="container" tabindex="-1">
					<div class="mb-row">
						<div class="mb-col-md-12">
							<?php echo sea_rent_boat_breadcrumbs(); ?>

							<!-- Header -->
							<?php if ( empty( get_the_title() ) ) { ?>
								<h1 class="mybooking-boats_post-header untitled">
									<?php echo esc_html_x('Untitled', 'content_blog', 'mybooking'); ?>
								</h1>

							<?php } else { ?>
								<h1 class="mybooking-boats_post-header"><?php the_title(); ?></h1>
							<?php } ?>
						</div>
					</div>	
					<div class="mb-row">	
						<div class="mb-col-md-8">

							<?php
								$boat_details_gallery = get_post_meta( $post->ID, 'boat-details-gallery-data', true );
								if ( isset( $boat_details_gallery ) && !empty( $boat_details_gallery ) ) {
									$boat_details_photos_url_array = $boat_details_gallery['image_url'];
								}
								else {
									$boat_details_photos_url_array = [];
								}
								$boat_details_photos_count = sizeof($boat_details_photos_url_array);
								
							  if( $boat_details_photos_count !='' ) { ?>
								  <div class="mybooking-boat_carousel mybooking-product-carousel-inner">
									  <?php for( $i=0; $i<$boat_details_photos_count; $i++ ) { ?>
											<div class="mybooking-carousel-item">
		  									<?php
		  									    $boat_photo = wp_get_attachment_image(
		  											$boat_details_photos_url_array[$i],
		  											'full',
		  											false,
		  											['src', 'alt', 'class' => 'mybooking-boat_carousel-img']
		  										);
		  										echo wp_kses_post( $boat_photo )
		                    				?>
											</div>
										<?php } ?>
									</div>
							<?php } ?>

							<!-- Content -->
							<div class="entry-content">
								<?php the_content(); ?>
							</div>

							<?php if ( $boat_details_description !='' ) {  ?>
								<span class="mybooking-boats_description">
									<?php echo esc_html( $boat_details_description ) ?>
								</span>
							<?php } ?>

							<!-- Categories -->
							<div class="mybooking-boats_card-category">
								<?php if ( get_post_type( get_the_ID() ) == 'boat' ) {
									$boat_taxonomy = get_the_terms( get_the_ID(), 'boats' );
									if ( isset( $boat_taxonomy ) && !empty( $boat_taxonomy ) ) {
										foreach ( $boat_taxonomy as $boat_tax ) { ?>
											<span class="mybooking-boats_card-category-item"><?php echo esc_html( $boat_tax->name ); ?></span>
										<?php }
									}
								}?>
							</div>

							<!-- Gets custom fields data -->
							<?php
								$boat_details_id = get_post_meta( $post->ID, 'boat-details-id', true );
								$boat_details_model = get_post_meta( $post->ID, 'boat-details-model', true );
								$boat_details_engine = get_post_meta( $post->ID, 'boat-details-engine', true );
								$boat_details_places = get_post_meta( $post->ID, 'boat-details-places', true );
								$boat_details_lenght = get_post_meta( $post->ID, 'boat-details-lenght', true );
								$boat_details_width = get_post_meta( $post->ID, 'boat-details-width', true );
								$boat_details_height = get_post_meta( $post->ID, 'boat-details-height', true );
								$boat_details_description = get_post_meta( $post->ID, 'boat-details-description', true );
							?>

							<?php if ( $boat_details_model !='' ) {  ?>
								<div class="mybooking-boats_model">
									<?php echo esc_html( $boat_details_model ) ?>
								</div>
							<?php } ?>

							<!-- Details -->
							<?php if ( $boat_details_model !='' ) {  ?>
								<div class="mybooking-boats_engine">
									<?php echo esc_html( $boat_details_engine ) ?>
								</div>
							<?php } ?>

							<div class="mybooking-boats_details">
								<?php if ( $boat_details_places !='' ) {  ?>
									<span class="mybooking-boats_places">
										<span class="dashicons dashicons-groups"></span>
										<?php echo esc_html( $boat_details_places ) ?> pax
									</span>
								<?php } ?>

								<?php if ( $boat_details_lenght !='' ) {  ?>
									<span class="mybooking-boats_lenght">
										<span class="dashicons dashicons-editor-code"></span>
										<?php echo esc_html( $boat_details_lenght ) ?>
									</span>
								<?php } ?>

								<?php if ( $boat_details_width !='' ) {  ?>
									<span class="mybooking-boats_width">
										<span class="dashicons dashicons-fullscreen-exit-alt"></span>
										<?php echo esc_html( $boat_details_width ) ?>
									</span>
								<?php } ?>

								<?php if ( $boat_details_height !='' ) {  ?>
				          <span class="mybooking-boats_height">
				            <span class="dashicons dashicons-arrow-up-alt"></span>
				            <?php echo esc_html( $boat_details_height ) ?>
				          </span>
				        <?php } ?>
							</div>

							<?php if ( $boat_details_description !='' ) {  ?>
								<span class="mybooking-boats_description">
									<?php echo esc_html( $boat_details_description ) ?>
								</span>
							<?php } ?>

							<!-- Widgets bottom -->

							<?php if ( is_active_sidebar( 'sidebar-post' ) ) { ?>
								<div class="mybooking-boats_single-widget-area">
									 <?php dynamic_sidebar('sidebar-post'); ?>
								</div>
							<?php } ?>
						</div>

						<div class="mb-col-md-4">

								<!-- Mybooking Boat Calendar -->
								<?php if ( $boat_details_id !='' ) {  ?>
									<?php echo do_shortcode( '[mybooking_rent_engine_product code="' . $boat_details_id . '"]' ); ?>
								<?php } else { ?>
									<?php echo do_shortcode( '[mybooking_contact subject="'.esc_html(get_the_title()).'"]' ); ?>
								<?php } ?>
						</div>
					</div>

    			<div class="mb-row">
    				<div class="mb-col-md-12">

							<!-- Link pages -->
          		<?php
          		wp_link_pages(
          			array(
          				'before' => '<div class="mybooking-entry-links">' . esc_html_x( 'Pages', 'pages_navigation', 'mybooking' ),
          				'after'  => '</div>',
          			)
          		);
          		?>

							<!-- Footer -->
    					<footer class="entry-footer">
    						<?php
    						   if (function_exists('mybooking_entry_footer') ):
    						     mybooking_entry_footer();
    						   endif;
    						?>
    					</footer>
    				</div>
    			</div>
    		</div>

    		<!-- Posts navigation -->
    		<?php
    		  if (function_exists('mybooking_post_nav') ):
    		     mybooking_post_nav();
    		  endif; ?>
    	</div>
    </article>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</div>

<?php get_footer();
