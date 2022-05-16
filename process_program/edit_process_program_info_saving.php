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
$result = mysqli_query($con,$sql) or die(mysqli_error());

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



$row_id= $_POST['pp_id'];
$pp_number= $_POST['pp_number'];
$pp_description= $_POST['pp_description'];

$customer_name= $_POST['customer_name'];

$splitted_customer= explode("?fs?",$customer_name);
$customer_name=$splitted_customer[0];
$customer_id=$splitted_customer[1];

$greige_demand_no= $_POST['greige_demand_no'];
$week_in_year= $_POST['week_in_year'];
$design= $_POST['design'];
$remarks= $_POST['remarks'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `process_program_info` where `pp_number`='$pp_number' AND
`pp_description`='$pp_description' AND `customer_name`='$customer_name' AND`greige_demand_no`='$greige_demand_no' AND`week_in_year`='$week_in_year' AND
    `design`='$design' AND `remarks`='$remarks'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$update_sql_statement="UPDATE `process_program_info` SET
    `pp_number`='$pp_number',`pp_description`='$pp_description',
    `customer_name`='$customer_name',`customer_id`='$customer_id', `greige_demand_no`='$greige_demand_no',`week_in_year`='$week_in_year',
    `design`='$design',
    `remarks`='$remarks'
    WHERE
    `row_id`='$row_id'";
   
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)< 1)
	{
	
		$data_insertion_hampering = "No";
	
	}
	
}

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously Updated.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully Updated.";

	

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully Updated.";

}

$obj->disconnection();

?>
