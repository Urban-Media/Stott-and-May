<?php
/*
Element Description: Basic Text
*/

// Element Class
class image_row extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'image_row_mapping' ) );
        add_shortcode( 'image_row', array( $this, 'image_row_html' ) );
    }

    // Element Mapping
    public function image_row_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Image Row', 'text-domain'),
              'base' => 'image_row',
              'description' => __('This is a row of 4 images.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/images.png',
              'params' => array(

                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'title',
                    'heading' => __( 'Title', 'text-domain' ),
                    'param_name' => 'title',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Title for the component', 'text-domain' ),
                    'group' => 'Content',
                ),

              )
          )
      );
    }


    // Element HTML
    public function image_row_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                  ),
                  $atts
              )
          );

          // Fill $html var with data
          $html = '
          <div class="image-row-container" style="background-color: ' . $backgroundcolour . ';">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-10">
                  <h2 class="image-row-title">
                    ' . $title . '
                  </h2>
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new image_row();

?>
