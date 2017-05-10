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


$html;

//Get's mail chimp template by $template_id
function send_mail(){



	$driveSubCost = 199;
	$quickRatingPercent = 0.67;
	$completeSurveyPercent = 0.38;
	$vipPercentile = 0.22;
	$offersSentPercentile = 0.29;
	$rtrPercentile = 0.25;
	$vipEngagment = 0.25;
	$additionVisits = 22;

	//Please adjust
	$avgTableSize = 3;


	$avg_check    = $_POST["cf-averageCheck"];
	$avg_custNo    = $_POST["cf-averageCustNo"];
	$f_name    = $_POST["cf-fName"];
	$l_name    = $_POST["cf-lName"];
	$email   = $_POST["cf-email"];
	$companyName = $_POST["cf-companyName"];

	$averageSalesWeek = $avg_check * $avg_custNo;
	$quickRating = $quickRatingPercent * $averageSalesWeek;
	$annualVIPsignups = $quickRating * $vipPercentile * 52;
	$additionAnnualSales = $annualVIPsignups * $avg_check * $avgTableSize * $vipEngagment * $additionVisits;
	$additionMonthlySales = $additionAnnualSales / 12;
	$repeatCustomers = $annualVIPsignups * $vipEngagment;
	$calc = $additionAnnualSales / ($driveSubCost * 12);
	$roi = ceil ( floatval($calc) );


	$name = 'DriveCX';

	$subject = 'DriveCX ROI Report for ' . $f_name . " " . $l_name;

	
	
	
	//Input appropriate mailchimp api-key i.e. 2a2aabc6bee455d3a0fa3068b85df27f-us15
	//$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	//$template_id = 50631;

	$campaign_id = '47bdd5bd1e';

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
		$html = str_replace("*|ROI|*", "$roi" . " X", $html);
		$html = str_replace("*|FNAME|*", "$f_name", $html);
		$html = str_replace("*|LNAME|*", "$l_name", $html);

	}

	
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


	$headers = 'Content-Type: text/html; charset=iso-8859-1' . "\r\n";

	$to = $email;

	// If email has been process for sending, display a success message
	if ( mail( $to, $subject, $html , $headers) ) {
		echo '<div>';
		echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
		echo '</div>';
	} else {
		echo 'An unexpected error occurred';
	}

	send_deal($email);
	
	//echo $html;
	
	
	
	$myfile = fopen("email.html", "w") or die("Unable to open file!");
	fwrite($myfile, $html);
	fclose($myfile);

}


?>