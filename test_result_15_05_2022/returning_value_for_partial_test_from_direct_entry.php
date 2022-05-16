<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$all_value=$_POST['all_value'];
$splitted_data=explode('?fs?', $all_value);


$trf_id=$splitted_data[1];
$process_id=$splitted_data[2];
$pp_number=$splitted_data[3];
$partial_test_for_test_result_id=$splitted_data[5];

  /*$partial_test_for_test_result_id=$_POST['partial_test_for_test_result_id'];
  $pp_number=$_POST['pp_number'];
  $version_number=$_POST['version_number'];
  $process_id=$_POST['process_id'];
*/
		  /*$sql = "select distinct * from qc_result_for_$process_id_process where partial_test_for_test_result_id='$partial_test_for_test_result_id'";
*/
    $sql = "select  * from partial_test_for_test_result_info where trf_id='$trf_id' AND (pp_number='$pp_number' and process_id='$process_id' and `partial_test_for_test_result_id`='$partial_test_for_test_result_id')";



		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
     $option="";
    		 while( $row = mysqli_fetch_array( $result))
    		 {    
            

			  $option=$row['partial_test_for_test_result_id']."?fs?".$row['trf_id']."?fs?".$row['employee_id']."?fs?".$row['employee_name']."?fs?".$row['shift']."?fs?".$row['process_name']."?fs?".$row['pp_number']."?fs?".$row['version_number']."?fs?".$row['customer_name']."?fs?".$row['customer_id']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_or_batcher_qty']."?fs?".$row['machine_name']."?fs?".$row['version_id']."?fs?";

              

		 }

		 echo $option;


?>