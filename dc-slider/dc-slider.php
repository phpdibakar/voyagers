<?php
/* 
	Plugin Name: DC Slider
	Plugin URI: http://dcweb.in/
	Description: Slider Component for WordPress
	Version: 1.0
	Author: Dibakar Chakraborty
	Author URI: http://dcweb.in/
	License: GPLv2 or later
*/

function dc_slider_activation(){
	global $wpdb;

	$sql = "CREATE TABLE IF NOT EXISTS ". $wpdb->prefix. "dc_slider(
		id INT(11) NOT NULL AUTO_INCREMENT,
		title VARCHAR(100) NOT NULL,
		sub_title VARCHAR(255) NULL,
		img VARCHAR(255) NOT NULL,
		PRIMARY KEY(id)
		)ENGINE=MYISAM;";
	
	$wpdb->query($sql);
}

function dc_slider_deactivation(){
	global $wpdb;
	
	$sql = "DROP TABLE IF EXISTS ". $wpdb->prefix. "dc_slider;";
	
	$wpdb->query($sql);
}

register_activation_hook(__FILE__, "dc_slider_activation" );
register_deactivation_hook(__FILE__, "dc_slider_deactivation" );

add_action('admin_menu','dc_register_slider_admin_interface');

function dc_register_slider_admin_interface(){
	if ( is_admin() ) {
		add_menu_page('Dc Slider','Dc Slider','manage_options','dc-slider','dc_slider_manager');
	}
}

function dc_slider_manager(){
	if( !current_user_can('manage_options') )
		wp_die( __('You are not authorized to access this section'));
	
	require_once 'libraries/Slider.php';
	$basedir = dirname( __FILE__ );
	new Slider($basedir);
}
?>