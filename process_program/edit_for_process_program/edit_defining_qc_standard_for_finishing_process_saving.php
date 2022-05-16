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

/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

if( mysqli_num_rows($result) < 1 )
{

	header('Location:logout.php');

}
else
{
	while($row=mysqli_fetch_array($result))
	{	
		 $user_name=$row['user_name'];	
	}
}

*/

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

$test_method_for_mass_per_unit_per_area= $_POST['test_method_for_mass_per_unit_per_area'];
$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= $_POST['mass_per_unit_per_area_tolerance_range_math_operator'];
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];

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

$description_or_type_for_surface_fuzzing_and_pilling= $_POST['description_or_type_for_surface_fuzzing_and_pilling'];
$test_method_for_surface_fuzzing_and_pilling= $_POST['test_method_for_surface_fuzzing_and_pilling'];
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


$test_method_for_abrasion_resistance_c_change= $_POST['test_method_for_abrasion_resistance_c_change'];
$abrasion_resistance_c_change_rubs= $_POST['abrasion_resistance_c_change_rubs'];
$abrasion_resistance_c_change_value_math_op= $_POST['abrasion_resistance_c_change_value_math_op'];
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
$mass_loss_in_abrasion_test_value_tolerance_range_math_operator= $_POST['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'];
$mass_loss_in_abrasion_test_value_tolerance_value= $_POST['mass_loss_in_abrasion_test_value_tolerance_value'];
$mass_loss_in_abrasion_test_value_min_value= $_POST['mass_loss_in_abrasion_test_value_min_value'];
$mass_loss_in_abrasion_test_value_max_value= $_POST['mass_loss_in_abrasion_test_value_max_value'];
$uom_of_mass_loss_in_abrasion_test_value= $_POST['uom_of_mass_loss_in_abrasion_test_value'];

$test_method_for_cf_to_dry_cleaning_color_change= $_POST['test_method_for_cf_to_dry_cleaning_color_change'];
$cf_to_dry_cleaning_color_change_tolerance_range_math_operator= $_POST['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'];
$cf_to_dry_cleaning_color_change_tolerance_value= $_POST['cf_to_dry_cleaning_color_change_tolerance_value'];
$cf_to_dry_cleaning_color_change_min_value= $_POST['cf_to_dry_cleaning_color_change_min_value'];
$cf_to_dry_cleaning_color_change_max_value= $_POST['cf_to_dry_cleaning_color_change_max_value'];
$uom_of_cf_to_dry_cleaning_color_change= $_POST['uom_of_cf_to_dry_cleaning_color_change'];

$test_method_for_cf_to_dry_cleaning_staining= $_POST['test_method_for_cf_to_dry_cleaning_staining'];
$cf_to_dry_cleaning_staining_tolerance_range_math_operator= $_POST['cf_to_dry_cleaning_staining_tolerance_range_math_operator'];
$cf_to_dry_cleaning_staining_tolerance_value= $_POST['cf_to_dry_cleaning_staining_tolerance_value'];
$cf_to_dry_cleaning_staining_min_value= $_POST['cf_to_dry_cleaning_staining_min_value'];
$cf_to_dry_cleaning_staining_max_value= $_POST['cf_to_dry_cleaning_staining_max_value'];
$uom_of_cf_to_dry_cleaning_staining= $_POST['uom_of_cf_to_dry_cleaning_staining'];


$test_method_for_cf_to_washing_color_change= $_POST['test_method_for_cf_to_washing_color_change'];
$cf_to_washing_color_change_tolerance_range_math_operator= $_POST['cf_to_washing_color_change_tolerance_range_math_operator'];
$cf_to_washing_color_change_tolerance_value= $_POST['cf_to_washing_color_change_tolerance_value'];
$cf_to_washing_color_change_min_value= $_POST['cf_to_washing_color_change_min_value'];
$cf_to_washing_color_change_max_value= $_POST['cf_to_washing_color_change_max_value'];
$uom_of_cf_to_washing_color_change= $_POST['uom_of_cf_to_washing_color_change'];

$test_method_for_cf_to_washing_staining= $_POST['test_method_for_cf_to_washing_staining'];
$cf_to_washing_staining_tolerance_range_math_operator= $_POST['cf_to_washing_staining_tolerance_range_math_operator'];
$cf_to_washing_staining_tolerance_value= $_POST['cf_to_washing_staining_tolerance_value'];
$cf_to_washing_staining_min_value= $_POST['cf_to_washing_staining_min_value'];
$cf_to_washing_staining_max_value= $_POST['cf_to_washing_staining_max_value'];
$uom_of_cf_to_washing_staining= $_POST['uom_of_cf_to_washing_staining'];

$test_method_for_cf_to_washing_cross_staining= $_POST['test_method_for_cf_to_washing_cross_staining'];
$cf_to_washing_cross_staining_tolerance_range_math_operator= $_POST['cf_to_washing_cross_staining_tolerance_range_math_operator'];
$cf_to_washing_cross_staining_tolerance_value= $_POST['cf_to_washing_cross_staining_tolerance_value'];
$cf_to_washing_cross_staining_min_value= $_POST['cf_to_washing_cross_staining_min_value'];
$cf_to_washing_cross_staining_max_value= $_POST['cf_to_washing_cross_staining_max_value'];
$uom_of_cf_to_washing_cross_staining= $_POST['uom_of_cf_to_washing_cross_staining'];

$test_method_for_water_absorption_b_wash_thirty_sec= $_POST['test_method_for_water_absorption_b_wash_thirty_sec'];
$water_absorption_b_wash_thirty_sec_tolerance_range_math_op= $_POST['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'];
$water_absorption_b_wash_thirty_sec_tolerance_value= $_POST['water_absorption_b_wash_thirty_sec_tolerance_value'];
$water_absorption_b_wash_thirty_sec_min_value= $_POST['water_absorption_b_wash_thirty_sec_min_value'];
$water_absorption_b_wash_thirty_sec_max_value= $_POST['water_absorption_b_wash_thirty_sec_max_value'];
$uom_of_water_absorption_b_wash_thirty_sec= $_POST['uom_of_water_absorption_b_wash_thirty_sec'];

