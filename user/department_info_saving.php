<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";


$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

// cross-site scripting----------- [start]

// $location= htmlentities($_POST['location']);
$department_name= htmlentities($_POST['department_name']);
$section_name= htmlentities($_POST['section_name']);
$contact_person_name= htmlentities($_POST['contact_person_name']);

// cross-site scripting------------[end]

$contact_no= $_POST['contact_no'];
$email= $_POST['email'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `department_info` where `department_name`='$department_name' and `section_name`='$section_name' and `contact_person_name`='$contact_person_name' and `contact_no`='$contact_no' and `email`='$email'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$insert_sql_statement="insert into `department_info` ( `department_name`,`section_name`,`contact_person_name`,`contact_no`,`email`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$department_name','$section_name','$contact_person_name','$contact_no','$email','$user_id','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
}

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully saved.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
