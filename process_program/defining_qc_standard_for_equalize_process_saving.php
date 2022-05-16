<?php
session_start();
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


$pp_number= $_POST['pp_number_value'];

echo $version_number_details= $_POST['version_number'];

$splitted_version= explode("?fs?",$version_number_details);

$version_number= $splitted_version[0];
$color= $splitted_version[1];
$finish_width_in_inch= $splitted_version[2];
$customer_name= $splitted_version[3];
$version_id= $splitted_version[4];
$customer_id= $splitted_version[5];
$style_name= $splitted_version[6];

$standard_for_which_process= $_POST['standard_for_which_process'];
exit();

// $pp_number= $_POST['pp_number'];
// $version_number= $_POST['version_number'];
// $splitted_receiving_date= explode("?fs?",$version_number);
// $version_number= $splitted_receiving_date[0];
// $version_id= $splitted_receiving_date[4];

// $customer_name= $_POST['customer_name'];
// $color= $_POST['color'];
// $finish_width_in_inch= $_POST['finish_width_in_inch'];
// $standard_for_which_process= $_POST['standard_for_which_process'];

$whiteness_value= $_POST['whiteness_value'];
$uom_of_whiteness= $_POST['uom_of_whiteness'];
$whiteness_tolerance_range_math_operator= $_POST['whiteness_tolerance_range_math_operator'];
$whiteness_tolerance_value_in_percentage= $_POST['whiteness_tolerance_value_in_percentage'];
$whiteness_min_value= $_POST['whiteness_min_value'];
$whiteness_max_value= $_POST['whiteness_max_value'];
$bowing_and_skew_value= $_POST['bowing_and_skew_value'];
$uom_of_bowing_and_skew= $_POST['uom_of_bowing_and_skew'];
$bowing_and_skew_tolerance_range_math_operator= $_POST['bowing_and_skew_tolerance_range_math_operator'];
$bowing_and_skew_tolerance_value_in_percentage= $_POST['bowing_and_skew_tolerance_value_in_percentage'];
$bowing_and_skew_min_value= $_POST['bowing_and_skew_min_value'];
$bowing_and_skew_max_value= $_POST['bowing_and_skew_max_value'];
$ph_value= $_POST['ph_value'];
$uom_of_ph= $_POST['uom_of_ph'];
$ph_tolerance_range_math_operator= $_POST['ph_tolerance_range_math_operator'];
$ph_tolerance_value_in_percentage= $_POST['ph_tolerance_value_in_percentage'];
$ph_min_value= $_POST['ph_min_value'];
$ph_max_value= $_POST['ph_max_value'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_equalize_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and `standard_for_which_process`='$standard_for_which_process' and `whiteness_value`=$whiteness_value and `uom_of_whiteness`='$uom_of_whiteness' and `whiteness_tolerance_range_math_operator`='$whiteness_tolerance_range_math_operator' and `whiteness_tolerance_value_in_percentage`=$whiteness_tolerance_value_in_percentage and `whiteness_min_value`=$whiteness_min_value and `whiteness_max_value`=$whiteness_max_value and `bowing_and_skew_value`=$bowing_and_skew_value and `uom_of_bowing_and_skew`='$uom_of_bowing_and_skew' and `bowing_and_skew_tolerance_range_math_operator`='$bowing_and_skew_tolerance_range_math_operator' and `bowing_and_skew_tolerance_value_in_percentage`=$bowing_and_skew_tolerance_value_in_percentage and `bowing_and_skew_min_value`=$bowing_and_skew_min_value and `bowing_and_skew_max_value`=$bowing_and_skew_max_value and `ph_value`=$ph_value and `uom_of_ph`='$uom_of_ph' and `ph_tolerance_range_math_operator`='$ph_tolerance_range_math_operator' and `ph_tolerance_value_in_percentage`=$ph_tolerance_value_in_percentage and `ph_min_value`=$ph_min_value and `ph_max_value`=$ph_max_value";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$insert_sql_statement="insert into `defining_qc_standard_for_equalize_process` ( `pp_number`,`version_id`,`version_number`,`customer_name`,`color`,`finish_width_in_inch`,`standard_for_which_process`,`whiteness_value`,`uom_of_whiteness`,`whiteness_tolerance_range_math_operator`,`whiteness_tolerance_value_in_percentage`,`whiteness_min_value`,`whiteness_max_value`,`bowing_and_skew_value`,`uom_of_bowing_and_skew`,`bowing_and_skew_tolerance_range_math_operator`,`bowing_and_skew_tolerance_value_in_percentage`,`bowing_and_skew_min_value`,`bowing_and_skew_max_value`,`ph_value`,`uom_of_ph`,`ph_tolerance_range_math_operator`,`ph_tolerance_value_in_percentage`,`ph_min_value`,`ph_max_value`,`recording_person_id`,`recording_person_name`,`recording_time` ) 
	values
    ('$pp_number','$version_id','$version_number','$customer_name','$color',$finish_width_in_inch,'$standard_for_which_process',$whiteness_value,'$uom_of_whiteness','$whiteness_tolerance_range_math_operator',$whiteness_tolerance_value_in_percentage,$whiteness_min_value,$whiteness_max_value,$bowing_and_skew_value,'$uom_of_bowing_and_skew','$bowing_and_skew_tolerance_range_math_operator',$bowing_and_skew_tolerance_value_in_percentage,$bowing_and_skew_min_value,$bowing_and_skew_max_value,$ph_value,'$uom_of_ph','$ph_tolerance_range_math_operator',$ph_tolerance_value_in_percentage,$ph_min_value,$ph_max_value,'$user_id','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

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