$test_method_for_water_absorption_b_wash_max= $_POST['test_method_for_water_absorption_b_wash_max'];
$water_absorption_b_wash_max_tolerance_range_math_op= $_POST['water_absorption_b_wash_max_tolerance_range_math_op'];
$water_absorption_b_wash_max_tolerance_value= $_POST['water_absorption_b_wash_max_tolerance_value'];
$water_absorption_b_wash_max_min_value= $_POST['water_absorption_b_wash_max_min_value'];
$water_absorption_b_wash_max_max_value= $_POST['water_absorption_b_wash_max_max_value'];
$uom_of_water_absorption_b_wash_max= $_POST['uom_of_water_absorption_b_wash_max'];


$test_method_for_water_absorption_a_wash_thirty_sec= $_POST['test_method_for_water_absorption_a_wash_thirty_sec'];
$water_absorption_a_wash_thirty_sec_tolerance_range_math_op= $_POST['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'];
$water_absorption_a_wash_thirty_sec_tolerance_value= $_POST['water_absorption_a_wash_thirty_sec_tolerance_value'];
$water_absorption_a_wash_thirty_sec_min_value= $_POST['water_absorption_a_wash_thirty_sec_min_value'];
$water_absorption_a_wash_thirty_sec_max_value= $_POST['water_absorption_a_wash_thirty_sec_max_value'];
$uom_of_water_absorption_a_wash_thirty_sec= $_POST['uom_of_water_absorption_a_wash_thirty_sec'];

$test_method_for_perspiration_acid_color_change= $_POST['test_method_for_perspiration_acid_color_change'];
$cf_to_perspiration_acid_color_change_tolerance_range_math_op= $_POST['cf_to_perspiration_acid_color_change_tolerance_range_math_op'];
$cf_to_perspiration_acid_color_change_tolerance_value= $_POST['cf_to_perspiration_acid_color_change_tolerance_value'];
$cf_to_perspiration_acid_color_change_min_value= $_POST['cf_to_perspiration_acid_color_change_min_value'];
$cf_to_perspiration_acid_color_change_max_value= $_POST['cf_to_perspiration_acid_color_change_max_value'];
$uom_of_cf_to_perspiration_acid_color_change= $_POST['uom_of_cf_to_perspiration_acid_color_change'];

$test_method_for_cf_to_perspiration_acid_staining= $_POST['test_method_for_cf_to_perspiration_acid_staining'];
$cf_to_perspiration_acid_staining_tolerance_range_math_operator= $_POST['cf_to_perspiration_acid_staining_tolerance_range_math_operator'];
$cf_to_perspiration_acid_staining_value= $_POST['cf_to_perspiration_acid_staining_value'];
$cf_to_perspiration_acid_staining_min_value= $_POST['cf_to_perspiration_acid_staining_min_value'];
$cf_to_perspiration_acid_staining_max_value= $_POST['cf_to_perspiration_acid_staining_max_value'];
$uom_of_cf_to_perspiration_acid_staining= $_POST['uom_of_cf_to_perspiration_acid_staining'];



