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
$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];
$machine_name= $_POST['machine_name'];
// $face_or_back= $_POST['face_or_back'];


$cf_to_rubbing_dry_value= $_POST['cf_to_rubbing_dry_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];

$cf_to_rubbing_wet_value= $_POST['cf_to_rubbing_wet_value'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];

$dimensional_stability_to_warp_washing_before_iron_value= $_POST['dimensional_stability_to_warp_washing_before_iron_value'];
$uom_of_dimensional_stability_to_warp_washing_before_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_before_iron'];

$dimensional_stability_to_weft_washing_before_iron_value= $_POST['dimensional_stability_to_weft_washing_before_iron_value'];
$uom_of_dimensional_stability_to_weft_washing_before_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_before_iron'];

$dimensional_stability_to_warp_washing_after_iron_value= $_POST['dimensional_stability_to_warp_washing_after_iron_value'];
$uom_of_dimensional_stability_to_warp_washing_after_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_after_iron'];

$dimensional_stability_to_weft_washing_after_iron_value= $_POST['dimensional_stability_to_weft_washing_after_iron_value'];
$uom_of_dimensional_stability_to_weft_washing_after_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_after_iron'];



$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$uom_of_warp_yarn_count= $_POST['uom_of_warp_yarn_count'];

$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$uom_of_weft_yarn_count= $_POST['uom_of_weft_yarn_count'];


$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$uom_of_no_of_threads_in_warp= $_POST['uom_of_no_of_threads_in_warp'];

$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$uom_of_no_of_threads_in_weft= $_POST['uom_of_no_of_threads_in_weft'];


$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$uom_of_mass_per_unit_per_area= $_POST['uom_of_mass_per_unit_per_area'];

$surface_fuzzing_and_pilling_value= $_POST['surface_fuzzing_and_pilling_value'];
$uom_of_surface_fuzzing_and_pilling= $_POST['uom_of_surface_fuzzing_and_pilling'];


$tensile_properties_in_warp_value= $_POST['tensile_properties_in_warp_value'];
$uom_of_tensile_properties_in_warp= $_POST['uom_of_tensile_properties_in_warp'];

$tensile_properties_in_weft_value= $_POST['tensile_properties_in_weft_value'];
$uom_of_tensile_properties_in_weft= $_POST['uom_of_tensile_properties_in_weft'];

$tear_force_in_warp_value= $_POST['tear_force_in_warp_value'];
$uom_of_tear_force_in_warp= $_POST['uom_of_tear_force_in_warp'];

$tear_force_in_weft_value= $_POST['tear_force_in_weft_value'];
$uom_of_tear_force_in_weft= $_POST['uom_of_tear_force_in_weft'];

$seam_slippage_resistance_in_warp_value= $_POST['seam_slippage_resistance_in_warp_value'];
$uom_of_seam_slippage_resistance_in_warp= $_POST['uom_of_seam_slippage_resistance_in_warp'];

$seam_slippage_resistance_in_weft_value= $_POST['seam_slippage_resistance_in_weft_value'];
$uom_of_seam_slippage_resistance_in_weft= $_POST['uom_of_seam_slippage_resistance_in_weft'];


$seam_slippage_resistance_iso_2_in_warp_value= $_POST['seam_slippage_resistance_iso_2_in_warp_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];

$seam_slippage_resistance_iso_2_in_weft_value= $_POST['seam_slippage_resistance_iso_2_in_weft_value'];
$uom_of_seam_slippage_resistance_iso_2_in_weft= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft'];

$seam_strength_in_warp_value= $_POST['seam_strength_in_warp_value'];
$uom_of_seam_strength_in_warp= $_POST['uom_of_seam_strength_in_warp'];

$seam_strength_in_weft_value= $_POST['seam_strength_in_weft_value'];
$uom_of_seam_strength_in_weft= $_POST['uom_of_seam_strength_in_weft'];

$seam_properties_seam_slippage_iso_astm_d_in_warp_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];

$seam_properties_seam_slippage_iso_astm_d_in_weft_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];

$seam_properties_seam_strength_iso_astm_d_in_warp_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

$seam_properties_seam_strength_iso_astm_d_in_weft_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];








