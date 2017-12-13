<?php
/*
Element Description: Slanted Image
*/

// Element Class
class slanted_image extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'slanted_image_mapping' ) );
        add_shortcode( 'slanted_image', array( $this, 'slanted_image_html' ) );
    }

    // Element Mapping
    public function slanted_image_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Slanted Image', 'text-domain'),
              'base' => 'slanted_image',
              'description' => __('This is the component with an image on one side and text content on the other.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/slanted-image.png',
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
                    'type' => 'attach_image',
                    'holder' => 'div',
                    'class' => 'slanted_image',
                    'heading' => __( 'Slanted Image', 'text-domain' ),
                    'param_name' => 'slanted_image',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Choose slanted image.', 'text-domain' ),
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
                    'heading' => __( 'Colour of Dotted Line', 'text-domain' ),
                    'param_name' => 'colour_line',
                    'value' => array(
                      'Choose Option' => 'default',
                      'Blue' => 'blue',
                      'Pink' => 'pink',
                      'White' => 'white',
                    ),
                    'std'         => 'default',
                    'description' => __( 'Choose the colour of the dotted line on the image.', 'text-domain' ),
                    'group' => 'Design',
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Text Colour', 'text-domain' ),
                    'param_name' => 'colour_title',
                    'value' => array(
                      'Choose Option' => 'default',
                      'Dark' => 'dark',
                      'Light' => 'light',
                    ),
                    'std'         => 'default',
                    'description' => __( 'Choose the colour of the text.', 'text-domain' ),
                    'group' => 'Design',
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Button Visibility', 'text-domain' ),
                    'param_name' => 'buttonvisibility',
                    'value' => array(
                      'Show' => 'show',
                      'Hide' => 'hide',
                    ),
                    'std'         => 'hide',
                    'description' => __( 'Choose whether or not to show the scroll prompt mouse at the bottom of this component.', 'text-domain' ),
                    'group' => 'Content',
                ),

                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'button-text',
                    'heading' => __( 'Button Text', 'text-domain' ),
                    'param_name' => 'buttontext',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Text for the button.', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'Content',
                    'dependency' => array(
                      'element' => 'buttonvisibility',
                      'value' => 'show'
                    )
                ),

                array(
                    'type' => 'vc_link',
                    'holder' => 'div',
                    'class' => 'button-link',
                    'heading' => __( 'Button Link (URL)', 'text-domain' ),
                    'param_name' => 'buttonlink',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'URL that you would like the button to link too.', 'text-domain' ),
                    'group' => 'Content',
                    'dependency' => array(
                      'element' => 'buttonvisibility',
                      'value' => 'show'
                    )
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Image Placement', 'text-domain' ),
                    'param_name' => 'imageplacement',
                    'value' => array(
                      'Left' => 'left',
                      'Right' => 'right',
                    ),
                    'std'         => 'left',
                    'description' => __( 'Choose whether you want the image on the left or right.', 'text-domain' ),
                    'group' => 'Design',
                ),

              )
          )
      );
    }


    // Element HTML
    public function slanted_image_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'backgroundcolour' => '',
                      'slanted_image' => '',
                      'colour_line' => '',
                      'colour_title' => '',
                      'buttonvisibility' => '',
                      'buttontext' => '',
                      'buttonlink' => '',
                      'imageplacement' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;
          $slanted_image_url = wp_get_attachment_image_src($slanted_image, 'full');
          $href = vc_build_link( $buttonlink );

          if($buttonvisibility == 'show') {
            $buttonoutput = '<a href=" ' . $href["url"] . ' ">
              <button type="button" class="hero-btn">
                ' . $buttontext . '
              </button>
            </a>';
          } else {
            $buttonoutput = '';
          }

          if($imageplacement == 'right') {
            $imageplacement_output = 'justify-content-start';
          } else {
            $imageplacement_output = 'justify-content-end';
          }

          // Fill $html var with data
          $html = '
          <div class="slanted-container" style="background-color: ' . $backgroundcolour . ';">
            <div class="slanted-image-container ' . $imageplacement . '">
              <div class="slanted-image d-none d-md-block ' . $colour_line . '">
                <div class="image" style="background-image: url(' . $slanted_image_url[0] . ');">
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row ' . $imageplacement_output . '">
                <div class="col-12 col-md-6 content-container">
                  <h2 class="slanted-text-title ' . $colour_title . '">
                    ' . $title . '
                  </h2>
                  <div class="content ' . $colour_title . '">
                    ' . $content . '
                    ' . $buttonoutput . '
                  </div>
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new slanted_image();

?>
