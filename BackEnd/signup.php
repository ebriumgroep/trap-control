<?php
	function phpAlert($msg){
		echo '<script type = "text/javascript">alert("'.$msg.'")</script>';
	}

	function phpLog($msg){
		echo '<script type = "text/javascript">console.log("'.$msg.'")</script>';
	}

	$servername = "localhost";
	$dUsername = "root";
	$dPassword = "root";
	$db = "erbium";

	$active_fullname = $_POST['fullname'];
	$active_username = $_POST['username'];
	$active_password = $_POST['password'];


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
	

	$sql = "INSERT INTO client(full_name, username, password)
			VALUES ('$active_fullname', '$active_username', '$active_password')";

	if($conn->query($sql) === true){
		$conn->close();
		phpLog("Successfully Registered!");
		die();
	}
	else{
		$conn->close();
		phpLog("Try again");
		die();
	}

?>