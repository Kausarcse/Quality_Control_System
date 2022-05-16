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

$test_method_for_mass_per_unit_per_area= $_POST['test_method_for_mass_per_unit_per_area'];
$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['mass_per_unit_per_area_tolerance_range_math_operator'])));
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];

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

$description_or_type_for_surface_fuzzing_and_pilling= $_POST['description_or_type_for_surface_fuzzing_and_pilling'];
$test_method_for_surface_fuzzing_and_pilling= $_POST['test_method_for_surface_fuzzing_and_pilling'];
$rubs_for_surface_fuzzing_and_pilling= $_POST['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
$surface_fuzzing_and_pilling_tolerance_value= $_POST['surface_fuzzing_and_pilling_tolerance_value'];
$surface_fuzzing_and_pilling_min_value= $_POST['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $_POST['surface_fuzzing_and_pilling_max_value'];
$uom_of_surface_fuzzing_and_pilling_value= $_POST['uom_of_surface_fuzzing_and_pilling_value'];

$test_method_for_tensile_properties_in_warp= $_POST['test_method_for_tensile_properties_in_warp'];
$tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
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


$test_method_for_abrasion_resistance_c_change= $_POST['test_method_for_abrasion_resistance_c_change'];
$abrasion_resistance_c_change_rubs= $_POST['abrasion_resistance_c_change_rubs'];
$abrasion_resistance_c_change_value_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['abrasion_resistance_c_change_value_math_op'])));
$abrasion_resistance_c_change_value_tolerance_value= $_POST['abrasion_resistance_c_change_value_tolerance_value'];
$abrasion_resistance_c_change_value_min_value= $_POST['abrasion_resistance_c_change_value_min_value'];
$abrasion_resistance_c_change_value_max_value= $_POST['abrasion_resistance_c_change_value_max_value'];
$uom_of_abrasion_resistance_c_change_value= $_POST['uom_of_abrasion_resistance_c_change_value'];

$test_method_for_abrasion_resistance_no_of_thread_break= $_POST['test_method_for_abrasion_resistance_no_of_thread_break'];
$abrasion_resistance_no_of_thread_break= $_POST['abrasion_resistance_no_of_thread_break'];
$abrasion_resistance_rubs= $_POST['abrasion_resistance_rubs'];
$abrasion_resistance_thread_break= $_POST['abrasion_resistance_thread_break'];


$test_method_for_mass_loss_in_abrasion_test= $_POST['test_method_for_mass_loss_in_abrasion_test'];
$rubs_for_mass_loss_in_abrasion_test= $_POST['rubs_for_mass_loss_in_abrasion_test'];
$mass_loss_in_abrasion_test_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'])));
$mass_loss_in_abrasion_test_value_tolerance_value= $_POST['mass_loss_in_abrasion_test_value_tolerance_value'];
$mass_loss_in_abrasion_test_value_min_value= $_POST['mass_loss_in_abrasion_test_value_min_value'];
$mass_loss_in_abrasion_test_value_max_value= $_POST['mass_loss_in_abrasion_test_value_max_value'];
$uom_of_mass_loss_in_abrasion_test_value= $_POST['uom_of_mass_loss_in_abrasion_test_value'];

$test_method_for_cf_to_dry_cleaning_color_change= $_POST['test_method_for_cf_to_dry_cleaning_color_change'];
$cf_to_dry_cleaning_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'])));
$cf_to_dry_cleaning_color_change_tolerance_value= $_POST['cf_to_dry_cleaning_color_change_tolerance_value'];
$cf_to_dry_cleaning_color_change_min_value= $_POST['cf_to_dry_cleaning_color_change_min_value'];
$cf_to_dry_cleaning_color_change_max_value= $_POST['cf_to_dry_cleaning_color_change_max_value'];
$uom_of_cf_to_dry_cleaning_color_change= $_POST['uom_of_cf_to_dry_cleaning_color_change'];

$test_method_for_cf_to_dry_cleaning_staining= $_POST['test_method_for_cf_to_dry_cleaning_staining'];
$cf_to_dry_cleaning_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_dry_cleaning_staining_tolerance_range_math_operator'])));
$cf_to_dry_cleaning_staining_tolerance_value= $_POST['cf_to_dry_cleaning_staining_tolerance_value'];
$cf_to_dry_cleaning_staining_min_value= $_POST['cf_to_dry_cleaning_staining_min_value'];
$cf_to_dry_cleaning_staining_max_value= $_POST['cf_to_dry_cleaning_staining_max_value'];
$uom_of_cf_to_dry_cleaning_staining= $_POST['uom_of_cf_to_dry_cleaning_staining'];


$test_method_for_cf_to_washing_color_change= $_POST['test_method_for_cf_to_washing_color_change'];
$cf_to_washing_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_washing_color_change_tolerance_range_math_operator'])));
$cf_to_washing_color_change_tolerance_value= $_POST['cf_to_washing_color_change_tolerance_value'];
$cf_to_washing_color_change_min_value= $_POST['cf_to_washing_color_change_min_value'];
$cf_to_washing_color_change_max_value= $_POST['cf_to_washing_color_change_max_value'];
$uom_of_cf_to_washing_color_change= $_POST['uom_of_cf_to_washing_color_change'];

$test_method_for_cf_to_washing_staining= $_POST['test_method_for_cf_to_washing_staining'];
$cf_to_washing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_washing_staining_tolerance_range_math_operator'])));
$cf_to_washing_staining_tolerance_value= $_POST['cf_to_washing_staining_tolerance_value'];
$cf_to_washing_staining_min_value= $_POST['cf_to_washing_staining_min_value'];
$cf_to_washing_staining_max_value= $_POST['cf_to_washing_staining_max_value'];
$uom_of_cf_to_washing_staining= $_POST['uom_of_cf_to_washing_staining'];

$test_method_for_cf_to_washing_cross_staining= $_POST['test_method_for_cf_to_washing_cross_staining'];
$cf_to_washing_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_washing_cross_staining_tolerance_range_math_operator'])));
$cf_to_washing_cross_staining_tolerance_value= $_POST['cf_to_washing_cross_staining_tolerance_value'];
$cf_to_washing_cross_staining_min_value= $_POST['cf_to_washing_cross_staining_min_value'];
$cf_to_washing_cross_staining_max_value= $_POST['cf_to_washing_cross_staining_max_value'];
$uom_of_cf_to_washing_cross_staining= $_POST['uom_of_cf_to_washing_cross_staining'];

