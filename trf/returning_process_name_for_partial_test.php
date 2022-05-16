<?php
// Returniing Machine name By Process name
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $process_name=$_POST['process_name_value'];

  $splitted_data=explode('?fs?',$process_name);
  $process_id=$splitted_data[0]; 
  $process_name=$splitted_data[1]; 
  $version_id=$splitted_data[2]; 
  $pp_number="";
  $version_number="";
  $current_process_index="";


  $sql_for_porcess_selection="SELECT DISTINCT apv.process_serial_no,apv.process_name,ptti.version_number,ptti.pp_number from partial_test_for_trf_info ptti
								INNER JOIN adding_process_to_version apv ON ptti.pp_number=apv.pp_number and ptti.version_id=apv.version_id
								WHERE apv.version_id='$version_id' order by process_serial_no asc";
  $result_for_porcess_selection= mysqli_query($con,$sql_for_porcess_selection) or die(mysqli_error($con));
   
  $row_for_pp_version=mysqli_fetch_array( $result_for_porcess_selection);
   $pp_number=$row_for_pp_version['pp_number']; 
   $version_number=$row_for_pp_version['version_number']; 




		 while( $row_for_all_process = mysqli_fetch_array( $result_for_porcess_selection))
		 {
			 $data_for_all_process[] = $row_for_all_process['process_name'];

             
			
            
			
		 }
                 

				 $current_process_index = array_search($process_name,$data_for_all_process);
               
                 $for_current_process_name=$data_for_all_process[($current_process_index-1)];
            
                
               

         $option='<option value="select" selected="selected">Select Machine </option>';

		 /*$sql = "select * FROM `machine_name` WHERE  `machine_name`.process_id= '$process_id'";*/
		 $sql = "SELECT ptfti.process_name
		         ,(SELECT after_trolley_or_batcher_qty from partial_test_for_trf_info pt 
					where pt.pp_number= '$pp_number'
					and  pt.version_number = '$version_number'
					and pt.process_name = '".$for_current_process_name."') before_trolley_mtr
				 ,(SELECT after_trolley_number_or_batcher_number from partial_test_for_trf_info pt 
					where pt.pp_number= '$pp_number'
					and  pt.version_number = '$version_number'
					and pt.process_name = '".$for_current_process_name."') before_trolley_or_batcher_no
		          FROM partial_test_for_trf_info ptfti
				WHERE ptfti.process_name='".$for_current_process_name."' AND ptfti.pp_number='$pp_number' AND ptfti.version_number='$version_number'";
         
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
		 	
		 	
		  $option=$option.'<option value="'.$row['process_name']."?fs?".$row['before_trolley_mtr']."?fs?".$row['before_trolley_or_batcher_no']."?fs?".'"> '.$row['process_name'].' </option>';



		 }

		 echo $option;


?>