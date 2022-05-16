<?php
session_start();
require_once("../login/session.php");
include('db_connection_class.php');
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
$splitted_receiving_date= explode("?fs?",$version_number);
$version_number= $splitted_receiving_date[0];
$version_id= $splitted_receiving_date[4];

$customer_name= $_POST['customer_name'];
$color= $_POST['color'];
$greige_width= $_POST['greige_width'];
$standard_for_which_process= $_POST['standard_for_which_process'];
$cf_to_rubbing_dry_tolerance_range_math_operator= $_POST['cf_to_rubbing_dry_tolerance_range_math_operator'];
$cf_to_rubbing_dry_tolerance_value= $_POST['cf_to_rubbing_dry_tolerance_value'];
$cf_to_rubbing_dry_min_value= $_POST['cf_to_rubbing_dry_min_value'];
$cf_to_rubbing_dry_max_value= $_POST['cf_to_rubbing_dry_max_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];

$cf_to_rubbing_wet_tolerance_range_math_operator= $_POST['cf_to_rubbing_wet_tolerance_range_math_operator'];
$cf_to_rubbing_wet_tolerance_value= $_POST['cf_to_rubbing_wet_tolerance_value'];
$cf_to_rubbing_wet_min_value= $_POST['cf_to_rubbing_wet_min_value'];
$cf_to_rubbing_wet_max_value= $_POST['cf_to_rubbing_wet_max_value'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];

$washing_cycle_for_warp_for_washing_before_iron= $_POST['washing_cycle_for_warp_for_washing_before_iron'];
$change_in_warp_for_washing_before_iron_min_value= $_POST['change_in_warp_for_washing_before_iron_min_value'];
$change_in_warp_for_washing_before_iron_max_value= $_POST['change_in_warp_for_washing_before_iron_max_value'];
$uom_of_change_in_warp_for_washing_before_iron= $_POST['uom_of_change_in_warp_for_washing_before_iron'];

$washing_cycle_for_weft_for_washing_before_iron= $_POST['washing_cycle_for_weft_for_washing_before_iron'];
$change_in_weft_for_washing_before_iron_min_value= $_POST['change_in_weft_for_washing_before_iron_min_value'];
$change_in_weft_for_washing_before_iron_max_value= $_POST['change_in_weft_for_washing_before_iron_max_value'];
$uom_of_change_in_weft_for_washing_before_iron= $_POST['uom_of_change_in_weft_for_washing_before_iron'];

$washing_cycle_for_warp_for_washing_after_iron= $_POST['washing_cycle_for_warp_for_washing_after_iron'];
$change_in_warp_for_washing_after_iron_min_value= $_POST['change_in_warp_for_washing_after_iron_min_value'];
$change_in_warp_for_washing_after_iron_max_value= $_POST['change_in_warp_for_washing_after_iron_max_value'];
$uom_of_change_in_warp_for_washing_after_iron= $_POST['uom_of_change_in_warp_for_washing_after_iron'];

$washing_cycle_for_weft_for_washing_after_iron= $_POST['washing_cycle_for_weft_for_washing_after_iron'];
$change_in_weft_for_washing_after_iron_min_value= $_POST['change_in_weft_for_washing_after_iron_min_value'];
$change_in_weft_for_washing_after_iron_max_value= $_POST['change_in_weft_for_washing_after_iron_max_value'];
$uom_of_change_in_weft_for_washing_after_iron= $_POST['uom_of_change_in_weft_for_washing_after_iron'];

$change_in_warp_for_dry_cleaning_min_value= $_POST['change_in_warp_for_dry_cleaning_min_value'];
$change_in_warp_for_dry_cleaning_max_value= $_POST['change_in_warp_for_dry_cleaning_max_value'];
$uom_of_change_in_warp_for_dry_cleaning= $_POST['uom_of_change_in_warp_for_dry_cleaning'];
$change_in_weft_for_dry_cleaning_min_value= $_POST['change_in_weft_for_dry_cleaning_min_value'];
$change_in_weft_for_dry_cleaning_max_value= $_POST['change_in_weft_for_dry_cleaning_max_value'];
$uom_of_change_in_weft_for_dry_cleaning= $_POST['uom_of_change_in_weft_for_dry_cleaning'];

$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$warp_yarn_count_tolerance_range_math_operator= $_POST['warp_yarn_count_tolerance_range_math_operator'];
$warp_yarn_count_tolerance_value= $_POST['warp_yarn_count_tolerance_value'];
$warp_yarn_count_min_value= $_POST['warp_yarn_count_min_value'];
$warp_yarn_count_max_value= $_POST['warp_yarn_count_max_value'];
$uom_of_warp_yarn_count_value= $_POST['uom_of_warp_yarn_count_value'];

$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$weft_yarn_count_tolerance_range_math_operator= $_POST['weft_yarn_count_tolerance_range_math_operator'];
$weft_yarn_count_tolerance_value= $_POST['weft_yarn_count_tolerance_value'];
$weft_yarn_count_min_value= $_POST['weft_yarn_count_min_value'];
$weft_yarn_count_max_value= $_POST['weft_yarn_count_max_value'];
$uom_of_weft_yarn_count_value= $_POST['uom_of_weft_yarn_count_value'];

$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= $_POST['mass_per_unit_per_area_tolerance_range_math_operator'];
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];

$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$no_of_threads_in_warp_tolerance_range_math_operator= $_POST['no_of_threads_in_warp_tolerance_range_math_operator'];
$no_of_threads_in_warp_tolerance_value= $_POST['no_of_threads_in_warp_tolerance_value'];
$no_of_threads_in_warp_min_value= $_POST['no_of_threads_in_warp_min_value'];
$no_of_threads_in_warp_max_value= $_POST['no_of_threads_in_warp_max_value'];
$uom_of_no_of_threads_in_warp_value= $_POST['uom_of_no_of_threads_in_warp_value'];

$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$no_of_threads_in_weft_tolerance_range_math_operator= $_POST['no_of_threads_in_weft_tolerance_range_math_operator'];
$no_of_threads_in_weft_tolerance_value= $_POST['no_of_threads_in_weft_tolerance_value'];
$no_of_threads_in_weft_min_value= $_POST['no_of_threads_in_weft_min_value'];
$no_of_threads_in_weft_max_value= $_POST['no_of_threads_in_weft_max_value'];
$uom_of_no_of_threads_in_weft_value= $_POST['uom_of_no_of_threads_in_weft_value'];

