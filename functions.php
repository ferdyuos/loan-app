<?php 
session_start();
                   
// MySQL database connection                       
$mysqli = new mysqli("localhost:3306","emeka","emeka123","loan");
if (mysqli_connect_error())
{
	die(" Database conection failed: " .mysqli_connect_error());
}
echo"Connected successfully";


//php method to collect time and date
date_default_timezone_set('Africa/Lagos');
$date = date("Fj,Y");
$time=date("g:i A");
$date_created = $date. ' '.$time;


// variable declaration
$email    = "";
$errors   = array(); 



/* HTML Button Calls
*/

// call the register() function if register_btn is clicked
if (isset($_POST['register_admin_btn'])) {
	registeradmin();
}
// call the registeruser() function if user_register_btn is clicked
if (isset($_POST['user_register_btn'])) {
	registeruser();
}
// call the registerentity() function if entity_register_btn is clicked
if (isset($_POST['entity_register_btn'])) {
	registerentity();
}
// call adminlogin() function if admin_login_btn is clicked
if (isset($_POST['admin_login_btn'])) {
	adminlogin();
}
// call userlogin() function if user_login_btn is clicked
if (isset($_POST['user_login_btn'])) {
	userlogin();
}
// call entitylogin() function if entity_login_btn is clicked
if (isset($_POST['entity_login_btn'])) {
	entitylogin();
}
// call the loanrequest() function if loan_request_btn is clicked
if (isset($_POST['loan_request_btn'])) {
	loanrequest();
}
// call the peerequest() function if peer_request_btn is clicked
if (isset($_POST['peer_request_btn'])) {
	peerequest();
}
// call the update_ranking() function if update_ranking_btn is clicked
if (isset($_POST['update_ranking_btn'])) {
	update_ranking();
}


