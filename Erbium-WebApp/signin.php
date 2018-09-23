<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	$databaseGranted = false;
	$wrongPassword = false;

	$active_username = $_POST["username"];
	$active_password = $_POST["password"];
	$active_clientid = "";
	$active_fullname = "";

    $sql = "SELECT * FROM client";
	$result = $conn->query($sql);

	//Check if the user is in the database
	if($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc()) {
			# code...
			if($row["username"] == $active_username)
			{
				if($row["password"] == $active_password)
				{
					$active_clientid = $row['client_id'];
					$active_fullname = $row['full_name'];
					$databaseGranted = true;
					break;
				}
				else
				{
					$wrongPassword = true;
					break;
				}
			}
		}
	}

		
	if($databaseGranted){
		$conn->close();
		session_start();
        $_SESSION['sid'] = session_id();
		$_SESSION['username'] = $active_username;
		$_SESSION['clientId'] = $active_clientid;
		$_SESSION['fullname'] = $active_fullname;
		// header('Location: Erbuim_Main.php');
		echo 0;
	}
	else if($wrongPassword){
		$conn->close();
		// header("refresh:0.5; url = index.html");
		// echo "Password entered is wrong!";
		echo 1;
		// header('Location: index.html');
	}
	else{
		$conn->close();
		// header("refresh:0.5; url = index.html");
		echo 2;
		// header('Location: index.html');
	}

?>