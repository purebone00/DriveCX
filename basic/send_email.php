<?php
//this function sends the email
function send_mail() {

	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {

		// sanitize form values
		$f_name    = sanitize_text_field( $_POST["cf-fname"] );
		$l_name    = sanitize_text_field( $_POST["cf-lname"] );
		$email   = sanitize_email( $_POST["cf-email"] );
		$subject = sanitize_text_field( $_POST["cf-subject"] );
		$message = esc_textarea( $_POST["cf-message"] );

		// get the blog administrator's email address
		//$to = get_option( 'admin_email' );
		$to = $email;
		$headers = "From: $name <$email>" . "\r\n";

		// If email has been process for sending, display a success message
		if ( wp_mail( $to, $subject, $message) ) {
			echo '<div>';
			echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
	}
	


//wp_mail( $to, $subject, $message );
send_deal($email);
}


function calculate(){
	
}
?>