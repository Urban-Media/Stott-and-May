<?php
/*
Element Description: Basic Text
*/

// Element Class
class basic_text extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'basic_text_mapping' ) );
        add_shortcode( 'basic_text', array( $this, 'basic_text_html' ) );
    }

    // Element Mapping
    public function basic_text_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Basic Text', 'text-domain'),
              'base' => 'basic_text',
              'description' => __('This is a basic text component', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/file.png',
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

                array(
                    'type' => 'textarea_html',
                    'holder' => 'div',
                    'class' => 'component_content',
                    'heading' => __( 'Component Content', 'text-domain' ),
                    'param_name' => 'content',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( '', 'text-domain' ),
                    'group' => 'Content',
                ),

                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __( "Background Colour", "my-text-domain" ),
                  "param_name" => "backgroundcolour",
                  "value" => '#FF0000', //Default Red color
                  "description" => __( "Choose background colour.", "my-text-domain" ),
                  'group' => 'Design',
                ),

              )
          )
      );
    }


    // Element HTML
    public function basic_text_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'backgroundcolour' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;

          // Fill $html var with data
          $html = '
          <div class="text-container" style="background-color: ' . $backgroundcolour . ';">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-10">
                  <h2 class="basic-text-title">
                    ' . $title . '
                  </h2>
                  <div class="content_container">
                    ' . $content . '
                  </div>
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new basic_text();

?>
