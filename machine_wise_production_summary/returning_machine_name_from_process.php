<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
    $process_name_value=$_POST['process_name_value'];
   $splitted_data=explode('?fs?',$process_name_value);
   $process_id=$splitted_data[0]; 

  $option='<option value="select" selected="selected">Select Machine </option>';


		 $sql = "select * FROM `machine_name` WHERE  process_id= '$process_id'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $machine_name=$row['machine_name'];
		 	
			  $option=$option.'<option value="'.$row['machine_name'].'"> '.$row['machine_name'].' </option>';



		 }


		 echo $option;


?>