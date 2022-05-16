<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


  $trolley_details=$_POST['trolley_details'];

  $splitted_data=explode('?fs?',$trolley_details);
  $pp_number = $splitted_data[0]; 
  $version_id = $splitted_data[1]; 
  $style_name = $splitted_data[2]; 
  $finish_width_in_inch = $splitted_data[3]; 

  $trolley_specific_data='';

        $sql = "SELECT after_trolley_number_or_batcher_number, after_trolley_or_batcher_qty, after_trolley_or_batcher_out_time 
                FROM (SELECT partial_test_for_test_result_id, after_trolley_number_or_batcher_number, after_trolley_or_batcher_qty, after_trolley_or_batcher_out_time 
                FROM partial_test_for_test_result_info 
                WHERE pp_number = '$pp_number' AND version_id = '$version_id' AND finish_width_in_inch = '$finish_width_in_inch' AND style = '$style_name'
                ORDER BY partial_test_for_test_result_id ASC LIMIT 2) as ptftri ORDER BY partial_test_for_test_result_id DESC LIMIT 1";
        
        $result= mysqli_query($con,$sql) or die(mysqli_error($con));

        $row = mysqli_fetch_array( $result);
		
        $after_trolley_number_or_batcher_number=$row['after_trolley_number_or_batcher_number'];
        $after_trolley_or_batcher_qty=$row['after_trolley_or_batcher_qty'];
        $after_trolley_or_batcher_out_time=$row['after_trolley_or_batcher_out_time'];

        $trolley_specific_data = $after_trolley_number_or_batcher_number.'?fs?'.$after_trolley_or_batcher_qty.'?fs?'.$after_trolley_or_batcher_out_time.'?fs?';

		echo $trolley_specific_data;


?>