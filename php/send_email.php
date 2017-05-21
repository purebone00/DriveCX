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
	$companyName = $_POST["cf-companyName"];
	
	$completeSurveyPercent;

	function calculate(){
		
		global $completeSurveyPercent;
		global $additionAnnualSales;
		
        $full_url = 'https://driveroicalculator.firebaseio.com/full/fullFormula.json';
		

		$curlFull = curl_init($full_url);
		curl_setopt($curlFull, CURLOPT_HTTPHEADER, array(
            //'Accept: application/vnd.api+json',
            //'Content-Type: application/vnd.api+json',
			'Content-Type: application/json',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $full_url
        ));
		curl_setopt($curlFull, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlFull, CURLOPT_SSL_VERIFYPEER, false);
		$curlFull_response = curl_exec($curlFull);
		
        //If api call does not succeed display error
		if ($curlFull_response === false) {
			$f_info = curl_getinfo($curlFull);
			curl_close($curlFull);
			die('error occured during curl exec. Additioanl info: ' . var_export($f_info));
		}
		curl_close($curlFull);
		$f_decoded = json_decode($curlFull_response, true);
		
		//If decoded json fails, display an error
		if (isset($f_decoded->response->status) && $f_decoded->response->status == 'ERROR') {
			die('error occured: ' . $f_decoded->response->errormessage);
		}
		
		$quick_url = 'https://driveroicalculator.firebaseio.com/quick/quickFormula.json';	
		$curlQuick = curl_init($quick_url);
		curl_setopt($curlQuick, CURLOPT_HTTPHEADER, array(
            //'Accept: application/vnd.api+json',
            //'Content-Type: application/vnd.api+json',
			'Content-Type: application/json',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $quick_url
        ));
		curl_setopt($curlQuick, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curlQuick, CURLOPT_RETURNTRANSFER, true);
		$curlQuick_response = curl_exec($curlQuick);
        
		//If api call does not succeed display error
		if ($curlQuick_response === false) {
			$q_info = curl_getinfo($curlQuick);
			curl_close($curlQuick);
			die('error occured during curl exec. Additioanl info: ' . var_export($q_info));
		}
		curl_close($curlQuick);

		$q_decoded = json_decode($curlQuick_response, true);
        
		//If decoded json fails, display an error
		if (isset($q_decoded->response->status) && $q_decoded->response->status == 'ERROR') {
			die('error occured: ' . $q_decoded->response->errormessage);
		}


		$fullService = isset($_POST["cf-full-service"]);
	
		$avg_check    = $_POST["cf-averageCheck"];
		$avg_custNo   = $_POST["cf-averageCustNo"];
	
		$driveSubCost = 199;
		$quickRatingPercent = ($fullService ? $q_decoded['quick'] : $f_decoded['full']);
		$completeSurveyPercent = ($fullService ? $q_decoded['surveyPercentage'] : $f_decoded['surveyPercentage']);	
		$vipPercentile = ($fullService ? $q_decoded['vipPercentage'] : $f_decoded['vipPercentage']);	
		$offersSentPercentile = $q_decoded['offerSent'];		
		$rtrPercentile = ($fullService ? $q_decoded['rtr'] : $f_decoded['rtr']);		
		$vipEngagment = ($fullService) ? $q_decoded['vipEngage'] : $f_decoded['vipEngage']; 		
		$additionVisits = ($fullService ? $q_decoded['addVisits'] : $f_decoded['addVisits']);
		$avgTableSize = ($fullService ? $q_decoded['tableSize'] : $f_decoded['tableSize']);
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

	//Gets HTML template from MailChimp Campaign
	function get_template(){
	
		$mailChimpAPI_url = 'https://driveroicalculator.firebaseio.com/keys/mailChimp.json';	
		$curlMailChimpAPI = curl_init($mailChimpAPI_url);
		curl_setopt($curlMailChimpAPI, CURLOPT_HTTPHEADER, array(
            //'Accept: application/vnd.api+json',
            //'Content-Type: application/vnd.api+json',
			'Content-Type: application/json',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $mailChimpAPI_url
        ));
		curl_setopt($curlMailChimpAPI, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curlMailChimpAPI, CURLOPT_RETURNTRANSFER, true);
		$curlMailChimpAPI_response = curl_exec($curlMailChimpAPI);
        
		//If api call does not succeed display error
		if ($curlMailChimpAPI_response === false) {
			$mailChimpAPI_info = curl_getinfo($curlMailChimpAPI);
			curl_close($curlMailChimpAPI);
			die('error occured during curl exec. Additioanl info: ' . var_export($mailChimpAPI_info));
		}
		curl_close($curlMailChimpAPI);

		$MailChimpAPI_decoded = json_decode($curlMailChimpAPI_response, true);

		$MailChimpCampaignId_url = 'https://driveroicalculator.firebaseio.com/keys/MailChimpCampaignId.json';	
		$curlMailChimpCampaignId = curl_init($MailChimpCampaignId_url);
		curl_setopt($curlMailChimpCampaignId, CURLOPT_HTTPHEADER, array(
            //'Accept: application/vnd.api+json',
            //'Content-Type: application/vnd.api+json',
			'Content-Type: application/json',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $MailChimpCampaignId_url
        ));
		curl_setopt($curlMailChimpCampaignId, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curlMailChimpCampaignId, CURLOPT_RETURNTRANSFER, true);
		$curlMailChimpCampaignId_response = curl_exec($curlMailChimpCampaignId);
        
		//If api call does not succeed display error
		if ($curlMailChimpCampaignId_response === false) {
			$MailChimpCampaignId_info = curl_getinfo($curlMailChimpCampaignId);
			curl_close($curlMailChimpCampaignId);
			die('error occured during curl exec. Additioanl info: ' . var_export($MailChimpCampaignId_info));
		}
		curl_close($curlMailChimpCampaignId);

		$MailChimpCampaignId_decoded = json_decode($curlMailChimpCampaignId_response, true);


		
		
		$api_key = $MailChimpAPI_decoded;
	
		$campaign_id = $MailChimpCampaignId_decoded;
		$roi = calculate();
		
		global $f_name;
		global $l_name;
		global $companyName;
		global $additionAnnualSales;

		global $completeSurveyPercent;
		global $additionAnnualSales;

		$service_url = 'https://us15.api.mailchimp.com/3.0/campaigns/' . $campaign_id . "/content/";

		$curl = curl_init($service_url);

		//Set curl header for API call
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
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

		//Identifies HTML of MailChimp Campaign
		$html_start = strpos($curl_response, '"html":' );
		$html_end = strpos($curl_response, '</html>') - $html_start - 1;
		
		//Modifies and corrects email template for html coding
		if( $html_start !== false && $html_end !== false) {
			
			$html = substr($curl_response, $html_start + 8, $html_end);
			$html = str_replace("\\n", "\n", $html);
			$html = str_replace("\\t", "\t", $html);
			$html = str_replace("\\\"", "\"", $html);
			$html = str_replace("\\u", "&rsquo;s ", $html);
			
			$html = str_replace("&rsquo;s 00a9", "&copy;", $html);
			$html = str_replace("&rsquo;s 00ae", "&#174;", $html);
			$html = str_replace("2122", "&#8482;", $html);
			
			
			$html = str_replace("*|ROI|*", "$roi", $html);
			$html = str_replace("*|FNAME|*", $f_name, $html);
			$html = str_replace("*|LNAME|*", $l_name, $html);
			$html = str_replace("*|COMPLETESURVEY|*", $completeSurveyPercent, $html);
			$html = str_replace("*|ANNUALSALES|*", $additionAnnualSales, $html);

		}
	
		return $html;
		
	}


	function send_mail(){

		global $f_name;
		global $l_name;
		global $companyName;
	
		$email   = $_POST["cf-email"];
		

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
	
		
		// Send Mail, if email has been process for sending, display a success message
		if ( mail( $to, $subject, $html , $headers) ) {
			echo '<div>';
			echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
		
	
		send_deal($email, $f_name, $l_name, $companyName);

		
		
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
