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



$test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'])));
$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
$cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $_POST['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
$uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $_POST['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


$test_method_for_cf_to_oxidative_bleach_damage_color_cange= $_POST['test_method_for_cf_to_oxidative_bleach_damage_color_cange'];
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



$cf_to_pvc_migration_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_pvc_migration_staining_tolerance_range_math_operator'])));
$cf_to_pvc_migration_staining_tolerance_value= $_POST['cf_to_pvc_migration_staining_tolerance_value'];
$cf_to_pvc_migration_staining_min_value= $_POST['cf_to_pvc_migration_staining_min_value'];
$cf_to_pvc_migration_staining_max_value= $_POST['cf_to_pvc_migration_staining_max_value'];
$uom_of_cf_to_pvc_migration_staining= $_POST['uom_of_cf_to_pvc_migration_staining'];


$test_method_for_cf_to_saliva_staining= $_POST['test_method_for_cf_to_saliva_staining'];
$cf_to_saliva_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['cf_to_saliva_staining_tolerance_range_math_operator'])));
$cf_to_saliva_staining_tolerance_value= $_POST['cf_to_saliva_staining_tolerance_value'];
$cf_to_saliva_staining_staining_min_value= $_POST['cf_to_saliva_staining_staining_min_value'];
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



$test_method_for_ph= $_POST['test_method_for_ph'];
$ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['ph_value_tolerance_range_math_operator'])));
$ph_value_tolerance_value= $_POST['ph_value_tolerance_value'];
$ph_value_min_value= $_POST['ph_value_min_value'];
$ph_value_max_value= $_POST['ph_value_max_value'];
$uom_of_ph_value= $_POST['uom_of_ph_value'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));


//if route serial change but customer wise version and process technique already define
$select_sql_for_duplicacy2 = "select * from `adding_process_to_version_model` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color_name`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' and `process_serial_no` = '$process_serial' ";


$result2 = mysqli_query($con, $select_sql_for_duplicacy2) or die(mysqli_error($con));

if(mysqli_num_rows($result2)>0)
{

	$data_previously_saved="Yes";

}
else 
{
	 $insert_sql_add_process_model2 ="insert into `adding_process_to_version_model`
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
       
	  $result = mysqli_query($con, $insert_sql_add_process_model2) or die(mysqli_error($con));

	  //echo $result;
	  //echo $data_insertion_hampering_for_add_process_model;
	  if(mysqli_affected_rows($con)<>1)
	  {
	  
	    $data_insertion_hampering_for_add_process_model = "Yes";
	  
	  }
	  //echo $data_insertion_hampering_for_add_process_model;
}



$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_washing_process` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' ";

// $select_sql_for_duplicacy="select * from `adding_process_to_version_model` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color_name`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' and `process_serial_no` = '$process_serial' ";


$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

	 $insert_sql_for_define_model="insert into `model_defining_qc_standard_for_washing_process`
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

    
      
	mysqli_query($con,$insert_sql_for_define_model) or die(mysqli_error($con));

  
	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering_for_define_model = "Yes";
	
	}
  else
  {
    
      // $insert_sql_add_process_model ="insert into `adding_process_to_version_model`
      //  ( 
      //  `version_number`,
      //  `customer_id`,
      //  `customer_name`,
      //  `color_name`,
      //  `process_id`,
      //  `process_name`,
      //  `process_serial_no`,
      //  `process_or_reprocess`,
      //  `process_technique`,
      //  `checking_field`,

      //    `recording_person_id`,
      //    `recording_person_name`,
      //    `recording_time` ) 
      //    values 
      //    (
      //    '$version_number',
      //    '$customer_id',
      //    '$customer_name',
      //    '$color_name',
      //    '$process_id',
      //    '$process_name',
      //    '$process_serial',
      //    'process',
      //    '$process_technique_name',
      //    '',

      //    '$user_id',
      //    '$user_name',
      //     NOW()
      //      )";
       
      // mysqli_query($con, $insert_sql_add_process_model) or die(mysqli_error($con));


      // if(mysqli_affected_rows($con)<>1)
      // {
      
      //   $data_insertion_hampering_for_add_process_model = "Yes";
      
      // }


  	  	
  }
}




// if($data_previously_saved == "Yes")
// {

// 	mysqli_query($con,"ROLLBACK");
// 	echo "Data is previously saved.  ";

// }
// else if($data_insertion_hampering_for_define_model == "No" )
// {

// 	mysqli_query($con,"COMMIT");
// 	echo "Model standard is successfully saved.  ";

// }
// else 
// {

// 	mysqli_query($con,"ROLLBACK");
// 	echo "Data is not successfully saved.  ";

// }


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
