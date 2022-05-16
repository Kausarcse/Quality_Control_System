<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
   $process_id=$_POST['process_id_value'];

  $option='';

   
		/* $sql = 'select percentage_of_cotton_content,machine_name,version_name  from `pp_wise_version_creation_info` order by `percentage_of_cotton_content`';*/
		echo $sql = "select distinct * FROM `partial_test_for_trf_info` WHERE process_id= '$process_id'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 
		 	
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			  $option=$option.'<option value="'.$row['process_id']."?fs?".$row['process_name'].'"> '.$row['process_name'].' </option>';



		 }

	

	/*	 echo $customer."?fs?".$machine_name."?fs?".$percentage_of_cotton_content."?fs?".$option;*/
		 echo $option;


?>