<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$version_name=$_POST['version_name'];

   $sql = "select * from pp_wise_version_creation_info where version_name='$version_name'";

    
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
     $option="";
    		 while( $row = mysqli_fetch_array( $result))
    		 {    
            

			  $option=$row['version_id'];

              

		 }

		 echo $option;


?>