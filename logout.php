<?php
    // verify the user is logged in
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['userid'])){
        
        /* IF YOU ARE HERE THEN THE USER IS LOGGED IN, AND WE CAN LOG THEM OUT */
        session_destroy();
        
        // redirect to the home page
        header("Location: http://localhost/contacts/home.php");
    }
    else
        header("Location: ./login.php"); // redirect the user to the login page
        
?>
