<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location:index.php?msg=Login First");
	}
?>
	<!doctype html>
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Dashboard | DataHost</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<style>
			#create_folder {
				float: right;
			}
		</style>
		<script type="application/x-javascript">
			function folder() {}
		</script>
	</head>

	<body>
		<section id="body" class="width">
			<aside id="sidebar" class="column-left">
				<header>
					<h1><a href="#">DataHost</a></h1>
					<h2>Data Matters</h2> </header>
				<nav id="mainnav">
					<ul>
						<li class="selected-item"><a href="home.php">Dashboard</a></li>
						<li><a href="upload.php">Upload</a></li>
						<li><a href="#">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</aside>
			<section id="content" class="column-right">
				<article>
					<h2>Dashboard</h2> </article>
				<br>
				<h3>Create Folder</h3>
				<hr>
				<fieldset>
					<form action="home.php" method="post">
						<p>
							<label for="name">Folder Name:</label>
							<input type="text" name="fname" id="name" value="" />
							<?php if($_GET['dir']==''){
								echo "<input type='hidden' name='dir' value='files/".$_SESSION['id']."/'>";
							}else{
								echo "<input type='hidden' name='dir' value='files/".$_SESSION['id']."/".$_GET['dir']."/'>";
							} 
							?>
								<br /> </p>
						<p>
							<input type="submit" name="send" class="formbutton" value="Create Folder " /> </p>
					</form>
				</fieldset>
				<footer class="clear ">
					<p>&copy; 2017 DataHost.</p>
				</footer>
			</section>
			<div class="clear "></div>
		</section>
	</body>

	</html>