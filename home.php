<?php
  include 'logged.php';
  //include 'links.php';
?>

<html style="background-color: #dbffdb; font-family: Sans-serif">
    
<h1 style="color: #d64848">Contacts - Home</h1> 
<a href="./home.php">Home</a> //

<?php                
    // display the user aware navigation links
    if ($LOGGED_IN == true){ // user is logged in
        echo '<a href="./sleepingCat.php">Cat</a> // ';
        echo '<a href="./logout.php">Logout</a>';
    if ($ADMIN == true)
        echo ' // <a href="./admin/home.php">Admin Home</a>';
    }
    else{ // user is not logged in
        echo '<a href="./register.php">Register</a> // ';
        echo '<a href="./login.php">Login</a>';
    }
?>

    <hr />
    <p style="font-size: 20">

<?php
    if ($LOGGED_IN == true){ // user is logged in
       if ($ADMIN == false){
          echo 'Hello '.$_SESSION['first_name'].', how are you today?<br /><br />';
       } else if ($ADMIN == true){
          echo 'Hello Admin, '.$_SESSION['first_name'].', how are you today?<br /><br />';
       }
    }
    else if ($LOGGED_IN == false){ // user is not logged in
    echo "Welcome, guest. Please Login in or Register at the links above to make a new Contacts account.";
    }

?>
</p>
</html>

