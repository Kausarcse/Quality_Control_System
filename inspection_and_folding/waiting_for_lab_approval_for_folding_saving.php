<?php
error_reporting(0);
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

$date = date("Y-m-d");

$user_name=$_SESSION['user_name'];

$all_data = $_POST['all_data']; 

$remark_for_lab_approval = $_POST['remark_for_lab_approval']; 
// echo $remark_for_lab_approval;

$test_result = $_POST['test_result'];
// echo $test_result;

$inspection_status = $_POST['inspection_status'];

$splitted_data=explode("?fs?", $all_data);


$partial_test_for_test_result_creation_date =$splitted_data[0];
$shift = $splitted_data[1];
$trf_id = $splitted_data[2];
$pp_number = $splitted_data[3];
$week = $splitted_data[4];
$customer_name = $splitted_data[5];
$design = $splitted_data[6];
$version_number = $splitted_data[7];
$style_name = $splitted_data[8];
$color = $splitted_data[9];
$construction_name = $splitted_data[10];
$process_name = $splitted_data[11];
$before_trolly_number = $splitted_data[12];
$after_trolly_number = $splitted_data[13];
$finish_width_in_inch = $splitted_data[14];
$quantity = $splitted_data[15];

$split_process_name = explode("-",$process_name);
 $previous_process_name = $split_process_name[1];


//exit();
mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

 $select_sql_for_duplicacy="SELECT * from inspection_and_folding_table_for_lab_approval where 
							`trf_no`='$trf_id' and `pp_number`='$pp_number' and `customer_name`='$customer_name' and
							`version_number`='$version_number' and `style_name`='$style_name' and process_name = '$process_name' and 
							`color`='$color' and `before_trolley_number` = '$before_trolly_number' and `trolly_number` = '$after_trolly_number' AND finish_width = '$finish_width_in_inch'";
$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
	 $sql_for_check_lab_approval = "SELECT * FROM inspection_and_folding_table_for_lab_approval 
									where pp_number = '$pp_number' and version_number = '$version_number' and finish_width = '$finish_width_in_inch' and 
									style_name = '$style_name' and trolly_number = '$before_trolly_number' AND inspection_status = 'inspection for rework'";

	$result_for_check_lab_approval = mysqli_query($con,$sql_for_check_lab_approval) or die(mysqli_error($con));
	$row_for_check_lab_approval = mysqli_num_rows($result_for_check_lab_approval);
	
	if($row_for_check_lab_approval >0)
	{
		$update_sql_for_rework="UPDATE `inspection_and_folding_table_for_lab_approval` 
								SET trf_no = '$trf_id', pp_number = '$pp_number', shift='$shift', week_in_year = '$week', 
								customer_name = '$customer_name', design_name = '$design', version_number = '$version_number', style_name = '$style_name', 
								color='$color', construction_name = '$construction_name', process_name='$process_name', trolly_number='$trolly_number', 
								before_trolley_number='$before_trolly_number', finish_width='$finish_width_in_inch', quantity='$quantity', test_status='$test_result', 
								remarks='$remark_for_lab_approval', inspection_status='$inspection_status', recording_person_id= '$user_id', 
								recording_person_name='$user_name', recording_time= NOW()
								where pp_number = '$pp_number' and version_number = '$version_number' and finish_width = '$finish_width_in_inch' and 
								style_name = '$style_name' and trolly_number = '$before_trolly_number' AND inspection_status = 'inspection for rework'";

		mysqli_query($con,$update_sql_for_rework) or die(mysqli_error($con));

	
		// $delete_sql_for_rework = "DELETE FROM inspection_and_folding_table_for_lab_approval where `pp_number`='$pp_number' and 
		// `customer_name`='$customer_name' and `version_number`='$version_number' and `style_name`='$style_name' and 
		// `color`='$color' AND finish_width = '$finish_width_in_inch'";
		
		// mysqli_query($con,$delete_sql_for_rework) or die(mysqli_error($con));
	
	}
	else
	{
		$insert_sql_statement="insert into inspection_and_folding_table_for_lab_approval 
		(
		`trf_no`,`pp_number`,`shift`,`week_in_year`,`customer_name`,`design_name`,`version_number`,`style_name`,`color`,
		`construction_name`,`process_name`, before_trolley_number, `trolly_number`,`finish_width`,`quantity`,`test_status`,
		`remarks`,inspection_status,`recording_person_id`,`recording_person_name`,`recording_time` ) 
		values (
		'$trf_id','$pp_number','$shift','$week','$customer_name','$design','$version_number','$style_name','$color','$construction_name',
		'$process_name','$before_trolly_number','$after_trolly_number','$finish_width_in_inch','$quantity','$test_result','$remark_for_lab_approval',
		'$inspection_status','$user_id','$user_name', NOW())";

		mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
		
		if(mysqli_affected_rows($con)<>1)
		{
			$data_insertion_hampering = "Yes";
		}
	}

	
	
}


if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously Saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully Saved.";
}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully Saved.";
	
}

$obj->disconnection();

?>
