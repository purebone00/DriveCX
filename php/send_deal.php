<?php

//this function sends to pipedrive
function send_deal($email) {
	$service_url = 'https://api.pipedrive.com/v1/deals?api_token=ad92c95c3a68f498c69190b4dae80dc522c6c5b4';
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