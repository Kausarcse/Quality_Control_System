<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
   $version_id=$_POST['version_id'];

  $option='<option value="select" selected="selected">Select Process </option>';

		  $sql = "SELECT DISTINCT apv.process_serial_no,apv.process_name,pn.process_id  from adding_process_to_version apv 
                 INNER JOIN process_name pn ON apv.process_name=pn.process_name
		         WHERE apv.version_id='$version_id'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	 $process_name=$row['process_name'];
		 
		 if($process_name=='Finishing')
		 {
		  $option=$option.'<option value="'.$row['process_id']."?fs?".$row['process_name'].'"> '.$row['process_name'].' </option>';
         }
          


		 }


		 echo $option;


?>