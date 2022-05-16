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

// $pp_number= $_POST['pp_number_value'];
// $version_number= $_POST['version_number'];
// $splitted_receiving_date= explode("?fs?",$version_number);
// $version_number= $splitted_receiving_date[0];
// $version_id= $splitted_receiving_date[4];

// $customer_name= $_POST['customer_name'];
// $customer_id= $_POST['customer_id'];
// $color= $_POST['color'];
// $finish_width_in_inch= $_POST['finish_width_in_inch'];
// $standard_for_which_process= $_POST['standard_for_which_process'];



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


   mysqli_query($con,"BEGIN");
   mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	$select_sql_for_duplicacy="select * from `defining_qc_standard_for_ready_for_raising_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`='$finish_width_in_inch'  and `recording_person_id`='$user_id' and `recording_person_name`='$user_name'";

	$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
	{

		$data_previously_saved="Yes";

	}
	else if(mysqli_num_rows($result) < 1)
	{

	$insert_sql_statement="INSERT INTO `defining_qc_standard_for_ready_for_raising_process`( 
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
      '$version_number',
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

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

  if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}

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

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully saved.";

  $sql_for_last_process_route = "SELECT * FROM adding_process_to_version 
                                WHERE pp_number = '$pp_number' AND version_name = '$version_number' AND color = '$color' AND finish_width_in_inch = '$finish_width_in_inch'
                                ORDER BY row_id DESC 
                                LIMIT 1";
                                	
  $result_for_last_process_route = mysqli_query($con,$sql_for_last_process_route) or die(mysqli_error($con));

  $row_for_last_process_route = mysqli_fetch_assoc($result_for_last_process_route);

  if($row_for_last_process_route['process_id'] == 'proc_14')
  {
      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for greige issue',`current_status`='Defined Ready For Raising standard' 
      WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
  }
  else
  {
      $update_sql_for_pp_monitoringt="UPDATE `pp_monitoring` SET  `current_state`='Waiting for defining all standard',`current_status`='Defined Ready For Raising standard' 
      WHERE `pp_number`= '$pp_number' and `version_number`='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

      mysqli_query($con,$update_sql_for_pp_monitoringt) or die(mysqli_error($con));
  }
}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();