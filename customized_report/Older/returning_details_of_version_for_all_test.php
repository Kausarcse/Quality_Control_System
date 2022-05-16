<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$pp_number=$_POST['pp_number_value'];
$version_number=$_POST['version_number_value'];
$color_value=$_POST['color_value'];
$process_name=$_POST['process_name'];
$current_process_index=-1;
$previous_process="";
$after_process="";
$data_for_all_process = array();
$table ='        
			         <table id="datatable-buttons" class="table table-striped table-bordered">
			         	<thead>
			                 <tr>
			                 <th>Date</th>
			                 <th>Greige width (inch)</th>
			                 <th>Finish width (inch)</th>
			                 <th>Version</th>
			                 <th>Before Trolley/Batcher</th>
			                 <th>Process Trolley/Batcher</th>
			                 <th>Before Trolley/Batcher Quantity(mtr)</th>
			                 <th>Process Trolley/Batcher Quantity</th>
			                 <th>Short/ Excess Qty (mtr)</th>
			                 <th>Short/ Excess Qty (%)</th>
			                
			                 <th>Next State</th>
			                 <th>Test Report View</th>
			                 <th>Remarks</th>
			                 </tr>
			            </thead>
			            <tbody>';
		
		$sql_for_all_process="SELECT  process_name,process_serial_no  from adding_process_to_version apv
								 where 1=1
									and version_name='$version_number' 
									and pp_number ='$pp_number'
									order by process_serial_no asc";
		$result_for_all_process= mysqli_query($con,$sql_for_all_process) or die(mysqli_error());

		 while( $row_for_all_process = mysqli_fetch_array( $result_for_all_process))
		 {
			$data_for_all_process[] = $row_for_all_process['process_name'];
		 }
		
		 $current_process_index = array_search($process_name,$data_for_all_process);
								
		$sql = " SELECT DISTINCT 
					ptfti.pp_number
					,ptfti.version_number
					,ptfti.all_test_for_trf_creation_date 
					,ppwci.greige_width_in_inch GW
					,ppwci.finish_width_in_inch FW
					,ppwci.version_name
					,ptfti.before_trolley_number_or_batcher_number
					,ptfti.after_trolley_number_or_batcher_number Process_trolly
					,(SELECT qty from all_test_for_trf_info pt 
					where pt.pp_number= ptfti.pp_number
					and  pt.version_number = ptfti.version_number
					and pt.process_name = '".$data_for_all_process[$current_process_index-1]."' limit 1 ) before_trolley_mtr
					,ptfti.qty process_trolley_mtr
					FROM pp_wise_version_creation_info ppwci 
					,all_test_for_trf_info ptfti  
					where 1=1
					and ppwci.pp_number = ptfti.pp_number
					and ppwci.version_name = ptfti.version_number
					and ptfti.process_name = '$process_name'
					and ppwci.pp_number='$pp_number' 
					and ppwci.`version_name`='$version_number' 
					order by process_id ASC";
		
		 $result= mysqli_query($con,$sql) or die(mysqli_error());

		 while( $row = mysqli_fetch_array( $result))
		 {    
              $table .='<tr>
			                 <td>'.$row['all_test_for_trf_creation_date'].'</td>
			                 <td>'.$row['GW'].'</td>
			                 <td>'.$row['FW'].'</td>
			                 <td>'.$row['version_name'].'</td>
			                 <td>'.$row['before_trolley_number_or_batcher_number'].'</td>
			                 <td>'.$row['Process_trolly'].'</td>
			                 <td>'.$row['before_trolley_mtr'].'</td>
			                 <td>'.$row['process_trolley_mtr'].'</td>
			                 <td>'.($row['process_trolley_mtr'] - $row['before_trolley_mtr']).'</td>
			                 <td>'.((($row['process_trolley_mtr'] - $row['before_trolley_mtr'])/ $row['process_trolley_mtr'])*100 ).'%</td>
			                 
			                 <td>'.($data_for_all_process[$current_process_index+1]).'</td>
			                 <td onclick="">View</td>  
			                 <td></td>
			                 </tr>';
		 }
		 
		 $table .='</tbody>
			         </table> ';

		
		 echo $table;


?>

