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

$select_sql_for_duplicacy="select * from `qc_result_for_sanforizing_process` where 
`pp_number`='$pp_number' and 
`version_number`='$version_number' and 
`customer_name`='$customer_name' and
 `color`='$color' and 
 `finish_width_in_inch`=$finish_width_in_inch and 
 `standard_for_which_process`='$standard_for_which_process' and
 `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
	`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and 
 
 `cf_to_rubbing_dry_value` ='$cf_to_rubbing_dry_value' and  
 `cf_to_rubbing_wet_value` ='$cf_to_rubbing_wet_value' and  

 `dimensional_stability_to_warp_washing_before_iron_value` ='$dimensional_stability_to_warp_washing_before_iron_value' and  
 `dimensional_stability_to_weft_washing_before_iron_value` ='$dimensional_stability_to_weft_washing_before_iron_value' and  
 `dimensional_stability_to_warp_washing_after_iron_value` ='$dimensional_stability_to_warp_washing_after_iron_value' and  
 `dimensional_stability_to_weft_washing_after_iron_value` ='$dimensional_stability_to_weft_washing_after_iron_value' and  

 `warp_yarn_count_value` ='$warp_yarn_count_value' and  
 `weft_yarn_count_value` ='$weft_yarn_count_value' and  

 `no_of_threads_in_warp_value` ='$no_of_threads_in_warp_value' and  
 `no_of_threads_in_weft_value` ='$no_of_threads_in_weft_value' and  

 `mass_per_unit_per_area_value` ='$mass_per_unit_per_area_value' and  

 `surface_fuzzing_and_pilling_value` ='$surface_fuzzing_and_pilling_value' and  

 `tensile_properties_in_warp_value` ='$tensile_properties_in_warp_value' and  
 `tensile_properties_in_weft_value` ='$tensile_properties_in_weft_value' and  

 `tear_force_in_warp_value` ='$tear_force_in_warp_value' and  
 `tear_force_in_weft_value` ='$tear_force_in_weft_value' and  

 `seam_slippage_resistance_in_warp_value` ='$seam_slippage_resistance_in_warp_value' and  
 `seam_slippage_resistance_in_weft_value` ='$seam_slippage_resistance_in_weft_value' and  
 `seam_slippage_resistance_iso_2_in_warp_value` ='$seam_slippage_resistance_iso_2_in_warp_value' and  
 `seam_slippage_resistance_iso_2_in_weft_value` ='$seam_slippage_resistance_iso_2_in_weft_value' and  
 `seam_strength_in_warp_value` ='$seam_strength_in_warp_value' and  
 `seam_strength_in_weft_value` ='$seam_strength_in_weft_value' and  
 `seam_properties_seam_slippage_iso_astm_d_in_warp_value` ='$seam_properties_seam_slippage_iso_astm_d_in_warp_value' and  
 `seam_properties_seam_slippage_iso_astm_d_in_weft_value` ='$seam_properties_seam_slippage_iso_astm_d_in_weft_value' and  
 `seam_properties_seam_strength_iso_astm_d_in_warp_value` ='$seam_properties_seam_strength_iso_astm_d_in_warp_value' and 
 `seam_properties_seam_strength_iso_astm_d_in_weft_value` ='$seam_properties_seam_strength_iso_astm_d_in_weft_value' and  
 hand_feel='$hand_feel' and current_state='$current_state' and  status= '$status' and remarks='$remarks' and  `date`='$date'
 ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $update_sql_statement="UPDATE `qc_result_for_sanforizing_process` SET 
    `cf_to_rubbing_dry_value` ='$cf_to_rubbing_dry_value',  
    `cf_to_rubbing_wet_value` ='$cf_to_rubbing_wet_value',  

    `dimensional_stability_to_warp_washing_before_iron_value` ='$dimensional_stability_to_warp_washing_before_iron_value',  
    `dimensional_stability_to_weft_washing_before_iron_value` ='$dimensional_stability_to_weft_washing_before_iron_value',  
    `dimensional_stability_to_warp_washing_after_iron_value` ='$dimensional_stability_to_warp_washing_after_iron_value',  
    `dimensional_stability_to_weft_washing_after_iron_value` ='$dimensional_stability_to_weft_washing_after_iron_value',  

    `warp_yarn_count_value` ='$warp_yarn_count_value',  
    `weft_yarn_count_value` ='$weft_yarn_count_value',  

    `no_of_threads_in_warp_value` ='$no_of_threads_in_warp_value',  
    `no_of_threads_in_weft_value` ='$no_of_threads_in_weft_value',  

    `mass_per_unit_per_area_value` ='$mass_per_unit_per_area_value',  

    `surface_fuzzing_and_pilling_value` ='$surface_fuzzing_and_pilling_value',  

    `tensile_properties_in_warp_value` ='$tensile_properties_in_warp_value',  
    `tensile_properties_in_weft_value` ='$tensile_properties_in_weft_value',  

    `tear_force_in_warp_value` ='$tear_force_in_warp_value',  
    `tear_force_in_weft_value` ='$tear_force_in_weft_value',  

    `seam_slippage_resistance_in_warp_value` ='$seam_slippage_resistance_in_warp_value',  
    `seam_slippage_resistance_in_weft_value` ='$seam_slippage_resistance_in_weft_value',  
    `seam_slippage_resistance_iso_2_in_warp_value` ='$seam_slippage_resistance_iso_2_in_warp_value',  
    `seam_slippage_resistance_iso_2_in_weft_value` ='$seam_slippage_resistance_iso_2_in_weft_value',  
    `seam_strength_in_warp_value` ='$seam_strength_in_warp_value',  
    `seam_strength_in_weft_value` ='$seam_strength_in_weft_value',  
    `seam_properties_seam_slippage_iso_astm_d_in_warp_value` ='$seam_properties_seam_slippage_iso_astm_d_in_warp_value',  
    `seam_properties_seam_slippage_iso_astm_d_in_weft_value` ='$seam_properties_seam_slippage_iso_astm_d_in_weft_value',  
    `seam_properties_seam_strength_iso_astm_d_in_warp_value` ='$seam_properties_seam_strength_iso_astm_d_in_warp_value', 
    `seam_properties_seam_strength_iso_astm_d_in_weft_value` ='$seam_properties_seam_strength_iso_astm_d_in_weft_value',
    hand_feel='$hand_feel', current_state='$current_state',  status= '$status', remarks='$remarks', `date`='$date'   
    WHERE 
    `pp_number`='$pp_number' and 
    `version_number`='$version_number' and 
    `customer_name`='$customer_name' and 
    `color`='$color' and 
    `finish_width_in_inch`=$finish_width_in_inch and 
    `standard_for_which_process`='$standard_for_which_process' and
	`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
    `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	mysqli_query($con, $update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
	else
	{
        $sql_for_monitoring_sanforize = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_sanforize= mysqli_query($con, $sql_for_monitoring_sanforize);
		$row_for_monitoring_sanforize = mysqli_fetch_assoc($result_for_monitoring_sanforize);
		$current_status_monitoring_san = $row_for_monitoring_sanforize['current_status'];
		
		if($current_status_monitoring_san=='Sanforizing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Sanforizing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Sanforizing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Sanforizing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
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