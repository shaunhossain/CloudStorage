<?php
	session_start();
	if (!($_POST['capt']==$_SESSION['capt_original'])||($_POST['capt']==null))  {
    	header("location:login.php?msg=Enter Valid Captcha");
	}
	else{
		require 'db_connect.php';
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		try{
			$sql = "INSERT INTO user_info VALUES(NULL,'".$fname."','".$lname."','".$email."','".$password."',0)";
			$conn->exec($sql);
			header("location:signup_verify.php?email=$email");
		}
		catch(PDOException $e){
			echo $e->getMessage();
			echo "<br><a href='login.html'><h1>Go Back</h1></a>";
		}
	}
?>