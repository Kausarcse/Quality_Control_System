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
$total_number = $_POST['total_number'];

$old_pp_number = $_POST['old_pp_number'];
$old_version_name = $_POST['old_version_name'];

for ($i=1; $i <= $total_number; $i++) 
{ 
	if ( isset($_POST['check_box_select'.$i])) 
	{
		    $new_pp_version_id = $_POST['check_box_select'.$i];
		  

		//coding start from here.....


		// ...........................................................Duplicacy Check..............................................................//

    $duplicate_adding_process_to_version="select * from `adding_process_to_version` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
	$result_duplicate_adding_process_to_version= mysqli_query($con,$duplicate_adding_process_to_version) or die(mysqli_error());
	$check_duplicate_adding_process_to_version = mysqli_num_rows($result_duplicate_adding_process_to_version);


	if ($check_duplicate_adding_process_to_version >= 1) 
	{
       echo "Data is Previously saved";
	}

	else
	{
               // ...........................................................Adding Process To version..............................................................//
			
			   $new_pp_version_select="select * from `pp_wise_version_creation_info` where `pp_number`='$pp_number' and `version_id`='$new_pp_version_id'";
		     	

				$result = mysqli_query($con,$new_pp_version_select) or die(mysqli_error());

				while($row = mysqli_fetch_array($result)) 
				{
				    $new_pp_version_id = $new_pp_version_id;

				    //select pp version details
				    $pp_number= $row['pp_number'];
				    $pp_num_id= $row['pp_num_id'];
					$version_name= $row['version_name'];
					$version_id= $new_pp_version_id;
					$style_name= $row['style_name'];
					$color= $row['color'];
					$finish_width_in_inch= $row['finish_width_in_inch'];


					//select pp info details
					$new_pp_info_select="select * from `process_program_info` where `pp_number`='$pp_number'";
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
                            

                             $pp_number_for_pp_monitoring=$row_adding_process_to_version['pp_number'];
                             $version_name_for_pp_monitoring=$row_adding_process_to_version['version_name'];
                             $style_name_for_pp_monitoring=$row_adding_process_to_version['style_name'];
                             $finish_width_in_inch_for_pp_monitoring=$row_adding_process_to_version['finish_width_in_inch'];

                             
                        



							  $new_pp_version_id=$new_pp_version_id;  /*added new line*/

							  /*if($new_pp_version_id=='')
							  {

							  }*/
							  

								$adding_version_id= $new_pp_version_id;
								
								$adding_pp_num_id= $pp_num_id;
								$adding_pp_number= $pp_number;
								$adding_version_name= $version_name;
								$adding_style_name = $style_name;
								$adding_customer_name = $customer_name;
								$adding_finish_width_in_inch= $finish_width_in_inch;
								$adding_color= $color;
								$adding_process_id= $row_adding_process_to_version['process_id'];
								$adding_process_name = $row_adding_process_to_version['process_name'];
								$adding_process_serial_no = $row_adding_process_to_version['process_serial_no'];
								$adding_process_or_reprocess = $row_adding_process_to_version['process_or_reprocess'];

								$adding_temp_process_name= $row_adding_process_to_version['checking_field'];

								$insert_sql_statement="insert into `adding_process_to_version` ( `version_id`,`pp_num_id`,`pp_number`,`version_name`,`style_name`,`customer_name`,`finish_width_in_inch`,`color`,`process_id`,`process_name`,`process_serial_no`,`process_or_reprocess`,`checking_field`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$adding_version_id','$adding_pp_num_id','$adding_pp_number','$adding_version_name','$adding_style_name','$adding_customer_name','$adding_finish_width_in_inch','$adding_color','$adding_process_id','$adding_process_name','$adding_process_serial_no','$adding_process_or_reprocess','$adding_temp_process_name','$user_id','$user_name',NOW())";
									  /*echo $insert_sql_statement;*/
								mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));



								



								if(mysqli_affected_rows($con)<>1)
								{
								
									$data_insertion_hampering = "Yes";
								
								}

								else
								{
                                 
                                
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
								echo "Data is successfully Copied.";

								

								/***************************************************************Adding PP Monitoring**************************************************************/

								$adding_pp_monitoring="select current_status,current_state from `pp_monitoring` where `pp_number`='$pp_number_for_pp_monitoring' and `version_number` = '$version_name_for_pp_monitoring' and `style_name`='$style_name_for_pp_monitoring' and `finish_width_in_inch`='$finish_width_in_inch_for_pp_monitoring'";
								$result_adding_pp_monitoring = mysqli_query($con,$adding_pp_monitoring) or die(mysqli_error($con));
								$check_adding_adding_pp_monitoring = mysqli_num_rows($result_adding_pp_monitoring);

								if ($check_adding_adding_pp_monitoring >= 1) 
								{

							    $row_adding_for_pp_monitoring = mysqli_fetch_array($result_adding_pp_monitoring);
							      

                                        $current_status=$row_adding_for_pp_monitoring['current_status'];
                                        $current_state=$row_adding_for_pp_monitoring['current_state'];
										$adding_pp_number_for_pp_monitoring= $pp_number;
										$adding_version_number_for_pp_monitoring= $version_name;
										$adding_style_name_for_pp_monitoring = $style_name;
										$adding_customer_name_for_pp_monitoring = $customer_name;
										$adding_finish_width_in_inch_for_pp_monitoring= $finish_width_in_inch;

                                     $insert_sql_for_pp_monitoring="insert into `pp_monitoring`
											                            ( 
											                            `pp_number`,
											                            `version_number`,
											                            `style_name`,
											                            `finish_width_in_inch`,
											                            `current_status`,
											                            `recording_person_id`,
											                            `recording_person_name`,
											                            `recording_time`,
											                            `current_state` 
											                            ) 
											                            values 
											                            (
											                            '$adding_pp_number_for_pp_monitoring',
											                            '$adding_version_number_for_pp_monitoring',
											                            '$adding_style_name_for_pp_monitoring',
											                            '$adding_finish_width_in_inch_for_pp_monitoring',
											                            'Wait for greige issuance',
											                            '$user_id',
											                            '$user_name',
											                             NOW(),
											                            'Wait for greige issuance')";

											                          
                                    
												    mysqli_query($con,$insert_sql_for_pp_monitoring) or die(mysqli_error($con));
								   

							  }

							  else

							  {

							  	$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Wait for greige issuance',`current_state`='Wait for greige issuance' WHERE `pp_number`= '$adding_pp_number_for_pp_monitoring' and `version_number`='$adding_version_number_for_pp_monitoring' and `finish_width_in_inch`='$adding_finish_width_in_inch_for_pp_monitoring' and `style_name`='$adding_style_name_for_pp_monitoring'";
	        
		                           mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
							  }

                             /***************************************************************End of Adding PP Monitoring**************************************************************/


							}
							else
							{

								mysqli_query($con,"ROLLBACK");
								echo "Data is not successfully saved.";

							}

							/*$obj->disconnection();*/

						 }
				
					
				  } // ...........................................................Adding Process To version..............................................................//


                    /*............................................................Copy Calendering..............................................................*/
                $duplicate_calendering_process="select * from `defining_qc_standard_for_calendering_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
				$result_duplicate_calendering_process= mysqli_query($con,$duplicate_calendering_process) or die(mysqli_error());
				$check_duplicate_calendering_process = mysqli_num_rows($result_duplicate_calendering_process);


				if ($check_duplicate_calendering_process >= 1) 
				{
		           echo "Calendering Data is Previously saved";
				}

				else
				{

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

					$test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
					$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
					$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
					$seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
					$seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
					$uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
					$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


					$test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
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


					 $insert_sql_statement_for_calendering="INSERT INTO `defining_qc_standard_for_calendering_process`( 
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

				         `test_method_for_seam_slippage_resistance_iso_2_warp`, 
				         `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op`, 
				         `seam_slippage_resistance_iso_2_in_warp_tolerance_value`, 
				         `seam_slippage_resistance_iso_2_in_warp_min_value`, 
				         `seam_slippage_resistance_iso_2_in_warp_max_value`, 
				         `uom_of_seam_slippage_resistance_iso_2_in_warp`, 
				         `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load`, 

				        `test_method_for_seam_slippage_resistance_iso_2_weft`, 
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
					     '$version_name',
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

					       '$test_method_for_seam_slippage_resistance_iso_2_weft',
					       '$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op',
					        '$seam_slippage_resistance_iso_2_in_weft_tolerance_value',
					        '$seam_slippage_resistance_iso_2_in_weft_min_value',
					        '$seam_slippage_resistance_iso_2_in_weft_max_value',
					        '$uom_of_seam_slippage_resistance_iso_2_in_weft',
					        '$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load',

					       '$test_method_for_seam_slippage_resistance_iso_2_warp',
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

                      $result_of_data_for_calendering = mysqli_query($con,$insert_sql_statement_for_calendering) or die(mysqli_error($con));

                 } /*End else For duplicacy*/

                    /*............................................................Copy Scouring & Bleaching..............................................................*/


			                $duplicate_scouring_bleaching_process="select * from `defining_qc_standard_for_scouring_bleaching_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_scouring_bleaching_process= mysqli_query($con,$duplicate_scouring_bleaching_process) or die(mysqli_error());
							$check_duplicate_scouring_bleaching_process = mysqli_num_rows($result_duplicate_scouring_bleaching_process);


							if ($check_duplicate_scouring_bleaching_process >= 1) 
							{
					           echo " Scouring & Bleaching Data is Previously saved";
							}

							else
							{

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


								 $insert_sql_statement_for_scouring_bleaching ="insert into `defining_qc_standard_for_scouring_bleaching_process` 
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
							                        '$version_name',
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
							    
							    
								$result_of_data_for_scouring_bleaching = mysqli_query($con,$insert_sql_statement_for_scouring_bleaching) or die(mysqli_error($con));



								 /*...............................................................NEED TO COMMENT OUT(DATA FOR ALL PROCESS)..............................................*/

								$old_data_for_all_ = "select * from `data_for_all_standard` where `version_id`='$old_version_name'";
								    $result_old_data_for_all = mysqli_query($con,$old_data_for_all_) or die(mysqli_error());
								    

								    while($row_old_data_for_all= mysqli_fetch_array($result_old_data_for_all))
								    {
                                            $process_id= $row_old_data_for_all['process_id'];

									       $checking_data= $row_old_data_for_all['checking_data'];
									       $test_method_id= $row_old_data_for_all['test_method_id'];


									 
									    $insert_sql_statement_for_test_method="insert into `data_for_all_standard` 
									                       ( 
									                       `test_method_id`,
									                       `pp_number`,
									                       `version_id`,
									                       `version_number`,
									                       `customer_id`,
									                       `color`,
									                       `process_id`,
									                       `checking_data`

									                       ) 
									                       values 
									                       (

									                        '$test_method_id',
									                        '$pp_number',
									                        '$version_id',
									                        '$version_name',
									                        '$customer_id',
									                        '$color',
									                        '$process_id',
									                        '$checking_data'
									                         )";

									  mysqli_query($con,$insert_sql_statement_for_test_method) or die(mysqli_error($con));
								    }

									
									

							}   // ..................................................Duplicacy Check for scouring_bleaching..............................................................//






							/*............................................................Copy bleaching..............................................................*/


			                $duplicate_bleaching_process="select * from `defining_qc_standard_for_bleaching_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_bleaching_process= mysqli_query($con,$duplicate_bleaching_process) or die(mysqli_error());
							$check_duplicate_bleaching_process = mysqli_num_rows($result_duplicate_bleaching_process);


							if ($check_duplicate_bleaching_process >= 1) 
							{
					           echo " Bleaching Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_bleaching_process = "select * from `defining_qc_standard_for_bleaching_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_bleaching_process = mysqli_query($con,$old_pp_version_bleaching_process) or die(mysqli_error());
							    $row_old_pp_version_bleaching_process = mysqli_fetch_array($result_old_pp_version_bleaching_process);

								 $standard_for_which_process= $row_old_pp_version_bleaching_process['standard_for_which_process'];	

								 $test_id_for_whiteness= $row_old_pp_version_bleaching_process['test_id_for_whiteness'];
								 $test_method_for_whiteness= $row_old_pp_version_bleaching_process['test_method_for_whiteness'];
								 $whiteness_min_value= $row_old_pp_version_bleaching_process['whiteness_min_value'];
								 $whiteness_max_value= $row_old_pp_version_bleaching_process['whiteness_max_value'];
								 $uom_of_whiteness= $row_old_pp_version_bleaching_process['uom_of_whiteness'];



								$test_id_for_residual_sizing_material= $row_old_pp_version_bleaching_process['test_id_for_residual_sizing_material'];
								$test_method_for_residual_sizing_material= $row_old_pp_version_bleaching_process['test_method_for_residual_sizing_material'];
								$residual_sizing_material_min_value= $row_old_pp_version_bleaching_process['residual_sizing_material_min_value'];
								$residual_sizing_material_max_value= $row_old_pp_version_bleaching_process['residual_sizing_material_max_value'];
								$uom_of_residual_sizing_material= $row_old_pp_version_bleaching_process['uom_of_residual_sizing_material'];


								$test_id_for_absorbency= $row_old_pp_version_bleaching_process['test_id_for_absorbency'];
								$test_method_for_absorbency= $row_old_pp_version_bleaching_process['test_method_for_absorbency'];
								$absorbency_min_value= $row_old_pp_version_bleaching_process['absorbency_min_value'];
								$absorbency_max_value= $row_old_pp_version_bleaching_process['absorbency_max_value'];
								$uom_of_absorbency= $row_old_pp_version_bleaching_process['uom_of_absorbency'];

								$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
								$test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
								$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
								$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
								$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['rubs_for_surface_fuzzing_and_pilling'];
								$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_min_value'];
								$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_max_value'];
								$uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

								 
								 $test_id_for_ph= $row_old_pp_version_bleaching_process['test_id_for_ph'];
								 $test_method_for_ph= $row_old_pp_version_bleaching_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_bleaching_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_bleaching_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_bleaching_process['uom_of_ph'];




									$insert_sql_statement_for_bleaching="insert into `defining_qc_standard_for_bleaching_process` 
									                     ( 
									                     `pp_number`,
									                     `version_id`,
									                     `version_number`,
									                     `customer_name`,
									                     `customer_id`,
									                     `color`,
									                     `finish_width_in_inch`,
									                     `standard_for_which_process`,

								                         `test_id_for_whiteness`, 
								                         `test_method_for_whiteness`, 
								                         `whiteness_min_value`, 
								                         `whiteness_max_value`, 
								                         `uom_of_whiteness`, 

								                         `test_id_for_residual_sizing_material`,
								                         `test_method_for_residual_sizing_material`,
									                     `residual_sizing_material_min_value`,
									                     `residual_sizing_material_max_value`,
									                     `uom_of_residual_sizing_material`,

									                     `test_id_for_absorbency`,
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

									                     
								                        `test_id_for_ph`, 
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
								                        '$version_name',
								                        '$customer_name',
								                        '$customer_id',
								                        '$color',
								                        '$finish_width_in_inch',
								                        '$standard_for_which_process',

								                        
								                        '$test_id_for_whiteness',
								                        '$test_method_for_whiteness',
								                        '$whiteness_min_value',
								                        '$whiteness_max_value',
								                        '$uom_of_whiteness',

								                        '$test_id_for_residual_sizing_material',
								                        '$test_method_for_residual_sizing_material',
								                        '$residual_sizing_material_min_value',
								                        '$residual_sizing_material_max_value',
								                        '$uom_of_residual_sizing_material',

								                        '$test_id_for_absorbency',
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

								                        
								                        '$test_id_for_ph',
								                        '$test_method_for_ph',
								                        '$ph_min_value',
								                        '$ph_max_value',
								                        '$uom_of_ph',


								                         '$user_id',
								                         '$user_name',
								                          NOW()
								                         )";

									mysqli_query($con,$insert_sql_statement_for_bleaching) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for bleaching..............................................................//





							/*............................................................Copy curing..............................................................*/


			                $duplicate_curing_process="select * from `defining_qc_standard_for_curing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_curing_process= mysqli_query($con,$duplicate_curing_process) or die(mysqli_error());
							$check_duplicate_curing_process = mysqli_num_rows($result_duplicate_curing_process);


							if ($check_duplicate_curing_process >= 1) 
							{
					           echo " curing Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_curing_process = "select * from `defining_qc_standard_for_curing_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_curing_process = mysqli_query($con,$old_pp_version_curing_process) or die(mysqli_error());
							    $row_old_pp_version_curing_process = mysqli_fetch_array($result_old_pp_version_curing_process);

								 $standard_for_which_process= $row_old_pp_version_curing_process['standard_for_which_process'];	



								$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_curing_process['test_method_for_cf_to_rubbing_dry'];
								$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_curing_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
								$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_tolerance_value'];
								$cf_to_rubbing_dry_min_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_min_value'];
								$cf_to_rubbing_dry_max_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_max_value'];
								$uom_of_cf_to_rubbing_dry= $row_old_pp_version_curing_process['uom_of_cf_to_rubbing_dry'];

								$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_curing_process['test_method_for_cf_to_rubbing_wet'];
								$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_curing_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
								$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_tolerance_value'];
								$cf_to_rubbing_wet_min_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_min_value'];
								$cf_to_rubbing_wet_max_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_max_value'];
								$uom_of_cf_to_rubbing_wet= $row_old_pp_version_curing_process['uom_of_cf_to_rubbing_wet'];

								$test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_curing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
								$washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_curing_process['washing_cycle_for_warp_for_washing_before_iron'];
								$dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_curing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
								$dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_curing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
								$uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_curing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

								$test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_curing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
								$washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_curing_process['washing_cycle_for_weft_for_washing_before_iron'];
								$dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_curing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
								$dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_curing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
								$uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_curing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

								$test_method_for_warp_yarn_count= $row_old_pp_version_curing_process['test_method_for_warp_yarn_count'];
								$warp_yarn_count_value= $row_old_pp_version_curing_process['warp_yarn_count_value'];
								$warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_curing_process['warp_yarn_count_tolerance_range_math_operator'];
								$warp_yarn_count_tolerance_value= $row_old_pp_version_curing_process['warp_yarn_count_tolerance_value'];
								$warp_yarn_count_min_value= $row_old_pp_version_curing_process['warp_yarn_count_min_value'];
								$warp_yarn_count_max_value= $row_old_pp_version_curing_process['warp_yarn_count_max_value'];
								$uom_of_warp_yarn_count_value= $row_old_pp_version_curing_process['uom_of_warp_yarn_count_value'];

								$test_method_for_weft_yarn_count= $row_old_pp_version_curing_process['test_method_for_weft_yarn_count'];
								$weft_yarn_count_value= $row_old_pp_version_curing_process['weft_yarn_count_value'];
								$weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_curing_process['weft_yarn_count_tolerance_range_math_operator'];
								$weft_yarn_count_tolerance_value= $row_old_pp_version_curing_process['weft_yarn_count_tolerance_value'];
								$weft_yarn_count_min_value= $row_old_pp_version_curing_process['weft_yarn_count_min_value'];
								$weft_yarn_count_max_value= $row_old_pp_version_curing_process['weft_yarn_count_max_value'];
								$uom_of_weft_yarn_count_value= $row_old_pp_version_curing_process['uom_of_weft_yarn_count_value'];

								$test_method_for_no_of_threads_in_warp= $row_old_pp_version_curing_process['test_method_for_no_of_threads_in_warp'];
								$no_of_threads_in_warp_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_value'];
								$no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_curing_process['no_of_threads_in_warp_tolerance_range_math_operator'];
								$no_of_threads_in_warp_tolerance_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_tolerance_value'];
								$no_of_threads_in_warp_min_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_min_value'];
								$no_of_threads_in_warp_max_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_max_value'];
								$uom_of_no_of_threads_in_warp_value= $row_old_pp_version_curing_process['uom_of_no_of_threads_in_warp_value'];

								$test_method_for_no_of_threads_in_weft= $row_old_pp_version_curing_process['test_method_for_no_of_threads_in_weft'];
								$no_of_threads_in_weft_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_value'];
								$no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_curing_process['no_of_threads_in_weft_tolerance_range_math_operator'];
								$no_of_threads_in_weft_tolerance_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_tolerance_value'];
								$no_of_threads_in_weft_min_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_min_value'];
								$no_of_threads_in_weft_max_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_max_value'];
								$uom_of_no_of_threads_in_weft_value= $row_old_pp_version_curing_process['uom_of_no_of_threads_in_weft_value'];


								$test_method_for_mass_per_unit_per_area= $row_old_pp_version_curing_process['test_method_for_mass_per_unit_per_area'];
								$mass_per_unit_per_area_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_value'];
								$mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_curing_process['mass_per_unit_per_area_tolerance_range_math_operator'];
								$mass_per_unit_per_area_tolerance_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_tolerance_value'];
								$mass_per_unit_per_area_min_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_min_value'];
								$mass_per_unit_per_area_max_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_max_value'];
								$uom_of_mass_per_unit_per_area_value= $row_old_pp_version_curing_process['uom_of_mass_per_unit_per_area_value'];


								$test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['test_method_for_surface_fuzzing_and_pilling'];
								$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['description_or_type_for_surface_fuzzing_and_pilling'];
								$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['rubs_for_surface_fuzzing_and_pilling'];
								$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
								$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_tolerance_value'];
								$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_min_value'];
								$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_max_value'];
								$uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_curing_process['uom_of_surface_fuzzing_and_pilling_value'];


								$test_method_for_tensile_properties_in_warp= $row_old_pp_version_curing_process['test_method_for_tensile_properties_in_warp'];
								$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
								$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_tolerance_value'];
								$tensile_properties_in_warp_value_min_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_min_value'];
								$tensile_properties_in_warp_value_max_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_max_value'];
								$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_curing_process['uom_of_tensile_properties_in_warp_value'];

								$test_method_for_tensile_properties_in_weft= $row_old_pp_version_curing_process['test_method_for_tensile_properties_in_weft'];
								$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
								$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_tolerance_value'];
								$tensile_properties_in_weft_value_min_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_min_value'];
								$tensile_properties_in_weft_value_max_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_max_value'];
								$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_curing_process['uom_of_tensile_properties_in_weft_value'];

								$test_method_for_tear_force_in_warp= $row_old_pp_version_curing_process['test_method_for_tear_force_in_warp'];
								$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_curing_process['tear_force_in_warp_value_tolerance_range_math_operator'];
								$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_tolerance_value'];
								$tear_force_in_warp_value_min_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_min_value'];
								$tear_force_in_warp_value_max_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_max_value'];
								$uom_of_tear_force_in_warp_value= $row_old_pp_version_curing_process['uom_of_tear_force_in_warp_value'];

								$test_method_for_tear_force_in_weft= $row_old_pp_version_curing_process['test_method_for_tear_force_in_weft'];
								$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_curing_process['tear_force_in_weft_value_tolerance_range_math_operator'];
								$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_tolerance_value'];
								$tear_force_in_weft_value_min_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_min_value'];
								$tear_force_in_weft_value_max_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_max_value'];
								$uom_of_tear_force_in_weft_value= $row_old_pp_version_curing_process['uom_of_tear_force_in_weft_value'];

								$test_method_for_resistance_to_surface_wetting_before_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_before_wash'];
								$resistance_to_surface_wetting_before_wash_tol_range_math_op= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'];
								$resistance_to_surface_wetting_before_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
								$resistance_to_surface_wetting_before_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_min_value'];
								$resistance_to_surface_wetting_before_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_max_value'];
								$uom_of_resistance_to_surface_wetting_before_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_before_wash'];


								$test_method_for_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_after_one_wash'];
								$resistance_to_surface_wetting_after_one_wash_tol_range_math_op= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'];
								$resistance_to_surface_wetting_after_one_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
								$resistance_to_surface_wetting_after_one_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_min_value'];
								$resistance_to_surface_wetting_after_one_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_max_value'];
								$uom_of_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_after_one_wash'];


								$test_method_for_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_after_five_wash'];
								$resistance_to_surface_wetting_after_five_wash_tol_range_math_op= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'];
								$resistance_to_surface_wetting_after_five_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
								$resistance_to_surface_wetting_after_five_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_min_value'];
								$resistance_to_surface_wetting_after_five_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_max_value'];
								$uom_of_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_after_five_wash'];


								$test_method_formaldehyde_content= $row_old_pp_version_curing_process['test_method_formaldehyde_content'];
								$formaldehyde_content_tolerance_range_math_operator= $row_old_pp_version_curing_process['formaldehyde_content_tolerance_range_math_operator'];
								$formaldehyde_content_tolerance_value= $row_old_pp_version_curing_process['formaldehyde_content_tolerance_value'];
								$formaldehyde_content_min_value= $row_old_pp_version_curing_process['formaldehyde_content_min_value'];
								$formaldehyde_content_max_value= $row_old_pp_version_curing_process['formaldehyde_content_max_value'];
								$uom_of_formaldehyde_content= $row_old_pp_version_curing_process['uom_of_formaldehyde_content'];


								$test_method_for_ph= $row_old_pp_version_curing_process['test_method_for_ph'];
								$ph_value_tolerance_range_math_operator= $row_old_pp_version_curing_process['ph_value_tolerance_range_math_operator'];
								$ph_value_tolerance_value= $row_old_pp_version_curing_process['ph_value_tolerance_value'];
								$ph_value_min_value= $row_old_pp_version_curing_process['ph_value_min_value'];
								$ph_value_max_value= $row_old_pp_version_curing_process['ph_value_max_value'];
								$uom_of_ph_value= $row_old_pp_version_curing_process['uom_of_ph_value'];


								$test_method_for_smoothness_appearance= $row_old_pp_version_curing_process['test_method_for_smoothness_appearance'];
								$smoothness_appearance_tolerance_range_math_op= $row_old_pp_version_curing_process['smoothness_appearance_tolerance_range_math_op'];
								$smoothness_appearance_tolerance_value= $row_old_pp_version_curing_process['smoothness_appearance_tolerance_value'];
								$smoothness_appearance_min_value= $row_old_pp_version_curing_process['smoothness_appearance_min_value'];
								$smoothness_appearance_max_value= $row_old_pp_version_curing_process['smoothness_appearance_max_value'];
								$uom_of_smoothness_appearance= $row_old_pp_version_curing_process['uom_of_smoothness_appearance'];

								
								$test_method_for_appearance_after_wash_fabric=$row_old_pp_version_curing_process['test_method_for_appearance_after_wash_fabric'];

								$appearance_after_washing_cycle_fabric_wash=$row_old_pp_version_curing_process['appearance_after_washing_cycle_fabric_wash'];
								
								
								$test_method_for_appearance_after_washing_fabric_color_change=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_color_change'];
								$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_color_change_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_color_change=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_color_change'];
								$appearance_after_washing_fabric_color_change_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_min_value'];
								$appearance_after_washing_fabric_color_change_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_max_value'];
								$test_method_for_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_cross_staining'];
								$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_cross_staining_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_cross_staining'];
								$appearance_after_washing_fabric_cross_staining_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_min_value'];
								$appearance_after_washing_fabric_cross_staining_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_max_value'];
								$test_method_for_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
								$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
								$appearance_after_washing_fabric_surface_fuzzing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_min_value'];
								$appearance_after_washing_fabric_surface_fuzzing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_max_value'];
								$test_method_for_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_surface_pilling'];
								$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_surface_pilling_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_surface_pilling'];
								$appearance_after_washing_fabric_surface_pilling_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_min_value'];
								$appearance_after_washing_fabric_surface_pilling_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_max_value'];
								$test_method_for_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_crease_before_ironing'];
								$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
								$appearance_after_washing_fabric_crease_before_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_min_value'];
								$appearance_after_washing_fabric_crease_before_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_max_value'];
								$test_method_for_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_crease_after_ironing'];
								$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator'];
								$appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_tolerance_value'];
								$uom_of_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
								$appearance_after_washing_fabric_crease_after_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_min_value'];
								$appearance_after_washing_fabric_crease_after_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_max_value'];
								$test_method_for_appearance_after_washing_fabric_loss_of_print=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_loss_of_print'];
								$appearance_after_washing_loss_of_print_fabric=$row_old_pp_version_curing_process['appearance_after_washing_loss_of_print_fabric'];
								$test_method_for_appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
								$appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_curing_process['appearance_after_washing_fabric_abrasive_mark'];
								$test_method_for_appearance_after_washing_fabric_odor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_odor'];
								$appearance_after_washing_odor_fabric=$row_old_pp_version_curing_process['appearance_after_washing_odor_fabric'];

								$appearance_after_washing_cycle_garments_wash=$row_old_pp_version_curing_process['appearance_after_washing_cycle_garments_wash'];
								
								$test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_color_change_without_suppressor'];
								$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator'];
								$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_without_suppressor_tolerance_value'];
								$uom_of_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_color_change_without_suppressor'];
								$appearance_after_washing_garments_color_change_without_suppressor_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_without_suppressor_min_value'];
								$appearance_after_washing_garments_color_change_without_suppressor_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_without_suppressor_max_value'];
								$test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_color_change_with_suppressor'];
								$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator'];
								$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_with_suppressor_tolerance_value'];
								$uom_of_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_color_change_with_suppressor'];
								$appearance_after_washing_garments_color_change_with_suppressor_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_with_suppressor_min_value'];
								$appearance_after_washing_garments_color_change_with_suppressor_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_color_change_with_suppressor_max_value'];
								$test_method_for_appearance_after_washing_garments_cross_staining=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_cross_staining'];
								$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_tolerance_range_math_operator'];
								$appearance_after_washing_garments_cross_staining_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_tolerance_value'];
								$uom_of_appearance_after_washing_garments_cross_staining=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_cross_staining'];
								$appearance_after_washing_garments_cross_staining_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_min_value'];
								$appearance_after_washing_garments_cross_staining_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_max_value'];
								$test_method_for_appearance_after_washing_garments_differential_shrinkage=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_differential_shrinkage'];
								$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator'];
								$appearance_after_washing_garments__differential_shrinkage_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments__differential_shrinkage_tolerance_value'];
								$uom_of_appearance_after_washing_garments__differential_shrinkage=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments__differential_shrinkage'];
								$appearance_after_washing_garments__differential_shrinkage_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments__differential_shrinkage_min_value'];
								$appearance_after_washing_garments__differential_shrinkage_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments__differential_shrinkage_max_value'];
								$test_method_for_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_surface_fuzzing'];
								$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator'];
								$appearance_after_washing_garments_surface_fuzzing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_value'];
								$uom_of_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_surface_fuzzing'];
								$appearance_after_washing_garments_surface_fuzzing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_min_value'];
								$appearance_after_washing_garments_surface_fuzzing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_max_value'];
								$test_method_for_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_surface_pilling'];
								$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator'];
								$appearance_after_washing_garments_surface_pilling_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_tolerance_value'];
								$uom_of_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_surface_pilling'];
								$appearance_after_washing_garments_surface_pilling_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_min_value'];
								$appearance_after_washing_garments_surface_pilling_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_max_value'];
								$test_method_for_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_crease_after_ironing'];
								$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator'];
								$appearance_after_washing_garments_crease_after_ironing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_tolerance_value'];
								$uom_of_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_crease_after_ironing'];
								$appearance_after_washing_garments_crease_after_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_min_value'];
								$appearance_after_washing_garments_crease_after_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_max_value'];
								$test_method_for_appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_abrasive_mark'];
								$appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_curing_process['appearance_after_washing_garments_abrasive_mark'];
								$test_method_for_appearance_after_washing_garments_seam_breakdown=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_seam_breakdown'];
								$seam_breakdown_garments=$row_old_pp_version_curing_process['seam_breakdown_garments'];
								$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
								$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator=$row_old_pp_version_curing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator'];
								$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value'];
								$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
								$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value'];
								$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value'];
								$test_method_for_appearance_after_washing_garments_detachment_of_interlining=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_detachment_of_interlining'];
								$detachment_of_interlinings_fused_components_garments=$row_old_pp_version_curing_process['detachment_of_interlinings_fused_components_garments'];
								$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance'];
								$change_id_handle_or_appearance=$row_old_pp_version_curing_process['change_id_handle_or_appearance'];
								$test_method_for_appearance_after_washing_garments_effect_accessories=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_effect_accessories'];
								$effect_on_accessories_such_as_buttons=$row_old_pp_version_curing_process['effect_on_accessories_such_as_buttons'];
								$test_method_for_appearance_after_washing_garments_spirality=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_spirality'];
								$appearance_after_washing_garments_spirality_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_spirality_min_value'];
								$appearance_after_washing_garments_spirality_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_spirality_max_value'];
								$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons'];
								$detachment_or_fraying_of_ribbons=$row_old_pp_version_curing_process['detachment_or_fraying_of_ribbons'];
								$test_method_for_appearance_after_washing_garments_loss_of_print=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_loss_of_print'];
								$loss_of_print_garments=$row_old_pp_version_curing_process['loss_of_print_garments'];
								$test_method_for_appearance_after_washing_garments_care_level=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_care_level'];
								$care_level_garments=$row_old_pp_version_curing_process['care_level_garments'];
								$test_method_for_appearance_after_washing_garments_odor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_odor'];
								$odor_garments=$row_old_pp_version_curing_process['odor_garments'];




									$insert_sql_statement_for_curing="INSERT INTO `defining_qc_standard_for_curing_process` ( 
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

									       `test_method_for_surface_fuzzing_and_pilling`, 
								         `description_or_type_for_surface_fuzzing_and_pilling`, 
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


								           `test_method_for_resistance_to_surface_wetting_before_wash`, 
								           `resistance_to_surface_wetting_before_wash_tol_range_math_op`, 
								           `resistance_to_surface_wetting_before_wash_tolerance_value`, 
								           `resistance_to_surface_wetting_before_wash_min_value`, 
								           `resistance_to_surface_wetting_before_wash_max_value`, 
								           `uom_of_resistance_to_surface_wetting_before_wash`, 
								  
								          `test_method_for_resistance_to_surface_wetting_after_one_wash`,
								          `resistance_to_surface_wetting_after_one_wash_tol_range_math_op`,
								          `resistance_to_surface_wetting_after_one_wash_tolerance_value`,
								          `resistance_to_surface_wetting_after_one_wash_min_value`, 
								          `resistance_to_surface_wetting_after_one_wash_max_value`, 
								          `uom_of_resistance_to_surface_wetting_after_one_wash`,

								         `test_method_for_resistance_to_surface_wetting_after_five_wash`, 
								         `resistance_to_surface_wetting_after_five_wash_tol_range_math_op`, 
								         `resistance_to_surface_wetting_after_five_wash_tolerance_value`,
								         `resistance_to_surface_wetting_after_five_wash_min_value`, 
								         `resistance_to_surface_wetting_after_five_wash_max_value`, 
								         `uom_of_resistance_to_surface_wetting_after_five_wash`, 

									      `test_method_formaldehyde_content`, 
								        `formaldehyde_content_tolerance_range_math_operator`, 
								        `formaldehyde_content_tolerance_value`, 
								        `formaldehyde_content_min_value`, 
								        `formaldehyde_content_max_value`, 
								        `uom_of_formaldehyde_content`, 

								    	  `test_method_for_ph`,
								        `ph_value_tolerance_range_math_operator`,
								    	  `ph_value_tolerance_value`, 
								    	  `ph_value_min_value`, 
								    	  `ph_value_max_value`, 
								    	  `uom_of_ph_value`, 

										  `test_method_for_smoothness_appearance`, 
								      `smoothness_appearance_tolerance_range_math_op`, 
								       `smoothness_appearance_tolerance_value`, 
								       `smoothness_appearance_min_value`, 
								       `smoothness_appearance_max_value`, 
								       `uom_of_smoothness_appearance`,

								      test_method_for_appearance_after_wash_fabric,
								      appearance_after_washing_cycle_fabric_wash1,
								      
								      test_method_for_appearance_after_washing_fabric_color_change,
								      appearance_after_washing_fabric_color_change_math_op,
								      appearance_after_washing_fabric_color_change_tolerance_value,
								      uom_of_appearance_after_washing_fabric_color_change,
								      appearance_after_washing_fabric_color_change_min_value,
								      appearance_after_washing_fabric_color_change_max_value,
								      
								      test_method_for_appearance_after_washing_fabric_cross_staining,
								      appearance_after_washing_fabric_cross_staining_math_op,
								      appearance_after_washing_fabric_cross_staining_tolerance_value,
								      uom_of_appearance_after_washing_fabric_cross_staining,
								      appearance_after_washing_fabric_cross_staining_min_value,
								      appearance_after_washing_fabric_cross_staining_max_value,

								      test_method_for_appearance_after_washing_fabric_surface_fuzzing,
								      appearance_after_washing_fabric_surface_fuzzing_math_op,
								      appearance_after_washing_fabric_surface_fuzzing_tolerance_value,
								      uom_of_appearance_after_washing_fabric_surface_fuzzing,
								      appearance_after_washing_fabric_surface_fuzzing_min_value,
								      appearance_after_washing_fabric_surface_fuzzing_max_value,

								      test_method_for_appearance_after_washing_fabric_surface_pilling,
								      appearance_after_washing_fabric_surface_pilling_math_op,
								      appearance_after_washing_fabric_surface_pilling_tolerance_value,
								      uom_of_appearance_after_washing_fabric_surface_pilling,
								      appearance_after_washing_fabric_surface_pilling_min_value,
								      appearance_after_washing_fabric_surface_pilling_max_value,

								      test_method_for_appear_after_washing_fabric_crease_before_iron,
								      appearance_after_washing_fabric_crease_before_iron_math_op,
								      appearance_after_washing_fabric_crease_before_iron_tolerance_val,
								      uom_of_appearance_after_washing_fabric_crease_before_ironing,
								      appearance_after_washing_fabric_crease_before_ironing_min_value,
								      appearance_after_washing_fabric_crease_before_ironing_max_value,

								      test_method_for_appear_after_washing_fabric_crease_after_ironing,
								      appearance_after_washing_fabric_crease_after_iron_math_op,
								      appearance_after_washing_fabric_crease_after_iron_tolerance_val,
								      uom_of_appearance_after_washing_fabric_crease_after_ironing,
								      appearance_after_washing_fabric_crease_after_ironing_min_value,
								      appearance_after_washing_fabric_crease_after_ironing_max_value,

								      test_method_for_appearance_after_washing_fabric_loss_of_print,
								      appearance_after_washing_loss_of_print_fabric,

								      test_method_for_appearance_after_washing_fabric_abrasive_mark,
								      appearance_after_washing_fabric_abrasive_mark,

								      test_method_for_appearance_after_washing_fabric_odor,
								      appearance_after_washing_odor_fabric,
								     
								      appearance_after_washing_cycle_garments_wash1,
								      test_method_for_appear_wash_garments_color_change_without_sup,
								      appear_after_washing_garments_color_change_without_sup_math_op,
								      appear_after_washing_garments_color_change_without_sup_toler_val,
								      uom_of_appear_after_washing_garments_color_change_without_sup,
								      appear_after_washing_garments_color_change_without_sup_min_value,
								      appear_after_washing_garments_color_change_without_sup_max_val,

								      test_method_for_appear_after_wash_garments_color_change_with_sup,
								      appear_after_washing_garments_color_change_with_sup_math_op,
								      appear_after_washing_garments_color_change_with_sup_toler_value,
								      uom_of_appear_after_washing_garments_color_change_with_sup,
								      appear_after_washing_garments_color_change_with_sup_min_value,
								      appear_after_washing_garments_color_change_with_sup_max_value,

								      test_method_for_appear_after_washing_garments_cross_staining,
								      appear_after_washing_garments_cross_staining_math_op,
								      appear_after_washing_garments_cross_staining_tolerance_value,
								      uom_of_appearance_after_washing_garments_cross_staining,
								      appearance_after_washing_garments_cross_staining_min_value,
								      appearance_after_washing_garments_cross_staining_max_value,

								      test_method_for_appear_after_washing_garments_differential_shrin,
								      appear_after_washing_garments_differential_shrink_math_op,
								      appear_after_washing_garments__differential_shrink_tolerance_val,
								      uom_of_appearance_after_washing_garments__differential_shrinkage,
								      appearance_after_washing_garments__differential_shrink_min_value,
								      appearance_after_washing_garments__differential_shrink_max_value,

								      test_method_for_appear_after_washing_garments_surface_fuzzing,
								      appear_after_washing_garments_surface_fuzzing_math_op,
								      appearance_after_washing_garments_surface_fuzzing_tolerance_val,
								      uom_of_appearance_after_washing_garments_surface_fuzzing,
								      appearance_after_washing_garments_surface_fuzzing_min_value,
								      appearance_after_washing_garments_surface_fuzzing_max_value,

								      test_method_for_appear_after_washing_garments_surface_pilling,
								      appear_after_washing_garments_surface_pilling_math_op,
								      appearance_after_washing_garments_surface_pilling_tolerance_val,
								      uom_of_appearance_after_washing_garments_surface_pilling,
								      appearance_after_washing_garments_surface_pilling_min_value,
								      appearance_after_washing_garments_surface_pilling_max_value,

								      test_method_for_appear_after_washing_garments_crease_after_iron,
								      appear_after_washing_garments_crease_after_ironing_math_op,
								      appear_after_washing_garments_crease_after_ironing_tolerance_val,
								      uom_of_appear_after_washing_garments_crease_after_ironing,
								      appearance_after_washing_garments_crease_after_ironing_min_value,
								      appearance_after_washing_garments_crease_after_ironing_max_value,

								      test_method_for_appearance_after_washing_garments_abrasive_mark,
								      appearance_after_washing_garments_abrasive_mark,

								      test_method_for_appearance_after_washing_garments_seam_breakdown,
								      seam_breakdown_garments,

								      test_method_for_apear_after_wash_garments_seam_pucker_after_iron,
								      appear_after_wash_garments_seam_pucker_rop_iron_math_op,
								      appear_after_washing_garments_seam_pucker_rop_iron_toler_value,
								      uom_of_appear_after_washing_garments_seam_pucker_rop_rion,
								      appear_after_washing_garments_seam_pucker_rop_iron_min_value,
								      appear_after_washing_garments_seam_pucker_rop_iron_max_value,

								      test_method_for_appear_after_washing_garments_detachment_inter,
								      detachment_of_interlinings_fused_components_garments,

								      test_method_for_appear_after_washing_garments_change_in_handle,
								      change_id_handle_or_appearance,

								      test_method_for_appearance_after_washing_garments_effect_access,
								      effect_on_accessories_such_as_buttons,

								      test_method_for_appearance_after_washing_garments_spirality,
								      appearance_after_washing_garments_spirality_min_value,
								      appearance_after_washing_garments_spirality_max_value,

								      test_method_for_appear_after_washing_garments_detachment_fraying,
								      detachment_or_fraying_of_ribbons,

								      test_method_for_appearance_after_washing_garments_loss_of_print,
								      loss_of_print_garments,

								      test_method_for_appearance_after_washing_garments_care_level,
								      care_level_garments,

								      test_method_for_appearance_after_washing_garments_odor,
								      odor_garments,

										  `recording_person_id`, 
										  `recording_person_name`, 
										  `recording_time` 
								        ) 

								       VALUES 
								        (
								         '$pp_number',
								         '$version_id',
								         '$version_name',
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

									       '$test_method_for_surface_fuzzing_and_pilling',
								         '$description_or_type_for_surface_fuzzing_and_pilling',
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


								           '$test_method_for_resistance_to_surface_wetting_before_wash',
								           '$resistance_to_surface_wetting_before_wash_tol_range_math_op',
								           '$resistance_to_surface_wetting_before_wash_tolerance_value',
								           '$resistance_to_surface_wetting_before_wash_min_value',
								           '$resistance_to_surface_wetting_before_wash_max_value',
								           '$uom_of_resistance_to_surface_wetting_before_wash',

								           '$test_method_for_resistance_to_surface_wetting_after_one_wash',
								           '$resistance_to_surface_wetting_after_one_wash_tol_range_math_op',
								           '$resistance_to_surface_wetting_after_one_wash_tolerance_value',
								           '$resistance_to_surface_wetting_after_one_wash_min_value',
								           '$resistance_to_surface_wetting_after_one_wash_max_value',
								           '$uom_of_resistance_to_surface_wetting_after_one_wash',

								           '$test_method_for_resistance_to_surface_wetting_after_five_wash',
								           '$resistance_to_surface_wetting_after_five_wash_tol_range_math_op',
								           '$resistance_to_surface_wetting_after_five_wash_tolerance_value',
								           '$resistance_to_surface_wetting_after_five_wash_min_value',
								           '$resistance_to_surface_wetting_after_five_wash_max_value',
								           '$uom_of_resistance_to_surface_wetting_after_five_wash',
								            
								           '$test_method_formaldehyde_content',
								           '$formaldehyde_content_tolerance_range_math_operator',
								           '$formaldehyde_content_tolerance_value',
								           '$formaldehyde_content_min_value',
								           '$formaldehyde_content_max_value',
								           '$uom_of_formaldehyde_content',

								           '$test_method_for_ph',
								           '$ph_value_tolerance_range_math_operator',
								           '$ph_value_tolerance_value',
								           '$ph_value_min_value',
								           '$ph_value_max_value',
								           '$uom_of_ph_value',


								           '$test_method_for_smoothness_appearance',
								           '$smoothness_appearance_tolerance_range_math_op',
								           '$smoothness_appearance_tolerance_value',
								           '$smoothness_appearance_min_value',
								           '$smoothness_appearance_max_value',
								           '$uom_of_smoothness_appearance',

								          '$test_method_for_appearance_after_wash_fabric',
								          '$appearance_after_washing_cycle_fabric_wash',

								          '$test_method_for_appearance_after_washing_fabric_color_change',
								          '$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_color_change_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_color_change',
								          '$appearance_after_washing_fabric_color_change_min_value',
								          '$appearance_after_washing_fabric_color_change_max_value',

								          '$test_method_for_appearance_after_washing_fabric_cross_staining',
								          '$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_cross_staining_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_cross_staining',
								          '$appearance_after_washing_fabric_cross_staining_min_value',
								          '$appearance_after_washing_fabric_cross_staining_max_value',

								          '$test_method_for_appearance_after_washing_fabric_surface_fuzzing',
								          '$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_surface_fuzzing_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_surface_fuzzing',
								          '$appearance_after_washing_fabric_surface_fuzzing_min_value',
								          '$appearance_after_washing_fabric_surface_fuzzing_max_value',

								          '$test_method_for_appearance_after_washing_fabric_surface_pilling',
								          '$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_surface_pilling_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_surface_pilling',
								          '$appearance_after_washing_fabric_surface_pilling_min_value',
								          '$appearance_after_washing_fabric_surface_pilling_max_value',

								          '$test_method_for_appearance_after_washing_fabric_crease_before_ironing',
								          '$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_crease_before_ironing_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_crease_before_ironing',
								          '$appearance_after_washing_fabric_crease_before_ironing_min_value',
								          '$appearance_after_washing_fabric_crease_before_ironing_max_value',

								          '$test_method_for_appearance_after_washing_fabric_crease_after_ironing',
								          '$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator',
								          '$appearance_after_washing_fabric_crease_after_ironing_tolerance_value',
								          '$uom_of_appearance_after_washing_fabric_crease_after_ironing',
								          '$appearance_after_washing_fabric_crease_after_ironing_min_value',
								          '$appearance_after_washing_fabric_crease_after_ironing_max_value',

								          '$test_method_for_appearance_after_washing_fabric_loss_of_print',
								          '$appearance_after_washing_loss_of_print_fabric',

								          '$test_method_for_appearance_after_washing_fabric_abrasive_mark',
								          '$appearance_after_washing_fabric_abrasive_mark',

								          '$test_method_for_appearance_after_washing_fabric_odor',
								          '$appearance_after_washing_odor_fabric',

								          '$appearance_after_washing_cycle_garments_wash',
								          '$test_method_for_appearance_after_washing_garments_color_change_without_suppressor',
								          '$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_color_change_without_suppressor',
								          '$appearance_after_washing_garments_color_change_without_suppressor_min_value',
								          '$appearance_after_washing_garments_color_change_without_suppressor_max_value',

								          '$test_method_for_appearance_after_washing_garments_color_change_with_suppressor',
								          '$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_color_change_with_suppressor',
								          '$appearance_after_washing_garments_color_change_with_suppressor_min_value',
								          '$appearance_after_washing_garments_color_change_with_suppressor_max_value',

								          '$test_method_for_appearance_after_washing_garments_cross_staining',
								          '$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_cross_staining_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_cross_staining',
								          '$appearance_after_washing_garments_cross_staining_min_value',
								          '$appearance_after_washing_garments_cross_staining_max_value',

								          '$test_method_for_appearance_after_washing_garments_differential_shrinkage',
								          '$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator',
								          '$appearance_after_washing_garments__differential_shrinkage_tolerance_value',
								          '$uom_of_appearance_after_washing_garments__differential_shrinkage',
								          '$appearance_after_washing_garments__differential_shrinkage_min_value',
								          '$appearance_after_washing_garments__differential_shrinkage_max_value',

								          '$test_method_for_appearance_after_washing_garments_surface_fuzzing',
								          '$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_surface_fuzzing_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_surface_fuzzing',
								          '$appearance_after_washing_garments_surface_fuzzing_min_value',
								          '$appearance_after_washing_garments_surface_fuzzing_max_value',

								          '$test_method_for_appearance_after_washing_garments_surface_pilling',
								          '$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_surface_pilling_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_surface_pilling',
								          '$appearance_after_washing_garments_surface_pilling_min_value',
								          '$appearance_after_washing_garments_surface_pilling_max_value',

								          '$test_method_for_appearance_after_washing_garments_crease_after_ironing',
								          '$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_crease_after_ironing_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_crease_after_ironing',
								          '$appearance_after_washing_garments_crease_after_ironing_min_value',
								          '$appearance_after_washing_garments_crease_after_ironing_max_value',

								          '$test_method_for_appearance_after_washing_garments_abrasive_mark',
								          '$appearance_after_washing_garments_abrasive_mark',

								          '$test_method_for_appearance_after_washing_garments_seam_breakdown',
								          '$seam_breakdown_garments',

								          '$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron',
								          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator',
								          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value',
								          '$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron',
								          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value',
								          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value',

								          '$test_method_for_appearance_after_washing_garments_detachment_of_interlining',
								          '$detachment_of_interlinings_fused_components_garments',

								          '$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance',
								          '$change_id_handle_or_appearance',

								          '$test_method_for_appearance_after_washing_garments_effect_accessories',
								          '$effect_on_accessories_such_as_buttons',

								          '$test_method_for_appearance_after_washing_garments_spirality',
								          '$appearance_after_washing_garments_spirality_min_value',
								          '$appearance_after_washing_garments_spirality_max_value',

								          '$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons',
								          '$detachment_or_fraying_of_ribbons',

								          '$test_method_for_appearance_after_washing_garments_loss_of_print',
								          '$loss_of_print_garments',

								          '$test_method_for_appearance_after_washing_garments_care_level',
								          '$care_level_garments',

								          '$test_method_for_appearance_after_washing_garments_odor',
								          '$odor_garments',

									         '$user_id',
									         '$user_name',
									          NOW()
										        )";

									mysqli_query($con,$insert_sql_statement_for_curing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for curing..............................................................//



							 /*............................................................Copy finishing.............................................................*/


			                $duplicate_finishing_process="select * from `defining_qc_standard_for_finishing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_finishing_process= mysqli_query($con,$duplicate_finishing_process) or die(mysqli_error());
							$check_duplicate_finishing_process = mysqli_num_rows($result_duplicate_finishing_process);


							if ($check_duplicate_finishing_process >= 1) 
							{
					           echo "finishing Data is Previously saved";
							}

							else
							{

		                    $old_pp_version_finishing_process = "select * from `defining_qc_standard_for_finishing_process` where `version_id`='$old_version_name'";
						    $result_old_pp_version_finishing_process = mysqli_query($con,$old_pp_version_finishing_process) or die(mysqli_error());
						    $row_old_pp_version_finishing_process = mysqli_fetch_array($result_old_pp_version_finishing_process);

							
							//copy caledering process data
							$standard_for_which_process= $row_old_pp_version_finishing_process['standard_for_which_process'];


					$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_dry'];
$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_value'];
$cf_to_rubbing_dry_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_min_value'];
$cf_to_rubbing_dry_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_max_value'];
$uom_of_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_dry'];

$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_wet'];
$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_value'];
$cf_to_rubbing_wet_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_min_value'];
$cf_to_rubbing_wet_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_max_value'];
$uom_of_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_wet'];

$test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
$washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_before_iron'];
$dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
$dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
$uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];


$test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
$washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_before_iron'];
$dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
$dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
$uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

$test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
$washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_after_iron'];
$dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
$dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
$uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

$test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
$washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_after_iron'];
$dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
$dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
$uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];



$test_method_for_warp_yarn_count= $row_old_pp_version_finishing_process['test_method_for_warp_yarn_count'];
$warp_yarn_count_value= $row_old_pp_version_finishing_process['warp_yarn_count_value'];
$warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_finishing_process['warp_yarn_count_tolerance_range_math_operator'];
$warp_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['warp_yarn_count_tolerance_value'];
$warp_yarn_count_min_value= $row_old_pp_version_finishing_process['warp_yarn_count_min_value'];
$warp_yarn_count_max_value= $row_old_pp_version_finishing_process['warp_yarn_count_max_value'];
$uom_of_warp_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_warp_yarn_count_value'];

$test_method_for_weft_yarn_count= $row_old_pp_version_finishing_process['test_method_for_weft_yarn_count'];
$weft_yarn_count_value= $row_old_pp_version_finishing_process['weft_yarn_count_value'];
$weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_finishing_process['weft_yarn_count_tolerance_range_math_operator'];
$weft_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['weft_yarn_count_tolerance_value'];
$weft_yarn_count_min_value= $row_old_pp_version_finishing_process['weft_yarn_count_min_value'];
$weft_yarn_count_max_value= $row_old_pp_version_finishing_process['weft_yarn_count_max_value'];
$uom_of_weft_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_weft_yarn_count_value'];

$test_method_for_mass_per_unit_per_area= $row_old_pp_version_finishing_process['test_method_for_mass_per_unit_per_area'];
$mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_range_math_operator'];
$mass_per_unit_per_area_tolerance_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['uom_of_mass_per_unit_per_area_value'];

$test_method_for_no_of_threads_in_warp= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_warp'];
$no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_value'];
$no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_range_math_operator'];
$no_of_threads_in_warp_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_value'];
$no_of_threads_in_warp_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_min_value'];
$no_of_threads_in_warp_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_max_value'];
$uom_of_no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_warp_value'];

$test_method_for_no_of_threads_in_weft= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_weft'];
$no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_value'];
$no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_range_math_operator'];
$no_of_threads_in_weft_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_value'];
$no_of_threads_in_weft_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_min_value'];
$no_of_threads_in_weft_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_max_value'];
$uom_of_no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_weft_value'];

$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['description_or_type_for_surface_fuzzing_and_pilling'];
$test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['test_method_for_surface_fuzzing_and_pilling'];
$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_value'];
$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_max_value'];
$uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_finishing_process['uom_of_surface_fuzzing_and_pilling_value'];

$test_method_for_tensile_properties_in_warp= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_warp'];
$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_value'];
$tensile_properties_in_warp_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_min_value'];
$tensile_properties_in_warp_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_max_value'];
$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_warp_value'];

$test_method_for_tensile_properties_in_weft= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_weft'];
$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_value'];
$tensile_properties_in_weft_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_min_value'];
$tensile_properties_in_weft_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_max_value'];
$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_weft_value'];

$test_method_for_tear_force_in_warp= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_warp'];
$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_range_math_operator'];
$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_value'];
$tear_force_in_warp_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_min_value'];
$tear_force_in_warp_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_max_value'];
$uom_of_tear_force_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_warp_value'];

$test_method_for_tear_force_in_weft= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_weft'];
$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_range_math_operator'];
$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_value'];
$tear_force_in_weft_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_min_value'];
$tear_force_in_weft_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_max_value'];
$uom_of_tear_force_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_weft_value'];


$test_method_for_abrasion_resistance_c_change= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_c_change'];
$abrasion_resistance_c_change_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_rubs'];
$abrasion_resistance_c_change_value_math_op= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_math_op'];
$abrasion_resistance_c_change_value_tolerance_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_tolerance_value'];
$abrasion_resistance_c_change_value_min_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_min_value'];
$abrasion_resistance_c_change_value_max_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_max_value'];
$uom_of_abrasion_resistance_c_change_value= $row_old_pp_version_finishing_process['uom_of_abrasion_resistance_c_change_value'];

$test_method_for_abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_no_of_thread_break'];
$abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_no_of_thread_break'];
$abrasion_resistance_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_rubs'];
$abrasion_resistance_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_thread_break'];


$test_method_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['test_method_for_mass_loss_in_abrasion_test'];
$rubs_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['rubs_for_mass_loss_in_abrasion_test'];
$mass_loss_in_abrasion_test_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'];
$mass_loss_in_abrasion_test_value_tolerance_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_value'];
$mass_loss_in_abrasion_test_value_min_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_min_value'];
$mass_loss_in_abrasion_test_value_max_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_max_value'];
$uom_of_mass_loss_in_abrasion_test_value= $row_old_pp_version_finishing_process['uom_of_mass_loss_in_abrasion_test_value'];

$test_method_for_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_color_change'];
$cf_to_dry_cleaning_color_change_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'];
$cf_to_dry_cleaning_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_value'];
$cf_to_dry_cleaning_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_min_value'];
$cf_to_dry_cleaning_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_max_value'];
$uom_of_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_color_change'];

$test_method_for_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_staining'];
$cf_to_dry_cleaning_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'];
$cf_to_dry_cleaning_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_value'];
$cf_to_dry_cleaning_staining_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_min_value'];
$cf_to_dry_cleaning_staining_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_max_value'];
$uom_of_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_staining'];


$test_method_for_cf_to_washing_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_color_change'];
$cf_to_washing_color_change_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_range_math_operator'];
$cf_to_washing_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_value'];
$cf_to_washing_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_min_value'];
$cf_to_washing_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_max_value'];
$uom_of_cf_to_washing_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_color_change'];

$test_method_for_cf_to_washing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_staining'];
$cf_to_washing_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_range_math_operator'];
$cf_to_washing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_value'];
$cf_to_washing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_min_value'];
$cf_to_washing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_max_value'];
$uom_of_cf_to_washing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_staining'];

$test_method_for_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_cross_staining'];
$cf_to_washing_cross_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_range_math_operator'];
$cf_to_washing_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_value'];
$cf_to_washing_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_min_value'];
$cf_to_washing_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_max_value'];
$uom_of_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_cross_staining'];

$test_method_for_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_thirty_sec'];
$water_absorption_b_wash_thirty_sec_tolerance_range_math_op= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'];
$water_absorption_b_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_value'];
$water_absorption_b_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_min_value'];
$water_absorption_b_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_max_value'];
$uom_of_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_thirty_sec'];

$test_method_for_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_max'];
$water_absorption_b_wash_max_tolerance_range_math_op= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_range_math_op'];
$water_absorption_b_wash_max_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_value'];
$water_absorption_b_wash_max_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_min_value'];
$water_absorption_b_wash_max_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_max_value'];
$uom_of_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_max'];


$test_method_for_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_a_wash_thirty_sec'];
$water_absorption_a_wash_thirty_sec_tolerance_range_math_op= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'];
$water_absorption_a_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_value'];
$water_absorption_a_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_min_value'];
$water_absorption_a_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_max_value'];
$uom_of_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_a_wash_thirty_sec'];

$test_method_for_perspiration_acid_color_change= $row_old_pp_version_finishing_process['test_method_for_perspiration_acid_color_change'];
$cf_to_perspiration_acid_color_change_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'];
$cf_to_perspiration_acid_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_value'];
$cf_to_perspiration_acid_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_min_value'];
$cf_to_perspiration_acid_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_max_value'];
$uom_of_cf_to_perspiration_acid_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_color_change'];

$test_method_for_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_staining'];
$cf_to_perspiration_acid_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'];
$cf_to_perspiration_acid_staining_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_value'];
$cf_to_perspiration_acid_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_min_value'];
$cf_to_perspiration_acid_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_max_value'];
$uom_of_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_staining'];



$test_method_for_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_cross_staining'];
$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_acid_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
$cf_to_perspiration_acid_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_min_value'];
$cf_to_perspiration_acid_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_max_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_cross_staining'];


$test_method_for_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_color_change'];
$cf_to_perspiration_alkali_color_change_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'];
$cf_to_perspiration_alkali_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
$cf_to_perspiration_alkali_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_min_value'];
$cf_to_perspiration_alkali_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_max_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_color_change'];


$test_method_for_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_staining'];
$cf_to_perspiration_alkali_staining_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_value'];
$cf_to_perspiration_alkali_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_min_value'];
$cf_to_perspiration_alkali_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_staining'];

$test_method_for_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_cross_staining'];
$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
$cf_to_perspiration_alkali_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_min_value'];
$cf_to_perspiration_alkali_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_cross_staining'];

$test_method_for_cf_to_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_color_change'];
$cf_to_water_color_change_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_range_math_operator'];
$cf_to_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_value'];
$cf_to_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_min_value'];
$cf_to_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_max_value'];
$uom_of_cf_to_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_water_color_change'];

$test_method_for_cf_to_water_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_staining'];
$cf_to_water_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_range_math_operator'];
$cf_to_water_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_value'];
$cf_to_water_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_staining_min_value'];
$cf_to_water_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_staining_max_value'];
$uom_of_cf_to_water_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_staining'];

$test_method_for_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_cross_staining'];
$cf_to_water_cross_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_range_math_operator'];
$cf_to_water_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_value'];
$cf_to_water_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_min_value'];
$cf_to_water_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_max_value'];
$uom_of_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_cross_staining'];

$test_method_for_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_surface'];
$cf_to_water_spotting_surface_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_range_math_op'];
$cf_to_water_spotting_surface_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_value'];
$cf_to_water_spotting_surface_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_min_value'];
$cf_to_water_spotting_surface_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_max_value'];
$uom_of_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_surface'];

$test_method_for_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_edge'];
$cf_to_water_spotting_edge_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_range_math_op'];
$cf_to_water_spotting_edge_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_value'];
$cf_to_water_spotting_edge_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_min_value'];
$cf_to_water_spotting_edge_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_max_value'];
$uom_of_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_edge'];


$test_method_for_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_cross_staining'];
$cf_to_water_spotting_cross_staining_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'];
$cf_to_water_spotting_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_value'];
$cf_to_water_spotting_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_min_value'];
$cf_to_water_spotting_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_max_value'];
$uom_of_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_cross_staining'];


$test_method_for_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_before_wash'];
$resistance_to_surface_wetting_before_wash_tol_range_math_op= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'];
$resistance_to_surface_wetting_before_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
$resistance_to_surface_wetting_before_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_min_value'];
$resistance_to_surface_wetting_before_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_max_value'];
$uom_of_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_before_wash'];


$test_method_for_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_one_wash'];
$resistance_to_surface_wetting_after_one_wash_tol_range_math_op= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'];
$resistance_to_surface_wetting_after_one_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
$resistance_to_surface_wetting_after_one_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_min_value'];
$resistance_to_surface_wetting_after_one_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_one_wash'];


$test_method_for_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_five_wash'];
$resistance_to_surface_wetting_after_five_wash_tol_range_math_op= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'];
$resistance_to_surface_wetting_after_five_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
$resistance_to_surface_wetting_after_five_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_min_value'];
$resistance_to_surface_wetting_after_five_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_five_wash'];


$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


$test_method_for_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_oxidative_bleach_damage_color_change'];
$cf_to_oxidative_bleach_damage_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_value'];
$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'];
$cf_to_oxidative_bleach_damage_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
$cf_to_oxidative_bleach_damage_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_min_value'];
$cf_to_oxidative_bleach_damage_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_max_value'];
$uom_of_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_oxidative_bleach_damage_color_change'];




$test_method_for_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_phenolic_yellowing_staining'];
$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'];
$cf_to_phenolic_yellowing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
$cf_to_phenolic_yellowing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_min_value'];
$cf_to_phenolic_yellowing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_max_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_phenolic_yellowing_staining'];


$test_method_for_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_pvc_migration_staining'];
$cf_to_pvc_migration_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'];
$cf_to_pvc_migration_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_value'];
$cf_to_pvc_migration_staining_min_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_min_value'];
$cf_to_pvc_migration_staining_max_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_max_value'];
$uom_of_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_pvc_migration_staining'];


$test_method_for_cf_to_saliva_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_staining'];
$cf_to_saliva_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_range_math_operator'];
$cf_to_saliva_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_value'];
$cf_to_saliva_staining_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_staining_min_value'];
$cf_to_saliva_staining_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_max_value'];
$uom_of_cf_to_saliva_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_staining'];

$test_method_for_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_color_change'];
$cf_to_saliva_color_change_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_range_math_operator'];
$cf_to_saliva_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_value'];
$cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_max_value'];
$uom_of_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_color_change'];


$test_method_for_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_chlorinated_water_color_change'];
$cf_to_chlorinated_water_color_change_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'];
$cf_to_chlorinated_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_value'];
$cf_to_chlorinated_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_min_value'];
$cf_to_chlorinated_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_max_value'];
$uom_of_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_chlorinated_water_color_change'];

$test_method_for_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_cholorine_bleach_color_change'];
$cf_to_cholorine_bleach_color_change_tolerance_range_math_op= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'];
$cf_to_cholorine_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
$cf_to_cholorine_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_min_value'];
$cf_to_cholorine_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_max_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_cholorine_bleach_color_change'];


$test_method_for_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_peroxide_bleach_color_change'];
$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'];
$cf_to_peroxide_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
$cf_to_peroxide_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_min_value'];
$cf_to_peroxide_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_max_value'];
$uom_of_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_peroxide_bleach_color_change'];

$test_method_for_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cross_staining'];
$cross_staining_tolerance_range_math_operator= $row_old_pp_version_finishing_process['cross_staining_tolerance_range_math_operator'];
$cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cross_staining_tolerance_value'];
$cross_staining_min_value= $row_old_pp_version_finishing_process['cross_staining_min_value'];
$cross_staining_max_value= $row_old_pp_version_finishing_process['cross_staining_max_value'];
$uom_of_cross_staining= $row_old_pp_version_finishing_process['uom_of_cross_staining'];

$test_method_formaldehyde_content= $row_old_pp_version_finishing_process['test_method_formaldehyde_content'];
$formaldehyde_content_tolerance_range_math_operator= $row_old_pp_version_finishing_process['formaldehyde_content_tolerance_range_math_operator'];
$formaldehyde_content_tolerance_value= $row_old_pp_version_finishing_process['formaldehyde_content_tolerance_value'];
$formaldehyde_content_min_value= $row_old_pp_version_finishing_process['formaldehyde_content_min_value'];
$formaldehyde_content_max_value= $row_old_pp_version_finishing_process['formaldehyde_content_max_value'];
$uom_of_formaldehyde_content= $row_old_pp_version_finishing_process['uom_of_formaldehyde_content'];

$test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_warp'];
$seam_slippage_resistance_in_warp_tolerance_range_math_operator= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'];
$seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_value'];
$seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_min_value'];
$seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_max_value'];
$uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_warp'];

$test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_weft'];
$seam_slippage_resistance_in_weft_tolerance_range_math_operator= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'];
$seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_value'];
$seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_min_value'];
$seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_max_value'];
$uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_weft'];




$test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
$seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
$seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


$test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'];
$seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
$seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
$seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


$test_method_for_seam_strength_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_warp'];
$seam_strength_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_range_math_operator'];
$seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_value'];
$seam_strength_in_warp_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_min_value'];
$seam_strength_in_warp_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_max_value'];
$uom_of_seam_strength_in_warp_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_warp_value'];

$test_method_for_seam_strength_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_weft'];
$seam_strength_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_range_math_operator'];
$seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_value'];
$seam_strength_in_weft_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_min_value'];
$seam_strength_in_weft_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_max_value'];
$uom_of_seam_strength_in_weft_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_weft_value'];

$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
 $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];



