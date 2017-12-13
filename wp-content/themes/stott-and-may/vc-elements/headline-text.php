<?php
/*
Element Description: Headline Text
*/

// Element Class
class headline_text extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'headline_text_mapping' ) );
        add_shortcode( 'headline_text', array( $this, 'headline_text_html' ) );
    }

    // Element Mapping
    public function headline_text_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Headline Text', 'text-domain'),
              'base' => 'headline_text',
              'description' => __('This is a headline text component. Large text and colourful backgrounds.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/favorites.png',
              'params' => array(

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
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Background Image or Colour?', 'text-domain' ),
                    'param_name' => 'imageorcolour',
                    'value' => array(
                      'Choose Option' => 'default',
                      'Image' => 'bgimage',
                      'Colour' => 'colour'
                    ),
                    'std'         => 'default',
                    'description' => __( 'Choose between a background colour or image.', 'text-domain' ),
                    'group' => 'Design',
                ),

                array(
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => 'background-image',
                    'heading' => __( 'Background Image', 'text-domain' ),
                    'param_name' => 'backgroundimage',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Choose background image.', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'Design',
                    'dependency' => array(
                      'element' => 'imageorcolour',
                      'value' => 'bgimage'
                    )
                ),

                array(
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => __( "Background Colour", "my-text-domain" ),
                  "param_name" => "backgroundcolour",
                  "value" => '#FF0000', //Default Red color
                  "description" => __( "Choose background colour.", "my-text-domain" ),
                  'group' => 'Design',
                  'dependency' => array(
                    'element' => 'imageorcolour',
                    'value' => 'colour'
                  )
               ),

              )
          )
      );
    }


    // Element HTML
    public function headline_text_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                    'imageorcolour' => '',
                    'backgroundimage' => '',
                    'backgroundcolour' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;

          switch($imageorcolour) {
            case "bgimage":
              $bgimage = wp_get_attachment_image_src($backgroundimage, 'full');
              $style = "background-image: url(" . $bgimage[0] . ");";
            break;

            case "colour":
              $style = "background-color:" . $backgroundcolour . ";";
            break;

            default:
              $style = "background-color: #ebebeb;";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="headline-container" style="' . $style . '">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-10">
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
new headline_text();

?>
