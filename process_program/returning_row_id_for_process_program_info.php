<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$pp_number=$_POST['pp_number'];

   $sql = "select * from process_program_info where pp_number='$pp_number'";

    
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
     $option="";
    		 while( $row = mysqli_fetch_array( $result))
    		 {    
            

			  $option=$row['pp_num_id'];

              

		 }

		 echo $option;


?>