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
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => 'show_title',
                    'heading' => __( 'Show Title?', 'text-domain' ),
                    'param_name' => 'show_title',
                    'value' => array(
                      'Choose Option' => 'choose_option',
                      'Show' => 'show',
                      'Hide' => 'hide',
                    ),
                    'description' => __( 'Option to show title at top of carousel component.', 'text-domain' ),
                    'group' => 'Content',
                ),

                  array(
                      'type' => 'textfield',
                      'holder' => 'div',
                      'class' => 'title',
                      'heading' => __( 'Title', 'text-domain' ),
                      'param_name' => 'title',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Title for the blog post component.', 'text-domain' ),
                      'group' => 'Content',
                      "dependency" => array(
                          "element" => "show_title",
                          "value" => "show"
                      )
                  ),

                  array(
                      'type' => 'dropdown',
                      'holder' => 'div',
                      'class' => 'show_button',
                      'heading' => __( 'Show Button?', 'text-domain' ),
                      'param_name' => 'show_button',
                      'value' => array(
                        'Choose Option' => 'choose_option',
                        'Show' => 'show',
                        'Hide' => 'hide',
                      ),
                      'description' => __( 'Option to show button below carousel of icons.', 'text-domain' ),
                      'group' => 'Content',
                  ),

                  array(
                      'type' => 'textfield',
                      'holder' => 'div',
                      'class' => 'button_text',
                      'heading' => __( 'Button Text', 'text-domain' ),
                      'param_name' => 'button_text',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Text for button.', 'text-domain' ),
                      'group' => 'Content',
                      "dependency" => array(
                          "element" => "show_button",
                          "value" => "show"
                      )
                  ),

                  array(
                      'type' => 'vc_link',
                      'holder' => 'div',
                      'class' => 'button_URL',
                      'heading' => __( 'Button URL', 'text-domain' ),
                      'param_name' => 'button_url',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Where should this button go?.', 'text-domain' ),
                      'group' => 'Content',
                      "dependency" => array(
                          "element" => "show_button",
                          "value" => "show"
                      )
                  ),

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
                      'show_title' => '',
                      'title'   => '',
                      'icon' => '',
                      'backgroundcolour' => '',
                      'show_button' => '',
                      'button_text' => '',
                      'button_url' => '',
                  ),
                  $atts
              )
          );

          $href_btn = vc_build_link($button_url);
          $icons_loop = vc_param_group_parse_atts( $atts['icon'] );
          $show_title_html = ($show_title == "show") ? '<div class="container"><h2 class="icon-carousel-title">' . $title . '</h2></div>' : '';
          $show_button_html = ($show_button == "show") ? '<div class="container"><center><a href="' . $href_btn["url"] . '"><button class="hero-btn small">' . $button_text . '</button></a></center></div>' : '';

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
            ' . $show_title_html . '
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
            ' . $show_button_html . '
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new icon_carousel();


?>
