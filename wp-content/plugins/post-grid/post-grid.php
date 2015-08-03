<?php
/*
Plugin Name: Post Grid
Plugin URI: http://paratheme.com
Description: Awesome post grid for query post from any post-type and display on grid.
Version: 1.3
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('post_grid_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('post_grid_plugin_dir', plugin_dir_path( __FILE__ ) );
define('post_grid_wp_url', 'https://wordpress.org/plugins/post-grid/' );
define('post_grid_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/post-grid' );
define('post_grid_pro_url','http://paratheme.com/items/post-grid-awesome-grid-for-any-post-type/' );
define('post_grid_demo_url', 'http://paratheme.com/demo/post-grid/' );
define('post_grid_conatct_url', 'http://paratheme.com/contact/' );
define('post_grid_qa_url', 'http://paratheme.com/qa/' );
define('post_grid_plugin_name', 'Post Grid' );
define('post_grid_share_url', 'https://wordpress.org/plugins/post-grid/' );
define('post_grid_tutorial_video_url', '//www.youtube.com/embed/JsDfu6LXtj4?rel=0' );



require_once( plugin_dir_path( __FILE__ ) . 'includes/post-grid-meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/post-grid-functions.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/PostGridClass.php');

//Themes php files

require_once( plugin_dir_path( __FILE__ ) . 'themes/flat/index.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/rounded/index.php');




function post_grid_init_scripts()
	{
		wp_enqueue_script('jquery');

		wp_enqueue_style('post_grid_style', post_grid_plugin_url.'css/style.css');
		wp_enqueue_script('masonry.pkgd.min', plugins_url( '/js/masonry.pkgd.min.js' , __FILE__ ) , array( 'jquery' ));
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', post_grid_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
		// Style for themes
		wp_enqueue_style('post-grid-style-flat', post_grid_plugin_url.'themes/flat/style.css');			
		wp_enqueue_style('post-grid-style-rounded', post_grid_plugin_url.'themes/rounded/style.css');			

		
	}
add_action("init","post_grid_init_scripts");









function post_grid_admin_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
						
		wp_enqueue_script('post_grid_admin_js', plugins_url( '/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));

		wp_enqueue_style('post_grid_admin_style', post_grid_plugin_url.'admin/css/style.css');

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', post_grid_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaIcons', post_grid_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
	
	
	
	}



add_action( 'admin_enqueue_scripts', 'post_grid_admin_scripts' );



// to work upload button on user profile
add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 


register_activation_hook(__FILE__, 'post_grid_activation');


function post_grid_activation()
	{
		$post_grid_version= "1.3";
		update_option('post_grid_version', $post_grid_version); //update plugin version.
		
		$post_grid_customer_type= "free"; //customer_type "free"
		update_option('post_grid_customer_type', $post_grid_customer_type); //update plugin version.

	}


function post_grid_display($atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'id' => "",

				), $atts);


			$post_id = $atts['id'];

			$post_grid_themes = get_post_meta( $post_id, 'post_grid_themes', true );

			$html = '';

			if($post_grid_themes== "flat")
				{
					$html.= post_grid_themes_flat($post_id);
				}
			
			elseif($post_grid_themes== "rounded")
				{
					$html.= post_grid_themes_rounded($post_id);
				}				
	
			else
				{
					$html.= post_grid_themes_flat($post_id);
				}					
							

			return $html;





}

add_shortcode('post_grid', 'post_grid_display');




add_action('admin_menu', 'post_grid_menu_init');

function post_grid_menu_help(){
	include('post-grid-help.php');	
}




function post_grid_menu_init() {
	add_submenu_page('edit.php?post_type=post_grid', __('Help','post_grid'), __('Help','post_grid'), 'manage_options', 'post_grid_menu_help', 'post_grid_menu_help');

}






?>