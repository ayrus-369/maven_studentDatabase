<?php
// $con=mysqli_connect("sql306.epizy.com","epiz_32420006","
// DyqIw87pGxS","epiz_32420006_Student_Database");
$con=mysqli_connect("localhost","student_database","","student_database");
if(!$con){
	die("Failed to Establish Database Connection");

}
	//connected database