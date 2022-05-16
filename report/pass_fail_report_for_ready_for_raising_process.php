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
$table="<div id='ready_for_raising_table'style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_raising_process="select * from defining_qc_standard_for_ready_for_raising_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_raising_process=mysqli_query($con,$sql_for_raising_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_raising_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/


	$sql_for_ready_for_raising_process_qc_result="select * from qc_result_for_ready_for_raising_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	$result_for_raising_qc=mysqli_query($con,$sql_for_ready_for_raising_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_raising_qc);


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

    $flag="";

	$total_test= 0;
	$p= 0;
	$f= 0;

	$data="";
	$data_for_test_method_id="";
	$test_name_method="";
	$result= mysqli_query($con,$sql) or die(mysqli_error($con));
				 while( $row = mysqli_fetch_array( $result))
				 {
				 	 if (in_array($row['id'], ['7']))
					 {
						
						if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0) 
						{
							$total_test++;
							if($row_for_defining_process['tensile_properties_in_warp_value_min_value']<=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_warp_value_max_value']>=$row_for_qc['tensile_properties_in_warp_value'])
							{
								$p++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Warp'."</td>
										<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>	
										<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
										<td>Pass</td>
										</tr>";
							}
							else {
								$f++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Warp'."</td>
										<td>".$row_for_qc['tensile_properties_in_warp_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>	
										<td>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
							}

						}

						if ($row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) 
						{
							if($row_for_defining_process['tensile_properties_in_weft_value_min_value']<=$row_for_qc['tensile_properties_in_weft_value'] && $row_for_defining_process['tensile_properties_in_weft_value_max_value']>=$row_for_qc['tensile_properties_in_weft_value'])
							{
								$p++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Weft'."</td>
										<td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>	
										<td>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
										<td>Pass</td>
										</tr>";
							}
							else 
							{
								$f++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Weft'."</td>
										<td>".$row_for_qc['tensile_properties_in_weft_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>	
										<td>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
							}

							

						}
					}

					if (in_array($row['id'], ['8']))
					{
						
						if ($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0) 
						{
							$total_test++;

							if($row_for_defining_process['tear_force_in_warp_value_min_value']<=$row_for_qc['tear_force_in_warp_value'] && $row_for_defining_process['tear_force_in_warp_value_max_value']>=$row_for_qc['tear_force_in_warp_value'])
							{
								$p++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Warp'."</td>
										<td>".$row_for_qc['tear_force_in_warp_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>	
										<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
										<td>Pass</td>
										</tr>";
							}
							else {
								$f++;
								$table.="<tr>
										<td>".$row['test_name_method'].'Warp'."</td>
										<td>".$row_for_qc['tear_force_in_warp_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>	
										<td>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
										<td style='color: red;'>Fail</td>
										</tr>";
							}

							

						}

							if ($row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0) 
							{
								if($row_for_defining_process['tear_force_in_weft_value_min_value']<=$row_for_qc['tear_force_in_weft_value'] && $row_for_defining_process['tear_force_in_weft_value_max_value']>=$row_for_qc['tear_force_in_weft_value'])
								{
									$p++;
									$table.="<tr>
											<td>".$row['test_name_method'].'Weft'."</td>
											<td>".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>	
											<td>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
											<td>Pass</td>
											</tr>";
								}
								else {
									$f++;
									$table.="<tr>
											<td>".$row['test_name_method'].'Weft'."</td>
											<td>".$row_for_qc['tear_force_in_weft_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>	
											<td>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
											<td style='color: red;'>Fail</td>
											</tr>";
								}

							
						}
					}   //End of if (in_array($row['id'], ['8', '135', '148', '201', '275', '303']))
  
				  }  /*End of While*/

    $table.="</tbody>
              </table>";
    $table.="<label> Remarks: ".$row_for_qc['remarks']."</label></div>";

    echo $table;
     
?>

<script>
	$('#ready_for_raising_table').show();
</script>