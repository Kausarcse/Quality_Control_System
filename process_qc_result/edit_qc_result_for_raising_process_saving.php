<?php
session_start();
error_reporting(0);
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

//print_r($_POST);
//exit;

$data_previously_saved = "No";
$data_insertion_hampering = "No";

$user_id = 'abcd';
$user_name = 'abcd';


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

$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];
$machine_name= $_POST['machine_name'];
$face_back = $_POST['face_back'];
$tensile_properties_in_warp_value= $_POST['tensile_properties_in_warp_value'];
$uom_of_tensile_properties_in_warp= $_POST['uom_of_tensile_properties_in_warp'];
$tensile_properties_in_weft_value= $_POST['tensile_properties_in_weft_value'];
$uom_of_tensile_properties_in_weft= $_POST['uom_of_tensile_properties_in_weft'];
$tear_force_in_warp_value= $_POST['tear_force_in_warp_value'];
$uom_of_tear_force_in_warp= $_POST['uom_of_tear_force_in_warp'];
$tear_force_in_weft_value= $_POST['tear_force_in_weft_value'];
$uom_of_tear_force_in_weft= $_POST['uom_of_tear_force_in_weft'];
$status= $_POST['status'];
$hand_feel = $_POST['hand_feel'];
$raising_quality=$_POST['raising_quality'];
$remarks= $_POST['remarks'];
$current_state= $_POST['current_state'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_raising_process`
 where 
 `pp_number`='$pp_number' and 
 `version_number`='$version_number' and 
 `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`='$finish_width_in_inch' and 
 `standard_for_which_process`='$standard_for_which_process' and 
 `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
	`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and
 
              `tensile_properties_in_warp_value` ='$tensile_properties_in_warp_value' and
			  `tensile_properties_in_weft_value` ='$tensile_properties_in_weft_value' and			  
			  `tear_force_in_warp_value` ='$tear_force_in_warp_value' and
			  `tear_force_in_weft_value` ='$tear_force_in_weft_value' and face_back='$face_back' and 
			  hand_feel = '$hand_feel' and raising_quality = '$raising_quality' and status= '$status' and remarks='$remarks' and  `date`='$date' and current_state = '$current_state'
 ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
	$update_sql_statement="UPDATE `qc_result_for_raising_process` SET 
              `tensile_properties_in_warp_value` ='$tensile_properties_in_warp_value',
			  `tensile_properties_in_weft_value` ='$tensile_properties_in_weft_value',			  
			  `tear_force_in_warp_value` ='$tear_force_in_warp_value',
			  `tear_force_in_weft_value` ='$tear_force_in_weft_value', face_back='$face_back', 
			  hand_feel = '$hand_feel' , raising_quality = '$raising_quality', status= '$status', remarks='$remarks', `date`='$date', current_state = '$current_state'
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

		$sql_for_monitoring_raising = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_raising= mysqli_query($con, $sql_for_monitoring_raising);
		$row_for_monitoring_raising = mysqli_fetch_assoc($result_for_monitoring_raising);
		$current_status_monitoring_san = $row_for_monitoring_raising['current_status'];
		
		if($current_status_monitoring_san=='Ready For Raising Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Ready For Raising Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Ready For Raising Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Ready For Raising Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Ready For Raising Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Ready For Raising Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Ready For Raising Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Ready For Raising Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Ready For Raising Process',`current_state`= '$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

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