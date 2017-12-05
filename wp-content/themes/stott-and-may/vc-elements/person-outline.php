<?php
/*
Element Description: Person Outline
*/

// Element Class
class person_outline extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'person_outline_mapping' ) );
        add_shortcode( 'person_outline', array( $this, 'person_outline_html' ) );
    }

    // Element Mapping
    public function person_outline_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Person Outline Component', 'text-domain'),
              'base' => 'person_outline',
              'description' => __('This is the component where you add an outline image of a person and then content on the other side.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/user.png',
              'params' => array(

                  array(
                      'type' => 'textfield',
                      'holder' => 'div',
                      'class' => 'title',
                      'heading' => __( 'Title', 'text-domain' ),
                      'param_name' => 'title',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'This is the component title.', 'text-domain' ),
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
                      'type' => 'attach_image',
                      'holder' => 'div',
                      'class' => 'outline-image',
                      'heading' => __( 'Outline Image', 'text-domain' ),
                      'param_name' => 'outlineimage',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Add an image of a person to this.', 'text-domain' ),
                      'admin_label' => false,
                      'weight' => 0,
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

                  array(
                      'type' => 'dropdown',
                      'holder' => 'div',
                      'class' => '',
                      'heading' => __( 'Show Bottom Border?', 'text-domain' ),
                      'param_name' => 'bottom_border',
                      'value' => array(
                        'Choose Option' => 'default',
                        'Show' => 'show',
                        'Hide' => 'hide'
                      ),
                      'std'         => 'default',
                      'description' => __( 'This will show or hide a pink border on the bottom of this component.', 'text-domain' ),
                      'group' => 'Design',
                  ),

              )
          )
      );
    }


    // Element HTML
    public function person_outline_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'outlineimage'   => '',
                      'backgroundcolour' => '',
                      'bottom_border' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;
          $outlineimage_url = wp_get_attachment_image_src($outlineimage, 'full');

          switch($bottom_border) {
            case "show":
              $style = "border-bottom: 10px solid #d5137c;";
            break;

            case "hide":
              $style = "";
            break;

            default:
              $style = "";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="person-outline-container" style="background-color: ' . $backgroundcolour . '; ' . $style . '">
            <div class="container">
              <div class="row">
                <div class="col-12 col-sm-6 order-1 order-sm-12">
                  <h2 class="person-outline-title">
                    ' . $title . '
                  </h2>
                  <div class="content_container">
                    ' . $content . '
                  </div>
                </div>
                <div class="col-12 col-sm-6 order-12 order-sm-1">
                  <img src="' . $outlineimage_url[0] . '">
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new person_outline();


?>
