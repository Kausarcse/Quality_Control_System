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



//post data collect
$customer_id= $_POST['customer_id'];
$customer_name= $_POST['customer_name'];
$version_number= $_POST['version_number'];
$color_name= $_POST['color_name'];
$process_id= $_POST['process_id'];
$process_name= $_POST['process_name'];
$process_serial= $_POST['process_serial'];
$process_technique_name= $_POST['process_technique_name'];


$test_method_for_residual_sizing_material= $_POST['test_method_for_residual_sizing_material'];
$residual_sizing_material_min_value= $_POST['residual_sizing_material_min_value'];
$residual_sizing_material_max_value= $_POST['residual_sizing_material_max_value'];
$uom_of_residual_sizing_material= $_POST['uom_of_residual_sizing_material'];


$test_method_for_absorbency= $_POST['test_method_for_absorbency'];
$absorbency_min_value= $_POST['absorbency_min_value'];
$absorbency_max_value= $_POST['absorbency_max_value'];
$uom_of_absorbency= $_POST['uom_of_absorbency'];

$test_method_for_resistance_to_surface_fuzzing_and_pilling= $_POST['test_method_for_resistance_to_surface_fuzzing_and_pilling'];
$resistance_to_surface_fuzzing_and_pilling_min_value= $_POST['resistance_to_surface_fuzzing_and_pilling_min_value'];
$resistance_to_surface_fuzzing_and_pilling_max_value= $_POST['resistance_to_surface_fuzzing_and_pilling_max_value'];
$uom_of_resistance_to_surface_fuzzing_and_pilling= $_POST['uom_of_resistance_to_surface_fuzzing_and_pilling'];

 
 $test_method_for_ph= $_POST['test_method_for_ph'];
 $ph_min_value= $_POST['ph_min_value'];
 $ph_max_value= $_POST['ph_max_value'];
 $uom_of_ph= $_POST['uom_of_ph'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_scouring_process` where 
  							`customer_id`='$customer_id' and 
							`customer_name`='$customer_name' and 
							`version_number`='$version_number' and 
							`color`='$color_name' and 
							`process_id`= '$process_id' and 
							`process_name`= '$process_name' and 
							`process_serial`= '$process_serial' and
							`process_technique`= '$process_technique_name' and

                            `residual_sizing_material_min_value`= '$residual_sizing_material_min_value' AND 
							`residual_sizing_material_max_value`='$residual_sizing_material_max_value' AND
							`absorbency_min_value`='$absorbency_min_value' AND 
							`absorbency_max_value` = '$absorbency_max_value' AND 
							`resistance_to_surface_fuzzing_and_pilling_min_value`='$resistance_to_surface_fuzzing_and_pilling_min_value' AND
							`resistance_to_surface_fuzzing_and_pilling_max_value`='$resistance_to_surface_fuzzing_and_pilling_max_value' AND 
							`ph_min_value`='$ph_min_value' AND 
							`ph_max_value`='$ph_max_value'";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $update_sql_statement_for_model="UPDATE model_defining_qc_standard_for_scouring_process SET

                                        `residual_sizing_material_min_value`= '$residual_sizing_material_min_value',
                                        `residual_sizing_material_max_value`='$residual_sizing_material_max_value',
                                        
                                        `absorbency_min_value`='$absorbency_min_value',
                                        `absorbency_max_value` ='$absorbency_max_value',
                                    
                                        `resistance_to_surface_fuzzing_and_pilling_min_value`='$resistance_to_surface_fuzzing_and_pilling_min_value',
                                        `resistance_to_surface_fuzzing_and_pilling_max_value`='$resistance_to_surface_fuzzing_and_pilling_max_value',
                                
                                        `ph_min_value`='$ph_min_value', 
                                        `ph_max_value`='$ph_max_value'
                                    WHERE
                                        `customer_id`='$customer_id' and 
                                        `customer_name`='$customer_name' and 
                                        `version_number`='$version_number' and 
                                        `color`='$color_name' and 
                                        `process_id`= '$process_id' and 
                                        `process_name`= '$process_name' and 
                                        `process_serial`= '$process_serial' and
                                        `process_technique`= '$process_technique_name' ";
                                    
   
	mysqli_query($con,$update_sql_statement_for_model) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";

	}

}
		


if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Scouring Model is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Scouring Model is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Scouring Model is not successfully updated.";

}

$obj->disconnection();

?>
