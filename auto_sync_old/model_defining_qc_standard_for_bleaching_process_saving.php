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


$standard_for_which_process= 'Scouring';


$test_id_for_whiteness= $_POST['test_id_for_whiteness'];
$test_method_for_whiteness= $_POST['test_method_for_whiteness'];
$whiteness_min_value= $_POST['whiteness_min_value'];
$whiteness_max_value= $_POST['whiteness_max_value'];
$uom_of_whiteness= $_POST['uom_of_whiteness'];



$test_id_for_residual_sizing_material= $_POST['test_id_for_residual_sizing_material'];
$test_method_for_residual_sizing_material= $_POST['test_method_for_residual_sizing_material'];
$residual_sizing_material_min_value= $_POST['residual_sizing_material_min_value'];
$residual_sizing_material_max_value= $_POST['residual_sizing_material_max_value'];
$uom_of_residual_sizing_material= $_POST['uom_of_residual_sizing_material'];


$test_id_for_absorbency= $_POST['test_id_for_absorbency'];
$test_method_for_absorbency= $_POST['test_method_for_absorbency'];
$absorbency_min_value= $_POST['absorbency_min_value'];
$absorbency_max_value= $_POST['absorbency_max_value'];
$uom_of_absorbency= $_POST['uom_of_absorbency'];

$description_or_type_for_surface_fuzzing_and_pilling= $_POST['description_or_type_for_surface_fuzzing_and_pilling'];
$test_method_for_resistance_to_surface_fuzzing_and_pilling= $_POST['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_tolerance_range_math_operator= $_POST['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
$surface_fuzzing_and_pilling_tolerance_value= $_POST['surface_fuzzing_and_pilling_tolerance_value'];
$rubs_for_surface_fuzzing_and_pilling= $_POST['rubs_for_surface_fuzzing_and_pilling'];
$surface_fuzzing_and_pilling_min_value= $_POST['surface_fuzzing_and_pilling_min_value'];
$surface_fuzzing_and_pilling_max_value= $_POST['surface_fuzzing_and_pilling_max_value'];
$uom_of_resistance_to_surface_fuzzing_and_pilling= $_POST['uom_of_resistance_to_surface_fuzzing_and_pilling'];


$test_id_for_ph= $_POST['test_id_for_ph'];
$test_method_for_ph= $_POST['test_method_for_ph'];
$ph_min_value= $_POST['ph_min_value'];
$ph_max_value= $_POST['ph_max_value'];
$uom_of_ph= $_POST['uom_of_ph'];



mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_bleaching_process` where `customer_id`='$customer_id' and `customer_name`='$customer_name' and `version_number`='$version_number' and `color`='$color_name' and `process_name`='$process_name' and `process_technique`='$process_technique_name' ";


$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $insert_sql_for_define_model="insert into `model_defining_qc_standard_for_bleaching_process`
	 ( 
	    `customer_id`,
        `customer_name`,
	    `version_number`,
	    `color`,
        `process_id`,
	    `process_name`,
        `process_serial`,
        `process_technique`,

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

    
      
	mysqli_query($con,$insert_sql_for_define_model) or die(mysqli_error($con));

  
	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering_for_define_model = "Yes";
	
	}
  else
  {
    
      $insert_sql_add_process_model ="insert into `adding_process_to_version_model`
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
       
      mysqli_query($con, $insert_sql_add_process_model) or die(mysqli_error($con));


      if(mysqli_affected_rows($con)<>1)
      {
      
        $data_insertion_hampering_for_add_process_model = "Yes";
      
      }
  }
}



if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.  ";

}
else if($data_insertion_hampering_for_define_model == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Model standard is successfully saved.  ";

}
else 
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.  ";

}

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