$rubs_for_surface_fuzzing_and_pilling= $_POST['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= $_POST['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
$surface_fuzzing_and_pilling_tolerance_value= $_POST['surface_fuzzing_and_pilling_tolerance_value'];
$surface_fuzzing_and_pilling_min_value= $_POST['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $_POST['surface_fuzzing_and_pilling_max_value'];
$uom_of_surface_fuzzing_and_pilling_value= $_POST['uom_of_surface_fuzzing_and_pilling_value'];

$tensile_properties_in_warp_value_tolerance_range_math_operator= $_POST['tensile_properties_in_warp_value_tolerance_range_math_operator'];
$tensile_properties_in_warp_value_tolerance_value= $_POST['tensile_properties_in_warp_value_tolerance_value'];
$tensile_properties_in_warp_value_min_value= $_POST['tensile_properties_in_warp_value_min_value'];
$tensile_properties_in_warp_value_max_value= $_POST['tensile_properties_in_warp_value_max_value'];
$uom_of_tensile_properties_in_warp_value= $_POST['uom_of_tensile_properties_in_warp_value'];

$tear_force_in_warp_value_tolerance_range_math_operator= $_POST['tear_force_in_warp_value_tolerance_range_math_operator'];
$tear_force_in_warp_value_tolerance_value= $_POST['tear_force_in_warp_value_tolerance_value'];
$tear_force_in_warp_value_min_value= $_POST['tear_force_in_warp_value_min_value'];
$tear_force_in_warp_value_max_value= $_POST['tear_force_in_warp_value_max_value'];
$uom_of_tear_force_in_warp_value= $_POST['uom_of_tear_force_in_warp_value'];

$tear_force_in_weft_value_tolerance_range_math_operator= $_POST['tear_force_in_weft_value_tolerance_range_math_operator'];
$tear_force_in_weft_value_tolerance_value= $_POST['tear_force_in_weft_value_tolerance_value'];
$tear_force_in_weft_value_min_value= $_POST['tear_force_in_weft_value_min_value'];
$tear_force_in_weft_value_max_value= $_POST['tear_force_in_weft_value_max_value'];
$uom_of_tear_force_in_weft_value= $_POST['uom_of_tear_force_in_weft_value'];

$seam_strength_in_warp_value_tolerance_range_math_operator= $_POST['seam_strength_in_warp_value_tolerance_range_math_operator'];
$seam_strength_in_warp_value_tolerance_value= $_POST['seam_strength_in_warp_value_tolerance_value'];
$seam_strength_in_warp_value_min_value= $_POST['seam_strength_in_warp_value_min_value'];
$seam_strength_in_warp_value_max_value= $_POST['seam_strength_in_warp_value_max_value'];
$uom_of_seam_strength_in_warp_value= $_POST['uom_of_seam_strength_in_warp_value'];

$seam_strength_in_weft_value_tolerance_range_math_operator= $_POST['seam_strength_in_weft_value_tolerance_range_math_operator'];
$seam_strength_in_weft_value_tolerance_value= $_POST['seam_strength_in_weft_value_tolerance_value'];
$seam_strength_in_weft_value_min_value= $_POST['seam_strength_in_weft_value_min_value'];
$seam_strength_in_weft_value_max_value= $_POST['seam_strength_in_weft_value_max_value'];
$uom_of_seam_strength_in_weft_value= $_POST['uom_of_seam_strength_in_weft_value'];

$abrasion_resistance_c_change_value_math_op= $_POST['abrasion_resistance_c_change_value_math_op'];
$abrasion_resistance_c_change_value_tolerance_value= $_POST['abrasion_resistance_c_change_value_tolerance_value'];
$abrasion_resistance_c_change_value_min_value= $_POST['abrasion_resistance_c_change_value_min_value'];
$abrasion_resistance_c_change_value_max_value= $_POST['abrasion_resistance_c_change_value_max_value'];
$uom_of_abrasion_resistance_c_change_value= $_POST['uom_of_abrasion_resistance_c_change_value'];

$abrasion_resistance_no_of_thread_break= $_POST['abrasion_resistance_no_of_thread_break'];
$abrasion_resistance_rubs= $_POST['abrasion_resistance_rubs'];
$abrasion_resistance_thread_break= $_POST['abrasion_resistance_thread_break'];

$revolution= $_POST['revolution'];
$print_durability= $_POST['print_durability'];

$rubs_for_mass_loss_in_abrasion_test= $_POST['rubs_for_mass_loss_in_abrasion_test'];
$mass_loss_in_abrasion_test_value_tolerance_range_math_operator= $_POST['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'];
$mass_loss_in_abrasion_test_value_tolerance_value= $_POST['mass_loss_in_abrasion_test_value_tolerance_value'];
$mass_loss_in_abrasion_test_value_min_value= $_POST['mass_loss_in_abrasion_test_value_min_value'];
$mass_loss_in_abrasion_test_value_max_value= $_POST['mass_loss_in_abrasion_test_value_max_value'];
$uom_of_mass_loss_in_abrasion_test_value= $_POST['uom_of_mass_loss_in_abrasion_test_value'];

$formaldehyde_content_tolerance_range_math_operator= $_POST['formaldehyde_content_tolerance_range_math_operator'];
$formaldehyde_content_tolerance_value= $_POST['formaldehyde_content_tolerance_value'];
$formaldehyde_content_min_value= $_POST['formaldehyde_content_min_value'];
$formaldehyde_content_max_value= $_POST['formaldehyde_content_max_value'];
$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];

$cf_to_dry_cleaning_color_change_tolerance_range_math_operator= $_POST['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'];
$cf_to_dry_cleaning_color_change_tolerance_value= $_POST['cf_to_dry_cleaning_color_change_tolerance_value'];
$cf_to_dry_cleaning_color_change_min_value= $_POST['cf_to_dry_cleaning_color_change_min_value'];
$cf_to_dry_cleaning_color_change_max_value= $_POST['cf_to_dry_cleaning_color_change_max_value'];
$uom_of_cf_to_dry_cleaning_color_change= $_POST['uom_of_cf_to_dry_cleaning_color_change'];

$cf_to_dry_cleaning_staining_tolerance_range_math_operator= $_POST['cf_to_dry_cleaning_staining_tolerance_range_math_operator'];
$cf_to_dry_cleaning_staining_tolerance_value= $_POST['cf_to_dry_cleaning_staining_tolerance_value'];
$cf_to_dry_cleaning_staining_min_value= $_POST['cf_to_dry_cleaning_staining_min_value'];
$cf_to_dry_cleaning_staining_max_value= $_POST['cf_to_dry_cleaning_staining_max_value'];
$uom_of_cf_to_dry_cleaning_staining= $_POST['uom_of_cf_to_dry_cleaning_staining'];

$cf_to_washing_color_change_tolerance_range_math_operator= $_POST['cf_to_washing_color_change_tolerance_range_math_operator'];
$cf_to_washing_color_change_tolerance_value= $_POST['cf_to_washing_color_change_tolerance_value'];
$cf_to_washing_color_change_min_value= $_POST['cf_to_washing_color_change_min_value'];
$cf_to_washing_color_change_max_value= $_POST['cf_to_washing_color_change_max_value'];
$uom_of_cf_to_washing_color_change= $_POST['uom_of_cf_to_washing_color_change'];

$cf_to_washing_staining_tolerance_range_math_operator= $_POST['cf_to_washing_staining_tolerance_range_math_operator'];
$cf_to_washing_staining_tolerance_value= $_POST['cf_to_washing_staining_tolerance_value'];
$cf_to_washing_staining_min_value= $_POST['cf_to_washing_staining_min_value'];
$cf_to_washing_staining_max_value= $_POST['cf_to_washing_staining_max_value'];
$uom_of_cf_to_washing_staining= $_POST['uom_of_cf_to_washing_staining'];

$cf_to_washing_cross_staining_tolerance_range_math_operator= $_POST['cf_to_washing_cross_staining_tolerance_range_math_operator'];
$cf_to_washing_cross_staining_tolerance_value= $_POST['cf_to_washing_cross_staining_tolerance_value'];
$cf_to_washing_cross_staining_min_value= $_POST['cf_to_washing_cross_staining_min_value'];
$cf_to_washing_cross_staining_max_value= $_POST['cf_to_washing_cross_staining_max_value'];
$uom_of_cf_to_washing_cross_staining= $_POST['uom_of_cf_to_washing_cross_staining'];

$cf_to_perspiration_acid_color_change_tolerance_range_math_op= $_POST['cf_to_perspiration_acid_color_change_tolerance_range_math_op'];
$cf_to_perspiration_acid_color_change_tolerance_value= $_POST['cf_to_perspiration_acid_color_change_tolerance_value'];
$cf_to_perspiration_acid_color_change_min_value= $_POST['cf_to_perspiration_acid_color_change_min_value'];
$cf_to_perspiration_acid_color_change_max_value= $_POST['cf_to_perspiration_acid_color_change_max_value'];
$uom_of_cf_to_perspiration_acid_color_change= $_POST['uom_of_cf_to_perspiration_acid_color_change'];

$cf_to_perspiration_acid_staining_tolerance_range_math_operator= $_POST['cf_to_perspiration_acid_staining_tolerance_range_math_operator'];
$cf_to_perspiration_acid_staining_value= $_POST['cf_to_perspiration_acid_staining_value'];
$cf_to_perspiration_acid_staining_min_value= $_POST['cf_to_perspiration_acid_staining_min_value'];
$cf_to_perspiration_acid_staining_max_value= $_POST['cf_to_perspiration_acid_staining_max_value'];
$uom_of_cf_to_perspiration_acid_staining= $_POST['uom_of_cf_to_perspiration_acid_staining'];


$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_acid_cross_staining_tolerance_value= $_POST['cf_to_perspiration_acid_cross_staining_tolerance_value'];
$cf_to_perspiration_acid_cross_staining_min_value= $_POST['cf_to_perspiration_acid_cross_staining_min_value'];
$cf_to_perspiration_acid_cross_staining_max_value= $_POST['cf_to_perspiration_acid_cross_staining_max_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $_POST['uom_of_cf_to_perspiration_acid_cross_staining'];

$cf_to_perspiration_alkali_color_change_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'];
$cf_to_perspiration_alkali_color_change_tolerance_value= $_POST['cf_to_perspiration_alkali_color_change_tolerance_value'];
$cf_to_perspiration_alkali_color_change_min_value= $_POST['cf_to_perspiration_alkali_color_change_min_value'];
$cf_to_perspiration_alkali_color_change_max_value= $_POST['cf_to_perspiration_alkali_color_change_max_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $_POST['uom_of_cf_to_perspiration_alkali_color_change'];


$cf_to_perspiration_alkali_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_staining_tolerance_value'];
$cf_to_perspiration_alkali_staining_min_value= $_POST['cf_to_perspiration_alkali_staining_min_value'];
$cf_to_perspiration_alkali_staining_max_value= $_POST['cf_to_perspiration_alkali_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_staining= $_POST['uom_of_cf_to_perspiration_alkali_staining'];

$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= $_POST['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'];
$cf_to_perspiration_alkali_cross_staining_tolerance_value= $_POST['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
$cf_to_perspiration_alkali_cross_staining_min_value= $_POST['cf_to_perspiration_alkali_cross_staining_min_value'];
$cf_to_perspiration_alkali_cross_staining_max_value= $_POST['cf_to_perspiration_alkali_cross_staining_max_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $_POST['uom_of_cf_to_perspiration_alkali_cross_staining'];

$cf_to_water_color_change_tolerance_range_math_operator= $_POST['cf_to_water_color_change_tolerance_range_math_operator'];
$cf_to_water_color_change_tolerance_value= $_POST['cf_to_water_color_change_tolerance_value'];
$cf_to_water_color_change_min_value= $_POST['cf_to_water_color_change_min_value'];
$cf_to_water_color_change_max_value= $_POST['cf_to_water_color_change_max_value'];
$uom_of_cf_to_water_color_change= $_POST['uom_of_cf_to_water_color_change'];

$cf_to_water_staining_tolerance_range_math_operator= $_POST['cf_to_water_staining_tolerance_range_math_operator'];
$cf_to_water_staining_tolerance_value= $_POST['cf_to_water_staining_tolerance_value'];
$cf_to_water_staining_min_value= $_POST['cf_to_water_staining_min_value'];
$cf_to_water_staining_max_value= $_POST['cf_to_water_staining_max_value'];
$uom_of_cf_to_water_staining= $_POST['uom_of_cf_to_water_staining'];

$cf_to_water_sotting_staining_tolerance_range_math_operator= $_POST['cf_to_water_sotting_staining_tolerance_range_math_operator'];
$cf_to_water_sotting_staining_tolerance_value= $_POST['cf_to_water_sotting_staining_tolerance_value'];
$cf_to_water_sotting_staining_min_value= $_POST['cf_to_water_sotting_staining_min_value'];
$cf_to_water_sotting_staining_max_value= $_POST['cf_to_water_sotting_staining_max_value'];
$uom_of_cf_to_water_sotting_staining= $_POST['uom_of_cf_to_water_sotting_staining'];

$cf_to_surface_wetting_staining_tolerance_range_math_operator= $_POST['cf_to_surface_wetting_staining_tolerance_range_math_operator'];
$cf_to_surface_wetting_staining_tolerance_value= $_POST['cf_to_surface_wetting_staining_tolerance_value'];
$cf_to_surface_wetting_staining_min_value= $_POST['cf_to_surface_wetting_staining_min_value'];
$cf_to_surface_wetting_staining_max_value= $_POST['cf_to_surface_wetting_staining_max_value'];
$uom_of_cf_to_surface_wetting_staining= $_POST['uom_of_cf_to_surface_wetting_staining'];

$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];

$cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op= $_POST['cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op'];
$cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_staining_min_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_staining_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_staining_max_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_staining_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_staining= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_staining'];

$cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op= $_POST['cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op'];
$cf_to_oidative_bleach_damage_color_change_tolerance_value= $_POST['cf_to_oidative_bleach_damage_color_change_tolerance_value'];
$cf_to_oidative_bleach_damage_color_change_min_value= $_POST['cf_to_oidative_bleach_damage_color_change_min_value'];
$cf_to_oidative_bleach_damage_color_change_max_value= $_POST['cf_to_oidative_bleach_damage_color_change_max_value'];
$uom_of_cf_to_oidative_bleach_damage_color_change= $_POST['uom_of_cf_to_oidative_bleach_damage_color_change'];

$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= $_POST['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'];
$cf_to_phenolic_yellowing_staining_tolerance_value= $_POST['cf_to_phenolic_yellowing_staining_tolerance_value'];
$cf_to_phenolic_yellowing_staining_min_value= $_POST['cf_to_phenolic_yellowing_staining_min_value'];
$cf_to_phenolic_yellowing_staining_max_value= $_POST['cf_to_phenolic_yellowing_staining_max_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $_POST['uom_of_cf_to_phenolic_yellowing_staining'];

$cf_to_saliva_color_change_tolerance_range_math_operator= $_POST['cf_to_saliva_color_change_tolerance_range_math_operator'];
$cf_to_pvc_migration_staining_tolerance_value= $_POST['cf_to_pvc_migration_staining_tolerance_value'];
$cf_to_pvc_migration_staining_min_value= $_POST['cf_to_pvc_migration_staining_min_value'];
$cf_to_pvc_migration_staining_max_value= $_POST['cf_to_pvc_migration_staining_max_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];

$cf_to_pvc_migration_staining_tolerance_range_math_operator= $_POST['cf_to_pvc_migration_staining_tolerance_range_math_operator'];
$cf_to_saliva_color_change_tolerance_value= $_POST['cf_to_saliva_color_change_tolerance_value'];
$cf_to_saliva_color_change_min_value= $_POST['cf_to_saliva_color_change_min_value'];
$cf_to_saliva_color_change_max_value= $_POST['cf_to_saliva_color_change_max_value'];
$uom_of_cf_to_saliva_color_change= $_POST['uom_of_cf_to_saliva_color_change'];

$cf_to_saliva_staining_tolerance_range_math_operator= $_POST['cf_to_saliva_staining_tolerance_range_math_operator'];
$cf_to_saliva_staining_tolerance_value= $_POST['cf_to_saliva_staining_tolerance_value'];
$cf_to_saliva_staining_staining_min_value= $_POST['cf_to_saliva_staining_staining_min_value'];
$cf_to_saliva_staining_max_value= $_POST['cf_to_saliva_staining_max_value'];
$uom_of_cf_to_saliva_staining= $_POST['uom_of_cf_to_saliva_staining'];

$cf_to_chlorinated_water_color_change_tolerance_range_math_op= $_POST['cf_to_chlorinated_water_color_change_tolerance_range_math_op'];
$cf_to_chlorinated_water_color_change_tolerance_value= $_POST['cf_to_chlorinated_water_color_change_tolerance_value'];
$cf_to_chlorinated_water_color_change_min_value= $_POST['cf_to_chlorinated_water_color_change_min_value'];
$cf_to_chlorinated_water_color_change_max_value= $_POST['cf_to_chlorinated_water_color_change_max_value'];
$uom_of_cf_to_chlorinated_water_color_change= $_POST['uom_of_cf_to_chlorinated_water_color_change'];

$cf_to_chlorinated_water_staining_tolerance_range_math_operator= $_POST['cf_to_chlorinated_water_staining_tolerance_range_math_operator'];
$cf_to_chlorinated_water_staining_tolerance_value= $_POST['cf_to_chlorinated_water_staining_tolerance_value'];
$cf_to_chlorinated_water_staining_min_value= $_POST['cf_to_chlorinated_water_staining_min_value'];
$cf_to_chlorinated_water_staining_max_value= $_POST['cf_to_chlorinated_water_staining_max_value'];
$uom_of_cf_to_chlorinated_water_staining= $_POST['uom_of_cf_to_chlorinated_water_staining'];

$cf_to_cholorine_bleach_color_change_tolerance_range_math_op= $_POST['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'];
$cf_to_cholorine_bleach_color_change_tolerance_value= $_POST['cf_to_cholorine_bleach_color_change_tolerance_value'];
$cf_to_cholorine_bleach_color_change_min_value= $_POST['cf_to_cholorine_bleach_color_change_min_value'];
$cf_to_cholorine_bleach_color_change_max_value= $_POST['cf_to_cholorine_bleach_color_change_max_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $_POST['uom_of_cf_to_cholorine_bleach_color_change'];

$cf_to_cholorine_bleach_staining_tolerance_range_math_operator= $_POST['cf_to_cholorine_bleach_staining_tolerance_range_math_operator'];
$cf_to_cholorine_bleach_staining_tolerance_value= $_POST['cf_to_cholorine_bleach_staining_tolerance_value'];
$cf_to_cholorine_bleach_staining_min_value= $_POST['cf_to_cholorine_bleach_staining_min_value'];
$cf_to_cholorine_bleach_staining_max_value= $_POST['cf_to_cholorine_bleach_staining_max_value'];
$uom_of_cf_to_cholorine_bleach_staining= $_POST['uom_of_cf_to_cholorine_bleach_staining'];

$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= $_POST['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'];
$cf_to_peroxide_bleach_color_change_tolerance_value= $_POST['cf_to_peroxide_bleach_color_change_tolerance_value'];
$cf_to_peroxide_bleach_color_change_min_value= $_POST['cf_to_peroxide_bleach_color_change_min_value'];
$cf_to_peroxide_bleach_color_change_max_value= $_POST['cf_to_peroxide_bleach_color_change_max_value'];
$uom_of_cf_to_peroxide_bleach_color_change= $_POST['uom_of_cf_to_peroxide_bleach_color_change'];

$cf_to_peroxide_bleach_staining_tolerance_range_math_operator= $_POST['cf_to_peroxide_bleach_staining_tolerance_range_math_operator'];
$cf_to_peroxide_bleach_staining_tolerance_value= $_POST['cf_to_peroxide_bleach_staining_tolerance_value'];
$cf_to_peroxide_bleach_staining_min_value= $_POST['cf_to_peroxide_bleach_staining_min_value'];
$cf_to_peroxide_bleach_staining_max_value= $_POST['cf_to_peroxide_bleach_staining_max_value'];
$uom_of_cf_to_peroxide_bleach_staining= $_POST['uom_of_cf_to_peroxide_bleach_staining'];

$cross_staining_tolerance_range_math_operator= $_POST['cross_staining_tolerance_range_math_operator'];
$cross_staining_tolerance_value= $_POST['cross_staining_tolerance_value'];
$cross_staining_min_value= $_POST['cross_staining_min_value'];
$cross_staining_max_value= $_POST['cross_staining_max_value'];
$uom_of_cross_staining= $_POST['uom_of_cross_staining'];

$water_absorption_value_tolerance_range_math_operator= $_POST['water_absorption_value_tolerance_range_math_operator'];
$water_absorption_value_tolerance_value= $_POST['water_absorption_value_tolerance_value'];
$water_absorption_value_min_value= $_POST['water_absorption_value_min_value'];
$water_absorption_value_max_value= $_POST['water_absorption_value_max_value'];
$uom_of_water_absorption_value= $_POST['uom_of_water_absorption_value'];

$spirality_value_tolerance_range_math_operator= $_POST['spirality_value_tolerance_range_math_operator'];
$spirality_value_tolerance_value= $_POST['spirality_value_tolerance_value'];
$spirality_value_min_value= $_POST['spirality_value_min_value'];
$spirality_value_max_value= $_POST['spirality_value_max_value'];
$uom_of_spirality_value= $_POST['uom_of_spirality_value'];

$durable_press_value_tolerance_range_math_operator= $_POST['durable_press_value_tolerance_range_math_operator'];
$durable_press_value_tolerance_value= $_POST['durable_press_value_tolerance_value'];
$durable_press_value_min_value= $_POST['durable_press_value_min_value'];
$durable_press_value_max_value= $_POST['durable_press_value_max_value'];
$uom_of_durable_press_value= $_POST['uom_of_durable_press_value'];

$ironability_of_woven_fabric_value_tolerance_range_math_operator= $_POST['ironability_of_woven_fabric_value_tolerance_range_math_operator'];
$ironability_of_woven_fabric_value_tolerance_value= $_POST['ironability_of_woven_fabric_value_tolerance_value'];
$ironability_of_woven_fabric_value_min_value= $_POST['ironability_of_woven_fabric_value_min_value'];
$ironability_of_woven_fabric_value_max_value= $_POST['ironability_of_woven_fabric_value_max_value'];
$uom_of_ironability_of_woven_fabric_value= $_POST['uom_of_ironability_of_woven_fabric_value'];

$cf_to_artificial_light_value_tolerance_range_math_operator= $_POST['cf_to_artificial_light_value_tolerance_range_math_operator'];
$cf_to_artificial_light_value_tolerance_value= $_POST['cf_to_artificial_light_value_tolerance_value'];
$cf_to_artificial_light_value_min_value= $_POST['cf_to_artificial_light_value_min_value'];
$cf_to_artificial_light_value_max_value= $_POST['cf_to_artificial_light_value_max_value'];
$uom_of_cf_to_artificial_light_value= $_POST['uom_of_cf_to_artificial_light_value'];

$moisture_content_in_percentage_min_value= $_POST['moisture_content_in_percentage_min_value'];
$moisture_content_in_percentage_max_value= $_POST['moisture_content_in_percentage_max_value'];
$uom_of_moisture_content_in_percentage= $_POST['uom_of_moisture_content_in_percentage'];
$evaporation_rate_in_percentage_min_value= $_POST['evaporation_rate_in_percentage_min_value'];
$evaporation_rate_in_percentage_max_value= $_POST['evaporation_rate_in_percentage_max_value'];
$uom_of_evaporation_rate_in_percentage= $_POST['uom_of_evaporation_rate_in_percentage'];

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

$percentage_of_weft_other_fiber_content_value= $_POST['percentage_of_weft_other_fiber_content_value'];
$percentage_of_weft_other_fiber_content_tolerance_range_math_op= $_POST['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
$percentage_of_weft_other_fiber_content_tolerance_value= $_POST['percentage_of_weft_other_fiber_content_tolerance_value'];
$percentage_of_weft_other_fiber_content_min_value= $_POST['percentage_of_weft_other_fiber_content_min_value'];
$percentage_of_weft_other_fiber_content_max_value= $_POST['percentage_of_weft_other_fiber_content_max_value'];
$uom_of_percentage_of_weft_other_fiber_content= $_POST['uom_of_percentage_of_weft_other_fiber_content'];

$seam_slippage_resistance_in_warp_tolerance_range_math_operator= $_POST['seam_slippage_resistance_in_warp_tolerance_range_math_operator'];
$seam_slippage_resistance_in_warp_tolerance_value= $_POST['seam_slippage_resistance_in_warp_tolerance_value'];
$seam_slippage_resistance_in_warp_min_value= $_POST['seam_slippage_resistance_in_warp_min_value'];
$seam_slippage_resistance_in_warp_max_value= $_POST['seam_slippage_resistance_in_warp_max_value'];
$uom_of_seam_slippage_resistance_in_warp= $_POST['uom_of_seam_slippage_resistance_in_warp'];

$seam_slippage_resistance_in_weft_tolerance_range_math_operator= $_POST['seam_slippage_resistance_in_weft_tolerance_range_math_operator'];
$seam_slippage_resistance_in_weft_tolerance_value= $_POST['seam_slippage_resistance_in_weft_tolerance_value'];
$seam_slippage_resistance_in_weft_min_value= $_POST['seam_slippage_resistance_in_weft_min_value'];
$seam_slippage_resistance_in_weft_max_value= $_POST['seam_slippage_resistance_in_weft_max_value'];
$uom_of_seam_slippage_resistance_in_weft= $_POST['uom_of_seam_slippage_resistance_in_weft'];

$ph_value_tolerance_range_math_operator= $_POST['ph_value_tolerance_range_math_operator'];
$ph_value_tolerance_value= $_POST['ph_value_tolerance_value'];
$ph_value_min_value= $_POST['ph_value_min_value'];
$ph_value_max_value= $_POST['ph_value_max_value'];
$uom_of_ph_value= $_POST['uom_of_ph_value'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_finishing_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `greige_width`=$greige_width and `standard_for_which_process`='$standard_for_which_process' and `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator' and `cf_to_rubbing_dry_tolerance_value`=$cf_to_rubbing_dry_tolerance_value and `cf_to_rubbing_dry_min_value`=$cf_to_rubbing_dry_min_value and `cf_to_rubbing_dry_max_value`=$cf_to_rubbing_dry_max_value and `uom_of_cf_to_rubbing_dry`='$uom_of_cf_to_rubbing_dry' and `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator' and `cf_to_rubbing_wet_tolerance_value`=$cf_to_rubbing_wet_tolerance_value and `cf_to_rubbing_wet_min_value`=$cf_to_rubbing_wet_min_value and `cf_to_rubbing_wet_max_value`=$cf_to_rubbing_wet_max_value and `uom_of_cf_to_rubbing_wet`='$uom_of_cf_to_rubbing_wet' and `change_in_warp_for_washing_before_iron_min_value`=$change_in_warp_for_washing_before_iron_min_value and `change_in_warp_for_washing_before_iron_max_value`=$change_in_warp_for_washing_before_iron_max_value and `uom_of_change_in_warp_for_washing_before_iron`='$uom_of_change_in_warp_for_washing_before_iron' and `change_in_weft_for_washing_before_iron_min_value`=$change_in_weft_for_washing_before_iron_min_value and `change_in_weft_for_washing_before_iron_max_value`=$change_in_weft_for_washing_before_iron_max_value and `uom_of_change_in_weft_for_washing_before_iron`='$uom_of_change_in_weft_for_washing_before_iron' and `change_in_warp_for_washing_after_iron_min_value`=$change_in_warp_for_washing_after_iron_min_value and `change_in_warp_for_washing_after_iron_max_value`=$change_in_warp_for_washing_after_iron_max_value and `uom_of_change_in_warp_for_washing_after_iron`='$uom_of_change_in_warp_for_washing_after_iron' and `change_in_weft_for_washing_after_iron_min_value`=$change_in_weft_for_washing_after_iron_min_value and `change_in_weft_for_washing_after_iron_max_value`=$change_in_weft_for_washing_after_iron_max_value and `uom_of_change_in_weft_for_washing_after_iron`='$uom_of_change_in_weft_for_washing_after_iron' and `change_in_warp_for_dry_cleaning_min_value`=$change_in_warp_for_dry_cleaning_min_value and `change_in_warp_for_dry_cleaning_max_value`=$change_in_warp_for_dry_cleaning_max_value and `uom_of_change_in_warp_for_dry_cleaning`='$uom_of_change_in_warp_for_dry_cleaning' and `change_in_weft_for_dry_cleaning_min_value`=$change_in_weft_for_dry_cleaning_min_value and `change_in_weft_for_dry_cleaning_max_value`=$change_in_weft_for_dry_cleaning_max_value and `uom_of_change_in_weft_for_dry_cleaning`='$uom_of_change_in_weft_for_dry_cleaning' and `warp_yarn_count_value`=$warp_yarn_count_value and `warp_yarn_count_tolerance_range_math_operator`='$warp_yarn_count_tolerance_range_math_operator' and `warp_yarn_count_tolerance_value`=$warp_yarn_count_tolerance_value and `warp_yarn_count_min_value`=$warp_yarn_count_min_value and `warp_yarn_count_max_value`=$warp_yarn_count_max_value and `uom_of_warp_yarn_count_value`='$uom_of_warp_yarn_count_value' and `mass_per_unit_per_area_value`=$mass_per_unit_per_area_value and `mass_per_unit_per_area_tolerance_range_math_operator`='$mass_per_unit_per_area_tolerance_range_math_operator' and `mass_per_unit_per_area_tolerance_value`=$mass_per_unit_per_area_tolerance_value and `mass_per_unit_per_area_min_value`=$mass_per_unit_per_area_min_value and `mass_per_unit_per_area_max_value`=$mass_per_unit_per_area_max_value and `uom_of_mass_per_unit_per_area_value`='$uom_of_mass_per_unit_per_area_value' and `no_of_threads_in_warp_value`=$no_of_threads_in_warp_value and `no_of_threads_in_warp_tolerance_range_math_operator`='$no_of_threads_in_warp_tolerance_range_math_operator' and `no_of_threads_in_warp_tolerance_value`=$no_of_threads_in_warp_tolerance_value and `no_of_threads_in_warp_min_value`=$no_of_threads_in_warp_min_value and `no_of_threads_in_warp_max_value`=$no_of_threads_in_warp_max_value and `uom_of_no_of_threads_in_warp_value`='$uom_of_no_of_threads_in_warp_value' and `no_of_threads_in_weft_value`=$no_of_threads_in_weft_value and `no_of_threads_in_weft_tolerance_range_math_operator`='$no_of_threads_in_weft_tolerance_range_math_operator' and `no_of_threads_in_weft_tolerance_value`=$no_of_threads_in_weft_tolerance_value and `no_of_threads_in_weft_min_value`=$no_of_threads_in_weft_min_value and `no_of_threads_in_weft_max_value`=$no_of_threads_in_weft_max_value and `uom_of_no_of_threads_in_weft_value`='$uom_of_no_of_threads_in_weft_value' and `surface_fuzzing_and_pilling_tolerance_range_math_operator`='$surface_fuzzing_and_pilling_tolerance_range_math_operator' and `surface_fuzzing_and_pilling_tolerance_value`=$surface_fuzzing_and_pilling_tolerance_value and `surface_fuzzing_and_pilling_min_value`=$surface_fuzzing_and_pilling_min_value and `surface_fuzzing_and_pilling_max_value`=$surface_fuzzing_and_pilling_max_value and `uom_of_surface_fuzzing_and_pilling_value`='$uom_of_surface_fuzzing_and_pilling_value' and `tensile_properties_in_warp_value_tolerance_range_math_operator`='$tensile_properties_in_warp_value_tolerance_range_math_operator' and `tensile_properties_in_warp_value_tolerance_value`=$tensile_properties_in_warp_value_tolerance_value and `tensile_properties_in_warp_value_min_value`=$tensile_properties_in_warp_value_min_value and `tensile_properties_in_warp_value_max_value`=$tensile_properties_in_warp_value_max_value and `uom_of_tensile_properties_in_warp_value`='$uom_of_tensile_properties_in_warp_value' and `tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator' and `tear_force_in_warp_value_tolerance_value`=$tear_force_in_warp_value_tolerance_value and `tear_force_in_warp_value_min_value`=$tear_force_in_warp_value_min_value and `tear_force_in_warp_value_max_value`=$tear_force_in_warp_value_max_value and `uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value' and `tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator' and `tear_force_in_weft_value_tolerance_value`=$tear_force_in_weft_value_tolerance_value and `tear_force_in_weft_value_min_value`=$tear_force_in_weft_value_min_value and `tear_force_in_weft_value_max_value`=$tear_force_in_weft_value_max_value and `uom_of_tear_force_in_weft_value`='$uom_of_tear_force_in_weft_value' and `seam_strength_in_warp_value_tolerance_range_math_operator`='$seam_strength_in_warp_value_tolerance_range_math_operator' and `seam_strength_in_warp_value_tolerance_value`=$seam_strength_in_warp_value_tolerance_value and `seam_strength_in_warp_value_min_value`=$seam_strength_in_warp_value_min_value and `seam_strength_in_warp_value_max_value`=$seam_strength_in_warp_value_max_value and `uom_of_seam_strength_in_warp_value`='$uom_of_seam_strength_in_warp_value' and `seam_strength_in_weft_value_tolerance_range_math_operator`='$seam_strength_in_weft_value_tolerance_range_math_operator' and `seam_strength_in_weft_value_tolerance_value`=$seam_strength_in_weft_value_tolerance_value and `seam_strength_in_weft_value_min_value`=$seam_strength_in_weft_value_min_value and `seam_strength_in_weft_value_max_value`=$seam_strength_in_weft_value_max_value and `uom_of_seam_strength_in_weft_value`='$uom_of_seam_strength_in_weft_value' and `abrasion_resistance_c_change_value_math_op`='$abrasion_resistance_c_change_value_math_op' and `abrasion_resistance_c_change_value_tolerance_value`=$abrasion_resistance_c_change_value_tolerance_value and `abrasion_resistance_c_change_value_min_value`=$abrasion_resistance_c_change_value_min_value and `abrasion_resistance_c_change_value_max_value`=$abrasion_resistance_c_change_value_max_value and `uom_of_abrasion_resistance_c_change_value`='$uom_of_abrasion_resistance_c_change_value' and `abrasion_resistance_thread_break`='$abrasion_resistance_thread_break' and `revolution`='$revolution' and `print_durability`='$print_durability' and `mass_loss_in_abrasion_test_value_tolerance_range_math_operator`='$mass_loss_in_abrasion_test_value_tolerance_range_math_operator' and `mass_loss_in_abrasion_test_value_tolerance_value`=$mass_loss_in_abrasion_test_value_tolerance_value and `mass_loss_in_abrasion_test_value_min_value`=$mass_loss_in_abrasion_test_value_min_value and `mass_loss_in_abrasion_test_value_max_value`=$mass_loss_in_abrasion_test_value_max_value and `uom_of_mass_loss_in_abrasion_test_value`='$uom_of_mass_loss_in_abrasion_test_value' and `formaldehyde_content_tolerance_range_math_operator`='$formaldehyde_content_tolerance_range_math_operator' and `formaldehyde_content_tolerance_value`=$formaldehyde_content_tolerance_value and `formaldehyde_content_min_value`=$formaldehyde_content_min_value and `formaldehyde_content_max_value`=$formaldehyde_content_max_value and `uom_of_formaldehyde_content`='$uom_of_formaldehyde_content' and `cf_to_dry_cleaning_color_change_tolerance_range_math_operator`='$cf_to_dry_cleaning_color_change_tolerance_range_math_operator' and `cf_to_dry_cleaning_color_change_tolerance_value`=$cf_to_dry_cleaning_color_change_tolerance_value and `cf_to_dry_cleaning_color_change_min_value`=$cf_to_dry_cleaning_color_change_min_value and `cf_to_dry_cleaning_color_change_max_value`=$cf_to_dry_cleaning_color_change_max_value and `uom_of_cf_to_dry_cleaning_color_change`='$uom_of_cf_to_dry_cleaning_color_change' and `cf_to_dry_cleaning_staining_tolerance_range_math_operator`='$cf_to_dry_cleaning_staining_tolerance_range_math_operator' and `cf_to_dry_cleaning_staining_tolerance_value`=$cf_to_dry_cleaning_staining_tolerance_value and `cf_to_dry_cleaning_staining_min_value`=$cf_to_dry_cleaning_staining_min_value and `cf_to_dry_cleaning_staining_max_value`=$cf_to_dry_cleaning_staining_max_value and `uom_of_cf_to_dry_cleaning_staining`='$uom_of_cf_to_dry_cleaning_staining' and `cf_to_washing_color_change_tolerance_range_math_operator`='$cf_to_washing_color_change_tolerance_range_math_operator' and `cf_to_washing_color_change_tolerance_value`=$cf_to_washing_color_change_tolerance_value and `cf_to_washing_color_change_min_value`=$cf_to_washing_color_change_min_value and `cf_to_washing_color_change_max_value`=$cf_to_washing_color_change_max_value and `uom_of_cf_to_washing_color_change`='$uom_of_cf_to_washing_color_change' and `cf_to_washing_staining_tolerance_range_math_operator`='$cf_to_washing_staining_tolerance_range_math_operator' and `cf_to_washing_staining_tolerance_value`=$cf_to_washing_staining_tolerance_value and `cf_to_washing_staining_min_value`=$cf_to_washing_staining_min_value and `cf_to_washing_staining_max_value`=$cf_to_washing_staining_max_value and `uom_of_cf_to_washing_staining`='$uom_of_cf_to_washing_staining' and `cf_to_perspiration_acid_color_change_tolerance_range_math_op`='$cf_to_perspiration_acid_color_change_tolerance_range_math_op' and `cf_to_perspiration_acid_color_change_tolerance_value`=$cf_to_perspiration_acid_color_change_tolerance_value and `cf_to_perspiration_acid_color_change_min_value`=$cf_to_perspiration_acid_color_change_min_value and `cf_to_perspiration_acid_color_change_max_value`=$cf_to_perspiration_acid_color_change_max_value and `uom_of_cf_to_perspiration_acid_color_change`='$uom_of_cf_to_perspiration_acid_color_change' and `cf_to_perspiration_acid_staining_tolerance_range_math_operator`='$cf_to_perspiration_acid_staining_tolerance_range_math_operator' and `cf_to_perspiration_acid_staining_value`=$cf_to_perspiration_acid_staining_value and `cf_to_perspiration_acid_staining_min_value`=$cf_to_perspiration_acid_staining_min_value and `cf_to_perspiration_acid_staining_max_value`=$cf_to_perspiration_acid_staining_max_value and `uom_of_cf_to_perspiration_acid_staining`='$uom_of_cf_to_perspiration_acid_staining' and `cf_to_perspiration_alkali_color_change_tolerance_range_math_op`='$cf_to_perspiration_alkali_color_change_tolerance_range_math_op' and `cf_to_perspiration_alkali_color_change_tolerance_value`=$cf_to_perspiration_alkali_color_change_tolerance_value and `cf_to_perspiration_alkali_color_change_min_value`=$cf_to_perspiration_alkali_color_change_min_value and `cf_to_perspiration_alkali_color_change_max_value`=$cf_to_perspiration_alkali_color_change_max_value and `uom_of_cf_to_perspiration_alkali_color_change`='$uom_of_cf_to_perspiration_alkali_color_change' and `cf_to_water_color_change_tolerance_range_math_operator`='$cf_to_water_color_change_tolerance_range_math_operator' and `cf_to_water_color_change_tolerance_value`=$cf_to_water_color_change_tolerance_value and `cf_to_water_color_change_min_value`=$cf_to_water_color_change_min_value and `cf_to_water_color_change_max_value`=$cf_to_water_color_change_max_value and `uom_of_cf_to_water_color_change`='$uom_of_cf_to_water_color_change' and `cf_to_water_staining_tolerance_range_math_operator`='$cf_to_water_staining_tolerance_range_math_operator' and `cf_to_water_staining_tolerance_value`=$cf_to_water_staining_tolerance_value and `cf_to_water_staining_min_value`=$cf_to_water_staining_min_value and `cf_to_water_staining_max_value`=$cf_to_water_staining_max_value and `uom_of_cf_to_water_staining`='$uom_of_cf_to_water_staining' and `cf_to_water_sotting_staining_tolerance_range_math_operator`='$cf_to_water_sotting_staining_tolerance_range_math_operator' and `cf_to_water_sotting_staining_tolerance_value`=$cf_to_water_sotting_staining_tolerance_value and `cf_to_water_sotting_staining_min_value`=$cf_to_water_sotting_staining_min_value and `cf_to_water_sotting_staining_max_value`=$cf_to_water_sotting_staining_max_value and `uom_of_cf_to_water_sotting_staining`='$uom_of_cf_to_water_sotting_staining' and `cf_to_surface_wetting_staining_tolerance_range_math_operator`='$cf_to_surface_wetting_staining_tolerance_range_math_operator' and `cf_to_surface_wetting_staining_tolerance_value`=$cf_to_surface_wetting_staining_tolerance_value and `cf_to_surface_wetting_staining_min_value`=$cf_to_surface_wetting_staining_min_value and `cf_to_surface_wetting_staining_max_value`=$cf_to_surface_wetting_staining_max_value and `uom_of_cf_to_surface_wetting_staining`='$uom_of_cf_to_surface_wetting_staining' and `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op`='$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op' and `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value`=$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value and `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value`=$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value and `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value`=$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value and `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`='$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change' and `cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op`='$cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op' and `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value`=$cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value and `cf_to_hydrolysis_of_reactive_dyes_staining_min_value`=$cf_to_hydrolysis_of_reactive_dyes_staining_min_value and `cf_to_hydrolysis_of_reactive_dyes_staining_max_value`=$cf_to_hydrolysis_of_reactive_dyes_staining_max_value and `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining`='$uom_of_cf_to_hydrolysis_of_reactive_dyes_staining' and `cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op`='$cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op' and `cf_to_oidative_bleach_damage_color_change_tolerance_value`=$cf_to_oidative_bleach_damage_color_change_tolerance_value and `cf_to_oidative_bleach_damage_color_change_min_value`=$cf_to_oidative_bleach_damage_color_change_min_value and `cf_to_oidative_bleach_damage_color_change_max_value`=$cf_to_oidative_bleach_damage_color_change_max_value and `uom_of_cf_to_oidative_bleach_damage_color_change`='$uom_of_cf_to_oidative_bleach_damage_color_change' and `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator`='$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator' and `cf_to_phenolic_yellowing_staining_tolerance_value`=$cf_to_phenolic_yellowing_staining_tolerance_value and `cf_to_phenolic_yellowing_staining_min_value`=$cf_to_phenolic_yellowing_staining_min_value and `cf_to_phenolic_yellowing_staining_max_value`=$cf_to_phenolic_yellowing_staining_max_value and `uom_of_cf_to_phenolic_yellowing_staining`='$uom_of_cf_to_phenolic_yellowing_staining' and `cf_to_saliva_color_change_tolerance_range_math_operator`='$cf_to_saliva_color_change_tolerance_range_math_operator' and `cf_to_pvc_migration_staining_tolerance_value`=$cf_to_pvc_migration_staining_tolerance_value and `cf_to_pvc_migration_staining_min_value`=$cf_to_pvc_migration_staining_min_value and `cf_to_pvc_migration_staining_max_value`=$cf_to_pvc_migration_staining_max_value and `uom_of_cf_to_pvc_migration_staining`='$uom_of_cf_to_pvc_migration_staining' and `cf_to_pvc_migration_staining_tolerance_range_math_operator`='$cf_to_pvc_migration_staining_tolerance_range_math_operator' and `cf_to_saliva_color_change_tolerance_value`=$cf_to_saliva_color_change_tolerance_value and `cf_to_saliva_color_change_min_value`=$cf_to_saliva_color_change_min_value and `cf_to_saliva_color_change_max_value`=$cf_to_saliva_color_change_max_value and `uom_of_cf_to_saliva_color_change`='$uom_of_cf_to_saliva_color_change' and `cf_to_saliva_staining_tolerance_range_math_operator`='$cf_to_saliva_staining_tolerance_range_math_operator' and `cf_to_saliva_staining_tolerance_value`=$cf_to_saliva_staining_tolerance_value and `cf_to_saliva_staining_staining_min_value`=$cf_to_saliva_staining_staining_min_value and `cf_to_saliva_staining_max_value`=$cf_to_saliva_staining_max_value and `uom_of_cf_to_saliva_staining`='$uom_of_cf_to_saliva_staining' and `cf_to_chlorinated_water_color_change_tolerance_range_math_op`='$cf_to_chlorinated_water_color_change_tolerance_range_math_op' and `cf_to_chlorinated_water_color_change_tolerance_value`=$cf_to_chlorinated_water_color_change_tolerance_value and `cf_to_chlorinated_water_color_change_min_value`=$cf_to_chlorinated_water_color_change_min_value and `cf_to_chlorinated_water_color_change_max_value`=$cf_to_chlorinated_water_color_change_max_value and `uom_of_cf_to_chlorinated_water_color_change`='$uom_of_cf_to_chlorinated_water_color_change' and `cf_to_chlorinated_water_staining_tolerance_range_math_operator`='$cf_to_chlorinated_water_staining_tolerance_range_math_operator' and `cf_to_chlorinated_water_staining_tolerance_value`=$cf_to_chlorinated_water_staining_tolerance_value and `cf_to_chlorinated_water_staining_min_value`=$cf_to_chlorinated_water_staining_min_value and `cf_to_chlorinated_water_staining_max_value`=$cf_to_chlorinated_water_staining_max_value and `uom_of_cf_to_chlorinated_water_staining`='$uom_of_cf_to_chlorinated_water_staining' and `cf_to_cholorine_bleach_color_change_tolerance_range_math_op`='$cf_to_cholorine_bleach_color_change_tolerance_range_math_op' and `cf_to_cholorine_bleach_color_change_tolerance_value`=$cf_to_cholorine_bleach_color_change_tolerance_value and `cf_to_cholorine_bleach_color_change_min_value`=$cf_to_cholorine_bleach_color_change_min_value and `cf_to_cholorine_bleach_color_change_max_value`=$cf_to_cholorine_bleach_color_change_max_value and `uom_of_cf_to_cholorine_bleach_color_change`='$uom_of_cf_to_cholorine_bleach_color_change' and `cf_to_cholorine_bleach_staining_tolerance_range_math_operator`='$cf_to_cholorine_bleach_staining_tolerance_range_math_operator' and `cf_to_cholorine_bleach_staining_tolerance_value`=$cf_to_cholorine_bleach_staining_tolerance_value and `cf_to_cholorine_bleach_staining_min_value`=$cf_to_cholorine_bleach_staining_min_value and `cf_to_cholorine_bleach_staining_max_value`=$cf_to_cholorine_bleach_staining_max_value and `uom_of_cf_to_cholorine_bleach_staining`='$uom_of_cf_to_cholorine_bleach_staining' and `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator`='$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator' and `cf_to_peroxide_bleach_color_change_tolerance_value`=$cf_to_peroxide_bleach_color_change_tolerance_value and `cf_to_peroxide_bleach_color_change_min_value`=$cf_to_peroxide_bleach_color_change_min_value and `cf_to_peroxide_bleach_color_change_max_value`=$cf_to_peroxide_bleach_color_change_max_value and `uom_of_cf_to_peroxide_bleach_color_change`='$uom_of_cf_to_peroxide_bleach_color_change' and `cf_to_peroxide_bleach_staining_tolerance_range_math_operator`='$cf_to_peroxide_bleach_staining_tolerance_range_math_operator' and `cf_to_peroxide_bleach_staining_tolerance_value`=$cf_to_peroxide_bleach_staining_tolerance_value and `cf_to_peroxide_bleach_staining_min_value`=$cf_to_peroxide_bleach_staining_min_value and `cf_to_peroxide_bleach_staining_max_value`=$cf_to_peroxide_bleach_staining_max_value and `uom_of_cf_to_peroxide_bleach_staining`='$uom_of_cf_to_peroxide_bleach_staining' and `cross_staining_tolerance_range_math_operator`='$cross_staining_tolerance_range_math_operator' and `cross_staining_tolerance_value`=$cross_staining_tolerance_value and `cross_staining_min_value`=$cross_staining_min_value and `cross_staining_max_value`=$cross_staining_max_value and `uom_of_cross_staining`='$uom_of_cross_staining' and `water_absorption_value_tolerance_range_math_operator`='$water_absorption_value_tolerance_range_math_operator' and `water_absorption_value_tolerance_value`=$water_absorption_value_tolerance_value and `water_absorption_value_min_value`=$water_absorption_value_min_value and `water_absorption_value_max_value`=$water_absorption_value_max_value and `uom_of_water_absorption_value`='$uom_of_water_absorption_value' and `spirality_value_tolerance_range_math_operator`='$spirality_value_tolerance_range_math_operator' and `spirality_value_tolerance_value`=$spirality_value_tolerance_value and `spirality_value_min_value`=$spirality_value_min_value and `spirality_value_max_value`=$spirality_value_max_value and `uom_of_spirality_value`='$uom_of_spirality_value' and `durable_press_value_tolerance_range_math_operator`='$durable_press_value_tolerance_range_math_operator' and `durable_press_value_tolerance_value`=$durable_press_value_tolerance_value and `durable_press_value_min_value`=$durable_press_value_min_value and `durable_press_value_max_value`=$durable_press_value_max_value and `uom_of_durable_press_value`='$uom_of_durable_press_value' and `ironability_of_woven_fabric_value_tolerance_range_math_operator`='$ironability_of_woven_fabric_value_tolerance_range_math_operator' and `ironability_of_woven_fabric_value_tolerance_value`=$ironability_of_woven_fabric_value_tolerance_value and `ironability_of_woven_fabric_value_min_value`=$ironability_of_woven_fabric_value_min_value and `ironability_of_woven_fabric_value_max_value`=$ironability_of_woven_fabric_value_max_value and `uom_of_ironability_of_woven_fabric_value`='$uom_of_ironability_of_woven_fabric_value' and `cf_to_artificial_light_value_tolerance_range_math_operator`='$cf_to_artificial_light_value_tolerance_range_math_operator' and `cf_to_artificial_light_value_tolerance_value`=$cf_to_artificial_light_value_tolerance_value and `cf_to_artificial_light_value_min_value`=$cf_to_artificial_light_value_min_value and `cf_to_artificial_light_value_max_value`=$cf_to_artificial_light_value_max_value and `uom_of_cf_to_artificial_light_value`='$uom_of_cf_to_artificial_light_value' and `moisture_content_in_percentage_min_value`=$moisture_content_in_percentage_min_value and `moisture_content_in_percentage_max_value`=$moisture_content_in_percentage_max_value and `uom_of_moisture_content_in_percentage`='$uom_of_moisture_content_in_percentage' and `evaporation_rate_in_percentage_min_value`=$evaporation_rate_in_percentage_min_value and `evaporation_rate_in_percentage_max_value`=$evaporation_rate_in_percentage_max_value and `uom_of_evaporation_rate_in_percentage`='$uom_of_evaporation_rate_in_percentage' and `percentage_of_total_cotton_content_tolerance_range_math_operator`='$percentage_of_total_cotton_content_tolerance_range_math_operator' and `percentage_of_total_cotton_content_tolerance_value`=$percentage_of_total_cotton_content_tolerance_value and `percentage_of_total_cotton_content_min_value`=$percentage_of_total_cotton_content_min_value and `percentage_of_total_cotton_content_max_value`=$percentage_of_total_cotton_content_max_value and `uom_of_percentage_of_total_cotton_content`='$uom_of_percentage_of_total_cotton_content' and `percentage_of_total_polyester_content_tolerance_range_math_op`='$percentage_of_total_polyester_content_tolerance_range_math_op' and `percentage_of_total_polyester_content_tolerance_value`=$percentage_of_total_polyester_content_tolerance_value and `percentage_of_total_polyester_content_min_value`=$percentage_of_total_polyester_content_min_value and `percentage_of_total_polyester_content_max_value`=$percentage_of_total_polyester_content_max_value and `uom_of_percentage_of_total_polyester_content`='$uom_of_percentage_of_total_polyester_content' and `percentage_of_total_other_fiber_content_tolerance_range_math_op`='$percentage_of_total_other_fiber_content_tolerance_range_math_op' and `percentage_of_total_other_fiber_content_tolerance_value`=$percentage_of_total_other_fiber_content_tolerance_value and `percentage_of_total_other_fiber_content_min_value`=$percentage_of_total_other_fiber_content_min_value and `percentage_of_total_other_fiber_content_max_value`=$percentage_of_total_other_fiber_content_max_value and `uom_of_percentage_of_total_other_fiber_content`='$uom_of_percentage_of_total_other_fiber_content' and `percentage_of_warp_cotton_content_tolerance_range_math_operator`='$percentage_of_warp_cotton_content_tolerance_range_math_operator' and `percentage_of_warp_cotton_content_tolerance_value`=$percentage_of_warp_cotton_content_tolerance_value and `percentage_of_warp_cotton_content_min_value`=$percentage_of_warp_cotton_content_min_value and `uom_of_percentage_of_warp_cotton_content`='$uom_of_percentage_of_warp_cotton_content' and `percentage_of_warp_polyester_content_tolerance_range_math_op`='$percentage_of_warp_polyester_content_tolerance_range_math_op' and `percentage_of_warp_polyester_content_tolerance_value`=$percentage_of_warp_polyester_content_tolerance_value and `percentage_of_warp_polyester_content_min_value`=$percentage_of_warp_polyester_content_min_value and `percentage_of_warp_polyester_content_max_value`=$percentage_of_warp_polyester_content_max_value and `uom_of_percentage_of_warp_polyester_content`='$uom_of_percentage_of_warp_polyester_content' and `percentage_of_warp_other_fiber_content_tolerance_range_math_op`='$percentage_of_warp_other_fiber_content_tolerance_range_math_op' and `percentage_of_warp_other_fiber_content_tolerance_value`=$percentage_of_warp_other_fiber_content_tolerance_value and `percentage_of_warp_other_fiber_content_min_value`=$percentage_of_warp_other_fiber_content_min_value and `percentage_of_warp_other_fiber_content_max_value`=$percentage_of_warp_other_fiber_content_max_value and `uom_of_percentage_of_warp_other_fiber_content`='$uom_of_percentage_of_warp_other_fiber_content' and `percentage_of_weft_polyester_content_tolerance_range_math_op`='$percentage_of_weft_polyester_content_tolerance_range_math_op' and `percentage_of_weft_polyester_content_tolerance_value`=$percentage_of_weft_polyester_content_tolerance_value and `percentage_of_weft_polyester_content_min_value`=$percentage_of_weft_polyester_content_min_value and `percentage_of_weft_polyester_content_max_value`=$percentage_of_weft_polyester_content_max_value and `uom_of_percentage_of_weft_polyester_content`='$uom_of_percentage_of_weft_polyester_content' and `percentage_of_weft_other_fiber_content_tolerance_range_math_op`='$percentage_of_weft_other_fiber_content_tolerance_range_math_op' and `percentage_of_weft_other_fiber_content_tolerance_value`=$percentage_of_weft_other_fiber_content_tolerance_value and `percentage_of_weft_other_fiber_content_min_value`=$percentage_of_weft_other_fiber_content_min_value and `percentage_of_weft_other_fiber_content_max_value`=$percentage_of_weft_other_fiber_content_max_value and `uom_of_percentage_of_weft_other_fiber_content`='$uom_of_percentage_of_weft_other_fiber_content' and `seam_slippage_resistance_in_warp_tolerance_range_math_operator`='$seam_slippage_resistance_in_warp_tolerance_range_math_operator' and `seam_slippage_resistance_in_warp_tolerance_value`=$seam_slippage_resistance_in_warp_tolerance_value and `seam_slippage_resistance_in_warp_min_value`=$seam_slippage_resistance_in_warp_min_value and `seam_slippage_resistance_in_warp_max_value`=$seam_slippage_resistance_in_warp_max_value and `uom_of_seam_slippage_resistance_in_warp`='$uom_of_seam_slippage_resistance_in_warp' and `seam_slippage_resistance_in_weft_tolerance_range_math_operator`='$seam_slippage_resistance_in_weft_tolerance_range_math_operator' and `seam_slippage_resistance_in_weft_tolerance_value`=$seam_slippage_resistance_in_weft_tolerance_value and `seam_slippage_resistance_in_weft_min_value`=$seam_slippage_resistance_in_weft_min_value and `seam_slippage_resistance_in_weft_max_value`=$seam_slippage_resistance_in_weft_max_value and `uom_of_seam_slippage_resistance_in_weft`='$uom_of_seam_slippage_resistance_in_weft' and `ph_value_tolerance_range_math_operator`='$ph_value_tolerance_range_math_operator' and `ph_value_tolerance_value`=$ph_value_tolerance_value and `ph_value_min_value`=$ph_value_min_value and `ph_value_max_value`=$ph_value_max_value and `uom_of_ph_value`='$uom_of_ph_value' and `recording_person_id`='$user_id' and `recording_person_name`='$user_name'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{


	$insert_sql_statement="insert into `defining_qc_standard_for_finishing_process` ( `pp_number`,`version_id`,`version_number`, `customer_name`, `color`, `greige_width`, `standard_for_which_process`, `cf_to_rubbing_dry_tolerance_range_math_operator`, `cf_to_rubbing_dry_tolerance_value`, `cf_to_rubbing_dry_min_value`, `cf_to_rubbing_dry_max_value`, `uom_of_cf_to_rubbing_dry`, `cf_to_rubbing_wet_tolerance_range_math_operator`, `washing_cycle_for_warp_for_washing_before_iron`,`cf_to_rubbing_wet_tolerance_value`, `cf_to_rubbing_wet_min_value`, `cf_to_rubbing_wet_max_value`, `uom_of_cf_to_rubbing_wet`, `change_in_warp_for_washing_before_iron_min_value`, `change_in_warp_for_washing_before_iron_max_value`, `uom_of_change_in_warp_for_washing_before_iron`,`washing_cycle_for_weft_for_washing_before_iron` ,`change_in_weft_for_washing_before_iron_min_value`, `change_in_weft_for_washing_before_iron_max_value`, `uom_of_change_in_weft_for_washing_before_iron`, `washing_cycle_for_warp_for_washing_after_iron`,`change_in_warp_for_washing_after_iron_min_value`, `change_in_warp_for_washing_after_iron_max_value`, `uom_of_change_in_warp_for_washing_after_iron`,`washing_cycle_for_weft_for_washing_after_iron` ,`change_in_weft_for_washing_after_iron_min_value`, `change_in_weft_for_washing_after_iron_max_value`, `uom_of_change_in_weft_for_washing_after_iron`, `change_in_warp_for_dry_cleaning_min_value`, `change_in_warp_for_dry_cleaning_max_value`, `uom_of_change_in_warp_for_dry_cleaning`, `change_in_weft_for_dry_cleaning_min_value`, `change_in_weft_for_dry_cleaning_max_value`, `uom_of_change_in_weft_for_dry_cleaning`, `warp_yarn_count_value`, `warp_yarn_count_tolerance_range_math_operator`, `warp_yarn_count_tolerance_value`, `warp_yarn_count_min_value`, `warp_yarn_count_max_value`, `uom_of_warp_yarn_count_value`, `weft_yarn_count_value`, `weft_yarn_count_tolerance_range_math_operator`, `weft_yarn_count_tolerance_value`, `weft_yarn_count_min_value`, `weft_yarn_count_max_value`, `uom_of_weft_yarn_count_value`, `mass_per_unit_per_area_value`, `mass_per_unit_per_area_tolerance_range_math_operator`, `mass_per_unit_per_area_tolerance_value`, `mass_per_unit_per_area_min_value`, `mass_per_unit_per_area_max_value`, `uom_of_mass_per_unit_per_area_value`, `no_of_threads_in_warp_value`, `no_of_threads_in_warp_tolerance_range_math_operator`, `no_of_threads_in_warp_tolerance_value`, `no_of_threads_in_warp_min_value`, `no_of_threads_in_warp_max_value`, `uom_of_no_of_threads_in_warp_value`, `no_of_threads_in_weft_value`, `no_of_threads_in_weft_tolerance_range_math_operator`, `no_of_threads_in_weft_tolerance_value`, `no_of_threads_in_weft_min_value`, `no_of_threads_in_weft_max_value`, `uom_of_no_of_threads_in_weft_value`,`rubs_for_surface_fuzzing_and_pilling` ,`surface_fuzzing_and_pilling_tolerance_range_math_operator`, `surface_fuzzing_and_pilling_tolerance_value`, `surface_fuzzing_and_pilling_min_value`, `surface_fuzzing_and_pilling_max_value`, `uom_of_surface_fuzzing_and_pilling_value`, `tensile_properties_in_warp_value_tolerance_range_math_operator`, `tensile_properties_in_warp_value_tolerance_value`, `tensile_properties_in_warp_value_min_value`, `tensile_properties_in_warp_value_max_value`, `uom_of_tensile_properties_in_warp_value`, `tear_force_in_warp_value_tolerance_range_math_operator`, `tear_force_in_warp_value_tolerance_value`, `tear_force_in_warp_value_min_value`, `tear_force_in_warp_value_max_value`, `uom_of_tear_force_in_warp_value`, `tear_force_in_weft_value_tolerance_range_math_operator`, `tear_force_in_weft_value_tolerance_value`, `tear_force_in_weft_value_min_value`, `tear_force_in_weft_value_max_value`, `uom_of_tear_force_in_weft_value`, `seam_strength_in_warp_value_tolerance_range_math_operator`, `seam_strength_in_warp_value_tolerance_value`, `seam_strength_in_warp_value_min_value`, `seam_strength_in_warp_value_max_value`, `uom_of_seam_strength_in_warp_value`, `seam_strength_in_weft_value_tolerance_range_math_operator`, `seam_strength_in_weft_value_tolerance_value`, `seam_strength_in_weft_value_min_value`, `seam_strength_in_weft_value_max_value`, `uom_of_seam_strength_in_weft_value`, `abrasion_resistance_c_change_value_math_op`, `abrasion_resistance_c_change_value_tolerance_value`, `abrasion_resistance_c_change_value_min_value`, `abrasion_resistance_c_change_value_max_value`, `uom_of_abrasion_resistance_c_change_value`, `rubs_for_mass_loss_in_abrasion_test`,`abrasion_resistance_no_of_thread_break`,`abrasion_resistance_rubs`,`abrasion_resistance_thread_break`, `revolution`, `print_durability`, `mass_loss_in_abrasion_test_value_tolerance_range_math_operator`, `mass_loss_in_abrasion_test_value_tolerance_value`, `mass_loss_in_abrasion_test_value_min_value`, `mass_loss_in_abrasion_test_value_max_value`, `uom_of_mass_loss_in_abrasion_test_value`, `formaldehyde_content_tolerance_range_math_operator`, `formaldehyde_content_tolerance_value`, `formaldehyde_content_min_value`, `formaldehyde_content_max_value`, `uom_of_formaldehyde_content`, `cf_to_dry_cleaning_color_change_tolerance_range_math_operator`, `cf_to_dry_cleaning_color_change_tolerance_value`, `cf_to_dry_cleaning_color_change_min_value`, `cf_to_dry_cleaning_color_change_max_value`, `uom_of_cf_to_dry_cleaning_color_change`, `cf_to_dry_cleaning_staining_tolerance_range_math_operator`, `cf_to_dry_cleaning_staining_tolerance_value`, `cf_to_dry_cleaning_staining_min_value`, `cf_to_dry_cleaning_staining_max_value`, `uom_of_cf_to_dry_cleaning_staining`, `cf_to_washing_color_change_tolerance_range_math_operator`, `cf_to_washing_color_change_tolerance_value`, `cf_to_washing_color_change_min_value`, `cf_to_washing_color_change_max_value`, `uom_of_cf_to_washing_color_change`, `cf_to_washing_staining_tolerance_range_math_operator`, `cf_to_washing_staining_tolerance_value`, `cf_to_washing_staining_min_value`, `cf_to_washing_staining_max_value`, `uom_of_cf_to_washing_staining`,`cf_to_washing_color_change_tolerance_value`, `cf_to_washing_color_change_min_value`, `cf_to_washing_color_change_max_value`, `uom_of_cf_to_washing_color_change`, `cf_to_washing_cross_staining_tolerance_range_math_operator`, `cf_to_washing_cross_staining_tolerance_value`, `cf_to_washing_cross_staining_min_value`, `cf_to_washing_cross_staining_max_value`, `uom_of_cf_to_washing_cross_staining`, `cf_to_perspiration_acid_color_change_tolerance_range_math_op`, `cf_to_perspiration_acid_color_change_tolerance_value`, `cf_to_perspiration_acid_color_change_min_value`, `cf_to_perspiration_acid_color_change_max_value`, `uom_of_cf_to_perspiration_acid_color_change`, `cf_to_perspiration_acid_staining_tolerance_range_math_operator`, `cf_to_perspiration_acid_staining_value`, `cf_to_perspiration_acid_staining_min_value`, `cf_to_perspiration_acid_staining_max_value`, `uom_of_cf_to_perspiration_acid_staining`,`cf_to_perspiration_acid_cross_staining_tolerance_range_math_op`, `cf_to_perspiration_acid_cross_staining_tolerance_value`, `cf_to_perspiration_acid_cross_staining_min_value`, `cf_to_perspiration_acid_cross_staining_max_value`, `uom_of_cf_to_perspiration_acid_cross_staining`, `cf_to_perspiration_alkali_color_change_tolerance_range_math_op`, `cf_to_perspiration_alkali_color_change_tolerance_value`, `cf_to_perspiration_alkali_color_change_min_value`, `cf_to_perspiration_alkali_color_change_max_value`, `uom_of_cf_to_perspiration_alkali_color_change`, `cf_to_perspiration_alkali_staining_tolerance_range_math_op`, `cf_to_perspiration_alkali_staining_tolerance_value`, `cf_to_perspiration_alkali_staining_min_value`, `cf_to_perspiration_alkali_staining_max_value`, `uom_of_cf_to_perspiration_alkali_staining`,`cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op`, `cf_to_perspiration_alkali_cross_staining_tolerance_value`, `cf_to_perspiration_alkali_cross_staining_min_value`, `cf_to_perspiration_alkali_cross_staining_max_value`, `uom_of_cf_to_perspiration_alkali_cross_staining`,`cf_to_water_color_change_tolerance_range_math_operator`, `cf_to_water_color_change_tolerance_value`, `cf_to_water_color_change_min_value`, `cf_to_water_color_change_max_value`, `uom_of_cf_to_water_color_change`, `cf_to_water_staining_tolerance_range_math_operator`, `cf_to_water_staining_tolerance_value`, `cf_to_water_staining_min_value`, `cf_to_water_staining_max_value`, `uom_of_cf_to_water_staining`, `cf_to_water_sotting_staining_tolerance_range_math_operator`, `cf_to_water_sotting_staining_tolerance_value`, `cf_to_water_sotting_staining_min_value`, `cf_to_water_sotting_staining_max_value`, `uom_of_cf_to_water_sotting_staining`, `cf_to_surface_wetting_staining_tolerance_range_math_operator`, `cf_to_surface_wetting_staining_tolerance_value`, `cf_to_surface_wetting_staining_min_value`, `cf_to_surface_wetting_staining_max_value`, `uom_of_cf_to_surface_wetting_staining`, `cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op`, `cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value`, `cf_to_hydrolysis_of_reactive_dyes_color_change_min_value`, `cf_to_hydrolysis_of_reactive_dyes_color_change_max_value`, `uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`, `cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op`, `cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value`, `cf_to_hydrolysis_of_reactive_dyes_staining_min_value`, `cf_to_hydrolysis_of_reactive_dyes_staining_max_value`, `uom_of_cf_to_hydrolysis_of_reactive_dyes_staining`, `cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op`, `cf_to_oidative_bleach_damage_color_change_tolerance_value`, `cf_to_oidative_bleach_damage_color_change_min_value`, `cf_to_oidative_bleach_damage_color_change_max_value`, `uom_of_cf_to_oidative_bleach_damage_color_change`, `cf_to_phenolic_yellowing_staining_tolerance_range_math_operator`, `cf_to_phenolic_yellowing_staining_tolerance_value`, `cf_to_phenolic_yellowing_staining_min_value`, `cf_to_phenolic_yellowing_staining_max_value`, `uom_of_cf_to_phenolic_yellowing_staining`, `cf_to_saliva_color_change_tolerance_range_math_operator`, `cf_to_pvc_migration_staining_tolerance_value`, `cf_to_pvc_migration_staining_min_value`, `cf_to_pvc_migration_staining_max_value`, `uom_of_cf_to_pvc_migration_staining`, `cf_to_pvc_migration_staining_tolerance_range_math_operator`, `cf_to_saliva_color_change_tolerance_value`, `cf_to_saliva_color_change_min_value`, `cf_to_saliva_color_change_max_value`, `uom_of_cf_to_saliva_color_change`, `cf_to_saliva_staining_tolerance_range_math_operator`, `cf_to_saliva_staining_tolerance_value`, `cf_to_saliva_staining_staining_min_value`, `cf_to_saliva_staining_max_value`, `uom_of_cf_to_saliva_staining`, `cf_to_chlorinated_water_color_change_tolerance_range_math_op`, `cf_to_chlorinated_water_color_change_tolerance_value`, `cf_to_chlorinated_water_color_change_min_value`, `cf_to_chlorinated_water_color_change_max_value`, `uom_of_cf_to_chlorinated_water_color_change`, `cf_to_chlorinated_water_staining_tolerance_range_math_operator`, `cf_to_chlorinated_water_staining_tolerance_value`, `cf_to_chlorinated_water_staining_min_value`, `cf_to_chlorinated_water_staining_max_value`, `uom_of_cf_to_chlorinated_water_staining`, `cf_to_cholorine_bleach_color_change_tolerance_range_math_op`, `cf_to_cholorine_bleach_color_change_tolerance_value`, `cf_to_cholorine_bleach_color_change_min_value`, `cf_to_cholorine_bleach_color_change_max_value`, `uom_of_cf_to_cholorine_bleach_color_change`, `cf_to_cholorine_bleach_staining_tolerance_range_math_operator`, `cf_to_cholorine_bleach_staining_tolerance_value`, `cf_to_cholorine_bleach_staining_min_value`, `cf_to_cholorine_bleach_staining_max_value`, `uom_of_cf_to_cholorine_bleach_staining`, `cf_to_peroxide_bleach_color_change_tolerance_range_math_operator`, `cf_to_peroxide_bleach_color_change_tolerance_value`, `cf_to_peroxide_bleach_color_change_min_value`, `cf_to_peroxide_bleach_color_change_max_value`, `uom_of_cf_to_peroxide_bleach_color_change`, `cf_to_peroxide_bleach_staining_tolerance_range_math_operator`, `cf_to_peroxide_bleach_staining_tolerance_value`, `cf_to_peroxide_bleach_staining_min_value`, `cf_to_peroxide_bleach_staining_max_value`, `uom_of_cf_to_peroxide_bleach_staining`, `cross_staining_tolerance_range_math_operator`, `cross_staining_tolerance_value`, `cross_staining_min_value`, `cross_staining_max_value`, `uom_of_cross_staining`, `water_absorption_value_tolerance_range_math_operator`, `water_absorption_value_tolerance_value`, `water_absorption_value_min_value`, `water_absorption_value_max_value`, `uom_of_water_absorption_value`, `spirality_value_tolerance_range_math_operator`, `spirality_value_tolerance_value`, `spirality_value_min_value`, `spirality_value_max_value`, `uom_of_spirality_value`, `durable_press_value_tolerance_range_math_operator`, `durable_press_value_tolerance_value`, `durable_press_value_min_value`, `durable_press_value_max_value`, `uom_of_durable_press_value`, `ironability_of_woven_fabric_value_tolerance_range_math_operator`, `ironability_of_woven_fabric_value_tolerance_value`, `ironability_of_woven_fabric_value_min_value`, `ironability_of_woven_fabric_value_max_value`, `uom_of_ironability_of_woven_fabric_value`, `cf_to_artificial_light_value_tolerance_range_math_operator`, `cf_to_artificial_light_value_tolerance_value`, `cf_to_artificial_light_value_min_value`, `cf_to_artificial_light_value_max_value`, `uom_of_cf_to_artificial_light_value`, `moisture_content_in_percentage_min_value`, `moisture_content_in_percentage_max_value`, `uom_of_moisture_content_in_percentage`, `evaporation_rate_in_percentage_min_value`, `evaporation_rate_in_percentage_max_value`, `uom_of_evaporation_rate_in_percentage`, `percentage_of_total_cotton_content_value`, `percentage_of_total_cotton_content_tolerance_range_math_operator`, `percentage_of_total_cotton_content_tolerance_value`, `percentage_of_total_cotton_content_min_value`, `percentage_of_total_cotton_content_max_value`, `uom_of_percentage_of_total_cotton_content`, `percentage_of_total_polyester_content_value`, `percentage_of_total_polyester_content_tolerance_range_math_op`, `percentage_of_total_polyester_content_tolerance_value`, `percentage_of_total_polyester_content_min_value`, `percentage_of_total_polyester_content_max_value`, `uom_of_percentage_of_total_polyester_content`, `percentage_of_total_other_fiber_content_value`, `percentage_of_total_other_fiber_content_tolerance_range_math_op`, `percentage_of_total_other_fiber_content_tolerance_value`, `percentage_of_total_other_fiber_content_min_value`, `percentage_of_total_other_fiber_content_max_value`, `uom_of_percentage_of_total_other_fiber_content`, `percentage_of_warp_cotton_content_value`, `percentage_of_warp_cotton_content_tolerance_range_math_operator`, `percentage_of_warp_cotton_content_tolerance_value`, `percentage_of_warp_cotton_content_min_value`, `uom_of_percentage_of_warp_cotton_content`, `percentage_of_warp_polyester_content_value`, `percentage_of_warp_polyester_content_tolerance_range_math_op`, `percentage_of_warp_polyester_content_tolerance_value`, `percentage_of_warp_polyester_content_min_value`, `percentage_of_warp_polyester_content_max_value`, `uom_of_percentage_of_warp_polyester_content`, `percentage_of_warp_other_fiber_content_value`, `percentage_of_warp_other_fiber_content_tolerance_range_math_op`, `percentage_of_warp_other_fiber_content_tolerance_value`, `percentage_of_warp_other_fiber_content_min_value`, `percentage_of_warp_other_fiber_content_max_value`, `uom_of_percentage_of_warp_other_fiber_content`, `percentage_of_weft_cotton_content_value`, `percentage_of_weft_cotton_content_tolerance_range_math_op`, `percentage_of_weft_cotton_content_tolerance_value`, `percentage_of_weft_cotton_content_min_value`, `percentage_of_weft_cotton_content_max_value`, `uom_of_percentage_of_weft_cotton_content`, `percentage_of_weft_polyester_content_value`, `percentage_of_weft_polyester_content_tolerance_range_math_op`, `percentage_of_weft_polyester_content_tolerance_value`, `percentage_of_weft_polyester_content_min_value`, `percentage_of_weft_polyester_content_max_value`, `uom_of_percentage_of_weft_polyester_content`, `percentage_of_weft_other_fiber_content_value`, `percentage_of_weft_other_fiber_content_tolerance_range_math_op`, `percentage_of_weft_other_fiber_content_tolerance_value`, `percentage_of_weft_other_fiber_content_min_value`, `percentage_of_weft_other_fiber_content_max_value`, `uom_of_percentage_of_weft_other_fiber_content`, `seam_slippage_resistance_in_warp_tolerance_range_math_operator`, `seam_slippage_resistance_in_warp_tolerance_value`, `seam_slippage_resistance_in_warp_min_value`, `seam_slippage_resistance_in_warp_max_value`, `uom_of_seam_slippage_resistance_in_warp`, `seam_slippage_resistance_in_weft_tolerance_range_math_operator`, `seam_slippage_resistance_in_weft_tolerance_value`, `seam_slippage_resistance_in_weft_min_value`, `seam_slippage_resistance_in_weft_max_value`, `uom_of_seam_slippage_resistance_in_weft`, `ph_value_tolerance_range_math_operator`, `ph_value_tolerance_value`, `ph_value_min_value`, `ph_value_max_value`, `uom_of_ph_value`, `recording_person_id`, `recording_person_name`, `recording_time` ) values ('$pp_number','$version_id','$version_number','$customer_name','$color',$greige_width,'$standard_for_which_process','$cf_to_rubbing_dry_tolerance_range_math_operator',$cf_to_rubbing_dry_tolerance_value,$cf_to_rubbing_dry_min_value,$cf_to_rubbing_dry_max_value,'$uom_of_cf_to_rubbing_dry','$cf_to_rubbing_wet_tolerance_range_math_operator',$cf_to_rubbing_wet_tolerance_value,$cf_to_rubbing_wet_min_value,$cf_to_rubbing_wet_max_value,'$uom_of_cf_to_rubbing_wet','$washing_cycle_for_warp_for_washing_before_iron',$change_in_warp_for_washing_before_iron_min_value,$change_in_warp_for_washing_before_iron_max_value,'$uom_of_change_in_warp_for_washing_before_iron','$washing_cycle_for_weft_for_washing_before_iron',$change_in_weft_for_washing_before_iron_min_value,$change_in_weft_for_washing_before_iron_max_value,'$uom_of_change_in_weft_for_washing_before_iron','$washing_cycle_for_warp_for_washing_after_iron',$change_in_warp_for_washing_after_iron_min_value,$change_in_warp_for_washing_after_iron_max_value,'$uom_of_change_in_warp_for_washing_after_iron','$washing_cycle_for_weft_for_washing_after_iron',$change_in_weft_for_washing_after_iron_min_value,$change_in_weft_for_washing_after_iron_max_value,'$uom_of_change_in_weft_for_washing_after_iron',$change_in_warp_for_dry_cleaning_min_value,$change_in_warp_for_dry_cleaning_max_value,'$uom_of_change_in_warp_for_dry_cleaning',$change_in_weft_for_dry_cleaning_min_value,$change_in_weft_for_dry_cleaning_max_value,'$uom_of_change_in_weft_for_dry_cleaning',$warp_yarn_count_value,'$warp_yarn_count_tolerance_range_math_operator',$warp_yarn_count_tolerance_value,$warp_yarn_count_min_value,$warp_yarn_count_max_value,'$uom_of_warp_yarn_count_value',$weft_yarn_count_value,'$weft_yarn_count_tolerance_range_math_operator',$weft_yarn_count_tolerance_value,$weft_yarn_count_min_value,$weft_yarn_count_max_value,'$uom_of_weft_yarn_count_value',$mass_per_unit_per_area_value,'$mass_per_unit_per_area_tolerance_range_math_operator',$mass_per_unit_per_area_tolerance_value,$mass_per_unit_per_area_min_value,$mass_per_unit_per_area_max_value,'$uom_of_mass_per_unit_per_area_value',$no_of_threads_in_warp_value,'$no_of_threads_in_warp_tolerance_range_math_operator',$no_of_threads_in_warp_tolerance_value,$no_of_threads_in_warp_min_value,$no_of_threads_in_warp_max_value,'$uom_of_no_of_threads_in_warp_value',$no_of_threads_in_weft_value,'$no_of_threads_in_weft_tolerance_range_math_operator',$no_of_threads_in_weft_tolerance_value,$no_of_threads_in_weft_min_value,$no_of_threads_in_weft_max_value,'$uom_of_no_of_threads_in_weft_value','$rubs_for_surface_fuzzing_and_pilling','$surface_fuzzing_and_pilling_tolerance_range_math_operator',$surface_fuzzing_and_pilling_tolerance_value,$surface_fuzzing_and_pilling_min_value,$surface_fuzzing_and_pilling_max_value,'$uom_of_surface_fuzzing_and_pilling_value','$tensile_properties_in_warp_value_tolerance_range_math_operator',$tensile_properties_in_warp_value_tolerance_value,$tensile_properties_in_warp_value_min_value,$tensile_properties_in_warp_value_max_value,'$uom_of_tensile_properties_in_warp_value','$tear_force_in_warp_value_tolerance_range_math_operator',$tear_force_in_warp_value_tolerance_value,$tear_force_in_warp_value_min_value,$tear_force_in_warp_value_max_value,'$uom_of_tear_force_in_warp_value','$tear_force_in_weft_value_tolerance_range_math_operator',$tear_force_in_weft_value_tolerance_value,$tear_force_in_weft_value_min_value,$tear_force_in_weft_value_max_value,'$uom_of_tear_force_in_weft_value','$seam_strength_in_warp_value_tolerance_range_math_operator',$seam_strength_in_warp_value_tolerance_value,$seam_strength_in_warp_value_min_value,$seam_strength_in_warp_value_max_value,'$uom_of_seam_strength_in_warp_value','$seam_strength_in_weft_value_tolerance_range_math_operator',$seam_strength_in_weft_value_tolerance_value,$seam_strength_in_weft_value_min_value,$seam_strength_in_weft_value_max_value,'$uom_of_seam_strength_in_weft_value','$abrasion_resistance_c_change_value_math_op',$abrasion_resistance_c_change_value_tolerance_value,$abrasion_resistance_c_change_value_min_value,$abrasion_resistance_c_change_value_max_value,'$uom_of_abrasion_resistance_c_change_value','$abrasion_resistance_no_of_thread_break','$abrasion_resistance_rubs','$abrasion_resistance_thread_break','$revolution','$print_durability','$rubs_for_mass_loss_in_abrasion_test','$mass_loss_in_abrasion_test_value_tolerance_range_math_operator',$mass_loss_in_abrasion_test_value_tolerance_value,$mass_loss_in_abrasion_test_value_min_value,$mass_loss_in_abrasion_test_value_max_value,'$uom_of_mass_loss_in_abrasion_test_value','$formaldehyde_content_tolerance_range_math_operator',$formaldehyde_content_tolerance_value,$formaldehyde_content_min_value,$formaldehyde_content_max_value,'$uom_of_formaldehyde_content','$cf_to_dry_cleaning_color_change_tolerance_range_math_operator',$cf_to_dry_cleaning_color_change_tolerance_value,$cf_to_dry_cleaning_color_change_min_value,$cf_to_dry_cleaning_color_change_max_value,'$uom_of_cf_to_dry_cleaning_color_change','$cf_to_dry_cleaning_staining_tolerance_range_math_operator',$cf_to_dry_cleaning_staining_tolerance_value,$cf_to_dry_cleaning_staining_min_value,$cf_to_dry_cleaning_staining_max_value,'$uom_of_cf_to_dry_cleaning_staining','$cf_to_washing_color_change_tolerance_range_math_operator',$cf_to_washing_color_change_tolerance_value,$cf_to_washing_color_change_min_value,$cf_to_washing_color_change_max_value,'$uom_of_cf_to_washing_color_change','$cf_to_washing_staining_tolerance_range_math_operator',$cf_to_washing_staining_tolerance_value,$cf_to_washing_staining_min_value,$cf_to_washing_staining_max_value,'$uom_of_cf_to_washing_staining', '$cf_to_washing_cross_staining_tolerance_range_math_operator',$cf_to_washing_cross_staining_tolerance_value,$cf_to_washing_cross_staining_min_value,$cf_to_washing_cross_staining_max_value,'$uom_of_cf_to_washing_cross_staining','$cf_to_perspiration_acid_color_change_tolerance_range_math_op',$cf_to_perspiration_acid_color_change_tolerance_value,$cf_to_perspiration_acid_color_change_min_value,$cf_to_perspiration_acid_color_change_max_value,'$uom_of_cf_to_perspiration_acid_color_change','$cf_to_perspiration_acid_staining_tolerance_range_math_operator',$cf_to_perspiration_acid_staining_value,$cf_to_perspiration_acid_staining_min_value,$cf_to_perspiration_acid_staining_max_value,'$uom_of_cf_to_perspiration_acid_staining','$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op',$cf_to_perspiration_acid_cross_staining_tolerance_value,$cf_to_perspiration_acid_cross_staining_min_value,$cf_to_perspiration_acid_cross_staining_max_value,'$uom_of_cf_to_perspiration_acid_cross_staining','$cf_to_perspiration_alkali_color_change_tolerance_range_math_op',$cf_to_perspiration_alkali_color_change_tolerance_value,$cf_to_perspiration_alkali_color_change_min_value,$cf_to_perspiration_alkali_color_change_max_value,'$uom_of_cf_to_perspiration_alkali_color_change','$cf_to_perspiration_alkali_staining_tolerance_range_math_op',$cf_to_perspiration_alkali_staining_tolerance_value,$cf_to_perspiration_alkali_staining_min_value,$cf_to_perspiration_alkali_staining_max_value,'$uom_of_cf_to_perspiration_alkali_staining','$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op',$cf_to_perspiration_alkali_cross_staining_tolerance_value,$cf_to_perspiration_alkali_cross_staining_min_value,$cf_to_perspiration_alkali_cross_staining_max_value,'$uom_of_cf_to_perspiration_alkali_cross_staining','$cf_to_water_color_change_tolerance_range_math_operator',$cf_to_water_color_change_tolerance_value,$cf_to_water_color_change_min_value,$cf_to_water_color_change_max_value,'$uom_of_cf_to_water_color_change','$cf_to_water_staining_tolerance_range_math_operator',$cf_to_water_staining_tolerance_value,$cf_to_water_staining_min_value,$cf_to_water_staining_max_value,'$uom_of_cf_to_water_staining','$cf_to_water_sotting_staining_tolerance_range_math_operator',$cf_to_water_sotting_staining_tolerance_value,$cf_to_water_sotting_staining_min_value,$cf_to_water_sotting_staining_max_value,'$uom_of_cf_to_water_sotting_staining','$cf_to_surface_wetting_staining_tolerance_range_math_operator',$cf_to_surface_wetting_staining_tolerance_value,$cf_to_surface_wetting_staining_min_value,$cf_to_surface_wetting_staining_max_value,'$uom_of_cf_to_surface_wetting_staining','$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op',$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value,$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value,$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value,'$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change','$cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op',$cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value,$cf_to_hydrolysis_of_reactive_dyes_staining_min_value,$cf_to_hydrolysis_of_reactive_dyes_staining_max_value,'$uom_of_cf_to_hydrolysis_of_reactive_dyes_staining','$cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op',$cf_to_oidative_bleach_damage_color_change_tolerance_value,$cf_to_oidative_bleach_damage_color_change_min_value,$cf_to_oidative_bleach_damage_color_change_max_value,'$uom_of_cf_to_oidative_bleach_damage_color_change','$cf_to_phenolic_yellowing_staining_tolerance_range_math_operator',$cf_to_phenolic_yellowing_staining_tolerance_value,$cf_to_phenolic_yellowing_staining_min_value,$cf_to_phenolic_yellowing_staining_max_value,'$uom_of_cf_to_phenolic_yellowing_staining','$cf_to_saliva_color_change_tolerance_range_math_operator',$cf_to_pvc_migration_staining_tolerance_value,$cf_to_pvc_migration_staining_min_value,$cf_to_pvc_migration_staining_max_value,'$uom_of_cf_to_pvc_migration_staining','$cf_to_pvc_migration_staining_tolerance_range_math_operator',$cf_to_saliva_color_change_tolerance_value,$cf_to_saliva_color_change_min_value,$cf_to_saliva_color_change_max_value,'$uom_of_cf_to_saliva_color_change','$cf_to_saliva_staining_tolerance_range_math_operator',$cf_to_saliva_staining_tolerance_value,$cf_to_saliva_staining_staining_min_value,$cf_to_saliva_staining_max_value,'$uom_of_cf_to_saliva_staining','$cf_to_chlorinated_water_color_change_tolerance_range_math_op',$cf_to_chlorinated_water_color_change_tolerance_value,$cf_to_chlorinated_water_color_change_min_value,$cf_to_chlorinated_water_color_change_max_value,'$uom_of_cf_to_chlorinated_water_color_change','$cf_to_chlorinated_water_staining_tolerance_range_math_operator',$cf_to_chlorinated_water_staining_tolerance_value,$cf_to_chlorinated_water_staining_min_value,$cf_to_chlorinated_water_staining_max_value,'$uom_of_cf_to_chlorinated_water_staining','$cf_to_cholorine_bleach_color_change_tolerance_range_math_op',$cf_to_cholorine_bleach_color_change_tolerance_value,$cf_to_cholorine_bleach_color_change_min_value,$cf_to_cholorine_bleach_color_change_max_value,'$uom_of_cf_to_cholorine_bleach_color_change','$cf_to_cholorine_bleach_staining_tolerance_range_math_operator',$cf_to_cholorine_bleach_staining_tolerance_value,$cf_to_cholorine_bleach_staining_min_value,$cf_to_cholorine_bleach_staining_max_value,'$uom_of_cf_to_cholorine_bleach_staining','$cf_to_peroxide_bleach_color_change_tolerance_range_math_operator',$cf_to_peroxide_bleach_color_change_tolerance_value,$cf_to_peroxide_bleach_color_change_min_value,$cf_to_peroxide_bleach_color_change_max_value,'$uom_of_cf_to_peroxide_bleach_color_change','$cf_to_peroxide_bleach_staining_tolerance_range_math_operator',$cf_to_peroxide_bleach_staining_tolerance_value,$cf_to_peroxide_bleach_staining_min_value,$cf_to_peroxide_bleach_staining_max_value,'$uom_of_cf_to_peroxide_bleach_staining','$cross_staining_tolerance_range_math_operator',$cross_staining_tolerance_value,$cross_staining_min_value,$cross_staining_max_value,'$uom_of_cross_staining','$water_absorption_value_tolerance_range_math_operator',$water_absorption_value_tolerance_value,$water_absorption_value_min_value,$water_absorption_value_max_value,'$uom_of_water_absorption_value','$spirality_value_tolerance_range_math_operator',$spirality_value_tolerance_value,$spirality_value_min_value,$spirality_value_max_value,'$uom_of_spirality_value','$durable_press_value_tolerance_range_math_operator',$durable_press_value_tolerance_value,$durable_press_value_min_value,$durable_press_value_max_value,'$uom_of_durable_press_value','$ironability_of_woven_fabric_value_tolerance_range_math_operator',$ironability_of_woven_fabric_value_tolerance_value,$ironability_of_woven_fabric_value_min_value,$ironability_of_woven_fabric_value_max_value,'$uom_of_ironability_of_woven_fabric_value','$cf_to_artificial_light_value_tolerance_range_math_operator',$cf_to_artificial_light_value_tolerance_value,$cf_to_artificial_light_value_min_value,$cf_to_artificial_light_value_max_value,'$uom_of_cf_to_artificial_light_value',$moisture_content_in_percentage_min_value,$moisture_content_in_percentage_max_value,'$uom_of_moisture_content_in_percentage',$evaporation_rate_in_percentage_min_value,$evaporation_rate_in_percentage_max_value,'$uom_of_evaporation_rate_in_percentage',$percentage_of_total_cotton_content_value,'$percentage_of_total_cotton_content_tolerance_range_math_operator',$percentage_of_total_cotton_content_tolerance_value,$percentage_of_total_cotton_content_min_value,$percentage_of_total_cotton_content_max_value,'$uom_of_percentage_of_total_cotton_content','$percentage_of_total_polyester_content_value','$percentage_of_total_polyester_content_tolerance_range_math_op',$percentage_of_total_polyester_content_tolerance_value,$percentage_of_total_polyester_content_min_value,$percentage_of_total_polyester_content_max_value,'$uom_of_percentage_of_total_polyester_content',$percentage_of_total_other_fiber_content_value,'$percentage_of_total_other_fiber_content_tolerance_range_math_op',$percentage_of_total_other_fiber_content_tolerance_value,$percentage_of_total_other_fiber_content_min_value,$percentage_of_total_other_fiber_content_max_value,'$uom_of_percentage_of_total_other_fiber_content',$percentage_of_warp_cotton_content_value,'$percentage_of_warp_cotton_content_tolerance_range_math_operator',$percentage_of_warp_cotton_content_tolerance_value,$percentage_of_warp_cotton_content_min_value,'$uom_of_percentage_of_warp_cotton_content',$percentage_of_warp_polyester_content_value,'$percentage_of_warp_polyester_content_tolerance_range_math_op',$percentage_of_warp_polyester_content_tolerance_value,$percentage_of_warp_polyester_content_min_value,$percentage_of_warp_polyester_content_max_value,'$uom_of_percentage_of_warp_polyester_content',$percentage_of_warp_other_fiber_content_value,'$percentage_of_warp_other_fiber_content_tolerance_range_math_op',$percentage_of_warp_other_fiber_content_tolerance_value,$percentage_of_warp_other_fiber_content_min_value,$percentage_of_warp_other_fiber_content_max_value,'$uom_of_percentage_of_warp_other_fiber_content',$percentage_of_weft_cotton_content_value,'$percentage_of_weft_cotton_content_tolerance_range_math_op',$percentage_of_weft_cotton_content_tolerance_value,$percentage_of_weft_cotton_content_min_value,$percentage_of_weft_cotton_content_max_value,'$uom_of_percentage_of_weft_cotton_content',$percentage_of_weft_polyester_content_value,'$percentage_of_weft_polyester_content_tolerance_range_math_op',$percentage_of_weft_polyester_content_tolerance_value,$percentage_of_weft_polyester_content_min_value,$percentage_of_weft_polyester_content_max_value,'$uom_of_percentage_of_weft_polyester_content',$percentage_of_weft_other_fiber_content_value,'$percentage_of_weft_other_fiber_content_tolerance_range_math_op',$percentage_of_weft_other_fiber_content_tolerance_value,$percentage_of_weft_other_fiber_content_min_value,$percentage_of_weft_other_fiber_content_max_value,'$uom_of_percentage_of_weft_other_fiber_content','$seam_slippage_resistance_in_warp_tolerance_range_math_operator',$seam_slippage_resistance_in_warp_tolerance_value,$seam_slippage_resistance_in_warp_min_value,$seam_slippage_resistance_in_warp_max_value,'$uom_of_seam_slippage_resistance_in_warp','$seam_slippage_resistance_in_weft_tolerance_range_math_operator',$seam_slippage_resistance_in_weft_tolerance_value,$seam_slippage_resistance_in_weft_min_value,$seam_slippage_resistance_in_weft_max_value,'$uom_of_seam_slippage_resistance_in_weft','$ph_value_tolerance_range_math_operator',$ph_value_tolerance_value,$ph_value_min_value,$ph_value_max_value,'$uom_of_ph_value','$user_id','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

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
