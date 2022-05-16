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
// $total_short_or_excess_in_percentage= $_POST['total_short_or_excess_in_percentage'];
$machine_name= $_POST['machine_name'];

$cf_to_rubbing_dry_value= $_POST['cf_to_rubbing_dry_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];
$cf_to_rubbing_wet_value= $_POST['cf_to_rubbing_wet_value'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];

$cf_to_washing_color_change_value= $_POST['cf_to_washing_color_change_value'];
$uom_of_cf_to_washing_color_change= $_POST['uom_of_cf_to_washing_color_change'];

$cf_to_washing_staining_value= $_POST['cf_to_washing_staining_value'];
$uom_of_cf_to_washing_staining= $_POST['uom_of_cf_to_washing_staining'];

$cf_to_washing_cross_staining_value= $_POST['cf_to_washing_cross_staining_value'];
$uom_of_cf_to_washing_cross_staining= $_POST['uom_of_cf_to_washing_cross_staining'];

$cf_to_dry_cleaning_color_change_value= $_POST['cf_to_dry_cleaning_color_change_value'];
$uom_of_cf_to_dry_cleaning_color_change= $_POST['uom_of_cf_to_dry_cleaning_color_change'];

$cf_to_dry_cleaning_staining_value= $_POST['cf_to_dry_cleaning_staining_value'];
$uom_of_cf_to_dry_cleaning_staining= $_POST['uom_of_cf_to_dry_cleaning_staining'];

$cf_to_perspiration_acid_color_change_value= $_POST['cf_to_perspiration_acid_color_change_value'];
$uom_of_cf_to_perspiration_acid_color_change= $_POST['uom_of_cf_to_perspiration_acid_color_change'];

$cf_to_perspiration_acid_staining_value= $_POST['cf_to_perspiration_acid_staining_value'];
$uom_of_cf_to_perspiration_acid_staining= $_POST['uom_of_cf_to_perspiration_acid_staining'];

$cf_to_perspiration_acid_cross_staining_value= $_POST['cf_to_perspiration_acid_cross_staining_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $_POST['uom_of_cf_to_perspiration_acid_cross_staining'];

$cf_to_perspiration_alkali_color_change_value= $_POST['cf_to_perspiration_alkali_color_change_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $_POST['uom_of_cf_to_perspiration_alkali_color_change'];

$cf_to_perspiration_alkali_staining_value= $_POST['cf_to_perspiration_alkali_staining_value'];
$uom_of_cf_to_perspiration_alkali_staining= $_POST['uom_of_cf_to_perspiration_alkali_staining'];

$cf_to_perspiration_alkali_cross_staining_value= $_POST['cf_to_perspiration_alkali_cross_staining_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $_POST['uom_of_cf_to_perspiration_alkali_cross_staining'];

$cf_to_water_color_change_value= $_POST['cf_to_water_color_change_value'];
$uom_of_cf_to_water_color_change= $_POST['uom_of_cf_to_water_color_change'];
$cf_to_water_staining_value= $_POST['cf_to_water_staining_value'];
$uom_of_cf_to_water_staining= $_POST['uom_of_cf_to_water_staining'];
$cf_to_water_cross_staining_value= $_POST['cf_to_water_cross_staining_value'];
$uom_of_cf_to_water_cross_staining= $_POST['uom_of_cf_to_water_cross_staining'];

$cf_to_water_spotting_surface_value= $_POST['cf_to_water_spotting_surface_value'];
$uom_of_cf_to_water_spotting_surface= $_POST['uom_of_cf_to_water_spotting_surface'];
$cf_to_water_spotting_edge_value= $_POST['cf_to_water_spotting_edge_value'];
$uom_of_cf_to_water_spotting_edge= $_POST['uom_of_cf_to_water_spotting_edge'];
$cf_to_water_spotting_cross_staining_value= $_POST['cf_to_water_spotting_cross_staining_value'];
$uom_of_cf_to_water_spotting_cross_staining= $_POST['uom_of_cf_to_water_spotting_cross_staining'];

$cf_to_hydrolysis_of_reactive_dyes_color_change_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];
$cf_to_oxidative_bleach_damage_color_change_value= $_POST['cf_to_oxidative_bleach_damage_color_change_value'];
$uom_of_cf_to_oxidative_bleach_damage_color_change= $_POST['uom_of_cf_to_oxidative_bleach_damage_color_change'];
$cf_to_oxidative_bleach_damage_value= $_POST['cf_to_oxidative_bleach_damage_value'];
$uom_of_cf_to_oxidative_bleach_damage= $_POST['uom_of_cf_to_oxidative_bleach_damage'];

$cf_to_phenolic_yellowing_staining_value= $_POST['cf_to_phenolic_yellowing_staining_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $_POST['uom_of_cf_to_phenolic_yellowing_staining'];
$cf_to_pvc_migration_staining_value= $_POST['cf_to_pvc_migration_staining_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];
$cf_to_saliva_color_change_value= $_POST['cf_to_saliva_color_change_value'];
$uom_of_cf_to_saliva_color_change= $_POST['uom_of_cf_to_saliva_color_change'];
$cf_to_saliva_staining_value= $_POST['cf_to_saliva_staining_value'];
$uom_of_cf_to_saliva_staining= $_POST['uom_of_cf_to_saliva_staining'];

$cf_to_chlorinated_water_color_change_change_value= $_POST['cf_to_chlorinated_water_color_change_change_value'];
$uom_of_cf_to_chlorinated_water_color_change_change= $_POST['uom_of_cf_to_chlorinated_water_color_change_change'];
$cf_to_cholorine_bleach_color_change_value= $_POST['cf_to_cholorine_bleach_color_change_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $_POST['uom_of_cf_to_cholorine_bleach_color_change'];
$cf_to_peroxide_bleach_color_change_value= $_POST['cf_to_peroxide_bleach_color_change_value'];
$uom_cf_to_peroxide_bleach_color_change= $_POST['uom_cf_to_peroxide_bleach_color_change'];
$cross_staining_value= $_POST['cross_staining_value'];
$uom_of_cross_staining= $_POST['uom_of_cross_staining'];
$ph_value= $_POST['ph_value'];
$uom_of_ph= $_POST['uom_of_ph'];
$status= $_POST['status'];
$remarks= $_POST['remarks'];

$current_state = $_POST['current_state'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_washing_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and   
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
	$select_sql_max_primary_key="select MAX(max_report_serial_no) as max_report_serial_no FROM (select CONVERT(substring(report_serial_no,4,LENGTH(report_serial_no)),UNSIGNED) as max_report_serial_no from qc_result_for_washing_process) as temp_qc_result_for_washing_process_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_report_serial_no']+1;

    if($row_for_max_primary_key['max_report_serial_no']==0)
    {

    	$current_report_serial_no='WR_1';

    }
    else
    {

    	$current_report_serial_no ="WR_".($row_for_max_primary_key['max_report_serial_no']+1);

    }

	$insert_sql_statement="insert into `qc_result_for_washing_process` ( 
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

	              `cf_to_washing_color_change_value`,
	               `uom_of_cf_to_washing_color_change`,
	              
	              `cf_to_washing_staining_value`,
	               `uom_of_cf_to_washing_staining`,
	              
	              `cf_to_washing_cross_staining_value`,
	               `uom_of_cf_to_washing_cross_staining`,
	              
	              `cf_to_dry_cleaning_color_change_value`,
	               `uom_of_cf_to_dry_cleaning_color_change`,

	              `cf_to_dry_cleaning_staining_value`,
	              `uom_of_cf_to_dry_cleaning_staining`,	

	              `cf_to_perspiration_acid_color_change_value`,
	              `uom_of_cf_to_perspiration_acid_color_change`,		              

	              `cf_to_perspiration_acid_staining_value`,
	              `uom_of_cf_to_perspiration_acid_staining`,

	              `cf_to_perspiration_acid_cross_staining_value`,
	              `uom_of_cf_to_perspiration_acid_cross_staining`,

	              `cf_to_perspiration_alkali_color_change_value`,
	              `uom_of_cf_to_perspiration_alkali_color_change`,

	              `cf_to_perspiration_alkali_staining_value`,
	              `uom_of_cf_to_perspiration_alkali_staining`,

	               `cf_to_perspiration_alkali_cross_staining_value`,
	              `uom_of_cf_to_perspiration_alkali_cross_staining`,

	              `cf_to_water_color_change_value`,
	              `uom_of_cf_to_water_color_change`,

	              `cf_to_water_staining_value`,
	              `uom_of_cf_to_water_staining`,

	              `cf_to_water_cross_staining_value`,
	              `uom_of_cf_to_water_cross_staining`,

	              `cf_to_water_spotting_surface_value`,
	              `uom_of_cf_to_water_spotting_surface`,

	              `cf_to_water_spotting_edge_value`,
	              `uom_of_cf_to_water_spotting_edge`,

	              `cf_to_water_spotting_cross_staining_value`,
	              `uom_of_cf_to_water_spotting_cross_staining`,

	              `cf_to_hydrolysis_of_reactive_dyes_color_change_value`,
	              `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`,
	              `cf_to_oxidative_bleach_damage_color_change_value`,
	              `uom_of_cf_to_oxidative_bleach_damage_color_change`,
	              `cf_to_oxidative_bleach_damage_value`,
	              `uom_of_cf_to_oxidative_bleach_damage`,

	              `cf_to_phenolic_yellowing_staining_value`,
	              `uom_of_cf_to_phenolic_yellowing_staining`,
	              `cf_to_pvc_migration_staining_value`,
	              `uom_of_cf_to_pvc_migration_staining`,
	              `cf_to_saliva_color_change_value`,
	              `uom_of_cf_to_saliva_color_change`,
	              `cf_to_saliva_staining_value`,
	              `uom_of_cf_to_saliva_staining`,

	              `cf_to_chlorinated_water_color_change_change_value`,
	              `uom_of_cf_to_chlorinated_water_color_change_change`,
	              `cf_to_cholorine_bleach_color_change_value`,
	              `uom_of_cf_to_cholorine_bleach_color_change`,
	              `cf_to_peroxide_bleach_color_change_value`,
	              `uom_cf_to_peroxide_bleach_color_change`,
	              `cross_staining_value`,
	              `uom_of_cross_staining`,
	              `ph_value`,
	              `uom_of_ph`,
	              `status`,
	              `remarks`,
	               `recording_person_id`,
	               `recording_person_name`,
	               `recording_time`,
				   `version_id`,
				`customer_id`,
				`report_serial_no`,
				`current_state`
	           ) values (

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

	           '$cf_to_washing_color_change_value',
	           '$uom_of_cf_to_washing_color_change',

	           '$cf_to_washing_staining_value',
	           '$uom_of_cf_to_washing_staining',

	           '$cf_to_washing_cross_staining_value',
	           '$uom_of_cf_to_washing_cross_staining',

	           '$cf_to_dry_cleaning_color_change_value',
	           '$uom_of_cf_to_dry_cleaning_color_change',

	            '$cf_to_dry_cleaning_staining_value',
	            '$uom_of_cf_to_dry_cleaning_staining',	


				'$cf_to_perspiration_acid_color_change_value',
	            '$uom_of_cf_to_perspiration_acid_color_change',	

	            '$cf_to_perspiration_acid_staining_value',
	            '$uom_of_cf_to_perspiration_acid_staining',

	            '$cf_to_perspiration_acid_cross_staining_value',
	            '$uom_of_cf_to_perspiration_acid_cross_staining',

	            '$cf_to_perspiration_alkali_color_change_value',
	            '$uom_of_cf_to_perspiration_alkali_color_change',

				'$cf_to_perspiration_alkali_staining_value',
	            '$uom_of_cf_to_perspiration_alkali_staining',

 				'$cf_to_perspiration_alkali_cross_staining_value',
	            '$uom_of_cf_to_perspiration_alkali_cross_staining',

	            '$cf_to_water_color_change_value',
	            '$uom_of_cf_to_water_color_change',

 				'$cf_to_water_staining_value',
	            '$uom_of_cf_to_water_staining',

	            '$cf_to_water_cross_staining_value',
	              '$uom_of_cf_to_water_cross_staining',

 				'$cf_to_water_spotting_surface_value',
	             '$uom_of_cf_to_water_spotting_surface',

	             '$cf_to_water_spotting_edge_value',
	              '$uom_of_cf_to_water_spotting_edge',

	              '$cf_to_water_spotting_cross_staining_value',
	              '$uom_of_cf_to_water_spotting_cross_staining',

	              '$cf_to_hydrolysis_of_reactive_dyes_color_change_value',
	              '$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change',
	              '$cf_to_oxidative_bleach_damage_color_change_value',
	              '$uom_of_cf_to_oxidative_bleach_damage_color_change',
	              '$cf_to_oxidative_bleach_damage_value',
	              '$uom_of_cf_to_oxidative_bleach_damage',

	              '$cf_to_phenolic_yellowing_staining_value',
	              '$uom_of_cf_to_phenolic_yellowing_staining',
	              '$cf_to_pvc_migration_staining_value',
	              '$uom_of_cf_to_pvc_migration_staining',
	              '$cf_to_saliva_color_change_value',
	              '$uom_of_cf_to_saliva_color_change',
	              '$cf_to_saliva_staining_value',
	              '$uom_of_cf_to_saliva_staining',

	              '$cf_to_chlorinated_water_color_change_change_value',
	              '$uom_of_cf_to_chlorinated_water_color_change_change',
	              '$cf_to_cholorine_bleach_color_change_value',
	              '$uom_of_cf_to_cholorine_bleach_color_change',
	              '$cf_to_peroxide_bleach_color_change_value',
	              '$uom_cf_to_peroxide_bleach_color_change',
	              '$cross_staining_value',
	              '$uom_of_cross_staining',
	              '$ph_value',
	              '$uom_of_ph',
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

		$sql_for_monitoring_washing = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_washing= mysqli_query($con, $sql_for_monitoring_washing);
		$row_for_monitoring_washing = mysqli_fetch_assoc($result_for_monitoring_washing);
		$current_status_monitoring_san = $row_for_monitoring_washing['current_status'];
		
		if($current_status_monitoring_san=='Washing Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Washing Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Washing Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Washing Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else
		{
			$sql_for_process = "SELECT * FROM qc_result_for_washing_process WHERE pp_number = '$pp_number' AND version_number = '$version_number' and finish_width_in_inch = '$finish_width_in_inch'
								and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number' 
								and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number'";

			$result_for_process = mysqli_query($con,$sql_for_process) or die(mysqli_error($con));
			
			if(mysqli_num_rows($result_for_process) == 1)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 2)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 3)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 4)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Washing Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

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
