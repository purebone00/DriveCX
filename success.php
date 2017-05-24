<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DriveCX</title>

    <link rel="icon" type="image/png" sizes="32x32" href="resources/images/favicon/LogoMark_16.png">
	<link rel="icon" type="image/png" sizes="96x96" href="resources/images/favicon/LogoMark_32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="resources/images/favicon/LogoMark_96.png">
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
    <link rel="stylesheet" type="text/css" href="resources/success_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom Script -->
    <script type="text/javascript" src="resources/successscript.js"></script>
    <script type="text/javascript" src="resources/typed.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
</head>

<body>

	<?php
							
		$f_name = $_POST["cf-fName"];
		$l_name = $_POST["cf-lName"];
							
		$email    	  = $_POST["cf-email"];
		$avg_check    = $_POST["cf-averageCheck"];
		$avg_custNo   = $_POST["cf-averageCustNo"];
		$companyName  = $_POST["cf-companyName"];
						
	?>

    <div class="container">
        
        <div class="row">
            <div class="class="col-sm-12" style="max-width: 750px; margin: auto;">
                <div class ="row" >
                    <div class="animated zoomInLeft" style="-webkit-animation-delay: 1s;">
                        <div class='quote'>
                            <div class="col-md-4">
                                <div class="container text-centered">
                                    <img class='img-responsive img-circle' id="speechBubbleImg" style="width:150px;" src='resources/images/michael.png'>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class='speech-bubble left'>
                                    <p style="color: black!important">
                                        <img style="width:25px;" src='resources/images/driveSmallLogo.png' alt=""> Michael Lenizky
                                        <span class='time-ago'>
                                            Manager of Customer Success
                                        </span>
                                    </p>
                                    <blockquote>
                                        <div style="display:inline;" class="element"></div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <div style="margin-bottom:25px; margin-top:-85px; color: #757575;">
            <div class="card card-container">
                <img src="resources/images/logo.png" class="img-responsive container" alt=""></img>
                <h1>Information sent:</h1>
                <?php
                echo '<br>';
                echo '<p>First name: '. $f_name.'</p>';
                echo '<p>Last name: '. $l_name.'</p>';
                echo '<p>Email address: '. $email.'</p>';
                echo '<p>Company Name: ' . $companyName . '</p>';
                echo '<br>';
                echo '<p>Average check: '. $avg_check.'</p>';
                echo '<p>Average customer number: '. $avg_custNo.'</p>';

                include 'php/send_email.php';
                include 'php/send_deal.php';
                send_mail();						
                ?>
            </div>
        </div>
    </div>




</body>


</html>
