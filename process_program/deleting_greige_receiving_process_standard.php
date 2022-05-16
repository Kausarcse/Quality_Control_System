<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$greige_receiving_id=$_POST['greige_receiving_id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));



	$delete_sql_statement="DELETE FROM `defining_qc_standard_for_greige_receiving_process` WHERE `id`='$greige_receiving_id'";

	mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_deleteion_hampering = "Yes";
	
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Greige Receiving Standard is successfully Deleted.";


	// $update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Defined process route',`current_state`='Wait for defining standard' WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch' and `style_name`='$style_name'";
	        
	// mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Greige Receiving Standard is not successfully Deleted.";

}

$obj->disconnection();

?>