$test_method_for_water_absorption_b_wash_thirty_sec= $_POST['test_method_for_water_absorption_b_wash_thirty_sec'];
$water_absorption_b_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'])));
$water_absorption_b_wash_thirty_sec_tolerance_value= $_POST['water_absorption_b_wash_thirty_sec_tolerance_value'];
$water_absorption_b_wash_thirty_sec_min_value= $_POST['water_absorption_b_wash_thirty_sec_min_value'];
$water_absorption_b_wash_thirty_sec_max_value= $_POST['water_absorption_b_wash_thirty_sec_max_value'];
$uom_of_water_absorption_b_wash_thirty_sec= $_POST['uom_of_water_absorption_b_wash_thirty_sec'];

$test_method_for_water_absorption_b_wash_max= $_POST['test_method_for_water_absorption_b_wash_max'];
$water_absorption_b_wash_max_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['water_absorption_b_wash_max_tolerance_range_math_op'])));
$water_absorption_b_wash_max_tolerance_value= $_POST['water_absorption_b_wash_max_tolerance_value'];
$water_absorption_b_wash_max_min_value= $_POST['water_absorption_b_wash_max_min_value'];
$water_absorption_b_wash_max_max_value= $_POST['water_absorption_b_wash_max_max_value'];
$uom_of_water_absorption_b_wash_max= $_POST['uom_of_water_absorption_b_wash_max'];


$test_method_for_water_absorption_a_wash_thirty_sec= $_POST['test_method_for_water_absorption_a_wash_thirty_sec'];
$water_absorption_a_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'])));
$water_absorption_a_wash_thirty_sec_tolerance_value= $_POST['water_absorption_a_wash_thirty_sec_tolerance_value'];
$water_absorption_a_wash_thirty_sec_min_value= $_POST['water_absorption_a_wash_thirty_sec_min_value'];
$water_absorption_a_wash_thirty_sec_max_value= $_POST['water_absorption_a_wash_thirty_sec_max_value'];
$uom_of_water_absorption_a_wash_thirty_sec= $_POST['uom_of_water_absorption_a_wash_thirty_sec'];

$test_method_for_perspiration_acid_color_change= $_POST['test_method_for_perspiration_acid_color_change'];
$cf_to_perspiration_acid_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_acid_color_change_tolerance_range_math_op'])));
$cf_to_perspiration_acid_color_change_tolerance_value= $_POST['cf_to_perspiration_acid_color_change_tolerance_value'];
$cf_to_perspiration_acid_color_change_min_value= $_POST['cf_to_perspiration_acid_color_change_min_value'];
$cf_to_perspiration_acid_color_change_max_value= $_POST['cf_to_perspiration_acid_color_change_max_value'];
$uom_of_cf_to_perspiration_acid_color_change= $_POST['uom_of_cf_to_perspiration_acid_color_change'];

$test_method_for_cf_to_perspiration_acid_staining= $_POST['test_method_for_cf_to_perspiration_acid_staining'];
$cf_to_perspiration_acid_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_acid_staining_tolerance_range_math_operator'])));
$cf_to_perspiration_acid_staining_value= $_POST['cf_to_perspiration_acid_staining_value'];
$cf_to_perspiration_acid_staining_min_value= $_POST['cf_to_perspiration_acid_staining_min_value'];
$cf_to_perspiration_acid_staining_max_value= $_POST['cf_to_perspiration_acid_staining_max_value'];
$uom_of_cf_to_perspiration_acid_staining= $_POST['uom_of_cf_to_perspiration_acid_staining'];



