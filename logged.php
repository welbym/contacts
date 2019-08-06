<?php
// include our connect
    require_once("connect.php");
    
    // check to see if there is a user already logged in
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['userid'])){
        $LOGGED_IN = true;
    if ($_SESSION['admin'] == true)
        $ADMIN = true;
    else
        $ADMIN = false;
    } else
        $LOGGED_IN = false;
?>