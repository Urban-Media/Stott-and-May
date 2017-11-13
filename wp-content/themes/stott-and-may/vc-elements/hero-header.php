<?php
/*
Element Description: VC Info Box
*/

// Element Class
class vcInfoBox extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
    }

    // Element Mapping
    public function vc_infobox_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Page Header', 'text-domain'),
              'base' => 'vc_infobox',
              'description' => __('This is the header component for all pages', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/header.png',
              'params' => array(

                  array(
                      'type' => 'textfield',
                      'holder' => 'h3',
                      'class' => 'primary-header-title',
                      'heading' => __( 'Header Title', 'text-domain' ),
                      'param_name' => 'headertitle',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'This is the primary title for the page header element.', 'text-domain' ),
                      'admin_label' => false,
                      'weight' => 0,
                      'group' => 'Content',
                  ),

                  array(
                      'type' => 'textarea',
                      'holder' => 'div',
                      'class' => 'header-content',
                      'heading' => __( 'Header Content', 'text-domain' ),
                      'param_name' => 'headercontent',
                      'value' => __( '<p>Lorem ipsum</p>', 'text-domain' ),
                      'description' => __( 'This is a block of text that displays below the title. NOTE: Leave blank if you do not want this.', 'text-domain' ),
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
                      'description' => __( 'Add an image here to show in the background of the header element.', 'text-domain' ),
                      'group' => 'Design',
                  ),

                  array(
                      'type' => 'attach_image',
                      'holder' => 'div',
                      'class' => 'header-background',
                      'heading' => __( 'Header Background Image', 'text-domain' ),
                      'param_name' => 'headerbackgroundimage',
                      'value' => __( '', 'text-domain' ),
                      'description' => __( 'Add an image here to show in the background of the header element.', 'text-domain' ),
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
                    "heading" => __( "Header Background Colour", "my-text-domain" ),
                    "param_name" => "headerbackgroundcolour",
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
                     'heading' => __( 'Scroll Prompt Visibility', 'text-domain' ),
                     'param_name' => 'scrollprompt',
                     'value' => array(
                       'Show' => 'show',
                       'Hide' => 'hide',
                     ),
                     'std'         => 'show',
                     'description' => __( 'Choose whether or not to show the scroll prompt mouse at the bottom of this component.', 'text-domain' ),
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

              )
          )
      );
    }


    // Element HTML
    public function vc_infobox_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'headertitle'   => '',
                      'headercontent'   => '',
                      'imageorcolour' => '',
                      'headerbackgroundimage' => '',
                      'headerbackgroundcolour' => '',
                      'scrollprompt' => '',
                      'buttonvisibility' => '',
                      'buttontext' => '',
                      'buttonlink' => '',
                  ),
                  $atts
              )
          );

          $href = vc_build_link( $buttonlink );

          switch($imageorcolour) {
            case "bgimage":
              $backgroundimage = wp_get_attachment_image_src($headerbackgroundimage, 'full');
              $style = "background-image: url(" . $backgroundimage[0] . ");";
            break;

            case "colour":
              $style = "background-color:" . $headerbackgroundcolour . ";";
            break;

            default:
              $style = "background-color: #ebebeb;";
            break;
          }

          switch($scrollprompt) {
            case "show":
              $visibility = "display: block;";
            break;

            case "hide":
              $visibility = "display: none;";
            break;
          }

          if($buttonvisibility == 'show') {
            $buttonoutput = '<a href=" ' . $href["url"] . ' ">
              <button type="button" class="hero-btn">
                ' . $buttontext . '
              </button>
            </a>';
          } else {
            $buttonoutput = '';
          }

          // Fill $html var with data
          $html = '
          <div class="page-header-container" style="' . $style . '">
            <div class="header-content">
              <div class="container">
                <div class="row">
                  <div class="col-sm-6">
                    <h1 class="header-title">' . $headertitle . '</h1>
                    <div class="header-text">' . $headercontent . '</div>
                      ' . $buttonoutput . '
                  </div>
                </div>
              </div>
            </div>
            <div class="scroll-prompt-container" style="' . $visibility . '">
              <figure class="prompt">
                <span>
                </span>
              </figure>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new vcInfoBox();


?>
