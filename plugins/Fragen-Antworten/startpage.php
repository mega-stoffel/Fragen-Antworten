<?php
/*
Plugin Name:  Fragen-Antworten Plugin
Plugin URI:   https://github.com/mega-stoffel/fragen-antworten
Description:  Wöchentliche Fragen stellen, bewerten und beantworten
Version:      0.1
Author:       X-tof Hoyer
Author URI:   https://coverd.mega-stoffel.de
*/

// Keine Ahnung, was das hier ist?
/*if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}

// Keine Ahnung, was das hier ist?
$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
check_admin_referer( "activate-plugin_{$plugin}" );*/

//These two lines define my own theme output:
//define('TALLBIKE_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
//require_once TALLBIKE_PLUGIN_PATH.'/libs/register_custom_theme_files.php';

// damit kann man wohl etwas "installieren", wenn das Plugin aktiviert wird
register_activation_hook( __FILE__ , 'fragen_antworten_install' );
//register_activation_hook( __FILE__ , 'tallbike_install_data' );

// hier werden wohl die Datentypen und Shortcode Definitionen festgelegt:
add_action( 'init', 'faFragen_setup_post_type');
//add_action( 'init', 'faSterne_setup_post_type');
add_action( 'init', 'fragen_antworten_shortcodes_init');

//todo: this doesn't seem to work!
register_deactivation_hook( __FILE__ , 'fragen_antworten_delete' );


// hmmmmmm?
// This function adds bikes and events to the regular posts query!
// I guess, I need to write my own widgets/pages for my custom post types....
function wporg_add_custom_post_types($query) {
  if ( is_home() && $query->is_main_query() ) {
      $query->set( 'post_type', array( 'fragen', 'sterne' ) );
  }
  return $query;
}
add_action('pre_get_posts', 'wporg_add_custom_post_types');

/* here's all installation related stuff, creating new tables, etc */
include "install/fragen-antworten-installation.php";

// -----------------------------------
//       S H O R T C O D E S
// -----------------------------------
require_once( 'fragen-antworten-shortcodes.php');

add_shortcode('fa_tester', 'fa_tester');




function must_login_first() {
   echo "You must log in to interact on this website!";
   die();
}


// -----------------------------------
//     P A G E T E M P L A T E S
// -----------------------------------
//require_once( 'libs/fa-pagetemplates.php' );



// ---------------------------------
//       W I D G E T S 
// ---------------------------------
// require_once( 'libs/tb-widgets.php' );
// Register my widget for all future Events
// function tb_future_events_widget() {
// 	register_widget( 'Future_Events' );
// }
// add_action( 'widgets_init', 'tb_future_events_widget' );




?>