<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$row_id=$_POST['row_id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());



	$delete_sql_statement="DELETE FROM `process_program_info` WHERE `row_id`='$row_id'";

	mysqli_query($con,$delete_sql_statement) or die(mysqli_error());

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_deleteion_hampering = "Yes";
	
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "PP Wise Version row is successfully Deleted.";


}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "PP Wise Version row is not successfully Deleted.";
 
}

$obj->disconnection();

?>
