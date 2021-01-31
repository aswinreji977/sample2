<?php

$conn = new mysqli('localhost','root','','sample2');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$name=$_POST['username'];
$id=$_POST['userid'];
$password=$_POST['password'];
$phone=$_POST['phone'];
$ins = "INSERT INTO patient (username,userid,password,Phone) 
VALUES ('$name','$id','$password','$phone')";
if ($conn->query($ins) === TRUE) {
	echo "You have successfully registered";
	echo "<br>Go back to login <a href='login.html'>Login In </a>";
} else {
  echo "Error: " . $ins . "<br>" . $conn->error;
}



?>
