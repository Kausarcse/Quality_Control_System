<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];

$pp_number = $_POST['new_pp_number'];
$total_number = $_POST['total_number'];

$old_pp_number = $_POST['old_pp_number'];
$old_version_name = $_POST['old_version_name'];
$duplicate_adding_process_to_version_;

for ($i=1; $i <= $total_number; $i++) 
{
	 
				'$duplicate_adding_process_to_version_'.$i;
				if ( isset($_POST['check_box_select'.$i])) 
				{



				    echo $new_pp_version_id=$_POST['check_box_select'.$i];


			 for ($j=1; $j <= $total_number; $j++) 
                {

				    $j ="select * from `adding_process_to_version` where `pp_number`='$pp_number' and `version_id` = '$new_pp_version_id' ";

					$result_duplicate_adding_process_to_version= mysqli_query($con,$j) or die(mysqli_error($con));
					$check_duplicate_adding_process_to_version = mysqli_num_rows($result_duplicate_adding_process_to_version);


					if ($check_duplicate_adding_process_to_version >= 1) 
					{
			           echo "Data is Previously saved";
					}

					else
					{
			               // ...........................................................Adding Process To version..............................................................//
						
						   $new_pp_version_select="select * from `pp_wise_version_creation_info` where `pp_number`='$pp_number' and `version_id`='$new_pp_version_id'";
					     	

							$result = mysqli_query($con,$new_pp_version_select) or die(mysqli_error());

							while($row = mysqli_fetch_array($result)) 
							{
							    $new_pp_version_id = $new_pp_version_id;

							    //select pp version details
							    $pp_number= $row['pp_number'];
							    $pp_num_id= $row['pp_num_id'];
								$version_name= $row['version_name'];
								$version_id= $new_pp_version_id;
								$style_name= $row['style_name'];
								$color= $row['color'];
								$finish_width_in_inch= $row['finish_width_in_inch'];


								//select pp info details
								$new_pp_info_select="select * from `process_program_info` where `pp_number`='$pp_number'";
								$result_new_pp_info_select = mysqli_query($con,$new_pp_info_select) or die(mysqli_error($con));
								$row_new_pp_info_select = mysqli_fetch_array($result_new_pp_info_select);
			                   
								$customer_name= $row_new_pp_info_select['customer_name'];
								$customer_id= $row_new_pp_info_select['customer_id'];

			                     /***************************************************************Adding PP Monitoring**************************************************************/

											$adding_pp_monitoring="select * from `pp_monitoring` where `pp_number`='$pp_number' and `version_number` = '$version_name' and `style_name`='$style_name' and `finish_width_in_inch`='$finish_width_in_inch'";
											$result_adding_pp_monitoring = mysqli_query($con,$adding_pp_monitoring) or die(mysqli_error($con));
											$check_adding_adding_pp_monitoring = mysqli_num_rows($result_adding_pp_monitoring);

											if ($check_adding_adding_pp_monitoring == 0) 
											{


													$adding_pp_number_for_pp_monitoring= $pp_number;
													$adding_version_number_for_pp_monitoring= $version_name;
													$adding_style_name_for_pp_monitoring = $style_name;
													$adding_customer_name_for_pp_monitoring = $customer_name;
													$adding_finish_width_in_inch_for_pp_monitoring= $finish_width_in_inch;

			                                     $insert_sql_for_pp_monitoring="insert into `pp_monitoring`
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
														                            '$adding_pp_number_for_pp_monitoring',
														                            '$adding_version_number_for_pp_monitoring',
														                            '$adding_style_name_for_pp_monitoring',
														                            '$adding_finish_width_in_inch_for_pp_monitoring',
														                            'Wait for defining standard',
														                            '$user_id',
														                            '$user_name',
														                             NOW(),
														                            'Wait for defining standard')";

														                          
			                                    
															    mysqli_query($con,$insert_sql_for_pp_monitoring) or die(mysqli_error($con));

										  }

			                             /***************************************************************End of Adding PP Monitoring**************************************************************/

			                        



											

			                    
									 //copy from adding_process_to_version start
									//select adding_process_to_version for old pp_version
									$adding_process_to_version="select * from `adding_process_to_version` where `pp_number`='$old_pp_number' and `version_id` = '$old_version_name' ";
									$result_adding_process_to_version = mysqli_query($con,$adding_process_to_version) or die(mysqli_error());
									$check_adding_process_to_version = mysqli_num_rows($result_adding_process_to_version);

									if ($check_adding_process_to_version >= 1) 
									{

										 



										while($row_adding_process_to_version = mysqli_fetch_array($result_adding_process_to_version))
										{
										  $new_pp_version_id=$new_pp_version_id;  /*added new line*/

										  /*if($new_pp_version_id=='')
										  {

										  }*/
										  
											 $pp_number_for_pp_monitoring=$row_adding_process_to_version['pp_number'];
				                             $version_name_for_pp_monitoring=$row_adding_process_to_version['version_name'];
				                             $style_name_for_pp_monitoring=$row_adding_process_to_version['style_name'];
				                             $finish_width_in_inch_for_pp_monitoring=$row_adding_process_to_version['finish_width_in_inch'];



											$adding_version_id= $new_pp_version_id;
											
											$adding_pp_num_id= $pp_num_id;
											$adding_pp_number= $pp_number;
											$adding_version_name= $version_name;
											$adding_style_name = $style_name;
											$adding_customer_name = $customer_name;
											$adding_finish_width_in_inch= $finish_width_in_inch;
											$adding_color= $color;
											$adding_process_id= $row_adding_process_to_version['process_id'];
											$adding_process_name = $row_adding_process_to_version['process_name'];
											$adding_process_serial_no = $row_adding_process_to_version['process_serial_no'];
											$adding_process_or_reprocess = $row_adding_process_to_version['process_or_reprocess'];

											$adding_temp_process_name= $row_adding_process_to_version['checking_field'];

											$insert_sql_statement="insert into `adding_process_to_version` ( `version_id`,`pp_num_id`,`pp_number`,`version_name`,`style_name`,`customer_name`,`finish_width_in_inch`,`color`,`process_id`,`process_name`,`process_serial_no`,`process_or_reprocess`,`checking_field`,`recording_person_id`,`recording_person_name`,`recording_time` ) values ('$adding_version_id','$adding_pp_num_id','$adding_pp_number','$adding_version_name','$adding_style_name','$adding_customer_name','$adding_finish_width_in_inch','$adding_color','$adding_process_id','$adding_process_name','$adding_process_serial_no','$adding_process_or_reprocess','$adding_temp_process_name','$user_id','$user_name',NOW())";
												  /*echo $insert_sql_statement;*/
											mysqli_query($con,$insert_sql_statement) or die(mysqli_error($con));



											if(mysqli_affected_rows($con)<>1)
											{
											
												$data_insertion_hampering = "Yes";
											
											}
										}
										if($data_previously_saved == "Yes")
										{

											mysqli_query($con,"ROLLBACK");
											echo "Data is previously saved.";

										}
										else if($data_insertion_hampering == "No" )
										{

											mysqli_query($con,"COMMIT");
											echo "Data is successfully saved.";

											$adding_pp_monitoring="select current_status,current_state from `pp_monitoring` where `pp_number`='$pp_number_for_pp_monitoring' and `version_number` = '$version_name_for_pp_monitoring' and `style_name`='$style_name_for_pp_monitoring' and `finish_width_in_inch`='$finish_width_in_inch_for_pp_monitoring'";
											$result_adding_pp_monitoring = mysqli_query($con,$adding_pp_monitoring) or die(mysqli_error($con));
											$check_adding_adding_pp_monitoring = mysqli_num_rows($result_adding_pp_monitoring);

											$row_adding_for_pp_monitoring = mysqli_fetch_array($result_adding_pp_monitoring);
										      

			                                        $current_status=$row_adding_for_pp_monitoring['current_status'];
			                                        $current_state=$row_adding_for_pp_monitoring['current_state'];
													$adding_pp_number_for_pp_monitoring= $pp_number;
													$adding_version_number_for_pp_monitoring= $version_name;
													$adding_style_name_for_pp_monitoring = $style_name;
													$adding_customer_name_for_pp_monitoring = $customer_name;
													$adding_finish_width_in_inch_for_pp_monitoring= $finish_width_in_inch;

											if ($check_adding_adding_pp_monitoring >= 1) 
											{
			                                  	$update_sql_for_pp_monitoring="UPDATE `pp_monitoring` SET  `current_status`='Wait for defining standard',`current_state`='Wait for defining standard' WHERE `pp_number`= '$adding_pp_number_for_pp_monitoring' and `version_number`='$adding_version_number_for_pp_monitoring' and `finish_width_in_inch`='$adding_finish_width_in_inch_for_pp_monitoring' and `style_name`='$adding_style_name_for_pp_monitoring'";
				        
					                           mysqli_query($con,$update_sql_for_pp_monitoring) or die(mysqli_error($con));
											}
											else
											{


			                                     $insert_sql_for_pp_monitoring="insert into `pp_monitoring`
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
														                            '$adding_pp_number_for_pp_monitoring',
														                            '$adding_version_number_for_pp_monitoring',
														                            '$adding_style_name_for_pp_monitoring',
														                            '$adding_finish_width_in_inch_for_pp_monitoring',
														                            'Wait for defining Standard',
														                            '$user_id',
														                            '$user_name',
														                             NOW(),
														                            'Wait for defining standard')";

														                          
			                                    
															    mysqli_query($con,$insert_sql_for_pp_monitoring) or die(mysqli_error($con));
											   

										  }
										  

			                             /***************************************************************End of Adding PP Monitoring**************************************************************/


											



										}
										else
										{

											mysqli_query($con,"ROLLBACK");
											echo "Data is not successfully saved.";

										}

										

									 }
							
								
							  } // ...........................................................Adding Process To version..............................................................//

					} // ...........................................................Adding Process To version..............................................................//
	            }
	 }
	

}

$obj->disconnection();



