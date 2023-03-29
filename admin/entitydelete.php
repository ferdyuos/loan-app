<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] == "GET")
if(isset($_GET['id']))
{
    $mysqli = new mysqli("localhost:3306", "emeka", "emeka123", "loan") or die ("connection failed: " .$mysqli->connect_error());
    $id = $_GET['id'];
    $query= $mysqli->query("SELECT email from entities WHERE id='$id'");
}     

while($row = mysqli_fetch_array($query))
{
    $mysqli->query("DELETE FROM entities WHERE id='$id'");
    print '<script>alert("deleted"); </script>';
}   
?>

