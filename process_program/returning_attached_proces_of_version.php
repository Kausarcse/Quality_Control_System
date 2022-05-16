<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$pp_number=$_POST['pp_number_value'];
$version_number=$_POST['version_number_value'];
$version_id=$_POST['version_id'];
$color_value=$_POST['color_value'];
$option='<option value="select" selected="selected">Select Standard For</option>';

 
		$sql2 = "select DISTINCT process_name,process_or_reprocess from `adding_process_to_version` where pp_number='$pp_number' and `version_name`='$version_number' and `color`='$color_value' order by row_id ASC";
		 
		 $result2= mysqli_query($con,$sql2) or die(mysqli_error($con));

		 while( $row2 = mysqli_fetch_array( $result2))
		 {    
                     $process_name=$row2['process_name'];
                     $process_or_reprocess=$row2['process_or_reprocess'];

                     if($process_or_reprocess=='process')
                     {

                            //chceing for greige issue standard
                            if ($row2['process_name'] == 'Greige Receiving') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_greige_receiving_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }

                            //chceing for singe and desize standard
                            else if ($row2['process_name'] == 'Singeing & Desizing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_singe_and_desize_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }

                            //chceing for bleaching standard
                            else if ($row2['process_name'] == 'Bleaching') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_bleaching_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for calendering standard
                            else if ($row2['process_name'] == 'Calander') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_calendering_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for curing standard
                            else if ($row2['process_name'] == 'Curing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_curing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for desizing standard
                            else if ($row2['process_name'] == 'Desizing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_desizing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for finishing standard
                            else if ($row2['process_name'] == 'Finishing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_finishing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for mercerize standard
                            else if ($row2['process_name'] == 'Mercerize') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_mercerize_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for printing standard
                            else if ($row2['process_name'] == 'Printing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_printing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for raising standard
                            else if ($row2['process_name'] == 'Raising') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_raising_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for ready_for_dying standard
                            else if ($row2['process_name'] == 'Ready For Dyeing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_ready_for_dying_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for ready_for_mercerize standard
                            else if ($row2['process_name'] == 'Ready For Mercerize') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_ready_for_mercerize_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for ready_for_printing standard
                            else if ($row2['process_name'] == 'Ready For Print') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_ready_for_printing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for ready_for_raising standard
                            else if ($row2['process_name'] == 'Ready For Raising') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_ready_for_raising_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for sanforizing standard
                            else if ($row2['process_name'] == 'Sanforizing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_sanforizing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for scouring_bleaching standard
                            else if ($row2['process_name'] == 'Scouring & Bleaching') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_scouring_bleaching_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for scouring standard
                            else if ($row2['process_name'] == 'Scouring') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_scouring_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for singeing standard
                            else if ($row2['process_name'] == 'Singeing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_singeing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for steaming standard
                            else if ($row2['process_name'] == 'Steaming') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_steaming_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }


                            //chceing for washing standard
                            else if ($row2['process_name'] == 'Washing') 
                            {
                                   $sql = "select * from `defining_qc_standard_for_washing_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                   `version_id`='$version_id' and `color`='$color_value' order by id ASC";
               
                                   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

                                   $row = mysqli_num_rows( $result);

                                   if ($row > 0) 
                                   {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                   }
                                   else
                                   {
                                               $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                   }
                            }

                             //chceing for Dyeing-finish standard
                             else if ($row2['process_name'] == 'Dyeing-Finish') 
                             {
                                    $sql = "select * from `defining_qc_standard_for_dyeing_finish_process` where pp_number='$pp_number' and `version_number`='$version_number' and
                                    `version_id`='$version_id' and `color`='$color_value' order by id ASC";
                
                                    $result= mysqli_query($con,$sql) or die(mysqli_error($con));
 
                                    $row = mysqli_num_rows( $result);
 
                                    if ($row > 0) 
                                    {
                                           $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].' (done)</option>';
                                    }
                                    else
                                    {
                                          $option = $option.'<option value="'.$row2['process_name'].'">'.$row2['process_name'].'</option>'; 
                                    }
                             }

                     }

		 }
		 echo $option;


?>