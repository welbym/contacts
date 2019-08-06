<html style="background-color: #dbffdb; font-family: Sans-serif">
    
<h1 style="color: #d64848">Contacts - User Login Page</h1>
<a href="/contacts/home.php">Home</a> //
<a href="./register.php">Register</a> //
<a href="./login.php">Login</a>

<hr />

<?php
    // check to see if the user successfully created an account
    if (isset($success) && $success == true){
        echo '<font color="green">You have logged in. Please go to the <a href="./contacts/home.php">home page</a>.<font>';
    }
    // check to see if the error message is set, if so display it
    else if (isset($error_msg))
        echo '<font color="red">'.$error_msg.'</font>';    
?>

    <form action="./login.php" method="POST" name="registerForm">
    <table>
        <tr><td>Email: <font color="blue">*</font></td></tr>
        <tr><td><input type="text" value="" name="email" size="35" /></td></tr>
        <tr><td>Password: <font color="blue">*</font></td></tr>
        <tr><td><input type="password" value="" name="passwd" size="35" /></td></tr>
        <tr><td>
            <input type="submit" name="loginBtn" value="Login" />
            <font color="blue">*</font> = required fields
        </td></tr>
    </table>
</form>   

</html>

<?php
    // include our connect script
    require_once("connect.php");

    $email = "";
    $passwd = "";

    // check to see if there is a user already logged in, if so redirect them
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['userid']))
        header("Location: ./contacts/home.php"); // redirect the user to the user home
    
    // check to see if the user clicked the login button
    if (isset($_POST['loginBtn'])){
    // get the form data for processing
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    include 'connect.php';

    // make sure the required fields were entered
    if ($email != "" && $passwd != ""){ 
        // next code block
    // query the database to see if the username exists
    $query = mysqli_query($conn, "SELECT * FROM People WHERE email='{$email}'");
    if (mysqli_num_rows($query) == 1){
    // get the record from the query
    $record = mysqli_fetch_assoc($query);
    
    // encrypt the user's password
    //$passwd = md5($passwd);
    
    // compare the passwords to make sure they match
    if ($passwd === $record['passwd']){
            // next code block
 
/* IF YOU GET HERE THE USER CAN LOGIN */
 
$_SESSION['email'] = $record['email'];
$_SESSION['userid'] = $record['id'];
$_SESSION['first_name'] = $record['first_name'];
$_SESSION['admin'] = $record['admin'];
 
$success = true;
 
// redirect the user to the user home
header("Location: ./home.php");

    }
    else
        $error_msg = 'Your password was incorrect.';
}
else
    $error_msg = 'That account does not exist.';
    }
    else
        $error_msg = 'Please fill out all required fields.';
    }
?>