$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'];
$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'];
$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


$ph_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['ph_value_tolerance_range_math_operator'];
$ph_value_tolerance_value= $row_old_pp_version_finishing_process['ph_value_tolerance_value'];
$ph_value_min_value= $row_old_pp_version_finishing_process['ph_value_min_value'];
$ph_value_max_value= $row_old_pp_version_finishing_process['ph_value_max_value'];
$uom_of_ph_value= $row_old_pp_version_finishing_process['uom_of_ph_value'];

$description_or_type_for_water_absorption= $row_old_pp_version_finishing_process['description_or_type_for_water_absorption'];
$water_absorption_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['water_absorption_value_tolerance_range_math_operator'];
$water_absorption_value_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_value_tolerance_value'];
$water_absorption_value_min_value= $row_old_pp_version_finishing_process['water_absorption_value_min_value'];
$water_absorption_value_max_value= $row_old_pp_version_finishing_process['water_absorption_value_max_value'];
$uom_of_water_absorption_value= $row_old_pp_version_finishing_process['uom_of_water_absorption_value'];

$wicking_test_tol_range_math_op= $row_old_pp_version_finishing_process['wicking_test_tol_range_math_op'];
$wicking_test_tolerance_value= $row_old_pp_version_finishing_process['wicking_test_tolerance_value'];
$wicking_test_min_value= $row_old_pp_version_finishing_process['wicking_test_min_value'];
$wicking_test_max_value= $row_old_pp_version_finishing_process['wicking_test_max_value'];
$uom_of_wicking_test= $row_old_pp_version_finishing_process['uom_of_wicking_test'];


