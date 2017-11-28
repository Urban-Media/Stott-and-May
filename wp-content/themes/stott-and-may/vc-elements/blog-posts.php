<?php
/*
Element Description: Blog Posts
*/

// Element Class
class blog_posts extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'blog_posts_mapping' ) );
        add_shortcode( 'blog_posts', array( $this, 'blog_posts_html' ) );
    }

    // Element Mapping
    public function blog_posts_mapping() {
      // Stop all if VC is not enabled
      if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
      }

      // Map the block with vc_map()
      vc_map(

          array(
              'name' => __('Blog Posts', 'text-domain'),
              'base' => 'blog_posts',
              'description' => __('This is the blog posts component', 'text-domain'),
              'category' => __('Custom Elements', 'text-domain'),
              'icon' => site_url().'/img/blog.png',
              'params' => array(

                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'title',
                    'heading' => __( 'Title', 'text-domain' ),
                    'param_name' => 'title',
                    'value' => __( '', 'text-domain' ),
                    'description' => __( 'Title for the blog post component.', 'text-domain' ),
                    'group' => 'Content',
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => 'bg_s',
                    'heading' => __( 'Show "S" in Background?', 'text-domain' ),
                    'param_name' => 'bg_s',
                    'value' => array(
                      'Choose Option' => 'choose_option',
                      'Show' => 'show',
                      'Hide' => 'hide',
                    ),
                    'description' => __( 'Option to show "S" in background of the blog post component.', 'text-domain' ),
                    'group' => 'Design',
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

              )
          )
      );
    }


    // Element HTML
    public function blog_posts_html( $atts ) {

      // Params extraction
          extract(
              shortcode_atts(
                  array(
                      'title'   => '',
                      'bg_s'   => '',
                      'backgroundcolour' => '',
                  ),
                  $atts
              )
          );

          $args = array( 'numberposts' => 3 );
          $lastposts = get_posts( $args );

          switch($bg_s) {
            case "show":
              $shows = "//192.168.1.45/Stott-and-May/img/background-s.png";
            break;

            case "hide":
              $shows = "";
            break;
          }

          // Fill $html var with data
          $html = '
          <div class="blog-posts-container" style="background-color: ' . $backgroundcolour . ';background-image: url(' . $shows . ');">
            <div class="container">
              <h2 class="blog-posts-title">
                ' . $title . '
              </h2>
              <div class="post-container">
                <div class="row">
                ';
                  foreach($lastposts as $post) : setup_postdata($post);
                  $categories = get_the_category($post->ID);
                  $permalink = get_permalink($post->ID);
                  $siteurl = site_url();

                $html .= '
                  <div class="col-12 col-sm-4">
                    <a href="' . $permalink . '">
                      <div class="blog-post">
                        <div class="blog-post-image" style="background-image: url(' . get_the_post_thumbnail_url($post) . ');">
                        </div>
                        <span>
                        ' . $categories[0]->name . '
                        </span>
                        <h3 class="post-title">
                          ' . $post->post_title . '
                        </h3>
                      </div>
                    </a>
                  </div>
                ';
                endforeach;
                $html .= '
                </div>
              </div>
              <a href="' . $siteurl . '/blog">
                <button class="hero-btn small">
                  View all blogs
                </button>
              </a>
            </div>
          </div>';

          return $html;
    }

} // End Element Class

// Element Class Init
new blog_posts();


?>
