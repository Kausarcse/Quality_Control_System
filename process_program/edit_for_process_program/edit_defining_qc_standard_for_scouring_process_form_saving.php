<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

//print_r($_POST);
//exit;

$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

/*$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
$result = mysqli_query($con,$sql) or die(mysqli_error());

if( mysqli_num_rows($result) < 1 )
{

	header('Location:logout.php');

}
else
{
	while($row=mysql_fetch_array($result))
	{	
		 $user_name=$row['user_name'];	
	}
}
*/


$pp_number= $_POST['pp_number'];
 

 $version_number= $_POST['version_number'];
 //$splitted_receiving_date= explode("?fs?",$version_number);
 //$version_number= $splitted_receiving_date[0];
//$version_id= $splitted_receiving_date[4];

 $customer_name= $_POST['customer_name'];
 $customer_id= $_POST['customer_id'];
 $color= $_POST['color'];
 $finish_width_in_inch= $_POST['finish_width_in_inch'];
 $standard_for_which_process= $_POST['standard_for_which_process'];

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
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_scouring_process` where 
`pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and 
`color`='$color' and `finish_width_in_inch`='$finish_width_in_inch' and `standard_for_which_process`='$standard_for_which_process' AND
`residual_sizing_material_min_value`= '$residual_sizing_material_min_value' AND `residual_sizing_material_max_value`='$residual_sizing_material_max_value' AND
`absorbency_min_value`='$absorbency_min_value' AND `absorbency_max_value` = '$absorbency_max_value' AND `resistance_to_surface_fuzzing_and_pilling_min_value`='$resistance_to_surface_fuzzing_and_pilling_min_value' AND
`resistance_to_surface_fuzzing_and_pilling_max_value`='$resistance_to_surface_fuzzing_and_pilling_max_value' AND `ph_min_value`='$ph_min_value' AND `ph_max_value`='$ph_max_value'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{   

	$update_sql_statement="UPDATE  `defining_qc_standard_for_scouring_process` SET
	                    
	                     `residual_sizing_material_min_value`= '$residual_sizing_material_min_value',
	                     `residual_sizing_material_max_value`='$residual_sizing_material_max_value',
	                     
	                     `absorbency_min_value`='$absorbency_min_value',
	                     `absorbency_max_value` ='$absorbency_max_value',
	                  
	                     `resistance_to_surface_fuzzing_and_pilling_min_value`='$resistance_to_surface_fuzzing_and_pilling_min_value',
	                     `resistance_to_surface_fuzzing_and_pilling_max_value`='$resistance_to_surface_fuzzing_and_pilling_max_value',
	            
                        `ph_min_value`='$ph_min_value', 
                        `ph_max_value`='$ph_max_value'

                        WHERE

                        `pp_number`='$pp_number' AND `version_number`='$version_number' AND customer_id='$customer_id' AND`customer_name`='$customer_name' AND `color`='$color' 
				         AND `finish_width_in_inch`=$finish_width_in_inch AND `standard_for_which_process`='$standard_for_which_process'";

mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
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
