<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=1){
		header("Location:student_home.php?type=2");
	}
	
	$qr=mysqli_query($con,"Delete from users where id='".$_REQUEST['id']."'");
	if($qr){
		header("Location:teacher_home.php?del-success=Deleted Successfully");
	}
	else{
		header("Location:teacher_home.php?del-error=Failed to Delete Student");
	}

		
	}