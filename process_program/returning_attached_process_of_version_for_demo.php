<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$pp_number=$_POST['pp_number_value'];
$version_number=$_POST['version_number_value'];
$color_value=$_POST['color_value'];
$option='<option value="select" selected="selected">Select Standard For</option>';

 /* echo $pp_number;*/

/*  echo '<option> option 1 </option> <option> option 2 </option>';
*/   
         
		/* $sql = 'select finish_width_in_inch,color,version_name  from `pp_wise_version_creation_info` order by `finish_width_in_inch`';*/
		 /*$sql = "select * from `adding_process_to_version`,`test_method_add_for_pp` where `adding_process_to_version`.`pp_number='$pp_number' and `adding_process_to_version`.`version_name`='$version_number'  and `test_method_add_for_pp`.`version_number`='$version_number' and `adding_process_to_version`.`color`='$color_value' and `adding_process_to_version`.`version_name`=`test_method_add_for_pp`.`version_number`";*/



		 /*$sql = "select * from `adding_process_to_version`,`test_method_add_for_pp` where `adding_process_to_version`.`pp_number`='$pp_number' and `adding_process_to_version`.`version_name`='$version_number'  and `test_method_add_for_pp`.`version_number`='$version_number' and `adding_process_to_version`.`color`='$color_value' and `adding_process_to_version`.`version_name`=`test_method_add_for_pp`.`version_number` AND `adding_process_to_version`.`version_id`=`test_method_add_for_pp`.`version_id`";*/

		/* $sql = "select * from `adding_process_to_version`,`test_method_add_for_pp` where `adding_process_to_version`.`pp_number`='$pp_number' and `adding_process_to_version`.`color`='$color_value' and `adding_process_to_version`.`version_name`=`test_method_add_for_pp`.`version_number` AND `adding_process_to_version`.`version_id`=`test_method_add_for_pp`.`version_id` AND `adding_process_to_version`.`version_id`=`test_method_add_for_pp`.`version_id`";*/


		  $sql = "select distinct process_id,process_name,customer_id,version_id from `test_method_add_for_pp` where `pp_number`='$pp_number' and `version_number`='$version_number' and `color`='$color_value'";

		
		 
		 $result= mysqli_query($con,$sql) or die(mysqli_error());

		 while( $row = mysqli_fetch_array( $result))
		 {    
              $process_name=$row['process_name'];
              //$color=$row['color'];
              //$finish_width_in_inch=$row['finish_width_in_inch'];
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			 //$option=$option.'<option value="'.$row['test_id']."?fs?".$row['process_id']."?fs?".$row['customer_id']."?fs?".$row['test_method_id']."?fs?".$row['version_id']."?fs?".$row['process_name'].'">'.$row['process_name'].'</option>';


$option=$option.'<option value="'.$row['process_id']."?fs?".$row['process_name']."?fs?".$row['customer_id']."?fs?".$row['version_id'].'">'.$row['process_name'].'</option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$color."?fs?".$finish_width_in_inch."?fs?".$option;*/
		 echo $option;


?>