<?php
/*
Element Description: Fullwidth Background Video
*/

// Element Class
class fw_bg_video extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'fw_bg_video_mapping' ) );
        add_shortcode( 'fw_bg_video', array( $this, 'fw_bg_video_html' ) );
    }

    // Element Mapping
    public function fw_bg_video_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Fullwidth Background Video', 'text-domain'),
              'base' => 'fw_bg_video',
              'description' => __('This is the background video component', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/video-camera.png',
              'params' => array(

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

              )
          )
      );
    }


    // Element HTML
    public function fw_bg_video_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'videourl'   => '',
                      'scrollprompt' => '',
                  ),
                  $atts
              )
          );

          switch($scrollprompt) {
            case "show":
              $visibility = "display: block;";
            break;

            case "hide":
              $visibility = "display: none;";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="video-bg-container" style="">
            <video playsinline autoplay muted loop poster="" id="bgvid">
              <source src="' . $videourl . '" type="video/webm">
            </video>
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
new fw_bg_video();


?>
