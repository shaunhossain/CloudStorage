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
			
			#nofilefound {
				width: 78%;
				float: left;
				border-width: 1px;
				border-style: dashed;
				padding: 10%;
			}
			
			#file_table {
				border-width: 1px;
				border-style: dashed;
			}
		</style>
		<script type="application/x-javascript">
			function openDelete() {
				confirm("You Sure Want To Delete This?");
			}

			function copyToClipboard(filename) {
				window.prompt("Copy to clipboard to share Link: Ctrl+C, Enter", window.location.hostname + "/" + filename);
			}
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
						<li>
							<center>
								<?php echo "<h5>Welcome ".$_SESSION['fname']."</h5>" ?> </center>
						</li>
						<li class="selected-item"><a href="home.php">Dashboard</a></li>
						<li><a href="upload.php">Upload</a></li>
						<li><a href="changepassword.php">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>
			</aside>
			<section id="content" class="column-right">
				<article>
					<h2>Dashboard</h2> </article>
				<br>
				<h3>Your Files</h3>
				<hr>
				<article id="create_folder"> <a class="button" href="createFolder.php?dir=<?php if(isset($_GET['dir'])){echo $_GET['dir'];} ?>">Create Folder</a> </article>
				<table id="file_table">
					<?php 
					if(isset($_GET['dir'])){
						$dir = "files/".$_SESSION['id']."/".$_GET['dir'];	
					}
					else{
						$dir = "files/".$_SESSION['id'];
					}
					if(isset($_POST['fname'])){
						mkdir($_POST['dir'].$_POST['fname']);
					}
					$sd = array_diff(scandir($dir), array('..', '.'));
					chdir($dir);
					if($sd==null){
						echo "<div id='nofilefound'>";
						echo "<h4><center>No File(s) Uploaded</center></h4>";
						echo "</div>";
					}
					
					foreach($sd as $i){
						echo "<tr>";
						echo "<td>";
							if(is_dir($i)){
								echo "<img src='img/folder.png' width='40px' height='40px'></img>";
							}
							else{
								echo "<img src='img/file.png' width='40px' height='40px'></img>";
							}
						echo "</td>";
						echo "<td>";
						if(isset($_GET['dir'])){
								$tempDir = $_GET['dir']."/".$i;
						}
						else{
							$tempDir = $i;
						}
						if(is_dir($i)){
							echo "<a href='?dir=".$tempDir."' style='margin:0px'>";
							echo $i;
							echo "</a>";
						}
						else{
							echo "<a href='files/".$_SESSION['id']."/".$tempDir."'  style='margin:0px'>";
							echo $i;
							echo "</a>";
						}
						echo "</td>";
						if(!is_dir($i)){
							echo "<td>";
							$temp = urlencode($i);
							$tName = $dir."/".$temp;
							echo "<a onclick=copyToClipboard('".$tName."')>";
							echo "<img src='img/share.png' width='20px' height='20px'></img>&nbsp;";
							echo "</a>";
							echo "<a href='deleteFile.php?fname=".$i."'>";
							echo "<img src='img/delete.png' width='20px' height='20px'></img>";
							echo "</a>";
							echo "</td>";
						}
						else{
							echo "<td>";
							echo "<a href='deleteFile.php?fname=".$i."'>";
							echo "<img src='img/delete.png' width='20px' height='20px'></img>";
							echo "</a>";
							echo "</td>";
						}
						echo "</tr>";
					}
				?>
				</table>
				<footer class="clear">
					<p>&copy; 2017 DataHost.</p>
				</footer>
			</section>
			<div class="clear"></div>
		</section>
	</body>

	</html>