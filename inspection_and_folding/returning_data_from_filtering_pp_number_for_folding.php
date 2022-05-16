<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$pp_number=$_POST['pp_number'];

$data ='';
	 $sql = "SELECT * FROM inspection_and_folding WHERE pp_number = '$pp_number'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		$row = mysqli_fetch_array( $result);
		 
		 	$customer_name=$row['customer_name'];
            $week_in_year=$row['week_in_year'];
		 	
            $data.= $customer_name.'?fs?'.$week_in_year;

		 echo $data;


?>