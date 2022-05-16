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

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_ready_for_raising_process` where 
  							`customer_id`='$customer_id' and 
							`customer_name`='$customer_name' and 
							`version_number`='$version_number' and 
							`color`='$color_name' and 
							`process_id`= '$process_id' and 
							`process_name`= '$process_name' and 
							`process_serial`= '$process_serial' and
							`process_technique`= '$process_technique_name' and

                            `tensile_properties_in_warp_value_tolerance_range_math_operator`='$tensile_properties_in_warp_value_tolerance_range_math_operator'AND
                            `tensile_properties_in_warp_value_tolerance_value`='$tensile_properties_in_warp_value_tolerance_value'AND
                            `tensile_properties_in_warp_value_min_value`= '$tensile_properties_in_warp_value_min_value'AND
                            `tensile_properties_in_warp_value_max_value`=  '$tensile_properties_in_warp_value_max_value'AND
                            `uom_of_tensile_properties_in_warp_value`='$uom_of_tensile_properties_in_warp_value'AND

                            `tensile_properties_in_weft_value_tolerance_range_math_operator`='$tensile_properties_in_weft_value_tolerance_range_math_operator'AND
                            `tensile_properties_in_weft_value_tolerance_value`= '$tensile_properties_in_weft_value_tolerance_value'AND
                            `tensile_properties_in_weft_value_min_value`= '$tensile_properties_in_weft_value_min_value'AND
                            `tensile_properties_in_weft_value_max_value`='$tensile_properties_in_weft_value_max_value'AND
                            `uom_of_tensile_properties_in_weft_value`='$uom_of_tensile_properties_in_weft_value'AND

                            `tear_force_in_warp_value_tolerance_range_math_operator`='$tear_force_in_warp_value_tolerance_range_math_operator'AND
                            `tear_force_in_warp_value_tolerance_value`='$tear_force_in_warp_value_tolerance_value'AND
                            `tear_force_in_warp_value_min_value`='$tear_force_in_warp_value_min_value'AND
                            `tear_force_in_warp_value_max_value`='$tear_force_in_warp_value_max_value'AND
                            `uom_of_tear_force_in_warp_value`='$uom_of_tear_force_in_warp_value'AND

                            `tear_force_in_weft_value_tolerance_range_math_operator`='$tear_force_in_weft_value_tolerance_range_math_operator'AND
                            `tear_force_in_weft_value_tolerance_value`='$tear_force_in_weft_value_tolerance_value'AND
                            `tear_force_in_weft_value_min_value`='$tear_force_in_weft_value_min_value'AND
                            `tear_force_in_weft_value_max_value`= '$tear_force_in_weft_value_max_value'AND
                            `uom_of_tear_force_in_weft_value`= '$uom_of_tear_force_in_weft_value'";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $update_sql_statement_for_model="UPDATE model_defining_qc_standard_for_ready_for_raising_process SET
                                        `tensile_properties_in_warp_value_tolerance_range_math_operator`='$tensile_properties_in_warp_value_tolerance_range_math_operator', 
                                        `tensile_properties_in_warp_value_tolerance_value`='$tensile_properties_in_warp_value_tolerance_value',
                                        `tensile_properties_in_warp_value_min_value`= '$tensile_properties_in_warp_value_min_value',
                                        `tensile_properties_in_warp_value_max_value`=  '$tensile_properties_in_warp_value_max_value',
                                        `uom_of_tensile_properties_in_warp_value`='$uom_of_tensile_properties_in_warp_value',

                                        `tensile_properties_in_weft_value_tolerance_range_math_operator`='$tensile_properties_in_weft_value_tolerance_range_math_operator',
                                        `tensile_properties_in_weft_value_tolerance_value`= '$tensile_properties_in_weft_value_tolerance_value',
                                        `tensile_properties_in_weft_value_min_value`= '$tensile_properties_in_weft_value_min_value',
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
                                        `tear_force_in_weft_value_max_value`= '$tear_force_in_weft_value_max_value',
                                        `uom_of_tear_force_in_weft_value`= '$uom_of_tear_force_in_weft_value'

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
	echo "Ready For Raising Model is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Ready For Raising Model is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Ready For Raising Model is not successfully updated.";

}

$obj->disconnection();

?>
