<?php
session_start();
error_reporting(0);
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];


$pp_number= $_POST['pp_number'];
$version_number= $_POST['version_number'];
$version_id= $_POST['version_id'];



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


$received_quantity_in_meter= $_POST['received_quantity_in_meter'];
$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];

$machine_name= $_POST['machine_name'];



$absorbency_left_value= $_POST['absorbency_left_value'];
$absorbency_center_value= $_POST['absorbency_center_value'];
$absorbency_right_value= $_POST['absorbency_right_value'];
$uom_of_absorbency= $_POST['uom_of_absorbency'];

$residual_sizing_material_left_value= $_POST['residual_sizing_material_left_value'];
$residual_sizing_material_center_value= $_POST['residual_sizing_material_center_value'];
$residual_sizing_material_right_value= $_POST['residual_sizing_material_right_value'];
$uom_of_residual_sizing_material= $_POST['uom_of_residual_sizing_material'];


$resistance_to_surface_fuzzing_and_pilling_left_value= $_POST['resistance_to_surface_fuzzing_and_pilling_left_value'];
$resistance_to_surface_fuzzing_and_pilling_center_value= $_POST['resistance_to_surface_fuzzing_and_pilling_center_value'];
$resistance_to_surface_fuzzing_and_pilling_right_value= $_POST['resistance_to_surface_fuzzing_and_pilling_right_value'];
$uom_of_resistance_to_surface_fuzzing_and_pilling= $_POST['uom_of_resistance_to_surface_fuzzing_and_pilling'];

$ph_left_value= $_POST['ph_left_value'];
$ph_center_value= $_POST['ph_center_value'];
$ph_right_value= $_POST['ph_right_value'];
$uom_of_ph= $_POST['uom_of_ph'];


$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state = $_POST['current_state'];
mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_scouring_process` where 
`pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and 
`color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and 
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
	`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and
	
`absorbency_left_value` ='$absorbency_left_value' and  
`absorbency_center_value` ='$absorbency_center_value' and  
`absorbency_right_value` ='$absorbency_right_value' and  
`residual_sizing_material_left_value` ='$residual_sizing_material_left_value' and  
`residual_sizing_material_center_value` ='$residual_sizing_material_center_value' and  
`residual_sizing_material_right_value` ='$residual_sizing_material_right_value' and 
`resistance_to_surface_fuzzing_and_pilling_left_value` ='$resistance_to_surface_fuzzing_and_pilling_left_value' and  
`resistance_to_surface_fuzzing_and_pilling_center_value` ='$resistance_to_surface_fuzzing_and_pilling_center_value' and  
`resistance_to_surface_fuzzing_and_pilling_right_value` ='$resistance_to_surface_fuzzing_and_pilling_right_value' and  
`ph_left_value` ='$ph_left_value' and  
`ph_center_value` ='$ph_center_value' and  
`ph_right_value` ='$ph_right_value' and status= '$status' and remarks='$remarks' and current_state = '$current_state' and  `date`='$date' 

";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $update_sql_statement="UPDATE `qc_result_for_scouring_process` SET 
   `absorbency_left_value` ='$absorbency_left_value',  
	`absorbency_center_value` ='$absorbency_center_value',  
	`absorbency_right_value` ='$absorbency_right_value',  
	`residual_sizing_material_left_value` ='$residual_sizing_material_left_value',  
	`residual_sizing_material_center_value` ='$residual_sizing_material_center_value',  
	`residual_sizing_material_right_value` ='$residual_sizing_material_right_value', 
	`resistance_to_surface_fuzzing_and_pilling_left_value` ='$resistance_to_surface_fuzzing_and_pilling_left_value',  
	`resistance_to_surface_fuzzing_and_pilling_center_value` ='$resistance_to_surface_fuzzing_and_pilling_center_value',  
	`resistance_to_surface_fuzzing_and_pilling_right_value` ='$resistance_to_surface_fuzzing_and_pilling_right_value',  
	`ph_left_value` ='$ph_left_value',  
	`ph_center_value` ='$ph_center_value',  
	`ph_right_value` ='$ph_right_value', `status`= '$status', remarks='$remarks', `date`='$date', current_state = '$current_state'
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
		$sql_for_monitoring_scouring = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_scouring= mysqli_query($con, $sql_for_monitoring_scouring);
		$row_for_monitoring_scouring = mysqli_fetch_assoc($result_for_monitoring_scouring);
		$current_status_monitoring_san = $row_for_monitoring_scouring['current_status'];
		
		if($current_status_monitoring_san=='Scouring Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Scouring Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Scouring Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Scouring Process')
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