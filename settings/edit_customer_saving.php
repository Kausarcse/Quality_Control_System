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

/*$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];*/
/*
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

$customer_id= $_POST['customer_id'];
$customer_name= $_POST['customer_name'];
$customer_address= $_POST['customer_address'];
$country_of_origin= $_POST['country_of_origin'];
$receive_key_account_manage= $_POST['key_account_manager_name'];
$splitted_receiving_data= explode("?fs?",$receive_key_account_manage);
$key_account_manager_name=$splitted_receiving_data[0];
$key_account_manager_id=$splitted_receiving_data[1];

$customer_type = $_POST['customer_type'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `customer` where `customer_name`='$customer_name' and `customer_address`='$customer_address' and `country_of_origin`='$country_of_origin' and `key_account_manager_name`='$key_account_manager_name' and customer_type='$customer_type'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
   
	$update_sql_statement="UPDATE `customer` SET  `customer_name`='$customer_name',`customer_address`='$customer_address',`country_of_origin`='$country_of_origin',`key_account_manager_name`='$key_account_manager_name', customer_type='$customer_type', `recording_person_id`='$user_id',`recording_person_name`='$user_name',`recording_time`= NOW() WHERE `customer_id`= '$customer_id'";


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
	echo "Data is successfully updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully updated.";

}

$obj->disconnection();

?>
