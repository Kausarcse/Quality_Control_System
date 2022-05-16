<?php
session_start();
error_reporting(0);
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

$pp_number= $_POST['pp_number'];
 $version_number= $_POST['version_number'];
 $splitted_receiving_date= explode("?fs?",$version_number);
 $version_number= $splitted_receiving_date[0];
 $version_id= $splitted_receiving_date[4];

 $customer_name= $_POST['customer_name'];
 $customer_id= $_POST['customer_id'];
 $color= $_POST['color'];
 $finish_width_in_inch= $_POST['finish_width_in_inch'];
 $process_name= $_POST['process_name'];
 
 $splitted_data_for_process=explode("?fs?", $process_name);
$process_name=$splitted_data_for_process[0];
 
 $process_id=$splitted_data_for_process[1];


 $test_method_name= $_POST['test_method_name'];


$temp_test_method_name= $test_method_name[0];

for($i=1;$i<count($test_method_name);$i++) // Making Checkbox Value Comma(,) Separated.
{    

	 $temp_test_method_name=$temp_test_method_name.",".$test_method_name[$i];
     



}


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());
//in loop



$select_sql_for_duplicacy="select * from `test_method_add_for_pp` where `customer_name`='$customer_name' and `checking_field`='$temp_test_method_name' and `process_name`='$process_name'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error());

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
//in loop
else if( mysqli_num_rows($result) < 1)
{ 

	
    /*$delect_sql_for_customer_method="DELETE FROM `test_method_add_for_pp` WHERE `customer_id`='$customer_id'";
    $result_for_customer_method = mysqli_query($con,$delect_sql_for_customer_method) or die(mysqli_error($con));*/

  for($i=0; $i< count($test_method_name); $i++) // Making Checkbox Value Comma(,) Separated.
	{    
	

          $splitted_receiving_date= explode(",",$temp_test_method_name);

   
			   for($i=0;$i<count($splitted_receiving_date);$i++) // Making Checkbox Value Comma(,) Separated.
			      { 
			         $individual_value_for_insert=$splitted_receiving_date[$i];
			       
			         $splitted_receiving_date_individual= explode("fs",$individual_value_for_insert);

			          $test_id=$splitted_receiving_date_individual[0]; 
			          $test_name=$splitted_receiving_date_individual[1]; 
			          $test_method_name=$splitted_receiving_date_individual[2]; 
			          $test_method_id=$splitted_receiving_date_individual[3]; 
			          $test_name_for_use=$splitted_receiving_date_individual[4]; 
          
	   $delect_sql_for_customer_method="DELETE FROM `test_method_add_for_pp` WHERE `customer_id`='$customer_id' AND `test_id`='$test_id' AND `test_method_id`='$test_method_id'";

       $result_for_customer_method = mysqli_query($con,$delect_sql_for_customer_method) or die(mysqli_error($con));



		$insert_sql_statement="INSERT INTO `test_method_add_for_pp`
		     ( `row_id`, 
		       `pp_number`, 
		       `version_number`, 
		       `version_id`,
		       `customer_name`,
		       `customer_id`, 
		       `color`, 
		       `finish_width_in_inch`, 
		       `process_name`, 
		       `process_id`,
		       `test_id`, 
		       `test_name`, 
		       `test_name_for_use`, 
		       `test_method_name`, 
		       `test_method_id`, 
		       `checking_field`,
		       `recording_person_id`, 
		       `recording_person_name`, 
		       `recording_time`) 
		      VALUES 
		     ('$row_id',
		     '$pp_number',
		     '$version_number',
		     '$version_id',
		     '$customer_name',
		     '$customer_id',
		     '$color',
		     '$finish_width_in_inch',
		     '$process_name',
		     '$process_id',
		     '$test_id',
		     '$test_name',
		     '$test_name_for_use',
		     '$test_method_name',
		     '$test_method_id',
		     '$temp_test_method_name',
		     '$user_id',
		     '$user_name',
		      NOW()
		      )";

		  

		mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
       

		}

		if(mysqli_affected_rows($con)<>1)
		{
		
			$data_insertion_hampering = "Yes";
		
		}
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
