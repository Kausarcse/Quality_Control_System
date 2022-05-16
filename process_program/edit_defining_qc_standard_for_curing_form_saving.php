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



$pp_number= $_POST['pp_number'];
$version_number= $_POST['version_number'];

$customer_name= $_POST['customer_name'];
$customer_id= $_POST['customer_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];


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


$test_method_formaldehyde_content= $_POST['test_method_formaldehyde_content'];
$formaldehyde_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['formaldehyde_content_tolerance_range_math_operator'])));
$formaldehyde_content_tolerance_value= $_POST['formaldehyde_content_tolerance_value'];
$formaldehyde_content_min_value= $_POST['formaldehyde_content_min_value'];
$formaldehyde_content_max_value= $_POST['formaldehyde_content_max_value'];
$uom_of_formaldehyde_content= $_POST['uom_of_formaldehyde_content'];


$test_method_for_ph= $_POST['test_method_for_ph'];
$ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['ph_value_tolerance_range_math_operator'])));
$ph_value_tolerance_value= $_POST['ph_value_tolerance_value'];
$ph_value_min_value= $_POST['ph_value_min_value'];
$ph_value_max_value= $_POST['ph_value_max_value'];
$uom_of_ph_value= $_POST['uom_of_ph_value'];


// $test_method_for_smoothness_appearance= $_POST['test_method_for_smoothness_appearance'];
$smoothness_appearance_tolerance_washing_cycle = $_POST['smoothness_appearance_tolerance_washing_cycle'];
$smoothness_appearance_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['smoothness_appearance_tolerance_range_math_op'])));
$smoothness_appearance_tolerance_value= $_POST['smoothness_appearance_tolerance_value'];
$smoothness_appearance_min_value= $_POST['smoothness_appearance_min_value'];
$smoothness_appearance_max_value= $_POST['smoothness_appearance_max_value'];
$uom_of_smoothness_appearance= $_POST['uom_of_smoothness_appearance'];

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

	$select_sql_for_duplicacy="select * from `defining_qc_standard_for_curing_process` where `pp_number`='$pp_number' and
     `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and
      `finish_width_in_inch`='$finish_width_in_inch' and `standard_for_which_process`='$standard_for_which_process' AND
        
      `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator' AND
      `cf_to_rubbing_dry_tolerance_value`='$cf_to_rubbing_dry_tolerance_value' AND
      `cf_to_rubbing_dry_min_value`='$cf_to_rubbing_dry_min_value' AND
      `cf_to_rubbing_dry_max_value`='$cf_to_rubbing_dry_max_value' AND

      `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator' AND
      `cf_to_rubbing_wet_tolerance_value`='$cf_to_rubbing_wet_tolerance_value' AND
      `cf_to_rubbing_wet_min_value`='$cf_to_rubbing_wet_min_value' AND
      `cf_to_rubbing_wet_max_value`='$cf_to_rubbing_wet_max_value' AND

      washing_cycle_for_warp_for_washing_before_iron='$washing_cycle_for_warp_for_washing_before_iron' and
      dimensional_stability_to_warp_washing_before_iron_min_value='$dimensional_stability_to_warp_washing_before_iron_min_value' and
      dimensional_stability_to_warp_washing_before_iron_max_value='$dimensional_stability_to_warp_washing_before_iron_max_value' and
      washing_cycle_for_weft_for_washing_before_iron='$washing_cycle_for_weft_for_washing_before_iron' and
      dimensional_stability_to_weft_washing_before_iron_min_value='$dimensional_stability_to_weft_washing_before_iron_min_value' and
      dimensional_stability_to_weft_washing_before_iron_max_value='$dimensional_stability_to_weft_washing_before_iron_max_value' and
      

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

    `ph_value_min_value`='$ph_value_min_value' AND 
    `ph_value_max_value`='$ph_value_max_value' and

    smoothness_appearance_tolerance_washing_cycle = '$smoothness_appearance_tolerance_washing_cycle' AND
    smoothness_appearance_tolerance_range_math_op ='$smoothness_appearance_tolerance_range_math_op' AND
    smoothness_appearance_tolerance_value=' $smoothness_appearance_tolerance_value' AND
    smoothness_appearance_min_value ='$smoothness_appearance_min_value' AND
    smoothness_appearance_max_value ='$smoothness_appearance_max_value' AND
    appearance_after_washing_cycle_fabric_wash='$appearance_after_wash_for_fabric_radio_button' and
    appearance_after_washing_fabric_color_change_math_op='$appearance_after_washing_fabric_color_change_tolerance_range_math_operator' and
    appearance_after_washing_fabric_color_change_tolerance_value='$appearance_after_washing_fabric_color_change_tolerance_value' and
    appearance_after_washing_fabric_color_change_min_value='$appearance_after_washing_fabric_color_change_min_value' and
    appearance_after_washing_fabric_color_change_max_value='$appearance_after_washing_fabric_color_change_max_value' and

    appearance_after_washing_fabric_cross_staining_math_op='$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator' and
    appearance_after_washing_fabric_cross_staining_tolerance_value='$appearance_after_washing_fabric_cross_staining_tolerance_value' and
    appearance_after_washing_fabric_cross_staining_min_value='$appearance_after_washing_fabric_cross_staining_min_value' and
    appearance_after_washing_fabric_cross_staining_max_value='$appearance_after_washing_fabric_cross_staining_max_value' and

    appearance_after_washing_fabric_surface_fuzzing_math_op='$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator' and
    appearance_after_washing_fabric_surface_fuzzing_tolerance_value='$appearance_after_washing_fabric_surface_fuzzing_tolerance_value' and
    appearance_after_washing_fabric_surface_fuzzing_min_value='$appearance_after_washing_fabric_surface_fuzzing_min_value' and
    appearance_after_washing_fabric_surface_fuzzing_max_value='$appearance_after_washing_fabric_surface_fuzzing_max_value' and

    appearance_after_washing_fabric_surface_pilling_math_op='$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator' and
    appearance_after_washing_fabric_surface_pilling_tolerance_value='$appearance_after_washing_fabric_surface_pilling_tolerance_value' and
    appearance_after_washing_fabric_surface_pilling_min_value='$appearance_after_washing_fabric_surface_pilling_min_value' and
    appearance_after_washing_fabric_surface_pilling_max_value='$appearance_after_washing_fabric_surface_pilling_max_value' and

    appearance_after_washing_fabric_crease_before_iron_math_op='$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator' and
    appearance_after_washing_fabric_crease_before_iron_tolerance_val='$appearance_after_washing_fabric_crease_before_ironing_tolerance_value' and
    appearance_after_washing_fabric_crease_before_ironing_min_value='$appearance_after_washing_fabric_crease_before_ironing_min_value' and
    appearance_after_washing_fabric_crease_before_ironing_max_value='$appearance_after_washing_fabric_crease_before_ironing_max_value' and

    appearance_after_washing_fabric_crease_after_iron_math_op='$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator' and
    appearance_after_washing_fabric_crease_after_iron_tolerance_val='$appearance_after_washing_fabric_crease_after_ironing_tolerance_value' and
    appearance_after_washing_fabric_crease_after_ironing_min_value='$appearance_after_washing_fabric_crease_after_ironing_min_value' and
    appearance_after_washing_fabric_crease_after_ironing_max_value='$appearance_after_washing_fabric_crease_after_ironing_max_value' and

    appearance_after_washing_loss_of_print_fabric='$appearance_after_washing_loss_of_print_fabric' and

    appearance_after_washing_fabric_abrasive_mark='$appearance_after_washing_fabric_abrasive_mark' and

    appearance_after_washing_odor_fabric='$appearance_after_washing_odor_fabric' and
    appearance_after_washing_other_observation_fabric='$appearance_after_washing_other_observation_fabric' AND
    
    appearance_after_washing_cycle_garments_wash='$appearance_after_wash_for_garments_radio_button' and
    appear_after_washing_garments_color_change_without_sup_math_op='$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator' and
    appear_after_washing_garments_color_change_without_sup_toler_val='$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value' and
    appear_after_washing_garments_color_change_without_sup_min_value='$appearance_after_washing_garments_color_change_without_suppressor_min_value' and
    appear_after_washing_garments_color_change_without_sup_max_val='$appearance_after_washing_garments_color_change_without_suppressor_max_value' and

    appear_after_washing_garments_color_change_with_sup_math_op='$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator' and
    appear_after_washing_garments_color_change_with_sup_toler_value='$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value' and
    appear_after_washing_garments_color_change_with_sup_min_value='$appearance_after_washing_garments_color_change_with_suppressor_min_value' and
    appear_after_washing_garments_color_change_with_sup_max_value='$appearance_after_washing_garments_color_change_with_suppressor_max_value' and

    appear_after_washing_garments_cross_staining_math_op='$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator' and
    appear_after_washing_garments_cross_staining_tolerance_value='$appearance_after_washing_garments_cross_staining_tolerance_value' and
    appearance_after_washing_garments_cross_staining_min_value='$appearance_after_washing_garments_cross_staining_min_value' and
    appearance_after_washing_garments_cross_staining_max_value='$appearance_after_washing_garments_cross_staining_max_value' and

    appear_after_washing_garments_differential_shrink_math_op='$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator' and
    appear_after_washing_garments__differential_shrink_tolerance_val='$appearance_after_washing_garments__differential_shrinkage_tolerance_value' and
    appearance_after_washing_garments__differential_shrink_min_value='$appearance_after_washing_garments__differential_shrinkage_min_value' and
    appearance_after_washing_garments__differential_shrink_max_value='$appearance_after_washing_garments__differential_shrinkage_max_value' and

    appear_after_washing_garments_surface_fuzzing_math_op='$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator' and
    appearance_after_washing_garments_surface_fuzzing_tolerance_val='$appearance_after_washing_garments_surface_fuzzing_tolerance_value' and
    appearance_after_washing_garments_surface_fuzzing_min_value='$appearance_after_washing_garments_surface_fuzzing_min_value' and
    appearance_after_washing_garments_surface_fuzzing_max_value='$appearance_after_washing_garments_surface_fuzzing_max_value' and

    appear_after_washing_garments_surface_pilling_math_op='$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator' and
    appearance_after_washing_garments_surface_pilling_tolerance_val='$appearance_after_washing_garments_surface_pilling_tolerance_value' and
    appearance_after_washing_garments_surface_pilling_min_value='$appearance_after_washing_garments_surface_pilling_min_value' and
    appearance_after_washing_garments_surface_pilling_max_value='$appearance_after_washing_garments_surface_pilling_max_value' and

    appear_after_washing_garments_crease_after_ironing_math_op='$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator' and
    appear_after_washing_garments_crease_after_ironing_tolerance_val='$appearance_after_washing_garments_crease_after_ironing_tolerance_value' and
    appearance_after_washing_garments_crease_after_ironing_min_value='$appearance_after_washing_garments_crease_after_ironing_min_value' and
    appearance_after_washing_garments_crease_after_ironing_max_value='$appearance_after_washing_garments_crease_after_ironing_max_value' and

    appearance_after_washing_garments_abrasive_mark='$appearance_after_washing_garments_abrasive_mark' and

    seam_breakdown_garments='$seam_breakdown_garments' and

    appear_after_wash_garments_seam_pucker_rop_iron_math_op='$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator' and
    appear_after_washing_garments_seam_pucker_rop_iron_toler_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value' and
    appear_after_washing_garments_seam_pucker_rop_iron_min_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value' and
    appear_after_washing_garments_seam_pucker_rop_iron_max_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value' and

    detachment_of_interlinings_fused_components_garments='$detachment_of_interlinings_fused_components_garments' and

    change_id_handle_or_appearance='$change_id_handle_or_appearance' and

    effect_on_accessories_such_as_buttons='$effect_on_accessories_such_as_buttons' and

    appearance_after_washing_garments_spirality_min_value='$appearance_after_washing_garments_spirality_min_value' and
    appearance_after_washing_garments_spirality_max_value='$appearance_after_washing_garments_spirality_max_value' and

    detachment_or_fraying_of_ribbons='$detachment_or_fraying_of_ribbons' and

    loss_of_print_garments='$loss_of_print_garments' and

    care_level_garments='$care_level_garments' and

    odor_garments='$odor_garments' and
    appearance_after_washing_other_observation_garments='$appearance_after_washing_other_observation_garments' ";

	$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
	{

		$data_previously_saved="Yes";

	}
	else if(mysqli_num_rows($result) < 1)
	{

	$update_sql_statement="UPDATE `defining_qc_standard_for_curing_process` SET
	 
                        `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator',
                        `cf_to_rubbing_dry_tolerance_value`='$cf_to_rubbing_dry_tolerance_value',
                        `cf_to_rubbing_dry_min_value`='$cf_to_rubbing_dry_min_value',
                        `cf_to_rubbing_dry_max_value`='$cf_to_rubbing_dry_max_value', 

                        `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator',
                        `cf_to_rubbing_wet_tolerance_value`='$cf_to_rubbing_wet_tolerance_value', 
                        `cf_to_rubbing_wet_min_value`='$cf_to_rubbing_wet_min_value',
                        `cf_to_rubbing_wet_max_value`='$cf_to_rubbing_wet_max_value',

                        washing_cycle_for_warp_for_washing_before_iron='$washing_cycle_for_warp_for_washing_before_iron',
                        dimensional_stability_to_warp_washing_before_iron_min_value='$dimensional_stability_to_warp_washing_before_iron_min_value',
                        dimensional_stability_to_warp_washing_before_iron_max_value='$dimensional_stability_to_warp_washing_before_iron_max_value',
                        washing_cycle_for_weft_for_washing_before_iron='$washing_cycle_for_weft_for_washing_before_iron',
                        dimensional_stability_to_weft_washing_before_iron_min_value='$dimensional_stability_to_weft_washing_before_iron_min_value',
                        dimensional_stability_to_weft_washing_before_iron_max_value='$dimensional_stability_to_weft_washing_before_iron_max_value',
                        
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

                        `ph_value_min_value`='$ph_value_min_value', 
                        `ph_value_max_value`='$ph_value_max_value',

                        smoothness_appearance_tolerance_washing_cycle = '$smoothness_appearance_tolerance_washing_cycle',
                        smoothness_appearance_tolerance_range_math_op ='$smoothness_appearance_tolerance_range_math_op',
                        smoothness_appearance_tolerance_value=' $smoothness_appearance_tolerance_value',
                        smoothness_appearance_min_value ='$smoothness_appearance_min_value',
                        smoothness_appearance_max_value ='$smoothness_appearance_max_value',
                      
                        test_method_for_appearance_after_wash_fabric='$appearance_after_wash_radio_button',
                        appearance_after_washing_cycle_fabric_wash='$appearance_after_wash_for_fabric_radio_button',

                        appearance_after_washing_fabric_color_change_math_op='$appearance_after_washing_fabric_color_change_tolerance_range_math_operator',
                        appearance_after_washing_fabric_color_change_tolerance_value='$appearance_after_washing_fabric_color_change_tolerance_value',
                        appearance_after_washing_fabric_color_change_min_value='$appearance_after_washing_fabric_color_change_min_value',
                        appearance_after_washing_fabric_color_change_max_value='$appearance_after_washing_fabric_color_change_max_value',
                        
                      
                        appearance_after_washing_fabric_cross_staining_math_op='$appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator',
                        appearance_after_washing_fabric_cross_staining_tolerance_value='$appearance_after_washing_fabric_cross_staining_tolerance_value',
                        appearance_after_washing_fabric_cross_staining_min_value='$appearance_after_washing_fabric_cross_staining_min_value',
                        appearance_after_washing_fabric_cross_staining_max_value='$appearance_after_washing_fabric_cross_staining_max_value',

                        appearance_after_washing_fabric_surface_fuzzing_math_op='$appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator',
                        appearance_after_washing_fabric_surface_fuzzing_tolerance_value='$appearance_after_washing_fabric_surface_fuzzing_tolerance_value',
                        appearance_after_washing_fabric_surface_fuzzing_min_value='$appearance_after_washing_fabric_surface_fuzzing_min_value',
                        appearance_after_washing_fabric_surface_fuzzing_max_value='$appearance_after_washing_fabric_surface_fuzzing_max_value',

                        appearance_after_washing_fabric_surface_pilling_math_op='$appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator',
                        appearance_after_washing_fabric_surface_pilling_tolerance_value='$appearance_after_washing_fabric_surface_pilling_tolerance_value',
                        appearance_after_washing_fabric_surface_pilling_min_value='$appearance_after_washing_fabric_surface_pilling_min_value',
                        appearance_after_washing_fabric_surface_pilling_max_value='$appearance_after_washing_fabric_surface_pilling_max_value',

                        appearance_after_washing_fabric_crease_before_iron_math_op='$appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator',
                        appearance_after_washing_fabric_crease_before_iron_tolerance_val='$appearance_after_washing_fabric_crease_before_ironing_tolerance_value',
                        appearance_after_washing_fabric_crease_before_ironing_min_value='$appearance_after_washing_fabric_crease_before_ironing_min_value',
                        appearance_after_washing_fabric_crease_before_ironing_max_value='$appearance_after_washing_fabric_crease_before_ironing_max_value',

                        appearance_after_washing_fabric_crease_after_iron_math_op='$appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator',
                        appearance_after_washing_fabric_crease_after_iron_tolerance_val='$appearance_after_washing_fabric_crease_after_ironing_tolerance_value',
                        appearance_after_washing_fabric_crease_after_ironing_min_value='$appearance_after_washing_fabric_crease_after_ironing_min_value',
                        appearance_after_washing_fabric_crease_after_ironing_max_value='$appearance_after_washing_fabric_crease_after_ironing_max_value',

                        appearance_after_washing_loss_of_print_fabric='$appearance_after_washing_loss_of_print_fabric',

                        appearance_after_washing_fabric_abrasive_mark='$appearance_after_washing_fabric_abrasive_mark',

                        appearance_after_washing_odor_fabric='$appearance_after_washing_odor_fabric',
                        appearance_after_washing_other_observation_fabric='$appearance_after_washing_other_observation_fabric',

                      
                        appearance_after_washing_cycle_garments_wash='$appearance_after_wash_for_garments_radio_button',


                        appear_after_washing_garments_color_change_without_sup_math_op='$appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator',
                        appear_after_washing_garments_color_change_without_sup_toler_val='$appearance_after_washing_garments_color_change_without_suppressor_tolerance_value',
                        appear_after_washing_garments_color_change_without_sup_min_value='$appearance_after_washing_garments_color_change_without_suppressor_min_value',
                        appear_after_washing_garments_color_change_without_sup_max_val='$appearance_after_washing_garments_color_change_without_suppressor_max_value',

                        appear_after_washing_garments_color_change_with_sup_math_op='$appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator',
                        appear_after_washing_garments_color_change_with_sup_toler_value='$appearance_after_washing_garments_color_change_with_suppressor_tolerance_value',
                        appear_after_washing_garments_color_change_with_sup_min_value='$appearance_after_washing_garments_color_change_with_suppressor_min_value',
                        appear_after_washing_garments_color_change_with_sup_max_value='$appearance_after_washing_garments_color_change_with_suppressor_max_value',

                        appear_after_washing_garments_cross_staining_math_op='$appearance_after_washing_garments_cross_staining_tolerance_range_math_operator',
                        appear_after_washing_garments_cross_staining_tolerance_value='$appearance_after_washing_garments_cross_staining_tolerance_value',
                        appearance_after_washing_garments_cross_staining_min_value='$appearance_after_washing_garments_cross_staining_min_value',
                        appearance_after_washing_garments_cross_staining_max_value='$appearance_after_washing_garments_cross_staining_max_value',

                        appear_after_washing_garments_differential_shrink_math_op='$appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator',
                        appear_after_washing_garments__differential_shrink_tolerance_val='$appearance_after_washing_garments__differential_shrinkage_tolerance_value',
                        appearance_after_washing_garments__differential_shrink_min_value='$appearance_after_washing_garments__differential_shrinkage_min_value',
                        appearance_after_washing_garments__differential_shrink_max_value='$appearance_after_washing_garments__differential_shrinkage_max_value',

                        appear_after_washing_garments_surface_fuzzing_math_op='$appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator',
                        appearance_after_washing_garments_surface_fuzzing_tolerance_val='$appearance_after_washing_garments_surface_fuzzing_tolerance_value',
                        appearance_after_washing_garments_surface_fuzzing_min_value='$appearance_after_washing_garments_surface_fuzzing_min_value',
                        appearance_after_washing_garments_surface_fuzzing_max_value='$appearance_after_washing_garments_surface_fuzzing_max_value',

                        appear_after_washing_garments_surface_pilling_math_op='$appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator',
                        appearance_after_washing_garments_surface_pilling_tolerance_val='$appearance_after_washing_garments_surface_pilling_tolerance_value',
                        appearance_after_washing_garments_surface_pilling_min_value='$appearance_after_washing_garments_surface_pilling_min_value',
                        appearance_after_washing_garments_surface_pilling_max_value='$appearance_after_washing_garments_surface_pilling_max_value',

                        appear_after_washing_garments_crease_after_ironing_math_op='$appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator',
                        appear_after_washing_garments_crease_after_ironing_tolerance_val='$appearance_after_washing_garments_crease_after_ironing_tolerance_value',
                        appearance_after_washing_garments_crease_after_ironing_min_value='$appearance_after_washing_garments_crease_after_ironing_min_value',
                        appearance_after_washing_garments_crease_after_ironing_max_value='$appearance_after_washing_garments_crease_after_ironing_max_value',

                        appearance_after_washing_garments_abrasive_mark='$appearance_after_washing_garments_abrasive_mark',

                        seam_breakdown_garments='$seam_breakdown_garments',

                        appear_after_wash_garments_seam_pucker_rop_iron_math_op='$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator',
                        appear_after_washing_garments_seam_pucker_rop_iron_toler_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value',
                        appear_after_washing_garments_seam_pucker_rop_iron_min_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value',
                        appear_after_washing_garments_seam_pucker_rop_iron_max_value='$appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value',

                        detachment_of_interlinings_fused_components_garments='$detachment_of_interlinings_fused_components_garments',

                        change_id_handle_or_appearance='$change_id_handle_or_appearance',

                        effect_on_accessories_such_as_buttons='$effect_on_accessories_such_as_buttons',

                        appearance_after_washing_garments_spirality_min_value='$appearance_after_washing_garments_spirality_min_value',
                        appearance_after_washing_garments_spirality_max_value='$appearance_after_washing_garments_spirality_max_value',

                        detachment_or_fraying_of_ribbons='$detachment_or_fraying_of_ribbons',

                        loss_of_print_garments='$loss_of_print_garments',

                        care_level_garments='$care_level_garments',

                        odor_garments='$odor_garments',
                        appearance_after_washing_other_observation_garments='$appearance_after_washing_other_observation_garments'

                     WHERE
                          `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and
                          `finish_width_in_inch`='$finish_width_in_inch' and `standard_for_which_process`='$standard_for_which_process' ";


	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}

        $process_id= $_POST['process_id'];
        $version_id = $_POST['version_id'];

        $checking_data= $_POST['checking_data'];

        $test_method_id= $_POST['test_method_id'];
        $splitted_test_method_id=explode(',', $test_method_id);

        for($i=0 ; $i < count($splitted_test_method_id)-1 ; $i++)
        	{
			
			 	$sql_for_test_method_test = "SELECT * FROM data_for_all_standard 
											WHERE pp_number = '$pp_number' and
											version_number = '$version_number' and
											customer_id = '$customer_id' and
											color = '$color' and
											process_id = '$process_id' and test_method_id = '$splitted_test_method_id[$i]'";

			 	$result_for_test_method_test = mysqli_query($con,$sql_for_test_method_test) or die(mysqli_error($con));
				 $row_for_test_method_test = mysqli_fetch_assoc($result_for_test_method_test);
				
				 	 $test_method_id_for_selected = $row_for_test_method_test['test_method_id'];
					 if($test_method_id_for_selected == $splitted_test_method_id[$i])
					 {
						
					 }
					 else
					 {
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
								'$splitted_test_method_id[$i]',
								'$pp_number',
								'$version_id',
                                '$version_number',
                                '$customer_id',
                                '$color',
                                '$process_id',
                                '$checking_data'
                                 )";

          				mysqli_query($con,$insert_sql_statement_for_test_method) or die(mysqli_error($con));
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