<?php 
include('../functions.php');

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
    $query= $mysqli->query("SELECT id,recipient_email,amount from peer_record WHERE id='$id'");
    
}     

$row = mysqli_fetch_array($query);
$recipient_email=$row['recipient_email'];
$amount=$row['amount'];

if (isset($_SESSION['user'])) {				
		
    $user = $_SESSION['user'];
    $sender_id = $user['id'];
    $sender_email = $user['email'];
    $sender_username = $user['username'];
    $sender_first_name=$user['first_name'];
    $sender_last_name=$user['last_name'];
    $sender_name = $sender_first_name. ' ' .$sender_last_name;
}

$query = "UPDATE peer_record SET sender_email='$sender_email' ,sender_username='$sender_username' ,sender_name='$sender_name', status='sent_0' WHERE id='$id'";
			mysqli_query($mysqli, $query);

// $mysqli->query("UPDATE peer_record SET sender_email='$sender_email' ,sender_username='$sender_username' ,sender_name='$sender_name', 
// status='sent' WHERE id='$id''");

$mysqli->query("UPDATE users SET balance=balance+'$amount' WHERE email='$recipient_email'");
header('location: peerrecords.php');
?>

