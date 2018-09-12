<?php
	$servername = "localhost";
	$dUsername = "root";
	$dPassword = "root";
	$db = "erbium";

	session_start();
	$active_client = $_SESSION['clientId'];

	$conn = new mysqli($servername, $dUsername, $dPassword, $db);
//TODO

    $sql = "SELECT  client_id, hardware_id, token, type, Upload_Interval from device";
    $result = $conn->query($sql);
    $counter = 0;
	
	if($result->num_rows > 0)
	{
        $result_array = array();
		while ($row = $result->fetch_assoc()) {
			# code...
			if($row["client_id"] == $active_client)
			{
                $result_array[] = array($row["hardware_id"],$row["token"],$row["type"],$row["Upload_Interval"]);
				//$returnedString .=  $row["hardware_id"].' '.$row["type"]."\n";
            }
            $counter = $counter + 1;
		}
	}
	$conn->close();
	// echo "string";
    echo json_encode($result_array);
	return;
    // echo "data";
    // $json_array = json_encode($result_array);
    // phpLog($returnedString);
	//echo ($returnedString);

?>