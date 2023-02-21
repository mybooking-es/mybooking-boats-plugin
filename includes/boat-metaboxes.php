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
          'normal',                               // Position; normal, advanced or side
                                                  // CHANGED to normal because advanced duplicates gallery fields
          'core',                                 // Priority
       );
     }
   }
   add_action( 'add_meta_boxes', 'add_boat_metabox' );


  /* Add fields
  */
  function boat_deatils_box( $boat_data ) {

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

    <table class="form-table">
      <tr>
        <th scope="row"></th>
        <td class="boat-details-width"">
          <h3>Boat multimedia<h3>
        </td>
        <td></td>
      </tr>
    </table>
    <?php

    // Gallery data
    $boat_gallery_data = get_post_meta( $boat_data->ID, 'boat-details-gallery-data', true );
    ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label><?php echo esc_html_x( 'Image gallery', 'boat-single', 'mybooking-boats' ) ?></label>
            </th>
            <td class="boat-details-width">
              <div class="gallery_wrapper">
                <div id="img_box_container">
                  <?php
                    if ( isset( $boat_gallery_data['image_url'] ) ){
                      for( $i = 0; $i < count( $boat_gallery_data['image_url'] ); $i++ ){
                        $boat_gallery_item_src =  wp_get_attachment_image_src($boat_gallery_data['image_url'][$i],
                                                                                'medium'
                                                                                );
                        if (!empty($boat_gallery_item_src)) {
                      ?>
                        <div class="gallery_single_row dolu">
                          <div class="gallery_area image_container ">
                            <img class="gallery_img_img" src="<?php esc_html_e( $boat_gallery_item_src[0] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                            <input type="hidden"
                                class="meta_image_url"
                                name="boat-details-gallery[image_url][]"
                                value="<?php esc_html_e( $boat_gallery_data['image_url'][$i] ); ?>"
                              />
                          </div>
                          <div class="gallery_area">
                            <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                          </div>
                          <div class="clear">
                          </div>
                        </div>
                      <?php
                        }
                      }
                    }
                  ?>
                </div>
                <!-- Prepare new image -->
                <div style="display:none" id="master_box">
                  <div class="gallery_single_row">
                    <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                      <input class="meta_image_url" value="" type="hidden" name="boat-details-gallery[image_url][]" />
                    </div>
                    <div class="gallery_area">
                      <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="dashicons dashicons-trash"></i></span>
                    </div>
                    <div class="clear"></div>
                  </div>
                </div>
                <div id="add_gallery_single_row">
                  <button class="button add" type="button" onclick="open_media_uploader_image_plus();" title="Add image"/>
                    +
                  </button>
                </div>
              </div>
            </td>
            <td style="width: 45%;">
              <p class="description"><?php echo esc_html_x( 'Add multiple images from your media library to create a carousel. Click and drag to change the order.', 'boat-single', 'mybooking-boats' ) ?></p>
            </td>
          </tr>
        </tbody>
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

    // Height field
    $boat_details_height = get_post_meta( $boat_data->ID, 'boat-details-height', true );
    ?>
      <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="boat-details-height">Height</label>
          </th>
          <td>
            <input
              type="text"
              size="50"
              name="boat-details-height"
              value="<?php echo esc_attr( $boat_details_height ); ?>"
              id="boat-details-height"
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

    // Gallery
    if ( $_POST['boat-details-gallery'] ){

      // Build array for saving post meta
      $gallery_data = array();
      for ($i = 0; $i < count( $_POST['boat-details-gallery']['image_url'] ); $i++ ){
        if ( '' != $_POST['boat-details-gallery']['image_url'][$i]){
          $gallery_data['image_url'][] = $_POST['boat-details-gallery']['image_url'][ $i ];
        }
      }
      if ( isset( $gallery_data ) ) {
        // Avoid duplicates
        update_post_meta( $boat_data_id, 'boat-details-gallery-data', $gallery_data );
      }
      else {
        delete_post_meta( $boat_data_id, 'boat-details-gallery-data' );
      }
    }
    // Nothing received, all fields are empty, delete option
    else {
      delete_post_meta( $boat_data_id, 'boat-details-gallery-data' );
    }

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

    // Height
    if (  array_key_exists( 'boat-details-height', $_POST )  ) {
      $boat_height = sanitize_text_field( $_POST['boat-details-height'] );
      update_post_meta(
        $boat_data_id,
        'boat-details-height',
        $boat_height
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

  /* Camper Gallery scripts
   */
  function mybooking_boat_gallery_styles_scripts() {
?>
<style type="text/css">
  // Gallery

.gallery_area {
    float:right;
}

.image_container {
    float:left!important;
    width: 120px;
    background: url('https://i.hizliresim.com/dOJ6qL.png');
    height: 120px;
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 3px;
    cursor: pointer;
}

.image_container img{
    height: 120px;
    width: 120px;
    object-fit: cover;
    border-radius: 3px;
}

.clear {
  clear:both;
}

.gallery_wrapper {
    width: 100%;
    height: auto;
    position: relative;
    display: inline-block;
}

.gallery_wrapper input[type=text] {
    width:300px;
}

.gallery_wrapper .gallery_single_row {
    float: left;
    display:inline-block;
    width: 120px;
    position: relative;
    margin-right: 8px;
    margin-bottom: 20px;
}

.dolu {
    display: inline-block!important;
}

.gallery_wrapper label {
    padding:0 6px;
}

.button.remove {
    background: none;
    color: red;
    position: absolute;
    border: none;
    top: 4px;
    right: 7px;
    font-size: 1.2em;
    padding: 0px;
    box-shadow: none;
}

.button.remove:hover {
    background: none;
    color: #fff;
}

.button.add {
    background: #c3c2c2;
    color: #ffffff;
    border: none;
    box-shadow: none;
    width: 120px;
    height: 120px;
    line-height: 120px;
    font-size: 4em;
}

.button.add:hover, .button.add:focus {
    background: #e2e2e2;
    box-shadow: none;
    color: #0f88c1;
    border: none;
}
</style>
<script type="text/javascript">
    // Media uploader
    var media_uploader = null;

    /**
     * Remove single image
     */
    function remove_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

      jQuery(selectorImg).hide();
      jQuery(selectorAddButton).show();
      jQuery(selectorRemoveButton).hide();
      // Prepare the hidden field to hold the ID
      jQuery(selectorHidden).val('');

    }

    /**
     * Single image uploader
     */
    function open_media_uploader_single_image(selectorImg, selectorHidden, selectorAddButton, selectorRemoveButton) {

      // Uploader
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){

        var length = media_uploader.state().get("selection").length;

        if (length == 1) {
          var image = media_uploader.state().get("selection").models[0];
          var image_id = image.attributes.id;
          var image_url = image.changed.url;
          jQuery(selectorImg).attr('src', image_url);
          jQuery(selectorImg).show();
          jQuery(selectorAddButton).hide();
          jQuery(selectorRemoveButton).show();
          // Prepare the hidden field to hold the ID
          jQuery(selectorHidden).val(image_id);
        }

      });
      media_uploader.open();

    }

    /**
     * Remove Image
     */
    function remove_img(value) {
      var parent=jQuery(value).parent().parent();
      parent.remove();
    }

    /**
     * Uploader image
     */
    function open_media_uploader_image(obj){
      // Upload image
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var image_id = json.id;
        var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
        jQuery(obj).append(html);
        // Prepare the hidden field to hold the ID
        jQuery(obj).find('.meta_image_url').val(image_id);
      });
      media_uploader.open();
    }

    /**
     * Uploader image
     */
    function open_media_uploader_image_this(obj){
      // Change image
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: false
      });
      media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();
        var image_url = json.url;
        var image_id = json.id;
        jQuery(obj).attr('src',image_url);
        // Prepare the hidden field to hold the ID
        jQuery(obj).siblings('.meta_image_url').val(image_id);
      });
      media_uploader.open();
    }

    /**
     * Append image
     */
    function open_media_uploader_image_plus(){
      // Uploader
      media_uploader = wp.media({
        frame:    "post",
        state:    "insert",
        multiple: true
      });
      media_uploader.on("insert", function(){

        var length = media_uploader.state().get("selection").length;
        var images = media_uploader.state().get("selection").models;

        for(var i = 0; i < length; i++){
          var image_id = images[i].attributes.id;
          var image_url = images[i].changed.url;
          var box = jQuery('#master_box').html();
          jQuery(box).appendTo('#img_box_container');
          var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
          var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
          element.append(html);
          // Prepare the hidden field to hold the ID
          element.find('.meta_image_url').val(image_id);
        }
      });
      media_uploader.open();
    }
    jQuery(function() {
      jQuery("#img_box_container").sortable(); // Activate jQuery UI sortable feature
    });
    </script>
<?php
  }

  add_action( 'admin_head-post.php', 'mybooking_boat_gallery_styles_scripts' );
  add_action( 'admin_head-post-new.php', 'mybooking_boat_gallery_styles_scripts' );
