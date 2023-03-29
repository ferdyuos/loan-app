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
    $query= $mysqli->query("SELECT id,recipient_email,amount from loan_record WHERE id='$id'");
    
}     

$row = mysqli_fetch_array($query);
$recipient_email=$row['recipient_email'];
$amount=$row['amount'];

if (isset($_SESSION['entity'])) {				
		
    $entity = $_SESSION['entity'];
    $sender_id = $entity['id'];
    $sender_email = $entity['email'];
    $sender_username = $entity['username'];
    $sender_name=$entity['name'];
}

$query = "UPDATE loan_record SET granted_entity_email='$sender_email' ,granted_entity_username='$sender_username' ,granted_entity_name='$sender_name', status='sent_1' WHERE id='$id'";
			mysqli_query($mysqli, $query);

$mysqli->query("UPDATE users SET balance=balance+'$amount' WHERE email='$recipient_email'");
header('location: loanrecords.php');
?>

