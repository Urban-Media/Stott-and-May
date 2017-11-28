<?php
/*
Element Description: Fullwidth Background Video
*/

// Element Class
class resource_download extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'resource_download_mapping' ) );
        add_shortcode( 'resource_download', array( $this, 'resource_download_html' ) );
    }

    // Element Mapping
    public function resource_download_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Resource Download', 'text-domain'),
              'base' => 'resource_download',
              'description' => __('This is the resource download component with a resource image.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/download.png',
              'params' => array(

                  array(
                      'type' => 'textfield',
                      'holder' => 'div',
                      'class' => 'title',
                      'heading' => __( 'Title', 'text-domain' ),
                      'param_name' => 'title',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Title for the resource download component.', 'text-domain' ),
                      'group' => 'Content',
                  ),

                  array(
                      'type' => 'attach_image',
                      'holder' => 'div',
                      'class' => 'resource_image',
                      'heading' => __( 'Resource Image', 'text-domain' ),
                      'param_name' => 'resource_image',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Image to sit next to resource.', 'text-domain' ),
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
                      'description' => __( 'Add an image here to show in the background of the resource download component.', 'text-domain' ),
                      'group' => 'Design',
                  ),

                  array(
                      'type' => 'attach_image',
                      'holder' => 'div',
                      'class' => 'background-image',
                      'heading' => __( 'Background Image', 'text-domain' ),
                      'param_name' => 'backgroundimage',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Add an image here to show in the background of the resource download component.', 'text-domain' ),
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
                     'heading' => __( 'Dark or Light Title?', 'text-domain' ),
                     'param_name' => 'darkorlight',
                     'value' => array(
                       'Choose Option' => 'default',
                       'Dark' => 'dark',
                       'Light' => 'light'
                     ),
                     'std'         => 'default',
                     'description' => __( 'This will change the colour of the title between dark to light.', 'text-domain' ),
                     'group' => 'Design',
                 ),

              )
          )
      );
    }


    // Element HTML
    public function resource_download_html( $atts, $content ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'resource_image' => '',

                      'imageorcolour' => '',
                      'backgroundimage' => '',
                      'backgroundcolour' => '',
                      'darkorlight' => '',
                  ),
                  $atts
              )
          );
          $atts['content'] = $content;

          $resourceimage_url = wp_get_attachment_image_src($resource_image, 'full');

          switch($imageorcolour) {
            case "bgimage":
              $backgroundimage_url = wp_get_attachment_image_src($backgroundimage, 'full');
              $style = "background-image: url(" . $backgroundimage_url[0] . ");";
            break;

            case "colour":
              $style = "background-color:" . $backgroundcolour . ";";
            break;

            default:
              $style = "background-color: #ebebeb;";
            break;
          }

          switch($darkorlight) {
            case "light":
              $light_class = "white";
            break;
            case "dark":
              $light_class = "dark";
            break;
            default:
              $light_class = "dark";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="resource-download-container" style="' . $style . '">
            <div class="container">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h2 class="resource-download-title ' . $light_class . '">
                    ' . $title . '
                  </h2>
                  <div class="content_container">
                    ' . $content . '
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <img src="' . $resourceimage_url[0] . '">
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new resource_download();


?>