$hand_feel= $_POST['hand_feel'];
$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state= $_POST['current_state'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_calendering_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and   
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";



$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
     $select_sql_max_primary_key="select MAX(max_report_serial_no) as max_report_serial_no FROM (select CONVERT(substring(report_serial_no,4,LENGTH(report_serial_no)),UNSIGNED) as max_report_serial_no from qc_result_for_calendering_process) as temp_qc_result_for_calendering_process_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_report_serial_no']+1;

    if($row_for_max_primary_key['max_report_serial_no']==0)
    {

    	$current_report_serial_no='CR_1';

    }
    else
    {

    	$current_report_serial_no ="CR_".($row_for_max_primary_key['max_report_serial_no']+1);

    }

	$insert_sql_statement="insert into `qc_result_for_calendering_process` (
	                     `pp_number`, 
	                     `version_number`, 
	                     `customer_name`, 
	                     `color`, 
	                     `finish_width_in_inch`, 
	                     `standard_for_which_process`,
	                      `date`, 
	                      `before_trolley_number_or_batcher_number`, 
	                      `after_trolley_number_or_batcher_number`, 
	                      `short_or_excess_in_percentage`,
	                      `total_quantity_in_meter`, 
	                      `machine_name`, 

	                      `cf_to_rubbing_dry_value`, 
	                      `uom_of_cf_to_rubbing_dry`,

	                      `cf_to_rubbing_wet_value`, 
	                      `uom_of_cf_to_rubbing_wet`, 

	                      `dimensional_stability_to_warp_washing_before_iron_value`, 
	                      `uom_of_dimensional_stability_to_warp_washing_before_iron`,

	                      `dimensional_stability_to_weft_washing_before_iron_value`, 
	                      `uom_of_dimensional_stability_to_weft_washing_before_iron`, 

	                      `dimensional_stability_to_warp_washing_after_iron_value`, 
	                      `uom_of_dimensional_stability_to_warp_washing_after_iron`,

	                      `dimensional_stability_to_weft_washing_after_iron_value`, 
	                      `uom_of_dimensional_stability_to_weft_washing_after_iron`, 

	                      `warp_yarn_count_value`, 
	                      `uom_of_warp_yarn_count`, 

	                      `weft_yarn_count_value`, 
	                      `uom_of_weft_yarn_count`, 

	                      `no_of_threads_in_warp_value`, 
	                      `uom_of_no_of_threads_in_warp`, 

	                      `no_of_threads_in_weft_value`, 
	                      `uom_of_no_of_threads_in_weft`,

	                      `mass_per_unit_per_area_value`, 
	                      `uom_of_mass_per_unit_per_area`, 

	                      `surface_fuzzing_and_pilling_value`, 
	                      `uom_of_surface_fuzzing_and_pilling`, 

	                      `tensile_properties_in_warp_value`, 
	                      `uom_of_tensile_properties_in_warp`, 

	                      `tensile_properties_in_weft_value`, 
	                      `uom_of_tensile_properties_in_weft`, 

	                      `tear_force_in_warp_value`, 
	                      `uom_of_tear_force_in_warp`, 

	                      `tear_force_in_weft_value`, 
	                      `uom_of_tear_force_in_weft`, 

	                      `seam_slippage_resistance_in_warp_value`, 
	                      `uom_of_seam_slippage_resistance_in_warp`, 

	                      `seam_slippage_resistance_in_weft_value`, 
	                      `uom_of_seam_slippage_resistance_in_weft`,

	                      `seam_slippage_resistance_iso_2_in_warp_value`, 
	                      `uom_of_seam_slippage_resistance_iso_2_in_warp`, 

	                      `seam_slippage_resistance_iso_2_in_weft_value`, 
	                      `uom_of_seam_slippage_resistance_iso_2_in_weft`, 

	                      `seam_strength_in_warp_value`, 
	                      `uom_of_seam_strength_in_warp`, 

	                      `seam_strength_in_weft_value`, 
	                      `uom_of_seam_strength_in_weft`, 

	                      `seam_properties_seam_slippage_iso_astm_d_in_warp_value`, 
	                      `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp`, 

                          `seam_properties_seam_slippage_iso_astm_d_in_weft_value`, 
	                      `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft`, 

                          `seam_properties_seam_strength_iso_astm_d_in_warp_value`, 
	                      `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp`, 


                          `seam_properties_seam_strength_iso_astm_d_in_weft_value`, 
	                      `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft`, 


	                       `hand_feel`, 
	                       `status`, 
	                       `remarks`, 
	                       `recording_person_id`, 
	                       `recording_person_name`,
	                       `recording_time`,
	                       `version_id`,
							`customer_id`,
							`report_serial_no`,
	                       `current_state` 
	                        )
	                    values 
	                    (
	                    '$pp_number',
	                    '$version_number',
	                    '$customer_name',
	                    '$color',
	                    '$finish_width_in_inch',
	                    '$standard_for_which_process',
	                    '$date',
	                    '$before_trolley_number_or_batcher_number',
	                    '$after_trolley_number_or_batcher_number',
	                    '$short_or_excess_in_percentage',
	                    '$total_quantity_in_meter',
	                    '$machine_name',
	                    '$cf_to_rubbing_dry_value',
	                    '$uom_of_cf_to_rubbing_dry',

	                    '$cf_to_rubbing_wet_value',
	                    '$uom_of_cf_to_rubbing_wet',

	                    '$dimensional_stability_to_warp_washing_before_iron_value',
	                    '$uom_of_dimensional_stability_to_warp_washing_before_iron',

	                    '$dimensional_stability_to_weft_washing_before_iron_value',
	                    '$uom_of_dimensional_stability_to_weft_washing_before_iron',

	                    '$dimensional_stability_to_warp_washing_after_iron_value',
	                    '$uom_of_dimensional_stability_to_warp_washing_after_iron',

	                    '$dimensional_stability_to_weft_washing_after_iron_value',
	                    '$uom_of_dimensional_stability_to_weft_washing_after_iron',

	                    '$warp_yarn_count_value',
	                    '$uom_of_warp_yarn_count',

	                    '$weft_yarn_count_value',
	                    '$uom_of_weft_yarn_count',

	                    '$no_of_threads_in_warp_value',
	                    '$uom_of_no_of_threads_in_warp',

	                    '$no_of_threads_in_weft_value',
	                    '$uom_of_no_of_threads_in_weft',

	                    '$mass_per_unit_per_area_value',
	                    '$uom_of_mass_per_unit_per_area',

	                    '$surface_fuzzing_and_pilling_value',
	                    '$uom_of_surface_fuzzing_and_pilling',

	                    '$tensile_properties_in_warp_value',
	                    '$uom_of_tensile_properties_in_warp',

	                    '$tensile_properties_in_weft_value',
	                    '$uom_of_tensile_properties_in_weft',

	                    '$tear_force_in_warp_value',
	                    '$uom_of_tear_force_in_warp',

	                    '$tear_force_in_weft_value',
	                    '$uom_of_tear_force_in_weft',

	                    '$seam_slippage_resistance_in_warp_value',
	                    '$uom_of_seam_slippage_resistance_in_warp',

	                    '$seam_slippage_resistance_in_weft_value',
	                    '$uom_of_seam_slippage_resistance_in_weft',

	                    '$seam_slippage_resistance_iso_2_in_warp_value',
	                    '$uom_of_seam_slippage_resistance_iso_2_in_warp',

	                    '$seam_slippage_resistance_iso_2_in_weft_value',
	                    '$uom_of_seam_slippage_resistance_iso_2_in_weft',

	                    '$seam_strength_in_warp_value',
	                    '$uom_of_seam_strength_in_warp',

	                    '$seam_strength_in_weft_value',
	                    '$uom_of_seam_strength_in_weft',

	                    '$seam_properties_seam_slippage_iso_astm_d_in_warp_value',
	                    '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp',

	                    
	                    '$seam_properties_seam_slippage_iso_astm_d_in_weft_value',
	                    '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft',
                    
	                    '$seam_properties_seam_strength_iso_astm_d_in_warp_value',
	                    '$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp',

	                    '$seam_properties_seam_strength_iso_astm_d_in_weft_value',
	                    '$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft',
	                    '$hand_feel',
	                    '$status',
	                    '$remarks',
	                    '$user_id',
	                    '$user_name',
	                    NOW(),
	                    '$version_id',
					    '$customer_id',
					    '$current_report_serial_no',
	                    '$current_state'
	                     )";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
	else
	{
		$sql_for_monitoring_calender = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_calender= mysqli_query($con, $sql_for_monitoring_calender);
		$row_for_monitoring_calender = mysqli_fetch_assoc($result_for_monitoring_calender);
		$current_status_monitoring_san = $row_for_monitoring_calender['current_status'];
		
		if($current_status_monitoring_san=='Calander Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Calander Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Calander Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Calander Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else
		{

			$sql_for_process = "SELECT * FROM qc_result_for_calendering_process WHERE pp_number = '$pp_number' AND version_number = '$version_number' and finish_width_in_inch = '$finish_width_in_inch'
										and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number' 
										and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number'";
										
			$result_for_process = mysqli_query($con,$sql_for_process) or die(mysqli_error($con));
			
			if(mysqli_num_rows($result_for_process) == 1)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status` = 'Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 2)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 3)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 4)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Calander Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));

				
			}
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
	echo "Data is successfully saved.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
