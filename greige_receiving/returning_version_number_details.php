<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $pp_number=$_POST['pp_number_value'];
  $option='<option value="select" selected="selected">Select Version Number</option>';

 /* echo $pp_number;*/

/*  echo '<option> option 1 </option> <option> option 2 </option>';
*/   
         
		/* $sql = 'select greige_width_in_inch,color,version_name  from `pp_wise_version_creation_info` order by `greige_width_in_inch`';*/
		 $sql = "select * FROM `process_program_info`,`pp_wise_version_creation_info` WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number AND
`process_program_info`.pp_number='$pp_number'";

		 $result= mysqli_query($con,$sql) or die(mysqli_error());

		 while( $row = mysqli_fetch_array( $result))
		 {    
             $customer=$row['customer_name'];
             $color=$row['color'];
              $greige_width=$row['greige_width_in_inch'];
/*			  $option=$option.'<option value="'.$row['version_name'].'">Version:'.$row['version_name'].'</option>';
*/			  $option=$option.'<option value="'.$row['version_name']."?fs?".$row['color']."?fs?".$row['greige_width_in_inch']."?fs?".$row['customer_name'].'">Version:'.$row['version_name'].', Color: '.$row['color'].', Greige Width:'.$row['greige_width_in_inch'].' ,Customer:'.$row['customer_name'].'</option>';



		 }

		/*$sql_for_customer= 'select * from `process_program_info`,`pp_wise_version_creation_info` where `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number ';
		 
		$customer_result= mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
		while ($customer_row = mysqli_fetch_array( $customer_result)) {
			$customer=$customer_row['customer_name'];
			
			
		}*/

	/*	 echo $customer."?fs?".$color."?fs?".$greige_width."?fs?".$option;*/
		 echo $option;


?>