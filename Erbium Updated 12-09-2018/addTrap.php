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
	$active_hardware = $_POST["hardware"];
	$active_token = 0;
	$active_type = $_POST['type'];
	$active_uploadInterval = $_POST['upload_interval'];


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
	
	//phpLog('$active_client' +' $active_hardware'+ ' $active_hardware'+ ' $active_type');
	$sql = "INSERT INTO device(client_id, hardware_id, token, type, Upload_Interval)
			VALUES ('$active_client', '$active_hardware', $active_token, '$active_type','$active_uploadInterval')";

	$fullname = $_SESSION['fullname'];

	if($conn->query($sql) === true){
		$conn->close();
		phpAlert(" Successfully added trap!");
		header("Location:Erbuim_Main.php");
		// echo "<script>
		// window.location.href = 'Erbuim_Main.php';
	  // </script>";
		die();
	}
	else{
		$conn->close();
		?><span><?php echo "Please fill all fields.....!!!!!!!!!!!!";?></span> <?php
		// echo "<script>
		// window.location.href = 'Erbuim_AddTrap.html';
	  // </script>";
		die();
	}

?>