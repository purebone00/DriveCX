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

	//Input appropriate mailchimp api-key i.e. 2a2aabc6bee455d3a0fa3068b85df27f-us15
	//$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	$api_key = "2a2aabc6bee455d3a0fa3068b85df27f-us15";
	//$template_id = 50631;	
	
	$campaign_id = '1f0ea54feb';	
	
	//set url for api call
	//$service_url = 'https://us15.api.mailchimp.com/3.0/templates/' . $template_id . "/";
	//$service_url = 'https://us15.api.mailchimp.com/3.0/templates/' . $template_id . "/default-content";
	
	$service_url = 'https://us15.api.mailchimp.com/3.0/campaigns/' . $campaign_id . "/content/";
	
	//$service_url = 'https://us15.api.mailchimp.com/3.0/campaigns/';
	
	
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
	$image_start = strpos($curl_response, '"html":' );
	$image_end = strpos($curl_response, '</html>') - $image_start - 1;
	
		
	if( $image_start !== false && $image_end !== false) {
		$html = (string) htmlspecialchars(substr($curl_response, $image_start + 8, $image_end));
	}
	
	
	
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
	$roi = $additionAnnualSales / ($driveSubCost * 12);
	

	$name = 'DriveCX';
	
	$subject = 'DriveCX ROI Report for ' . $f_name . " " . $l_name;
	
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
		
	//$report = "<html><head><H1>Hello</H1><body><img src=\"" . $image_url ."\"></head></body></html>";
	
		
	$headers = "From: $name <$email>" 
	//. "\r\n" . 'Reply-To: johndoe@email.com' 
	. "\r\n". 'Content-Type: text/html' 
	//. "\r\n". 'X-Mailer: PHP/' 
	//. phpversion()
	;
		
	$to = $email;
	
	
	$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
	$txt = "Mickey Mouse\n";	
	fwrite($myfile, $txt);
	$txt = "Minnie Mouse\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	
	/**				
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	echo $dom->saveHTML();
	*/
	
	//echo "$html";
	
	
	/**	
	$text = "<!doctype html>\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">\n\t<head>\n\t\t<!-- NAME: SELL PRODUCTS -->\n\t\t<!--[if gte mso 15]>\n\t\t<xml>\n\t\t\t<o:OfficeDocumentSettings>\n\t\t\t<o:AllowPNG/>\n\t\t\t<o:PixelsPerInch>96</o:PixelsPerInch>\n\t\t\t</o:OfficeDocumentSettings>\n\t\t</xml>\n\t\t<![endif]-->\n\t\t<meta charset=\"UTF-8\">\n <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n\t\t<title>*|MC:SUBJECT|*</title>\n \n <style type=\"text/css\">\n\t\tp{\n\t\t\tmargin:10px 0;\n\t\t\tpadding:0;\n\t\t}\n\t\ttable{\n\t\t\tborder-collapse:collapse;\n\t\t}\n\t\th1,h2,h3,h4,h5,h6{\n\t\t\tdisplay:block;\n\t\t\tmargin:0;\n\t\t\tpadding:0;\n\t\t}\n\t\timg,a img{\n\t\t\tborder:0;\n\t\t\theight:auto;\n\t\t\toutline:none;\n\t\t\ttext-decoration:none;\n\t\t}\n\t\tbody,#bodyTable,#bodyCell{\n\t\t\theight:100%;\n\t\t\tmargin:0;\n\t\t\tpadding:0;\n\t\t\twidth:100%;\n\t\t}\n\t\t#outlook a{\n\t\t\tpadding:0;\n\t\t}\n\t\timg{\n\t\t\t-ms-interpolation-mode:bicubic;\n\t\t}\n\t\ttable{\n\t\t\tmso-table-lspace:0pt;\n\t\t\tmso-table-rspace:0pt;\n\t\t}\n\t\t.ReadMsgBody{\n\t\t\twidth:100%;\n\t\t}\n\t\t.ExternalClass{\n\t\t\twidth:100%;\n\t\t}\n\t\tp,a,li,td,blockquote{\n\t\t\tmso-line-height-rule:exactly;\n\t\t}\n\t\ta[href^=tel],a[href^=sms]{\n\t\t\tcolor:inherit;\n\t\t\tcursor:default;\n\t\t\ttext-decoration:none;\n\t\t}\n\t\tp,a,li,td,body,table,blockquote{\n\t\t\t-ms-text-size-adjust:100%;\n\t\t\t-webkit-text-size-adjust:100%;\n\t\t}\n\t\t.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{\n\t\t\tline-height:100%;\n\t\t}\n\t\ta[x-apple-data-detectors]{\n\t\t\tcolor:inherit !important;\n\t\t\ttext-decoration:none !important;\n\t\t\tfont-size:inherit !important;\n\t\t\tfont-family:inherit !important;\n\t\t\tfont-weight:inherit !important;\n\t\t\tline-height:inherit !important;\n\t\t}\n\t\t.templateContainer{\n\t\t\tmax-width:600px !important;\n\t\t}\n\t\ta.mcnButton{\n\t\t\tdisplay:block;\n\t\t}\n\t\t.mcnImage{\n\t\t\tvertical-align:bottom;\n\t\t}\n\t\t.mcnTextContent{\n\t\t\tword-break:break-word;\n\t\t}\n\t\t.mcnTextContent img{\n\t\t\theight:auto !important;\n\t\t}\n\t\t.mcnDividerBlock{\n\t\t\ttable-layout:fixed !important;\n\t\t}\n\t\th1{\n\t\t\tcolor:#222222;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:40px;\n\t\t\tfont-style:normal;\n\t\t\tfont-weight:bold;\n\t\t\tline-height:150%;\n\t\t\tletter-spacing:normal;\n\t\t\ttext-align:center;\n\t\t}\n\t\th2{\n\t\t\tcolor:#222222;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:34px;\n\t\t\tfont-style:normal;\n\t\t\tfont-weight:bold;\n\t\t\tline-height:150%;\n\t\t\tletter-spacing:normal;\n\t\t\ttext-align:left;\n\t\t}\n\t\th3{\n\t\t\tcolor:#444444;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:22px;\n\t\t\tfont-style:normal;\n\t\t\tfont-weight:bold;\n\t\t\tline-height:150%;\n\t\t\tletter-spacing:normal;\n\t\t\ttext-align:left;\n\t\t}\n\t\th4{\n\t\t\tcolor:#999999;\n\t\t\tfont-family:Georgia;\n\t\t\tfont-size:20px;\n\t\t\tfont-style:italic;\n\t\t\tfont-weight:normal;\n\t\t\tline-height:125%;\n\t\t\tletter-spacing:normal;\n\t\t\ttext-align:left;\n\t\t}\n\t\t#templateHeader{\n\t\t\tbackground-color:#F7F7F7;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:45px;\n\t\t\tpadding-bottom:45px;\n\t\t}\n\t\t.headerContainer{\n\t\t\tbackground-color:transparent;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:0;\n\t\t\tpadding-bottom:0;\n\t\t}\n\t\t.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{\n\t\t\tcolor:#808080;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:16px;\n\t\t\tline-height:150%;\n\t\t\ttext-align:left;\n\t\t}\n\t\t.headerContainer .mcnTextContent a,.headerContainer .mcnTextContent p a{\n\t\t\tcolor:#00ADD8;\n\t\t\tfont-weight:normal;\n\t\t\ttext-decoration:underline;\n\t\t}\n\t\t#templateBody{\n\t\t\tbackground-color:#FFFFFF;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:36px;\n\t\t\tpadding-bottom:45px;\n\t\t}\n\t\t.bodyContainer{\n\t\t\tbackground-color:transparent;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:0;\n\t\t\tpadding-bottom:0;\n\t\t}\n\t\t.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{\n\t\t\tcolor:#808080;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:16px;\n\t\t\tline-height:150%;\n\t\t\ttext-align:left;\n\t\t}\n\t\t.bodyContainer .mcnTextContent a,.bodyContainer .mcnTextContent p a{\n\t\t\tcolor:#00ADD8;\n\t\t\tfont-weight:normal;\n\t\t\ttext-decoration:underline;\n\t\t}\n\t\t#templateFooter{\n\t\t\tbackground-color:#333333;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:45px;\n\t\t\tpadding-bottom:63px;\n\t\t}\n\t\t.footerContainer{\n\t\t\tbackground-color:transparent;\n\t\t\tbackground-image:none;\n\t\t\tbackground-repeat:no-repeat;\n\t\t\tbackground-position:center;\n\t\t\tbackground-size:cover;\n\t\t\tborder-top:0;\n\t\t\tborder-bottom:0;\n\t\t\tpadding-top:0;\n\t\t\tpadding-bottom:0;\n\t\t}\n\t\t.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{\n\t\t\tcolor:#FFFFFF;\n\t\t\tfont-family:Helvetica;\n\t\t\tfont-size:12px;\n\t\t\tline-height:150%;\n\t\t\ttext-align:center;\n\t\t}\n\t\t.footerContainer .mcnTextContent a,.footerContainer .mcnTextContent p a{\n\t\t\tcolor:#FFFFFF;\n\t\t\tfont-weight:normal;\n\t\t\ttext-decoration:underline;\n\t\t}\n\t@media only screen and (min-width:768px){\n\t\t.templateContainer{\n\t\t\twidth:600px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\tbody,table,td,p,a,li,blockquote{\n\t\t\t-webkit-text-size-adjust:none !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\tbody{\n\t\t\twidth:100% !important;\n\t\t\tmin-width:100% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImage{\n\t\t\twidth:100% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{\n\t\t\tmax-width:100% !important;\n\t\t\twidth:100% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnBoxedTextContentContainer{\n\t\t\tmin-width:100% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageGroupContent{\n\t\t\tpadding:9px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{\n\t\t\tpadding-top:9px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{\n\t\t\tpadding-top:18px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageCardBottomImageContent{\n\t\t\tpadding-bottom:9px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageGroupBlockInner{\n\t\t\tpadding-top:0 !important;\n\t\t\tpadding-bottom:0 !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageGroupBlockOuter{\n\t\t\tpadding-top:9px !important;\n\t\t\tpadding-bottom:9px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnTextContent,.mcnBoxedTextContentColumn{\n\t\t\tpadding-right:18px !important;\n\t\t\tpadding-left:18px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{\n\t\t\tpadding-right:18px !important;\n\t\t\tpadding-bottom:0 !important;\n\t\t\tpadding-left:18px !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcpreview-image-uploader{\n\t\t\tdisplay:none !important;\n\t\t\twidth:100% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\th1{\n\t\t\tfont-size:30px !important;\n\t\t\tline-height:125% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\th2{\n\t\t\tfont-size:26px !important;\n\t\t\tline-height:125% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\th3{\n\t\t\tfont-size:20px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\th4{\n\t\t\tfont-size:18px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{\n\t\t\tfont-size:14px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{\n\t\t\tfont-size:16px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{\n\t\t\tfont-size:16px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}\t@media only screen and (max-width: 480px){\n\t\t.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{\n\t\t\tfont-size:14px !important;\n\t\t\tline-height:150% !important;\n\t\t}\n\n}</style></head>\n <body style=\"height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <center>\n <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\" id=\"bodyTable\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;\">\n <tr>\n <td align=\"center\" valign=\"top\" id=\"bodyCell\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;\">\n <!-- BEGIN TEMPLATE // -->\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" id=\"templateHeader\" data-template-container=\"\" style=\"background:#F7F7F7 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F7F7F7;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 45px;padding-bottom: 45px;\">\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"templateContainer\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;\">\n\t\t\t\t\t\t\t\t\t\t<tr>\n \t\t\t<td valign=\"top\" class=\"headerContainer\" style=\"background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnImageBlock\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody class=\"mcnImageBlockOuter\">\n <tr>\n <td valign=\"top\" style=\"padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnImageBlockInner\">\n <table align=\"left\" width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mcnImageContentContainer\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td class=\"mcnImageContent\" valign=\"top\" style=\"padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n \n <a href=\"http://www.drivecx.com\" title=\"\" class=\"\" target=\"_blank\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <img align=\"center\" alt=\"\" src=\"https://gallery.mailchimp.com/b8a4e8c0efeb65ee825682bf4/images/10df18a0-de79-41d0-8aec-fa95af62aba9.png\" width=\"564\" style=\"max-width: 1050px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" class=\"mcnImage\">\n </a>\n \n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody>\n</table></td>\n\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t</td>\n </tr>\n\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" id=\"templateBody\" data-template-container=\"\" style=\"background:#FFFFFF none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 36px;padding-bottom: 45px;\">\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"templateContainer\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;\">\n\t\t\t\t\t\t\t\t\t\t<tr>\n \t\t\t<td valign=\"top\" class=\"bodyContainer\" style=\"background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnTextBlock\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody class=\"mcnTextBlockOuter\">\n <tr>\n <td valign=\"top\" class=\"mcnTextBlockInner\" style=\"padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n \t<!--[if mso]>\n\t\t\t\t<table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" style=\"width:100%;\">\n\t\t\t\t<tr>\n\t\t\t\t<![endif]-->\n\t\t\t \n\t\t\t\t<!--[if mso]>\n\t\t\t\t<td valign=\"top\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t<![endif]-->\n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" width=\"100%\" class=\"mcnTextContentContainer\">\n <tbody><tr>\n \n <td valign=\"top\" class=\"mcnTextContent\" style=\"padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #808080;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;\">\n \n Hello ROI\n </td>\n </tr>\n </tbody></table>\n\t\t\t\t<!--[if mso]>\n\t\t\t\t</td>\n\t\t\t\t<![endif]-->\n \n\t\t\t\t<!--[if mso]>\n\t\t\t\t</tr>\n\t\t\t\t</table>\n\t\t\t\t<![endif]-->\n </td>\n </tr>\n </tbody>\n</table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnButtonBlock\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody class=\"mcnButtonBlockOuter\">\n <tr>\n <td style=\"padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" valign=\"top\" align=\"center\" class=\"mcnButtonBlockInner\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mcnButtonContentContainer\" style=\"border-collapse: separate !important;border-radius: 3px;background-color: #00ADD8;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody>\n <tr>\n <td align=\"center\" valign=\"middle\" class=\"mcnButtonContent\" style=\"font-family: Helvetica;font-size: 18px;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <a class=\"mcnButton \" title=\"Contact Us\" href=\"http://google.ca\" target=\"_self\" style=\"font-weight: bold;letter-spacing: -0.5px;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;\">Contact Us</a>\n </td>\n </tr>\n </tbody>\n </table>\n </td>\n </tr>\n </tbody>\n</table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnDividerBlock\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;\">\n <tbody class=\"mcnDividerBlockOuter\">\n <tr>\n <td class=\"mcnDividerBlockInner\" style=\"min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table class=\"mcnDividerContent\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <span></span>\n </td>\n </tr>\n </tbody></table>\n<!-- \n <td class=\"mcnDividerBlockInner\" style=\"padding: 18px;\">\n <hr class=\"mcnDividerContent\" style=\"border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;\" />\n-->\n </td>\n </tr>\n </tbody>\n</table></td>\n\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t</td>\n </tr>\n <tr>\n\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" id=\"templateFooter\" data-template-container=\"\" style=\"background:#333333 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #333333;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 45px;padding-bottom: 63px;\">\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t\t\t<td align=\"center\" valign=\"top\" width=\"600\" style=\"width:600px;\">\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t\t<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"templateContainer\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;\">\n\t\t\t\t\t\t\t\t\t\t<tr>\n \t\t\t<td valign=\"top\" class=\"footerContainer\" style=\"background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;\"><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowBlock\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody class=\"mcnFollowBlockOuter\">\n <tr>\n <td align=\"center\" valign=\"top\" style=\"padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowBlockInner\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowContentContainer\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"center\" style=\"padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowContent\">\n <tbody><tr>\n <td align=\"center\" valign=\"top\" style=\"padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"center\" valign=\"top\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <!--[if mso]>\n <table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n <tr>\n <![endif]-->\n \n <!--[if mso]>\n <td align=\"center\" valign=\"top\">\n <![endif]-->\n \n \n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td valign=\"top\" style=\"padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowContentItemContainer\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowContentItem\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"left\" valign=\"middle\" style=\"padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n \n <td align=\"center\" valign=\"middle\" width=\"24\" class=\"mcnFollowIconContent\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <a href=\"http://www.facebook.com\" target=\"_blank\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\"><img src=\"https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png\" style=\"display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" height=\"24\" width=\"24\" class=\"\"></a>\n </td>\n \n \n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n \n <!--[if mso]>\n </td>\n <![endif]-->\n \n <!--[if mso]>\n <td align=\"center\" valign=\"top\">\n <![endif]-->\n \n \n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td valign=\"top\" style=\"padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowContentItemContainer\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowContentItem\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"left\" valign=\"middle\" style=\"padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n \n <td align=\"center\" valign=\"middle\" width=\"24\" class=\"mcnFollowIconContent\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <a href=\"http://www.twitter.com/\" target=\"_blank\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\"><img src=\"https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-twitter-48.png\" style=\"display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" height=\"24\" width=\"24\" class=\"\"></a>\n </td>\n \n \n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n \n <!--[if mso]>\n </td>\n <![endif]-->\n \n <!--[if mso]>\n <td align=\"center\" valign=\"top\">\n <![endif]-->\n \n \n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td valign=\"top\" style=\"padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowContentItemContainer\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowContentItem\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"left\" valign=\"middle\" style=\"padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n \n <td align=\"center\" valign=\"middle\" width=\"24\" class=\"mcnFollowIconContent\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <a href=\"http://www.instagram.com/\" target=\"_blank\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\"><img src=\"https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-instagram-48.png\" style=\"display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" height=\"24\" width=\"24\" class=\"\"></a>\n </td>\n \n \n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n \n <!--[if mso]>\n </td>\n <![endif]-->\n \n <!--[if mso]>\n <td align=\"center\" valign=\"top\">\n <![endif]-->\n \n \n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td valign=\"top\" style=\"padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\" class=\"mcnFollowContentItemContainer\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"mcnFollowContentItem\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n <td align=\"left\" valign=\"middle\" style=\"padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"\" style=\"border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <tbody><tr>\n \n <td align=\"center\" valign=\"middle\" width=\"24\" class=\"mcnFollowIconContent\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\">\n <a href=\"http://mailchimp.com\" target=\"_blank\" style=\"mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;\"><img src=\"https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png\" style=\"display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" height=\"24\" width=\"24\" class=\"\"></a>\n </td>\n \n \n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n \n <!--[if mso]>\n </td>\n <![endif]-->\n \n <!--[if mso]>\n </tr>\n </table>\n <![endif]-->\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n </tbody></table>\n </td>\n </tr>\n</tbody></table>\n\n </td>\n </tr>\n </tbody>\n</table></td>\n\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<!--[if gte mso 9]>\n\t\t\t\t\t\t\t\t\t</td>\n\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t</table>\n\t\t\t\t\t\t\t\t\t<![endif]-->\n\t\t\t\t\t\t\t\t</td>\n </tr>\n </table>\n <!-- // END TEMPLATE -->\n </td>\n </tr>\n </table>\n </center>\n <center>\n <br />\n <br />\n <br />\n <br />\n <br />\n <br />\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" id=\"canspamBarWrapper\" style=\"background-color:#FFFFFF; border-top:1px solid #E5E5E5;\">\n <tr>\n <td align=\"center\" valign=\"top\" style=\"padding-top:20px; padding-bottom:20px;\">\n <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"canspamBar\">\n <tr>\n <td align=\"center\" valign=\"top\" style=\"color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:5px; padding-left:20px; text-align:center;\">\n This email was sent to <a href=\"mailto:*|EMAIL|*\" target=\"_blank\" style=\"color:#404040 !important;\">*|EMAIL|*</a>\n <br />\n <a href=\"*|ABOUT_LIST|*\" target=\"_blank\" style=\"color:#404040 !important;\"><em>why did I get this?</em></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"*|UNSUB|*\" style=\"color:#404040 !important;\">unsubscribe from this list</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"*|UPDATE_PROFILE|*\" style=\"color:#404040 !important;\">update subscription preferences</a>\n <br />\n *|LIST:ADDRESSLINE|*\n <br />\n <br />\n *|REWARDS|*\n </td>\n </tr>\n </table>\n </td>\n </tr>\n </table>\n <style type=\"text/css\">\n @media only screen and (max-width: 480px){\n table#canspamBar td{font-size:14px !important;}\n table#canspamBar td a{display:block !important; margin-top:10px !important;}\n }\n </style>\n </center></body>\n</html>";
	echo $text;
	*/
	
	//echo $image_html;
		
	/**
	
	// If email has been processed for sending, display a success message
	if ( mail( $to, $subject, $report, $headers) ) {
		echo '<div>';
		echo '<p>A copy of your report has been sent to your email address '. $email.'</p>';
		echo '</div>';
	} else {
		echo 'An unexpected error occurred';
	}
	
	
	//send_deal($email);	
	*/
}


?>