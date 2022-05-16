<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$scouring_bleaching_id=$_POST['scouring_bleaching_id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));



	$delete_sql_statement="DELETE FROM `defining_qc_standard_for_scouring_bleaching_process` WHERE `id`='$scouring_bleaching_id'";

	mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_deleteion_hampering = "Yes";
	
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Scouring & Bleaching Standard Data is successfully Deleted.";


}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Scouring & Bleaching Standard Data is not successfully Deleted.";

}

$obj->disconnection();

?>
