<?php
    include 'dbConnect.php';
    $conn = connect_database();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo 'Value:'.$HTTP_RAW_POST_DATA;
    $data = explode(",", file_get_contents("php://input"));
    $timeStamp = $data[0].' '.$data[1];
    $sql = "INSERT INTO trap_count(time_stamp, device_id) VALUES ('$timeStamp', '$data[2]')";

    if($conn->query($sql) === true){
        $conn->close();
        //echo "Successful";
        echo '1';
    }
    else{
        $conn->close();
        //echo "Not Successful";
        echo '0';
    }
?>