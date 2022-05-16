<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $pp_number=$_POST['pp_number_value'];
  $process_name='';
 
  $option='<option value="select" selected="selected">Select Version Number</option>';


              
/*$sql_for_porcess_selection="SELECT DISTINCT apv.process_serial_no,apv.process_name from partial_test_for_trf_info ptti
								INNER JOIN adding_process_to_version apv ON ptti.pp_number=apv.pp_number and ptti.version_id=apv.version_id
								WHERE apv.pp_number='$pp_number' order by process_serial_no asc";
  $result_for_porcess_selection= mysqli_query($con,$sql_for_porcess_selection) or die(mysqli_error($con));
   

		 while( $row_for_all_process = mysqli_fetch_array( $result_for_porcess_selection))
		 {
			$data_for_all_process[] = $row_for_all_process['process_name'];
		 }


		if($row_for_all_process['process_name']=='Bleaching')
		{     
			$process_name='Bleaching';
			 $current_process_index = array_search($process_name,$data_for_all_process);

		 echo $current_process_index;
		 exit();
		}

		if($row_for_all_process['process_name']=='Scouring')
		{    $process_name='Scouring';
			 $current_process_index = array_search($process_name,$data_for_all_process);

		 echo $current_process_index;
		 exit();
		}
		

else{
       */  
		/* $sql = 'select percentage_of_cotton_content,design,version_name  from `pp_wise_version_creation_info` order by `percentage_of_cotton_content`';*/
		 $sql = "select * FROM `process_program_info`,`pp_wise_version_creation_info` WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number AND
`process_program_info`.pp_number='$pp_number'";

		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $design=$row['design'];
		 	 $week_in_year=$row['week_in_year'];
             $customer=$row['customer_name'];
             $percentage_of_cotton_content=$row['percentage_of_cotton_content'];
             $percentage_of_polyester_content=$row['percentage_of_polyester_content'];
             $percentage_of_other_fiber_content=$row['percentage_of_other_fiber_content'];
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			  $option=$option.'<option value="'.$row['version_name']."?fs?".$row['design']."?fs?".$row['week_in_year']."?fs?".$row['customer_name']."?fs?".$row['percentage_of_cotton_content']."?fs?".$row['percentage_of_polyester_content']."?fs?".$row['percentage_of_other_fiber_content']."?fs?".$row['customer_id']."?fs?".$row['version_id']."?fs?".$row['style_name']."?fs?".$row['finish_width_in_inch']."?fs?".$row['process-id'].'?fs?'.'">Version:'.$row['version_name'].', Style:'.$row['style_name'].' ,Customer:'.$row['customer_name'].', Cotton:'.$row['percentage_of_cotton_content'].', Polyester:'.$row['percentage_of_polyester_content'].', Other:'.$row['percentage_of_other_fiber_content'].', Finish Width:'.$row['finish_width_in_inch'].'</option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$design."?fs?".$percentage_of_cotton_content."?fs?".$option;*/
		 echo $option;


?>