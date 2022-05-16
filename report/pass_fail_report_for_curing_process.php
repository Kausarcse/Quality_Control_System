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
$table="<div id='curing_table' style='display:none'>
<table class='table table-bordered' >
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_curing_process="select * from defining_qc_standard_for_curing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	// $sql_for_curing_process="select * from defining_qc_standard_for_curing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_curing_process=mysqli_query($con,$sql_for_curing_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($report_for_curing_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/


	$sql_for_curing_process_qc_result="select * from qc_result_for_curing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
    
		
	// $sql_for_curing_process_qc_result="select * from qc_result_for_curing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_curing_process_qc=mysqli_query($con,$sql_for_curing_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($report_for_curing_process_qc);


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

                    /*if (in_array($row['id'], ['1','240','105','164','207','247','259','298']))*/
                    if (in_array($row['id'], ['1']))
					 {
						if ($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) 

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
									<td >".$row['test_name_method'].' (Dry)'."</td>
									<td>".$cf_to_rubbing_dry_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
									
									<td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}
													
						}

						if ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0  && $row_for_qc['cf_to_rubbing_wet_value']<>0) 
						{
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
									
									<td>".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}
						}
						 
					 }      /* End of if (in_array($row['id'], ['1','240','105','164','207','247','259','298']))*/


					if (in_array($row['id'], ['2']))
					{

						
						if ($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_warp_washing_before_iron_value']<>0) 
						{
                            
                            $total_test++;

							if($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value']<=$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']>=$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'])
							{
								$p++;

								 $table.="<tr>
									<td>".$row['test_name_method']. '(Before Iron-Warp)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								
								 $table.="<tr>
									<td>".$row['test_name_method']. '(Before Iron-Warp)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

						}

						if ($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_weft_washing_before_iron_value']<>0) 

							{
								$total_test++;
	
								if($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value']<=$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']>=$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'])
								{
									$p++;
	
									 $table.="<tr>
										<td>".$row['test_name_method'].'(Before Iron-Weft)'."</td>
										<td>".$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
										
										<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
										<td>Pass</td>
										</tr>";
								}
								else {
									$f++;
	
									 $table.="<tr>
										<td>".$row['test_name_method'].'(Before Iron-Weft)'."</td>
										<td>".$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
										
										<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
								}			
	
							}


					if ($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_warp_washing_after_iron_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value']<=$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']>=$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'])
							{
								$p++;

								$table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Warp)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else 
							{
								$f++;

								

									$table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Warp)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

						}

						if ($row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_weft_washing_after_iron_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value']<=$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']>=$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'])
							{
								$p++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Weft)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Weft)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

						}


					}
					if (in_array($row['id'], ['74']))
					{
						
						if ($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['warp_yarn_count_min_value']<=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['warp_yarn_count_max_value']>=$row_for_qc['warp_yarn_count_value'])
							{
								$p++;
								$table.="<tr>
								<td>".$row['test_name_method'].'(Dry)'."</td>
								<td>".$row_for_qc['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
								<td>".$row_for_defining_process['warp_yarn_count_value'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%</td>
								<td>Pass</td>
								</tr>";
							}
							else 
							{
								$f++;
		
								$table.="<tr>
									<td>".$row['test_name_method'].' (Dry)'."</td>
									<td>".$row_for_qc['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
									<td>".$row_for_defining_process['warp_yarn_count_value'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

						}

						if ($row_for_defining_process['weft_yarn_count_max_value']<>0 && $row_for_qc['weft_yarn_count_value']<>0) 
						{
							$total_test++;

							if($row_for_defining_process['weft_yarn_count_min_value']<=$row_for_qc['weft_yarn_count_value'] && $row_for_defining_process['weft_yarn_count_max_value']>=$row_for_qc['weft_yarn_count_value'])
							{
								$p++;
								$table.="<tr>
								<td>".$row['test_name_method'].'(Weft)'."</td>
								<td>".$row_for_qc['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
								<td>".$row_for_defining_process['weft_yarn_count_value'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%</td>
								<td>Pass</td>
								</tr>";
							}
							else 
							{
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].' (Dry)'."</td>
									<td>".$row_for_qc['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
									<td>".$row_for_defining_process['weft_yarn_count_value'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}
						}
					}

					if (in_array($row['id'], ['4']))
					{
						
						if ($row_for_defining_process['no_of_threads_in_warp_max_value']<>0 && $row_for_qc['no_of_threads_in_warp_value']<>0) 
						{
                            
                            $total_test++;

							if($row_for_defining_process['no_of_threads_in_warp_min_value']<=$row_for_qc['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_warp_max_value']>=$row_for_qc['no_of_threads_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
									<td>".$row_for_defining_process['no_of_threads_in_warp_value'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
									<td>".$row_for_defining_process['no_of_threads_in_warp_value'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

						}

							if ($row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc['no_of_threads_in_weft_value']<>0) 
							{
							
							$total_test++;

							if($row_for_defining_process['no_of_threads_in_weft_min_value']<=$row_for_qc['no_of_threads_in_weft_value'] && $row_for_defining_process['no_of_threads_in_weft_max_value']>=$row_for_qc['no_of_threads_in_weft_value'])
							{
								$p++;

								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
									<td>".$row_for_defining_process['no_of_threads_in_weft_value'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
									<td>".$row_for_defining_process['no_of_threads_in_weft_value'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							 

							}

						
					 }

					 if (in_array($row['id'], ['5']))
					 {
						
						if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc['mass_per_unit_per_area_value']<>0) 
						{
                         
                         	$total_test++;

							 if($row_for_defining_process['mass_per_unit_per_area_min_value']<=$row_for_qc['mass_per_unit_per_area_value'] && $row_for_defining_process['mass_per_unit_per_area_max_value']>=$row_for_qc['mass_per_unit_per_area_value'])
							 {
								 $p++;
								 if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
								 {
									 $table.="<tr>
									 <td>".$row['test_name_method']."</td>
									 <td>".$row_for_qc['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value']."</td>
									 <td>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.' &#177; '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
									 <td>Pass</td>
									 </tr>";
								 }
								 else
								 {
									 $table.="<tr>
									 <td>".$row['test_name_method']."</td>
									 <td>".$row_for_qc['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value']."</td>
									 <td>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
									 <td>Pass</td>
									 </tr>";
								 }
 
								 
							 }
							 else 
							 {
								 $f++;
								 if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
								 {
									 $table.="<tr>
									 <td>".$row['test_name_method']."</td>
									 <td >".$row_for_qc['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value']."</td>
									 <td>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.' &#177; '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
									 <td style='color: red;'>Fail</td>
									 </tr>";
								 }
								 else
								 {
									 $table.="<tr>
									 <td>".$row['test_name_method']."</td>
									 <td >".$row_for_qc['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value']."</td>
									 <td>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
									 <td style='color: red;'>Fail</td>
									 </tr>";
								 }
								 
							 }
						}
					}


					if (in_array($row['id'], ['6']))
					{
						
						if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0) 
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

							if($row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['surface_fuzzing_and_pilling_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['surface_fuzzing_and_pilling_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$surface_fuzzing_and_pilling_value.' ' .$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].' '.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									<td>Pass</td>
									</tr>";
							}
							else 
							{
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$surface_fuzzing_and_pilling_value.' ' .$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].' '.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}


						}
					} /* End of if (in_array($row['id'], ['6', '101']))*/

					if (in_array($row['id'], ['7']))
					{
						
						if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0) 
						{
                        
                        	$total_test++;

						 	if($row_for_defining_process['tensile_properties_in_warp_value_min_value']<=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_warp_value_max_value']>=$row_for_qc['tensile_properties_in_warp_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}
						}

						if ($row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['tensile_properties_in_weft_value_min_value']<=$row_for_qc['tensile_properties_in_weft_value'] && $row_for_defining_process['tensile_properties_in_weft_value_max_value']>=$row_for_qc['tensile_properties_in_weft_value'])
							{
								$p++;
								 $table.="<tr>
								 <td>".$row['test_name_method'].'(Weft)'."</td>
								 <td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
								 <td>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
								 <td>Pass</td>
									</tr>";
							}
							else 
							{
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
									<td >".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}
					 }        /*End of if (in_array($row['id'], ['7', '115', '263', '274', '302']))*/
                    

                    if (in_array($row['id'], ['8']))
					 {
						
						if ($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0) {
                        
                        $total_test++;

							if($row_for_defining_process['tear_force_in_warp_value_min_value']<=$row_for_qc['tear_force_in_warp_value'] && $row_for_defining_process['tear_force_in_warp_value_max_value']>=$row_for_qc['tear_force_in_warp_value'])
							{
								$p++;

								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tear_force_in_warp_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
								 	<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
								 	<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td >".$row_for_qc['tear_force_in_warp_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
								 	<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
								 	<td style='color: red;'>Fail</td>
									</tr>";
							}

							 

							}  /*End warp tear force*/

							if ($row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0) {
								$total_test++;

							if($row_for_defining_process['tear_force_in_weft_value_min_value']<=$row_for_qc['tear_force_in_weft_value'] && $row_for_defining_process['tear_force_in_weft_value_max_value']>=$row_for_qc['tear_force_in_weft_value'])
							{
								$p++;
							 	$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
								 	<td>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
								 	<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

							 $table.="<tr>
									<td >".$row['test_name_method'].'(Weft)'."</td>
									<td >".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
								 	<td >".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
								 	<td style='color: red;'>Fail</td>
									</tr>";
							}


							}
					 }  /* End of  if (in_array($row['id'], ['8', '135', '148', '201', '275', '303']))*/

					
					 if (in_array($row['id'], ['21','22', '66']))
					 {
						
						if($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_before_wash_value']<>0)
                        {

                           $total_test++;

						   
						   if($customer_type == 'american')
						   {
							   $resistance_to_surface_wetting_before_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
							   $resistance_to_surface_wetting_before_wash_value = $row_for_qc['resistance_to_surface_wetting_before_wash_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$resistance_to_surface_wetting_before_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
							
							if($resistance_to_surface_wetting_before_wash_tolerance ==1.0)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '1';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==1.5)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '1-2';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==2.0)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '2';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==2.5)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '2-3';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==3.0)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '3';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==3.5)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '3-4';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==4.0)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '4';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==4.5)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '4-5';
							}
							elseif($resistance_to_surface_wetting_before_wash_tolerance ==5.0)
							{
								$resistance_to_surface_wetting_before_wash_tolerance_value = '5';
							}						  // for defining

						   $resistance_to_surface_wetting_before_wash = $row_for_qc['resistance_to_surface_wetting_before_wash_value'];
					   
							   if($resistance_to_surface_wetting_before_wash ==1.0)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '1';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==1.5)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '1-2';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==2.0)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '2';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==2.5)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '2-3';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==3.0)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '3';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==3.5)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '3-4';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==4.0)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '4';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==4.5)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '4-5';
							   }
							   elseif($resistance_to_surface_wetting_before_wash ==5.0)
							   {
								   $resistance_to_surface_wetting_before_wash_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['resistance_to_surface_wetting_before_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_before_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_before_wash_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Before Wash)'."</td>
                              <td>".$resistance_to_surface_wetting_before_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
							  <td>".$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_before_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(Before Wash)'."</td>
                              <td>".$resistance_to_surface_wetting_before_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
							  <td>".$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_before_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                     
                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0)*/

                         if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_one_wash_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $resistance_to_surface_wetting_after_one_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
							   $resistance_to_surface_wetting_after_one_wash_value = $row_for_qc['resistance_to_surface_wetting_after_one_wash_value'];

						   }
					   		if($customer_type == 'european')
						   {
							$resistance_to_surface_wetting_after_one_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
							
							if($resistance_to_surface_wetting_after_one_wash_tolerance ==1.0)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '1';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==1.5)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '1-2';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==2.0)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '2';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==2.5)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '2-3';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==3.0)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '3';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==3.5)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '3-4';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==4.0)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '4';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==4.5)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '4-5';
							}
							elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==5.0)
							{
								$resistance_to_surface_wetting_after_one_wash_tolerance_value = '5';
							}					  // for defining

						   $resistance_to_surface_wetting_after_one_wash = $row_for_qc['resistance_to_surface_wetting_after_one_wash_value'];
					   
							   if($resistance_to_surface_wetting_after_one_wash ==1.0)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '1';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==1.5)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '1-2';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==2.0)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '2';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==2.5)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '2-3';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==3.0)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '3';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==3.5)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '3-4';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==4.0)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '4';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==4.5)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '4-5';
							   }
							   elseif($resistance_to_surface_wetting_after_one_wash ==5.0)
							   {
								   $resistance_to_surface_wetting_after_one_wash_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(After One Wash)'."</td>
                              <td>".$resistance_to_surface_wetting_after_one_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
							  <td>".$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_one_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td >".$row['test_name_method'].'(After One Wash)'."</td>
                              <td >".$resistance_to_surface_wetting_after_one_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
							  <td >".$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_one_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']<>0)*/



                        if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_five_wash_value']<>0)
                        {

                           $total_test++;

						   if($customer_type == 'american')
						   {
							   $resistance_to_surface_wetting_after_five_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
							   $resistance_to_surface_wetting_after_five_wash_value = $row_for_qc['resistance_to_surface_wetting_after_five_wash_value'];

						   }
					   		if($customer_type == 'european')
						   {
							 
							$resistance_to_surface_wetting_after_five_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
							
							if($resistance_to_surface_wetting_after_five_wash_tolerance ==1.0)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '1';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==1.5)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '1-2';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==2.0)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '2';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==2.5)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '2-3';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==3.0)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '3';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==3.5)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '3-4';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==4.0)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '4';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==4.5)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '4-5';
							}
							elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==5.0)
							{
								$resistance_to_surface_wetting_after_five_wash_tolerance_value = '5';
							}																	   // for defining

						   $resistance_to_surface_wetting_after_five_wash = $row_for_qc['resistance_to_surface_wetting_after_five_wash_value'];
					   
							   if($resistance_to_surface_wetting_after_five_wash ==1.0)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '1';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==1.5)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '1-2';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==2.0)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '2';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==2.5)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '2-3';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==3.0)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '3';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==3.5)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '3-4';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==4.0)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '4';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==4.5)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '4-5';
							   }
							   elseif($resistance_to_surface_wetting_after_five_wash ==5.0)
							   {
								   $resistance_to_surface_wetting_after_five_wash_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'])
                           {
                              $p++;
							  $table.="<tr>
							  <td>".$row['test_name_method'].'(After Five Wash)'."</td>
                              <td>".$resistance_to_surface_wetting_after_five_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
							  <td>".$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_five_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
							  <td >".$row['test_name_method'].'(After Five Wash)'."</td>
                              <td>".$resistance_to_surface_wetting_after_five_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
							  <td >".$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_five_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

        
                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0)*/


					 } /*End of if (in_array($row['id'], ['21', '206', '22', '66']))*/


					 if (in_array($row['id'], ['32']))
					 {
                        if($row_for_defining_process['formaldehyde_content_max_value']<>0 && $row_for_qc['formaldehyde_content_value']<>0)
                        {

                           $total_test++;
                           if(($row_for_defining_process['formaldehyde_content_min_value']<=$row_for_qc['formaldehyde_content_value'] && $row_for_defining_process['formaldehyde_content_max_value']>=$row_for_qc['formaldehyde_content_value']) ||  $row_for_qc['formaldehyde_content_value']=='N.D.' )
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method']."</td>
							  <td>".$row_for_qc['formaldehyde_content_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
							  <td>".$row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'].' '.$row_for_defining_process['formaldehyde_content_tolerance_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
							  <td>Pass</td>
							  </tr>";
                           }
                           else {
                              $f++;
							  $table.="<tr>
                              <td >".$row['test_name_method']."</td>
							  <td>".$row_for_qc['formaldehyde_content_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
							  <td>".$row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'].' '.$row_for_defining_process['formaldehyde_content_tolerance_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
							  <td style='color: red;'>Fail</td>
							  </tr>";
                           }

                                 
                        }    /*End of if($row_for_defining_process['formaldehyde_content_max_value']<>0)*/

					 } /* end of if (in_array($row['id'], ['32', '118', '170', '77', '235', '258']))*/
                       

                        
                      
					 if (in_array($row['id'], ['37']))
					 { 

	                     if($row_for_defining_process['smoothness_appearance_max_value']<>0 && $row_for_qc['smoothness_appearance_value']<>0)
	                        {
	                           $total_test++;
		                           if($row_for_defining_process['smoothness_appearance_min_value']<=$row_for_qc['smoothness_appearance_value'] && $row_for_defining_process['smoothness_appearance_max_value']>=$row_for_qc['smoothness_appearance_value'])
				                     {
				                        $p++;
										$table.="<tr>
										<td>".$row['test_name_method'].' ('.$row_for_defining_process['smoothness_appearance_tolerance_washing_cycle'].')'."</td>
										<td>".$row_for_qc['smoothness_appearance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
										<td>".$row_for_defining_process['smoothness_appearance_tolerance_range_math_op'].' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
										<td>Pass</td>
										</tr>";
				                     }
				                     else {
				                        $f++;
										$table.="<tr>
										<td>".$row['test_name_method'].' ('.$row_for_defining_process['smoothness_appearance_tolerance_washing_cycle'].')'."</td>
										<td>".$row_for_qc['smoothness_appearance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
										<td >".$row_for_defining_process['smoothness_appearance_tolerance_range_math_op'].' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
				                     }

				                  
				           }  /*ENd of ($row_for_defining_process['smoothness_appearance_max_value']<>0) */

	                 }   /*End of if (in_array($row['id'], ['37', '282', '82', '37', '267']))*/

					 if (in_array($row['id'], ['3']))
					{ 

						if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
						{
							if($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 && $row_for_qc['appear_after_wash_fabric_color_change_value']<>0)
						   {
							  $total_test++;
							 
							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_color_change_tolerance_value'];
								  $appear_after_wash_fabric_color_change_value = $row_for_qc['appear_after_wash_fabric_color_change_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							    $appearance_after_washing_fabric_color_change_tolerance = $row_for_defining_process['appearance_after_washing_fabric_color_change_tolerance_value'];
							
							  if($appearance_after_washing_fabric_color_change_tolerance ==1.0)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '1';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==1.5)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '1-2';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==2.0)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '2';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==2.5)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '2-3';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==3.0)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '3';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==3.5)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '3-4';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==4.0)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '4';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==4.5)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '4-5';
							  }
							  elseif($appearance_after_washing_fabric_color_change_tolerance ==5.0)
							  {
								  $appearance_after_washing_fabric_color_change_tolerance_value = '5';
							  }
	
	
	
							  $appear_after_wash_fabric_color_change = $row_for_qc['appear_after_wash_fabric_color_change_value'];
						  
								  if($appear_after_wash_fabric_color_change ==1.0)
								  {
									  $appear_after_wash_fabric_color_change_value = '1';
								  }
								  elseif($appear_after_wash_fabric_color_change ==1.5)
								  {
									  $appear_after_wash_fabric_color_change_value = '1-2';
								  }
								  elseif($appear_after_wash_fabric_color_change ==2.0)
								  {
									  $appear_after_wash_fabric_color_change_value = '2';
								  }
								  elseif($appear_after_wash_fabric_color_change ==2.5)
								  {
									  $appear_after_wash_fabric_color_change_value = '2-3';
								  }
								  elseif($appear_after_wash_fabric_color_change ==3.0)
								  {
									  $appear_after_wash_fabric_color_change_value = '3';
								  }
								  elseif($appear_after_wash_fabric_color_change ==3.5)
								  {
									  $appear_after_wash_fabric_color_change_value = '3-4';
								  }
								  elseif($appear_after_wash_fabric_color_change ==4.0)
								  {
									  $appear_after_wash_fabric_color_change_value = '4';
								  }
								  elseif($appear_after_wash_fabric_color_change ==4.5)
								  {
									  $appear_after_wash_fabric_color_change_value = '4-5';
								  }
								  elseif($appear_after_wash_fabric_color_change ==5.0)
								  {
									  $appear_after_wash_fabric_color_change_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_fabric_color_change_min_value']<=$row_for_qc['appear_after_wash_fabric_color_change_value'] && $row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']>=$row_for_qc['appear_after_wash_fabric_color_change_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Color Change))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appear_after_wash_fabric_color_change_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'].' '.$appearance_after_washing_fabric_color_change_tolerance_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Fabric (Color Change))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td >".$appear_after_wash_fabric_color_change_value."</td>
									   <td >".$row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'].' '.$appearance_after_washing_fabric_color_change_tolerance_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0) */
						
						if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_cross_staining_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
								  $appearance_after_washing_fabric_cross_staining_value = $row_for_qc['appearance_after_washing_fabric_cross_staining_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							    $appearance_after_washing_fabric_cross_staining_tolerance = $row_for_defining_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];

							  if($appearance_after_washing_fabric_cross_staining_tolerance ==1.0)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '1';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==1.5)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '1-2';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==2.0)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '2';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==2.5)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '2-3';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==3.0)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '3';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==3.5)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '3-4';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==4.0)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '4';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==4.5)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '4-5';
							  }
							  elseif($appearance_after_washing_fabric_cross_staining_tolerance ==5.0)
							  {
								  $appearance_after_washing_fabric_cross_staining_tolerance_value = '5';
							  }
	
	
							  $appearance_after_washing_fabric_cross_staining = $row_for_qc['appearance_after_washing_fabric_cross_staining_value'];
						  
								  if($appearance_after_washing_fabric_cross_staining ==1.0)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '1';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==1.5)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '1-2';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==2.0)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '2';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==2.5)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '2-3';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==3.0)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '3';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==3.5)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '3-4';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==4.0)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '4';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==4.5)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '4-5';
								  }
								  elseif($appearance_after_washing_fabric_cross_staining ==5.0)
								  {
									  $appearance_after_washing_fabric_cross_staining_value = '5';
								  } 				// for test result
   
						  }
								  if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_cross_staining_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'].' '.$appearance_after_washing_fabric_cross_staining_tolerance_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_cross_staining_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'].' '.$appearance_after_washing_fabric_cross_staining_tolerance_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0) */
						if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
								  $appearance_after_washing_fabric_surface_fuzzing_value = $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							    $appearance_after_washing_fabric_surface_fuzzing_tolerance = $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];

							  if($appearance_after_washing_fabric_surface_fuzzing_tolerance ==1.0)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '1';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==1.5)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '1-2';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==2.0)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '2';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==2.5)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '2-3';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==3.0)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '3';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==3.5)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '3-4';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==4.0)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '4';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==4.5)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '4-5';
							  }
							  elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==5.0)
							  {
								  $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '5';
							  }
	
	
							  $appearance_after_washing_fabric_surface_fuzzing = $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'];
						  
								  if($appearance_after_washing_fabric_surface_fuzzing ==1.0)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '1';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==1.5)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '1-2';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==2.0)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '2';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==2.5)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '2-3';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==3.0)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '3';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==3.5)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '3-4';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==4.0)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '4';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==4.5)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '4-5';
								  }
								  elseif($appearance_after_washing_fabric_surface_fuzzing ==5.0)
								  {
									  $appearance_after_washing_fabric_surface_fuzzing_value = '5';
								  } 				// for test result
   
						  }
								  if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_surface_fuzzing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'].' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_surface_fuzzing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'].' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_surface_pilling_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
								  $appearance_after_washing_fabric_surface_pilling_value = $row_for_qc['appearance_after_washing_fabric_surface_pilling_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							     
							  $appearance_after_washing_fabric_surface_pilling_tolerance = $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];

							  if($appearance_after_washing_fabric_surface_pilling_tolerance ==1.0)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '1';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==1.5)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '1-2';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==2.0)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '2';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==2.5)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '2-3';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==3.0)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '3';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==3.5)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '3-4';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==4.0)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '4';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==4.5)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '4-5';
							  }
							  elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==5.0)
							  {
								  $appearance_after_washing_fabric_surface_pilling_tolerance_value = '5';
							  }

	
							  $appearance_after_washing_fabric_surface_pilling = $row_for_qc['appearance_after_washing_fabric_surface_pilling_value'];
						  
								  if($appearance_after_washing_fabric_surface_pilling ==1.0)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '1';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==1.5)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '1-2';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==2.0)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '2';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==2.5)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '2-3';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==3.0)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '3';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==3.5)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '3-4';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==4.0)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '4';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==4.5)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '4-5';
								  }
								  elseif($appearance_after_washing_fabric_surface_pilling ==5.0)
								  {
									  $appearance_after_washing_fabric_surface_pilling_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_surface_pilling_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'].' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_surface_pilling_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'].' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0  && $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_crease_before_iron_tolerance_val = $row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
								  $appearance_after_washing_fabric_crease_before_ironing_value = $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							     
								$appearance_after_washing_fabric_crease_before_iron_tolerance = $row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];

								if($appearance_after_washing_fabric_crease_before_iron_tolerance ==1.0)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '1';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==1.5)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '1-2';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==2.0)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '2';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==2.5)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '2-3';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==3.0)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '3';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==3.5)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '3-4';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==4.0)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '4';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==4.5)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '4-5';
								}
								elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==5.0)
								{
									$appearance_after_washing_fabric_crease_before_iron_tolerance_val = '5';
								}
	
							  $appearance_after_washing_fabric_crease_before_ironing = $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'];
						  
								  if($appearance_after_washing_fabric_crease_before_ironing ==1.0)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '1';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==1.5)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '1-2';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==2.0)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '2';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==2.5)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '2-3';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==3.0)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '3';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==3.5)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '3-4';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==4.0)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '4';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==4.5)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '4-5';
								  }
								  elseif($appearance_after_washing_fabric_crease_before_ironing ==5.0)
								  {
									  $appearance_after_washing_fabric_crease_before_ironing_value = '5';
								  } 				// for test result
   
						  }



								  if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Crease before ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_crease_before_ironing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'].' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Crease before ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_crease_before_ironing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'].' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0  && $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_fabric_crease_after_iron_tolerance_val = $row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];
								  $appearance_after_washing_fabric_crease_after_ironing_value = $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							     
								$appearance_after_washing_fabric_crease_after_iron_tolerance = $row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];

								if($appearance_after_washing_fabric_crease_after_iron_tolerance ==1.0)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '1';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==1.5)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '1-2';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==2.0)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '2';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==2.5)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '2-3';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==3.0)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '3';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==3.5)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '3-4';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==4.0)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '4';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==4.5)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '4-5';
								}
								elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==5.0)
								{
									$appearance_after_washing_fabric_crease_after_iron_tolerance_val = '5';
								}


							  $appearance_after_washing_fabric_crease_after_ironing = $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'];
						  
								  if($appearance_after_washing_fabric_crease_after_ironing ==1.0)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '1';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==1.5)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '1-2';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==2.0)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '2';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==2.5)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '2-3';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==3.0)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '3';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==3.5)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '3-4';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==4.0)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '4';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==4.5)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '4-5';
								  }
								  elseif($appearance_after_washing_fabric_crease_after_ironing ==5.0)
								  {
									  $appearance_after_washing_fabric_crease_after_ironing_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Crease after ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_crease_after_ironing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'].' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Crease after ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$appearance_after_washing_fabric_crease_after_ironing_value."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'].' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Loss of Print))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_fabric_loss_of_print_value']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_loss_of_print_fabric']."</td>
									   <td>Pass</td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Abrasive Mark))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']."</td>
									   <td>Pass</td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>0) */

						if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Odor))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_fabric_odor_value']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_odor_fabric']."</td>
									   <td>Pass</td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_odor_fabric']<>0) */
						
						if($row_for_defining_process['appearance_after_washing_other_observation_fabric']<>'' && $row_for_qc['appearance_after_washing_other_observation_fabric']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Fabric (Other observation))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_other_observation_fabric']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_other_observation_fabric']."</td>
									   <td>Pass</td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_odor_fabric']<>0) */
					}
					
					if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')

						{
							if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0 && $row_for_qc['appear_after_wash_garments_color_change_without_sup_value']<>0)
						   {
							  $total_test++;
							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments_color_change_without_sup_toler_val = $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_toler_val'];
								  $appear_after_wash_garments_color_change_without_sup_value = $row_for_qc['appear_after_wash_garments_color_change_without_sup_value'];
   
							  }
							  if($customer_type == 'european')
							  {
							     
							
								$appear_after_washing_garments_color_change_without_sup_toler = $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_toler_val'];

								if($appear_after_washing_garments_color_change_without_sup_toler ==1.0)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '1';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==1.5)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '1-2';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==2.0)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '2';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==2.5)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '2-3';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==3.0)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '3';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==3.5)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '3-4';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==4.0)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '4';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==4.5)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '4-5';
								}
								elseif($appear_after_washing_garments_color_change_without_sup_toler ==5.0)
								{
									$appear_after_washing_garments_color_change_without_sup_toler_val = '5';
								}

							  $appear_after_wash_garments_color_change_without_sup = $row_for_qc['appear_after_wash_garments_color_change_without_sup_value'];
						  
								  if($appear_after_wash_garments_color_change_without_sup ==1.0)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '1';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==1.5)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '1-2';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==2.0)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '2';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==2.5)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '2-3';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==3.0)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '3';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==3.5)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '3-4';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==4.0)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '4';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==4.5)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '4-5';
								  }
								  elseif($appear_after_wash_garments_color_change_without_sup ==5.0)
								  {
									  $appear_after_wash_garments_color_change_without_sup_value = '5';
								  } 				// for test result
   
						  }


								  if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']>=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Color Change(Without Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appear_after_wash_garments_color_change_without_sup_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'].' '.$appear_after_washing_garments_color_change_without_sup_toler_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '((Garments(Color Change(Without Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appear_after_wash_garments_color_change_without_sup_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'].' '.$appear_after_washing_garments_color_change_without_sup_toler_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0) */

						if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0 && $row_for_qc['appear_after_wash_garments_color_change_with_sup_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments_color_change_with_sup_toler_value = $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
								  $appear_after_wash_garments_color_change_with_sup_value = $row_for_qc['appear_after_wash_garments_color_change_with_sup_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								$appear_after_washing_garments_color_change_with_sup_toler = $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_toler_value'];

								if($appear_after_washing_garments_color_change_with_sup_toler ==1.0)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '1';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==1.5)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '1-2';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==2.0)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '2';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==2.5)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '2-3';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==3.0)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '3';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==3.5)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '3-4';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==4.0)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '4';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==4.5)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '4-5';
								}
								elseif($appear_after_washing_garments_color_change_with_sup_toler ==5.0)
								{
									$appear_after_washing_garments_color_change_with_sup_toler_value = '5';
								}


							  $appear_after_wash_garments_color_change_with_sup = $row_for_qc['appear_after_wash_garments_color_change_with_sup_value'];
						  
								  if($appear_after_wash_garments_color_change_with_sup ==1.0)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '1';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==1.5)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '1-2';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==2.0)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '2';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==2.5)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '2-3';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==3.0)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '3';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==3.5)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '3-4';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==4.0)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '4';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==4.5)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '4-5';
								  }
								  elseif($appear_after_wash_garments_color_change_with_sup ==5.0)
								  {
									  $appear_after_wash_garments_color_change_with_sup_value = '5';
								  } 				// for test result
   
						  }
								  if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']>=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Color Change(With Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appear_after_wash_garments_color_change_with_sup_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'].' '.$appear_after_washing_garments_color_change_with_sup_toler_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '((Garments(Color Change(With Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appear_after_wash_garments_color_change_with_sup_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'].' '.$appear_after_washing_garments_color_change_with_sup_toler_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_cross_staining_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments_cross_staining_tolerance_value = $row_for_defining_process['appear_after_washing_garments_cross_staining_tolerance_value'];
								  $appearance_after_washing_garments_cross_staining_value = $row_for_qc['appearance_after_washing_garments_cross_staining_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								$appear_after_washing_garments_cross_staining_tolerance = $row_for_defining_process['appear_after_washing_garments_cross_staining_tolerance_value'];

								if($appear_after_washing_garments_cross_staining_tolerance ==1.0)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '1';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==1.5)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '1-2';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==2.0)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '2';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==2.5)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '2-3';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==3.0)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '3';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==3.5)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '3-4';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==4.0)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '4';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==4.5)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '4-5';
								}
								elseif($appear_after_washing_garments_cross_staining_tolerance ==5.0)
								{
									$appear_after_washing_garments_cross_staining_tolerance_value = '5';
								}


							  $appearance_after_washing_garments_cross_staining = $row_for_qc['appearance_after_washing_garments_cross_staining_value'];
						  
								  if($appearance_after_washing_garments_cross_staining ==1.0)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '1';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==1.5)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '1-2';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==2.0)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '2';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==2.5)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '2-3';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==3.0)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '3';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==3.5)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '3-4';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==4.0)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '4';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==4.5)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '4-5';
								  }
								  elseif($appearance_after_washing_garments_cross_staining ==5.0)
								  {
									  $appearance_after_washing_garments_cross_staining_value = '5';
								  } 				// for test result
   
						  }


								  if($row_for_defining_process['appearance_after_washing_garments_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_garments_cross_staining_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_cross_staining_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'].' '.$appear_after_washing_garments_cross_staining_tolerance_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Garments (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_cross_staining_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'].' '.$appear_after_washing_garments_cross_staining_tolerance_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value']<>0)
						   {
							  $total_test++;


							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments__differential_shrink_tolerance_val = $row_for_defining_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
								  $appearance_after_washing_garments_differential_shrinkage_value = $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								$appear_after_washing_garments__differential_shrink_tolerance = $row_for_defining_process['appear_after_washing_garments__differential_shrink_tolerance_val'];

								if($appear_after_washing_garments__differential_shrink_tolerance ==1.0)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '1';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==1.5)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '1-2';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==2.0)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '2';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==2.5)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '2-3';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==3.0)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '3';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==3.5)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '3-4';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==4.0)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '4';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==4.5)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '4-5';
								}
								elseif($appear_after_washing_garments__differential_shrink_tolerance ==5.0)
								{
									$appear_after_washing_garments__differential_shrink_tolerance_val = '5';
								}
  

							  $appearance_after_washing_garments_differential_shrinkage = $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'];
						  
								  if($appearance_after_washing_garments_differential_shrinkage ==1.0)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '1';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==1.5)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '1-2';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==2.0)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '2';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==2.5)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '2-3';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==3.0)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '3';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==3.5)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '3-4';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==4.0)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '4';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==4.5)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '4-5';
								  }
								  elseif($appearance_after_washing_garments_differential_shrinkage ==5.0)
								  {
									  $appearance_after_washing_garments_differential_shrinkage_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_min_value']<=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']>=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Differential Shrinking))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_differential_shrinkage_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_differential_shrink_math_op'].' '.$appear_after_washing_garments__differential_shrink_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Garments (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td >".$appearance_after_washing_garments_differential_shrinkage_value."</td>
									   <td >".$row_for_defining_process['appear_after_washing_garments_differential_shrink_math_op'].' '.$appear_after_washing_garments__differential_shrink_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_garments_surface_fuzzing_tolerance_val = $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];
								  $appearance_after_washing_garments_surface_fuzzing_value = $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								$appearance_after_washing_garments_surface_fuzzing_tolerance = $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];

								if($appearance_after_washing_garments_surface_fuzzing_tolerance ==1.0)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '1';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==1.5)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '1-2';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==2.0)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '2';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==2.5)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '2-3';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==3.0)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '3';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==3.5)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '3-4';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==4.0)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '4';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==4.5)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '4-5';
								}
								elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==5.0)
								{
									$appearance_after_washing_garments_surface_fuzzing_tolerance_val = '5';
								}
  

							  $appearance_after_washing_garments_surface_fuzzing = $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'];
						  
								  if($appearance_after_washing_garments_surface_fuzzing ==1.0)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '1';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==1.5)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '1-2';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==2.0)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '2';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==2.5)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '2-3';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==3.0)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '3';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==3.5)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '3-4';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==4.0)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '4';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==4.5)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '4-5';
								  }
								  elseif($appearance_after_washing_garments_surface_fuzzing ==5.0)
								  {
									  $appearance_after_washing_garments_surface_fuzzing_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_surface_fuzzing_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'].' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td >".$appearance_after_washing_garments_surface_fuzzing_value."</td>
									   <td >".$row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'].' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_surface_pilling_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appearance_after_washing_garments_surface_pilling_tolerance_val = $row_for_defining_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
								  $appearance_after_washing_garments_surface_pilling_value = $row_for_qc['appearance_after_washing_garments_surface_pilling_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								
								$appearance_after_washing_garments_surface_pilling_tolerance = $row_for_defining_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];

								if($appearance_after_washing_garments_surface_pilling_tolerance ==1.0)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '1';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==1.5)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '1-2';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==2.0)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '2';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==2.5)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '2-3';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==3.0)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '3';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==3.5)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '3-4';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==4.0)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '4';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==4.5)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '4-5';
								}
								elseif($appearance_after_washing_garments_surface_pilling_tolerance ==5.0)
								{
									$appearance_after_washing_garments_surface_pilling_tolerance_val = '5';
								}
  
							  $appearance_after_washing_garments_surface_pilling = $row_for_qc['appearance_after_washing_garments_surface_pilling_value'];
						  
								  if($appearance_after_washing_garments_surface_pilling ==1.0)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '1';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==1.5)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '1-2';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==2.0)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '2';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==2.5)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '2-3';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==3.0)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '3';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==3.5)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '3-4';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==4.0)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '4';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==4.5)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '4-5';
								  }
								  elseif($appearance_after_washing_garments_surface_pilling ==5.0)
								  {
									  $appearance_after_washing_garments_surface_pilling_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_surface_pilling_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'].' '.$appearance_after_washing_garments_surface_pilling_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td >".$appearance_after_washing_garments_surface_pilling_value."</td>
									   <td >".$row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'].' '.$appearance_after_washing_garments_surface_pilling_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value']<>0)
						   {
							  $total_test++;

							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments_crease_after_ironing_tolerance_val = $row_for_defining_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];
								  $appearance_after_washing_garments_crease_after_ironing_value = $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'];
   
							  }
							  if($customer_type == 'european')
							  {
								
								$appear_after_washing_garments_crease_after_ironing_tolerance = $row_for_defining_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];

								if($appear_after_washing_garments_crease_after_ironing_tolerance ==1.0)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '1';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==1.5)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '1-2';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==2.0)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '2';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==2.5)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '2-3';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==3.0)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '3';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==3.5)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '3-4';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==4.0)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '4';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==4.5)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '4-5';
								}
								elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==5.0)
								{
									$appear_after_washing_garments_crease_after_ironing_tolerance_val = '5';
								}
  
  
							  $appearance_after_washing_garments_crease_after_ironing = $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'];
						  
								  if($appearance_after_washing_garments_crease_after_ironing ==1.0)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '1';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==1.5)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '1-2';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==2.0)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '2';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==2.5)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '2-3';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==3.0)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '3';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==3.5)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '3-4';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==4.0)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '4';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==4.5)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '4-5';
								  }
								  elseif($appearance_after_washing_garments_crease_after_ironing ==5.0)
								  {
									  $appearance_after_washing_garments_crease_after_ironing_value = '5';
								  } 				// for test result
   
						  }

								  if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Crease After Ironing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_crease_after_ironing_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'].' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Garments Crease After Ironing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_crease_after_ironing_value."</td>
									   <td>".$row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'].' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Abrasive Mark))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_abrasive_mark_value']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_garments_abrasive_mark']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>0) */

						if($row_for_defining_process['seam_breakdown_garments']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Seam Breakdown))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_seam_breakdown_value']."</td>
									   <td>".$row_for_defining_process['seam_breakdown_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['seam_breakdown_garments']<>0) */

						


						if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir']<>0)
						   {
							  $total_test++;

							  	  
							  if($customer_type == 'american')
							  {
								  $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];
								  $appearance_after_washing_garments_seam_puckering_roping_after_ir = $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'];
   
							  }
							  if($customer_type == 'european')
							  {
								
								$appear_after_washing_garments_seam_pucker_rop_iron_toler = $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];

								if($appear_after_washing_garments_seam_pucker_rop_iron_toler ==1.0)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '1';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==1.5)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '1-2';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==2.0)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '2';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==2.5)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '2-3';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==3.0)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '3';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==3.5)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '3-4';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==4.0)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '4';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==4.5)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '4-5';
								}
								elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==5.0)
								{
									$appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '5';
								}
  
  
							  $appearance_after_washing_garments_seam_puckering_roping_after = $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'];
						  
								  if($appearance_after_washing_garments_seam_puckering_roping_after ==1.0)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '1';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==1.5)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '1-2';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==2.0)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '2';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==2.5)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '2-3';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==3.0)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '3';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==3.5)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '3-4';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==4.0)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '4';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==4.5)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '4-5';
								  }
								  elseif($appearance_after_washing_garments_seam_puckering_roping_after ==5.0)
								  {
									  $appearance_after_washing_garments_seam_puckering_roping_after_ir = '5';
								  } 				// for test result
   
						  }


								  if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value']<=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']>=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Seam puckering/roping After Iron))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$appearance_after_washing_garments_seam_puckering_roping_after_ir."</td>
									   <td>".$row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'].' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Garments(Seam puckering/roping After Iron))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td >".$appearance_after_washing_garments_seam_puckering_roping_after_ir."</td>
									   <td>".$row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'].' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0) */

						if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Detachment of interlinings/fused components))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']."</td>
									   <td>".$row_for_defining_process['detachment_of_interlinings_fused_components_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>0) */

						if($row_for_defining_process['change_id_handle_or_appearance']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Change in handle or appearance))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_change_in_handle_value']."</td>
									   <td>".$row_for_defining_process['change_id_handle_or_appearance']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['change_id_handle_or_appearance']<>0) */

						if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Effect on accessories such as buttons, zips etc.))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_effect_accessories_value']."</td>
									   <td>".$row_for_defining_process['effect_on_accessories_such_as_buttons']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['effect_on_accessories_such_as_buttons']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
						   {
							  $total_test++;
								  if($row_for_defining_process['appearance_after_washing_garments_spirality_min_value']<=$row_for_qc['appearance_after_washing_garments_spirality_value'] && $row_for_defining_process['appearance_after_washing_garments_spirality_max_value']>=$row_for_qc['appearance_after_washing_garments_spirality_value'])
									{
									   $p++;
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Spirality(%)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_spirality_value']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'].' to '.$row_for_defining_process['appearance_after_washing_garments_spirality_max_value']."</td>
									   <td>Pass</td>
									   </tr>";
									}
									else {
									   $f++;
									   $table.="<tr>
									   <td >".$row['test_name_method']. '(Garments(Spirality(%)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td >".$row_for_qc['appearance_after_washing_garments_spirality_value']."</td>
									   <td >".$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'].' to '.$row_for_defining_process['appearance_after_washing_garments_spirality_max_value']."</td>
									   <td style='color: red;'>Fail</td>
									   </tr>";
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0) */

						if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments(Detachment/Fraying of ribbons/trims))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']."</td>
									   <td>".$row_for_defining_process['detachment_or_fraying_of_ribbons']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['detachment_or_fraying_of_ribbons']<>0) */

						if($row_for_defining_process['loss_of_print_garments']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Loss of Print))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_loss_of_print_value']."</td>
									   <td>".$row_for_defining_process['loss_of_print_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['loss_of_print_garments']<>0) */

						if($row_for_defining_process['care_level_garments']<>0)
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Care Level))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_care_level_value']."</td>
									   <td>".$row_for_defining_process['care_level_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['care_level_garments']<>0) */

						if($row_for_defining_process['odor_garments']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Odor)('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_garments_odor_value']."</td>
									   <td>".$row_for_defining_process['odor_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_other_observation_garments']<>0) */

						if($row_for_defining_process['appearance_after_washing_other_observation_garments']<>'' && $row_for_qc['appearance_after_washing_other_observation_garments']<>'')
						   {
							 
									   $table.="<tr>
									   <td>".$row['test_name_method']. '(Garments (Other observation)('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')'."</td>
									   <td>".$row_for_qc['appearance_after_washing_other_observation_garments']."</td>
									   <td>".$row_for_defining_process['appearance_after_washing_other_observation_garments']."</td>
									   <td></td>
									   </tr>";
									
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_other_observation_garments']<>0) */

					}

						





					}   /*End of if (in_array($row['id'], ['3']))*/

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
							 <td>".$row_for_defining_process['ph_value_min_value'].' to  '.$row_for_defining_process['ph_value_max_value']."</td>
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
                    
                         
				  }    /*End of  while( $row = mysqli_fetch_array( $result))*/


			
					

    $table.="</tbody>
              </table>";

    $table.="<label> Remarks: ".$row_for_qc['remarks']."</label>  </div>";

    echo $table;
     
?>


<script>
	$('#curing_table').show();
</script>