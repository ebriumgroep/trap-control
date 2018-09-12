<?php
	function phpAlert($msg){
		echo '<script type = "text/javascript">alert("'.$msg.'")</script>';
		//echo '<p>Please make sure your login details are correct</p>';
	}

	function phpLog($msg){
		echo '<script type = "text/javascript">console.log("'.$msg.'")</script>';
	}

	$servername = "localhost";
	$dUsername = "root";
	$dPassword = "";
	$db = "erbium";
	$databaseGranted = false;
	$wrongPassword = false;

	$active_username = $_POST["username"];
	$active_password = $_POST["password"];
	$active_clientid = "";
	$active_fullname = "";


	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
	$sql = "SELECT client_id, username, password, full_name FROM Client";
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
       	phpAlert("Access Granted");
		header('Location: Erbuim_Main.php');
	}
	else if($wrongPassword){
		$conn->close();
		phpAlert("Password entered is wrong!");
		header('Location: index.html');
	}
	else{
		$conn->close();
		phpAlert("Incorrect username or password!");
		header('Location: index.html');
	}

?>