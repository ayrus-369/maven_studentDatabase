<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_home.php");
	}
    $id=mysqli_real_escape_string($con,$_REQUEST['id']);
	$name=mysqli_real_escape_string($con,$_REQUEST['name']);
	$email=mysqli_real_escape_string($con,$_REQUEST['email']);
	$password=mysqli_real_escape_string($con,$_REQUEST['password']);
	

	$qr=mysqli_query($con,"UPDATE `users` set name='$name',email='$email',password='$password'where id='$id'");
	
    if($qr){
		header("Location:teacher_home.php?up-success=Updated Successfully");
	}
	else{
		header("Location:teacher_home.php?up-error=Failed to Update Student");
	}
?>
<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}