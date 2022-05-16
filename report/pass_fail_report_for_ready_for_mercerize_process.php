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
$table="<div id='ready_for_mercerize_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_ready_for_mercerize="select * from defining_qc_standard_for_ready_for_mercerize_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_ready_for_mercerize=mysqli_query($con,$sql_for_ready_for_mercerize) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_ready_for_mercerize);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/
	
	$sql_for_ready_for_mercerize_qc_result="select * from qc_result_for_ready_for_mercerize_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
	
	$result_for_ready_for_mercerize_qc=mysqli_query($con,$sql_for_ready_for_mercerize_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_ready_for_mercerize_qc);


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

					 if (in_array($row['id'], ['49']))
					 {
					 if ($row_for_defining_process['whiteness_max_value']<>0 && $row_for_qc['whiteness_value_in_left_side_of_fabric']<>0) 

					  {
						$total_test++;
						if($row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_value_in_left_side_of_fabric'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_value_in_left_side_of_fabric'] && $row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_value_in_center_of_fabric'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_value_in_center_of_fabric'] && $row_for_defining_process['whiteness_min_value']<=$row_for_qc['whiteness_value_in_right_side_of_fabric'] && $row_for_defining_process['whiteness_max_value']>=$row_for_qc['whiteness_value_in_right_side_of_fabric'])
						{
							$p++;
							$table.="<tr>
							<td>".$row['test_name_method']."</td>
							<td>Left: ".$row_for_qc['whiteness_value_in_left_side_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness'].' Center: '.$row_for_qc['whiteness_value_in_center_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness'].' Right: '.$row_for_qc['whiteness_value_in_right_side_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness']."</td>	
							<td>".$row_for_defining_process['whiteness_min_value'].' to '.$row_for_defining_process['whiteness_max_value']."</td>
							<td>Pass</td>
							</tr>";
						}
						else {
							$f++;
							$table.="<tr>
							<td>".$row['test_name_method']."</td>
							<td>Left: ".$row_for_qc['whiteness_value_in_left_side_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness'].' Center: '.$row_for_qc['whiteness_value_in_center_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness'].' Right: '.$row_for_qc['whiteness_value_in_right_side_of_fabric'].' '.$row_for_defining_process['uom_of_whiteness']."</td>	
							<td>".$row_for_defining_process['whiteness_min_value'].' to '.$row_for_defining_process['whiteness_max_value']."</td>
							<td style='color: red;'>Fail</td>
							</tr>";
						}

					
					   }
					 }
					 
					 if (in_array($row['id'], ['10']))
					 {
					  if ($row_for_defining_process['bowing_and_skew_max_value']<>0 && $row_for_qc['bowing_and_skew_value']<>0) 

					  {
						$total_test++;
						if($row_for_defining_process['bowing_and_skew_min_value']<=$row_for_qc['bowing_and_skew_value'] && $row_for_defining_process['bowing_and_skew_max_value']>=$row_for_qc['bowing_and_skew_value'])
						{
							$p++;
							$table.="<tr>
							<td>".$row['test_name_method']."</td>
							<td>".$row_for_qc['bowing_and_skew_value'].' '.$row_for_defining_process['uom_of_bowing_and_skew']."</td>	
							<td>".$row_for_defining_process['bowing_and_skew_tolerance_range_math_operator'].' '.$row_for_defining_process['bowing_and_skew_tolerance_value'].' '.$row_for_defining_process['uom_of_bowing_and_skew']."</td>
							<td>Pass</td>
							</tr>";
						}
						else {
							$f++;
							$table.="<tr>
							<td>".$row['test_name_method']."</td>
							<td>".$row_for_qc['bowing_and_skew_value'].' '.$row_for_defining_process['uom_of_bowing_and_skew']."</td>	
							<td>".$row_for_defining_process['bowing_and_skew_tolerance_range_math_operator'].' '.$row_for_defining_process['bowing_and_skew_tolerance_value'].' '.$row_for_defining_process['uom_of_bowing_and_skew']."</td>
							<td style='color: red;'>Fail</td>
							</tr>";

						}
								
					  }
					 }

					  
						 
		 }  //End of while

		            if ($row_for_defining_process['ph_max_value']<>0) 
							{

							$total_test++;
	                        if($row_for_defining_process['ph_min_value']<=$row_for_qc['Ph_value_in_left_side_of_fabric'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['Ph_value_in_left_side_of_fabric'] && $row_for_defining_process['ph_min_value']<=$row_for_qc['Ph_value_in_left_side_of_fabric'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['Ph_value_in_right_of_fabric'] && $row_for_defining_process['ph_max_value']>=$row_for_qc['Ph_value_in_right_of_fabric'])
							{
								$p++;
									$split_ph=explode('(', $row['test_name_method']);
									$ph_test_name=$split_ph[0];
									$table.="<tr>
									<td>pH(Drop Test Method)</td>
									<td>Left:".$row_for_qc['Ph_value_in_left_side_of_fabric'].' Center:'.$row_for_qc['Ph_value_in_center_of_fabric'].' Right:'.$row_for_qc['Ph_value_in_right_of_fabric']."</td>	
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
									<td>Left:".$row_for_qc['Ph_value_in_left_side_of_fabric'].' Center:'.$row_for_qc['Ph_value_in_center_of_fabric'].' Right:'.$row_for_qc['Ph_value_in_right_of_fabric']."</td>	
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
		$('#ready_for_mercerize_table').show();
</script>