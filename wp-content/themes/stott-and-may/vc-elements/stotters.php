<?php
/*
Element Description: Stotters
*/

// Element Class
class stotters extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'stotters_mapping' ) );
        add_shortcode( 'stotters', array( $this, 'stotters_html' ) );
    }

    // Element Mapping
    public function stotters_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      $stotters_tax = get_terms(
          array (
            'taxonomy' => 'markets',
            'hide_empty' => false
            )
      );
      //var_dump($stotters_tax);

      $stottersOptions = array(
        'Choose Options' => 'default'
      );

      foreach($stotters_tax as $tax) {
        /*$newOptions = $tax->slug => $tax->name;
        array_push($stottersOptions, $newOptions);*/
        $newRow = array($tax->name => $tax->slug);
        $stottersOptions += $newRow;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Stotters', 'text-domain'),
              'base' => 'stotters',
              'description' => __('Display Stotters from different markets.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/standing-up-man.png',
              'params' => array(

                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'title',
                    'heading' => __( 'Title', 'text-domain' ),
                    'param_name' => 'title',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Title for the Stotters component.', 'text-domain' ),
                    'group' => 'Content',
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Market?', 'text-domain' ),
                    'param_name' => 'market_selection',
                    'value' => $stottersOptions,
                    'std'         => 'default',
                    'description' => __( 'Choose between a background colour or image.', 'text-domain' ),
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
    public function stotters_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'market_selection' => '',
                      'imageorcolour' => '',
                      'backgroundimage' => '',
                      'backgroundcolour' => '',
                  ),
                  $atts
              )
          );

          $args = array(
            'numberposts' => 0,
            'order' => 'ASC',
            'post_type' => 'stotters',
            'markets' => $market_selection,
          );
          $lastposts = get_posts( $args );

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
          <div class="stotters-container" style="' . $style . '">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h2 class="stotters-title">
                    ' . $title . '
                  </h2>
                </div>
              </div>
              <div class="post-container">
                <div class="row">
                ';
                  foreach($lastposts as $post) : setup_postdata($post);
                  $categories = get_the_category($post->ID);
                  $permalink = get_permalink($post->ID);
                  $siteurl = site_url();
                  $jobrole = get_field('job_role', $post->ID);

                $html .= '
                  <div class="col-12 col-sm-4">
                    <a href="' . $permalink . '">
                      <div class="stotter">
                        <div class="blog-post-image" style="background-image: url(' . get_the_post_thumbnail_url($post) . ');">
                          <div class="stotter-overlay">
                            <div class="stotter-info">
                              <h3 class="post-title">
                                ' . $post->post_title . '
                              </h3>
                              <h4>' . $jobrole . '</h4>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                ';
                endforeach;
                $html .= '
                </div>
              </div>
              <center>
                <a href="' . $siteurl . '/stotters">
                  <button class="hero-btn small">
                    Meet all the Stotters
                  </button>
                </a>
              </center>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new stotters();


?>
