<?php

include('../../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $pp_number=$_POST['pp_number_value'];
  $option='<option value="select" selected="selected">Select Version Number</option>';

 /* echo $pp_number;*/

/*  echo '<option> option 1 </option> <option> option 2 </option>';
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
*/			  $option=$option.'<option value="'.$row['version_name']."?fs?".$row['design']."?fs?".$row['week_in_year']."?fs?".$row['customer_name']."?fs?".$row['percentage_of_cotton_content']."?fs?".$row['percentage_of_polyester_content']."?fs?".$row['percentage_of_other_fiber_content'].'">Version:'.$row['version_name'].', design: '.$row['design'].' ,Customer:'.$row['customer_name'].', Cotton:'.$row['percentage_of_cotton_content'].', Polyester:'.$row['percentage_of_polyester_content'].', Other:'.$row['percentage_of_other_fiber_content'].'</option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$design."?fs?".$percentage_of_cotton_content."?fs?".$option;*/
		 echo $option;


?>