$spirality_value_tolerance_range_math_operator= $row_old_pp_version_finishing_process['spirality_value_tolerance_range_math_operator'];
$spirality_value_tolerance_value= $row_old_pp_version_finishing_process['spirality_value_tolerance_value'];
$spirality_value_min_value= $row_old_pp_version_finishing_process['spirality_value_min_value'];
$spirality_value_max_value= $row_old_pp_version_finishing_process['spirality_value_max_value'];
$uom_of_spirality_value= $row_old_pp_version_finishing_process['uom_of_spirality_value'];


$smoothness_appearance_tolerance_range_math_op= $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_range_math_op'];
$smoothness_appearance_tolerance_value= $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_value'];
$smoothness_appearance_min_value= $row_old_pp_version_finishing_process['smoothness_appearance_min_value'];
$smoothness_appearance_max_value= $row_old_pp_version_finishing_process['smoothness_appearance_max_value'];
$uom_of_smoothness_appearance= $row_old_pp_version_finishing_process['uom_of_smoothness_appearance'];


$print_duribility_m_s_c_15_washing_time_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_washing_time_value'];
$print_duribility_m_s_c_15_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_value'];
$uom_of_print_duribility_m_s_c_15= $row_old_pp_version_finishing_process['uom_of_print_duribility_m_s_c_15'];


$description_or_type_for_iron_temperature= $row_old_pp_version_finishing_process['description_or_type_for_iron_temperature'];
$iron_ability_of_woven_fabric_tolerance_range_math_op= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_range_math_op'];
$iron_ability_of_woven_fabric_tolerance_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_value'];
$iron_ability_of_woven_fabric_min_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_min_value'];
$iron_ability_of_woven_fabric_max_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_max_value'];
$uom_of_iron_ability_of_woven_fabric= $row_old_pp_version_finishing_process['uom_of_iron_ability_of_woven_fabric'];

$color_fastess_to_artificial_daylight_blue_wool_scale= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_blue_wool_scale'];
$color_fastess_to_artificial_daylight_tolerance_range_math_op= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'];
$color_fastess_to_artificial_daylight_tolerance_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_value'];
$color_fastess_to_artificial_daylight_min_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_min_value'];
$color_fastess_to_artificial_daylight_max_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_max_value'];
$uom_of_color_fastess_to_artificial_daylight= $row_old_pp_version_finishing_process['uom_of_color_fastess_to_artificial_daylight'];

$test_method_for_moisture_content= $row_old_pp_version_finishing_process['test_method_for_moisture_content'];
$moisture_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['moisture_content_tolerance_range_math_op'];
$moisture_content_tolerance_value= $row_old_pp_version_finishing_process['moisture_content_tolerance_value'];
$moisture_content_min_value= $row_old_pp_version_finishing_process['moisture_content_min_value'];
$moisture_content_max_value= $row_old_pp_version_finishing_process['moisture_content_max_value'];
$uom_of_moisture_content= $row_old_pp_version_finishing_process['uom_of_moisture_content'];


$test_method_for_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['test_method_for_evaporation_rate_quick_drying'];
$evaporation_rate_quick_drying_tolerance_range_math_op= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_range_math_op'];
$evaporation_rate_quick_drying_tolerance_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_value'];
$evaporation_rate_quick_drying_min_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_min_value'];
$evaporation_rate_quick_drying_max_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_max_value'];
$uom_of_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['uom_of_evaporation_rate_quick_drying'];





$percentage_of_total_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_value'];
$percentage_of_total_cotton_content_tolerance_range_math_operator= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_range_math_operator'];
$percentage_of_total_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_value'];
$percentage_of_total_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_min_value'];
$percentage_of_total_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_max_value'];
$uom_of_percentage_of_total_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_cotton_content'];

$percentage_of_total_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_value'];
$percentage_of_total_polyester_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_range_math_op'];
$percentage_of_total_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_value'];
$percentage_of_total_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_min_value'];
$percentage_of_total_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_max_value'];
$uom_of_percentage_of_total_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_polyester_content'];

/*$description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'].",".$row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber_1'];*/
$description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'];
$percentage_of_total_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_value'];
$percentage_of_total_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'];
$percentage_of_total_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_value'];
$percentage_of_total_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_min_value'];
$percentage_of_total_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_max_value'];
$uom_of_percentage_of_total_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_other_fiber_content'];

$percentage_of_warp_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_value'];
$percentage_of_warp_cotton_content_tolerance_range_math_operator= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'];
$percentage_of_warp_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_value'];
$percentage_of_warp_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_min_value'];
$uom_of_percentage_of_warp_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_cotton_content'];

$percentage_of_warp_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_value'];
$percentage_of_warp_polyester_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_range_math_op'];
$percentage_of_warp_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_value'];
$percentage_of_warp_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_min_value'];
$percentage_of_warp_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_max_value'];
$uom_of_percentage_of_warp_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_polyester_content'];

$description_or_type_for_warp_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_warp_other_fiber'];
$percentage_of_warp_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_value'];
$percentage_of_warp_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'];
$percentage_of_warp_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_value'];
$percentage_of_warp_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_min_value'];
$percentage_of_warp_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_max_value'];
$uom_of_percentage_of_warp_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_other_fiber_content'];

$percentage_of_weft_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_value'];
$percentage_of_weft_cotton_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_range_math_op'];
$percentage_of_weft_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_value'];
$percentage_of_weft_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_min_value'];
$percentage_of_weft_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_max_value'];
$uom_of_percentage_of_weft_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_cotton_content'];

$percentage_of_weft_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_value'];
$percentage_of_weft_polyester_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_range_math_op'];
$percentage_of_weft_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_value'];
$percentage_of_weft_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_min_value'];
$percentage_of_weft_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_max_value'];
$uom_of_percentage_of_weft_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_polyester_content'];

$description_or_type_for_weft_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_weft_other_fiber'];
$percentage_of_weft_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_value'];
$percentage_of_weft_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
$percentage_of_weft_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_value'];
$percentage_of_weft_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_min_value'];
$percentage_of_weft_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_max_value'];
$uom_of_percentage_of_weft_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_other_fiber_content'];



$test_method_for_appearance_after_wash_fabric=$row_old_pp_version_finishing_process['test_method_for_appearance_after_wash_fabric'];

$appearance_after_washing_cycle_fabric_wash=$row_old_pp_version_finishing_process['appearance_after_washing_cycle_fabric_wash1'];





$test_method_for_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_color_change'];
$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator'];
$appearance_after_washing_fabric_color_change_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_tolerance_value'];
$uom_of_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_color_change'];
$appearance_after_washing_fabric_color_change_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_min_value'];
$appearance_after_washing_fabric_color_change_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_max_value'];
$test_method_for_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_cross_staining'];
$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator'];
$appearance_after_washing_fabric_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
$uom_of_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_cross_staining'];
$appearance_after_washing_fabric_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_min_value'];
$appearance_after_washing_fabric_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_max_value'];
$test_method_for_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator'];
$appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
$appearance_after_washing_fabric_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_min_value'];
$appearance_after_washing_fabric_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_max_value'];
$test_method_for_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_pilling'];
$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator'];
$appearance_after_washing_fabric_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
$uom_of_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_pilling'];
$appearance_after_washing_fabric_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_min_value'];
$appearance_after_washing_fabric_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_max_value'];
$test_method_for_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_crease_before_ironing'];
$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator'];
$appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
$appearance_after_washing_fabric_crease_before_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_min_value'];
$appearance_after_washing_fabric_crease_before_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_max_value'];
$test_method_for_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_crease_after_ironing'];
$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator'];
$appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
$appearance_after_washing_fabric_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_min_value'];
$appearance_after_washing_fabric_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_max_value'];
$test_method_for_appearance_after_washing_fabric_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_loss_of_print'];
$appearance_after_washing_loss_of_print_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_loss_of_print_fabric'];
$test_method_for_appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
$appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_abrasive_mark'];
$test_method_for_appearance_after_washing_fabric_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_odor'];
$appearance_after_washing_odor_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_odor_fabric'];

$appearance_after_washing_cycle_garments_wash=$row_old_pp_version_finishing_process['appearance_after_washing_cycle_garments_wash1'];

