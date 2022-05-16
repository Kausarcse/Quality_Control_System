<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$data_previously_saved = "No";
$data_insertion_hampering_for_define_model = "No";
$data_insertion_hampering_for_add_process_model = "No";



$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];


//post data collect
$customer_id= $_POST['customer_id'];
$customer_name= $_POST['customer_name'];
$version_number= $_POST['version_number'];
$color_name= $_POST['color_name'];
$process_id= $_POST['process_id'];
$process_name= $_POST['process_name'];
$process_serial= $_POST['process_serial'];
$process_technique_name= $_POST['process_technique_name'];

// $pp_number= $_POST['pp_number_value'];
// $version_number= $_POST['version_number'];
// $splitted_receiving_date= explode("?fs?",$version_number);
// $version_number= $splitted_receiving_date[0];
// $version_id= $splitted_receiving_date[4];

// $customer_name= $_POST['customer_name'];
// $customer_id= $_POST['customer_id'];
// $color= $_POST['color'];
// $finish_width_in_inch= $_POST['finish_width_in_inch'];

$test_method_for_cf_to_rubbing_dry= $_POST['test_method_for_cf_to_rubbing_dry'];
$cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_rubbing_dry_tolerance_range_math_operator'])));
$cf_to_rubbing_dry_tolerance_value= $_POST['cf_to_rubbing_dry_tolerance_value'];
$cf_to_rubbing_dry_min_value= $_POST['cf_to_rubbing_dry_min_value'];
$cf_to_rubbing_dry_max_value= $_POST['cf_to_rubbing_dry_max_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];

$test_method_for_cf_to_rubbing_wet= $_POST['test_method_for_cf_to_rubbing_wet'];
$cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_rubbing_wet_tolerance_range_math_operator'])));
$cf_to_rubbing_wet_tolerance_value= $_POST['cf_to_rubbing_wet_tolerance_value'];
$cf_to_rubbing_wet_min_value= $_POST['cf_to_rubbing_wet_min_value'];
$cf_to_rubbing_wet_max_value= $_POST['cf_to_rubbing_wet_max_value'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];

$test_method_for_dimensional_stability_to_warp_washing_b_iron= $_POST['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
$washing_cycle_for_warp_for_washing_before_iron= $_POST['washing_cycle_for_warp_for_washing_before_iron'];
$dimensional_stability_to_warp_washing_before_iron_min_value= $_POST['dimensional_stability_to_warp_washing_before_iron_min_value'];
$dimensional_stability_to_warp_washing_before_iron_max_value= $_POST['dimensional_stability_to_warp_washing_before_iron_max_value'];
$uom_of_dimensional_stability_to_warp_washing_before_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_before_iron'];

$test_method_for_dimensional_stability_to_weft_washing_b_iron= $_POST['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
$washing_cycle_for_weft_for_washing_before_iron= $_POST['washing_cycle_for_weft_for_washing_before_iron'];
$dimensional_stability_to_weft_washing_before_iron_min_value= $_POST['dimensional_stability_to_weft_washing_before_iron_min_value'];
$dimensional_stability_to_weft_washing_before_iron_max_value= $_POST['dimensional_stability_to_weft_washing_before_iron_max_value'];
$uom_of_dimensional_stability_to_weft_washing_before_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_before_iron'];

$test_method_for_dimensional_stability_to_warp_washing_after_iron= $_POST['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
$washing_cycle_for_warp_for_washing_after_iron= $_POST['washing_cycle_for_warp_for_washing_after_iron'];
$dimensional_stability_to_warp_washing_after_iron_min_value= $_POST['dimensional_stability_to_warp_washing_after_iron_min_value'];
$dimensional_stability_to_warp_washing_after_iron_max_value= $_POST['dimensional_stability_to_warp_washing_after_iron_max_value'];
$uom_of_dimensional_stability_to_warp_washing_after_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_after_iron'];

$test_method_for_dimensional_stability_to_weft_washing_after_iron= $_POST['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
$washing_cycle_for_weft_for_washing_after_iron= $_POST['washing_cycle_for_weft_for_washing_after_iron'];
$dimensional_stability_to_weft_washing_after_iron_min_value= $_POST['dimensional_stability_to_weft_washing_after_iron_min_value'];
$dimensional_stability_to_weft_washing_after_iron_max_value= $_POST['dimensional_stability_to_weft_washing_after_iron_max_value'];
$uom_of_dimensional_stability_to_weft_washing_after_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_after_iron'];

$test_method_for_warp_yarn_count= $_POST['test_method_for_warp_yarn_count'];
$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['warp_yarn_count_tolerance_range_math_operator'])));
$warp_yarn_count_tolerance_value= $_POST['warp_yarn_count_tolerance_value'];
$warp_yarn_count_min_value= $_POST['warp_yarn_count_min_value'];
$warp_yarn_count_max_value= $_POST['warp_yarn_count_max_value'];
$uom_of_warp_yarn_count_value= $_POST['uom_of_warp_yarn_count_value'];

$test_method_for_weft_yarn_count= $_POST['test_method_for_weft_yarn_count'];
$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['weft_yarn_count_tolerance_range_math_operator'])));
$weft_yarn_count_tolerance_value= $_POST['weft_yarn_count_tolerance_value'];
$weft_yarn_count_min_value= $_POST['weft_yarn_count_min_value'];
$weft_yarn_count_max_value= $_POST['weft_yarn_count_max_value'];
$uom_of_weft_yarn_count_value= $_POST['uom_of_weft_yarn_count_value'];

