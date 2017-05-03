<?php
   /*
   Plugin Name: ROI CALCULATOR PLUGIN
   Plugin URI: vince.life/drivecx
   Description: This will calculate ROI
   Version: 1.2
   Author: Team 43
   Author URI: vince.life
   License: GPL2
   */
require_once('html_form.php');    
require_once('send_email.php');	
require_once('send_deal.php');

//start of plugin once shortcode is called
function cf_shortcode() {
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	ob_start();
	send_mail();
	return ob_get_clean();
	}
	else{
	html_form_code();
	}
}

add_shortcode( 'sitepoint_contact_form', 'cf_shortcode' );
?>