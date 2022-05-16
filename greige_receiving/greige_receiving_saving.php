<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
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
$result = mysql_query($con,$sql) or die(mysqli_error());

if( mysql_num_rows($result) < 1 )
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
$version_name= $_POST['version_name'];
$greige_receiving_date= $_POST['greige_receiving_date'];
$splitted_greige_receiving_date= explode("/",$greige_receiving_date);
$greige_receiving_date= $splitted_greige_receiving_date[2]."-".$splitted_greige_receiving_date[1]."-".$splitted_greige_receiving_date[0];
$received_quantity= $_POST['received_quantity'];
$warp_yarn_count= $_POST['warp_yarn_count'];
$weft_yarn_count= $_POST['weft_yarn_count'];
$no_of_threads_in_warp_in_thread_per_inch= $_POST['no_of_threads_in_warp_in_thread_per_inch'];
$no_of_threads_in_weft_in_thread_per_inch= $_POST['no_of_threads_in_weft_in_thread_per_inch'];
$gsm= $_POST['gsm'];
$percentage_of_cotton_content= $_POST['percentage_of_cotton_content'];
$percentage_of_polyester_content= $_POST['percentage_of_polyester_content'];
$name_of_other_fiber_in_yarn= $_POST['name_of_other_fiber_in_yarn'];
$percentage_of_other_fiber_content= $_POST['percentage_of_other_fiber_content'];
$greige_width= $_POST['greige_width'];
$status= $_POST['status'];
$remarks= $_POST['remarks'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `greige_receiving` where `pp_number`='$pp_number' and `version_name`='$version_name' and `greige_receiving_date`='$greige_receiving_date' and `received_quantity`=$received_quantity and `warp_yarn_count`=$warp_yarn_count and `weft_yarn_count`=$weft_yarn_count and `no_of_threads_in_warp_in_thread_per_inch`=$no_of_threads_in_warp_in_thread_per_inch and `no_of_threads_in_weft_in_thread_per_inch`=$no_of_threads_in_weft_in_thread_per_inch and `gsm`=$gsm and `percentage_of_cotton_content`=$percentage_of_cotton_content and `percentage_of_polyester_content`=$percentage_of_polyester_content and `name_of_other_fiber_in_yarn`='$name_of_other_fiber_in_yarn' and `percentage_of_other_fiber_content`=$percentage_of_other_fiber_content and `greige_width`=$greige_width and `status`='$status' and `remarks`='$remarks'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$insert_sql_statement="insert into `greige_receiving` ( `pp_number`,`version_name`,`greige_receiving_date`,`received_quantity`,`warp_yarn_count`,`weft_yarn_count`,`no_of_threads_in_warp_in_thread_per_inch`,`no_of_threads_in_weft_in_thread_per_inch`,`gsm`,`percentage_of_cotton_content`,`percentage_of_polyester_content`,`name_of_other_fiber_in_yarn`,`percentage_of_other_fiber_content`,`greige_width`,`status`,`remarks`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$pp_number','$version_name','$greige_receiving_date',$received_quantity,$warp_yarn_count,$weft_yarn_count,$no_of_threads_in_warp_in_thread_per_inch,$no_of_threads_in_weft_in_thread_per_inch,$gsm,$percentage_of_cotton_content,$percentage_of_polyester_content,'$name_of_other_fiber_in_yarn',$percentage_of_other_fiber_content,$greige_width,'$status','$remarks','$user_id','$user_name',NOW())";

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