$test_method_for_cf_to_perspiration_acid_cross_staining= $_POST['test_method_for_cf_to_perspiration_acid_cross_staining'];
$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_acid_cross_staining_tolerance_value= $_POST['cf_to_perspiration_acid_cross_staining_tolerance_value'];
$cf_to_perspiration_acid_cross_staining_min_value= $_POST['cf_to_perspiration_acid_cross_staining_min_value'];
$cf_to_perspiration_acid_cross_staining_max_value= $_POST['cf_to_perspiration_acid_cross_staining_max_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $_POST['uom_of_cf_to_perspiration_acid_cross_staining'];


$test_method_for_cf_to_perspiration_alkali_color_change= $_POST['test_method_for_cf_to_perspiration_alkali_color_change'];
$cf_to_perspiration_alkali_color_change_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'];
$cf_to_perspiration_alkali_color_change_tolerance_value= $_POST['cf_to_perspiration_alkali_color_change_tolerance_value'];
$cf_to_perspiration_alkali_color_change_min_value= $_POST['cf_to_perspiration_alkali_color_change_min_value'];
$cf_to_perspiration_alkali_color_change_max_value= $_POST['cf_to_perspiration_alkali_color_change_max_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $_POST['uom_of_cf_to_perspiration_alkali_color_change'];


$test_method_for_cf_to_perspiration_alkali_staining= $_POST['test_method_for_cf_to_perspiration_alkali_staining'];
$cf_to_perspiration_alkali_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_staining_tolerance_value'];
$cf_to_perspiration_alkali_staining_min_value= $_POST['cf_to_perspiration_alkali_staining_min_value'];
$cf_to_perspiration_alkali_staining_max_value= $_POST['cf_to_perspiration_alkali_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_staining= $_POST['uom_of_cf_to_perspiration_alkali_staining'];

$test_method_for_cf_to_perspiration_alkali_cross_staining= $_POST['test_method_for_cf_to_perspiration_alkali_cross_staining'];
$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_cross_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
$cf_to_perspiration_alkali_cross_staining_min_value= $_POST['cf_to_perspiration_alkali_cross_staining_min_value'];
$cf_to_perspiration_alkali_cross_staining_max_value= $_POST['cf_to_perspiration_alkali_cross_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $_POST['uom_of_cf_to_perspiration_alkali_cross_staining'];

$test_method_for_cf_to_water_color_change= $_POST['test_method_for_cf_to_water_color_change'];
$cf_to_water_color_change_tolerance_range_math_operator= $_POST['cf_to_water_color_change_tolerance_range_math_operator'];
$cf_to_water_color_change_tolerance_value= $_POST['cf_to_water_color_change_tolerance_value'];
$cf_to_water_color_change_min_value= $_POST['cf_to_water_color_change_min_value'];
$cf_to_water_color_change_max_value= $_POST['cf_to_water_color_change_max_value'];
$uom_of_cf_to_water_color_change= $_POST['uom_of_cf_to_water_color_change'];

$test_method_for_cf_to_water_staining= $_POST['test_method_for_cf_to_water_staining'];
$cf_to_water_staining_tolerance_range_math_operator= $_POST['cf_to_water_staining_tolerance_range_math_operator'];
$cf_to_water_staining_tolerance_value= $_POST['cf_to_water_staining_tolerance_value'];
$cf_to_water_staining_min_value= $_POST['cf_to_water_staining_min_value'];
$cf_to_water_staining_max_value= $_POST['cf_to_water_staining_max_value'];
$uom_of_cf_to_water_staining= $_POST['uom_of_cf_to_water_staining'];

$test_method_for_cf_to_water_cross_staining= $_POST['test_method_for_cf_to_water_cross_staining'];
$cf_to_water_cross_staining_tolerance_range_math_operator= $_POST['cf_to_water_cross_staining_tolerance_range_math_operator'];
$cf_to_water_cross_staining_tolerance_value= $_POST['cf_to_water_cross_staining_tolerance_value'];
$cf_to_water_cross_staining_min_value= $_POST['cf_to_water_cross_staining_min_value'];
$cf_to_water_cross_staining_max_value= $_POST['cf_to_water_cross_staining_max_value'];
$uom_of_cf_to_water_cross_staining= $_POST['uom_of_cf_to_water_cross_staining'];

$test_method_for_cf_to_water_spotting_surface= $_POST['test_method_for_cf_to_water_spotting_surface'];
$cf_to_water_spotting_surface_tolerance_range_math_op= $_POST['cf_to_water_spotting_surface_tolerance_range_math_op'];
$cf_to_water_spotting_surface_tolerance_value= $_POST['cf_to_water_spotting_surface_tolerance_value'];
$cf_to_water_spotting_surface_min_value= $_POST['cf_to_water_spotting_surface_min_value'];
$cf_to_water_spotting_surface_max_value= $_POST['cf_to_water_spotting_surface_max_value'];
$uom_of_cf_to_water_spotting_surface= $_POST['uom_of_cf_to_water_spotting_surface'];

$test_method_for_cf_to_water_spotting_edge= $_POST['test_method_for_cf_to_water_spotting_edge'];
$cf_to_water_spotting_edge_tolerance_range_math_op= $_POST['cf_to_water_spotting_edge_tolerance_range_math_op'];
$cf_to_water_spotting_edge_tolerance_value= $_POST['cf_to_water_spotting_edge_tolerance_value'];
$cf_to_water_spotting_edge_min_value= $_POST['cf_to_water_spotting_edge_min_value'];
$cf_to_water_spotting_edge_max_value= $_POST['cf_to_water_spotting_edge_max_value'];
$uom_of_cf_to_water_spotting_edge= $_POST['uom_of_cf_to_water_spotting_edge'];


$test_method_for_cf_to_water_spotting_cross_staining= $_POST['test_method_for_cf_to_water_spotting_cross_staining'];
$cf_to_water_spotting_cross_staining_tolerance_range_math_op= $_POST['cf_to_water_spotting_cross_staining_tolerance_range_math_op'];
$cf_to_water_spotting_cross_staining_tolerance_value= $_POST['cf_to_water_spotting_cross_staining_tolerance_value'];
$cf_to_water_spotting_cross_staining_min_value= $_POST['cf_to_water_spotting_cross_staining_min_value'];
$cf_to_water_spotting_cross_staining_max_value= $_POST['cf_to_water_spotting_cross_staining_max_value'];
$uom_of_cf_to_water_spotting_cross_staining= $_POST['uom_of_cf_to_water_spotting_cross_staining'];


$test_method_for_resistance_to_surface_wetting_before_wash= $_POST['test_method_for_resistance_to_surface_wetting_before_wash'];
$resistance_to_surface_wetting_before_wash_tol_range_math_op= $_POST['resistance_to_surface_wetting_before_wash_tol_range_math_op'];
$resistance_to_surface_wetting_before_wash_tolerance_value= $_POST['resistance_to_surface_wetting_before_wash_tolerance_value'];
$resistance_to_surface_wetting_before_wash_min_value= $_POST['resistance_to_surface_wetting_before_wash_min_value'];
$resistance_to_surface_wetting_before_wash_max_value= $_POST['resistance_to_surface_wetting_before_wash_max_value'];
$uom_of_resistance_to_surface_wetting_before_wash= $_POST['uom_of_resistance_to_surface_wetting_before_wash'];


$test_method_for_resistance_to_surface_wetting_after_one_wash= $_POST['test_method_for_resistance_to_surface_wetting_after_one_wash'];
$resistance_to_surface_wetting_after_one_wash_tol_range_math_op= $_POST['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'];
$resistance_to_surface_wetting_after_one_wash_tolerance_value= $_POST['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
$resistance_to_surface_wetting_after_one_wash_min_value= $_POST['resistance_to_surface_wetting_after_one_wash_min_value'];
$resistance_to_surface_wetting_after_one_wash_max_value= $_POST['resistance_to_surface_wetting_after_one_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_one_wash= $_POST['uom_of_resistance_to_surface_wetting_after_one_wash'];


$test_method_for_resistance_to_surface_wetting_after_five_wash= $_POST['test_method_for_resistance_to_surface_wetting_after_five_wash'];
$resistance_to_surface_wetting_after_five_wash_tol_range_math_op= $_POST['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'];
$resistance_to_surface_wetting_after_five_wash_tolerance_value= $_POST['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
$resistance_to_surface_wetting_after_five_wash_min_value= $_POST['resistance_to_surface_wetting_after_five_wash_min_value'];
$resistance_to_surface_wetting_after_five_wash_max_value= $_POST['resistance_to_surface_wetting_after_five_wash_max_value'];
$uom_of_resistance_to_surface_wetting_after_five_wash= $_POST['uom_of_resistance_to_surface_wetting_after_five_wash'];


$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


$test_method_for_cf_to_oxidative_bleach_damage_color_change= $_POST['test_method_for_cf_to_oxidative_bleach_damage_color_change'];
$cf_to_oxidative_bleach_damage_value= $_POST['cf_to_oxidative_bleach_damage_value'];
$cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= $_POST['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'];
$cf_to_oxidative_bleach_damage_color_change_tolerance_value= $_POST['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
$cf_to_oxidative_bleach_damage_color_change_min_value= $_POST['cf_to_oxidative_bleach_damage_color_change_min_value'];
$cf_to_oxidative_bleach_damage_color_change_max_value= $_POST['cf_to_oxidative_bleach_damage_color_change_max_value'];
$uom_of_cf_to_oxidative_bleach_damage_color_change= $_POST['uom_of_cf_to_oxidative_bleach_damage_color_change'];




$test_method_for_cf_to_phenolic_yellowing_staining= $_POST['test_method_for_cf_to_phenolic_yellowing_staining'];
$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= $_POST['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'];
$cf_to_phenolic_yellowing_staining_tolerance_value= $_POST['cf_to_phenolic_yellowing_staining_tolerance_value'];
$cf_to_phenolic_yellowing_staining_min_value= $_POST['cf_to_phenolic_yellowing_staining_min_value'];
$cf_to_phenolic_yellowing_staining_max_value= $_POST['cf_to_phenolic_yellowing_staining_max_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $_POST['uom_of_cf_to_phenolic_yellowing_staining'];


$test_method_for_cf_to_pvc_migration_staining= $_POST['test_method_for_cf_to_pvc_migration_staining'];
$cf_to_pvc_migration_staining_tolerance_range_math_operator= $_POST['cf_to_pvc_migration_staining_tolerance_range_math_operator'];
$cf_to_pvc_migration_staining_tolerance_value= $_POST['cf_to_pvc_migration_staining_tolerance_value'];
$cf_to_pvc_migration_staining_min_value= $_POST['cf_to_pvc_migration_staining_min_value'];
$cf_to_pvc_migration_staining_max_value= $_POST['cf_to_pvc_migration_staining_max_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];


$test_method_for_cf_to_saliva_staining= $_POST['test_method_for_cf_to_saliva_staining'];
$cf_to_saliva_staining_tolerance_range_math_operator= $_POST['cf_to_saliva_staining_tolerance_range_math_operator'];
$cf_to_saliva_staining_tolerance_value= $_POST['cf_to_saliva_staining_tolerance_value'];
$cf_to_saliva_staining_staining_min_value= $_POST['cf_to_saliva_staining_staining_min_value'];
$cf_to_saliva_staining_staining_min_value= $_POST['cf_to_saliva_staining_staining_min_value'];
$cf_to_saliva_staining_max_value= $_POST['cf_to_saliva_staining_max_value'];
$uom_of_cf_to_saliva_staining= $_POST['uom_of_cf_to_saliva_staining'];

$test_method_for_cf_to_saliva_color_change= $_POST['test_method_for_cf_to_saliva_color_change'];
$cf_to_saliva_color_change_tolerance_range_math_operator= $_POST['cf_to_saliva_color_change_tolerance_range_math_operator'];
$cf_to_saliva_color_change_tolerance_value= $_POST['cf_to_saliva_color_change_tolerance_value'];
$cf_to_saliva_color_change_staining_min_value= $_POST['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_staining_min_value= $_POST['cf_to_saliva_color_change_staining_min_value'];
$cf_to_saliva_color_change_max_value= $_POST['cf_to_saliva_color_change_max_value'];
$uom_of_cf_to_saliva_color_change= $_POST['uom_of_cf_to_saliva_color_change'];


$test_method_for_cf_to_chlorinated_water_color_change= $_POST['test_method_for_cf_to_chlorinated_water_color_change'];
$cf_to_chlorinated_water_color_change_tolerance_range_math_op= $_POST['cf_to_chlorinated_water_color_change_tolerance_range_math_op'];
$cf_to_chlorinated_water_color_change_tolerance_value= $_POST['cf_to_chlorinated_water_color_change_tolerance_value'];
$cf_to_chlorinated_water_color_change_min_value= $_POST['cf_to_chlorinated_water_color_change_min_value'];
$cf_to_chlorinated_water_color_change_max_value= $_POST['cf_to_chlorinated_water_color_change_max_value'];
$uom_of_cf_to_chlorinated_water_color_change= $_POST['uom_of_cf_to_chlorinated_water_color_change'];

$test_method_for_cf_to_cholorine_bleach_color_change= $_POST['test_method_for_cf_to_cholorine_bleach_color_change'];
$cf_to_cholorine_bleach_color_change_tolerance_range_math_op= $_POST['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'];
$cf_to_cholorine_bleach_color_change_tolerance_value= $_POST['cf_to_cholorine_bleach_color_change_tolerance_value'];
$cf_to_cholorine_bleach_color_change_min_value= $_POST['cf_to_cholorine_bleach_color_change_min_value'];
$cf_to_cholorine_bleach_color_change_max_value= $_POST['cf_to_cholorine_bleach_color_change_max_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $_POST['uom_of_cf_to_cholorine_bleach_color_change'];


$test_method_for_cf_to_peroxide_bleach_color_change= $_POST['test_method_for_cf_to_peroxide_bleach_color_change'];
$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= $_POST['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'];
$cf_to_peroxide_bleach_color_change_tolerance_value= $_POST['cf_to_peroxide_bleach_color_change_tolerance_value'];
$cf_to_peroxide_bleach_color_change_min_value= $_POST['cf_to_peroxide_bleach_color_change_min_value'];
$cf_to_peroxide_bleach_color_change_max_value= $_POST['cf_to_peroxide_bleach_color_change_max_value'];
$uom_of_cf_to_peroxide_bleach_color_change= $_POST['uom_of_cf_to_peroxide_bleach_color_change'];

$test_method_for_cross_staining= $_POST['test_method_for_cross_staining'];
$cross_staining_tolerance_range_math_operator= $_POST['cross_staining_tolerance_range_math_operator'];
$cross_staining_tolerance_value= $_POST['cross_staining_tolerance_value'];
$cross_staining_min_value= $_POST['cross_staining_min_value'];
$cross_staining_max_value= $_POST['cross_staining_max_value'];
$uom_of_cross_staining= $_POST['uom_of_cross_staining'];

$test_method_formaldehyde_content= $_POST['test_method_formaldehyde_content'];
$formaldehyde_content_tolerance_range_math_operator= $_POST['formaldehyde_content_tolerance_range_math_operator'];
$formaldehyde_content_tolerance_value= $_POST['formaldehyde_content_tolerance_value'];
$formaldehyde_content_min_value= $_POST['formaldehyde_content_min_value'];
$formaldehyde_content_max_value= $_POST['formaldehyde_content_max_value'];
$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];

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




$test_method_for_seam_slippage_resistance_iso_2_warp= $_POST['test_method_for_seam_slippage_resistance_iso_2_warp'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'];
$seam_slippage_resistance_iso_2_in_warp_tolerance_value= $_POST['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
$seam_slippage_resistance_iso_2_in_warp_min_value= $_POST['seam_slippage_resistance_iso_2_in_warp_min_value'];
$seam_slippage_resistance_iso_2_in_warp_max_value= $_POST['seam_slippage_resistance_iso_2_in_warp_max_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];
$uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


$test_method_for_seam_slippage_resistance_iso_2_weft= $_POST['test_method_for_seam_slippage_resistance_iso_2_weft'];
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

$seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'];
$seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
$seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


$ph_value_tolerance_range_math_operator= $_POST['ph_value_tolerance_range_math_operator'];
$ph_value_tolerance_value= $_POST['ph_value_tolerance_value'];
$ph_value_min_value= $_POST['ph_value_min_value'];
$ph_value_max_value= $_POST['ph_value_max_value'];
$uom_of_ph_value= $_POST['uom_of_ph_value'];

$description_or_type_for_water_absorption= $_POST['description_or_type_for_water_absorption'];
$water_absorption_value_tolerance_range_math_operator= $_POST['water_absorption_value_tolerance_range_math_operator'];
$water_absorption_value_tolerance_value= $_POST['water_absorption_value_tolerance_value'];
$water_absorption_value_min_value= $_POST['water_absorption_value_min_value'];
$water_absorption_value_max_value= $_POST['water_absorption_value_max_value'];
$uom_of_water_absorption_value= $_POST['uom_of_water_absorption_value'];

$wicking_test_tol_range_math_op= $_POST['wicking_test_tol_range_math_op'];
$wicking_test_tolerance_value= $_POST['wicking_test_tolerance_value'];
$wicking_test_min_value= $_POST['wicking_test_min_value'];
$wicking_test_max_value= $_POST['wicking_test_max_value'];
$uom_of_wicking_test= $_POST['uom_of_wicking_test'];


$spirality_value_tolerance_range_math_operator= $_POST['spirality_value_tolerance_range_math_operator'];
$spirality_value_tolerance_value= $_POST['spirality_value_tolerance_value'];
$spirality_value_min_value= $_POST['spirality_value_min_value'];
$spirality_value_max_value= $_POST['spirality_value_max_value'];
$uom_of_spirality_value= $_POST['uom_of_spirality_value'];


$smoothness_appearance_tolerance_range_math_op= $_POST['smoothness_appearance_tolerance_range_math_op'];
$smoothness_appearance_tolerance_value= $_POST['smoothness_appearance_tolerance_value'];
$smoothness_appearance_min_value= $_POST['smoothness_appearance_min_value'];
$smoothness_appearance_max_value= $_POST['smoothness_appearance_max_value'];
$uom_of_smoothness_appearance= $_POST['uom_of_smoothness_appearance'];


$print_duribility_m_s_c_15_washing_time_value= $_POST['print_duribility_m_s_c_15_washing_time_value'];
$print_duribility_m_s_c_15_value= $_POST['print_duribility_m_s_c_15_value'];
$uom_of_print_duribility_m_s_c_15= $_POST['uom_of_print_duribility_m_s_c_15'];


$description_or_type_for_iron_temperature= $_POST['description_or_type_for_iron_temperature'];
$iron_ability_of_woven_fabric_tolerance_range_math_op= $_POST['iron_ability_of_woven_fabric_tolerance_range_math_op'];
$iron_ability_of_woven_fabric_tolerance_value= $_POST['iron_ability_of_woven_fabric_tolerance_value'];
$iron_ability_of_woven_fabric_min_value= $_POST['iron_ability_of_woven_fabric_min_value'];
$iron_ability_of_woven_fabric_max_value= $_POST['iron_ability_of_woven_fabric_max_value'];
$uom_of_iron_ability_of_woven_fabric= $_POST['uom_of_iron_ability_of_woven_fabric'];

$color_fastess_to_artificial_daylight_blue_wool_scale= $_POST['color_fastess_to_artificial_daylight_blue_wool_scale'];
$color_fastess_to_artificial_daylight_tolerance_range_math_op= $_POST['color_fastess_to_artificial_daylight_tolerance_range_math_op'];
$color_fastess_to_artificial_daylight_tolerance_value= $_POST['color_fastess_to_artificial_daylight_tolerance_value'];
$color_fastess_to_artificial_daylight_min_value= $_POST['color_fastess_to_artificial_daylight_min_value'];
$color_fastess_to_artificial_daylight_max_value= $_POST['color_fastess_to_artificial_daylight_max_value'];
$uom_of_color_fastess_to_artificial_daylight= $_POST['uom_of_color_fastess_to_artificial_daylight'];

$test_method_for_moisture_content= $_POST['test_method_for_moisture_content'];
$moisture_content_tolerance_range_math_op= $_POST['moisture_content_tolerance_range_math_op'];
$moisture_content_tolerance_value= $_POST['moisture_content_tolerance_value'];
$moisture_content_min_value= $_POST['moisture_content_min_value'];
$moisture_content_max_value= $_POST['moisture_content_max_value'];
$uom_of_moisture_content= $_POST['uom_of_moisture_content'];


$test_method_for_evaporation_rate_quick_drying= $_POST['test_method_for_evaporation_rate_quick_drying'];
$evaporation_rate_quick_drying_tolerance_range_math_op= $_POST['evaporation_rate_quick_drying_tolerance_range_math_op'];
$evaporation_rate_quick_drying_tolerance_value= $_POST['evaporation_rate_quick_drying_tolerance_value'];
$evaporation_rate_quick_drying_min_value= $_POST['evaporation_rate_quick_drying_min_value'];
$evaporation_rate_quick_drying_max_value= $_POST['evaporation_rate_quick_drying_max_value'];
$uom_of_evaporation_rate_quick_drying= $_POST['uom_of_evaporation_rate_quick_drying'];





$percentage_of_total_cotton_content_value= $_POST['percentage_of_total_cotton_content_value'];
$percentage_of_total_cotton_content_tolerance_range_math_operator= $_POST['percentage_of_total_cotton_content_tolerance_range_math_operator'];
$percentage_of_total_cotton_content_tolerance_value= $_POST['percentage_of_total_cotton_content_tolerance_value'];
$percentage_of_total_cotton_content_min_value= $_POST['percentage_of_total_cotton_content_min_value'];
$percentage_of_total_cotton_content_max_value= $_POST['percentage_of_total_cotton_content_max_value'];
$uom_of_percentage_of_total_cotton_content= $_POST['uom_of_percentage_of_total_cotton_content'];

$percentage_of_total_polyester_content_value= $_POST['percentage_of_total_polyester_content_value'];
$percentage_of_total_polyester_content_tolerance_range_math_op= $_POST['percentage_of_total_polyester_content_tolerance_range_math_op'];
$percentage_of_total_polyester_content_tolerance_value= $_POST['percentage_of_total_polyester_content_tolerance_value'];
$percentage_of_total_polyester_content_min_value= $_POST['percentage_of_total_polyester_content_min_value'];
$percentage_of_total_polyester_content_max_value= $_POST['percentage_of_total_polyester_content_max_value'];
$uom_of_percentage_of_total_polyester_content= $_POST['uom_of_percentage_of_total_polyester_content'];

/*$description_or_type_for_total_other_fiber= $_POST['description_or_type_for_total_other_fiber'].",".$_POST['description_or_type_for_total_other_fiber_1'];*/
$description_or_type_for_total_other_fiber= $_POST['description_or_type_for_total_other_fiber'];
$percentage_of_total_other_fiber_content_value= $_POST['percentage_of_total_other_fiber_content_value'];
$percentage_of_total_other_fiber_content_tolerance_range_math_op= $_POST['percentage_of_total_other_fiber_content_tolerance_range_math_op'];
$percentage_of_total_other_fiber_content_tolerance_value= $_POST['percentage_of_total_other_fiber_content_tolerance_value'];
$percentage_of_total_other_fiber_content_min_value= $_POST['percentage_of_total_other_fiber_content_min_value'];
$percentage_of_total_other_fiber_content_max_value= $_POST['percentage_of_total_other_fiber_content_max_value'];
$uom_of_percentage_of_total_other_fiber_content= $_POST['uom_of_percentage_of_total_other_fiber_content'];

$percentage_of_warp_cotton_content_value= $_POST['percentage_of_warp_cotton_content_value'];
$percentage_of_warp_cotton_content_tolerance_range_math_operator= $_POST['percentage_of_warp_cotton_content_tolerance_range_math_operator'];
$percentage_of_warp_cotton_content_tolerance_value= $_POST['percentage_of_warp_cotton_content_tolerance_value'];
$percentage_of_warp_cotton_content_min_value= $_POST['percentage_of_warp_cotton_content_min_value'];
$uom_of_percentage_of_warp_cotton_content= $_POST['uom_of_percentage_of_warp_cotton_content'];

$percentage_of_warp_polyester_content_value= $_POST['percentage_of_warp_polyester_content_value'];
$percentage_of_warp_polyester_content_tolerance_range_math_op= $_POST['percentage_of_warp_polyester_content_tolerance_range_math_op'];
$percentage_of_warp_polyester_content_tolerance_value= $_POST['percentage_of_warp_polyester_content_tolerance_value'];
$percentage_of_warp_polyester_content_min_value= $_POST['percentage_of_warp_polyester_content_min_value'];
$percentage_of_warp_polyester_content_max_value= $_POST['percentage_of_warp_polyester_content_max_value'];
$uom_of_percentage_of_warp_polyester_content= $_POST['uom_of_percentage_of_warp_polyester_content'];

$description_or_type_for_warp_other_fiber= $_POST['description_or_type_for_warp_other_fiber'];
$percentage_of_warp_other_fiber_content_value= $_POST['percentage_of_warp_other_fiber_content_value'];
$percentage_of_warp_other_fiber_content_tolerance_range_math_op= $_POST['percentage_of_warp_other_fiber_content_tolerance_range_math_op'];
$percentage_of_warp_other_fiber_content_tolerance_value= $_POST['percentage_of_warp_other_fiber_content_tolerance_value'];
$percentage_of_warp_other_fiber_content_min_value= $_POST['percentage_of_warp_other_fiber_content_min_value'];
$percentage_of_warp_other_fiber_content_max_value= $_POST['percentage_of_warp_other_fiber_content_max_value'];
$uom_of_percentage_of_warp_other_fiber_content= $_POST['uom_of_percentage_of_warp_other_fiber_content'];

$percentage_of_weft_cotton_content_value= $_POST['percentage_of_weft_cotton_content_value'];
$percentage_of_weft_cotton_content_tolerance_range_math_op= $_POST['percentage_of_weft_cotton_content_tolerance_range_math_op'];
$percentage_of_weft_cotton_content_tolerance_value= $_POST['percentage_of_weft_cotton_content_tolerance_value'];
$percentage_of_weft_cotton_content_min_value= $_POST['percentage_of_weft_cotton_content_min_value'];
$percentage_of_weft_cotton_content_max_value= $_POST['percentage_of_weft_cotton_content_max_value'];
$uom_of_percentage_of_weft_cotton_content= $_POST['uom_of_percentage_of_weft_cotton_content'];

$percentage_of_weft_polyester_content_value= $_POST['percentage_of_weft_polyester_content_value'];
$percentage_of_weft_polyester_content_tolerance_range_math_op= $_POST['percentage_of_weft_polyester_content_tolerance_range_math_op'];
$percentage_of_weft_polyester_content_tolerance_value= $_POST['percentage_of_weft_polyester_content_tolerance_value'];
$percentage_of_weft_polyester_content_min_value= $_POST['percentage_of_weft_polyester_content_min_value'];
$percentage_of_weft_polyester_content_max_value= $_POST['percentage_of_weft_polyester_content_max_value'];
$uom_of_percentage_of_weft_polyester_content= $_POST['uom_of_percentage_of_weft_polyester_content'];

$description_or_type_for_weft_other_fiber= $_POST['description_or_type_for_weft_other_fiber'];
$percentage_of_weft_other_fiber_content_value= $_POST['percentage_of_weft_other_fiber_content_value'];
$percentage_of_weft_other_fiber_content_tolerance_range_math_op= $_POST['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
$percentage_of_weft_other_fiber_content_tolerance_value= $_POST['percentage_of_weft_other_fiber_content_tolerance_value'];
$percentage_of_weft_other_fiber_content_min_value= $_POST['percentage_of_weft_other_fiber_content_min_value'];
$percentage_of_weft_other_fiber_content_max_value= $_POST['percentage_of_weft_other_fiber_content_max_value'];
$uom_of_percentage_of_weft_other_fiber_content= $_POST['uom_of_percentage_of_weft_other_fiber_content'];





//from new database and form





   mysqli_query($con,"BEGIN");
   mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	$select_sql_for_duplicacy="select * from `defining_qc_standard_for_finishing_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and 
	`customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`='$finish_width_in_inch' and `standard_for_which_process`='$standard_for_which_process' AND
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

				`mass_per_unit_per_area_value`='$mass_per_unit_per_area_value' AND 
				`mass_per_unit_per_area_tolerance_range_math_operator`='$mass_per_unit_per_area_tolerance_range_math_operator' AND 
				`mass_per_unit_per_area_tolerance_value`='$mass_per_unit_per_area_tolerance_value' AND 
				`mass_per_unit_per_area_min_value`='$mass_per_unit_per_area_min_value' AND 
				`mass_per_unit_per_area_max_value`='$mass_per_unit_per_area_max_value' AND 
				`uom_of_mass_per_unit_per_area_value`='$uom_of_mass_per_unit_per_area_value' AND 

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

				`tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator' AND 
				`tear_force_in_warp_value_tolerance_value`='$tear_force_in_warp_value_tolerance_value' AND 
				`tear_force_in_warp_value_min_value`='$tear_force_in_warp_value_min_value' AND 
				`tear_force_in_warp_value_max_value`='$tear_force_in_warp_value_max_value' AND 
				`uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value' AND 
		
				`tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator' AND 
				`tear_force_in_weft_value_tolerance_value`='$tear_force_in_weft_value_tolerance_value' AND 
				`tear_force_in_weft_value_min_value`='$tear_force_in_weft_value_min_value' AND 
				`tear_force_in_weft_value_max_value`='$tear_force_in_weft_value_max_value' AND 
				`uom_of_tear_force_in_weft_value`='$uom_of_tear_force_in_weft_value' AND 

				`formaldehyde_content_tolerance_range_math_operator`='$formaldehyde_content_tolerance_range_math_operator' AND 
				`formaldehyde_content_tolerance_value`='$formaldehyde_content_tolerance_value' AND 
				`formaldehyde_content_min_value`='$formaldehyde_content_min_value' AND 
				`formaldehyde_content_max_value`='$formaldehyde_content_max_value' AND 
				`uom_of_formaldehyde_content`='$uom_of_formaldehyde_content' AND 

				`cf_to_perspiration_acid_color_change_tolerance_range_math_op`='$cf_to_perspiration_acid_color_change_tolerance_range_math_op' AND 
				`cf_to_perspiration_acid_color_change_tolerance_value`='$cf_to_perspiration_acid_color_change_tolerance_value' AND 
				`cf_to_perspiration_acid_color_change_min_value`='$cf_to_perspiration_acid_color_change_min_value' AND 
				`cf_to_perspiration_acid_color_change_max_value`='$cf_to_perspiration_acid_color_change_max_value' AND 
				
				`cf_to_perspiration_acid_staining_tolerance_range_math_operator`='$cf_to_perspiration_acid_staining_tolerance_range_math_operator' AND 
				`cf_to_perspiration_acid_staining_value`='$cf_to_perspiration_acid_staining_value' AND 
				`cf_to_perspiration_acid_staining_min_value`='$cf_to_perspiration_acid_staining_min_value' AND 
				`cf_to_perspiration_acid_staining_max_value`='$cf_to_perspiration_acid_staining_max_value' AND 
			
				`cf_to_perspiration_acid_cross_staining_tolerance_range_math_op`='$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op' AND 
				`cf_to_perspiration_acid_cross_staining_tolerance_value`='$cf_to_perspiration_acid_cross_staining_tolerance_value' AND 
				`cf_to_perspiration_acid_cross_staining_max_value`='$cf_to_perspiration_acid_cross_staining_max_value' AND 
				`cf_to_perspiration_acid_cross_staining_min_value`='$cf_to_perspiration_acid_cross_staining_min_value' AND 
			
				`cf_to_perspiration_alkali_color_change_tolerance_range_math_op`='$cf_to_perspiration_alkali_color_change_tolerance_range_math_op' AND 
				`cf_to_perspiration_alkali_color_change_tolerance_value`='$cf_to_perspiration_alkali_color_change_tolerance_value' AND 
				`cf_to_perspiration_alkali_color_change_min_value`='$cf_to_perspiration_alkali_color_change_min_value' AND 
				`cf_to_perspiration_alkali_color_change_max_value`='$cf_to_perspiration_alkali_color_change_max_value' AND 
			
				`cf_to_perspiration_alkali_staining_tolerance_range_math_op`='$cf_to_perspiration_alkali_staining_tolerance_range_math_op' AND  
				`cf_to_perspiration_alkali_staining_tolerance_value`='$cf_to_perspiration_alkali_staining_tolerance_value' AND 
				`cf_to_perspiration_alkali_staining_min_value`='$cf_to_perspiration_alkali_staining_min_value' AND 
				`cf_to_perspiration_alkali_staining_max_value`='$cf_to_perspiration_alkali_staining_max_value' AND 
			
				`cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op`='$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op' AND 
				`cf_to_perspiration_alkali_cross_staining_tolerance_value`='$cf_to_perspiration_alkali_cross_staining_tolerance_value' AND 
				`cf_to_perspiration_alkali_cross_staining_min_value`='$cf_to_perspiration_alkali_cross_staining_min_value' AND 
				`cf_to_perspiration_alkali_cross_staining_max_value`='$cf_to_perspiration_alkali_cross_staining_max_value' AND 
		
				`ph_value_min_value`='$ph_value_min_value' AND 
				`ph_value_max_value`='$ph_value_max_value' AND 

				`color_fastess_to_artificial_daylight_blue_wool_scale`='$color_fastess_to_artificial_daylight_blue_wool_scale' AND  
				`color_fastess_to_artificial_daylight_tolerance_range_math_op`='$color_fastess_to_artificial_daylight_tolerance_range_math_op' AND  
				`color_fastess_to_artificial_daylight_tolerance_value`='$color_fastess_to_artificial_daylight_tolerance_value' AND 
				`color_fastess_to_artificial_daylight_min_value`='$color_fastess_to_artificial_daylight_min_value' AND 
				`color_fastess_to_artificial_daylight_max_value`='$color_fastess_to_artificial_daylight_max_value' ";

	$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
	{

		$data_previously_saved="Yes";

	}
	else if(mysqli_num_rows($result) < 1)
	{

			$update_sql_statement="UPDATE  `defining_qc_standard_for_finishing_process` SET
			
			
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

				`mass_per_unit_per_area_value`='$mass_per_unit_per_area_value', 
				`mass_per_unit_per_area_tolerance_range_math_operator`='$mass_per_unit_per_area_tolerance_range_math_operator',
				`mass_per_unit_per_area_tolerance_value`='$mass_per_unit_per_area_tolerance_value', 
				`mass_per_unit_per_area_min_value`='$mass_per_unit_per_area_min_value', 
				`mass_per_unit_per_area_max_value`='$mass_per_unit_per_area_max_value', 
				`uom_of_mass_per_unit_per_area_value`='$uom_of_mass_per_unit_per_area_value',

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

				`tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator', 
				`tear_force_in_warp_value_tolerance_value`='$tear_force_in_warp_value_tolerance_value', 
				`tear_force_in_warp_value_min_value`='$tear_force_in_warp_value_min_value', 
				`tear_force_in_warp_value_max_value`='$tear_force_in_warp_value_max_value', 
				`uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value', 
		
				`tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator', 
				`tear_force_in_weft_value_tolerance_value`='$tear_force_in_weft_value_tolerance_value', 
				`tear_force_in_weft_value_min_value`='$tear_force_in_weft_value_min_value', 
				`tear_force_in_weft_value_max_value`='$tear_force_in_weft_value_max_value', 
				`uom_of_tear_force_in_weft_value`='$uom_of_tear_force_in_weft_value', 

				`formaldehyde_content_tolerance_range_math_operator`='$formaldehyde_content_tolerance_range_math_operator', 
				`formaldehyde_content_tolerance_value`='$formaldehyde_content_tolerance_value', 
				`formaldehyde_content_min_value`='$formaldehyde_content_min_value', 
				`formaldehyde_content_max_value`='$formaldehyde_content_max_value', 
				`uom_of_formaldehyde_content`='$uom_of_formaldehyde_content', 

				`cf_to_perspiration_acid_color_change_tolerance_range_math_op`='$cf_to_perspiration_acid_color_change_tolerance_range_math_op', 
				`cf_to_perspiration_acid_color_change_tolerance_value`='$cf_to_perspiration_acid_color_change_tolerance_value', 
				`cf_to_perspiration_acid_color_change_min_value`='$cf_to_perspiration_acid_color_change_min_value', 
				`cf_to_perspiration_acid_color_change_max_value`='$cf_to_perspiration_acid_color_change_max_value', 
				
				`cf_to_perspiration_acid_staining_tolerance_range_math_operator`='$cf_to_perspiration_acid_staining_tolerance_range_math_operator', 
				`cf_to_perspiration_acid_staining_value`='$cf_to_perspiration_acid_staining_value', 
				`cf_to_perspiration_acid_staining_min_value`='$cf_to_perspiration_acid_staining_min_value', 
				`cf_to_perspiration_acid_staining_max_value`='$cf_to_perspiration_acid_staining_max_value', 
			
				`cf_to_perspiration_acid_cross_staining_tolerance_range_math_op`='$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op', 
				`cf_to_perspiration_acid_cross_staining_tolerance_value`='$cf_to_perspiration_acid_cross_staining_tolerance_value', 
				`cf_to_perspiration_acid_cross_staining_max_value`='$cf_to_perspiration_acid_cross_staining_max_value', 
				`cf_to_perspiration_acid_cross_staining_min_value`='$cf_to_perspiration_acid_cross_staining_min_value', 
			
				`cf_to_perspiration_alkali_color_change_tolerance_range_math_op`='$cf_to_perspiration_alkali_color_change_tolerance_range_math_op', 
				`cf_to_perspiration_alkali_color_change_tolerance_value`='$cf_to_perspiration_alkali_color_change_tolerance_value', 
				`cf_to_perspiration_alkali_color_change_min_value`='$cf_to_perspiration_alkali_color_change_min_value', 
				`cf_to_perspiration_alkali_color_change_max_value`='$cf_to_perspiration_alkali_color_change_max_value', 
			
				`cf_to_perspiration_alkali_staining_tolerance_range_math_op`='$cf_to_perspiration_alkali_staining_tolerance_range_math_op', 
				`cf_to_perspiration_alkali_staining_tolerance_value`='$cf_to_perspiration_alkali_staining_tolerance_value', 
				`cf_to_perspiration_alkali_staining_min_value`='$cf_to_perspiration_alkali_staining_min_value', 
				`cf_to_perspiration_alkali_staining_max_value`='$cf_to_perspiration_alkali_staining_max_value', 
			
				`cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op`='$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op', 
				`cf_to_perspiration_alkali_cross_staining_tolerance_value`='$cf_to_perspiration_alkali_cross_staining_tolerance_value', 
				`cf_to_perspiration_alkali_cross_staining_min_value`='$cf_to_perspiration_alkali_cross_staining_min_value', 
				`cf_to_perspiration_alkali_cross_staining_max_value`='$cf_to_perspiration_alkali_cross_staining_max_value', 
		
				`ph_value_min_value`='$ph_value_min_value', 
				`ph_value_max_value`='$ph_value_max_value', 

				`color_fastess_to_artificial_daylight_blue_wool_scale`='$color_fastess_to_artificial_daylight_blue_wool_scale', 
				`color_fastess_to_artificial_daylight_tolerance_range_math_op`='$color_fastess_to_artificial_daylight_tolerance_range_math_op', 
				`color_fastess_to_artificial_daylight_tolerance_value`='$color_fastess_to_artificial_daylight_tolerance_value', 
				`color_fastess_to_artificial_daylight_min_value`='$color_fastess_to_artificial_daylight_min_value', 
				`color_fastess_to_artificial_daylight_max_value`='$color_fastess_to_artificial_daylight_max_value'
					
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

?>
