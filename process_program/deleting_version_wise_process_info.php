<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$process_id=$_POST['process_id'];
$splitted_data=explode('?fs?', $process_id);
$process_id=$splitted_data[0];
$version_id=$splitted_data[1];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));


/*
	$delete_sql_statement="DELETE FROM `adding_process_to_version` WHERE `process_id`='$process_id'";

   */
	$delete_sql_statement="DELETE FROM `adding_process_to_version` WHERE `process_id`='$process_id' and `version_id` = '$version_id'";
	

	 mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

	 
	 

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_deleteion_hampering = "Yes";
	
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Version Wise process is successfully Deleted.";


}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Version Wise  process is not successfully Deleted.";
 
}

$obj->disconnection();

?>
