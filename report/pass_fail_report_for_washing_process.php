<?php
error_reporting(0);
$pp_number=$_GET['pp_number'];
$version_number=$_GET['version_number'];
$customer_id=$_GET['customer_id'];
$customer_name=$_GET['customer_name'];
$style=$_GET['style'];
$finish_width_in_inch=$_GET['finish_width_in_inch'];
$before_trolley_number_or_batcher_number=$_GET['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number=$_GET['after_trolley_number_or_batcher_number'];
$table="<div id='washing_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_washing_process="select * from defining_qc_standard_for_washing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_washing_process=mysqli_query($con,$sql_for_washing_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_washing_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/


	$sql_for_washing_process_qc_result="select * from qc_result_for_washing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	$result_for_washing_process_qc=mysqli_query($con,$sql_for_washing_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_washing_process_qc);


	/************ Displaying Result from qc_result table [End] ************/
	


	// $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
	// 	from test_name_and_method_for_all_process tnm 
	// 	INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
	// 	INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id
	// 	where tmc.customer_name = '$customer_name' ORDER BY tnm.id asc";

   $sql = "SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
   FROM test_name_and_method_for_all_process tnmp
   INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
   INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
   INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
   WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";

$sql_for_customer = "SELECT customer_type from customer WHERE customer_id = '$customer_id' AND customer_name = '$customer_name'";
$result_for_customer = mysqli_query($con, $sql_for_customer) or die(mysqli_error($con));
$row_for_customer = mysqli_fetch_assoc($result_for_customer);

 $customer_type =  $row_for_customer['customer_type'];

 $total_test= 0;
 $p= 0;
 $f= 0;

	$data="";
	$data_for_test_method_id="";
	$test_name_method="";
	$result= mysqli_query($con,$sql) or die(mysqli_error($con));
				 while( $row = mysqli_fetch_array( $result))
				 {
				 	if (in_array($row['id'], ['1']))
					 {
						if ($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0 ) 
                  {
                            $total_test++;

                            if($customer_type == 'american')
								{
									$cf_to_rubbing_dry_tolerance_value = $row_for_defining_process['cf_to_rubbing_dry_tolerance_value'];
									$cf_to_rubbing_dry_value = $row_for_qc['cf_to_rubbing_dry_value'];
								}

								if($customer_type == 'european')
								{
									$cf_to_rubbing_dry_tolerance = $row_for_defining_process['cf_to_rubbing_dry_tolerance_value'];
									if($cf_to_rubbing_dry_tolerance == 1.0)
									{
										$cf_to_rubbing_dry_tolerance_value = '1';
									}
									elseif($cf_to_rubbing_dry_tolerance == 1.5)
									{
										$cf_to_rubbing_dry_tolerance_value = '1-2';
									}
									elseif($cf_to_rubbing_dry_tolerance == 2.0)
									{
										$cf_to_rubbing_dry_tolerance_value = '2';
									}
									elseif($cf_to_rubbing_dry_tolerance == 2.5)
									{
										$cf_to_rubbing_dry_tolerance_value = '2-3';
									}
									elseif($cf_to_rubbing_dry_tolerance == 3.0)
									{
										$cf_to_rubbing_dry_tolerance_value = '3';
									}
									elseif($cf_to_rubbing_dry_tolerance == 3.5)
									{
										$cf_to_rubbing_dry_tolerance_value = '3-4';
									}
									elseif($cf_to_rubbing_dry_tolerance == 4.0)
									{
										$cf_to_rubbing_dry_tolerance_value = '4';
									}
									elseif($cf_to_rubbing_dry_tolerance == 4.5)
									{
										$cf_to_rubbing_dry_tolerance_value = '4-5';
									}
									elseif($cf_to_rubbing_dry_tolerance == 5.0)
									{
										$cf_to_rubbing_dry_tolerance_value = '5';
									} // for define

									$cf_to_rubbing_dry = $row_for_qc['cf_to_rubbing_dry_value'];
									if($cf_to_rubbing_dry == 1.0)
									{
										$cf_to_rubbing_dry_value = '1';
									}
									elseif($cf_to_rubbing_dry == 1.5)
									{
										$cf_to_rubbing_dry_value = '1-2';
									}
									elseif($cf_to_rubbing_dry == 2.0)
									{
										$cf_to_rubbing_dry_value = '2';
									}
									elseif($cf_to_rubbing_dry == 2.5)
									{
										$cf_to_rubbing_dry_value = '2-3';
									}
									elseif($cf_to_rubbing_dry == 3.0)
									{
										$cf_to_rubbing_dry_value = '3';
									}
									elseif($cf_to_rubbing_dry == 3.5)
									{
										$cf_to_rubbing_dry_value = '3-4';
									}
									elseif($cf_to_rubbing_dry == 4.0)
									{
										$cf_to_rubbing_dry_value = '4';
									}
									elseif($cf_to_rubbing_dry == 4.5)
									{
										$cf_to_rubbing_dry_value = '4-5';
									}
									elseif($cf_to_rubbing_dry == 5.0)
									{
										$cf_to_rubbing_dry_value = '5';
									}  // for test result
								}
								

                            if($row_for_defining_process['cf_to_rubbing_dry_min_value']<=$row_for_qc['cf_to_rubbing_dry_value'] && $row_for_defining_process['cf_to_rubbing_dry_max_value']>=$row_for_qc['cf_to_rubbing_dry_value'])
                            {
                               $p++;
    
                               $table.="<tr>
                                  <td>".$row['test_name_method'].' (Dry)'."</td>
                                  <td>".$cf_to_rubbing_dry_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
                                  <td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
                                  <td>Pass</td>
                                  </tr>";
                            }
                            else 
                            {
                               $f++;
    
                               $table.="<tr>
                                  <td>".$row['test_name_method'].' (Dry)'."</td>
                                  <td>".$cf_to_rubbing_dry_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
                                  <td >".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
                                  <td style='color: red;'>Fail</td>
                                  </tr>";
                            }
							}

							if ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) {
								$total_test++;

                        if($customer_type == 'american')
								{
									$cf_to_rubbing_wet_tolerance_value = $row_for_defining_process['cf_to_rubbing_wet_tolerance_value'];
									$cf_to_rubbing_wet_value = $row_for_qc['cf_to_rubbing_wet_value'];
								}

								if($customer_type == 'european')
								{
									$cf_to_rubbing_wet_tolerance = $row_for_defining_process['cf_to_rubbing_wet_tolerance_value'];
									if($cf_to_rubbing_wet_tolerance == 1.0)
									{
										$cf_to_rubbing_wet_tolerance_value = '1';
									}
									elseif($cf_to_rubbing_wet_tolerance == 1.5)
									{
										$cf_to_rubbing_wet_tolerance_value = '1-2';
									}
									elseif($cf_to_rubbing_wet_tolerance == 2.0)
									{
										$cf_to_rubbing_wet_tolerance_value = '2';
									}
									elseif($cf_to_rubbing_wet_tolerance == 2.5)
									{
										$cf_to_rubbing_wet_tolerance_value = '2-3';
									}
									elseif($cf_to_rubbing_wet_tolerance == 3.0)
									{
										$cf_to_rubbing_wet_tolerance_value = '3';
									}
									elseif($cf_to_rubbing_wet_tolerance == 3.5)
									{
										$cf_to_rubbing_wet_tolerance_value = '3-4';
									}
									elseif($cf_to_rubbing_wet_tolerance == 4.0)
									{
										$cf_to_rubbing_wet_tolerance_value = '4';
									}
									elseif($cf_to_rubbing_wet_tolerance == 4.5)
									{
										$cf_to_rubbing_wet_tolerance_value = '4-5';
									}
									elseif($cf_to_rubbing_wet_tolerance == 5.0)
									{
										$cf_to_rubbing_wet_tolerance_value = '5';
									} // for define

									$cf_to_rubbing_wet = $row_for_qc['cf_to_rubbing_wet_value'];
									if($cf_to_rubbing_wet == 1.0)
									{
										$cf_to_rubbing_wet_value = '1';
									}
									elseif($cf_to_rubbing_wet == 1.5)
									{
										$cf_to_rubbing_wet_value = '1-2';
									}
									elseif($cf_to_rubbing_wet == 2.0)
									{
										$cf_to_rubbing_wet_value = '2';
									}
									elseif($cf_to_rubbing_wet == 2.5)
									{
										$cf_to_rubbing_wet_value = '2-3';
									}
									elseif($cf_to_rubbing_wet == 3.0)
									{
										$cf_to_rubbing_wet_value = '3';
									}
									elseif($cf_to_rubbing_wet == 3.5)
									{
										$cf_to_rubbing_wet_value = '3-4';
									}
									elseif($cf_to_rubbing_wet == 4.0)
									{
										$cf_to_rubbing_wet_value = '4';
									}
									elseif($cf_to_rubbing_wet == 4.5)
									{
										$cf_to_rubbing_wet_value = '4-5';
									}
									elseif($cf_to_rubbing_wet == 5.0)
									{
										$cf_to_rubbing_wet_value = '5';
									}  // for test result
								}

                        if($row_for_defining_process['cf_to_rubbing_wet_min_value']<=$row_for_qc['cf_to_rubbing_wet_value'] && $row_for_defining_process['cf_to_rubbing_wet_max_value']>=$row_for_qc['cf_to_rubbing_wet_value'])
								{
									$p++;
									$table.="<tr>
										<td>".$row['test_name_method'].' (Wet)'."</td>
										<td>".$cf_to_rubbing_wet_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
										<td>".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
										<td>Pass</td>
										</tr>";
								}
								else {
									$f++;
									$table.="<tr>
										<td >".$row['test_name_method'].' (Wet)'."</td>
										<td >".$cf_to_rubbing_wet_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
										<td >".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
								}
							}
						
					 }					
					

					 if (in_array($row['id'], ['15','59']))
					{
						
						if ($row_for_defining_process['cf_to_washing_color_change_max_value']<>0 && $row_for_qc['cf_to_washing_color_change_value']<>0) {

							$total_test++;

                    
							if($customer_type == 'american')
							{
								$cf_to_washing_color_change_tolerance_value = $row_for_defining_process['cf_to_washing_color_change_tolerance_value'];
								$cf_to_washing_color_change_value = $row_for_qc['cf_to_washing_color_change_value'];

							}
							if($customer_type == 'european')
							{
								$cf_to_washing_color_change_tolerance = $row_for_defining_process['cf_to_washing_color_change_tolerance_value'];
							
									if($cf_to_washing_color_change_tolerance ==1.0)
									{
										$cf_to_washing_color_change_tolerance_value = '1';
									}
									elseif($cf_to_washing_color_change_tolerance ==1.5)
									{
										$cf_to_washing_color_change_tolerance_value = '1-2';
									}
									elseif($cf_to_washing_color_change_tolerance ==2.0)
									{
										$cf_to_washing_color_change_tolerance_value = '2';
									}
									elseif($cf_to_washing_color_change_tolerance ==2.5)
									{
										$cf_to_washing_color_change_tolerance_value = '2-3';
									}
									elseif($cf_to_washing_color_change_tolerance ==3.0)
									{
										$cf_to_washing_color_change_tolerance_value = '3';
									}
									elseif($cf_to_washing_color_change_tolerance ==3.5)
									{
										$cf_to_washing_color_change_tolerance_value = '3-4';
									}
									elseif($cf_to_washing_color_change_tolerance ==4.0)
									{
										$cf_to_washing_color_change_tolerance_value = '4';
									}
									elseif($cf_to_washing_color_change_tolerance ==4.5)
									{
										$cf_to_washing_color_change_tolerance_value = '4-5';
									}
									elseif($cf_to_washing_color_change_tolerance ==5.0)
									{
										$cf_to_washing_color_change_tolerance_value = '5';
									}  				// for defining

								$cf_to_washing_color_change = $row_for_qc['cf_to_washing_color_change_value'];
							
									if($cf_to_washing_color_change ==1.0)
									{
										$cf_to_washing_color_change_value = '1';
									}
									elseif($cf_to_washing_color_change ==1.5)
									{
										$cf_to_washing_color_change_value = '1-2';
									}
									elseif($cf_to_washing_color_change ==2.0)
									{
										$cf_to_washing_color_change_value = '2';
									}
									elseif($cf_to_washing_color_change ==2.5)
									{
										$cf_to_washing_color_change_value = '2-3';
									}
									elseif($cf_to_washing_color_change ==3.0)
									{
										$cf_to_washing_color_change_value = '3';
									}
									elseif($cf_to_washing_color_change ==3.5)
									{
										$cf_to_washing_color_change_value = '3-4';
									}
									elseif($cf_to_washing_color_change ==4.0)
									{
										$cf_to_washing_color_change_value = '4';
									}
									elseif($cf_to_washing_color_change ==4.5)
									{
										$cf_to_washing_color_change_value = '4-5';
									}
									elseif($cf_to_washing_color_change ==5.0)
									{
										$cf_to_washing_color_change_value = '5';
									} 				// for test result

							}


							if($row_for_defining_process['cf_to_washing_color_change_min_value']<=$row_for_qc['cf_to_washing_color_change_value'] && $row_for_defining_process['cf_to_washing_color_change_max_value']>=$row_for_qc['cf_to_washing_color_change_value'])
							{
								$p++;
                        $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
										<td>".$cf_to_washing_color_change_value."</td>
										<td>".$row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'].' '.$cf_to_washing_color_change_tolerance_value."</td>
										<td>Pass</td>
										</tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Color Change)'."</td>
                        <td>".$cf_to_washing_color_change_value."</td>
                        <td>".$row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'].' '.$cf_to_washing_color_change_tolerance_value."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}

							}

							if ($row_for_defining_process['cf_to_washing_staining_max_value']<>0 && $row_for_qc['cf_to_washing_staining_value']<>0) {

								$total_test++;

                        if($customer_type == 'american')
                        {
                           $cf_to_washing_staining_tolerance_value =  $row_for_defining_process['cf_to_washing_staining_tolerance_value'];
                           $cf_to_washing_staining_value = $row_for_qc['cf_to_washing_staining_value'];

                        }
                        if($customer_type == 'european')
                        {
                        
                           $cf_to_washing_staining_tolerance = $row_for_defining_process['cf_to_washing_staining_tolerance_value'];
                        
                           if($cf_to_washing_staining_tolerance ==1.0)
                           {
                              $cf_to_washing_staining_tolerance_value = '1';
                           }
                           elseif($cf_to_washing_staining_tolerance ==1.5)
                           {
                              $cf_to_washing_staining_tolerance_value = '1-2';
                           }
                           elseif($cf_to_washing_staining_tolerance ==2.0)
                           {
                              $cf_to_washing_staining_tolerance_value = '2';
                           }
                           elseif($cf_to_washing_staining_tolerance ==2.5)
                           {
                              $cf_to_washing_staining_tolerance_value = '2-3';
                           }
                           elseif($cf_to_washing_staining_tolerance ==3.0)
                           {
                              $cf_to_washing_staining_tolerance_value = '3';
                           }
                           elseif($cf_to_washing_staining_tolerance ==3.5)
                           {
                              $cf_to_washing_staining_tolerance_value = '3-4';
                           }
                           elseif($cf_to_washing_staining_tolerance ==4.0)
                           {
                              $cf_to_washing_staining_tolerance_value = '4';
                           }
                           elseif($cf_to_washing_staining_tolerance ==4.5)
                           {
                              $cf_to_washing_staining_tolerance_value = '4-5';
                           }
                           elseif($cf_to_washing_staining_tolerance ==5.0)
                           {
                              $cf_to_washing_staining_tolerance_value = '5';
                           }			// for defining

                     $cf_to_washing_staining = $row_for_qc['cf_to_washing_staining_value'];
                  
                        if($cf_to_washing_staining ==1.0)
                        {
                           $cf_to_washing_staining_value = '1';
                        }
                        elseif($cf_to_washing_staining ==1.5)
                        {
                           $cf_to_washing_staining_value = '1-2';
                        }
                        elseif($cf_to_washing_staining ==2.0)
                        {
                           $cf_to_washing_staining_value = '2';
                        }
                        elseif($cf_to_washing_staining ==2.5)
                        {
                           $cf_to_washing_staining_value = '2-3';
                        }
                        elseif($cf_to_washing_staining ==3.0)
                        {
                           $cf_to_washing_staining_value = '3';
                        }
                        elseif($cf_to_washing_staining ==3.5)
                        {
                           $cf_to_washing_staining_value = '3-4';
                        }
                        elseif($cf_to_washing_staining ==4.0)
                        {
                           $cf_to_washing_staining_value = '4';
                        }
                        elseif($cf_to_washing_staining ==4.5)
                        {
                           $cf_to_washing_staining_value = '4-5';
                        }
                        elseif($cf_to_washing_staining ==5.0)
                        {
                           $cf_to_washing_staining_value = '5';
                        } 				// for test result

                  }


							if($row_for_defining_process['cf_to_washing_staining_min_value']<=$row_for_qc['cf_to_washing_staining_value'] && $row_for_defining_process['cf_to_washing_staining_max_value']>=$row_for_qc['cf_to_washing_staining_value'])
							{
								$p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_washing_staining_value."</td>
                        <td>".$row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'].' '.$cf_to_washing_staining_tolerance_value."</td>
                        <td>Pass</td>
                        </tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_washing_staining_value."</td>
                        <td>".$row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'].' '.$cf_to_washing_staining_tolerance_value."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}

							
							}	

							if ($row_for_defining_process['cf_to_washing_cross_staining_max_value']<>0 && $row_for_qc['cf_to_washing_cross_staining_value']<>0) {

								$total_test++;
                        if($customer_type == 'american')
                        {
                           $cf_to_washing_cross_staining_tolerance_value =  $row_for_defining_process['cf_to_washing_cross_staining_tolerance_value'];
                           $cf_to_washing_cross_staining_value = $row_for_qc['cf_to_washing_cross_staining_value'];

                        }
                        if($customer_type == 'european')
                        {
                        
                              $cf_to_washing_cross_staining_tolerance = $row_for_defining_process['cf_to_washing_cross_staining_tolerance_value'];
                           
                              if($cf_to_washing_cross_staining_tolerance ==1.0)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '1';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==1.5)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '1-2';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==2.0)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '2';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==2.5)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '2-3';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==3.0)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '3';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==3.5)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '3-4';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==4.0)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '4';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==4.5)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '4-5';
                              }
                              elseif($cf_to_washing_cross_staining_tolerance ==5.0)
                              {
                                 $cf_to_washing_cross_staining_tolerance_value = '5';
                              }			// for defining

                              $cf_to_washing_cross_staining = $row_for_qc['cf_to_washing_cross_staining_value'];
                        
                              if($cf_to_washing_cross_staining ==1.0)
                              {
                                 $cf_to_washing_cross_staining_value = '1';
                              }
                              elseif($cf_to_washing_cross_staining ==1.5)
                              {
                                 $cf_to_washing_cross_staining_value = '1-2';
                              }
                              elseif($cf_to_washing_cross_staining ==2.0)
                              {
                                 $cf_to_washing_cross_staining_value = '2';
                              }
                              elseif($cf_to_washing_cross_staining ==2.5)
                              {
                                 $cf_to_washing_cross_staining_value = '2-3';
                              }
                              elseif($cf_to_washing_cross_staining ==3.0)
                              {
                                 $cf_to_washing_cross_staining_value = '3';
                              }
                              elseif($cf_to_washing_cross_staining ==3.5)
                              {
                                 $cf_to_washing_cross_staining_value = '3-4';
                              }
                              elseif($cf_to_washing_cross_staining ==4.0)
                              {
                                 $cf_to_washing_cross_staining_value = '4';
                              }
                              elseif($cf_to_washing_cross_staining ==4.5)
                              {
                                 $cf_to_washing_cross_staining_value = '4-5';
                              }
                              elseif($cf_to_washing_cross_staining ==5.0)
                              {
                                 $cf_to_washing_cross_staining_value = '5';
                              } 				// for test result

                  }

							if($row_for_defining_process['cf_to_washing_cross_staining_min_value']<=$row_for_qc['cf_to_washing_cross_staining_value'] && $row_for_defining_process['cf_to_washing_cross_staining_max_value']>=$row_for_qc['cf_to_washing_cross_staining_value'])
							{
								$p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                        <td>".$cf_to_washing_cross_staining_value."</td>
                        <td>".$row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'].' '.$cf_to_washing_cross_staining_tolerance_value."</td>
                        <td>Pass</td>
                        </tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                        <td>".$cf_to_washing_cross_staining_value."</td>
                        <td>".$row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'].' '.$cf_to_washing_cross_staining_tolerance_value."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}

								}								
													
					}


					 if (in_array($row['id'], ['16', '145']))
					{
						
						if ($row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']<>0 && $row_for_qc['cf_to_dry_cleaning_color_change_value']<>0) {

							$total_test++;

                     if($customer_type == 'american')
							{
								$cf_to_dry_cleaning_color_change_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'];
								$cf_to_dry_cleaning_color_change_value = $row_for_qc['cf_to_dry_cleaning_color_change_value'];

							}
							if($customer_type == 'european')
							{
								$cf_to_dry_cleaning_color_change_tolerance = $row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'];
							
									if($cf_to_dry_cleaning_color_change_tolerance ==1.0)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '1';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==1.5)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '1-2';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==2.0)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '2';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==2.5)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '2-3';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==3.0)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '3';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==3.5)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '3-4';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==4.0)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '4';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==4.5)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '4-5';
									}
									elseif($cf_to_dry_cleaning_color_change_tolerance ==5.0)
									{
										$cf_to_dry_cleaning_color_change_tolerance_value = '5';
									}			// for defining

								$cf_to_dry_cleaning_color_change = $row_for_qc['cf_to_dry_cleaning_color_change_value'];
							
									if($cf_to_dry_cleaning_color_change ==1.0)
									{
										$cf_to_dry_cleaning_color_change_value = '1';
									}
									elseif($cf_to_dry_cleaning_color_change ==1.5)
									{
										$cf_to_dry_cleaning_color_change_value = '1-2';
									}
									elseif($cf_to_dry_cleaning_color_change ==2.0)
									{
										$cf_to_dry_cleaning_color_change_value = '2';
									}
									elseif($cf_to_dry_cleaning_color_change ==2.5)
									{
										$cf_to_dry_cleaning_color_change_value = '2-3';
									}
									elseif($cf_to_dry_cleaning_color_change ==3.0)
									{
										$cf_to_dry_cleaning_color_change_value = '3';
									}
									elseif($cf_to_dry_cleaning_color_change ==3.5)
									{
										$cf_to_dry_cleaning_color_change_value = '3-4';
									}
									elseif($cf_to_dry_cleaning_color_change ==4.0)
									{
										$cf_to_dry_cleaning_color_change_value = '4';
									}
									elseif($cf_to_dry_cleaning_color_change ==4.5)
									{
										$cf_to_dry_cleaning_color_change_value = '4-5';
									}
									elseif($cf_to_dry_cleaning_color_change ==5.0)
									{
										$cf_to_dry_cleaning_color_change_value = '5';
									} 				// for test result

							}



							if($row_for_defining_process['cf_to_dry_cleaning_color_change_min_value']<=$row_for_qc['cf_to_dry_cleaning_color_change_value'] && $row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']>=$row_for_qc['cf_to_dry_cleaning_color_change_value'])
							{
								$p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Color Change)'."</td>
                        <td>".$cf_to_dry_cleaning_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change']."</td>
                        <td>".$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change']."</td>
                        <td>Pass</td>
                        </tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Color Change)'."</td>
                        <td>".$cf_to_dry_cleaning_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change']."</td>
                        <td>".$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}

							}

							if ($row_for_defining_process['cf_to_dry_cleaning_staining_max_value']<>0 && $row_for_qc['cf_to_dry_cleaning_staining_value']<>0) {

								$total_test++;

                        if($customer_type == 'american')
								{
									$cf_to_dry_cleaning_staining_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'];
									$cf_to_dry_cleaning_staining_value = $row_for_qc['cf_to_dry_cleaning_staining_value'];

								}
								if($customer_type == 'european')
								{
									$cf_to_dry_cleaning_staining_tolerance = $row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'];
								
								if($cf_to_dry_cleaning_staining_tolerance ==1.0)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '1';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==1.5)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '1-2';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==2.0)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '2';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==2.5)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '2-3';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==3.0)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '3';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==3.5)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '3-4';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==4.0)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '4';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==4.5)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '4-5';
								}
								elseif($cf_to_dry_cleaning_staining_tolerance ==5.0)
								{
									$cf_to_dry_cleaning_staining_tolerance_value = '5';
								}			// for defining

								$cf_to_dry_cleaning_staining = $row_for_qc['cf_to_dry_cleaning_staining_value'];
							
									if($cf_to_dry_cleaning_staining ==1.0)
									{
										$cf_to_dry_cleaning_staining_value = '1';
									}
									elseif($cf_to_dry_cleaning_staining ==1.5)
									{
										$cf_to_dry_cleaning_staining_value = '1-2';
									}
									elseif($cf_to_dry_cleaning_staining ==2.0)
									{
										$cf_to_dry_cleaning_staining_value = '2';
									}
									elseif($cf_to_dry_cleaning_staining ==2.5)
									{
										$cf_to_dry_cleaning_staining_value = '2-3';
									}
									elseif($cf_to_dry_cleaning_staining ==3.0)
									{
										$cf_to_dry_cleaning_staining_value = '3';
									}
									elseif($cf_to_dry_cleaning_staining ==3.5)
									{
										$cf_to_dry_cleaning_staining_value = '3-4';
									}
									elseif($cf_to_dry_cleaning_staining ==4.0)
									{
										$cf_to_dry_cleaning_staining_value = '4';
									}
									elseif($cf_to_dry_cleaning_staining ==4.5)
									{
										$cf_to_dry_cleaning_staining_value = '4-5';
									}
									elseif($cf_to_dry_cleaning_staining ==5.0)
									{
										$cf_to_dry_cleaning_staining_value = '5';
									} 				// for test result

							}
							
							


							if($row_for_defining_process['cf_to_dry_cleaning_staining_min_value']<=$row_for_qc['cf_to_dry_cleaning_staining_value'] && $row_for_defining_process['cf_to_dry_cleaning_staining_max_value']>=$row_for_qc['cf_to_dry_cleaning_staining_value'])
							{
								$p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_dry_cleaning_staining_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining']."</td>
                        <td>Pass</td>
                        </tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_dry_cleaning_staining_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}

					          }	

					}
                    /*  Iftekhar  After test*/
					 if (in_array($row['id'], ['17','61']))
					 {

                        if($row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_color_change_value']<>0)
                        {   $total_test++;

                           if($customer_type == 'american')
                           {
                              $cf_to_perspiration_acid_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                              $cf_to_perspiration_acid_color_change_value = $row_for_qc['cf_to_perspiration_acid_color_change_value'];
   
                           }
                        if($customer_type == 'european')
                           {
                              $cf_to_perspiration_acid_color_change_tolerance = $row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                        
                              if($cf_to_perspiration_acid_color_change_tolerance ==1.0)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '1';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==1.5)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '1-2';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==2.0)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '2';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==2.5)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '2-3';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==3.0)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '3';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==3.5)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '3-4';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==4.0)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '4';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==4.5)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '4-5';
                              }
                              elseif($cf_to_perspiration_acid_color_change_tolerance ==5.0)
                              {
                                 $cf_to_perspiration_acid_color_change_tolerance_value = '5';
                              }					// for defining
   
                           $cf_to_perspiration_acid_color_change = $row_for_qc['cf_to_perspiration_acid_color_change_value'];
                        
                              if($cf_to_perspiration_acid_color_change ==1.0)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '1';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==1.5)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '1-2';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==2.0)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '2';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==2.5)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '2-3';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==3.0)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '3';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==3.5)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '3-4';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==4.0)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '4';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==4.5)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '4-5';
                              }
                              elseif($cf_to_perspiration_acid_color_change ==5.0)
                              {
                                 $cf_to_perspiration_acid_color_change_value = '5';
                              } 				// for test result
   
                        }
	                        	if($row_for_defining_process['cf_to_perspiration_acid_color_change_min_value']<=$row_for_qc['cf_to_perspiration_acid_color_change_value'] && $row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']>=$row_for_qc['cf_to_perspiration_acid_color_change_value'])
								{
									$p++;
                           $table.="<tr>
                           <td>".$row['test_name_method'].'(Color Change)'."</td>
                           <td>".$cf_to_perspiration_acid_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change']."</td>
                           <td>".$row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'].' '.$cf_to_perspiration_acid_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change']."</td>
                           <td>Pass</td>
                           </tr>";
								}
								else {
									$f++;
                           $table.="<tr>
                           <td>".$row['test_name_method'].'(Color Change)'."</td>
                           <td>".$cf_to_perspiration_acid_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change']."</td>
                           <td>".$row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'].' '.$cf_to_perspiration_acid_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change']."</td>
                           <td style='color: red;'>Fail</td>
                           </tr>";
								}

                     }

						if($row_for_defining_process['cf_to_perspiration_acid_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_staining_value']<>0)
						{

							$total_test++;

                     
							if($customer_type == 'american')
								{
									$cf_to_perspiration_acid_staining_value = $row_for_defining_process['cf_to_perspiration_acid_staining_value'];
									$cf_to_perspiration_acid_staining_val = $row_for_qc['cf_to_perspiration_acid_staining_value'];

								}
							if($customer_type == 'european')
								{
									$cf_to_perspiration_acid_staining = $row_for_defining_process['cf_to_perspiration_acid_staining_value'];
							
							if($cf_to_perspiration_acid_staining ==1.0)
							{
								$cf_to_perspiration_acid_staining_value = '1';
							}
							elseif($cf_to_perspiration_acid_staining ==1.5)
							{
								$cf_to_perspiration_acid_staining_value = '1-2';
							}
							elseif($cf_to_perspiration_acid_staining ==2.0)
							{
								$cf_to_perspiration_acid_staining_value = '2';
							}
							elseif($cf_to_perspiration_acid_staining ==2.5)
							{
								$cf_to_perspiration_acid_staining_value = '2-3';
							}
							elseif($cf_to_perspiration_acid_staining ==3.0)
							{
								$cf_to_perspiration_acid_staining_value = '3';
							}
							elseif($cf_to_perspiration_acid_staining ==3.5)
							{
								$cf_to_perspiration_acid_staining_value = '3-4';
							}
							elseif($cf_to_perspiration_acid_staining ==4.0)
							{
								$cf_to_perspiration_acid_staining_value = '4';
							}
							elseif($cf_to_perspiration_acid_staining ==4.5)
							{
								$cf_to_perspiration_acid_staining_value = '4-5';
							}
							elseif($cf_to_perspiration_acid_staining ==5.0)
							{
								$cf_to_perspiration_acid_staining_value = '5';
							}                                                 // for defining

								$cf_to_perspiration_acid_staining = $row_for_qc['cf_to_perspiration_acid_staining_value'];
							
									if($cf_to_perspiration_acid_staining ==1.0)
									{
										$cf_to_perspiration_acid_staining_val = '1';
									}
									elseif($cf_to_perspiration_acid_staining ==1.5)
									{
										$cf_to_perspiration_acid_staining_val = '1-2';
									}
									elseif($cf_to_perspiration_acid_staining ==2.0)
									{
										$cf_to_perspiration_acid_staining_val = '2';
									}
									elseif($cf_to_perspiration_acid_staining ==2.5)
									{
										$cf_to_perspiration_acid_staining_val = '2-3';
									}
									elseif($cf_to_perspiration_acid_staining ==3.0)
									{
										$cf_to_perspiration_acid_staining_val = '3';
									}
									elseif($cf_to_perspiration_acid_staining ==3.5)
									{
										$cf_to_perspiration_acid_staining_val = '3-4';
									}
									elseif($cf_to_perspiration_acid_staining ==4.0)
									{
										$cf_to_perspiration_acid_staining_val = '4';
									}
									elseif($cf_to_perspiration_acid_staining ==4.5)
									{
										$cf_to_perspiration_acid_staining_val = '4-5';
									}
									elseif($cf_to_perspiration_acid_staining ==5.0)
									{
										$cf_to_perspiration_acid_staining_val = '5';
									} 				// for test result

							}

							if($row_for_defining_process['cf_to_perspiration_acid_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_staining_value'])
							{
								$p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_perspiration_acid_staining_val.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'].' '.$cf_to_perspiration_acid_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_staining']."</td>
                        <td>Pass</td>
                        </tr>";
							}
							else {
								$f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_perspiration_acid_staining_val.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'].' '.$cf_to_perspiration_acid_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_staining']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
							}
                    
						}
                  

                  if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_cross_staining_value']<>0)
                  {
                    $total_test++;
               
               if($customer_type == 'american')
                  {
                     $cf_to_perspiration_acid_cross_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                     $cf_to_perspiration_acid_cross_staining_value = $row_for_qc['cf_to_perspiration_acid_cross_staining_value'];

                  }
               if($customer_type == 'european')
                  {
                     $cf_to_perspiration_acid_cross_staining_tolerance = $row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
               
                     if($cf_to_perspiration_acid_cross_staining_tolerance ==1.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '1';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==1.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '1-2';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==2.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '2';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==2.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '2-3';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==3.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '3';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==3.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '3-4';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==4.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '4';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==4.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '4-5';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining_tolerance ==5.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_tolerance_value = '5';
                     }							   // for defining

                  $cf_to_perspiration_acid_cross_staining = $row_for_qc['cf_to_perspiration_acid_cross_staining_value'];
               
                     if($cf_to_perspiration_acid_cross_staining ==1.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '1';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==1.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '1-2';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==2.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '2';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==2.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '2-3';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==3.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '3';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==3.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '3-4';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==4.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '4';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==4.5)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '4-5';
                     }
                     elseif($cf_to_perspiration_acid_cross_staining ==5.0)
                     {
                        $cf_to_perspiration_acid_cross_staining_value = '5';
                     } 				// for test result

               }



               
                     if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'])
                     { 
                        $p++;
                         $table.="<tr>
                           <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                           <td>".$cf_to_perspiration_acid_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_acid_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining']."</td>
                     <td>Pass</td>
                     </tr>";
                     }
                     else {
                        $f++;
                         $table.="<tr>
                           <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                           <td>".$cf_to_perspiration_acid_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_acid_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining']."</td>
                     <td style='color: red;'>Fail</td>
                  </tr>";
                     }

                          
                  }    /*End of if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']<>0)*/       

               }  /*End of f (in_array($row['id'], ['17','61']))*/


					 
					 if (in_array($row['id'], ['18', '120', '62', '18', '129', '194', '269']))
					 {
                  if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_color_change_value']<>0)
                  {
                   
                     $total_test++;

                     if($customer_type == 'american')
                     {
                        $cf_to_perspiration_alkali_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                        $cf_to_perspiration_alkali_color_change_value = $row_for_qc['cf_to_perspiration_alkali_color_change_value'];

                     }
                     if($customer_type == 'european')
                        {
                        $cf_to_perspiration_alkali_color_change_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                        
                        if($cf_to_perspiration_alkali_color_change_tolerance ==1.0)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '1';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==1.5)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '1-2';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==2.0)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '2';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==2.5)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '2-3';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==3.0)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '3';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==3.5)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '3-4';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==4.0)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '4';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==4.5)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '4-5';
                        }
                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==5.0)
                        {
                           $cf_to_perspiration_alkali_color_change_tolerance_value = '5';
                        }		   // for defining

                        $cf_to_perspiration_alkali_color_change = $row_for_qc['cf_to_perspiration_alkali_color_change_value'];
                     
                           if($cf_to_perspiration_alkali_color_change ==1.0)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '1';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==1.5)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '1-2';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==2.0)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '2';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==2.5)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '2-3';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==3.0)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '3';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==3.5)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '3-4';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==4.0)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '4';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==4.5)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '4-5';
                           }
                           elseif($cf_to_perspiration_alkali_color_change ==5.0)
                           {
                              $cf_to_perspiration_alkali_color_change_value = '5';
                           } 				// for test result

                        }

                  if($row_for_defining_process['cf_to_perspiration_alkali_color_change_min_value']<=$row_for_qc['cf_to_perspiration_alkali_color_change_value'] && $row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']>=$row_for_qc['cf_to_perspiration_alkali_color_change_value'])
                  {
                     $p++;
                      $table.="<tr>
                     <td>".$row['test_name_method'].'Color Change'."</td>
                     <td>".$cf_to_perspiration_alkali_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change']."</td>
                     <td>Pass</td>
                     </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'Color Change'."</td>
                              <td> ".$cf_to_perspiration_alkali_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change']."</td>
                     <td style='color: red;'>Fail</td>
                     </tr>";
                  }

                       
               }    /*End of if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0)*/

                  if($row_for_defining_process['cf_to_perspiration_alkali_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_staining_value']<>0)
                     {

                        $total_test++;

                  if($customer_type == 'american')
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                     $cf_to_perspiration_alkali_staining_value = $row_for_qc['cf_to_perspiration_alkali_staining_value'];

                  }
                  if($customer_type == 'european')
                  {
                  $cf_to_perspiration_alkali_staining_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                  
                  if($cf_to_perspiration_alkali_staining_tolerance ==1.0)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '1';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==1.5)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '1-2';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==2.0)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '2';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==2.5)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '2-3';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==3.0)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '3';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==3.5)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '3-4';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==4.0)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '4';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==4.5)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '4-5';
                  }
                  elseif($cf_to_perspiration_alkali_staining_tolerance ==5.0)
                  {
                     $cf_to_perspiration_alkali_staining_tolerance_value = '5';
                  }		   // for defining

                  $cf_to_perspiration_alkali_staining = $row_for_qc['cf_to_perspiration_alkali_staining_value'];
               
                     if($cf_to_perspiration_alkali_staining ==1.0)
                     {
                        $cf_to_perspiration_alkali_staining_value = '1';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==1.5)
                     {
                        $cf_to_perspiration_alkali_staining_value = '1-2';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==2.0)
                     {
                        $cf_to_perspiration_alkali_staining_value = '2';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==2.5)
                     {
                        $cf_to_perspiration_alkali_staining_value = '2-3';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==3.0)
                     {
                        $cf_to_perspiration_alkali_staining_value = '3';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==3.5)
                     {
                        $cf_to_perspiration_alkali_staining_value = '3-4';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==4.0)
                     {
                        $cf_to_perspiration_alkali_staining_value = '4';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==4.5)
                     {
                        $cf_to_perspiration_alkali_staining_value = '4-5';
                     }
                     elseif($cf_to_perspiration_alkali_staining ==5.0)
                     {
                        $cf_to_perspiration_alkali_staining_value = '5';
                     } 				// for test result

                  }

                  if($row_for_defining_process['cf_to_perspiration_alkali_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_staining_value'])
                  {
                     $p++;

                     $table.="<tr>
                     <td>".$row['test_name_method'].'Staining'."</td>
                     <td>".$cf_to_perspiration_alkali_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining']."</td>
                     <td>Pass</td>
                     </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'Staining'."</td>
                     <td>".$cf_to_perspiration_alkali_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining']."</td>
                     <td style='color: red;'>Fail</td>
                     </tr>";
                  }

                        
               } 

               if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_cross_staining_value']<>0)
               {

                  $total_test++;


                  if($customer_type == 'american')
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
                     $cf_to_perspiration_alkali_cross_staining_value = $row_for_qc['cf_to_perspiration_alkali_cross_staining_value'];

                  }
               if($customer_type == 'european')
                  {
                  $cf_to_perspiration_alkali_cross_staining_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
                  
                  if($cf_to_perspiration_alkali_cross_staining_tolerance ==1.0)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '1';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==1.5)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '1-2';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==2.0)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '2';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==2.5)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '2-3';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==3.0)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '3';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==3.5)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '3-4';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==4.0)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '4';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==4.5)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '4-5';
                  }
                  elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==5.0)
                  {
                     $cf_to_perspiration_alkali_cross_staining_tolerance_value = '5';
                  }												// for defining

                  $cf_to_perspiration_alkali_cross_staining = $row_for_qc['cf_to_perspiration_alkali_cross_staining_value'];
               
                     if($cf_to_perspiration_alkali_cross_staining ==1.0)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '1';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==1.5)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '1-2';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==2.0)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '2';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==2.5)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '2-3';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==3.0)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '3';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==3.5)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '3-4';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==4.0)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '4';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==4.5)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '4-5';
                     }
                     elseif($cf_to_perspiration_alkali_cross_staining ==5.0)
                     {
                        $cf_to_perspiration_alkali_cross_staining_value = '5';
                     } 				// for test result

               }

                  if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'])
                  {
                     $p++;
                      $table.="<tr>
                     <td>".$row['test_name_method'].'Cross Staining'."</td>
                     <td>".$cf_to_perspiration_alkali_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining']."</td>
                     <td>".$row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining']."</td>
                     <td>Pass</td>
                     </tr>";
                  }
                  else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'Cross Staining'."</td>
                              <td>".$cf_to_perspiration_alkali_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining']."</td>
                              <td>".$row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'].' '.$cf_to_perspiration_alkali_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining']."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                        }

                              
                  }   



					 }  /*End of if (in_array($row['id'], ['18', '120', '62', '18', '129', '194', '269']))*/

					 if (in_array($row['id'], ['19', '121', '141', '167', '228']))
					 { 
					 	 
						if($row_for_defining_process['cf_to_water_color_change_max_value']<>0 && $row_for_qc['cf_to_water_color_change_value']<>0)
                     {

                        $total_test++;

						   if($customer_type == 'american')
						   {
							   $cf_to_water_color_change_tolerance_value = $row_for_defining_process['cf_to_water_color_change_tolerance_value'];
							   $cf_to_water_color_change_value = $row_for_qc['cf_to_water_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_water_color_change_tolerance = $row_for_defining_process['cf_to_water_color_change_tolerance_value'];
							
							if($cf_to_water_color_change_tolerance ==1.0)
							{
								$cf_to_water_color_change_tolerance_value = '1';
							}
							elseif($cf_to_water_color_change_tolerance ==1.5)
							{
								$cf_to_water_color_change_tolerance_value = '1-2';
							}
							elseif($cf_to_water_color_change_tolerance ==2.0)
							{
								$cf_to_water_color_change_tolerance_value = '2';
							}
							elseif($cf_to_water_color_change_tolerance ==2.5)
							{
								$cf_to_water_color_change_tolerance_value = '2-3';
							}
							elseif($cf_to_water_color_change_tolerance ==3.0)
							{
								$cf_to_water_color_change_tolerance_value = '3';
							}
							elseif($cf_to_water_color_change_tolerance ==3.5)
							{
								$cf_to_water_color_change_tolerance_value = '3-4';
							}
							elseif($cf_to_water_color_change_tolerance ==4.0)
							{
								$cf_to_water_color_change_tolerance_value = '4';
							}
							elseif($cf_to_water_color_change_tolerance ==4.5)
							{
								$cf_to_water_color_change_tolerance_value = '4-5';
							}
							elseif($cf_to_water_color_change_tolerance ==5.0)
							{
								$cf_to_water_color_change_tolerance_value = '5';
							}						// for defining

						   $cf_to_water_color_change = $row_for_qc['cf_to_water_color_change_value'];
					   
							   if($cf_to_water_color_change ==1.0)
							   {
								   $cf_to_water_color_change_value = '1';
							   }
							   elseif($cf_to_water_color_change ==1.5)
							   {
								   $cf_to_water_color_change_value = '1-2';
							   }
							   elseif($cf_to_water_color_change ==2.0)
							   {
								   $cf_to_water_color_change_value = '2';
							   }
							   elseif($cf_to_water_color_change ==2.5)
							   {
								   $cf_to_water_color_change_value = '2-3';
							   }
							   elseif($cf_to_water_color_change ==3.0)
							   {
								   $cf_to_water_color_change_value = '3';
							   }
							   elseif($cf_to_water_color_change ==3.5)
							   {
								   $cf_to_water_color_change_value = '3-4';
							   }
							   elseif($cf_to_water_color_change ==4.0)
							   {
								   $cf_to_water_color_change_value = '4';
							   }
							   elseif($cf_to_water_color_change ==4.5)
							   {
								   $cf_to_water_color_change_value = '4-5';
							   }
							   elseif($cf_to_water_color_change ==5.0)
							   {
								   $cf_to_water_color_change_value = '5';
							   } 				// for test result

					   }

						  


                           if($row_for_defining_process['cf_to_water_color_change_min_value']<=$row_for_qc['cf_to_water_color_change_value'] && $row_for_defining_process['cf_to_water_color_change_max_value']>=$row_for_qc['cf_to_water_color_change_value'])
                           {
                              $p++;
							         $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_water_color_change_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'].' '.$cf_to_water_color_change_tolerance_value."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
							         $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_water_color_change_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'].' '.$cf_to_water_color_change_tolerance_value."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                        }    /*End of if($row_for_defining_process['cf_to_water_color_change_max_value']<>0)*/


                         if($row_for_defining_process['cf_to_water_staining_max_value']<>0 && $row_for_qc['cf_to_water_staining_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
                           {
                              $cf_to_water_staining_tolerance_value = $row_for_defining_process['cf_to_water_staining_tolerance_value'];
                              $cf_to_water_staining_value = $row_for_qc['cf_to_water_staining_value'];

                           }
					   		   if($customer_type == 'european')
                           {
                           $cf_to_water_staining_tolerance = $row_for_defining_process['cf_to_water_staining_tolerance_value'];
                           
                           if($cf_to_water_staining_tolerance ==1.0)
                           {
                              $cf_to_water_staining_tolerance_value = '1';
                           }
                           elseif($cf_to_water_staining_tolerance ==1.5)
                           {
                              $cf_to_water_staining_tolerance_value = '1-2';
                           }
                           elseif($cf_to_water_staining_tolerance ==2.0)
                           {
                              $cf_to_water_staining_tolerance_value = '2';
                           }
                           elseif($cf_to_water_staining_tolerance ==2.5)
                           {
                              $cf_to_water_staining_tolerance_value = '2-3';
                           }
                           elseif($cf_to_water_staining_tolerance ==3.0)
                           {
                              $cf_to_water_staining_tolerance_value = '3';
                           }
                           elseif($cf_to_water_staining_tolerance ==3.5)
                           {
                              $cf_to_water_staining_tolerance_value = '3-4';
                           }
                           elseif($cf_to_water_staining_tolerance ==4.0)
                           {
                              $cf_to_water_staining_tolerance_value = '4';
                           }
                           elseif($cf_to_water_staining_tolerance ==4.5)
                           {
                              $cf_to_water_staining_tolerance_value = '4-5';
                           }
                           elseif($cf_to_water_staining_tolerance ==5.0)
                           {
                              $cf_to_water_staining_tolerance_value = '5';
                           }		// for defining

                           $cf_to_water_staining = $row_for_qc['cf_to_water_staining_value'];
                        
                              if($cf_to_water_staining ==1.0)
                              {
                                 $cf_to_water_staining_value = '1';
                              }
                              elseif($cf_to_water_staining ==1.5)
                              {
                                 $cf_to_water_staining_value = '1-2';
                              }
                              elseif($cf_to_water_staining ==2.0)
                              {
                                 $cf_to_water_staining_value = '2';
                              }
                              elseif($cf_to_water_staining ==2.5)
                              {
                                 $cf_to_water_staining_value = '2-3';
                              }
                              elseif($cf_to_water_staining ==3.0)
                              {
                                 $cf_to_water_staining_value = '3';
                              }
                              elseif($cf_to_water_staining ==3.5)
                              {
                                 $cf_to_water_staining_value = '3-4';
                              }
                              elseif($cf_to_water_staining ==4.0)
                              {
                                 $cf_to_water_staining_value = '4';
                              }
                              elseif($cf_to_water_staining ==4.5)
                              {
                                 $cf_to_water_staining_value = '4-5';
                              }
                              elseif($cf_to_water_staining ==5.0)
                              {
                                 $cf_to_water_staining_value = '5';
                              } 				// for test result

                        }

						   

                           if($row_for_defining_process['cf_to_water_staining_min_value']<=$row_for_qc['cf_to_water_staining_value'] && $row_for_defining_process['cf_to_water_staining_max_value']>=$row_for_qc['cf_to_water_staining_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Staining)'."</td>
                                       <td>".$cf_to_water_staining_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'].' '.$cf_to_water_staining_tolerance_value."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Staining)'."</td>
                              <td>".$cf_to_water_staining_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'].' '.$cf_to_water_staining_tolerance_value."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                               
                        }    /*End of if($row_for_defining_process['cf_to_water_staining_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_water_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_cross_staining_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
                           {
                              $cf_to_water_cross_staining_tolerance_value = $row_for_defining_process['cf_to_water_cross_staining_tolerance_value'];
                              $cf_to_water_cross_staining_value = $row_for_qc['cf_to_water_cross_staining_value'];

                           }
					   		   if($customer_type == 'european')
                              {
                              $cf_to_water_cross_staining_tolerance = $row_for_defining_process['cf_to_water_cross_staining_tolerance_value'];
                              
                              if($cf_to_water_cross_staining_tolerance ==1.0)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '1';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==1.5)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '1-2';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==2.0)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '2';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==2.5)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '2-3';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==3.0)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '3';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==3.5)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '3-4';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==4.0)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '4';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==4.5)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '4-5';
                              }
                              elseif($cf_to_water_cross_staining_tolerance ==5.0)
                              {
                                 $cf_to_water_cross_staining_tolerance_value = '5';
                              }									// for defining

                              $cf_to_water_cross_staining = $row_for_qc['cf_to_water_cross_staining_value'];
                           
                                 if($cf_to_water_cross_staining ==1.0)
                                 {
                                    $cf_to_water_cross_staining_value = '1';
                                 }
                                 elseif($cf_to_water_cross_staining ==1.5)
                                 {
                                    $cf_to_water_cross_staining_value = '1-2';
                                 }
                                 elseif($cf_to_water_cross_staining ==2.0)
                                 {
                                    $cf_to_water_cross_staining_value = '2';
                                 }
                                 elseif($cf_to_water_cross_staining ==2.5)
                                 {
                                    $cf_to_water_cross_staining_value = '2-3';
                                 }
                                 elseif($cf_to_water_cross_staining ==3.0)
                                 {
                                    $cf_to_water_cross_staining_value = '3';
                                 }
                                 elseif($cf_to_water_cross_staining ==3.5)
                                 {
                                    $cf_to_water_cross_staining_value = '3-4';
                                 }
                                 elseif($cf_to_water_cross_staining ==4.0)
                                 {
                                    $cf_to_water_cross_staining_value = '4';
                                 }
                                 elseif($cf_to_water_cross_staining ==4.5)
                                 {
                                    $cf_to_water_cross_staining_value = '4-5';
                                 }
                                 elseif($cf_to_water_cross_staining ==5.0)
                                 {
                                    $cf_to_water_cross_staining_value = '5';
                                 } 				// for test result

                           }

						   
						  

                           if($row_for_defining_process['cf_to_water_cross_staining_min_value']<=$row_for_qc['cf_to_water_cross_staining_value'] && $row_for_defining_process['cf_to_water_cross_staining_max_value']>=$row_for_qc['cf_to_water_cross_staining_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                                       <td>".$cf_to_water_cross_staining_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'].' '.$cf_to_water_cross_staining_tolerance_value."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                              <td>".$cf_to_water_cross_staining_value."</td>
                              <td>".$row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'].' '.$cf_to_water_cross_staining_tolerance_value."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                             
                        }    /*End of if($row_for_defining_process['cf_to_water_cross_staining_max_value']<>0)*/
					 } 

                if (in_array($row['id'], ['20']))
					 {

                        if($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0 && $row_for_qc['cf_to_water_spotting_surface_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $cf_to_water_spotting_surface_tolerance_value = $row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'];
							   $cf_to_water_spotting_surface_value = $row_for_qc['cf_to_water_spotting_surface_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_water_spotting_surface_tolerance = $row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'];
							
							if($cf_to_water_spotting_surface_tolerance ==1.0)
							{
								$cf_to_water_spotting_surface_tolerance_value = '1';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==1.5)
							{
								$cf_to_water_spotting_surface_tolerance_value = '1-2';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==2.0)
							{
								$cf_to_water_spotting_surface_tolerance_value = '2';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==2.5)
							{
								$cf_to_water_spotting_surface_tolerance_value = '2-3';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==3.0)
							{
								$cf_to_water_spotting_surface_tolerance_value = '3';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==3.5)
							{
								$cf_to_water_spotting_surface_tolerance_value = '3-4';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==4.0)
							{
								$cf_to_water_spotting_surface_tolerance_value = '4';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==4.5)
							{
								$cf_to_water_spotting_surface_tolerance_value = '4-5';
							}
							elseif($cf_to_water_spotting_surface_tolerance ==5.0)
							{
								$cf_to_water_spotting_surface_tolerance_value = '5';
							}										 // for defining

						   $cf_to_water_spotting_surface = $row_for_qc['cf_to_water_spotting_surface_value'];
					   
							   if($cf_to_water_spotting_surface ==1.0)
							   {
								   $cf_to_water_spotting_surface_value = '1';
							   }
							   elseif($cf_to_water_spotting_surface ==1.5)
							   {
								   $cf_to_water_spotting_surface_value = '1-2';
							   }
							   elseif($cf_to_water_spotting_surface ==2.0)
							   {
								   $cf_to_water_spotting_surface_value = '2';
							   }
							   elseif($cf_to_water_spotting_surface ==2.5)
							   {
								   $cf_to_water_spotting_surface_value = '2-3';
							   }
							   elseif($cf_to_water_spotting_surface ==3.0)
							   {
								   $cf_to_water_spotting_surface_value = '3';
							   }
							   elseif($cf_to_water_spotting_surface ==3.5)
							   {
								   $cf_to_water_spotting_surface_value = '3-4';
							   }
							   elseif($cf_to_water_spotting_surface ==4.0)
							   {
								   $cf_to_water_spotting_surface_value = '4';
							   }
							   elseif($cf_to_water_spotting_surface ==4.5)
							   {
								   $cf_to_water_spotting_surface_value = '4-5';
							   }
							   elseif($cf_to_water_spotting_surface ==5.0)
							   {
								   $cf_to_water_spotting_surface_value = '5';
							   } 				// for test result

					   }

						   
						 

						
                           if($row_for_defining_process['cf_to_water_spotting_surface_min_value']<=$row_for_qc['cf_to_water_spotting_surface_value'] && $row_for_defining_process['cf_to_water_spotting_surface_max_value']>=$row_for_qc['cf_to_water_spotting_surface_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Surface)'."</td>
                              <td>".$cf_to_water_spotting_surface_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'].' '.$cf_to_water_spotting_surface_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Surface)'."</td>
                              <td>".$cf_to_water_spotting_surface_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'].' '.$cf_to_water_spotting_surface_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                         
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0)*/

                        if($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0 && $row_for_qc['cf_to_water_spotting_edge_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $cf_to_water_spotting_edge_tolerance_value = $row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'];
							   $cf_to_water_spotting_edge_value = $row_for_qc['cf_to_water_spotting_edge_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_water_spotting_edge_tolerance = $row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'];
							
							if($cf_to_water_spotting_edge_tolerance ==1.0)
							{
								$cf_to_water_spotting_edge_tolerance_value = '1';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==1.5)
							{
								$cf_to_water_spotting_edge_tolerance_value = '1-2';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==2.0)
							{
								$cf_to_water_spotting_edge_tolerance_value = '2';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==2.5)
							{
								$cf_to_water_spotting_edge_tolerance_value = '2-3';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==3.0)
							{
								$cf_to_water_spotting_edge_tolerance_value = '3';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==3.5)
							{
								$cf_to_water_spotting_edge_tolerance_value = '3-4';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==4.0)
							{
								$cf_to_water_spotting_edge_tolerance_value = '4';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==4.5)
							{
								$cf_to_water_spotting_edge_tolerance_value = '4-5';
							}
							elseif($cf_to_water_spotting_edge_tolerance ==5.0)
							{
								$cf_to_water_spotting_edge_tolerance_value = '5';
							}								  // for defining

						   $cf_to_water_spotting_edge = $row_for_qc['cf_to_water_spotting_edge_value'];
					   
							   if($cf_to_water_spotting_edge ==1.0)
							   {
								   $cf_to_water_spotting_edge_value = '1';
							   }
							   elseif($cf_to_water_spotting_edge ==1.5)
							   {
								   $cf_to_water_spotting_edge_value = '1-2';
							   }
							   elseif($cf_to_water_spotting_edge ==2.0)
							   {
								   $cf_to_water_spotting_edge_value = '2';
							   }
							   elseif($cf_to_water_spotting_edge ==2.5)
							   {
								   $cf_to_water_spotting_edge_value = '2-3';
							   }
							   elseif($cf_to_water_spotting_edge ==3.0)
							   {
								   $cf_to_water_spotting_edge_value = '3';
							   }
							   elseif($cf_to_water_spotting_edge ==3.5)
							   {
								   $cf_to_water_spotting_edge_value = '3-4';
							   }
							   elseif($cf_to_water_spotting_edge ==4.0)
							   {
								   $cf_to_water_spotting_edge_value = '4';
							   }
							   elseif($cf_to_water_spotting_edge ==4.5)
							   {
								   $cf_to_water_spotting_edge_value = '4-5';
							   }
							   elseif($cf_to_water_spotting_edge ==5.0)
							   {
								   $cf_to_water_spotting_edge_value = '5';
							   } 				// for test result

					   }


						  
                           if($row_for_defining_process['cf_to_water_spotting_edge_min_value']<=$row_for_qc['cf_to_water_spotting_edge_value'] && $row_for_defining_process['cf_to_water_spotting_edge_max_value']>=$row_for_qc['cf_to_water_spotting_edge_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Edge)'."</td>
                              <td>".$cf_to_water_spotting_edge_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'].' '.$cf_to_water_spotting_edge_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Edge)'."</td>
                              <td>".$cf_to_water_spotting_edge_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'].' '.$cf_to_water_spotting_edge_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

        
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_spotting_cross_staining_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $cf_to_water_spotting_cross_staining_tolerance_value = $row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'];
							   $cf_to_water_spotting_cross_staining_value = $row_for_qc['cf_to_water_spotting_cross_staining_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_water_spotting_cross_staining_tolerance = $row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'];
							
							if($cf_to_water_spotting_cross_staining_tolerance ==1.0)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '1';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==1.5)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '1-2';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==2.0)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '2';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==2.5)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '2-3';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==3.0)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '3';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==3.5)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '3-4';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==4.0)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '4';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==4.5)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '4-5';
							}
							elseif($cf_to_water_spotting_cross_staining_tolerance ==5.0)
							{
								$cf_to_water_spotting_cross_staining_tolerance_value = '5';
							}							  // for defining

						   $cf_to_water_spotting_cross_staining = $row_for_qc['cf_to_water_spotting_cross_staining_value'];
					   
							   if($cf_to_water_spotting_cross_staining ==1.0)
							   {
								   $cf_to_water_spotting_cross_staining_value = '1';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==1.5)
							   {
								   $cf_to_water_spotting_cross_staining_value = '1-2';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==2.0)
							   {
								   $cf_to_water_spotting_cross_staining_value = '2';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==2.5)
							   {
								   $cf_to_water_spotting_cross_staining_value = '2-3';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==3.0)
							   {
								   $cf_to_water_spotting_cross_staining_value = '3';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==3.5)
							   {
								   $cf_to_water_spotting_cross_staining_value = '3-4';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==4.0)
							   {
								   $cf_to_water_spotting_cross_staining_value = '4';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==4.5)
							   {
								   $cf_to_water_spotting_cross_staining_value = '4-5';
							   }
							   elseif($cf_to_water_spotting_cross_staining ==5.0)
							   {
								   $cf_to_water_spotting_cross_staining_value = '5';
							   } 				// for test result

					   }

						  

                           if($row_for_defining_process['cf_to_water_spotting_cross_staining_min_value']<=$row_for_qc['cf_to_water_spotting_cross_staining_value'] && $row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']>=$row_for_qc['cf_to_water_spotting_cross_staining_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                              <td>".$cf_to_water_spotting_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'].' '.$cf_to_water_spotting_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                              <td>".$cf_to_water_spotting_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
							  <td>".$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'].' '.$cf_to_water_spotting_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                              
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0)*/

					 } /* End of if (in_array($row['id'], ['20', '65', '196']))*/
                     			

					 if (in_array($row['id'], ['23', '67']))
					 {
						if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0 && $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
							   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
							 
							$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance = $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
							
							if($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==1.0)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '1';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==1.5)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '1-2';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==2.0)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '2';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==2.5)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '2-3';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==3.0)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '3';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==3.5)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '3-4';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==4.0)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '4';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==4.5)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '4-5';
							}
							elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==5.0)
							{
								$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '5';
							}																	// for defining

						   $cf_to_hydrolysis_of_reactive_dyes_color_change = $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
					   
							   if($cf_to_hydrolysis_of_reactive_dyes_color_change ==1.0)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==1.5)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1-2';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==2.0)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==2.5)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2-3';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==3.0)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==3.5)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3-4';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==4.0)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==4.5)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4-5';
							   }
							   elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==5.0)
							   {
								   $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value']<=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'] && $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']>=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                        }    /*End of if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0)*/




					 } /* End of if (in_array($row['id'], ['23', '67']))*/
					  
                if (in_array($row['id'], ['24', '68']))
					      {
                        if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value']<>0)
                        {

                           $total_test++;


						   if($customer_type == 'american')
						   {
							   $cf_to_oxidative_bleach_damage_color_change_tolerance_value = $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
							   $cf_to_oxidative_bleach_damage_color_change_value = $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
							 
							
							$cf_to_oxidative_bleach_damage_color_change_tolerance = $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
							
							if($cf_to_oxidative_bleach_damage_color_change_tolerance ==1.0)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '1';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==1.5)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '1-2';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==2.0)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '2';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==2.5)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '2-3';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==3.0)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '3';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==3.5)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '3-4';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==4.0)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '4';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==4.5)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '4-5';
							}
							elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==5.0)
							{
								$cf_to_oxidative_bleach_damage_color_change_tolerance_value = '5';
							}												// for defining

						   $cf_to_oxidative_bleach_damage_color_change = $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'];
					   
							   if($cf_to_oxidative_bleach_damage_color_change ==1.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '1';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==1.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '1-2';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==2.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '2';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==2.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '2-3';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==3.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '3';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==3.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '3-4';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==4.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '4';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==4.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '4-5';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==5.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '5';
							   } 				// for test result

					   }
					   

                           if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'])
                           {
                              $p++;
							         $table.="<tr>
							         <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_oxidative_bleach_damage_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.$cf_to_oxidative_bleach_damage_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_oxidative_bleach_damage_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.$cf_to_oxidative_bleach_damage_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                              
                        }    /*End of if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['cf_to_oxidative_bleach_damage_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'].' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_oxidative_bleach_damage_min_value'].' to  '.$row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'].' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                              <td>".$row_for_defining_process['cf_to_oxidative_bleach_damage_min_value'].' to  '.$row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                               
                        }    /*End of if($row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['24', '68']))*/



					 if (in_array($row['id'], ['25', '158', '69']))
					 {

                  if($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0 && $row_for_qc['cf_to_phenolic_yellowing_staining_value']<>0)
                  {

                     $total_test++;

               if($customer_type == 'american')
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = $row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                  $cf_to_phenolic_yellowing_staining_value = $row_for_qc['cf_to_phenolic_yellowing_staining_value'];

               }
                  if($customer_type == 'european')
               {
               $cf_to_phenolic_yellowing_staining_tolerance = $row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
               
               if($cf_to_phenolic_yellowing_staining_tolerance ==1.0)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '1';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==1.5)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '1-2';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==2.0)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '2';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==2.5)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '2-3';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==3.0)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '3';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==3.5)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '3-4';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==4.0)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '4';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==4.5)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '4-5';
               }
               elseif($cf_to_phenolic_yellowing_staining_tolerance ==5.0)
               {
                  $cf_to_phenolic_yellowing_staining_tolerance_value = '5';
               }											 // for defining

               $cf_to_phenolic_yellowing_staining = $row_for_qc['cf_to_phenolic_yellowing_staining_value'];
            
                  if($cf_to_phenolic_yellowing_staining ==1.0)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '1';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==1.5)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '1-2';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==2.0)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '2';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==2.5)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '2-3';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==3.0)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '3';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==3.5)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '3-4';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==4.0)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '4';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==4.5)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '4-5';
                  }
                  elseif($cf_to_phenolic_yellowing_staining ==5.0)
                  {
                     $cf_to_phenolic_yellowing_staining_value = '5';
                  } 				// for test result

            }

              
                     if($row_for_defining_process['cf_to_phenolic_yellowing_staining_min_value']<=$row_for_qc['cf_to_phenolic_yellowing_staining_value'] && $row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']>=$row_for_qc['cf_to_phenolic_yellowing_staining_value'])
                     {
                        $p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_phenolic_yellowing_staining_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.$cf_to_phenolic_yellowing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                        <td>Pass</td>
                        </tr>";
                     }
                     else {
                        $f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_phenolic_yellowing_staining_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.$cf_to_phenolic_yellowing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
                     }

                      
                  }    /*End of if($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0)*/

					 }  /*End of if (in_array($row['id'], ['25', '158', '69']))*/

               if (in_array($row['id'], ['26', '132', '169', '143', '26', '70', '195', '211']))
					 {
                  if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0 && $row_for_qc['cf_to_pvc_migration_staining_value']<>0)
                  {

                     $total_test++;

               if($customer_type == 'american')
               {
                  $cf_to_pvc_migration_staining_tolerance_value = $row_for_defining_process['cf_to_pvc_migration_staining_tolerance_value'];
                  $cf_to_pvc_migration_staining_value = $row_for_qc['cf_to_pvc_migration_staining_value'];

               }
                  if($customer_type == 'european')
               {
               $cf_to_pvc_migration_staining_tolerance = $row_for_defining_process['cf_to_pvc_migration_staining_tolerance_value'];
               
               if($cf_to_pvc_migration_staining_tolerance ==1.0)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '1';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==1.5)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '1-2';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==2.0)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '2';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==2.5)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '2-3';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==3.0)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '3';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==3.5)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '3-4';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==4.0)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '4';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==4.5)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '4-5';
               }
               elseif($cf_to_pvc_migration_staining_tolerance ==5.0)
               {
                  $cf_to_pvc_migration_staining_tolerance_value = '5';
               }

               $cf_to_pvc_migration_staining = $row_for_qc['cf_to_pvc_migration_staining_value'];
            
                  if($cf_to_pvc_migration_staining ==1.0)
                  {
                     $cf_to_pvc_migration_staining_value = '1';
                  }
                  elseif($cf_to_pvc_migration_staining ==1.5)
                  {
                     $cf_to_pvc_migration_staining_value = '1-2';
                  }
                  elseif($cf_to_pvc_migration_staining ==2.0)
                  {
                     $cf_to_pvc_migration_staining_value = '2';
                  }
                  elseif($cf_to_pvc_migration_staining ==2.5)
                  {
                     $cf_to_pvc_migration_staining_value = '2-3';
                  }
                  elseif($cf_to_pvc_migration_staining ==3.0)
                  {
                     $cf_to_pvc_migration_staining_value = '3';
                  }
                  elseif($cf_to_pvc_migration_staining ==3.5)
                  {
                     $cf_to_pvc_migration_staining_value = '3-4';
                  }
                  elseif($cf_to_pvc_migration_staining ==4.0)
                  {
                     $cf_to_pvc_migration_staining_value = '4';
                  }
                  elseif($cf_to_pvc_migration_staining ==4.5)
                  {
                     $cf_to_pvc_migration_staining_value = '4-5';
                  }
                  elseif($cf_to_pvc_migration_staining ==5.0)
                  {
                     $cf_to_pvc_migration_staining_value = '5';
                  } 				// for test result

            }


              

                     if($row_for_defining_process['cf_to_pvc_migration_staining_min_value']<=$row_for_qc['cf_to_pvc_migration_staining_value'] && $row_for_defining_process['cf_to_pvc_migration_staining_max_value']>=$row_for_qc['cf_to_pvc_migration_staining_value'])
                     {
                        $p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_pvc_migration_staining_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'].' '.$cf_to_pvc_migration_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining']."</td>
                        <td>Pass</td>
                        </tr>";
                     }
                     else {
                        $f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_pvc_migration_staining_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'].' '.$cf_to_pvc_migration_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
                     }


                  }    /*End of if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0)*/
					 }


					 if (in_array($row['id'], ['27']))
					 {
                  if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0 && $row_for_qc['cf_to_saliva_color_change_value']<>0)
                  {

                     $total_test++;

               if($customer_type == 'american')
               {
                  $cf_to_saliva_color_change_tolerance_value = $row_for_defining_process['cf_to_saliva_color_change_tolerance_value'];
                  $cf_to_saliva_color_change_value = $row_for_qc['cf_to_saliva_color_change_value'];

               }
                  if($customer_type == 'european')
               {
               $cf_to_saliva_color_change_tolerance = $row_for_defining_process['cf_to_saliva_color_change_tolerance_value'];
               
               if($cf_to_saliva_color_change_tolerance ==1.0)
               {
                  $cf_to_saliva_color_change_tolerance_value = '1';
               }
               elseif($cf_to_saliva_color_change_tolerance ==1.5)
               {
                  $cf_to_saliva_color_change_tolerance_value = '1-2';
               }
               elseif($cf_to_saliva_color_change_tolerance ==2.0)
               {
                  $cf_to_saliva_color_change_tolerance_value = '2';
               }
               elseif($cf_to_saliva_color_change_tolerance ==2.5)
               {
                  $cf_to_saliva_color_change_tolerance_value = '2-3';
               }
               elseif($cf_to_saliva_color_change_tolerance ==3.0)
               {
                  $cf_to_saliva_color_change_tolerance_value = '3';
               }
               elseif($cf_to_saliva_color_change_tolerance ==3.5)
               {
                  $cf_to_saliva_color_change_tolerance_value = '3-4';
               }
               elseif($cf_to_saliva_color_change_tolerance ==4.0)
               {
                  $cf_to_saliva_color_change_tolerance_value = '4';
               }
               elseif($cf_to_saliva_color_change_tolerance ==4.5)
               {
                  $cf_to_saliva_color_change_tolerance_value = '4-5';
               }
               elseif($cf_to_saliva_color_change_tolerance ==5.0)
               {
                  $cf_to_saliva_color_change_tolerance_value = '5';
               }


               $cf_to_saliva_color_change = $row_for_qc['cf_to_saliva_color_change_value'];
            
                  if($cf_to_saliva_color_change ==1.0)
                  {
                     $cf_to_saliva_color_change_value = '1';
                  }
                  elseif($cf_to_saliva_color_change ==1.5)
                  {
                     $cf_to_saliva_color_change_value = '1-2';
                  }
                  elseif($cf_to_saliva_color_change ==2.0)
                  {
                     $cf_to_saliva_color_change_value = '2';
                  }
                  elseif($cf_to_saliva_color_change ==2.5)
                  {
                     $cf_to_saliva_color_change_value = '2-3';
                  }
                  elseif($cf_to_saliva_color_change ==3.0)
                  {
                     $cf_to_saliva_color_change_value = '3';
                  }
                  elseif($cf_to_saliva_color_change ==3.5)
                  {
                     $cf_to_saliva_color_change_value = '3-4';
                  }
                  elseif($cf_to_saliva_color_change ==4.0)
                  {
                     $cf_to_saliva_color_change_value = '4';
                  }
                  elseif($cf_to_saliva_color_change ==4.5)
                  {
                     $cf_to_saliva_color_change_value = '4-5';
                  }
                  elseif($cf_to_saliva_color_change ==5.0)
                  {
                     $cf_to_saliva_color_change_value = '5';
                  } 				// for test result

            }


             

                     if($row_for_defining_process['cf_to_saliva_color_change_min_value']<=$row_for_qc['cf_to_saliva_color_change_value'] && $row_for_defining_process['cf_to_saliva_color_change_max_value']>=$row_for_qc['cf_to_saliva_color_change_value'])
                     {
                        $p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Color Change)'."</td>
                        <td>".$cf_to_saliva_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change']."</td>
                        <td>".$row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'].' '.$cf_to_saliva_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change']."</td>
                        <td>Pass</td>
                        </tr>";
                     }
                     else {
                        $f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Color Change)'."</td>
                        <td>".$cf_to_saliva_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change']."</td>
                        <td>".$row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'].' '.$cf_to_saliva_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
                     }

                          
                  }    /*End of if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0)*/

                  if($row_for_defining_process['cf_to_saliva_staining_max_value']<>0 && $row_for_qc['cf_to_saliva_staining_value']<>0)
                  {

                     $total_test++;

               if($customer_type == 'american')
               {
                  $cf_to_saliva_staining_tolerance_value = $row_for_defining_process['cf_to_saliva_staining_tolerance_value'];
                  $cf_to_saliva_staining_value = $row_for_qc['cf_to_saliva_staining_value'];

               }
                  if($customer_type == 'european')
               {
               $cf_to_saliva_staining_tolerance = $row_for_defining_process['cf_to_saliva_staining_tolerance_value'];
               
               if($cf_to_saliva_staining_tolerance ==1.0)
               {
                  $cf_to_saliva_staining_tolerance_value = '1';
               }
               elseif($cf_to_saliva_staining_tolerance ==1.5)
               {
                  $cf_to_saliva_staining_tolerance_value = '1-2';
               }
               elseif($cf_to_saliva_staining_tolerance ==2.0)
               {
                  $cf_to_saliva_staining_tolerance_value = '2';
               }
               elseif($cf_to_saliva_staining_tolerance ==2.5)
               {
                  $cf_to_saliva_staining_tolerance_value = '2-3';
               }
               elseif($cf_to_saliva_staining_tolerance ==3.0)
               {
                  $cf_to_saliva_staining_tolerance_value = '3';
               }
               elseif($cf_to_saliva_staining_tolerance ==3.5)
               {
                  $cf_to_saliva_staining_tolerance_value = '3-4';
               }
               elseif($cf_to_saliva_staining_tolerance ==4.0)
               {
                  $cf_to_saliva_staining_tolerance_value = '4';
               }
               elseif($cf_to_saliva_staining_tolerance ==4.5)
               {
                  $cf_to_saliva_staining_tolerance_value = '4-5';
               }
               elseif($cf_to_saliva_staining_tolerance ==5.0)
               {
                  $cf_to_saliva_staining_tolerance_value = '5';
               }


               $cf_to_saliva_staining = $row_for_qc['cf_to_saliva_staining_value'];
            
                  if($cf_to_saliva_staining ==1.0)
                  {
                     $cf_to_saliva_staining_value = '1';
                  }
                  elseif($cf_to_saliva_staining ==1.5)
                  {
                     $cf_to_saliva_staining_value = '1-2';
                  }
                  elseif($cf_to_saliva_staining ==2.0)
                  {
                     $cf_to_saliva_staining_value = '2';
                  }
                  elseif($cf_to_saliva_staining ==2.5)
                  {
                     $cf_to_saliva_staining_value = '2-3';
                  }
                  elseif($cf_to_saliva_staining ==3.0)
                  {
                     $cf_to_saliva_staining_value = '3';
                  }
                  elseif($cf_to_saliva_staining ==3.5)
                  {
                     $cf_to_saliva_staining_value = '3-4';
                  }
                  elseif($cf_to_saliva_staining ==4.0)
                  {
                     $cf_to_saliva_staining_value = '4';
                  }
                  elseif($cf_to_saliva_staining ==4.5)
                  {
                     $cf_to_saliva_staining_value = '4-5';
                  }
                  elseif($cf_to_saliva_staining ==5.0)
                  {
                     $cf_to_saliva_staining_value = '5';
                  } 				// for test result

            }


              
                     if($row_for_defining_process['cf_to_saliva_staining_min_value']<=$row_for_qc['cf_to_saliva_staining_value'] && $row_for_defining_process['cf_to_saliva_staining_max_value']>=$row_for_qc['cf_to_saliva_staining_value'])
                     {
                        $p++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_saliva_staining_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'].' '.$cf_to_saliva_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining']."</td>
                        <td>Pass</td>
                        </tr>";
                     }
                     else {
                        $f++;
                        $table.="<tr>
                        <td>".$row['test_name_method'].'(Staining)'."</td>
                        <td>".$cf_to_saliva_staining_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining']."</td>
                        <td>".$row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'].' '.$cf_to_saliva_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining']."</td>
                        <td style='color: red;'>Fail</td>
                        </tr>";
                     }

                          
                  }    /*End of if($row_for_defining_process['cf_to_saliva_staining_max_value']<>0)*/


					 }  /*End of if (in_array($row['id'], ['27', '71', '168', '156']))*/


					 if (in_array($row['id'], ['28','72']))
					 {
                        if($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0 && $row_for_qc['cf_to_chlorinated_water_color_change_value']<>0)
                        {

                           if($customer_type == 'american')
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = $row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                              $cf_to_chlorinated_water_color_change_change_value = $row_for_qc['cf_to_chlorinated_water_color_change_change_value'];
      
                           }
                              if($customer_type == 'european')
                           {
                           $cf_to_chlorinated_water_color_change_tolerance = $row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                           
                           if($cf_to_chlorinated_water_color_change_tolerance ==1.0)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '1';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==1.5)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '1-2';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==2.0)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '2';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==2.5)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '2-3';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==3.0)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '3';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==3.5)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '3-4';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==4.0)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '4';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==4.5)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '4-5';
                           }
                           elseif($cf_to_chlorinated_water_color_change_tolerance ==5.0)
                           {
                              $cf_to_chlorinated_water_color_change_tolerance_value = '5';
                           }
       
       
                           $cf_to_chlorinated_water_color_change_change = $row_for_qc['cf_to_chlorinated_water_color_change_change_value'];
                        
                              if($cf_to_chlorinated_water_color_change_change ==1.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '1';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==1.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '1-2';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==2.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '2';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==2.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '2-3';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==3.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '3';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==3.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '3-4';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==4.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '4';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==4.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '4-5';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==5.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '5';
                              } 				// for test result
      
                        }
      
      
                           
      
      
                           
                                 if($row_for_defining_process['cf_to_chlorinated_water_color_change_min_value']<=$row_for_qc['cf_to_chlorinated_water_color_change_change_value'] && $row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']>=$row_for_qc['cf_to_chlorinated_water_color_change_value'])
                                 {
                                    $p++;
                             $table.="<tr>
                             <td>".$row['test_name_method'].'(Color Change)'."</td>
                                    <td>".$cf_to_chlorinated_water_color_change_change_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change']."</td>
                             <td>".$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.$cf_to_chlorinated_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change']."</td>
                             <td>Pass</td>
                             </tr>";
                                 }
                                 else {
                                    $f++;
                             $table.="<tr>
                             <td>".$row['test_name_method'].'(Color Change)'."</td>
                                    <td>".$cf_to_chlorinated_water_color_change_change_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change']."</td>
                             <td>".$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.$cf_to_chlorinated_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change']."</td>
                             <td style='color: red;'>Fail</td>
                             </tr>";
                                 }
      
                                      
                              }    /*End of if($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0)*/
					 }  /*End of if (in_array($row['id'], ['28', '210', '224', '72', '142']))*/


					 if (in_array($row['id'], ['29', '73']))
					 {
                       if($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_cholorine_bleach_color_change_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $cf_to_cholorine_bleach_color_change_tolerance_value = $row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
							   $cf_to_cholorine_bleach_color_change_value = $row_for_qc['cf_to_cholorine_bleach_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_cholorine_bleach_color_change_tolerance = $row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
							
							if($cf_to_cholorine_bleach_color_change_tolerance ==1.0)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '1';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==1.5)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '1-2';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==2.0)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '2';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==2.5)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '2-3';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==3.0)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '3';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==3.5)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '3-4';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==4.0)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '4';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==4.5)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '4-5';
							}
							elseif($cf_to_cholorine_bleach_color_change_tolerance ==5.0)
							{
								$cf_to_cholorine_bleach_color_change_tolerance_value = '5';
							}
 
 
						   $cf_to_cholorine_bleach_color_change = $row_for_qc['cf_to_cholorine_bleach_color_change_value'];
					   
							   if($cf_to_cholorine_bleach_color_change ==1.0)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '1';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==1.5)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '1-2';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==2.0)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '2';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==2.5)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '2-3';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==3.0)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '3';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==3.5)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '3-4';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==4.0)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '4';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==4.5)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '4-5';
							   }
							   elseif($cf_to_cholorine_bleach_color_change ==5.0)
							   {
								   $cf_to_cholorine_bleach_color_change_value = '5';
							   } 				// for test result

					   }

						

                           if($row_for_defining_process['cf_to_cholorine_bleach_color_change_min_value']<=$row_for_qc['cf_to_cholorine_bleach_color_change_value'] && $row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']>=$row_for_qc['cf_to_cholorine_bleach_color_change_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_cholorine_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
							  <td>".$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.$cf_to_cholorine_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_cholorine_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
							  <td>".$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.$cf_to_cholorine_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['29', '241', '73', '285']))*/



					 if (in_array($row['id'], ['30', '75']))
					 {
                       if($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_peroxide_bleach_color_change_value']<>0)
                        {

                           $total_test++;

                           
						   if($customer_type == 'american')
						   {
							   $cf_to_peroxide_bleach_color_change_tolerance_value = $row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
							   $cf_to_peroxide_bleach_color_change_value = $row_for_qc['cf_to_peroxide_bleach_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cf_to_peroxide_bleach_color_change_tolerance = $row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
							
							if($cf_to_peroxide_bleach_color_change_tolerance ==1.0)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '1';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==1.5)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '1-2';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==2.0)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '2';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==2.5)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '2-3';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==3.0)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '3';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==3.5)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '3-4';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==4.0)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '4';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==4.5)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '4-5';
							}
							elseif($cf_to_peroxide_bleach_color_change_tolerance ==5.0)
							{
								$cf_to_peroxide_bleach_color_change_tolerance_value = '5';
							}
 
 
 
						   $cf_to_peroxide_bleach_color_change = $row_for_qc['cf_to_peroxide_bleach_color_change_value'];
					   
							   if($cf_to_peroxide_bleach_color_change ==1.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '1';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==1.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '1-2';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==2.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '2';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==2.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '2-3';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==3.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '3';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==3.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '3-4';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==4.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '4';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==4.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '4-5';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==5.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '5';
							   } 				// for test result

					   }


						  

                           if($row_for_defining_process['cf_to_peroxide_bleach_color_change_min_value']<=$row_for_qc['cf_to_peroxide_bleach_color_change_value'] && $row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']>=$row_for_qc['cf_to_peroxide_bleach_color_change_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Color Change)'."</td>
                              <td>".$cf_to_peroxide_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>
							  <td>".$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.$cf_to_peroxide_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td >".$row['test_name_method'].'(Color Change)'."</td>
                              <td >".$cf_to_peroxide_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>
							  <td>".$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.$cf_to_peroxide_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                        
                        }    /*End of if($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['30', '75']))*/


					 if (in_array($row['id'], ['31', '76']))
					 {
                        if($row_for_defining_process['cross_staining_max_value']<>0 && $row_for_qc['cross_staining_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $cross_staining_tolerance_value = $row_for_defining_process['cross_staining_tolerance_value'];
							   $cross_staining_value = $row_for_qc['cross_staining_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$cross_staining_tolerance = $row_for_defining_process['cross_staining_tolerance_value'];
							
							if($cross_staining_tolerance ==1.0)
							{
								$cross_staining_tolerance_value = '1';
							}
							elseif($cross_staining_tolerance ==1.5)
							{
								$cross_staining_tolerance_value = '1-2';
							}
							elseif($cross_staining_tolerance ==2.0)
							{
								$cross_staining_tolerance_value = '2';
							}
							elseif($cross_staining_tolerance ==2.5)
							{
								$cross_staining_tolerance_value = '2-3';
							}
							elseif($cross_staining_tolerance ==3.0)
							{
								$cross_staining_tolerance_value = '3';
							}
							elseif($cross_staining_tolerance ==3.5)
							{
								$cross_staining_tolerance_value = '3-4';
							}
							elseif($cross_staining_tolerance ==4.0)
							{
								$cross_staining_tolerance_value = '4';
							}
							elseif($cross_staining_tolerance ==4.5)
							{
								$cross_staining_tolerance_value = '4-5';
							}
							elseif($cross_staining_tolerance ==5.0)
							{
								$cross_staining_tolerance_value = '5';
							}
 
 
 
						   $cross_staining = $row_for_qc['cross_staining_value'];
					   
							   if($cross_staining ==1.0)
							   {
								   $cross_staining_value = '1';
							   }
							   elseif($cross_staining ==1.5)
							   {
								   $cross_staining_value = '1-2';
							   }
							   elseif($cross_staining ==2.0)
							   {
								   $cross_staining_value = '2';
							   }
							   elseif($cross_staining ==2.5)
							   {
								   $cross_staining_value = '2-3';
							   }
							   elseif($cross_staining ==3.0)
							   {
								   $cross_staining_value = '3';
							   }
							   elseif($cross_staining ==3.5)
							   {
								   $cross_staining_value = '3-4';
							   }
							   elseif($cross_staining ==4.0)
							   {
								   $cross_staining_value = '4';
							   }
							   elseif($cross_staining ==4.5)
							   {
								   $cross_staining_value = '4-5';
							   }
							   elseif($cross_staining ==5.0)
							   {
								   $cross_staining_value = '5';
							   } 				// for test result

					   }

						  

                           if($row_for_defining_process['cross_staining_min_value']<=$row_for_qc['cross_staining_value'] && $row_for_defining_process['cross_staining_max_value']>=$row_for_qc['cross_staining_value'])
                           {
                              $p++;

                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                              <td>".$cross_staining_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>
							  <td>".$row_for_defining_process['cross_staining_tolerance_range_math_operator'].' '.$cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
                              <td>".$row['test_name_method'].'(Cross Staining)'."</td>
                              <td>".$cross_staining_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>
							  <td>".$row_for_defining_process['cross_staining_tolerance_range_math_operator'].' '.$cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                                 
                        }    /*End of if($row_for_defining_process['cross_staining_max_value']<>0)*/
                        
					 }  /*End of  if (in_array($row['id'], ['31', '76']))*/



                    if (in_array($row['id'], ['33']))
					   {
                       if($row_for_defining_process['ph_value_max_value']<>0 && $row_for_qc['ph_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['ph_value_min_value']<=$row_for_qc['ph_value'] && $row_for_defining_process['ph_value_max_value']>=$row_for_qc['ph_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method']."</td>
                              <td>".$row_for_qc['ph_value']."</td>
                              <td>".$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value']."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method']."</td>
                              <td>".$row_for_qc['ph_value']."</td>
                              <td>".$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value']."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                        }    /*End of if($row_for_defining_process['ph_value_max_value']<>0)*/

					   }    
                      
 // if (in_array($row['id'], ['33', '109', '78', '237', '170']))

				  }    /*End of  while( $row = mysqli_fetch_array( $result))*/ 


    $table.="</tbody>
              </table></div>";

    echo $table;
?>

<script>
	$('#washing_table').show();
</script>