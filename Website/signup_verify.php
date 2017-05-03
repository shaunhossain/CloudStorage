<?php
	$sendTo = $_GET['email'];
	$fromHeaders = 'MIME-Version: 1.0' . "\ r\n";
	$fromHeaders .= ' Content-type: text/html; charset=iso-8859-1' . "\ r\n";
	$fromHeader .= "From:noreply@datahost.ga \r\n";
	$subject = "Email/Account Verification - DataHost";
	$message = "Hello,
	Thank You For Signing Up At DataHost.You Need To Verify Your Account/Email Before Using Datahost's Service.Click On Link Below To Verify.
	http://datahost.ga/verifymail.php?email=".$sendTo;
	mail($sendTo,$subject,$message,$fromHeader);
?>

	<head>
		<meta charset="UTF-8">
		<title>Sign-Up/Login</title>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
		<link rel="stylesheet" href="css/login_style.css"> </head>

	<body>
		<div class="form">
			<center>
				<h3>
			Confirmation Mail Has Been Sent To Your Mail : <?php echo $_GET['email']?><br>
			Please Click On Link To Verify Your Mail.<br>
			<br></h3>
				<a href="login.php">
					<button class="button button-block">Go To Login </button>
				</a>
			</center>
		</div>
	</body>
