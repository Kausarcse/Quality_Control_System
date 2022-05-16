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

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_greige_receiving_process` where 
    `pp_number`='$pp_number' and 
    `version_number`='$version_number' and 
    `customer_name`='$customer_name' and 
    `color`='$color' and 
    `finish_width_in_inch`='$finish_width_in_inch' and 
    `standard_for_which_process`='$standard_for_which_process' and 
	`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
	`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and
	
    `warp_yarn_count_value` ='$warp_yarn_count_value' and 
	`weft_yarn_count_value` ='$weft_yarn_count_value' and 
	`mass_per_unit_per_area_value` ='$mass_per_unit_per_area_value' and 
	`gerige_width_value` ='$gerige_width_value' and 
	`no_of_threads_in_warp_value` ='$no_of_threads_in_warp_value' and 
	`no_of_threads_in_weft_value` ='$no_of_threads_in_weft_value' and 
	`polyester_fiber_content_value` ='$polyester_fiber_content_value' and 
	`cotton_fiber_content_value` ='$cotton_fiber_content_value' and 
	`other_fiber_content_value` ='$other_fiber_content_value' and status= '$status' and remarks='$remarks' and  `date`='$date' ";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{
	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $update_sql_statement="UPDATE `qc_result_for_greige_receiving_process` SET 
    `warp_yarn_count_value` ='$warp_yarn_count_value', 
	`weft_yarn_count_value` ='$weft_yarn_count_value', 
	`mass_per_unit_per_area_value` ='$mass_per_unit_per_area_value', 
	`gerige_width_value` ='$gerige_width_value', 
	`no_of_threads_in_warp_value` ='$no_of_threads_in_warp_value', 
	`no_of_threads_in_weft_value` ='$no_of_threads_in_weft_value', 
	`polyester_fiber_content_value` ='$polyester_fiber_content_value', 
	`cotton_fiber_content_value` ='$cotton_fiber_content_value', 
	`other_fiber_content_value` ='$other_fiber_content_value', status= '$status', remarks='$remarks', `date`='$date'
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
        //  $update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Greige Issue Completed',`current_state`='Wait for defining process route' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'  ";
	    //  mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
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