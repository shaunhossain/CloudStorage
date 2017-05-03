<?php
	session_start();
	echo "<script type='application/x-javascript'>";
		echo "if(confirm('You Sure Want To Delete This?')){}";
		echo "else{window.location.replace('home.php');}";
	echo "</script>";
	chdir("files/".$_SESSION['id']);
	
	if(is_dir($_GET['fname'])){
		$dir = $_GET['fname'];
		function deleteDirectory($dir) {
    
			if (!file_exists($dir)) {
					return true;
    		}

    		if (!is_dir($dir)) {
				return unlink($dir);
    		}

    		foreach (scandir($dir) as $item) {
        		if ($item == '.' || $item == '..') {
					continue;
        		}

        		if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            		return false;
				}

    		}

    	return rmdir($dir);
		}
		
		deleteDirectory($dir);
	}
	else{
		unlink($_GET['fname']);
	}
	header("location:home.php");
?>