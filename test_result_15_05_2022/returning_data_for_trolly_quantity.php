<?php
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


   $details_for_trolly_qty=$_POST['details_for_trolly_qty'];
   $splitted_data=explode('?fs?',$details_for_trolly_qty);
   $pp_number=$splitted_data[0]; 
   $finish_width_in_inch=$splitted_data[1]; 
   $customer_id=$splitted_data[2]; 
   $version_id=$splitted_data[3]; 

   $option = '';
   
		 $sql = "SELECT after_trolley_or_batcher_qty, after_trolley_or_batcher_out_time, after_trolley_number_or_batcher_number 
                FROM partial_test_for_test_result_info 
                WHERE pp_number = '$pp_number' AND version_id = '$version_id' AND finish_width_in_inch = '$finish_width_in_inch' AND customer_id = '$customer_id'
                ORDER BY partial_test_for_test_result_id DESC LIMIT 1";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $after_trolley_or_batcher_qty=$row['after_trolley_or_batcher_qty'];
              $after_trolley_or_batcher_out_time=$row['after_trolley_or_batcher_out_time'];
		 	 $after_trolley_number_or_batcher_number=$row['after_trolley_number_or_batcher_number'];

			  $option= $after_trolley_or_batcher_qty.'?fs?'.$after_trolley_or_batcher_out_time.'?fs?'.$after_trolley_number_or_batcher_number;



		 }


		 echo $option;


?>