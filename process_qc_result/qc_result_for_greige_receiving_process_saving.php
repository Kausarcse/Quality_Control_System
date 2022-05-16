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
$style_name= $_POST['style_name'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];
$date= $_POST['date'];
$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
// $fabric_width_in_inch= $_POST['fabric_width_in_inch'];
$received_quantity_in_meter= $_POST['received_quantity_in_meter'];
$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];
// $total_short_or_excess_in_percentage= $_POST['total_short_or_excess_in_percentage'];
$machine_name= $_POST['machine_name'];

$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$weft_yarn_count_value= $_POST['weft_yarn_count_value'];

$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$gerige_width_value= $_POST['gerige_width_value'];


$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];

$polyester_fiber_content_value= $_POST['polyester_fiber_content_value'];
$cotton_fiber_content_value= $_POST['cotton_fiber_content_value'];
$other_fiber_content_value= $_POST['other_fiber_content_value'];

$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state= $_POST['current_status'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_greige_receiving_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and   
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and `received_quantity_in_meter` = '$received_quantity_in_meter'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $select_sql_max_primary_key="select MAX(max_report_serial_no) as max_report_serial_no FROM (select CONVERT(substring(report_serial_no,5,LENGTH(report_serial_no)),UNSIGNED) as max_report_serial_no from qc_result_for_greige_receiving_process) as temp_qc_result_for_greige_receiving_process_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_report_serial_no']+1;

    if($row_for_max_primary_key['max_report_serial_no']==0)
    {

    	$current_report_serial_no='GRR_1';

    }
    else
    {

    	$current_report_serial_no ="GRR_".($row_for_max_primary_key['max_report_serial_no']+1);

    }

	$insert_sql_statement="insert into `qc_result_for_greige_receiving_process` 
	( 
	`pp_number`,
	`version_number`,
	`customer_name`,
	`color`,
	`style`,
	`finish_width_in_inch`,
	`standard_for_which_process`,
	`date`,
	`before_trolley_number_or_batcher_number`,
	`after_trolley_number_or_batcher_number`,
	`received_quantity_in_meter`,
	`short_or_excess_in_percentage`,
	`total_quantity_in_meter`,
	`machine_name`,
	`warp_yarn_count_value`,
	`weft_yarn_count_value`,
	`mass_per_unit_per_area_value`,
	`gerige_width_value`,
	`no_of_threads_in_warp_value`,
	`no_of_threads_in_weft_value`,
	`polyester_fiber_content_value`,
	`cotton_fiber_content_value`,
	`other_fiber_content_value`,
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
	'$style_name',
	'$finish_width_in_inch',
	'$standard_for_which_process',
	'$date',
	'$before_trolley_number_or_batcher_number',
	'$after_trolley_number_or_batcher_number',
	'$received_quantity_in_meter',
	'$short_or_excess_in_percentage',
	'$total_quantity_in_meter',
	'$machine_name',
	'$warp_yarn_count_value',
	'$weft_yarn_count_value',
	'$mass_per_unit_per_area_value',
	'$gerige_width_value',
	'$no_of_threads_in_warp_value',
	'$no_of_threads_in_weft_value',
	'$polyester_fiber_content_value',
	'$cotton_fiber_content_value',
	'$other_fiber_content_value',
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
		
         /*$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Greige Issued',`current_state`='PP in progress' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'  ";
         
         
        
	    mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
*/
	    $select_sql_for_duplicacy_pp_monitoring="SELECT * from `pp_monitoring` where 
												`pp_number`='$pp_number' and 
												`version_number`='$version_number' and 
												`style_name`='$style_name' and 
												`finish_width_in_inch`='$finish_width_in_inch'";

        $result_pp_monitoring = mysqli_query($con,$select_sql_for_duplicacy_pp_monitoring) or die(mysqli_error($con));
   
		  if(mysqli_num_rows($result_pp_monitoring)> 0)
			{  

			    $update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  
											 `current_status`='Greige Receiving Process',
											 `current_state`='$current_state' 
											 WHERE 
											 `pp_number`= '$pp_number' and 
											 `version_number`='$version_number' and 
											 `finish_width_in_inch`='$finish_width_in_inch' and 
											 `style_name`='$style_name'";
			        
				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));

			}
			else
			{
				$insert_sql_for_pp_monitoringt="insert into `pp_monitoring`
		                            ( 
		                            `pp_number`,
		                            `version_number`,
		                            `style_name`,
		                            `finish_width_in_inch`,
		                            `current_status`,
		                            `recording_person_id`,
		                            `recording_person_name`,
		                            `recording_time`,
		                            `current_state` 
		                            ) 
		                            values 
		                            (
		                            '$pp_number',
		                            '$version_number',
		                            '$style_name',
		                            '$finish_width_in_inch',
		                            'Greige Receiving Process',
		                            '$user_id',
		                            '$user_name',
		                            NOW(),
		                            '$current_state')";

			    mysqli_query($con,$insert_sql_for_pp_monitoringt) or die(mysqli_error($con));
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
