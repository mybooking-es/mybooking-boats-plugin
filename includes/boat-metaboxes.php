<?php
/**
 * Register meta boxes for Sea Rent Boats Custom Post Type
 *
 * @since 1.0.1
 */

   /* Add metabox
   */
   function add_boat_metabox() {
     $screens = [ 'boat' ];
     foreach ( $screens as $screen ) {
       add_meta_box(
          'boat-details',                         // Unique ID
          'Boat Details',                         // Box title
          'boat_deatils_box',                     // Content callback, must be of type callable
          $screen,                                // Post type
          'advanced',                             // Position; normal, advanced or side
          'core',                                 // Priority
       );
     }
   }
   add_action( 'add_meta_boxes', 'add_boat_metabox' );


  /* Add fields
  */
  function boat_deatils_box( $boat_data ) {

    // Featured image control
    $boat_details_image = get_post_meta( $boat_data->ID, 'boat-details-image', true );
    ?>
      <table class="form-table" style="background-color:#efefef; padding: 10px;">
      <tbody>
        <tr>
          <th scope="row" style="padding-left:10px;">
            <label for="boat-details-image">Featured image</label>
          </th>
          <td>
            <input
              type="checkbox"
              name="boat-details-image"
              <?php checked( $boat_details_image, 1 ); ?>
              value="1"
              id="boat-details-image"
              class="components-text-control__input">
              <span class="description"><strong>If checked will show Featured Image in boat page.</strong> Uncheck if you plan to add an image gallery in content area, while keep it in cards.</span>
          </td>
        </tr>
      </table>
    <?php

    // ID field
    $boat_details_id = get_post_meta( $boat_data->ID, 'boat-details-id', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-id">Boat ID</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-id"
              value="<?php echo esc_attr( $boat_details_id ); ?>"
              id="boat-details-id"
              class="components-text-control__input">
          </td>
          <td>
            <p class="description">Paste here the ID of this boat if you want to show the booking calendar. Requires an active <a href="https://mybooking.es/registro/" title="Register your account" target="_blank">Mybooking account</a> and a properly set inventory.</p>
          </td>
        </tr>
      </table>
    <?php

    // Model field
    $boat_details_model = get_post_meta( $boat_data->ID, 'boat-details-model', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-model">Model</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-model"
              value="<?php echo esc_attr( $boat_details_model ); ?>"
              id="boat-details-model"
              class="components-text-control__input">
          </td>
        </tr>
      </table>
    <?php

    // Engine field
    $boat_details_engine = get_post_meta( $boat_data->ID, 'boat-details-engine', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-engine">Engine</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-engine"
              value="<?php echo esc_attr( $boat_details_engine ); ?>"
              id="boat-details-engine"
              class="components-text-control__input">
          </td>
        </tr>
      </table>
    <?php

    // Places field
    $boat_details_places = get_post_meta( $boat_data->ID, 'boat-details-places', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-places">Places</label>
          </th>
          <td>
            <input
              type="number"
              size="50"
              name="boat-details-places"
              value="<?php echo esc_attr( $boat_details_places ); ?>"
              id="boat-details-places"
              class="components-text-control__input">
          </td>
        </tr>
      </table>
    <?php

    // Lenght field
    $boat_details_lenght = get_post_meta( $boat_data->ID, 'boat-details-lenght', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-lenght">Lenght</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-lenght"
              value="<?php echo esc_attr( $boat_details_lenght ); ?>"
              id="boat-details-lenght"
              class="components-text-control__input">
          </td>
        </tr>
      </table>
    <?php

    // Width field
    $boat_details_width = get_post_meta( $boat_data->ID, 'boat-details-width', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-width">Width</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-width"
              value="<?php echo esc_attr( $boat_details_width ); ?>"
              id="boat-details-width"
              class="components-text-control__input">
          </td>
        </tr>
      </table>
    <?php

    // Description field
    $boat_details_description = get_post_meta( $boat_data->ID, 'boat-details-description', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-description">Description</label>
          </th>
          <td>
            <textarea
              name="boat-details-description"
              id="boat-details-description"
              rows="10" cols="50"
              class="components-text-control__input"><?php echo esc_html( $boat_details_description ); ?>
            </textarea>
          </td>
        </tr>
      </table>
    <?php
  }


  /* Save data
  */
  function add_boat_metabox_data( $boat_data_id ) {

    // Boat ID
    if (  array_key_exists( 'boat-details-id', $_POST )  ) {
      $boat_id = sanitize_text_field( $_POST['boat-details-id'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-id',
        $boat_id
      );
    }

    // Boat ID
    if (  array_key_exists( 'boat-details-image', $_POST )  ) {
      $boat_image = ( isset( $_POST['boat-details-image'] ) && '1' === $_POST['boat-details-image'] ) ? 1 : 0;
      update_post_meta(
        $boat_data_image,
        'boat-details-image',
        $boat_image
      );
    }

    // $mytheme_checkbox_value = ( isset( $_POST['mytheme_checkbox_value'] ) && '1' === $_POST['mytheme_checkbox_value'] ) ? 1 : 0; // Input var okay.
		// update_post_meta( $post_id, 'mytheme_checkbox_value', esc_attr( $mytheme_checkbox_value ) );

    // Model
    if (  array_key_exists( 'boat-details-model', $_POST )  ) {
      $boat_model = sanitize_text_field( $_POST['boat-details-model'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-model',
        $boat_model
      );
    }

    // Engine
    if (  array_key_exists( 'boat-details-engine', $_POST )  ) {
      $boat_engine = sanitize_text_field( $_POST['boat-details-engine'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-engine',
        $boat_engine
      );
    }

    // Places
    if (  array_key_exists( 'boat-details-places', $_POST )  ) {
      $boat_places = sanitize_text_field( $_POST['boat-details-places'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-places',
        $boat_places
      );
    }

    // Lenght
    if (  array_key_exists( 'boat-details-lenght', $_POST )  ) {
      $boat_lenght = sanitize_text_field( $_POST['boat-details-lenght'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-lenght',
        $boat_lenght
      );
    }

    // Width
    if (  array_key_exists( 'boat-details-width', $_POST )  ) {
      $boat_width = sanitize_text_field( $_POST['boat-details-width'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-width',
        $boat_width
      );
    }

    // Description
    if (  array_key_exists( 'boat-details-description', $_POST )  ) {
      $boat_description = sanitize_text_field( $_POST['boat-details-description'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-description',
        $boat_description
      );
    }

   }
   add_action( 'save_post', 'add_boat_metabox_data' );


   /* Move metabox below editor
   */
  function mybooking_move_metabox() {

    global $post, $wp_meta_boxes;
    do_meta_boxes(
      get_current_screen(),
      'advanced',
      $post
    );
    unset( $wp_meta_boxes['post']['advanced'] );
  }
  add_action('edit_form_after_title', 'mybooking_move_metabox');
