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

//$date = date_format(date_create($_POST['date']),"Y-m-d");

$date= $_POST['date'];
$splitted_date= explode("/",$date);
$date= $splitted_date[2]."-".$splitted_date[1]."-".$splitted_date[0];


$process_name= $_POST['process_name'];
$machine_name= $_POST['machine_name'];
$diffrance= $_POST['diffrance'];

$problem = $_POST['problem'];
$str_arr = explode ('?fs?', $problem); 
$problem = $str_arr[0];
$problem_group = $str_arr[1];

$from_time= $_POST['from_time'];
$to_time= $_POST['to_time'];
$shift= $_POST['shift'];
$diff_hours= $_POST['diff_hours'];
$diff_minutes= $_POST['diff_minutes'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `machine_stopage_daily_input` where `date`='$date' and `process_name`='$process_name' and `machine_name`='$machine_name' and `problem`='$problem' and `from_time`='$from_time' and `to_time`='$to_time' ";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

	$insert_sql_statement="insert into `machine_stopage_daily_input` (`date`,`process_name`, `machine_name`,`problem`, `problem_group`,`from_time`, `to_time`, `shift`,`diff_hours`, `diff_minutes`, `diffrance`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$date','$process_name','$machine_name','$problem', '$problem_group','$from_time', '$to_time', '$shift','$diff_hours', '$diff_minutes', '$diffrance','$user_id','$user_name',NOW())";

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
