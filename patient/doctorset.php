<?php 
session_start();
	
	
	$conn = new mysqli('localhost','root','','sample2');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$doc=$_POST['doctor'];

  $sql = "select userid from doctor where username = '$doc'";
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
  $id=$_SESSION['id'];        
        if($count == 1){  
			$userid=$row["userid"];
			
            $ins = "UPDATE patient
				 SET doctorid='$userid' WHERE userid=$id";
if ($conn->query($ins) === TRUE) {
	echo "<h1>".$doc." is assigned for you</h1>";
	

        } } 
        else{  
            echo "<h1>No doctor found</h1>";
		}
		
		

?>