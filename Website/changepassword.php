<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:index.php?msg=Login First");
	}
?>
	<!doctype html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Upload File | DataHost</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<style>
			#suc {
				color: #4FFF33;
				font-size: 1.6em;
				padding-bottom: 10px;
			}
		</style>
	</head>

	<body>
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">
				<header>
					<h1><a href="#">DataHost</a></h1>
					<h2>Data Matters</h2> </header>
				<nav id="mainnav">
					<ul>
						<li>
							<center>
								<?php echo "<h5>Welcome ".$_SESSION['fname']."</h5>" ?> </center>
						</li>
						<li><a href="home.php">Dashboard</a></li>
						<li><a href="upload.php">Upload</a></li>
						<li class="selected-item"><a href="#">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</aside>
			<section id="content" class="column-right">
				<article>
					<h2>Change Password</h2> </article>
				<br/>
				<br>
				<?php 
					if(isset($_POST['send'])){
						require 'db_connect.php';
						if($_POST['cur_pass']==$_SESSION['password']){
							if($_POST['n_pass']==$_POST['n_pass_conf']){
								$npass = $_POST['n_pass'];
								$sql = "UPDATE user_info set password='".$npass."' WHERE id=".$_SESSION['id'];
								try {
									$stmt = $conn->prepare($sql);
									$stmt->execute();
									echo "<div id='suc'>Password Changed Successfully</div>";
									}
								catch(PDOException $e)
									{
										echo $sql . "<br>" . $e->getMessage();
									}
						}
						else{
							echo "<h3>Please Enter Correct Current Password</h3>";
						}
					}
					}
				?>
					<br>
					<fieldset>
						<legend>Enter Details</legend>
						<form action="changepassword.php" method="post">
							<p>
								<label for="name">Current Password:</label>
								<input type="password" name="cur_pass" id="name" value="" />
								<br /> </p>
							<p>
								<label for="email">New Password:</label>
								<input type="password" name="n_pass" id="email" value="" />
								<br /> </p>
							<p>
								<label for="message">Confirm Password:</label>
								<input type="password" name="n_pass_conf" id="email" value="" />
								<br /> </p>
							<p>
								<input type="submit" name="send" class="formbutton" value="Send" /> </p>
						</form>
					</fieldset>
					<footer class="clear">
						<p>&copy; 2017 DataHost.</p>
					</footer>
			</section>
			<div class="clear"></div>
		</section>
	</body>

	</html>