$test_method_for_cf_to_perspiration_acid_cross_staining= $_POST['test_method_for_cf_to_perspiration_acid_cross_staining'];
$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'])));
$cf_to_perspiration_acid_cross_staining_tolerance_value= $_POST['cf_to_perspiration_acid_cross_staining_tolerance_value'];
$cf_to_perspiration_acid_cross_staining_min_value= $_POST['cf_to_perspiration_acid_cross_staining_min_value'];
$cf_to_perspiration_acid_cross_staining_max_value= $_POST['cf_to_perspiration_acid_cross_staining_max_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $_POST['uom_of_cf_to_perspiration_acid_cross_staining'];


$test_method_for_cf_to_perspiration_alkali_color_change= $_POST['test_method_for_cf_to_perspiration_alkali_color_change'];
$cf_to_perspiration_alkali_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'])));
$cf_to_perspiration_alkali_color_change_tolerance_value= $_POST['cf_to_perspiration_alkali_color_change_tolerance_value'];
$cf_to_perspiration_alkali_color_change_min_value= $_POST['cf_to_perspiration_alkali_color_change_min_value'];
$cf_to_perspiration_alkali_color_change_max_value= $_POST['cf_to_perspiration_alkali_color_change_max_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $_POST['uom_of_cf_to_perspiration_alkali_color_change'];


$test_method_for_cf_to_perspiration_alkali_staining= $_POST['test_method_for_cf_to_perspiration_alkali_staining'];
$cf_to_perspiration_alkali_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_alkali_staining_tolerance_range_math_op'])));
$cf_to_perspiration_alkali_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_staining_tolerance_value'];
$cf_to_perspiration_alkali_staining_min_value= $_POST['cf_to_perspiration_alkali_staining_min_value'];
$cf_to_perspiration_alkali_staining_max_value= $_POST['cf_to_perspiration_alkali_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_staining= $_POST['uom_of_cf_to_perspiration_alkali_staining'];

$test_method_for_cf_to_perspiration_alkali_cross_staining= $_POST['test_method_for_cf_to_perspiration_alkali_cross_staining'];
$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'])));
$cf_to_perspiration_alkali_cross_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
$cf_to_perspiration_alkali_cross_staining_min_value= $_POST['cf_to_perspiration_alkali_cross_staining_min_value'];
$cf_to_perspiration_alkali_cross_staining_max_value= $_POST['cf_to_perspiration_alkali_cross_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $_POST['uom_of_cf_to_perspiration_alkali_cross_staining'];

$test_method_for_cf_to_water_color_change= $_POST['test_method_for_cf_to_water_color_change'];
$cf_to_water_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_color_change_tolerance_range_math_operator'])));
$cf_to_water_color_change_tolerance_value= $_POST['cf_to_water_color_change_tolerance_value'];
$cf_to_water_color_change_min_value= $_POST['cf_to_water_color_change_min_value'];
$cf_to_water_color_change_max_value= $_POST['cf_to_water_color_change_max_value'];
$uom_of_cf_to_water_color_change= $_POST['uom_of_cf_to_water_color_change'];

$test_method_for_cf_to_water_staining= $_POST['test_method_for_cf_to_water_staining'];
$cf_to_water_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_staining_tolerance_range_math_operator'])));
$cf_to_water_staining_tolerance_value= $_POST['cf_to_water_staining_tolerance_value'];
$cf_to_water_staining_min_value= $_POST['cf_to_water_staining_min_value'];
$cf_to_water_staining_max_value= $_POST['cf_to_water_staining_max_value'];
$uom_of_cf_to_water_staining= $_POST['uom_of_cf_to_water_staining'];

$test_method_for_cf_to_water_cross_staining= $_POST['test_method_for_cf_to_water_cross_staining'];
$cf_to_water_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_cross_staining_tolerance_range_math_operator'])));
$cf_to_water_cross_staining_tolerance_value= $_POST['cf_to_water_cross_staining_tolerance_value'];
$cf_to_water_cross_staining_min_value= $_POST['cf_to_water_cross_staining_min_value'];
$cf_to_water_cross_staining_max_value= $_POST['cf_to_water_cross_staining_max_value'];
$uom_of_cf_to_water_cross_staining= $_POST['uom_of_cf_to_water_cross_staining'];

$test_method_for_cf_to_water_spotting_surface= $_POST['test_method_for_cf_to_water_spotting_surface'];
$cf_to_water_spotting_surface_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_spotting_surface_tolerance_range_math_op'])));
$cf_to_water_spotting_surface_tolerance_value= $_POST['cf_to_water_spotting_surface_tolerance_value'];
$cf_to_water_spotting_surface_min_value= $_POST['cf_to_water_spotting_surface_min_value'];
$cf_to_water_spotting_surface_max_value= $_POST['cf_to_water_spotting_surface_max_value'];
$uom_of_cf_to_water_spotting_surface= $_POST['uom_of_cf_to_water_spotting_surface'];

$test_method_for_cf_to_water_spotting_edge= $_POST['test_method_for_cf_to_water_spotting_edge'];
$cf_to_water_spotting_edge_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_spotting_edge_tolerance_range_math_op'])));
$cf_to_water_spotting_edge_tolerance_value= $_POST['cf_to_water_spotting_edge_tolerance_value'];
$cf_to_water_spotting_edge_min_value= $_POST['cf_to_water_spotting_edge_min_value'];
$cf_to_water_spotting_edge_max_value= $_POST['cf_to_water_spotting_edge_max_value'];
$uom_of_cf_to_water_spotting_edge= $_POST['uom_of_cf_to_water_spotting_edge'];


$test_method_for_cf_to_water_spotting_cross_staining= $_POST['test_method_for_cf_to_water_spotting_cross_staining'];
$cf_to_water_spotting_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_water_spotting_cross_staining_tolerance_range_math_op'])));
$cf_to_water_spotting_cross_staining_tolerance_value= $_POST['cf_to_water_spotting_cross_staining_tolerance_value'];
$cf_to_water_spotting_cross_staining_min_value= $_POST['cf_to_water_spotting_cross_staining_min_value'];
$cf_to_water_spotting_cross_staining_max_value= $_POST['cf_to_water_spotting_cross_staining_max_value'];
$uom_of_cf_to_water_spotting_cross_staining= $_POST['uom_of_cf_to_water_spotting_cross_staining'];


$test_method_for_resistance_to_surface_wetting_before_wash= $_POST['test_method_for_resistance_to_surface_wetting_before_wash'];
$resistance_to_surface_wetting_before_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['resistance_to_surface_wetting_before_wash_tol_range_math_op'])));
$resistance_to_surface_wetting_before_wash_tolerance_value= $_POST['resistance_to_surface_wetting_before_wash_tolerance_value'];
$resistance_to_surface_wetting_before_wash_min_value= $_POST['resistance_to_surface_wetting_before_wash_min_value'];
$resistance_to_surface_wetting_before_wash_max_value= $_POST['resistance_to_surface_wetting_before_wash_max_value'];
$uom_of_resistance_to_surface_wetting_before_wash= $_POST['uom_of_resistance_to_surface_wetting_before_wash'];


$test_method_for_resistance_to_surface_wetting_after_one_wash= $_POST['test_method_for_resistance_to_surface_wetting_after_one_wash'];
$resistance_to_surface_wetting_after_one_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'])));
$resistance_to_surface_wetting_after_one_wash_tolerance_value= $_POST['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
$resistance_to_surface_wetting_after_one_wash_min_value= $_POST['resistance_to_surface_wetting_after_one_wash_min_value'];
$resistance_to_surface_wetting_after_one_wash_max_value= $_POST['resistance_to_surface_wetting_after_one_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_one_wash= $_POST['uom_of_resistance_to_surface_wetting_after_one_wash'];


$test_method_for_resistance_to_surface_wetting_after_five_wash= $_POST['test_method_for_resistance_to_surface_wetting_after_five_wash'];
$resistance_to_surface_wetting_after_five_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'])));
$resistance_to_surface_wetting_after_five_wash_tolerance_value= $_POST['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
$resistance_to_surface_wetting_after_five_wash_min_value= $_POST['resistance_to_surface_wetting_after_five_wash_min_value'];
$resistance_to_surface_wetting_after_five_wash_max_value= $_POST['resistance_to_surface_wetting_after_five_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_five_wash= $_POST['uom_of_resistance_to_surface_wetting_after_five_wash'];


$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'])));
$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


$test_method_for_cf_to_oxidative_bleach_damage_color_change= $_POST['test_method_for_cf_to_oxidative_bleach_damage_color_change'];
$cf_to_oxidative_bleach_damage_value= $_POST['cf_to_oxidative_bleach_damage_value'];
$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'])));
$cf_to_oxidative_bleach_damage_color_change_tolerance_value= $_POST['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
$cf_to_oxidative_bleach_damage_color_change_min_value= $_POST['cf_to_oxidative_bleach_damage_color_change_min_value'];
$cf_to_oxidative_bleach_damage_color_change_max_value= $_POST['cf_to_oxidative_bleach_damage_color_change_max_value'];
$uom_of_cf_to_oxidative_bleach_damage_color_change= $_POST['uom_of_cf_to_oxidative_bleach_damage_color_change'];




$test_method_for_cf_to_phenolic_yellowing_staining= $_POST['test_method_for_cf_to_phenolic_yellowing_staining'];
$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'])));
$cf_to_phenolic_yellowing_staining_tolerance_value= $_POST['cf_to_phenolic_yellowing_staining_tolerance_value'];
$cf_to_phenolic_yellowing_staining_min_value= $_POST['cf_to_phenolic_yellowing_staining_min_value'];
$cf_to_phenolic_yellowing_staining_max_value= $_POST['cf_to_phenolic_yellowing_staining_max_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $_POST['uom_of_cf_to_phenolic_yellowing_staining'];


$test_method_for_cf_to_pvc_migration_staining= $_POST['test_method_for_cf_to_pvc_migration_staining'];
$cf_to_pvc_migration_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_pvc_migration_staining_tolerance_range_math_operator'])));
$cf_to_pvc_migration_staining_tolerance_value= $_POST['cf_to_pvc_migration_staining_tolerance_value'];
$cf_to_pvc_migration_staining_min_value= $_POST['cf_to_pvc_migration_staining_min_value'];
$cf_to_pvc_migration_staining_max_value= $_POST['cf_to_pvc_migration_staining_max_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];


$test_method_for_cf_to_saliva_staining= $_POST['test_method_for_cf_to_saliva_staining'];
$cf_to_saliva_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_saliva_staining_tolerance_range_math_operator'])));
$cf_to_saliva_staining_tolerance_value= $_POST['cf_to_saliva_staining_tolerance_value'];
$cf_to_saliva_staining_staining_min_value= $_POST['cf_to_saliva_staining_staining_min_value'];
$cf_to_saliva_staining_max_value= $_POST['cf_to_saliva_staining_max_value'];
$uom_of_cf_to_saliva_staining= $_POST['uom_of_cf_to_saliva_staining'];

$test_method_for_cf_to_saliva_color_change= $_POST['test_method_for_cf_to_saliva_color_change'];
$cf_to_saliva_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_saliva_color_change_tolerance_range_math_operator'])));
$cf_to_saliva_color_change_tolerance_value= $_POST['cf_to_saliva_color_change_tolerance_value'];
$cf_to_saliva_color_change_staining_min_value= $_POST['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_staining_min_value= $_POST['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_max_value= $_POST['cf_to_saliva_color_change_max_value'];
$uom_of_cf_to_saliva_color_change= $_POST['uom_of_cf_to_saliva_color_change'];


$test_method_for_cf_to_chlorinated_water_color_change= $_POST['test_method_for_cf_to_chlorinated_water_color_change'];
$cf_to_chlorinated_water_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_chlorinated_water_color_change_tolerance_range_math_op'])));
$cf_to_chlorinated_water_color_change_tolerance_value= $_POST['cf_to_chlorinated_water_color_change_tolerance_value'];
$cf_to_chlorinated_water_color_change_min_value= $_POST['cf_to_chlorinated_water_color_change_min_value'];
$cf_to_chlorinated_water_color_change_max_value= $_POST['cf_to_chlorinated_water_color_change_max_value'];
$uom_of_cf_to_chlorinated_water_color_change= $_POST['uom_of_cf_to_chlorinated_water_color_change'];

$test_method_for_cf_to_cholorine_bleach_color_change= $_POST['test_method_for_cf_to_cholorine_bleach_color_change'];
$cf_to_cholorine_bleach_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'])));
$cf_to_cholorine_bleach_color_change_tolerance_value= $_POST['cf_to_cholorine_bleach_color_change_tolerance_value'];
$cf_to_cholorine_bleach_color_change_min_value= $_POST['cf_to_cholorine_bleach_color_change_min_value'];
$cf_to_cholorine_bleach_color_change_max_value= $_POST['cf_to_cholorine_bleach_color_change_max_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $_POST['uom_of_cf_to_cholorine_bleach_color_change'];


$test_method_for_cf_to_peroxide_bleach_color_change= $_POST['test_method_for_cf_to_peroxide_bleach_color_change'];
$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'])));
$cf_to_peroxide_bleach_color_change_tolerance_value= $_POST['cf_to_peroxide_bleach_color_change_tolerance_value'];
$cf_to_peroxide_bleach_color_change_min_value= $_POST['cf_to_peroxide_bleach_color_change_min_value'];
$cf_to_peroxide_bleach_color_change_max_value= $_POST['cf_to_peroxide_bleach_color_change_max_value'];
$uom_of_cf_to_peroxide_bleach_color_change= $_POST['uom_of_cf_to_peroxide_bleach_color_change'];

$test_method_for_cross_staining= $_POST['test_method_for_cross_staining'];
$cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cross_staining_tolerance_range_math_operator'])));
$cross_staining_tolerance_value= $_POST['cross_staining_tolerance_value'];
$cross_staining_min_value= $_POST['cross_staining_min_value'];
$cross_staining_max_value= $_POST['cross_staining_max_value'];
$uom_of_cross_staining= $_POST['uom_of_cross_staining'];

$test_method_formaldehyde_content= $_POST['test_method_formaldehyde_content'];
$formaldehyde_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['formaldehyde_content_tolerance_range_math_operator'])));
$formaldehyde_content_tolerance_value= $_POST['formaldehyde_content_tolerance_value'];
$formaldehyde_content_min_value= $_POST['formaldehyde_content_min_value'];
$formaldehyde_content_max_value= $_POST['formaldehyde_content_max_value'];
$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];

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




$test_method_for_seam_slippage_resistance_iso_2_warp= $_POST['test_method_for_seam_slippage_resistance_iso_2_warp'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
$seam_slippage_resistance_iso_2_in_warp_min_value= $_POST['seam_slippage_resistance_iso_2_in_warp_min_value'];
$seam_slippage_resistance_iso_2_in_warp_max_value= $_POST['seam_slippage_resistance_iso_2_in_warp_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];
$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


$test_method_for_seam_slippage_resistance_iso_2_weft= $_POST['test_method_for_seam_slippage_resistance_iso_2_weft'];
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

$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];

$ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['ph_value_tolerance_range_math_operator'])));
$ph_value_tolerance_value= $_POST['ph_value_tolerance_value'];
$ph_value_min_value= $_POST['ph_value_min_value'];
$ph_value_max_value= $_POST['ph_value_max_value'];
$uom_of_ph_value= $_POST['uom_of_ph_value'];

$description_or_type_for_water_absorption= $_POST['description_or_type_for_water_absorption'];
$water_absorption_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['water_absorption_value_tolerance_range_math_operator'])));
$water_absorption_value_tolerance_value= $_POST['water_absorption_value_tolerance_value'];
$water_absorption_value_min_value= $_POST['water_absorption_value_min_value'];
$water_absorption_value_max_value= $_POST['water_absorption_value_max_value'];
$uom_of_water_absorption_value= $_POST['uom_of_water_absorption_value'];

$wicking_test_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['wicking_test_tol_range_math_op'])));
$wicking_test_tolerance_value= $_POST['wicking_test_tolerance_value'];
$wicking_test_min_value= $_POST['wicking_test_min_value'];
$wicking_test_max_value= $_POST['wicking_test_max_value'];
$uom_of_wicking_test= $_POST['uom_of_wicking_test'];

