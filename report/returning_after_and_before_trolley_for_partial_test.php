<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $process_name=$_POST['process_name_value'];
  $process_name;

  $before_trolley = '';
  $after_trolley = '';
  
  $splitted_data=explode('?fs?',$process_name);
  $process_id=$splitted_data[0]; 
  $version_id=$splitted_data[1];
  $pp_number=$splitted_data[2];
  $style_name=$splitted_data[3];
  $finish_width_in_inch=$splitted_data[4];
  $before_trolley_number_or_batcher_number=$splitted_data[5];
  $after_trolley_number_or_batcher_number=$splitted_data[6];
  

   $sql_for_trolley_selection="SELECT before_trolley_number_or_batcher_number, after_trolley_number_or_batcher_number from partial_test_for_test_result_info WHERE pp_number='$pp_number'
                              AND version_id='$version_id' and process_id='$process_id' and finish_width_in_inch = '$finish_width_in_inch' and style = '$style_name' ";
                            
  $result_for_trolley_selection= mysqli_query($con,$sql_for_trolley_selection) or die(mysqli_error($con));
   

   while( $row = mysqli_fetch_array( $result_for_trolley_selection))
   {    
   	
      if ($row['before_trolley_number_or_batcher_number'] == $before_trolley_number_or_batcher_number) 
      {
        
          $before_trolley .= "<option value='".$row['before_trolley_number_or_batcher_number']."' selected>";   
          $before_trolley .= $row['before_trolley_number_or_batcher_number'];    
          $before_trolley .= "</option>"; 
      } 

      else
      {
          $before_trolley .= "<option value='".$row['before_trolley_number_or_batcher_number']."'>";   
          $before_trolley .= $row['before_trolley_number_or_batcher_number'];    
          $before_trolley .= "</option>"; 
      }

      
       	
      if ($row['after_trolley_number_or_batcher_number'] == $after_trolley_number_or_batcher_number) 
      {
        
          $after_trolley .= "<option value='".$row['after_trolley_number_or_batcher_number']."' selected>";   
          $after_trolley .= $row['after_trolley_number_or_batcher_number'];    
          $after_trolley .= "</option>"; 
      } 

      else
      {
          $after_trolley .= "<option value='".$row['after_trolley_number_or_batcher_number']."'>";   
          $after_trolley .= $row['after_trolley_number_or_batcher_number'];    
          $after_trolley .= "</option>"; 
      }

   }

	
  $json = array('after_trolley' => $after_trolley, 'before_trolley' => $before_trolley);

  $results[] = $json;  

  
  echo json_encode($results); 


?>