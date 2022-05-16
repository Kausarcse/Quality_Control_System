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


$problem= $_POST['problem'];
$description= $_POST['description'];
$problem_type= $_POST['problem_type'];
$problem_group= $_POST['problem_group'];
$id= $_POST['id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `problems_of_machine_stopage` where `problem`='$problem' and `description`='$description' and `problem_type`='$problem_type' and `problem_group`='$problem_group' and id='$id'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
   
	$update_sql_statement="UPDATE `problems_of_machine_stopage` SET `problem`='$problem',`description`='$description',`problem_type`='$problem_type',`problem_group`='$problem_group', `recording_person_id`='$user_id',`recording_person_name`='$user_name',`recording_time`= NOW() WHERE `id`= '$id'";


	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

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
	echo "Data is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully updated.";

}

$obj->disconnection();

?>
