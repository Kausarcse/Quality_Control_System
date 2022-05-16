<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$trf_id=$_POST['trf_id'];

if($trf_id == 'select')
{
	$pp_number=$_POST['pp_number'];

	$version_details= $_POST['version_number'];
	$splitted_version_number=explode("?fs?",$version_details);

	$version_number= $splitted_version_number[0];
	$customer_id= $splitted_version_number[7];
	$version_id= $splitted_version_number[8];
	$style= $splitted_version_number[9];
	$finish_width_in_inch= $splitted_version_number[10];

	$process_details= $_POST['process_name'];
	$split_process_name= explode("?fs?", $process_details);
	$process_id= $split_process_name[0];
	$process_name= $split_process_name[1];
	
	if(isset($_POST['before_trolley_number_or_batcher_number']))
	{
		$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
	}
	else
	{
		$before_trolley_number_or_batcher_number= '';
	}

	if(isset($_POST['after_trolley_number_or_batcher_number']))
	{
		$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
	}
	else
	{
		$after_trolley_number_or_batcher_number= '';
	}
	
	$sql = "SELECT  * from partial_test_for_test_result_info 
			where  pp_number='$pp_number' 
			and process_name='$process_name' 
			and version_id = '$version_id' 
			and finish_width_in_inch = '$finish_width_in_inch' 
			and customer_id = '$customer_id' 
			AND style = '$style' 
			and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number' 
			and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number'";

}
else
{
	$sql = "select  * from partial_test_for_test_result_info where trf_id='$trf_id'";
}

		$result= mysqli_query($con,$sql) or die(mysqli_error($con));
		$option="";
		while( $row = mysqli_fetch_array( $result))
		{    
			$option=$row['partial_test_for_test_result_id']."?fs?".$row['trf_id']."?fs?".$row['employee_id']."?fs?".$row['employee_name']."?fs?".$row['shift']."?fs?".$row['process_name']."?fs?".$row['pp_number']."?fs?".$row['version_number']."?fs?".$row['customer_name']."?fs?".$row['customer_id']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_or_batcher_qty']."?fs?".$row['machine_name']."?fs?".$row['version_id']."?fs?";
		}

		 echo $option;


?>