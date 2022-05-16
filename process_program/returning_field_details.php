<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
 $process_name=$_POST['process_name'];



  $splitted_data=explode("?fs?", $process_name);

  $process_id=$splitted_data[0];
  $process_name=$splitted_data[1];
  $customer_id=$splitted_data[2];
  $version_id=$splitted_data[3];
 
  $option='';



          /*$sql = "select  *  FROM `test_method_add_for_pp`,`field_selection_for_test_method` WHERE `test_method_add_for_pp`.`process_name`='$process_name' AND `test_method_add_for_pp`.`process_id`='$process_id' AND `field_selection_for_test_method`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`version_id`='$version_id' AND `test_method_add_for_pp`.`test_method_id`='$test_method_id'";
*/

          /*$sql = "select  *  FROM `test_method_add_for_pp`,`field_selection_for_test_method` WHERE `test_method_add_for_pp`.`process_name`='$process_name' AND `test_method_add_for_pp`.`process_id`='$process_id' AND `field_selection_for_test_method`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`version_id`='$version_id' ";*/

         /* $sql = "select distinct test_method_add_for_pp.process_name, test_method_add_for_pp.process_id,field_selection_for_test_method.test_name,field_selection_for_test_method.test_method_name,field_selection_for_test_method.direction_or_type,field_selection_for_test_method.field_for_value,field_selection_for_test_method.field_for_math_operator,field_selection_for_test_method.field_for_tolerance,field_selection_for_test_method.field_for_uom,field_selection_for_test_method.field_for_minimum_value,field_selection_for_test_method.field_for_maximum_value,field_selection_for_test_method.test_name_for_use  FROM `test_method_add_for_pp`,`field_selection_for_test_method`

           WHERE 

           `test_method_add_for_pp`.`process_name`='$process_name' AND `test_method_add_for_pp`.`process_id`='$process_id' AND `field_selection_for_test_method`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`version_id`='$version_id' ";*/



            $sql = "select distinct test_method_add_for_pp.process_name, test_method_add_for_pp.process_id,field_selection_for_test_method.test_name,field_selection_for_test_method.test_method_name,field_selection_for_test_method.direction_or_type,field_selection_for_test_method.field_for_value,field_selection_for_test_method.field_for_math_operator,field_selection_for_test_method.field_for_tolerance,field_selection_for_test_method.field_for_uom,field_selection_for_test_method.field_for_minimum_value,field_selection_for_test_method.field_for_maximum_value,field_selection_for_test_method.test_name_for_use  FROM `test_method_add_for_pp`,`field_selection_for_test_method`
          
           WHERE 

           `test_method_add_for_pp`.`process_name`='$process_name' AND `test_method_add_for_pp`.`process_id`='$process_id' AND `field_selection_for_test_method`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`customer_id`='$customer_id' AND `test_method_add_for_pp`.`version_id`='$version_id' AND `test_method_add_for_pp`.`test_name`=`field_selection_for_test_method`.`test_name`";
        
		
       
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
             //$customer=$row['customer_name'];
            // $color=$row['color'];
            //  $finish_width_in_inch=$row['finish_width_in_inch'];
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			 /* $option=$option.'<option value="'.$row['version_name']."?fs?".$row['color']."?fs?".$row['finish_width_in_inch']."?fs?".$row['customer_name']."?fs?".$row['customer_id'].'">Version:'.$row['version_name'].', Color: '.$row['color'].', Finish Width:'.$row['finish_width_in_inch'].' ,Customer:'.$row['customer_name'].'</option>';*/



           /*$option=$option.'<option value="'.$row['test_name']."?fs?".$row['test_method_name']."?fs?".$row['direction_or_type']."?fs?".$row['field_for_value']."?fs?".$row['field_for_math_operator']."?fs?".$row['field_for_tolerance']."?fs?".$row['field_for_uom']."?fs?".$row['field_for_minimum_value']."?fs?".$row['field_for_maximum_value']. '">Name:'.$row['test_method_name'].'</option>';*/


           $option=$option."?option?".$row['test_name']."?fs?".$row['test_method_name']."?fs?".$row['direction_or_type']."?fs?".$row['field_for_value']."?fs?".$row['field_for_math_operator']."?fs?".$row['field_for_tolerance']."?fs?".$row['field_for_uom']."?fs?".$row['field_for_minimum_value']."?fs?".$row['field_for_maximum_value']."?fs?".$row['test_name_for_use'];



		 }

		/*$sql_for_customer= 'select * from `test_method_add_for_pp`,`pp_wise_version_creation_info` where `test_method_add_for_pp`.pp_number=`pp_wise_version_creation_info`.pp_number ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$color."?fs?".$finish_width_in_inch."?fs?".$option;*/
		 echo $option;


?>