$test_method_for_no_of_threads_in_warp= $_POST['test_method_for_no_of_threads_in_warp'];
$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['no_of_threads_in_warp_tolerance_range_math_operator'])));
$no_of_threads_in_warp_tolerance_value= $_POST['no_of_threads_in_warp_tolerance_value'];
$no_of_threads_in_warp_min_value= $_POST['no_of_threads_in_warp_min_value'];
$no_of_threads_in_warp_max_value= $_POST['no_of_threads_in_warp_max_value'];
$uom_of_no_of_threads_in_warp_value= $_POST['uom_of_no_of_threads_in_warp_value'];

$test_method_for_no_of_threads_in_weft= $_POST['test_method_for_no_of_threads_in_weft'];
$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['no_of_threads_in_weft_tolerance_range_math_operator'])));
$no_of_threads_in_weft_tolerance_value= $_POST['no_of_threads_in_weft_tolerance_value'];
$no_of_threads_in_weft_min_value= $_POST['no_of_threads_in_weft_min_value'];
$no_of_threads_in_weft_max_value= $_POST['no_of_threads_in_weft_max_value'];
$uom_of_no_of_threads_in_weft_value= $_POST['uom_of_no_of_threads_in_weft_value'];


$test_method_for_mass_per_unit_per_area= $_POST['test_method_for_mass_per_unit_per_area'];
$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['mass_per_unit_per_area_tolerance_range_math_operator'])));
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];


