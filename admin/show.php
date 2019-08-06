<?php
  include 'logged.php';
?>

<html style="background-color: #dbffdb; font-family: Sans-serif">
<h1 style="color: #d64848">Admin - Show</h1> 

<?php                
    // display the user aware navigation links
    if ($LOGGED_IN == true && $ADMIN == true){ // user is logged in and is an admin
        echo '<a href="http://localhost/contacts/home.php">User Home</a> // ';
        echo '<a href="./home.php">Admin Home</a> // ';
        echo '<a href="http://localhost/contacts/logout.php">Logout</a>';
    }
    else{ // user is not logged in
        header("Location: http://localhost/contacts/home.php");
    }
?>

    <hr/>


</html>