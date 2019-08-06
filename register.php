
<html style="background-color: #dbffdb; font-family: Sans-serif">
    
<h1 style="color: #d64848">Contacts - User Register Page</h1>
<a href="/contacts/home.php">Home</a> //
<a href="./register.php">Register</a> //
<a href="./login.php">Login</a>

<hr />

<form action="./register.php" method="POST" name="registerForm">
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
        <tr><td>
            <input type="submit" name="registerBtn" value="Register" />
            <font color="blue">*</font> = required fields
        </td></tr>
    </table>
</form>
</html>

<?php
    // connect to the database
    // check for a user being logged in
    // process the register form data
    // check to see if the user successfully created an account

    // include our connect script
    require_once("connect.php");
    
    // check to see if there is a user already logged in, if so redirect them
    session_start();
    if (isset($_SESSION['userid']))
        header("Location: ./contacts/home.php"); // redirect the user to the home page

    // initialize the variables
$first_name = "";
$last_name = "";
$age = "0";
$email = "";
$passwd = "";
$passwd = "";
$error_msg = null;

    if (isset($_POST['registerBtn'])){
    // get all of the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $passwd_again = $_POST['passwd_again'];
    
    // next code block
    // verify all the required form data was entered
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
        $sql = "INSERT INTO People (first_name, last_name, age, email, passwd)
        VALUES ('$first_name', '$last_name', '$age', '$email', '$passwd')";
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
        echo '<font color="green">Yay!! Your account has been created. <a href="./login.php">Click here</a> to login!<font>';
    }
    // check to see if the error message is set, if so display it
    else if (isset($error_msg))
        echo '<font color="red">'.$error_msg.'</font>';
?>
