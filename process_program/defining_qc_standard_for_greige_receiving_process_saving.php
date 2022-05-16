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


$pp_number= $_POST['pp_number_value'];

$version_number_details= $_POST['version_number'];

$splitted_version= explode("?fs?",$version_number_details);

$version_number= $splitted_version[0];
$color= $splitted_version[1];
$finish_width_in_inch= $splitted_version[2];
$customer_name= $splitted_version[3];
$version_id= $splitted_version[4];
$customer_id= $splitted_version[5];
$style_name= $splitted_version[6];

$standard_for_which_process= $_POST['standard_for_which_process'];

$warp_yarn_count_value= $_POST['warp_yarn_count_value'];
$warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['warp_yarn_count_tolerance_range_math_operator'])));
$warp_yarn_count_tolerance_value= $_POST['warp_yarn_count_tolerance_value'];
$warp_yarn_count_min_value= $_POST['warp_yarn_count_min_value'];
$warp_yarn_count_max_value= $_POST['warp_yarn_count_max_value'];
$uom_of_warp_yarn_count_value= $_POST['uom_of_warp_yarn_count_value'];

$weft_yarn_count_value= $_POST['weft_yarn_count_value'];
$weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['weft_yarn_count_tolerance_range_math_operator'])));
$weft_yarn_count_tolerance_value= $_POST['weft_yarn_count_tolerance_value'];
$weft_yarn_count_min_value= $_POST['weft_yarn_count_min_value'];
$weft_yarn_count_max_value= $_POST['weft_yarn_count_max_value'];
$uom_of_weft_yarn_count_value= $_POST['uom_of_weft_yarn_count_value'];

$mass_per_unit_per_area_value= $_POST['mass_per_unit_per_area_value'];
$mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['mass_per_unit_per_area_tolerance_range_math_operator'])));
$mass_per_unit_per_area_tolerance_value= $_POST['mass_per_unit_per_area_tolerance_value'];
$mass_per_unit_per_area_min_value= $_POST['mass_per_unit_per_area_min_value'];
$mass_per_unit_per_area_max_value= $_POST['mass_per_unit_per_area_max_value'];
$uom_of_mass_per_unit_per_area_value= $_POST['uom_of_mass_per_unit_per_area_value'];

$no_of_threads_in_warp_value= $_POST['no_of_threads_in_warp_value'];
$no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['no_of_threads_in_warp_tolerance_range_math_operator'])));
$no_of_threads_in_warp_tolerance_value= $_POST['no_of_threads_in_warp_tolerance_value'];
$no_of_threads_in_warp_min_value= $_POST['no_of_threads_in_warp_min_value'];
$no_of_threads_in_warp_max_value= $_POST['no_of_threads_in_warp_max_value'];
$uom_of_no_of_threads_in_warp_value= $_POST['uom_of_no_of_threads_in_warp_value'];

$no_of_threads_in_weft_value= $_POST['no_of_threads_in_weft_value'];
$no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['no_of_threads_in_weft_tolerance_range_math_operator'])));
$no_of_threads_in_weft_tolerance_value= $_POST['no_of_threads_in_weft_tolerance_value'];
$no_of_threads_in_weft_min_value= $_POST['no_of_threads_in_weft_min_value'];
$no_of_threads_in_weft_max_value= $_POST['no_of_threads_in_weft_max_value'];
$uom_of_no_of_threads_in_weft_value= $_POST['uom_of_no_of_threads_in_weft_value'];


$greige_width_value= $_POST['greige_width_value'];
$greige_width_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['greige_width_range_math_operator'])));
$greige_width_tolerance_value= $_POST['greige_width_tolerance_value'];
$greige_width_min_value= $_POST['greige_width_min_value'];
$greige_width_max_value= $_POST['greige_width_max_value'];
$uom_of_greige_width_value= $_POST['uom_of_greige_width_value'];



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

$description_or_type_for_total_other_fiber= $_POST['description_or_type_for_total_other_fiber'];
$percentage_of_total_other_fiber_content_value= $_POST['percentage_of_total_other_fiber_content_value'];
$percentage_of_total_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_total_other_fiber_content_tolerance_range_math_op'])));
$percentage_of_total_other_fiber_content_tolerance_value= $_POST['percentage_of_total_other_fiber_content_tolerance_value'];
$percentage_of_total_other_fiber_content_min_value= $_POST['percentage_of_total_other_fiber_content_min_value'];
$percentage_of_total_other_fiber_content_max_value= $_POST['percentage_of_total_other_fiber_content_max_value'];
$uom_of_percentage_of_total_other_fiber_content= $_POST['uom_of_percentage_of_total_other_fiber_content'];

$description_or_type_for_total_other_fiber_1= $_POST['description_or_type_for_total_other_fiber_1'];
$percentage_of_total_other_fiber_content_1_value= $_POST['percentage_of_total_other_fiber_content_1_value'];
$percentage_of_total_other_fiber_content_1_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_total_other_fiber_content_1_tol_range_math_op'])));
$percentage_of_total_other_fiber_content_1_tolerance_value= $_POST['percentage_of_total_other_fiber_content_1_tolerance_value'];
$percentage_of_total_other_fiber_content_1_min_value= $_POST['percentage_of_total_other_fiber_content_1_min_value'];
$percentage_of_total_other_fiber_content_1_max_value= $_POST['percentage_of_total_other_fiber_content_1_max_value'];
$uom_of_percentage_of_total_other_fiber_content_1= $_POST['uom_of_percentage_of_total_other_fiber_content_1'];


