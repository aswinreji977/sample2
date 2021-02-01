<!DOCTYPE html>
<html>
<head>
<title>Doctor</title>
</head>
<body>
<?php
session_start();
$conn = new mysqli('localhost','root','','sample2');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$id=$_POST['userid'];
$password=$_POST['password'];
$_SESSION['id']=$id;
$sql = "select * from doctor where userid = '$id' and password = '$password'";
$result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);  
          
        if($count == 1){  
			$username=$row["username"];
            echo "<h1 align='center'>Hi,".$username."</h1><br>";
			$sql1= "select * from patient where doctorid = '$id'";
			$result1 = mysqli_query($conn, $sql1);  
			echo "Your patients";
			echo "<table border='1'>
    <tr>
        
        <th>Name</th>
		<th>Phone</th>

    </tr>";
	

while ($row2 = mysqli_fetch_array($result1)) {
    echo"
        <tr>
            <td>$row2[0]</td>
			<td>$row2[3]</td>

        </tr>";

}

echo"
</table>";
		}
			else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";
		}
?>
</body>
</html>
		