$test_method_for_surface_fuzzing_and_pilling= $_POST['test_method_for_surface_fuzzing_and_pilling'];
$description_or_type_for_surface_fuzzing_and_pilling= $_POST['description_or_type_for_surface_fuzzing_and_pilling'];
$rubs_for_surface_fuzzing_and_pilling= $_POST['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
$surface_fuzzing_and_pilling_tolerance_value= $_POST['surface_fuzzing_and_pilling_tolerance_value'];
$surface_fuzzing_and_pilling_min_value= $_POST['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $_POST['surface_fuzzing_and_pilling_max_value'];
$uom_of_surface_fuzzing_and_pilling_value= $_POST['uom_of_surface_fuzzing_and_pilling_value'];


$test_method_for_tensile_properties_in_warp= $_POST['test_method_for_tensile_properties_in_warp'];
$tensile_properties_in_warp_value_tolerance_range_math_operator=mysqli_real_escape_string($con,stripslashes(trim($_POST['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
$tensile_properties_in_warp_value_tolerance_value= $_POST['tensile_properties_in_warp_value_tolerance_value'];
$tensile_properties_in_warp_value_min_value= $_POST['tensile_properties_in_warp_value_min_value'];
$tensile_properties_in_warp_value_max_value= $_POST['tensile_properties_in_warp_value_max_value'];
$uom_of_tensile_properties_in_warp_value= $_POST['uom_of_tensile_properties_in_warp_value'];

$test_method_for_tensile_properties_in_weft= $_POST['test_method_for_tensile_properties_in_weft'];
$tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
$tensile_properties_in_weft_value_tolerance_value= $_POST['tensile_properties_in_weft_value_tolerance_value'];
$tensile_properties_in_weft_value_min_value= $_POST['tensile_properties_in_weft_value_min_value'];
$tensile_properties_in_weft_value_max_value= $_POST['tensile_properties_in_weft_value_max_value'];
$uom_of_tensile_properties_in_weft_value= $_POST['uom_of_tensile_properties_in_weft_value'];

$test_method_for_tear_force_in_warp= $_POST['test_method_for_tear_force_in_warp'];
$tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['tear_force_in_warp_value_tolerance_range_math_operator'])));
$tear_force_in_warp_value_tolerance_value= $_POST['tear_force_in_warp_value_tolerance_value'];
$tear_force_in_warp_value_min_value= $_POST['tear_force_in_warp_value_min_value'];
$tear_force_in_warp_value_max_value= $_POST['tear_force_in_warp_value_max_value'];
$uom_of_tear_force_in_warp_value= $_POST['uom_of_tear_force_in_warp_value'];

$test_method_for_tear_force_in_weft= $_POST['test_method_for_tear_force_in_weft'];
$tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['tear_force_in_weft_value_tolerance_range_math_operator'])));
$tear_force_in_weft_value_tolerance_value= $_POST['tear_force_in_weft_value_tolerance_value'];
$tear_force_in_weft_value_min_value= $_POST['tear_force_in_weft_value_min_value'];
$tear_force_in_weft_value_max_value= $_POST['tear_force_in_weft_value_max_value'];
$uom_of_tear_force_in_weft_value= $_POST['uom_of_tear_force_in_weft_value'];


$test_method_for_seam_slippage_resistance_in_warp= $_POST['test_method_for_seam_slippage_resistance_in_warp'];
$seam_slippage_resistance_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_slippage_resistance_in_warp_tolerance_range_math_operator'])));
$seam_slippage_resistance_in_warp_tolerance_value= $_POST['seam_slippage_resistance_in_warp_tolerance_value'];
$seam_slippage_resistance_in_warp_min_value= $_POST['seam_slippage_resistance_in_warp_min_value'];
$seam_slippage_resistance_in_warp_max_value= $_POST['seam_slippage_resistance_in_warp_max_value'];
$uom_of_seam_slippage_resistance_in_warp= $_POST['uom_of_seam_slippage_resistance_in_warp'];

$test_method_for_seam_slippage_resistance_in_weft= $_POST['test_method_for_seam_slippage_resistance_in_weft'];
$seam_slippage_resistance_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_slippage_resistance_in_weft_tolerance_range_math_operator'])));
$seam_slippage_resistance_in_weft_tolerance_value= $_POST['seam_slippage_resistance_in_weft_tolerance_value'];
$seam_slippage_resistance_in_weft_min_value= $_POST['seam_slippage_resistance_in_weft_min_value'];
$seam_slippage_resistance_in_weft_max_value= $_POST['seam_slippage_resistance_in_weft_max_value'];
$uom_of_seam_slippage_resistance_in_weft= $_POST['uom_of_seam_slippage_resistance_in_weft'];



