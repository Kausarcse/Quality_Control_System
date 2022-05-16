<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$ready_for_raising_id=$_POST['ready_for_raising_id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));



	$delete_sql_statement="DELETE FROM `defining_qc_standard_for_ready_for_raising_process` WHERE `id`='$ready_for_raising_id'";

	mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_deleteion_hampering = "Yes";
	
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Ready for Raising Standard Data is successfully Deleted.";


}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Ready for Raising Standard Data is not successfully Deleted.";

}

$obj->disconnection();

?>
