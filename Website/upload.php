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
		<title>Upload File | DataHost</title>
		<link rel="stylesheet" href="css/styles.css" type="text/css" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<script>
			function _(el) {
				return document.getElementById(el);
			}

			function uploadFile() {
				var file = _("file1").files[0];
				var d = document.getElementById("dir");
				var dir = d.options[d.selectedIndex].value;
				var formdata = new FormData();
				formdata.append("file1", file);
				formdata.append("dir", dir);
				var ajax = new XMLHttpRequest();
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", completeHandler, false);
				ajax.addEventListener("error", errorHandler, false);
				ajax.addEventListener("abort", abortHandler, false);
				ajax.open("POST", "file_upload_parser.php");
				ajax.send(formdata);
			}

			function progressHandler(event) {
				_("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
			}

			function completeHandler(event) {
				_("status").innerHTML = event.target.responseText;
				_("progressBar").value = 0;
			}

			function errorHandler(event) {
				_("status").innerHTML = "Upload Failed";
			}

			function abortHandler(event) {
				_("status").innerHTML = "Upload Aborted";
			}
		</script>
		<style>
			progress {
				width: 400px;
				height: 14px;
				/*	margin: 50px auto; */
				display: block;
				/* Important Thing */
				-webkit-appearance: none;
				border: none;
			}
			/* All good till now. Now we'll style the background */
			
			progress::-webkit-progress-bar {
				background: black;
				border-radius: 50px;
				padding: 2px;
				box-shadow: 0 1px 0px 0 rgba(255, 255, 255, 0.2);
			}
			/* Now the value part */
			
			progress::-webkit-progress-value {
				border-radius: 50px;
				box-shadow: inset 0 1px 1px 0 rgba(255, 255, 255, 0.4);
				background: -webkit-linear-gradient(45deg, transparent, transparent 33%, rgba(0, 0, 0, 0.1) 33%, rgba(0, 0, 0, 0.1) 66%, transparent 66%), -webkit-linear-gradient(top, rgba(255, 255, 255, 0.25), rgba(0, 0, 0, 0.2)), -webkit-linear-gradient(left, #ba7448, #c4672d);
				/* Looks great, now animating it */
				background-size: 25px 14px, 100% 100%, 100% 100%;
				-webkit-animation: move 5s linear 0 infinite;
			}
			/* That's it! Now let's try creating a new stripe pattern and animate it using animation and keyframes properties  */
			
			@-webkit-keyframes move {
				0% {
					background-position: 0px 0px, 0 0, 0 0
				}
				100% {
					background-position: -100px 0px, 0 0, 0 0
				}
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
						<li class="selected-item"><a href="upload.php">Upload</a></li>
						<li><a href="changepassword.php">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</aside>
			<section id="content" class="column-right">
				<article>
					<h2>Upload File</h2> </article>
				<br/>
				<br>
				<center>
					<form id="upload_form" enctype="multipart/form-data" method="post">
						<h5>Choose File</h5>
						<input type="file" name="file1" id="file1">
						<br>
						<br>
						<h5>Select Folder</h5>
						<select id="dir">
							<?php
							$dir = "files/".$_SESSION['id']."/";
							chdir($dir);
							$scanDir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('.'));
							$folds = array(); 
							foreach ($scanDir as $fol1) {
    							if ($fol1->isDir())
        							$folds[] = $fol1->getPath();
							}
							$folds = array_unique($folds);
							foreach($folds as $fol){
								if($fol == "."){
									echo "<option value='".$fol."' >/</option>";	
								}
								else{
									echo "<option value='".$fol."' >".$fol."</option>";
								}
							}
						?>
						</select>
						<br>
						<br> <a onclick="uploadFile()" class="button">Upload File</a>
						<br>
						<br>
						<progress id="progressBar" value="0" max="100"> </progress>
						<h5 id="status"></h5>
						<p id="loaded_n_total"></p>
					</form>
				</center>
				<footer class="clear">
					<p>&copy; 2017 DataHost.</p>
				</footer>
			</section>
			<div class="clear"></div>
		</section>
	</body>

	</html>