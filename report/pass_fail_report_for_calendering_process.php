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

$table="<div id='calender_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_calendering_process="select * from defining_qc_standard_for_calendering_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

    

	// $sql_for_calendering_process="select * from defining_qc_standard_for_calendering_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_calendering_process=mysqli_query($con,$sql_for_calendering_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($report_for_calendering_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/


	$sql_for_calendering_process_qc_result="select * from qc_result_for_calendering_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
    
		
	// $sql_for_calendering_process_qc_result="select * from qc_result_for_calendering_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_calendering_process_qc=mysqli_query($con,$sql_for_calendering_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($report_for_calendering_process_qc);


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
									
									<td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].''.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].' (Dry)'."</td>
									<td>".$cf_to_rubbing_dry_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
									
									<td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].''.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
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
									
									<td>".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].''.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].' (Wet)'."</td>
									<td>".$cf_to_rubbing_wet_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
									
									<td>".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].''.$cf_to_rubbing_wet_tolerance_value.''.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
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
									<td>".$row['test_name_method']. '(Before Iron-Warp)('.$row_for_defining_process['washing_cycle_for_warp_for_washing_before_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(Before Iron-Warp)('.$row_for_defining_process['washing_cycle_for_warp_for_washing_before_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
									
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
									<td>".$row['test_name_method'].'(Before Iron-Weft)('.$row_for_defining_process['washing_cycle_for_weft_for_washing_before_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>

									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(Before Iron-Weft)('.$row_for_defining_process['washing_cycle_for_weft_for_washing_before_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>

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
									<td>".$row['test_name_method'].'(After Iron-Warp)('.$row_for_defining_process['washing_cycle_for_warp_for_washing_after_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								

									$table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Warp)('.$row_for_defining_process['washing_cycle_for_warp_for_washing_after_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron']."</td>
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
									<td>".$row['test_name_method'].'(After Iron-Weft)('.$row_for_defining_process['washing_cycle_for_weft_for_washing_after_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(After Iron-Weft)('.$row_for_defining_process['washing_cycle_for_weft_for_washing_after_iron'].' Wash)'."</td>
									<td>".$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									
									<td>".$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' '.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}

				     }



				     if (in_array($row['id'], ['74']))
					 {
						
						if ($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0) {

							$total_test++;

							if($row_for_defining_process['warp_yarn_count_min_value']<=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['warp_yarn_count_max_value']>=$row_for_qc['warp_yarn_count_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
									
									<td>".$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%)</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
									
									<td>".$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%)</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}

							if ($row_for_defining_process['weft_yarn_count_max_value']<>0  && $row_for_qc['weft_yarn_count_value']<>0) {
								$total_test++;

							if($row_for_defining_process['weft_yarn_count_min_value']<=$row_for_qc['weft_yarn_count_value'] && $row_for_defining_process['weft_yarn_count_max_value']>=$row_for_qc['weft_yarn_count_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
									
									<td>".$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%)</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
									
									<td>".$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%)</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}
					 }



					 if (in_array($row['id'], ['4']))
					 {
						
						if ($row_for_defining_process['no_of_threads_in_warp_max_value']<>0  && $row_for_qc['no_of_threads_in_warp_value']<>0) {
                            
                            $total_test++;

							if($row_for_defining_process['no_of_threads_in_warp_min_value']<=$row_for_qc['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_warp_max_value']>=$row_for_qc['no_of_threads_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
									
									<td>".$row_for_defining_process['no_of_threads_in_warp_value'].' ('.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%)</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
									
									<td>".$row_for_defining_process['no_of_threads_in_warp_value'].' ('.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%)</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}

							if ($row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc['no_of_threads_in_weft_value']<>0) {
							
							$total_test++;

							if($row_for_defining_process['no_of_threads_in_weft_min_value']<=$row_for_qc['no_of_threads_in_weft_value'] && $row_for_defining_process['no_of_threads_in_weft_max_value']>=$row_for_qc['no_of_threads_in_weft_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['no_of_threads_in_weft_value'].' ('.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%)</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['no_of_threads_in_weft_value'].' ('.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%)</td>
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
						
						if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0) {
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
									<td>".$surface_fuzzing_and_pilling_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									
									<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].''.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									<td>Pass</td>
									</tr>";

							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$surface_fuzzing_and_pilling_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>
									
									<td>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].''.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']."</td>

									<td style='color: red;'>Fail</td>
									</tr>";

							}

							
							}
					 } /* End of if (in_array($row['id'], ['6', '101']))*/

					 if (in_array($row['id'], ['7']))
					 {
						
						if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0) {
                        
                        $total_test++;

						 	if($row_for_defining_process['tensile_properties_in_warp_value_min_value']<=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_warp_value_max_value']>=$row_for_qc['tensile_properties_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									
									<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].''.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td>Pass</td>
									</tr>";

							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									
									<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].''.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";

							}

							
							}

							if ($row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) {

							$total_test++;

							if($row_for_defining_process['tensile_properties_in_weft_value_min_value']<=$row_for_qc['tensile_properties_in_weft_value'] && $row_for_defining_process['tensile_properties_in_weft_value_max_value']>=$row_for_qc['tensile_properties_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].''.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].''.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
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
									
									<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].''.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['tear_force_in_warp_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
									
									<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].''.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							 

							}

							if ($row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0) {
								$total_test++;

							if($row_for_defining_process['tear_force_in_weft_value_min_value']<=$row_for_qc['tear_force_in_weft_value'] && $row_for_defining_process['tear_force_in_weft_value_max_value']>=$row_for_qc['tear_force_in_weft_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].''.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
									
									<td>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].''.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}

							

							}
					 }  /* End of  if (in_array($row['id'], ['8', '135', '148', '201', '275', '303']))*/

					 if (in_array($row['id'], ['9']))
					 {
						
						if ($row_for_defining_process['seam_slippage_resistance_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_warp_value']<>0) {
                         
                         $total_test++;
							if($row_for_defining_process['seam_slippage_resistance_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_in_warp_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_in_warp_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
							}



							}

							if ($row_for_defining_process['seam_slippage_resistance_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_weft_value']<>0) {

							$total_test++;
							if($row_for_defining_process['seam_slippage_resistance_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_in_weft_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_in_weft_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
									<td>Fail</td>
									</tr>";
							}



							}
					 }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

					 if (in_array($row['id'], ['9']))
					 {
						
						if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
									<td>Fail</td>
									</tr>";
							}



							}

							if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_weft_value']<>0) {

								$total_test++;

							if($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value'].' to '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
									<td>Fail</td>
									</tr>";
							}

							 

							}
					 }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

					 if (in_array($row['id'], ['11']))
					 {
						
						if ($row_for_defining_process['seam_strength_in_warp_max_value']<>0 && $row_for_qc['seam_strength_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_strength_in_warp_min_value']<=$row_for_qc['seam_strength_in_warp_value'] && $row_for_defining_process['seam_strength_in_warp_max_value']>=$row_for_qc['seam_strength_in_warp_value'])
							{
								$p++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_strength_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_strength_in_warp_min_value'].' to '.$row_for_defining_process['seam_strength_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;

								 $table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_strength_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_strength_in_warp_min_value'].' to '.$row_for_defining_process['seam_strength_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp']."</td>
									<td>Fail</td>
									</tr>";
							}



							}

							if ($row_for_defining_process['seam_strength_in_weft_max_value']<>0 && $row_for_qc['seam_strength_in_weft_value']<>0) {

								$total_test++;
							if($row_for_defining_process['seam_strength_in_weft_min_value']<=$row_for_qc['seam_strength_in_weft_value'] && $row_for_defining_process['seam_strength_in_weft_max_value']>=$row_for_qc['seam_strength_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_strength_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_strength_in_weft_min_value'].' to '.$row_for_defining_process['seam_strength_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_strength_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_strength_in_weft_min_value'].' to '.$row_for_defining_process['seam_strength_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft']."</td>
									<td>Fail</td>
									</tr>";
							}



							}
					 } /* End of  if (in_array($row['id'], ['11', '149', '187', '244', '304']))*/

					 if (in_array($row['id'], ['12']))
					 {
						
						if ($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'].' to '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value'].' to '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
									<td>Fail</td>
									</tr>";
							}



							}	

							if ($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'].' to '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value'].' to '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
									<td>Fail</td>
									</tr>";
							}



								}

							if ($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value']<=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']>=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'].' to '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
									<td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value'].' to '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
									<td>Fail</td>
									</tr>";
							}



							}

							if ($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value']<=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'] && $row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value']>=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'].' to '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
									<td>Pass</td>
									</tr>";
							}
							else {
								$f++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
									
									<td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value'].' to '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
									<td>Fail</td>
									</tr>";
							}



							}
					 }

                         
				  }    /*End of  while( $row = mysqli_fetch_array( $result))*/

    $table.="</tbody>
              </table>";

     $table.="<label> Remarks: ".$row_for_qc['remarks']."</label> </div>";

    echo $table;
     
?>


<script>
	$('#calender_table').show();
</script>