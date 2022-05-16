<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

error_reporting(0);

$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

$pp_number= $_POST['pp_number'];
$pp_num_id= $_POST['pp_num_id'];

$version_name= $_POST['version_name'];
$version_id= $_POST['version_id'];
$color= $_POST['color'];
$finish_width_in_inch= $_POST['finish_width_in_inch'];
$customer_name= $_POST['customer_name'];
$style_name= $_POST['style_name'];





$possible_number_of_process = '50';


$temp_process_name="1";

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$delete_sql_statement="DELETE FROM `adding_process_to_version` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' and finish_width_in_inch = '$finish_width_in_inch'";

mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

 for($i=1;$i<=50;$i++)
 {
	
	$process_name = "process_name_".$i;


    

	//$process_name = $_POST[$process_name];
		  
	//echo $process_name;
		  	  
	$process_serial_no = "process_serial_".$i;

	$process_or_reprocess_no = "process_or_reprocess_".$i;
    $process_or_reprocess_no;
	
	
	 
	if(isset($_POST[$process_name]) && isset($_POST[$process_serial_no]) && $_POST[$process_or_reprocess_no]) 
	{

		  $process_name = $_POST[$process_name];
          $process_serial_no = $_POST[$process_serial_no];
		  $process_or_reprocess = $_POST[$process_or_reprocess_no];
		  

		  $splitted_process_name =explode('?fs?', $process_name);

		  if($process_or_reprocess=='re-process')
		  {
		    $process_name="Re-".$splitted_process_name[0];
		    $process_id=$splitted_process_name[1];
		  }
		  else if($process_or_reprocess=='2nd-Re-Process')
		  {
		    $process_name="2nd-Re-".$splitted_process_name[0];
		    $process_id=$splitted_process_name[1];
		  }
		  else if($process_or_reprocess=='3rd-Re-Process')
		  {
		    $process_name="3rd-Re-".$splitted_process_name[0];
		    $process_id=$splitted_process_name[1];
		  }
		  else if($process_or_reprocess=='4th-Re-Process')
		  {
		    $process_name="4th-Re-".$splitted_process_name[0];
		    $process_id=$splitted_process_name[1];
		  }
		  else
		  {
		  	 $process_name=$splitted_process_name[0];
		     $process_id=$splitted_process_name[1];
		  }

		 

		  
		  
		  

		  //if(!empty($process_name))
		  if(isset($process_id))
		  {
			  $insert_sql_statement="insert into `adding_process_to_version` ( `version_id`,`pp_num_id`,`pp_number`,`version_name`,`style_name`,`customer_name`,`finish_width_in_inch`,`color`,`process_id`,`process_name`,`process_serial_no`,`process_or_reprocess`,`checking_field`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$version_id','$pp_num_id','$pp_number','$version_name','$style_name','$customer_name','$finish_width_in_inch','$color','$process_id','$process_name','$process_serial_no','$process_or_reprocess','$temp_process_name','$user_id','$user_name',NOW())";
			  /*echo $insert_sql_statement;*/
			  mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));
			  
		  } // End of if(!empty($process_name))

	}	  
	
 }


if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Process for This Version is Already Defined.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully Updated.";

	$select_sql_for_duplicacy_pp_monitoring="select * from `pp_monitoring` where `pp_number`='$pp_number' and `version_number`='$version_name' and `style_name`='$style_name' and `finish_width_in_inch`='$finish_width_in_inch'";

    $result_pp_monitoring = mysqli_query($con,$select_sql_for_duplicacy_pp_monitoring) or die(mysqli_error($con));
   
  if(mysqli_num_rows($result_pp_monitoring)> 0)
	{  
		 

	   /* $update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Wait for defining standard',`current_state`='Wait for defining standard' WHERE `pp_number`= '$pp_number' and `version_number`='$version_name' and `finish_width_in_inch`='$finish_width_in_inch'";
	        
		    mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));*/

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
                            'Wait for defining standard',
                            '$user_id',
                            '$user_name',
                            NOW(),
                            'Wait for defining standard')";

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
