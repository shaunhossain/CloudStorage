<?php
	require 'db_connect.php';
	$email = $_GET['email'];	
	$sql = "update user_info set verified=1 where email='".$email."'";
	if ($conn->query($sql)==TRUE) {	
		$sql = "select * from user_info where email='".$email."'";
		$query=$conn->query($sql);
		if($r = $query->fetch()){
			$path="files/".$r['id'];	
			if (!file_exists($path)) {
				mkdir($path, 0777, true);
				echo "<h2>Successfully Verified</h2><br>";
				echo "<a href='login.php'>Log In Now !</a>";
			}
			else
				echo "Error Creating Directory<br>Contact Admin : admin@datahost.ga";
		}
		else
			echo "Error In Fetching<br>Contact Admin : admin@datahost.ga";
	}
	else
		echo "Error In Updating Record<br>Contact Admin : admin@datahost.ga";
?>
