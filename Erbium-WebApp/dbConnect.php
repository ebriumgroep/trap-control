<?php
	function connect_database(){
		$servername = "localhost";
	    $dUsername = "id7227985_root";
	    $dPassword = "erbium";
		$db = "id7227985_erbium";

		return new mysqli($servername, $dUsername, $dPassword, $db);
	}
?>