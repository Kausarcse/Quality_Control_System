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
$user_name = $_SESSION['user_name'];
$password = $_SESSION['password'];

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

$customer_name= $_POST['customer_name'];

$customer_id= $_POST['customer_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$standard_for_which_process= $_POST['standard_for_which_process'];

$test_method_for_cf_to_rubbing_dry= $_POST['test_method_for_cf_to_rubbing_dry'];
$uom_of_cf_to_rubbing_dry= $_POST['uom_of_cf_to_rubbing_dry'];
$rubbing_dry_tolerance_range_math_operator= $_POST['cf_to_rubbing_dry_tolerance_range_math_operator'];
$rubbing_dry_tolerance_value= $_POST['cf_to_rubbing_dry_tolerance_value'];
$rubbing_dry_min_value= $_POST['cf_to_rubbing_dry_min_value'];
$rubbing_dry_max_value= $_POST['cf_to_rubbing_dry_max_value'];

$test_method_for_cf_to_rubbing_wet= $_POST['test_method_for_cf_to_rubbing_wet'];
$uom_of_cf_to_rubbing_wet= $_POST['uom_of_cf_to_rubbing_wet'];
$rubbing_wet_tolerance_range_math_operator= $_POST['cf_to_rubbing_wet_tolerance_range_math_operator'];
$rubbing_wet_tolerance_value= $_POST['cf_to_rubbing_wet_tolerance_value'];
$rubbing_wet_min_value= $_POST['cf_to_rubbing_wet_min_value'];
$rubbing_wet_max_value= $_POST['cf_to_rubbing_wet_max_value'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_printing_process` where 
`pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and 
`color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' AND

`rubbing_dry_tolerance_range_math_operator`='$rubbing_dry_tolerance_range_math_operator' AND
`rubbing_dry_tolerance_value`='$rubbing_dry_tolerance_value' AND
`rubbing_dry_min_value`='$rubbing_dry_min_value' AND
`rubbing_dry_max_value`='$rubbing_dry_max_value' AND

`rubbing_wet_tolerance_range_math_operator`='$rubbing_wet_tolerance_range_math_operator' AND
`rubbing_wet_tolerance_value`='$rubbing_wet_tolerance_value' AND
`rubbing_wet_min_value`='$rubbing_wet_min_value' AND
`rubbing_wet_max_value`='$rubbing_wet_max_value'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$update_sql_statement="UPDATE `defining_qc_standard_for_printing_process` SET
    
    `rubbing_dry_tolerance_range_math_operator`='$rubbing_dry_tolerance_range_math_operator',
    `rubbing_dry_tolerance_value`='$rubbing_dry_tolerance_value',
    `rubbing_dry_min_value`='$rubbing_dry_min_value',
    `rubbing_dry_max_value`='$rubbing_dry_max_value',
    
    `rubbing_wet_tolerance_range_math_operator`='$rubbing_wet_tolerance_range_math_operator',
    `rubbing_wet_tolerance_value`='$rubbing_wet_tolerance_value',
    `rubbing_wet_min_value`='$rubbing_wet_min_value',
    `rubbing_wet_max_value`='$rubbing_wet_max_value'

    WHERE
    `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and 
    `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process'";
    
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
