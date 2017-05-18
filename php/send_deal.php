<?php

//this function sends to pipedrive
function send_deal($email,$avg_check,$avg_custNo,$f_name,$l_name,$companyName) {
	$service_url = 'https://api.pipedrive.com/v1/deals?api_token=538669d2b75c6b2fb22aa2e91f4af8fbb1e3071c';
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
	
	success_message($email,$avg_check,$avg_custNo,$f_name,$l_name,$companyName);
	
		
}

function success_message($email,$avg_check,$avg_custNo,$f_name,$l_name,$companyName){
	//echo 'Message sent to Pipeewfefwline, expect to hear from us soon:)';
	
?>	
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DriveCX</title>

    <link rel="icon" type="image/png" sizes="32x32" href="resources/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="resources/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resources/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/resources/images/favicon/manifest.json">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <!-- Boostrap Datatoggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="resources/stylesuccess.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom Script -->
    <script type="text/javascript" src="resources/scriptsucess.js"></script>
    <script type="text/javascript" src="resources/typed.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
</head>

<body>



    <div class="container">
	
	<div class="class="col-sm-12" style="max-width: 550px; margin: auto;
    width: 50%;">
	<div class ="row" >
	 <div class="animated zoomInLeft" style="-webkit-animation-delay: 1s;">
                        <div class='quote'>
                            <div >
                                <img class='img-responsive' style="width:200px;" src='resources/images/man_material.png'>
                            </div>
                            <div >
                                <div class='speech-bubble left'>
                                    <p style="color: black!important">
                                        <img style="width:25px;" src='resources/images/driveSmallLogo.png' alt=""> Michael Lenizky
                                        <span class='time-ago'>
                                            Manager of Customer Success
                                        </span>
                                    </p>
                                    <blockquote>
                                        <div class="element"></div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
	</div>
	
			
	 <div class="row">

                
				
				
				
				
                    <div style="margin-bottom:25px; margin-top:-85px; color: #757575;">
                        <div class="card card-container">
                            <img src="resources/images/logo.png" class="img-responsive container" alt=""></img>
                            <h1>Information sent:</h1>
							<?php
							echo '<p>Email address:'. $email.'</p>';
							echo '<p>Information sent:</p>';
							echo '<p>Average check: '. $avg_check.'</p>';
							echo '<p>Average customer number: '. $avg_custNo.'</p>';
							echo '<p>First name: '. $f_name.'</p>';
							echo '<p>Last name: '. $l_name.'</p>';
							echo '<p>Company name: '. $companyName.'</p>';
							
							?>
							
                        </div>
                    </div>
        
            </div>


	</div>
</div>

</body>


</html>
<?php
}
?>