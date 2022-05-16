<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$customer_id=$_POST['customer_id'];

//  $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
// from test_name_and_method_for_all_process tnm 
// INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
// INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id and tmc.test_method_id=ttnm.test_method_id
// where tmc.customer_id = '$customer_id'  ORDER BY tnm.id asc";

$sql = "SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
WHERE tmc.customer_id = '$customer_id' ORDER BY ttnm.test_name_and_method_for_process_id ASC";

$data="";
$data_for_test_method_id="";
$test_name_method="";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
									 while( $row = mysqli_fetch_array($result))
									 {

										 $data=$data."?fs?".$row['id'];

										 $data_for_test_method_id= $data_for_test_method_id."?tnm?".$row['test_method_id'];

										 $test_name_method= $test_name_method."?tnm?".$row['test_name_method'];
									      
								      }
                    
                                     echo $data.'?met?'.$data_for_test_method_id.'?met?'.$test_name_method;

                                      
								      
?>