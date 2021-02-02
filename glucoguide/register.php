<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
	<div class="input-group">
  	  <label>Userid</label>
  	  <input type="text" name="userid" value="<?php echo $userid; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address" value="<?php echo $address; ?>">
  	</div>
	<div class="input-group">
  	  <label>Phone</label>
  	  <input type="text" name="phone" value="<?php echo $phone; ?>">
  	</div>
	<div>
  	  <label>You Are:</label>
  	  Doctor<input type="radio" name="category" value="doctor">
	  Patient<input type="radio" name="category" value="patient">
  	</div>
	<div class="input-group">
  	  <label>Choose your doctor</label>
  	  <input type="text" name="doctorid" value="<?php echo $doctorid; ?>">
  	</div>
	<div class="input-group">
  	  <label>Hospital</label>
  	  <input type="text" name="hospital" value="<?php echo $hospital; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>