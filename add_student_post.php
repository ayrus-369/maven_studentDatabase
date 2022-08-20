<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_home.php");
	}
	$name=mysqli_real_escape_string($con,$_REQUEST['name']);
	$email=mysqli_real_escape_string($con,$_REQUEST['email']);
	$password=mysqli_real_escape_string($con,$_REQUEST['password']);
	$usertype=mysqli_real_escape_string($con,$_REQUEST['usertype']);

	$qr=mysqli_query($con,"INSERT into users (name,email,password,usertype,created_at) values ('".$name."','".$email."','".md5($password)."',' ".$usertype."','".date('Y-m-d H:i:s')."')");
	if($qr){
		header("Location:teacher_home.php?success=Added Successfully");
	}
	else{
		header("Location:teacher_home.php?error=Failed to Add Student");
	}
?>
<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}