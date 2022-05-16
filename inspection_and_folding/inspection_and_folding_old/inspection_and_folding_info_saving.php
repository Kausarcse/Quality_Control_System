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


// echo "hello";
// exit();


$shift_for_folding= $_POST['shift_for_folding'];
$trf_id_for_folding= $_POST['trf_id_for_folding'];
$pp_number_for_folding= $_POST['pp_number_for_folding'];
$customer_name_for_folding= $_POST['customer_name_for_folding'];

$design_for_folding= $_POST['design_for_folding'];
$version_number_for_folding= $_POST['version_number_for_folding'];
$style_name_for_folding= $_POST['style_name_for_folding'];
$color_for_folding= $_POST['color_for_folding'];

$construction_name_for_folding= $_POST['construction_name_for_folding'];
$process_name_for_folding= $_POST['process_name_for_folding'];
$after_trolley_number_or_batcher_number= $_POST['trolly_for_folding'];
$finished_width_for_folding= $_POST['finish_width_for_folding'];

$trolly_quantity_for_folding= $_POST['quantity_for_folding'];


// echo $trolly_quantity_for_folding;

$inspection_report_status_for_folding= $_POST['inspection_report_status_for_folding'];
$for_folding= $_POST['for_folding'];
$returing_quantity_for_folding= $_POST['returing_quantity_for_folding'];
$remarks_for_folding= $_POST['remarks_for_folding'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `inspection_and_folding`WHERE `trf_no`= '$trf_id_for_folding' And (`pp_number`='$pp_number_for_folding' and `version_number` = '$version_number_for_folding' and`customer_name` ='$customer_name_for_folding' and `style_name`='$style_name_for_folding' and `color`='$color_for_folding')";
$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

$result_for_select=mysqli_fetch_array($result);
 $before_folding_quantity=$result_for_select['folding_quantity'];
 $total_value=$before_folding_quantity+$for_folding;


if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else 
{
		$insert_sql_statement="insert into `inspection_and_folding` (`trf_no`,`pp_number`,`customer_name`,`design`,`version_number`,`style_name`,`color`, construction_name, process_name, after_trolley_number_or_batcher_number, finish_width, quantity, `inspection_report_status`, folding_quantity, returing_quantity, remarks, `recording_persion_name`,`recording_time` ) 
		values 
		('$trf_id_for_folding','$pp_number_for_folding','$customer_name_for_folding','$design_for_folding','$version_number_for_folding','$style_name_for_folding','$color_for_folding','$construction_name_for_folding', '$process_name_for_folding','$after_trolley_number_or_batcher_number', '$finished_width_for_folding', '$trolly_quantity_for_folding', '$inspection_report_status_for_folding', '$for_folding','$returing_quantity_for_folding','$remarks_for_folding','$user_name',NOW())";
	
		mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
	
		if(mysqli_affected_rows($con)<>1)
		{
		
			$data_insertion_hampering = "Yes";
		
		}
}


if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	// echo "Data is previously saved.";
	
	$update_sql_statement="UPDATE `inspection_and_folding` SET  `inspection_report_status`='$inspection_report_status_for_folding',`folding_quantity`='$total_value',`returing_quantity`='$returing_quantity_for_folding',`remarks`='$remarks_for_folding',`recording_time`= NOW() 
	WHERE `trf_no`= '$trf_id_for_folding' or (`pp_number`='$pp_number_for_folding' and `version_number` = '$version_number_for_folding' and`customer_name` ='$customer_name_for_folding' and `style_name`='$style_name_for_folding' and `color`='$color_for_folding')";
    // echo $update_sql_statement;
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));
	echo "Data is successfully updated";

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
