<?php
   include('Config.php');
   session_start();
   $user_check = mysqli_real_escape_string($_SESSION['semiclubs_user']);
	$ses_sql = mysqli_query($db,"select Username from SemiClubsdb where username = '$user_check'");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$_SESSION = $row['Username'];
	 if(!isset($_SESSION['semiclubs_user'])){
      //redirect to login
   }
   ?>