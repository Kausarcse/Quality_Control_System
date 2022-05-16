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

$partial_test_for_test_result_creation_date= $_POST['partial_test_for_test_result_creation_date'];
$alternate_partial_test_for_test_result_creation_date_time= $_POST['alternate_partial_test_for_test_result_creation_date_time'];
$splitted_pp_creation_date= explode("/",$partial_test_for_test_result_creation_date);
$partial_test_for_test_result_creation_date= $splitted_pp_creation_date[2]."-".$splitted_pp_creation_date[1]."-".$splitted_pp_creation_date[0];
$trf_id= $_POST['trf_id'];
$shift= $_POST['shift'];
$process_name= $_POST['process_name'];
$pp_number= $_POST['pp_number'];

$version_number= $_POST['version_number'];
$splitted_version_number=explode("?fs?",$version_number);
$version_number= $splitted_version_number[0];

$week_in_year= $_POST['week_in_year'];
$design= $_POST['design'];
$customer_name= $_POST['customer_name'];
$fiber_composition= $_POST['fiber_composition'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
$qty= $_POST['qty'];
$machine_name= $_POST['machine_name'];
$service_type= $_POST['service_type'];
$washing= $_POST['washingURL'];
$bleaching= $_POST['bleachingURL'];
$ironing= $_POST['ironingURL'];
$dry_cleaning= $_POST['DryCleaningURL'];
$drying= $_POST['DryingURL'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

// $select_sql_for_duplicacy=" select * from `partial_test_for_test_result_info` 
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
// 							   and `service_type` = '$service_type'"; trf_id

$select_sql_for_duplicacy="select * from `partial_test_for_test_result_info` where `trf_id`='$trf_id' and `shift`='$shift' and `pp_number`='$pp_number' and `version_number`='$version_number' and `week_in_year`='$week_in_year' and `design`='$design' and `customer_name`='$customer_name' and `fiber_composition`='$fiber_composition' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and `qty`='$qty' and `machine_name`= '$machine_name' and`service_type`= '$service_type'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));



if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

     

	$insert_sql_statement="INSERT INTO `partial_test_for_test_result_info`(`partial_test_for_test_result_creation_date`,`alternate_partial_test_for_test_result_creation_date_time`, `trf_id`,`shift`,`process_name`,`pp_number`, `version_number`, `week_in_year`, `design`, `customer_name`, `fiber_composition`, `finish_width_in_inch`, `before_trolley_number_or_batcher_number`, `after_trolley_number_or_batcher_number`, `qty`, `machine_name`, `service_type`, `washing`, `bleaching`, `ironing`, `dry_cleaning`, `drying`, `recording_person_id`, `recording_person_name`, `recording_time`) 
	   VALUES
	   ('$partial_test_for_test_result_creation_date','$alternate_partial_test_for_test_result_creation_date_time','$trf_id','$shift','$process_name','$pp_number','$version_number','$week_in_year','$design','$customer_name','$fiber_composition',$finish_width_in_inch,$before_trolley_number_or_batcher_number,$after_trolley_number_or_batcher_number,$qty,'$machine_name','$service_type','$washing','$bleaching','$ironing','$dry_cleaning','$drying','$user_id','$user_name',NOW())";

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
