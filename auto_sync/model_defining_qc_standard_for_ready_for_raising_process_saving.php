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
}


$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_ready_for_raising_process` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' ";


$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $insert_sql_for_define_model="insert into `model_defining_qc_standard_for_ready_for_raising_process`
	 ( 
      `customer_id`,
      `customer_name`,
      `version_number`,
      `color`,
      `process_id`,
      `process_name`,
      `process_serial`,
      `process_technique`,

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
