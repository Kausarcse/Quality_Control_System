<?php
error_reporting(0);
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
$data_insertion_hampering = "No";



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


$received_quantity_in_meter= $_POST['received_quantity_in_meter'];
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
$resistance_to_surface_wetting_before_wash_value= $_POST['resistance_to_surface_wetting_before_wash_value'];
$uom_of_resistance_to_surface_wetting_before_wash= $_POST['uom_of_resistance_to_surface_wetting_before_wash'];
$resistance_to_surface_wetting_after_one_wash_value= $_POST['resistance_to_surface_wetting_after_one_wash_value'];
$uom_of_resistance_to_surface_wetting_after_one_wash= $_POST['uom_of_resistance_to_surface_wetting_after_one_wash'];
$resistance_to_surface_wetting_after_five_wash_value= $_POST['resistance_to_surface_wetting_after_five_wash_value'];
$uom_of_resistance_to_surface_wetting_after_five_wash= $_POST['uom_of_resistance_to_surface_wetting_after_five_wash'];
$formaldehyde_content_value= $_POST['formaldehyde_content_value'];
$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];
$smoothness_appearance_value= $_POST['smoothness_appearance_value'];
$uom_of_smoothness_appearance= $_POST['uom_of_smoothness_appearance'];
$ph_value= $_POST['ph_value'];
$uom_of_ph= $_POST['uom_of_ph'];

// $test_method_for_appearance_after_wash="";
// if(!empty($_POST['test_method_for_appearance_after_wash_fabric']))
// {
//     foreach($_POST['test_method_for_appearance_after_wash_fabric'] as $test_method_for_appearance_after_wash_value)
//     {
//       $test_method_for_appearance_after_wash.= $test_method_for_appearance_after_wash_value. ",";
//     }   
// }

// $appearance_after_washing_cycle_fabric_wash="";
// if(!empty($_POST['appearance_after_washing_cycle_fabric_wash']))
// {
//     foreach($_POST['appearance_after_washing_cycle_fabric_wash'] as $appearance_after_washing_cycle_fabric_wash_value)
//     {
//       $appearance_after_washing_cycle_fabric_wash.= $appearance_after_washing_cycle_fabric_wash_value. ",";
//     }
// }


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
	$appearance_after_wash_for_garments_radio_button =$_POST['appearance_after_washing_cycle_garments_wash'];
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
//       $appearance_after_washing_cycle_garments_wash.= $appearance_after_washing_cycle_garments_wash_value. ",";
//     }
//     //  $appearance_after_washing_cycle_garments_wash.=",";
    
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

// echo $test_method_for_appearance_after_wash;
// echo $appearance_after_washing_cycle_fabric_wash;
// exit();

