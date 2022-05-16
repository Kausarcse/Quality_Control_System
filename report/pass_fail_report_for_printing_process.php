<?php
error_reporting(0);
$pp_number=$_GET['pp_number'];
$version_number=$_GET['version_number'];
$customer_name=$_GET['customer_name'];
$customer_id = $_GET['customer_id'];

$style=$_GET['style'];
$finish_width_in_inch=$_GET['finish_width_in_inch'];
$before_trolley_number_or_batcher_number=$_GET['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number=$_GET['after_trolley_number_or_batcher_number'];
$table="<div id='printing_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_printing="select * from defining_qc_standard_for_printing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_printing=mysqli_query($con,$sql_for_printing) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_printing);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/

    
    $sql_for_printing_qc_result="select * from qc_result_for_printing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
  

	$result_for_printing_qc=mysqli_query($con,$sql_for_printing_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_printing_qc);


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
										<td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
										<td>Pass</td>
										</tr>";
							}
							else {
								$f++;
								$table.="<tr>
										<td>".$row['test_name_method'].' (Dry)'."</td>
										<td>".$cf_to_rubbing_dry_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>	
										<td>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry']."</td>
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
								<td>".$row['test_name_method'].' (Wet)'."</td>
								<td>".$cf_to_rubbing_wet_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>	
								<td>".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet']."</td>
								<td style='color: red;'>Fail</td>
								</tr>";
							}

							}
						 
					 }      /* End ofif (in_array($row['id'], ['1','240','105','164','207','247','259','298']))*/
					  
				  }

    $table.="</tbody>
              </table>";
    $table.="<label> Remarks: ".$row_for_qc['remarks']."</label></div>";

    echo $table;
     
?>

<script>
	$('#printing_table').show();
</script>