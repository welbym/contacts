<?php
  include 'logged.php';
?>

<html style="background-color: #dbffdb; font-family: Sans-serif">
<h1 style="color: #d64848">Admin - Edit</h1> 

<?php                
    // display the user aware navigation links
    if ($LOGGED_IN == true && $ADMIN == true){ // user is logged in and is an admin
    	include 'links.php';
        echo $user_home_link;
        echo $logout_link;
    }
    else{ // user is not logged in
        header("Location: http://localhost/contacts/home.php");
    }
?>

    <hr/>

