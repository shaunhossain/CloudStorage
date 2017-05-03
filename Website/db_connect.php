<?php
	$server_url = "mysql.hostinger.in";
	$username = "u331623145_mek";
	$password = "mek2281998";
	try {
    	$conn = new PDO("mysql:host=$server_url;dbname=u331623145_dh", $username, $password);
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	//echo "Connected successfully"; 
    }
	catch(PDOException $e)
    {
    	echo "Connection failed: " . $e->getMessage();
    }
?>
