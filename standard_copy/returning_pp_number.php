<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $customer_data=$_POST['customer_data'];
  $split_customer_data=explode('?fs?', $customer_data);
  $customer_id=$split_customer_data[0];
  $process_technique_name=$split_customer_data[1];
  $construction_name=$split_customer_data[2];
  $version_name=$split_customer_data[3];

  $option='<option value="select" selected="selected">Select PP NUmber</option>';



		 $sql = "select distinct pwvci.pp_number FROM `pp_wise_version_creation_info` pwvci,`process_program_info` ppi  WHERE ppi.customer_id='$customer_id' and pwvci.process_technique_name='$process_technique_name' and pwvci.construction_name='$construction_name'";
		

		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
             
		  $option=$option.'<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';



		 }


		 echo $option;


?>