<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

  $pp_number=$_POST['pp_number_value'];
  $option='<option value="select" selected="selected">Select Version Number</option>';

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
		
		$option=$option.'<option value="'.$row['version_name']."?fs?".$row['design']."?fs?".$row['week_in_year']."?fs?".$row['customer_name']."?fs?".$row['percentage_of_cotton_content']."?fs?".$row['percentage_of_polyester_content']."?fs?".$row['percentage_of_other_fiber_content']."?fs?".$row['customer_id']."?fs?".$row['version_id']."?fs?".$row['style_name']."?fs?".$row['finish_width_in_inch']."?fs?".$row['greige_width_in_inch']."?fs?".$row['color']."?fs?".'">Version:'.$row['version_name'].', style: '.$row['style_name'].' ,Customer:'.$row['customer_name'].', Cotton:'.$row['percentage_of_cotton_content'].', Polyester:'.$row['percentage_of_polyester_content'].', Other:'.$row['percentage_of_other_fiber_content'].', Finish Width:'.$row['finish_width_in_inch'].', Color:'.$row['color'].'</option>';
		
	}

	echo $option;


?>