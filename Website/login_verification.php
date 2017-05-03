<?php
	require 'db_connect.php';
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$sql = "select * from user_info where email='".$uname."' and password='".$pass."'";
	$query=$conn->query($sql);
	if($r = $query->fetch()){
		if($r['verified']==0){
			echo "Confirm Your Mail First!";
		}
		else{
			session_start();
			$_SESSION['id']=$r['id'];
			$_SESSION['password']=$pass;
			$_SESSION['email']=$uname;
			$_SESSION['fname']=$r['fname'];
			$_SESSION['lname']=$r['lname'];
			echo "success";
		}
	}
	else{
		echo "Email Or Password Incorrect !";
	}
?>