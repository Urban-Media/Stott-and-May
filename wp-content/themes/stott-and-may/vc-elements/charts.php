<?php
/*
Element Description: Basic Text
*/

// Element Class
class charts extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'charts_mapping' ) );
        add_shortcode( 'charts', array( $this, 'charts_html' ) );
    }

    // Element Mapping
    public function charts_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Charts', 'text-domain'),
              'base' => 'charts',
              'description' => __('This is a component that includes 3 charts.', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/pie-chart.png',
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
                   'heading' => __( 'Star Rating 1 Visibility', 'text-domain' ),
                   'param_name' => 'star_rating_1_visibility',
                   'value' => array(
                     'Show' => 'show',
                     'Hide' => 'hide',
                   ),
                   'std'         => 'hide',
                   'description' => __( 'Choose whether or not to show star rating that will appear on the left.', 'text-domain' ),
                   'group' => 'Content',
               ),

               array(
                   'type' => 'textfield',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Star Rating 1 Title', 'text-domain' ),
                   'param_name' => 'star_rating_1_title',
                   'value' => __( '', 'text-domain' ),
                   'description' => __( 'Title for star rating 1.', 'text-domain' ),
                   'admin_label' => false,
                   'weight' => 0,
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'star_rating_1_visibility',
                     'value' => 'show'
                   )
               ),

               array(
                   'type' => 'dropdown',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Rating', 'text-domain' ),
                   'param_name' => 'star_rating_1_rating',
                   'value' => array(
                     'Choose Option' => 'default',
                     '1 Star' => 'one_star',
                     '2 Star' => 'two_star',
                     '3 Star' => 'three_star',
                     '4 Star' => 'four_star',
                     '5 Star' => 'five_star',
                   ),
                   'std'         => 'hide',
                   'description' => __( 'Choose how many stars you wish to highlight.', 'text-domain' ),
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'star_rating_1_visibility',
                     'value' => 'show'
                   )
               ),

               array(
                   'type' => 'dropdown',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Star Rating 2 Visibility', 'text-domain' ),
                   'param_name' => 'star_rating_2_visibility',
                   'value' => array(
                     'Show' => 'show',
                     'Hide' => 'hide',
                   ),
                   'std'         => 'hide',
                   'description' => __( 'Choose whether or not to show star rating that will appear on the right.', 'text-domain' ),
                   'group' => 'Content',
               ),

               array(
                   'type' => 'textfield',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Star Rating 2 Title', 'text-domain' ),
                   'param_name' => 'star_rating_2_title',
                   'value' => __( '', 'text-domain' ),
                   'description' => __( 'Title for star rating 2.', 'text-domain' ),
                   'admin_label' => false,
                   'weight' => 0,
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'star_rating_2_visibility',
                     'value' => 'show'
                   )
               ),

               array(
                   'type' => 'dropdown',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Rating', 'text-domain' ),
                   'param_name' => 'star_rating_2_rating',
                   'value' => array(
                     'Choose Option' => 'default',
                     '1 Star' => 'one_star',
                     '2 Star' => 'two_star',
                     '3 Star' => 'three_star',
                     '4 Star' => 'four_star',
                     '5 Star' => 'five_star',
                   ),
                   'std'         => 'hide',
                   'description' => __( 'Choose how many stars you wish to highlight.', 'text-domain' ),
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'star_rating_2_visibility',
                     'value' => 'show'
                   )
               ),

               array(
                   'type' => 'dropdown',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Main Chart Visibility', 'text-domain' ),
                   'param_name' => 'main_chart_visibility',
                   'value' => array(
                     'Show' => 'show',
                     'Hide' => 'hide',
                   ),
                   'std'         => 'hide',
                   'description' => __( 'Choose whether or not to show the main donut chart in the center.', 'text-domain' ),
                   'group' => 'Content',
               ),

               array(
                   'type' => 'textfield',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Main Chart Title', 'text-domain' ),
                   'param_name' => 'main_chart_title',
                   'value' => __( '', 'text-domain' ),
                   'description' => __( 'Title for main chart.', 'text-domain' ),
                   'admin_label' => false,
                   'weight' => 0,
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'main_chart_visibility',
                     'value' => 'show'
                   )
               ),

               array(
                   'type' => 'textfield',
                   'holder' => 'div',
                   'class' => '',
                   'heading' => __( 'Main Chart Value', 'text-domain' ),
                   'param_name' => 'main_chart_value',
                   'value' => __( '', 'text-domain' ),
                   'description' => __( 'Value for main chart. Enter a value between -100 and 100. (0 is the center point)', 'text-domain' ),
                   'admin_label' => false,
                   'weight' => 0,
                   'group' => 'Content',
                   'dependency' => array(
                     'element' => 'main_chart_visibility',
                     'value' => 'show'
                   )
               ),

              )
          )
      );
    }


    // Element HTML
    public function charts_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'imageorcolour' => '',
                      'backgroundimage' => '',
                      'backgroundcolour' => '',
                      'colour_title' => '',
                      'star_rating_1_visibility' => '',
                      'star_rating_1_title' => '',
                      'star_rating_1_rating' => '',
                      'star_rating_2_visibility' => '',
                      'star_rating_2_title' => '',
                      'star_rating_2_rating' => '',
                      'main_chart_visibility' => '',
                      'main_chart_title' => '',
                      'main_chart_value' => '',
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

          if($star_rating_1_visibility == 'show') {
            $star_1_output = '
            <h3 class="star_title">' . $star_rating_1_title . '</h3>
            <div class="stars star-rating-1 ' . $star_rating_1_rating . '">
            <i class="icon-star icons star1"></i>
            <i class="icon-star icons star2"></i>
            <i class="icon-star icons star3"></i>
            <i class="icon-star icons star4"></i>
            <i class="icon-star icons star5"></i>
            </div>';
          } else {
            $star_1_output = '';
          }

          if($star_rating_2_visibility == 'show') {
            $star_2_output = '
            <h3 class="star_title">' . $star_rating_2_title . '</h3>
            <div class="stars star-rating-2 ' . $star_rating_2_rating . '">
            <i class="icon-star icons star1"></i>
            <i class="icon-star icons star2"></i>
            <i class="icon-star icons star3"></i>
            <i class="icon-star icons star4"></i>
            <i class="icon-star icons star5"></i>
            </div>';
          } else {
            $star_2_output = '';
          }

          if($main_chart_visibility == 'show') {
            $chart_output = '
            <div class="wrapper ' . $colour_title . '">
              <h6>0</h6>
              <div class="container chart" data-size="360" data-value="' . $main_chart_value . '" data-arrow=""></div>
              <h6>-100 &nbsp; &nbsp; 100</h6>
              <h4>' . $main_chart_title . '</h4>
            </div>
            ';
          } else {
            $chart_output = '';
          }


          // Fill $html var with data
          $html = '
          <div class="chart-container" style="' . $style . ';">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12 col-sm-8">
                  <h2 class="chart-title ' . $colour_title . '">
                    ' . $title . '
                  </h2>
                </div>
              </div>
              <div class="row">
                <div class="order-sm-12 order-md-12 order-lg-first order-xl-first col-12 col-sm-12 col-md-6 col-lg-3 col-xl-4 align-self-center ' . $colour_title . '">
                  ' . $star_1_output . '
                </div>
                <div class="order-first col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 align-self-center ">
                  ' . $chart_output . '
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-4 align-self-center ' . $colour_title . '">
                  ' . $star_2_output . '
                </div>
              </div>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new charts();

?>