$spirality_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['spirality_value_tolerance_range_math_operator'])));
$spirality_value_tolerance_value= $_POST['spirality_value_tolerance_value'];
$spirality_value_min_value= $_POST['spirality_value_min_value'];
$spirality_value_max_value= $_POST['spirality_value_max_value'];
$uom_of_spirality_value= $_POST['uom_of_spirality_value'];

$smoothness_appearance_tolerance_washing_cycle = $_POST['smoothness_appearance_tolerance_washing_cycle'];
$smoothness_appearance_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['smoothness_appearance_tolerance_range_math_op'])));
$smoothness_appearance_tolerance_value= $_POST['smoothness_appearance_tolerance_value'];
$smoothness_appearance_min_value= $_POST['smoothness_appearance_min_value'];
$smoothness_appearance_max_value= $_POST['smoothness_appearance_max_value'];
$uom_of_smoothness_appearance= $_POST['uom_of_smoothness_appearance'];


$print_duribility_m_s_c_15_washing_time_value= $_POST['print_duribility_m_s_c_15_washing_time_value'];
$print_duribility_m_s_c_15_value= $_POST['print_duribility_m_s_c_15_value'];
$uom_of_print_duribility_m_s_c_15= $_POST['uom_of_print_duribility_m_s_c_15'];


