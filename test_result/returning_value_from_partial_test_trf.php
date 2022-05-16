<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $trf_id=$_POST['trf_id_value'];
  $option='<option value="select" selected="selected">Select Version Number</option>';

 /* echo $trf_id;*/

/*  echo '<option> option 1 </option> <option> option 2 </option>';
*/   
         
		
		 //$sql = "select * FROM `partial_test_for_trf_info`,`all_test_for_trf_info` WHERE `all_test_for_trf_info`.`trf_id`='$trf_id' OR `partial_test_for_trf_info`.`trf_id`='$trf_id'";

		 $sql = "select * FROM `partial_test_for_trf_info` WHERE `trf_id`='$trf_id'";

		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $partial_test_for_trf_creation_date=$row['partial_test_for_trf_creation_date'];
		 	 $alternate_partial_test_for_trf_creation_date_time=$row['alternate_partial_test_for_trf_creation_date_time'];
		 	 $shift=$row['shift'];
		 	 $pp_number=$row['pp_number'];
		 	 $version_number=$row['version_number'];
		 	 $design=$row['design'];
		 	 $week_in_year=$row['week_in_year'];
             $customer=$row['customer_name'];
             $fiber_composition=$row['fiber_composition'];
             $finish_width_in_inch=$row['finish_width_in_inch'];
             $before_trolley_number_or_batcher_number=$row['before_trolley_number_or_batcher_number'];
             $after_trolley_number_or_batcher_number=$row['after_trolley_number_or_batcher_number'];
          
             $machine_name=$row['machine_name'];
             $process_name=$row['process_name'];
             
             


             $option='<option value="'."?fs?".$row['pp_number']."?fs?".$row['version_number']."?fs?".$row['design']."?fs?".$row['week_in_year']."?fs?".$row['customer_name']."?fs?".$row['fiber_composition']."?fs?".$row['finish_width_in_inch']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_number_or_batcher_number']."?fs?".$row['before_trolley_or_batcher_qty']."?fs?".$row['machine_name']."?fs?".$row['service_type']."?fs?".$row['washing']."?fs?".$row['bleaching']."?fs?".$row['ironing']."?fs?".$row['dry_cleaning']."?fs?".$row['drying']."?fs?".$row['process_name']."?fs?".$row['partial_test_for_trf_creation_date']."?fs?".$row['alternate_partial_test_for_trf_creation_date_time']."?fs?".$row['shift']."?fs?".$row['customer_id']."?fs?".$row['version_id']."?fs?".$row['before_trolley_or_batcher_in_time']."?fs?".$row['after_trolley_or_batcher_out_time']."?fs?".$row['after_trolley_or_batcher_qty']."?fs?".$row['process_id']."?fs?".$row['style']."?fs?".$row['process_name_from_for_reprocess']."?fs?".'">'.$row['pp_number'].'</option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.trf_id=`pp_wise_version_creation_info`.trf_id ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$design."?fs?".$percentage_of_cotton_content."?fs?".$option;*/
	     /*echo $row['fiber_composition'];*/
		 echo $option;


?>