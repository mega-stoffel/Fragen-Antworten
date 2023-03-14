<?php

global $fragen_antworten_db_version;
$fragen_antworten_db_version = '0.1';

function fragen_antworten_install()
{ 
    // hier werden die beiden "Custom Post Types" hinzugefügt:
    faFragen_setup_post_type(); 
    //faSterne_setup_post_type(); 

    // adding the dedicated SQL commands:
    //faSQL_setup(); 

    // Clear the permalinks after the post type has been registered.
    // flush_rewrite_rules(); (used to be here, tried it with the events-archive-issue)
    flush_rewrite_rules(false); 
}

function faFragen_setup_post_type() {
    $Fragen_Labels = array(
        'name'          => 'Fragen',
        'singular_name' => 'Frage',
        'search_items'  => 'Frage suchen',
        'all_items'     => 'Alle Fragen',
        'parent_item'   => 'Parent?',
        'parent_item_colon' => 'Parent?:',
        'edit_item'     => 'Frage bearbeiten',
        'update_item'   => 'Frage aktualisieren',
        'add_new_item'  => 'Neue Frage hinzufügen',
        'new_item_name' => 'Neue Frage',
        'menu_name'     => 'Fragen',
    );

    $Fragen_Options = array(
        'labels'      => $Fragen_Labels,
        'public'      => true,
        'has_archive' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-format-status',
        'supports' => ['title','editor','author','comments','page-attributes','post-formats'],
        'rewrite' => array( 'slug' => 'fragen', 'feeds' => 'true'), 
        'publicly_queryable' => true,
        'delete_with_user' => false,
        //this is the important line for the entries in the Block Editor!
        'show_in_rest' => true,
        'taxonomies' => array( 'category')
    );
    register_post_type( 'Fragen', $Fragen_Options); 
    // Fragen will be accessible with this URL: http://localhost:8888/?post_type=fragen
}

// Dann etwas ähnliches nochmal mit den Bewertungen, wobei hier wohl erst noch so Dinge wie "Taxonomie" gelernt werden muss.
//function faSterne_setup_post_type()
//{
//}

// Diese SQL Funktion wird evtl. benötigt, wenn ich Fragen mit Sternen verbinden will. Wer weiß, ob das nötig ist.
//function tallbike_Hardcoding_SQL () {
function faSQL_setup ()
{
    global $wpdb;
 
    $tablelinkBUE_name = $wpdb->prefix . "Link_Bike_User_Event"; 
    //global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql_link_bike_user_event = "CREATE TABLE $tablelinkBUE_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        bikeid mediumint(9) NOT NULL,
        userid mediumint(9) NOT NULL,
        eventid mediumint(9) NOT NULL,
        points real,
        --text text NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_link_bike_user_event );

 }
 
// ******************************
// Entering some example data
// ******************************

function fragen_antworten_install_data()
{

    global $wpdb;
	
	$table_name = $wpdb->prefix . 'Fragen';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'post_title' => "Was ist deine Lieblingsfarbe?",
		) 
	);
}

?>