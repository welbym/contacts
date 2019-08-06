<?php 
include 'connect.php';


$id = $_POST['delete_id'];
$query = mysqli_query($conn, "DELETE FROM People WHERE id='$id'")
?>


