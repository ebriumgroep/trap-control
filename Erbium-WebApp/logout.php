<?php
    session_start();
    
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    //setcookie(PHPSESSID, 'value', time()-1);
    
	header("location:index.html");
?>