$percentage_of_warp_cotton_content_value= $_POST['percentage_of_warp_cotton_content_value'];
$percentage_of_warp_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_warp_cotton_content_tolerance_range_math_operator'])));
$percentage_of_warp_cotton_content_tolerance_value= $_POST['percentage_of_warp_cotton_content_tolerance_value'];
$percentage_of_warp_cotton_content_min_value= $_POST['percentage_of_warp_cotton_content_min_value'];
$percentage_of_warp_cotton_content_max_value= $_POST['percentage_of_warp_cotton_content_max_value'];
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

$description_or_type_for_warp_other_fiber_1= $_POST['description_or_type_for_warp_other_fiber_1'];
$percentage_of_warp_other_fiber_content_1_value= $_POST['percentage_of_warp_other_fiber_content_1_value'];
$percentage_of_warp_other_fiber_content_1_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_warp_other_fiber_content_1_tolerance_range_math_op'])));
$percentage_of_warp_other_fiber_content_1_tolerance_value= $_POST['percentage_of_warp_other_fiber_content_1_tolerance_value'];
$percentage_of_warp_other_fiber_content_1_min_value= $_POST['percentage_of_warp_other_fiber_content_1_min_value'];
$percentage_of_warp_other_fiber_content_1_max_value= $_POST['percentage_of_warp_other_fiber_content_1_max_value'];
$uom_of_percentage_of_warp_other_fiber_content_1= $_POST['uom_of_percentage_of_warp_other_fiber_content_1'];

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



$description_or_type_for_weft_other_fiber_1= $_POST['description_or_type_for_weft_other_fiber_1'];
$percentage_of_weft_other_fiber_content_1_value= $_POST['percentage_of_weft_other_fiber_content_1_value'];
$percentage_of_weft_other_fiber_content_1_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($_POST['percentage_of_weft_other_fiber_content_1_tolerance_range_math_op'])));
$percentage_of_weft_other_fiber_content_1_tolerance_value= $_POST['percentage_of_weft_other_fiber_content_1_tolerance_value'];
$percentage_of_weft_other_fiber_content_1_min_value= $_POST['percentage_of_weft_other_fiber_content_1_min_value'];
$percentage_of_weft_other_fiber_content_1_max_value= $_POST['percentage_of_weft_other_fiber_content_1_max_value'];
$uom_of_percentage_of_weft_other_fiber_content_1= $_POST['uom_of_percentage_of_weft_other_fiber_content_1'];





//from new database and form






/*
$select_sql_for_duplicacy="select * from `defining_qc_standard_for_greige_receiving_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `greige_width`='$greige_width' and `standard_for_which_process`='$standard_for_which_process' and `cf_to_rubbing_dry_tolerance_range_math_operator`='$cf_to_rubbing_dry_tolerance_range_math_operator' and `cf_to_rubbing_dry_tolerance_value`='$cf_to_rubbing_dry_tolerance_value' and `cf_to_rubbing_dry_min_value`='$cf_to_rubbing_dry_min_value' and `cf_to_rubbing_dry_max_value`='$cf_to_rubbing_dry_max_value' and `uom_of_cf_to_rubbing_dry`='$uom_of_cf_to_rubbing_dry' and `cf_to_rubbing_wet_tolerance_range_math_operator`='$cf_to_rubbing_wet_tolerance_range_math_operator' and `cf_to_rubbing_wet_tolerance_value`='$cf_to_rubbing_wet_tolerance_value' and `cf_to_rubbing_wet_min_value`='$cf_to_rubbing_wet_min_value' and `cf_to_rubbing_wet_max_value`='$cf_to_rubbing_wet_max_value' and `uom_of_cf_to_rubbing_wet`='$uom_of_cf_to_rubbing_wet' and `ph_value_tolerance_range_math_operator`='$ph_value_tolerance_range_math_operator' and `ph_value_tolerance_value`='$ph_value_tolerance_value' and `ph_value_min_value`='$ph_value_min_value' and `ph_value_max_value`='$ph_value_max_value' and `uom_of_ph_value`='$uom_of_ph_value' and `wicking_test_min_value`='$wicking_test_min_value' and `spirality_value_min_value`='$spirality_value_min_value' and `spirality_value_max_value`='$spirality_value_min_value' and `wicking_test_max_value`='$wicking_test_max_value' and`recording_person_id`='$user_id' and `recording_person_name`='$user_name'";

*/

   mysqli_query($con,"BEGIN");
   mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	$select_sql_for_duplicacy="select * from `defining_qc_standard_for_greige_receiving_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`='$finish_width_in_inch'";

	$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
	{

		$data_previously_saved="Yes";

	}
	else if(mysqli_num_rows($result) < 1)
	{

	$insert_sql_statement="INSERT INTO `defining_qc_standard_for_greige_receiving_process`( 
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
			 `percentage_of_warp_cotton_content_max_value`,
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
	         '$version_number',
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
			   '$percentage_of_warp_cotton_content_max_value',
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
    
	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	   
	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
	else

	{
		$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='Greige Issued' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

	    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));


	    $process_id= $_POST['process_id'];

        $checking_data= $_POST['checking_data'];

        $test_method_id= $_POST['test_method_id'];
         $splitted_test_method_id=explode(',', $test_method_id);
         for($i=0 ; $i < count($splitted_test_method_id)-1 ; $i++)

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
	echo "Data is successfully saved.";
	

	//  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_status`='Wait for greige issuance',`current_state`='Wait for greige issuance' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";
		$update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined greige standard' WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";
        mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
