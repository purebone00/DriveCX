<?php

//this function sends to pipedrive
function send_deal($email) {
	$pipeDriveAPI_url = 'https://driveroicalculator.firebaseio.com/keys/pipeDrive.json';	
	$curlpipeDriveAPI = curl_init($pipeDriveAPI_url);
	curl_setopt($curlpipeDriveAPI, CURLOPT_HTTPHEADER, array(
		//'Accept: application/vnd.api+json',
		//'Content-Type: application/vnd.api+json',
		'Content-Type: application/json',
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $pipeDriveAPI_url
	));
	curl_setopt($curlpipeDriveAPI, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($curlpipeDriveAPI, CURLOPT_RETURNTRANSFER, true);
	$curlpipeDriveAPI_response = curl_exec($curlpipeDriveAPI);
	
	//If api call does not succeed display error
	if ($curlpipeDriveAPI_response === false) {
		$pipeDriveAPI_info = curl_getinfo($curlpipeDriveAPI);
		curl_close($curlpipeDriveAPI);
		die('error occured during curl exec. Additioanl info: ' . var_export($pipeDriveAPI_info));
	}
	curl_close($curlpipeDriveAPI);

	$pipeDriveAPI_decoded = json_decode($curlpipeDriveAPI_response, true);

	$service_url = $pipeDriveAPI_decoded;
	$curl = curl_init($service_url);
	$curl_post_data = array(
			'title' => 'New lead from landing page: '. $email,
			'value' => '39'		
	);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		die('error occured during curl exec. Additioanl info: ' . var_export($info));
	}
	curl_close($curl);
	$decoded = json_decode($curl_response);
	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('error occured: ' . $decoded->response->errormessage);
	}
	//echo 'Message sent to Pipeline, expect to hear from us soon:)';

		
}
?>