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

$pp_number= $_POST['pp_number'];
$split_pp_number= explode('?fs?',$pp_number);

$pp_number=$split_pp_number[0];
$pp_num_id=$split_pp_number[1];

$version_name= $_POST['version_name'];
$style_name= $_POST['style_name'];
$color= $_POST['color'];
//$version_id =$_POST['version_id'];
$construction_name= $_POST['construction_name'];
$no_of_weft_yarn_picking= $_POST['no_of_weft_yarn_picking'];
$greige_width_in_inch= $_POST['greige_width_in_inch'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$process_technique_name= $_POST['process_technique_name'];
$percentage_of_cotton_content= $_POST['percentage_of_cotton_content'];
$percentage_of_polyester_content= $_POST['percentage_of_polyester_content'];
$other_fiber_in_yarn= $_POST['other_fiber_in_yarn'];
$percentage_of_other_fiber_content= $_POST['percentage_of_other_fiber_content'];
$pp_quantity= $_POST['pp_quantity'];
$remarks= $_POST['remarks'];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error());

$select_sql_for_duplicacy="select * from `pp_wise_version_creation_info` where 
`pp_number`='$pp_number' and 
`version_name`='$version_name' and
 `color`='$color' and 
 `style_name`='$style_name' and 
 `construction_name`='$construction_name' and 
 `no_of_weft_yarn_picking`='$no_of_weft_yarn_picking' and 
 `greige_width_in_inch`=$greige_width_in_inch and 
 `finish_width_in_inch`=$finish_width_in_inch and 
 `process_technique_name`='$process_technique_name' and 
 `percentage_of_cotton_content`=$percentage_of_cotton_content and 
 `percentage_of_polyester_content`=$percentage_of_polyester_content and 
 `other_fiber_in_yarn`='$other_fiber_in_yarn' and 
 `percentage_of_other_fiber_content`=$percentage_of_other_fiber_content and 
 `pp_quantity`=$pp_quantity and
 `remarks`='$remarks' ";


$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{

	$update_sql_statement="UPDATE `pp_wise_version_creation_info` SET
    
	`style_name`='$style_name',
	`color`='$color',
	`construction_name`='$construction_name',
	`no_of_weft_yarn_picking`='$no_of_weft_yarn_picking',
	`greige_width_in_inch`='$greige_width_in_inch',
	`process_technique_name`='$process_technique_name',
	`percentage_of_cotton_content`='$percentage_of_cotton_content',
	`percentage_of_polyester_content`='$percentage_of_polyester_content',
	`other_fiber_in_yarn`='$other_fiber_in_yarn',
	`percentage_of_other_fiber_content`='$percentage_of_other_fiber_content',
	`pp_quantity`='$pp_quantity',
	`remarks`='$remarks'
    WHERE
    `pp_number`='$pp_number' and `version_name`='$version_name'  and `finish_width_in_inch`='$finish_width_in_inch'";

	mysqli_query($con,$update_sql_statement) or die(mysqli_error());

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
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

	$select_sql_for_duplicacy_pp_monitoring="select * from `pp_monitoring` where `pp_number`='$pp_number' and `version_number`='$version_name' and `style_name`='$style_name' and `finish_width_in_inch`='$finish_width_in_inch'";

    $result_pp_monitoring = mysqli_query($con,$select_sql_for_duplicacy_pp_monitoring) or die(mysqli_error($con));

      if(mysqli_num_rows($result_pp_monitoring)> 0)
      {
         
         
      
      }
      else
      {


		
	    $insert_sql_for_pp_monitoringt="insert into `pp_monitoring`
                            ( 
                            `pp_number`,
                            `version_number`,
                            `style_name`,
                            `finish_width_in_inch`,
                            `current_status`,
                            `recording_person_id`,
                            `recording_person_name`,
                            `recording_time`,
                            `current_state` 
                            ) 
                            values 
                            (
                            '$pp_number',
                            '$version_name',
                            '$style_name',
                            '$finish_width_in_inch',
                            'PP Issued',
                            '$user_id',
                            '$user_name',
                            NOW(),
                            'Wait for defining process route')";

	    mysqli_query($con,$insert_sql_for_pp_monitoringt) or die(mysqli_error($con));

      }

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully Updated.";

}

$obj->disconnection();

?>