$description_or_type_for_iron_temperature= $_POST['description_or_type_for_iron_temperature'];
$iron_ability_of_woven_fabric_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['iron_ability_of_woven_fabric_tolerance_range_math_op'])));
$iron_ability_of_woven_fabric_tolerance_value= $_POST['iron_ability_of_woven_fabric_tolerance_value'];
$iron_ability_of_woven_fabric_min_value= $_POST['iron_ability_of_woven_fabric_min_value'];
$iron_ability_of_woven_fabric_max_value= $_POST['iron_ability_of_woven_fabric_max_value'];
$uom_of_iron_ability_of_woven_fabric= $_POST['uom_of_iron_ability_of_woven_fabric'];

$color_fastess_to_artificial_daylight_blue_wool_scale= $_POST['color_fastess_to_artificial_daylight_blue_wool_scale'];
$color_fastess_to_artificial_daylight_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['color_fastess_to_artificial_daylight_tolerance_range_math_op'])));
$color_fastess_to_artificial_daylight_tolerance_value= $_POST['color_fastess_to_artificial_daylight_tolerance_value'];
$color_fastess_to_artificial_daylight_min_value= $_POST['color_fastess_to_artificial_daylight_min_value'];
$color_fastess_to_artificial_daylight_max_value= $_POST['color_fastess_to_artificial_daylight_max_value'];
$uom_of_color_fastess_to_artificial_daylight= $_POST['uom_of_color_fastess_to_artificial_daylight'];

$test_method_for_moisture_content= $_POST['test_method_for_moisture_content'];
$moisture_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['moisture_content_tolerance_range_math_op'])));
$moisture_content_tolerance_value= $_POST['moisture_content_tolerance_value'];
$moisture_content_min_value= $_POST['moisture_content_min_value'];
$moisture_content_max_value= $_POST['moisture_content_max_value'];
$uom_of_moisture_content= $_POST['uom_of_moisture_content'];


$test_method_for_evaporation_rate_quick_drying= $_POST['test_method_for_evaporation_rate_quick_drying'];
$evaporation_rate_quick_drying_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['evaporation_rate_quick_drying_tolerance_range_math_op'])));
$evaporation_rate_quick_drying_tolerance_value= $_POST['evaporation_rate_quick_drying_tolerance_value'];
$evaporation_rate_quick_drying_min_value= $_POST['evaporation_rate_quick_drying_min_value'];
$evaporation_rate_quick_drying_max_value= $_POST['evaporation_rate_quick_drying_max_value'];
$uom_of_evaporation_rate_quick_drying= $_POST['uom_of_evaporation_rate_quick_drying'];





$percentage_of_total_cotton_content_value= $_POST['percentage_of_total_cotton_content_value'];
$percentage_of_total_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_total_cotton_content_tolerance_range_math_operator'])));
$percentage_of_total_cotton_content_tolerance_value= $_POST['percentage_of_total_cotton_content_tolerance_value'];
$percentage_of_total_cotton_content_min_value= $_POST['percentage_of_total_cotton_content_min_value'];
$percentage_of_total_cotton_content_max_value= $_POST['percentage_of_total_cotton_content_max_value'];
$uom_of_percentage_of_total_cotton_content= $_POST['uom_of_percentage_of_total_cotton_content'];

$percentage_of_total_polyester_content_value= $_POST['percentage_of_total_polyester_content_value'];
$percentage_of_total_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_total_polyester_content_tolerance_range_math_op'])));
$percentage_of_total_polyester_content_tolerance_value= $_POST['percentage_of_total_polyester_content_tolerance_value'];
$percentage_of_total_polyester_content_min_value= $_POST['percentage_of_total_polyester_content_min_value'];
$percentage_of_total_polyester_content_max_value= $_POST['percentage_of_total_polyester_content_max_value'];
$uom_of_percentage_of_total_polyester_content= $_POST['uom_of_percentage_of_total_polyester_content'];

/*$description_or_type_for_total_other_fiber= $_POST['description_or_type_for_total_other_fiber'].",".$_POST['description_or_type_for_total_other_fiber_1'];*/
$description_or_type_for_total_other_fiber= $_POST['description_or_type_for_total_other_fiber'];
$percentage_of_total_other_fiber_content_value= $_POST['percentage_of_total_other_fiber_content_value'];
$percentage_of_total_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_total_other_fiber_content_tolerance_range_math_op'])));
$percentage_of_total_other_fiber_content_tolerance_value= $_POST['percentage_of_total_other_fiber_content_tolerance_value'];
$percentage_of_total_other_fiber_content_min_value= $_POST['percentage_of_total_other_fiber_content_min_value'];
$percentage_of_total_other_fiber_content_max_value= $_POST['percentage_of_total_other_fiber_content_max_value'];
$uom_of_percentage_of_total_other_fiber_content= $_POST['uom_of_percentage_of_total_other_fiber_content'];

$percentage_of_warp_cotton_content_value= $_POST['percentage_of_warp_cotton_content_value'];
$percentage_of_warp_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_warp_cotton_content_tolerance_range_math_operator'])));
$percentage_of_warp_cotton_content_tolerance_value= $_POST['percentage_of_warp_cotton_content_tolerance_value'];
$percentage_of_warp_cotton_content_min_value= $_POST['percentage_of_warp_cotton_content_min_value'];
$uom_of_percentage_of_warp_cotton_content= $_POST['uom_of_percentage_of_warp_cotton_content'];

