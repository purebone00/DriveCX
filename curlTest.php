<?php
        $full_url = 'https://drivecx-4e872.firebaseio.com/full/fullFormula.json';
		$quick_url = 'https://drivecx-4e872.firebaseio.com/quick/quickFormula.json';

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
        print_r($f_decoded);
        echo $f_decoded['addVisits'];
		//If decoded json fails, display an error
		if (isset($f_decoded->response->status) && $f_decoded->response->status == 'ERROR') {
			die('error occured: ' . $f_decoded->response->errormessage);
		}
        

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
        print_r($q_decoded);
        
		//If decoded json fails, display an error
		if (isset($q_decoded->response->status) && $q_decoded->response->status == 'ERROR') {
			die('error occured: ' . $q_decoded->response->errormessage);
		}
        echo $q_decoded[0];

?>