<?php

require_once('php/send_email.php');	
require_once('php/send_deal.php');
			if(isset($_POST['cf-submitted'])){		send_mail();		include 'success.php';	}		else { $pagecontents = file_get_contents("homepage.html");		echo $pagecontents;	}
?>