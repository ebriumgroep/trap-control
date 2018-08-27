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

	session_start();
	$active_client = $_SESSION['clientId'];
	$active_hardware = $_POST['hardware'];
	$active_token = 0;
	$active_type = $_POST['type'];


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
	
	phpLog('$active_client' +' $active_hardware'+ ' $active_hardware'+ ' $active_type');
	$sql = "INSERT INTO device(client_id, hardware_id, token, type)
			VALUES ('$active_client', '$active_hardware', $active_token, '$active_type')";

	$fullname = $_SESSION['fullname'];

	if($conn->query($sql) === true){
		$conn->close();
		phpAlert(" Successfully added trap!");
		die();
	}
	else{
		$conn->close();
		phpAlert(" couldn't added trap!");
		die();
	}

?>