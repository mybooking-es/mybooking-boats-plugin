<?php
/**
*		BOATS LOOP PART
*  	---------------
*
* 	@version 0.0.1
*   @package WordPress
*   @subpackage Mybooking Boats Plugin
*   @since 1.0.3
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

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

    <div class="mybooking-boats_card-image">
      <div class="mybooking-boats_card-image-container">
        <?php the_post_thumbnail(); ?>
      </div>
    </div>

    <div class="mybooking-boats_card-body">
      <div class="mybooking-boats_card-info">

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

      <!-- Read more -->
      <a class="mybooking-boats_btn-book" href="<?php the_permalink(); ?>"><?php echo __( 'Book Now','mybooking-boats' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>
    </div>
  </div>
</article>
