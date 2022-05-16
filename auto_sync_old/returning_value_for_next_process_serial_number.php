<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$get_all_data_for_process_serial=$_POST['get_all_data_for_process_serial'];

$splitted_data = explode('?fs?',$get_all_data_for_process_serial);
$customer_id = $splitted_data[0];
$customer_name = $splitted_data[1];
$process_id = $splitted_data[2];
$process_name = $splitted_data[3];
$version_number = $splitted_data[4];
$color_name = $splitted_data[5];
$process_technique = $splitted_data[6];

$option="";

    $sql_process_serial = "SELECT MAX(process_serial_no) AS process_serial FROM adding_process_to_version_model 
                        WHERE 
                        version_number = '$version_number' AND 
                        customer_id = '$customer_id' AND 
                        customer_name = '$customer_name' AND 
                        color_name = '$color_name' AND 
                        process_technique = '$process_technique'";

    
		 $result_process_serial = mysqli_query($con,$sql_process_serial) or die(mysqli_error($con));
     
        while( $row = mysqli_fetch_assoc($result_process_serial))
        {    
            $option=$row['process_serial'];
        }

		echo $option;


?>