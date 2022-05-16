<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $trf_id=$_POST['trf_id_value'];
  $option='<option value=" " selected="selected">Select Time</option>';



		 $sql = "SELECT alternate_partial_test_for_test_result_creation_date_time FROM `partial_test_for_test_result_info` WHERE `trf_id`='$trf_id'";


		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $alternate_partial_test_for_test_result_creation_date_time=$row['alternate_partial_test_for_test_result_creation_date_time'];
		 	 
             


             $option='<option value="'.$row['alternate_partial_test_for_test_result_creation_date_time'].'">'.$row['alternate_partial_test_for_test_result_creation_date_time'].'</option>';



		 }


		 echo $option;


?>