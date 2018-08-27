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
	$returnedString = "";

	session_start();
	$active_client = $_SESSION['clientId'];


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
//TODO
	$sql = "SELECT  client_id, hardware_id, token, type from device";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			# code...
			if($row["client_id"] == $active_client)
			{
				$returnedString .=  $row["hardware_id"].' '.$row["type"]."\n";
			}
		}
	}

	// phpLog($returnedString);
	$conn->close();
	echo ($returnedString);

?>