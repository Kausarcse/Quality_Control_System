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

// $pp_number= $_POST['pp_number'];
// $version_number= $_POST['version_number'];


// $customer_name= $_POST['customer_name'];
// $customer_id= $_POST['customer_id'];
// $color= $_POST['color'];
// $finish_width_in_inch= $_POST['finish_width_in_inch'];

// $standard_for_which_process= $_POST['standard_for_which_process'];

$test_method_for_flame_intensity= $_POST['test_method_for_flame_intensity'];
$uom_of_flame_intensity= $_POST['uom_of_flame_intensity'];
$flame_intensity_min_value= $_POST['flame_intensity_min_value'];
$flame_intensity_max_value= $_POST['flame_intensity_max_value'];

$test_method_for_machine_speed= $_POST['test_method_for_machine_speed'];
$uom_of_machine_speed= $_POST['uom_of_machine_speed'];
$machine_speed_min_value= $_POST['machine_speed_min_value'];
$machine_speed_max_value= $_POST['machine_speed_max_value'];

$test_method_for_bath_temperature= $_POST['test_method_for_bath_temperature'];
$uom_of_bath_temperature= $_POST['uom_of_bath_temperature'];
$bath_temperature_min_value= $_POST['bath_temperature_min_value'];
$bath_temperature_max_value= $_POST['bath_temperature_max_value'];

$test_method_for_bath_ph= $_POST['test_method_for_bath_ph'];
$uom_of_bath_ph= $_POST['uom_of_bath_ph'];
$bath_ph_min_value= $_POST['bath_ph_min_value'];
$bath_ph_max_value= $_POST['bath_ph_max_value'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `model_defining_qc_standard_for_singe_and_desize_process` where 
  							`customer_id`='$customer_id' and 
							`customer_name`='$customer_name' and 
							`version_number`='$version_number' and 
							`color`='$color_name' and 
							`process_id`= '$process_id' and 
							`process_name`= '$process_name' and 
							`process_serial`= '$process_serial' and
							`process_technique`= '$process_technique_name' and
							
							`flame_intensity_min_value` = '$flame_intensity_min_value' and
	 						`flame_intensity_max_value` = '$flame_intensity_max_value' and

							`machine_speed_min_value` = '$machine_speed_min_value' and
							`machine_speed_max_value` = '$machine_speed_max_value' and

							`bath_temperature_min_value` = '$bath_temperature_min_value' and
							`bath_temperature_max_value` = '$bath_temperature_max_value' and

							`bath_ph_min_value` = '$bath_ph_min_value' and
							`bath_ph_max_value` = '$bath_ph_max_value'";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	 $update_sql_statement_for_model="UPDATE model_defining_qc_standard_for_singe_and_desize_process SET

		`flame_intensity_min_value` = '$flame_intensity_min_value',
		`flame_intensity_max_value` = '$flame_intensity_max_value',

		`machine_speed_min_value` = '$machine_speed_min_value',
		`machine_speed_max_value` = '$machine_speed_max_value',

		`bath_temperature_min_value` = '$bath_temperature_min_value',
		`bath_temperature_max_value` = '$bath_temperature_max_value',

		`bath_ph_min_value` = '$bath_ph_min_value',
   		`bath_ph_max_value` = '$bath_ph_max_value'

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

	// $update_sql_statement_for_standard="UPDATE defining_qc_standard_for_singe_and_desize_process SET

	//  `flame_intensity_min_value` = '$flame_intensity_min_value',
	//  `flame_intensity_max_value` = '$flame_intensity_max_value',

	//  `machine_speed_min_value` = '$machine_speed_min_value',
	//  `machine_speed_max_value` = '$machine_speed_max_value',

	//  `bath_temperature_min_value` = '$bath_temperature_min_value',
	//  `bath_temperature_max_value` = '$bath_temperature_max_value',

	//  `bath_ph_min_value` = '$bath_ph_min_value',
	// `bath_ph_max_value` = '$bath_ph_max_value'
	// 	WHERE
	// 	`customer_name`='$customer_id' 
	// 	and `version_number`='$version_id' 
	// 	and `color`= '$color_id'
	// 	and `standard_for_which_process`='$standard_for_which_process'";
    
   
	// mysqli_query($con,$update_sql_statement_for_standard) or die(mysqli_error($con));


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

?>
