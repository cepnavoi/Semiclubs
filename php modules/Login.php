<?php
include("Config.php"); 
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	  $EnteredUsername = mysqli_real_escape_string($db,$_POST['username']);
      $EnteredPassword = mysqli_real_escape_string($db,$_POST['password']);  
	  $sql = "select Password from Users where Username = '$EnteredUsername'";
	  $PasswordHash = mysqli_query($db,$sql);
	  if(mysqli_fetch_array($PasswordHash,MYSQLI_ASSOC)==1) {
		  if(password_verify($EnteredPassword,$PasswordHash)) {
			  $_SESSION['semiclubs_user'] = $myusername;
			  // Login complete, proceed to next area
		  } else {
			//Display password is incorrect  
		  }
	  }else {
		  //Display username is incorrect
	  }
   }
?>
<html>
<head>
<title>Login</title>
</head>
<body>
<form action = "" method = "post">
<div class="form-input">
<input type="text" name="username" placeholder="username">
</div>
<div class="form-input">
<input type="password" name="password" placeholder="password">
</div>
<input type="submit" name="submit" value="LOGIN" class="btn-login">
</form>
</body>
</html>
