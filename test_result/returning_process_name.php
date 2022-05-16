<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
   $process_name=$_POST['process_name_value'];
  $splitted_data=explode('?fs?',$process_name);
  $process_id=$splitted_data[0]; 

  $option='<option value="" selected="selected">Select Machine </option>';

 /* echo $process_id;*/

/*  echo '<option> option 1 </option> <option> option 2 </option>';
*/   
         
		/* $sql = 'select percentage_of_cotton_content,machine_name,version_name  from `pp_wise_version_creation_info` order by `percentage_of_cotton_content`';*/
		 $sql = "select * FROM `machine_name` WHERE  `machine_name`.process_id= '$process_id'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $machine_name=$row['machine_name'];
		 	
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			  $option=$option.'<option value="'.$row['machine_name'].'"> '.$row['machine_name'].' </option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.process_id=`pp_wise_version_creation_info`.process_id ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$machine_name."?fs?".$percentage_of_cotton_content."?fs?".$option;*/
		 echo $option;


?>