$status= $_POST['status'];
$remarks= $_POST['remarks'];
$current_state= $_POST['current_state'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `qc_result_for_curing_process` where 
`pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and 
`color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and 
`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
    `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and
	
    `cf_to_rubbing_dry_value`='$cf_to_rubbing_dry_value' and
	`cf_to_rubbing_wet_value`='$cf_to_rubbing_wet_value' and


	`dimensional_stability_to_warp_washing_before_iron_value`='$dimensional_stability_to_warp_washing_before_iron_value' and
	`dimensional_stability_to_weft_washing_before_iron_value`='$dimensional_stability_to_weft_washing_before_iron_value' and
	`dimensional_stability_to_warp_washing_after_iron_value`='$dimensional_stability_to_warp_washing_after_iron_value' and
	`dimensional_stability_to_weft_washing_after_iron_value`='$dimensional_stability_to_weft_washing_after_iron_value' and

	`warp_yarn_count_value`='$warp_yarn_count_value' and
	`weft_yarn_count_value`='$weft_yarn_count_value' and

	`no_of_threads_in_warp_value`='$no_of_threads_in_warp_value' and
	`no_of_threads_in_weft_value`='$no_of_threads_in_weft_value' and

	`mass_per_unit_per_area_value`='$mass_per_unit_per_area_value' and

	`surface_fuzzing_and_pilling_value`='$surface_fuzzing_and_pilling_value' and

	`tensile_properties_in_warp_value`='$tensile_properties_in_warp_value' and

	`tensile_properties_in_weft_value`='$tensile_properties_in_weft_value' and

	`tear_force_in_warp_value`='$tear_force_in_warp_value' and
	`tear_force_in_weft_value`='$tear_force_in_weft_value' and

	`resistance_to_surface_wetting_before_wash_value`='$resistance_to_surface_wetting_before_wash_value' and
	`resistance_to_surface_wetting_after_one_wash_value`='$resistance_to_surface_wetting_after_one_wash_value' and
	`resistance_to_surface_wetting_after_five_wash_value`='$resistance_to_surface_wetting_after_five_wash_value' and

	`formaldehyde_content_value`='$formaldehyde_content_value' and

	`smoothness_appearance_value`='$smoothness_appearance_value' and

	`ph_value`='$ph_value' and

  test_method_for_appearance_after_wash='$test_method_for_appearance_after_wash' and
  appearance_after_washing_cycle_fabric_wash='$appearance_after_washing_cycle_fabric_wash' and
	appear_after_wash_fabric_color_change_value='$appearance_after_washing_fabric_color_change_value' and
	appearance_after_washing_fabric_cross_staining_value='$appearance_after_washing_fabric_cross_staining_value' and
	appearance_after_washing_fabric_surface_fuzzing_value='$appearance_after_washing_fabric_surface_fuzzing_value' and
	appearance_after_washing_fabric_surface_pilling_value='$appearance_after_washing_fabric_surface_pilling_value' and
	appearance_after_washing_fabric_crease_before_ironing_value='$appearance_after_washing_fabric_crease_before_ironing_value' and
	appearance_after_washing_fabric_crease_after_ironing_value='$appearance_after_washing_fabric_crease_after_ironing_value' and
	appearance_after_washing_fabric_loss_of_print_value='$appearance_after_washing_fabric_loss_of_print_value' and
	appearance_after_washing_fabric_abrasive_mark_value='$appearance_after_washing_fabric_abrasive_mark_value' and
	appearance_after_washing_fabric_odor_value='$appearance_after_washing_fabric_odor_value' and
	appearance_after_washing_other_observation_fabric = '$appearance_after_washing_other_observation_fabric' and

  	appearance_after_washing_cycle_garments_wash='$appearance_after_washing_cycle_garments_wash' and
	appear_after_wash_garments_color_change_without_sup_value='$appearance_after_washing_garments_color_change_without_suppressor_value' and
	appear_after_wash_garments_color_change_with_sup_value='$appearance_after_washing_garments_color_change_with_suppressor_value' and
	appearance_after_washing_garments_cross_staining_value='$appearance_after_washing_garments_cross_staining_value' and
	appearance_after_washing_garments_differential_shrinkage_value='$appearance_after_washing_garmentsdifferential_shrinkage_value' and
	appearance_after_washing_garments_surface_fuzzing_value='$appearance_after_washing_garments_surface_fuzzing_value' and
	appearance_after_washing_garments_surface_pilling_value='$appearance_after_washing_garments_surface_pilling_value' and
	appearance_after_washing_garments_crease_after_ironing_value='$appearance_after_washing_garments_crease_after_ironing_value' and
	appearance_after_washing_garments_abrasive_mark_value='$appearance_after_washing_garments_abrasive_mark_value' and
	appearance_after_washing_garments_seam_breakdown_value='$appearance_after_washing_garments_seam_breakdown_value' and
	appearance_after_washing_garments_seam_puckering_roping_after_ir='$appearance_after_washing_garments_seam_puckering_roping_after_iron_value' and
	appearance_after_washing_garments_detachment_of_interlining_valu='$appearance_after_washing_garments_detachment_of_interlining_value' and
	appearance_after_washing_garments_change_in_handle_value='$appearance_after_washing_garments_change_in_handle_or_appearance_value' and
	appearance_after_washing_garments_effect_accessories_value='$appearance_after_washing_garments_effect_accessories_value' and
	appearance_after_washing_garments_spirality_value='$appearance_after_washing_garments_spirality_value' and
	appearance_after_washing_garments_detachment_or_fraying_of_ribbo='$appearance_after_washing_garments_detachment_or_fraying_of_ribbons_value' and
	appearance_after_washing_garments_loss_of_print_value='$appearance_after_washing_garments_loss_of_print_value' and
	appearance_after_washing_garments_care_level_value='$appearance_after_washing_garments_care_level_value' and
	appearance_after_washing_garments_odor_value='$appearance_after_washing_garments_odor_value' and 
	appearance_after_washing_other_observation_garments = '$appearance_after_washing_other_observation_garments' and 
	current_state='$current_state' and status= '$status' and remarks='$remarks' and  `date`='$date' ";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if(mysqli_num_rows($result) < 1)
{
    $update_sql_statement="UPDATE `qc_result_for_curing_process` SET 
        `cf_to_rubbing_dry_value`='$cf_to_rubbing_dry_value',
        `cf_to_rubbing_wet_value`='$cf_to_rubbing_wet_value',

        `dimensional_stability_to_warp_washing_before_iron_value`='$dimensional_stability_to_warp_washing_before_iron_value',
        `dimensional_stability_to_weft_washing_before_iron_value`='$dimensional_stability_to_weft_washing_before_iron_value',
        `dimensional_stability_to_warp_washing_after_iron_value`='$dimensional_stability_to_warp_washing_after_iron_value',
        `dimensional_stability_to_weft_washing_after_iron_value`='$dimensional_stability_to_weft_washing_after_iron_value',

        `warp_yarn_count_value`='$warp_yarn_count_value',
        `weft_yarn_count_value`='$weft_yarn_count_value',

        `no_of_threads_in_warp_value`='$no_of_threads_in_warp_value',
        `no_of_threads_in_weft_value`='$no_of_threads_in_weft_value',

        `mass_per_unit_per_area_value`='$mass_per_unit_per_area_value',

        `surface_fuzzing_and_pilling_value`='$surface_fuzzing_and_pilling_value',

        `tensile_properties_in_warp_value`='$tensile_properties_in_warp_value',

        `tensile_properties_in_weft_value`='$tensile_properties_in_weft_value',

        `tear_force_in_warp_value`='$tear_force_in_warp_value',
        `tear_force_in_weft_value`='$tear_force_in_weft_value',

        `resistance_to_surface_wetting_before_wash_value`='$resistance_to_surface_wetting_before_wash_value',
        `resistance_to_surface_wetting_after_one_wash_value`='$resistance_to_surface_wetting_after_one_wash_value',
        `resistance_to_surface_wetting_after_five_wash_value`='$resistance_to_surface_wetting_after_five_wash_value',

        `formaldehyde_content_value`='$formaldehyde_content_value',

        `smoothness_appearance_value`='$smoothness_appearance_value',

        `ph_value`='$ph_value',
        test_method_for_appearance_after_wash='$appearance_after_wash_radio_button',
        appearance_after_washing_cycle_fabric_wash='$appearance_after_wash_for_fabric_radio_button',
        appear_after_wash_fabric_color_change_value='$appearance_after_washing_fabric_color_change_value',
        appearance_after_washing_fabric_cross_staining_value='$appearance_after_washing_fabric_cross_staining_value',
        appearance_after_washing_fabric_surface_fuzzing_value='$appearance_after_washing_fabric_surface_fuzzing_value',
        appearance_after_washing_fabric_surface_pilling_value='$appearance_after_washing_fabric_surface_pilling_value',
        appearance_after_washing_fabric_crease_before_ironing_value='$appearance_after_washing_fabric_crease_before_ironing_value',
        appearance_after_washing_fabric_crease_after_ironing_value='$appearance_after_washing_fabric_crease_after_ironing_value',
        appearance_after_washing_fabric_loss_of_print_value='$appearance_after_washing_fabric_loss_of_print_value',
        appearance_after_washing_fabric_abrasive_mark_value='$appearance_after_washing_fabric_abrasive_mark_value',
        appearance_after_washing_fabric_odor_value='$appearance_after_washing_fabric_odor_value',
		appearance_after_washing_other_observation_fabric = '$appearance_after_washing_other_observation_fabric', 

        appearance_after_washing_cycle_garments_wash='$appearance_after_wash_for_garments_radio_button',
        appear_after_wash_garments_color_change_without_sup_value='$appearance_after_washing_garments_color_change_without_suppressor_value',
        appear_after_wash_garments_color_change_with_sup_value='$appearance_after_washing_garments_color_change_with_suppressor_value',
        appearance_after_washing_garments_cross_staining_value='$appearance_after_washing_garments_cross_staining_value',
        appearance_after_washing_garments_differential_shrinkage_value='$appearance_after_washing_garmentsdifferential_shrinkage_value',
        appearance_after_washing_garments_surface_fuzzing_value='$appearance_after_washing_garments_surface_fuzzing_value',
        appearance_after_washing_garments_surface_pilling_value='$appearance_after_washing_garments_surface_pilling_value',
        appearance_after_washing_garments_crease_after_ironing_value='$appearance_after_washing_garments_crease_after_ironing_value',
        appearance_after_washing_garments_abrasive_mark_value='$appearance_after_washing_garments_abrasive_mark_value',
        appearance_after_washing_garments_seam_breakdown_value='$appearance_after_washing_garments_seam_breakdown_value',
        appearance_after_washing_garments_seam_puckering_roping_after_ir='$appearance_after_washing_garments_seam_puckering_roping_after_iron_value',
        appearance_after_washing_garments_detachment_of_interlining_valu='$appearance_after_washing_garments_detachment_of_interlining_value',
        appearance_after_washing_garments_change_in_handle_value='$appearance_after_washing_garments_change_in_handle_or_appearance_value',
        appearance_after_washing_garments_effect_accessories_value='$appearance_after_washing_garments_effect_accessories_value',
        appearance_after_washing_garments_spirality_value='$appearance_after_washing_garments_spirality_value',
        appearance_after_washing_garments_detachment_or_fraying_of_ribbo='$appearance_after_washing_garments_detachment_or_fraying_of_ribbons_value',
        appearance_after_washing_garments_loss_of_print_value='$appearance_after_washing_garments_loss_of_print_value',
        appearance_after_washing_garments_care_level_value='$appearance_after_washing_garments_care_level_value',
        appearance_after_washing_garments_odor_value='$appearance_after_washing_garments_odor_value',
		appearance_after_washing_other_observation_garments = '$appearance_after_washing_other_observation_garments',
		current_state='$current_state', `status`= '$status', remarks='$remarks', recording_time=NOW()
        WHERE 
        `pp_number`='$pp_number' and 
        `version_number`='$version_number' and 
        `customer_name`='$customer_name' and 
        `color`='$color' and 
        `finish_width_in_inch`=$finish_width_in_inch and 
        `standard_for_which_process`='$standard_for_which_process' and
	`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and 
    `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
       
  
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
  else
	{
		$sql_for_monitoring_curing = "SELECT * FROM pp_monitoring WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";
		$result_for_monitoring_curing= mysqli_query($con, $sql_for_monitoring_curing);
		$row_for_monitoring_curing = mysqli_fetch_assoc($result_for_monitoring_curing);
		$current_status_monitoring_san = $row_for_monitoring_curing['current_status'];
		
		if($current_status_monitoring_san=='Curing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='Re-Curing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='2nd-Re-Curing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else if($current_status_monitoring_san=='3rd-Re-Curing Process')
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
		}
		else
		{
			$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET `current_state`='$current_state' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

			mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
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
	echo "Data is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully updated.";

}

$obj->disconnection();

?>