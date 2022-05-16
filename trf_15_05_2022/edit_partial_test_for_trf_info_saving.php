<?php
session_start();
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
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

if( mysql_num_rows($result) < 1 )
{

	header('Location:logout.php');

}
else
{
	while($row=mysql_fetch_array($result))
	{	
		 $user_name=$row['user_name'];	
	}
}

*/

$partial_test_for_trf_creation_date= $_POST['partial_test_for_trf_creation_date'];
$alternate_partial_test_for_trf_creation_date_time= $_POST['alternate_partial_test_for_trf_creation_date_time'];
//$splitted_pp_creation_date= explode("/",$partial_test_for_trf_creation_date);
//$partial_test_for_trf_creation_date= $splitted_pp_creation_date[2]."-".$splitted_pp_creation_date[1]."-".$splitted_pp_creation_date[0];



$employee_name= $_POST['employee_name'];
$splitted_employee_name=explode("?fs?", $employee_name);
$employee_name=$splitted_employee_name[0];
$employee_id=$splitted_employee_name[1];




$shift= $_POST['shift'];


$process_width=$_POST['process_width'];
$process_name= $_POST['process_name'];
$splitted_data_for_process= explode('?fs?', $process_name);
$process_name=$splitted_data_for_process[1];  //changed
 $process_id=$splitted_data_for_process[0];


 $pp_number= $_POST['pp_number'];
$version_id= $_POST['version_id'];
$version_number= $_POST['version_number'];


$week_in_year= $_POST['week_in_year'];
$design= $_POST['design'];
$customer_name= $_POST['customer_name'];
$customer_id= $_POST['customer_id'];
$style= $_POST['style'];

$fiber_composition= $_POST['fiber_composition'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];

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

// $select_sql_for_duplicacy=" select * from `partial_test_for_trf_info` 
// 							 where `shift`='$shift' 
// 							   and `process_name`='$process_name' 
// 							   and `pp_number`='$pp_number' 
// 							   and `version_number`='$version_number' 
// 							   and `week_in_year`='$week_in_year' 
// 							   and `design`='$design' 
// 							   and `customer_name`='$customer_name' 
// 							   and `fiber_composition`='$fiber_composition' 
// 							   and `finish_width_in_inch` = '$finish_width_in_inch' 
// 							   and `before_trolley_number_or_batcher_number` = '$before_trolley_number_or_batcher_number'
// 							   and `after_trolley_number_or_batcher_number` = '$after_trolley_number_or_batcher_number'
// 							   and `qty`=$qty and `machine_name` = '$machine_name'
// 							   and `service_type` = '$service_type'";

$select_sql_for_duplicacy="select * from `partial_test_for_trf_info` where `pp_number`='$pp_number' and `process_name`='$process_name' and `version_number`='$version_number' AND
`partial_test_for_trf_creation_date`='$partial_test_for_trf_creation_date' AND
	`alternate_partial_test_for_trf_creation_date_time`='$alternate_partial_test_for_trf_creation_date_time' AND
	`employee_name`='$employee_name' AND
	 `shift`='$shift' AND
     `pp_number`='$pp_number' AND
     `version_number`='$version_number' AND
	 `process_name`='$process_name' AND
	 `process_width`='$process_width' AND
	 `week_in_year`='$week_in_year' AND
	 `design`='$design' AND
	 `customer_name`='$customer_name' AND
	 `fiber_composition`='$fiber_composition' AND
	 `finish_width_in_inch`='$finish_width_in_inch' AND 

	 `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' AND
	 `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' AND

	 `before_trolley_or_batcher_in_time`='$before_trolley_or_batcher_in_time' AND
	 `after_trolley_or_batcher_out_time`='$after_trolley_or_batcher_out_time' AND

	 `before_trolley_or_batcher_qty`='$before_trolley_or_batcher_qty' AND
	 `after_trolley_or_batcher_qty`='$after_trolley_or_batcher_qty' AND
	 
	 `machine_name`='$machine_name' AND
	 `service_type`='$service_type' AND
	 `washing`='$washing' AND 
	 `bleaching`='$bleaching' AND
	 `ironing`='$ironing' AND 
	 `dry_cleaning`='$dry_cleaning' AND 
	 `drying`='$drying' ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));



if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

    

	$update_sql_statement="UPDATE `partial_test_for_trf_info` SET
	 `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number', 
	 `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number',

	 `before_trolley_or_batcher_in_time`='$before_trolley_or_batcher_in_time', 
	 `after_trolley_or_batcher_out_time`='$after_trolley_or_batcher_out_time', 

	 `before_trolley_or_batcher_qty`='$before_trolley_or_batcher_qty',
	 `after_trolley_or_batcher_qty`='$after_trolley_or_batcher_qty'
	 
	
	 WHERE 
     `pp_number`='$pp_number' and `process_id`='$process_id' and process_name='$process_name' and `version_id`='$version_id' and `finish_width_in_inch`='$finish_width_in_inch' ";



mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

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
	echo "Data is successfully Updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously Updated.";

}

$obj->disconnection();

?>
