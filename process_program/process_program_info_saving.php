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

$pp_creation_date= $_POST['pp_creation_date'];
$splitted_pp_creation_date= explode("/",$pp_creation_date);
$pp_creation_date= $splitted_pp_creation_date[2]."-".$splitted_pp_creation_date[1]."-".$splitted_pp_creation_date[0];

$pp_number= $_POST['pp_number'];
$pp_description= $_POST['pp_description'];

$customer_name= $_POST['customer_name'];
$splitted_customer= explode("?fs?",$customer_name);
$customer_name=$splitted_customer[0];
$customer_id=$splitted_customer[1];


$greige_demand_no= $_POST['greige_demand_no'];
$week_in_year= $_POST['week_in_year'];
$design= $_POST['design'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `process_program_info` where `pp_number`='$pp_number'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{
   $select_sql_max_primary_key="select MAX(max_pp_num_id) as max_pp_id FROM (select CONVERT(substring(pp_num_id,10,LENGTH(pp_num_id)),UNSIGNED) as max_pp_num_id from process_program_info) as temp_process_program_info_table"; //converted into string and find max

    $result_for_max_primary_key = mysqli_query($con,$select_sql_max_primary_key) or die(mysqli_error($con));
    
    $row_for_max_primary_key = mysqli_fetch_array($result_for_max_primary_key);

    $row_id=$row_for_max_primary_key['max_pp_id']+1;

    if($row_for_max_primary_key['max_pp_id']==0)
    {

        $current_pp_id='ppnumber_1';

    }
    else
    {

        $current_pp_id ="ppnumber_".($row_for_max_primary_key['max_pp_id']+1);

    }

	$insert_sql_statement="insert into `process_program_info` ( `row_id`,`pp_creation_date`,`pp_num_id`,`pp_number`,`pp_description`,`customer_name`,`customer_id`,`greige_demand_no`,`week_in_year`,`design`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$row_id','$pp_creation_date','$current_pp_id','$pp_number','$pp_description','$customer_name','$customer_id','$greige_demand_no','$week_in_year','$design','$user_id','$user_name',NOW())";

	mysqli_query($con,$insert_sql_statement) or die(mysqli_error());

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}
	else
	{
		/*$insert_sql_for_pp_monitoringt="insert into `pp_monitoring`
                            ( `pp_number`,`version_number`,`style`,`finish_width_in_inch`,`current_status`,`recording_person_id`,`recording_person_name`,`recording_time` ) 
                            values 
                            ('$pp_number','','','','PP Issued','$user_id','$user_name',NOW())";

	    mysqli_query($con,$insert_sql_for_pp_monitoringt) or die(mysqli_error($con));*/
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
