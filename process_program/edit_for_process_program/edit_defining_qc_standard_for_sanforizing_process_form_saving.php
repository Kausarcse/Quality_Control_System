<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];



$pp_number= $_POST['pp_number'];
$version_number= $_POST['version_number'];

$customer_name= $_POST['customer_name'];
$customer_id= $_POST['customer_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];

$test_method_for_cf_to_rubbing_dry= $_POST['test_method_for_cf_to_rubbing_dry'];
$cf_to_rubbing_dry_tolerance_range_math_operator= $_POST['cf_to_rubbing_dry_tolerance_range_math_operator'];
$cf_to_rubbing_dry_tolerance_value= $_POST['cf_to_rubbing_dry_tolerance_value'];
$cf_to_rubbing_dry_min_value= $_POST['cf_to_rubbing_dry_min_value'];
$cf_to_rubbing_dry_max_value= $_POST['cf_to_rubbing_dry_max_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];

$test_method_for_cf_to_rubbing_wet= $_POST['test_method_for_cf_to_rubbing_wet'];
$cf_to_rubbing_wet_tolerance_range_math_operator= $_POST['cf_to_rubbing_wet_tolerance_range_math_operator'];
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

$test_method_for_warp_yarn_count= $_POST['test_method_for_warp_yarn_count'];
$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$warp_yarn_count_tolerance_range_math_operator= $_POST['warp_yarn_count_tolerance_range_math_operator'];
$warp_yarn_count_tolerance_value= $_POST['warp_yarn_count_tolerance_value'];
$warp_yarn_count_min_value= $_POST['warp_yarn_count_min_value'];
$warp_yarn_count_max_value= $_POST['warp_yarn_count_max_value'];
$uom_of_warp_yarn_count_value= $_POST['uom_of_warp_yarn_count_value'];

$test_method_for_weft_yarn_count= $_POST['test_method_for_weft_yarn_count'];
$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$weft_yarn_count_tolerance_range_math_operator= $_POST['weft_yarn_count_tolerance_range_math_operator'];
$weft_yarn_count_tolerance_value= $_POST['weft_yarn_count_tolerance_value'];
$weft_yarn_count_min_value= $_POST['weft_yarn_count_min_value'];
$weft_yarn_count_max_value= $_POST['weft_yarn_count_max_value'];
$uom_of_weft_yarn_count_value= $_POST['uom_of_weft_yarn_count_value'];

$test_method_for_no_of_threads_in_warp= $_POST['test_method_for_no_of_threads_in_warp'];
$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$no_of_threads_in_warp_tolerance_range_math_operator= $_POST['no_of_threads_in_warp_tolerance_range_math_operator'];
$no_of_threads_in_warp_tolerance_value= $_POST['no_of_threads_in_warp_tolerance_value'];
$no_of_threads_in_warp_min_value= $_POST['no_of_threads_in_warp_min_value'];
$no_of_threads_in_warp_max_value= $_POST['no_of_threads_in_warp_max_value'];
$uom_of_no_of_threads_in_warp_value= $_POST['uom_of_no_of_threads_in_warp_value'];

$test_method_for_no_of_threads_in_weft= $_POST['test_method_for_no_of_threads_in_weft'];
$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$no_of_threads_in_weft_tolerance_range_math_operator= $_POST['no_of_threads_in_weft_tolerance_range_math_operator'];
$no_of_threads_in_weft_tolerance_value= $_POST['no_of_threads_in_weft_tolerance_value'];
$no_of_threads_in_weft_min_value= $_POST['no_of_threads_in_weft_min_value'];
$no_of_threads_in_weft_max_value= $_POST['no_of_threads_in_weft_max_value'];
$uom_of_no_of_threads_in_weft_value= $_POST['uom_of_no_of_threads_in_weft_value'];


$test_method_for_mass_per_unit_per_area= $_POST['test_method_for_mass_per_unit_per_area'];
$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= $_POST['mass_per_unit_per_area_tolerance_range_math_operator'];
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];


$test_method_for_surface_fuzzing_and_pilling= $_POST['test_method_for_surface_fuzzing_and_pilling'];
$description_or_type_for_surface_fuzzing_and_pilling= $_POST['description_or_type_for_surface_fuzzing_and_pilling'];
$rubs_for_surface_fuzzing_and_pilling= $_POST['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= $_POST['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
$surface_fuzzing_and_pilling_tolerance_value= $_POST['surface_fuzzing_and_pilling_tolerance_value'];
$surface_fuzzing_and_pilling_min_value= $_POST['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $_POST['surface_fuzzing_and_pilling_max_value'];
$uom_of_surface_fuzzing_and_pilling_value= $_POST['uom_of_surface_fuzzing_and_pilling_value'];


$test_method_for_tensile_properties_in_warp= $_POST['test_method_for_tensile_properties_in_warp'];
$tensile_properties_in_warp_value_tolerance_range_math_operator= $_POST['tensile_properties_in_warp_value_tolerance_range_math_operator'];
$tensile_properties_in_warp_value_tolerance_value= $_POST['tensile_properties_in_warp_value_tolerance_value'];
$tensile_properties_in_warp_value_min_value= $_POST['tensile_properties_in_warp_value_min_value'];
$tensile_properties_in_warp_value_max_value= $_POST['tensile_properties_in_warp_value_max_value'];
$uom_of_tensile_properties_in_warp_value= $_POST['uom_of_tensile_properties_in_warp_value'];

$test_method_for_tensile_properties_in_weft= $_POST['test_method_for_tensile_properties_in_weft'];
$tensile_properties_in_weft_value_tolerance_range_math_operator= $_POST['tensile_properties_in_weft_value_tolerance_range_math_operator'];
$tensile_properties_in_weft_value_tolerance_value= $_POST['tensile_properties_in_weft_value_tolerance_value'];
$tensile_properties_in_weft_value_min_value= $_POST['tensile_properties_in_weft_value_min_value'];
$tensile_properties_in_weft_value_max_value= $_POST['tensile_properties_in_weft_value_max_value'];
$uom_of_tensile_properties_in_weft_value= $_POST['uom_of_tensile_properties_in_weft_value'];

$test_method_for_tear_force_in_warp= $_POST['test_method_for_tear_force_in_warp'];
$tear_force_in_warp_value_tolerance_range_math_operator= $_POST['tear_force_in_warp_value_tolerance_range_math_operator'];
$tear_force_in_warp_value_tolerance_value= $_POST['tear_force_in_warp_value_tolerance_value'];
$tear_force_in_warp_value_min_value= $_POST['tear_force_in_warp_value_min_value'];
$tear_force_in_warp_value_max_value= $_POST['tear_force_in_warp_value_max_value'];
$uom_of_tear_force_in_warp_value= $_POST['uom_of_tear_force_in_warp_value'];

$test_method_for_tear_force_in_weft= $_POST['test_method_for_tear_force_in_weft'];
$tear_force_in_weft_value_tolerance_range_math_operator= $_POST['tear_force_in_weft_value_tolerance_range_math_operator'];
$tear_force_in_weft_value_tolerance_value= $_POST['tear_force_in_weft_value_tolerance_value'];
$tear_force_in_weft_value_min_value= $_POST['tear_force_in_weft_value_min_value'];
$tear_force_in_weft_value_max_value= $_POST['tear_force_in_weft_value_max_value'];
$uom_of_tear_force_in_weft_value= $_POST['uom_of_tear_force_in_weft_value'];


$test_method_for_seam_slippage_resistance_in_warp= $_POST['test_method_for_seam_slippage_resistance_in_warp'];
$seam_slippage_resistance_in_warp_tolerance_range_math_operator= $_POST['seam_slippage_resistance_in_warp_tolerance_range_math_operator'];
$seam_slippage_resistance_in_warp_tolerance_value= $_POST['seam_slippage_resistance_in_warp_tolerance_value'];
$seam_slippage_resistance_in_warp_min_value= $_POST['seam_slippage_resistance_in_warp_min_value'];
$seam_slippage_resistance_in_warp_max_value= $_POST['seam_slippage_resistance_in_warp_max_value'];
$uom_of_seam_slippage_resistance_in_warp= $_POST['uom_of_seam_slippage_resistance_in_warp'];

$test_method_for_seam_slippage_resistance_in_weft= $_POST['test_method_for_seam_slippage_resistance_in_weft'];
$seam_slippage_resistance_in_weft_tolerance_range_math_operator= $_POST['seam_slippage_resistance_in_weft_tolerance_range_math_operator'];
$seam_slippage_resistance_in_weft_tolerance_value= $_POST['seam_slippage_resistance_in_weft_tolerance_value'];
$seam_slippage_resistance_in_weft_min_value= $_POST['seam_slippage_resistance_in_weft_min_value'];
$seam_slippage_resistance_in_weft_max_value= $_POST['seam_slippage_resistance_in_weft_max_value'];
$uom_of_seam_slippage_resistance_in_weft= $_POST['uom_of_seam_slippage_resistance_in_weft'];



$test_method_for_seam_slippage_resistance_iso_2_warp= $_POST['test_method_for_seam_slippage_resistance_iso_2_in_warp'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
$seam_slippage_resistance_iso_2_in_warp_min_value= $_POST['seam_slippage_resistance_iso_2_in_warp_min_value'];
$seam_slippage_resistance_iso_2_in_warp_max_value= $_POST['seam_slippage_resistance_iso_2_in_warp_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];
$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];

$test_method_for_seam_slippage_resistance_iso_2_weft= $_POST['test_method_for_seam_slippage_resistance_iso_2_in_weft'];
$seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= $_POST['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'];
$seam_slippage_resistance_iso_2_in_weft_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
$seam_slippage_resistance_iso_2_in_weft_min_value= $_POST['seam_slippage_resistance_iso_2_in_weft_min_value'];
$seam_slippage_resistance_iso_2_in_weft_max_value= $_POST['seam_slippage_resistance_iso_2_in_weft_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_weft= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft'];
$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


$test_method_for_seam_strength_in_warp= $_POST['test_method_for_seam_strength_in_warp'];
$seam_strength_in_warp_value_tolerance_range_math_operator= $_POST['seam_strength_in_warp_value_tolerance_range_math_operator'];
$seam_strength_in_warp_value_tolerance_value= $_POST['seam_strength_in_warp_value_tolerance_value'];
$seam_strength_in_warp_value_min_value= $_POST['seam_strength_in_warp_value_min_value'];
$seam_strength_in_warp_value_max_value= $_POST['seam_strength_in_warp_value_max_value'];
$uom_of_seam_strength_in_warp_value= $_POST['uom_of_seam_strength_in_warp_value'];

$test_method_for_seam_strength_in_weft= $_POST['test_method_for_seam_strength_in_weft'];
$seam_strength_in_weft_value_tolerance_range_math_operator= $_POST['seam_strength_in_weft_value_tolerance_range_math_operator'];
$seam_strength_in_weft_value_tolerance_value= $_POST['seam_strength_in_weft_value_tolerance_value'];
$seam_strength_in_weft_value_min_value= $_POST['seam_strength_in_weft_value_min_value'];
$seam_strength_in_weft_value_max_value= $_POST['seam_strength_in_weft_value_max_value'];
$uom_of_seam_strength_in_weft_value= $_POST['uom_of_seam_strength_in_weft_value'];

$test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


 $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
 $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


$test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
$seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'];
$seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

$test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'];
$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];




   mysqli_query($con,"BEGIN");
   mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	$select_sql_for_duplicacy="select * from `defining_qc_standard_for_sanforizing_process` where `pp_number`='$pp_number' and 
    `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`='$finish_width_in_inch' and
     `standard_for_which_process`='$standard_for_which_process' and `recording_person_id`='$user_id' and `recording_person_name`='$user_name' AND
     `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator' AND
     `cf_to_rubbing_dry_tolerance_value`='$cf_to_rubbing_dry_tolerance_value' AND
     `cf_to_rubbing_dry_min_value`='$cf_to_rubbing_dry_min_value' AND
     `cf_to_rubbing_dry_max_value`='$cf_to_rubbing_dry_max_value' AND

     `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator' AND
     `cf_to_rubbing_wet_tolerance_value`='$cf_to_rubbing_wet_tolerance_value' AND
     `cf_to_rubbing_wet_min_value`='$cf_to_rubbing_wet_min_value' AND
     `cf_to_rubbing_wet_max_value`='$cf_to_rubbing_wet_max_value' AND

     `warp_yarn_count_value`='$warp_yarn_count_value' AND
     `warp_yarn_count_tolerance_range_math_operator`='$warp_yarn_count_tolerance_range_math_operator' AND 
     `warp_yarn_count_tolerance_value`='$warp_yarn_count_tolerance_value' AND
     `warp_yarn_count_min_value`='$warp_yarn_count_min_value' AND
     `warp_yarn_count_max_value`='$warp_yarn_count_max_value' AND
     `uom_of_warp_yarn_count_value`='$uom_of_warp_yarn_count_value' AND

     `weft_yarn_count_value`='$weft_yarn_count_value' AND 
     `weft_yarn_count_tolerance_range_math_operator`='$weft_yarn_count_tolerance_range_math_operator' AND
     `weft_yarn_count_tolerance_value`='$weft_yarn_count_tolerance_value' AND 
     `weft_yarn_count_min_value`='$weft_yarn_count_min_value' AND 
     `weft_yarn_count_max_value`='$weft_yarn_count_max_value' AND
     `uom_of_weft_yarn_count_value`='$uom_of_weft_yarn_count_value' AND

     `no_of_threads_in_warp_value`='$no_of_threads_in_warp_value' AND
     `no_of_threads_in_warp_tolerance_range_math_operator`='$no_of_threads_in_warp_tolerance_range_math_operator' AND
     `no_of_threads_in_warp_tolerance_value`='$no_of_threads_in_warp_tolerance_value' AND
     `no_of_threads_in_warp_min_value`='$no_of_threads_in_warp_min_value' AND
     `no_of_threads_in_warp_max_value`='$no_of_threads_in_warp_max_value' AND
     `uom_of_no_of_threads_in_warp_value`='$uom_of_no_of_threads_in_warp_value' AND 

     `no_of_threads_in_weft_value`='$no_of_threads_in_weft_value' AND
     `no_of_threads_in_weft_tolerance_range_math_operator`='$no_of_threads_in_weft_tolerance_range_math_operator' AND
     `no_of_threads_in_weft_tolerance_value`='$no_of_threads_in_weft_tolerance_value' AND
     `no_of_threads_in_weft_min_value`='$no_of_threads_in_weft_min_value' AND
     `no_of_threads_in_weft_max_value`='$no_of_threads_in_weft_max_value' AND
     `uom_of_no_of_threads_in_weft_value`='$uom_of_no_of_threads_in_weft_value' AND 

     `mass_per_unit_per_area_value`='$mass_per_unit_per_area_value' AND
     `mass_per_unit_per_area_tolerance_range_math_operator`='$mass_per_unit_per_area_tolerance_range_math_operator' AND
     `mass_per_unit_per_area_tolerance_value`='$mass_per_unit_per_area_tolerance_value' AND
     `mass_per_unit_per_area_min_value`='$mass_per_unit_per_area_min_value' AND
     `mass_per_unit_per_area_max_value`='$mass_per_unit_per_area_max_value' AND
     `uom_of_mass_per_unit_per_area_value`='$uom_of_mass_per_unit_per_area_value' AND

     `description_or_type_for_surface_fuzzing_and_pilling`='$description_or_type_for_surface_fuzzing_and_pilling' AND
     `rubs_for_surface_fuzzing_and_pilling`='$rubs_for_surface_fuzzing_and_pilling' AND
     `surface_fuzzing_and_pilling_tolerance_range_math_operator`='$surface_fuzzing_and_pilling_tolerance_range_math_operator' AND 
     `surface_fuzzing_and_pilling_tolerance_value`='$surface_fuzzing_and_pilling_tolerance_value' AND
     `surface_fuzzing_and_pilling_min_value`='$surface_fuzzing_and_pilling_min_value' AND
     `surface_fuzzing_and_pilling_max_value`='$surface_fuzzing_and_pilling_max_value' AND

     `tensile_properties_in_warp_value_tolerance_range_math_operator`='$tensile_properties_in_warp_value_tolerance_range_math_operator' AND 
     `tensile_properties_in_warp_value_tolerance_value`='$tensile_properties_in_warp_value_tolerance_value' AND
     `tensile_properties_in_warp_value_min_value`='$tensile_properties_in_warp_value_min_value' AND
     `tensile_properties_in_warp_value_max_value`='$tensile_properties_in_warp_value_max_value' AND
     `uom_of_tensile_properties_in_warp_value`='$uom_of_tensile_properties_in_warp_value' AND

     `tensile_properties_in_weft_value_tolerance_range_math_operator`='$tensile_properties_in_weft_value_tolerance_range_math_operator' AND
     `tensile_properties_in_weft_value_tolerance_value`='$tensile_properties_in_weft_value_tolerance_value' AND
     `tensile_properties_in_weft_value_min_value`='$tensile_properties_in_weft_value_min_value' AND
     `tensile_properties_in_weft_value_max_value`='$tensile_properties_in_weft_value_max_value' AND
     `uom_of_tensile_properties_in_weft_value`='$uom_of_tensile_properties_in_weft_value' AND

     `test_method_for_tear_force_in_warp`='$test_method_for_tear_force_in_warp' AND
     `tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator' AND 
     `tear_force_in_warp_value_tolerance_value`='$tear_force_in_warp_value_tolerance_value' AND
     `tear_force_in_warp_value_min_value`='$tear_force_in_warp_value_min_value' AND
     `tear_force_in_warp_value_max_value`='$tear_force_in_warp_value_max_value' AND
     `uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value' AND

     `tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator' AND 
     `tear_force_in_weft_value_tolerance_value`='$tear_force_in_weft_value_tolerance_value' AND
     `tear_force_in_weft_value_min_value`='$tear_force_in_weft_value_min_value' AND
     `tear_force_in_weft_value_max_value`='$tear_force_in_weft_value_max_value' AND
     `uom_of_tear_force_in_weft_value`='$uom_of_tear_force_in_weft_value' ";

	$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
	{

		$data_previously_saved="Yes";

	}
	else if(mysqli_num_rows($result) < 1)
	{

	    $update_sql_statement="UPDATE `defining_qc_standard_for_sanforizing_process` SET

            `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator',
            `cf_to_rubbing_dry_tolerance_value`='$cf_to_rubbing_dry_tolerance_value',
            `cf_to_rubbing_dry_min_value`='$cf_to_rubbing_dry_min_value',
            `cf_to_rubbing_dry_max_value`='$cf_to_rubbing_dry_max_value', 

            `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator',
            `cf_to_rubbing_wet_tolerance_value`='$cf_to_rubbing_wet_tolerance_value', 
            `cf_to_rubbing_wet_min_value`='$cf_to_rubbing_wet_min_value',
            `cf_to_rubbing_wet_max_value`='$cf_to_rubbing_wet_max_value',

            `warp_yarn_count_value`='$warp_yarn_count_value',
            `warp_yarn_count_tolerance_range_math_operator`='$warp_yarn_count_tolerance_range_math_operator', 
            `warp_yarn_count_tolerance_value`='$warp_yarn_count_tolerance_value', 
            `warp_yarn_count_min_value`='$warp_yarn_count_min_value', 
            `warp_yarn_count_max_value`='$warp_yarn_count_max_value', 
            `uom_of_warp_yarn_count_value`='$uom_of_warp_yarn_count_value', 
    
            `weft_yarn_count_value`='$weft_yarn_count_value', 
            `weft_yarn_count_tolerance_range_math_operator`='$weft_yarn_count_tolerance_range_math_operator', 
            `weft_yarn_count_tolerance_value`='$weft_yarn_count_tolerance_value', 
            `weft_yarn_count_min_value`='$weft_yarn_count_min_value', 
            `weft_yarn_count_max_value`='$weft_yarn_count_max_value', 
            `uom_of_weft_yarn_count_value`='$uom_of_weft_yarn_count_value',

            `no_of_threads_in_warp_value`='$no_of_threads_in_warp_value', 
            `no_of_threads_in_warp_tolerance_range_math_operator`='$no_of_threads_in_warp_tolerance_range_math_operator', 
            `no_of_threads_in_warp_tolerance_value`='$no_of_threads_in_warp_tolerance_value', 
            `no_of_threads_in_warp_min_value`='$no_of_threads_in_warp_min_value', 
            `no_of_threads_in_warp_max_value`='$no_of_threads_in_warp_max_value', 
            `uom_of_no_of_threads_in_warp_value`='$uom_of_no_of_threads_in_warp_value', 

            `no_of_threads_in_weft_value`='$no_of_threads_in_weft_value', 
            `no_of_threads_in_weft_tolerance_range_math_operator`='$no_of_threads_in_weft_tolerance_range_math_operator', 
            `no_of_threads_in_weft_tolerance_value`='$no_of_threads_in_weft_tolerance_value', 
            `no_of_threads_in_weft_min_value`='$no_of_threads_in_weft_min_value', 
            `no_of_threads_in_weft_max_value`='$no_of_threads_in_weft_max_value', 
            `uom_of_no_of_threads_in_weft_value`='$uom_of_no_of_threads_in_weft_value', 

            `mass_per_unit_per_area_value`='$mass_per_unit_per_area_value', 
            `mass_per_unit_per_area_tolerance_range_math_operator`='$mass_per_unit_per_area_tolerance_range_math_operator',
            `mass_per_unit_per_area_tolerance_value`='$mass_per_unit_per_area_tolerance_value', 
            `mass_per_unit_per_area_min_value`='$mass_per_unit_per_area_min_value', 
            `mass_per_unit_per_area_max_value`='$mass_per_unit_per_area_max_value', 
            `uom_of_mass_per_unit_per_area_value`='$uom_of_mass_per_unit_per_area_value',

            `description_or_type_for_surface_fuzzing_and_pilling`='$description_or_type_for_surface_fuzzing_and_pilling', 
            `rubs_for_surface_fuzzing_and_pilling`='$rubs_for_surface_fuzzing_and_pilling', 
            `surface_fuzzing_and_pilling_tolerance_range_math_operator`='$surface_fuzzing_and_pilling_tolerance_range_math_operator', 
            `surface_fuzzing_and_pilling_tolerance_value`='$surface_fuzzing_and_pilling_tolerance_value', 
            `surface_fuzzing_and_pilling_min_value`='$surface_fuzzing_and_pilling_min_value', 
            `surface_fuzzing_and_pilling_max_value`='$surface_fuzzing_and_pilling_max_value', 
    
            `tensile_properties_in_warp_value_tolerance_range_math_operator`='$tensile_properties_in_warp_value_tolerance_range_math_operator', 
            `tensile_properties_in_warp_value_tolerance_value`='$tensile_properties_in_warp_value_tolerance_value', 
            `tensile_properties_in_warp_value_min_value`='$tensile_properties_in_warp_value_min_value', 
            `tensile_properties_in_warp_value_max_value`='$tensile_properties_in_warp_value_max_value', 
            `uom_of_tensile_properties_in_warp_value`='$uom_of_tensile_properties_in_warp_value', 

            `tensile_properties_in_weft_value_tolerance_range_math_operator`='$tensile_properties_in_weft_value_tolerance_range_math_operator', 
            `tensile_properties_in_weft_value_tolerance_value`='$tensile_properties_in_weft_value_tolerance_value', 
            `tensile_properties_in_weft_value_min_value`='$tensile_properties_in_weft_value_min_value', 
            `tensile_properties_in_weft_value_max_value`='$tensile_properties_in_weft_value_max_value', 
            `uom_of_tensile_properties_in_weft_value`='$uom_of_tensile_properties_in_weft_value', 

            `test_method_for_tear_force_in_warp`='$test_method_for_tear_force_in_warp', 
            `tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator', 
            `tear_force_in_warp_value_tolerance_value`='$tear_force_in_warp_value_tolerance_value', 
            `tear_force_in_warp_value_min_value`='$tear_force_in_warp_value_min_value', 
            `tear_force_in_warp_value_max_value`='$tear_force_in_warp_value_max_value', 
            `uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value', 

            `tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator', 
            `tear_force_in_weft_value_tolerance_value`='$tear_force_in_weft_value_tolerance_value', 
            `tear_force_in_weft_value_min_value`='$tear_force_in_weft_value_min_value', 
            `tear_force_in_weft_value_max_value`='$tear_force_in_weft_value_max_value', 
            `uom_of_tear_force_in_weft_value`='$uom_of_tear_force_in_weft_value'

            WHERE
                `pp_number`='$pp_number' AND `version_number`='$version_number' AND customer_id='$customer_id' AND`customer_name`='$customer_name' AND `color`='$color' 
				AND `finish_width_in_inch`=$finish_width_in_inch AND `standard_for_which_process`='$standard_for_which_process'";
 


          mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));
     
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