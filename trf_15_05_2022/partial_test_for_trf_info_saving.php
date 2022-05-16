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


$partial_test_for_trf_creation_date= $_POST['partial_test_for_trf_creation_date'];
$alternate_partial_test_for_trf_creation_date_time= $_POST['alternate_partial_test_for_trf_creation_date_time'];
$splitted_pp_creation_date= explode("/",$partial_test_for_trf_creation_date);
$partial_test_for_trf_creation_date= $splitted_pp_creation_date[2]."-".$splitted_pp_creation_date[1]."-".$splitted_pp_creation_date[0];


$shift= $_POST['shift_in_time'];

$employee_name= $_POST['employee_name'];
$splitted_employee_name=explode("?fs?", $employee_name);
$employee_name=$splitted_employee_name[0];
$employee_id=$splitted_employee_name[1];

	$pp_number= $_POST['pp_number'];

	$version_details= $_POST['version_number'];
	$splitted_version_number=explode("?fs?",$version_details);

	$version_number= $splitted_version_number[0];
	$design= $splitted_version_number[1];
	$week_in_year= $splitted_version_number[2];
	$customer_name= $splitted_version_number[3];
	$customer_id= $splitted_version_number[7];
	$version_id= $splitted_version_number[8];
	$style= $splitted_version_number[9];
	$finish_width_in_inch= $splitted_version_number[10];
	$greige_width_in_inch= $splitted_version_number[11];
	$color= $splitted_version_number[12];
	$fiber_composition= 'Cotton:'.$splitted_version_number[4].' Polyester:'.$splitted_version_number[5].' Other:'.$splitted_version_number[6];

	$process_details= $_POST['process_name'];
	$split_process_name= explode("?fs?", $process_details);
	$process_id= $split_process_name[0];
	$process_name= $split_process_name[1];

	$process_width= $_POST['process_width'];

	
	$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
	$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
	
	$before_trolley_or_batcher_in_time= $_POST['before_trolley_or_batcher_in_time'];
	$after_trolley_or_batcher_out_time= $_POST['after_trolley_or_batcher_out_time'];
	
	$before_trolley_or_batcher_qty= $_POST['before_trolley_or_batcher_qty'];
	$after_trolley_or_batcher_qty= $_POST['after_trolley_or_batcher_qty'];
	
	$machine_name= $_POST['machine_name'];
	$service_type= $_POST['service_type'];

	$washing= $_POST['washingURL'];
	$bleaching= $_POST['bleachingURL'];
	$ironing= $_POST['ironingURL'];
	$dry_cleaning= $_POST['DryCleaningURL'];
	$drying= $_POST['DryingURL'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));



$select_sql_for_duplicacy="SELECT * FROM partial_test_for_trf_info 
							WHERE 
							trf_id = '$trf_id' AND
							pp_number = '$pp_number' AND 
							version_id = '$version_id' AND 
							version_number = '$version_number' AND 
							process_id = '$process_id' AND 
							process_name = '$process_name' AND 
							customer_id = '$customer_id' AND 
							style = '$style' AND 
							finish_width_in_inch = '$finish_width_in_inch' AND 
							greige_width_in_inch = '$greige_width_in_inch' AND 
							color = '$color' AND 
							before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number' AND 
							after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));


if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

    $select_sql_max_primary_key="select MAX(trf_id) as trf_id FROM (select CONVERT(substring(trf_id,10,LENGTH(trf_id)),UNSIGNED) as trf_id from partial_test_for_trf_info) as temp_partial_test_for_trf_info"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['trf_id']+1;

    if($row_for_max_primary_key['trf_id']==0)
    {

      $current_trf_id='ZZZFL_PT_1';

    }
    else
    {

      $current_trf_id ="ZZZFL_PT_".($row_for_max_primary_key['trf_id']+1);

    } 

	$insert_sql_statement="INSERT INTO `partial_test_for_trf_info`(
	`trf_id`,
	`partial_test_for_trf_creation_date`,
	`alternate_partial_test_for_trf_creation_date_time`,
	`employee_id`,`employee_name`,
	 `shift`,
	 `process_name`,
	 `process_id`,
	 `process_width`,
	 `pp_number`,
	 `version_id`, 
	 `version_number`, 
	 `week_in_year`,
	 `design`, 
	 `customer_name`,
	 `customer_id`, 
	 `style`, 
	 `fiber_composition`, 
	 `finish_width_in_inch`, 
	 `greige_width_in_inch`, 
	 `color`, 

	 `before_trolley_number_or_batcher_number`, 
	 `after_trolley_number_or_batcher_number`,

	 `before_trolley_or_batcher_in_time`, 
	 `after_trolley_or_batcher_out_time`, 

	 `before_trolley_or_batcher_qty`,
	 `after_trolley_or_batcher_qty`,
	 
	 `machine_name`, 
	 `service_type`, 
	 `washing`, 
	 `bleaching`, 
	 `ironing`, 
	 `dry_cleaning`, 
	 `drying`, 
	 `recording_person_id`, 
	 `recording_person_name`,
	  `recording_time`
	  ) 
	   VALUES
	   (
	   '$current_trf_id',
	   '$partial_test_for_trf_creation_date',
	   '$alternate_partial_test_for_trf_creation_date_time',
	   '$employee_id',
	   '$employee_name',
	   '$shift',
	   '$process_name',
	   '$process_id',
	   '$process_width',
	   
	   '$pp_number',
	   '$version_id',
	   '$version_number',
	   '$week_in_year',
	   '$design',
	   '$customer_name',
	   '$customer_id',
	   '$style',
	   '$fiber_composition',
	   '$finish_width_in_inch',
	   '$greige_width_in_inch',
	   '$color',

	   '$before_trolley_number_or_batcher_number',
	   '$after_trolley_number_or_batcher_number',

	   '$before_trolley_or_batcher_in_time',
	   '$after_trolley_or_batcher_out_time',

	   '$before_trolley_or_batcher_qty',
	   '$after_trolley_or_batcher_qty',

	   '$machine_name',
	   '$service_type',
	   '$washing',
	   '$bleaching',
	   '$ironing',
	   '$dry_cleaning',
	   '$drying',
	   '$user_id',
	   '$user_name',
	   NOW()
	)";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
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
