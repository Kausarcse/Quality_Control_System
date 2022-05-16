<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";


$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

$pp_number = $_POST['new_pp_number'];
$split_pp_number=explode("?fs?", $pp_number);
$new_pp_num_id = $split_pp_number[0];
$new_pp_number = $split_pp_number[1];
$old_pp_number = $_POST['old_pp_number'];
$old_version_name = $_POST['old_version_name'];



mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$new_pp_version_select="select * from `pp_wise_version_creation_info` where `pp_num_id`='$new_pp_number'";

$result = mysqli_query($con,$new_pp_version_select) or die(mysqli_error());

while($row = mysqli_fetch_array($result)) 
{
    $new_version_id = $row['version_id'];

    //select pp version details
    $pp_number= $row['pp_number'];
	$version_number= $row['version_name'];
	$version_id= $new_version_id;
	$color= $row['color'];
	$finish_width_in_inch= $row['finish_width_in_inch'];


	//select pp info details
	$new_pp_info_select="select * from `process_program_info` where `pp_num_id`='$new_pp_number'";
	$result_new_pp_info_select = mysqli_query($con,$new_pp_info_select) or die(mysqli_error());
	$row_new_pp_info_select = mysqli_fetch_array($result_new_pp_info_select);

	$customer_name= $row_new_pp_info_select['customer_name'];
	$customer_id= $row_new_pp_info_select['customer_id'];

	//copy from adding_process_to_version start
	//select adding_process_to_version for old pp_version
	$adding_process_to_version="select * from `adding_process_to_version` where `pp_number`='$old_pp_number' and `version_id` = '$old_version_name' ";
	$result_adding_process_to_version = mysqli_query($con,$adding_process_to_version) or die(mysqli_error());
	$check_adding_process_to_version = mysqli_num_rows($result_adding_process_to_version);

	if ($check_adding_process_to_version >= 1) 
	{
		while($row_adding_process_to_version = mysqli_fetch_array($result_adding_process_to_version))
		{
		  $new_row_id=$row_adding_process_to_version['row_id'];  /*added new line*/

		  /*if($new_row_id=='')
		  {

		  }*/
		  

			$adding_version_id= $row_adding_process_to_version['version_id'];
			$adding_pp_num_id= $new_pp_num_id;
			$adding_pp_number= $new_pp_number;
			$adding_version_name= $row_adding_process_to_version['version_name'];
			$adding_style_name = $row_adding_process_to_version['style_name'];
			$adding_customer_name = $row_adding_process_to_version['customer_name'];
			$adding_finish_width_in_inch= $row_adding_process_to_version['finish_width_in_inch'];
			$adding_color= $row_adding_process_to_version['color'];
			$adding_process_id= $row_adding_process_to_version['process_id'];
			$adding_process_name = $row_adding_process_to_version['process_name'];
			$adding_process_serial_no = $row_adding_process_to_version['process_serial_no'];
			$adding_process_or_reprocess = $row_adding_process_to_version['process_or_reprocess'];

			$adding_temp_process_name= $row_adding_process_to_version['checking_field'];

			$insert_sql_statement="insert into `adding_process_to_version` ( `version_id`,`pp_num_id`,`pp_number`,`version_name`,`style_name`,`customer_name`,`finish_width_in_inch`,`color`,`process_id`,`process_name`,`process_serial_no`,`process_or_reprocess`,`checking_field`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$adding_version_id','$adding_pp_num_id','$adding_pp_number','$adding_version_name','$adding_style_name','$adding_customer_name','$adding_finish_width_in_inch','$adding_color','$adding_process_id','$adding_process_name','$adding_process_serial_no','$adding_process_or_reprocess','$adding_temp_process_name','$user_id','$user_name',NOW())";
				  /*echo $insert_sql_statement;*/
			mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
		}


		//scouring and bleaching process selection
	    $old_pp_version_scouring_bleaching_process = "select * from `defining_qc_standard_for_scouring_bleaching_process` where `version_id`='$old_version_name'";
	    $result_old_pp_version_scouring_bleaching_process = mysqli_query($con,$old_pp_version_scouring_bleaching_process) or die(mysqli_error());
	    $row_old_pp_version_scouring_bleaching_process = mysqli_fetch_array($result_old_pp_version_scouring_bleaching_process);

		 $standard_for_which_process= $row_old_pp_version_scouring_bleaching_process['standard_for_which_process'];	

		 $test_method_for_whiteness= $row_old_pp_version_scouring_bleaching_process['test_method_for_whiteness'];
		 $whiteness_min_value= $row_old_pp_version_scouring_bleaching_process['whiteness_min_value'];
		 $whiteness_max_value= $row_old_pp_version_scouring_bleaching_process['whiteness_max_value'];

		 $uom_of_whiteness= $row_old_pp_version_scouring_bleaching_process['uom_of_whiteness'];



		$test_method_for_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['test_method_for_residual_sizing_material'];
		$residual_sizing_material_min_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_min_value'];
		$residual_sizing_material_max_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_max_value'];
		$uom_of_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['uom_of_residual_sizing_material'];


		$test_method_for_absorbency= $row_old_pp_version_scouring_bleaching_process['test_method_for_absorbency'];
		$absorbency_min_value= $row_old_pp_version_scouring_bleaching_process['absorbency_min_value'];
		$absorbency_max_value= $row_old_pp_version_scouring_bleaching_process['absorbency_max_value'];
		$uom_of_absorbency= $row_old_pp_version_scouring_bleaching_process['uom_of_absorbency'];

		$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
		$test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
		$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
		$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
		$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['rubs_for_surface_fuzzing_and_pilling'];
		$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_min_value'];
		$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_max_value'];
		$uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

		 
		 $test_method_for_ph= $row_old_pp_version_scouring_bleaching_process['test_method_for_ph'];
		 $ph_min_value= $row_old_pp_version_scouring_bleaching_process['ph_min_value'];
		 $ph_max_value= $row_old_pp_version_scouring_bleaching_process['ph_max_value'];
		 $uom_of_ph= $row_old_pp_version_scouring_bleaching_process['uom_of_ph'];


		 $insert_sql_statement ="insert into `defining_qc_standard_for_scouring_bleaching_process` 
		                     ( 
		                     `pp_number`,
		                     `version_id`,
		                     `version_number`,
		                     `customer_name`,
		                     `customer_id`,
		                     `color`,
		                     `finish_width_in_inch`,
		                     `standard_for_which_process`,

	                         `test_method_for_whiteness`, 
	                         `whiteness_min_value`, 
	                         `whiteness_max_value`, 
	                         `uom_of_whiteness`, 

	                         `test_method_for_residual_sizing_material`,
		                     `residual_sizing_material_min_value`,
		                     `residual_sizing_material_max_value`,
		                     `uom_of_residual_sizing_material`,

		                     `test_method_for_absorbency`,
		                     `absorbency_min_value`,
		                     `absorbency_max_value`,
		                     `uom_of_absorbency`,

		                     `description_or_type_for_surface_fuzzing_and_pilling`,
	                       `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
	                        `surface_fuzzing_and_pilling_tolerance_range_math_operator`,
	                        `surface_fuzzing_and_pilling_tolerance_value`,
	                        `rubs_for_surface_fuzzing_and_pilling`,
	                       `surface_fuzzing_and_pilling_min_value`,
	                       `surface_fuzzing_and_pilling_max_value`,
	                       `uom_of_resistance_to_surface_fuzzing_and_pilling`,

		                     
	                        `test_method_for_ph`, 
	                        `ph_min_value`, 
	                        `ph_max_value`,
	                        `uom_of_ph`, 

		                     `recording_person_id`,
		                     `recording_person_name`,
		                     `recording_time` 
		                     ) 
							values 
						    (
						    '$pp_number',
	                        '$version_id',
	                        '$version_number',
	                        '$customer_name',
	                        '$customer_id',
	                        '$color',
	                        '$finish_width_in_inch',
	                        '$standard_for_which_process',

	                        
	                        '$test_method_for_whiteness',
	                        '$whiteness_min_value',
	                        '$whiteness_max_value',
	                        '$uom_of_whiteness',

	                        '$test_method_for_residual_sizing_material',
	                        '$residual_sizing_material_min_value',
	                        '$residual_sizing_material_max_value',
	                        '$uom_of_residual_sizing_material',

	                        '$test_method_for_absorbency',
	                        '$absorbency_min_value',
	                        '$absorbency_max_value',
	                        '$uom_of_absorbency',
	                        
	                        '$description_or_type_for_surface_fuzzing_and_pilling',
	                        '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
	                        '$surface_fuzzing_and_pilling_tolerance_range_math_operator',
	                        '$surface_fuzzing_and_pilling_tolerance_value',
	                        '$rubs_for_surface_fuzzing_and_pilling',
	                        '$surface_fuzzing_and_pilling_min_value',
	                        '$surface_fuzzing_and_pilling_max_value',
	                        '$uom_of_resistance_to_surface_fuzzing_and_pilling',
	                        
	                        '$test_method_for_ph',
	                        '$ph_min_value',
	                        '$ph_max_value',
	                        '$uom_of_ph',


	                         '$user_id',
	                         '$user_name',
	                          NOW()
	                         )";
	    
	    
		$result_of_data = mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));


		if(mysqli_affected_rows($con)<>1)
		{
		
			$data_insertion_hampering = "Yes";
		
		}
		
	}

	else
	{

	}



    //copy from caledering process start

    //caledering process selection
    $old_pp_version_calendering_process = "select * from `defining_qc_standard_for_calendering_process` where `version_id`='$old_version_name'";
    $result_old_pp_version_calendering_process = mysqli_query($con,$old_pp_version_calendering_process) or die(mysqli_error());
    $row_old_pp_version_calendering_process = mysqli_fetch_array($result_old_pp_version_calendering_process);

	
	//copy caledering process data
	$standard_for_which_process= $row_old_pp_version_calendering_process['standard_for_which_process'];

	$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_calendering_process['test_method_for_cf_to_rubbing_dry'];
	$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
	$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_tolerance_value'];
	$cf_to_rubbing_dry_min_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_min_value'];
	$cf_to_rubbing_dry_max_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_max_value'];
	$uom_of_cf_to_rubbing_dry= $row_old_pp_version_calendering_process['uom_of_cf_to_rubbing_dry'];

	$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_calendering_process['test_method_for_cf_to_rubbing_wet'];
	$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
	$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_tolerance_value'];
	$cf_to_rubbing_wet_min_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_min_value'];
	$cf_to_rubbing_wet_max_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_max_value'];
	$uom_of_cf_to_rubbing_wet= $row_old_pp_version_calendering_process['uom_of_cf_to_rubbing_wet'];

	$test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
	$washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_calendering_process['washing_cycle_for_warp_for_washing_before_iron'];
	$dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
	$dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
	$uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

	$test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
	$washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_calendering_process['washing_cycle_for_weft_for_washing_before_iron'];
	$dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
	$dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
	$uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];


	$test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
	$washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_calendering_process['washing_cycle_for_warp_for_washing_after_iron'];
	$dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
	$dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
	$uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

	$test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
	$washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_calendering_process['washing_cycle_for_weft_for_washing_after_iron'];
	$dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
	$dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
	$uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];

	$test_method_for_warp_yarn_count= $row_old_pp_version_calendering_process['test_method_for_warp_yarn_count'];
	$warp_yarn_count_value= $row_old_pp_version_calendering_process['warp_yarn_count_value'];
	$warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_calendering_process['warp_yarn_count_tolerance_range_math_operator'];
	$warp_yarn_count_tolerance_value= $row_old_pp_version_calendering_process['warp_yarn_count_tolerance_value'];
	$warp_yarn_count_min_value= $row_old_pp_version_calendering_process['warp_yarn_count_min_value'];
	$warp_yarn_count_max_value= $row_old_pp_version_calendering_process['warp_yarn_count_max_value'];
	$uom_of_warp_yarn_count_value= $row_old_pp_version_calendering_process['uom_of_warp_yarn_count_value'];

	$test_method_for_weft_yarn_count= $row_old_pp_version_calendering_process['test_method_for_weft_yarn_count'];
	$weft_yarn_count_value= $row_old_pp_version_calendering_process['weft_yarn_count_value'];
	$weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_calendering_process['weft_yarn_count_tolerance_range_math_operator'];
	$weft_yarn_count_tolerance_value= $row_old_pp_version_calendering_process['weft_yarn_count_tolerance_value'];
	$weft_yarn_count_min_value= $row_old_pp_version_calendering_process['weft_yarn_count_min_value'];
	$weft_yarn_count_max_value= $row_old_pp_version_calendering_process['weft_yarn_count_max_value'];
	$uom_of_weft_yarn_count_value= $row_old_pp_version_calendering_process['uom_of_weft_yarn_count_value'];

	$test_method_for_no_of_threads_in_warp= $row_old_pp_version_calendering_process['test_method_for_no_of_threads_in_warp'];
	$no_of_threads_in_warp_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_value'];
	$no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_calendering_process['no_of_threads_in_warp_tolerance_range_math_operator'];
	$no_of_threads_in_warp_tolerance_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_tolerance_value'];
	$no_of_threads_in_warp_min_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_min_value'];
	$no_of_threads_in_warp_max_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_max_value'];
	$uom_of_no_of_threads_in_warp_value= $row_old_pp_version_calendering_process['uom_of_no_of_threads_in_warp_value'];

	$test_method_for_no_of_threads_in_weft= $row_old_pp_version_calendering_process['test_method_for_no_of_threads_in_weft'];
	$no_of_threads_in_weft_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_value'];
	$no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_calendering_process['no_of_threads_in_weft_tolerance_range_math_operator'];
	$no_of_threads_in_weft_tolerance_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_tolerance_value'];
	$no_of_threads_in_weft_min_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_min_value'];
	$no_of_threads_in_weft_max_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_max_value'];
	$uom_of_no_of_threads_in_weft_value= $row_old_pp_version_calendering_process['uom_of_no_of_threads_in_weft_value'];


	$test_method_for_mass_per_unit_per_area= $row_old_pp_version_calendering_process['test_method_for_mass_per_unit_per_area'];
	$mass_per_unit_per_area_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_value'];
	$mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_calendering_process['mass_per_unit_per_area_tolerance_range_math_operator'];
	$mass_per_unit_per_area_tolerance_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_tolerance_value'];
	$mass_per_unit_per_area_min_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_min_value'];
	$mass_per_unit_per_area_max_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_max_value'];
	$uom_of_mass_per_unit_per_area_value= $row_old_pp_version_calendering_process['uom_of_mass_per_unit_per_area_value'];


	$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['description_or_type_for_surface_fuzzing_and_pilling'];
	$test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['test_method_for_surface_fuzzing_and_pilling'];
	$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['rubs_for_surface_fuzzing_and_pilling'];
	$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
	$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_tolerance_value'];
	$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_min_value'];
	$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_max_value'];
	$uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_calendering_process['uom_of_surface_fuzzing_and_pilling_value'];


	$test_method_for_tensile_properties_in_warp= $row_old_pp_version_calendering_process['test_method_for_tensile_properties_in_warp'];
	$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
	$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_tolerance_value'];
	$tensile_properties_in_warp_value_min_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_min_value'];
	$tensile_properties_in_warp_value_max_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_max_value'];
	$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_calendering_process['uom_of_tensile_properties_in_warp_value'];

	$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['test_method_for_tensile_properties_in_weft'];
	$test_method_for_tensile_properties_in_weft= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
	$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_tolerance_value'];
	$tensile_properties_in_weft_value_min_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_min_value'];
	$tensile_properties_in_weft_value_max_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_max_value'];
	$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_calendering_process['uom_of_tensile_properties_in_weft_value'];

	$test_method_for_tear_force_in_warp= $row_old_pp_version_calendering_process['test_method_for_tear_force_in_warp'];
	$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['tear_force_in_warp_value_tolerance_range_math_operator'];
	$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_tolerance_value'];
	$tear_force_in_warp_value_min_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_min_value'];
	$tear_force_in_warp_value_max_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_max_value'];
	$uom_of_tear_force_in_warp_value= $row_old_pp_version_calendering_process['uom_of_tear_force_in_warp_value'];

	$test_method_for_tear_force_in_weft= $row_old_pp_version_calendering_process['test_method_for_tear_force_in_weft'];
	$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['tear_force_in_weft_value_tolerance_range_math_operator'];
	$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_tolerance_value'];
	$tear_force_in_weft_value_min_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_min_value'];
	$tear_force_in_weft_value_max_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_max_value'];
	$uom_of_tear_force_in_weft_value= $row_old_pp_version_calendering_process['uom_of_tear_force_in_weft_value'];


	$test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_in_warp'];
	$seam_slippage_resistance_in_warp_tolerance_range_math_operator= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'];
	$seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_tolerance_value'];
	$seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_min_value'];
	$seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_max_value'];
	$uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_in_warp'];

	$test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_in_weft'];
	$seam_slippage_resistance_in_weft_tolerance_range_math_operator= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'];
	$seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_tolerance_value'];
	$seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_min_value'];
	$seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_max_value'];
	$uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_in_weft'];

	$test_method_for_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_in_warp'];
	$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
	$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
	$seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
	$seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
	$uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
	$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


	$test_method_for_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_in_weft'];
	$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'];
	$seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
	$seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
	$seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
	$uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
	$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];



	$test_method_for_seam_strength_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_strength_in_warp'];
	$seam_strength_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_tolerance_range_math_operator'];
	$seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_tolerance_value'];
	$seam_strength_in_warp_value_min_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_min_value'];
	$seam_strength_in_warp_value_max_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_max_value'];
	$uom_of_seam_strength_in_warp_value= $row_old_pp_version_calendering_process['uom_of_seam_strength_in_warp_value'];

	$test_method_for_seam_strength_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_strength_in_weft'];
	$seam_strength_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_tolerance_range_math_operator'];
	$seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_tolerance_value'];
	$seam_strength_in_weft_value_min_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_min_value'];
	$seam_strength_in_weft_value_max_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_max_value'];
	$uom_of_seam_strength_in_weft_value= $row_old_pp_version_calendering_process['uom_of_seam_strength_in_weft_value'];

	$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
	$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'];
	$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
	$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
	$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
	$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


	$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
	$seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'];
	$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
	$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
	$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
	$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


	$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
	$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'];
	$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
	$seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
	$seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
	$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

	$test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
	$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'];
	$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
	$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
	$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
	$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


	 $insert_sql_statement="INSERT INTO `defining_qc_standard_for_calendering_process`( 
	  `pp_number`, 
	  `version_id`, 
	  `version_number`, 
	  `customer_name`, 
	  `customer_id`, 
	  `color`, 
	  `finish_width_in_inch`,
	  `standard_for_which_process`, 

	  `test_method_for_cf_to_rubbing_dry`,
	  `cf_to_rubbing_dry_tolerance_range_math_operator`,
	  `cf_to_rubbing_dry_tolerance_value`,
	  `cf_to_rubbing_dry_min_value`,
	  `cf_to_rubbing_dry_max_value`, 
	  `uom_of_cf_to_rubbing_dry`, 

	  `test_method_for_cf_to_rubbing_wet`,
	  `cf_to_rubbing_wet_tolerance_range_math_operator`,
	  `cf_to_rubbing_wet_tolerance_value`, 
	  `cf_to_rubbing_wet_min_value`,
	  `cf_to_rubbing_wet_max_value`,
	  `uom_of_cf_to_rubbing_wet`,

	  `test_method_for_dimensional_stability_to_warp_washing_b_iron`, 
	  `washing_cycle_for_warp_for_washing_before_iron`, 
	  `dimensional_stability_to_warp_washing_before_iron_min_value`, 
	  `dimensional_stability_to_warp_washing_before_iron_max_value`, 
	  `uom_of_dimensional_stability_to_warp_washing_before_iron`, 

	    `test_method_for_dimensional_stability_to_weft_washing_b_iron`,
	    `washing_cycle_for_weft_for_washing_before_iron`,
	    `dimensional_stability_to_weft_washing_before_iron_min_value`, 
	    `dimensional_stability_to_weft_washing_before_iron_max_value`, 
	    `uom_of_dimensional_stability_to_weft_washing_before_iron`,

	    `test_method_for_dimensional_stability_to_warp_washing_after_iron`,
	    `washing_cycle_for_warp_for_washing_after_iron`,
	    `dimensional_stability_to_warp_washing_after_iron_min_value`,
	    `dimensional_stability_to_warp_washing_after_iron_max_value`, 
	    `uom_of_dimensional_stability_to_warp_washing_after_iron`, 

		 `test_method_for_dimensional_stability_to_weft_washing_after_iron`, 
		 `washing_cycle_for_weft_for_washing_after_iron`, 
		 `dimensional_stability_to_weft_washing_after_iron_min_value`, 
		 `dimensional_stability_to_weft_washing_after_iron_max_value`,
		 `uom_of_dimensional_stability_to_weft_washing_after_iron`,

	    `test_method_for_warp_yarn_count`,
	    `warp_yarn_count_value`,
        `warp_yarn_count_tolerance_range_math_operator`, 
        `warp_yarn_count_tolerance_value`, 
        `warp_yarn_count_min_value`, 
        `warp_yarn_count_max_value`, 
        `uom_of_warp_yarn_count_value`, 


        `test_method_for_weft_yarn_count`, 
        `weft_yarn_count_value`, 
        `weft_yarn_count_tolerance_range_math_operator`, 
        `weft_yarn_count_tolerance_value`, 
        `weft_yarn_count_min_value`, 
        `weft_yarn_count_max_value`, 
        `uom_of_weft_yarn_count_value`,

         `test_method_for_no_of_threads_in_warp`, 
         `no_of_threads_in_warp_value`, 
          `no_of_threads_in_warp_tolerance_range_math_operator`, 
          `no_of_threads_in_warp_tolerance_value`, 
          `no_of_threads_in_warp_min_value`, 
          `no_of_threads_in_warp_max_value`, 
          `uom_of_no_of_threads_in_warp_value`, 

          `test_method_for_no_of_threads_in_weft`, 
          `no_of_threads_in_weft_value`, 
          `no_of_threads_in_weft_tolerance_range_math_operator`, 
          `no_of_threads_in_weft_tolerance_value`, 
          `no_of_threads_in_weft_min_value`, 
          `no_of_threads_in_weft_max_value`, 
          `uom_of_no_of_threads_in_weft_value`, 

          `test_method_for_mass_per_unit_per_area`, 
          `mass_per_unit_per_area_value`, 
	        `mass_per_unit_per_area_tolerance_range_math_operator`,
	        `mass_per_unit_per_area_tolerance_value`, 
	        `mass_per_unit_per_area_min_value`, 
	        `mass_per_unit_per_area_max_value`, 
	        `uom_of_mass_per_unit_per_area_value`,

	      `description_or_type_for_surface_fuzzing_and_pilling`, 
	      `test_method_for_surface_fuzzing_and_pilling`, 
	      `rubs_for_surface_fuzzing_and_pilling`, 
          `surface_fuzzing_and_pilling_tolerance_range_math_operator`, 
          `surface_fuzzing_and_pilling_tolerance_value`, 
          `surface_fuzzing_and_pilling_min_value`, 
          `surface_fuzzing_and_pilling_max_value`, 
          `uom_of_surface_fuzzing_and_pilling_value`,


         `test_method_for_tensile_properties_in_warp`, 
         `tensile_properties_in_warp_value_tolerance_range_math_operator`, 
          `tensile_properties_in_warp_value_tolerance_value`, 
          `tensile_properties_in_warp_value_min_value`, 
          `tensile_properties_in_warp_value_max_value`, 
          `uom_of_tensile_properties_in_warp_value`, 

          `test_method_for_tensile_properties_in_weft`, 
          `tensile_properties_in_weft_value_tolerance_range_math_operator`, 
          `tensile_properties_in_weft_value_tolerance_value`, 
          `tensile_properties_in_weft_value_min_value`, 
          `tensile_properties_in_weft_value_max_value`, 
          `uom_of_tensile_properties_in_weft_value`, 

          `test_method_for_tear_force_in_warp`, 
          `tear_force_in_warp_value_tolerance_range_math_operator`, 
          `tear_force_in_warp_value_tolerance_value`, 
          `tear_force_in_warp_value_min_value`, 
          `tear_force_in_warp_value_max_value`, 
          `uom_of_tear_force_in_warp_value`, 

          `test_method_for_tear_force_in_weft`, 
          `tear_force_in_weft_value_tolerance_range_math_operator`, 
          `tear_force_in_weft_value_tolerance_value`, 
          `tear_force_in_weft_value_min_value`, 
          `tear_force_in_weft_value_max_value`, 
          `uom_of_tear_force_in_weft_value`, 
         
         `test_method_for_seam_slippage_resistance_in_warp`, 
         `seam_slippage_resistance_in_warp_tolerance_range_math_operator`, 
         `seam_slippage_resistance_in_warp_tolerance_value`, 
         `seam_slippage_resistance_in_warp_min_value`, 
         `seam_slippage_resistance_in_warp_max_value`, 
         `uom_of_seam_slippage_resistance_in_warp`, 

         `test_method_for_seam_slippage_resistance_in_weft`, 
         `seam_slippage_resistance_in_weft_tolerance_range_math_operator`, 
        `seam_slippage_resistance_in_weft_tolerance_value`, 
        `seam_slippage_resistance_in_weft_min_value`, 
        `seam_slippage_resistance_in_weft_max_value`, 
        `uom_of_seam_slippage_resistance_in_weft`, 

         `test_method_for_seam_slippage_resistance_iso_2_in_warp`, 
         `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op`, 
         `seam_slippage_resistance_iso_2_in_warp_tolerance_value`, 
         `seam_slippage_resistance_iso_2_in_warp_min_value`, 
         `seam_slippage_resistance_iso_2_in_warp_max_value`, 
         `uom_of_seam_slippage_resistance_iso_2_in_warp`, 
         `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load`, 

        `test_method_for_seam_slippage_resistance_iso_2_in_weft`, 
        `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op`, 
        `seam_slippage_resistance_iso_2_in_weft_tolerance_value`, 
        `seam_slippage_resistance_iso_2_in_weft_min_value`, 
        `seam_slippage_resistance_iso_2_in_weft_max_value`, 
        `uom_of_seam_slippage_resistance_iso_2_in_weft`, 
        `uom_of_seam_slippage_resistance_iso_2_in_weft_for_load`, 

        
          `test_method_for_seam_strength_in_warp`,
          `seam_strength_in_warp_value_tolerance_range_math_operator`,
          `seam_strength_in_warp_value_tolerance_value`, 
          `seam_strength_in_warp_value_min_value`, 
          `seam_strength_in_warp_value_max_value`, 
          `uom_of_seam_strength_in_warp_value`, 

        `test_method_for_seam_strength_in_weft`,
        `seam_strength_in_weft_value_tolerance_range_math_operator`,
        `seam_strength_in_weft_value_tolerance_value`, 
        `seam_strength_in_weft_value_min_value`, 
        `seam_strength_in_weft_value_max_value`, 
        `uom_of_seam_strength_in_weft_value`, 


        `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp`, 
        `seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op`, 
        `seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value`, 
        `seam_properties_seam_slippage_iso_astm_d_in_warp_min_value`, 
        `seam_properties_seam_slippage_iso_astm_d_in_warp_max_value`, 
        `uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp`, 

        `test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft`, 
        `seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op`, 
        `seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value`, 
        `seam_properties_seam_slippage_iso_astm_d_in_weft_min_value`, 
        `seam_properties_seam_slippage_iso_astm_d_in_weft_max_value`, 
        `uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft`, 

         `test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp`,
         `seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op`,
        `seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value`, 
        `seam_properties_seam_strength_iso_astm_d_in_warp_min_value`, 
        `seam_properties_seam_strength_iso_astm_d_in_warp_max_value`, 
        `uom_of_seam_properties_seam_strength_iso_astm_d_in_warp`,

        `test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft`,
        `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op`,
        `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value`, 
        `seam_properties_seam_strength_iso_astm_d_in_weft_min_value`, 
        `seam_properties_seam_strength_iso_astm_d_in_weft_max_value`, 
        `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft`,


	   `recording_person_id`, 
    	`recording_person_name`, 
       `recording_time` 
          ) 
        VALUES 
         (
	     '$pp_number',
	     '$version_id',
	     '$version_number',
	     '$customer_name',
	     '$customer_id',
	     '$color',
	     '$finish_width_in_inch',
	     '$standard_for_which_process',

	     '$test_method_for_cf_to_rubbing_dry',
	     '$cf_to_rubbing_dry_tolerance_range_math_operator',
	     '$cf_to_rubbing_dry_tolerance_value',
	     '$cf_to_rubbing_dry_min_value',
	     '$cf_to_rubbing_dry_max_value',
	     '$uom_of_cf_to_rubbing_dry',

	     '$test_method_for_cf_to_rubbing_wet',
	     '$cf_to_rubbing_wet_tolerance_range_math_operator',
	     '$cf_to_rubbing_wet_tolerance_value',
	     '$cf_to_rubbing_wet_min_value',
	     '$cf_to_rubbing_wet_max_value',
	     '$uom_of_cf_to_rubbing_wet',

	     '$test_method_for_dimensional_stability_to_warp_washing_b_iron',
	     '$washing_cycle_for_warp_for_washing_before_iron',
	     '$dimensional_stability_to_warp_washing_before_iron_min_value',
	     '$dimensional_stability_to_warp_washing_before_iron_max_value',
	     '$uom_of_dimensional_stability_to_warp_washing_before_iron',

	     '$test_method_for_dimensional_stability_to_weft_washing_b_iron',
	     '$washing_cycle_for_weft_for_washing_before_iron',
	     '$dimensional_stability_to_weft_washing_before_iron_min_value',
	     '$dimensional_stability_to_weft_washing_before_iron_max_value',
	     '$uom_of_dimensional_stability_to_weft_washing_before_iron',

	     '$test_method_for_dimensional_stability_to_warp_washing_after_iron',
	     '$washing_cycle_for_warp_for_washing_after_iron',
         '$dimensional_stability_to_warp_washing_after_iron_min_value',
         '$dimensional_stability_to_warp_washing_after_iron_max_value',
         '$uom_of_dimensional_stability_to_warp_washing_after_iron',

         '$test_method_for_dimensional_stability_to_weft_washing_after_iron',
         '$washing_cycle_for_weft_for_washing_after_iron',
         '$dimensional_stability_to_weft_washing_after_iron_min_value',
         '$dimensional_stability_to_weft_washing_after_iron_max_value',
         '$uom_of_dimensional_stability_to_weft_washing_after_iron',


	     '$test_method_for_warp_yarn_count',
	     '$warp_yarn_count_value',
	     '$warp_yarn_count_tolerance_range_math_operator',
	     '$warp_yarn_count_tolerance_value',
	     '$warp_yarn_count_min_value',
	     '$warp_yarn_count_max_value',
	     '$uom_of_warp_yarn_count_value',


	      '$test_method_for_weft_yarn_count',
	      '$weft_yarn_count_value',
	      '$weft_yarn_count_tolerance_range_math_operator',
	      '$weft_yarn_count_tolerance_value',
	      '$weft_yarn_count_min_value',
	      '$weft_yarn_count_max_value',
	      '$uom_of_weft_yarn_count_value',


	      '$test_method_for_no_of_threads_in_warp',
	      '$no_of_threads_in_warp_value',
	      '$no_of_threads_in_warp_tolerance_range_math_operator',
	      '$no_of_threads_in_warp_tolerance_value',
	      '$no_of_threads_in_warp_min_value',
	      '$no_of_threads_in_warp_max_value',
	      '$uom_of_no_of_threads_in_warp_value',


	      '$test_method_for_no_of_threads_in_weft',
	      '$no_of_threads_in_weft_value',
	      '$no_of_threads_in_weft_tolerance_range_math_operator',
	      '$no_of_threads_in_weft_tolerance_value',
	      '$no_of_threads_in_weft_min_value',
	      '$no_of_threads_in_weft_max_value',
	      '$uom_of_no_of_threads_in_weft_value',

	      '$test_method_for_mass_per_unit_per_area',
	      '$mass_per_unit_per_area_value',
	      '$mass_per_unit_per_area_tolerance_range_math_operator',
	      '$mass_per_unit_per_area_tolerance_value',
	      '$mass_per_unit_per_area_min_value',
	      '$mass_per_unit_per_area_max_value',
	      '$uom_of_mass_per_unit_per_area_value',

	       '$description_or_type_for_surface_fuzzing_and_pilling',
	       '$test_method_for_surface_fuzzing_and_pilling',
	       '$rubs_for_surface_fuzzing_and_pilling',
	       '$surface_fuzzing_and_pilling_tolerance_range_math_operator',
	       '$surface_fuzzing_and_pilling_tolerance_value',
	       '$surface_fuzzing_and_pilling_min_value',
	       '$surface_fuzzing_and_pilling_max_value',
	       '$uom_of_surface_fuzzing_and_pilling_value',

	       '$test_method_for_tensile_properties_in_warp',
	       '$tensile_properties_in_warp_value_tolerance_range_math_operator',
	       '$tensile_properties_in_warp_value_tolerance_value',
	       '$tensile_properties_in_warp_value_min_value',
	       '$tensile_properties_in_warp_value_max_value',
	       '$uom_of_tensile_properties_in_warp_value',

	       '$test_method_for_tensile_properties_in_weft',
	       '$tensile_properties_in_weft_value_tolerance_range_math_operator',
	       '$tensile_properties_in_weft_value_tolerance_value',
	       '$tensile_properties_in_weft_value_min_value',
	       '$tensile_properties_in_weft_value_max_value',
	       '$uom_of_tensile_properties_in_weft_value',

	       '$test_method_for_tear_force_in_warp',
	       '$tear_force_in_warp_value_tolerance_range_math_operator',
	       '$tear_force_in_warp_value_tolerance_value',
	       '$tear_force_in_warp_value_min_value',
	       '$tear_force_in_warp_value_max_value',
	       '$uom_of_tear_force_in_warp_value',


	       '$test_method_for_tear_force_in_weft',
	       '$tear_force_in_weft_value_tolerance_range_math_operator',
	       '$tear_force_in_weft_value_tolerance_value',
	       '$tear_force_in_weft_value_min_value',
	       '$tear_force_in_weft_value_max_value',
	       '$uom_of_tear_force_in_weft_value',


	       '$test_method_for_seam_slippage_resistance_in_warp',
	       '$seam_slippage_resistance_in_warp_tolerance_range_math_operator',
	       '$seam_slippage_resistance_in_warp_tolerance_value',
	       '$seam_slippage_resistance_in_warp_min_value',
	       '$seam_slippage_resistance_in_warp_max_value',
	       '$uom_of_seam_slippage_resistance_in_warp',

	       '$test_method_for_seam_slippage_resistance_in_weft',
	       '$seam_slippage_resistance_in_weft_tolerance_range_math_operator',
	       '$seam_slippage_resistance_in_weft_tolerance_value',
	       '$seam_slippage_resistance_in_weft_min_value',
	       '$seam_slippage_resistance_in_weft_max_value',
	       '$uom_of_seam_slippage_resistance_in_weft',

	       '$test_method_for_seam_slippage_resistance_iso_2_in_weft',
	       '$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op',
	        '$seam_slippage_resistance_iso_2_in_weft_tolerance_value',
	        '$seam_slippage_resistance_iso_2_in_weft_min_value',
	        '$seam_slippage_resistance_iso_2_in_weft_max_value',
	        '$uom_of_seam_slippage_resistance_iso_2_in_weft',
	        '$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load',

	       '$test_method_for_seam_slippage_resistance_iso_2_in_warp',
	       '$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op',
	       '$seam_slippage_resistance_iso_2_in_warp_tolerance_value',
	       '$seam_slippage_resistance_iso_2_in_warp_min_value',
	       '$seam_slippage_resistance_iso_2_in_warp_max_value',
	       '$uom_of_seam_slippage_resistance_iso_2_in_warp',
	       '$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load',

	       '$test_method_for_seam_strength_in_warp',
	       '$seam_strength_in_warp_value_tolerance_range_math_operator',
	       '$seam_strength_in_warp_value_tolerance_value',
	       '$seam_strength_in_warp_value_min_value',
	       '$seam_strength_in_warp_value_max_value',
	       '$uom_of_seam_strength_in_warp_value',


	       '$test_method_for_seam_strength_in_weft',
	       '$seam_strength_in_weft_value_tolerance_range_math_operator',
	       '$seam_strength_in_weft_value_tolerance_value',
	       '$seam_strength_in_weft_value_min_value',
	       '$seam_strength_in_weft_value_max_value',
	       '$uom_of_seam_strength_in_weft_value',


        '$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp',
        '$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op',
        '$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value',
        '$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value',
        '$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value',
        '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp',

        '$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft',
        '$seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op',
         '$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value',
         '$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value',
         '$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value',
         '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft',

        '$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp',
        '$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op',
         '$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value',
         '$seam_properties_seam_strength_iso_astm_d_in_warp_min_value',
         '$seam_properties_seam_strength_iso_astm_d_in_warp_max_value',
         '$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp',

         '$test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft',
         '$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op',
         '$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value',
         '$seam_properties_seam_strength_iso_astm_d_in_weft_min_value',
         '$seam_properties_seam_strength_iso_astm_d_in_weft_max_value',
         '$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft',

         
          '$user_id',
          '$user_name',
           NOW()
	        )";

	//mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	// if (mysqli_query($con, $insert_sql_statement)) 
	// {
	//   echo $last_id = mysqli_insert_id($con);
	// } else {
	//   echo "Error: " . $insert_sql_statement . "<br>" . mysqli_error($con);
	// }



	// if ($result_of_data = mysqli_query($con, $insert_sql_statement)) 
	// {
	//   echo $result_of_data;
	//   echo $last_id = mysqli_insert_id($con);
	// }




	//copy from data_for_all_standard

	//select data from test_method_for_customer
	// $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
	// from test_name_and_method_for_all_process tnm 
	// INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
	// INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id
	// where tmc.customer_id = '$customer_id'";


	// $checking_data="";
	// $test_method_id="";
	// $result= mysqli_query($con,$sql) or die(mysqli_error());
	//  while( $row = mysqli_fetch_array( $result))
	//  {
	// 	 $checking_data=$checking_data."?fs?".$row['id'];
	// 	 $test_method_id= $test_method_id."?tnm?".$row['test_method_id']; 
	//  }

	//  $process_id_for_calendering = 'proc_17';

 //    $splitted_test_method_id=explode(',', $test_method_id);
 //     for($i=0 ; $i < count($splitted_test_method_id)-1 ; $i++)

 //    {
 //        $insert_sql_statement_for_test_method="insert into `data_for_all_standard` 
 //                           ( 
 //                           `test_method_id`,
 //                           `pp_number`,
 //                           `version_id`,
 //                           `version_number`,
 //                           `customer_id`,
 //                           `color`,
 //                           `process_id`,
 //                           `checking_data`

 //                           ) 
 //                values 
 //                  (

 //                  '$splitted_test_method_id[$i]',
 //                  '$pp_number',
 //                  '$version_id',
 //                            '$version_number',
 //                            '$customer_id',
 //                            '$color',
 //                            '$process_id_for_calendering',
 //                            '$checking_data'
 //                             )";

 //      mysqli_query($con,$insert_sql_statement_for_test_method) or die(mysqli_error($con));
 //    }

	//copy from caledering process end





    //copy from scouring and bleaching process start

     

	 
	//scouring and bleaching process selection
    $old_pp_version_scouring_bleaching_process = "select * from `defining_qc_standard_for_scouring_bleaching_process` where `version_id`='$old_version_name'";
    $result_old_pp_version_scouring_bleaching_process = mysqli_query($con,$old_pp_version_scouring_bleaching_process) or die(mysqli_error());
    $row_old_pp_version_scouring_bleaching_process = mysqli_fetch_array($result_old_pp_version_scouring_bleaching_process);

	 $standard_for_which_process= $row_old_pp_version_scouring_bleaching_process['standard_for_which_process'];	

	 $test_method_for_whiteness= $row_old_pp_version_scouring_bleaching_process['test_method_for_whiteness'];
	 $whiteness_min_value= $row_old_pp_version_scouring_bleaching_process['whiteness_min_value'];
	 $whiteness_max_value= $row_old_pp_version_scouring_bleaching_process['whiteness_max_value'];

	 $uom_of_whiteness= $row_old_pp_version_scouring_bleaching_process['uom_of_whiteness'];



	$test_method_for_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['test_method_for_residual_sizing_material'];
	$residual_sizing_material_min_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_min_value'];
	$residual_sizing_material_max_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_max_value'];
	$uom_of_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['uom_of_residual_sizing_material'];


	$test_method_for_absorbency= $row_old_pp_version_scouring_bleaching_process['test_method_for_absorbency'];
	$absorbency_min_value= $row_old_pp_version_scouring_bleaching_process['absorbency_min_value'];
	$absorbency_max_value= $row_old_pp_version_scouring_bleaching_process['absorbency_max_value'];
	$uom_of_absorbency= $row_old_pp_version_scouring_bleaching_process['uom_of_absorbency'];

	$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
	$test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
	$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
	$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
	$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['rubs_for_surface_fuzzing_and_pilling'];
	$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_min_value'];
	$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_max_value'];
	$uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

	 
	 $test_method_for_ph= $row_old_pp_version_scouring_bleaching_process['test_method_for_ph'];
	 $ph_min_value= $row_old_pp_version_scouring_bleaching_process['ph_min_value'];
	 $ph_max_value= $row_old_pp_version_scouring_bleaching_process['ph_max_value'];
	 $uom_of_ph= $row_old_pp_version_scouring_bleaching_process['uom_of_ph'];


	 $insert_sql_statement ="insert into `defining_qc_standard_for_scouring_bleaching_process` 
	                     ( 
	                     `pp_number`,
	                     `version_id`,
	                     `version_number`,
	                     `customer_name`,
	                     `customer_id`,
	                     `color`,
	                     `finish_width_in_inch`,
	                     `standard_for_which_process`,

                         `test_method_for_whiteness`, 
                         `whiteness_min_value`, 
                         `whiteness_max_value`, 
                         `uom_of_whiteness`, 

                         `test_method_for_residual_sizing_material`,
	                     `residual_sizing_material_min_value`,
	                     `residual_sizing_material_max_value`,
	                     `uom_of_residual_sizing_material`,

	                     `test_method_for_absorbency`,
	                     `absorbency_min_value`,
	                     `absorbency_max_value`,
	                     `uom_of_absorbency`,

	                     `description_or_type_for_surface_fuzzing_and_pilling`,
                       `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
                        `surface_fuzzing_and_pilling_tolerance_range_math_operator`,
                        `surface_fuzzing_and_pilling_tolerance_value`,
                        `rubs_for_surface_fuzzing_and_pilling`,
                       `surface_fuzzing_and_pilling_min_value`,
                       `surface_fuzzing_and_pilling_max_value`,
                       `uom_of_resistance_to_surface_fuzzing_and_pilling`,

	                     
                        `test_method_for_ph`, 
                        `ph_min_value`, 
                        `ph_max_value`,
                        `uom_of_ph`, 

	                     `recording_person_id`,
	                     `recording_person_name`,
	                     `recording_time` 
	                     ) 
						values 
					    (
					    '$pp_number',
                        '$version_id',
                        '$version_number',
                        '$customer_name',
                        '$customer_id',
                        '$color',
                        '$finish_width_in_inch',
                        '$standard_for_which_process',

                        
                        '$test_method_for_whiteness',
                        '$whiteness_min_value',
                        '$whiteness_max_value',
                        '$uom_of_whiteness',

                        '$test_method_for_residual_sizing_material',
                        '$residual_sizing_material_min_value',
                        '$residual_sizing_material_max_value',
                        '$uom_of_residual_sizing_material',

                        '$test_method_for_absorbency',
                        '$absorbency_min_value',
                        '$absorbency_max_value',
                        '$uom_of_absorbency',
                        
                        '$description_or_type_for_surface_fuzzing_and_pilling',
                        '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
                        '$surface_fuzzing_and_pilling_tolerance_range_math_operator',
                        '$surface_fuzzing_and_pilling_tolerance_value',
                        '$rubs_for_surface_fuzzing_and_pilling',
                        '$surface_fuzzing_and_pilling_min_value',
                        '$surface_fuzzing_and_pilling_max_value',
                        '$uom_of_resistance_to_surface_fuzzing_and_pilling',
                        
                        '$test_method_for_ph',
                        '$ph_min_value',
                        '$ph_max_value',
                        '$uom_of_ph',


                         '$user_id',
                         '$user_name',
                          NOW()
                         )";
    
    
	$result_of_data = mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));


	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
} 



if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully saved.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
