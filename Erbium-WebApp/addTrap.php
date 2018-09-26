<?php

	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	function phpAlert($msg){
		echo '<script type = "text/javascript">alert("'.$msg.'")</script>';
	}

	function phpLog($msg){
		echo '<script type = "text/javascript">console.log("'.$msg.'")</script>';
	}

	session_start();
	$active_client = $_SESSION['clientId'];
	$active_hardware = $_POST["hardware"];
	$active_token = 0;
	$active_type = $_POST['type'];
	$active_uploadInterval = $_POST['upload_interval'];
	//new
	$active_lat = $_POST['trapLat'];
	$active_long = $_POST['trapLong'];


	//just need to add the lat and long and hardware id to the location table as well
	$sql = "INSERT INTO device(client_id, hardware_id, token, type, Upload_Interval)
			VALUES ('$active_client', '$active_hardware', $active_token, '$active_type','$active_uploadInterval');
			INSERT INTO location(device_id,latitude,longitude)
			VALUES ('$active_hardware','$active_lat','$active_long');";

	$fullname = $_SESSION['fullname'];

	if($conn->multi_query($sql) === true){
		$conn->close();
		header("Location:Erbuim_Main.html");
		// echo "<script>
		// window.location.href = 'Erbuim_Main.php';
	  // </script>";
		die();
	}
	else{
		$conn->close();
		echo "Please fill all fields.....!!!!!!!!!!!!";
		// echo "<script>
		// window.location.href = 'Erbuim_AddTrap.html';
	  // </script>";
		die();
	}

?>