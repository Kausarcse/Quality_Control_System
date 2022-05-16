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


$test_method_for_whiteness= $_POST['test_method_for_whiteness'];
$whiteness_min_value= $_POST['whiteness_min_value'];
$whiteness_max_value= $_POST['whiteness_max_value'];
$uom_of_whiteness= $_POST['uom_of_whiteness'];


$test_method_for_bowing_and_skew= $_POST['test_method_for_bowing_and_skew'];
$bowing_and_skew_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['bowing_and_skew_tolerance_range_math_operator'])));
$bowing_and_skew_tolerance_value= $_POST['bowing_and_skew_tolerance_value'];
$bowing_and_skew_min_value= $_POST['bowing_and_skew_min_value'];
$bowing_and_skew_max_value= $_POST['bowing_and_skew_max_value'];
$uom_of_bowing_and_skew= $_POST['uom_of_bowing_and_skew'];



$test_method_for_ph= $_POST['test_method_for_ph'];
$ph_min_value= $_POST['ph_min_value'];
$ph_max_value= $_POST['ph_max_value'];
$uom_of_ph= $_POST['uom_of_ph'];




mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_ready_for_dying_process` where 
  							`customer_id`='$customer_id' and 
							`customer_name`='$customer_name' and 
							`version_number`='$version_number' and 
							`color`='$color_name' and 
							`process_id`= '$process_id' and 
							`process_name`= '$process_name' and 
							`process_serial`= '$process_serial' and
							`process_technique`= '$process_technique_name' and

                            `whiteness_min_value`='$whiteness_min_value' AND 
                            `whiteness_max_value`='$whiteness_max_value' AND
                            
                            `bowing_and_skew_tolerance_range_math_operator`='$bowing_and_skew_tolerance_range_math_operator' AND
                            `bowing_and_skew_tolerance_value`='$bowing_and_skew_tolerance_value' AND
                            `bowing_and_skew_min_value`='$bowing_and_skew_min_value' AND
                            `bowing_and_skew_max_value`='$bowing_and_skew_max_value' AND

                            `ph_min_value`='$ph_min_value' AND
                            `ph_max_value`='$ph_max_value' ";



$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $update_sql_statement_for_model="UPDATE model_defining_qc_standard_for_ready_for_dying_process SET
                                        `whiteness_min_value`='$whiteness_min_value', 
                                        `whiteness_max_value`='$whiteness_max_value', 

                                        `bowing_and_skew_tolerance_range_math_operator`='$bowing_and_skew_tolerance_range_math_operator', 
                                        `bowing_and_skew_tolerance_value`='$bowing_and_skew_tolerance_value', 
                                        `bowing_and_skew_min_value`='$bowing_and_skew_min_value', 
                                        `bowing_and_skew_max_value`='$bowing_and_skew_max_value', 

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
	echo "Ready For Dyeing Model is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Ready For Dyeing Model is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Ready For Dyeing Model is not successfully updated.";

}

$obj->disconnection();

?>
