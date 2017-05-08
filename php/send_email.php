<?php
//this function sends the email
function send_mail(){

		$fullService = $_POST["cf-full-service"];

		$driveSubCost = 199;
		$quickRatingPercent = ($fullService ? 0.5 : 0.67);
		$completeSurveyPercent = ($fullService ? 0.3 : 0.38);
		$vipPercentile = ($fullService ? 0.06 : 0.22);
		$offersSentPercentile = 0.29;
		$rtrPercentile = ($fullService ? 0.05 : 0.25);
		$vipEngagment = 0.25;
		$additionVisits = ($fullService ? 4 : 12);
		$avgTableSize = ($fullService ? 3 : 1);

		$avg_check    = $_POST["cf-averageCheck"];
		$avg_custNo    = $_POST["cf-averageCustNo"];
		$f_name    = $_POST["cf-fName"];
		$l_name    = $_POST["cf-lName"];
		$email   = $_POST["cf-email"];
		$companyName = $_POST["cf-companyName"];

		$averageSalesWeek = $avg_check * $avg_custNo;
		$quickRating = ($quickRatingPercent * $avg_custNo) / $avgTableSize;
		$annualVIPsignups = $quickRating * $vipPercentile * 52;
		$annualRTRoffers = $quickRating * $completeSurveyPercent * ($fullService ? 1 : $offersSentPercentile) * $rtrPercentile * 52;
		$additionAnnualSales = ($annualVIPsignups * $avg_check * $avgTableSize * $vipEngagment * $additionVisits);
		$additionMonthlySales = $additionAnnualSales / 12;
		$repeatCustomers = $annualVIPsignups * $vipEngagment;
		$roi = $additionAnnualSales / ($driveSubCost * 12);

		$subject = 'DriveCX ROI Report for ' . $f_name . " " . $l_name;
		$message .= 'average sales per week = ' . $averageSalesWeek . "\r\n";
		$message .= 'Quick Ratings = ' . $quickRating . "\r\n";
		$message .= 'Annual addition Customers = ' . $annualVIPsignups . "\r\n";
		$message .= 'Additional sales = ' . $additionAnnualSales . "\r\n";
		$message .= 'Loyal Customers = ' . $repeatCustomers . "\r\n";
		$message .= 'ROI rating = ' . $roi . "\r\n";
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