/* Check If its User, Admin, Entity
*/
function isUser()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
function isAdmin()
{
	if (isset($_SESSION['admin']) && $_SESSION['admin']['type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}
function isEntity()
{
	if (isset($_SESSION['entity'])) {
		return true;
	}else{
		return false;
	}
}


/* function to check user,admin,entity by id and return user array from id
*/
function getAdminById($id){
	global $mysqli;
	$query = "SELECT * FROM admins WHERE id=" . $id;
	$result = mysqli_query($mysqli, $query);

	$admin = mysqli_fetch_assoc($result);
	return $admin;
}
function getUserById($id){
	global $mysqli;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($mysqli, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}
function getEntityById($id){
	global $mysqli;
	$query = "SELECT * FROM entities WHERE id=" . $id;
	$result = mysqli_query($mysqli, $query);

	$entity = mysqli_fetch_assoc($result);
	return $entity;
}


// escape string
function e($val){
	global $mysqli;
	return mysqli_real_escape_string($mysqli, trim($val));
}
//display error
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

// To check if user is logged in
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}


/* REGISTER ADMIN
*/
function registeradmin()
{
	// call these variables with the global keyword to make them available in function
	global $mysqli, $errors, $email,$date_created;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$email       =  e($_POST['email']);
	$password  =  e($_POST['password']);
	$confirm_password  =  e($_POST['confirm_password']);

	// form validation: ensure that the form is correctly filled
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirm_password) {
		array_push($errors, "The two passwords do not match");
	}

	// register admin if there are no errors in the form
	if (count($errors) == 0) {
        $password_encrypt = md5($password);//encrypt the password before saving in the database
    
		// GETS type from user form and inserts into admins database
		if (isset($_POST['type'])) {
			$type = e($_POST['type']);
			$query = "INSERT INTO admins (email, type, password) 
					  VALUES('$email', '$type', '$password_encrypt')";
			mysqli_query($mysqli, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: settings.php');
		}else{
			$query = "INSERT INTO admins (email, type, password,date_created) 
					  VALUES('$email', 'user', '$password_encrypt','$date_created')";
			mysqli_query($mysqli, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($mysqli);

			$_SESSION['admin'] = getAdminById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}



/* REGISTER USER
*/
function registeruser()
{
	// call these variables with the global keyword to make them available in function
	global $mysqli, $errors, $email, $date_created;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$firstName       =  e($_POST['first_name']);
	$lastName       =  e($_POST['last_name']);
	$matric       =  e($_POST['matric']);
	$department       =  e($_POST['department']);
	$hostel       =  e($_POST['hostel']);
	$email       =  e($_POST['email']);
	$username       =  e($_POST['username']);
	$nin  =  e($_POST['nin']);
	$bvn  =  e($_POST['bvn']);
	$password  =  e($_POST['password']);
	$confirmPassword  =  e($_POST['confirm_password']);

	// form validation: ensure that the form is correctly filled
	if (empty($firstName)) { 
		array_push($errors, "First Name is required"); 
	}
	if (empty($lastName)) { 
		array_push($errors, "Last Name is required"); 
	}
	if (empty($matric)) { 
		array_push($errors, "Matric No. is required"); 
	}
	if (empty($department)) { 
		array_push($errors, "Department is required"); 
	}
	if (empty($hostel)) { 
		array_push($errors, "Hostel is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($nin)) { 
		array_push($errors, "NIN is required"); 
	}
	if (empty($bvn)) { 
		array_push($errors, "BVN is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirmPassword) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
        $password_encrypt = md5($password);

		$query = "INSERT INTO users (first_name,last_name,email,username,nin, bvn,password,date_created,balance,ratings,matric_no,department,hostel) 
					VALUES('$firstName','$lastName','$email','$username','$nin','$bvn','$password_encrypt','$date_created','0','0.0','$matric','$department','$hostel')";
		mysqli_query($mysqli, $query);
		$_SESSION['success']  = "New user successfully created!!";

		header('location: index.php');
		$logged_in_user_id = mysqli_insert_id($mysqli);
		$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
		$_SESSION['success']  = "You are now logged in";				
		
	}
}


/* REGISTER ENTITY
*/
function registerentity()
{
	// call these variables with the global keyword to make them available in function
	global $mysqli, $errors, $email, $date_created;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$name=  e($_POST['name']);
	$email       =  e($_POST['email']);
	$username       =  e($_POST['username']);
	$cac_number  =  e($_POST['cac']);
	$password  =  e($_POST['password']);
	$confirmPassword  =  e($_POST['confirm_password']);

	// form validation: ensure that the form is correctly filled
	if (empty($name)) { 
		array_push($errors, "Name is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($cac_number)) { 
		array_push($errors, "CAC Number is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirmPassword) {
		array_push($errors, "The two passwords do not match");
	}

	// register entity if there are no errors in the form
	if (count($errors) == 0) {
        $password_encrypt = md5($password);//encrypt the password before saving in the database
       

		$type = e($_POST['type']);
		$query = "INSERT INTO entities (email,username,name,cac_number,password,date_created) 
					VALUES('$email','$username','$name','$cac_number','$password_encrypt','$date_created')";
		mysqli_query($mysqli, $query);
		$_SESSION['success']  = "New user successfully created!!";
		header('location: index.php');
		$logged_in_user_id = mysqli_insert_id($mysqli);
		$_SESSION['entity'] = getEntityById($logged_in_user_id); // put logged in user in session
		$_SESSION['success']  = "You are now logged in";				
		
	} 
}



/*  ADMIN LOGIN
*/
function adminlogin(){
	global $mysqli, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password_encrypt = md5($password);
		//$password_encrypt = password_hash($password, PASSWORD_DEFAULT);//encrypt the password before saving in the database
		$query = "SELECT * FROM admins WHERE email='$email' AND password='$password_encrypt' LIMIT 1";
		$results = mysqli_query($mysqli, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['type'] == 'admin') {

				$_SESSION['admin'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');		  
			}
			elseif  ($logged_in_user['type'] == 'user') {

				$_SESSION['admin'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');		  
			}
			
			else{
				$_SESSION['admin'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: login.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}


/*  ENTITY LOGIN
*/
function entitylogin(){
	global $mysqli, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password_encrypt = md5($password);
		$query = "SELECT * FROM entities WHERE email='$email' AND password='$password_encrypt' LIMIT 1";
		$results = mysqli_query($mysqli, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);

			$_SESSION['entity'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');		  
		}
		else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}



/* USER LOGIN
*/
function userlogin(){
	global $mysqli, $email, $errors;

	// grap form values
	$email = e($_POST['email']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password_encrypt = md5($password);
		$query = "SELECT * FROM users WHERE email='$email' AND password='$password_encrypt' LIMIT 1";
		$results = mysqli_query($mysqli, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);

			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');		  
		}
		else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}



/* INSERT INTO loan_RECORD TABLE IF A USER SENDS A loan REQUEST
*/
function loanrequest()
{
	global $mysqli,$errors,$date_created;

	// grap form values
	$amount = e($_POST['amount']);
	$recieved_sender_username = e($_POST['entity_username']);
	$description = e($_POST['description']);

	$query= $mysqli->query("SELECT id,email,username,name from entities WHERE username='$recieved_sender_username'");
	$row = mysqli_fetch_array($query);
	$sender_id=$row['id'];
	$sender_email=$row['email'];
	$sender_username=$row['username'];
	$sender_name=$row['name'];
	
	// make sure form is filled properly
	if (empty($amount)) {
		array_push($errors, "Amount is required");
	}
	
	if (empty($description)) {
		array_push($errors, "Description is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		
		if (isset($_SESSION['user'])) {				
		
		$user = $_SESSION['user'];
		$recipient_id = $user['id'];
		$recipient_email = $user['email'];
		$recipient_username = $user['username'];
		$recipient_first_name=$user['first_name'];
		$recipient_last_name=$user['last_name'];
		$recipient_name = $recipient_first_name. ' ' .$recipient_last_name;

		if($recieved_sender_username=$sender_username) {
			$query = "INSERT INTO loan_record (granted_entity_id,granted_entity_email,granted_entity_username,granted_entity_name,recipient_id,recipient_email,recipient_username,recipient_name,amount,description,date_created) 
					VALUES('$sender_id','$sender_email','$sender_username','$sender_name','$recipient_id','$recipient_email','$recipient_username','$recipient_name','$amount','$description','$date_created')";
			mysqli_query($mysqli, $query);
			header('location: loanrequest.php');
		}


		else if(empty($recieved_sender_username)){
			$query = "INSERT INTO loan_record (recipient_id,recipient_email,recipient_username,recipient_name,amount,description,date_created) 
					VALUES('$recipient_id','$recipient_email','$recipient_username','$recipient_name','$amount','$description','$date_created')";
			mysqli_query($mysqli, $query);
			header('location: loanrequest.php');
		}
		
		}

		
		
	}
}


/* INSERT INTO PEER_RECORD TABLE IF A USER SENDS A PEER loan REQUEST
*/
function peerequest()
{
	global $mysqli,$errors,$date_created;

	// grap form values
	$amount = e($_POST['amount']);
	$recieved_sender_username = e($_POST['peer_username']);
	$description = e($_POST['description']);

	$query= $mysqli->query("SELECT id,email,username,first_name,last_name from users WHERE username='$recieved_sender_username'");
	$row = mysqli_fetch_array($query);
	$sender_id=$row['id'];
	$sender_email=$row['email'];
	$sender_username=$row['username'];
	$sender_first_name=$row['first_name'];
	$sender_last_name=$row['last_name'];
	$sender_name = $sender_first_name. ' ' .$sender_last_name;

	
	// make sure form is filled properly
	if (empty($amount)) {
		array_push($errors, "Amount is required");
	}
	
	if (empty($description)) {
		array_push($errors, "Description is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		
		if (isset($_SESSION['user'])) {				
		
		$user = $_SESSION['user'];
		$recipient_id = $user['id'];
		$recipient_email = $user['email'];
		$recipient_username = $user['username'];
		$recipient_first_name=$user['first_name'];
		$recipient_last_name=$user['last_name'];
		$recipient_name = $recipient_first_name. ' ' .$recipient_last_name;

		if($recieved_sender_username=$sender_username) {
			$query = "INSERT INTO peer_record (sender_id,sender_email,sender_username,sender_name,recipient_id,recipient_email,recipient_username,recipient_name,amount,description,date_created) 
					VALUES('$sender_id','$sender_email','$sender_username','$sender_name','$recipient_id','$recipient_email','$recipient_username','$recipient_name','$amount','$description','$date_created')";
			mysqli_query($mysqli, $query);
			header('location: peerrequest.php');
		}


		else if(empty($recieved_sender_username)){
			$query = "INSERT INTO peer_record (recipient_id,recipient_email,recipient_username,recipient_name,amount,description,date_created) 
					VALUES('$recipient_id','$recipient_email','$recipient_username','$recipient_name','$amount','$description','$date_created')";
			mysqli_query($mysqli, $query);
			header('location: peerrequest.php');
		}
		
		}

		
		
	}
}


/* UPDATE USER RANKING 
*/
function update_ranking()
{

	global $mysqli, $errors, $email, $date_created;


	if (isset($_SESSION['user'])) {				
		
		$user = $_SESSION['user'];
		$id = $user['id'];
		$job_index = $user['job_index'];
		$experience = $user['experience'];
		$total_bank_balance = $user['total_bank_balance'];
		$guarantor_total_bank_balance = $user['guarantor_total_bank_balance'];
		$salary = $user['salary'];
	}

	$job_index= (int)$job_index;
	$experience= (int)$experience;
	$total_bank_balance= (int)$total_bank_balance;
	$guarantor_total_bank_balance= (int)$guarantor_total_bank_balance;
	$salary= (int)$salary;

	$ratings_1 = ($job_index*$experience) * ($total_bank_balance+$guarantor_total_bank_balance+$salary);
	$ratings= $ratings_1/100000000;

$query = "UPDATE users SET ratings='$ratings' WHERE id='$id'";
			mysqli_query($mysqli, $query);
header('location: index.php');
}