$test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_color_change_without_suppressor'];
$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator'];
$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_without_suppressor_tolerance_value'];
$uom_of_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_color_change_without_suppressor'];
$appearance_after_washing_garments_color_change_without_suppressor_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_without_suppressor_min_value'];
$appearance_after_washing_garments_color_change_without_suppressor_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_without_suppressor_max_value'];
$test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_color_change_with_suppressor'];
$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator'];
$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_with_suppressor_tolerance_value'];
$uom_of_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_color_change_with_suppressor'];
$appearance_after_washing_garments_color_change_with_suppressor_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_with_suppressor_min_value'];
$appearance_after_washing_garments_color_change_with_suppressor_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_color_change_with_suppressor_max_value'];
$test_method_for_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_cross_staining'];
$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_tolerance_range_math_operator'];
$appearance_after_washing_garments_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_tolerance_value'];
$uom_of_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_cross_staining'];
$appearance_after_washing_garments_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_min_value'];
$appearance_after_washing_garments_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_max_value'];
$test_method_for_appearance_after_washing_garments_differential_shrinkage=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_differential_shrinkage'];
$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator'];
$appearance_after_washing_garments__differential_shrinkage_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrinkage_tolerance_value'];
$uom_of_appearance_after_washing_garments__differential_shrinkage=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments__differential_shrinkage'];
$appearance_after_washing_garments__differential_shrinkage_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrinkage_min_value'];
$appearance_after_washing_garments__differential_shrinkage_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrinkage_max_value'];
$test_method_for_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_surface_fuzzing'];
$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator'];
$appearance_after_washing_garments_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_value'];
$uom_of_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_fuzzing'];
$appearance_after_washing_garments_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_min_value'];
$appearance_after_washing_garments_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_max_value'];
$test_method_for_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_surface_pilling'];
$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator'];
$appearance_after_washing_garments_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_tolerance_value'];
$uom_of_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_pilling'];
$appearance_after_washing_garments_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_min_value'];
$appearance_after_washing_garments_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_max_value'];
$test_method_for_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_crease_after_ironing'];
$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator'];
$appearance_after_washing_garments_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_tolerance_value'];
$uom_of_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_crease_after_ironing'];
$appearance_after_washing_garments_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_min_value'];
$appearance_after_washing_garments_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_max_value'];
$test_method_for_appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_abrasive_mark'];
$appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_garments_abrasive_mark'];
$test_method_for_appearance_after_washing_garments_seam_breakdown=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_seam_breakdown'];
$seam_breakdown_garments=$row_old_pp_version_finishing_process['seam_breakdown_garments'];
$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator=$row_old_pp_version_finishing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value'];
$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value'];
$test_method_for_appearance_after_washing_garments_detachment_of_interlining=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_detachment_of_interlining'];
$detachment_of_interlinings_fused_components_garments=$row_old_pp_version_finishing_process['detachment_of_interlinings_fused_components_garments'];
$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance'];
$change_id_handle_or_appearance=$row_old_pp_version_finishing_process['change_id_handle_or_appearance'];
$test_method_for_appearance_after_washing_garments_effect_accessories=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_effect_accessories'];
$effect_on_accessories_such_as_buttons=$row_old_pp_version_finishing_process['effect_on_accessories_such_as_buttons'];
$test_method_for_appearance_after_washing_garments_spirality=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_spirality'];
$appearance_after_washing_garments_spirality_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_min_value'];
$appearance_after_washing_garments_spirality_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_max_value'];
$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons'];
$detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['detachment_or_fraying_of_ribbons'];
$test_method_for_appearance_after_washing_garments_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_loss_of_print'];
$loss_of_print_garments=$row_old_pp_version_finishing_process['loss_of_print_garments'];
$test_method_for_appearance_after_washing_garments_care_level=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_care_level'];
$care_level_garments=$row_old_pp_version_finishing_process['care_level_garments'];
$test_method_for_appearance_after_washing_garments_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_odor'];
$odor_garments=$row_old_pp_version_finishing_process['odor_garments'];



	$insert_sql_statement_for_finishing="INSERT INTO `defining_qc_standard_for_finishing_process`( 
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

        `test_method_for_mass_per_unit_per_area`, 
        `mass_per_unit_per_area_value`, 
        `mass_per_unit_per_area_tolerance_range_math_operator`,
        `mass_per_unit_per_area_tolerance_value`, 
        `mass_per_unit_per_area_min_value`, 
        `mass_per_unit_per_area_max_value`, 
        `uom_of_mass_per_unit_per_area_value`,

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

        `test_method_for_abrasion_resistance_c_change`, 
        `abrasion_resistance_c_change_rubs`, 
        `abrasion_resistance_c_change_value_math_op`, 
        `abrasion_resistance_c_change_value_tolerance_value`,
        `abrasion_resistance_c_change_value_min_value`,
        `abrasion_resistance_c_change_value_max_value`, 
        `uom_of_abrasion_resistance_c_change_value`, 

          `test_method_for_abrasion_resistance_no_of_thread_break`, 
          `abrasion_resistance_no_of_thread_break`, 
          `abrasion_resistance_rubs`, 
          `abrasion_resistance_thread_break`, 

          `test_method_for_mass_loss_in_abrasion_test`, 
          `rubs_for_mass_loss_in_abrasion_test`, 
          `mass_loss_in_abrasion_test_value_tolerance_range_math_operator`, 
          `mass_loss_in_abrasion_test_value_tolerance_value`, 
          `mass_loss_in_abrasion_test_value_min_value`, 
          `mass_loss_in_abrasion_test_value_max_value`, 
          `uom_of_mass_loss_in_abrasion_test_value`, 

          `test_method_formaldehyde_content`, 
          `formaldehyde_content_tolerance_range_math_operator`, 
          `formaldehyde_content_tolerance_value`, 
          `formaldehyde_content_min_value`, 
          `formaldehyde_content_max_value`, 
          `uom_of_formaldehyde_content`, 

          `test_method_for_cf_to_dry_cleaning_color_change`, 
          `cf_to_dry_cleaning_color_change_tolerance_range_math_operator`, 
          `cf_to_dry_cleaning_color_change_tolerance_value`, 
          `cf_to_dry_cleaning_color_change_min_value`, 
          `cf_to_dry_cleaning_color_change_max_value`, 
          `uom_of_cf_to_dry_cleaning_color_change`, 


          `test_method_for_cf_to_dry_cleaning_staining`, 
          `cf_to_dry_cleaning_staining_tolerance_range_math_operator`, 
          `cf_to_dry_cleaning_staining_tolerance_value`, 
          `cf_to_dry_cleaning_staining_min_value`, 
          `cf_to_dry_cleaning_staining_max_value`, 
          `uom_of_cf_to_dry_cleaning_staining`, 


          `test_method_for_cf_to_washing_color_change`, 
          `cf_to_washing_color_change_tolerance_range_math_operator`, 
          `cf_to_washing_color_change_tolerance_value`, 
          `cf_to_washing_color_change_min_value`, 
          `cf_to_washing_color_change_max_value`, 
          `uom_of_cf_to_washing_color_change`, 

          `test_method_for_cf_to_washing_staining`, 
          `cf_to_washing_staining_tolerance_range_math_operator`, 
          `cf_to_washing_staining_tolerance_value`, 
          `cf_to_washing_staining_min_value`, 
          `cf_to_washing_staining_max_value`, 
          `uom_of_cf_to_washing_staining`, 

          `test_method_for_cf_to_washing_cross_staining`, 
          `cf_to_washing_cross_staining_tolerance_range_math_operator`, 
          `cf_to_washing_cross_staining_tolerance_value`, 
          `cf_to_washing_cross_staining_min_value`, 
          `cf_to_washing_cross_staining_max_value`, 
          `uom_of_cf_to_washing_cross_staining`, 

          `test_method_for_water_absorption_b_wash_thirty_sec`, 
          `water_absorption_b_wash_thirty_sec_tolerance_range_math_op`, 
          `water_absorption_b_wash_thirty_sec_tolerance_value`, 
          `water_absorption_b_wash_thirty_sec_min_value`, 
          `water_absorption_b_wash_thirty_sec_max_value`, 
          `uom_of_water_absorption_b_wash_thirty_sec`, 

          `test_method_for_water_absorption_b_wash_max`, 
          `water_absorption_b_wash_max_tolerance_range_math_op`, 
          `water_absorption_b_wash_max_tolerance_value`, 
          `water_absorption_b_wash_max_min_value`, 
          `water_absorption_b_wash_max_max_value`, 
          `uom_of_water_absorption_b_wash_max`, 

          `test_method_for_water_absorption_a_wash_thirty_sec`, 
          `water_absorption_a_wash_thirty_sec_tolerance_range_math_op`, 
          `water_absorption_a_wash_thirty_sec_tolerance_value`, 
          `water_absorption_a_wash_thirty_sec_min_value`, 
          `water_absorption_a_wash_thirty_sec_max_value`, 
          `uom_of_water_absorption_a_wash_thirty_sec`, 

          `test_method_for_perspiration_acid_color_change`, 
          `cf_to_perspiration_acid_color_change_tolerance_range_math_op`, 
          `cf_to_perspiration_acid_color_change_tolerance_value`, 
          `cf_to_perspiration_acid_color_change_min_value`, 
          `cf_to_perspiration_acid_color_change_max_value`, 
          `uom_of_cf_to_perspiration_acid_color_change`, 

          `test_method_for_cf_to_perspiration_acid_staining`, 
          `cf_to_perspiration_acid_staining_tolerance_range_math_operator`, 
          `cf_to_perspiration_acid_staining_value`, 
          `cf_to_perspiration_acid_staining_min_value`, 
          `cf_to_perspiration_acid_staining_max_value`, 
          `uom_of_cf_to_perspiration_acid_staining`, 

          
          `test_method_for_cf_to_perspiration_acid_cross_staining`, 
          `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op`, 
          `cf_to_perspiration_acid_cross_staining_tolerance_value`, 
          `cf_to_perspiration_acid_cross_staining_max_value`, 
          `cf_to_perspiration_acid_cross_staining_min_value`, 
          `uom_of_cf_to_perspiration_acid_cross_staining`, 

          `test_method_for_cf_to_perspiration_alkali_color_change`, 
          `cf_to_perspiration_alkali_color_change_tolerance_range_math_op`, 
          `cf_to_perspiration_alkali_color_change_tolerance_value`, 
          `cf_to_perspiration_alkali_color_change_min_value`, 
          `cf_to_perspiration_alkali_color_change_max_value`, 
          `uom_of_cf_to_perspiration_alkali_color_change`, 

          `test_method_for_cf_to_perspiration_alkali_staining`, 
          `cf_to_perspiration_alkali_staining_tolerance_range_math_op`, 
          `cf_to_perspiration_alkali_staining_tolerance_value`, 
          `cf_to_perspiration_alkali_staining_min_value`, 
          `cf_to_perspiration_alkali_staining_max_value`, 
          `uom_of_cf_to_perspiration_alkali_staining`, 

          `test_method_for_cf_to_perspiration_alkali_cross_staining`, 
          `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op`, 
          `cf_to_perspiration_alkali_cross_staining_tolerance_value`, 
          `cf_to_perspiration_alkali_cross_staining_min_value`, 
          `cf_to_perspiration_alkali_cross_staining_max_value`, 
          `uom_of_cf_to_perspiration_alkali_cross_staining`, 


          `test_method_for_cf_to_water_color_change`, 
          `cf_to_water_color_change_tolerance_range_math_operator`, 
          `cf_to_water_color_change_tolerance_value`, 
          `cf_to_water_color_change_min_value`, 
          `cf_to_water_color_change_max_value`, 
          `uom_of_cf_to_water_color_change`, 

          `test_method_for_cf_to_water_staining`, 
          `cf_to_water_staining_tolerance_range_math_operator`, 
          `cf_to_water_staining_tolerance_value`, 
          `cf_to_water_staining_min_value`, 
          `cf_to_water_staining_max_value`, 
          `uom_of_cf_to_water_staining`, 

          `test_method_for_cf_to_water_cross_staining`, 
          `cf_to_water_cross_staining_tolerance_range_math_operator`, 
          `cf_to_water_cross_staining_tolerance_value`, 
          `cf_to_water_cross_staining_min_value`, 
          `cf_to_water_cross_staining_max_value`, 
          `uom_of_cf_to_water_cross_staining`, 

          `test_method_for_cf_to_water_spotting_surface`, 
          `cf_to_water_spotting_surface_tolerance_range_math_op`, 
          `cf_to_water_spotting_surface_tolerance_value`,
          `cf_to_water_spotting_surface_min_value`, 
          `cf_to_water_spotting_surface_max_value`, 
          `uom_of_cf_to_water_spotting_surface`, 

           `test_method_for_cf_to_water_spotting_edge`, 
           `cf_to_water_spotting_edge_tolerance_range_math_op`, 
           `cf_to_water_spotting_edge_tolerance_value`, 
           `cf_to_water_spotting_edge_min_value`,
           `cf_to_water_spotting_edge_max_value`, 
           `uom_of_cf_to_water_spotting_edge`,

           `test_method_for_cf_to_water_spotting_cross_staining`, 
           `cf_to_water_spotting_cross_staining_tolerance_range_math_op`, 
           `cf_to_water_spotting_cross_staining_tolerance_value`, 
           `cf_to_water_spotting_cross_staining_min_value`, 
           `cf_to_water_spotting_cross_staining_max_value`, 
           `uom_of_cf_to_water_spotting_cross_staining`, 

           `test_method_for_resistance_to_surface_wetting_before_wash`, 
           `resistance_to_surface_wetting_before_wash_tol_range_math_op`, 
           `resistance_to_surface_wetting_before_wash_tolerance_value`, 
           `resistance_to_surface_wetting_before_wash_min_value`, 
           `resistance_to_surface_wetting_before_wash_max_value`, 
           `uom_of_resistance_to_surface_wetting_before_wash`, 

           `test_method_for_resistance_to_surface_wetting_after_one_wash`,
           `resistance_to_surface_wetting_after_one_wash_tol_range_math_op`,
            `resistance_to_surface_wetting_after_one_wash_tolerance_value`,
            `resistance_to_surface_wetting_after_one_wash_min_value`, 
            `resistance_to_surface_wetting_after_one_wash_max_value`, 
            `uom_of_resistance_to_surface_wetting_after_one_wash`,

             `test_method_for_resistance_to_surface_wetting_after_five_wash`, 
             `resistance_to_surface_wetting_after_five_wash_tol_range_math_op`, 
             `resistance_to_surface_wetting_after_five_wash_tolerance_value`,
             `resistance_to_surface_wetting_after_five_wash_min_value`, 
             `resistance_to_surface_wetting_after_five_wash_max_value`, 
             `uom_of_resistance_to_surface_wetting_after_five_wash`, 

              `test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change`, 
              `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op`, 
              `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value`, 
              `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value`, 
              `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value`, 
              `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`, 

              `test_method_for_cf_to_oxidative_bleach_damage_color_change`, 
              `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op`, 
              `cf_to_oxidative_bleach_damage_value`, 
              `cf_to_oxidative_bleach_damage_color_change_tolerance_value`, 
              `cf_to_oxidative_bleach_damage_color_change_min_value`, 
              `cf_to_oxidative_bleach_damage_color_change_max_value`, 
              `uom_of_cf_to_oxidative_bleach_damage_color_change`, 

              `test_method_for_cf_to_phenolic_yellowing_staining`, 
              `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator`, 
              `cf_to_phenolic_yellowing_staining_tolerance_value`, 
              `cf_to_phenolic_yellowing_staining_min_value`, 
              `cf_to_phenolic_yellowing_staining_max_value`, 
              `uom_of_cf_to_phenolic_yellowing_staining`, 

              `test_method_for_cf_to_pvc_migration_staining`, 
              `cf_to_pvc_migration_staining_tolerance_range_math_operator`, 
              `cf_to_pvc_migration_staining_tolerance_value`, 
              `cf_to_pvc_migration_staining_min_value`, 
              `cf_to_pvc_migration_staining_max_value`, 
              `uom_of_cf_to_pvc_migration_staining`, 

              `test_method_for_cf_to_saliva_color_change`, 
              `cf_to_saliva_color_change_tolerance_range_math_operator`, 
              `cf_to_saliva_color_change_tolerance_value`, 
              `cf_to_saliva_color_change_staining_min_value`, 
              `cf_to_saliva_color_change_max_value`, 
              `uom_of_cf_to_saliva_color_change`, 

              `test_method_for_cf_to_saliva_staining`, 
              `cf_to_saliva_staining_tolerance_range_math_operator`, 
              `cf_to_saliva_staining_tolerance_value`, 
              `cf_to_saliva_staining_staining_min_value`, 
              `cf_to_saliva_staining_max_value`, 
              `uom_of_cf_to_saliva_staining`, 


              `test_method_for_cf_to_chlorinated_water_color_change`, 
              `cf_to_chlorinated_water_color_change_tolerance_range_math_op`, 
              `cf_to_chlorinated_water_color_change_tolerance_value`, 
              `cf_to_chlorinated_water_color_change_min_value`, 
              `cf_to_chlorinated_water_color_change_max_value`, 
              `uom_of_cf_to_chlorinated_water_color_change`, 

              `test_method_for_cf_to_cholorine_bleach_color_change`, 
              `cf_to_cholorine_bleach_color_change_tolerance_range_math_op`, 
              `cf_to_cholorine_bleach_color_change_tolerance_value`, 
              `cf_to_cholorine_bleach_color_change_min_value`, 
              `cf_to_cholorine_bleach_color_change_max_value`, 
              `uom_of_cf_to_cholorine_bleach_color_change`, 


              `test_method_for_cf_to_peroxide_bleach_color_change`, 
              `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator`, 
              `cf_to_peroxide_bleach_color_change_tolerance_value`, 
              `cf_to_peroxide_bleach_color_change_min_value`, 
              `cf_to_peroxide_bleach_color_change_max_value`, 
              `uom_of_cf_to_peroxide_bleach_color_change`, 


              `test_method_for_cross_staining`, 
              `cross_staining_tolerance_range_math_operator`, 
              `cross_staining_tolerance_value`, 
              `cross_staining_min_value`, 
              `cross_staining_max_value`, 
              `uom_of_cross_staining`, 

              `description_or_type_for_water_absorption`, 
              `water_absorption_value_tolerance_range_math_operator`,
               `water_absorption_value_tolerance_value`, 
               `water_absorption_value_min_value`, 
               `water_absorption_value_max_value`, 
               `uom_of_water_absorption_value`, 

               `wicking_test_tol_range_math_op`,
               `wicking_test_tolerance_value`, 
               `wicking_test_min_value`, 
               `wicking_test_max_value`, 
               `uom_of_wicking_test`, 

               `spirality_value_tolerance_range_math_operator`,
                `spirality_value_tolerance_value`, 
                `spirality_value_min_value`,
                `spirality_value_max_value`, 
                `uom_of_spirality_value`, 

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


                `test_method_for_seam_slippage_resistance_iso_2_warp`, 
                `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op`, 
                `seam_slippage_resistance_iso_2_in_warp_tolerance_value`, 
                `seam_slippage_resistance_iso_2_in_warp_min_value`, 
                `seam_slippage_resistance_iso_2_in_warp_max_value`, 
                `uom_of_seam_slippage_resistance_iso_2_in_warp`, 
                `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load`, 

                `test_method_for_seam_slippage_resistance_iso_2_weft`, 
                `seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op`, 
                `seam_slippage_resistance_iso_2_in_weft_tolerance_value`, 
                `seam_slippage_resistance_iso_2_in_weft_min_value`, 
                `seam_slippage_resistance_iso_2_in_weft_max_value`, 
                `uom_of_seam_slippage_resistance_iso_2_in_weft`, 

                

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

	            `seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op`,
	            `seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value`, 
	            `seam_properties_seam_strength_iso_astm_d_in_weft_min_value`, 
	            `seam_properties_seam_strength_iso_astm_d_in_weft_max_value`, 
	            `uom_of_seam_properties_seam_strength_iso_astm_d_in_weft`,


                `ph_value_tolerance_range_math_operator`,
                `ph_value_tolerance_value`, 
                `ph_value_min_value`, 
                `ph_value_max_value`, 
                `uom_of_ph_value`, 

                `smoothness_appearance_tolerance_range_math_op`, 
	            `smoothness_appearance_tolerance_value`, 
	            `smoothness_appearance_min_value`, 
	            `smoothness_appearance_max_value`, 
	            `uom_of_smoothness_appearance`, 

	            `print_duribility_m_s_c_15_washing_time_value`, 
		        `print_duribility_m_s_c_15_value`, 
		        `uom_of_print_duribility_m_s_c_15`, 


	            `description_or_type_for_iron_temperature`, 
	            `iron_ability_of_woven_fabric_tolerance_range_math_op`, 
	            `iron_ability_of_woven_fabric_tolerance_value`, 
	            `iron_ability_of_woven_fabric_min_value`, 
	            `iron_ability_of_woven_fabric_max_value`, 
	            `uom_of_iron_ability_of_woven_fabric`, 

	            `color_fastess_to_artificial_daylight_blue_wool_scale`, 
	            `color_fastess_to_artificial_daylight_tolerance_range_math_op`, 
	            `color_fastess_to_artificial_daylight_tolerance_value`, 
	            `color_fastess_to_artificial_daylight_min_value`, 
	            `color_fastess_to_artificial_daylight_max_value`, 
	            `uom_of_color_fastess_to_artificial_daylight`,

	             `test_method_for_moisture_content`, 
	             `moisture_content_tolerance_range_math_op`, 
		         `moisture_content_tolerance_value`, 
		         `moisture_content_min_value`, 
		         `moisture_content_max_value`, 
		         `uom_of_moisture_content`, 

		         `test_method_for_evaporation_rate_quick_drying`, 
		         `evaporation_rate_quick_drying_tolerance_range_math_op`, 
		         `evaporation_rate_quick_drying_tolerance_value`, 
		         `evaporation_rate_quick_drying_min_value`, 
		         `evaporation_rate_quick_drying_max_value`, 
		         `uom_of_evaporation_rate_quick_drying`, 

		         `percentage_of_total_cotton_content_value`, 
		         `percentage_of_total_cotton_content_tolerance_range_math_operator`, 
		         `percentage_of_total_cotton_content_tolerance_value`, 
		         `percentage_of_total_cotton_content_min_value`, 
		         `percentage_of_total_cotton_content_max_value`, 
		         `uom_of_percentage_of_total_cotton_content`,

		         `percentage_of_total_polyester_content_value`, 
		         `percentage_of_total_polyester_content_tolerance_range_math_op`, 
		         `percentage_of_total_polyester_content_tolerance_value`, 
		         `percentage_of_total_polyester_content_min_value`, 
		         `percentage_of_total_polyester_content_max_value`, 
		         `uom_of_percentage_of_total_polyester_content`, 

		         `description_or_type_for_total_other_fiber`, 
		         `percentage_of_total_other_fiber_content_value`, 
		         `percentage_of_total_other_fiber_content_tolerance_range_math_op`, 
		         `percentage_of_total_other_fiber_content_tolerance_value`, 
		         `percentage_of_total_other_fiber_content_min_value`, 
		         `percentage_of_total_other_fiber_content_max_value`, 
		         `uom_of_percentage_of_total_other_fiber_content`, 

		         `percentage_of_warp_cotton_content_value`, 
		         `percentage_of_warp_cotton_content_tolerance_range_math_operator`, 
		         `percentage_of_warp_cotton_content_tolerance_value`, 
		         `percentage_of_warp_cotton_content_min_value`, 
		         `uom_of_percentage_of_warp_cotton_content`, 

		         `percentage_of_warp_polyester_content_value`, 
		         `percentage_of_warp_polyester_content_tolerance_range_math_op`, 
		         `percentage_of_warp_polyester_content_tolerance_value`, 
		         `percentage_of_warp_polyester_content_min_value`, 
		         `percentage_of_warp_polyester_content_max_value`, 
		         `uom_of_percentage_of_warp_polyester_content`, 

		         `description_or_type_for_warp_other_fiber`, 
		         `percentage_of_warp_other_fiber_content_value`, 
		         `percentage_of_warp_other_fiber_content_tolerance_range_math_op`, 
		         `percentage_of_warp_other_fiber_content_tolerance_value`, 
		         `percentage_of_warp_other_fiber_content_min_value`, 
		         `percentage_of_warp_other_fiber_content_max_value`, 
		         `uom_of_percentage_of_warp_other_fiber_content`, 

		         `percentage_of_weft_cotton_content_value`, 
		         `percentage_of_weft_cotton_content_tolerance_range_math_op`, 
		         `percentage_of_weft_cotton_content_tolerance_value`, 
		         `percentage_of_weft_cotton_content_min_value`, 
		         `percentage_of_weft_cotton_content_max_value`, 
		         `uom_of_percentage_of_weft_cotton_content`, 

		         `percentage_of_weft_polyester_content_value`, 
		         `percentage_of_weft_polyester_content_tolerance_range_math_op`, 
		         `percentage_of_weft_polyester_content_tolerance_value`, 
		         `percentage_of_weft_polyester_content_min_value`, 
		         `percentage_of_weft_polyester_content_max_value`, 
		         `uom_of_percentage_of_weft_polyester_content`, 

		         `description_or_type_for_weft_other_fiber`, 
		         `percentage_of_weft_other_fiber_content_value`, 
		         `percentage_of_weft_other_fiber_content_tolerance_range_math_op`, 
		         `percentage_of_weft_other_fiber_content_tolerance_value`, 
		         `percentage_of_weft_other_fiber_content_min_value`, 
		         `percentage_of_weft_other_fiber_content_max_value`, 
		         `uom_of_percentage_of_weft_other_fiber_content`,

	              test_method_for_appearance_after_wash_fabric,
      appearance_after_washing_cycle_fabric_wash1,
      
      test_method_for_appearance_after_washing_fabric_color_change,
      appearance_after_washing_fabric_color_change_math_op,
      appearance_after_washing_fabric_color_change_tolerance_value,
      uom_of_appearance_after_washing_fabric_color_change,
      appearance_after_washing_fabric_color_change_min_value,
      appearance_after_washing_fabric_color_change_max_value,
      
      test_method_for_appearance_after_washing_fabric_cross_staining,
      appearance_after_washing_fabric_cross_staining_math_op,
      appearance_after_washing_fabric_cross_staining_tolerance_value,
      uom_of_appearance_after_washing_fabric_cross_staining,
      appearance_after_washing_fabric_cross_staining_min_value,
      appearance_after_washing_fabric_cross_staining_max_value,

      test_method_for_appearance_after_washing_fabric_surface_fuzzing,
      appearance_after_washing_fabric_surface_fuzzing_math_op,
      appearance_after_washing_fabric_surface_fuzzing_tolerance_value,
      uom_of_appearance_after_washing_fabric_surface_fuzzing,
      appearance_after_washing_fabric_surface_fuzzing_min_value,
      appearance_after_washing_fabric_surface_fuzzing_max_value,

      test_method_for_appearance_after_washing_fabric_surface_pilling,
      appearance_after_washing_fabric_surface_pilling_math_op,
      appearance_after_washing_fabric_surface_pilling_tolerance_value,
      uom_of_appearance_after_washing_fabric_surface_pilling,
      appearance_after_washing_fabric_surface_pilling_min_value,
      appearance_after_washing_fabric_surface_pilling_max_value,

      test_method_for_appear_after_washing_fabric_crease_before_iron,
      appearance_after_washing_fabric_crease_before_iron_math_op,
      appearance_after_washing_fabric_crease_before_iron_tolerance_val,
      uom_of_appearance_after_washing_fabric_crease_before_ironing,
      appearance_after_washing_fabric_crease_before_ironing_min_value,
      appearance_after_washing_fabric_crease_before_ironing_max_value,

      test_method_for_appear_after_washing_fabric_crease_after_ironing,
      appearance_after_washing_fabric_crease_after_iron_math_op,
      appearance_after_washing_fabric_crease_after_iron_tolerance_val,
      uom_of_appearance_after_washing_fabric_crease_after_ironing,
      appearance_after_washing_fabric_crease_after_ironing_min_value,
      appearance_after_washing_fabric_crease_after_ironing_max_value,

      test_method_for_appearance_after_washing_fabric_loss_of_print,
      appearance_after_washing_loss_of_print_fabric,

      test_method_for_appearance_after_washing_fabric_abrasive_mark,
      appearance_after_washing_fabric_abrasive_mark,

      test_method_for_appearance_after_washing_fabric_odor,
      appearance_after_washing_odor_fabric,
     
      appearance_after_washing_cycle_garments_wash1,
      test_method_for_appear_wash_garments_color_change_without_sup,
      appear_after_washing_garments_color_change_without_sup_math_op,
      appear_after_washing_garments_color_change_without_sup_toler_val,
      uom_of_appear_after_washing_garments_color_change_without_sup,
      appear_after_washing_garments_color_change_without_sup_min_value,
      appear_after_washing_garments_color_change_without_sup_max_val,

      test_method_for_appear_after_wash_garments_color_change_with_sup,
      appear_after_washing_garments_color_change_with_sup_math_op,
      appear_after_washing_garments_color_change_with_sup_toler_value,
      uom_of_appear_after_washing_garments_color_change_with_sup,
      appear_after_washing_garments_color_change_with_sup_min_value,
      appear_after_washing_garments_color_change_with_sup_max_value,

      test_method_for_appear_after_washing_garments_cross_staining,
      appear_after_washing_garments_cross_staining_math_op,
      appear_after_washing_garments_cross_staining_tolerance_value,
      uom_of_appearance_after_washing_garments_cross_staining,
      appearance_after_washing_garments_cross_staining_min_value,
      appearance_after_washing_garments_cross_staining_max_value,

      test_method_for_appear_after_washing_garments_differential_shrin,
      appear_after_washing_garments_differential_shrink_math_op,
      appear_after_washing_garments__differential_shrink_tolerance_val,
      uom_of_appearance_after_washing_garments__differential_shrinkage,
      appearance_after_washing_garments__differential_shrink_min_value,
      appearance_after_washing_garments__differential_shrink_max_value,

      test_method_for_appear_after_washing_garments_surface_fuzzing,
      appear_after_washing_garments_surface_fuzzing_math_op,
      appearance_after_washing_garments_surface_fuzzing_tolerance_val,
      uom_of_appearance_after_washing_garments_surface_fuzzing,
      appearance_after_washing_garments_surface_fuzzing_min_value,
      appearance_after_washing_garments_surface_fuzzing_max_value,

      test_method_for_appear_after_washing_garments_surface_pilling,
      appear_after_washing_garments_surface_pilling_math_op,
      appearance_after_washing_garments_surface_pilling_tolerance_val,
      uom_of_appearance_after_washing_garments_surface_pilling,
      appearance_after_washing_garments_surface_pilling_min_value,
      appearance_after_washing_garments_surface_pilling_max_value,

      test_method_for_appear_after_washing_garments_crease_after_iron,
      appear_after_washing_garments_crease_after_ironing_math_op,
      appear_after_washing_garments_crease_after_ironing_tolerance_val,
      uom_of_appear_after_washing_garments_crease_after_ironing,
      appearance_after_washing_garments_crease_after_ironing_min_value,
      appearance_after_washing_garments_crease_after_ironing_max_value,

      test_method_for_appearance_after_washing_garments_abrasive_mark,
      appearance_after_washing_garments_abrasive_mark,

      test_method_for_appearance_after_washing_garments_seam_breakdown,
      seam_breakdown_garments,

      test_method_for_apear_after_wash_garments_seam_pucker_after_iron,
      appear_after_wash_garments_seam_pucker_rop_iron_math_op,
      appear_after_washing_garments_seam_pucker_rop_iron_toler_value,
      uom_of_appear_after_washing_garments_seam_pucker_rop_rion,
      appear_after_washing_garments_seam_pucker_rop_iron_min_value,
      appear_after_washing_garments_seam_pucker_rop_iron_max_value,

      test_method_for_appear_after_washing_garments_detachment_inter,
      detachment_of_interlinings_fused_components_garments,

      test_method_for_appear_after_washing_garments_change_in_handle,
      change_id_handle_or_appearance,

      test_method_for_appearance_after_washing_garments_effect_access,
      effect_on_accessories_such_as_buttons,

      test_method_for_appearance_after_washing_garments_spirality,
      appearance_after_washing_garments_spirality_min_value,
      appearance_after_washing_garments_spirality_max_value,

      test_method_for_appear_after_washing_garments_detachment_fraying,
      detachment_or_fraying_of_ribbons,

      test_method_for_appearance_after_washing_garments_loss_of_print,
      loss_of_print_garments,

      test_method_for_appearance_after_washing_garments_care_level,
      care_level_garments,

      test_method_for_appearance_after_washing_garments_odor,
      odor_garments,

                `recording_person_id`, 
                `recording_person_name`, 
                `recording_time`) 
	        VALUES 
	        (
	         '$pp_number',
	         '$version_id',
	         '$version_name',
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

	          '$test_method_for_mass_per_unit_per_area',
	          '$mass_per_unit_per_area_value',
	          '$mass_per_unit_per_area_tolerance_range_math_operator',
	          '$mass_per_unit_per_area_tolerance_value',
	          '$mass_per_unit_per_area_min_value',
	          '$mass_per_unit_per_area_max_value',
	          '$uom_of_mass_per_unit_per_area_value',


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

	           '$test_method_for_abrasion_resistance_c_change',
	           '$abrasion_resistance_c_change_rubs',
	           '$abrasion_resistance_c_change_value_math_op',
	           '$abrasion_resistance_c_change_value_tolerance_value',
	           '$abrasion_resistance_c_change_value_min_value',
	           '$abrasion_resistance_c_change_value_max_value',
	           '$uom_of_abrasion_resistance_c_change_value',

	           '$test_method_for_abrasion_resistance_no_of_thread_break',
	           '$abrasion_resistance_no_of_thread_break',
	           '$abrasion_resistance_rubs',
	           '$abrasion_resistance_thread_break',

	           '$test_method_for_mass_loss_in_abrasion_test',
	           '$rubs_for_mass_loss_in_abrasion_test',
	           '$mass_loss_in_abrasion_test_value_tolerance_range_math_operator',
	           '$mass_loss_in_abrasion_test_value_tolerance_value',
	           '$mass_loss_in_abrasion_test_value_min_value',
	           '$mass_loss_in_abrasion_test_value_max_value',
	           '$uom_of_mass_loss_in_abrasion_test_value',

	           '$test_method_formaldehyde_content',
	           '$formaldehyde_content_tolerance_range_math_operator',
	           '$formaldehyde_content_tolerance_value',
	           '$formaldehyde_content_min_value',
	           '$formaldehyde_content_max_value',
	           '$uom_of_formaldehyde_content',

	           '$test_method_for_cf_to_dry_cleaning_color_change',
	           '$cf_to_dry_cleaning_color_change_tolerance_range_math_operator',
	           '$cf_to_dry_cleaning_color_change_tolerance_value',
	           '$cf_to_dry_cleaning_color_change_min_value',
	           '$cf_to_dry_cleaning_color_change_max_value',
	           '$uom_of_cf_to_dry_cleaning_color_change',

	           '$test_method_for_cf_to_dry_cleaning_staining',
	           '$cf_to_dry_cleaning_staining_tolerance_range_math_operator',
	           '$cf_to_dry_cleaning_staining_tolerance_value',
	           '$cf_to_dry_cleaning_staining_min_value',
	           '$cf_to_dry_cleaning_staining_max_value',
	           '$uom_of_cf_to_dry_cleaning_staining',

	           '$test_method_for_cf_to_washing_color_change',
	           '$cf_to_washing_color_change_tolerance_range_math_operator',
	           '$cf_to_washing_color_change_tolerance_value',
	           '$cf_to_washing_color_change_min_value',
	           '$cf_to_washing_color_change_max_value',
	           '$uom_of_cf_to_washing_color_change',

	           '$test_method_for_cf_to_washing_staining',
	           '$cf_to_washing_staining_tolerance_range_math_operator',
	           '$cf_to_washing_staining_tolerance_value',
	           '$cf_to_washing_staining_tolerance_value',
	           '$cf_to_washing_staining_max_value',
	           '$uom_of_cf_to_washing_staining',

	           '$test_method_for_cf_to_washing_cross_staining',
	           '$cf_to_washing_cross_staining_tolerance_range_math_operator',
	           '$cf_to_washing_cross_staining_tolerance_value',
	           '$cf_to_washing_cross_staining_min_value',
	           '$cf_to_washing_cross_staining_max_value',
	           '$uom_of_cf_to_washing_cross_staining',

	           '$test_method_for_water_absorption_b_wash_thirty_sec',
	           '$water_absorption_b_wash_thirty_sec_tolerance_range_math_op',
	           '$water_absorption_b_wash_thirty_sec_tolerance_value',
	           '$water_absorption_b_wash_thirty_sec_min_value',
	           '$water_absorption_b_wash_thirty_sec_max_value',
	           '$uom_of_water_absorption_b_wash_thirty_sec',

	           '$test_method_for_water_absorption_b_wash_max',
	           '$water_absorption_b_wash_max_tolerance_range_math_op',
	           '$water_absorption_b_wash_max_tolerance_value',
	           '$water_absorption_b_wash_max_min_value',
	           '$water_absorption_b_wash_max_max_value',
	           '$uom_of_water_absorption_b_wash_max',

	           '$test_method_for_water_absorption_a_wash_thirty_sec',
	           '$water_absorption_a_wash_thirty_sec_tolerance_range_math_op',
	           '$water_absorption_a_wash_thirty_sec_tolerance_value',
	           '$water_absorption_a_wash_thirty_sec_min_value',
	           '$water_absorption_a_wash_thirty_sec_max_value',
	           '$uom_of_water_absorption_a_wash_thirty_sec',

	           '$test_method_for_perspiration_acid_color_change',
	           '$cf_to_perspiration_acid_color_change_tolerance_range_math_op',
	           '$cf_to_perspiration_acid_color_change_tolerance_value',
	           '$cf_to_perspiration_acid_color_change_min_value',
	           '$cf_to_perspiration_acid_color_change_max_value',
	           '$uom_of_cf_to_perspiration_acid_color_change',

	           '$test_method_for_cf_to_perspiration_acid_staining',
	           '$cf_to_perspiration_acid_staining_tolerance_range_math_operator',
	           '$cf_to_perspiration_acid_staining_value',
	           '$cf_to_perspiration_acid_staining_min_value',
	           '$cf_to_perspiration_acid_staining_max_value',
	           '$uom_of_cf_to_perspiration_acid_staining',

	           '$test_method_for_cf_to_perspiration_acid_cross_staining',
	           '$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op',
	           '$cf_to_perspiration_acid_cross_staining_tolerance_value',
	           '$cf_to_perspiration_acid_cross_staining_min_value',
	           '$cf_to_perspiration_acid_cross_staining_max_value',
	           '$uom_of_cf_to_perspiration_acid_cross_staining',

	           '$test_method_for_cf_to_perspiration_alkali_color_change',
	           '$cf_to_perspiration_alkali_color_change_tolerance_range_math_op',
	           '$cf_to_perspiration_alkali_color_change_tolerance_value',
	           '$cf_to_perspiration_alkali_color_change_min_value',
	           '$cf_to_perspiration_alkali_color_change_max_value',
	           '$uom_of_cf_to_perspiration_alkali_color_change',

	           '$test_method_for_cf_to_perspiration_alkali_staining',
	           '$cf_to_perspiration_alkali_staining_tolerance_range_math_op',
	           '$cf_to_perspiration_alkali_staining_tolerance_value',
	           '$cf_to_perspiration_alkali_staining_min_value',
	           '$cf_to_perspiration_alkali_staining_max_value',
	           '$uom_of_cf_to_perspiration_alkali_staining',

	           '$test_method_for_cf_to_perspiration_alkali_cross_staining',
	           '$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op',
	           '$cf_to_perspiration_alkali_cross_staining_tolerance_value',
	           '$cf_to_perspiration_alkali_cross_staining_min_value',
	           '$cf_to_perspiration_alkali_cross_staining_max_value',
	           '$uom_of_cf_to_perspiration_alkali_cross_staining',

	           '$test_method_for_cf_to_water_color_change',
	           '$cf_to_water_color_change_tolerance_range_math_operator',
	           '$cf_to_water_color_change_tolerance_value',
	           '$cf_to_water_color_change_min_value',
	           '$cf_to_water_color_change_max_value',
	           '$uom_of_cf_to_water_color_change',

	           '$test_method_for_cf_to_water_staining',
	           '$cf_to_water_staining_tolerance_range_math_operator',
	           '$cf_to_water_staining_tolerance_value',
	           '$cf_to_water_staining_min_value',
	           '$cf_to_water_staining_max_value',
	           '$uom_of_cf_to_water_staining',

	           '$test_method_for_cf_to_water_cross_staining',
	           '$cf_to_water_cross_staining_tolerance_range_math_operator',
	           '$cf_to_water_cross_staining_tolerance_value',
	           '$cf_to_water_cross_staining_min_value',
	           '$cf_to_water_cross_staining_max_value',
	           '$uom_of_cf_to_water_cross_staining',

	           '$test_method_for_cf_to_water_spotting_surface',
	           '$cf_to_water_spotting_surface_tolerance_range_math_op',
	           '$cf_to_water_spotting_surface_tolerance_value',
	           '$cf_to_water_spotting_surface_min_value',
	           '$cf_to_water_spotting_surface_max_value',
	           '$uom_of_cf_to_water_spotting_surface',

	           '$test_method_for_cf_to_water_spotting_edge',
	           '$cf_to_water_spotting_edge_tolerance_range_math_op',
	           '$cf_to_water_spotting_edge_tolerance_value',
	           '$cf_to_water_spotting_edge_min_value',
	           '$cf_to_water_spotting_edge_max_value',
	           '$uom_of_cf_to_water_spotting_edge',

	           '$test_method_for_cf_to_water_spotting_cross_staining',
	           '$cf_to_water_spotting_cross_staining_tolerance_range_math_op',
	           '$cf_to_water_spotting_cross_staining_tolerance_value',
	           '$cf_to_water_spotting_cross_staining_min_value',
	           '$cf_to_water_spotting_cross_staining_max_value',
	           '$uom_of_cf_to_water_spotting_cross_staining',


	           '$test_method_for_resistance_to_surface_wetting_before_wash',
	           '$resistance_to_surface_wetting_before_wash_tol_range_math_op',
	           '$resistance_to_surface_wetting_before_wash_tolerance_value',
	           '$resistance_to_surface_wetting_before_wash_min_value',
	           '$resistance_to_surface_wetting_before_wash_max_value',
	           '$uom_of_resistance_to_surface_wetting_before_wash',

	           '$test_method_for_resistance_to_surface_wetting_after_one_wash',
	           '$resistance_to_surface_wetting_after_one_wash_tol_range_math_op',
	           '$resistance_to_surface_wetting_after_one_wash_tolerance_value',
	           '$resistance_to_surface_wetting_after_one_wash_min_value',
	           '$resistance_to_surface_wetting_after_one_wash_max_value',
	           '$uom_of_resistance_to_surface_wetting_after_one_wash',

	           '$test_method_for_resistance_to_surface_wetting_after_five_wash',
	           '$resistance_to_surface_wetting_after_five_wash_tol_range_math_op',
	           '$resistance_to_surface_wetting_after_five_wash_tolerance_value',
	           '$resistance_to_surface_wetting_after_five_wash_min_value',
	           '$resistance_to_surface_wetting_after_five_wash_max_value',
	           '$uom_of_resistance_to_surface_wetting_after_five_wash',

	           '$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change',
	           '$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op',
	           '$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value',
	           '$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value',
	           '$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value',
	           '$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change',

	           '$test_method_for_cf_to_oxidative_bleach_damage_color_change',
	           '$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op',
	           '$cf_to_oxidative_bleach_damage_value',
	           '$cf_to_oxidative_bleach_damage_color_change_tolerance_value',
	           '$cf_to_oxidative_bleach_damage_color_change_min_value',
	           '$cf_to_oxidative_bleach_damage_color_change_max_value',
	           '$uom_of_cf_to_oxidative_bleach_damage_color_change',

	           '$test_method_for_cf_to_phenolic_yellowing_staining',
	           '$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator',
	           '$cf_to_phenolic_yellowing_staining_tolerance_value',
	           '$cf_to_phenolic_yellowing_staining_min_value',
	           '$cf_to_phenolic_yellowing_staining_max_value',
	           '$uom_of_cf_to_phenolic_yellowing_staining',

	           '$test_method_for_cf_to_pvc_migration_staining',
	           '$cf_to_pvc_migration_staining_tolerance_range_math_operator',
	           '$cf_to_pvc_migration_staining_tolerance_value',
	           '$cf_to_pvc_migration_staining_min_value',
	           '$cf_to_pvc_migration_staining_max_value',
	           '$uom_of_cf_to_pvc_migration_staining',

	           '$test_method_for_cf_to_saliva_color_change',
	           '$cf_to_saliva_color_change_tolerance_range_math_operator',
	           '$cf_to_saliva_color_change_tolerance_value',
	           '$cf_to_saliva_color_change_staining_min_value',
	           '$cf_to_saliva_color_change_max_value',
	           '$uom_of_cf_to_saliva_color_change',

	           '$test_method_for_cf_to_saliva_staining',
	           '$cf_to_saliva_staining_tolerance_range_math_operator',
	           '$cf_to_saliva_staining_tolerance_value',
	           '$cf_to_saliva_staining_staining_min_value',
	           '$cf_to_saliva_staining_max_value',
	           '$uom_of_cf_to_saliva_staining',

	           '$test_method_for_cf_to_chlorinated_water_color_change',
	           '$cf_to_chlorinated_water_color_change_tolerance_range_math_op',
	           '$cf_to_chlorinated_water_color_change_tolerance_value',
	           '$cf_to_chlorinated_water_color_change_min_value',
	           '$cf_to_chlorinated_water_color_change_max_value',
	           '$uom_of_cf_to_chlorinated_water_color_change',

	           '$test_method_for_cf_to_cholorine_bleach_color_change',
	           '$cf_to_cholorine_bleach_color_change_tolerance_range_math_op',
	           '$cf_to_cholorine_bleach_color_change_tolerance_value',
	           '$cf_to_cholorine_bleach_color_change_min_value',
	           '$cf_to_cholorine_bleach_color_change_max_value',
	           '$uom_of_cf_to_cholorine_bleach_color_change',

	           '$test_method_for_cf_to_peroxide_bleach_color_change',
	           '$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator',
	           '$cf_to_peroxide_bleach_color_change_tolerance_value',
	           '$cf_to_peroxide_bleach_color_change_min_value',
	           '$cf_to_peroxide_bleach_color_change_max_value',
	           '$uom_of_cf_to_peroxide_bleach_color_change',

	           

	           '$test_method_for_cross_staining',
	           '$cross_staining_tolerance_range_math_operator',
	           '$cross_staining_tolerance_value',
	           '$cross_staining_min_value',
	           '$cross_staining_max_value',
	           '$uom_of_cross_staining',


	           '$description_or_type_for_water_absorption',
	           '$water_absorption_value_tolerance_range_math_operator',
	           '$water_absorption_value_tolerance_value',
	           '$water_absorption_value_min_value',
	           '$water_absorption_value_max_value',
	           '$uom_of_water_absorption_value',

	           '$wicking_test_tol_range_math_op',
	           '$wicking_test_tolerance_value',
	           '$wicking_test_min_value',
	           '$wicking_test_max_value',
	           '$uom_of_wicking_test',

	           '$spirality_value_tolerance_range_math_operator',
	           '$spirality_value_tolerance_value',
	           '$spirality_value_min_value',
	           '$spirality_value_max_value',
	           '$uom_of_spirality_value',

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

	           '$test_method_for_seam_slippage_resistance_iso_2_weft',
	           '$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op',
	            '$seam_slippage_resistance_iso_2_in_weft_tolerance_value',
	            '$seam_slippage_resistance_iso_2_in_weft_min_value',
	            '$seam_slippage_resistance_iso_2_in_weft_max_value',
	            '$uom_of_seam_slippage_resistance_iso_2_in_weft',

	           '$test_method_for_seam_slippage_resistance_iso_2_warp',
	           '$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op',
	           '$seam_slippage_resistance_iso_2_in_warp_tolerance_value',
	           '$seam_slippage_resistance_iso_2_in_warp_min_value',
	           '$seam_slippage_resistance_iso_2_in_warp_max_value',
	           '$uom_of_seam_slippage_resistance_iso_2_in_warp',
	           '$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load',

	           
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

             '$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op',
             '$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value',
             '$seam_properties_seam_strength_iso_astm_d_in_weft_min_value',
             '$seam_properties_seam_strength_iso_astm_d_in_weft_max_value',
             '$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft',

	           '$ph_value_tolerance_range_math_operator',
	           '$ph_value_tolerance_value',
	           '$ph_value_min_value',
	           '$ph_value_max_value',
	           '$uom_of_ph_value',

	           '$smoothness_appearance_tolerance_range_math_op',
	           '$smoothness_appearance_tolerance_value',
	           '$smoothness_appearance_min_value',
	           '$smoothness_appearance_max_value',
	           '$uom_of_smoothness_appearance',



	           '$print_duribility_m_s_c_15_washing_time_value',
	           '$print_duribility_m_s_c_15_value',
	           '$uom_of_print_duribility_m_s_c_15',
                
               '$description_or_type_for_iron_temperature',
	           '$iron_ability_of_woven_fabric_tolerance_range_math_op',
	           '$iron_ability_of_woven_fabric_tolerance_value',
	           '$iron_ability_of_woven_fabric_min_value',
	           '$iron_ability_of_woven_fabric_max_value',
	           '$uom_of_iron_ability_of_woven_fabric',

	           '$color_fastess_to_artificial_daylight_blue_wool_scale',
	           '$color_fastess_to_artificial_daylight_tolerance_range_math_op',
	           '$color_fastess_to_artificial_daylight_tolerance_value',
	           '$color_fastess_to_artificial_daylight_min_value',
	           '$color_fastess_to_artificial_daylight_max_value',
	           '$uom_of_color_fastess_to_artificial_daylight',

	           '$test_method_for_moisture_content',
	           '$moisture_content_tolerance_range_math_op',
	           '$moisture_content_tolerance_value',
	           '$moisture_content_min_value',
	           '$moisture_content_max_value',
	           '$uom_of_moisture_content',

	           '$test_method_for_evaporation_rate_quick_drying',
	           '$evaporation_rate_quick_drying_tolerance_range_math_op',
	           '$evaporation_rate_quick_drying_tolerance_value',
	           '$evaporation_rate_quick_drying_min_value',
	           '$evaporation_rate_quick_drying_max_value',
	           '$uom_of_evaporation_rate_quick_drying',


	           '$percentage_of_total_cotton_content_value',
	           '$percentage_of_total_cotton_content_tolerance_range_math_operator',
	           '$percentage_of_total_cotton_content_tolerance_value',
	           '$percentage_of_total_cotton_content_min_value',
	           '$percentage_of_total_cotton_content_max_value',
	           '$uom_of_percentage_of_total_cotton_content',

	           '$percentage_of_total_polyester_content_value',
	           '$percentage_of_total_polyester_content_tolerance_range_math_op',
	           '$percentage_of_total_polyester_content_tolerance_value',
	           '$percentage_of_total_polyester_content_min_value',
	           '$percentage_of_total_polyester_content_max_value',
	           '$uom_of_percentage_of_total_polyester_content',

	           '$description_or_type_for_total_other_fiber',
	           '$percentage_of_total_other_fiber_content_value',
	           '$percentage_of_total_other_fiber_content_tolerance_range_math_op',
	           '$percentage_of_total_other_fiber_content_tolerance_value',
	           '$percentage_of_total_other_fiber_content_min_value',
	           '$percentage_of_total_other_fiber_content_max_value',
	           '$uom_of_percentage_of_total_other_fiber_content',

	           '$percentage_of_warp_cotton_content_value',
	           '$percentage_of_warp_cotton_content_tolerance_range_math_operator',
	           '$percentage_of_warp_cotton_content_tolerance_value',
	           '$percentage_of_warp_cotton_content_min_value',
	           '$uom_of_percentage_of_warp_cotton_content',

	           '$percentage_of_warp_polyester_content_value',
	           '$percentage_of_warp_polyester_content_tolerance_range_math_op',
	           '$percentage_of_warp_polyester_content_tolerance_value',
	           '$percentage_of_warp_polyester_content_min_value',
	           '$percentage_of_warp_polyester_content_max_value',
	           '$uom_of_percentage_of_warp_polyester_content',

	           '$description_or_type_for_warp_other_fiber',
	           '$percentage_of_warp_other_fiber_content_value',
	           '$percentage_of_warp_other_fiber_content_tolerance_range_math_op',
	           '$percentage_of_warp_other_fiber_content_tolerance_value',
	           '$percentage_of_warp_other_fiber_content_min_value',
	           '$percentage_of_warp_other_fiber_content_max_value',
	           '$uom_of_percentage_of_warp_other_fiber_content',

	           '$percentage_of_weft_cotton_content_value',
	           '$percentage_of_weft_cotton_content_tolerance_range_math_op',
	           '$percentage_of_weft_cotton_content_tolerance_value',
	           '$percentage_of_weft_cotton_content_min_value',
	           '$percentage_of_weft_cotton_content_max_value',
	           '$uom_of_percentage_of_weft_cotton_content',

	           '$percentage_of_weft_polyester_content_value','
	           $percentage_of_weft_polyester_content_tolerance_range_math_op',
	           '$percentage_of_weft_polyester_content_tolerance_value',
	           '$percentage_of_weft_polyester_content_min_value',
	           '$percentage_of_weft_polyester_content_max_value',
	           '$uom_of_percentage_of_weft_polyester_content',

	           '$description_or_type_for_weft_other_fiber',
	           '$percentage_of_weft_other_fiber_content_value',
	           '$percentage_of_weft_other_fiber_content_tolerance_range_math_op',
	           '$percentage_of_weft_other_fiber_content_tolerance_value',
	           '$percentage_of_weft_other_fiber_content_min_value',
	           '$percentage_of_weft_other_fiber_content_max_value',
	           '$uom_of_percentage_of_weft_other_fiber_content',
                 
          '$test_method_for_appearance_after_wash_fabric',
          '$appearance_after_washing_cycle_fabric_wash',

          '$test_method_for_appearance_after_washing_fabric_color_change',
          '$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_color_change_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_color_change',
          '$appearance_after_washing_fabric_color_change_min_value',
          '$appearance_after_washing_fabric_color_change_max_value',

          '$test_method_for_appearance_after_washing_fabric_cross_staining',
          '$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_cross_staining_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_cross_staining',
          '$appearance_after_washing_fabric_cross_staining_min_value',
          '$appearance_after_washing_fabric_cross_staining_max_value',

          '$test_method_for_appearance_after_washing_fabric_surface_fuzzing',
          '$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_surface_fuzzing_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_surface_fuzzing',
          '$appearance_after_washing_fabric_surface_fuzzing_min_value',
          '$appearance_after_washing_fabric_surface_fuzzing_max_value',

          '$test_method_for_appearance_after_washing_fabric_surface_pilling',
          '$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_surface_pilling_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_surface_pilling',
          '$appearance_after_washing_fabric_surface_pilling_min_value',
          '$appearance_after_washing_fabric_surface_pilling_max_value',

          '$test_method_for_appearance_after_washing_fabric_crease_before_ironing',
          '$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_crease_before_ironing_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_crease_before_ironing',
          '$appearance_after_washing_fabric_crease_before_ironing_min_value',
          '$appearance_after_washing_fabric_crease_before_ironing_max_value',

          '$test_method_for_appearance_after_washing_fabric_crease_after_ironing',
          '$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator',
          '$appearance_after_washing_fabric_crease_after_ironing_tolerance_value',
          '$uom_of_appearance_after_washing_fabric_crease_after_ironing',
          '$appearance_after_washing_fabric_crease_after_ironing_min_value',
          '$appearance_after_washing_fabric_crease_after_ironing_max_value',

          '$test_method_for_appearance_after_washing_fabric_loss_of_print',
          '$appearance_after_washing_loss_of_print_fabric',

          '$test_method_for_appearance_after_washing_fabric_abrasive_mark',
          '$appearance_after_washing_fabric_abrasive_mark',

          '$test_method_for_appearance_after_washing_fabric_odor',
          '$appearance_after_washing_odor_fabric',

          '$appearance_after_washing_cycle_garments_wash',
          '$test_method_for_appearance_after_washing_garments_color_change_without_suppressor',
          '$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator',
          '$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value',
          '$uom_of_appearance_after_washing_garments_color_change_without_suppressor',
          '$appearance_after_washing_garments_color_change_without_suppressor_min_value',
          '$appearance_after_washing_garments_color_change_without_suppressor_max_value',

          '$test_method_for_appearance_after_washing_garments_color_change_with_suppressor',
          '$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator',
          '$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value',
          '$uom_of_appearance_after_washing_garments_color_change_with_suppressor',
          '$appearance_after_washing_garments_color_change_with_suppressor_min_value',
          '$appearance_after_washing_garments_color_change_with_suppressor_max_value',

          '$test_method_for_appearance_after_washing_garments_cross_staining',
          '$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator',
          '$appearance_after_washing_garments_cross_staining_tolerance_value',
          '$uom_of_appearance_after_washing_garments_cross_staining',
          '$appearance_after_washing_garments_cross_staining_min_value',
          '$appearance_after_washing_garments_cross_staining_max_value',

          '$test_method_for_appearance_after_washing_garments_differential_shrinkage',
          '$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator',
          '$appearance_after_washing_garments__differential_shrinkage_tolerance_value',
          '$uom_of_appearance_after_washing_garments__differential_shrinkage',
          '$appearance_after_washing_garments__differential_shrinkage_min_value',
          '$appearance_after_washing_garments__differential_shrinkage_max_value',

          '$test_method_for_appearance_after_washing_garments_surface_fuzzing',
          '$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator',
          '$appearance_after_washing_garments_surface_fuzzing_tolerance_value',
          '$uom_of_appearance_after_washing_garments_surface_fuzzing',
          '$appearance_after_washing_garments_surface_fuzzing_min_value',
          '$appearance_after_washing_garments_surface_fuzzing_max_value',

          '$test_method_for_appearance_after_washing_garments_surface_pilling',
          '$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator',
          '$appearance_after_washing_garments_surface_pilling_tolerance_value',
          '$uom_of_appearance_after_washing_garments_surface_pilling',
          '$appearance_after_washing_garments_surface_pilling_min_value',
          '$appearance_after_washing_garments_surface_pilling_max_value',

          '$test_method_for_appearance_after_washing_garments_crease_after_ironing',
          '$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator',
          '$appearance_after_washing_garments_crease_after_ironing_tolerance_value',
          '$uom_of_appearance_after_washing_garments_crease_after_ironing',
          '$appearance_after_washing_garments_crease_after_ironing_min_value',
          '$appearance_after_washing_garments_crease_after_ironing_max_value',

          '$test_method_for_appearance_after_washing_garments_abrasive_mark',
          '$appearance_after_washing_garments_abrasive_mark',

          '$test_method_for_appearance_after_washing_garments_seam_breakdown',
          '$seam_breakdown_garments',

          '$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron',
          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator',
          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value',
          '$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron',
          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value',
          '$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value',

          '$test_method_for_appearance_after_washing_garments_detachment_of_interlining',
          '$detachment_of_interlinings_fused_components_garments',

          '$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance',
          '$change_id_handle_or_appearance',

          '$test_method_for_appearance_after_washing_garments_effect_accessories',
          '$effect_on_accessories_such_as_buttons',

          '$test_method_for_appearance_after_washing_garments_spirality',
          '$appearance_after_washing_garments_spirality_min_value',
          '$appearance_after_washing_garments_spirality_max_value',

          '$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons',
          '$detachment_or_fraying_of_ribbons',

          '$test_method_for_appearance_after_washing_garments_loss_of_print',
          '$loss_of_print_garments',

          '$test_method_for_appearance_after_washing_garments_care_level',
          '$care_level_garments',

          '$test_method_for_appearance_after_washing_garments_odor',
          '$odor_garments',



	           '$user_id',
	           '$user_name',
	           NOW()
	        )";

                      $result_of_data_for_finishing = mysqli_query($con,$insert_sql_statement_for_finishing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for finishing.............................................................//











							/*............................................................Copy greige_receiving..............................................................*/


			                $duplicate_greige_receiving_process="select * from `defining_qc_standard_for_greige_receiving_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_greige_receiving_process= mysqli_query($con,$duplicate_greige_receiving_process) or die(mysqli_error());
							$check_duplicate_greige_receiving_process = mysqli_num_rows($result_duplicate_greige_receiving_process);


							if ($check_duplicate_greige_receiving_process >= 1) 
							{
					           echo " greige_receiving Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_greige_receiving_process = "select * from `defining_qc_standard_for_greige_receiving_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_greige_receiving_process = mysqli_query($con,$old_pp_version_greige_receiving_process) or die(mysqli_error());
							    $row_old_pp_version_greige_receiving_process = mysqli_fetch_array($result_old_pp_version_greige_receiving_process);

								$standard_for_which_process= $row_old_pp_version_greige_receiving_process['standard_for_which_process'];	



								$warp_yarn_count_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_value'];
								$warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['warp_yarn_count_tolerance_range_math_operator'];
								$warp_yarn_count_tolerance_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_tolerance_value'];
								$warp_yarn_count_min_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_min_value'];
								$warp_yarn_count_max_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_max_value'];
								$uom_of_warp_yarn_count_value= $row_old_pp_version_greige_receiving_process['uom_of_warp_yarn_count_value'];

								$weft_yarn_count_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_value'];
								$weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['weft_yarn_count_tolerance_range_math_operator'];
								$weft_yarn_count_tolerance_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_tolerance_value'];
								$weft_yarn_count_min_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_min_value'];
								$weft_yarn_count_max_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_max_value'];
								$uom_of_weft_yarn_count_value= $row_old_pp_version_greige_receiving_process['uom_of_weft_yarn_count_value'];

								$mass_per_unit_per_area_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_value'];
								$mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_tolerance_range_math_operator'];
								$mass_per_unit_per_area_tolerance_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_tolerance_value'];
								$mass_per_unit_per_area_min_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_min_value'];
								$mass_per_unit_per_area_max_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_max_value'];
								$uom_of_mass_per_unit_per_area_value= $row_old_pp_version_greige_receiving_process['uom_of_mass_per_unit_per_area_value'];

								$no_of_threads_in_warp_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_value'];
								$no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_tolerance_range_math_operator'];
								$no_of_threads_in_warp_tolerance_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_tolerance_value'];
								$no_of_threads_in_warp_min_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_min_value'];
								$no_of_threads_in_warp_max_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_max_value'];
								$uom_of_no_of_threads_in_warp_value= $row_old_pp_version_greige_receiving_process['uom_of_no_of_threads_in_warp_value'];

								$no_of_threads_in_weft_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_value'];
								$no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_tolerance_range_math_operator'];
								$no_of_threads_in_weft_tolerance_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_tolerance_value'];
								$no_of_threads_in_weft_min_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_min_value'];
								$no_of_threads_in_weft_max_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_max_value'];
								$uom_of_no_of_threads_in_weft_value= $row_old_pp_version_greige_receiving_process['uom_of_no_of_threads_in_weft_value'];


								$greige_width_value= $row_old_pp_version_greige_receiving_process['greige_width_value'];
								$greige_width_range_math_operator= $row_old_pp_version_greige_receiving_process['greige_width_range_math_operator'];
								$greige_width_tolerance_value= $row_old_pp_version_greige_receiving_process['greige_width_tolerance_value'];
								$greige_width_min_value= $row_old_pp_version_greige_receiving_process['greige_width_min_value'];
								$greige_width_max_value= $row_old_pp_version_greige_receiving_process['greige_width_max_value'];
								$uom_of_greige_width_value= $row_old_pp_version_greige_receiving_process['uom_of_greige_width_value'];



								$percentage_of_total_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_value'];
								$percentage_of_total_cotton_content_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_tolerance_range_math_operator'];
								$percentage_of_total_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_tolerance_value'];
								$percentage_of_total_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_min_value'];
								$percentage_of_total_cotton_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_max_value'];
								$uom_of_percentage_of_total_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_cotton_content'];

								$percentage_of_total_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_value'];
								$percentage_of_total_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_tolerance_range_math_op'];
								$percentage_of_total_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_tolerance_value'];
								$percentage_of_total_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_min_value'];
								$percentage_of_total_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_max_value'];
								$uom_of_percentage_of_total_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_polyester_content'];

								$description_or_type_for_total_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_total_other_fiber'];
								$percentage_of_total_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_value'];
								$percentage_of_total_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'];
								$percentage_of_total_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_tolerance_value'];
								$percentage_of_total_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_min_value'];
								$percentage_of_total_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_max_value'];
								$uom_of_percentage_of_total_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_other_fiber_content'];

								$description_or_type_for_total_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_total_other_fiber_1'];
								$percentage_of_total_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_value'];
								$percentage_of_total_other_fiber_content_1_tol_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_tol_range_math_op'];
								$percentage_of_total_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_tolerance_value'];
								$percentage_of_total_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_min_value'];
								$percentage_of_total_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_max_value'];
								$uom_of_percentage_of_total_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_other_fiber_content_1'];


								$percentage_of_warp_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_value'];
								$percentage_of_warp_cotton_content_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'];
								$percentage_of_warp_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_tolerance_value'];
								$percentage_of_warp_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_min_value'];
								$uom_of_percentage_of_warp_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_cotton_content'];

								$percentage_of_warp_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_value'];
								$percentage_of_warp_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_tolerance_range_math_op'];
								$percentage_of_warp_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_tolerance_value'];
								$percentage_of_warp_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_min_value'];
								$percentage_of_warp_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_max_value'];
								$uom_of_percentage_of_warp_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_polyester_content'];

								$description_or_type_for_warp_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_warp_other_fiber'];
								$percentage_of_warp_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_value'];
								$percentage_of_warp_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'];
								$percentage_of_warp_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_tolerance_value'];
								$percentage_of_warp_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_min_value'];
								$percentage_of_warp_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_max_value'];
								$uom_of_percentage_of_warp_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_other_fiber_content'];

								$description_or_type_for_warp_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_warp_other_fiber_1'];
								$percentage_of_warp_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_value'];
								$percentage_of_warp_other_fiber_content_1_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_tolerance_range_math_op'];
								$percentage_of_warp_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_tolerance_value'];
								$percentage_of_warp_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_min_value'];
								$percentage_of_warp_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_max_value'];
								$uom_of_percentage_of_warp_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_other_fiber_content_1'];

								$percentage_of_weft_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_value'];
								$percentage_of_weft_cotton_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_tolerance_range_math_op'];
								$percentage_of_weft_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_tolerance_value'];
								$percentage_of_weft_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_min_value'];
								$percentage_of_weft_cotton_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_max_value'];
								$uom_of_percentage_of_weft_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_cotton_content'];

								$percentage_of_weft_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_value'];
								$percentage_of_weft_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_tolerance_range_math_op'];
								$percentage_of_weft_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_tolerance_value'];
								$percentage_of_weft_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_min_value'];
								$percentage_of_weft_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_max_value'];
								$uom_of_percentage_of_weft_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_polyester_content'];

								$description_or_type_for_weft_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_weft_other_fiber'];
								$percentage_of_weft_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_value'];
								$percentage_of_weft_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
								$percentage_of_weft_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_tolerance_value'];
								$percentage_of_weft_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_min_value'];
								$percentage_of_weft_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_max_value'];
								$uom_of_percentage_of_weft_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_other_fiber_content'];



								$description_or_type_for_weft_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_weft_other_fiber_1'];
								$percentage_of_weft_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_value'];
								$percentage_of_weft_other_fiber_content_1_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_tolerance_range_math_op'];
								$percentage_of_weft_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_tolerance_value'];
								$percentage_of_weft_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_min_value'];
								$percentage_of_weft_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_max_value'];
								$uom_of_percentage_of_weft_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_other_fiber_content_1'];




									$insert_sql_statement_for_greige_receiving="INSERT INTO `defining_qc_standard_for_greige_receiving_process`( 
										  `pp_number`, 
										  `version_id`, 
										  `version_number`, 
										  `customer_name`, 
										  `customer_id`, 
										  `color`, 
										  `finish_width_in_inch`,
										  `standard_for_which_process`, 


									        `warp_yarn_count_value`,
									        `warp_yarn_count_tolerance_range_math_operator`, 
									        `warp_yarn_count_tolerance_value`, 
									        `warp_yarn_count_min_value`, 
									        `warp_yarn_count_max_value`, 
									        `uom_of_warp_yarn_count_value`, 


									        `weft_yarn_count_value`, 
									        `weft_yarn_count_tolerance_range_math_operator`, 
									        `weft_yarn_count_tolerance_value`, 
									        `weft_yarn_count_min_value`, 
									        `weft_yarn_count_max_value`, 
									        `uom_of_weft_yarn_count_value`, 

									        `mass_per_unit_per_area_value`, 
									        `mass_per_unit_per_area_tolerance_range_math_operator`,
									        `mass_per_unit_per_area_tolerance_value`, 
									        `mass_per_unit_per_area_min_value`, 
									        `mass_per_unit_per_area_max_value`, 
									        `uom_of_mass_per_unit_per_area_value`,

									          `no_of_threads_in_warp_value`, 
									          `no_of_threads_in_warp_tolerance_range_math_operator`, 
									          `no_of_threads_in_warp_tolerance_value`, 
									          `no_of_threads_in_warp_min_value`, 
									          `no_of_threads_in_warp_max_value`, 
									          `uom_of_no_of_threads_in_warp_value`, 

									          `no_of_threads_in_weft_value`, 
									          `no_of_threads_in_weft_tolerance_range_math_operator`, 
									          `no_of_threads_in_weft_tolerance_value`, 
									          `no_of_threads_in_weft_min_value`, 
									          `no_of_threads_in_weft_max_value`, 
									          `uom_of_no_of_threads_in_weft_value`, 

								              `greige_width_value`,
								               `greige_width_range_math_operator`, 
								               `greige_width_tolerance_value`, 
								               `greige_width_min_value`, 
								               `greige_width_max_value`, 
								               `uom_of_greige_width_value`,

									         `percentage_of_total_cotton_content_value`, 
									         `percentage_of_total_cotton_content_tolerance_range_math_operator`, 
									         `percentage_of_total_cotton_content_tolerance_value`, 
									         `percentage_of_total_cotton_content_min_value`, 
									         `percentage_of_total_cotton_content_max_value`, 
									         `uom_of_percentage_of_total_cotton_content`,

									         `percentage_of_total_polyester_content_value`, 
									         `percentage_of_total_polyester_content_tolerance_range_math_op`, 
									         `percentage_of_total_polyester_content_tolerance_value`, 
									         `percentage_of_total_polyester_content_min_value`, 
									         `percentage_of_total_polyester_content_max_value`, 
									         `uom_of_percentage_of_total_polyester_content`, 

									         `description_or_type_for_total_other_fiber`, 
									         `percentage_of_total_other_fiber_content_value`, 
									         `percentage_of_total_other_fiber_content_tolerance_range_math_op`, 
									         `percentage_of_total_other_fiber_content_tolerance_value`, 
									         `percentage_of_total_other_fiber_content_min_value`, 
									         `percentage_of_total_other_fiber_content_max_value`, 
									         `uom_of_percentage_of_total_other_fiber_content`, 

									         `description_or_type_for_total_other_fiber_1`, 
								             `percentage_of_total_other_fiber_content_1_value`, 
								             `percentage_of_total_other_fiber_content_1_tol_range_math_op`, 
								             `percentage_of_total_other_fiber_content_1_tolerance_value`, 
								             `percentage_of_total_other_fiber_content_1_min_value`, 
								             `percentage_of_total_other_fiber_content_1_max_value`, 
								             `uom_of_percentage_of_total_other_fiber_content_1`,  

									         `percentage_of_warp_cotton_content_value`, 
									         `percentage_of_warp_cotton_content_tolerance_range_math_operator`, 
									         `percentage_of_warp_cotton_content_tolerance_value`, 
									         `percentage_of_warp_cotton_content_min_value`, 
									         `uom_of_percentage_of_warp_cotton_content`, 

									         `percentage_of_warp_polyester_content_value`, 
									         `percentage_of_warp_polyester_content_tolerance_range_math_op`, 
									         `percentage_of_warp_polyester_content_tolerance_value`, 
									         `percentage_of_warp_polyester_content_min_value`, 
									         `percentage_of_warp_polyester_content_max_value`, 
									         `uom_of_percentage_of_warp_polyester_content`, 

									         `description_or_type_for_warp_other_fiber`, 
									         `percentage_of_warp_other_fiber_content_value`, 
									         `percentage_of_warp_other_fiber_content_tolerance_range_math_op`, 
									         `percentage_of_warp_other_fiber_content_tolerance_value`, 
									         `percentage_of_warp_other_fiber_content_min_value`, 
									         `percentage_of_warp_other_fiber_content_max_value`, 
									         `uom_of_percentage_of_warp_other_fiber_content`,


									         `description_or_type_for_warp_other_fiber_1`, 
								             `percentage_of_warp_other_fiber_content_1_value`, 
								             `percentage_of_warp_other_fiber_content_1_tolerance_range_math_op`, 
								             `percentage_of_warp_other_fiber_content_1_tolerance_value`, 
								             `percentage_of_warp_other_fiber_content_1_min_value`, 
								             `percentage_of_warp_other_fiber_content_1_max_value`, 
								             `uom_of_percentage_of_warp_other_fiber_content_1`,  

									         `percentage_of_weft_cotton_content_value`, 
									         `percentage_of_weft_cotton_content_tolerance_range_math_op`, 
									         `percentage_of_weft_cotton_content_tolerance_value`, 
									         `percentage_of_weft_cotton_content_min_value`, 
									         `percentage_of_weft_cotton_content_max_value`, 
									         `uom_of_percentage_of_weft_cotton_content`, 

									         `percentage_of_weft_polyester_content_value`, 
									         `percentage_of_weft_polyester_content_tolerance_range_math_op`, 
									         `percentage_of_weft_polyester_content_tolerance_value`, 
									         `percentage_of_weft_polyester_content_min_value`, 
									         `percentage_of_weft_polyester_content_max_value`, 
									         `uom_of_percentage_of_weft_polyester_content`, 

									         `description_or_type_for_weft_other_fiber`, 
									         `percentage_of_weft_other_fiber_content_value`, 
									         `percentage_of_weft_other_fiber_content_tolerance_range_math_op`, 
									         `percentage_of_weft_other_fiber_content_tolerance_value`, 
									         `percentage_of_weft_other_fiber_content_min_value`, 
									         `percentage_of_weft_other_fiber_content_max_value`, 
									         `uom_of_percentage_of_weft_other_fiber_content`,


									         `description_or_type_for_weft_other_fiber_1`, 
								             `percentage_of_weft_other_fiber_content_1_value`, 
								             `percentage_of_weft_other_fiber_content_1_tolerance_range_math_op`, 
								             `percentage_of_weft_other_fiber_content_1_tolerance_value`, 
								             `percentage_of_weft_other_fiber_content_1_min_value`, 
								             `percentage_of_weft_other_fiber_content_1_max_value`, 
								             `uom_of_percentage_of_weft_other_fiber_content_1`, 

								           

								            `recording_person_id`, 
								            `recording_person_name`, 
								            `recording_time`) 
									        VALUES 
									        (
									         '$pp_number',
									         '$version_id',
									         '$version_name',
									         '$customer_name',
									         '$customer_id',
									         '$color',
									         '$finish_width_in_inch',
									         '$standard_for_which_process',

									         '$warp_yarn_count_value',
									         '$warp_yarn_count_tolerance_range_math_operator',
									         '$warp_yarn_count_tolerance_value',
									         '$warp_yarn_count_min_value',
									         '$warp_yarn_count_max_value',
									         '$uom_of_warp_yarn_count_value',


									          '$weft_yarn_count_value',
									          '$weft_yarn_count_tolerance_range_math_operator',
									          '$weft_yarn_count_tolerance_value',
									          '$weft_yarn_count_min_value',
									          '$weft_yarn_count_max_value',
									          '$uom_of_weft_yarn_count_value',

									          '$mass_per_unit_per_area_value',
									          '$mass_per_unit_per_area_tolerance_range_math_operator',
									          '$mass_per_unit_per_area_tolerance_value',
									          '$mass_per_unit_per_area_min_value',
									          '$mass_per_unit_per_area_max_value',
									          '$uom_of_mass_per_unit_per_area_value',


									          '$no_of_threads_in_warp_value',
									          '$no_of_threads_in_warp_tolerance_range_math_operator',
									          '$no_of_threads_in_warp_tolerance_value',
									          '$no_of_threads_in_warp_min_value',
									          '$no_of_threads_in_warp_max_value',
									          '$uom_of_no_of_threads_in_warp_value',


									          '$no_of_threads_in_weft_value',
									          '$no_of_threads_in_weft_tolerance_range_math_operator',
									          '$no_of_threads_in_weft_tolerance_value',
									          '$no_of_threads_in_weft_min_value',
									          '$no_of_threads_in_weft_max_value',
									          '$uom_of_no_of_threads_in_weft_value',


									           '$greige_width_value',
									           '$greige_width_range_math_operator',
									           '$greige_width_tolerance_value',
									           '$greige_width_min_value',
									           '$greige_width_max_value',
									           '$uom_of_greige_width_value',

									           '$percentage_of_total_cotton_content_value',
									           '$percentage_of_total_cotton_content_tolerance_range_math_operator',
									           '$percentage_of_total_cotton_content_tolerance_value',
									           '$percentage_of_total_cotton_content_min_value',
									           '$percentage_of_total_cotton_content_max_value',
									           '$uom_of_percentage_of_total_cotton_content',

									           '$percentage_of_total_polyester_content_value',
									           '$percentage_of_total_polyester_content_tolerance_range_math_op',
									           '$percentage_of_total_polyester_content_tolerance_value',
									           '$percentage_of_total_polyester_content_min_value',
									           '$percentage_of_total_polyester_content_max_value',
									           '$uom_of_percentage_of_total_polyester_content',

									           '$description_or_type_for_total_other_fiber',
									           '$percentage_of_total_other_fiber_content_value',
									           '$percentage_of_total_other_fiber_content_tolerance_range_math_op',
									           '$percentage_of_total_other_fiber_content_tolerance_value',
									           '$percentage_of_total_other_fiber_content_min_value',
									           '$percentage_of_total_other_fiber_content_max_value',
									           '$uom_of_percentage_of_total_other_fiber_content',

									          '$description_or_type_for_total_other_fiber_1',
								              '$percentage_of_total_other_fiber_content_1_value',
								              '$percentage_of_total_other_fiber_content_1_tol_range_math_op',
								              '$percentage_of_total_other_fiber_content_1_tolerance_value',
								              '$percentage_of_total_other_fiber_content_1_min_value',
								              '$percentage_of_total_other_fiber_content_1_max_value',
								              '$uom_of_percentage_of_total_other_fiber_content_1',

									           '$percentage_of_warp_cotton_content_value',
									           '$percentage_of_warp_cotton_content_tolerance_range_math_operator',
									           '$percentage_of_warp_cotton_content_tolerance_value',
									           '$percentage_of_warp_cotton_content_min_value',
									           '$uom_of_percentage_of_warp_cotton_content',

									           '$percentage_of_warp_polyester_content_value',
									           '$percentage_of_warp_polyester_content_tolerance_range_math_op',
									           '$percentage_of_warp_polyester_content_tolerance_value',
									           '$percentage_of_warp_polyester_content_min_value',
									           '$percentage_of_warp_polyester_content_max_value',
									           '$uom_of_percentage_of_warp_polyester_content',

									           '$description_or_type_for_warp_other_fiber',
									           '$percentage_of_warp_other_fiber_content_value',
									           '$percentage_of_warp_other_fiber_content_tolerance_range_math_op',
									           '$percentage_of_warp_other_fiber_content_tolerance_value',
									           '$percentage_of_warp_other_fiber_content_min_value',
									           '$percentage_of_warp_other_fiber_content_max_value',
									           '$uom_of_percentage_of_warp_other_fiber_content',

									           '$description_or_type_for_warp_other_fiber_1',
								               '$percentage_of_warp_other_fiber_content_1_value',
								               '$percentage_of_warp_other_fiber_content_1_tolerance_range_math_op',
								               '$percentage_of_warp_other_fiber_content_1_tolerance_value',
								               '$percentage_of_warp_other_fiber_content_1_min_value',
								               '$percentage_of_warp_other_fiber_content_1_max_value',
								               '$uom_of_percentage_of_warp_other_fiber_content_1',

									           '$percentage_of_weft_cotton_content_value',
									           '$percentage_of_weft_cotton_content_tolerance_range_math_op',
									           '$percentage_of_weft_cotton_content_tolerance_value',
									           '$percentage_of_weft_cotton_content_min_value',
									           '$percentage_of_weft_cotton_content_max_value',
									           '$uom_of_percentage_of_weft_cotton_content',

									           '$percentage_of_weft_polyester_content_value',
									           '$percentage_of_weft_polyester_content_tolerance_range_math_op',
									           '$percentage_of_weft_polyester_content_tolerance_value',
									           '$percentage_of_weft_polyester_content_min_value',
									           '$percentage_of_weft_polyester_content_max_value',
									           '$uom_of_percentage_of_weft_polyester_content',

									           '$description_or_type_for_weft_other_fiber',
									           '$percentage_of_weft_other_fiber_content_value',
									           '$percentage_of_weft_other_fiber_content_tolerance_range_math_op',
									           '$percentage_of_weft_other_fiber_content_tolerance_value',
									           '$percentage_of_weft_other_fiber_content_min_value',
									           '$percentage_of_weft_other_fiber_content_max_value',
									           '$uom_of_percentage_of_weft_other_fiber_content',

									           '$description_or_type_for_weft_other_fiber_1',
								              '$percentage_of_weft_other_fiber_content_1_value',
								              '$percentage_of_weft_other_fiber_content_1_tolerance_range_math_op',
								              '$percentage_of_weft_other_fiber_content_1_tolerance_value',
								              '$percentage_of_weft_other_fiber_content_1_min_value',
								              '$percentage_of_weft_other_fiber_content_1_max_value',
								              '$uom_of_percentage_of_weft_other_fiber_content_1',


									           '$user_id',
									           '$user_name',
									           NOW()
									        )";

									mysqli_query($con,$insert_sql_statement_for_greige_receiving) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for greige_receiving..............................................................//





							/*............................................................Copy mercerize..............................................................*/


			                $duplicate_mercerize_process="select * from `defining_qc_standard_for_mercerize_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_mercerize_process= mysqli_query($con,$duplicate_mercerize_process) or die(mysqli_error());
							$check_duplicate_mercerize_process = mysqli_num_rows($result_duplicate_mercerize_process);


							if ($check_duplicate_mercerize_process >= 1) 
							{
					           echo " mercerize Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_mercerize_process = "select * from `defining_qc_standard_for_mercerize_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_mercerize_process = mysqli_query($con,$old_pp_version_mercerize_process) or die(mysqli_error());
							    $row_old_pp_version_mercerize_process = mysqli_fetch_array($result_old_pp_version_mercerize_process);

								$standard_for_which_process= $row_old_pp_version_mercerize_process['standard_for_which_process'];	

								$test_method_for_whiteness= $row_old_pp_version_mercerize_process['test_method_for_whiteness'];
								 $whiteness_min_value= $row_old_pp_version_mercerize_process['whiteness_min_value'];
								 $whiteness_max_value= $row_old_pp_version_mercerize_process['whiteness_max_value'];
								 $uom_of_whiteness= $row_old_pp_version_mercerize_process['uom_of_whiteness'];

								$test_method_for_absorbency= $row_old_pp_version_mercerize_process['test_method_for_absorbency'];
								$absorbency_min_value= $row_old_pp_version_mercerize_process['absorbency_min_value'];
								$absorbency_max_value= $row_old_pp_version_mercerize_process['absorbency_max_value'];
								$uom_of_absorbency= $row_old_pp_version_mercerize_process['uom_of_absorbency'];

								$test_method_for_residual_sizing_material= $row_old_pp_version_mercerize_process['test_method_for_residual_sizing_material'];
								$residual_sizing_material_min_value= $row_old_pp_version_mercerize_process['residual_sizing_material_min_value'];
								$residual_sizing_material_max_value= $row_old_pp_version_mercerize_process['residual_sizing_material_max_value'];
								$uom_of_residual_sizing_material= $row_old_pp_version_mercerize_process['uom_of_residual_sizing_material'];

								 
								 $test_method_for_ph= $row_old_pp_version_mercerize_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_mercerize_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_mercerize_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_mercerize_process['uom_of_ph'];


									$insert_sql_statement_for_mercerize="insert into `defining_qc_standard_for_mercerize_process` 
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

									                     `test_method_for_absorbency`,
									                     `absorbency_min_value`,
									                     `absorbency_max_value`,
									                     `uom_of_absorbency`,

									                     `test_method_for_residual_sizing_material`,
									                     `residual_sizing_material_min_value`,
									                     `residual_sizing_material_max_value`,
									                     `uom_of_residual_sizing_material`,


								                        `test_method_for_ph`, 
								                        `ph_min_value`, 
								                        `ph_max_value`,
								                        `uom_of_ph`, 

									                     `recording_person_id`,
									                     `recording_person_name`,
									                     `recording_time` ) 
														values 
													    (
													    '$pp_number',
								                        '$version_id',
								                        '$version_name',
								                        '$customer_name',
								                        '$customer_id',
								                        '$color',
								                        '$finish_width_in_inch',
								                        '$standard_for_which_process',

								                        
								                        '$test_method_for_whiteness',
								                        '$whiteness_min_value',
								                        '$whiteness_max_value',
								                        '$uom_of_whiteness',

								                        '$test_method_for_absorbency',
								                        '$absorbency_min_value',
								                        '$absorbency_max_value',
								                        '$uom_of_absorbency',

								                         '$test_method_for_residual_sizing_material',
								                        '$residual_sizing_material_min_value',
								                        '$residual_sizing_material_max_value',
								                        '$uom_of_residual_sizing_material',

								                        '$test_method_for_ph',
								                        '$ph_min_value',
								                        '$ph_max_value',
								                        '$uom_of_ph',


								                         '$user_id',
								                         '$user_name',
								                          NOW()
								                         )";

									mysqli_query($con,$insert_sql_statement_for_mercerize) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for mercerize..............................................................//



							/*............................................................Copy printing..............................................................*/


			                $duplicate_printing_process="select * from `defining_qc_standard_for_printing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_printing_process= mysqli_query($con,$duplicate_printing_process) or die(mysqli_error());
							$check_duplicate_printing_process = mysqli_num_rows($result_duplicate_printing_process);


							if ($check_duplicate_printing_process >= 1) 
							{
					           echo " printing Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_printing_process = "select * from `defining_qc_standard_for_printing_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_printing_process = mysqli_query($con,$old_pp_version_printing_process) or die(mysqli_error());
							    $row_old_pp_version_printing_process = mysqli_fetch_array($result_old_pp_version_printing_process);

								$standard_for_which_process= $row_old_pp_version_printing_process['standard_for_which_process'];	

								$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_printing_process['test_method_for_cf_to_rubbing_dry'];
								$uom_of_cf_to_rubbing_dry= $row_old_pp_version_printing_process['uom_of_cf_to_rubbing_dry'];
								$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_printing_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
								$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_tolerance_value'];
								$cf_to_rubbing_dry_min_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_min_value'];
								$cf_to_rubbing_dry_max_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_max_value'];

								$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_printing_process['test_method_for_cf_to_rubbing_wet'];
								$uom_of_cf_to_rubbing_wet= $row_old_pp_version_printing_process['uom_of_cf_to_rubbing_wet'];
								$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_printing_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
								$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_tolerance_value'];
								$cf_to_rubbing_wet_min_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_min_value'];
								$cf_to_rubbing_wet_max_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_max_value'];




									$insert_sql_statement_for_printing="insert into `defining_qc_standard_for_printing_process` ( `pp_number`,`version_id`,`version_number`,`customer_name`,`customer_id`,`color`,`finish_width_in_inch`,`standard_for_which_process`,`test_method_for_cf_to_rubbing_dry`,`uom_of_cf_to_rubbing_dry`,`cf_to_rubbing_dry_tolerance_range_math_operator`,`cf_to_rubbing_dry_tolerance_value`,`cf_to_rubbing_dry_min_value`,`cf_to_rubbing_dry_max_value`,`test_method_for_cf_to_rubbing_wet`,`uom_of_cf_to_rubbing_wet`,`cf_to_rubbing_wet_tolerance_range_math_operator`,`cf_to_rubbing_wet_tolerance_value`,`cf_to_rubbing_wet_min_value`,`cf_to_rubbing_wet_max_value`,`recording_person_id`,`recording_person_name`,`recording_time` ) 
									values 
									('$pp_number','$version_id','$version_name','$customer_name','$customer_id','$color',$finish_width_in_inch,'$standard_for_which_process','$test_method_for_cf_to_rubbing_dry','$uom_of_cf_to_rubbing_dry','$cf_to_rubbing_dry_tolerance_range_math_operator','$cf_to_rubbing_dry_tolerance_value','$cf_to_rubbing_dry_min_value','$cf_to_rubbing_dry_max_value','$test_method_for_cf_to_rubbing_wet','$uom_of_cf_to_rubbing_wet','$cf_to_rubbing_wet_tolerance_range_math_operator','$cf_to_rubbing_wet_tolerance_value','$cf_to_rubbing_wet_min_value','$cf_to_rubbing_wet_max_value','$user_id','$user_name',NOW())";


									mysqli_query($con,$insert_sql_statement_for_printing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for printing..............................................................//




							/*............................................................Copy raising..............................................................*/


			                $duplicate_raising_process="select * from `defining_qc_standard_for_raising_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_raising_process= mysqli_query($con,$duplicate_raising_process) or die(mysqli_error());
							$check_duplicate_raising_process = mysqli_num_rows($result_duplicate_raising_process);


							if ($check_duplicate_raising_process >= 1) 
							{
					           echo " raising Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_raising_process = "select * from `defining_qc_standard_for_raising_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_raising_process = mysqli_query($con,$old_pp_version_raising_process) or die(mysqli_error());
							    $row_old_pp_version_raising_process = mysqli_fetch_array($result_old_pp_version_raising_process);

								$standard_for_which_process= $row_old_pp_version_raising_process['standard_for_which_process'];	

								$test_method_for_tensile_properties_in_warp= $row_old_pp_version_raising_process['test_method_for_tensile_properties_in_warp'];
								$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
								$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_tolerance_value'];
								$tensile_properties_in_warp_value_min_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_min_value'];
								$tensile_properties_in_warp_value_max_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_max_value'];
								$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_raising_process['uom_of_tensile_properties_in_warp_value'];

								$test_method_for_tensile_properties_in_weft= $row_old_pp_version_raising_process['test_method_for_tensile_properties_in_weft'];
								$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
								$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_tolerance_value'];
								$tensile_properties_in_weft_value_min_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_min_value'];
								$tensile_properties_in_weft_value_max_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_max_value'];
								$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_raising_process['uom_of_tensile_properties_in_weft_value'];

								$test_method_for_tear_force_in_warp= $row_old_pp_version_raising_process['test_method_for_tear_force_in_warp'];
								$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_raising_process['tear_force_in_warp_value_tolerance_range_math_operator'];
								$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_tolerance_value'];
								$tear_force_in_warp_value_min_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_min_value'];
								$tear_force_in_warp_value_max_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_max_value'];
								$uom_of_tear_force_in_warp_value= $row_old_pp_version_raising_process['uom_of_tear_force_in_warp_value'];

								$test_method_for_tear_force_in_weft= $row_old_pp_version_raising_process['test_method_for_tear_force_in_weft'];
								$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'];
								$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_tolerance_value'];
								$tear_force_in_weft_value_min_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_min_value'];
								$tear_force_in_weft_value_max_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_max_value'];
								$uom_of_tear_force_in_weft_value= $row_old_pp_version_raising_process['uom_of_tear_force_in_weft_value'];


									$insert_sql_statement_for_raising="INSERT INTO `defining_qc_standard_for_raising_process`( 
									  `pp_number`, 
									  `version_id`, 
									  `version_number`, 
									  `customer_name`, 
								        `customer_id`, 
									  `color`, 
									  `finish_width_in_inch`,
									  `standard_for_which_process`, 


									  
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


										  `recording_person_id`, 
										  `recording_person_name`, 
										  `recording_time` 
								        ) 

								       VALUES 
								        (
								      '$pp_number',
								      '$version_id',
								      '$version_name',
								      '$customer_name',
								      '$customer_id',
								      '$color',
								      '$finish_width_in_inch',
								      '$standard_for_which_process',


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

								       '$user_id',
								       '$user_name',
								        NOW()
									        )";



									mysqli_query($con,$insert_sql_statement_for_raising) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for raising..............................................................//





							/*............................................................Copy ready_for_dying..............................................................*/


			                $duplicate_ready_for_dying_process="select * from `defining_qc_standard_for_ready_for_dying_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_ready_for_dying_process= mysqli_query($con,$duplicate_ready_for_dying_process) or die(mysqli_error());
							$check_duplicate_ready_for_dying_process = mysqli_num_rows($result_duplicate_ready_for_dying_process);


							if ($check_duplicate_ready_for_dying_process >= 1) 
							{
					           echo " ready_for_dying Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_ready_for_dying_process = "select * from `defining_qc_standard_for_ready_for_dying_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_ready_for_dying_process = mysqli_query($con,$old_pp_version_ready_for_dying_process) or die(mysqli_error());
							    $row_old_pp_version_ready_for_dying_process = mysqli_fetch_array($result_old_pp_version_ready_for_dying_process);

								$standard_for_which_process= $row_old_pp_version_ready_for_dying_process['standard_for_which_process'];	
								

								$test_method_for_whiteness= $row_old_pp_version_ready_for_dying_process['test_method_for_whiteness'];
								 $whiteness_min_value= $row_old_pp_version_ready_for_dying_process['whiteness_min_value'];
								 $whiteness_max_value= $row_old_pp_version_ready_for_dying_process['whiteness_max_value'];
								 $uom_of_whiteness= $row_old_pp_version_ready_for_dying_process['uom_of_whiteness'];


								 $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_dying_process['test_method_for_bowing_and_skew'];
								 $bowing_and_skew_tolerance_range_math_operator= $row_old_pp_version_ready_for_dying_process['bowing_and_skew_tolerance_range_math_operator'];
								 $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_dying_process['bowing_and_skew_tolerance_value'];
								 $bowing_and_skew_min_value= $row_old_pp_version_ready_for_dying_process['bowing_and_skew_min_value'];
								 $bowing_and_skew_max_value= $row_old_pp_version_ready_for_dying_process['bowing_and_skew_max_value'];
								 $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_dying_process['uom_of_bowing_and_skew'];


								 
								 $test_method_for_ph= $row_old_pp_version_ready_for_dying_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_ready_for_dying_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_ready_for_dying_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_ready_for_dying_process['uom_of_ph'];





									$insert_sql_statement_for_ready_for_dying="INSERT INTO `defining_qc_standard_for_ready_for_dying_process`
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

									                       `test_method_for_bowing_and_skew`, 
									                       `bowing_and_skew_tolerance_range_math_operator`, 
									                       `bowing_and_skew_tolerance_value`, 
									                       `bowing_and_skew_min_value`, 
									                       `bowing_and_skew_max_value`, 
									                       `uom_of_bowing_and_skew`,

									                       `test_method_for_ph`, 
									                       `ph_min_value`, 
									                       `ph_max_value`,
									                       `uom_of_ph`,  

									                       `recording_person_id`, 
									                       `recording_person_name`, 
									                       `recording_time`
									                       )
									                        VALUES 
									                        (
									                        '$pp_number',
									                        '$version_id',
									                        '$version_name',
									                        '$customer_name',
									                        '$customer_id',
									                        '$color',
									                        '$finish_width_in_inch',
									                        '$standard_for_which_process',

									                        
									                        '$test_method_for_whiteness',
									                        '$whiteness_min_value',
									                        '$whiteness_max_value',
								                             '$uom_of_whiteness',

									                        '$test_method_for_bowing_and_skew',
									                        '$bowing_and_skew_tolerance_range_math_operator',
									                        '$bowing_and_skew_tolerance_value',
									                        '$bowing_and_skew_min_value',
									                        '$bowing_and_skew_max_value',
									                        '$uom_of_bowing_and_skew',

									                        '$test_method_for_ph',
									                        '$ph_min_value',
									                        '$ph_max_value',
									                        '$uom_of_ph',

									                        '$user_id',
									                        '$user_name',
									                         NOW()
									                          )";



									mysqli_query($con,$insert_sql_statement_for_ready_for_dying) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for ready_for_dying..............................................................//




							/*............................................................Copy ready_for_mercerize..............................................................*/


			                $duplicate_ready_for_mercerize_process="select * from `defining_qc_standard_for_ready_for_mercerize_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_ready_for_mercerize_process= mysqli_query($con,$duplicate_ready_for_mercerize_process) or die(mysqli_error());
							$check_duplicate_ready_for_mercerize_process = mysqli_num_rows($result_duplicate_ready_for_mercerize_process);


							if ($check_duplicate_ready_for_mercerize_process >= 1) 
							{
					           echo " ready_for_mercerize Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_ready_for_mercerize_process = "select * from `defining_qc_standard_for_ready_for_mercerize_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_ready_for_mercerize_process = mysqli_query($con,$old_pp_version_ready_for_mercerize_process) or die(mysqli_error());
							    $row_old_pp_version_ready_for_mercerize_process = mysqli_fetch_array($result_old_pp_version_ready_for_mercerize_process);

								$standard_for_which_process= $row_old_pp_version_ready_for_mercerize_process['standard_for_which_process'];	


								$test_method_for_whiteness= $row_old_pp_version_ready_for_mercerize_process['test_method_for_whiteness'];
								 $whiteness_min_value= $row_old_pp_version_ready_for_mercerize_process['whiteness_min_value'];
								 $whiteness_max_value= $row_old_pp_version_ready_for_mercerize_process['whiteness_max_value'];
								 $uom_of_whiteness= $row_old_pp_version_ready_for_mercerize_process['uom_of_whiteness'];


								 $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_mercerize_process['test_method_for_bowing_and_skew'];
								 $bowing_and_skew_tolerance_range_math_operator= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_tolerance_range_math_operator'];
								 $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_tolerance_value'];
								 $bowing_and_skew_min_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_min_value'];
								 $bowing_and_skew_max_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_max_value'];
								 $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_mercerize_process['uom_of_bowing_and_skew'];


								 
								 $test_method_for_ph= $row_old_pp_version_ready_for_mercerize_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_ready_for_mercerize_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_ready_for_mercerize_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_ready_for_mercerize_process['uom_of_ph'];


									$insert_sql_statement_for_ready_for_mercerize="INSERT INTO `defining_qc_standard_for_ready_for_mercerize_process`
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

									                       `test_method_for_bowing_and_skew`, 
									                       `bowing_and_skew_tolerance_range_math_operator`, 
									                       `bowing_and_skew_tolerance_value`, 
									                       `bowing_and_skew_min_value`, 
									                       `bowing_and_skew_max_value`, 
									                       `uom_of_bowing_and_skew`,

									                       `test_method_for_ph`, 
									                       `ph_min_value`, 
									                       `ph_max_value`,
									                       `uom_of_ph`,  

									                       `recording_person_id`, 
									                       `recording_person_name`, 
									                       `recording_time`
									                       )
									                        VALUES 
									                        (
									                        '$pp_number',
									                        '$version_id',
									                        '$version_name',
									                        '$customer_name',
									                        '$customer_id',
									                        '$color',
									                        '$finish_width_in_inch',
									                        '$standard_for_which_process',

									                        
									                        '$test_method_for_whiteness',
									                        '$whiteness_min_value',
									                        '$whiteness_max_value',
								                             '$uom_of_whiteness',

									                        '$test_method_for_bowing_and_skew',
									                        '$bowing_and_skew_tolerance_range_math_operator',
									                        '$bowing_and_skew_tolerance_value',
									                        '$bowing_and_skew_min_value',
									                        '$bowing_and_skew_max_value',
									                        '$uom_of_bowing_and_skew',

									                        '$test_method_for_ph',
									                        '$ph_min_value',
									                        '$ph_max_value',
									                        '$uom_of_ph',

									                        '$user_id',
									                        '$user_name',
									                         NOW()
									                          )";



									mysqli_query($con,$insert_sql_statement_for_ready_for_mercerize) or die(mysqli_error($con));

                                    
                                   

							}   // .................................................Duplicacy Check for ready_for_mercerize..............................................................//




      /*............................................................Copy ready_for_printing..............................................................*/


			                $duplicate_ready_for_printing_process="select * from `defining_qc_standard_for_ready_for_printing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_ready_for_printing_process= mysqli_query($con,$duplicate_ready_for_printing_process) or die(mysqli_error());
							$check_duplicate_ready_for_printing_process = mysqli_num_rows($result_duplicate_ready_for_printing_process);


							if ($check_duplicate_ready_for_printing_process >= 1) 
							{
					           echo " ready_for_printing Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_ready_for_printing_process = "select * from `defining_qc_standard_for_ready_for_printing_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_ready_for_printing_process = mysqli_query($con,$old_pp_version_ready_for_printing_process) or die(mysqli_error());
							    $row_old_pp_version_ready_for_printing_process = mysqli_fetch_array($result_old_pp_version_ready_for_printing_process);

								$standard_for_which_process= $row_old_pp_version_ready_for_printing_process['standard_for_which_process'];	


								$test_method_for_whiteness= $row_old_pp_version_ready_for_printing_process['test_method_for_whiteness'];
								 $whiteness_min_value= $row_old_pp_version_ready_for_printing_process['whiteness_min_value'];
								 $whiteness_max_value= $row_old_pp_version_ready_for_printing_process['whiteness_max_value'];
								 $uom_of_whiteness= $row_old_pp_version_ready_for_printing_process['uom_of_whiteness'];


								 $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_printing_process['test_method_for_bowing_and_skew'];
								 $bowing_and_skew_tolerance_range_math_operator= $row_old_pp_version_ready_for_printing_process['bowing_and_skew_tolerance_range_math_operator'];
								 $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_printing_process['bowing_and_skew_tolerance_value'];
								 $bowing_and_skew_min_value= $row_old_pp_version_ready_for_printing_process['bowing_and_skew_min_value'];
								 $bowing_and_skew_max_value= $row_old_pp_version_ready_for_printing_process['bowing_and_skew_max_value'];
								 $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_printing_process['uom_of_bowing_and_skew'];


								 
								 $test_method_for_ph= $row_old_pp_version_ready_for_printing_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_ready_for_printing_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_ready_for_printing_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_ready_for_printing_process['uom_of_ph'];



									$insert_sql_statement_for_ready_for_printing="INSERT INTO `defining_qc_standard_for_ready_for_printing_process`
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

									                       `test_method_for_bowing_and_skew`, 
									                       `bowing_and_skew_tolerance_range_math_operator`, 
									                       `bowing_and_skew_tolerance_value`, 
									                       `bowing_and_skew_min_value`, 
									                       `bowing_and_skew_max_value`, 
									                       `uom_of_bowing_and_skew`,

									                       `test_method_for_ph`, 
									                       `ph_min_value`, 
									                       `ph_max_value`,
									                       `uom_of_ph`,  

									                       `recording_person_id`, 
									                       `recording_person_name`, 
									                       `recording_time`
									                       )
									                        VALUES 
									                        (
									                        '$pp_number',
									                        '$version_id',
									                        '$version_name',
									                        '$customer_name',
									                        '$customer_id',
									                        '$color',
									                        '$finish_width_in_inch',
									                        '$standard_for_which_process',

									                        
									                        '$test_method_for_whiteness',
									                        '$whiteness_min_value',
									                        '$whiteness_max_value',
								                             '$uom_of_whiteness',

									                        '$test_method_for_bowing_and_skew',
									                        '$bowing_and_skew_tolerance_range_math_operator',
									                        '$bowing_and_skew_tolerance_value',
									                        '$bowing_and_skew_min_value',
									                        '$bowing_and_skew_max_value',
									                        '$uom_of_bowing_and_skew',

									                        '$test_method_for_ph',
									                        '$ph_min_value',
									                        '$ph_max_value',
									                        '$uom_of_ph',

									                        '$user_id',
									                        '$user_name',
									                         NOW()
									                          )";


									mysqli_query($con,$insert_sql_statement_for_ready_for_printing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for ready_for_printing..............................................................//




							/*............................................................Copy ready_for_raising..............................................................*/


			                $duplicate_ready_for_raising_process="select * from `defining_qc_standard_for_ready_for_raising_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_ready_for_raising_process= mysqli_query($con,$duplicate_ready_for_raising_process) or die(mysqli_error());
							$check_duplicate_ready_for_raising_process = mysqli_num_rows($result_duplicate_ready_for_raising_process);


							if ($check_duplicate_ready_for_raising_process >= 1) 
							{
					           echo " ready_for_raising Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_ready_for_raising_process = "select * from `defining_qc_standard_for_ready_for_raising_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_ready_for_raising_process = mysqli_query($con,$old_pp_version_ready_for_raising_process) or die(mysqli_error());
							    $row_old_pp_version_ready_for_raising_process = mysqli_fetch_array($result_old_pp_version_ready_for_raising_process);

								$standard_for_which_process= $row_old_pp_version_ready_for_raising_process['standard_for_which_process'];	


								$test_method_for_tensile_properties_in_warp= $row_old_pp_version_ready_for_raising_process['test_method_for_tensile_properties_in_warp'];
								$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
								$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_tolerance_value'];
								$tensile_properties_in_warp_value_min_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_min_value'];
								$tensile_properties_in_warp_value_max_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_max_value'];
								$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_ready_for_raising_process['uom_of_tensile_properties_in_warp_value'];

								$test_method_for_tensile_properties_in_weft= $row_old_pp_version_ready_for_raising_process['test_method_for_tensile_properties_in_weft'];
								$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
								$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_tolerance_value'];
								$tensile_properties_in_weft_value_min_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_min_value'];
								$tensile_properties_in_weft_value_max_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_max_value'];
								$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_ready_for_raising_process['uom_of_tensile_properties_in_weft_value'];

								$test_method_for_tear_force_in_warp= $row_old_pp_version_ready_for_raising_process['test_method_for_tear_force_in_warp'];
								$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_tolerance_range_math_operator'];
								$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_tolerance_value'];
								$tear_force_in_warp_value_min_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_min_value'];
								$tear_force_in_warp_value_max_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_max_value'];
								$uom_of_tear_force_in_warp_value= $row_old_pp_version_ready_for_raising_process['uom_of_tear_force_in_warp_value'];

								$test_method_for_tear_force_in_weft= $row_old_pp_version_ready_for_raising_process['test_method_for_tear_force_in_weft'];
								$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'];
								$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_tolerance_value'];
								$tear_force_in_weft_value_min_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_min_value'];
								$tear_force_in_weft_value_max_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_max_value'];
								$uom_of_tear_force_in_weft_value= $row_old_pp_version_ready_for_raising_process['uom_of_tear_force_in_weft_value'];



									$insert_sql_statement_for_ready_for_raising="INSERT INTO `defining_qc_standard_for_ready_for_raising_process`( 
									  `pp_number`, 
									  `version_id`, 
									  `version_number`, 
									  `customer_name`, 
								        `customer_id`, 
									  `color`, 
									  `finish_width_in_inch`,
									  `standard_for_which_process`, 


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


										  `recording_person_id`, 
										  `recording_person_name`, 
										  `recording_time` 
								        ) 

								       VALUES 
								        (
								      '$pp_number',
								      '$version_id',
								      '$version_name',
								      '$customer_name',
								      '$customer_id',
								      '$color',
								      '$finish_width_in_inch',
								      '$standard_for_which_process',


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

								       '$user_id',
								       '$user_name',
								        NOW()
									        )";


									mysqli_query($con,$insert_sql_statement_for_ready_for_raising) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for ready_for_raising..............................................................//





							/*............................................................Copy sanforizing.............................................................*/


			                $duplicate_sanforizing_process="select * from `defining_qc_standard_for_sanforizing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
				$result_duplicate_sanforizing_process= mysqli_query($con,$duplicate_sanforizing_process) or die(mysqli_error());
				$check_duplicate_sanforizing_process = mysqli_num_rows($result_duplicate_sanforizing_process);


				if ($check_duplicate_sanforizing_process >= 1) 
				{
		           echo "sanforizing Data is Previously saved";
				}

				else
				{

                    $old_pp_version_sanforizing_process = "select * from `defining_qc_standard_for_sanforizing_process` where `version_id`='$old_version_name'";
				    $result_old_pp_version_sanforizing_process = mysqli_query($con,$old_pp_version_sanforizing_process) or die(mysqli_error());
				    $row_old_pp_version_sanforizing_process = mysqli_fetch_array($result_old_pp_version_sanforizing_process);

					
					//copy caledering process data
					$standard_for_which_process= $row_old_pp_version_sanforizing_process['standard_for_which_process'];

					$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_sanforizing_process['test_method_for_cf_to_rubbing_dry'];
					$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
					$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_tolerance_value'];
					$cf_to_rubbing_dry_min_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_min_value'];
					$cf_to_rubbing_dry_max_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_max_value'];
					$uom_of_cf_to_rubbing_dry= $row_old_pp_version_sanforizing_process['uom_of_cf_to_rubbing_dry'];

					$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_sanforizing_process['test_method_for_cf_to_rubbing_wet'];
					$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
					$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_tolerance_value'];
					$cf_to_rubbing_wet_min_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_min_value'];
					$cf_to_rubbing_wet_max_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_max_value'];
					$uom_of_cf_to_rubbing_wet= $row_old_pp_version_sanforizing_process['uom_of_cf_to_rubbing_wet'];

					$test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
					$washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_warp_for_washing_before_iron'];
					$dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
					$dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
					$uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

					$test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
					$washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_weft_for_washing_before_iron'];
					$dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
					$dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
					$uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];


					$test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
					$washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_warp_for_washing_after_iron'];
					$dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
					$dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
					$uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

					$test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
					$washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_weft_for_washing_after_iron'];
					$dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
					$dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
					$uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];

					$test_method_for_warp_yarn_count= $row_old_pp_version_sanforizing_process['test_method_for_warp_yarn_count'];
					$warp_yarn_count_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_value'];
					$warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['warp_yarn_count_tolerance_range_math_operator'];
					$warp_yarn_count_tolerance_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_tolerance_value'];
					$warp_yarn_count_min_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_min_value'];
					$warp_yarn_count_max_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_max_value'];
					$uom_of_warp_yarn_count_value= $row_old_pp_version_sanforizing_process['uom_of_warp_yarn_count_value'];

					$test_method_for_weft_yarn_count= $row_old_pp_version_sanforizing_process['test_method_for_weft_yarn_count'];
					$weft_yarn_count_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_value'];
					$weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['weft_yarn_count_tolerance_range_math_operator'];
					$weft_yarn_count_tolerance_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_tolerance_value'];
					$weft_yarn_count_min_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_min_value'];
					$weft_yarn_count_max_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_max_value'];
					$uom_of_weft_yarn_count_value= $row_old_pp_version_sanforizing_process['uom_of_weft_yarn_count_value'];

					$test_method_for_no_of_threads_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_no_of_threads_in_warp'];
					$no_of_threads_in_warp_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_value'];
					$no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_tolerance_range_math_operator'];
					$no_of_threads_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_tolerance_value'];
					$no_of_threads_in_warp_min_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_min_value'];
					$no_of_threads_in_warp_max_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_max_value'];
					$uom_of_no_of_threads_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_no_of_threads_in_warp_value'];

					$test_method_for_no_of_threads_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_no_of_threads_in_weft'];
					$no_of_threads_in_weft_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_value'];
					$no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_tolerance_range_math_operator'];
					$no_of_threads_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_tolerance_value'];
					$no_of_threads_in_weft_min_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_min_value'];
					$no_of_threads_in_weft_max_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_max_value'];
					$uom_of_no_of_threads_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_no_of_threads_in_weft_value'];


					$test_method_for_mass_per_unit_per_area= $row_old_pp_version_sanforizing_process['test_method_for_mass_per_unit_per_area'];
					$mass_per_unit_per_area_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_value'];
					$mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_tolerance_range_math_operator'];
					$mass_per_unit_per_area_tolerance_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_tolerance_value'];
					$mass_per_unit_per_area_min_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_min_value'];
					$mass_per_unit_per_area_max_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_max_value'];
					$uom_of_mass_per_unit_per_area_value= $row_old_pp_version_sanforizing_process['uom_of_mass_per_unit_per_area_value'];


					$description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['description_or_type_for_surface_fuzzing_and_pilling'];
					$test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['test_method_for_surface_fuzzing_and_pilling'];
					$rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['rubs_for_surface_fuzzing_and_pilling'];
					$surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
					$surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_tolerance_value'];
					$surface_fuzzing_and_pilling_min_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_min_value'];
					$surface_fuzzing_and_pilling_max_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_max_value'];
					$uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_sanforizing_process['uom_of_surface_fuzzing_and_pilling_value'];


					$test_method_for_tensile_properties_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_tensile_properties_in_warp'];
					$tensile_properties_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
					$tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_tolerance_value'];
					$tensile_properties_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_min_value'];
					$tensile_properties_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_max_value'];
					$uom_of_tensile_properties_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_tensile_properties_in_warp_value'];

					$tensile_properties_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['test_method_for_tensile_properties_in_weft'];
					$test_method_for_tensile_properties_in_weft= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
					$tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_tolerance_value'];
					$tensile_properties_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_min_value'];
					$tensile_properties_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_max_value'];
					$uom_of_tensile_properties_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_tensile_properties_in_weft_value'];

					$test_method_for_tear_force_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_tear_force_in_warp'];
					$tear_force_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_tolerance_range_math_operator'];
					$tear_force_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_tolerance_value'];
					$tear_force_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_min_value'];
					$tear_force_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_max_value'];
					$uom_of_tear_force_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_tear_force_in_warp_value'];

					$test_method_for_tear_force_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_tear_force_in_weft'];
					$tear_force_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_tolerance_range_math_operator'];
					$tear_force_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_tolerance_value'];
					$tear_force_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_min_value'];
					$tear_force_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_max_value'];
					$uom_of_tear_force_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_tear_force_in_weft_value'];


					$test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_in_warp'];
					$seam_slippage_resistance_in_warp_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'];
					$seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_tolerance_value'];
					$seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_min_value'];
					$seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_max_value'];
					$uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_in_warp'];

					$test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_in_weft'];
					$seam_slippage_resistance_in_weft_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'];
					$seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_tolerance_value'];
					$seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_min_value'];
					$seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_max_value'];
					$uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_in_weft'];

					$test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
					$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
					$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
					$seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
					$seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
					$uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
					$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


					$test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
					$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'];
					$seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
					$seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
					$seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
					$uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
					$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];



					$test_method_for_seam_strength_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_strength_in_warp'];
					$seam_strength_in_warp_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_tolerance_range_math_operator'];
					$seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_tolerance_value'];
					$seam_strength_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_min_value'];
					$seam_strength_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_max_value'];
					$uom_of_seam_strength_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_seam_strength_in_warp_value'];

					$test_method_for_seam_strength_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_strength_in_weft'];
					$seam_strength_in_weft_value_tolerance_range_math_operator= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_tolerance_range_math_operator'];
					$seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_tolerance_value'];
					$seam_strength_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_min_value'];
					$seam_strength_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_max_value'];
					$uom_of_seam_strength_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_seam_strength_in_weft_value'];

					$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
					$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'];
					$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
					$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
					$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
					$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


					$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
					$seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'];
					$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
					$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
					$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
					$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


					$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
					$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'];
					$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
					$seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
					$seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
					$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

					$test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
					$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'];
					$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
					$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
					$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
					$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


					 $insert_sql_statement_for_sanforizing="INSERT INTO `defining_qc_standard_for_sanforizing_process`( 
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

				         `test_method_for_seam_slippage_resistance_iso_2_warp`, 
				         `seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op`, 
				         `seam_slippage_resistance_iso_2_in_warp_tolerance_value`, 
				         `seam_slippage_resistance_iso_2_in_warp_min_value`, 
				         `seam_slippage_resistance_iso_2_in_warp_max_value`, 
				         `uom_of_seam_slippage_resistance_iso_2_in_warp`, 
				         `uom_of_seam_slippage_resistance_iso_2_in_warp_for_load`, 

				        `test_method_for_seam_slippage_resistance_iso_2_weft`, 
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
					     '$version_name',
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

					       '$test_method_for_seam_slippage_resistance_iso_2_weft',
					       '$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op',
					        '$seam_slippage_resistance_iso_2_in_weft_tolerance_value',
					        '$seam_slippage_resistance_iso_2_in_weft_min_value',
					        '$seam_slippage_resistance_iso_2_in_weft_max_value',
					        '$uom_of_seam_slippage_resistance_iso_2_in_weft',
					        '$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load',

					       '$test_method_for_seam_slippage_resistance_iso_2_warp',
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

                      $result_of_data_for_sanforizing = mysqli_query($con,$insert_sql_statement_for_sanforizing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for sanforizing.............................................................//


							/*............................................................Copy scouring_bleaching..............................................................*/


			                $duplicate_scouring_bleaching_process="select * from `defining_qc_standard_for_scouring_bleaching_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_scouring_bleaching_process= mysqli_query($con,$duplicate_scouring_bleaching_process) or die(mysqli_error());
							$check_duplicate_scouring_bleaching_process = mysqli_num_rows($result_duplicate_scouring_bleaching_process);


							if ($check_duplicate_scouring_bleaching_process >= 1) 
							{
					           echo " scouring_bleaching Data is Previously saved";
							}

							else
							{

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




									$insert_sql_statement_for_scouring_bleaching="insert into `defining_qc_standard_for_scouring_bleaching_process` 
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
								                        '$version_name',
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


									mysqli_query($con,$insert_sql_statement_for_scouring_bleaching) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for scouring_bleaching..............................................................//




							/*............................................................Copy scouring..............................................................*/


			                $duplicate_scouring_process="select * from `defining_qc_standard_for_scouring_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_scouring_process= mysqli_query($con,$duplicate_scouring_process) or die(mysqli_error());
							$check_duplicate_scouring_process = mysqli_num_rows($result_duplicate_scouring_process);


							if ($check_duplicate_scouring_process >= 1) 
							{
					           echo " scouring Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_scouring_process = "select * from `defining_qc_standard_for_scouring_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_scouring_process = mysqli_query($con,$old_pp_version_scouring_process) or die(mysqli_error());
							    $row_old_pp_version_scouring_process = mysqli_fetch_array($result_old_pp_version_scouring_process);

								$standard_for_which_process= $row_old_pp_version_scouring_process['standard_for_which_process'];	


								$test_method_for_residual_sizing_material= $row_old_pp_version_scouring_process['test_method_for_residual_sizing_material'];
								$residual_sizing_material_min_value= $row_old_pp_version_scouring_process['residual_sizing_material_min_value'];
								$residual_sizing_material_max_value= $row_old_pp_version_scouring_process['residual_sizing_material_max_value'];
								$uom_of_residual_sizing_material= $row_old_pp_version_scouring_process['uom_of_residual_sizing_material'];


								$test_method_for_absorbency= $row_old_pp_version_scouring_process['test_method_for_absorbency'];
								$absorbency_min_value= $row_old_pp_version_scouring_process['absorbency_min_value'];
								$absorbency_max_value= $row_old_pp_version_scouring_process['absorbency_max_value'];
								$uom_of_absorbency= $row_old_pp_version_scouring_process['uom_of_absorbency'];

								$test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
								$resistance_to_surface_fuzzing_and_pilling_min_value= $row_old_pp_version_scouring_process['resistance_to_surface_fuzzing_and_pilling_min_value'];
								$resistance_to_surface_fuzzing_and_pilling_max_value= $row_old_pp_version_scouring_process['resistance_to_surface_fuzzing_and_pilling_max_value'];
								$uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

								 
								 $test_method_for_ph= $row_old_pp_version_scouring_process['test_method_for_ph'];
								 $ph_min_value= $row_old_pp_version_scouring_process['ph_min_value'];
								 $ph_max_value= $row_old_pp_version_scouring_process['ph_max_value'];
								 $uom_of_ph= $row_old_pp_version_scouring_process['uom_of_ph'];


									$insert_sql_statement_for_scouring="insert into `defining_qc_standard_for_scouring_process` 
									                     ( 
									                     `pp_number`,
									                     `version_id`,
									                     `version_number`,
									                     `customer_name`,
									                     `customer_id`,
									                     `color`,
									                     `finish_width_in_inch`,
									                     `standard_for_which_process`,


								                         `test_method_for_residual_sizing_material`,
									                     `residual_sizing_material_min_value`,
									                     `residual_sizing_material_max_value`,
									                     `uom_of_residual_sizing_material`,

									                     `test_method_for_absorbency`,
									                     `absorbency_min_value`,
									                     `absorbency_max_value`,
									                     `uom_of_absorbency`,

									                     `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
									                     `resistance_to_surface_fuzzing_and_pilling_min_value`,
									                     `resistance_to_surface_fuzzing_and_pilling_max_value`,
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
								                        '$version_name',
								                        '$customer_name',
								                        '$customer_id',
								                        '$color',
								                        '$finish_width_in_inch',
								                        '$standard_for_which_process',

								                        
								                        '$test_method_for_residual_sizing_material',
								                        '$residual_sizing_material_min_value',
								                        '$residual_sizing_material_max_value',
								                        '$uom_of_residual_sizing_material',

								                        '$test_method_for_absorbency',
								                        '$absorbency_min_value',
								                        '$absorbency_max_value',
								                        '$uom_of_absorbency',
								                        
								                        '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
								                        '$resistance_to_surface_fuzzing_and_pilling_min_value',
								                        '$resistance_to_surface_fuzzing_and_pilling_max_value',
								                        '$uom_of_resistance_to_surface_fuzzing_and_pilling',

								                        
								                        '$test_method_for_ph',
								                        '$ph_min_value',
								                        '$ph_max_value',
								                        '$uom_of_ph',


								                         '$user_id',
								                         '$user_name',
								                          NOW()
								                         )";


									mysqli_query($con,$insert_sql_statement_for_scouring) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for scouring..............................................................//





							/*............................................................Copy singe_and_desize..............................................................*/


			                $duplicate_singe_and_desize_process="select * from `defining_qc_standard_for_singe_and_desize_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_singe_and_desize_process= mysqli_query($con,$duplicate_singe_and_desize_process) or die(mysqli_error());
							$check_duplicate_singe_and_desize_process = mysqli_num_rows($result_duplicate_singe_and_desize_process);


							if ($check_duplicate_singe_and_desize_process >= 1) 
							{
					           echo " singe_and_desize Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_singe_and_desize_process = "select * from `defining_qc_standard_for_singe_and_desize_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_singe_and_desize_process = mysqli_query($con,$old_pp_version_singe_and_desize_process) or die(mysqli_error());
							    $row_old_pp_version_singe_and_desize_process = mysqli_fetch_array($result_old_pp_version_singe_and_desize_process);

								$standard_for_which_process= $row_old_pp_version_singe_and_desize_process['standard_for_which_process'];	


								$test_method_for_flame_intensity= $row_old_pp_version_singe_and_desize_process['test_method_for_flame_intensity'];
								$uom_of_flame_intensity= $row_old_pp_version_singe_and_desize_process['uom_of_flame_intensity'];
								$flame_intensity_min_value= $row_old_pp_version_singe_and_desize_process['flame_intensity_min_value'];
								$flame_intensity_max_value= $row_old_pp_version_singe_and_desize_process['flame_intensity_max_value'];

								$test_method_for_machine_speed= $row_old_pp_version_singe_and_desize_process['test_method_for_machine_speed'];
								$uom_of_machine_speed= $row_old_pp_version_singe_and_desize_process['uom_of_machine_speed'];
								$machine_speed_min_value= $row_old_pp_version_singe_and_desize_process['machine_speed_min_value'];
								$machine_speed_max_value= $row_old_pp_version_singe_and_desize_process['machine_speed_max_value'];

								$test_method_for_bath_temperature= $row_old_pp_version_singe_and_desize_process['test_method_for_bath_temperature'];
								$uom_of_bath_temperature= $row_old_pp_version_singe_and_desize_process['uom_of_bath_temperature'];
								$bath_temperature_min_value= $row_old_pp_version_singe_and_desize_process['bath_temperature_min_value'];
								$bath_temperature_max_value= $row_old_pp_version_singe_and_desize_process['bath_temperature_max_value'];

								$test_method_for_bath_ph= $row_old_pp_version_singe_and_desize_process['test_method_for_bath_ph'];
								$uom_of_bath_ph= $row_old_pp_version_singe_and_desize_process['uom_of_bath_ph'];
								$bath_ph_min_value= $row_old_pp_version_singe_and_desize_process['bath_ph_min_value'];
								$bath_ph_max_value= $row_old_pp_version_singe_and_desize_process['bath_ph_max_value'];



									$insert_sql_statement_for_singe_and_desize="insert into `defining_qc_standard_for_singe_and_desize_process`
									 ( 
									 `pp_number`,
									 `version_id`,
									 `version_number`,
									 `customer_name`,
									 `customer_id`,
									 `color`,
									 `finish_width_in_inch`,
									 `standard_for_which_process`,

									 `test_method_for_flame_intensity`,
									 `uom_of_flame_intensity`,
									 `flame_intensity_min_value`,
									 `flame_intensity_max_value`,

									 `test_method_for_machine_speed`,
									 `uom_of_machine_speed`,
									 `machine_speed_min_value`,
									 `machine_speed_max_value`,

									 `test_method_for_bath_temperature`,
									 `uom_of_bath_temperature`,
									 `bath_temperature_min_value`,
									 `bath_temperature_max_value`,

									 `test_method_for_bath_ph`,
									 `uom_of_bath_ph`,
									 `bath_ph_min_value`,
								     `bath_ph_max_value`,
								     `recording_person_id`,
								     `recording_person_name`,
								     `recording_time` ) 
								     values 
								     (
								     '$pp_number',
								     '$version_id',
								     '$version_name',
								     '$customer_name',
								     '$customer_id',
								     '$color',$finish_width_in_inch,
								     '$standard_for_which_process',

								     '$test_method_for_flame_intensity',
								     '$uom_of_flame_intensity',
								     '$flame_intensity_min_value',
								     '$flame_intensity_max_value',

								     '$test_method_for_machine_speed',
								     '$uom_of_machine_speed',
								     '$machine_speed_min_value',
								     '$machine_speed_max_value',

								     '$test_method_for_bath_temperature','
								     $uom_of_bath_temperature',
								     '$bath_temperature_min_value',
								     '$bath_temperature_max_value',

								     '$test_method_for_bath_ph',
								     '$uom_of_bath_ph',
								     '$bath_ph_min_value',
								     '$bath_ph_max_value',
								     '$user_id',
								     '$user_name',
								      NOW()
								       )";


									mysqli_query($con,$insert_sql_statement_for_singe_and_desize) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for singe_and_desize..............................................................//






      /*............................................................Copy washing..............................................................*/


			                $duplicate_washing_process="select * from `defining_qc_standard_for_washing_process` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";
							$result_duplicate_washing_process= mysqli_query($con,$duplicate_washing_process) or die(mysqli_error());
							$check_duplicate_washing_process = mysqli_num_rows($result_duplicate_washing_process);


							if ($check_duplicate_washing_process >= 1) 
							{
					           echo " washing Data is Previously saved";
							}

							else
							{

			                    $old_pp_version_washing_process = "select * from `defining_qc_standard_for_washing_process` where `version_id`='$old_version_name'";
							    $result_old_pp_version_washing_process = mysqli_query($con,$old_pp_version_washing_process) or die(mysqli_error());
							    $row_old_pp_version_washing_process = mysqli_fetch_array($result_old_pp_version_washing_process);

								$standard_for_which_process= $row_old_pp_version_washing_process['standard_for_which_process'];	


								$test_method_for_cf_to_rubbing_dry= $row_old_pp_version_washing_process['test_method_for_cf_to_rubbing_dry'];
								$cf_to_rubbing_dry_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_rubbing_dry_tolerance_range_math_operator'];
								$cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_tolerance_value'];
								$cf_to_rubbing_dry_min_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_min_value'];
								$cf_to_rubbing_dry_max_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_max_value'];
								$uom_of_cf_to_rubbing_dry= $row_old_pp_version_washing_process['uom_of_cf_to_rubbing_dry'];

								$test_method_for_cf_to_rubbing_wet= $row_old_pp_version_washing_process['test_method_for_cf_to_rubbing_wet'];
								$cf_to_rubbing_wet_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_rubbing_wet_tolerance_range_math_operator'];
								$cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_tolerance_value'];
								$cf_to_rubbing_wet_min_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_min_value'];
								$cf_to_rubbing_wet_max_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_max_value'];
								$uom_of_cf_to_rubbing_wet= $row_old_pp_version_washing_process['uom_of_cf_to_rubbing_wet'];

								$test_method_for_cf_to_washing_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_color_change'];
								$cf_to_washing_color_change_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_washing_color_change_tolerance_range_math_operator'];
								$cf_to_washing_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_tolerance_value'];
								$cf_to_washing_color_change_min_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_min_value'];
								$cf_to_washing_color_change_max_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_max_value'];
								$uom_of_cf_to_washing_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_washing_color_change'];

								$test_method_for_cf_to_washing_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_staining'];
								$cf_to_washing_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_washing_staining_tolerance_range_math_operator'];
								$cf_to_washing_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_staining_tolerance_value'];
								$cf_to_washing_staining_min_value= $row_old_pp_version_washing_process['cf_to_washing_staining_min_value'];
								$cf_to_washing_staining_max_value= $row_old_pp_version_washing_process['cf_to_washing_staining_max_value'];
								$uom_of_cf_to_washing_staining= $row_old_pp_version_washing_process['uom_of_cf_to_washing_staining'];

								$test_method_for_cf_to_washing_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_cross_staining'];
								$cf_to_washing_cross_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_tolerance_range_math_operator'];
								$cf_to_washing_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_tolerance_value'];
								$cf_to_washing_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_min_value'];
								$cf_to_washing_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_max_value'];
								$uom_of_cf_to_washing_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_washing_cross_staining'];


								$test_method_for_cf_to_dry_cleaning_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_dry_cleaning_color_change'];
								$cf_to_dry_cleaning_color_change_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'];
								$cf_to_dry_cleaning_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_tolerance_value'];
								$cf_to_dry_cleaning_color_change_min_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_min_value'];
								$cf_to_dry_cleaning_color_change_max_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_max_value'];
								$uom_of_cf_to_dry_cleaning_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_dry_cleaning_color_change'];

								$test_method_for_cf_to_dry_cleaning_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_dry_cleaning_staining'];
								$cf_to_dry_cleaning_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'];
								$cf_to_dry_cleaning_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_tolerance_value'];
								$cf_to_dry_cleaning_staining_min_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_min_value'];
								$cf_to_dry_cleaning_staining_max_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_max_value'];
								$uom_of_cf_to_dry_cleaning_staining= $row_old_pp_version_washing_process['uom_of_cf_to_dry_cleaning_staining'];



								$test_method_for_perspiration_acid_color_change= $row_old_pp_version_washing_process['test_method_for_perspiration_acid_color_change'];
								$cf_to_perspiration_acid_color_change_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'];
								$cf_to_perspiration_acid_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_tolerance_value'];
								$cf_to_perspiration_acid_color_change_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_min_value'];
								$cf_to_perspiration_acid_color_change_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_max_value'];
								$uom_of_cf_to_perspiration_acid_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_color_change'];

								$test_method_for_cf_to_perspiration_acid_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_acid_staining'];
								$cf_to_perspiration_acid_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'];
								$cf_to_perspiration_acid_staining_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_value'];
								$cf_to_perspiration_acid_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_min_value'];
								$cf_to_perspiration_acid_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_max_value'];
								$uom_of_cf_to_perspiration_acid_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_staining'];


								$test_method_for_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_acid_cross_staining'];
								$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'];
								$cf_to_perspiration_acid_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
								$cf_to_perspiration_acid_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_min_value'];
								$cf_to_perspiration_acid_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_max_value'];
								$uom_of_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_cross_staining'];

								$test_method_for_cf_to_perspiration_alkali_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_color_change'];
								$cf_to_perspiration_alkali_color_change_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'];
								$cf_to_perspiration_alkali_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
								$cf_to_perspiration_alkali_color_change_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_min_value'];
								$cf_to_perspiration_alkali_color_change_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_max_value'];
								$uom_of_cf_to_perspiration_alkali_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_color_change'];


								$test_method_for_cf_to_perspiration_alkali_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_staining'];
								$cf_to_perspiration_alkali_staining_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'];
								$cf_to_perspiration_alkali_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_tolerance_value'];
								$cf_to_perspiration_alkali_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_min_value'];
								$cf_to_perspiration_alkali_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_max_value'];
								$uom_of_cf_to_perspiration_alkali_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_staining'];

								$test_method_for_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_cross_staining'];
								$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'];
								$cf_to_perspiration_alkali_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
								$cf_to_perspiration_alkali_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_min_value'];
								$cf_to_perspiration_alkali_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_max_value'];
								$uom_of_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_cross_staining'];

								$test_method_for_cf_to_water_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_water_color_change'];
								$cf_to_water_color_change_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_water_color_change_tolerance_range_math_operator'];
								$cf_to_water_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_color_change_tolerance_value'];
								$cf_to_water_color_change_min_value= $row_old_pp_version_washing_process['cf_to_water_color_change_min_value'];
								$cf_to_water_color_change_max_value= $row_old_pp_version_washing_process['cf_to_water_color_change_max_value'];
								$uom_of_cf_to_water_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_water_color_change'];

								$test_method_for_cf_to_water_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_staining'];
								$cf_to_water_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_water_staining_tolerance_range_math_operator'];
								$cf_to_water_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_staining_tolerance_value'];
								$cf_to_water_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_staining_min_value'];
								$cf_to_water_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_staining_max_value'];
								$uom_of_cf_to_water_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_staining'];

								$test_method_for_cf_to_water_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_cross_staining'];
								$cf_to_water_cross_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_water_cross_staining_tolerance_range_math_operator'];
								$cf_to_water_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_tolerance_value'];
								$cf_to_water_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_min_value'];
								$cf_to_water_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_max_value'];
								$uom_of_cf_to_water_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_cross_staining'];

								$test_method_for_cf_to_water_spotting_surface= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_surface'];
								$cf_to_water_spotting_surface_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_tolerance_range_math_op'];
								$cf_to_water_spotting_surface_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_tolerance_value'];
								$cf_to_water_spotting_surface_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_min_value'];
								$cf_to_water_spotting_surface_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_max_value'];
								$uom_of_cf_to_water_spotting_surface= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_surface'];

								$test_method_for_cf_to_water_spotting_edge= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_edge'];
								$cf_to_water_spotting_edge_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_tolerance_range_math_op'];
								$cf_to_water_spotting_edge_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_tolerance_value'];
								$cf_to_water_spotting_edge_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_min_value'];
								$cf_to_water_spotting_edge_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_max_value'];
								$uom_of_cf_to_water_spotting_edge= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_edge'];


								$test_method_for_cf_to_water_spotting_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_cross_staining'];
								$cf_to_water_spotting_cross_staining_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'];
								$cf_to_water_spotting_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_tolerance_value'];
								$cf_to_water_spotting_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_min_value'];
								$cf_to_water_spotting_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_max_value'];
								$uom_of_cf_to_water_spotting_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_cross_staining'];



								$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'];
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
								$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
								$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
								$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


								$test_method_for_cf_to_oxidative_bleach_damage_color_cange= $row_old_pp_version_washing_process['test_method_for_cf_to_oxidative_bleach_damage_color_cange'];
								$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'];
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
								$cf_to_oxidative_bleach_damage_color_change_min_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_min_value'];
								$cf_to_oxidative_bleach_damage_color_change_max_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_max_value'];
								$uom_of_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_oxidative_bleach_damage_color_change'];




								$test_method_for_cf_to_phenolic_yellowing_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_phenolic_yellowing_staining'];
								$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'];
								$cf_to_phenolic_yellowing_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
								$cf_to_phenolic_yellowing_staining_min_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_min_value'];
								$cf_to_phenolic_yellowing_staining_max_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_max_value'];
								$uom_of_cf_to_phenolic_yellowing_staining= $row_old_pp_version_washing_process['uom_of_cf_to_phenolic_yellowing_staining'];


								$cf_to_pvc_migration_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'];
								$cf_to_pvc_migration_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_tolerance_value'];
								$cf_to_pvc_migration_staining_min_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_min_value'];
								$cf_to_pvc_migration_staining_max_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_max_value'];
								$uom_of_cf_to_pvc_migration_staining= $row_old_pp_version_washing_process['uom_of_cf_to_pvc_migration_staining'];


								$test_method_for_cf_to_saliva_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_saliva_staining'];
								$cf_to_saliva_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_saliva_staining_tolerance_range_math_operator'];
								$cf_to_saliva_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_tolerance_value'];
								$cf_to_saliva_staining_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_staining_min_value'];
								$cf_to_saliva_staining_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_staining_min_value'];
								$cf_to_saliva_staining_max_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_max_value'];
								$uom_of_cf_to_saliva_staining= $row_old_pp_version_washing_process['uom_of_cf_to_saliva_staining'];

								$test_method_for_cf_to_saliva_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_saliva_color_change'];
								$cf_to_saliva_color_change_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_saliva_color_change_tolerance_range_math_operator'];
								$cf_to_saliva_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_tolerance_value'];
								$cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_staining_min_value'];
								$cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_staining_min_value'];
								$cf_to_saliva_color_change_max_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_max_value'];
								$uom_of_cf_to_saliva_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_saliva_color_change'];


								$test_method_for_cf_to_chlorinated_water_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_chlorinated_water_color_change'];
								$cf_to_chlorinated_water_color_change_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'];
								$cf_to_chlorinated_water_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_tolerance_value'];
								$cf_to_chlorinated_water_color_change_min_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_min_value'];
								$cf_to_chlorinated_water_color_change_max_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_max_value'];
								$uom_of_cf_to_chlorinated_water_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_chlorinated_water_color_change'];

								$test_method_for_cf_to_cholorine_bleach_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_cholorine_bleach_color_change'];
								$cf_to_cholorine_bleach_color_change_tolerance_range_math_op= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'];
								$cf_to_cholorine_bleach_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
								$cf_to_cholorine_bleach_color_change_min_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_min_value'];
								$cf_to_cholorine_bleach_color_change_max_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_max_value'];
								$uom_of_cf_to_cholorine_bleach_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_cholorine_bleach_color_change'];


								$test_method_for_cf_to_peroxide_bleach_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_peroxide_bleach_color_change'];
								$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'];
								$cf_to_peroxide_bleach_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
								$cf_to_peroxide_bleach_color_change_min_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_min_value'];
								$cf_to_peroxide_bleach_color_change_max_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_max_value'];
								$uom_of_cf_to_peroxide_bleach_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_peroxide_bleach_color_change'];

								$test_method_for_cross_staining= $row_old_pp_version_washing_process['test_method_for_cross_staining'];
								$cross_staining_tolerance_range_math_operator= $row_old_pp_version_washing_process['cross_staining_tolerance_range_math_operator'];
								$cross_staining_tolerance_value= $row_old_pp_version_washing_process['cross_staining_tolerance_value'];
								$cross_staining_min_value= $row_old_pp_version_washing_process['cross_staining_min_value'];
								$cross_staining_max_value= $row_old_pp_version_washing_process['cross_staining_max_value'];
								$uom_of_cross_staining= $row_old_pp_version_washing_process['uom_of_cross_staining'];



								$test_method_for_ph= $row_old_pp_version_washing_process['test_method_for_ph'];
								$ph_value_tolerance_range_math_operator= $row_old_pp_version_washing_process['ph_value_tolerance_range_math_operator'];
								$ph_value_tolerance_value= $row_old_pp_version_washing_process['ph_value_tolerance_value'];
								$ph_value_min_value= $row_old_pp_version_washing_process['ph_value_min_value'];
								$ph_value_max_value= $row_old_pp_version_washing_process['ph_value_max_value'];
								$uom_of_ph_value= $row_old_pp_version_washing_process['uom_of_ph_value'];



									$insert_sql_statement_for_washing="INSERT INTO `defining_qc_standard_for_washing_process`( 
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

									  `test_method_for_cf_to_washing_color_change`, 
									  `cf_to_washing_color_change_tolerance_range_math_operator`, 
								      `cf_to_washing_color_change_tolerance_value`, 
								      `cf_to_washing_color_change_min_value`, 
								      `cf_to_washing_color_change_max_value`, 
								      `uom_of_cf_to_washing_color_change`, 

								      `test_method_for_cf_to_washing_staining`, 
								      `cf_to_washing_staining_tolerance_range_math_operator`, 
								      `cf_to_washing_staining_tolerance_value`, 
								      `cf_to_washing_staining_min_value`, 
								      `cf_to_washing_staining_max_value`, 
								      `uom_of_cf_to_washing_staining`, 

								      `test_method_for_cf_to_washing_cross_staining`, 
								      `cf_to_washing_cross_staining_tolerance_range_math_operator`, 
								      `cf_to_washing_cross_staining_tolerance_value`, 
								      `cf_to_washing_cross_staining_min_value`, 
								      `cf_to_washing_cross_staining_max_value`, 
								      `uom_of_cf_to_washing_cross_staining`, 

								      `test_method_for_cf_to_dry_cleaning_color_change`, 
								      `cf_to_dry_cleaning_color_change_tolerance_range_math_operator`, 
								      `cf_to_dry_cleaning_color_change_tolerance_value`, 
								      `cf_to_dry_cleaning_color_change_min_value`, 
								      `cf_to_dry_cleaning_color_change_max_value`, 
								      `uom_of_cf_to_dry_cleaning_color_change`, 


								      `test_method_for_cf_to_dry_cleaning_staining`, 
								      `cf_to_dry_cleaning_staining_tolerance_range_math_operator`, 
								      `cf_to_dry_cleaning_staining_tolerance_value`, 
								      `cf_to_dry_cleaning_staining_min_value`, 
								      `cf_to_dry_cleaning_staining_max_value`, 
								      `uom_of_cf_to_dry_cleaning_staining`, 

								      `test_method_for_perspiration_acid_color_change`, 
								      `cf_to_perspiration_acid_color_change_tolerance_range_math_op`, 
								      `cf_to_perspiration_acid_color_change_tolerance_value`, 
								      `cf_to_perspiration_acid_color_change_min_value`, 
								      `cf_to_perspiration_acid_color_change_max_value`, 
								      `uom_of_cf_to_perspiration_acid_color_change`, 

								      `test_method_for_cf_to_perspiration_acid_staining`, 
								      `cf_to_perspiration_acid_staining_tolerance_range_math_operator`, 
								      `cf_to_perspiration_acid_staining_value`, 
								      `cf_to_perspiration_acid_staining_min_value`, 
								      `cf_to_perspiration_acid_staining_max_value`, 
								      `uom_of_cf_to_perspiration_acid_staining`, 

								      `test_method_for_cf_to_perspiration_acid_cross_staining`, 
								      `cf_to_perspiration_acid_cross_staining_tolerance_range_math_op`, 
								      `cf_to_perspiration_acid_cross_staining_tolerance_value`, 
								      `cf_to_perspiration_acid_cross_staining_max_value`, 
								      `cf_to_perspiration_acid_cross_staining_min_value`, 
								      `uom_of_cf_to_perspiration_acid_cross_staining`, 


								      `test_method_for_cf_to_perspiration_alkali_color_change`, 
								      `cf_to_perspiration_alkali_color_change_tolerance_range_math_op`, 
								      `cf_to_perspiration_alkali_color_change_tolerance_value`, 
								      `cf_to_perspiration_alkali_color_change_min_value`, 
								      `cf_to_perspiration_alkali_color_change_max_value`, 
								      `uom_of_cf_to_perspiration_alkali_color_change`, 

								      `test_method_for_cf_to_perspiration_alkali_staining`, 
								      `cf_to_perspiration_alkali_staining_tolerance_range_math_op`, 
								      `cf_to_perspiration_alkali_staining_tolerance_value`, 
								      `cf_to_perspiration_alkali_staining_min_value`, 
								      `cf_to_perspiration_alkali_staining_max_value`, 
								      `uom_of_cf_to_perspiration_alkali_staining`, 

								      `test_method_for_cf_to_perspiration_alkali_cross_staining`, 
								      `cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op`, 
								      `cf_to_perspiration_alkali_cross_staining_tolerance_value`, 
								      `cf_to_perspiration_alkali_cross_staining_min_value`, 
								      `cf_to_perspiration_alkali_cross_staining_max_value`, 
								      `uom_of_cf_to_perspiration_alkali_cross_staining`, 


								      `test_method_for_cf_to_water_color_change`, 
								      `cf_to_water_color_change_tolerance_range_math_operator`, 
								      `cf_to_water_color_change_tolerance_value`, 
								      `cf_to_water_color_change_min_value`, 
								      `cf_to_water_color_change_max_value`, 
								      `uom_of_cf_to_water_color_change`, 

								      `test_method_for_cf_to_water_staining`, 
								      `cf_to_water_staining_tolerance_range_math_operator`, 
								      `cf_to_water_staining_tolerance_value`, 
								      `cf_to_water_staining_min_value`, 
								      `cf_to_water_staining_max_value`, 
								      `uom_of_cf_to_water_staining`, 

								      `test_method_for_cf_to_water_cross_staining`, 
								      `cf_to_water_cross_staining_tolerance_range_math_operator`, 
								      `cf_to_water_cross_staining_tolerance_value`, 
								      `cf_to_water_cross_staining_min_value`, 
								      `cf_to_water_cross_staining_max_value`, 
								      `uom_of_cf_to_water_cross_staining`, 

								      `test_method_for_cf_to_water_spotting_surface`, 
								      `cf_to_water_spotting_surface_tolerance_range_math_op`, 
								      `cf_to_water_spotting_surface_tolerance_value`,
								      `cf_to_water_spotting_surface_min_value`, 
								      `cf_to_water_spotting_surface_max_value`, 
								      `uom_of_cf_to_water_spotting_surface`, 

								       `test_method_for_cf_to_water_spotting_edge`, 
								       `cf_to_water_spotting_edge_tolerance_range_math_op`, 
								       `cf_to_water_spotting_edge_tolerance_value`, 
								       `cf_to_water_spotting_edge_min_value`,
								       `cf_to_water_spotting_edge_max_value`, 
								       `uom_of_cf_to_water_spotting_edge`,

								       `test_method_for_cf_to_water_spotting_cross_staining`, 
								       `cf_to_water_spotting_cross_staining_tolerance_range_math_op`, 
								       `cf_to_water_spotting_cross_staining_tolerance_value`, 
								       `cf_to_water_spotting_cross_staining_min_value`, 
								       `cf_to_water_spotting_cross_staining_max_value`, 
								       `uom_of_cf_to_water_spotting_cross_staining`, 

								           

								          `test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change`, 
								          `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op`, 
								          `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value`, 
								          `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value`, 
								          `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value`, 
								          `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`, 

								          `test_method_for_cf_to_oxidative_bleach_damage_color_cange`, 
								          `cf_to_oxidative_bleach_damage_color_change_tol_range_math_op`, 
								          `cf_to_oxidative_bleach_damage_color_change_tolerance_value`, 
								          `cf_to_oxidative_bleach_damage_color_change_min_value`, 
								          `cf_to_oxidative_bleach_damage_color_change_max_value`, 
								          `uom_of_cf_to_oxidative_bleach_damage_color_change`, 

								          `test_method_for_cf_to_phenolic_yellowing_staining`, 
								          `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator`, 
								          `cf_to_phenolic_yellowing_staining_tolerance_value`, 
								          `cf_to_phenolic_yellowing_staining_min_value`, 
								          `cf_to_phenolic_yellowing_staining_max_value`, 
								          `uom_of_cf_to_phenolic_yellowing_staining`, 

								          `cf_to_pvc_migration_staining_tolerance_range_math_operator`, 
								          `cf_to_pvc_migration_staining_tolerance_value`, 
								          `cf_to_pvc_migration_staining_min_value`, 
								          `cf_to_pvc_migration_staining_max_value`, 
								          `uom_of_cf_to_pvc_migration_staining`, 

								          `test_method_for_cf_to_saliva_color_change`, 
								          `cf_to_saliva_color_change_tolerance_range_math_operator`, 
								          `cf_to_saliva_color_change_tolerance_value`, 
								          `cf_to_saliva_color_change_staining_min_value`, 
								          `cf_to_saliva_color_change_max_value`, 
								          `uom_of_cf_to_saliva_color_change`, 

								          `test_method_for_cf_to_saliva_staining`, 
								          `cf_to_saliva_staining_tolerance_range_math_operator`, 
								          `cf_to_saliva_staining_tolerance_value`, 
								          `cf_to_saliva_staining_staining_min_value`, 
								          `cf_to_saliva_staining_max_value`, 
								          `uom_of_cf_to_saliva_staining`, 


								          `test_method_for_cf_to_chlorinated_water_color_change`, 
								          `cf_to_chlorinated_water_color_change_tolerance_range_math_op`, 
								          `cf_to_chlorinated_water_color_change_tolerance_value`, 
								          `cf_to_chlorinated_water_color_change_min_value`, 
								          `cf_to_chlorinated_water_color_change_max_value`, 
								          `uom_of_cf_to_chlorinated_water_color_change`, 

								          `test_method_for_cf_to_cholorine_bleach_color_change`, 
								          `cf_to_cholorine_bleach_color_change_tolerance_range_math_op`, 
								          `cf_to_cholorine_bleach_color_change_tolerance_value`, 
								          `cf_to_cholorine_bleach_color_change_min_value`, 
								          `cf_to_cholorine_bleach_color_change_max_value`, 
								          `uom_of_cf_to_cholorine_bleach_color_change`, 


								          `test_method_for_cf_to_peroxide_bleach_color_change`, 
								          `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator`, 
								          `cf_to_peroxide_bleach_color_change_tolerance_value`, 
								          `cf_to_peroxide_bleach_color_change_min_value`, 
								          `cf_to_peroxide_bleach_color_change_max_value`, 
								          `uom_of_cf_to_peroxide_bleach_color_change`, 


								          `test_method_for_cross_staining`, 
								          `cross_staining_tolerance_range_math_operator`, 
								          `cross_staining_tolerance_value`, 
								          `cross_staining_min_value`, 
								          `cross_staining_max_value`, 
								          `uom_of_cross_staining`, 

								           `test_method_for_ph`,
								           `ph_value_tolerance_range_math_operator`,
								           `ph_value_tolerance_value`, 
								           `ph_value_min_value`, 
								           `ph_value_max_value`, 
								           `uom_of_ph_value`, 

								            `recording_person_id`, 
								            `recording_person_name`, 
								            `recording_time`) 
									        VALUES 
									        (
									         '$pp_number',
									         '$version_id',
									         '$version_name',
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

									         '$test_method_for_cf_to_washing_color_change',
									         '$cf_to_washing_color_change_tolerance_range_math_operator',
									           '$cf_to_washing_color_change_tolerance_value',
									           '$cf_to_washing_color_change_min_value',
									           '$cf_to_washing_color_change_max_value',
									           '$uom_of_cf_to_washing_color_change',

									           '$test_method_for_cf_to_washing_staining',
									           '$cf_to_washing_staining_tolerance_range_math_operator',
									           '$cf_to_washing_staining_tolerance_value',
									           '$cf_to_washing_staining_tolerance_value',
									           '$cf_to_washing_staining_max_value',
									           '$uom_of_cf_to_washing_staining',

									           '$test_method_for_cf_to_washing_cross_staining',
									           '$cf_to_washing_cross_staining_tolerance_range_math_operator',
									           '$cf_to_washing_cross_staining_tolerance_value',
									           '$cf_to_washing_cross_staining_min_value',
									           '$cf_to_washing_cross_staining_max_value',
									           '$uom_of_cf_to_washing_cross_staining',

									           '$test_method_for_cf_to_dry_cleaning_color_change',
									           '$cf_to_dry_cleaning_color_change_tolerance_range_math_operator',
									           '$cf_to_dry_cleaning_color_change_tolerance_value',
									           '$cf_to_dry_cleaning_color_change_min_value',
									           '$cf_to_dry_cleaning_color_change_max_value',
									           '$uom_of_cf_to_dry_cleaning_color_change',

									           '$test_method_for_cf_to_dry_cleaning_staining',
									           '$cf_to_dry_cleaning_staining_tolerance_range_math_operator',
									           '$cf_to_dry_cleaning_staining_tolerance_value',
									           '$cf_to_dry_cleaning_staining_min_value',
									           '$cf_to_dry_cleaning_staining_max_value',
									           '$uom_of_cf_to_dry_cleaning_staining',

									          
									           '$test_method_for_perspiration_acid_color_change',
									           '$cf_to_perspiration_acid_color_change_tolerance_range_math_op',
									           '$cf_to_perspiration_acid_color_change_tolerance_value',
									           '$cf_to_perspiration_acid_color_change_min_value',
									           '$cf_to_perspiration_acid_color_change_max_value',
									           '$uom_of_cf_to_perspiration_acid_color_change',

									           '$test_method_for_cf_to_perspiration_acid_staining',
									           '$cf_to_perspiration_acid_staining_tolerance_range_math_operator',
									           '$cf_to_perspiration_acid_staining_value',
									           '$cf_to_perspiration_acid_staining_min_value',
									           '$cf_to_perspiration_acid_staining_max_value',
									           '$uom_of_cf_to_perspiration_acid_staining',

									           '$test_method_for_cf_to_perspiration_acid_cross_staining',
									           '$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op',
									           '$cf_to_perspiration_acid_cross_staining_tolerance_value',
									           '$cf_to_perspiration_acid_cross_staining_min_value',
									           '$cf_to_perspiration_acid_cross_staining_max_value',
									           '$uom_of_cf_to_perspiration_acid_cross_staining',

									           '$test_method_for_cf_to_perspiration_alkali_color_change',
									           '$cf_to_perspiration_alkali_color_change_tolerance_range_math_op',
									           '$cf_to_perspiration_alkali_color_change_tolerance_value',
									           '$cf_to_perspiration_alkali_color_change_min_value',
									           '$cf_to_perspiration_alkali_color_change_max_value',
									           '$uom_of_cf_to_perspiration_alkali_color_change',

									           '$test_method_for_cf_to_perspiration_alkali_staining',
									           '$cf_to_perspiration_alkali_staining_tolerance_range_math_op',
									           '$cf_to_perspiration_alkali_staining_tolerance_value',
									           '$cf_to_perspiration_alkali_staining_min_value',
									           '$cf_to_perspiration_alkali_staining_max_value',
									           '$uom_of_cf_to_perspiration_alkali_staining',

									           '$test_method_for_cf_to_perspiration_alkali_cross_staining',
									           '$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op',
									           '$cf_to_perspiration_alkali_cross_staining_tolerance_value',
									           '$cf_to_perspiration_alkali_cross_staining_min_value',
									           '$cf_to_perspiration_alkali_cross_staining_max_value',
									           '$uom_of_cf_to_perspiration_alkali_cross_staining',

									           '$test_method_for_cf_to_water_color_change',
									           '$cf_to_water_color_change_tolerance_range_math_operator',
									           '$cf_to_water_color_change_tolerance_value',
									           '$cf_to_water_color_change_min_value',
									           '$cf_to_water_color_change_max_value',
									           '$uom_of_cf_to_water_color_change',

									           '$test_method_for_cf_to_water_staining',
									           '$cf_to_water_staining_tolerance_range_math_operator',
									           '$cf_to_water_staining_tolerance_value',
									           '$cf_to_water_staining_min_value',
									           '$cf_to_water_staining_max_value',
									           '$uom_of_cf_to_water_staining',

									           '$test_method_for_cf_to_water_cross_staining',
									           '$cf_to_water_cross_staining_tolerance_range_math_operator',
									           '$cf_to_water_cross_staining_tolerance_value',
									           '$cf_to_water_cross_staining_min_value',
									           '$cf_to_water_cross_staining_max_value',
									           '$uom_of_cf_to_water_cross_staining',


									           '$test_method_for_cf_to_water_spotting_surface',
									           '$cf_to_water_spotting_surface_tolerance_range_math_op',
									           '$cf_to_water_spotting_surface_tolerance_value',
									           '$cf_to_water_spotting_surface_min_value',
									           '$cf_to_water_spotting_surface_max_value',
									           '$uom_of_cf_to_water_spotting_surface',

									           '$test_method_for_cf_to_water_spotting_edge',
									           '$cf_to_water_spotting_edge_tolerance_range_math_op',
									           '$cf_to_water_spotting_edge_tolerance_value',
									           '$cf_to_water_spotting_edge_min_value',
									           '$cf_to_water_spotting_edge_max_value',
									           '$uom_of_cf_to_water_spotting_edge',

									           '$test_method_for_cf_to_water_spotting_cross_staining',
									           '$cf_to_water_spotting_cross_staining_tolerance_range_math_op',
									           '$cf_to_water_spotting_cross_staining_tolerance_value',
									           '$cf_to_water_spotting_cross_staining_min_value',
									           '$cf_to_water_spotting_cross_staining_max_value',
									           '$uom_of_cf_to_water_spotting_cross_staining',


									           '$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change',
									           '$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op',
									           '$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value',
									           '$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value',
									           '$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value',
									           '$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change',

									           '$test_method_for_cf_to_oxidative_bleach_damage_color_cange',
									           '$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op',
									           '$cf_to_oxidative_bleach_damage_color_change_tolerance_value',
									           '$cf_to_oxidative_bleach_damage_color_change_min_value',
									           '$cf_to_oxidative_bleach_damage_color_change_max_value',
									           '$uom_of_cf_to_oxidative_bleach_damage_color_change',

									           '$test_method_for_cf_to_phenolic_yellowing_staining',
									           '$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator',
									           '$cf_to_phenolic_yellowing_staining_tolerance_value',
									           '$cf_to_phenolic_yellowing_staining_min_value',
									           '$cf_to_phenolic_yellowing_staining_max_value',
									           '$uom_of_cf_to_phenolic_yellowing_staining',

									           '$cf_to_pvc_migration_staining_tolerance_range_math_operator',
									           '$cf_to_pvc_migration_staining_tolerance_value',
									           '$cf_to_pvc_migration_staining_min_value',
									           '$cf_to_pvc_migration_staining_max_value',
									           '$uom_of_cf_to_pvc_migration_staining',

									           '$test_method_for_cf_to_saliva_color_change',
									           '$cf_to_saliva_color_change_tolerance_range_math_operator',
									           '$cf_to_saliva_color_change_tolerance_value',
									           '$cf_to_saliva_color_change_staining_min_value',
									           '$cf_to_saliva_color_change_max_value',
									           '$uom_of_cf_to_saliva_color_change',

									           '$test_method_for_cf_to_saliva_staining',
									           '$cf_to_saliva_staining_tolerance_range_math_operator',
									           '$cf_to_saliva_staining_tolerance_value',
									           '$cf_to_saliva_staining_staining_min_value',
									           '$cf_to_saliva_staining_max_value',
									           '$uom_of_cf_to_saliva_staining',

									           '$test_method_for_cf_to_chlorinated_water_color_change',
									           '$cf_to_chlorinated_water_color_change_tolerance_range_math_op',
									           '$cf_to_chlorinated_water_color_change_tolerance_value',
									           '$cf_to_chlorinated_water_color_change_min_value',
									           '$cf_to_chlorinated_water_color_change_max_value',
									           '$uom_of_cf_to_chlorinated_water_color_change',

									           '$test_method_for_cf_to_cholorine_bleach_color_change',
									           '$cf_to_cholorine_bleach_color_change_tolerance_range_math_op',
									           '$cf_to_cholorine_bleach_color_change_tolerance_value',
									           '$cf_to_cholorine_bleach_color_change_min_value',
									           '$cf_to_cholorine_bleach_color_change_max_value',
									           '$uom_of_cf_to_cholorine_bleach_color_change',

									           '$test_method_for_cf_to_peroxide_bleach_color_change',
									           '$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator',
									           '$cf_to_peroxide_bleach_color_change_tolerance_value',
									           '$cf_to_peroxide_bleach_color_change_min_value',
									           '$cf_to_peroxide_bleach_color_change_max_value',
									           '$uom_of_cf_to_peroxide_bleach_color_change',

									           '$test_method_for_cross_staining',
									           '$cross_staining_tolerance_range_math_operator',
									           '$cross_staining_tolerance_value',
									           '$cross_staining_min_value',
									           '$cross_staining_max_value',
									           '$uom_of_cross_staining',


									           '$test_method_for_ph',
									           '$ph_value_tolerance_range_math_operator',
									           '$ph_value_tolerance_value',
									           '$ph_value_min_value',
									           '$ph_value_max_value',
									           '$uom_of_ph_value',

									          
									           '$user_id',
									           '$user_name',
									           NOW()
									        )";


									mysqli_query($con,$insert_sql_statement_for_washing) or die(mysqli_error($con));

                                    
                                   

							}   // ..................................................Duplicacy Check for washing..............................................................//






		 } // ...........................................................Duplicacy Check For Adding Process to  Version..............................................................//

			
		     	
	}
	
	 
}






?>