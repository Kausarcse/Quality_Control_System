<?php
error_reporting(0);
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


// echo "hello";
// exit();


$shift_for_rework= $_POST['shift_for_rework'];
$trf_id_for_rework= $_POST['trf_id_for_rework'];
$pp_number_for_rework= $_POST['pp_number_for_rework'];
$customer_name_for_rework= $_POST['customer_name_for_rework'];

$design_for_rework= $_POST['design_for_rework'];
$version_number_for_rework= $_POST['version_number_for_rework'];
$style_name_for_rework= $_POST['style_name_for_rework'];
$color_for_rework= $_POST['color_for_rework'];

$construction_name_for_rework= $_POST['construction_name_for_rework'];
$process_name_for_rework= $_POST['process_name_for_rework'];
$trolly_for_rework= $_POST['trolly_for_rework'];
$finished_width_for_rework= $_POST['finish_width_for_rework'];

$trolly_quantity_for_rework= $_POST['quantity_for_rework'];


 //echo $trolly_quantity_for_rework;

$reason_of_rework= $_POST['for_reason_of_rework'];
$for_corrective_action_of_rework= $_POST['for_corrective_action_of_rework'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `inspection_and_folding_for_rework` where `trf_no`='$trf_id_for_rework' and `pp_number`='$pp_number_for_rework' and 
`customer_name`='$customer_name_for_rework' and `version_number`='$version_number_for_rework'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else 
{
	$insert_sql_statement="insert into `inspection_and_folding_for_rework` (`trf_no`,`pp_number`,`customer_name`,`design`,`version_number`,`style_name`,`color`, construction_name, process_name, trolly, finish_width, quantity, `reason_of_rework`, corrective_action, `recording_person_name`,`recording_time` ) 
    values 
    ('$trf_id_for_rework','$pp_number_for_rework','$customer_name_for_rework','$design_for_rework','$version_number_for_rework','$style_name_for_rework','$color_for_rework','$construction_name_for_rework', '$process_name_for_rework','$trolly_for_rework', '$finished_width_for_rework', '$trolly_quantity_for_rework', '$reason_of_rework', '$for_corrective_action_of_rework','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
}

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	// echo "Data is previously saved.";

	$update_sql_statement="UPDATE `inspection_and_folding_for_rework` SET  `quantity`='$trolly_quantity_for_rework',`reason_of_rework`='$reason_of_rework',`corrective_action`='$for_corrective_action_of_rework',`recording_time`= NOW() 
	WHERE `trf_no`= '$trf_id_for_rework' or (`pp_number`='$pp_number_for_rework' and `version_number` = '$version_number_for_rework' and`customer_name` ='$customer_name_for_rework' and `style_name`='$style_name_for_rework' and `color`='$color_for_rework')";
    // echo $update_sql_statement;
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));
	echo "Data is successfully updated";

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
