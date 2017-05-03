<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Sign-Up/Login</title>
	<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/login_style.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/login.js"></script>
	<script type="application/x-javascript">
		function verify() {
			var uname = $('#uname').val();
			var pass = $('#pass').val();
			jQuery.ajax({
				url: 'login_verification.php'
				, type: 'post'
				, data: 'uname=' + uname + "&pass=" + pass
				, success: function (results) {
					if (results.match("success")) {
						window.location.replace("home.php");
					}
					document.getElementById("msg").innerHTML = results;
				}
			});
		}
	</script>
</head>

<body>
	<div class="form">
		<ul class="tab-group">
			<li class="tab active"><a href="#signup">Sign Up</a></li>
			<li class="tab"><a href="#login">Log In</a></li>
		</ul>
		<div class="tab-content">
			<div id="signup">
				<h1>Sign Up</h1>
				<?php 
					if(isset($_GET['msg'])){
						echo "<div id='msg'>".$_GET['msg']."</div>";
					}?>
					<form method="post" action="signup.php">
						<div class="top-row">
							<div class="field-wrap">
								<label> First Name<span class="req">*</span> </label>
								<input type="text" required autocomplete="off" name="fname" /> </div>
							<div class="field-wrap">
								<label> Last Name<span class="req">*</span> </label>
								<input type="text" required autocomplete="off" name="lname" /> </div>
						</div>
						<div class="field-wrap">
							<label> Email Address<span class="req">*</span> </label>
							<input type="email" required autocomplete="off" name="email" /> </div>
						<div class="field-wrap">
							<label> Set A Password<span class="req">*</span> </label>
							<input type="password" required autocomplete="off" id="password" /> </div>
						<div class="field-wrap">
							<label> Confirm Password<span class="req">*</span></label>
							<input type="password" required autocomplete="off" id="confirm_password" name="password" /> </div> <img src="captchafont.php" width="200px" height="60px" />
						<div class="field-wrap">
							<label> Enter Above Code<span class="req">*</span></label>
							<input type="text" required autocomplete="off" name="capt" /> </div>
						<button type="submit" class="button button-block">Get Started</button>
					</form>
			</div>
			<div id="login">
				<h1>Welcome Back!</h1>
				<div id="msg"></div>
				<form method="GET">
					<div class="field-wrap">
						<label> Email Address<span class="req">*</span> </label>
						<input type="email" required autocomplete="off" id="uname" name="uname" /> </div>
					<div class="field-wrap">
						<label> Password<span class="req">*</span> </label>
						<input type="password" required autocomplete="off" id="pass" name="pass" /> </div>
					<!-- <p class="forgot"><a href="#">Forgot Password?</a></p> -->
					<button type="button" class="button button-block" id="sub_login" onclick="verify()">Log In</button>
				</form>
			</div>
		</div>
		<!-- tab-content -->
	</div>
	<!-- /form -->
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="js/login.js"></script>
	<!-- Confirm Password -->
	<script type="application/x-javascript">
		var password = document.getElementById("password")
			, confirm_password = document.getElementById("confirm_password");

		function validatePassword() {
			if (password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords Don't Match");
			}
			else {
				confirm_password.setCustomValidity('');
			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>
	<!-- /Confirm Pasword -->
	<!-- Captcha Check -->
</body>

</html>