$test_method_for_seam_slippage_resistance_iso_2_warp= $_POST['test_method_for_seam_slippage_resistance_iso_2_in_warp'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
$seam_slippage_resistance_iso_2_in_warp_min_value= $_POST['seam_slippage_resistance_iso_2_in_warp_min_value'];
$seam_slippage_resistance_iso_2_in_warp_max_value= $_POST['seam_slippage_resistance_iso_2_in_warp_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];
$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];

$test_method_for_seam_slippage_resistance_iso_2_weft= $_POST['test_method_for_seam_slippage_resistance_iso_2_in_weft'];
$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'])));
$seam_slippage_resistance_iso_2_in_weft_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
$seam_slippage_resistance_iso_2_in_weft_min_value= $_POST['seam_slippage_resistance_iso_2_in_weft_min_value'];
$seam_slippage_resistance_iso_2_in_weft_max_value= $_POST['seam_slippage_resistance_iso_2_in_weft_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_weft= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft'];
$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


$test_method_for_seam_strength_in_warp= $_POST['test_method_for_seam_strength_in_warp'];
$seam_strength_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_strength_in_warp_value_tolerance_range_math_operator'])));
$seam_strength_in_warp_value_tolerance_value= $_POST['seam_strength_in_warp_value_tolerance_value'];
$seam_strength_in_warp_value_min_value= $_POST['seam_strength_in_warp_value_min_value'];
$seam_strength_in_warp_value_max_value= $_POST['seam_strength_in_warp_value_max_value'];
$uom_of_seam_strength_in_warp_value= $_POST['uom_of_seam_strength_in_warp_value'];

$test_method_for_seam_strength_in_weft= $_POST['test_method_for_seam_strength_in_weft'];
$seam_strength_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_strength_in_weft_value_tolerance_range_math_operator'])));
$seam_strength_in_weft_value_tolerance_value= $_POST['seam_strength_in_weft_value_tolerance_value'];
$seam_strength_in_weft_value_min_value= $_POST['seam_strength_in_weft_value_min_value'];
$seam_strength_in_weft_value_max_value= $_POST['seam_strength_in_weft_value_max_value'];
$uom_of_seam_strength_in_weft_value= $_POST['uom_of_seam_strength_in_weft_value'];

$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'])));
$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


 $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
 $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'])));
$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'])));
$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

$test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_sanforizing_process` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' ";


$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $insert_sql_for_define_model="insert into `model_defining_qc_standard_for_sanforizing_process`
	 ( 
      `customer_id`,
      `customer_name`,
      `version_number`,
      `color`,
      `process_id`,
      `process_name`,
      `process_serial`,
      `process_technique`,

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
        `recording_time` ) 
        values 
        (
        '$customer_id',
        '$customer_name',
        '$version_number',
        '$color_name',
        '$process_id',
        '$process_name',
        '$process_serial',
        '$process_technique_name',

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

          '$test_method_for_seam_slippage_resistance_iso_2_warp',
          '$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op',
          '$seam_slippage_resistance_iso_2_in_warp_tolerance_value',
          '$seam_slippage_resistance_iso_2_in_warp_min_value',
          '$seam_slippage_resistance_iso_2_in_warp_max_value',
          '$uom_of_seam_slippage_resistance_iso_2_in_warp',
          '$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load',

          '$test_method_for_seam_slippage_resistance_iso_2_weft',
          '$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op',
          '$seam_slippage_resistance_iso_2_in_weft_tolerance_value',
          '$seam_slippage_resistance_iso_2_in_weft_min_value',
          '$seam_slippage_resistance_iso_2_in_weft_max_value',
          '$uom_of_seam_slippage_resistance_iso_2_in_weft',
          '$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load',
              
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

    
      
	mysqli_query($con,$insert_sql_for_define_model) or die(mysqli_error($con));

  
	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering_for_define_model = "Yes";
	
	}
  else
  {
    
      $insert_sql_add_process_model ="insert into `adding_process_to_version_model`
       ( 
       `version_number`,
       `customer_id`,
       `customer_name`,
       `color_name`,
       `process_id`,
       `process_name`,
       `process_serial_no`,
       `process_or_reprocess`,
       `process_technique`,
       `checking_field`,

         `recording_person_id`,
         `recording_person_name`,
         `recording_time` ) 
         values 
         (
         '$version_number',
         '$customer_id',
         '$customer_name',
         '$color_name',
         '$process_id',
         '$process_name',
         '$process_serial',
         'process',
         '$process_technique_name',
         '',

         '$user_id',
         '$user_name',
          NOW()
           )";
       
      mysqli_query($con, $insert_sql_add_process_model) or die(mysqli_error($con));


      if(mysqli_affected_rows($con)<>1)
      {
      
        $data_insertion_hampering_for_add_process_model = "Yes";
      
      }
  }
}



if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.  ";

}
else if($data_insertion_hampering_for_define_model == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Model standard is successfully saved.  ";

}
else 
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.  ";

}

if($data_insertion_hampering_for_add_process_model == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Model Process is successfully added in process route.";

}
else
{
  mysqli_query($con,"ROLLBACK");
	echo "Model Process is not added in process route.";
}

$obj->disconnection();

?>
