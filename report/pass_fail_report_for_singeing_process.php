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
$table="<div id='singeing_table' style='display:none;'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_singeing_process="select * from defining_qc_standard_for_singeing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'";

	$result_for_singeing_process=mysqli_query($con,$sql_for_singeing_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($result_for_singeing_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/

	$sql_for_singeing_process_qc_result="select * from qc_result_for_singeing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

	$result_for_singeing_process_qc=mysqli_query($con,$sql_for_singeing_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($result_for_singeing_process_qc);


	/************ Displaying Result from qc_result table [End] ************/
	


	//  $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
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
                    if (in_array($row['id'], ['45']))
                    {

						if ($row_for_defining_process['flame_intensity_max_value']<>0 && $row_for_qc['flame_intensity_value']<>0) 
                        {
							 $total_test++;
							if($row_for_defining_process['flame_intensity_min_value']<=$row_for_qc['flame_intensity_value'] && $row_for_defining_process['flame_intensity_max_value']>=$row_for_qc['flame_intensity_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$row_for_qc['flame_intensity_value'].' '.$row_for_defining_process['uom_of_flame_intensity']."</td>
									<td>".'('.$row_for_defining_process['flame_intensity_min_value'].' to '.$row_for_defining_process['flame_intensity_max_value'].') '.$row_for_defining_process['uom_of_flame_intensity']."</td>
									<td>Pass</td>
									</tr>";

							}
							else 
                            {
								 $f++;
								 $table.="<tr>
								 <td>".$row['test_name_method']."</td>
								 <td>".$row_for_qc['flame_intensity_value'].' '.$row_for_defining_process['uom_of_flame_intensity']."</td>
								 <td>".'('.$row_for_defining_process['flame_intensity_min_value'].' to '.$row_for_defining_process['flame_intensity_max_value'].') '.$row_for_defining_process['uom_of_flame_intensity']."</td>
								 <td style='color: red;'>Fail</td>
									</tr>";
							} 
						}	
					}

					 if (in_array($row['id'], ['46']))
					 {
						
						if ($row_for_defining_process['machine_speed_max_value']<>0 && $row_for_qc['machine_speed']<>0) 
                        {
							 $total_test++;
							if($row_for_defining_process['machine_speed_min_value']<=$row_for_qc['machine_speed'] && $row_for_defining_process['machine_speed_max_value']>=$row_for_qc['machine_speed'])
							{
								$p++;

								$table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$row_for_qc['machine_speed'].' '.$row_for_defining_process['uom_of_machine_speed']."</td>
									<td>".'('.$row_for_defining_process['machine_speed_min_value'].' to '.$row_for_defining_process['machine_speed_max_value'].') '.$row_for_defining_process['uom_of_machine_speed']."</td>
									<td>Pass</td>
									</tr>";
							}
							else 
                            {
								$f++;

								$table.="<tr>
								<td>".$row['test_name_method']."</td>
								<td>".$row_for_qc['machine_speed'].' '.$row_for_defining_process['uom_of_machine_speed']."</td>
								<td>".'('.$row_for_defining_process['machine_speed_min_value'].' to '.$row_for_defining_process['machine_speed_max_value'].') '.$row_for_defining_process['uom_of_machine_speed']."</td>
								<td style='color: red;'>Fail</td>
									</tr>";
							} 
						}		
					 }
	
				}     /*   End of While*/
//  echo $total_test;
//  echo $p;
// echo $f;
    $table.="</tbody>
              </table>";
    $table.="<label> Remarks: ".$row_for_qc['remarks']."</label></div>";

    echo $table;
     
?>


<script>
	$('#singeing_table').show();
</script>

