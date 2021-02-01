<!DOCTYPE html>
<html>
<head>
<title>values</title>
</head>
<body><?php 
		session_start();
		$val1=$_POST['value1'];
		$val2=$_POST['value2'];
		$val3=$_POST['value3'];
		$id=$_SESSION['id'];
		$sum=$val1+$val2+$val3;
		$avg=$sum/3;
		
		if($avg<60)
			echo "Prick and input the reading <form action=' ' method='post'>
					<input type='text' name='prick'></form>";
		elseif($avg<80)
			echo "normal";
	
		
?>
</body>
</html