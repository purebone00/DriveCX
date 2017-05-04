<?php
//this function sends the email
function send_mail(){
	
		$avg_check    = $_POST["cf-averageCheck"];
		$avg_custNo    = $_POST["cf-averageCustNo"];
		$f_name    = $_POST["cf-fName"];
		$l_name    = $_POST["cf-lName"];
		$email   = $_POST["cf-email"];
		$companyName = $_POST["cf-companyName"];
		$subject = 'DriveCX ROI Report for ' . $f_name . " " . $l_name;
		$message = 'average check = ' . $avg_check . "\r\n";
		$message .= 'average cust no = ' . $avg_custNo . "\r\n";
		$message .= 'firstname = ' . $f_name . "\r\n";
		$message .= 'lastname = ' . $l_name . "\r\n";
		$message .= 'email = ' . $email . "\r\n";
		$message .= 'company name = ' . $companyName . "\r\n";
	
		$to = $email;

		// If email has been process for sending, display a success message
		if ( mail( $to, $subject, $message) ) {
			echo '<div>';
			echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
		
	send_deal($email);	
			
}


function calculate(){
	
}
?>