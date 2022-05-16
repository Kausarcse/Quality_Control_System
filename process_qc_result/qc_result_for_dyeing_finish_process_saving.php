<?php
session_start();
error_reporting(0);
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];



$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];



$pp_number= $_POST['pp_number'];
$version_number= $_POST['version_number'];
$version_id= $_POST['version_id'];

/*
$splitted_data=explode('?fs?', $version_number);
$version_number=$splitted_data[0];*/

$customer_name= $_POST['customer_name'];
$customer_id= $_POST['customer_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];
$date= $_POST['date'];
// $splitted_date= explode("/",$date);
// $date= $splitted_date[2]."-".$splitted_date[1]."-".$splitted_date[0];
$before_trolley_number_or_batcher_number= $_POST['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number= $_POST['after_trolley_number_or_batcher_number'];
// $trf_number= $_POST['trf_number'];

// $process_qty= $_POST['process_qty'];
$short_or_excess_in_percentage= $_POST['short_or_excess_in_percentage'];
$total_quantity_in_meter= $_POST['total_quantity_in_meter'];
// $total_short_or_excess_in_percentage= $_POST['total_short_or_excess_in_percentage'];
$machine_name= $_POST['machine_name'];



$cf_to_rubbing_dry_value= $_POST['cf_to_rubbing_dry_value'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];

$cf_to_rubbing_wet_value= $_POST['cf_to_rubbing_wet_value'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];

$dimensional_stability_to_warp_washing_before_iron_value= $_POST['dimensional_stability_to_warp_washing_before_iron_value'];
$uom_of_dimensional_stability_to_warp_washing_before_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_before_iron'];

$dimensional_stability_to_weft_washing_before_iron_value= $_POST['dimensional_stability_to_weft_washing_before_iron_value'];
$uom_of_dimensional_stability_to_weft_washing_before_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_before_iron'];


$dimensional_stability_to_warp_washing_after_iron_value= $_POST['dimensional_stability_to_warp_washing_after_iron_value'];
$uom_of_dimensional_stability_to_warp_washing_after_iron= $_POST['uom_of_dimensional_stability_to_warp_washing_after_iron'];

$dimensional_stability_to_weft_washing_after_iron_value= $_POST['dimensional_stability_to_weft_washing_after_iron_value'];
$uom_of_dimensional_stability_to_weft_washing_after_iron= $_POST['uom_of_dimensional_stability_to_weft_washing_after_iron'];


$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$uom_of_warp_yarn_count= $_POST['uom_of_warp_yarn_count'];

$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$uom_of_weft_yarn_count= $_POST['uom_of_weft_yarn_count'];

$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$uom_of_no_of_threads_in_warp= $_POST['uom_of_no_of_threads_in_warp'];


$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$uom_of_no_of_threads_in_weft= $_POST['uom_of_no_of_threads_in_weft'];

$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$uom_of_mass_per_unit_per_area= $_POST['uom_of_mass_per_unit_per_area'];


$surface_fuzzing_and_pilling_value= $_POST['surface_fuzzing_and_pilling_value'];
$uom_of_surface_fuzzing_and_pilling= $_POST['uom_of_surface_fuzzing_and_pilling'];

$tensile_properties_in_warp_value= $_POST['tensile_properties_in_warp_value'];
$uom_of_tensile_properties_in_warp= $_POST['uom_of_tensile_properties_in_warp'];

$tensile_properties_in_weft_value= $_POST['tensile_properties_in_weft_value'];
$uom_of_tensile_properties_in_weft= $_POST['uom_of_tensile_properties_in_weft'];

$tear_force_in_warp_value= $_POST['tear_force_in_warp_value'];
$uom_of_tear_force_in_warp= $_POST['uom_of_tear_force_in_warp'];

$tear_force_in_weft_value= $_POST['tear_force_in_weft_value'];
$uom_of_tear_force_in_weft= $_POST['uom_of_tear_force_in_weft'];

$seam_slippage_resistance_in_warp_value= $_POST['seam_slippage_resistance_in_warp_value'];
$uom_of_seam_slippage_resistance_in_warp= $_POST['uom_of_seam_slippage_resistance_in_warp'];


$seam_slippage_resistance_in_weft_value= $_POST['seam_slippage_resistance_in_weft_value'];
$uom_of_seam_slippage_resistance_in_weft= $_POST['uom_of_seam_slippage_resistance_in_weft'];


$seam_slippage_resistance_iso_2_in_warp_value= $_POST['seam_slippage_resistance_iso_2_in_warp_value'];
$uom_of_seam_slippage_resistance_iso_2_in_warp= $_POST['uom_of_seam_slippage_resistance_iso_2_in_warp'];




$seam_slippage_resistance_iso_2_in_weft_value= $_POST['seam_slippage_resistance_iso_2_in_weft_value'];
$uom_of_seam_slippage_resistance_iso_2_in_weft= $_POST['uom_of_seam_slippage_resistance_iso_2_in_weft'];


$seam_strength_in_warp_value= $_POST['seam_strength_in_warp_value'];
$uom_of_seam_strength_in_warp= $_POST['uom_of_seam_strength_in_warp'];


$seam_strength_in_weft_value= $_POST['seam_strength_in_weft_value'];
$uom_of_seam_strength_in_weft= $_POST['uom_of_seam_strength_in_weft'];


$seam_properties_seam_slippage_iso_astm_d_in_warp_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_warp_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


$seam_properties_seam_slippage_iso_astm_d_in_weft_value= $_POST['seam_properties_seam_slippage_iso_astm_d_in_weft_value'];
$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


$seam_properties_seam_strength_iso_astm_d_in_warp_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_warp_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

$seam_properties_seam_strength_iso_astm_d_in_weft_value= $_POST['seam_properties_seam_strength_iso_astm_d_in_weft_value'];
$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $_POST['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


$abrasion_resistance_no_of_thread_break_value= $_POST['abrasion_resistance_no_of_thread_break_value'];
$uom_of_abrasion_resistance_no_of_thread_break= $_POST['uom_of_abrasion_resistance_no_of_thread_break'];


$abrasion_resistance_c_change_value= $_POST['abrasion_resistance_c_change_value'];
$uom_of_abrasion_resistance_c_change= $_POST['uom_of_abrasion_resistance_c_change'];


$mass_loss_in_abrasion_value= $_POST['mass_loss_in_abrasion_value'];
$uom_of_mass_loss_in_abrasion= $_POST['uom_of_mass_loss_in_abrasion'];

 							/////// cf to washing //////////////

$cf_to_washing_color_change_value= $_POST['cf_to_washing_color_change_value'];
$uom_of_cf_to_washing_color_change= $_POST['uom_of_cf_to_washing_color_change'];

$cf_to_washing_staining_value= $_POST['cf_to_washing_staining_value'];
$uom_of_cf_to_washing_staining= $_POST['uom_of_cf_to_washing_staining'];
    
$acetate_cf_washing= $_POST['acetate_cf_washing'];
$cotton_cf_washing= $_POST['cotton_cf_washing'];
$mylon_cf_washing= $_POST['mylon_cf_washing'];
$polyester_cf_washing= $_POST['polyester_cf_washing'];
$acrylic_cf_washing= $_POST['acrylic_cf_washing'];
$wool_cf_washing= $_POST['wool_cf_washing'];

$cf_to_washing_cross_staining_value= $_POST['cf_to_washing_cross_staining_value'];
$uom_of_cf_to_washing_cross_staining= $_POST['uom_of_cf_to_washing_cross_staining'];

				////////////////// cf to dry cleaning /////////////////////

$cf_to_dry_cleaning_color_change_value= $_POST['cf_to_dry_cleaning_color_change_value'];
$uom_of_cf_to_dry_cleaning_color_change= $_POST['uom_of_cf_to_dry_cleaning_color_change'];

$cf_to_dry_cleaning_staining_value= $_POST['cf_to_dry_cleaning_staining_value'];
$uom_of_cf_to_dry_cleaning_staining= $_POST['uom_of_cf_to_dry_cleaning_staining'];

$acetate_cf_dry_cleaning= $_POST['acetate_cf_dry_cleaning'];
$cotton_cf_dry_cleaning= $_POST['cotton_cf_dry_cleaning'];
$mylon_cf_dry_cleaning= $_POST['mylon_cf_dry_cleaning'];
$polyester_cf_dry_cleaning= $_POST['polyester_cf_dry_cleaning'];
$acrylic_cf_dry_cleaning= $_POST['acrylic_cf_dry_cleaning'];
$wool_cf_dry_cleaning= $_POST['wool_cf_dry_cleaning'];

////////////////// cf to perspiration acid //////////////////

$cf_to_perspiration_acid_color_change_value= $_POST['cf_to_perspiration_acid_color_change_value'];
$uom_of_cf_to_perspiration_acid_color_change= $_POST['uom_of_cf_to_perspiration_acid_color_change'];


$cf_to_perspiration_acid_staining_value= $_POST['cf_to_perspiration_acid_staining_value'];
$uom_of_cf_to_perspiration_acid_staining= $_POST['uom_of_cf_to_perspiration_acid_staining'];



$acetate_cf_to_perspiration_acid= $_POST['acetate_cf_to_perspiration_acid'];
$cotton_cf_to_perspiration_acid= $_POST['cotton_cf_to_perspiration_acid'];
$mylon_cf_to_perspiration_acid= $_POST['mylon_cf_to_perspiration_acid'];
$polyester_cf_to_perspiration_acid= $_POST['polyester_cf_to_perspiration_acid'];
$acrylic_cf_to_perspiration_acid= $_POST['acrylic_cf_to_perspiration_acid'];
$wool_cf_to_perspiration_acid= $_POST['wool_cf_to_perspiration_acid'];

$cf_to_perspiration_acid_cross_staining_value= $_POST['cf_to_perspiration_acid_cross_staining_value'];
$uom_of_cf_to_perspiration_acid_cross_staining= $_POST['uom_of_cf_to_perspiration_acid_cross_staining'];

////////////////// cf to perspiration alkali //////////////////

$cf_to_perspiration_alkali_color_change_value= $_POST['cf_to_perspiration_alkali_color_change_value'];
$uom_of_cf_to_perspiration_alkali_color_change= $_POST['uom_of_cf_to_perspiration_alkali_color_change'];


$cf_to_perspiration_alkali_staining_value= $_POST['cf_to_perspiration_alkali_staining_value'];
$uom_of_cf_to_perspiration_alkali_staining= $_POST['uom_of_cf_to_perspiration_alkali_staining'];


$acetate_cf_to_perspiration_alkali= $_POST['acetate_cf_to_perspiration_alkali'];
$cotton_cf_to_perspiration_alkali= $_POST['cotton_cf_to_perspiration_alkali'];
$mylon_cf_to_perspiration_alkali= $_POST['mylon_cf_to_perspiration_alkali'];
$polyester_cf_to_perspiration_alkali= $_POST['polyester_cf_to_perspiration_alkali'];
$acrylic_cf_to_perspiration_alkali= $_POST['acrylic_cf_to_perspiration_alkali'];
$wool_cf_to_perspiration_alkali= $_POST['wool_cf_to_perspiration_alkali'];

$cf_to_perspiration_alkali_cross_staining_value= $_POST['cf_to_perspiration_alkali_cross_staining_value'];
$uom_of_cf_to_perspiration_alkali_cross_staining= $_POST['uom_of_cf_to_perspiration_alkali_cross_staining'];

////////////////// cf to perspiration water //////////////////

$cf_to_water_color_change_value= $_POST['cf_to_water_color_change_value'];
$uom_of_cf_to_water_color_change= $_POST['uom_of_cf_to_water_color_change'];


$cf_to_water_staining_value= $_POST['cf_to_water_staining_value'];
$uom_of_cf_to_water_staining= $_POST['uom_of_cf_to_water_staining'];


$acetate_cf_to_water= $_POST['acetate_cf_to_water'];
$cotton_cf_to_water= $_POST['cotton_cf_to_water'];
$mylon_cf_to_water= $_POST['mylon_cf_to_water'];
$polyester_cf_to_water= $_POST['polyester_cf_to_water'];
$acrylic_cf_to_water= $_POST['acrylic_cf_to_water'];
$wool_cf_to_water= $_POST['wool_cf_to_water'];

$cf_to_water_cross_staining_value= $_POST['cf_to_water_cross_staining_value'];
$uom_of_cf_to_water_cross_staining= $_POST['uom_of_cf_to_water_cross_staining'];


$cf_to_water_spotting_surface_value= $_POST['cf_to_water_spotting_surface_value'];
$uom_of_cf_to_water_spotting_surface= $_POST['uom_of_cf_to_water_spotting_surface'];


$cf_to_water_spotting_edge_value= $_POST['cf_to_water_spotting_edge_value'];
$uom_of_cf_to_water_spotting_edge= $_POST['uom_of_cf_to_water_spotting_edge'];


$cf_to_water_spotting_cross_staining_value= $_POST['cf_to_water_spotting_cross_staining_value'];
$uom_of_cf_to_water_spotting_cross_staining= $_POST['uom_of_cf_to_water_spotting_cross_staining'];


$resistance_to_surface_wetting_before_wash_value= $_POST['resistance_to_surface_wetting_before_wash_value'];
$uom_of_resistance_to_surface_wetting_before_wash= $_POST['uom_of_resistance_to_surface_wetting_before_wash'];


$resistance_to_surface_wetting_after_one_wash_value= $_POST['resistance_to_surface_wetting_after_one_wash_value'];
$uom_of_resistance_to_surface_wetting_after_one_wash= $_POST['uom_of_resistance_to_surface_wetting_after_one_wash'];



$resistance_to_surface_wetting_after_five_wash_value= $_POST['resistance_to_surface_wetting_after_five_wash_value'];
$uom_of_resistance_to_surface_wetting_after_five_wash= $_POST['uom_of_resistance_to_surface_wetting_after_five_wash'];


$cf_to_hydrolysis_of_reactive_dyes_color_change_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


$cf_to_oxidative_bleach_damage_color_change_value= $_POST['cf_to_oxidative_bleach_damage_color_change_value'];
$uom_of_cf_to_oxidative_bleach_damage_color_change= $_POST['uom_of_cf_to_oxidative_bleach_damage_color_change'];


$cf_to_oxidative_bleach_damage_value= $_POST['cf_to_oxidative_bleach_damage_value'];
$uom_of_cf_to_oxidative_bleach_damage= $_POST['uom_of_cf_to_oxidative_bleach_damage'];


$cf_to_phenolic_yellowing_staining_value= $_POST['cf_to_phenolic_yellowing_staining_value'];
$uom_of_cf_to_phenolic_yellowing_staining= $_POST['uom_of_cf_to_phenolic_yellowing_staining'];


$cf_to_pvc_migration_staining_value= $_POST['cf_to_pvc_migration_staining_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];

////////////////// cf to perspiration saliva //////////////////

$cf_to_saliva_color_change_value= $_POST['cf_to_saliva_color_change_value'];
$uom_of_cf_to_saliva_color_change= $_POST['uom_of_cf_to_saliva_color_change'];


$cf_to_saliva_staining_value= $_POST['cf_to_saliva_staining_value'];
$uom_of_cf_to_saliva_staining= $_POST['uom_of_cf_to_saliva_staining'];


$acetate_cf_to_saliva= $_POST['acetate_cf_to_saliva'];
$cotton_cf_to_saliva= $_POST['cotton_cf_to_saliva'];
$mylon_cf_to_saliva= $_POST['mylon_cf_to_saliva'];
$polyester_cf_to_saliva= $_POST['polyester_cf_to_saliva'];
$acrylic_cf_to_saliva= $_POST['acrylic_cf_to_saliva'];
$wool_cf_to_saliva= $_POST['wool_cf_to_saliva'];


$cf_to_chlorinated_water_color_change_change_value= $_POST['cf_to_chlorinated_water_color_change_change_value'];
$uom_of_cf_to_chlorinated_water_color_change_change= $_POST['uom_of_cf_to_chlorinated_water_color_change_change'];


$cf_to_cholorine_bleach_color_change_value= $_POST['cf_to_cholorine_bleach_color_change_value'];
$uom_of_cf_to_cholorine_bleach_color_change= $_POST['uom_of_cf_to_cholorine_bleach_color_change'];


$cross_staining_value= $_POST['cross_staining_value'];
$uom_of_cross_staining= $_POST['uom_of_cross_staining'];


 $formaldehyde_content_value= $_POST['formaldehyde_content_value'];

$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];


$ph_value= $_POST['ph_value'];
$uom_of_ph= $_POST['uom_of_ph'];

$description_or_type_for_water_absorption=$_POST['description_or_type_for_water_absorption'];
$water_absorption_value= $_POST['water_absorption_value'];
$uom_of_water_absorption= $_POST['uom_of_water_absorption'];


$water_absorption_b_wash_thirty_sec_value= $_POST['water_absorption_b_wash_thirty_sec_value'];  // Nees to entry in sql

$uom_of_water_absorption_b_wash_thirty_sec= $_POST['uom_of_water_absorption_b_wash_thirty_sec'];


$water_absorption_b_wash_max_value= $_POST['water_absorption_b_wash_max_value'];
$uom_of_water_absorption_b_wash_max= $_POST['uom_of_water_absorption_b_wash_max'];


$water_absorption_a_wash_thirty_sec_value= $_POST['water_absorption_a_wash_thirty_sec_value'];
$uom_of_water_absorption_a_wash_thirty_sec= $_POST['uom_of_water_absorption_a_wash_thirty_sec'];


$spirality_value= $_POST['spirality_value'];
$uom_of_spirality= $_POST['uom_of_spirality'];


$smoothness_appearance_value= $_POST['smoothness_appearance_value'];
$uom_of_smoothness_appearance= $_POST['uom_of_smoothness_appearance'];

$print_durability_value= $_POST['print_durability_value'];
$uom_of_print_durability= $_POST['uom_of_print_durability'];

$iron_ability_of_woven_fabric_value=$_POST['iron_ability_of_woven_fabric_value'];
$uom_of_iron_ability_of_woven_fabric=$_POST['uom_of_iron_ability_of_woven_fabric'];

$cf_to_artificial_day_light_value= $_POST['cf_to_artificial_day_light_value'];
$uom_of_cf_to_artificial_day_light= $_POST['uom_of_cf_to_artificial_day_light'];

$cf_to_light_shade_color_1 = $_POST['cf_to_light_shade_color_1'];
$cf_to_light_shade_color_2 = $_POST['cf_to_light_shade_color_2'];
$cf_to_light_shade_color_3 = $_POST['cf_to_light_shade_color_3'];
$cf_to_light_shade_color_4 = $_POST['cf_to_light_shade_color_4'];
$cf_to_light_shade_color_5 = $_POST['cf_to_light_shade_color_5'];
$cf_to_light_shade_color_6 = $_POST['cf_to_light_shade_color_6'];
$cf_to_light_shade_color_7 = $_POST['cf_to_light_shade_color_7'];

$cf_to_light_shade_color_1_value = $_POST['cf_to_light_shade_color_1_value'];
$cf_to_light_shade_color_2_value = $_POST['cf_to_light_shade_color_2_value'];
$cf_to_light_shade_color_3_value = $_POST['cf_to_light_shade_color_3_value'];
$cf_to_light_shade_color_4_value = $_POST['cf_to_light_shade_color_4_value'];
$cf_to_light_shade_color_5_value = $_POST['cf_to_light_shade_color_5_value'];
$cf_to_light_shade_color_6_value = $_POST['cf_to_light_shade_color_6_value'];
$cf_to_light_shade_color_7_value = $_POST['cf_to_light_shade_color_7_value'];



$moisture_content_value= $_POST['moisture_content_value'];
$uom_of_moisture_content= $_POST['uom_of_moisture_content'];

$evaporation_rate_quick_drying_value= $_POST['evaporation_rate_quick_drying_value'];
$uom_of_evaporation_rate_quick_drying= $_POST['uom_of_evaporation_rate_quick_drying'];

$total_cotton_content_value= $_POST['total_cotton_content_value'];
$uom_of_total_cotton_content= $_POST['uom_of_total_cotton_content'];

$total_total_Polyester_content_value= $_POST['total_total_Polyester_content_value'];
$uom_of_total_total_Polyester_content= $_POST['uom_of_total_total_Polyester_content'];


$total_other_fiber_value= $_POST['total_other_fiber_value'];
$uom_of_total_other_fiber= $_POST['uom_of_total_other_fiber'];


$warp_cotton_content_value= $_POST['warp_cotton_content_value'];
$uom_of_warp_cotton_content= $_POST['uom_of_warp_cotton_content'];


$warp_Polyester_content_value= $_POST['warp_Polyester_content_value'];
$uom_of_warp_Polyester_content= $_POST['uom_of_warp_Polyester_content'];

$warp_other_fiber_value= $_POST['warp_other_fiber_value'];
$uom_of_warp_other_fiber= $_POST['uom_of_warp_other_fiber'];


$weft_cotton_content_value= $_POST['weft_cotton_content_value'];
$uom_of_weft_cotton_content= $_POST['uom_of_weft_cotton_content'];


$weft_Polyester_content_value= $_POST['weft_Polyester_content_value'];
$uom_of_weft_Polyester_content= $_POST['uom_of_weft_Polyester_content'];


$weft_other_fiber_value= $_POST['weft_other_fiber_value'];
$uom_of_weft_other_fiber= $_POST['uom_of_weft_other_fiber'];



$appearance_after_wash_radio_button = $_POST['test_method_for_appearance_after_wash'];

if($appearance_after_wash_radio_button== 'Fabric (Mock up)')
{
	$appearance_after_wash_for_fabric_radio_button = $_POST['appearance_after_washing_cycle_fabric_wash'];
}
else
{
	$appearance_after_wash_for_fabric_radio_button = '';
}

if($appearance_after_wash_radio_button== 'Garments')
{
	$appearance_after_wash_for_garments_radio_button = $_POST['appearance_after_washing_cycle_garments_wash'];
}
else
{
	$appearance_after_wash_for_garments_radio_button = '';
}


// echo $appearance_after_wash_radio_button;
// echo $appearance_after_wash_for_fabric_radio_button;
// echo $appearance_after_wash_for_garments_radio_button;
// exit();


$test_method_for_appearance_after_washing_fabric_color_change=$_POST['test_method_for_appearance_after_washing_fabric_color_change'];
$appearance_after_washing_fabric_color_change_value=$_POST['appearance_after_washing_fabric_color_change_value'];
$uom_of_appearance_after_washing_fabric_color_change=$_POST['uom_of_appearance_after_washing_fabric_color_change'];

$test_method_for_appearance_after_washing_fabric_cross_staining=$_POST['test_method_for_appearance_after_washing_fabric_cross_staining'];
$appearance_after_washing_fabric_cross_staining_value=$_POST['appearance_after_washing_fabric_cross_staining_value'];
$uom_of_appearance_after_washing_fabric_cross_staining=$_POST['uom_of_appearance_after_washing_fabric_cross_staining'];

$test_method_for_appearance_after_washing_fabric_surface_fuzzing=$_POST['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
$appearance_after_washing_fabric_surface_fuzzing_value=$_POST['appearance_after_washing_fabric_surface_fuzzing_value'];
$uom_of_appearance_after_washing_fabric_surface_fuzzing=$_POST['uom_of_appearance_after_washing_fabric_surface_fuzzing'];

$test_method_for_appearance_after_washing_fabric_surface_pilling=$_POST['test_method_for_appearance_after_washing_fabric_surface_pilling'];
$appearance_after_washing_fabric_surface_pilling_value=$_POST['appearance_after_washing_fabric_surface_pilling_value'];
$uom_of_appearance_after_washing_fabric_surface_pilling=$_POST['uom_of_appearance_after_washing_fabric_surface_pilling'];

$test_method_for_appearance_after_washing_fabric_crease_before_ironing=$_POST['test_method_for_appearance_after_washing_fabric_crease_before_ironing'];
$appearance_after_washing_fabric_crease_before_ironing_value=$_POST['appearance_after_washing_fabric_crease_before_ironing_value'];
$uom_of_appearance_after_washing_fabric_crease_before_ironing=$_POST['uom_of_appearance_after_washing_fabric_crease_before_ironing'];

$test_method_for_appearance_after_washing_fabric_crease_after_ironing=$_POST['test_method_for_appearance_after_washing_fabric_crease_after_ironing'];
$appearance_after_washing_fabric_crease_after_ironing_value=$_POST['appearance_after_washing_fabric_crease_after_ironing_value'];
$uom_of_appearance_after_washing_fabric_crease_after_ironing=$_POST['uom_of_appearance_after_washing_fabric_crease_after_ironing'];

$test_method_for_appearance_after_washing_fabric_loss_of_print=$_POST['test_method_for_appearance_after_washing_fabric_loss_of_print'];
$appearance_after_washing_fabric_loss_of_print_value=$_POST['appearance_after_washing_fabric_loss_of_print_value'];
$uom_of_appearance_after_washing_fabric_loss_of_print=$_POST['uom_of_appearance_after_washing_fabric_loss_of_print'];

$test_method_for_appearance_after_washing_fabric_abrasive_mark=$_POST['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
$appearance_after_washing_fabric_abrasive_mark_value=$_POST['appearance_after_washing_fabric_abrasive_mark_value'];
$uom_of_appearance_after_washing_fabric_abrasive_mark=$_POST['uom_of_appearance_after_washing_fabric_abrasive_mark'];

$test_method_for_appearance_after_washing_fabric_odor=$_POST['test_method_for_appearance_after_washing_fabric_odor'];
$appearance_after_washing_fabric_odor_value=$_POST['appearance_after_washing_fabric_odor_value'];
$uom_of_appearance_after_washing_fabric_odor=$_POST['uom_of_appearance_after_washing_fabric_odor'];
$appearance_after_washing_other_observation_fabric =  mysqli_real_escape_string($con, $_POST['appearance_after_washing_other_observation_fabric']);
// $appearance_after_washing_cycle_garments_wash="";
// if(!empty($_POST['appearance_after_washing_cycle_garments_wash']))
// {
//     foreach($_POST['appearance_after_washing_cycle_garments_wash'] as $appearance_after_washing_cycle_garments_wash_value)
//     {
//       $appearance_after_washing_cycle_garments_wash.= $appearance_after_washing_cycle_garments_wash_value. " , ";
//     }
    
// }

$test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$_POST['test_method_for_appearance_after_washing_garments_color_change_without_suppressor'];
$appearance_after_washing_garments_color_change_without_suppressor_value=$_POST['appearance_after_washing_garments_color_change_without_suppressor_value'];
$uom_of_appearance_after_washing_garments_color_change_without_suppressor=$_POST['uom_of_appearance_after_washing_garments_color_change_without_suppressor'];

$test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$_POST['test_method_for_appearance_after_washing_garments_color_change_with_suppressor'];
$appearance_after_washing_garments_color_change_with_suppressor_value=$_POST['appearance_after_washing_garments_color_change_with_suppressor_value'];
$uom_of_appearance_after_washing_garments_color_change_with_suppressor=$_POST['uom_of_appearance_after_washing_garments_color_change_with_suppressor'];

$test_method_for_appearance_after_washing_garments_cross_staining=$_POST['test_method_for_appearance_after_washing_garments_cross_staining'];
$appearance_after_washing_garments_cross_staining_value=$_POST['appearance_after_washing_garments_cross_staining_value'];
$uom_of_appearance_after_washing_garments_cross_staining=$_POST['uom_of_appearance_after_washing_garments_cross_staining'];

$test_method_for_appearance_after_washing_garments_differential_shrinkage=$_POST['test_method_for_appearance_after_washing_garments_differential_shrinkage'];
$appearance_after_washing_garmentsdifferential_shrinkage_value=$_POST['appearance_after_washing_garmentsdifferential_shrinkage_value'];
$uom_of_appearance_after_washing_garments_differential_shrinkage=$_POST['uom_of_appearance_after_washing_garments_differential_shrinkage'];

$test_method_for_appearance_after_washing_garments_surface_fuzzing=$_POST['test_method_for_appearance_after_washing_garments_surface_fuzzing'];
$appearance_after_washing_garments_surface_fuzzing_value=$_POST['appearance_after_washing_garments_surface_fuzzing_value'];
$uom_of_appearance_after_washing_garments_surface_fuzzing=$_POST['uom_of_appearance_after_washing_garments_surface_fuzzing'];

$test_method_for_appearance_after_washing_garments_surface_pilling=$_POST['test_method_for_appearance_after_washing_garments_surface_pilling'];
$appearance_after_washing_garments_surface_pilling_value=$_POST['appearance_after_washing_garments_surface_pilling_value'];
$uom_of_appearance_after_washing_garments_surface_pilling=$_POST['uom_of_appearance_after_washing_garments_surface_pilling'];

$test_method_for_appearance_after_washing_garments_crease_after_ironing=$_POST['test_method_for_appearance_after_washing_garments_crease_after_ironing'];
$appearance_after_washing_garments_crease_after_ironing_value=$_POST['appearance_after_washing_garments_crease_after_ironing_value'];
$uom_of_appearance_after_washing_garments_crease_after_ironing=$_POST['uom_of_appearance_after_washing_garments_crease_after_ironing'];

$test_method_for_appearance_after_washing_garments_abrasive_mark=$_POST['test_method_for_appearance_after_washing_garments_abrasive_mark'];
$appearance_after_washing_garments_abrasive_mark_value=$_POST['appearance_after_washing_garments_abrasive_mark_value'];
$uom_of_appearance_after_washing_garments_abrasive_mark=$_POST['uom_of_appearance_after_washing_garments_abrasive_mark'];

$test_method_for_appearance_after_washing_garments_seam_breakdown=$_POST['test_method_for_appearance_after_washing_garments_seam_breakdown'];
$appearance_after_washing_garments_seam_breakdown_value=$_POST['appearance_after_washing_garments_seam_breakdown_value'];
$uom_of_appearance_after_washing_garments_seam_breakdown=$_POST['uom_of_appearance_after_washing_garments_seam_breakdown'];

$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$_POST['test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron'];
$appearance_after_washing_garments_seam_puckering_roping_after_iron_value=$_POST['appearance_after_washing_garments_seam_puckering_roping_after_iron_value'];
$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$_POST['uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron'];

$test_method_for_appearance_after_washing_garments_detachment_of_interlining=$_POST['test_method_for_appearance_after_washing_garments_detachment_of_interliningn'];
$appearance_after_washing_garments_detachment_of_interlining_value=$_POST['appearance_after_washing_garments_detachment_of_interlining_value'];
$uom_of_appearance_after_washing_garments_detachment_of_interlining=$_POST['uom_of_appearance_after_washing_garments_detachment_of_interlining'];

$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$_POST['test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance'];
$appearance_after_washing_garments_change_in_handle_or_appearance_value=$_POST['appearance_after_washing_garments_change_in_handle_or_appearance_value'];
$uom_of_appearance_after_washing_garments_change_in_handle_or_appearance=$_POST['uom_of_appearance_after_washing_garments_change_in_handle_or_appearance'];

$test_method_for_appearance_after_washing_garments_effect_accessories=$_POST['test_method_for_appearance_after_washing_garments_effect_accessories'];
$appearance_after_washing_garments_effect_accessories_value=$_POST['appearance_after_washing_garments_effect_accessories_value'];
$uom_of_appearance_after_washing_garments_effect_accessories=$_POST['uom_of_appearance_after_washing_garments_effect_accessories'];

$test_method_for_appearance_after_washing_garments_spiralitys=$_POST['test_method_for_appearance_after_washing_garments_spiralitys'];
$appearance_after_washing_garments_spirality_value=$_POST['appearance_after_washing_garments_spirality_value'];
$uom_of_appearance_after_washing_garments_spirality=$_POST['uom_of_appearance_after_washing_garments_spirality'];

$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$_POST['test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons'];
$appearance_after_washing_garments_detachment_or_fraying_of_ribbons_value=$_POST['appearance_after_washing_garments_detachment_or_fraying_of_ribbons_value'];
$uom_of_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$_POST['uom_of_appearance_after_washing_garments_detachment_or_fraying_of_ribbons'];

$test_method_for_appearance_after_washing_garments_loss_of_print=$_POST['test_method_for_appearance_after_washing_garments_loss_of_print'];
$appearance_after_washing_garments_loss_of_print_value=$_POST['appearance_after_washing_garments_loss_of_print_value'];
$uom_of_appearance_after_washing_garments_loss_of_print=$_POST['uom_of_appearance_after_washing_garments_loss_of_print'];

$test_method_for_appearance_after_washing_garments_care_level=$_POST['test_method_for_appearance_after_washing_garments_care_level'];
$appearance_after_washing_garments_care_level_value=$_POST['appearance_after_washing_garments_care_level_value'];
$uom_of_appearance_after_washing_garments_care_level=$_POST['uom_of_appearance_after_washing_garments_care_level'];

$test_method_for_appearance_after_washing_garments_odor=$_POST['test_method_for_appearance_after_washing_garments_odor'];
$appearance_after_washing_garments_odor_value=$_POST['appearance_after_washing_garments_odor_value'];
$uom_of_appearance_after_washing_garments_odor=$_POST['uom_of_appearance_after_washing_garments_odor'];
$appearance_after_washing_other_observation_garments =  mysqli_real_escape_string($con, $_POST['appearance_after_washing_other_observation_garments']);




$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state= $_POST['current_state'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="SELECT * from `qc_result_for_dyeing_finish_process` 
							where `pp_number`='$pp_number' and 
								`version_number`='$version_number' and 
								`customer_name`='$customer_name' and 
								`color`='$color' and 
								`finish_width_in_inch`=$finish_width_in_inch and 
								`standard_for_which_process`='$standard_for_which_process' and   
								`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
								`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
	
    $select_sql_max_primary_key="select MAX(max_report_serial_no) as max_report_serial_no FROM (select CONVERT(substring(report_serial_no,4,LENGTH(report_serial_no)),UNSIGNED) as max_report_serial_no from qc_result_for_dyeing_finish_process) as temp_qc_result_for_dyeing_finish_process_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_report_serial_no']+1;

    if($row_for_max_primary_key['max_report_serial_no']==0)
    {

    	$current_report_serial_no='FR_1';

    }
    else
    {

    	$current_report_serial_no ="FR_".($row_for_max_primary_key['max_report_serial_no']+1);

    }

	$insert_sql_statement="insert into `qc_result_for_dyeing_finish_process` 
	( 
	`pp_number`,
	`version_number`,
	`customer_name`,
	`color`,
	`finish_width_in_inch`,
	`standard_for_which_process`,
	`date`,
	`before_trolley_number_or_batcher_number`,
	`after_trolley_number_or_batcher_number`,
	`short_or_excess_in_percentage`,
	`total_quantity_in_meter`,
	`machine_name`,

	`cf_to_rubbing_dry_value`,
	`uom_of_cf_to_rubbing_dry`,

	`cf_to_rubbing_wet_value`,
	`uom_of_cf_to_rubbing_wet`,

	`dimensional_stability_to_warp_washing_before_iron_value`,
	`uom_of_dimensional_stability_to_warp_washing_before_iron`,

	`dimensional_stability_to_weft_washing_before_iron_value`,
	`uom_of_dimensional_stability_to_weft_washing_before_iron`,

	`dimensional_stability_to_warp_washing_after_iron_value`,
	`uom_of_dimensional_stability_to_warp_washing_after_iron`,

	`dimensional_stability_to_weft_washing_after_iron_value`,
	`uom_of_dimensional_stability_to_weft_washing_after_iron`,

	`warp_yarn_count_value`,
	`uom_of_warp_yarn_count`,

	`weft_yarn_count_value`,
	`uom_of_weft_yarn_count`,

	`no_of_threads_in_warp_value`,
	`uom_of_no_of_threads_in_warp`,


	`mass_per_unit_per_area_value`,
	`uom_of_mass_per_unit_per_area`,
	
	`no_of_threads_in_weft_value`,
	`uom_of_no_of_threads_in_weft`,


	`surface_fuzzing_and_pilling_value`,
	`uom_of_surface_fuzzing_and_pilling`,

	`tensile_properties_in_warp_value`,
	`uom_of_tensile_properties_in_warp`,

	`tensile_properties_in_weft_value`,
	`uom_of_tensile_properties_in_weft`,

	`tear_force_in_warp_value`,
	`uom_of_tear_force_in_warp`,

	`tear_force_in_weft_value`,
	`uom_of_tear_force_in_weft`,

	`seam_slippage_resistance_in_warp_value`,
	`uom_of_seam_slippage_resistance_in_warp`,

	`seam_slippage_resistance_in_weft_value`,
	`uom_of_seam_slippage_resistance_in_weft`,

	`seam_slippage_resistance_iso_2_in_warp_value`,
	`uom_of_seam_slippage_resistance_iso_2_in_warp`,



	`seam_slippage_resistance_iso_2_in_weft_value`,
	`uom_of_seam_slippage_resistance_iso_2_in_weft`,

	`seam_strength_in_warp_value`,
	`uom_of_seam_strength_in_warp`,

	`seam_strength_in_weft_value`,
	`uom_of_seam_strength_in_weft`,

	`seam_properties_seam_slippage_iso_astm_d_in_warp_value`,
	`uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp`,

	`seam_properties_seam_slippage_iso_astm_d_in_weft_value`,
	`uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft`,

	`seam_properties_seam_strength_iso_astm_d_in_warp_value`,
	`uom_of_seam_properties_seam_strength_iso_astm_d_in_warp`,

	`seam_properties_seam_strength_iso_astm_d_in_weft_value`,
	`uom_of_seam_properties_seam_strength_iso_astm_d_in_weft`,

	`abrasion_resistance_no_of_thread_break_value`,
	`uom_of_abrasion_resistance_no_of_thread_break`,

	`abrasion_resistance_c_change_value`,
	`uom_of_abrasion_resistance_c_change`,

	`mass_loss_in_abrasion_value`,
	`uom_of_mass_loss_in_abrasion`,

	`cf_to_washing_color_change_value`,
	`uom_of_cf_to_washing_color_change`,

	`cf_to_washing_staining_value`,
	`uom_of_cf_to_washing_staining`,

	`cf_to_washing_cross_staining_value`,
	`uom_of_cf_to_washing_cross_staining`,

	`cf_to_dry_cleaning_color_change_value`,
	`uom_of_cf_to_dry_cleaning_color_change`,

	`cf_to_dry_cleaning_staining_value`,
	`uom_of_cf_to_dry_cleaning_staining`,

	`cf_to_perspiration_acid_color_change_value`,
	`uom_of_cf_to_perspiration_acid_color_change`,

	`cf_to_perspiration_acid_staining_value`,
	`uom_of_cf_to_perspiration_acid_staining`,

	`cf_to_perspiration_acid_cross_staining_value`,
	`uom_of_cf_to_perspiration_acid_cross_staining`,

	`cf_to_perspiration_alkali_color_change_value`,
	`uom_of_cf_to_perspiration_alkali_color_change`,

	`cf_to_perspiration_alkali_staining_value`,
	`uom_of_cf_to_perspiration_alkali_staining`,

	`cf_to_perspiration_alkali_cross_staining_value`,
	`uom_of_cf_to_perspiration_alkali_cross_staining`,

	`cf_to_water_color_change_value`,
	`uom_of_cf_to_water_color_change`,

	`cf_to_water_staining_value`,
	`uom_of_cf_to_water_staining`,

	`cf_to_water_cross_staining_value`,
	`uom_of_cf_to_water_cross_staining`,

	`cf_to_water_spotting_surface_value`,
	`uom_of_cf_to_water_spotting_surface`,

	`cf_to_water_spotting_edge_value`,
	`uom_of_cf_to_water_spotting_edge`,

	`cf_to_water_spotting_cross_staining_value`,
	`uom_of_cf_to_water_spotting_cross_staining`,

	`resistance_to_surface_wetting_before_wash_value`,
	`uom_of_resistance_to_surface_wetting_before_wash`,

	`resistance_to_surface_wetting_after_one_wash_value`,
	`uom_of_resistance_to_surface_wetting_after_one_wash`,

	`resistance_to_surface_wetting_after_five_wash_value`,
	`uom_of_resistance_to_surface_wetting_after_five_wash`,

	`cf_to_hydrolysis_of_reactive_dyes_color_change_value`,
	`uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change`,

	`cf_to_oxidative_bleach_damage_color_change_value`,
	`uom_of_cf_to_oxidative_bleach_damage_color_change`,

	`cf_to_oxidative_bleach_damage_value`,
	`uom_of_cf_to_oxidative_bleach_damage`,

	`cf_to_phenolic_yellowing_staining_value`,
	`uom_of_cf_to_phenolic_yellowing_staining`,

	`cf_to_pvc_migration_staining_value`,
	`uom_of_cf_to_pvc_migration_staining`,

	`cf_to_saliva_color_change_value`,
	`uom_of_cf_to_saliva_color_change`,

	`cf_to_saliva_staining_value`,
	`uom_of_cf_to_saliva_staining`,

	`cf_to_chlorinated_water_color_change_change_value`,
	`uom_of_cf_to_chlorinated_water_color_change_change`,

	`cf_to_cholorine_bleach_color_change_value`,
	`uom_of_cf_to_cholorine_bleach_color_change`,

	`cross_staining_value`,
	`uom_of_cross_staining`,

	`formaldehyde_content_value`,
	`uom_of_formaldehyde_content`,

	`ph_value`,
	`uom_of_ph`,

	`water_absorption_value`,
	`uom_of_water_absorption`,

	`water_absorption_b_wash_thirty_sec_value`,
	`uom_of_water_absorption_b_wash_thirty_sec`,


	`water_absorption_b_wash_max_value`,
	`uom_of_water_absorption_b_wash_max`,

	`water_absorption_a_wash_thirty_sec_value`,
	`uom_of_water_absorption_a_wash_thirty_sec`,

	`spirality_value`,
	`uom_of_spirality`,

	`smoothness_appearance_value`,
	`uom_of_smoothness_appearance`,

	`print_durability_value`,
	`uom_of_print_durability`,

	iron_ability_of_woven_fabric_value,
	uom_of_iron_ability_of_woven_fabric,

	`cf_to_artificial_day_light_value`,
	`uom_of_cf_to_artificial_day_light`,
	cf_to_light_shade_color_1,
	cf_to_light_shade_color_1_value,
	cf_to_light_shade_color_2,
	cf_to_light_shade_color_2_value,
	cf_to_light_shade_color_3,
	cf_to_light_shade_color_3_value,
	cf_to_light_shade_color_4,
	cf_to_light_shade_color_4_value,
	cf_to_light_shade_color_5,
	cf_to_light_shade_color_5_value,
	cf_to_light_shade_color_6,
	cf_to_light_shade_color_6_value,
	cf_to_light_shade_color_7,
	cf_to_light_shade_color_7_value,

	`moisture_content_value`,
	`uom_of_moisture_content`,

	`evaporation_rate_quick_drying_value`,
	`uom_of_evaporation_rate_quick_drying`,

	`total_cotton_content_value`,
	`uom_of_total_cotton_content`,

	`total_total_Polyester_content_value`,
	`uom_of_total_total_Polyester_content`,

	`total_other_fiber_value`,
	`uom_of_total_other_fiber`,

	`warp_cotton_content_value`,
	`uom_of_warp_cotton_content`,

	`warp_Polyester_content_value`,
	`uom_of_warp_Polyester_content`,

	`warp_other_fiber_value`,
	`uom_of_warp_other_fiber`,

	`weft_cotton_content_value`,
	`uom_of_weft_cotton_content`,

	`weft_Polyester_content_value`,
	`uom_of_weft_Polyester_content`,

	`weft_other_fiber_value`,
	`uom_of_weft_other_fiber`,

	test_method_for_appearance_after_wash,
	appearance_after_washing_cycle_fabric_wash,

	test_method_for_appear_after_wash_fabric_color_change,
	appear_after_wash_fabric_color_change_value,
	uom_of_appearance_after_washing_fabric_color_change,

	test_method_for_appear_after_washing_fabric_cross_staining,
	appearance_after_washing_fabric_cross_staining_value,
	uom_of_appearance_after_washing_fabric_cross_staining,

	test_method_for_appear_after_wash_fabric_surface_fuzzing,
	appearance_after_washing_fabric_surface_fuzzing_value,
	uom_of_appearance_after_washing_fabric_surface_fuzzing,

	test_method_for_appear_after_wash_fabric_surface_pilling,
	appearance_after_washing_fabric_surface_pilling_value,
	uom_of_appearance_after_washing_fabric_surface_pilling,

	test_method_for_appear_after_wash_fabric_crease_before_iron,
	appearance_after_washing_fabric_crease_before_ironing_value,
	uom_of_appearance_after_wash_fabric_crease_before_ironing,

	test_method_for_appear_after_wash_fabric_crease_after_iron,
	appearance_after_washing_fabric_crease_after_ironing_value,
	uom_of_appear_after_washing_fabric_crease_after_ironing,

	test_method_for_appear_after_wash_fabric_loss_of_print,
	appearance_after_washing_fabric_loss_of_print_value,
	uom_of_appearance_after_washing_fabric_loss_of_print,

	test_method_for_appear_after_wash_fabric_abrasive_mark,
	appearance_after_washing_fabric_abrasive_mark_value,
	uom_of_appearance_after_washing_fabric_abrasive_mark,

	test_method_for_appearance_after_washing_fabric_odor,
	appearance_after_washing_fabric_odor_value,
	uom_of_appearance_after_washing_fabric_odor,
	appearance_after_washing_other_observation_fabric,

	appearance_after_washing_cycle_garments_wash,

	test_method_for_appear_after_wash_garment_color_change_witho_sup,
	appear_after_wash_garments_color_change_without_sup_value,
	uom_of_appear_after_wash_garments_color_change_without_supp,

	test_method_for_appear_after_wash_garments_color_change_with_sup,
	appear_after_wash_garments_color_change_with_sup_value,
	uom_of_appear_after_wash_garments_color_change_with_sup,

	test_method_for_appearance_after_washing_garments_cross_staining,
	appearance_after_washing_garments_cross_staining_value,
	uom_of_appearance_after_washing_garments_cross_staining,

	test_method_for_appear_after_wash_garments_differential_shrink,
	appearance_after_washing_garments_differential_shrinkage_value,
	uom_of_appearance_after_washing_garments_differential_shrinkage,

	test_method_for_appear_after_washing_garments_surface_fuzzing,
	appearance_after_washing_garments_surface_fuzzing_value,
	uom_of_appearance_after_washing_garments_surface_fuzzing,

	test_method_for_appear_after_washing_garments_surface_pilling,
	appearance_after_washing_garments_surface_pilling_value,
	uom_of_appearance_after_washing_garments_surface_pilling,

	test_method_for_appear_after_wash_garments_crease_after_ironing,
	appearance_after_washing_garments_crease_after_ironing_value,
	uom_of_appearance_after_washing_garments_crease_after_ironing,

	test_method_for_appearance_after_washing_garments_abrasive_mark,
	appearance_after_washing_garments_abrasive_mark_value,
	uom_of_appearance_after_washing_garments_abrasive_mark,

	test_method_for_appearance_after_washing_garments_seam_breakdown,
	appearance_after_washing_garments_seam_breakdown_value,
	uom_of_appearance_after_washing_garments_seam_breakdown,

	test_method_for_appearance_after_washing_garments_seam_puckering,
	appearance_after_washing_garments_seam_puckering_roping_after_ir,
	uom_of_appearance_after_washing_garments_seam_puckering_roping_a,

	test_method_for_appear_after_wash_garment_detachment_interlining,
	appearance_after_washing_garments_detachment_of_interlining_valu,
	uom_of_appearance_after_washing_garments_detachment_of_interlini,

	test_method_for_appearance_after_washing_garment_change_handle,
	appearance_after_washing_garments_change_in_handle_value,
	uom_of_appearance_after_washing_garments_change_in_handle_or_app,

	test_method_for_appear_after_wash_garments_effect_accessories,
	appearance_after_washing_garments_effect_accessories_value,
	uom_of_appearance_after_washing_garments_effect_accessories,

	test_method_for_appearance_after_washing_garments_spiralitys,
	appearance_after_washing_garments_spirality_value,
	uom_of_appearance_after_washing_garments_spirality,

	test_method_for_appear_after_wash_garments_detachment_fraying_ri,
	appearance_after_washing_garments_detachment_or_fraying_of_ribbo,
	uom_of_appearance_after_washing_garments_detachment_or_fraying,

	test_method_for_appearance_after_washing_garments_loss_of_print,
	appearance_after_washing_garments_loss_of_print_value,
	uom_of_appearance_after_washing_garments_loss_of_print,

	test_method_for_appearance_after_washing_garments_care_level,
	appearance_after_washing_garments_care_level_value,
	uom_of_appearance_after_washing_garments_care_level,

	test_method_for_appearance_after_washing_garments_odor,
	appearance_after_washing_garments_odor_value,
	uom_of_appearance_after_washing_garments_odor,
	appearance_after_washing_other_observation_garments,

	`cf_to_washing_staining_value_for_acetate`,
	`cf_to_washing_staining_value_for_cotton`,
	 cf_to_washing_staining_value_for_mylon,
	`cf_to_washing_staining_value_for_polyester`,
	`cf_to_washing_staining_value_for_acrylic`,
	`cf_to_washing_staining_value_for_wool`,

	`cf_to_dry_cleaning_staining_value_for_acetate`,
	`cf_to_dry_cleaning_staining_value_for_cotton`,
	`cf_to_dry_cleaning_staining_value_for_mylon`,
	`cf_to_dry_cleaning_staining_value_for_polyester`,
	`cf_to_dry_cleaning_staining_value_for_acrylic`,
	`cf_to_dry_cleaning_staining_value_for_wool`, 

	 cf_to_perspiration_acid_staining_value_for_acetate,
	`cf_to_perspiration_acid_staining_value_for_cotton`,
	`cf_to_perspiration_acid_staining_value_for_mylon`,
	`cf_to_perspiration_acid_staining_value_for_polyester`,
	 cf_to_perspiration_acid_staining_value_for_acrylic,
	`cf_to_perspiration_acid_staining_value_for_wool`, 

	`cf_to_perspiration_alkali_staining_value_for_acetate`,
	`cf_to_perspiration_alkali_staining_value_for_cotton`,
	`cf_to_perspiration_alkali_staining_value_for_mylon`,
	`cf_to_perspiration_alkali_staining_value_for_polyester`,
	`cf_to_perspiration_alkali_staining_value_for_acrylic`,
	`cf_to_perspiration_alkali_staining_value_for_wool`, 

	`cf_to_water_staining_value_for_acetate`,
	`cf_to_water_staining_value_for_cotton`,
	`cf_to_water_staining_value_for_mylon`,
	`cf_to_water_staining_value_for_polyester`,
	`cf_to_water_staining_value_for_acrylic`,
	`cf_to_water_staining_value_for_wool`,

	`cf_to_saliva_staining_value_for_acetate`,
	`cf_to_saliva_staining_value_for_cotton`,
	`cf_to_saliva_staining_value_for_mylon`,
	`cf_to_saliva_staining_value_for_polyester`,
	`cf_to_saliva_staining_value_for_acrylic`,
	`cf_to_saliva_staining_value_for_wool`,

	`status`,
	`remarks`,
	`recording_person_id`,
	`recording_person_name`,
	`recording_time`,
	`version_id`,
	`customer_id`,
	`report_serial_no`,
    `current_state` 
     ) values (

     '$pp_number',
     '$version_number',
     '$customer_name',
     '$color',
     '$finish_width_in_inch',
     '$standard_for_which_process',
     '$date',
     '$before_trolley_number_or_batcher_number',
     '$after_trolley_number_or_batcher_number',
     '$short_or_excess_in_percentage',
     '$total_quantity_in_meter',
     '$machine_name',

     '$cf_to_rubbing_dry_value',
     '$uom_of_cf_to_rubbing_dry',

     '$cf_to_rubbing_wet_value',
     '$uom_of_cf_to_rubbing_wet',

     '$dimensional_stability_to_warp_washing_before_iron_value',
     '$uom_of_dimensional_stability_to_warp_washing_before_iron',

     '$dimensional_stability_to_weft_washing_before_iron_value',
	 '$uom_of_dimensional_stability_to_weft_washing_before_iron',

     '$dimensional_stability_to_warp_washing_after_iron_value',
     '$uom_of_dimensional_stability_to_warp_washing_after_iron',

     '$dimensional_stability_to_weft_washing_after_iron_value',
     '$uom_of_dimensional_stability_to_weft_washing_after_iron',

     '$warp_yarn_count_value',
     '$uom_of_warp_yarn_count',

     '$weft_yarn_count_value',
     '$uom_of_weft_yarn_count',

     '$no_of_threads_in_warp_value',
     '$uom_of_no_of_threads_in_warp',
     
     '$mass_per_unit_per_area_value',
     '$uom_of_mass_per_unit_per_area',
     
     '$no_of_threads_in_weft_value',
     '$uom_of_no_of_threads_in_weft',


     '$surface_fuzzing_and_pilling_value',
     '$uom_of_surface_fuzzing_and_pilling',

     '$tensile_properties_in_warp_value',
     '$uom_of_tensile_properties_in_warp',

     '$tensile_properties_in_weft_value',
     '$uom_of_tensile_properties_in_weft',

     '$tear_force_in_warp_value',
     '$uom_of_tear_force_in_warp',

     '$tear_force_in_weft_value',
     '$uom_of_tear_force_in_weft',

     '$seam_slippage_resistance_in_warp_value',
     '$uom_of_seam_slippage_resistance_in_warp',
     

     '$seam_slippage_resistance_in_weft_value',
     '$uom_of_seam_slippage_resistance_in_weft',

     '$seam_slippage_resistance_iso_2_in_warp_value',
     '$uom_of_seam_slippage_resistance_iso_2_in_warp',



     '$seam_slippage_resistance_iso_2_in_weft_value',
     '$uom_of_seam_slippage_resistance_iso_2_in_weft',

     '$seam_strength_in_warp_value',
     '$uom_of_seam_strength_in_warp',

     '$seam_strength_in_weft_value',
     '$uom_of_seam_strength_in_weft',

     '$seam_properties_seam_slippage_iso_astm_d_in_warp_value',
     '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp',

     '$seam_properties_seam_slippage_iso_astm_d_in_weft_value',
     '$uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft',

     '$seam_properties_seam_strength_iso_astm_d_in_warp_value',
     '$uom_of_seam_properties_seam_strength_iso_astm_d_in_warp',

     '$seam_properties_seam_strength_iso_astm_d_in_weft_value',
     '$uom_of_seam_properties_seam_strength_iso_astm_d_in_weft',

     '$abrasion_resistance_no_of_thread_break_value',
     '$uom_of_abrasion_resistance_no_of_thread_break',

     '$abrasion_resistance_c_change_value',
     '$uom_of_abrasion_resistance_c_change',

     '$mass_loss_in_abrasion_value',
     '$uom_of_mass_loss_in_abrasion',

     '$cf_to_washing_color_change_value',
     '$uom_of_cf_to_washing_color_change',

     '$cf_to_washing_staining_value',
     '$uom_of_cf_to_washing_staining',

     '$cf_to_washing_cross_staining_value',
     '$uom_of_cf_to_washing_cross_staining',

     '$cf_to_dry_cleaning_color_change_value',
     '$uom_of_cf_to_dry_cleaning_color_change',

     '$cf_to_dry_cleaning_staining_value',
     '$uom_of_cf_to_dry_cleaning_staining',

     '$cf_to_perspiration_acid_color_change_value',
     '$uom_of_cf_to_perspiration_acid_color_change',

     '$cf_to_perspiration_acid_staining_value',
     '$uom_of_cf_to_perspiration_acid_staining',

     '$cf_to_perspiration_acid_cross_staining_value',
     '$uom_of_cf_to_perspiration_acid_cross_staining',

     '$cf_to_perspiration_alkali_color_change_value',
     '$uom_of_cf_to_perspiration_alkali_color_change',

     '$cf_to_perspiration_alkali_staining_value',
     '$uom_of_cf_to_perspiration_alkali_staining',

     '$cf_to_perspiration_alkali_cross_staining_value',
     '$uom_of_cf_to_perspiration_alkali_cross_staining',

     '$cf_to_water_color_change_value',
     '$uom_of_cf_to_water_color_change',

     '$cf_to_water_staining_value',
     '$uom_of_cf_to_water_staining',

     '$cf_to_water_cross_staining_value',
     '$uom_of_cf_to_water_cross_staining',

     '$cf_to_water_spotting_surface_value',
     '$uom_of_cf_to_water_spotting_surface',

     '$cf_to_water_spotting_edge_value',
     '$uom_of_cf_to_water_spotting_edge',

     '$cf_to_water_spotting_cross_staining_value',
     '$uom_of_cf_to_water_spotting_cross_staining',

     '$resistance_to_surface_wetting_before_wash_value',
     '$uom_of_resistance_to_surface_wetting_before_wash',

     '$resistance_to_surface_wetting_after_one_wash_value',
     '$uom_of_resistance_to_surface_wetting_after_one_wash',

     '$resistance_to_surface_wetting_after_five_wash_value',
     '$uom_of_resistance_to_surface_wetting_after_five_wash',

     '$cf_to_hydrolysis_of_reactive_dyes_color_change_value',
     '$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change',

     '$cf_to_oxidative_bleach_damage_color_change_value',
     '$uom_of_cf_to_oxidative_bleach_damage_color_change',

     '$cf_to_oxidative_bleach_damage_value',
     '$uom_of_cf_to_oxidative_bleach_damage',

     '$cf_to_phenolic_yellowing_staining_value',
     '$uom_of_cf_to_phenolic_yellowing_staining',

     '$cf_to_pvc_migration_staining_value',
     '$uom_of_cf_to_pvc_migration_staining',

     '$cf_to_saliva_color_change_value',
     '$uom_of_cf_to_saliva_color_change',

     '$cf_to_saliva_staining_value',
     '$uom_of_cf_to_saliva_staining',

     '$cf_to_chlorinated_water_color_change_change_value',
     '$uom_of_cf_to_chlorinated_water_color_change_change',

     '$cf_to_cholorine_bleach_color_change_value',
     '$uom_of_cf_to_cholorine_bleach_color_change',

     '$cross_staining_value',
     '$uom_of_cross_staining',

     '$formaldehyde_content_value',
     '$uom_of_formaldehyde_content',

     '$ph_value',
     '$uom_of_ph',

     '$water_absorption_value',
     '$uom_of_water_absorption',

     '$water_absorption_b_wash_thirty_sec_value',
     '$uom_of_water_absorption_b_wash_thirty_sec',

     '$water_absorption_b_wash_max_value',
     '$uom_of_water_absorption_b_wash_max',

     '$water_absorption_a_wash_thirty_sec_value',
     '$uom_of_water_absorption_a_wash_thirty_sec',

     '$spirality_value',
     '$uom_of_spirality',

     '$smoothness_appearance_value',
     '$uom_of_smoothness_appearance',

	 '$print_durability_value',
	 '$uom_of_print_durability',

	 '$iron_ability_of_woven_fabric_value',
	 '$uom_of_iron_ability_of_woven_fabric',

	 '$cf_to_artificial_day_light_value',
	 '$uom_of_cf_to_artificial_day_light',
	 '$cf_to_light_shade_color_1',
	 '$cf_to_light_shade_color_1_value',
	 '$cf_to_light_shade_color_2',
	 '$cf_to_light_shade_color_2_value',
	 '$cf_to_light_shade_color_3',
	 '$cf_to_light_shade_color_3_value',
	 '$cf_to_light_shade_color_4',
	 '$cf_to_light_shade_color_4_value',
	 '$cf_to_light_shade_color_5',
	 '$cf_to_light_shade_color_5_value',
	 '$cf_to_light_shade_color_6',
	 '$cf_to_light_shade_color_6_value',
	 '$cf_to_light_shade_color_7',
	 '$cf_to_light_shade_color_7_value',

	 '$moisture_content_value',
	 '$uom_of_moisture_content',

	 '$evaporation_rate_quick_drying_value',
	 '$uom_of_evaporation_rate_quick_drying',

	 '$total_cotton_content_value',
	 '$uom_of_total_cotton_content',

	 '$total_total_Polyester_content_value',
	 '$uom_of_total_total_Polyester_content',

	 '$total_other_fiber_value',
	 '$uom_of_total_other_fiber',

	 '$warp_cotton_content_value',
	 '$uom_of_warp_cotton_content',

	 '$warp_Polyester_content_value',
	 '$uom_of_warp_Polyester_content',
	
	 '$warp_other_fiber_value',
	 '$uom_of_warp_other_fiber',

	 '$weft_cotton_content_value',
	 '$uom_of_weft_cotton_content',

	 '$weft_Polyester_content_value',
	 '$uom_of_weft_Polyester_content',

	 '$weft_other_fiber_value',
	 '$uom_of_weft_other_fiber',

	 '$appearance_after_wash_radio_button',
		'$appearance_after_wash_for_fabric_radio_button',

		'$test_method_for_appearance_after_washing_fabric_color_change',
		'$appearance_after_washing_fabric_color_change_value',
		'$uom_of_appearance_after_washing_fabric_color_change',

		'$test_method_for_appearance_after_washing_fabric_cross_staining',
		'$appearance_after_washing_fabric_cross_staining_value',
		'$uom_of_appearance_after_washing_fabric_cross_staining',

		'$test_method_for_appearance_after_washing_fabric_surface_fuzzing',
		'$appearance_after_washing_fabric_surface_fuzzing_value',
		'$uom_of_appearance_after_washing_fabric_surface_fuzzing',

		'$test_method_for_appearance_after_washing_fabric_surface_pilling',
		'$appearance_after_washing_fabric_surface_pilling_value',
		'$uom_of_appearance_after_washing_fabric_surface_pilling',

		'$test_method_for_appearance_after_washing_fabric_crease_before_ironing',
		'$appearance_after_washing_fabric_crease_before_ironing_value',
		'$uom_of_appearance_after_washing_fabric_crease_before_ironing',

		'$test_method_for_appearance_after_washing_fabric_crease_after_ironing',
		'$appearance_after_washing_fabric_crease_after_ironing_value',
		'$uom_of_appearance_after_washing_fabric_crease_after_ironing',

		'$test_method_for_appearance_after_washing_fabric_loss_of_print',
		'$appearance_after_washing_fabric_loss_of_print_value',
		'$uom_of_appearance_after_washing_fabric_loss_of_print',

		'$test_method_for_appearance_after_washing_fabric_abrasive_mark',
		'$appearance_after_washing_fabric_abrasive_mark_value',
		'$uom_of_appearance_after_washing_fabric_abrasive_mark',

		'$test_method_for_appearance_after_washing_fabric_odor',
		'$appearance_after_washing_fabric_odor_value',
		'$uom_of_appearance_after_washing_fabric_odor',
		'$appearance_after_washing_other_observation_fabric',

		'$appearance_after_wash_for_garments_radio_button',

		'$test_method_for_appearance_after_washing_garments_color_change_without_suppressor',
		'$appearance_after_washing_garments_color_change_without_suppressor_value',
		'$uom_of_appearance_after_washing_garments_color_change_without_suppressor',

		'$test_method_for_appearance_after_washing_garments_color_change_with_suppressor',
		'$appearance_after_washing_garments_color_change_with_suppressor_value',
		'$uom_of_appearance_after_washing_garments_color_change_with_suppressor',

		'$test_method_for_appearance_after_washing_garments_cross_staining',
		'$appearance_after_washing_garments_cross_staining_value',
		'$uom_of_appearance_after_washing_garments_cross_staining',

		'$test_method_for_appearance_after_washing_garments_differential_shrinkage',
		'$appearance_after_washing_garmentsdifferential_shrinkage_value',
		'$uom_of_appearance_after_washing_garments_differential_shrinkage',

		'$test_method_for_appearance_after_washing_garments_surface_fuzzing',
		'$appearance_after_washing_garments_surface_fuzzing_value',
		'$uom_of_appearance_after_washing_garments_surface_fuzzing',

		'$test_method_for_appearance_after_washing_garments_surface_pilling',
		'$appearance_after_washing_garments_surface_pilling_value',
		'$uom_of_appearance_after_washing_garments_surface_pilling',

		'$test_method_for_appearance_after_washing_garments_crease_after_ironing',
		'$appearance_after_washing_garments_crease_after_ironing_value',
		'$uom_of_appearance_after_washing_garments_crease_after_ironing',

		'$test_method_for_appearance_after_washing_garments_abrasive_mark',
		'$appearance_after_washing_garments_abrasive_mark_value',
		'$uom_of_appearance_after_washing_garments_abrasive_mark',

		'$test_method_for_appearance_after_washing_garments_seam_breakdown',
		'$appearance_after_washing_garments_seam_breakdown_value',
		'$uom_of_appearance_after_washing_garments_seam_breakdown',

		'$test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron',
		'$appearance_after_washing_garments_seam_puckering_roping_after_iron_value',
		'$uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron',

		'$test_method_for_appearance_after_washing_garments_detachment_of_interlining',
		'$appearance_after_washing_garments_detachment_of_interlining_value',
		'$uom_of_appearance_after_washing_garments_detachment_of_interlining',

		'$test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance',
		'$appearance_after_washing_garments_change_in_handle_or_appearance_value',
		'$uom_of_appearance_after_washing_garments_change_in_handle_or_appearance',

		'$test_method_for_appearance_after_washing_garments_effect_accessories',
		'$appearance_after_washing_garments_effect_accessories_value',
		'$uom_of_appearance_after_washing_garments_effect_accessories',

		'$test_method_for_appearance_after_washing_garments_spiralitys',
		'$appearance_after_washing_garments_spirality_value',
		'$uom_of_appearance_after_washing_garments_spirality',

		'$test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons',
		'$appearance_after_washing_garments_detachment_or_fraying_of_ribbons_value',
		'$uom_of_appearance_after_washing_garments_detachment_or_fraying_of_ribbons',

		'$test_method_for_appearance_after_washing_garments_loss_of_print',
		'$appearance_after_washing_garments_loss_of_print_value',
		'$uom_of_appearance_after_washing_garments_loss_of_print',

		'$test_method_for_appearance_after_washing_garments_care_level',
		'$appearance_after_washing_garments_care_level_value',
		'$uom_of_appearance_after_washing_garments_care_level',

		'$test_method_for_appearance_after_washing_garments_odor',
		'$appearance_after_washing_garments_odor_value',
		'$uom_of_appearance_after_washing_garments_odor',
		'$appearance_after_washing_other_observation_garments',

		'$acetate_cf_washing',
		'$cotton_cf_washing',
		'$mylon_cf_washing',
		'$polyester_cf_washing',
		'$acrylic_cf_washing',
		'$wool_cf_washing',
		'$acetate_cf_dry_cleaning',
		'$cotton_cf_dry_cleaning',
		'$mylon_cf_dry_cleaning',
		'$polyester_cf_dry_cleaning',
		'$acrylic_cf_dry_cleaning',
		'$wool_cf_dry_cleaning',
		'$acetate_cf_to_perspiration_acid',
		'$cotton_cf_to_perspiration_acid',
		'$mylon_cf_to_perspiration_acid',
		'$polyester_cf_to_perspiration_acid',
		'$acrylic_cf_to_perspiration_acid',
		'$wool_cf_to_perspiration_acid',

		'$acetate_cf_to_perspiration_alkali',
        '$cotton_cf_to_perspiration_alkali',
        '$mylon_cf_to_perspiration_alkali',
        '$polyester_cf_to_perspiration_alkali',
        '$acrylic_cf_to_perspiration_alkali',
        '$wool_cf_to_perspiration_alkali',
        '$acetate_cf_to_water',
        '$cotton_cf_to_water',
        '$mylon_cf_to_water',
        '$polyester_cf_to_water',
        '$acrylic_cf_to_water',
        '$wool_cf_to_water',
        '$acetate_cf_to_saliva',
        '$cotton_cf_to_saliva',
        '$mylon_cf_to_saliva',
        '$polyester_cf_to_saliva',
        '$acrylic_cf_to_saliva',
        '$wool_cf_to_saliva',

        '$status',
        '$remarks',
        '$user_id',
        '$user_name',
        NOW(),
        '$version_id',
        '$customer_id',
        '$current_report_serial_no',
        '$current_state'

       )";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
		$data_insertion_hampering = "Yes";
	}
	else
	{
		$sql_for_monitoring_dyeing_finish = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_dyeing_finish= mysqli_query($con, $sql_for_monitoring_dyeing_finish);
		$row_for_monitoring_dyeing_finish = mysqli_fetch_assoc($result_for_monitoring_dyeing_finish);
		$current_status_monitoring_san = $row_for_monitoring_dyeing_finish['current_status'];
		
		if($current_status_monitoring_san=='Dyeing-Finish Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Dyeing-Finish Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Dyeing-Finish Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Dyeing-Finish Process')
		{
			$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
		}
		else
		{
			$sql_for_process = "SELECT * FROM qc_result_for_dyeing_finish_process WHERE pp_number = '$pp_number' AND version_number = '$version_number' and finish_width_in_inch = '$finish_width_in_inch'
								and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number' 
								and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number'";
								
			$result_for_process = mysqli_query($con,$sql_for_process) or die(mysqli_error($con));
			
			if(mysqli_num_rows($result_for_process) == 1)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 2)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 3)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='2nd-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else if(mysqli_num_rows($result_for_process) == 4)
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='3rd-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			else
			{
				$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='4th-Re-Dyeing-Finish Process',`current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

				mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
			}
			
		}
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
