<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $design=$_POST['design'];

  $option='<option value="select" selected="selected">Select PP Nnmber</option>';



		 $sql = "select pp_number FROM `process_program_info` WHERE design='$design'";
		

		 $result= mysqli_query($con,$sql) or die(mysqli_error());

		 while( $row = mysqli_fetch_array( $result))
		 {    
             
		  $option=$option.'<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';



		 }


		 echo $option;


?>