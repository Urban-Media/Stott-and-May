<?php
/*
Element Description: Slideshow
*/

// Element Class
class slideshow extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'slideshow_mapping' ) );
        add_shortcode( 'slideshow', array( $this, 'slideshow_html' ) );
    }

    // Element Mapping
    public function slideshow_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Slideshow', 'text-domain'),
              'base' => 'slideshow',
              'description' => __('This is a slideshow component with text next to it.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/slideshow-presentation.png',
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

               array(
                   'type' => 'param_group',
                   'heading' => 'Slide',
                   'param_name' => 'slide',
                   'value' => '',
                   'group' => 'Content',
                   'params' => array(
                     array(
                       'type' => 'attach_image',
                       'value' => '',
                       'heading' => 'Slide Image',
                       'param_name' => 'slide-image',
                     )
                   ),
               ),
             )
         )
     );
   }


    // Element HTML
    public function slideshow_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'imageorcolour' => '',
                      'backgroundimage' => '',
                      'backgroundcolour' => '',
                      'slide' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;
          $slide_loop = vc_param_group_parse_atts( $atts['slide'] );

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
          <script>
            jQuery(document).ready(function($){
              $(".slider").bxSlider();
            });
          </script>
          <div class="slideshow-container" style="' . $style . '">
            <div class="container">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <h2 class="slideshow-title">
                    ' . $title . '
                  </h2>
                  <div class="content_container">
                    ' . $content . '
                  </div>
                </div>
                <div class="col-12 col-sm-8">
                  <div class="slider">';
                    foreach( $slide_loop as $val ) {
                    $slide_image_output = wp_get_attachment_image_src( $val['slide-image'], 'full');
                    $html .= '
                    <div class="">
                        <img class="icon-image" src="' . $slide_image_output[0] . '" width="" height="">
                    </div>';
                    }
                    $html .= '
                  </div>
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new slideshow();

?>
