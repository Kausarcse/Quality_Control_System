
 
<?php
error_reporting(0);
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$pp_number=$_POST['pp_number_value'];
$version_id=$_POST['version_number_value'];
/*$color_value=$_POST['color_value'];*/
$process_name=$_POST['process_name'];
$row_id=$_POST['row_id'];
$current_process_index=-1;
$previous_process="";
$after_process="";
$get_all_data;
$data_for_all_process = array();
$table ='      
                  <div><label class="form-control">Details Information</label> </div>
                  
					

			         <table id="datatable-buttons_for_version_details" class="table table-striped table-bordered">
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
			                 <th>Short/ Excess (mtr)</th>
			                 <th>Short/ Excess (%)</th>
			                
			                 <th>Next State</th>
			                 <th>Test Report View</th>
			                 
			                 </tr>
			            </thead>
			            <tbody>';
		
		$sql_for_all_process="SELECT  process_name,process_serial_no  from adding_process_to_version apv
								 where 1=1
									and version_id='$version_id' 
									and pp_number ='$pp_number'
									order by process_serial_no asc";
		$result_for_all_process= mysqli_query($con,$sql_for_all_process) or die(mysqli_error($con));

		 while( $row_for_all_process = mysqli_fetch_array( $result_for_all_process))
		 {
			$data_for_all_process[] = $row_for_all_process['process_name'];
		 }
		
		 $current_process_index = array_search($process_name,$data_for_all_process);
								
		$sql = "SELECT DISTINCT 
					ptfti.pp_number
					,ptfti.version_number
					,ptfti.version_id
					,ptfti.process_id
					,ptfti.process_name
					,ptfti.style
					,ptfti.partial_test_for_test_result_creation_date 
					,ppwci.greige_width_in_inch GW
					,ppwci.finish_width_in_inch FW
					,ppwci.version_id
					,ptfti.before_trolley_number_or_batcher_number
					,ptfti.after_trolley_number_or_batcher_number Process_trolly
					,ptfti.after_trolley_or_batcher_qty
					,ptfti.trf_id
					,(SELECT after_trolley_or_batcher_qty from partial_test_for_test_result_info pt 
					where pt.pp_number= ptfti.pp_number
					and  pt.version_id = ptfti.version_id
					and pt.process_name = '".$data_for_all_process[$current_process_index-1]."' limit 1 ) before_trolley_mtr
					,ptfti.after_trolley_or_batcher_qty process_trolley_mtr
					FROM pp_wise_version_creation_info ppwci 
					,partial_test_for_test_result_info ptfti  
					where 1=1
					and ptfti.partial_test_for_test_result_id = '$row_id'
					and ppwci.pp_number = ptfti.pp_number
					and ppwci.version_id = ptfti.version_id
					and ptfti.process_name = '$process_name'
					and ppwci.pp_number='$pp_number' 
					and ppwci.`version_id`='$version_id' 
					order by process_id ASC";

       /* echo $sql; */

        
		
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 

		while( $row = mysqli_fetch_array( $result))
		{   
			if($row['trf_id']=='select' || $row['trf_id']=='')
			{
				$get_all_data.="?fs?".$row['version_id']."?fs?".$row['pp_number']."?fs?".$row['process_id']."?fs?".$row['process_name']."?fs?".$row['style']."?fs?".$row['FW']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['Process_trolly']."?fs?".$row['after_trolley_or_batcher_qty'];
			} 
			else
			{
				$get_all_data.=$row['trf_id']."?fs?".$row['version_id']."?fs?".$row['pp_number']."?fs?".$row['process_id']."?fs?".$row['process_name']."?fs?".$row['style']."?fs?".$row['FW']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['Process_trolly']."?fs?".$row['after_trolley_or_batcher_qty'];
			}
			        
            $table .='<tr>
			<td>'.$row['partial_test_for_test_result_creation_date'].'</td>
			<td>'.$row['GW'].'</td>
			<td>'.$row['FW'].'</td>
			<td>'.$row['version_number'].'</td>
			<td>'.$row['before_trolley_number_or_batcher_number'].'</td>
			<td>'.$row['Process_trolly'].'</td>
			<td>'.$row['before_trolley_mtr'].'</td>
			<td>'.$row['process_trolley_mtr'].'</td>
			<td>'.($row['process_trolley_mtr'] - $row['before_trolley_mtr']).'</td>
			<td>'.((($row['process_trolley_mtr'] - $row['before_trolley_mtr'])/ $row['process_trolley_mtr'])*100 ).'%</td>
			
			<td>'.($data_for_all_process[$current_process_index+1]).'</td>

			<td onclick="report_view(&quot;'.$get_all_data.'&quot;)"><p style="color: red;">View Report</p></td>  
			
			</tr>';
		}
		 
		 $table .='</tbody>
			         </table>
			         ';

		
		 echo $table;


?>



<script>
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable-buttons_for_version_details thead tr').clone(true).appendTo( '#datatable-buttons_for_version_details thead' );
    $('#datatable-buttons_for_version_details thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );


 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#datatable-buttons_for_version_details').DataTable( {
       scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: '20%', targets: 0 }
        ],
        fixedColumns: true
    } );
} );
</script>                 