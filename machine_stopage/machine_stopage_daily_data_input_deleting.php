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

$id= $_POST['id'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));


$insert_sql_statement="DELETE FROM machine_stopage_daily_input WHERE id='$id' ";

mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));

if(mysqli_affected_rows($con)<>1)
{

	$data_insertion_hampering = "Yes";

}

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously deleted.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully deleted.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully deleted.";

}

$obj->disconnection();

?>
