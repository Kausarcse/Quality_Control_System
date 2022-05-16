<?php
error_reporting(0);
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
 $version_and_process=$_POST['version_and_process'];

 $splitted_data=explode('?fs?',$version_and_process);

   $version_id=$splitted_data[0];
   $after_trolley_number_or_batcher_number=$splitted_data[1];  
   $process_id=$splitted_data[2]; 
   $process_name=$splitted_data[3]; 

  $pp_number="";
  $version_number="";
  $current_process_index="";
  $option="";

  $sql_for_porcess_selection="SELECT DISTINCT apv.process_serial_no,apv.process_name,apv.process_id,ptti.version_number,ptti.pp_number,ptti.design,ptti.style,ptti.finish_width_in_inch from partial_test_for_test_result_info ptti
								INNER JOIN adding_process_to_version apv ON ptti.pp_number=apv.pp_number and ptti.version_id=apv.version_id
								WHERE apv.version_id='$version_id'   order by process_serial_no asc ";
							
  $result_for_porcess_selection= mysqli_query($con,$sql_for_porcess_selection) or die(mysqli_error($con));
   






		 while( $row_for_pp_version = mysqli_fetch_array( $result_for_porcess_selection))
		 {
			 $data_for_all_process[] = $row_for_pp_version['process_name'];
			 $data_for_all_process_id[] = $row_for_pp_version['process_id'];

              $pp_number=$row_for_pp_version['pp_number'];
              $version_number=$row_for_pp_version['version_number'];
              $design=$row_for_pp_version['design'];
              $style=$row_for_pp_version['style'];
              $finish_width_in_inch=$row_for_pp_version['finish_width_in_inch'];
			
            
			
		 }      
                 
                
				 /*$current_process_index = array_search($process_name,$data_for_all_process);*/
				 $current_process_id_index = array_search($process_id,$data_for_all_process_id);
				 $current_process_id_index;

				
               
               /*  $for_current_process_name=$data_for_all_process[($current_process_index-1)];*/
                
                $for_current_process_id=$data_for_all_process_id[($current_process_id_index-1)];


		$sql = "SELECT ptfti.process_name
		         ,ptfti.after_trolley_or_batcher_qty, ptfti.after_trolley_or_batcher_out_time
		          FROM partial_test_for_test_result_info ptfti
				WHERE ptfti.process_id='".$for_current_process_id."' AND ptfti.pp_number='$pp_number' AND ptfti.version_number='$version_number'
				and  ptfti.finish_width_in_inch = '$finish_width_in_inch'
				and ptfti.after_trolley_number_or_batcher_number='$after_trolley_number_or_batcher_number'";
         
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	
		 	
		  /*$option=$option.'<option value="'.$row['process_name']."?fs?".$row['before_trolley_mtr']."?fs?".$row['before_trolley_or_batcher_no']."?fs?".'"> '.$row['process_name'].' </option>';*/
		  $option=$row['after_trolley_or_batcher_qty'].'?fs?'.$row['after_trolley_or_batcher_out_time'];



		 }

		 echo $option;


?>