<?php
/*
Element Description: Basic Text
*/

// Element Class
class video_lightbox extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'video_lightbox_mapping' ) );
        add_shortcode( 'video_lightbox', array( $this, 'video_lightbox_html' ) );
    }

    // Element Mapping
    public function video_lightbox_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Video Lightbox', 'text-domain'),
              'base' => 'video_lightbox',
              'description' => __('This is a graphical component with a button to open a video.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/video-player.png',
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
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'video-url',
                    'heading' => __( 'Video URL', 'text-domain' ),
                    'param_name' => 'videourl',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Paste the URL from Vimeo for this video.', 'text-domain' ),
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
                   'type' => 'dropdown',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Component Height?', 'text-domain' ),
                   'param_name' => 'componentheight',
                   'value' => array(
                     'Choose Option' => 'default',
                     'Short' => 'short',
                     'Regular' => 'regular',
                     'Tall' => 'tall'
                   ),
                   'std'         => 'default',
                   'description' => __( 'Set the height of the component.', 'text-domain' ),
                   'group' => 'Design',
               ),

              )
          )
      );
    }


    // Element HTML
    public function video_lightbox_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'videourl'   => '',
                      'imageorcolour' => '',
                      'backgroundimage' => '',
                      'backgroundcolour' => '',
                      'componentheight' => '',
                  ),
                  $atts
              )
          );

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

          switch($componentheight) {
            case "default":
              $height = "tall";
            break;
            case "short":
              $height = "short";
            break;
            case "regular":
              $height = "regular";
            break;
            case "tall":
              $height = "tall";
            break;
            default:
              $height = "tall";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="video-lb-container ' . $height . '" style="' . $style . '">
            <div class="container">
              <div class="row align-items-center">
                <div class="col-12">
                  <h2 class="video-lb-title">
                    ' . $title . '
                  </h2>
                  <a href="' . $videourl . '" class="" data-fancybox>
                    <button type="button" class="hero-btn small">Watch Video</button>
                  </a>
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new video_lightbox();

?>
