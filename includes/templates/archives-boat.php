<?php
/**
*		BOATS ARCHIVE
*  	-------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Boats Plugin
*   @since 1.0.0
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="page_content mybooking-boats">
	<div class="container" id="content" tabindex="-1">
		<div class="mb-row">
			<div class="mb-col-md-12">

				<!-- Widgets top -->

				<?php if ( is_active_sidebar( 'sidebar-top' ) ) { ?>
					<div class="mybooking-boats_widget-area">
						 <?php dynamic_sidebar('sidebar-top'); ?>
					</div>
				<?php } ?>

				<!-- Boats loop -->

				<div class="mybooking-boats_grid">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<!-- Gets custom fields data -->
							<?php
								$boat_details_model = get_post_meta( $post->ID, 'boat-details-model', true );
								$boat_details_engine = get_post_meta( $post->ID, 'boat-details-engine', true );
								$boat_details_places = get_post_meta( $post->ID, 'boat-details-places', true );
								$boat_details_lenght = get_post_meta( $post->ID, 'boat-details-lenght', true );
								$boat_details_width = get_post_meta( $post->ID, 'boat-details-width', true );
							?>

							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<?php $mybooking_permalink = get_permalink(); ?>

								<!-- Card content -->
								<div class="mybooking-boats_card">

									<?php the_post_thumbnail(); ?>

									<div class="mybooking-boats_card-body">
										<div class="mybooking-boats_card-info">

											<!-- Categories -->
											<div class="mybooking-boats_card-category">
												<?php if ( get_post_type( get_the_ID() ) == 'boat' ) {
													$boat_taxonomy = get_the_terms( get_the_ID(), 'boats' );
													foreach ( $boat_taxonomy as $boat_tax ) { ?>
														<span class="mybooking-boats_card-category-item"><?php echo esc_html( $boat_tax->name ); ?></span>
													<?php }
												}?>
											</div>
										</div>

										<?php if ( !empty( get_the_title() ) ) { ?>
											<?php the_title( sprintf( '<h2 class="mybooking-boats_post-title"><a href="%s" rel="bookmark" class="mybooking-boats_post-title-link">', esc_url( $mybooking_permalink ) ), '</a></h2>' ); ?>

										<?php } else { ?>
											<?php $mybooking_allowed_html = array(
												'a' => array(
													'href' => array(),
													'rel' => array(),
													'class' => array()
												) ) ?>

											<h2 class="mybooking-boats_post-title">
												<?php echo wp_kses( sprintf( _x('<a href="%s" rel="bookmark" class="mybooking-boats_post-title-link untitled">Untitled</a>', 'content_blog', 'mybooking'), esc_url( $mybooking_permalink ) ), $mybooking_allowed_html ); ?>
											</h2>
										<?php } ?>

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

										<?php if ( $boat_details_places !='' && $boat_details_lenght !='' && $boat_details_width !='' ) {  ?>
											<div class="mybooking-boats_details">
												<?php if ( $boat_details_places !='' ) {  ?>
													<span class="mybooking-boats_places">
														<span class="dashicons dashicons-groups"></span>
														<?php echo esc_html( $boat_details_places ) ?>
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
											</div>
										<?php } ?>

										<!-- Read more -->
										<a class="mybooking-boats_btn-book" href="<?php the_permalink(); ?>"><?php echo __( 'Book Now','mybooking-boats' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>
									</div>
								</div>
							</article>

						<?php endwhile; ?>

					<!-- No content -->
					<?php else : ?>
						<h3><?php echo esc_html_x( 'No content found. Please publish at least one post to show something at here', 'blog_message', 'mybooking' ); ?></h3>
					<?php endif; ?>
				</div>

				<!-- Widgets bottom -->

				<?php if ( is_active_sidebar( 'sidebar-bottom' ) ) { ?>
					<div class="mybooking-boats_widget-area">
						 <?php dynamic_sidebar('sidebar-bottom'); ?>
					</div>
				<?php } ?>

				<!-- Pagination -->

				<div class="mb-col-md-12">
					<?php get_template_part( 'mybooking-parts/blog/mybooking-pagination' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer();
