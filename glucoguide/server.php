<?php
session_start();

// initializing variables
$username="";
$userid="";
$password="";
$category="";
$address="";
$phone="";
$email="";
$hospital="";
$doctorid="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'glucoguide');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $category = mysqli_real_escape_string($db, $_POST['category']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  if($category=="doctor"){
	  
	  $hospital=mysqli_real_escape_string($db, $_POST['hospital']);
	  }
	if($category=="patient"){
		
		$doctorid= mysqli_real_escape_string($db, $_POST['doctorid']);
	  }
	 
  
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE userid='$userid'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['userid'] === $userid) {
      array_push($errors, "Userid already exists");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username,userid,password,category) 
  			  VALUES('$username', '$userid', '$password','$category')";
  	mysqli_query($db, $query);
	if($category=="doctor"){
	$query2 = "INSERT INTO doctor (username,userid,phone,ADDRESS,emailid,Hospital) 
				   VALUES('$username', '$userid', '$email','$address','$hospital')";
		$result=mysqli_query($db, $query2);
		if(!$result)
			echo"error";
		$query3 = "INSERT INTO doctor_settings (d_id) 
				   VALUES('$userid')";
	mysqli_query($db, $query3);}
	if($category=="patient"){
		$query4 = "INSERT INTO patient (username,userid,phone,address,emailid) 
				   VALUES('$username', '$userid', '$email','$address')";
		mysqli_query($db, $query4);
		$default = "SELECT * FROM doctor_settings WHERE d_id='$doctorid'";
		$result = mysqli_query($db, $default);
		$values = mysqli_fetch_assoc($result);
  
		if ($values) { 
			$def= $values['default_count'] ;
			$l= $values['lower_value'];
			$h= $values['upper_value'] ;
				
			}
		$query5 = "INSERT INTO case_file (d_id,p_id,default_count,lower_value,upper_value) 
				   VALUES('$doctorid','$userid','$def','$l','$h')";
		mysqli_query($db, $query5);
	}
		
		
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
	
	
  }
  
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $userid = mysqli_real_escape_string($db, $_POST['userid']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($userid)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE userid='$userid' AND password='$password'";
  	$results = mysqli_query($db, $query);

	$row = mysqli_fetch_array($results, MYSQLI_ASSOC);  
		
          
       
  	if (mysqli_num_rows($results) == 1) {
		$username=$row["username"];
		$category=$row["category"];
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  if($category=="patient"){
  	  header('location: index.php');}
	  if($category=="doctor"){
	  header('location: index2.php');}
	  
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>