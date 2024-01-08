<?php
/*
 * Plugin Name:       new_slider
 * Plugin URI:        https://newslider.com
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            K.M Nazmul Huda
 * Author URI:        https://nazmul.khan121@gmail.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-basics-plugin
 * Domain Path:       new_slider
 */

 class new_slider{

    public function __construct(){
        // Hook the method to 'init'
        add_action( 'init', [ $this, 'cptui_register_my_cpts_slider' ] );
        add_action('wp_enqueue_scripts', [$this, 'new_slider_scripts_function']);
        add_shortcode('new-slider',array($this, 'new_slider_shortcode'));
    }

    public function new_slider_shortcode(){
        ?>
            <ul class="bxslider">
                <?php 
                    $slider = new WP_Query(array(
                        'post_type' => 'slider',
                    ));
                ?>
                <?php while($slider->have_posts()) :$slider->the_post(); ?>
                <li>
                    <img src="<?php the_post_thumbnail_url();?>" />
                </li>
                <?php endwhile;?>
            </ul>

        <?php
    }
        
    public function new_slider_scripts_function() {
        wp_enqueue_style('new-slider-style', plugins_url('css/jquery.bxslider.css', __FILE__));
        wp_enqueue_script('new-slider-script', plugins_url('js/jquery.bxslider.min.js', __FILE__), array('jquery'),false);
        wp_enqueue_script('custom-script', plugins_url('js/script.js', __FILE__), array('jquery'),false);
    }
    
   public function cptui_register_my_cpts_slider() {

        /**
         * Post Type: Sliders.
         */
    
        $labels = [
            "name" => esc_html__( "Sliders", "philosophy-blog" ),
            "singular_name" => esc_html__( "Slider", "philosophy-blog" ),
            "all_items" => esc_html__( "All Slider", "philosophy-blog" ),
            "add_new" => esc_html__( "Add New Slider", "philosophy-blog" ),
        ];
    
        $args = [
            "label" => esc_html__( "Sliders", "philosophy-blog" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => [ "slug" => "slider", "with_front" => true ],
            "query_var" => true,
            "menu_icon" => "dashicons-slides",
            "supports" => [ "title", "editor", "thumbnail" ],
            "show_in_graphql" => false,
            "menu_position"  => 6,
        ];
    
        register_post_type( "slider", $args );
    }
    
    
    
    
 }
 
// Instantiate the class
$new_slider = new new_slider();

