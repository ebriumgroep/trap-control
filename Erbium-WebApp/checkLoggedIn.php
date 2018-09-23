<?php
	session_start();
    if($_SESSION['sid'] == session_id()){
    	echo true;
    }else{
    	echo false;
    }
?>