<?php
session_start();
require_once("../login/session.php");
include('db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
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
$color= $_POST['color'];
$greige_width= $_POST['greige_width'];
$standard_for_which_process= $_POST['standard_for_which_process'];

$absorbency_value= $_POST['absorbency_value'];
$absorbency_tolerance_range_math_operator= $_POST['absorbency_tolerance_range_math_operator'];
$absorbency_tolerance_value= $_POST['absorbency_tolerance_value'];
$absorbency_min_value= $_POST['absorbency_min_value'];
$absorbency_max_value= $_POST['absorbency_max_value'];
$uom_of_absorbency= $_POST['uom_of_absorbency'];

$residual_sizing_material_value= $_POST['residual_sizing_material_value'];
$residual_sizing_material_tolerance_range_math_operator= $_POST['residual_sizing_material_tolerance_range_math_operator'];
$residual_sizing_material_tolerance_value= $_POST['residual_sizing_material_tolerance_value'];
$residual_sizing_material_min_value= $_POST['residual_sizing_material_min_value'];
$residual_sizing_material_max_value= $_POST['residual_sizing_material_max_value'];
$uom_of_residual_sizing_material= $_POST['uom_of_residual_sizing_material'];

$whiteness_value= $_POST['whiteness_value'];
$whiteness_tolerance_range_math_operator= $_POST['whiteness_tolerance_range_math_operator'];
$whiteness_tolerance_value= $_POST['whiteness_tolerance_value'];
$whiteness_min_value= $_POST['whiteness_min_value'];
$whiteness_max_value= $_POST['whiteness_max_value'];
$uom_of_whiteness= $_POST['uom_of_whiteness'];

$pilling_iso_12945_2_value= $_POST['pilling_iso_12945_2_value'];
$pilling_iso_12945_2_tolerance_range_math_operator= $_POST['pilling_iso_12945_2_tolerance_range_math_operator'];
$pilling_iso_12945_2_tolerance_value= $_POST['pilling_iso_12945_2_tolerance_value'];
$pilling_iso_12945_2_min_value= $_POST['pilling_iso_12945_2_min_value'];
$pilling_iso_12945_2_max_value= $_POST['pilling_iso_12945_2_max_value'];
$uom_of_pilling_iso_12945_2= $_POST['uom_of_pilling_iso_12945_2'];

$ph_value= $_POST['ph_value'];
$ph_tolerance_range_math_operator= $_POST['ph_tolerance_range_math_operator'];
$ph_tolerance_value= $_POST['ph_tolerance_value'];
$ph_min_value= $_POST['ph_min_value'];
$ph_max_value= $_POST['ph_max_value'];
$uom_of_ph= $_POST['uom_of_ph'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_scouring_bleaching_process` where `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `greige_width`=$greige_width and `standard_for_which_process`='$standard_for_which_process' and `absorbency_value`=$absorbency_value and `absorbency_tolerance_range_math_operator`='$absorbency_tolerance_range_math_operator' and `absorbency_tolerance_value`=$absorbency_tolerance_value and `absorbency_min_value`=$absorbency_min_value and `absorbency_max_value`=$absorbency_max_value and `uom_of_absorbency`='$uom_of_absorbency' and `residual_sizing_material_value`=$residual_sizing_material_value and `residual_sizing_material_tolerance_range_math_operator`='$residual_sizing_material_tolerance_range_math_operator' and `residual_sizing_material_tolerance_value`=$residual_sizing_material_tolerance_value and `residual_sizing_material_min_value`=$residual_sizing_material_min_value and `residual_sizing_material_max_value`=$residual_sizing_material_max_value and `uom_of_residual_sizing_material`='$uom_of_residual_sizing_material' and `whiteness_value`=$whiteness_value and `whiteness_tolerance_range_math_operator`='$whiteness_tolerance_range_math_operator' and `whiteness_tolerance_value`=$whiteness_tolerance_value and `whiteness_min_value`=$whiteness_min_value and `whiteness_max_value`='$whiteness_max_value' and `uom_of_whiteness`='$uom_of_whiteness' and `pilling_iso_12945_2_value`=$pilling_iso_12945_2_value and `pilling_iso_12945_2_tolerance_range_math_operator`='$pilling_iso_12945_2_tolerance_range_math_operator' and `pilling_iso_12945_2_tolerance_value`=$pilling_iso_12945_2_tolerance_value and `pilling_iso_12945_2_min_value`=$pilling_iso_12945_2_min_value and `pilling_iso_12945_2_max_value`=$pilling_iso_12945_2_max_value and `uom_of_pilling_iso_12945_2`='$uom_of_pilling_iso_12945_2' and `ph_value`=$ph_value and `ph_tolerance_range_math_operator`='$ph_tolerance_range_math_operator' and `ph_tolerance_value`=$ph_tolerance_value and `ph_min_value`=$ph_min_value and `ph_max_value`=$ph_max_value and `uom_of_ph`='$uom_of_ph'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$insert_sql_statement="insert into `defining_qc_standard_for_scouring_bleaching_process` ( `pp_number`,`version_number`,`customer_name`,`color`,`greige_width`,`standard_for_which_process`,`absorbency_value`,`absorbency_tolerance_range_math_operator`,`absorbency_tolerance_value`,`absorbency_min_value`,`absorbency_max_value`,`uom_of_absorbency`,`residual_sizing_material_value`,`residual_sizing_material_tolerance_range_math_operator`,`residual_sizing_material_tolerance_value`,`residual_sizing_material_min_value`,`residual_sizing_material_max_value`,`uom_of_residual_sizing_material`,`whiteness_value`,`whiteness_tolerance_range_math_operator`,`whiteness_tolerance_value`,`whiteness_min_value`,`whiteness_max_value`,`uom_of_whiteness`,`pilling_iso_12945_2_value`,`pilling_iso_12945_2_tolerance_range_math_operator`,`pilling_iso_12945_2_tolerance_value`,`pilling_iso_12945_2_min_value`,`pilling_iso_12945_2_max_value`,`uom_of_pilling_iso_12945_2`,`ph_value`,`ph_tolerance_range_math_operator`,`ph_tolerance_value`,`ph_min_value`,`ph_max_value`,`uom_of_ph`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$pp_number','$version_number','$customer_name','$color',$greige_width,'$standard_for_which_process',$absorbency_value,'$absorbency_tolerance_range_math_operator',$absorbency_tolerance_value,$absorbency_min_value,$absorbency_max_value,'$uom_of_absorbency',$residual_sizing_material_value,'$residual_sizing_material_tolerance_range_math_operator',$residual_sizing_material_tolerance_value,$residual_sizing_material_min_value,$residual_sizing_material_max_value,'$uom_of_residual_sizing_material',$whiteness_value,'$whiteness_tolerance_range_math_operator',$whiteness_tolerance_value,$whiteness_min_value,'$whiteness_max_value','$uom_of_whiteness',$pilling_iso_12945_2_value,'$pilling_iso_12945_2_tolerance_range_math_operator',$pilling_iso_12945_2_tolerance_value,$pilling_iso_12945_2_min_value,$pilling_iso_12945_2_max_value,'$uom_of_pilling_iso_12945_2',$ph_value,'$ph_tolerance_range_math_operator',$ph_tolerance_value,$ph_min_value,$ph_max_value,'$uom_of_ph','$user_id','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error());

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
