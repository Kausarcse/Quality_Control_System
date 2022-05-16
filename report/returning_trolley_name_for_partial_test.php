<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $process_name=$_POST['process_name_value'];
  $process_name;
  
  $splitted_data=explode('?fs?',$process_name);
  $process_id=$splitted_data[0]; 
  $version_id=$splitted_data[1];

  $pp_number=$splitted_data[2];
  

   $sql_for_trolley_selection="SELECT before_trolley_number_or_batcher_number,after_trolley_number_or_batcher_number from partial_test_for_test_result_info WHERE pp_number='$pp_number'
                              AND version_id='$version_id' and process_id='$process_id'";
                            
  $result_for_trolley_selection= mysqli_query($con,$sql_for_trolley_selection) or die(mysqli_error($con));
   
  

         $option='<option value=" " selected="selected">Select </option>';

	
		 while( $row = mysqli_fetch_array( $result_for_trolley_selection))
		 {    
		 	
		 	
		  $option=$option.'<option value="'."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['after_trolley_number_or_batcher_number']."?fs?".'">  </option>';



		 }

		 echo $option;


?>