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
$received_quantity_in_meter=$_GET['after_trolley_or_batcher_qty'];
$table="";
$table="<div id='greige_receiving_table' style='display:none'><table class='table table-bordered'>
<thead><tr>
<th>Test Name</th>
<th>Test Result</th>
<th>Requirements</th>
<th>Remarks</th>
</tr></thead>
 <tbody> 
  ";

	/***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_greige_receiving_process="select * from defining_qc_standard_for_greige_receiving_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";



	// $sql_for_greige_receiving_process="select * from defining_qc_standard_for_greige_receiving_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_greige_receiving_process=mysqli_query($con,$sql_for_greige_receiving_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($report_for_greige_receiving_process);

	/***************** Displaying Result from qc_standard table [END] *****************/


	/************ Displaying Result from qc_result table [Start] ************/
	if($received_quantity_in_meter=='')
		
		{
			$sql_for_greige_receiving_process_qc_result="select * from qc_result_for_greige_receiving_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";
 
		
	// $sql_for_greige_receiving_process_qc_result="select * from qc_result_for_greige_receiving_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_greige_receiving_process_qc=mysqli_query($con,$sql_for_greige_receiving_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($report_for_greige_receiving_process_qc);

		}
else

{

	 $sql_for_greige_receiving_process_qc_result="select * from qc_result_for_greige_receiving_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number' and `received_quantity_in_meter`='$received_quantity_in_meter' ";
 
		
	// $sql_for_greige_receiving_process_qc_result="select * from qc_result_for_greige_receiving_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
	$report_for_greige_receiving_process_qc=mysqli_query($con,$sql_for_greige_receiving_process_qc_result) or die(mysqli_error($con));
	$row_for_qc=mysqli_fetch_array($report_for_greige_receiving_process_qc);

  
}

	


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

               if (in_array($row['id'], ['74']))
               {
                 
                 if ($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0) 
                 {
                    $total_test++;
                    if($row_for_defining_process['warp_yarn_count_min_value']<=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['warp_yarn_count_max_value']>=$row_for_qc['warp_yarn_count_value'])
                        {
                           $p++;
                           $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp)'."</td>
                              <td>".$row_for_qc['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
                              <td>".$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                        }
                    else 
                        {
                           $f++;
                           $table.="<tr>
                           <td>".$row['test_name_method'].'(Warp)'."</td>
                           <td>".$row_for_qc['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
                           <td>".$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['warp_yarn_count_tolerance_value'].'%)'."</td>
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
                              <td>".$row_for_qc['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
                              <td>".$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                        }
                     else 
                        {
                           $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft)'."</td>
                              <td>".$row_for_qc['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
                              <td>".$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].'  '.$row_for_defining_process['weft_yarn_count_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                        }
                  }
               }

               if (in_array($row['id'], ['44']))
			           {
                      
			            if ($row_for_defining_process['greige_width_max_value']<>0 && $row_for_qc['gerige_width_value']<>0) 

			            {
			                            $total_test++;
			              if($row_for_defining_process['greige_width_min_value']<=$row_for_qc['gerige_width_value'] && $row_for_defining_process['greige_width_max_value']>=$row_for_qc['gerige_width_value'])
			              {
			                  $p++;
                           $table.="<tr>
									<td>".$row['test_name_method']."</td>
									<td>".$row_for_qc['gerige_width_value'].' '.$row_for_defining_process['uom_of_greige_width_value']."</td>
									<td>".$row_for_defining_process['greige_width_value'].' '.$row_for_defining_process['uom_of_greige_width_value'].' ('.$row_for_defining_process['greige_width_range_math_operator'].'  '.$row_for_defining_process['greige_width_tolerance_value'].' %)'."</td>
									<td>Pass</td>
									</tr>";
			              }
			              else {
			                  $f++;
                           $table.="<tr>
									<td >".$row['test_name_method']."</td>
									<td>".$row_for_qc['gerige_width_value'].' '.$row_for_defining_process['uom_of_greige_width_value']."</td>
									<td>".$row_for_defining_process['greige_width_value'].' '.$row_for_defining_process['uom_of_greige_width_value'].' ('.$row_for_defining_process['greige_width_range_math_operator'].'  '.$row_for_defining_process['greige_width_tolerance_value'].' %)'."</td>
									<td style='color: red;'>Fail</td>
									</tr>";
			              }

			              

			                }

			             
			           }      /* End of if (in_array($row['id'], ['44','90']]))*/

			           
                  

					

					  if (in_array($row['id'], ['4']))
					 {
						
						if ($row_for_defining_process['no_of_threads_in_warp_max_value']<>0 && $row_for_qc['no_of_threads_in_warp_value']<>0) {
                            
                            $total_test++;

							if($row_for_defining_process['no_of_threads_in_warp_min_value']<=$row_for_qc['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_warp_max_value']>=$row_for_qc['no_of_threads_in_warp_value'])
							{
								$p++;
								$table.="<tr>
									<td>".$row['test_name_method'].'(Warp)'."</td>
                           <td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
                           <td>".$row_for_defining_process['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value'].' ('.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value'].'%)'."</td>
                           <td>Pass</td>
                           </tr>";
							}
							else {
								$f++;
								$table.="<tr>
				
                           <td>".$row['test_name_method'].'(Warp)'."</td>
                           <td>".$row_for_qc['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
                           <td>".$row_for_defining_process['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value'].' ('.$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value'].'%)'."</td>
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
                           <td>".$row_for_defining_process['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value'].' ('.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value'].'%)'."</td>
                           <td>Pass</td>
                           </tr>";
							}
							else {
								$f++;
								 $table.="<tr>
									<td>".$row['test_name_method'].'(Weft)'."</td>
									<td>".$row_for_qc['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
                           <td>".$row_for_defining_process['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value'].' ('.$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value'].'%)'."</td>
                           <td style='color: red;'>Fail</td>
                           </tr>";
							}

							

							}

						
					 }

					  if (in_array($row['id'], ['5']))
					 {
						$mass_per_unit_per_area_value=floatval($row_for_qc['mass_per_unit_per_area_value']);
						$mass_per_unit_per_area_min_value=floatval($row_for_defining_process['mass_per_unit_per_area_min_value']);
						$mass_per_unit_per_area_max_value=floatval($row_for_defining_process['mass_per_unit_per_area_max_value']);
						if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc['mass_per_unit_per_area_value']<>0) {
                         
                         $total_test++;

							if($mass_per_unit_per_area_min_value<=$mass_per_unit_per_area_value && $mass_per_unit_per_area_max_value>=$mass_per_unit_per_area_value)
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
							else {
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



                      if (in_array($row['id'], ['43']))
					  {
                           if($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['cotton_fiber_content_value']<>0)
                          {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_total_cotton_content_min_value']<=$row_for_qc['cotton_fiber_content_value'] && $row_for_defining_process['percentage_of_total_cotton_content_max_value']>=$row_for_qc['cotton_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Total Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content'].' ('.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                               $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Total Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content'].' ('.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                        }

                        if($row_for_defining_process['percentage_of_total_polyester_content_max_value']<>0 && $row_for_qc['polyester_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_total_polyester_content_min_value']<=$row_for_qc['polyester_fiber_content_value'] && $row_for_defining_process['percentage_of_total_polyester_content_max_value']>=$row_for_qc['polyester_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Total Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content'].' ('.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Total Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content'].' ('.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                       }  



                        if($row_for_defining_process['percentage_of_total_other_fiber_content_max_value']<>0 && $row_for_qc['other_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_total_other_fiber_content_min_value']<=$row_for_qc['other_fiber_content_value'] && $row_for_defining_process['percentage_of_total_other_fiber_content_max_value']>=$row_for_qc['other_fiber_content_value'])
                           {
                              $p++;
                               $table.="<tr>
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_total_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                               $table.="<tr>
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_total_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_total_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                        
                       }

                       if($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['cotton_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_cotton_content_min_value']<=$row_for_qc['cotton_fiber_content_value'] && $row_for_defining_process['percentage_of_warp_cotton_content_max_value']>=$row_for_qc['cotton_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'].' ('.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'].' ('.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                       }  


                      if($row_for_defining_process['percentage_of_warp_polyester_content_max_value']<>0 && $row_for_qc['polyester_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_polyester_content_min_value']<=$row_for_qc['polyester_fiber_content_value'] && $row_for_defining_process['percentage_of_warp_polyester_content_max_value']>=$row_for_qc['polyester_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'].' ('.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'].' ('.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                       }  


                       if($row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']<>0 && $row_for_qc['other_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_other_fiber_content_min_value']<=$row_for_qc['other_fiber_content_value'] && $row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']>=$row_for_qc['other_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>  
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_warp_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value'].'%)'."</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                              $table.="<tr>  
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_warp_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value'].'%)'."</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                       }  


                       if($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['cotton_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_cotton_content_min_value']<=$row_for_qc['cotton_fiber_content_value'] && $row_for_defining_process['percentage_of_weft_cotton_content_max_value']>=$row_for_qc['cotton_fiber_content_value'])
                           {
                              $p++;
                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'].' ('.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']."%)</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;

                              $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Cotton)'."</td>
                              <td>".$row_for_qc['cotton_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'].' ('.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']."%)</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                         
                       } 


                        if($row_for_defining_process['percentage_of_weft_polyester_content_max_value']<>0 && $row_for_qc['polyester_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_polyester_content_min_value']<=$row_for_qc['polyester_fiber_content_value'] && $row_for_defining_process['percentage_of_weft_polyester_content_max_value']>=$row_for_qc['polyester_fiber_content_value'])
                           {
                              $p++;
                               $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'].' ('.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']."%)</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;
                               $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Polyester)'."</td>
                              <td>".$row_for_qc['polyester_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'].' ('.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']."%)</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                        
                       }  

                       if($row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']<>0 && $row_for_qc['other_fiber_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_other_fiber_content_min_value']<=$row_for_qc['other_fiber_content_value'] && $row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']>=$row_for_qc['other_fiber_content_value'])
                           {
                              $p++;
                                $table.="<tr>
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_weft_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']."%)</td>
                              <td>Pass</td>
                              </tr>";
                           }
                           else {
                              $f++;

                                $table.="<tr>
                              <td>".$row['test_name_method'].'('.$row_for_defining_process['description_or_type_for_weft_other_fiber'].')'."</td>
                              <td>".$row_for_qc['other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'].' ('.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']."%)</td>
                              <td style='color: red;'>Fail</td>
                              </tr>";
                           }

                       
                          } 


                          
                    }  /*  End of if (in_array($row['id'], ['43', '225', '296', '110', '180', '89']))*/

                       /*if($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['percentage_of_warp_cotton_content_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_cotton_content_min_value']<=$row_for_qc['percentage_of_warp_cotton_content_value'] && $row_for_defining_process['percentage_of_warp_cotton_content_max_value']>=$row_for_qc['percentage_of_warp_cotton_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Cotton)'."</td>
                              <td>".$row_for_qc['percentage_of_warp_cotton_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_warp_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_cotton_content_min_value'].','.$row_for_defining_process['percentage_of_warp_cotton_content_max_value']."</td>
                              </tr>";
                       }  


                      if($row_for_defining_process['percentage_of_warp_polyester_content_max_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_polyester_content_min_value']<=$row_for_qc['percentage_of_warp_polyester_content_value'] && $row_for_defining_process['percentage_of_warp_polyester_content_max_value']>=$row_for_qc['percentage_of_warp_polyester_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Polyester)'."</td>
                              <td>".$row_for_qc['percentage_of_warp_polyester_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_warp_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_polyester_content_min_value'].','.$row_for_defining_process['percentage_of_warp_polyester_content_max_value']."</td>
                              </tr>";
                       }  


                       if($row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_warp_other_fiber_content_min_value']<=$row_for_qc['percentage_of_warp_other_fiber_content_value'] && $row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']>=$row_for_qc['percentage_of_warp_other_fiber_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Warp Other Fiber)'."</td>
                              <td>".$row_for_qc['percentage_of_warp_other_fiber_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_warp_other_fiber_content_min_value'].','.$row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']."</td>
                              </tr>";
                       }  


                       if($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_cotton_content_min_value']<=$row_for_qc['percentage_of_weft_cotton_content_value'] && $row_for_defining_process['percentage_of_weft_cotton_content_max_value']>=$row_for_qc['percentage_of_weft_cotton_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Cotton)'."</td>
                              <td>".$row_for_qc['percentage_of_weft_cotton_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_weft_cotton_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_cotton_content_min_value'].','.$row_for_defining_process['percentage_of_weft_cotton_content_max_value']."</td>
                              </tr>";
                       } 


                        if($row_for_defining_process['percentage_of_weft_polyester_content_max_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_polyester_content_min_value']<=$row_for_qc['percentage_of_weft_polyester_content_value'] && $row_for_defining_process['percentage_of_weft_polyester_content_max_value']>=$row_for_qc['percentage_of_weft_polyester_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Polyester)'."</td>
                              <td>".$row_for_qc['percentage_of_weft_polyester_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_weft_polyester_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_polyester_content_min_value'].','.$row_for_defining_process['percentage_of_weft_polyester_content_max_value']."</td>
                              </tr>";
                       }  

                       if($row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']<>0)
                       {
                           $total_test++;
                           if($row_for_defining_process['percentage_of_weft_other_fiber_content_min_value']<=$row_for_qc['percentage_of_weft_other_fiber_content_value'] && $row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']>=$row_for_qc['percentage_of_weft_other_fiber_content_value'])
                           {
                              $p++;
                           }
                           else {
                              $f++;
                           }

                         $table.="<tr>
                              <td>".$row['test_name_method'].'(Weft Other Fiber)'."</td>
                              <td>".$row_for_qc['percentage_of_weft_other_fiber_content_value']."</td>
                              <td>".$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content']."</td>
                              <td>".$row_for_defining_process['percentage_of_weft_other_fiber_content_min_value'].','.$row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']."</td>
                              </tr>";
                          }  */
					  

                         
				  }    /*End of  while( $row = mysqli_fetch_array( $result))*/

    $table.="</tbody>
              </table>";

     $table.="<label> Remarks: ".$row_for_qc['remarks']."</label></div>";
   
    echo $table;
     
?>

<script>
	$('#greige_receiving_table').show();
</script>