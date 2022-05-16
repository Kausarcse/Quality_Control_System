<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$customer_id=$_POST['customer_id'];

$sql="SELECT distinct tnm.id
from test_name_and_method_for_all_process tnm 
INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id
where tmc.customer_id = '$customer_id'";

$data="";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
									 while( $row = mysqli_fetch_array( $result))
									 {

										 $data=$data."?fs?".$row['id'];
									      
								      }
                    
                                     echo $data;
								      
?>