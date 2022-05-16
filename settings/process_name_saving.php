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
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

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

$process_name= $_POST['process_name'];
$description_of_process= $_POST['description_of_process'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `process_name` where `process_name`='$process_name' and `description_of_process`='$description_of_process'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
    $select_sql_max_primary_key="select MAX(max_process_id) as max_process_id FROM (select CONVERT(substring(process_id,6,LENGTH(process_id)),UNSIGNED) as max_process_id from process_name) as temp_key_account_manager_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_process_id']+1;

    if($row_for_max_primary_key['max_process_id']==0)
    {

    	$current_process_id='proc_1';

    }
    else
    {

    	$current_process_id ="proc_".($row_for_max_primary_key['max_process_id']+1);

    }

	$insert_sql_statement="insert into `process_name` (`row_id`,`process_id`,`process_name`,`description_of_process`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$row_id','$current_process_id','$process_name','$description_of_process','$user_id','$user_name',NOW())";

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
