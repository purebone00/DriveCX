<?php

//Mail Chimp documentation:
/**curl --request GET \
--url 'https://usX.api.mailchimp.com/3.0/templates/2000094' \
--user 'anystring:apikey' \
--include
*/

/**
2a2aabc6bee455d3a0fa3068b85df27f-us15
*/

if(isset($_POST['cf-submitted'])){

	$f_name = $_POST["cf-fName"];
	$l_name = $_POST["cf-lName"];


	function calculate(){
		
		$fullService = isset($_POST["cf-full-service"]);
	
		$avg_check    = $_POST["cf-averageCheck"];
		$avg_custNo   = $_POST["cf-averageCustNo"];
	
	
	
		$driveSubCost = 199;
		$quickRatingPercent = ($fullService ? 0.5 : 0.67);
		$completeSurveyPercent = ($fullService ? 0.3 : 0.38);
		$vipPercentile = ($fullService ? 0.06 : 0.22);
		$offersSentPercentile = 0.29;
		$rtrPercentile = ($fullService ? 0.05 : 0.25);
		$vipEngagment = 0.25;
		$additionVisits = ($fullService ? 4 : 12);
		$avgTableSize = ($fullService ? 3 : 1);
	
		$averageSalesWeek = $avg_check * $avg_custNo;
		$quickRating = ($quickRatingPercent * $avg_custNo) / $avgTableSize;
		$annualVIPsignups = $quickRating * $vipPercentile * 52;
		$annualRTRoffers = $quickRating * $completeSurveyPercent * ($fullService ? 1 : $offersSentPercentile) * $rtrPercentile * 52;
		$additionAnnualSales = ($annualVIPsignups * $avg_check * $avgTableSize * $vipEngagment * $additionVisits);
		$additionMonthlySales = $additionAnnualSales / 12;
		$repeatCustomers = $annualVIPsignups * $vipEngagment;
		$calc = $additionAnnualSales / ($driveSubCost * 12);
		$roi = ceil ( floatval($calc) );
	
		return $roi;
	
	}


	function get_template(){
	
		global $f_name;
		global $l_name;
	
		//Input appropriate mailchimp api-key i.e. 2a2aabc6bee455d3a0fa3068b85df27f-us15
		//$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	
		//API key for gagachan MailChimp Acct.
		//$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	
		$api_key = "8784c7290a9d8bfd5fd33fa348ca02b1-us15";
	
		//$template_id = 50631;
	
		// campaign_id for gagachan MailChimip Acct.
		//$campaign_id = '47bdd5bd1e';
	
		$campaign_id = 'cf0b2442b5';
	
		$roi = calculate();
	
		//set url for api call
		//$service_url = 'https://us15.api.mailchimp.com/3.0/templates/' . $template_id . "/";
		//$service_url = 'https://us15.api.mailchimp.com/3.0/templates/' . $template_id . "/default-content";
		//$service_url = 'https://us15.api.mailchimp.com/3.0/campaigns/';

		$service_url = 'https://us15.api.mailchimp.com/3.0/campaigns/' . $campaign_id . "/content/";

		$curl = curl_init($service_url);

		//Set curl header for API call
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //'Accept: application/vnd.api+json',
            //'Content-Type: application/vnd.api+json',
			'Content-Type: application/json',
            'Authorization: apikey ' . $api_key
		));

		curl_setopt($curl, CURLOPT_HEADER, true);

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		//Set SSL verification for API call
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);



		$curl_response = curl_exec($curl);


		//If api call does not succeed display error
		if ($curl_response === false) {
			$info = curl_getinfo($curl);
			curl_close($curl);
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		}

		curl_close($curl);

		$decoded = json_decode($curl_response);

		//If decoded json fails, display an error
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
			die('error occured: ' . $decoded->response->errormessage);
		}


		$html;
		$html_start = strpos($curl_response, '"html":' );
		$html_end = strpos($curl_response, '</html>') - $html_start - 1;


		if( $html_start !== false && $html_end !== false) {
			$html = substr($curl_response, $html_start + 8, $html_end);
			$html = str_replace("\\n", "\n", $html);
			$html = str_replace("\\t", "\t", $html);
			$html = str_replace("\\\"", "\"", $html);
			$html = str_replace("\\u", "&rsquo;s ", $html);
			$html = str_replace("*|ROI|*", "$roi", $html);
			$html = str_replace("*|FNAME|*", $f_name, $html);
			$html = str_replace("*|LNAME|*", $l_name, $html);

		}
	
		return $html;
		
	}


	function send_mail(){

		global $f_name;
		global $l_name;
	
		$email   = $_POST["cf-email"];
		$companyName = $_POST["cf-companyName"];

		$name = 'DriveCX';
		$subject = 'DriveCX ROI Report for ' .  $f_name . " " . $l_name;

	
		$html = get_template();
	
		/**
		$message = 'average sales per week = ' . $averageSalesWeek . "\r\n";
		$message .= 'Quick Ratings = ' . $quickRating . "\r\n";
		$message .= 'Annual addition Customers = ' . $annualVIPsignups . "\r\n";
		$message .= 'Additional sales = ' . $additionAnnualSales . "\r\n";
		$message .= 'Loyal Customers = ' . $repeatCustomers . "\r\n";
		$message .= 'ROI rating = ' . $roi . "\r\n";
		$message .= 'firstname = ' . $f_name . "\r\n";
		$message .= 'lastname = ' . $l_name . "\r\n";
		$message .= 'email = ' . $email . "\r\n";
		$message .= 'company name = ' . $companyName . "\r\n";
		*/

		$headers = 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";

		$to = $email;
	
		//echo $html;
		
		list($user, $domain) = explode("@", $email);
	
		if(!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')){
			//validation error
			echo "email does not exist";
			return false;
		}
		else {	
	
		
		// If email has been process for sending, display a success message
		if ( mail( $to, $subject, $html , $headers) ) {
			echo '<div>';
			echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
	
		send_deal($email);

		
		
		/**
	
		require 'vendor/PHPMailer/PHPMailerAutoload.php';
		require 'vendor/PHPMailer/class.smtp.php';
	
		$mail = new PHPMailer;
		$mail->setFrom($drivemail, $name);
		$mail->addAddress($to, $f_name .  " " . $l_name);
		$mail->Subject  = $subject;
		$mail->Body     = $html;
		$mail->isHtml(true);
		*/
	
		/**
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => true,
			'verify_peer_name' => true,
			'allow_self_signed' => false
		));
		*/
	
		//$smtp = new SMTP;
	
	
		/**
		if( !$smtp->verify($user)){
			echo 'Verify failed';
			return false;
		}
		*/

		$myfile = fopen("email.html", "w") or die("Unable to open file!");
		fwrite($myfile, $html);
		fclose($myfile);
	
		}
	}
}


?>
