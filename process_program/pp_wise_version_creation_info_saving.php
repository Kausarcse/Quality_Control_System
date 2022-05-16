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

$message = '';


$pp_number= $_POST['pp_number'];
$split_pp_number= explode('?fs?',$pp_number);

$pp_number=$split_pp_number[0];
$pp_num_id=$split_pp_number[1];

$version_name= $_POST['version_name'];
$style_name= $_POST['style_name'];
$color= $_POST['color'];
$construction_name= $_POST['construction_name'];
$no_of_weft_yarn_picking= $_POST['no_of_weft_yarn_picking'];
$greige_width_in_inch= $_POST['greige_width_in_inch'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$process_technique_name= $_POST['process_technique_name'];
$percentage_of_cotton_content= $_POST['percentage_of_cotton_content'];
$percentage_of_polyester_content= $_POST['percentage_of_polyester_content'];
$other_fiber_in_yarn= $_POST['other_fiber_in_yarn'];
$percentage_of_other_fiber_content= $_POST['percentage_of_other_fiber_content'];
$pp_quantity= $_POST['pp_quantity'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `pp_wise_version_creation_info` 
                            where 
                                `pp_number`='$pp_number' and 
                                `version_name`='$version_name' and 
                                `style_name`='$style_name' and 
                                `color`='$color' and 
                                `finish_width_in_inch`='$finish_width_in_inch'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
   $select_sql_max_primary_key="select MAX(max_version_id) as max_version_id FROM (select CONVERT(substring(version_id,9,LENGTH(version_id)),UNSIGNED) as max_version_id from pp_wise_version_creation_info) as temp_pp_wise_version_creation_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_version_id']+1;

    if($row_for_max_primary_key['max_version_id']==0)
    {

        $current_version_id='version_1';

    }
    else
    {

        $current_version_id ="version_".($row_for_max_primary_key['max_version_id']+1);

    }

	$insert_sql_statement="insert into `pp_wise_version_creation_info` 
	( 
  	`row_id`,
  	`version_id`,
  	`pp_num_id`,
  	`pp_number`,
  	`version_name`,
  	`style_name`,
  	`color`,
  	`construction_name`,
  	`no_of_weft_yarn_picking`,
  	`greige_width_in_inch`,
  	`finish_width_in_inch`,
  	`process_technique_name`,
  	`percentage_of_cotton_content`,
  	`percentage_of_polyester_content`,
  	`other_fiber_in_yarn`,
  	`percentage_of_other_fiber_content`,
  	`pp_quantity`,
  	`recording_person_id`,
  	`recording_person_name`,
  	`recording_time` 
     )
      values 
      (
      '$row_id',
      '$current_version_id',
      '$pp_num_id',
      '$pp_number',
      '$version_name',
      '$style_name',
      '$color',
      '$construction_name',
      '$no_of_weft_yarn_picking',
      '$greige_width_in_inch',
      '$finish_width_in_inch',
      '$process_technique_name',
      '$percentage_of_cotton_content',
      '$percentage_of_polyester_content',
      '$other_fiber_in_yarn',
      '$percentage_of_other_fiber_content',
      '$pp_quantity',
      '$user_id',
      '$user_name',
      NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
	else
	{ 

        $select_sql_for_duplicacy_pp_monitoring="select * from `pp_monitoring` where `pp_number`='$pp_number' and `version_number`='$version_name' and `style_name`='$style_name' and `finish_width_in_inch`='$finish_width_in_inch'";

        $result_pp_monitoring = mysqli_query($con,$select_sql_for_duplicacy_pp_monitoring) or die(mysqli_error($con));

        if(mysqli_num_rows($result_pp_monitoring)> 0)
        {
        
        }
        else
        {
            if($pp_number !="" && $version_name !="" & $finish_width_in_inch !="" && $style_name !="")
            {
          
	               $insert_sql_for_pp_monitoringt="insert into `pp_monitoring`
                            ( 
                            `pp_number`,
                            `version_number`,
                            `style_name`,
                            `finish_width_in_inch`,
                            `current_status`,
                            `recording_person_id`,
                            `recording_person_name`,
                            `recording_time`,
                            `current_state` 
                            ) 
                            values 
                            (
                            '$pp_number',
                            '$version_name',
                            '$style_name',
                            '$finish_width_in_inch',
                            'PP Issued',
                            '$user_id',
                            '$user_name',
                            NOW(),
                            'Wait for defining process route')";

	                 mysqli_query($con,$insert_sql_for_pp_monitoringt) or die(mysqli_error($con));
      
            }
        }



      //auto sync option start

        //find out customer for this pp
        $select_pp_number_customer = "select * from `process_program_info` where `pp_number`='$pp_number'";

        $result_pp_number_customer = mysqli_query($con, $select_pp_number_customer) or die(mysqli_error($con));

        $pp_number_customer_result =  mysqli_fetch_array($result_pp_number_customer);

        $pp_number = $pp_number;
        $pp_num_id = $pp_number_customer_result['pp_num_id'];
        $version_name = $version_name;
        $version_id = $current_version_id;
        $color_name = $color;
        $customer_name = $pp_number_customer_result['customer_name'];
        $customer_id = $pp_number_customer_result['customer_id'];

        $style_name = $style_name;
        $finish_width_in_inch = $finish_width_in_inch;

          $select_sql_for_model_adding_process_to_version = "select * from `adding_process_to_version_model` where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name`='$customer_name' and 
                                                            `color_name`='$color_name'";
          
          $result_model_adding_process_to_version = mysqli_query($con, $select_sql_for_model_adding_process_to_version) or die(mysqli_error($con));

        if(mysqli_num_rows($result_model_adding_process_to_version)> 0)
        {

            while($row_model_adding_process_to_version = mysqli_fetch_array($result_model_adding_process_to_version)) 
            {
                // $version_id;
                // $customer_id = $customer_name;
                // $color_id ;

                //select model add in process to version information
                $process_id = $row_model_adding_process_to_version['process_id'];
                $process_name = $row_model_adding_process_to_version['process_name'];
                $process_serial_no = $row_model_adding_process_to_version['process_serial_no'];
                $process_or_reprocess = $row_model_adding_process_to_version['process_or_reprocess'];
                $process_technique = $row_model_adding_process_to_version['process_technique'];

                
                //select process id information
                //   $select_process_id = "select * from `process_name` where `process_name`='$process_name'";

                //   $result_process_id = mysqli_query($con, $select_process_id) or die(mysqli_error($con));

                //   $process_id_result =  mysqli_fetch_array($result_process_id);

                //   $process_id = $process_id_result['process_id'];
                $checking_field = '1';


                //insert model add in process data to main add in process

                 $insert_sql_statement_add_process=" insert into `adding_process_to_version` 
                                                    ( 
                                                        `version_id`,
                                                        `pp_num_id`,
                                                        `pp_number`,
                                                        `version_name`,
                                                        `style_name`,
                                                        `customer_name`,
                                                        `finish_width_in_inch`,
                                                        `color`,
                                                        `process_id`,
                                                        `process_name`,
                                                        `process_serial_no`,
                                                        `process_or_reprocess`,
                                                        `checking_field`,
                                                        `recording_person_id`,
                                                        `recording_person_name`,
                                                        `recording_time` 
                                                    ) 
                                                    values 
                                                    (
                                                        '$version_id',
                                                        '$pp_num_id',
                                                        '$pp_number',
                                                        '$version_name',
                                                        '$style_name',
                                                        '$customer_name',
                                                        '$finish_width_in_inch',
                                                        '$color_name',
                                                        '$process_id',
                                                        '$process_name',
                                                        '$process_serial_no',
                                                        '$process_or_reprocess',
                                                        '1',
                                                        '$user_id',
                                                        '$user_name',
                                                        NOW()
                                                    )";
               
                    mysqli_query($con,$insert_sql_statement_add_process) or die(mysqli_error($con));

                    if(mysqli_affected_rows($con)<>1)
                    {
                    
                        $data_insertion_hampering = "Yes";
                    
                    }
                    else
                    {
                        if ($process_name == 'Greige Receiving') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_greige = "select * from `model_defining_qc_standard_for_greige_receiving_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_for_greige = mysqli_query($con, $select_sql_for_greige) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_for_greige)> 0)
                            {
                              //if after checking data not found then insert new standard for singe and desige

                              //take model singe and desige all data 

                              /*............................................................Copy greige_receiving..............................................................*/


                                $model_pp_version_greige_receiving_process = "select * from `model_defining_qc_standard_for_greige_receiving_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_greige_receiving_process = mysqli_query($con,$model_pp_version_greige_receiving_process) or die(mysqli_error($con));
                                $row_old_pp_version_greige_receiving_process = mysqli_fetch_array($result_model_pp_version_greige_receiving_process);

                                $standard_for_which_process= $row_old_pp_version_greige_receiving_process['process_name'];  

                                $warp_yarn_count_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_value'];
                                $warp_yarn_count_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['warp_yarn_count_tolerance_range_math_operator'];
                                $warp_yarn_count_tolerance_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_tolerance_value'];
                                $warp_yarn_count_min_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_min_value'];
                                $warp_yarn_count_max_value= $row_old_pp_version_greige_receiving_process['warp_yarn_count_max_value'];
                                $uom_of_warp_yarn_count_value= $row_old_pp_version_greige_receiving_process['uom_of_warp_yarn_count_value'];

                                $weft_yarn_count_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_value'];
                                $weft_yarn_count_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['weft_yarn_count_tolerance_range_math_operator'];
                                $weft_yarn_count_tolerance_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_tolerance_value'];
                                $weft_yarn_count_min_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_min_value'];
                                $weft_yarn_count_max_value= $row_old_pp_version_greige_receiving_process['weft_yarn_count_max_value'];
                                $uom_of_weft_yarn_count_value= $row_old_pp_version_greige_receiving_process['uom_of_weft_yarn_count_value'];

                                $mass_per_unit_per_area_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_value'];
                                $mass_per_unit_per_area_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_tolerance_range_math_operator'];
                                $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_tolerance_value'];
                                $mass_per_unit_per_area_min_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_min_value'];
                                $mass_per_unit_per_area_max_value= $row_old_pp_version_greige_receiving_process['mass_per_unit_per_area_max_value'];
                                $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_greige_receiving_process['uom_of_mass_per_unit_per_area_value'];

                                $no_of_threads_in_warp_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_value'];
                                $no_of_threads_in_warp_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_tolerance_range_math_operator'];
                                $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_tolerance_value'];
                                $no_of_threads_in_warp_min_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_min_value'];
                                $no_of_threads_in_warp_max_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_warp_max_value'];
                                $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_greige_receiving_process['uom_of_no_of_threads_in_warp_value'];

                                $no_of_threads_in_weft_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_value'];
                                $no_of_threads_in_weft_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_tolerance_range_math_operator'];
                                $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_tolerance_value'];
                                $no_of_threads_in_weft_min_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_min_value'];
                                $no_of_threads_in_weft_max_value= $row_old_pp_version_greige_receiving_process['no_of_threads_in_weft_max_value'];
                                $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_greige_receiving_process['uom_of_no_of_threads_in_weft_value'];
                                
                                $greige_width_value= $row_old_pp_version_greige_receiving_process['greige_width_value'];
                                $greige_width_range_math_operator= $row_old_pp_version_greige_receiving_process['greige_width_range_math_operator'];
                                $greige_width_tolerance_value= $row_old_pp_version_greige_receiving_process['greige_width_tolerance_value'];
                                $greige_width_min_value= $row_old_pp_version_greige_receiving_process['greige_width_min_value'];
                                $greige_width_max_value= $row_old_pp_version_greige_receiving_process['greige_width_max_value'];
                                $uom_of_greige_width_value= $row_old_pp_version_greige_receiving_process['uom_of_greige_width_value'];

                                $percentage_of_total_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_value'];
                                $percentage_of_total_cotton_content_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_tolerance_range_math_operator'];
                                $percentage_of_total_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_tolerance_value'];
                                $percentage_of_total_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_min_value'];
                                $percentage_of_total_cotton_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_cotton_content_max_value'];
                                $uom_of_percentage_of_total_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_cotton_content'];

                                $percentage_of_total_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_value'];
                                $percentage_of_total_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_tolerance_range_math_op'];
                                $percentage_of_total_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_tolerance_value'];
                                $percentage_of_total_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_min_value'];
                                $percentage_of_total_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_polyester_content_max_value'];
                                $uom_of_percentage_of_total_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_polyester_content'];

                                $description_or_type_for_total_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_total_other_fiber'];
                                $percentage_of_total_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_value'];
                                $percentage_of_total_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'];
                                $percentage_of_total_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_tolerance_value'];
                                $percentage_of_total_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_min_value'];
                                $percentage_of_total_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_max_value'];
                                $uom_of_percentage_of_total_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_other_fiber_content'];

                                $description_or_type_for_total_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_total_other_fiber_1'];
                                $percentage_of_total_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_value'];
                                $percentage_of_total_other_fiber_content_1_tol_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_tol_range_math_op'];
                                $percentage_of_total_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_tolerance_value'];
                                $percentage_of_total_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_min_value'];
                                $percentage_of_total_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_total_other_fiber_content_1_max_value'];
                                $uom_of_percentage_of_total_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_total_other_fiber_content_1'];

                                $percentage_of_warp_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_value'];
                                $percentage_of_warp_cotton_content_tolerance_range_math_operator= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'];
                                $percentage_of_warp_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_tolerance_value'];
                                $percentage_of_warp_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_min_value'];
                                $percentage_of_warp_cotton_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_cotton_content_max_value'];
                                $uom_of_percentage_of_warp_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_cotton_content'];

                                $percentage_of_warp_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_value'];
                                $percentage_of_warp_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_tolerance_range_math_op'];
                                $percentage_of_warp_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_tolerance_value'];
                                $percentage_of_warp_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_min_value'];
                                $percentage_of_warp_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_polyester_content_max_value'];
                                $uom_of_percentage_of_warp_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_polyester_content'];


                                $description_or_type_for_warp_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_warp_other_fiber'];
                                $percentage_of_warp_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_value'];
                                $percentage_of_warp_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'];
                                $percentage_of_warp_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_tolerance_value'];
                                $percentage_of_warp_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_min_value'];
                                $percentage_of_warp_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_max_value'];
                                $uom_of_percentage_of_warp_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_other_fiber_content'];

                                $description_or_type_for_warp_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_warp_other_fiber_1'];
                                $percentage_of_warp_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_value'];
                                $percentage_of_warp_other_fiber_content_1_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_tolerance_range_math_op'];
                                $percentage_of_warp_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_tolerance_value'];
                                $percentage_of_warp_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_min_value'];
                                $percentage_of_warp_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_warp_other_fiber_content_1_max_value'];
                                $uom_of_percentage_of_warp_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_warp_other_fiber_content_1'];

                                $percentage_of_weft_cotton_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_value'];
                                $percentage_of_weft_cotton_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_tolerance_range_math_op'];
                                $percentage_of_weft_cotton_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_tolerance_value'];
                                $percentage_of_weft_cotton_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_min_value'];
                                $percentage_of_weft_cotton_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_cotton_content_max_value'];
                                $uom_of_percentage_of_weft_cotton_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_cotton_content'];

                                $percentage_of_weft_polyester_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_value'];
                                $percentage_of_weft_polyester_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_tolerance_range_math_op'];
                                $percentage_of_weft_polyester_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_tolerance_value'];
                                $percentage_of_weft_polyester_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_min_value'];
                                $percentage_of_weft_polyester_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_polyester_content_max_value'];
                                $uom_of_percentage_of_weft_polyester_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_polyester_content'];

                                $description_or_type_for_weft_other_fiber= $row_old_pp_version_greige_receiving_process['description_or_type_for_weft_other_fiber'];
                                $percentage_of_weft_other_fiber_content_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_value'];
                                $percentage_of_weft_other_fiber_content_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
                                $percentage_of_weft_other_fiber_content_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_tolerance_value'];
                                $percentage_of_weft_other_fiber_content_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_min_value'];
                                $percentage_of_weft_other_fiber_content_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_max_value'];
                                $uom_of_percentage_of_weft_other_fiber_content= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_other_fiber_content'];


                                $description_or_type_for_weft_other_fiber_1= $row_old_pp_version_greige_receiving_process['description_or_type_for_weft_other_fiber_1'];
                                $percentage_of_weft_other_fiber_content_1_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_value'];
                                $percentage_of_weft_other_fiber_content_1_tolerance_range_math_op= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_tolerance_range_math_op'];
                                $percentage_of_weft_other_fiber_content_1_tolerance_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_tolerance_value'];
                                $percentage_of_weft_other_fiber_content_1_min_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_min_value'];
                                $percentage_of_weft_other_fiber_content_1_max_value= $row_old_pp_version_greige_receiving_process['percentage_of_weft_other_fiber_content_1_max_value'];
                                $uom_of_percentage_of_weft_other_fiber_content_1= $row_old_pp_version_greige_receiving_process['uom_of_percentage_of_weft_other_fiber_content_1'];

                                $insert_sql_statement_for_greige_receiving="INSERT INTO `defining_qc_standard_for_greige_receiving_process`( 
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
                                                                            '$version_name',
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
                              
                                mysqli_query($con,$insert_sql_statement_for_greige_receiving) or die(mysqli_error($con));   
                                
                                $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  
                                                                        `current_state`='Waiting for defining all standard',
                                                                        `current_status`='Defined greige standard' 
                                                                        WHERE 
                                                                        `pp_number`= '$pp_number' and 
                                                                        `version_number`='$version_name' and 
                                                                        `finish_width_in_inch`='$finish_width_in_inch'";
                                mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                            }
                            else
                            {
                                $message = 'Already greige receiving standard defined';
                            }
                        }       // End greige receiving process
                        else if ($process_name == 'Singeing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_singeing = "select * from `model_defining_qc_standard_for_singeing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_singeing = mysqli_query($con, $select_sql_for_singeing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_singeing)> 0)
                            {
                              //if after checking data not found then insert new standard for singeing
                              //take model singeing all data 

                              /*............................................................Copy singeing..............................................................*/


                                $model_pp_version_singeing_process = "select * from `model_defining_qc_standard_for_singeing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_singeing_process = mysqli_query($con,$model_pp_version_singeing_process) or die(mysqli_error($con));
                                $row_old_pp_version_singeing_process = mysqli_fetch_array($result_model_pp_version_singeing_process);

                                $standard_for_which_process= $row_old_pp_version_singeing_process['process_name'];  

                                $test_method_for_flame_intensity= $row_old_pp_version_singeing_process['test_method_for_flame_intensity'];
                                $uom_of_flame_intensity= $row_old_pp_version_singeing_process['uom_of_flame_intensity'];
                                $flame_intensity_min_value= $row_old_pp_version_singeing_process['flame_intensity_min_value'];
                                $flame_intensity_max_value= $row_old_pp_version_singeing_process['flame_intensity_max_value'];

                                $test_method_for_machine_speed= $row_old_pp_version_singeing_process['test_method_for_machine_speed'];
                                $uom_of_machine_speed= $row_old_pp_version_singeing_process['uom_of_machine_speed'];
                                $machine_speed_min_value= $row_old_pp_version_singeing_process['machine_speed_min_value'];
                                $machine_speed_max_value= $row_old_pp_version_singeing_process['machine_speed_max_value'];

                    
                                $insert_sql_statement_for_singe="insert into `defining_qc_standard_for_singeing_process`
                                ( 
                                `pp_number`,
                                `version_id`,
                                `version_number`,
                                `customer_name`,
                                `customer_id`,
                                `color`,
                                `finish_width_in_inch`,
                                `standard_for_which_process`,

                                `test_method_for_flame_intensity`,
                                `uom_of_flame_intensity`,
                                `flame_intensity_min_value`,
                                `flame_intensity_max_value`,

                                `test_method_for_machine_speed`,
                                `uom_of_machine_speed`,
                                `machine_speed_min_value`,
                                `machine_speed_max_value`,

                                  `recording_person_id`,
                                  `recording_person_name`,
                                  `recording_time` ) 
                                  values 
                                  (
                                  '$pp_number',
                                  '$version_id',
                                  '$version_name',
                                  '$customer_name',
                                  '$customer_id',
                                  '$color',
                                   $finish_width_in_inch,
                                  '$standard_for_which_process',

                                  '$test_method_for_flame_intensity',
                                  '$uom_of_flame_intensity',
                                  '$flame_intensity_min_value',
                                  '$flame_intensity_max_value',

                                  '$test_method_for_machine_speed',
                                  '$uom_of_machine_speed',
                                  '$machine_speed_min_value',
                                  '$machine_speed_max_value',

                                  '$user_id',
                                  '$user_name',
                                   NOW()
                                    )";

                              mysqli_query($con,$insert_sql_statement_for_singe) or die(mysqli_error($con)); 

                              $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                              WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                              ORDER BY row_id DESC 
                              LIMIT 1";
                                  
                              $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                              $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                              if($row_for_last_process_route['process_id'] == 'proc_21')
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Singeing standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }
                              else
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Singeing standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }

                            }
                            else
                            {
                                $message = 'Already singeing standard defined';
                            }

                        }       // End singeing process
                        else if ($process_name == 'Desizing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_desizing = "select * from `model_defining_qc_standard_for_desizing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_desizing = mysqli_query($con, $select_sql_for_desizing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_desizing)> 0)
                            {
                              //if after checking data not found then insert new standard for desizing
                              //take model desizing all data 

                              /*............................................................Copy desizing..............................................................*/


                                $model_pp_version_desizing_process = "select * from `model_defining_qc_standard_for_desizing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_desizing_process = mysqli_query($con,$model_pp_version_desizing_process) or die(mysqli_error($con));
                                $row_old_pp_version_desizing_process = mysqli_fetch_array($result_model_pp_version_desizing_process);

                                $standard_for_which_process= $row_old_pp_version_desizing_process['process_name'];  

                                $test_method_for_machine_speed= $row_old_pp_version_desizing_process['test_method_for_machine_speed'];
                                $uom_of_machine_speed= $row_old_pp_version_desizing_process['uom_of_machine_speed'];
                                $machine_speed_min_value= $row_old_pp_version_desizing_process['machine_speed_min_value'];
                                $machine_speed_max_value= $row_old_pp_version_desizing_process['machine_speed_max_value'];

                                $test_method_for_bath_temperature= $row_old_pp_version_desizing_process['test_method_for_bath_temperature'];
                                $uom_of_bath_temperature= $row_old_pp_version_desizing_process['uom_of_bath_temperature'];
                                $bath_temperature_min_value= $row_old_pp_version_desizing_process['bath_temperature_min_value'];
                                $bath_temperature_max_value= $row_old_pp_version_desizing_process['bath_temperature_max_value'];

                                $test_method_for_bath_ph= $row_old_pp_version_desizing_process['test_method_for_bath_ph'];
                                $uom_of_bath_ph= $row_old_pp_version_desizing_process['uom_of_bath_ph'];
                                $bath_ph_min_value= $row_old_pp_version_desizing_process['bath_ph_min_value'];
                                $bath_ph_max_value= $row_old_pp_version_desizing_process['bath_ph_max_value'];


                                $insert_sql_statement_for_desize="insert into `defining_qc_standard_for_desizing_process`
                                ( 
                                `pp_number`,
                                `version_id`,
                                `version_number`,
                                `customer_name`,
                                `customer_id`,
                                `color`,
                                `finish_width_in_inch`,
                                `standard_for_which_process`,

                                `test_method_for_machine_speed`,
                                `uom_of_machine_speed`,
                                `machine_speed_min_value`,
                                `machine_speed_max_value`,

                                `test_method_for_bath_temperature`,
                                `uom_of_bath_temperature`,
                                `bath_temperature_min_value`,
                                `bath_temperature_max_value`,

                                `test_method_for_bath_ph`,
                                `uom_of_bath_ph`,
                                `bath_ph_min_value`,
                                `bath_ph_max_value`,

                                `recording_person_id`,
                                `recording_person_name`,
                                `recording_time` ) 
                                  values 
                                  (
                                  '$pp_number',
                                  '$version_id',
                                  '$version_name',
                                  '$customer_name',
                                  '$customer_id',
                                  '$color',
                                   $finish_width_in_inch,
                                  '$standard_for_which_process',

                                  '$test_method_for_machine_speed',
                                  '$uom_of_machine_speed',
                                  '$machine_speed_min_value',
                                  '$machine_speed_max_value',

                                  '$test_method_for_bath_temperature','
                                  $uom_of_bath_temperature',
                                  '$bath_temperature_min_value',
                                  '$bath_temperature_max_value',

                                  '$test_method_for_bath_ph',
                                  '$uom_of_bath_ph',
                                  '$bath_ph_min_value',
                                  '$bath_ph_max_value',

                                  '$user_id',
                                  '$user_name',
                                   NOW()
                                    )";

                              mysqli_query($con,$insert_sql_statement_for_desize) or die(mysqli_error($con)); 

                              $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                              WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                              ORDER BY row_id DESC 
                              LIMIT 1";
                                  
                              $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                              $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                              if($row_for_last_process_route['process_id'] == 'proc_22')
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Desizing standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }
                              else
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Desizing Calander standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }
                            }
                            else
                            {
                                $message = 'Already desizing standard defined';
                            }
                        }       // End desizing process
                        else if ($process_name == 'Singeing & Desizing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_singing_difine = "select * from `model_defining_qc_standard_for_singe_and_desize_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_singing_difine = mysqli_query($con, $select_sql_for_singing_difine) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_singing_difine)> 0)
                            {
                              //if after checking data not found then insert new standard for singe and desige

                              //take model singe and desige all data 

                              /*............................................................Copy singe_and_desize..............................................................*/


                                $model_pp_version_singe_and_desize_process = "select * from `model_defining_qc_standard_for_singe_and_desize_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_singe_and_desize_process = mysqli_query($con,$model_pp_version_singe_and_desize_process) or die(mysqli_error($con));
                                $row_old_pp_version_singe_and_desize_process = mysqli_fetch_array($result_model_pp_version_singe_and_desize_process);

                                $standard_for_which_process= $row_old_pp_version_singe_and_desize_process['process_name'];  

                                $test_method_for_flame_intensity= $row_old_pp_version_singe_and_desize_process['test_method_for_flame_intensity'];
                                $uom_of_flame_intensity= $row_old_pp_version_singe_and_desize_process['uom_of_flame_intensity'];
                                $flame_intensity_min_value= $row_old_pp_version_singe_and_desize_process['flame_intensity_min_value'];
                                $flame_intensity_max_value= $row_old_pp_version_singe_and_desize_process['flame_intensity_max_value'];

                                $test_method_for_machine_speed= $row_old_pp_version_singe_and_desize_process['test_method_for_machine_speed'];
                                $uom_of_machine_speed= $row_old_pp_version_singe_and_desize_process['uom_of_machine_speed'];
                                $machine_speed_min_value= $row_old_pp_version_singe_and_desize_process['machine_speed_min_value'];
                                $machine_speed_max_value= $row_old_pp_version_singe_and_desize_process['machine_speed_max_value'];

                                $test_method_for_bath_temperature= $row_old_pp_version_singe_and_desize_process['test_method_for_bath_temperature'];
                                $uom_of_bath_temperature= $row_old_pp_version_singe_and_desize_process['uom_of_bath_temperature'];
                                $bath_temperature_min_value= $row_old_pp_version_singe_and_desize_process['bath_temperature_min_value'];
                                $bath_temperature_max_value= $row_old_pp_version_singe_and_desize_process['bath_temperature_max_value'];

                                $test_method_for_bath_ph= $row_old_pp_version_singe_and_desize_process['test_method_for_bath_ph'];
                                $uom_of_bath_ph= $row_old_pp_version_singe_and_desize_process['uom_of_bath_ph'];
                                $bath_ph_min_value= $row_old_pp_version_singe_and_desize_process['bath_ph_min_value'];
                                $bath_ph_max_value= $row_old_pp_version_singe_and_desize_process['bath_ph_max_value'];



                                $insert_sql_statement_for_singe_and_desize="insert into `defining_qc_standard_for_singe_and_desize_process`
                                   ( 
                                   `pp_number`,
                                   `version_id`,
                                   `version_number`,
                                   `customer_name`,
                                   `customer_id`,
                                   `color`,
                                   `finish_width_in_inch`,
                                   `standard_for_which_process`,

                                   `test_method_for_flame_intensity`,
                                   `uom_of_flame_intensity`,
                                   `flame_intensity_min_value`,
                                   `flame_intensity_max_value`,

                                   `test_method_for_machine_speed`,
                                   `uom_of_machine_speed`,
                                   `machine_speed_min_value`,
                                   `machine_speed_max_value`,

                                   `test_method_for_bath_temperature`,
                                   `uom_of_bath_temperature`,
                                   `bath_temperature_min_value`,
                                   `bath_temperature_max_value`,

                                   `test_method_for_bath_ph`,
                                   `uom_of_bath_ph`,
                                   `bath_ph_min_value`,
                                     `bath_ph_max_value`,
                                     `recording_person_id`,
                                     `recording_person_name`,
                                     `recording_time` ) 
                                     values 
                                     (
                                     '$pp_number',
                                     '$version_id',
                                     '$version_name',
                                     '$customer_name',
                                     '$customer_id',
                                     '$color',
                                      $finish_width_in_inch,
                                     '$standard_for_which_process',

                                     '$test_method_for_flame_intensity',
                                     '$uom_of_flame_intensity',
                                     '$flame_intensity_min_value',
                                     '$flame_intensity_max_value',

                                     '$test_method_for_machine_speed',
                                     '$uom_of_machine_speed',
                                     '$machine_speed_min_value',
                                     '$machine_speed_max_value',

                                     '$test_method_for_bath_temperature','
                                     $uom_of_bath_temperature',
                                     '$bath_temperature_min_value',
                                     '$bath_temperature_max_value',

                                     '$test_method_for_bath_ph',
                                     '$uom_of_bath_ph',
                                     '$bath_ph_min_value',
                                     '$bath_ph_max_value',
                                     '$user_id',
                                     '$user_name',
                                      NOW()
                                       )";

                                 mysqli_query($con,$insert_sql_statement_for_singe_and_desize) or die(mysqli_error($con));   
                                 
                                 $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                 WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                 ORDER BY row_id DESC 
                                 LIMIT 1";
                                     
                                 $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                 $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                 if($row_for_last_process_route['process_id'] == 'proc_1')
                                 {
                                     $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Singeing & Desizing standard' 
                                     WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                     mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                 }
                                 else
                                 {
                                     $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Singeing & Desizing standard' 
                                     WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                     mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                 }

                            }
                            else
                            {
                                $message = 'Already singe & desize standard defined';
                            }
                        }       // End singeing and desizing process
                        else if ($process_name == 'Scouring') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_scouring = "select * from `model_defining_qc_standard_for_scouring_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_scouring = mysqli_query($con, $select_sql_for_scouring) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_scouring)> 0)
                            {
                              //if after checking data not found then insert new standard for scouring

                              //take model scouring all data 

                              /*............................................................Copy scouring..............................................................*/


                                $model_pp_version_scouring_process = "select * from `model_defining_qc_standard_for_scouring_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_scouring_process = mysqli_query($con,$model_pp_version_scouring_process) or die(mysqli_error($con));
                                $row_old_pp_version_scouring_process = mysqli_fetch_array($result_model_pp_version_scouring_process);

                                $standard_for_which_process= $row_old_pp_version_scouring_process['process_name'];  

                                $test_method_for_residual_sizing_material= $row_old_pp_version_scouring_process['test_method_for_residual_sizing_material'];
                                $residual_sizing_material_min_value= $row_old_pp_version_scouring_process['residual_sizing_material_min_value'];
                                $residual_sizing_material_max_value= $row_old_pp_version_scouring_process['residual_sizing_material_max_value'];
                                $uom_of_residual_sizing_material= $row_old_pp_version_scouring_process['uom_of_residual_sizing_material'];


                                $test_method_for_absorbency= $row_old_pp_version_scouring_process['test_method_for_absorbency'];
                                $absorbency_min_value= $row_old_pp_version_scouring_process['absorbency_min_value'];
                                $absorbency_max_value= $row_old_pp_version_scouring_process['absorbency_max_value'];
                                $uom_of_absorbency= $row_old_pp_version_scouring_process['uom_of_absorbency'];

                                $test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
                                $resistance_to_surface_fuzzing_and_pilling_min_value= $row_old_pp_version_scouring_process['resistance_to_surface_fuzzing_and_pilling_min_value'];
                                $resistance_to_surface_fuzzing_and_pilling_max_value= $row_old_pp_version_scouring_process['resistance_to_surface_fuzzing_and_pilling_max_value'];
                                $uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

                                
                                $test_method_for_ph= $row_old_pp_version_scouring_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_scouring_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_scouring_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_scouring_process['uom_of_ph'];

                                $insert_sql_statement_for_scouring="insert into `defining_qc_standard_for_scouring_process` 
                                        ( 
                                        `pp_number`,
                                        `version_id`,
                                        `version_number`,
                                        `customer_name`,
                                        `customer_id`,
                                        `color`,
                                        `finish_width_in_inch`,
                                        `standard_for_which_process`,


                                        `test_method_for_residual_sizing_material`,
                                        `residual_sizing_material_min_value`,
                                        `residual_sizing_material_max_value`,
                                        `uom_of_residual_sizing_material`,

                                        `test_method_for_absorbency`,
                                        `absorbency_min_value`,
                                        `absorbency_max_value`,
                                        `uom_of_absorbency`,

                                        `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
                                        `resistance_to_surface_fuzzing_and_pilling_min_value`,
                                        `resistance_to_surface_fuzzing_and_pilling_max_value`,
                                        `uom_of_resistance_to_surface_fuzzing_and_pilling`,

	                     
                                        `test_method_for_ph`, 
                                        `ph_min_value`, 
                                        `ph_max_value`,
                                        `uom_of_ph`, 

                                        `recording_person_id`,
                                        `recording_person_name`,
                                        `recording_time` 
                                        ) 
                                        values 
                                        (
                                        '$pp_number',
                                        '$version_id',
                                        '$version_name',
                                        '$customer_name',
                                        '$customer_id',
                                        '$color',
                                        '$finish_width_in_inch',
                                        '$standard_for_which_process',

                        
                                        '$test_method_for_residual_sizing_material',
                                        '$residual_sizing_material_min_value',
                                        '$residual_sizing_material_max_value',
                                        '$uom_of_residual_sizing_material',

                                        '$test_method_for_absorbency',
                                        '$absorbency_min_value',
                                        '$absorbency_max_value',
                                        '$uom_of_absorbency',
                                        
                                        '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
                                        '$resistance_to_surface_fuzzing_and_pilling_min_value',
                                        '$resistance_to_surface_fuzzing_and_pilling_max_value',
                                        '$uom_of_resistance_to_surface_fuzzing_and_pilling',

                        
                                        '$test_method_for_ph',
                                        '$ph_min_value',
                                        '$ph_max_value',
                                        '$uom_of_ph',


                                        '$user_id',
                                        '$user_name',
                                        NOW()
                                        )";

	                            mysqli_query($con,$insert_sql_statement_for_scouring) or die(mysqli_error($con));    
                                
                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_2')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Scouring standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Scouring standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                            }
                            else
                            {
                                $message = 'Already scouring standard defined';
                            }
                        }       // End scouring process
                        else if ($process_name == 'Bleaching') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_bleaching = "select * from `model_defining_qc_standard_for_bleaching_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_bleaching = mysqli_query($con, $select_sql_for_bleaching) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_bleaching)> 0)
                            {
                              //if after checking data not found then insert new standard for bleaching
                              //take model bleaching all data 

                              /*............................................................Copy bleaching..............................................................*/


                                $model_pp_version_bleaching_process = "select * from `model_defining_qc_standard_for_bleaching_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_bleaching_process = mysqli_query($con,$model_pp_version_bleaching_process) or die(mysqli_error($con));
                                $row_old_pp_version_bleaching_process = mysqli_fetch_array($result_model_pp_version_bleaching_process);

                                $standard_for_which_process= $row_old_pp_version_bleaching_process['process_name'];  

                                $test_id_for_whiteness= $row_old_pp_version_bleaching_process['test_id_for_whiteness'];
                                $test_method_for_whiteness= $row_old_pp_version_bleaching_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_bleaching_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_bleaching_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_bleaching_process['uom_of_whiteness'];



                                $test_id_for_residual_sizing_material= $row_old_pp_version_bleaching_process['test_id_for_residual_sizing_material'];
                                $test_method_for_residual_sizing_material= $row_old_pp_version_bleaching_process['test_method_for_residual_sizing_material'];
                                $residual_sizing_material_min_value= $row_old_pp_version_bleaching_process['residual_sizing_material_min_value'];
                                $residual_sizing_material_max_value= $row_old_pp_version_bleaching_process['residual_sizing_material_max_value'];
                                $uom_of_residual_sizing_material= $row_old_pp_version_bleaching_process['uom_of_residual_sizing_material'];


                                $test_id_for_absorbency= $row_old_pp_version_bleaching_process['test_id_for_absorbency'];
                                $test_method_for_absorbency= $row_old_pp_version_bleaching_process['test_method_for_absorbency'];
                                $absorbency_min_value= $row_old_pp_version_bleaching_process['absorbency_min_value'];
                                $absorbency_max_value= $row_old_pp_version_bleaching_process['absorbency_max_value'];
                                $uom_of_absorbency= $row_old_pp_version_bleaching_process['uom_of_absorbency'];

                                $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                $test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_tolerance_range_math_operator= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
                                $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
                                $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['rubs_for_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_min_value'];
                                $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_bleaching_process['surface_fuzzing_and_pilling_max_value'];
                                $uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

                                
                                $test_id_for_ph= $row_old_pp_version_bleaching_process['test_id_for_ph'];
                                $test_method_for_ph= $row_old_pp_version_bleaching_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_bleaching_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_bleaching_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_bleaching_process['uom_of_ph'];

                                $insert_sql_statement_for_bleaching="insert into `defining_qc_standard_for_bleaching_process` 
                                                        ( 
                                                        `pp_number`,
                                                        `version_id`,
                                                        `version_number`,
                                                        `customer_name`,
                                                        `customer_id`,
                                                        `color`,
                                                        `finish_width_in_inch`,
                                                        `standard_for_which_process`,

                                                        `test_id_for_whiteness`, 
                                                        `test_method_for_whiteness`, 
                                                        `whiteness_min_value`, 
                                                        `whiteness_max_value`, 
                                                        `uom_of_whiteness`, 

                                                        `test_id_for_residual_sizing_material`,
                                                        `test_method_for_residual_sizing_material`,
                                                        `residual_sizing_material_min_value`,
                                                        `residual_sizing_material_max_value`,
                                                        `uom_of_residual_sizing_material`,

                                                        `test_id_for_absorbency`,
                                                        `test_method_for_absorbency`,
                                                        `absorbency_min_value`,
                                                        `absorbency_max_value`,
                                                        `uom_of_absorbency`,

                                                        `description_or_type_for_surface_fuzzing_and_pilling`,
                                                        `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
                                                        `surface_fuzzing_and_pilling_tolerance_range_math_operator`,
                                                        `surface_fuzzing_and_pilling_tolerance_value`,
                                                        `rubs_for_surface_fuzzing_and_pilling`,
                                                        `surface_fuzzing_and_pilling_min_value`,
                                                        `surface_fuzzing_and_pilling_max_value`,
                                                        `uom_of_resistance_to_surface_fuzzing_and_pilling`,

	                     
                                                        `test_id_for_ph`, 
                                                        `test_method_for_ph`, 
                                                        `ph_min_value`, 
                                                        `ph_max_value`,
                                                        `uom_of_ph`, 

                                                        `recording_person_id`,
                                                        `recording_person_name`,
                                                        `recording_time` 
                                                        ) 
                                                        values 
                                                        (
                                                        '$pp_number',
                                                        '$version_id',
                                                        '$version_name',
                                                        '$customer_name',
                                                        '$customer_id',
                                                        '$color',
                                                        '$finish_width_in_inch',
                                                        '$standard_for_which_process',

                                                        
                                                        '$test_id_for_whiteness',
                                                        '$test_method_for_whiteness',
                                                        '$whiteness_min_value',
                                                        '$whiteness_max_value',
                                                        '$uom_of_whiteness',

                                                        '$test_id_for_residual_sizing_material',
                                                        '$test_method_for_residual_sizing_material',
                                                        '$residual_sizing_material_min_value',
                                                        '$residual_sizing_material_max_value',
                                                        '$uom_of_residual_sizing_material',

                                                        '$test_id_for_absorbency',
                                                        '$test_method_for_absorbency',
                                                        '$absorbency_min_value',
                                                        '$absorbency_max_value',
                                                        '$uom_of_absorbency',
                                                        
                                                        '$description_or_type_for_surface_fuzzing_and_pilling',
                                                        '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
                                                        '$surface_fuzzing_and_pilling_tolerance_range_math_operator',
                                                        '$surface_fuzzing_and_pilling_tolerance_value',
                                                        '$rubs_for_surface_fuzzing_and_pilling',
                                                        '$surface_fuzzing_and_pilling_min_value',
                                                        '$surface_fuzzing_and_pilling_max_value',
                                                        '$uom_of_resistance_to_surface_fuzzing_and_pilling',

                                                        
                                                        '$test_id_for_ph',
                                                        '$test_method_for_ph',
                                                        '$ph_min_value',
                                                        '$ph_max_value',
                                                        '$uom_of_ph',


                                                        '$user_id',
                                                        '$user_name',
                                                        NOW()
                                                        )";

	                            mysqli_query($con,$insert_sql_statement_for_bleaching) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_3')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Bleaching standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Bleaching standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                            }
                            else
                            {
                                $message = 'Already bleaching standard defined';
                            }
                        }       // End bleaching process
                        else if ($process_name == 'Scouring & Bleaching') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_scouring_bleaching = "select * from `model_defining_qc_standard_for_scouring_bleaching_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_scouring_bleaching = mysqli_query($con, $select_sql_for_scouring_bleaching) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_scouring_bleaching)> 0)
                            {
                              //if after checking data not found then insert new standard for Scouring & Bleaching
                              //take model Scouring & Bleaching all data 

                              /*............................................................Copy Scouring & Bleaching..............................................................*/


                                $model_pp_version_scouring_bleaching_process = "select * from `model_defining_qc_standard_for_scouring_bleaching_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_scouring_bleaching_process = mysqli_query($con,$model_pp_version_scouring_bleaching_process) or die(mysqli_error($con));
                                $row_old_pp_version_scouring_bleaching_process = mysqli_fetch_array($result_model_pp_version_scouring_bleaching_process);

                                $standard_for_which_process= $row_old_pp_version_scouring_bleaching_process['process_name'];  

                                $test_method_for_whiteness= $row_old_pp_version_scouring_bleaching_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_scouring_bleaching_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_scouring_bleaching_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_scouring_bleaching_process['uom_of_whiteness'];



                                $test_method_for_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['test_method_for_residual_sizing_material'];
                                $residual_sizing_material_min_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_min_value'];
                                $residual_sizing_material_max_value= $row_old_pp_version_scouring_bleaching_process['residual_sizing_material_max_value'];
                                $uom_of_residual_sizing_material= $row_old_pp_version_scouring_bleaching_process['uom_of_residual_sizing_material'];


                                $test_method_for_absorbency= $row_old_pp_version_scouring_bleaching_process['test_method_for_absorbency'];
                                $absorbency_min_value= $row_old_pp_version_scouring_bleaching_process['absorbency_min_value'];
                                $absorbency_max_value= $row_old_pp_version_scouring_bleaching_process['absorbency_max_value'];
                                $uom_of_absorbency= $row_old_pp_version_scouring_bleaching_process['uom_of_absorbency'];

                                $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                $test_method_for_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                                $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
                                $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['rubs_for_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_min_value'];
                                $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_scouring_bleaching_process['surface_fuzzing_and_pilling_max_value'];
                                $uom_of_resistance_to_surface_fuzzing_and_pilling= $row_old_pp_version_scouring_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling'];

                                
                                $test_method_for_ph= $row_old_pp_version_scouring_bleaching_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_scouring_bleaching_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_scouring_bleaching_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_scouring_bleaching_process['uom_of_ph'];

                                $insert_sql_statement_for_scouring_bleaching="insert into `defining_qc_standard_for_scouring_bleaching_process` 
                                ( 
                                `pp_number`,
                                `version_id`,
                                `version_number`,
                                `customer_name`,
                                `customer_id`,
                                `color`,
                                `finish_width_in_inch`,
                                `standard_for_which_process`,
       
                                `test_method_for_whiteness`, 
                                `whiteness_min_value`, 
                                `whiteness_max_value`, 
                                `uom_of_whiteness`, 
       
                                `test_method_for_residual_sizing_material`,
                                `residual_sizing_material_min_value`,
                                `residual_sizing_material_max_value`,
                                `uom_of_residual_sizing_material`,
       
                                `test_method_for_absorbency`,
                                `absorbency_min_value`,
                                `absorbency_max_value`,
                                `uom_of_absorbency`,
       
                                `description_or_type_for_surface_fuzzing_and_pilling`,
                                `test_method_for_resistance_to_surface_fuzzing_and_pilling`,
                                `surface_fuzzing_and_pilling_tolerance_range_math_operator`,
                                `surface_fuzzing_and_pilling_tolerance_value`,
                                `rubs_for_surface_fuzzing_and_pilling`,
                                `surface_fuzzing_and_pilling_min_value`,
                                `surface_fuzzing_and_pilling_max_value`,
                                `uom_of_resistance_to_surface_fuzzing_and_pilling`,
       
                                
                               `test_method_for_ph`, 
                               `ph_min_value`, 
                               `ph_max_value`,
                               `uom_of_ph`, 
       
                                `recording_person_id`,
                                `recording_person_name`,
                                `recording_time` 
                                ) 
                               values 
                               (
                               '$pp_number',
                               '$version_id',
                               '$version_name',
                               '$customer_name',
                               '$customer_id',
                               '$color',
                               '$finish_width_in_inch',
                               '$standard_for_which_process',
       
                               
                               '$test_method_for_whiteness',
                               '$whiteness_min_value',
                               '$whiteness_max_value',
                               '$uom_of_whiteness',
       
                               '$test_method_for_residual_sizing_material',
                               '$residual_sizing_material_min_value',
                               '$residual_sizing_material_max_value',
                               '$uom_of_residual_sizing_material',
       
                               '$test_method_for_absorbency',
                               '$absorbency_min_value',
                               '$absorbency_max_value',
                               '$uom_of_absorbency',
                               
                               '$description_or_type_for_surface_fuzzing_and_pilling',
                               '$test_method_for_resistance_to_surface_fuzzing_and_pilling',
                               '$surface_fuzzing_and_pilling_tolerance_range_math_operator',
                               '$surface_fuzzing_and_pilling_tolerance_value',
                               '$rubs_for_surface_fuzzing_and_pilling',
                               '$surface_fuzzing_and_pilling_min_value',
                               '$surface_fuzzing_and_pilling_max_value',
                               '$uom_of_resistance_to_surface_fuzzing_and_pilling',
                               
                               '$test_method_for_ph',
                               '$ph_min_value',
                               '$ph_max_value',
                               '$uom_of_ph',
       
       
                                '$user_id',
                                '$user_name',
                                 NOW()
                                )";
       
                                mysqli_query($con,$insert_sql_statement_for_scouring_bleaching) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_4')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Scouring & Bleaching standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Scouring & Bleaching standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }

                            }
                            else
                            {
                                $message = 'Already scouring & bleaching standard defined';
                            }
                        }       // End scouring & bleaching process
                        else if ($process_name == 'Ready For Mercerize') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_ready_for_mercerize = "select * from `model_defining_qc_standard_for_ready_for_mercerize_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_ready_for_mercerize = mysqli_query($con, $select_sql_for_ready_for_mercerize) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_ready_for_mercerize)> 0)
                            {
                              //if after checking data not found then insert new standard for Ready For Mercerize
                              //take model Ready For Mercerize all data 

                              /*............................................................Copy Ready For Mercerize..............................................................*/


                                $model_pp_version_ready_for_mercerize_process = "select * from `model_defining_qc_standard_for_ready_for_mercerize_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_ready_for_mercerize_process = mysqli_query($con,$model_pp_version_ready_for_mercerize_process) or die(mysqli_error($con));
                                $row_old_pp_version_ready_for_mercerize_process = mysqli_fetch_array($result_model_pp_version_ready_for_mercerize_process);

                                $standard_for_which_process= $row_old_pp_version_ready_for_mercerize_process['process_name'];
                                
                                $test_method_for_whiteness= $row_old_pp_version_ready_for_mercerize_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_ready_for_mercerize_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_ready_for_mercerize_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_ready_for_mercerize_process['uom_of_whiteness'];


                                $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_mercerize_process['test_method_for_bowing_and_skew'];
                                $bowing_and_skew_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_tolerance_range_math_operator'])));
                                $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_tolerance_value'];
                                $bowing_and_skew_min_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_min_value'];
                                $bowing_and_skew_max_value= $row_old_pp_version_ready_for_mercerize_process['bowing_and_skew_max_value'];
                                $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_mercerize_process['uom_of_bowing_and_skew'];


                                
                                $test_method_for_ph= $row_old_pp_version_ready_for_mercerize_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_ready_for_mercerize_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_ready_for_mercerize_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_ready_for_mercerize_process['uom_of_ph'];


                                $insert_sql_statement_for_ready_for_mercerize="INSERT INTO `defining_qc_standard_for_ready_for_mercerize_process`
                                                (
                                                `pp_number`, 
                                                `version_id`, 
                                                `version_number`, 
                                                `customer_name`, 
                                                `customer_id`, 
                                                `color`, 
                                                `finish_width_in_inch`, 
                                                `standard_for_which_process`, 

                                                
                                                `test_method_for_whiteness`, 
                                                `whiteness_min_value`, 
                                                `whiteness_max_value`, 
                                                `uom_of_whiteness`, 

                                                `test_method_for_bowing_and_skew`, 
                                                `bowing_and_skew_tolerance_range_math_operator`, 
                                                `bowing_and_skew_tolerance_value`, 
                                                `bowing_and_skew_min_value`, 
                                                `bowing_and_skew_max_value`, 
                                                `uom_of_bowing_and_skew`,

                                                `test_method_for_ph`, 
                                                `ph_min_value`, 
                                                `ph_max_value`,
                                                `uom_of_ph`,  

                                                `recording_person_id`, 
                                                `recording_person_name`, 
                                                `recording_time`
                                                )
                                                VALUES 
                                                (
                                                '$pp_number',
                                                '$version_id',
                                                '$version_name',
                                                '$customer_name',
                                                '$customer_id',
                                                '$color',
                                                '$finish_width_in_inch',
                                                '$standard_for_which_process',

                                                
                                                '$test_method_for_whiteness',
                                                '$whiteness_min_value',
                                                '$whiteness_max_value',
                                                '$uom_of_whiteness',

                                                '$test_method_for_bowing_and_skew',
                                                '$bowing_and_skew_tolerance_range_math_operator',
                                                '$bowing_and_skew_tolerance_value',
                                                '$bowing_and_skew_min_value',
                                                '$bowing_and_skew_max_value',
                                                '$uom_of_bowing_and_skew',

                                                '$test_method_for_ph',
                                                '$ph_min_value',
                                                '$ph_max_value',
                                                '$uom_of_ph',

                                                '$user_id',
                                                '$user_name',
                                                NOW()
                                                )";
  
	                            mysqli_query($con,$insert_sql_statement_for_ready_for_mercerize) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_5')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Ready For Mercerize standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Ready For Mercerize standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }

                            }
                            else
                            {
                                $message = 'Already ready for mercerize standard defined';
                            }
                        }       // End ready for mercerize process
                        else if ($process_name == 'Mercerize') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_mercerize = "select * from `model_defining_qc_standard_for_mercerize_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_mercerize = mysqli_query($con, $select_sql_for_mercerize) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_mercerize)> 0)
                            {
                              //if after checking data not found then insert new standard for Mercerize
                              //take model Mercerize all data 

                              /*............................................................Copy Mercerize..............................................................*/


                                $model_pp_version_mercerize_process = "select * from `model_defining_qc_standard_for_mercerize_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_mercerize_process = mysqli_query($con,$model_pp_version_mercerize_process) or die(mysqli_error($con));
                                $row_old_pp_version_mercerize_process = mysqli_fetch_array($result_model_pp_version_mercerize_process);

                                $standard_for_which_process= $row_old_pp_version_mercerize_process['process_name'];  

                                
                                $test_method_for_whiteness= $row_old_pp_version_mercerize_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_mercerize_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_mercerize_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_mercerize_process['uom_of_whiteness'];

                                $test_method_for_absorbency= $row_old_pp_version_mercerize_process['test_method_for_absorbency'];
                                $absorbency_min_value= $row_old_pp_version_mercerize_process['absorbency_min_value'];
                                $absorbency_max_value= $row_old_pp_version_mercerize_process['absorbency_max_value'];
                                $uom_of_absorbency= $row_old_pp_version_mercerize_process['uom_of_absorbency'];

                                $test_method_for_residual_sizing_material= $row_old_pp_version_mercerize_process['test_method_for_residual_sizing_material'];
                                $residual_sizing_material_min_value= $row_old_pp_version_mercerize_process['residual_sizing_material_min_value'];
                                $residual_sizing_material_max_value= $row_old_pp_version_mercerize_process['residual_sizing_material_max_value'];
                                $uom_of_residual_sizing_material= $row_old_pp_version_mercerize_process['uom_of_residual_sizing_material'];

                                
                                $test_method_for_ph= $row_old_pp_version_mercerize_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_mercerize_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_mercerize_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_mercerize_process['uom_of_ph'];


                                $insert_sql_statement_for_mercerize="insert into `defining_qc_standard_for_mercerize_process` 
                                ( 
                                `pp_number`,
                                `version_id`,
                                `version_number`,
                                `customer_name`,
                                `customer_id`,
                                `color`,
                                `finish_width_in_inch`,
                                `standard_for_which_process`,
       
                                `test_method_for_whiteness`, 
                                `whiteness_min_value`, 
                                `whiteness_max_value`, 
                                `uom_of_whiteness`, 
       
                                `test_method_for_absorbency`,
                                `absorbency_min_value`,
                                `absorbency_max_value`,
                                `uom_of_absorbency`,
       
                                `test_method_for_residual_sizing_material`,
                                `residual_sizing_material_min_value`,
                                `residual_sizing_material_max_value`,
                                `uom_of_residual_sizing_material`,
       
       
                                `test_method_for_ph`, 
                                `ph_min_value`, 
                                `ph_max_value`,
                                `uom_of_ph`, 
        
                                `recording_person_id`,
                                `recording_person_name`,
                                `recording_time` 
                                ) 
                                values 
                                (
                                '$pp_number',
                                '$version_id',
                                '$version_name',
                                '$customer_name',
                                '$customer_id',
                                '$color',
                                '$finish_width_in_inch',
                                '$standard_for_which_process',
        
                               
                                '$test_method_for_whiteness',
                                '$whiteness_min_value',
                                '$whiteness_max_value',
                                '$uom_of_whiteness',
        
                                '$test_method_for_absorbency',
                                '$absorbency_min_value',
                                '$absorbency_max_value',
                                '$uom_of_absorbency',
        
                                    '$test_method_for_residual_sizing_material',
                                '$residual_sizing_material_min_value',
                                '$residual_sizing_material_max_value',
                                '$uom_of_residual_sizing_material',
        
                                '$test_method_for_ph',
                                '$ph_min_value',
                                '$ph_max_value',
                                '$uom_of_ph',
       
       
                                '$user_id',
                                '$user_name',
                                 NOW()
                                )";
       
                                mysqli_query($con,$insert_sql_statement_for_mercerize) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_6')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Mercerize standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Mercerize standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                            }
                            else
                            {
                                $message = 'Already mercerize standard defined';
                            }
                        }       // End mercerize process
                        else if ($process_name == 'Ready For Print') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_ready_for_print = "select * from `model_defining_qc_standard_for_ready_for_printing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_ready_for_print = mysqli_query($con, $select_sql_for_ready_for_print) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_ready_for_print)> 0)
                            {
                              //if after checking data not found then insert new standard for Ready For Print
                              //take model Ready For Print all data 

                              /*............................................................Copy Ready For Print..............................................................*/


                                $model_pp_version_ready_for_print_process = "select * from `model_defining_qc_standard_for_ready_for_printing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_ready_for_print_process = mysqli_query($con,$model_pp_version_ready_for_print_process) or die(mysqli_error($con));
                                $row_old_pp_version_ready_for_print_process = mysqli_fetch_array($result_model_pp_version_ready_for_print_process);

                                $standard_for_which_process= $row_old_pp_version_ready_for_print_process['process_name']; 
                                
                                
                                $test_method_for_whiteness= $row_old_pp_version_ready_for_print_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_ready_for_print_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_ready_for_print_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_ready_for_print_process['uom_of_whiteness'];


                                $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_print_process['test_method_for_bowing_and_skew'];
                                $bowing_and_skew_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_print_process['bowing_and_skew_tolerance_range_math_operator'])));
                                $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_print_process['bowing_and_skew_tolerance_value'];
                                $bowing_and_skew_min_value= $row_old_pp_version_ready_for_print_process['bowing_and_skew_min_value'];
                                $bowing_and_skew_max_value= $row_old_pp_version_ready_for_print_process['bowing_and_skew_max_value'];
                                $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_print_process['uom_of_bowing_and_skew'];


                                
                                $test_method_for_ph= $row_old_pp_version_ready_for_print_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_ready_for_print_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_ready_for_print_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_ready_for_print_process['uom_of_ph'];

                                $insert_sql_statement_for_ready_for_printing="INSERT INTO `defining_qc_standard_for_ready_for_printing_process`
                                    (
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`, 
                                    `standard_for_which_process`, 

                                    
                                    `test_method_for_whiteness`, 
                                    `whiteness_min_value`, 
                                    `whiteness_max_value`, 
                                    `uom_of_whiteness`, 

                                    `test_method_for_bowing_and_skew`, 
                                    `bowing_and_skew_tolerance_range_math_operator`, 
                                    `bowing_and_skew_tolerance_value`, 
                                    `bowing_and_skew_min_value`, 
                                    `bowing_and_skew_max_value`, 
                                    `uom_of_bowing_and_skew`,

                                    `test_method_for_ph`, 
                                    `ph_min_value`, 
                                    `ph_max_value`,
                                    `uom_of_ph`,  

                                    `recording_person_id`, 
                                    `recording_person_name`, 
                                    `recording_time`
                                    )
                                        VALUES 
                                        (
                                        '$pp_number',
                                        '$version_id',
                                        '$version_name',
                                        '$customer_name',
                                        '$customer_id',
                                        '$color',
                                        '$finish_width_in_inch',
                                        '$standard_for_which_process',

	                        
                                        '$test_method_for_whiteness',
                                        '$whiteness_min_value',
                                        '$whiteness_max_value',
                                        '$uom_of_whiteness',

                                        '$test_method_for_bowing_and_skew',
                                        '$bowing_and_skew_tolerance_range_math_operator',
                                        '$bowing_and_skew_tolerance_value',
                                        '$bowing_and_skew_min_value',
                                        '$bowing_and_skew_max_value',
                                        '$uom_of_bowing_and_skew',

                                        '$test_method_for_ph',
                                        '$ph_min_value',
                                        '$ph_max_value',
                                        '$uom_of_ph',

                                        '$user_id',
                                        '$user_name',
                                        NOW()
                                        )";
  
	                            mysqli_query($con,$insert_sql_statement_for_ready_for_printing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_7')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Ready For Print standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Ready For Print standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                            }
                            else
                            {
                                $message = 'Already ready for print standard defined';
                            }
                        }       // End ready_for_print process
                        else if ($process_name == 'Printing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_printing = "select * from `model_defining_qc_standard_for_printing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_printing = mysqli_query($con, $select_sql_for_printing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_printing)> 0)
                            {
                              //if after checking data not found then insert new standard for Printing
                              //take model Printing all data 

                              /*............................................................Copy Printing..............................................................*/


                                $model_pp_version_printing_process = "select * from `model_defining_qc_standard_for_printing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_printing_process = mysqli_query($con,$model_pp_version_printing_process) or die(mysqli_error($con));
                                $row_old_pp_version_printing_process = mysqli_fetch_array($result_model_pp_version_printing_process);

                                $standard_for_which_process= $row_old_pp_version_printing_process['process_name']; 
                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_printing_process['test_method_for_cf_to_rubbing_dry'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_printing_process['uom_of_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_printing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_printing_process['cf_to_rubbing_dry_max_value'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_printing_process['test_method_for_cf_to_rubbing_wet'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_printing_process['uom_of_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_printing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_printing_process['cf_to_rubbing_wet_max_value'];

                                $insert_sql_statement_for_printing="insert into `defining_qc_standard_for_printing_process` 
                                        ( 
                                            `pp_number`,
                                            `version_id`,
                                            `version_number`,
                                            `customer_name`,
                                            `customer_id`,
                                            `color`,
                                            `finish_width_in_inch`,
                                            `standard_for_which_process`,

                                            `test_method_for_cf_to_rubbing_dry`,
                                            `uom_of_cf_to_rubbing_dry`,
                                            `cf_to_rubbing_dry_tolerance_range_math_operator`,
                                            `cf_to_rubbing_dry_tolerance_value`,
                                            `cf_to_rubbing_dry_min_value`,
                                            `cf_to_rubbing_dry_max_value`,
                                            `test_method_for_cf_to_rubbing_wet`,
                                            `uom_of_cf_to_rubbing_wet`,
                                            `cf_to_rubbing_wet_tolerance_range_math_operator`,
                                            `cf_to_rubbing_wet_tolerance_value`,
                                            `cf_to_rubbing_wet_min_value`,
                                            `cf_to_rubbing_wet_max_value`,
                                            `recording_person_id`,
                                            `recording_person_name`,
                                            `recording_time` 
                                        ) 
                                        values 
                                        (
                                            '$pp_number',
                                            '$version_id',
                                            '$version_name',
                                            '$customer_name',
                                            '$customer_id',
                                            '$color',
                                            $finish_width_in_inch,
                                            '$standard_for_which_process',
                                            '$test_method_for_cf_to_rubbing_dry',
                                            '$uom_of_cf_to_rubbing_dry',
                                            '$cf_to_rubbing_dry_tolerance_range_math_operator',
                                            '$cf_to_rubbing_dry_tolerance_value',
                                            '$cf_to_rubbing_dry_min_value',
                                            '$cf_to_rubbing_dry_max_value',
                                            '$test_method_for_cf_to_rubbing_wet',
                                            '$uom_of_cf_to_rubbing_wet',
                                            '$cf_to_rubbing_wet_tolerance_range_math_operator',
                                            '$cf_to_rubbing_wet_tolerance_value',
                                            '$cf_to_rubbing_wet_min_value',
                                            '$cf_to_rubbing_wet_max_value',
                                            '$user_id',
                                            '$user_name',
                                            NOW()
                                            )";
                            
                                mysqli_query($con,$insert_sql_statement_for_printing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_8')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Printing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Printing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }

                            }
                            else
                            {
                                $message = 'Already printing standard defined';
                            }
                        }       // End printing process
                        else if ($process_name == 'Curing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_curing = "select * from `model_defining_qc_standard_for_curing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_curing = mysqli_query($con, $select_sql_for_curing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_curing)> 0)
                            {
                              //if after checking data not found then insert new standard for Curing
                              //take model Curing all data 

                              /*............................................................Copy Curing..............................................................*/


                                $model_pp_version_curing_process = "select * from `model_defining_qc_standard_for_curing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_curing_process = mysqli_query($con,$model_pp_version_curing_process) or die(mysqli_error($con));
                                $row_old_pp_version_curing_process = mysqli_fetch_array($result_model_pp_version_curing_process);

                                $standard_for_which_process= $row_old_pp_version_curing_process['process_name']; 
                                
                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_curing_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_curing_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_curing_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_curing_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_curing_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_curing_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_curing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
                                $washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_curing_process['washing_cycle_for_warp_for_washing_before_iron'];
                                $dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_curing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
                                $dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_curing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_curing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_curing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
                                $washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_curing_process['washing_cycle_for_weft_for_washing_before_iron'];
                                $dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_curing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
                                $dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_curing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_curing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

                                $test_method_for_warp_yarn_count= $row_old_pp_version_curing_process['test_method_for_warp_yarn_count'];
                                $warp_yarn_count_value= $row_old_pp_version_curing_process['warp_yarn_count_value'];
                                $warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['warp_yarn_count_tolerance_range_math_operator'])));
                                $warp_yarn_count_tolerance_value= $row_old_pp_version_curing_process['warp_yarn_count_tolerance_value'];
                                $warp_yarn_count_min_value= $row_old_pp_version_curing_process['warp_yarn_count_min_value'];
                                $warp_yarn_count_max_value= $row_old_pp_version_curing_process['warp_yarn_count_max_value'];
                                $uom_of_warp_yarn_count_value= $row_old_pp_version_curing_process['uom_of_warp_yarn_count_value'];

                                $test_method_for_weft_yarn_count= $row_old_pp_version_curing_process['test_method_for_weft_yarn_count'];
                                $weft_yarn_count_value= $row_old_pp_version_curing_process['weft_yarn_count_value'];
                                $weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['weft_yarn_count_tolerance_range_math_operator'])));
                                $weft_yarn_count_tolerance_value= $row_old_pp_version_curing_process['weft_yarn_count_tolerance_value'];
                                $weft_yarn_count_min_value= $row_old_pp_version_curing_process['weft_yarn_count_min_value'];
                                $weft_yarn_count_max_value= $row_old_pp_version_curing_process['weft_yarn_count_max_value'];
                                $uom_of_weft_yarn_count_value= $row_old_pp_version_curing_process['uom_of_weft_yarn_count_value'];

                                $test_method_for_no_of_threads_in_warp= $row_old_pp_version_curing_process['test_method_for_no_of_threads_in_warp'];
                                $no_of_threads_in_warp_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_value'];
                                $no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['no_of_threads_in_warp_tolerance_range_math_operator'])));
                                $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_tolerance_value'];
                                $no_of_threads_in_warp_min_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_min_value'];
                                $no_of_threads_in_warp_max_value= $row_old_pp_version_curing_process['no_of_threads_in_warp_max_value'];
                                $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_curing_process['uom_of_no_of_threads_in_warp_value'];

                                $test_method_for_no_of_threads_in_weft= $row_old_pp_version_curing_process['test_method_for_no_of_threads_in_weft'];
                                $no_of_threads_in_weft_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_value'];
                                $no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['no_of_threads_in_weft_tolerance_range_math_operator'])));
                                $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_tolerance_value'];
                                $no_of_threads_in_weft_min_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_min_value'];
                                $no_of_threads_in_weft_max_value= $row_old_pp_version_curing_process['no_of_threads_in_weft_max_value'];
                                $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_curing_process['uom_of_no_of_threads_in_weft_value'];


                                $test_method_for_mass_per_unit_per_area= $row_old_pp_version_curing_process['test_method_for_mass_per_unit_per_area'];
                                $mass_per_unit_per_area_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_value'];
                                $mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['mass_per_unit_per_area_tolerance_range_math_operator'])));
                                $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_tolerance_value'];
                                $mass_per_unit_per_area_min_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_min_value'];
                                $mass_per_unit_per_area_max_value= $row_old_pp_version_curing_process['mass_per_unit_per_area_max_value'];
                                $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_curing_process['uom_of_mass_per_unit_per_area_value'];


                                $test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['test_method_for_surface_fuzzing_and_pilling'];
                                $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_curing_process['rubs_for_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                                $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_tolerance_value'];
                                $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_min_value'];
                                $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_curing_process['surface_fuzzing_and_pilling_max_value'];
                                $uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_curing_process['uom_of_surface_fuzzing_and_pilling_value'];


                                $test_method_for_tensile_properties_in_warp= $row_old_pp_version_curing_process['test_method_for_tensile_properties_in_warp'];
                                $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_tolerance_value'];
                                $tensile_properties_in_warp_value_min_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_min_value'];
                                $tensile_properties_in_warp_value_max_value= $row_old_pp_version_curing_process['tensile_properties_in_warp_value_max_value'];
                                $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_curing_process['uom_of_tensile_properties_in_warp_value'];

                                $test_method_for_tensile_properties_in_weft= $row_old_pp_version_curing_process['test_method_for_tensile_properties_in_weft'];
                                $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_tolerance_value'];
                                $tensile_properties_in_weft_value_min_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_min_value'];
                                $tensile_properties_in_weft_value_max_value= $row_old_pp_version_curing_process['tensile_properties_in_weft_value_max_value'];
                                $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_curing_process['uom_of_tensile_properties_in_weft_value'];

                                $test_method_for_tear_force_in_warp= $row_old_pp_version_curing_process['test_method_for_tear_force_in_warp'];
                                $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                                $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_tolerance_value'];
                                $tear_force_in_warp_value_min_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_min_value'];
                                $tear_force_in_warp_value_max_value= $row_old_pp_version_curing_process['tear_force_in_warp_value_max_value'];
                                $uom_of_tear_force_in_warp_value= $row_old_pp_version_curing_process['uom_of_tear_force_in_warp_value'];

                                $test_method_for_tear_force_in_weft= $row_old_pp_version_curing_process['test_method_for_tear_force_in_weft'];
                                $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                                $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_tolerance_value'];
                                $tear_force_in_weft_value_min_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_min_value'];
                                $tear_force_in_weft_value_max_value= $row_old_pp_version_curing_process['tear_force_in_weft_value_max_value'];
                                $uom_of_tear_force_in_weft_value= $row_old_pp_version_curing_process['uom_of_tear_force_in_weft_value'];

                                $test_method_for_resistance_to_surface_wetting_before_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_before_wash'];
                                $resistance_to_surface_wetting_before_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'])));
                                $resistance_to_surface_wetting_before_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                                $resistance_to_surface_wetting_before_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_min_value'];
                                $resistance_to_surface_wetting_before_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_before_wash_max_value'];
                                $uom_of_resistance_to_surface_wetting_before_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_before_wash'];


                                $test_method_for_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_after_one_wash'];
                                $resistance_to_surface_wetting_after_one_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'])));
                                $resistance_to_surface_wetting_after_one_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
                                $resistance_to_surface_wetting_after_one_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_min_value'];
                                $resistance_to_surface_wetting_after_one_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_one_wash_max_value'];
                                $uom_of_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_after_one_wash'];


                                $test_method_for_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_curing_process['test_method_for_resistance_to_surface_wetting_after_five_wash'];
                                $resistance_to_surface_wetting_after_five_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'])));
                                $resistance_to_surface_wetting_after_five_wash_tolerance_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
                                $resistance_to_surface_wetting_after_five_wash_min_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_min_value'];
                                $resistance_to_surface_wetting_after_five_wash_max_value= $row_old_pp_version_curing_process['resistance_to_surface_wetting_after_five_wash_max_value'];
                                $uom_of_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_curing_process['uom_of_resistance_to_surface_wetting_after_five_wash'];


                                $test_method_formaldehyde_content= $row_old_pp_version_curing_process['test_method_formaldehyde_content'];
                                $formaldehyde_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['formaldehyde_content_tolerance_range_math_operator'])));
                                $formaldehyde_content_tolerance_value= $row_old_pp_version_curing_process['formaldehyde_content_tolerance_value'];
                                $formaldehyde_content_min_value= $row_old_pp_version_curing_process['formaldehyde_content_min_value'];
                                $formaldehyde_content_max_value= $row_old_pp_version_curing_process['formaldehyde_content_max_value'];
                                $uom_of_formaldehyde_content= $row_old_pp_version_curing_process['uom_of_formaldehyde_content'];


                                $test_method_for_ph= $row_old_pp_version_curing_process['test_method_for_ph'];
                                $ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['ph_value_tolerance_range_math_operator'])));
                                $ph_value_tolerance_value= $row_old_pp_version_curing_process['ph_value_tolerance_value'];
                                $ph_value_min_value= $row_old_pp_version_curing_process['ph_value_min_value'];
                                $ph_value_max_value= $row_old_pp_version_curing_process['ph_value_max_value'];
                                $uom_of_ph_value= $row_old_pp_version_curing_process['uom_of_ph_value'];

                                $smoothness_appearance_tolerance_washing_cycle = $row_old_pp_version_curing_process['smoothness_appearance_tolerance_washing_cycle'];
                                $test_method_for_smoothness_appearance= $row_old_pp_version_curing_process['test_method_for_smoothness_appearance'];
                                $smoothness_appearance_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['smoothness_appearance_tolerance_range_math_op'])));
                                $smoothness_appearance_tolerance_value= $row_old_pp_version_curing_process['smoothness_appearance_tolerance_value'];
                                $smoothness_appearance_min_value= $row_old_pp_version_curing_process['smoothness_appearance_min_value'];
                                $smoothness_appearance_max_value= $row_old_pp_version_curing_process['smoothness_appearance_max_value'];
                                $uom_of_smoothness_appearance= $row_old_pp_version_curing_process['uom_of_smoothness_appearance'];

                                if(isset($row_old_pp_version_curing_process['test_method_for_appearance_after_wash']))
                                {
                                    $appearance_after_wash_radio_button = $row_old_pp_version_curing_process['test_method_for_appearance_after_wash'];
                                    
                                    if($appearance_after_wash_radio_button == 'Fabric (Mock up)')
                                    {
                                        if(isset($row_old_pp_version_curing_process['appearance_after_washing_cycle_fabric_wash']))
                                        {
                                            $appearance_after_wash_for_fabric_radio_button = $row_old_pp_version_curing_process['appearance_after_washing_cycle_fabric_wash'];
                                            $appearance_after_wash_for_garments_radio_button = '';
                                        }
                                        else
                                        {
                                            $appearance_after_wash_for_fabric_radio_button = '';
                                        }
                                    }
                                    if($appearance_after_wash_radio_button == 'Garments')
                                    {
                                        if(isset($row_old_pp_version_curing_process['appearance_after_washing_cycle_garments_wash']))
                                        {
                                            $appearance_after_wash_for_garments_radio_button = $row_old_pp_version_curing_process['appearance_after_washing_cycle_garments_wash'];
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

                                $test_method_for_appearance_after_washing_fabric_color_change=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_color_change'];
                                $appearance_after_washing_fabric_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_math_op'])));
                                $appearance_after_washing_fabric_color_change_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_tolerance_value'];
                                $uom_of_appearance_after_washing_fabric_color_change=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_color_change'];
                                $appearance_after_washing_fabric_color_change_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_min_value'];
                                $appearance_after_washing_fabric_color_change_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_color_change_max_value'];

                                $test_method_for_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_cross_staining'];
                                $appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_math_op'])));
                                $appearance_after_washing_fabric_cross_staining_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
                                $uom_of_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_cross_staining'];
                                $appearance_after_washing_fabric_cross_staining_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_min_value'];
                                $appearance_after_washing_fabric_cross_staining_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_cross_staining_max_value'];

                                $test_method_for_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
                                $appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_math_op'])));
                                $appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                                $uom_of_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
                                $appearance_after_washing_fabric_surface_fuzzing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_min_value'];
                                $appearance_after_washing_fabric_surface_fuzzing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_max_value'];

                                $test_method_for_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_surface_pilling'];
                                $appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_math_op'])));
                                $appearance_after_washing_fabric_surface_pilling_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                                $uom_of_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_surface_pilling'];
                                $appearance_after_washing_fabric_surface_pilling_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_min_value'];
                                $appearance_after_washing_fabric_surface_pilling_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_surface_pilling_max_value'];

                                $test_method_for_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_fabric_crease_before_iron'];
                                $appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_iron_math_op'])));
                                $appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
                                $uom_of_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
                                $appearance_after_washing_fabric_crease_before_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_min_value'];
                                $appearance_after_washing_fabric_crease_before_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_before_ironing_max_value'];

                                $test_method_for_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_fabric_crease_after_ironing'];
                                $appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_iron_math_op'])));
                                $appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];
                                $uom_of_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
                                $appearance_after_washing_fabric_crease_after_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_min_value'];
                                $appearance_after_washing_fabric_crease_after_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_fabric_crease_after_ironing_max_value'];

                                $test_method_for_appearance_after_washing_fabric_loss_of_print=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_loss_of_print'];
                                $appearance_after_washing_loss_of_print_fabric=$row_old_pp_version_curing_process['appearance_after_washing_loss_of_print_fabric'];
                                $test_method_for_appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
                                $appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_curing_process['appearance_after_washing_fabric_abrasive_mark'];
                                $test_method_for_appearance_after_washing_fabric_odor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_fabric_odor'];
                                $appearance_after_washing_odor_fabric=$row_old_pp_version_curing_process['appearance_after_washing_odor_fabric'];
                                $appearance_after_washing_other_observation_fabric = mysqli_real_escape_string($con, $row_old_pp_version_curing_process['appearance_after_washing_other_observation_fabric']);

                                $test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_curing_process['test_method_for_appear_wash_garments_color_change_without_sup'];
                                $appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_color_change_without_sup_math_op'])));
                                $appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_without_sup_toler_val'];
                                $uom_of_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_curing_process['uom_of_appear_after_washing_garments_color_change_without_sup'];
                                $appearance_after_washing_garments_color_change_without_suppressor_min_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_without_sup_min_value'];
                                $appearance_after_washing_garments_color_change_without_suppressor_max_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_without_sup_max_val'];

                                $test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_curing_process['test_method_for_appear_after_wash_garments_color_change_with_sup'];
                                $appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_color_change_with_sup_math_op'])));
                                $appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
                                $uom_of_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_curing_process['uom_of_appear_after_washing_garments_color_change_with_sup'];
                                $appearance_after_washing_garments_color_change_with_suppressor_min_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_with_sup_min_value'];
                                $appearance_after_washing_garments_color_change_with_suppressor_max_value=$row_old_pp_version_curing_process['appear_after_washing_garments_color_change_with_sup_max_value'];

                                $test_method_for_appearance_after_washing_garments_cross_staining=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_cross_staining'];
                                $appearance_after_washing_garments_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_cross_staining_math_op'])));
                                $appearance_after_washing_garments_cross_staining_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments_cross_staining_tolerance_value'];
                                $uom_of_appearance_after_washing_garments_cross_staining=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_cross_staining'];
                                $appearance_after_washing_garments_cross_staining_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_min_value'];
                                $appearance_after_washing_garments_cross_staining_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_cross_staining_max_value'];

                                $test_method_for_appearance_after_washing_garments_differential_shrinkage=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_differential_shrin'];
                                $appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_differential_shrink_math_op'])));
                                $appearance_after_washing_garments__differential_shrinkage_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
                                $uom_of_appearance_after_washing_garments__differential_shrinkage=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments__differential_shrinkage'];
                                $appearance_after_washing_garments__differential_shrinkage_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments__differential_shrink_min_value'];
                                $appearance_after_washing_garments__differential_shrinkage_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments__differential_shrink_max_value'];

                                $test_method_for_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_surface_fuzzing'];
                                $appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_surface_fuzzing_math_op'])));
                                $appearance_after_washing_garments_surface_fuzzing_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];
                                $uom_of_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_surface_fuzzing'];
                                $appearance_after_washing_garments_surface_fuzzing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_min_value'];
                                $appearance_after_washing_garments_surface_fuzzing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_fuzzing_max_value'];

                                $test_method_for_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_surface_pilling'];
                                $appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_surface_pilling_math_op'])));
                                $appearance_after_washing_garments_surface_pilling_tolerance_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
                                $uom_of_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_curing_process['uom_of_appearance_after_washing_garments_surface_pilling'];
                                $appearance_after_washing_garments_surface_pilling_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_min_value'];
                                $appearance_after_washing_garments_surface_pilling_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_surface_pilling_max_value'];

                                $test_method_for_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_crease_after_iron'];
                                $appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_washing_garments_crease_after_ironing_math_op'])));
                                $appearance_after_washing_garments_crease_after_ironing_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];
                                $uom_of_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_curing_process['uom_of_appear_after_washing_garments_crease_after_ironing'];
                                $appearance_after_washing_garments_crease_after_ironing_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_min_value'];
                                $appearance_after_washing_garments_crease_after_ironing_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_crease_after_ironing_max_value'];

                                $test_method_for_appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_abrasive_mark'];
                                $appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_curing_process['appearance_after_washing_garments_abrasive_mark'];
                                $test_method_for_appearance_after_washing_garments_seam_breakdown=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_seam_breakdown'];
                                $seam_breakdown_garments=$row_old_pp_version_curing_process['seam_breakdown_garments'];

                                $test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_curing_process['test_method_for_apear_after_wash_garments_seam_pucker_after_iron'];
                                $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_curing_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'])));
                                $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$row_old_pp_version_curing_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];
                                $uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_curing_process['uom_of_appear_after_washing_garments_seam_pucker_rop_rion'];
                                $appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$row_old_pp_version_curing_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value'];
                                $appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$row_old_pp_version_curing_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value'];

                                $test_method_for_appearance_after_washing_garments_detachment_of_interlining=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_detachment_inter'];
                                $detachment_of_interlinings_fused_components_garments=$row_old_pp_version_curing_process['detachment_of_interlinings_fused_components_garments'];
                                $test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_change_in_handle'];
                                $change_id_handle_or_appearance=$row_old_pp_version_curing_process['change_id_handle_or_appearance'];
                                $test_method_for_appearance_after_washing_garments_effect_accessories=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_effect_access'];
                                $effect_on_accessories_such_as_buttons=$row_old_pp_version_curing_process['effect_on_accessories_such_as_buttons'];
                                $test_method_for_appearance_after_washing_garments_spirality=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_spirality'];
                                $appearance_after_washing_garments_spirality_min_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_spirality_min_value'];
                                $appearance_after_washing_garments_spirality_max_value=$row_old_pp_version_curing_process['appearance_after_washing_garments_spirality_max_value'];

                                $test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$row_old_pp_version_curing_process['test_method_for_appear_after_washing_garments_detachment_fraying'];
                                $detachment_or_fraying_of_ribbons=$row_old_pp_version_curing_process['detachment_or_fraying_of_ribbons'];
                                $test_method_for_appearance_after_washing_garments_loss_of_print=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_loss_of_print'];
                                $loss_of_print_garments=$row_old_pp_version_curing_process['loss_of_print_garments'];
                                $test_method_for_appearance_after_washing_garments_care_level=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_care_level'];
                                $care_level_garments=$row_old_pp_version_curing_process['care_level_garments'];
                                $test_method_for_appearance_after_washing_garments_odor=$row_old_pp_version_curing_process['test_method_for_appearance_after_washing_garments_odor'];
                                $odor_garments=$row_old_pp_version_curing_process['odor_garments'];
                                $appearance_after_washing_other_observation_garments = mysqli_real_escape_string($con, $row_old_pp_version_curing_process['appearance_after_washing_other_observation_garments']);


                                $insert_sql_statement_for_curing="INSERT INTO `defining_qc_standard_for_curing_process` ( 
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`,
                                    `standard_for_which_process`, 
                              
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
                            
                                    `test_method_formaldehyde_content`, 
                                    `formaldehyde_content_tolerance_range_math_operator`, 
                                    `formaldehyde_content_tolerance_value`, 
                                    `formaldehyde_content_min_value`, 
                                    `formaldehyde_content_max_value`, 
                                    `uom_of_formaldehyde_content`, 
                              
                                    `test_method_for_ph`,
                                    `ph_value_tolerance_range_math_operator`,
                                    `ph_value_tolerance_value`, 
                                    `ph_value_min_value`, 
                                    `ph_value_max_value`, 
                                    `uom_of_ph_value`, 
                            
                                    `test_method_for_smoothness_appearance`, 
                                    `smoothness_appearance_tolerance_washing_cycle`,
                                    `smoothness_appearance_tolerance_range_math_op`, 
                                    `smoothness_appearance_tolerance_value`, 
                                    `smoothness_appearance_min_value`, 
                                    `smoothness_appearance_max_value`, 
                                    `uom_of_smoothness_appearance`,
                              
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
                                        `recording_time` 
                                      ) 
                              
                                     VALUES 
                                      (
                                       '$pp_number',
                                       '$version_id',
                                       '$version_name',
                                       '$customer_name',
                                       '$customer_id',
                                       '$color',
                                       '$finish_width_in_inch',
                                       '$standard_for_which_process',
                              
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
                                        
                                        '$test_method_formaldehyde_content',
                                        '$formaldehyde_content_tolerance_range_math_operator',
                                        '$formaldehyde_content_tolerance_value',
                                        '$formaldehyde_content_min_value',
                                        '$formaldehyde_content_max_value',
                                        '$uom_of_formaldehyde_content',
                            
                                        '$test_method_for_ph',
                                        '$ph_value_tolerance_range_math_operator',
                                        '$ph_value_tolerance_value',
                                        '$ph_value_min_value',
                                        '$ph_value_max_value',
                                        '$uom_of_ph_value',
                            
                            
                                        '$test_method_for_smoothness_appearance',
                                        '$smoothness_appearance_tolerance_washing_cycle',
                                        '$smoothness_appearance_tolerance_range_math_op',
                                        '$smoothness_appearance_tolerance_value',
                                        '$smoothness_appearance_min_value',
                                        '$smoothness_appearance_max_value',
                                        '$uom_of_smoothness_appearance',
                            
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
                              
                                  mysqli_query($con,$insert_sql_statement_for_curing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_9')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Curing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Curing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }

                            }
                            else
                            {
                                $message = 'Already curing standard defined';
                            }
                        }       // End curing process
                        else if ($process_name == 'Steaming') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_steaming = "select * from `model_defining_qc_standard_for_steaming_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_steaming = mysqli_query($con, $select_sql_for_steaming) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_steaming)> 0)
                            {
                              //if after checking data not found then insert new standard for steaming
                              //take model steaming all data 

                              /*............................................................Copy steaming..............................................................*/


                                $model_pp_version_steaming_process = "select * from `model_defining_qc_standard_for_steaming_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_steaming_process = mysqli_query($con,$model_pp_version_steaming_process) or die(mysqli_error($con));
                                $row_old_pp_version_steaming_process = mysqli_fetch_array($result_model_pp_version_steaming_process);

                                $standard_for_which_process= $row_old_pp_version_steaming_process['process_name'];  
                    
                                $insert_sql_statement_for_steaming="insert into `defining_qc_standard_for_steaming_process`
                                ( 
                                `pp_number`,
                                `version_id`,
                                `version_number`,
                                `customer_name`,
                                `customer_id`,
                                `color`,
                                `finish_width_in_inch`,
                                `standard_for_which_process`,

                                  `recording_person_id`,
                                  `recording_person_name`,
                                  `recording_time` ) 
                                  values 
                                  (
                                  '$pp_number',
                                  '$version_id',
                                  '$version_name',
                                  '$customer_name',
                                  '$customer_id',
                                  '$color',
                                   $finish_width_in_inch,
                                  '$standard_for_which_process',

                                  '$user_id',
                                  '$user_name',
                                   NOW()
                                    )";

                              mysqli_query($con,$insert_sql_statement_for_steaming) or die(mysqli_error($con)); 

                              $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                              WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                              ORDER BY row_id DESC 
                              LIMIT 1";
                                  
                              $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                              $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                              if($row_for_last_process_route['process_id'] == 'proc_10')
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Steaming standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }
                              else
                              {
                                  $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Steaming standard' 
                                  WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                  mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                              }

                            }
                            else
                            {
                                $message = 'Already Steaming standard defined';
                            }

                        }       // End steaming process
                        else if ($process_name == 'Ready For Dyeing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_ready_for_dyeing = "select * from `model_defining_qc_standard_for_ready_for_dying_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_ready_for_dyeing = mysqli_query($con, $select_sql_for_ready_for_dyeing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_ready_for_dyeing)> 0)
                            {
                              //if after checking data not found then insert new standard for Ready For Dyeing
                              //take model Ready For Dyeing all data 

                              /*............................................................Copy Ready For Dyeing..............................................................*/


                                $model_pp_version_ready_for_dyeing_process = "select * from `model_defining_qc_standard_for_ready_for_dying_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_ready_for_dyeing_process = mysqli_query($con,$model_pp_version_ready_for_dyeing_process) or die(mysqli_error($con));
                                $row_old_pp_version_ready_for_dyeing_process = mysqli_fetch_array($result_model_pp_version_ready_for_dyeing_process);

                                $standard_for_which_process= $row_old_pp_version_ready_for_dyeing_process['process_name'];  

                                
                                $test_method_for_whiteness= $row_old_pp_version_ready_for_dyeing_process['test_method_for_whiteness'];
                                $whiteness_min_value= $row_old_pp_version_ready_for_dyeing_process['whiteness_min_value'];
                                $whiteness_max_value= $row_old_pp_version_ready_for_dyeing_process['whiteness_max_value'];
                                $uom_of_whiteness= $row_old_pp_version_ready_for_dyeing_process['uom_of_whiteness'];


                                $test_method_for_bowing_and_skew= $row_old_pp_version_ready_for_dyeing_process['test_method_for_bowing_and_skew'];
                                $bowing_and_skew_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_dyeing_process['bowing_and_skew_tolerance_range_math_operator'])));
                                $bowing_and_skew_tolerance_value= $row_old_pp_version_ready_for_dyeing_process['bowing_and_skew_tolerance_value'];
                                $bowing_and_skew_min_value= $row_old_pp_version_ready_for_dyeing_process['bowing_and_skew_min_value'];
                                $bowing_and_skew_max_value= $row_old_pp_version_ready_for_dyeing_process['bowing_and_skew_max_value'];
                                $uom_of_bowing_and_skew= $row_old_pp_version_ready_for_dyeing_process['uom_of_bowing_and_skew'];


                                
                                $test_method_for_ph= $row_old_pp_version_ready_for_dyeing_process['test_method_for_ph'];
                                $ph_min_value= $row_old_pp_version_ready_for_dyeing_process['ph_min_value'];
                                $ph_max_value= $row_old_pp_version_ready_for_dyeing_process['ph_max_value'];
                                $uom_of_ph= $row_old_pp_version_ready_for_dyeing_process['uom_of_ph'];

                                $insert_sql_statement_for_ready_for_dyeing="INSERT INTO `defining_qc_standard_for_ready_for_dying_process`
                                                    (
                                                    `pp_number`, 
                                                    `version_id`, 
                                                    `version_number`, 
                                                    `customer_name`, 
                                                    `customer_id`, 
                                                    `color`, 
                                                    `finish_width_in_inch`, 
                                                    `standard_for_which_process`, 

                                                    
                                                    `test_method_for_whiteness`, 
                                                    `whiteness_min_value`, 
                                                    `whiteness_max_value`, 
                                                    `uom_of_whiteness`, 

                                                    `test_method_for_bowing_and_skew`, 
                                                    `bowing_and_skew_tolerance_range_math_operator`, 
                                                    `bowing_and_skew_tolerance_value`, 
                                                    `bowing_and_skew_min_value`, 
                                                    `bowing_and_skew_max_value`, 
                                                    `uom_of_bowing_and_skew`,

                                                    `test_method_for_ph`, 
                                                    `ph_min_value`, 
                                                    `ph_max_value`,
                                                    `uom_of_ph`,  

                                                    `recording_person_id`, 
                                                    `recording_person_name`, 
                                                    `recording_time`
                                                    )
                                                    VALUES 
                                                    (
                                                    '$pp_number',
                                                    '$version_id',
                                                    '$version_name',
                                                    '$customer_name',
                                                    '$customer_id',
                                                    '$color',
                                                    '$finish_width_in_inch',
                                                    '$standard_for_which_process',

                                                    
                                                    '$test_method_for_whiteness',
                                                    '$whiteness_min_value',
                                                    '$whiteness_max_value',
                                                    '$uom_of_whiteness',

                                                    '$test_method_for_bowing_and_skew',
                                                    '$bowing_and_skew_tolerance_range_math_operator',
                                                    '$bowing_and_skew_tolerance_value',
                                                    '$bowing_and_skew_min_value',
                                                    '$bowing_and_skew_max_value',
                                                    '$uom_of_bowing_and_skew',

                                                    '$test_method_for_ph',
                                                    '$ph_min_value',
                                                    '$ph_max_value',
                                                    '$uom_of_ph',

                                                    '$user_id',
                                                    '$user_name',
                                                    NOW()
                                                    )";
  
	                            mysqli_query($con,$insert_sql_statement_for_ready_for_dyeing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_11')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Ready For Dyeing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Ready For Dyeing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                            }
                            else
                            {
                                $message = 'Already ready for dyeing standard defined';
                            }
                        }       // End ready for dyeing process
                        else if ($process_name == 'Dyeing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_dyeing = "select * from `model_defining_qc_standard_for_dyeing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_dyeing = mysqli_query($con, $select_sql_for_dyeing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_dyeing)> 0)
                            {
                              //if after checking data not found then insert new standard for Ready For Dyeing
                              //take model Ready For Dyeing all data 

                              /*............................................................Copy Ready For Dyeing..............................................................*/


                                $model_pp_version_dyeing_process = "select * from `model_defining_qc_standard_for_dyeing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_dyeing_process = mysqli_query($con,$model_pp_version_dyeing_process) or die(mysqli_error($con));
                                $row_old_pp_version_dyeing_process = mysqli_fetch_array($result_model_pp_version_dyeing_process);

                                $standard_for_which_process= $row_old_pp_version_dyeing_process['process_name'];  

                                $insert_sql_statement_for_dyeing="INSERT INTO `defining_qc_standard_for_dyeing_process`
                                                    (
                                                    `pp_number`, 
                                                    `version_id`, 
                                                    `version_number`, 
                                                    `customer_name`, 
                                                    `customer_id`, 
                                                    `color`, 
                                                    `finish_width_in_inch`, 
                                                    `standard_for_which_process`, 

                                                    `recording_person_id`, 
                                                    `recording_person_name`, 
                                                    `recording_time`
                                                    )
                                                    VALUES 
                                                    (
                                                    '$pp_number',
                                                    '$version_id',
                                                    '$version_name',
                                                    '$customer_name',
                                                    '$customer_id',
                                                    '$color',
                                                    '$finish_width_in_inch',
                                                    '$standard_for_which_process',

                                                    '$user_id',
                                                    '$user_name',
                                                    NOW()
                                                    )";
  
	                            mysqli_query($con,$insert_sql_statement_for_dyeing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_12')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Dyeing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Dyeing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                            }
                            else
                            {
                                $message = 'Already dyeing standard defined';
                            }
                        }       // End ready for dyeing process
                        else if ($process_name == 'Washing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_washing = "select * from `model_defining_qc_standard_for_washing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_washing = mysqli_query($con, $select_sql_for_washing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_washing)> 0)
                            {
                              //if after checking data not found then insert new standard for Washing
                              //take model Washing all data 

                              /*............................................................Copy Washing..............................................................*/


                                $model_pp_version_washing_process = "select * from `model_defining_qc_standard_for_washing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_washing_process = mysqli_query($con,$model_pp_version_washing_process) or die(mysqli_error($con));
                                $row_old_pp_version_washing_process = mysqli_fetch_array($result_model_pp_version_washing_process);

                                $standard_for_which_process= $row_old_pp_version_washing_process['process_name'];  

                                                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_washing_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_washing_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_washing_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_washing_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_washing_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_washing_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_cf_to_washing_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_color_change'];
                                $cf_to_washing_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_washing_color_change_tolerance_range_math_operator'])));
                                $cf_to_washing_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_tolerance_value'];
                                $cf_to_washing_color_change_min_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_min_value'];
                                $cf_to_washing_color_change_max_value= $row_old_pp_version_washing_process['cf_to_washing_color_change_max_value'];
                                $uom_of_cf_to_washing_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_washing_color_change'];

                                $test_method_for_cf_to_washing_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_staining'];
                                $cf_to_washing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_washing_staining_tolerance_range_math_operator'])));
                                $cf_to_washing_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_staining_tolerance_value'];
                                $cf_to_washing_staining_min_value= $row_old_pp_version_washing_process['cf_to_washing_staining_min_value'];
                                $cf_to_washing_staining_max_value= $row_old_pp_version_washing_process['cf_to_washing_staining_max_value'];
                                $uom_of_cf_to_washing_staining= $row_old_pp_version_washing_process['uom_of_cf_to_washing_staining'];

                                $test_method_for_cf_to_washing_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_washing_cross_staining'];
                                $cf_to_washing_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_washing_cross_staining_tolerance_range_math_operator'])));
                                $cf_to_washing_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_tolerance_value'];
                                $cf_to_washing_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_min_value'];
                                $cf_to_washing_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_washing_cross_staining_max_value'];
                                $uom_of_cf_to_washing_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_washing_cross_staining'];


                                $test_method_for_cf_to_dry_cleaning_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_dry_cleaning_color_change'];
                                $cf_to_dry_cleaning_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'])));
                                $cf_to_dry_cleaning_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_tolerance_value'];
                                $cf_to_dry_cleaning_color_change_min_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_min_value'];
                                $cf_to_dry_cleaning_color_change_max_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_color_change_max_value'];
                                $uom_of_cf_to_dry_cleaning_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_dry_cleaning_color_change'];

                                $test_method_for_cf_to_dry_cleaning_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_dry_cleaning_staining'];
                                $cf_to_dry_cleaning_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'])));
                                $cf_to_dry_cleaning_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_tolerance_value'];
                                $cf_to_dry_cleaning_staining_min_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_min_value'];
                                $cf_to_dry_cleaning_staining_max_value= $row_old_pp_version_washing_process['cf_to_dry_cleaning_staining_max_value'];
                                $uom_of_cf_to_dry_cleaning_staining= $row_old_pp_version_washing_process['uom_of_cf_to_dry_cleaning_staining'];

                                $test_method_for_perspiration_acid_color_change= $row_old_pp_version_washing_process['test_method_for_perspiration_acid_color_change'];
                                $cf_to_perspiration_acid_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'])));
                                $cf_to_perspiration_acid_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                                $cf_to_perspiration_acid_color_change_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_min_value'];
                                $cf_to_perspiration_acid_color_change_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_color_change_max_value'];
                                $uom_of_cf_to_perspiration_acid_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_color_change'];

                                $test_method_for_cf_to_perspiration_acid_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_acid_staining'];
                                $cf_to_perspiration_acid_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'])));
                                $cf_to_perspiration_acid_staining_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_value'];
                                $cf_to_perspiration_acid_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_min_value'];
                                $cf_to_perspiration_acid_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_staining_max_value'];
                                $uom_of_cf_to_perspiration_acid_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_staining'];


                                $test_method_for_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_acid_cross_staining'];
                                $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'])));
                                $cf_to_perspiration_acid_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                                $cf_to_perspiration_acid_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_min_value'];
                                $cf_to_perspiration_acid_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_acid_cross_staining_max_value'];
                                $uom_of_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_acid_cross_staining'];

                                $test_method_for_cf_to_perspiration_alkali_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_color_change'];
                                $cf_to_perspiration_alkali_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'])));
                                $cf_to_perspiration_alkali_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                                $cf_to_perspiration_alkali_color_change_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_min_value'];
                                $cf_to_perspiration_alkali_color_change_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_color_change_max_value'];
                                $uom_of_cf_to_perspiration_alkali_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_color_change'];

                                $test_method_for_cf_to_perspiration_alkali_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_staining'];
                                $cf_to_perspiration_alkali_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'])));
                                $cf_to_perspiration_alkali_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                                $cf_to_perspiration_alkali_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_min_value'];
                                $cf_to_perspiration_alkali_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_staining_max_value'];
                                $uom_of_cf_to_perspiration_alkali_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_staining'];

                                $test_method_for_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_perspiration_alkali_cross_staining'];
                                $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'])));
                                $cf_to_perspiration_alkali_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
                                $cf_to_perspiration_alkali_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_min_value'];
                                $cf_to_perspiration_alkali_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_perspiration_alkali_cross_staining_max_value'];
                                $uom_of_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_perspiration_alkali_cross_staining'];

                                $test_method_for_cf_to_water_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_water_color_change'];
                                $cf_to_water_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_color_change_tolerance_range_math_operator'])));
                                $cf_to_water_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_color_change_tolerance_value'];
                                $cf_to_water_color_change_min_value= $row_old_pp_version_washing_process['cf_to_water_color_change_min_value'];
                                $cf_to_water_color_change_max_value= $row_old_pp_version_washing_process['cf_to_water_color_change_max_value'];
                                $uom_of_cf_to_water_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_water_color_change'];

                                $test_method_for_cf_to_water_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_staining'];
                                $cf_to_water_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_staining_tolerance_range_math_operator'])));
                                $cf_to_water_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_staining_tolerance_value'];
                                $cf_to_water_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_staining_min_value'];
                                $cf_to_water_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_staining_max_value'];
                                $uom_of_cf_to_water_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_staining'];

                                $test_method_for_cf_to_water_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_cross_staining'];
                                $cf_to_water_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_cross_staining_tolerance_range_math_operator'])));
                                $cf_to_water_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_tolerance_value'];
                                $cf_to_water_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_min_value'];
                                $cf_to_water_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_cross_staining_max_value'];
                                $uom_of_cf_to_water_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_cross_staining'];

                                $test_method_for_cf_to_water_spotting_surface= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_surface'];
                                $cf_to_water_spotting_surface_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_spotting_surface_tolerance_range_math_op'])));
                                $cf_to_water_spotting_surface_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_tolerance_value'];
                                $cf_to_water_spotting_surface_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_min_value'];
                                $cf_to_water_spotting_surface_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_surface_max_value'];
                                $uom_of_cf_to_water_spotting_surface= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_surface'];

                                $test_method_for_cf_to_water_spotting_edge= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_edge'];
                                $cf_to_water_spotting_edge_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_spotting_edge_tolerance_range_math_op'])));
                                $cf_to_water_spotting_edge_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_tolerance_value'];
                                $cf_to_water_spotting_edge_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_min_value'];
                                $cf_to_water_spotting_edge_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_edge_max_value'];
                                $uom_of_cf_to_water_spotting_edge= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_edge'];

                                $test_method_for_cf_to_water_spotting_cross_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_water_spotting_cross_staining'];
                                $cf_to_water_spotting_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'])));
                                $cf_to_water_spotting_cross_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_tolerance_value'];
                                $cf_to_water_spotting_cross_staining_min_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_min_value'];
                                $cf_to_water_spotting_cross_staining_max_value= $row_old_pp_version_washing_process['cf_to_water_spotting_cross_staining_max_value'];
                                $uom_of_cf_to_water_spotting_cross_staining= $row_old_pp_version_washing_process['uom_of_cf_to_water_spotting_cross_staining'];

                                $test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
                                $cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'])));
                                $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
                                $cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
                                $cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $row_old_pp_version_washing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
                                $uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];

                                $test_method_for_cf_to_oxidative_bleach_damage_color_cange= $row_old_pp_version_washing_process['test_method_for_cf_to_oxidative_bleach_damage_color_cange'];
                                $cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'])));
                                $cf_to_oxidative_bleach_damage_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
                                $cf_to_oxidative_bleach_damage_color_change_min_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_min_value'];
                                $cf_to_oxidative_bleach_damage_color_change_max_value= $row_old_pp_version_washing_process['cf_to_oxidative_bleach_damage_color_change_max_value'];
                                $uom_of_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_oxidative_bleach_damage_color_change'];

                                $test_method_for_cf_to_phenolic_yellowing_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_phenolic_yellowing_staining'];
                                $cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'])));
                                $cf_to_phenolic_yellowing_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                                $cf_to_phenolic_yellowing_staining_min_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_min_value'];
                                $cf_to_phenolic_yellowing_staining_max_value= $row_old_pp_version_washing_process['cf_to_phenolic_yellowing_staining_max_value'];
                                $uom_of_cf_to_phenolic_yellowing_staining= $row_old_pp_version_washing_process['uom_of_cf_to_phenolic_yellowing_staining'];

                                $cf_to_pvc_migration_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'])));
                                $cf_to_pvc_migration_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_tolerance_value'];
                                $cf_to_pvc_migration_staining_min_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_min_value'];
                                $cf_to_pvc_migration_staining_max_value= $row_old_pp_version_washing_process['cf_to_pvc_migration_staining_max_value'];
                                $uom_of_cf_to_pvc_migration_staining= $row_old_pp_version_washing_process['uom_of_cf_to_pvc_migration_staining'];

                                $test_method_for_cf_to_saliva_staining= $row_old_pp_version_washing_process['test_method_for_cf_to_saliva_staining'];
                                $cf_to_saliva_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_saliva_staining_tolerance_range_math_operator'])));
                                $cf_to_saliva_staining_tolerance_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_tolerance_value'];
                                $cf_to_saliva_staining_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_staining_min_value'];
                                $cf_to_saliva_staining_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_staining_min_value'];
                                $cf_to_saliva_staining_max_value= $row_old_pp_version_washing_process['cf_to_saliva_staining_max_value'];
                                $uom_of_cf_to_saliva_staining= $row_old_pp_version_washing_process['uom_of_cf_to_saliva_staining'];

                                $test_method_for_cf_to_saliva_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_saliva_color_change'];
                                $cf_to_saliva_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_saliva_color_change_tolerance_range_math_operator'])));
                                $cf_to_saliva_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_tolerance_value'];
                                $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_staining_min_value'];
                                $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_staining_min_value'];
                                $cf_to_saliva_color_change_max_value= $row_old_pp_version_washing_process['cf_to_saliva_color_change_max_value'];
                                $uom_of_cf_to_saliva_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_saliva_color_change'];

                                $test_method_for_cf_to_chlorinated_water_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_chlorinated_water_color_change'];
                                $cf_to_chlorinated_water_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'])));
                                $cf_to_chlorinated_water_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                                $cf_to_chlorinated_water_color_change_min_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_min_value'];
                                $cf_to_chlorinated_water_color_change_max_value= $row_old_pp_version_washing_process['cf_to_chlorinated_water_color_change_max_value'];
                                $uom_of_cf_to_chlorinated_water_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_chlorinated_water_color_change'];

                                $test_method_for_cf_to_cholorine_bleach_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_cholorine_bleach_color_change'];
                                $cf_to_cholorine_bleach_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'])));
                                $cf_to_cholorine_bleach_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
                                $cf_to_cholorine_bleach_color_change_min_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_min_value'];
                                $cf_to_cholorine_bleach_color_change_max_value= $row_old_pp_version_washing_process['cf_to_cholorine_bleach_color_change_max_value'];
                                $uom_of_cf_to_cholorine_bleach_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_cholorine_bleach_color_change'];

                                $test_method_for_cf_to_peroxide_bleach_color_change= $row_old_pp_version_washing_process['test_method_for_cf_to_peroxide_bleach_color_change'];
                                $cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'])));
                                $cf_to_peroxide_bleach_color_change_tolerance_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
                                $cf_to_peroxide_bleach_color_change_min_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_min_value'];
                                $cf_to_peroxide_bleach_color_change_max_value= $row_old_pp_version_washing_process['cf_to_peroxide_bleach_color_change_max_value'];
                                $uom_of_cf_to_peroxide_bleach_color_change= $row_old_pp_version_washing_process['uom_of_cf_to_peroxide_bleach_color_change'];

                                $test_method_for_cross_staining= $row_old_pp_version_washing_process['test_method_for_cross_staining'];
                                $cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['cross_staining_tolerance_range_math_operator'])));
                                $cross_staining_tolerance_value= $row_old_pp_version_washing_process['cross_staining_tolerance_value'];
                                $cross_staining_min_value= $row_old_pp_version_washing_process['cross_staining_min_value'];
                                $cross_staining_max_value= $row_old_pp_version_washing_process['cross_staining_max_value'];
                                $uom_of_cross_staining= $row_old_pp_version_washing_process['uom_of_cross_staining'];

                                $test_method_for_ph= $row_old_pp_version_washing_process['test_method_for_ph'];
                                $ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_washing_process['ph_value_tolerance_range_math_operator'])));
                                $ph_value_tolerance_value= $row_old_pp_version_washing_process['ph_value_tolerance_value'];
                                $ph_value_min_value= $row_old_pp_version_washing_process['ph_value_min_value'];
                                $ph_value_max_value= $row_old_pp_version_washing_process['ph_value_max_value'];
                                $uom_of_ph_value= $row_old_pp_version_washing_process['uom_of_ph_value'];


                                $insert_sql_statement_for_washing="INSERT INTO `defining_qc_standard_for_washing_process`( 
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`,
                                    `standard_for_which_process`, 
                              
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
                                          `recording_time`) 
                                          VALUES 
                                          (
                                           '$pp_number',
                                           '$version_id',
                                           '$version_name',
                                           '$customer_name',
                                           '$customer_id',
                                           '$color',
                                           '$finish_width_in_inch',
                                           '$standard_for_which_process',
                              
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
                              
                                  mysqli_query($con,$insert_sql_statement_for_washing) or die(mysqli_error($con));

                                  $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_13')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Washing standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Washing standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                            }
                            else
                            {
                                $message = 'Already washing standard defined';
                            }
                        }       // End washing process
                        else if ($process_name == 'Ready For Raising') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_ready_for_raising = "select * from `model_defining_qc_standard_for_ready_for_raising_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_ready_for_raising = mysqli_query($con, $select_sql_for_ready_for_raising) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_ready_for_raising)> 0)
                            {
                              //if after checking data not found then insert new standard for Ready For Raising
                              //take model Ready For Raising all data 

                              /*............................................................Copy Ready For Raising..............................................................*/


                                $model_pp_version_ready_for_raising_process = "select * from `model_defining_qc_standard_for_ready_for_raising_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_ready_for_raising_process = mysqli_query($con,$model_pp_version_ready_for_raising_process) or die(mysqli_error($con));
                                $row_old_pp_version_ready_for_raising_process = mysqli_fetch_array($result_model_pp_version_ready_for_raising_process);

                                $standard_for_which_process= $row_old_pp_version_ready_for_raising_process['process_name'];  

                                                                
                                $test_method_for_tensile_properties_in_warp= $row_old_pp_version_ready_for_raising_process['test_method_for_tensile_properties_in_warp'];
                                $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_tolerance_value'];
                                $tensile_properties_in_warp_value_min_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_min_value'];
                                $tensile_properties_in_warp_value_max_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_warp_value_max_value'];
                                $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_ready_for_raising_process['uom_of_tensile_properties_in_warp_value'];

                                $test_method_for_tensile_properties_in_weft= $row_old_pp_version_ready_for_raising_process['test_method_for_tensile_properties_in_weft'];
                                $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_tolerance_value'];
                                $tensile_properties_in_weft_value_min_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_min_value'];
                                $tensile_properties_in_weft_value_max_value= $row_old_pp_version_ready_for_raising_process['tensile_properties_in_weft_value_max_value'];
                                $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_ready_for_raising_process['uom_of_tensile_properties_in_weft_value'];

                                $test_method_for_tear_force_in_warp= $row_old_pp_version_ready_for_raising_process['test_method_for_tear_force_in_warp'];
                                $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                                $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_tolerance_value'];
                                $tear_force_in_warp_value_min_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_min_value'];
                                $tear_force_in_warp_value_max_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_warp_value_max_value'];
                                $uom_of_tear_force_in_warp_value= $row_old_pp_version_ready_for_raising_process['uom_of_tear_force_in_warp_value'];

                                $test_method_for_tear_force_in_weft= $row_old_pp_version_ready_for_raising_process['test_method_for_tear_force_in_weft'];
                                $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                                $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_tolerance_value'];
                                $tear_force_in_weft_value_min_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_min_value'];
                                $tear_force_in_weft_value_max_value= $row_old_pp_version_ready_for_raising_process['tear_force_in_weft_value_max_value'];
                                $uom_of_tear_force_in_weft_value= $row_old_pp_version_ready_for_raising_process['uom_of_tear_force_in_weft_value'];


                                $insert_sql_statement_for_ready_for_raising="INSERT INTO `defining_qc_standard_for_ready_for_raising_process`( 
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`,
                                    `standard_for_which_process`, 
                              
                              
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
                              
                              
                                        `recording_person_id`, 
                                        `recording_person_name`, 
                                        `recording_time` 
                                      ) 
                              
                                     VALUES 
                                      (
                                    '$pp_number',
                                    '$version_id',
                                    '$version_name',
                                    '$customer_name',
                                    '$customer_id',
                                    '$color',
                                    '$finish_width_in_inch',
                                    '$standard_for_which_process',
                              
                              
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
                              
                                     '$user_id',
                                     '$user_name',
                                      NOW()
                                          )";
                              
                                  mysqli_query($con,$insert_sql_statement_for_ready_for_raising) or die(mysqli_error($con));

                                  $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_14')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Ready For Raising standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Ready For Raising standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                            }
                            else
                            {
                                $message = 'Already ready for raising standard defined';
                            }
                        }       // End ready for raising process
                        else if ($process_name == 'Raising') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_raising = "select * from `model_defining_qc_standard_for_raising_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_raising = mysqli_query($con, $select_sql_for_raising) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_raising)> 0)
                            {
                              //if after checking data not found then insert new standard for Raising
                              //take model Raising all data 

                              /*............................................................Copy Raising..............................................................*/


                                $model_pp_version_raising_process = "select * from `model_defining_qc_standard_for_raising_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_raising_process = mysqli_query($con,$model_pp_version_raising_process) or die(mysqli_error($con));
                                $row_old_pp_version_raising_process = mysqli_fetch_array($result_model_pp_version_raising_process);

                                $standard_for_which_process= $row_old_pp_version_raising_process['process_name'];  

                                

                                $test_method_for_tensile_properties_in_warp= $row_old_pp_version_raising_process['test_method_for_tensile_properties_in_warp'];
                                $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_raising_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_tolerance_value'];
                                $tensile_properties_in_warp_value_min_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_min_value'];
                                $tensile_properties_in_warp_value_max_value= $row_old_pp_version_raising_process['tensile_properties_in_warp_value_max_value'];
                                $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_raising_process['uom_of_tensile_properties_in_warp_value'];

                                $test_method_for_tensile_properties_in_weft= $row_old_pp_version_raising_process['test_method_for_tensile_properties_in_weft'];
                                $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_raising_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_tolerance_value'];
                                $tensile_properties_in_weft_value_min_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_min_value'];
                                $tensile_properties_in_weft_value_max_value= $row_old_pp_version_raising_process['tensile_properties_in_weft_value_max_value'];
                                $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_raising_process['uom_of_tensile_properties_in_weft_value'];

                                $test_method_for_tear_force_in_warp= $row_old_pp_version_raising_process['test_method_for_tear_force_in_warp'];
                                $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_raising_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                                $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_tolerance_value'];
                                $tear_force_in_warp_value_min_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_min_value'];
                                $tear_force_in_warp_value_max_value= $row_old_pp_version_raising_process['tear_force_in_warp_value_max_value'];
                                $uom_of_tear_force_in_warp_value= $row_old_pp_version_raising_process['uom_of_tear_force_in_warp_value'];

                                $test_method_for_tear_force_in_weft= $row_old_pp_version_raising_process['test_method_for_tear_force_in_weft'];
                                $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                                $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_tolerance_value'];
                                $tear_force_in_weft_value_min_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_min_value'];
                                $tear_force_in_weft_value_max_value= $row_old_pp_version_raising_process['tear_force_in_weft_value_max_value'];
                                $uom_of_tear_force_in_weft_value= $row_old_pp_version_raising_process['uom_of_tear_force_in_weft_value'];

                                $insert_sql_statement_for_raising="INSERT INTO `defining_qc_standard_for_raising_process`( 
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`,
                                    `standard_for_which_process`, 
                              
                              
                                    
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
                              
                              
                                        `recording_person_id`, 
                                        `recording_person_name`, 
                                        `recording_time` 
                                      ) 
                              
                                     VALUES 
                                      (
                                    '$pp_number',
                                    '$version_id',
                                    '$version_name',
                                    '$customer_name',
                                    '$customer_id',
                                    '$color',
                                    '$finish_width_in_inch',
                                    '$standard_for_which_process',
                              
                              
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
                              
                                     '$user_id',
                                     '$user_name',
                                      NOW()
                                          )";
                              
                                  mysqli_query($con,$insert_sql_statement_for_raising) or die(mysqli_error($con));

                                  $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_15')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Raising standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Raising standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                              

                            }
                            else
                            {
                                $message = 'Already raising standard defined';
                            }
                        }       // End raising process
                        else if ($process_name == 'Finishing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_finishing = "select * from `model_defining_qc_standard_for_finishing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_finishing = mysqli_query($con, $select_sql_for_finishing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_finishing)> 0)
                            {
                              //if after checking data not found then insert new standard for Finishing
                              //take model Finishing all data 

                              /*............................................................Copy Finishing..............................................................*/


                                $model_pp_version_finishing_process = "select * from `model_defining_qc_standard_for_finishing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_finishing_process = mysqli_query($con,$model_pp_version_finishing_process) or die(mysqli_error($con));
                                $row_old_pp_version_finishing_process = mysqli_fetch_array($result_model_pp_version_finishing_process);

                                $standard_for_which_process= $row_old_pp_version_finishing_process['process_name'];  

                                                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
                                $washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_before_iron'];
                                $dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
                                $dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];


                                $test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
                                $washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_before_iron'];
                                $dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
                                $dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
                                $washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_after_iron'];
                                $dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
                                $dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
                                $washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_after_iron'];
                                $dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
                                $dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];



                            $test_method_for_warp_yarn_count= $row_old_pp_version_finishing_process['test_method_for_warp_yarn_count'];
                            $warp_yarn_count_value= $row_old_pp_version_finishing_process['warp_yarn_count_value'];
                            $warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['warp_yarn_count_tolerance_range_math_operator'])));
                            $warp_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['warp_yarn_count_tolerance_value'];
                            $warp_yarn_count_min_value= $row_old_pp_version_finishing_process['warp_yarn_count_min_value'];
                            $warp_yarn_count_max_value= $row_old_pp_version_finishing_process['warp_yarn_count_max_value'];
                            $uom_of_warp_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_warp_yarn_count_value'];

                            $test_method_for_weft_yarn_count= $row_old_pp_version_finishing_process['test_method_for_weft_yarn_count'];
                            $weft_yarn_count_value= $row_old_pp_version_finishing_process['weft_yarn_count_value'];
                            $weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['weft_yarn_count_tolerance_range_math_operator'])));
                            $weft_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['weft_yarn_count_tolerance_value'];
                            $weft_yarn_count_min_value= $row_old_pp_version_finishing_process['weft_yarn_count_min_value'];
                            $weft_yarn_count_max_value= $row_old_pp_version_finishing_process['weft_yarn_count_max_value'];
                            $uom_of_weft_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_weft_yarn_count_value'];

                            $test_method_for_mass_per_unit_per_area= $row_old_pp_version_finishing_process['test_method_for_mass_per_unit_per_area'];
                            $mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_value'];
                            $mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_range_math_operator'])));
                            $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_value'];
                            $mass_per_unit_per_area_min_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_min_value'];
                            $mass_per_unit_per_area_max_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_max_value'];
                            $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['uom_of_mass_per_unit_per_area_value'];

                            $test_method_for_no_of_threads_in_warp= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_warp'];
                            $no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_value'];
                            $no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_range_math_operator'])));
                            $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_value'];
                            $no_of_threads_in_warp_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_min_value'];
                            $no_of_threads_in_warp_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_max_value'];
                            $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_warp_value'];

                            $test_method_for_no_of_threads_in_weft= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_weft'];
                            $no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_value'];
                            $no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_range_math_operator'])));
                            $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_value'];
                            $no_of_threads_in_weft_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_min_value'];
                            $no_of_threads_in_weft_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_max_value'];
                            $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_weft_value'];

                            $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['description_or_type_for_surface_fuzzing_and_pilling'];
                            $test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['test_method_for_surface_fuzzing_and_pilling'];
                            $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['rubs_for_surface_fuzzing_and_pilling'];
                            $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                            $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_value'];
                            $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_min_value'];
                            $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_max_value'];
                            $uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_finishing_process['uom_of_surface_fuzzing_and_pilling_value'];

                            $test_method_for_tensile_properties_in_warp= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_warp'];
                            $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                            $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_value'];
                            $tensile_properties_in_warp_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_min_value'];
                            $tensile_properties_in_warp_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_max_value'];
                            $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_warp_value'];

                            $test_method_for_tensile_properties_in_weft= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_weft'];
                            $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                            $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_value'];
                            $tensile_properties_in_weft_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_min_value'];
                            $tensile_properties_in_weft_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_max_value'];
                            $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_weft_value'];

                            $test_method_for_tear_force_in_warp= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_warp'];
                            $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                            $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_value'];
                            $tear_force_in_warp_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_min_value'];
                            $tear_force_in_warp_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_max_value'];
                            $uom_of_tear_force_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_warp_value'];

                            $test_method_for_tear_force_in_weft= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_weft'];
                            $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                            $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_value'];
                            $tear_force_in_weft_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_min_value'];
                            $tear_force_in_weft_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_max_value'];
                            $uom_of_tear_force_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_weft_value'];


                            $test_method_for_abrasion_resistance_c_change= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_c_change'];
                            $abrasion_resistance_c_change_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_rubs'];
                            $abrasion_resistance_c_change_value_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_math_op'])));
                            $abrasion_resistance_c_change_value_tolerance_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_tolerance_value'];
                            $abrasion_resistance_c_change_value_min_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_min_value'];
                            $abrasion_resistance_c_change_value_max_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_max_value'];
                            $uom_of_abrasion_resistance_c_change_value= $row_old_pp_version_finishing_process['uom_of_abrasion_resistance_c_change_value'];

                            $test_method_for_abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_no_of_thread_break'];
                            $abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_no_of_thread_break'];
                            $abrasion_resistance_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_rubs'];
                            $abrasion_resistance_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_thread_break'];


                            $test_method_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['test_method_for_mass_loss_in_abrasion_test'];
                            $rubs_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['rubs_for_mass_loss_in_abrasion_test'];
                            $mass_loss_in_abrasion_test_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'])));
                            $mass_loss_in_abrasion_test_value_tolerance_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_value'];
                            $mass_loss_in_abrasion_test_value_min_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_min_value'];
                            $mass_loss_in_abrasion_test_value_max_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_max_value'];
                            $uom_of_mass_loss_in_abrasion_test_value= $row_old_pp_version_finishing_process['uom_of_mass_loss_in_abrasion_test_value'];

                            $test_method_for_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_color_change'];
                            $cf_to_dry_cleaning_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'])));
                            $cf_to_dry_cleaning_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_value'];
                            $cf_to_dry_cleaning_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_min_value'];
                            $cf_to_dry_cleaning_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_max_value'];
                            $uom_of_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_color_change'];

                            $test_method_for_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_staining'];
                            $cf_to_dry_cleaning_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'])));
                            $cf_to_dry_cleaning_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_value'];
                            $cf_to_dry_cleaning_staining_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_min_value'];
                            $cf_to_dry_cleaning_staining_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_max_value'];
                            $uom_of_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_staining'];


                            $test_method_for_cf_to_washing_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_color_change'];
                            $cf_to_washing_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_range_math_operator'])));
                            $cf_to_washing_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_value'];
                            $cf_to_washing_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_min_value'];
                            $cf_to_washing_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_max_value'];
                            $uom_of_cf_to_washing_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_color_change'];

                            $test_method_for_cf_to_washing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_staining'];
                            $cf_to_washing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_range_math_operator'])));
                            $cf_to_washing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_value'];
                            $cf_to_washing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_min_value'];
                            $cf_to_washing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_max_value'];
                            $uom_of_cf_to_washing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_staining'];

                            $test_method_for_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_cross_staining'];
                            $cf_to_washing_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_range_math_operator'])));
                            $cf_to_washing_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_value'];
                            $cf_to_washing_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_min_value'];
                            $cf_to_washing_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_max_value'];
                            $uom_of_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_cross_staining'];

                            $test_method_for_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_thirty_sec'];
                            $water_absorption_b_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'])));
                            $water_absorption_b_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_value'];
                            $water_absorption_b_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_min_value'];
                            $water_absorption_b_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_max_value'];
                            $uom_of_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_thirty_sec'];

                            $test_method_for_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_max'];
                            $water_absorption_b_wash_max_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_range_math_op'])));
                            $water_absorption_b_wash_max_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_value'];
                            $water_absorption_b_wash_max_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_min_value'];
                            $water_absorption_b_wash_max_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_max_value'];
                            $uom_of_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_max'];


                            $test_method_for_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_a_wash_thirty_sec'];
                            $water_absorption_a_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'])));
                            $water_absorption_a_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_value'];
                            $water_absorption_a_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_min_value'];
                            $water_absorption_a_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_max_value'];
                            $uom_of_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_a_wash_thirty_sec'];

                            $test_method_for_perspiration_acid_color_change= $row_old_pp_version_finishing_process['test_method_for_perspiration_acid_color_change'];
                            $cf_to_perspiration_acid_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'])));
                            $cf_to_perspiration_acid_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                            $cf_to_perspiration_acid_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_min_value'];
                            $cf_to_perspiration_acid_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_max_value'];
                            $uom_of_cf_to_perspiration_acid_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_color_change'];

                            $test_method_for_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_staining'];
                            $cf_to_perspiration_acid_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'])));
                            $cf_to_perspiration_acid_staining_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_value'];
                            $cf_to_perspiration_acid_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_min_value'];
                            $cf_to_perspiration_acid_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_max_value'];
                            $uom_of_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_staining'];



                            $test_method_for_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_cross_staining'];
                            $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_acid_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                            $cf_to_perspiration_acid_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_min_value'];
                            $cf_to_perspiration_acid_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_max_value'];
                            $uom_of_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_cross_staining'];


                            $test_method_for_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_color_change'];
                            $cf_to_perspiration_alkali_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                            $cf_to_perspiration_alkali_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_min_value'];
                            $cf_to_perspiration_alkali_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_max_value'];
                            $uom_of_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_color_change'];


                            $test_method_for_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_staining'];
                            $cf_to_perspiration_alkali_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                            $cf_to_perspiration_alkali_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_min_value'];
                            $cf_to_perspiration_alkali_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_max_value'];
                            $uom_of_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_staining'];

                            $test_method_for_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_cross_staining'];
                            $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
                            $cf_to_perspiration_alkali_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_min_value'];
                            $cf_to_perspiration_alkali_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_max_value'];
                            $uom_of_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_cross_staining'];

                            $test_method_for_cf_to_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_color_change'];
                            $cf_to_water_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_range_math_operator'])));
                            $cf_to_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_value'];
                            $cf_to_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_min_value'];
                            $cf_to_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_max_value'];
                            $uom_of_cf_to_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_water_color_change'];

                            $test_method_for_cf_to_water_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_staining'];
                            $cf_to_water_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_range_math_operator'])));
                            $cf_to_water_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_value'];
                            $cf_to_water_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_staining_min_value'];
                            $cf_to_water_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_staining_max_value'];
                            $uom_of_cf_to_water_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_staining'];

                            $test_method_for_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_cross_staining'];
                            $cf_to_water_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_range_math_operator'])));
                            $cf_to_water_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_value'];
                            $cf_to_water_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_min_value'];
                            $cf_to_water_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_max_value'];
                            $uom_of_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_cross_staining'];

                            $test_method_for_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_surface'];
                            $cf_to_water_spotting_surface_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_range_math_op'])));
                            $cf_to_water_spotting_surface_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_value'];
                            $cf_to_water_spotting_surface_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_min_value'];
                            $cf_to_water_spotting_surface_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_max_value'];
                            $uom_of_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_surface'];

                            $test_method_for_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_edge'];
                            $cf_to_water_spotting_edge_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_range_math_op'])));
                            $cf_to_water_spotting_edge_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_value'];
                            $cf_to_water_spotting_edge_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_min_value'];
                            $cf_to_water_spotting_edge_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_max_value'];
                            $uom_of_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_edge'];


                            $test_method_for_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_cross_staining'];
                            $cf_to_water_spotting_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'])));
                            $cf_to_water_spotting_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_value'];
                            $cf_to_water_spotting_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_min_value'];
                            $cf_to_water_spotting_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_max_value'];
                            $uom_of_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_cross_staining'];


                            $test_method_for_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_before_wash'];
                            $resistance_to_surface_wetting_before_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_before_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                            $resistance_to_surface_wetting_before_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_min_value'];
                            $resistance_to_surface_wetting_before_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_before_wash'];


                            $test_method_for_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_one_wash'];
                            $resistance_to_surface_wetting_after_one_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_after_one_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
                            $resistance_to_surface_wetting_after_one_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_min_value'];
                            $resistance_to_surface_wetting_after_one_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_one_wash'];


                            $test_method_for_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_five_wash'];
                            $resistance_to_surface_wetting_after_five_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_after_five_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
                            $resistance_to_surface_wetting_after_five_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_min_value'];
                            $resistance_to_surface_wetting_after_five_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_five_wash'];


                            $test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'])));
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
                            $uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


                            $test_method_for_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_oxidative_bleach_damage_color_change'];
                            $cf_to_oxidative_bleach_damage_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_value'];
                            $cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'])));
                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
                            $cf_to_oxidative_bleach_damage_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_min_value'];
                            $cf_to_oxidative_bleach_damage_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_max_value'];
                            $uom_of_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_oxidative_bleach_damage_color_change'];




                            $test_method_for_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_phenolic_yellowing_staining'];
                            $cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'])));
                            $cf_to_phenolic_yellowing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                            $cf_to_phenolic_yellowing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_min_value'];
                            $cf_to_phenolic_yellowing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_max_value'];
                            $uom_of_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_phenolic_yellowing_staining'];


                            $test_method_for_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_pvc_migration_staining'];
                            $cf_to_pvc_migration_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'])));
                            $cf_to_pvc_migration_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_value'];
                            $cf_to_pvc_migration_staining_min_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_min_value'];
                            $cf_to_pvc_migration_staining_max_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_max_value'];
                            $uom_of_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_pvc_migration_staining'];


                            $test_method_for_cf_to_saliva_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_staining'];
                            $cf_to_saliva_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_range_math_operator'])));
                            $cf_to_saliva_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_value'];
                            $cf_to_saliva_staining_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_staining_min_value'];
                            $cf_to_saliva_staining_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_max_value'];
                            $uom_of_cf_to_saliva_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_staining'];

                            $test_method_for_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_color_change'];
                            $cf_to_saliva_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_range_math_operator'])));
                            $cf_to_saliva_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_value'];
                            $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
                            $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
                            $cf_to_saliva_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_max_value'];
                            $uom_of_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_color_change'];


                            $test_method_for_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_chlorinated_water_color_change'];
                            $cf_to_chlorinated_water_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'])));
                            $cf_to_chlorinated_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                            $cf_to_chlorinated_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_min_value'];
                            $cf_to_chlorinated_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_max_value'];
                            $uom_of_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_chlorinated_water_color_change'];

                            $test_method_for_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_cholorine_bleach_color_change'];
                            $cf_to_cholorine_bleach_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'])));
                            $cf_to_cholorine_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
                            $cf_to_cholorine_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_min_value'];
                            $cf_to_cholorine_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_max_value'];
                            $uom_of_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_cholorine_bleach_color_change'];


                            $test_method_for_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_peroxide_bleach_color_change'];
                            $cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'])));
                            $cf_to_peroxide_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
                            $cf_to_peroxide_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_min_value'];
                            $cf_to_peroxide_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_max_value'];
                            $uom_of_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_peroxide_bleach_color_change'];

                            $test_method_for_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cross_staining'];
                            $cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cross_staining_tolerance_range_math_operator'])));
                            $cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cross_staining_tolerance_value'];
                            $cross_staining_min_value= $row_old_pp_version_finishing_process['cross_staining_min_value'];
                            $cross_staining_max_value= $row_old_pp_version_finishing_process['cross_staining_max_value'];
                            $uom_of_cross_staining= $row_old_pp_version_finishing_process['uom_of_cross_staining'];

                            $test_method_formaldehyde_content= $row_old_pp_version_finishing_process['test_method_formaldehyde_content'];
                            $formaldehyde_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['formaldehyde_content_tolerance_range_math_operator'])));
                            $formaldehyde_content_tolerance_value= $row_old_pp_version_finishing_process['formaldehyde_content_tolerance_value'];
                            $formaldehyde_content_min_value= $row_old_pp_version_finishing_process['formaldehyde_content_min_value'];
                            $formaldehyde_content_max_value= $row_old_pp_version_finishing_process['formaldehyde_content_max_value'];
                            $uom_of_formaldehyde_content= $row_old_pp_version_finishing_process['uom_of_formaldehyde_content'];

                            $test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_warp'];
                            $seam_slippage_resistance_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'])));
                            $seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_value'];
                            $seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_min_value'];
                            $seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_max_value'];
                            $uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_warp'];

                            $test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_weft'];
                            $seam_slippage_resistance_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'])));
                            $seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_value'];
                            $seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_min_value'];
                            $seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_max_value'];
                            $uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_weft'];




                            $test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
                            $seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
                            $seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
                            $seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
                            $seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
                            $uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
                            $uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


                            $test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
                            $seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'])));
                            $seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
                            $seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
                            $seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
                            $uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
                            $uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


                            $test_method_for_seam_strength_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_warp'];
                            $seam_strength_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_range_math_operator'])));
                            $seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_value'];
                            $seam_strength_in_warp_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_min_value'];
                            $seam_strength_in_warp_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_max_value'];
                            $uom_of_seam_strength_in_warp_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_warp_value'];

                            $test_method_for_seam_strength_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_weft'];
                            $seam_strength_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_range_math_operator'])));
                            $seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_value'];
                            $seam_strength_in_weft_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_min_value'];
                            $seam_strength_in_weft_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_max_value'];
                            $uom_of_seam_strength_in_weft_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_weft_value'];

                            $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'])));
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
                            $uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


                            $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'])));
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
                            $uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];



                            $test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'])));
                            $seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
                            $uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

                            $seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
                            $seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
                            $uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];

                            $ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['ph_value_tolerance_range_math_operator'])));
                            $ph_value_tolerance_value= $row_old_pp_version_finishing_process['ph_value_tolerance_value'];
                            $ph_value_min_value= $row_old_pp_version_finishing_process['ph_value_min_value'];
                            $ph_value_max_value= $row_old_pp_version_finishing_process['ph_value_max_value'];
                            $uom_of_ph_value= $row_old_pp_version_finishing_process['uom_of_ph_value'];

                            $description_or_type_for_water_absorption= $row_old_pp_version_finishing_process['description_or_type_for_water_absorption'];
                            $water_absorption_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_value_tolerance_range_math_operator'])));
                            $water_absorption_value_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_value_tolerance_value'];
                            $water_absorption_value_min_value= $row_old_pp_version_finishing_process['water_absorption_value_min_value'];
                            $water_absorption_value_max_value= $row_old_pp_version_finishing_process['water_absorption_value_max_value'];
                            $uom_of_water_absorption_value= $row_old_pp_version_finishing_process['uom_of_water_absorption_value'];

                            $wicking_test_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['wicking_test_tol_range_math_op'])));
                            $wicking_test_tolerance_value= $row_old_pp_version_finishing_process['wicking_test_tolerance_value'];
                            $wicking_test_min_value= $row_old_pp_version_finishing_process['wicking_test_min_value'];
                            $wicking_test_max_value= $row_old_pp_version_finishing_process['wicking_test_max_value'];
                            $uom_of_wicking_test= $row_old_pp_version_finishing_process['uom_of_wicking_test'];

                            $spirality_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['spirality_value_tolerance_range_math_operator'])));
                            $spirality_value_tolerance_value= $row_old_pp_version_finishing_process['spirality_value_tolerance_value'];
                            $spirality_value_min_value= $row_old_pp_version_finishing_process['spirality_value_min_value'];
                            $spirality_value_max_value= $row_old_pp_version_finishing_process['spirality_value_max_value'];
                            $uom_of_spirality_value= $row_old_pp_version_finishing_process['uom_of_spirality_value'];

                            $smoothness_appearance_tolerance_washing_cycle = $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_washing_cycle'];
                            $smoothness_appearance_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['smoothness_appearance_tolerance_range_math_op'])));
                            $smoothness_appearance_tolerance_value= $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_value'];
                            $smoothness_appearance_min_value= $row_old_pp_version_finishing_process['smoothness_appearance_min_value'];
                            $smoothness_appearance_max_value= $row_old_pp_version_finishing_process['smoothness_appearance_max_value'];
                            $uom_of_smoothness_appearance= $row_old_pp_version_finishing_process['uom_of_smoothness_appearance'];


                            $print_duribility_m_s_c_15_washing_time_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_washing_time_value'];
                            $print_duribility_m_s_c_15_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_value'];
                            $uom_of_print_duribility_m_s_c_15= $row_old_pp_version_finishing_process['uom_of_print_duribility_m_s_c_15'];


                            $description_or_type_for_iron_temperature= $row_old_pp_version_finishing_process['description_or_type_for_iron_temperature'];
                            $iron_ability_of_woven_fabric_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_range_math_op'])));
                            $iron_ability_of_woven_fabric_tolerance_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_value'];
                            $iron_ability_of_woven_fabric_min_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_min_value'];
                            $iron_ability_of_woven_fabric_max_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_max_value'];
                            $uom_of_iron_ability_of_woven_fabric= $row_old_pp_version_finishing_process['uom_of_iron_ability_of_woven_fabric'];

                            $color_fastess_to_artificial_daylight_blue_wool_scale= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_blue_wool_scale'];
                            $color_fastess_to_artificial_daylight_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'])));
                            $color_fastess_to_artificial_daylight_tolerance_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_value'];
                            $color_fastess_to_artificial_daylight_min_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_min_value'];
                            $color_fastess_to_artificial_daylight_max_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_max_value'];
                            $uom_of_color_fastess_to_artificial_daylight= $row_old_pp_version_finishing_process['uom_of_color_fastess_to_artificial_daylight'];

                            $test_method_for_moisture_content= $row_old_pp_version_finishing_process['test_method_for_moisture_content'];
                            $moisture_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['moisture_content_tolerance_range_math_op'])));
                            $moisture_content_tolerance_value= $row_old_pp_version_finishing_process['moisture_content_tolerance_value'];
                            $moisture_content_min_value= $row_old_pp_version_finishing_process['moisture_content_min_value'];
                            $moisture_content_max_value= $row_old_pp_version_finishing_process['moisture_content_max_value'];
                            $uom_of_moisture_content= $row_old_pp_version_finishing_process['uom_of_moisture_content'];


                            $test_method_for_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['test_method_for_evaporation_rate_quick_drying'];
                            $evaporation_rate_quick_drying_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_range_math_op'])));
                            $evaporation_rate_quick_drying_tolerance_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_value'];
                            $evaporation_rate_quick_drying_min_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_min_value'];
                            $evaporation_rate_quick_drying_max_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_max_value'];
                            $uom_of_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['uom_of_evaporation_rate_quick_drying'];





                            $percentage_of_total_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_value'];
                            $percentage_of_total_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_range_math_operator'])));
                            $percentage_of_total_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_value'];
                            $percentage_of_total_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_min_value'];
                            $percentage_of_total_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_max_value'];
                            $uom_of_percentage_of_total_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_cotton_content'];

                            $percentage_of_total_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_value'];
                            $percentage_of_total_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_total_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_value'];
                            $percentage_of_total_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_min_value'];
                            $percentage_of_total_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_max_value'];
                            $uom_of_percentage_of_total_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_polyester_content'];

                            /*$description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'].",".$row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber_1'];*/
                            $description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'];
                            $percentage_of_total_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_value'];
                            $percentage_of_total_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_total_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_value'];
                            $percentage_of_total_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_min_value'];
                            $percentage_of_total_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_max_value'];
                            $uom_of_percentage_of_total_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_other_fiber_content'];

                            $percentage_of_warp_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_value'];
                            $percentage_of_warp_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'])));
                            $percentage_of_warp_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_value'];
                            $percentage_of_warp_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_min_value'];
                            $uom_of_percentage_of_warp_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_cotton_content'];

                            $percentage_of_warp_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_value'];
                            $percentage_of_warp_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_warp_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_value'];
                            $percentage_of_warp_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_min_value'];
                            $percentage_of_warp_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_max_value'];
                            $uom_of_percentage_of_warp_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_polyester_content'];

                            $description_or_type_for_warp_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_warp_other_fiber'];
                            $percentage_of_warp_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_value'];
                            $percentage_of_warp_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_warp_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_value'];
                            $percentage_of_warp_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_min_value'];
                            $percentage_of_warp_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_max_value'];
                            $uom_of_percentage_of_warp_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_other_fiber_content'];

                            $percentage_of_weft_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_value'];
                            $percentage_of_weft_cotton_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_range_math_op'])));
                            $percentage_of_weft_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_value'];
                            $percentage_of_weft_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_min_value'];
                            $percentage_of_weft_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_max_value'];
                            $uom_of_percentage_of_weft_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_cotton_content'];

                            $percentage_of_weft_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_value'];
                            $percentage_of_weft_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_weft_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_value'];
                            $percentage_of_weft_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_min_value'];
                            $percentage_of_weft_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_max_value'];
                            $uom_of_percentage_of_weft_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_polyester_content'];

                            $description_or_type_for_weft_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_weft_other_fiber'];
                            $percentage_of_weft_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_value'];
                            $percentage_of_weft_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_weft_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_value'];
                            $percentage_of_weft_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_min_value'];
                            $percentage_of_weft_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_max_value'];
                            $uom_of_percentage_of_weft_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_other_fiber_content'];

                            if(isset($row_old_pp_version_finishing_process['test_method_for_appearance_after_wash']))
                            {
                                $appearance_after_wash_radio_button = $row_old_pp_version_finishing_process['test_method_for_appearance_after_wash'];
                                
                                if($appearance_after_wash_radio_button == 'Fabric (Mock up)')
                                {
                                    if(isset($row_old_pp_version_finishing_process['appearance_after_washing_cycle_fabric_wash']))
                                    {
                                        $appearance_after_wash_for_fabric_radio_button = $row_old_pp_version_finishing_process['appearance_after_washing_cycle_fabric_wash'];
                                        $appearance_after_wash_for_garments_radio_button = '';
                                    }
                                    else
                                    {
                                        $appearance_after_wash_for_fabric_radio_button = '';
                                    }
                                }
                                if($appearance_after_wash_radio_button == 'Garments')
                                {
                                    if(isset($row_old_pp_version_finishing_process['appearance_after_washing_cycle_garments_wash']))
                                    {
                                        $appearance_after_wash_for_garments_radio_button = $row_old_pp_version_finishing_process['appearance_after_washing_cycle_garments_wash'];
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

                          
                            $test_method_for_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_color_change'];
                            $appearance_after_washing_fabric_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_math_op'])));
                            $appearance_after_washing_fabric_color_change_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_color_change'];
                            $appearance_after_washing_fabric_color_change_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_min_value'];
                            $appearance_after_washing_fabric_color_change_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_max_value'];

                            $test_method_for_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_cross_staining'];
                            $appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_math_op'])));
                            $appearance_after_washing_fabric_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_cross_staining'];
                            $appearance_after_washing_fabric_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_min_value'];
                            $appearance_after_washing_fabric_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_max_value'];

                            $test_method_for_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
                            $appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_math_op'])));
                            $appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
                            $appearance_after_washing_fabric_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_min_value'];
                            $appearance_after_washing_fabric_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_pilling'];
                            $appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_math_op'])));
                            $appearance_after_washing_fabric_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_pilling'];
                            $appearance_after_washing_fabric_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_min_value'];
                            $appearance_after_washing_fabric_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_max_value'];

                            $test_method_for_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_fabric_crease_before_iron'];
                            $appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_iron_math_op'])));
                            $appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
                            $uom_of_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
                            $appearance_after_washing_fabric_crease_before_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_min_value'];
                            $appearance_after_washing_fabric_crease_before_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_fabric_crease_after_ironing'];
                            $appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_iron_math_op'])));
                            $appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];
                            $uom_of_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
                            $appearance_after_washing_fabric_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_min_value'];
                            $appearance_after_washing_fabric_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_loss_of_print'];
                            $appearance_after_washing_loss_of_print_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_loss_of_print_fabric'];
                            $test_method_for_appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
                            $appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_abrasive_mark'];
                            $test_method_for_appearance_after_washing_fabric_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_odor'];
                            $appearance_after_washing_odor_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_odor_fabric'];
                            $appearance_after_washing_other_observation_fabric = mysqli_real_escape_string($con, $row_old_pp_version_finishing_process['appearance_after_washing_other_observation_fabric']);

                            $test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['test_method_for_appear_wash_garments_color_change_without_sup'];
                            $appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_math_op'])));
                            $appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_toler_val'];
                            $uom_of_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_color_change_without_sup'];
                            $appearance_after_washing_garments_color_change_without_suppressor_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_min_value'];
                            $appearance_after_washing_garments_color_change_without_suppressor_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_max_val'];

                            $test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['test_method_for_appear_after_wash_garments_color_change_with_sup'];
                            $appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_math_op'])));
                            $appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
                            $uom_of_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_color_change_with_sup'];
                            $appearance_after_washing_garments_color_change_with_suppressor_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_min_value'];
                            $appearance_after_washing_garments_color_change_with_suppressor_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_max_value'];

                            $test_method_for_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_cross_staining'];
                            $appearance_after_washing_garments_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_cross_staining_math_op'])));
                            $appearance_after_washing_garments_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_cross_staining_tolerance_value'];
                            $uom_of_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_cross_staining'];
                            $appearance_after_washing_garments_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_min_value'];
                            $appearance_after_washing_garments_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_max_value'];

                            $test_method_for_appearance_after_washing_garments_differential_shrinkage=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_differential_shrin'];
                            $appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_differential_shrink_math_op'])));
                            $appearance_after_washing_garments__differential_shrinkage_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
                            $uom_of_appearance_after_washing_garments__differential_shrinkage=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments__differential_shrinkage'];
                            $appearance_after_washing_garments__differential_shrinkage_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrink_min_value'];
                            $appearance_after_washing_garments__differential_shrinkage_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrink_max_value'];

                            $test_method_for_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_surface_fuzzing'];
                            $appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_surface_fuzzing_math_op'])));
                            $appearance_after_washing_garments_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_fuzzing'];
                            $appearance_after_washing_garments_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_min_value'];
                            $appearance_after_washing_garments_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_max_value'];

                            $test_method_for_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_surface_pilling'];
                            $appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_surface_pilling_math_op'])));
                            $appearance_after_washing_garments_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_pilling'];
                            $appearance_after_washing_garments_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_min_value'];
                            $appearance_after_washing_garments_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_max_value'];

                            $test_method_for_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_crease_after_iron'];
                            $appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_crease_after_ironing_math_op'])));
                            $appearance_after_washing_garments_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_crease_after_ironing'];
                            $appearance_after_washing_garments_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_min_value'];
                            $appearance_after_washing_garments_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_max_value'];

                            $test_method_for_appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_abrasive_mark'];
                            $appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_garments_abrasive_mark'];
                            $test_method_for_appearance_after_washing_garments_seam_breakdown=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_seam_breakdown'];
                            $seam_breakdown_garments=$row_old_pp_version_finishing_process['seam_breakdown_garments'];

                            $test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['test_method_for_apear_after_wash_garments_seam_pucker_after_iron'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'])));
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];
                            $uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_seam_pucker_rop_rion'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value'];

                            $test_method_for_appearance_after_washing_garments_detachment_of_interlining=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_detachment_inter'];
                            $detachment_of_interlinings_fused_components_garments=$row_old_pp_version_finishing_process['detachment_of_interlinings_fused_components_garments'];
                            $test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_change_in_handle'];
                            $change_id_handle_or_appearance=$row_old_pp_version_finishing_process['change_id_handle_or_appearance'];
                            $test_method_for_appearance_after_washing_garments_effect_accessories=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_effect_access'];
                            $effect_on_accessories_such_as_buttons=$row_old_pp_version_finishing_process['effect_on_accessories_such_as_buttons'];
                            $test_method_for_appearance_after_washing_garments_spirality=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_spirality'];
                            $appearance_after_washing_garments_spirality_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_min_value'];
                            $appearance_after_washing_garments_spirality_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_max_value'];

                            $test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_detachment_fraying'];
                            $detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['detachment_or_fraying_of_ribbons'];
                            $test_method_for_appearance_after_washing_garments_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_loss_of_print'];
                            $loss_of_print_garments=$row_old_pp_version_finishing_process['loss_of_print_garments'];
                            $test_method_for_appearance_after_washing_garments_care_level=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_care_level'];
                            $care_level_garments=$row_old_pp_version_finishing_process['care_level_garments'];
                            $test_method_for_appearance_after_washing_garments_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_odor'];
                            $odor_garments=$row_old_pp_version_finishing_process['odor_garments'];
                            $appearance_after_washing_other_observation_garments = mysqli_real_escape_string($con, $row_old_pp_version_finishing_process['appearance_after_washing_other_observation_garments']);


                            $insert_sql_statement_for_finishing="INSERT INTO `defining_qc_standard_for_finishing_process`( 
                                `pp_number`, 
                                `version_id`, 
                                `version_number`, 
                                `customer_name`, 
                                `customer_id`, 
                                `color`, 
                                `finish_width_in_inch`,
                                `standard_for_which_process`, 
                        
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
                                `recording_time`) 
                                VALUES 
                                (
                                    '$pp_number',
                                    '$version_id',
                                    '$version_name',
                                    '$customer_name',
                                    '$customer_id',
                                    '$color',
                                    '$finish_width_in_inch',
                                    '$standard_for_which_process',
                        
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
                        
                                    //echo $insert_sql_statement;
                        
                                    mysqli_query($con,$insert_sql_statement_for_finishing) or die(mysqli_error($con));

                                    $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                    WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                    ORDER BY row_id DESC 
                                    LIMIT 1";
                                        
                                    $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                    $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                    if($row_for_last_process_route['process_id'] == 'proc_16')
                                    {
                                        $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Finishing standard' 
                                        WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                        mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                    }
                                    else
                                    {
                                        $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Finishing standard' 
                                        WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                        mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                    }
                            }
                            else
                            {
                                $message = 'Already finishing standard defined';
                            }
                        }       // End finishing process
                        else if ($process_name == 'Dyeing-Finish') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_dyeing_finish = "select * from `model_defining_qc_standard_for_dyeing_finish_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_dyeing_finish = mysqli_query($con, $select_sql_for_dyeing_finish) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_dyeing_finish)> 0)
                            {
                              //if after checking data not found then insert new standard for Finishing
                              //take model Finishing all data 

                              /*............................................................Copy Finishing..............................................................*/


                                $model_pp_version_dyeing_finish_process = "select * from `model_defining_qc_standard_for_dyeing_finish_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_dyeing_finish_process = mysqli_query($con,$model_pp_version_dyeing_finish_process) or die(mysqli_error($con));
                                $row_old_pp_version_finishing_process = mysqli_fetch_array($result_model_pp_version_dyeing_finish_process);

                                $standard_for_which_process= $row_old_pp_version_finishing_process['process_name'];  

                                                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_finishing_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_finishing_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
                                $washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_before_iron'];
                                $dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
                                $dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];


                                $test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
                                $washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_before_iron'];
                                $dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
                                $dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
                                $washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_warp_for_washing_after_iron'];
                                $dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
                                $dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
                                $washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_finishing_process['washing_cycle_for_weft_for_washing_after_iron'];
                                $dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
                                $dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_finishing_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_finishing_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];



                            $test_method_for_warp_yarn_count= $row_old_pp_version_finishing_process['test_method_for_warp_yarn_count'];
                            $warp_yarn_count_value= $row_old_pp_version_finishing_process['warp_yarn_count_value'];
                            $warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['warp_yarn_count_tolerance_range_math_operator'])));
                            $warp_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['warp_yarn_count_tolerance_value'];
                            $warp_yarn_count_min_value= $row_old_pp_version_finishing_process['warp_yarn_count_min_value'];
                            $warp_yarn_count_max_value= $row_old_pp_version_finishing_process['warp_yarn_count_max_value'];
                            $uom_of_warp_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_warp_yarn_count_value'];

                            $test_method_for_weft_yarn_count= $row_old_pp_version_finishing_process['test_method_for_weft_yarn_count'];
                            $weft_yarn_count_value= $row_old_pp_version_finishing_process['weft_yarn_count_value'];
                            $weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['weft_yarn_count_tolerance_range_math_operator'])));
                            $weft_yarn_count_tolerance_value= $row_old_pp_version_finishing_process['weft_yarn_count_tolerance_value'];
                            $weft_yarn_count_min_value= $row_old_pp_version_finishing_process['weft_yarn_count_min_value'];
                            $weft_yarn_count_max_value= $row_old_pp_version_finishing_process['weft_yarn_count_max_value'];
                            $uom_of_weft_yarn_count_value= $row_old_pp_version_finishing_process['uom_of_weft_yarn_count_value'];

                            $test_method_for_mass_per_unit_per_area= $row_old_pp_version_finishing_process['test_method_for_mass_per_unit_per_area'];
                            $mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_value'];
                            $mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_range_math_operator'])));
                            $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_tolerance_value'];
                            $mass_per_unit_per_area_min_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_min_value'];
                            $mass_per_unit_per_area_max_value= $row_old_pp_version_finishing_process['mass_per_unit_per_area_max_value'];
                            $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_finishing_process['uom_of_mass_per_unit_per_area_value'];

                            $test_method_for_no_of_threads_in_warp= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_warp'];
                            $no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_value'];
                            $no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_range_math_operator'])));
                            $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_tolerance_value'];
                            $no_of_threads_in_warp_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_min_value'];
                            $no_of_threads_in_warp_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_warp_max_value'];
                            $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_warp_value'];

                            $test_method_for_no_of_threads_in_weft= $row_old_pp_version_finishing_process['test_method_for_no_of_threads_in_weft'];
                            $no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_value'];
                            $no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_range_math_operator'])));
                            $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_tolerance_value'];
                            $no_of_threads_in_weft_min_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_min_value'];
                            $no_of_threads_in_weft_max_value= $row_old_pp_version_finishing_process['no_of_threads_in_weft_max_value'];
                            $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_finishing_process['uom_of_no_of_threads_in_weft_value'];

                            $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['description_or_type_for_surface_fuzzing_and_pilling'];
                            $test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['test_method_for_surface_fuzzing_and_pilling'];
                            $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_finishing_process['rubs_for_surface_fuzzing_and_pilling'];
                            $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                            $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_tolerance_value'];
                            $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_min_value'];
                            $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_finishing_process['surface_fuzzing_and_pilling_max_value'];
                            $uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_finishing_process['uom_of_surface_fuzzing_and_pilling_value'];

                            $test_method_for_tensile_properties_in_warp= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_warp'];
                            $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                            $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_tolerance_value'];
                            $tensile_properties_in_warp_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_min_value'];
                            $tensile_properties_in_warp_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_warp_value_max_value'];
                            $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_warp_value'];

                            $test_method_for_tensile_properties_in_weft= $row_old_pp_version_finishing_process['test_method_for_tensile_properties_in_weft'];
                            $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                            $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_tolerance_value'];
                            $tensile_properties_in_weft_value_min_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_min_value'];
                            $tensile_properties_in_weft_value_max_value= $row_old_pp_version_finishing_process['tensile_properties_in_weft_value_max_value'];
                            $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tensile_properties_in_weft_value'];

                            $test_method_for_tear_force_in_warp= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_warp'];
                            $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                            $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_tolerance_value'];
                            $tear_force_in_warp_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_min_value'];
                            $tear_force_in_warp_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_warp_value_max_value'];
                            $uom_of_tear_force_in_warp_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_warp_value'];

                            $test_method_for_tear_force_in_weft= $row_old_pp_version_finishing_process['test_method_for_tear_force_in_weft'];
                            $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                            $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_tolerance_value'];
                            $tear_force_in_weft_value_min_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_min_value'];
                            $tear_force_in_weft_value_max_value= $row_old_pp_version_finishing_process['tear_force_in_weft_value_max_value'];
                            $uom_of_tear_force_in_weft_value= $row_old_pp_version_finishing_process['uom_of_tear_force_in_weft_value'];


                            $test_method_for_abrasion_resistance_c_change= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_c_change'];
                            $abrasion_resistance_c_change_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_rubs'];
                            $abrasion_resistance_c_change_value_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_math_op'])));
                            $abrasion_resistance_c_change_value_tolerance_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_tolerance_value'];
                            $abrasion_resistance_c_change_value_min_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_min_value'];
                            $abrasion_resistance_c_change_value_max_value= $row_old_pp_version_finishing_process['abrasion_resistance_c_change_value_max_value'];
                            $uom_of_abrasion_resistance_c_change_value= $row_old_pp_version_finishing_process['uom_of_abrasion_resistance_c_change_value'];

                            $test_method_for_abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['test_method_for_abrasion_resistance_no_of_thread_break'];
                            $abrasion_resistance_no_of_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_no_of_thread_break'];
                            $abrasion_resistance_rubs= $row_old_pp_version_finishing_process['abrasion_resistance_rubs'];
                            $abrasion_resistance_thread_break= $row_old_pp_version_finishing_process['abrasion_resistance_thread_break'];


                            $test_method_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['test_method_for_mass_loss_in_abrasion_test'];
                            $rubs_for_mass_loss_in_abrasion_test= $row_old_pp_version_finishing_process['rubs_for_mass_loss_in_abrasion_test'];
                            $mass_loss_in_abrasion_test_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'])));
                            $mass_loss_in_abrasion_test_value_tolerance_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_tolerance_value'];
                            $mass_loss_in_abrasion_test_value_min_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_min_value'];
                            $mass_loss_in_abrasion_test_value_max_value= $row_old_pp_version_finishing_process['mass_loss_in_abrasion_test_value_max_value'];
                            $uom_of_mass_loss_in_abrasion_test_value= $row_old_pp_version_finishing_process['uom_of_mass_loss_in_abrasion_test_value'];

                            $test_method_for_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_color_change'];
                            $cf_to_dry_cleaning_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'])));
                            $cf_to_dry_cleaning_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_tolerance_value'];
                            $cf_to_dry_cleaning_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_min_value'];
                            $cf_to_dry_cleaning_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_color_change_max_value'];
                            $uom_of_cf_to_dry_cleaning_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_color_change'];

                            $test_method_for_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_dry_cleaning_staining'];
                            $cf_to_dry_cleaning_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'])));
                            $cf_to_dry_cleaning_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_tolerance_value'];
                            $cf_to_dry_cleaning_staining_min_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_min_value'];
                            $cf_to_dry_cleaning_staining_max_value= $row_old_pp_version_finishing_process['cf_to_dry_cleaning_staining_max_value'];
                            $uom_of_cf_to_dry_cleaning_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_dry_cleaning_staining'];


                            $test_method_for_cf_to_washing_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_color_change'];
                            $cf_to_washing_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_range_math_operator'])));
                            $cf_to_washing_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_tolerance_value'];
                            $cf_to_washing_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_min_value'];
                            $cf_to_washing_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_washing_color_change_max_value'];
                            $uom_of_cf_to_washing_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_color_change'];

                            $test_method_for_cf_to_washing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_staining'];
                            $cf_to_washing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_range_math_operator'])));
                            $cf_to_washing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_tolerance_value'];
                            $cf_to_washing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_min_value'];
                            $cf_to_washing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_staining_max_value'];
                            $uom_of_cf_to_washing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_staining'];

                            $test_method_for_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_washing_cross_staining'];
                            $cf_to_washing_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_range_math_operator'])));
                            $cf_to_washing_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_tolerance_value'];
                            $cf_to_washing_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_min_value'];
                            $cf_to_washing_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_washing_cross_staining_max_value'];
                            $uom_of_cf_to_washing_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_washing_cross_staining'];

                            $test_method_for_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_thirty_sec'];
                            $water_absorption_b_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'])));
                            $water_absorption_b_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_tolerance_value'];
                            $water_absorption_b_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_min_value'];
                            $water_absorption_b_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_thirty_sec_max_value'];
                            $uom_of_water_absorption_b_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_thirty_sec'];

                            $test_method_for_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['test_method_for_water_absorption_b_wash_max'];
                            $water_absorption_b_wash_max_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_range_math_op'])));
                            $water_absorption_b_wash_max_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_tolerance_value'];
                            $water_absorption_b_wash_max_min_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_min_value'];
                            $water_absorption_b_wash_max_max_value= $row_old_pp_version_finishing_process['water_absorption_b_wash_max_max_value'];
                            $uom_of_water_absorption_b_wash_max= $row_old_pp_version_finishing_process['uom_of_water_absorption_b_wash_max'];


                            $test_method_for_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['test_method_for_water_absorption_a_wash_thirty_sec'];
                            $water_absorption_a_wash_thirty_sec_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'])));
                            $water_absorption_a_wash_thirty_sec_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_tolerance_value'];
                            $water_absorption_a_wash_thirty_sec_min_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_min_value'];
                            $water_absorption_a_wash_thirty_sec_max_value= $row_old_pp_version_finishing_process['water_absorption_a_wash_thirty_sec_max_value'];
                            $uom_of_water_absorption_a_wash_thirty_sec= $row_old_pp_version_finishing_process['uom_of_water_absorption_a_wash_thirty_sec'];

                            $test_method_for_perspiration_acid_color_change= $row_old_pp_version_finishing_process['test_method_for_perspiration_acid_color_change'];
                            $cf_to_perspiration_acid_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'])));
                            $cf_to_perspiration_acid_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                            $cf_to_perspiration_acid_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_min_value'];
                            $cf_to_perspiration_acid_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_color_change_max_value'];
                            $uom_of_cf_to_perspiration_acid_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_color_change'];

                            $test_method_for_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_staining'];
                            $cf_to_perspiration_acid_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'])));
                            $cf_to_perspiration_acid_staining_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_value'];
                            $cf_to_perspiration_acid_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_min_value'];
                            $cf_to_perspiration_acid_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_staining_max_value'];
                            $uom_of_cf_to_perspiration_acid_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_staining'];



                            $test_method_for_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_acid_cross_staining'];
                            $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_acid_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                            $cf_to_perspiration_acid_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_min_value'];
                            $cf_to_perspiration_acid_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_acid_cross_staining_max_value'];
                            $uom_of_cf_to_perspiration_acid_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_acid_cross_staining'];


                            $test_method_for_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_color_change'];
                            $cf_to_perspiration_alkali_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                            $cf_to_perspiration_alkali_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_min_value'];
                            $cf_to_perspiration_alkali_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_color_change_max_value'];
                            $uom_of_cf_to_perspiration_alkali_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_color_change'];


                            $test_method_for_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_staining'];
                            $cf_to_perspiration_alkali_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                            $cf_to_perspiration_alkali_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_min_value'];
                            $cf_to_perspiration_alkali_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_staining_max_value'];
                            $uom_of_cf_to_perspiration_alkali_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_staining'];

                            $test_method_for_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_perspiration_alkali_cross_staining'];
                            $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'])));
                            $cf_to_perspiration_alkali_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
                            $cf_to_perspiration_alkali_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_min_value'];
                            $cf_to_perspiration_alkali_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_perspiration_alkali_cross_staining_max_value'];
                            $uom_of_cf_to_perspiration_alkali_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_perspiration_alkali_cross_staining'];

                            $test_method_for_cf_to_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_color_change'];
                            $cf_to_water_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_range_math_operator'])));
                            $cf_to_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_tolerance_value'];
                            $cf_to_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_min_value'];
                            $cf_to_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_water_color_change_max_value'];
                            $uom_of_cf_to_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_water_color_change'];

                            $test_method_for_cf_to_water_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_staining'];
                            $cf_to_water_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_range_math_operator'])));
                            $cf_to_water_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_staining_tolerance_value'];
                            $cf_to_water_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_staining_min_value'];
                            $cf_to_water_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_staining_max_value'];
                            $uom_of_cf_to_water_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_staining'];

                            $test_method_for_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_cross_staining'];
                            $cf_to_water_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_range_math_operator'])));
                            $cf_to_water_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_tolerance_value'];
                            $cf_to_water_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_min_value'];
                            $cf_to_water_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_cross_staining_max_value'];
                            $uom_of_cf_to_water_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_cross_staining'];

                            $test_method_for_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_surface'];
                            $cf_to_water_spotting_surface_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_range_math_op'])));
                            $cf_to_water_spotting_surface_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_tolerance_value'];
                            $cf_to_water_spotting_surface_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_min_value'];
                            $cf_to_water_spotting_surface_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_surface_max_value'];
                            $uom_of_cf_to_water_spotting_surface= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_surface'];

                            $test_method_for_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_edge'];
                            $cf_to_water_spotting_edge_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_range_math_op'])));
                            $cf_to_water_spotting_edge_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_tolerance_value'];
                            $cf_to_water_spotting_edge_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_min_value'];
                            $cf_to_water_spotting_edge_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_edge_max_value'];
                            $uom_of_cf_to_water_spotting_edge= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_edge'];


                            $test_method_for_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_water_spotting_cross_staining'];
                            $cf_to_water_spotting_cross_staining_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'])));
                            $cf_to_water_spotting_cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_tolerance_value'];
                            $cf_to_water_spotting_cross_staining_min_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_min_value'];
                            $cf_to_water_spotting_cross_staining_max_value= $row_old_pp_version_finishing_process['cf_to_water_spotting_cross_staining_max_value'];
                            $uom_of_cf_to_water_spotting_cross_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_water_spotting_cross_staining'];


                            $test_method_for_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_before_wash'];
                            $resistance_to_surface_wetting_before_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_before_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                            $resistance_to_surface_wetting_before_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_min_value'];
                            $resistance_to_surface_wetting_before_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_before_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_before_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_before_wash'];


                            $test_method_for_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_one_wash'];
                            $resistance_to_surface_wetting_after_one_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_after_one_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
                            $resistance_to_surface_wetting_after_one_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_min_value'];
                            $resistance_to_surface_wetting_after_one_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_one_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_after_one_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_one_wash'];


                            $test_method_for_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['test_method_for_resistance_to_surface_wetting_after_five_wash'];
                            $resistance_to_surface_wetting_after_five_wash_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'])));
                            $resistance_to_surface_wetting_after_five_wash_tolerance_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
                            $resistance_to_surface_wetting_after_five_wash_min_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_min_value'];
                            $resistance_to_surface_wetting_after_five_wash_max_value= $row_old_pp_version_finishing_process['resistance_to_surface_wetting_after_five_wash_max_value'];
                            $uom_of_resistance_to_surface_wetting_after_five_wash= $row_old_pp_version_finishing_process['uom_of_resistance_to_surface_wetting_after_five_wash'];


                            $test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'])));
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value'];
                            $cf_to_hydrolysis_of_reactive_dyes_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value'];
                            $uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'];


                            $test_method_for_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_oxidative_bleach_damage_color_change'];
                            $cf_to_oxidative_bleach_damage_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_value'];
                            $cf_to_oxidative_bleach_damage_color_change_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'])));
                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
                            $cf_to_oxidative_bleach_damage_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_min_value'];
                            $cf_to_oxidative_bleach_damage_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_oxidative_bleach_damage_color_change_max_value'];
                            $uom_of_cf_to_oxidative_bleach_damage_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_oxidative_bleach_damage_color_change'];




                            $test_method_for_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_phenolic_yellowing_staining'];
                            $cf_to_phenolic_yellowing_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'])));
                            $cf_to_phenolic_yellowing_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                            $cf_to_phenolic_yellowing_staining_min_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_min_value'];
                            $cf_to_phenolic_yellowing_staining_max_value= $row_old_pp_version_finishing_process['cf_to_phenolic_yellowing_staining_max_value'];
                            $uom_of_cf_to_phenolic_yellowing_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_phenolic_yellowing_staining'];


                            $test_method_for_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_pvc_migration_staining'];
                            $cf_to_pvc_migration_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'])));
                            $cf_to_pvc_migration_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_tolerance_value'];
                            $cf_to_pvc_migration_staining_min_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_min_value'];
                            $cf_to_pvc_migration_staining_max_value= $row_old_pp_version_finishing_process['cf_to_pvc_migration_staining_max_value'];
                            $uom_of_cf_to_pvc_migration_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_pvc_migration_staining'];


                            $test_method_for_cf_to_saliva_staining= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_staining'];
                            $cf_to_saliva_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_range_math_operator'])));
                            $cf_to_saliva_staining_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_tolerance_value'];
                            $cf_to_saliva_staining_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_staining_min_value'];
                            $cf_to_saliva_staining_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_staining_max_value'];
                            $uom_of_cf_to_saliva_staining= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_staining'];

                            $test_method_for_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_saliva_color_change'];
                            $cf_to_saliva_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_range_math_operator'])));
                            $cf_to_saliva_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_tolerance_value'];
                            $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
                            $cf_to_saliva_color_change_staining_min_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_staining_min_value'];
                            $cf_to_saliva_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_saliva_color_change_max_value'];
                            $uom_of_cf_to_saliva_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_saliva_color_change'];


                            $test_method_for_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_chlorinated_water_color_change'];
                            $cf_to_chlorinated_water_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'])));
                            $cf_to_chlorinated_water_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                            $cf_to_chlorinated_water_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_min_value'];
                            $cf_to_chlorinated_water_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_chlorinated_water_color_change_max_value'];
                            $uom_of_cf_to_chlorinated_water_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_chlorinated_water_color_change'];

                            $test_method_for_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_cholorine_bleach_color_change'];
                            $cf_to_cholorine_bleach_color_change_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'])));
                            $cf_to_cholorine_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
                            $cf_to_cholorine_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_min_value'];
                            $cf_to_cholorine_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_cholorine_bleach_color_change_max_value'];
                            $uom_of_cf_to_cholorine_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_cholorine_bleach_color_change'];


                            $test_method_for_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['test_method_for_cf_to_peroxide_bleach_color_change'];
                            $cf_to_peroxide_bleach_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'])));
                            $cf_to_peroxide_bleach_color_change_tolerance_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
                            $cf_to_peroxide_bleach_color_change_min_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_min_value'];
                            $cf_to_peroxide_bleach_color_change_max_value= $row_old_pp_version_finishing_process['cf_to_peroxide_bleach_color_change_max_value'];
                            $uom_of_cf_to_peroxide_bleach_color_change= $row_old_pp_version_finishing_process['uom_of_cf_to_peroxide_bleach_color_change'];

                            $test_method_for_cross_staining= $row_old_pp_version_finishing_process['test_method_for_cross_staining'];
                            $cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['cross_staining_tolerance_range_math_operator'])));
                            $cross_staining_tolerance_value= $row_old_pp_version_finishing_process['cross_staining_tolerance_value'];
                            $cross_staining_min_value= $row_old_pp_version_finishing_process['cross_staining_min_value'];
                            $cross_staining_max_value= $row_old_pp_version_finishing_process['cross_staining_max_value'];
                            $uom_of_cross_staining= $row_old_pp_version_finishing_process['uom_of_cross_staining'];

                            $test_method_formaldehyde_content= $row_old_pp_version_finishing_process['test_method_formaldehyde_content'];
                            $formaldehyde_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['formaldehyde_content_tolerance_range_math_operator'])));
                            $formaldehyde_content_tolerance_value= $row_old_pp_version_finishing_process['formaldehyde_content_tolerance_value'];
                            $formaldehyde_content_min_value= $row_old_pp_version_finishing_process['formaldehyde_content_min_value'];
                            $formaldehyde_content_max_value= $row_old_pp_version_finishing_process['formaldehyde_content_max_value'];
                            $uom_of_formaldehyde_content= $row_old_pp_version_finishing_process['uom_of_formaldehyde_content'];

                            $test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_warp'];
                            $seam_slippage_resistance_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'])));
                            $seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_tolerance_value'];
                            $seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_min_value'];
                            $seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_warp_max_value'];
                            $uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_warp'];

                            $test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_in_weft'];
                            $seam_slippage_resistance_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'])));
                            $seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_tolerance_value'];
                            $seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_min_value'];
                            $seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_in_weft_max_value'];
                            $uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_in_weft'];




                            $test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
                            $seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
                            $seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
                            $seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
                            $seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
                            $uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
                            $uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];


                            $test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_finishing_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
                            $seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'])));
                            $seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
                            $seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
                            $seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_finishing_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
                            $uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
                            $uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_finishing_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


                            $test_method_for_seam_strength_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_warp'];
                            $seam_strength_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_range_math_operator'])));
                            $seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_tolerance_value'];
                            $seam_strength_in_warp_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_min_value'];
                            $seam_strength_in_warp_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_warp_value_max_value'];
                            $uom_of_seam_strength_in_warp_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_warp_value'];

                            $test_method_for_seam_strength_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_strength_in_weft'];
                            $seam_strength_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_range_math_operator'])));
                            $seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_tolerance_value'];
                            $seam_strength_in_weft_value_min_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_min_value'];
                            $seam_strength_in_weft_value_max_value= $row_old_pp_version_finishing_process['seam_strength_in_weft_value_max_value'];
                            $uom_of_seam_strength_in_weft_value= $row_old_pp_version_finishing_process['uom_of_seam_strength_in_weft_value'];

                            $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'])));
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
                            $uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


                            $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'])));
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
                            $seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
                            $uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];



                            $test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'])));
                            $seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
                            $uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

                            $seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
                            $seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
                            $seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_finishing_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
                            $uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_finishing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];

                            $ph_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['ph_value_tolerance_range_math_operator'])));
                            $ph_value_tolerance_value= $row_old_pp_version_finishing_process['ph_value_tolerance_value'];
                            $ph_value_min_value= $row_old_pp_version_finishing_process['ph_value_min_value'];
                            $ph_value_max_value= $row_old_pp_version_finishing_process['ph_value_max_value'];
                            $uom_of_ph_value= $row_old_pp_version_finishing_process['uom_of_ph_value'];

                            $description_or_type_for_water_absorption= $row_old_pp_version_finishing_process['description_or_type_for_water_absorption'];
                            $water_absorption_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['water_absorption_value_tolerance_range_math_operator'])));
                            $water_absorption_value_tolerance_value= $row_old_pp_version_finishing_process['water_absorption_value_tolerance_value'];
                            $water_absorption_value_min_value= $row_old_pp_version_finishing_process['water_absorption_value_min_value'];
                            $water_absorption_value_max_value= $row_old_pp_version_finishing_process['water_absorption_value_max_value'];
                            $uom_of_water_absorption_value= $row_old_pp_version_finishing_process['uom_of_water_absorption_value'];

                            $wicking_test_tol_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['wicking_test_tol_range_math_op'])));
                            $wicking_test_tolerance_value= $row_old_pp_version_finishing_process['wicking_test_tolerance_value'];
                            $wicking_test_min_value= $row_old_pp_version_finishing_process['wicking_test_min_value'];
                            $wicking_test_max_value= $row_old_pp_version_finishing_process['wicking_test_max_value'];
                            $uom_of_wicking_test= $row_old_pp_version_finishing_process['uom_of_wicking_test'];

                            $spirality_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['spirality_value_tolerance_range_math_operator'])));
                            $spirality_value_tolerance_value= $row_old_pp_version_finishing_process['spirality_value_tolerance_value'];
                            $spirality_value_min_value= $row_old_pp_version_finishing_process['spirality_value_min_value'];
                            $spirality_value_max_value= $row_old_pp_version_finishing_process['spirality_value_max_value'];
                            $uom_of_spirality_value= $row_old_pp_version_finishing_process['uom_of_spirality_value'];

                            $smoothness_appearance_tolerance_washing_cycle = $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_washing_cycle'];
                            $smoothness_appearance_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['smoothness_appearance_tolerance_range_math_op'])));
                            $smoothness_appearance_tolerance_value= $row_old_pp_version_finishing_process['smoothness_appearance_tolerance_value'];
                            $smoothness_appearance_min_value= $row_old_pp_version_finishing_process['smoothness_appearance_min_value'];
                            $smoothness_appearance_max_value= $row_old_pp_version_finishing_process['smoothness_appearance_max_value'];
                            $uom_of_smoothness_appearance= $row_old_pp_version_finishing_process['uom_of_smoothness_appearance'];


                            $print_duribility_m_s_c_15_washing_time_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_washing_time_value'];
                            $print_duribility_m_s_c_15_value= $row_old_pp_version_finishing_process['print_duribility_m_s_c_15_value'];
                            $uom_of_print_duribility_m_s_c_15= $row_old_pp_version_finishing_process['uom_of_print_duribility_m_s_c_15'];


                            $description_or_type_for_iron_temperature= $row_old_pp_version_finishing_process['description_or_type_for_iron_temperature'];
                            $iron_ability_of_woven_fabric_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_range_math_op'])));
                            $iron_ability_of_woven_fabric_tolerance_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_tolerance_value'];
                            $iron_ability_of_woven_fabric_min_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_min_value'];
                            $iron_ability_of_woven_fabric_max_value= $row_old_pp_version_finishing_process['iron_ability_of_woven_fabric_max_value'];
                            $uom_of_iron_ability_of_woven_fabric= $row_old_pp_version_finishing_process['uom_of_iron_ability_of_woven_fabric'];

                            $color_fastess_to_artificial_daylight_blue_wool_scale= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_blue_wool_scale'];
                            $color_fastess_to_artificial_daylight_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'])));
                            $color_fastess_to_artificial_daylight_tolerance_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_tolerance_value'];
                            $color_fastess_to_artificial_daylight_min_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_min_value'];
                            $color_fastess_to_artificial_daylight_max_value= $row_old_pp_version_finishing_process['color_fastess_to_artificial_daylight_max_value'];
                            $uom_of_color_fastess_to_artificial_daylight= $row_old_pp_version_finishing_process['uom_of_color_fastess_to_artificial_daylight'];

                            $test_method_for_moisture_content= $row_old_pp_version_finishing_process['test_method_for_moisture_content'];
                            $moisture_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['moisture_content_tolerance_range_math_op'])));
                            $moisture_content_tolerance_value= $row_old_pp_version_finishing_process['moisture_content_tolerance_value'];
                            $moisture_content_min_value= $row_old_pp_version_finishing_process['moisture_content_min_value'];
                            $moisture_content_max_value= $row_old_pp_version_finishing_process['moisture_content_max_value'];
                            $uom_of_moisture_content= $row_old_pp_version_finishing_process['uom_of_moisture_content'];


                            $test_method_for_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['test_method_for_evaporation_rate_quick_drying'];
                            $evaporation_rate_quick_drying_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_range_math_op'])));
                            $evaporation_rate_quick_drying_tolerance_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_tolerance_value'];
                            $evaporation_rate_quick_drying_min_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_min_value'];
                            $evaporation_rate_quick_drying_max_value= $row_old_pp_version_finishing_process['evaporation_rate_quick_drying_max_value'];
                            $uom_of_evaporation_rate_quick_drying= $row_old_pp_version_finishing_process['uom_of_evaporation_rate_quick_drying'];





                            $percentage_of_total_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_value'];
                            $percentage_of_total_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_range_math_operator'])));
                            $percentage_of_total_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_tolerance_value'];
                            $percentage_of_total_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_min_value'];
                            $percentage_of_total_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_cotton_content_max_value'];
                            $uom_of_percentage_of_total_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_cotton_content'];

                            $percentage_of_total_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_value'];
                            $percentage_of_total_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_total_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_tolerance_value'];
                            $percentage_of_total_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_min_value'];
                            $percentage_of_total_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_polyester_content_max_value'];
                            $uom_of_percentage_of_total_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_polyester_content'];

                            /*$description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'].",".$row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber_1'];*/
                            $description_or_type_for_total_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_total_other_fiber'];
                            $percentage_of_total_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_value'];
                            $percentage_of_total_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_total_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_tolerance_value'];
                            $percentage_of_total_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_min_value'];
                            $percentage_of_total_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_total_other_fiber_content_max_value'];
                            $uom_of_percentage_of_total_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_total_other_fiber_content'];

                            $percentage_of_warp_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_value'];
                            $percentage_of_warp_cotton_content_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'])));
                            $percentage_of_warp_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_tolerance_value'];
                            $percentage_of_warp_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_cotton_content_min_value'];
                            $uom_of_percentage_of_warp_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_cotton_content'];

                            $percentage_of_warp_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_value'];
                            $percentage_of_warp_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_warp_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_tolerance_value'];
                            $percentage_of_warp_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_min_value'];
                            $percentage_of_warp_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_polyester_content_max_value'];
                            $uom_of_percentage_of_warp_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_polyester_content'];

                            $description_or_type_for_warp_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_warp_other_fiber'];
                            $percentage_of_warp_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_value'];
                            $percentage_of_warp_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_warp_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_tolerance_value'];
                            $percentage_of_warp_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_min_value'];
                            $percentage_of_warp_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_warp_other_fiber_content_max_value'];
                            $uom_of_percentage_of_warp_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_warp_other_fiber_content'];

                            $percentage_of_weft_cotton_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_value'];
                            $percentage_of_weft_cotton_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_range_math_op'])));
                            $percentage_of_weft_cotton_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_tolerance_value'];
                            $percentage_of_weft_cotton_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_min_value'];
                            $percentage_of_weft_cotton_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_cotton_content_max_value'];
                            $uom_of_percentage_of_weft_cotton_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_cotton_content'];

                            $percentage_of_weft_polyester_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_value'];
                            $percentage_of_weft_polyester_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_range_math_op'])));
                            $percentage_of_weft_polyester_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_tolerance_value'];
                            $percentage_of_weft_polyester_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_min_value'];
                            $percentage_of_weft_polyester_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_polyester_content_max_value'];
                            $uom_of_percentage_of_weft_polyester_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_polyester_content'];

                            $description_or_type_for_weft_other_fiber= $row_old_pp_version_finishing_process['description_or_type_for_weft_other_fiber'];
                            $percentage_of_weft_other_fiber_content_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_value'];
                            $percentage_of_weft_other_fiber_content_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'])));
                            $percentage_of_weft_other_fiber_content_tolerance_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_tolerance_value'];
                            $percentage_of_weft_other_fiber_content_min_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_min_value'];
                            $percentage_of_weft_other_fiber_content_max_value= $row_old_pp_version_finishing_process['percentage_of_weft_other_fiber_content_max_value'];
                            $uom_of_percentage_of_weft_other_fiber_content= $row_old_pp_version_finishing_process['uom_of_percentage_of_weft_other_fiber_content'];

                            if(isset($row_old_pp_version_finishing_process['test_method_for_appearance_after_wash']))
                            {
                                $appearance_after_wash_radio_button = $row_old_pp_version_finishing_process['test_method_for_appearance_after_wash'];
                                
                                if($appearance_after_wash_radio_button == 'Fabric (Mock up)')
                                {
                                    if(isset($row_old_pp_version_finishing_process['appearance_after_washing_cycle_fabric_wash']))
                                    {
                                        $appearance_after_wash_for_fabric_radio_button = $row_old_pp_version_finishing_process['appearance_after_washing_cycle_fabric_wash'];
                                        $appearance_after_wash_for_garments_radio_button = '';
                                    }
                                    else
                                    {
                                        $appearance_after_wash_for_fabric_radio_button = '';
                                    }
                                }
                                if($appearance_after_wash_radio_button == 'Garments')
                                {
                                    if(isset($row_old_pp_version_finishing_process['appearance_after_washing_cycle_garments_wash']))
                                    {
                                        $appearance_after_wash_for_garments_radio_button = $row_old_pp_version_finishing_process['appearance_after_washing_cycle_garments_wash'];
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

                          
                            $test_method_for_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_color_change'];
                            $appearance_after_washing_fabric_color_change_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_math_op'])));
                            $appearance_after_washing_fabric_color_change_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_color_change=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_color_change'];
                            $appearance_after_washing_fabric_color_change_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_min_value'];
                            $appearance_after_washing_fabric_color_change_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_color_change_max_value'];

                            $test_method_for_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_cross_staining'];
                            $appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_math_op'])));
                            $appearance_after_washing_fabric_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_cross_staining'];
                            $appearance_after_washing_fabric_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_min_value'];
                            $appearance_after_washing_fabric_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_cross_staining_max_value'];

                            $test_method_for_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_fuzzing'];
                            $appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_math_op'])));
                            $appearance_after_washing_fabric_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_fuzzing'];
                            $appearance_after_washing_fabric_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_min_value'];
                            $appearance_after_washing_fabric_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_surface_pilling'];
                            $appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_math_op'])));
                            $appearance_after_washing_fabric_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                            $uom_of_appearance_after_washing_fabric_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_surface_pilling'];
                            $appearance_after_washing_fabric_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_min_value'];
                            $appearance_after_washing_fabric_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_surface_pilling_max_value'];

                            $test_method_for_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_fabric_crease_before_iron'];
                            $appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_iron_math_op'])));
                            $appearance_after_washing_fabric_crease_before_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
                            $uom_of_appearance_after_washing_fabric_crease_before_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_before_ironing'];
                            $appearance_after_washing_fabric_crease_before_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_min_value'];
                            $appearance_after_washing_fabric_crease_before_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_before_ironing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_fabric_crease_after_ironing'];
                            $appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_iron_math_op'])));
                            $appearance_after_washing_fabric_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];
                            $uom_of_appearance_after_washing_fabric_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_fabric_crease_after_ironing'];
                            $appearance_after_washing_fabric_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_min_value'];
                            $appearance_after_washing_fabric_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_crease_after_ironing_max_value'];

                            $test_method_for_appearance_after_washing_fabric_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_loss_of_print'];
                            $appearance_after_washing_loss_of_print_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_loss_of_print_fabric'];
                            $test_method_for_appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_abrasive_mark'];
                            $appearance_after_washing_fabric_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_fabric_abrasive_mark'];
                            $test_method_for_appearance_after_washing_fabric_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_fabric_odor'];
                            $appearance_after_washing_odor_fabric=$row_old_pp_version_finishing_process['appearance_after_washing_odor_fabric'];
                            $appearance_after_washing_other_observation_fabric = mysqli_real_escape_string($con, $row_old_pp_version_finishing_process['appearance_after_washing_other_observation_fabric']);

                            $test_method_for_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['test_method_for_appear_wash_garments_color_change_without_sup'];
                            $appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_math_op'])));
                            $appearance_after_washing_garments_color_change_without_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_toler_val'];
                            $uom_of_appearance_after_washing_garments_color_change_without_suppressor=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_color_change_without_sup'];
                            $appearance_after_washing_garments_color_change_without_suppressor_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_min_value'];
                            $appearance_after_washing_garments_color_change_without_suppressor_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_without_sup_max_val'];

                            $test_method_for_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['test_method_for_appear_after_wash_garments_color_change_with_sup'];
                            $appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_math_op'])));
                            $appearance_after_washing_garments_color_change_with_suppressor_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
                            $uom_of_appearance_after_washing_garments_color_change_with_suppressor=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_color_change_with_sup'];
                            $appearance_after_washing_garments_color_change_with_suppressor_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_min_value'];
                            $appearance_after_washing_garments_color_change_with_suppressor_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_color_change_with_sup_max_value'];

                            $test_method_for_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_cross_staining'];
                            $appearance_after_washing_garments_cross_staining_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_cross_staining_math_op'])));
                            $appearance_after_washing_garments_cross_staining_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_cross_staining_tolerance_value'];
                            $uom_of_appearance_after_washing_garments_cross_staining=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_cross_staining'];
                            $appearance_after_washing_garments_cross_staining_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_min_value'];
                            $appearance_after_washing_garments_cross_staining_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_cross_staining_max_value'];

                            $test_method_for_appearance_after_washing_garments_differential_shrinkage=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_differential_shrin'];
                            $appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_differential_shrink_math_op'])));
                            $appearance_after_washing_garments__differential_shrinkage_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
                            $uom_of_appearance_after_washing_garments__differential_shrinkage=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments__differential_shrinkage'];
                            $appearance_after_washing_garments__differential_shrinkage_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrink_min_value'];
                            $appearance_after_washing_garments__differential_shrinkage_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments__differential_shrink_max_value'];

                            $test_method_for_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_surface_fuzzing'];
                            $appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_surface_fuzzing_math_op'])));
                            $appearance_after_washing_garments_surface_fuzzing_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_surface_fuzzing=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_fuzzing'];
                            $appearance_after_washing_garments_surface_fuzzing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_min_value'];
                            $appearance_after_washing_garments_surface_fuzzing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_fuzzing_max_value'];

                            $test_method_for_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_surface_pilling'];
                            $appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_surface_pilling_math_op'])));
                            $appearance_after_washing_garments_surface_pilling_tolerance_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_surface_pilling=$row_old_pp_version_finishing_process['uom_of_appearance_after_washing_garments_surface_pilling'];
                            $appearance_after_washing_garments_surface_pilling_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_min_value'];
                            $appearance_after_washing_garments_surface_pilling_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_surface_pilling_max_value'];

                            $test_method_for_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_crease_after_iron'];
                            $appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_washing_garments_crease_after_ironing_math_op'])));
                            $appearance_after_washing_garments_crease_after_ironing_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];
                            $uom_of_appearance_after_washing_garments_crease_after_ironing=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_crease_after_ironing'];
                            $appearance_after_washing_garments_crease_after_ironing_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_min_value'];
                            $appearance_after_washing_garments_crease_after_ironing_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_crease_after_ironing_max_value'];

                            $test_method_for_appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_abrasive_mark'];
                            $appearance_after_washing_garments_abrasive_mark=$row_old_pp_version_finishing_process['appearance_after_washing_garments_abrasive_mark'];
                            $test_method_for_appearance_after_washing_garments_seam_breakdown=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_seam_breakdown'];
                            $seam_breakdown_garments=$row_old_pp_version_finishing_process['seam_breakdown_garments'];

                            $test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['test_method_for_apear_after_wash_garments_seam_pucker_after_iron'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_finishing_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'])));
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];
                            $uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron=$row_old_pp_version_finishing_process['uom_of_appear_after_washing_garments_seam_pucker_rop_rion'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value'];
                            $appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value=$row_old_pp_version_finishing_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value'];

                            $test_method_for_appearance_after_washing_garments_detachment_of_interlining=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_detachment_inter'];
                            $detachment_of_interlinings_fused_components_garments=$row_old_pp_version_finishing_process['detachment_of_interlinings_fused_components_garments'];
                            $test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_change_in_handle'];
                            $change_id_handle_or_appearance=$row_old_pp_version_finishing_process['change_id_handle_or_appearance'];
                            $test_method_for_appearance_after_washing_garments_effect_accessories=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_effect_access'];
                            $effect_on_accessories_such_as_buttons=$row_old_pp_version_finishing_process['effect_on_accessories_such_as_buttons'];
                            $test_method_for_appearance_after_washing_garments_spirality=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_spirality'];
                            $appearance_after_washing_garments_spirality_min_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_min_value'];
                            $appearance_after_washing_garments_spirality_max_value=$row_old_pp_version_finishing_process['appearance_after_washing_garments_spirality_max_value'];

                            $test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['test_method_for_appear_after_washing_garments_detachment_fraying'];
                            $detachment_or_fraying_of_ribbons=$row_old_pp_version_finishing_process['detachment_or_fraying_of_ribbons'];
                            $test_method_for_appearance_after_washing_garments_loss_of_print=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_loss_of_print'];
                            $loss_of_print_garments=$row_old_pp_version_finishing_process['loss_of_print_garments'];
                            $test_method_for_appearance_after_washing_garments_care_level=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_care_level'];
                            $care_level_garments=$row_old_pp_version_finishing_process['care_level_garments'];
                            $test_method_for_appearance_after_washing_garments_odor=$row_old_pp_version_finishing_process['test_method_for_appearance_after_washing_garments_odor'];
                            $odor_garments=$row_old_pp_version_finishing_process['odor_garments'];
                            $appearance_after_washing_other_observation_garments = mysqli_real_escape_string($con, $row_old_pp_version_finishing_process['appearance_after_washing_other_observation_garments']);


                            $insert_sql_statement_for_dyeing_finish = "INSERT INTO `defining_qc_standard_for_dyeing_finish_process`( 
                                `pp_number`, 
                                `version_id`, 
                                `version_number`, 
                                `customer_name`, 
                                `customer_id`, 
                                `color`, 
                                `finish_width_in_inch`,
                                `standard_for_which_process`, 
                        
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
                                `recording_time`) 
                                VALUES 
                                (
                                    '$pp_number',
                                    '$version_id',
                                    '$version_name',
                                    '$customer_name',
                                    '$customer_id',
                                    '$color',
                                    '$finish_width_in_inch',
                                    '$standard_for_which_process',
                        
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
                        
                                    //echo $insert_sql_statement;
                        
                                    mysqli_query($con,$insert_sql_statement_for_dyeing_finish) or die(mysqli_error($con));

                                    $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                    WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                    ORDER BY row_id DESC 
                                    LIMIT 1";
                                        
                                    $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                    $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                    if($row_for_last_process_route['process_id'] == 'proc_23')
                                    {
                                        $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Dyeing-Finish standard' 
                                        WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                        mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                    }
                                    else
                                    {
                                        $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Dyeing-Finish standard' 
                                        WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                        mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                    }
                            }
                            else
                            {
                                $message = 'Already Dyeing-Finish standard defined';
                            }
                        }       // End Dyeing-Finish process
                        else if ($process_name == 'Calander') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_calendering = "select * from `model_defining_qc_standard_for_calendering_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_calendering = mysqli_query($con, $select_sql_for_calendering) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_calendering)> 0)
                            {
                              //if after checking data not found then insert new standard for calendering
                              //take model calendering all data 

                              /*............................................................Copy calendering..............................................................*/


                                $model_pp_version_calendering_process = "select * from `model_defining_qc_standard_for_calendering_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_calendering_process = mysqli_query($con,$model_pp_version_calendering_process) or die(mysqli_error($con));
                                $row_old_pp_version_calendering_process = mysqli_fetch_array($result_model_pp_version_calendering_process);

                                $standard_for_which_process= $row_old_pp_version_calendering_process['process_name'];  

                                                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_calendering_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_calendering_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_calendering_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_calendering_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_calendering_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_calendering_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
                                $washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_calendering_process['washing_cycle_for_warp_for_washing_before_iron'];
                                $dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
                                $dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
                                $washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_calendering_process['washing_cycle_for_weft_for_washing_before_iron'];
                                $dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
                                $dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
                                $washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_calendering_process['washing_cycle_for_warp_for_washing_after_iron'];
                                $dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
                                $dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_calendering_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
                                $washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_calendering_process['washing_cycle_for_weft_for_washing_after_iron'];
                                $dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
                                $dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_calendering_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_calendering_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];

                                $test_method_for_warp_yarn_count= $row_old_pp_version_calendering_process['test_method_for_warp_yarn_count'];
                                $warp_yarn_count_value= $row_old_pp_version_calendering_process['warp_yarn_count_value'];
                                $warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['warp_yarn_count_tolerance_range_math_operator'])));
                                $warp_yarn_count_tolerance_value= $row_old_pp_version_calendering_process['warp_yarn_count_tolerance_value'];
                                $warp_yarn_count_min_value= $row_old_pp_version_calendering_process['warp_yarn_count_min_value'];
                                $warp_yarn_count_max_value= $row_old_pp_version_calendering_process['warp_yarn_count_max_value'];
                                $uom_of_warp_yarn_count_value= $row_old_pp_version_calendering_process['uom_of_warp_yarn_count_value'];

                                $test_method_for_weft_yarn_count= $row_old_pp_version_calendering_process['test_method_for_weft_yarn_count'];
                                $weft_yarn_count_value= $row_old_pp_version_calendering_process['weft_yarn_count_value'];
                                $weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['weft_yarn_count_tolerance_range_math_operator'])));
                                $weft_yarn_count_tolerance_value= $row_old_pp_version_calendering_process['weft_yarn_count_tolerance_value'];
                                $weft_yarn_count_min_value= $row_old_pp_version_calendering_process['weft_yarn_count_min_value'];
                                $weft_yarn_count_max_value= $row_old_pp_version_calendering_process['weft_yarn_count_max_value'];
                                $uom_of_weft_yarn_count_value= $row_old_pp_version_calendering_process['uom_of_weft_yarn_count_value'];

                                $test_method_for_no_of_threads_in_warp= $row_old_pp_version_calendering_process['test_method_for_no_of_threads_in_warp'];
                                $no_of_threads_in_warp_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_value'];
                                $no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['no_of_threads_in_warp_tolerance_range_math_operator'])));
                                $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_tolerance_value'];
                                $no_of_threads_in_warp_min_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_min_value'];
                                $no_of_threads_in_warp_max_value= $row_old_pp_version_calendering_process['no_of_threads_in_warp_max_value'];
                                $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_calendering_process['uom_of_no_of_threads_in_warp_value'];

                                $test_method_for_no_of_threads_in_weft= $row_old_pp_version_calendering_process['test_method_for_no_of_threads_in_weft'];
                                $no_of_threads_in_weft_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_value'];
                                $no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['no_of_threads_in_weft_tolerance_range_math_operator'])));
                                $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_tolerance_value'];
                                $no_of_threads_in_weft_min_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_min_value'];
                                $no_of_threads_in_weft_max_value= $row_old_pp_version_calendering_process['no_of_threads_in_weft_max_value'];
                                $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_calendering_process['uom_of_no_of_threads_in_weft_value'];


                                $test_method_for_mass_per_unit_per_area= $row_old_pp_version_calendering_process['test_method_for_mass_per_unit_per_area'];
                                $mass_per_unit_per_area_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_value'];
                                $mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['mass_per_unit_per_area_tolerance_range_math_operator'])));
                                $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_tolerance_value'];
                                $mass_per_unit_per_area_min_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_min_value'];
                                $mass_per_unit_per_area_max_value= $row_old_pp_version_calendering_process['mass_per_unit_per_area_max_value'];
                                $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_calendering_process['uom_of_mass_per_unit_per_area_value'];


                                $test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['test_method_for_surface_fuzzing_and_pilling'];
                                $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_calendering_process['rubs_for_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                                $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_tolerance_value'];
                                $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_min_value'];
                                $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_calendering_process['surface_fuzzing_and_pilling_max_value'];
                                $uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_calendering_process['uom_of_surface_fuzzing_and_pilling_value'];


                                $test_method_for_tensile_properties_in_warp= $row_old_pp_version_calendering_process['test_method_for_tensile_properties_in_warp'];
                                $tensile_properties_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_tolerance_value'];
                                $tensile_properties_in_warp_value_min_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_min_value'];
                                $tensile_properties_in_warp_value_max_value= $row_old_pp_version_calendering_process['tensile_properties_in_warp_value_max_value'];
                                $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_calendering_process['uom_of_tensile_properties_in_warp_value'];

                                $test_method_for_tensile_properties_in_weft= $row_old_pp_version_calendering_process['test_method_for_tensile_properties_in_weft'];
                                $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_tolerance_value'];
                                $tensile_properties_in_weft_value_min_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_min_value'];
                                $tensile_properties_in_weft_value_max_value= $row_old_pp_version_calendering_process['tensile_properties_in_weft_value_max_value'];
                                $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_calendering_process['uom_of_tensile_properties_in_weft_value'];

                                $test_method_for_tear_force_in_warp= $row_old_pp_version_calendering_process['test_method_for_tear_force_in_warp'];
                                $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                                $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_tolerance_value'];
                                $tear_force_in_warp_value_min_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_min_value'];
                                $tear_force_in_warp_value_max_value= $row_old_pp_version_calendering_process['tear_force_in_warp_value_max_value'];
                                $uom_of_tear_force_in_warp_value= $row_old_pp_version_calendering_process['uom_of_tear_force_in_warp_value'];

                                $test_method_for_tear_force_in_weft= $row_old_pp_version_calendering_process['test_method_for_tear_force_in_weft'];
                                $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                                $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_tolerance_value'];
                                $tear_force_in_weft_value_min_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_min_value'];
                                $tear_force_in_weft_value_max_value= $row_old_pp_version_calendering_process['tear_force_in_weft_value_max_value'];
                                $uom_of_tear_force_in_weft_value= $row_old_pp_version_calendering_process['uom_of_tear_force_in_weft_value'];


                                $test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_in_warp'];
                                $seam_slippage_resistance_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'])));
                                $seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_tolerance_value'];
                                $seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_min_value'];
                                $seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_warp_max_value'];
                                $uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_in_warp'];

                                $test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_in_weft'];
                                $seam_slippage_resistance_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'])));
                                $seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_tolerance_value'];
                                $seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_min_value'];
                                $seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_in_weft_max_value'];
                                $uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_in_weft'];



                                $test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
                                $seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
                                $seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
                                $seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
                                $seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
                                $uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
                                $uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];

                                $test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_calendering_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
                                $seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'])));
                                $seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
                                $seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
                                $seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_calendering_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
                                $uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
                                $uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_calendering_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


                                $test_method_for_seam_strength_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_strength_in_warp'];
                                $seam_strength_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_strength_in_warp_value_tolerance_range_math_operator'])));
                                $seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_tolerance_value'];
                                $seam_strength_in_warp_value_min_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_min_value'];
                                $seam_strength_in_warp_value_max_value= $row_old_pp_version_calendering_process['seam_strength_in_warp_value_max_value'];
                                $uom_of_seam_strength_in_warp_value= $row_old_pp_version_calendering_process['uom_of_seam_strength_in_warp_value'];

                                $test_method_for_seam_strength_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_strength_in_weft'];
                                $seam_strength_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_strength_in_weft_value_tolerance_range_math_operator'])));
                                $seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_tolerance_value'];
                                $seam_strength_in_weft_value_min_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_min_value'];
                                $seam_strength_in_weft_value_max_value= $row_old_pp_version_calendering_process['seam_strength_in_weft_value_max_value'];
                                $uom_of_seam_strength_in_weft_value= $row_old_pp_version_calendering_process['uom_of_seam_strength_in_weft_value'];

                                $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'])));
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
                                $uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


                                $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'])));
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
                                $uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


                                $test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'])));
                                $seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
                                $uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

                                $test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
                                $seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_calendering_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
                                $uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_calendering_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


                                $insert_sql_statement_for_calendering="INSERT INTO `defining_qc_standard_for_calendering_process`( 
                                    `pp_number`, 
                                    `version_id`, 
                                    `version_number`, 
                                    `customer_name`, 
                                    `customer_id`, 
                                    `color`, 
                                    `finish_width_in_inch`,
                                    `standard_for_which_process`, 
                              
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
                                      VALUES 
                                      (
                                       '$pp_number',
                                       '$version_id',
                                       '$version_name',
                                       '$customer_name',
                                       '$customer_id',
                                       '$color',
                                       '$finish_width_in_inch',
                                       '$standard_for_which_process',
                              
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
                              
                                  mysqli_query($con,$insert_sql_statement_for_calendering) or die(mysqli_error($con));

                                  $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                  WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                  ORDER BY row_id DESC 
                                  LIMIT 1";
                                      
                                  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                  if($row_for_last_process_route['process_id'] == 'proc_17')
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Calander standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                                  else
                                  {
                                      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Calander standard' 
                                      WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                  }
                            }
                            else
                            {
                                $message = 'Already calendering standard defined';
                            }
                        }       // End calendering process
                        else if ($process_name == 'Sanforizing') 
                        {
                            //check duplicacy if pp and version wise data in system 
                         
                            $select_sql_for_sanforizing = "select * from `model_defining_qc_standard_for_sanforizing_process` 
                                                            where 
                                                            `version_number`='$version_name' and 
                                                            `customer_id`='$customer_id' and 
                                                            `customer_name` = '$customer_name' and 
                                                            `color` = '$color' and
                                                            `process_name` = '$process_name'  ";

                            $result_sanforizing = mysqli_query($con, $select_sql_for_sanforizing) or die(mysqli_error($con));

                            if(mysqli_num_rows($result_sanforizing)> 0)
                            {
                              //if after checking data not found then insert new standard for sanforizing
                              //take model sanforizing all data 

                              /*............................................................Copy sanforizing..............................................................*/


                                $model_pp_version_sanforizing_process = "select * from `model_defining_qc_standard_for_sanforizing_process` 
                                                                                where 
                                                                                `version_number`='$version_name' and 
                                                                                `customer_id`='$customer_id' and 
                                                                                `customer_name` = '$customer_name' and 
                                                                                `color` = '$color' and
                                                                                `process_name` = '$process_name'  ";    

                                $result_model_pp_version_sanforizing_process = mysqli_query($con,$model_pp_version_sanforizing_process) or die(mysqli_error($con));
                                $row_old_pp_version_sanforizing_process = mysqli_fetch_array($result_model_pp_version_sanforizing_process);

                                $standard_for_which_process= $row_old_pp_version_sanforizing_process['process_name'];  

                                                                
                                $test_method_for_cf_to_rubbing_dry= $row_old_pp_version_sanforizing_process['test_method_for_cf_to_rubbing_dry'];
                                $cf_to_rubbing_dry_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_tolerance_range_math_operator'])));
                                $cf_to_rubbing_dry_tolerance_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_tolerance_value'];
                                $cf_to_rubbing_dry_min_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_min_value'];
                                $cf_to_rubbing_dry_max_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_dry_max_value'];
                                $uom_of_cf_to_rubbing_dry= $row_old_pp_version_sanforizing_process['uom_of_cf_to_rubbing_dry'];

                                $test_method_for_cf_to_rubbing_wet= $row_old_pp_version_sanforizing_process['test_method_for_cf_to_rubbing_wet'];
                                $cf_to_rubbing_wet_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_tolerance_range_math_operator'])));
                                $cf_to_rubbing_wet_tolerance_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_tolerance_value'];
                                $cf_to_rubbing_wet_min_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_min_value'];
                                $cf_to_rubbing_wet_max_value= $row_old_pp_version_sanforizing_process['cf_to_rubbing_wet_max_value'];
                                $uom_of_cf_to_rubbing_wet= $row_old_pp_version_sanforizing_process['uom_of_cf_to_rubbing_wet'];

                                $test_method_for_dimensional_stability_to_warp_washing_b_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_warp_washing_b_iron'];
                                $washing_cycle_for_warp_for_washing_before_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_warp_for_washing_before_iron'];
                                $dimensional_stability_to_warp_washing_before_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_before_iron_min_value'];
                                $dimensional_stability_to_warp_washing_before_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_before_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_warp_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_b_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_weft_washing_b_iron'];
                                $washing_cycle_for_weft_for_washing_before_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_weft_for_washing_before_iron'];
                                $dimensional_stability_to_weft_washing_before_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_before_iron_min_value'];
                                $dimensional_stability_to_weft_washing_before_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_before_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_before_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_weft_washing_before_iron'];

                                $test_method_for_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_warp_washing_after_iron'];
                                $washing_cycle_for_warp_for_washing_after_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_warp_for_washing_after_iron'];
                                $dimensional_stability_to_warp_washing_after_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_after_iron_min_value'];
                                $dimensional_stability_to_warp_washing_after_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_warp_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_warp_washing_after_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_warp_washing_after_iron'];

                                $test_method_for_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_sanforizing_process['test_method_for_dimensional_stability_to_weft_washing_after_iron'];
                                $washing_cycle_for_weft_for_washing_after_iron= $row_old_pp_version_sanforizing_process['washing_cycle_for_weft_for_washing_after_iron'];
                                $dimensional_stability_to_weft_washing_after_iron_min_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_after_iron_min_value'];
                                $dimensional_stability_to_weft_washing_after_iron_max_value= $row_old_pp_version_sanforizing_process['dimensional_stability_to_weft_washing_after_iron_max_value'];
                                $uom_of_dimensional_stability_to_weft_washing_after_iron= $row_old_pp_version_sanforizing_process['uom_of_dimensional_stability_to_weft_washing_after_iron'];

                                $test_method_for_warp_yarn_count= $row_old_pp_version_sanforizing_process['test_method_for_warp_yarn_count'];
                                $warp_yarn_count_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_value'];
                                $warp_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['warp_yarn_count_tolerance_range_math_operator'])));
                                $warp_yarn_count_tolerance_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_tolerance_value'];
                                $warp_yarn_count_min_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_min_value'];
                                $warp_yarn_count_max_value= $row_old_pp_version_sanforizing_process['warp_yarn_count_max_value'];
                                $uom_of_warp_yarn_count_value= $row_old_pp_version_sanforizing_process['uom_of_warp_yarn_count_value'];

                                $test_method_for_weft_yarn_count= $row_old_pp_version_sanforizing_process['test_method_for_weft_yarn_count'];
                                $weft_yarn_count_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_value'];
                                $weft_yarn_count_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['weft_yarn_count_tolerance_range_math_operator'])));
                                $weft_yarn_count_tolerance_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_tolerance_value'];
                                $weft_yarn_count_min_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_min_value'];
                                $weft_yarn_count_max_value= $row_old_pp_version_sanforizing_process['weft_yarn_count_max_value'];
                                $uom_of_weft_yarn_count_value= $row_old_pp_version_sanforizing_process['uom_of_weft_yarn_count_value'];

                                $test_method_for_no_of_threads_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_no_of_threads_in_warp'];
                                $no_of_threads_in_warp_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_value'];
                                $no_of_threads_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['no_of_threads_in_warp_tolerance_range_math_operator'])));
                                $no_of_threads_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_tolerance_value'];
                                $no_of_threads_in_warp_min_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_min_value'];
                                $no_of_threads_in_warp_max_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_warp_max_value'];
                                $uom_of_no_of_threads_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_no_of_threads_in_warp_value'];

                                $test_method_for_no_of_threads_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_no_of_threads_in_weft'];
                                $no_of_threads_in_weft_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_value'];
                                $no_of_threads_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['no_of_threads_in_weft_tolerance_range_math_operator'])));
                                $no_of_threads_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_tolerance_value'];
                                $no_of_threads_in_weft_min_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_min_value'];
                                $no_of_threads_in_weft_max_value= $row_old_pp_version_sanforizing_process['no_of_threads_in_weft_max_value'];
                                $uom_of_no_of_threads_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_no_of_threads_in_weft_value'];


                                $test_method_for_mass_per_unit_per_area= $row_old_pp_version_sanforizing_process['test_method_for_mass_per_unit_per_area'];
                                $mass_per_unit_per_area_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_value'];
                                $mass_per_unit_per_area_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['mass_per_unit_per_area_tolerance_range_math_operator'])));
                                $mass_per_unit_per_area_tolerance_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_tolerance_value'];
                                $mass_per_unit_per_area_min_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_min_value'];
                                $mass_per_unit_per_area_max_value= $row_old_pp_version_sanforizing_process['mass_per_unit_per_area_max_value'];
                                $uom_of_mass_per_unit_per_area_value= $row_old_pp_version_sanforizing_process['uom_of_mass_per_unit_per_area_value'];


                                $test_method_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['test_method_for_surface_fuzzing_and_pilling'];
                                $description_or_type_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                $rubs_for_surface_fuzzing_and_pilling= $row_old_pp_version_sanforizing_process['rubs_for_surface_fuzzing_and_pilling'];
                                $surface_fuzzing_and_pilling_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'])));
                                $surface_fuzzing_and_pilling_tolerance_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_tolerance_value'];
                                $surface_fuzzing_and_pilling_min_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_min_value'];
                                $surface_fuzzing_and_pilling_max_value= $row_old_pp_version_sanforizing_process['surface_fuzzing_and_pilling_max_value'];
                                $uom_of_surface_fuzzing_and_pilling_value= $row_old_pp_version_sanforizing_process['uom_of_surface_fuzzing_and_pilling_value'];


                                $test_method_for_tensile_properties_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_tensile_properties_in_warp'];
                                $tensile_properties_in_warp_value_tolerance_range_math_operator=mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_tolerance_value'];
                                $tensile_properties_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_min_value'];
                                $tensile_properties_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_warp_value_max_value'];
                                $uom_of_tensile_properties_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_tensile_properties_in_warp_value'];

                                $test_method_for_tensile_properties_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_tensile_properties_in_weft'];
                                $tensile_properties_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_tolerance_range_math_operator'])));
                                $tensile_properties_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_tolerance_value'];
                                $tensile_properties_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_min_value'];
                                $tensile_properties_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['tensile_properties_in_weft_value_max_value'];
                                $uom_of_tensile_properties_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_tensile_properties_in_weft_value'];

                                $test_method_for_tear_force_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_tear_force_in_warp'];
                                $tear_force_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['tear_force_in_warp_value_tolerance_range_math_operator'])));
                                $tear_force_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_tolerance_value'];
                                $tear_force_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_min_value'];
                                $tear_force_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['tear_force_in_warp_value_max_value'];
                                $uom_of_tear_force_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_tear_force_in_warp_value'];

                                $test_method_for_tear_force_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_tear_force_in_weft'];
                                $tear_force_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['tear_force_in_weft_value_tolerance_range_math_operator'])));
                                $tear_force_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_tolerance_value'];
                                $tear_force_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_min_value'];
                                $tear_force_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['tear_force_in_weft_value_max_value'];
                                $uom_of_tear_force_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_tear_force_in_weft_value'];


                                $test_method_for_seam_slippage_resistance_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_in_warp'];
                                $seam_slippage_resistance_in_warp_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'])));
                                $seam_slippage_resistance_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_tolerance_value'];
                                $seam_slippage_resistance_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_min_value'];
                                $seam_slippage_resistance_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_warp_max_value'];
                                $uom_of_seam_slippage_resistance_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_in_warp'];

                                $test_method_for_seam_slippage_resistance_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_in_weft'];
                                $seam_slippage_resistance_in_weft_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'])));
                                $seam_slippage_resistance_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_tolerance_value'];
                                $seam_slippage_resistance_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_min_value'];
                                $seam_slippage_resistance_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_in_weft_max_value'];
                                $uom_of_seam_slippage_resistance_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_in_weft'];



                                $test_method_for_seam_slippage_resistance_iso_2_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_iso_2_warp'];
                                $seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op'])));
                                $seam_slippage_resistance_iso_2_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'];
                                $seam_slippage_resistance_iso_2_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_min_value'];
                                $seam_slippage_resistance_iso_2_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_warp_max_value'];
                                $uom_of_seam_slippage_resistance_iso_2_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_warp'];
                                $uom_of_seam_slippage_resistance_iso_2_in_warp_for_load= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_warp_for_load'];

                                $test_method_for_seam_slippage_resistance_iso_2_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_slippage_resistance_iso_2_weft'];
                                $seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op'])));
                                $seam_slippage_resistance_iso_2_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'];
                                $seam_slippage_resistance_iso_2_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_min_value'];
                                $seam_slippage_resistance_iso_2_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_slippage_resistance_iso_2_in_weft_max_value'];
                                $uom_of_seam_slippage_resistance_iso_2_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_weft'];
                                $uom_of_seam_slippage_resistance_iso_2_in_weft_for_load= $row_old_pp_version_sanforizing_process['uom_of_seam_slippage_resistance_iso_2_in_weft_for_load'];


                                $test_method_for_seam_strength_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_strength_in_warp'];
                                $seam_strength_in_warp_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_tolerance_range_math_operator'])));
                                $seam_strength_in_warp_value_tolerance_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_tolerance_value'];
                                $seam_strength_in_warp_value_min_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_min_value'];
                                $seam_strength_in_warp_value_max_value= $row_old_pp_version_sanforizing_process['seam_strength_in_warp_value_max_value'];
                                $uom_of_seam_strength_in_warp_value= $row_old_pp_version_sanforizing_process['uom_of_seam_strength_in_warp_value'];

                                $test_method_for_seam_strength_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_strength_in_weft'];
                                $seam_strength_in_weft_value_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_tolerance_range_math_operator'])));
                                $seam_strength_in_weft_value_tolerance_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_tolerance_value'];
                                $seam_strength_in_weft_value_min_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_min_value'];
                                $seam_strength_in_weft_value_max_value= $row_old_pp_version_sanforizing_process['seam_strength_in_weft_value_max_value'];
                                $uom_of_seam_strength_in_weft_value= $row_old_pp_version_sanforizing_process['uom_of_seam_strength_in_weft_value'];

                                $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'])));
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'];
                                $uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'];


                                $test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'])));
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'];
                                $seam_properties_seam_slippage_iso_astm_d_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'];
                                $uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'];


                                $test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'])));
                                $seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_warp_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'];
                                $uom_of_seam_properties_seam_strength_iso_astm_d_in_warp= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'];

                                $test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op= mysqli_real_escape_string($con,stripslashes(trim($row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'])));
                                $seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_min_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'];
                                $seam_properties_seam_strength_iso_astm_d_in_weft_max_value= $row_old_pp_version_sanforizing_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'];
                                $uom_of_seam_properties_seam_strength_iso_astm_d_in_weft= $row_old_pp_version_sanforizing_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'];


                                
	                            $insert_sql_statement_for_sanforizing="INSERT INTO `defining_qc_standard_for_sanforizing_process`( 
                                                        `pp_number`, 
                                                        `version_id`, 
                                                        `version_number`, 
                                                        `customer_name`, 
                                                        `customer_id`, 
                                                        `color`, 
                                                        `finish_width_in_inch`,
                                                        `standard_for_which_process`, 
                                                
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
                                                        VALUES 
                                                        (
                                                        '$pp_number',
                                                        '$version_id',
                                                        '$version_name',
                                                        '$customer_name',
                                                        '$customer_id',
                                                        '$color',
                                                        '$finish_width_in_inch',
                                                        '$standard_for_which_process',
                                                
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
  
                                mysqli_query($con,$insert_sql_statement_for_sanforizing) or die(mysqli_error($con));

                                $sql_for_last_process_route = "SELECT * FROM adding_process_to_version_model 
                                WHERE version_number = '$version_name' AND customer_id = '$customer_id' AND color_name = '$color_name' AND process_technique = '$process_technique'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                    
                                $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

                                $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

                                if($row_for_last_process_route['process_id'] == 'proc_18')
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Sanforizing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                                else
                                {
                                    $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Sanforizing standard' 
                                    WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";

                                    mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
                                }
                            }
                            else
                            {
                                $message = 'Already sanforizing standard defined';
                            }
                        }       // End sanforizing process
                    }

            }
          
          }
          else
          {
              $message = 'No data found in model';
          }
          

      //auto sync option end
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
