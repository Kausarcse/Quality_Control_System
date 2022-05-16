<?php
session_start();
error_reporting(0);
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$data_previously_saved = "No";
$data_insertion_hampering = "No";


$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];



$pp_number= $_POST['pp_number'];
$version_number= $_POST['version_number'];
$version_id= $_POST['version_id'];

/*
$splitted_data=explode('?fs?', $version_number);
$version_number=$splitted_data[0];*/

$customer_name= $_POST['customer_name'];
$customer_id= $_POST['customer_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];
$date= $_POST['date'];
// $splitted_date= explode("/",$date);
// $date= $splitted_date[2]."-".$splitted_date[1]."-".$splitted_date[0];
$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
// $fabric_width_in_inch= $_POST['fabric_width_in_inch'];
$received_quantity_in_meter= $_POST['received_quantity_in_meter'];
$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];
// $total_short_or_excess_in_percentage= $_POST['total_short_or_excess_in_percentage'];
$machine_name= $_POST['machine_name'];
$whiteness_value_in_left_side_of_fabric= $_POST['whiteness_value_in_left_side_of_fabric'];
$whiteness_value_in_center_of_fabric= $_POST['whiteness_value_in_center_of_fabric'];
$whiteness_value_in_right_side_of_fabric= $_POST['whiteness_value_in_right_side_of_fabric'];
$uom_of_whiteness= $_POST['uom_of_whiteness'];
$bowing_and_skew_value= $_POST['bowing_and_skew_value'];
$uom_of_bowing_and_skew= $_POST['uom_of_bowing_and_skew'];
$Ph_value_in_left_side_of_fabric= $_POST['Ph_value_in_left_side_of_fabric'];
$Ph_value_in_center_of_fabric= $_POST['Ph_value_in_center_of_fabric'];
$Ph_value_in_right_of_fabric= $_POST['Ph_value_in_right_of_fabric'];
$uom_of_ph= $_POST['uom_of_ph'];
$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state = $_POST['current_state'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_ready_for_mercerize_process` where 
`pp_number`='$pp_number' and 
`version_number`='$version_number' and 
`customer_name`='$customer_name' and 
`color`='$color' and 
`finish_width_in_inch`=$finish_width_in_inch and 
`standard_for_which_process`='$standard_for_which_process' and 
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
	`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and

`whiteness_value_in_left_side_of_fabric` ='$whiteness_value_in_left_side_of_fabric' and 
`whiteness_value_in_center_of_fabric` ='$whiteness_value_in_center_of_fabric' and 
`whiteness_value_in_right_side_of_fabric` ='$whiteness_value_in_right_side_of_fabric' and 
`bowing_and_skew_value` ='$bowing_and_skew_value' and 
`Ph_value_in_left_side_of_fabric` ='$Ph_value_in_left_side_of_fabric' and 
`Ph_value_in_center_of_fabric` ='$Ph_value_in_center_of_fabric' and 
`Ph_value_in_right_of_fabric` ='$Ph_value_in_right_of_fabric' and status= '$status' and remarks='$remarks' and  `date`='$date' and current_state = '$current_state'
";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $update_sql_statement="UPDATE `qc_result_for_ready_for_mercerize_process` SET 
    `whiteness_value_in_left_side_of_fabric` ='$whiteness_value_in_left_side_of_fabric', 
    `whiteness_value_in_center_of_fabric` ='$whiteness_value_in_center_of_fabric', 
    `whiteness_value_in_right_side_of_fabric` ='$whiteness_value_in_right_side_of_fabric', 
    `bowing_and_skew_value` ='$bowing_and_skew_value', 
    `Ph_value_in_left_side_of_fabric` ='$Ph_value_in_left_side_of_fabric', 
    `Ph_value_in_center_of_fabric` ='$Ph_value_in_center_of_fabric', 
    `Ph_value_in_right_of_fabric` ='$Ph_value_in_right_of_fabric', status= '$status', remarks='$remarks', `date`='$date', current_state = '$current_state'
    WHERE 
    `pp_number`='$pp_number' and 
    `version_number`='$version_number' and 
    `customer_name`='$customer_name' and 
    `color`='$color' and 
    `finish_width_in_inch`=$finish_width_in_inch and 
    `standard_for_which_process`='$standard_for_which_process' and
	`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
    `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
    else
	{
		$sql_for_monitoring_ready_for_mercherize = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_ready_for_mercherize= mysqli_query($con, $sql_for_monitoring_ready_for_mercherize);
		$row_for_monitoring_ready_for_mercherize = mysqli_fetch_assoc($result_for_monitoring_ready_for_mercherize);
		$current_status_monitoring_san = $row_for_monitoring_ready_for_mercherize['current_status'];
		
		if($current_status_monitoring_san=='Ready For Mercerize Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Ready For Mercerize Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Ready For Mercerize Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Ready For Mercerize Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`= '$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

	        mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
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