$percentage_of_warp_polyester_content_value= $_POST['percentage_of_warp_polyester_content_value'];
$percentage_of_warp_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_warp_polyester_content_tolerance_range_math_op'])));
$percentage_of_warp_polyester_content_tolerance_value= $_POST['percentage_of_warp_polyester_content_tolerance_value'];
$percentage_of_warp_polyester_content_min_value= $_POST['percentage_of_warp_polyester_content_min_value'];
$percentage_of_warp_polyester_content_max_value= $_POST['percentage_of_warp_polyester_content_max_value'];
$uom_of_percentage_of_warp_polyester_content= $_POST['uom_of_percentage_of_warp_polyester_content'];

$description_or_type_for_warp_other_fiber= $_POST['description_or_type_for_warp_other_fiber'];
$percentage_of_warp_other_fiber_content_value= $_POST['percentage_of_warp_other_fiber_content_value'];
$percentage_of_warp_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_warp_other_fiber_content_tolerance_range_math_op'])));
$percentage_of_warp_other_fiber_content_tolerance_value= $_POST['percentage_of_warp_other_fiber_content_tolerance_value'];
$percentage_of_warp_other_fiber_content_min_value= $_POST['percentage_of_warp_other_fiber_content_min_value'];
$percentage_of_warp_other_fiber_content_max_value= $_POST['percentage_of_warp_other_fiber_content_max_value'];
$uom_of_percentage_of_warp_other_fiber_content= $_POST['uom_of_percentage_of_warp_other_fiber_content'];

$percentage_of_weft_cotton_content_value= $_POST['percentage_of_weft_cotton_content_value'];
$percentage_of_weft_cotton_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_weft_cotton_content_tolerance_range_math_op'])));
$percentage_of_weft_cotton_content_tolerance_value= $_POST['percentage_of_weft_cotton_content_tolerance_value'];
$percentage_of_weft_cotton_content_min_value= $_POST['percentage_of_weft_cotton_content_min_value'];
$percentage_of_weft_cotton_content_max_value= $_POST['percentage_of_weft_cotton_content_max_value'];
$uom_of_percentage_of_weft_cotton_content= $_POST['uom_of_percentage_of_weft_cotton_content'];

$percentage_of_weft_polyester_content_value= $_POST['percentage_of_weft_polyester_content_value'];
$percentage_of_weft_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_weft_polyester_content_tolerance_range_math_op'])));
$percentage_of_weft_polyester_content_tolerance_value= $_POST['percentage_of_weft_polyester_content_tolerance_value'];
$percentage_of_weft_polyester_content_min_value= $_POST['percentage_of_weft_polyester_content_min_value'];
$percentage_of_weft_polyester_content_max_value= $_POST['percentage_of_weft_polyester_content_max_value'];
$uom_of_percentage_of_weft_polyester_content= $_POST['uom_of_percentage_of_weft_polyester_content'];

$description_or_type_for_weft_other_fiber= $_POST['description_or_type_for_weft_other_fiber'];
$percentage_of_weft_other_fiber_content_value= $_POST['percentage_of_weft_other_fiber_content_value'];
$percentage_of_weft_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_weft_other_fiber_content_tolerance_range_math_op'])));
$percentage_of_weft_other_fiber_content_tolerance_value= $_POST['percentage_of_weft_other_fiber_content_tolerance_value'];
$percentage_of_weft_other_fiber_content_min_value= $_POST['percentage_of_weft_other_fiber_content_min_value'];
$percentage_of_weft_other_fiber_content_max_value= $_POST['percentage_of_weft_other_fiber_content_max_value'];
$uom_of_percentage_of_weft_other_fiber_content= $_POST['uom_of_percentage_of_weft_other_fiber_content'];

if(isset($_POST['test_method_for_appearance_after_wash']))
{
    $appearance_after_wash_radio_button = $_POST['test_method_for_appearance_after_wash'];
    
    if($appearance_after_wash_radio_button == 'Fabric (Mock up)')
    {
        if(isset($_POST['appearance_after_washing_cycle_fabric_wash']))
        {
            $appearance_after_wash_for_fabric_radio_button = $_POST['appearance_after_washing_cycle_fabric_wash'];
            $appearance_after_wash_for_garments_radio_button = '';
        }
        else
        {
            $appearance_after_wash_for_fabric_radio_button = '';
        }
    }
    if($appearance_after_wash_radio_button == 'Garments')
    {
        if(isset($_POST['appearance_after_washing_cycle_garments_wash']))
        {
            $appearance_after_wash_for_garments_radio_button = $_POST['appearance_after_washing_cycle_garments_wash'];
            $appearance_after_wash_for_fabric_radio_button = '';
        }
        else
        {
            $appearance_after_wash_for_garments_radio_button = '';
        }
    }
}
else
{
    $appearance_after_wash_radio_button = '';
    $appearance_after_wash_for_fabric_radio_button = '';
    $appearance_after_wash_for_garments_radio_button = '';
}




// echo $appearance_after_wash_radio_button;
// echo $appearance_after_wash_for_fabric_radio_button;
// echo $appearance_after_wash_for_garments_radio_button;
// exit();
// $test_method_for_appearance_after_wash_fabric="";
// if(!empty($_POST['test_method_for_appearance_after_wash_fabric']))
// {
//     foreach($_POST['test_method_for_appearance_after_wash_fabric'] as $test_method_for_appearance_after_wash_value)
//     {
//       $test_method_for_appearance_after_wash_fabric.= $test_method_for_appearance_after_wash_value. "  ";
//     }
    
// }
// $appearance_after_washing_cycle_fabric_wash="";
// if(!empty($_POST['appearance_after_washing_cycle_fabric_wash']))
// {
//     foreach($_POST['appearance_after_washing_cycle_fabric_wash'] as $appearance_after_washing_cycle_fabric_wash_value)
//     {
//       $appearance_after_washing_cycle_fabric_wash.= $appearance_after_washing_cycle_fabric_wash_value. " ";
//     }
    
// }

$test_method_for_appearance_after_washing_fabric_color_change=$_POST['test_method_for_appearance_after_washing_fabric_color_change'];
$appearance_after_washing_fabric_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_color_change_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_color_change_tolerance_value=$_POST['appearance_after_washing_fabric_color_change_tolerance_value'];
$uom_of_appearance_after_washing_fabric_color_change=$_POST['uom_of_appearance_after_washing_fabric_color_change'];
$appearance_after_washing_fabric_color_change_min_value=$_POST['appearance_after_washing_fabric_color_change_min_value'];
$appearance_after_washing_fabric_color_change_max_value=$_POST['appearance_after_washing_fabric_color_change_max_value'];

