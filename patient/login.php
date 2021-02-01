<!DOCTYPE html>
<html>
<head>
<title>
Patient</title>
</head>
<body><?php
session_start();
$conn = new mysqli('localhost','root','','sample2');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id=$_POST['userid'];
$password=$_POST['password'];
$_SESSION['id']=$id;
  $sql = "select * from patient where userid = '$id' and password = '$password'";
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
			$username=$row["username"];
            echo "<h1 align='center'>Hi,".$username."</h1><br>";
			$result2 = mysqli_query($conn, $sql);  
$row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count2 = mysqli_num_rows($result2); 
		
			$doctorid=$row["doctorid"];
		if($doctorid!=NULL)
			echo "<form action='values.php' method='POST'>
		<h2>Enter values<h2>
		<input type='textbox' name='value1'><br>
		<input type='textbox' name='value2'><br>
		<input type='textbox' name='value3'><br>
		<input type='submit' value='Save' name='save'>
		
		</form>";
		else 
			echo"<form action='doctorset.php' method='post'>
Your doctor name <input type='text' name='doctor' value='Dr.'>
<input type='submit' name='doc_set' value='submit'>
</form>";

        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";
		}
		 

?>
</body>
</html>
