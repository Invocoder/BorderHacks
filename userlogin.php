<?php
session_start();
error_reporting(0);
include("Ndb.php");
if (isset($_POST['submit'])) {
	$ret = mysqli_query($db, "SELECT * FROM student WHERE email='" . $_POST['email'] . "' and password='" . $_POST['password'] . "'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['id'] = $num['student_id'];
		$_SESSION['name'] = $num['name'];
		$_SESSION['showFeedback'] = true;
		$status = 1;
		$log = mysqli_query($db, "insert into userlog(uid,username,userip,status) values('" . $_SESSION['id'] . "','" . $_SESSION['login'] . "','$uip','$status')");
		header("location:index.php");
		exit();
	} else {
		$_SESSION['login'] = $_POST['username'];
		$status = 0;
		mysqli_query($db, "insert into userlog(username,userip,status) values('" . $_SESSION['login'] . "','$uip','$status')");
		$errormsg = "Invalid username or password";
		header("location:userlogin.php");
	}
}



if (isset($_POST['change'])) {
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = $_POST['password'];
	$query = mysqli_query($db, "SELECT * FROM student WHERE email='$email' and mobile='$mobile'");
	$num = mysqli_fetch_array($query);
	if ($num > 0) {
		mysqli_query($db, "update student set password='$password' WHERE email='$email' and mobile='$mobile' ");
		$msg = "Password Changed Successfully";
	} else {
		$errormsg = "Invalid email id or Contact no";
	}
}
?>

<!DOCTYPE html>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page | MyPhysicianCare </title>
  <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>
 
<div class="container">
  <div class="left-section">
    <div class="header">
      <h1 class="animation a1">Welcome to Myphysiciancare</h1>
      <h4 class="animation a2">Log in for accesssing online test</h4>
    </div>
    <div class="form">
      <input type="email" class="form-field animation a3" placeholder="Username">
      <input type="password" class="form-field animation a4" placeholder="Password">
      <p class="animation a5"><a href="#">Forgot Password</a></p>
      <button class="animation a6">LOGIN</button>
    </div>
  </div>
  <div class="right-section"></div>
</div>
  
</body>
</html>