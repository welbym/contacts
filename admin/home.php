<?php
  include 'logged.php';
?>

<html style="background-color: #dbffdb; font-family: Sans-serif">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<h1 style="color: #d64848">Admin - Home</h1> 

<?php                
    // display the user aware navigation links
    if ($LOGGED_IN == true && $ADMIN == true){ // user is logged in and is an admin
        echo '<a href="http://localhost/contacts/home.php">User Home</a> // ';
        echo '<a href="http://localhost/contacts/logout.php">Logout</a>';
    }
    else{ // user is not logged in
        header("Location: http://localhost/contacts/home.php");
    }
?>

    <hr/>
    <p style="font-size: 20">

<?php
    echo 'Hello Admin, '.$_SESSION['first_name'].'.';
    $_SESSION['entryID'] = null;
?>
</p> 
<button style="border: 2px solid #888; background-color:#deeeed; font-family:courier; height: 40; width: 150;"onclick="window.location.href = './create.php';">Add new member</button>
<p>

</p> 

<style>
table{
  border: 2px solid #888; border-spacing: 8px; color:#000000;background-color:#ffffff; }
th{ font-size: 20px; }
td { padding: 8px; color: #d64848; background-color: #deeeed; }
button { border: 2px solid #888; background-color:#deeeed; font-family:courier;}
</style> <p> <?php
    include 'connect.php';
    $sql = "SELECT first_name, last_name, id FROM People";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table style><tr><th>ID</th><th>Name</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
    ?>
   <tr id="delete<?php echo $row['id'] ?>">
     <td><?php echo $row['id']?></td>
     <td><?php echo $row['first_name']." ".$row['last_name']?></td>
     
<!-- Show Button -->
     <td><button onclick=" <?php echo $_SESSION['entryID'] = $row['id'] ?>; window.location.href = './show.php'">Show</button></td>

<!-- Edit Button -->
     <td><button onclick="window.location.href = './edit.php'">Edit</button></td>

<!-- Delete Button -->
     <td><button onclick="deleteAjax(<?php echo $row['id'] ?>)" class="btn btn-danger">Delete</button></td>
   </tr> <?php
    }
    echo "</table>";
    } else {
    echo "0 results";
    }

mysqli_close($conn);
?>
</p>

<script type="text/javascript">

function deleteAjax(id){

if(confirm('Do you really want to do that?')){

$.ajax({
type: 'post',
url: 'delete.php',
data:{delete_id:id},
success:function(data){

$('#delete'+id).hide();

}});}}
</script>

</html>
