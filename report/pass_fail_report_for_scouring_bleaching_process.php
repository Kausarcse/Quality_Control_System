<?php
error_reporting(0);
?>
<?php
$pp_number=$_GET['pp_number'];
$version_number=$_GET['version_number'];
$customer_name=$_GET['customer_name'];
$customer_id = $_GET['customer_id'];

$style=$_GET['style'];
$finish_width_in_inch=$_GET['finish_width_in_inch'];
$before_trolley_number_or_batcher_number=$_GET['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number=$_GET['after_trolley_number_or_batcher_number'];

$table="<div id='scouring_bleaching_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";
 
	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_scouring_bleaching="select * from defining_qc_standard_for_scouring_bleaching_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_scouring_bleaching=mysqli_query($con,$sql_for_scouring_bleaching) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_scouring_bleaching);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/

	$sql_for_scouring_bleaching_qc_result="select * from qc_result_for_scouring_bleaching_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	$result_for_scouring_bleaching_qc=mysqli_query($con,$sql_for_scouring_bleaching_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_scouring_bleaching_qc);


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
	$p=0;
	$f=0;


	$data="";
	$data_for_test_method_id="";
	$test_name_method="";
	$result= mysqli_query($con,$sql) or die(mysqli_error($con));

				 while( $row = mysqli_fetch_array( $result))
				 {
						
					 if (in_array($row['id'], ['49']))
					 {
						
						if ($row_for_defining_process['whiteness_max_value']<>0 && $row_for_qc['whiteness_left_value']<>0) 
						{
							
								$total_test++;
								
								if($row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_left_value'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_left_value'] && $row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_center_value'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_center_value'] && $row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_right_value'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_right_value'])
									{
										
										$p++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['whiteness_left_value'].''.$row_for_defining_process['uom_of_whiteness'].' Center: '.$row_for_qc['whiteness_center_value'].''.$row_for_defining_process['uom_of_whiteness'].' Right: '.$row_for_qc['whiteness_right_value'].''.$row_for_defining_process['uom_of_whiteness']."</td>	
										<td>".'('.$row_for_defining_process['whiteness_min_value'].' to '.$row_for_defining_process['whiteness_max_value'].') '.$row_for_defining_process['uom_of_whiteness']."</td>
										<td>Pass</td>
										</tr>";
									}
								else 
									{
										$f++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['whiteness_left_value'].''.$row_for_defining_process['uom_of_whiteness'].' Center: '.$row_for_qc['whiteness_center_value'].''.$row_for_defining_process['uom_of_whiteness'].' Right: '.$row_for_qc['whiteness_right_value'].''.$row_for_defining_process['uom_of_whiteness']."</td>	
										<td>".'('.$row_for_defining_process['whiteness_min_value'].' to '.$row_for_defining_process['whiteness_max_value'].') '.$row_for_defining_process['uom_of_whiteness']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
									}
						}
					 }
                     


					 if (in_array($row['id'], ['50']))
					 {

					 if ($row_for_defining_process['residual_sizing_material_max_value']<>0 && $row_for_qc['residual_sizing_material_left_value']<>0) 
							{
	                      		$total_test++;

	                      		if($row_for_defining_process['residual_sizing_material_min_value']<=$row_for_qc['residual_sizing_material_left_value'] && $row_for_defining_process['residual_sizing_material_max_value']>=$row_for_qc['residual_sizing_material_left_value'] && $row_for_defining_process['residual_sizing_material_min_value']<=$row_for_qc['residual_sizing_material_center_value'] && $row_for_defining_process['residual_sizing_material_max_value']>=$row_for_qc['residual_sizing_material_center_value'] && $row_for_defining_process['residual_sizing_material_min_value']<=$row_for_qc['residual_sizing_material_right_value'] && $row_for_defining_process['residual_sizing_material_max_value']>=$row_for_qc['residual_sizing_material_right_value'])
									{
										$p++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['residual_sizing_material_left_value'].' Center: '.$row_for_qc['residual_sizing_material_center_value'].' Right: '.$row_for_qc['residual_sizing_material_right_value'].' '.$row_for_defining_process['uom_of_residual_sizing_material']."</td>	
										<td>".$row_for_defining_process['residual_sizing_material_min_value'].' to '.$row_for_defining_process['residual_sizing_material_max_value']."</td>
										<td>Pass</td>
										</tr>";
									}
								else 
									{
										$f++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['residual_sizing_material_left_value'].' Center: '.$row_for_qc['residual_sizing_material_center_value'].' Right: '.$row_for_qc['residual_sizing_material_right_value'].' '.$row_for_defining_process['uom_of_residual_sizing_material']."</td>	
										<td>".$row_for_defining_process['residual_sizing_material_min_value'].' to '.$row_for_defining_process['residual_sizing_material_max_value']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
									}

		                     

		                      }
	                   } /* End of  if (in_array($row['id'], ['50','97']))*/
  
					
                     if (in_array($row['id'], ['51']))
					 { 
                       
					 if ($row_for_defining_process['absorbency_max_value']<>0 && $row_for_qc['absorbency_left_value']<>0) 
						{
					 	$total_test++;

						 if($row_for_defining_process['absorbency_min_value']<=$row_for_qc['absorbency_left_value'] && $row_for_defining_process['absorbency_max_value']>=$row_for_qc['absorbency_left_value'] && $row_for_defining_process['absorbency_min_value']<=$row_for_qc['absorbency_center_value'] && $row_for_defining_process['absorbency_max_value']>=$row_for_qc['absorbency_center_value'] && $row_for_defining_process['absorbency_min_value']<=$row_for_qc['absorbency_right_value'] && $row_for_defining_process['absorbency_max_value']>=$row_for_qc['absorbency_right_value'])
									{
										$p++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['absorbency_left_value'].''.$row_for_defining_process['uom_of_absorbency'].' Center: '.$row_for_qc['absorbency_center_value'].''.$row_for_defining_process['uom_of_absorbency'].' Right '.$row_for_qc['absorbency_right_value'].''.$row_for_defining_process['uom_of_absorbency']."</td>	
										<td>".'('.$row_for_defining_process['absorbency_min_value'].' to '.$row_for_defining_process['absorbency_max_value'].') '.$row_for_defining_process['uom_of_absorbency']."</td>
										<td>Pass</td>
										</tr>";
									}
								else 
									{
										$f++;
										$table.="<tr>
										<td>".$row['test_name_method']."</td>
										<td>Left: ".$row_for_qc['absorbency_left_value'].''.$row_for_defining_process['uom_of_absorbency'].' Center: '.$row_for_qc['absorbency_center_value'].''.$row_for_defining_process['uom_of_absorbency'].' Right '.$row_for_qc['absorbency_right_value'].''.$row_for_defining_process['uom_of_absorbency']."</td>	
										<td>".'('.$row_for_defining_process['absorbency_min_value'].' to '.$row_for_defining_process['absorbency_max_value'].') '.$row_for_defining_process['uom_of_absorbency']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
									}
		                      
                           }
		                           
	                  }     /*End of if (in_array($row['id'], ['51','98']))*/
                         

                    if (in_array($row['id'], ['6']))
					 { 
                      if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['resistance_to_surface_fuzzing_and_pilling_left_value']<>0) 
						{
							$total_test++;

							if($customer_type == 'american')
							{
								$surface_fuzzing_and_pilling_tolerance_value = $row_for_defining_process['surface_fuzzing_and_pilling_tolerance_value'];
								$surface_fuzzing_and_pilling_value = $row_for_qc['surface_fuzzing_and_pilling_value'];

							}
							if($customer_type == 'european')
							{
								$surface_fuzzing_and_pilling_tolerance = $row_for_defining_process['surface_fuzzing_and_pilling_tolerance_value'];
							
											if($surface_fuzzing_and_pilling_tolerance ==1.0)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '1';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==1.5)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '1-2';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==2.0)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '2';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==2.5)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '2-3';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==3.0)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '3';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==3.5)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '3-4';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==4.0)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '4';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==4.5)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '4-5';
											}
											elseif($surface_fuzzing_and_pilling_tolerance ==5.0)
											{
												$surface_fuzzing_and_pilling_tolerance_value = '5';
											}  				// for defining

								$surface_fuzzing_and_pilling = $row_for_qc['surface_fuzzing_and_pilling_value'];
							
									if($surface_fuzzing_and_pilling ==1.0)
									{
										$surface_fuzzing_and_pilling_value = '1';
									}
									elseif($surface_fuzzing_and_pilling ==1.5)
									{
										$surface_fuzzing_and_pilling_value = '1-2';
									}
									elseif($surface_fuzzing_and_pilling ==2.0)
									{
										$surface_fuzzing_and_pilling_value = '2';
									}
									elseif($surface_fuzzing_and_pilling ==2.5)
									{
										$surface_fuzzing_and_pilling_value = '2-3';
									}
									elseif($surface_fuzzing_and_pilling ==3.0)
									{
										$surface_fuzzing_and_pilling_value = '3';
									}
									elseif($surface_fuzzing_and_pilling ==3.5)
									{
										$surface_fuzzing_and_pilling_value = '3-4';
									}
									elseif($surface_fuzzing_and_pilling ==4.0)
									{
										$surface_fuzzing_and_pilling_value = '4';
									}
									elseif($surface_fuzzing_and_pilling ==4.5)
									{
										$surface_fuzzing_and_pilling_value = '4-5';
									}
									elseif($surface_fuzzing_and_pilling ==5.0)
									{
										$surface_fuzzing_and_pilling_value = '5';
									} 				// for test result

							}

							if($row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_left_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_left_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_center_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_center_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_right_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['resistance_to_surface_fuzzing_and_pilling_right_value'])
							{
								$p++;
								$table.="<tr>
								<td>".$row['test_name_method']."</td>
								<td>Left: ".$row_for_qc['resistance_to_surface_fuzzing_and_pilling_left_value'].' Center: '.$row_for_qc['resistance_to_surface_fuzzing_and_pilling_center_value'].' Right: '.$row_for_qc['resistance_to_surface_fuzzing_and_pilling_right_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_fuzzing_and_pilling']."</td>	
								<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].' '.$surface_fuzzing_and_pilling_tolerance_value."</td>
								<td>Pass</td>
								</tr>";
							}
							else 
							{
								$f++;
								$table.="<tr>
								<td>".$row['test_name_method']."</td>
								<td>Left: ".$row_for_qc['resistance_to_surface_fuzzing_and_pilling_left_value'].' Center: '.$row_for_qc['resistance_to_surface_fuzzing_and_pilling_center_value'].' Right: '.$row_for_qc['resistance_to_surface_fuzzing_and_pilling_right_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_fuzzing_and_pilling']."</td>	
								<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].' '.$surface_fuzzing_and_pilling_tolerance_value."</td>
								<td style='color: red;'>Fail</td>
								</tr>";
							}
				   
						}


					 }  /*End of  if (in_array($row['id'], ['6','101']))*/


					 
					
					  
				  }        // End of while

				  if ($row_for_defining_process['ph_max_value']<>0  && $row_for_qc['ph_left_value']<>0) 
						 {
							$total_test++;
	                        if($row_for_defining_process['ph_min_value']<=$row_for_qc['ph_left_value'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['ph_left_value'] && $row_for_defining_process['ph_min_value']<=$row_for_qc['ph_left_value'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['ph_right_value'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['ph_right_value'])
							{
								$p++;
									$split_ph=explode('(', $row['test_name_method']);
									$ph_test_name=$split_ph[0];
									$table.="<tr>
									<td>pH(Drop Test Method)</td>
									<td>Left:".$row_for_qc['ph_left_value'].' Center:'.$row_for_qc['ph_center_value'].' Right:'.$row_for_qc['ph_right_value'].' '.$row_for_defining_process['uom_of_ph']."</td>	
									<td>".$row_for_defining_process['ph_min_value'].' to '.$row_for_defining_process['ph_max_value']."</td>
									<td>Pass</td>
									</tr>";
								}
								else {
									$f++;
									$split_ph=explode('(', $row['test_name_method']);
									$ph_test_name=$split_ph[0];
									$table.="<tr>
									<td>pH(Drop Test Method)</td>
									<td>Left:".$row_for_qc['ph_left_value'].' Center:'.$row_for_qc['ph_center_value'].' Right:'.$row_for_qc['ph_right_value'].' '.$row_for_defining_process['uom_of_ph']."</td>	
									<td>".$row_for_defining_process['ph_min_value'].' to '.$row_for_defining_process['ph_max_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
								}
							
						   } 

    $table.="</tbody>
              </table>";
    $table.="<label> Remarks: ".$row_for_qc['remarks']."</label></div>";

	echo $table;
     
?>

<script>
		$('#scouring_bleaching_table').show();
</script>