$test_method_for_appearance_after_washing_fabric_cross_staining=$_POST['test_method_for_appearance_after_washing_fabric_cross_staining'];
$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_cross_staining_tolerance_value=$_POST['appearance_after_washing_fabric_cross_staining_tolerance_value'];
$uom_of_appearance_after_washing_fabric_cross_staining=$_POST['uom_of_appearance_after_washing_fabric_cross_staining'];
$appearance_after_washing_fabric_cross_staining_min_value=$_POST['appearance_after_washing_fabric_cross_staining_min_value'];
$appearance_after_washing_fabric_cross_staining_max_value=$_POST['appearance_after_washing_fabric_cross_staining_max_value'];

$test_method_for_appearance_after_washing_fabric_surface_fuzzing=$_POST['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$_POST['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_surface_fuzzing=$_POST['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
$appearance_after_washing_fabric_surface_fuzzing_min_value=$_POST['appearance_after_washing_fabric_surface_fuzzing_min_value'];
$appearance_after_washing_fabric_surface_fuzzing_max_value=$_POST['appearance_after_washing_fabric_surface_fuzzing_max_value'];

$test_method_for_appearance_after_washing_fabric_surface_pilling=$_POST['test_method_for_appearance_after_washing_fabric_surface_pilling'];
$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_surface_pilling_tolerance_value=$_POST['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
$uom_of_appearance_after_washing_fabric_surface_pilling=$_POST['uom_of_appearance_after_washing_fabric_surface_pilling'];
$appearance_after_washing_fabric_surface_pilling_min_value=$_POST['appearance_after_washing_fabric_surface_pilling_min_value'];
$appearance_after_washing_fabric_surface_pilling_max_value=$_POST['appearance_after_washing_fabric_surface_pilling_max_value'];

$test_method_for_appearance_after_washing_fabric_crease_before_ironing=$_POST['test_method_for_appearance_after_washing_fabric_crease_before_ironing'];
$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$_POST['appearance_after_washing_fabric_crease_before_ironing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_crease_before_ironing=$_POST['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
$appearance_after_washing_fabric_crease_before_ironing_min_value=$_POST['appearance_after_washing_fabric_crease_before_ironing_min_value'];
$appearance_after_washing_fabric_crease_before_ironing_max_value=$_POST['appearance_after_washing_fabric_crease_before_ironing_max_value'];

$test_method_for_appearance_after_washing_fabric_crease_after_ironing=$_POST['test_method_for_appearance_after_washing_fabric_crease_after_ironing'];
$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator'])));
$appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$_POST['appearance_after_washing_fabric_crease_after_ironing_tolerance_value'];
$uom_of_appearance_after_washing_fabric_crease_after_ironing=$_POST['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
$appearance_after_washing_fabric_crease_after_ironing_min_value=$_POST['appearance_after_washing_fabric_crease_after_ironing_min_value'];
$appearance_after_washing_fabric_crease_after_ironing_max_value=$_POST['appearance_after_washing_fabric_crease_after_ironing_max_value'];

$test_method_for_appearance_after_washing_fabric_loss_of_print=$_POST['test_method_for_appearance_after_washing_fabric_loss_of_print'];
$appearance_after_washing_loss_of_print_fabric=$_POST['appearance_after_washing_loss_of_print_fabric'];
$test_method_for_appearance_after_washing_fabric_abrasive_mark=$_POST['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
$appearance_after_washing_fabric_abrasive_mark=$_POST['appearance_after_washing_fabric_abrasive_mark'];
$test_method_for_appearance_after_washing_fabric_odor=$_POST['test_method_for_appearance_after_washing_fabric_odor'];
$appearance_after_washing_odor_fabric=$_POST['appearance_after_washing_odor_fabric'];
$appearance_after_washing_other_observation_fabric = mysqli_real_escape_string($con, $_POST['appearance_after_washing_other_observation_fabric']);

// $appearance_after_washing_cycle_garments_wash="";
// if(!empty($_POST['appearance_after_washing_cycle_garments_wash']))
// {
//     foreach($_POST['appearance_after_washing_cycle_garments_wash'] as $appearance_after_washing_cycle_garments_wash_value)
//     {
//       $appearance_after_washing_cycle_garments_wash.= $appearance_after_washing_cycle_garments_wash_value. "  ";
//     }
    
// }

$test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$_POST['test_method_for_appearance_after_washing_garments_color_change_without_suppressor'];
$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator'])));
$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$_POST['appearance_after_washing_garments_color_change_without_suppressor_tolerance_value'];
$uom_of_appearance_after_washing_garments_color_change_without_suppressor=$_POST['uom_of_appearance_after_washing_garments_color_change_without_suppressor'];
$appearance_after_washing_garments_color_change_without_suppressor_min_value=$_POST['appearance_after_washing_garments_color_change_without_suppressor_min_value'];
$appearance_after_washing_garments_color_change_without_suppressor_max_value=$_POST['appearance_after_washing_garments_color_change_without_suppressor_max_value'];

$test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$_POST['test_method_for_appearance_after_washing_garments_color_change_with_suppressor'];
$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator'])));
$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$_POST['appearance_after_washing_garments_color_change_with_suppressor_tolerance_value'];
$uom_of_appearance_after_washing_garments_color_change_with_suppressor=$_POST['uom_of_appearance_after_washing_garments_color_change_with_suppressor'];
$appearance_after_washing_garments_color_change_with_suppressor_min_value=$_POST['appearance_after_washing_garments_color_change_with_suppressor_min_value'];
$appearance_after_washing_garments_color_change_with_suppressor_max_value=$_POST['appearance_after_washing_garments_color_change_with_suppressor_max_value'];

$test_method_for_appearance_after_washing_garments_cross_staining=$_POST['test_method_for_appearance_after_washing_garments_cross_staining'];
$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_cross_staining_tolerance_range_math_operator'])));
$appearance_after_washing_garments_cross_staining_tolerance_value=$_POST['appearance_after_washing_garments_cross_staining_tolerance_value'];
$uom_of_appearance_after_washing_garments_cross_staining=$_POST['uom_of_appearance_after_washing_garments_cross_staining'];
$appearance_after_washing_garments_cross_staining_min_value=$_POST['appearance_after_washing_garments_cross_staining_min_value'];
$appearance_after_washing_garments_cross_staining_max_value=$_POST['appearance_after_washing_garments_cross_staining_max_value'];

$test_method_for_appearance_after_washing_garments_differential_shrinkage=$_POST['test_method_for_appearance_after_washing_garments_differential_shrinkage'];
$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator'])));
$appearance_after_washing_garments__differential_shrinkage_tolerance_value=$_POST['appearance_after_washing_garments__differential_shrinkage_tolerance_value'];
$uom_of_appearance_after_washing_garments__differential_shrinkage=$_POST['uom_of_appearance_after_washing_garments__differential_shrinkage'];
$appearance_after_washing_garments__differential_shrinkage_min_value=$_POST['appearance_after_washing_garments__differential_shrinkage_min_value'];
$appearance_after_washing_garments__differential_shrinkage_max_value=$_POST['appearance_after_washing_garments__differential_shrinkage_max_value'];

$test_method_for_appearance_after_washing_garments_surface_fuzzing=$_POST['test_method_for_appearance_after_washing_garments_surface_fuzzing'];
$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator'])));
$appearance_after_washing_garments_surface_fuzzing_tolerance_value=$_POST['appearance_after_washing_garments_surface_fuzzing_tolerance_value'];
$uom_of_appearance_after_washing_garments_surface_fuzzing=$_POST['uom_of_appearance_after_washing_garments_surface_fuzzing'];
$appearance_after_washing_garments_surface_fuzzing_min_value=$_POST['appearance_after_washing_garments_surface_fuzzing_min_value'];
$appearance_after_washing_garments_surface_fuzzing_max_value=$_POST['appearance_after_washing_garments_surface_fuzzing_max_value'];

$test_method_for_appearance_after_washing_garments_surface_pilling=$_POST['test_method_for_appearance_after_washing_garments_surface_pilling'];
$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator'])));
$appearance_after_washing_garments_surface_pilling_tolerance_value=$_POST['appearance_after_washing_garments_surface_pilling_tolerance_value'];
$uom_of_appearance_after_washing_garments_surface_pilling=$_POST['uom_of_appearance_after_washing_garments_surface_pilling'];
$appearance_after_washing_garments_surface_pilling_min_value=$_POST['appearance_after_washing_garments_surface_pilling_min_value'];
$appearance_after_washing_garments_surface_pilling_max_value=$_POST['appearance_after_washing_garments_surface_pilling_max_value'];

$test_method_for_appearance_after_washing_garments_crease_after_ironing=$_POST['test_method_for_appearance_after_washing_garments_crease_after_ironing'];
$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator'])));
$appearance_after_washing_garments_crease_after_ironing_tolerance_value=$_POST['appearance_after_washing_garments_crease_after_ironing_tolerance_value'];
$uom_of_appearance_after_washing_garments_crease_after_ironing=$_POST['uom_of_appearance_after_washing_garments_crease_after_ironing'];
$appearance_after_washing_garments_crease_after_ironing_min_value=$_POST['appearance_after_washing_garments_crease_after_ironing_min_value'];
$appearance_after_washing_garments_crease_after_ironing_max_value=$_POST['appearance_after_washing_garments_crease_after_ironing_max_value'];

$test_method_for_appearance_after_washing_garments_abrasive_mark=$_POST['test_method_for_appearance_after_washing_garments_abrasive_mark'];
$appearance_after_washing_garments_abrasive_mark=$_POST['appearance_after_washing_garments_abrasive_mark'];
$test_method_for_appearance_after_washing_garments_seam_breakdown=$_POST['test_method_for_appearance_after_washing_garments_seam_breakdown'];
$seam_breakdown_garments=$_POST['seam_breakdown_garments'];

$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$_POST['test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator'])));
$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$_POST['appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value'];
$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$_POST['uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$_POST['appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$_POST['appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value'];

$test_method_for_appearance_after_washing_garments_detachment_of_interlining=$_POST['test_method_for_appearance_after_washing_garments_detachment_of_interlining'];
$detachment_of_interlinings_fused_components_garments=$_POST['detachment_of_interlinings_fused_components_garments'];
$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$_POST['test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance'];
$change_id_handle_or_appearance=$_POST['change_id_handle_or_appearance'];
$test_method_for_appearance_after_washing_garments_effect_accessories=$_POST['test_method_for_appearance_after_washing_garments_effect_accessories'];
$effect_on_accessories_such_as_buttons=$_POST['effect_on_accessories_such_as_buttons'];
$test_method_for_appearance_after_washing_garments_spirality=$_POST['test_method_for_appearance_after_washing_garments_spirality'];
$appearance_after_washing_garments_spirality_min_value=$_POST['appearance_after_washing_garments_spirality_min_value'];
$appearance_after_washing_garments_spirality_max_value=$_POST['appearance_after_washing_garments_spirality_max_value'];

$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$_POST['test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons'];
$detachment_or_fraying_of_ribbons=$_POST['detachment_or_fraying_of_ribbons'];
$test_method_for_appearance_after_washing_garments_loss_of_print=$_POST['test_method_for_appearance_after_washing_garments_loss_of_print'];
$loss_of_print_garments=$_POST['loss_of_print_garments'];
$test_method_for_appearance_after_washing_garments_care_level=$_POST['test_method_for_appearance_after_washing_garments_care_level'];
$care_level_garments=$_POST['care_level_garments'];
$test_method_for_appearance_after_washing_garments_odor=$_POST['test_method_for_appearance_after_washing_garments_odor'];
$odor_garments=$_POST['odor_garments'];
$appearance_after_washing_other_observation_garments = mysqli_real_escape_string($con, $_POST['appearance_after_washing_other_observation_garments']);

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_finishing_process` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' ";


$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $insert_sql_for_define_model="insert into `model_defining_qc_standard_for_finishing_process`
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
      `uom_of_seam_slippage_resistance_iso_2_in_weft_for_load`, 

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

      `smoothness_appearance_tolerance_washing_cycle`,
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
      appearance_after_washing_cycle_fabric_wash,
      
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
      appearance_after_washing_other_observation_fabric,
   
      appearance_after_washing_cycle_garments_wash,
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
      appearance_after_washing_other_observation_garments,

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
			'$uom_of_seam_slippage_resistance_iso_2_in_weft_for_load',

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

			'$smoothness_appearance_tolerance_washing_cycle',
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
                 
			'$appearance_after_wash_radio_button',
			'$appearance_after_wash_for_fabric_radio_button',

			'$test_method_for_appearance_after_washing_fabric_color_change',
			'$appearance_after_washing_fabric_color_change_tolerance_range_math_operator',
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
			'$appearance_after_washing_other_observation_fabric',

			'$appearance_after_wash_for_garments_radio_button',

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
			'$appearance_after_washing_other_observation_garments',



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
