<?php
  include 'logged.php';
?>

<html style="background-color: #dbffdb; font-family: Sans-serif">
    
<h1 style="color: #d64848">Admin - Create</h1> 

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
    $_POST['admin'] = 0;
?>

    <hr />
    <p style="font-size: 20">

<form action="./create.php" method="POST" name="createForm">
    <table cellpadding="1px">
        <tr><td>First Name: <font color="blue">*</font></td></tr>
        <tr><td><input type="text" value="" name="first_name" size="35" /></td></tr>
        <tr><td>Last Name:</td></tr>
        <tr><td><input type="text" value="" name="last_name" size="35" /></td></tr>
	<tr><td>Age:</td></tr>
        <tr><td><input type="int" value="" name="age" size="35" /></td></tr>
        <tr><td>Email Address:<font color="blue">*</font></td></tr>
        <tr><td><input type="text" value="" name="email" size="35" /></td></tr>
        <tr><td>Password: <font color="blue">*</font></td></tr>
        <tr><td><input type="password" value="" name="passwd" size="35" /></td></tr>
        <tr><td>password must be at least 5 characters and<br /> have a special character, e.g. !@#$%^&*()</font></td></tr>
        <tr><td>Confirm Password: <font color="blue">*</font></td></tr>
        <tr><td><input type="password" value="" name="passwd_again" size="35" /></td></tr>
        <tr><td>Admin:<input type="checkbox" value="1" name="admin" size="35"/></td></tr>
        <tr><td>
            <input type="submit" name="registerBtn" value="Create" />
            <font color="blue">*</font> = required fields
        </td></tr>
    </table>
</form>

<?php

    // include our connect script
    require_once("connect.php");
// initialize the variables
$first_name = "";
$last_name = "";
$age = "0";
$email = "";
$passwd = "";
$passwd = "";
$admin = 0;
$error_msg = null;

    if (isset($_POST['registerBtn'])){
    // get all of the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $admin = $_POST['admin'];
    $passwd_again = $_POST['passwd_again'];

    if ($first_name != "" && $email != "" && $passwd != "" && $passwd_again != ""){
    // make sure the two passwords match
    if ($passwd === $passwd_again){
        // make sure the password meets the min strength requirements
        if ( strlen($passwd) >= 5 && strpbrk($passwd, "!@#$%^&*()") != false ){
            // next code block
        // create and format some variables for the database
        $id = '';
        //$passwd = md5($passwd);
        // next code block
        if ($first_name != "" && $email != ""){ 
        include 'connect.php';
        $sql = "INSERT INTO People (first_name, last_name, age, email, passwd, admin)
        VALUES ('$first_name', '$last_name', '$age', '$email', '$passwd', $admin)";
        }

    if (mysqli_query($conn, $sql)) {
    $success = true;
    } else {
    $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

        }
        else
            $error_msg = 'Your password is not strong enough. Please use another.';
    }
    else
        $error_msg = 'Your passwords did not match.';
}
else
    $error_msg = 'Please fill out all required fields.';
}
 
 // check to see if the user successfully created an account
    if (isset($success) && $success = true){
        echo '<font color="green">Yay!! Your account has been created.';
    header("Location: ./home.php");
    }
    // check to see if the error message is set, if so display it
    else if (isset($error_msg))
        echo '<font color="red">'.$error_msg.'</font>';
?>

