<?php
/*
Element Description: Fullwidth Background Video
*/

// Element Class
class icon_carousel extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'icon_carousel_mapping' ) );
        add_shortcode( 'icon_carousel', array( $this, 'icon_carousel_html' ) );
    }

    // Element Mapping
    public function icon_carousel_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Icon Carousel', 'text-domain'),
              'base' => 'icon_carousel',
              'description' => __('This is the scrolling icon carousel component', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/horse-carousel.png',
              'params' => array(

                  array(
                      'type' => 'param_group',
                      'heading' => 'Icon',
                      'param_name' => 'icon',
                      'value' => '',
                      'group' => 'Content',
                      'params' => array(
                        array(
                          'type' => 'textfield',
                          'value' => '',
                          'heading' => 'Title',
                          'param_name' => 'title',
                        ),
                        array(
                          'type' => 'attach_image',
                          'value' => '',
                          'heading' => 'Icon Image',
                          'param_name' => 'icon-image',
                        ),
                        array(
                          'type' => 'vc_link',
                          'value' => '',
                          'heading' => 'Page Link',
                          'param_name' => 'page-link',
                        )
                      ),
                  ),

                  array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Background Colour", "my-text-domain" ),
                    "param_name" => "backgroundcolour",
                    "value" => '', //Default Red color
                    "description" => __( "Choose background colour.", "my-text-domain" ),
                    'group' => 'Design'
                 ),

              )
          )
      );
    }


    // Element HTML
    public function icon_carousel_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'videourl'   => '',
                      'icon' => '',
                      'backgroundcolour' => '',
                  ),
                  $atts
              )
          );

          $icons_loop = vc_param_group_parse_atts( $atts['icon'] );
          // Fill $html var with data
          $html = '
          <script>
            jQuery(document).ready(function($){
              $(".owl-carousel").owlCarousel({
                nav: true,
                dots: false,
                responsiveClass:true,
                responsive:{
                  0:{
                    items:1,
                  },
                  600:{
                    items:3,
                  },
                  1000:{
                    items:5,
                  }
                }
              });
            });
          </script>
          <div class="icon-carousel-container" style="background-color:' . $backgroundcolour . ';">
            <div class="owl-carousel owl-theme">';
              foreach( $icons_loop as $val ) {
              $href = vc_build_link( $val['page-link'] );
              $icon_image_output = wp_get_attachment_image_src( $val['icon-image'], 'full');
              $html .= '<div class="item">
                <a href="' . $href["url"] . '">
                  <img class="icon-image" src="' . $icon_image_output[0] . '" width="108" height="108">
                  <h4>' . $val["title"] . '</h4>
                </a>
              </div>';
              }
            $html .= '</div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new icon_carousel();


?>
