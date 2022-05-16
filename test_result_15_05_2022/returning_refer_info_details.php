<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

  $pp_number=$_POST['pp_number_value'];

  $option='<option value="select" selected="selected">Select Refer Information</option>';

	// $sql = "select * FROM `process_program_info`,`pp_wise_version_creation_info` WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number AND
	// 	`process_program_info`.pp_number='$pp_number'";

	$sql = "select DISTINCT `process_program_info`.*, `pp_wise_version_creation_info`.*, qrgr.received_quantity_in_meter FROM `process_program_info`,`pp_wise_version_creation_info`, qc_result_for_greige_receiving_process qrgr
		WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number 
		AND `process_program_info`.pp_number='$pp_number'
		AND qrgr.pp_number = `process_program_info`.pp_number
		AND qrgr.version_number = `pp_wise_version_creation_info`.version_name
		AND qrgr.color = `pp_wise_version_creation_info`.color
		AND qrgr.finish_width_in_inch = `pp_wise_version_creation_info`.finish_width_in_inch
		AND qrgr.customer_name = `process_program_info`.customer_name";


	$result= mysqli_query($con,$sql) or die(mysqli_error($con));

	while( $row = mysqli_fetch_array( $result))
	{    
		$design=$row['design'];
		$week_in_year=$row['week_in_year'];
		$customer=$row['customer_name'];
		$percentage_of_cotton_content=$row['percentage_of_cotton_content'];
		$percentage_of_polyester_content=$row['percentage_of_polyester_content'];
		$percentage_of_other_fiber_content=$row['percentage_of_other_fiber_content'];
		$greige_width_in_inch=$row['greige_width_in_inch'];

		
		$option=$option.'<option value="'.$row['version_name']."?fs?".$row['design']."?fs?".$row['week_in_year']."?fs?".$row['customer_name']."?fs?".$row['percentage_of_cotton_content']."?fs?".$row['percentage_of_polyester_content']."?fs?".$row['percentage_of_other_fiber_content']."?fs?".$row['customer_id']."?fs?".$row['version_id']."?fs?".$row['style_name']."?fs?".$row['finish_width_in_inch']."?fs?".$row['greige_width_in_inch']."?fs?".$row['color']."?fs?".$pp_number."?fs?".$row['received_quantity_in_meter']."?fs?".'">PP:'.$pp_number.', Version: '.$row['version_name'].', style: '.$row['style_name'].' ,Customer:'.$row['customer_name'].', Greige Width:'.$row['greige_width_in_inch'].', Color:'.$row['color'].', Quantity:'.$row['received_quantity_in_meter'].'</option>';
		
	}

	echo $option;

?>