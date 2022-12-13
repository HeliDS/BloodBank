<?php
    ob_start(); //prevent  Warning: Cannot modify header information - headers already sent in 000webhost
    session_start(); 
    session_unset(); // remove all session variables
    if( session_destroy() ) { // destroy the session and check it's succeeded or not
        header("Location: index.php");
        exit();
    }
?>