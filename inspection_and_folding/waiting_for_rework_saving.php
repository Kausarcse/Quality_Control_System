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

$all_data = $_POST['all_data'];

//  exit();
$splitted_data=explode("?fs?", $all_data);


$date = date("d-m-Y");

$folding_date =$splitted_data[0];
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
$before_trolley_number = $splitted_data[12];

$trolly_number = $splitted_data[13];
$finish_width_in_inch = $splitted_data[14];
$quantity = $splitted_data[15];
$reworkable_quantity = $splitted_data[16];

if($reworkable_quantity == 0)
{
	$reworkable_quantity = $quantity;
}

$reason_of_rework = $_POST['reason_of_rework'];

 $status_for_rework = $_POST['status_for_rework'];

// exit();
//  echo $process_name;
//  exit();
// echo $inspection_report_fol_folding;
// echo $folding_quantity;
// echo $rejected_quantity;
// echo $reworkable_quantity;
// echo $remark_for_folding;

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `inspection_and_folding_for_rework` WHERE 
        `trf_no`= '$trf_id' And `pp_number`='$pp_number' and `version_number` = '$version_number' 
        and`customer_name` ='$customer_name' and `style_name`='$style_name' and process_name = '$process_name' and 
        `color`='$color' and `before_trolley_number` ='$before_trolley_number' and trolly_number ='$trolly_number'";
$result = mysqli_query($con, $select_sql_for_duplicacy) or die(mysqli_error($con));

$result_for_select=mysqli_fetch_array($result);
//  $before_folding_quantity=$result_for_select['folding_quantity'];
//  $total_value=$before_folding_quantity+$for_folding;


if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
    $insert_sql_statement="insert into inspection_and_folding_for_rework 
    (
            `trf_no`,`pp_number`,`shift`,`week_in_year`,`customer_name`,`design_name`,`version_number`,`style_name`,
            `color`,`construction_name`,`process_name`, `before_trolley_number`,`trolly_number`,`finish_width`,`quantity`,reason_of_rework,
             current_status, `recording_person_id`,`recording_person_name`,`recording_time`) 
        values (
            '$trf_id','$pp_number','$shift','$week','$customer_name','$design','$version_number','$style_name',
            '$color','$construction_name','$process_name','$before_trolley_number', '$trolly_number','$finish_width_in_inch','$reworkable_quantity',
            '$reason_of_rework', 'Reprocess Added in process route','$user_id','$user_name', NOW())";

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
	
	// $update_sql_statement="UPDATE `inspection_and_folding` SET  `inspection_report_status`='$inspection_report_status_for_folding',`folding_quantity`='$total_value',`returing_quantity`='$returing_quantity_for_folding',`remarks`='$remarks_for_folding',`recording_time`= NOW() 
	// WHERE `trf_no`= '$trf_id_for_folding' or (`pp_number`='$pp_number_for_folding' and `version_number` = '$version_number_for_folding' and`customer_name` ='$customer_name_for_folding' and `style_name`='$style_name_for_folding' and `color`='$color_for_folding')";
    // // echo $update_sql_statement;
	// mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));
	// echo "Data is successfully updated";

}
else if($data_insertion_hampering == "No")
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