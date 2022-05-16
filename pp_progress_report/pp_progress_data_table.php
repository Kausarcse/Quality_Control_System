<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$sub_query='';


if(isset($_POST['pp_number'])  && $_POST['pp_number']!='select')
{   
  
  $pp_number=$_POST['pp_number'];

    $sub_query.=" and  pwvci.pp_number ='".$pp_number."'";

}
if(isset($_POST['from_date']) && $_POST['from_date']!='' && $_POST['to_date']=='')
{   
	$from_date=$_POST['from_date'];

    $sub_query.=" and  ppi.pp_creation_date='".$from_date."'";

}
 if(isset($_POST['to_date']) && isset($_POST['from_date']) && $_POST['to_date']!='')
{   
	
  $from_date=$_POST['from_date'];
  $to_date=$_POST['to_date'];

    $sub_query.=" and  ppi.pp_creation_date between'".$from_date."' and '".$to_date."'";
}

if(isset($_POST['current_state']) && $_POST['current_state']!='select')
{   
	
	$current_state=$_POST['current_state'];

    $sub_query.=" and  pm.current_state='".$current_state."'";

}
if(isset($_POST['from_week']) && $_POST['from_week']!='' && $_POST['to_week']!='select')
{   
	$from_week=$_POST['from_week'];

    $sub_query.=" and  ppi.week_in_year='".$from_week."'";


}

if(isset($_POST['to_week']) && isset($_POST['from_week']) && $_POST['to_week']!='select')
{   
	$from_week=$_POST['from_week'];
	$to_week=$_POST['to_week'];

    $sub_query.=" and  ppi.week_in_year between '".$from_week."' and '".$to_week."'";

}


if(isset($_POST['customer']) && $_POST['customer']!='select')
{   
	
  $customer=$_POST['customer'];

    $sub_query.=" and  ppi.customer_id='".$customer."'";

}
if(isset($_POST['process_type'])  && $_POST['process_type']!='select')
{   
  
  $process_type=$_POST['process_type'];

    $sub_query.=" and  pwvci.process_technique_name IN (".$process_type.")";

}

if(isset($_POST['construction_name'])  && $_POST['construction_name']!='select')
{   
  
  $construction_name=$_POST['construction_name'];

    $sub_query.=" and  pwvci.construction_name ='".$construction_name."'";

}

if(isset($_POST['process_technique'])  && $_POST['process_technique']!='select')
{   
	
   $process_technique=$_POST['process_technique'];

    $sub_query.=" and  pwvci.process_technique_name='".$process_technique."'";
}


if(isset($_POST['process_or_reprocess']) && $_POST['process_or_reprocess']!='select')
{   
	
   $process_or_reprocess=$_POST['process_or_reprocess'];

    $sub_query.=" and  adptv.process_or_reprocess='".$process_or_reprocess."'";

}


$current_process_index=-1;
$previous_process="";
$after_process="";
$data_for_all_process = array();

// <td colspan="9" style="text-align: center; font-size: 30px; color: black; font-weight: bold; border: 1px solid">
// <table id="pp_progress_header" class="table table-bordered">
// 						<thead>
// 								<tr>
									
// 									<td colspan="9" style="text-align: center; font-size: 30px; color: black; font-weight: bold;">

// 										PP Progress Report
// 									</td>
// 								</tr>
// 						</thead>
// 					</table>
		 
$table ='   <div class="form-group form-group-sm" id="for_pp_progress_report_table">
                    
			         <table id="datatable-buttons" class="table table-striped table-bordered" border=1>
			         	<thead>
						 <tr>
						 <th style="border: 1px solid black">PP</th>
						 <th style="border: 1px solid black">PP Issue Date</th>
						 <th style="border: 1px solid black">Week</th>
						 <th style="border: 1px solid black">Customer</th>
						 <th style="border: 1px solid black">Design</th>
						 <th style="border: 1px solid black">PPQ (mtr.) </th>
						 <th style="border: 1px solid black">Greige Issue Date</th>
						 <th style="border: 1px solid black">GIQ (mtr.)</th>
						 <th style="border: 1px solid black">Greige Issuance Completaion date</th>
						 <th style="border: 1px solid black">S/E  (GIQ - PPQ) (mtr.)</th>
						 <th style="border: 1px solid black">Process Starting Date</th>
						 
						 <th style="border: 1px solid black">Singeing Qty. (mtr.)</th>
						<th style="border: 1px solid black">Re-Singeing Qty. (mtr.)</th>
						<th style="border: 1px solid black">2nd-Re-Singeing Qty. (mtr.)</th>
						<th style="border: 1px solid black">3rd-Re-Singeing Qty. (mtr.)</th>
						<th style="border: 1px solid black">4th-Re-Singeing Qty. (mtr.)</th>

						<th style="border: 1px solid black">Desizing Qty. (mtr.)</th>
						<th style="border: 1px solid black">Re-Desizing Qty. (mtr.)</th>
						<th style="border: 1px solid black">2nd-Re-Desizing Qty. (mtr.)</th>
						<th style="border: 1px solid black">3rd-Re-Desizing Qty. (mtr.)</th>
						<th style="border: 1px solid black">4th-Re-Desizing Qty. (mtr.)</th>
						
						 <th style="border: 1px solid black">Singe & Desize Qty. (mtr.)</th>
						 <th style="border: 1px solid black">Re-Singe & Desize Qty. (mtr.)</th>
						 <th style="border: 1px solid black">2nd-Re-Singe & Desize Qty. (mtr.)</th>
						 <th style="border: 1px solid black">3rd-Re-Singe & Desize Qty. (mtr.)</th>
						 <th style="border: 1px solid black">4th-Re-Singe & Desize Qty. (mtr.)</th>
					  
						 <th style="border: 1px solid black">Scouring Qty. (mtr.)</th>
						<th style="border: 1px solid black">Re-Scouring Qty. (mtr.)</th>
						<th style="border: 1px solid black">2nd-Re-Scouring Qty. (mtr.)</th>
						<th style="border: 1px solid black">3rd-Re-Scouring Qty. (mtr.)</th>
						<th style="border: 1px solid black">4th-Re-Scouring Qty. (mtr.)</th>

						<th style="border: 1px solid black">Bleaching Qty. (mtr.)</th>
						<th style="border: 1px solid black">Re-Bleaching Qty. (mtr.)</th>
						<th style="border: 1px solid black">2nd-Re-Bleaching Qty. (mtr.)</th>
						<th style="border: 1px solid black">3rd-Re-Bleaching Qty. (mtr.)</th>
						<th style="border: 1px solid black">4th-Re-Bleaching Qty. (mtr.)</th>


						 <th style="border: 1px solid black">Scouring & Bleaching Qty. (mtr.)</th>
						 <th style="border: 1px solid black">Re-Scouring & Bleaching Qty. (mtr.)</th>
						 <th style="border: 1px solid black">2nd-Re-Scouring & Bleaching Qty. (mtr.)</th>
						 <th style="border: 1px solid black">3rd-Re-Scouring & Bleaching Qty. (mtr.)</th>
						 <th style="border: 1px solid black">4th-Re-Scouring & Bleaching Qty. (mtr.)</th>
						 
						 <th style="border: 1px solid black">Ready for Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Ready for Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Ready for Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Ready for Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Ready for Mercerize Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Mercerize Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Mercerize Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Ready for Print Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Ready for Print Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Ready for Print Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Ready for Print Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Ready for Print Qty. (mtr.) </th>

						 <th style="border: 1px solid black"> Printing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Printing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Printing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Printing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Printing Qty. (mtr.) </th>
						 
						
						 <th style="border: 1px solid black">Curing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Curing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Curing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Curing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Curing Qty. (mtr.) </th>
						
						 <th style="border: 1px solid black">Steaming Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Steaming Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Steaming Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Steaming Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Steaming Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Ready for Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Ready for Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Ready for Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Ready for Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Ready for Dyeing Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Dyeing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Dyeing Qty. (mtr.) </th>
						
						 <th style="border: 1px solid black">Washing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Washing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Washing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Washing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Washing Qty. (mtr.) </th>

						 <th style="border: 1px solid black">Ready for Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Ready for Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Ready for Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Ready for Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Ready for Raising Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Raising Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Raising Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Finishing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Finishing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Finishing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Finishing Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Finishing Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Dyeing-Finish Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Dyeing-Finish Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2nd-Re-Dyeing-Finish Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Dyeing-Finish Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Dyeing-Finish Qty. (mtr.) </th>

						 <th style="border: 1px solid black">Calender Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Re-Calender Qty. (mtr.) </th>
						 <th style="border: 1px solid black">2d Re-Calender Qty. (mtr.) </th>
						 <th style="border: 1px solid black">3rd-Re-Calender Qty. (mtr.) </th>
						 <th style="border: 1px solid black">4th-Re-Calender Qty. (mtr.) </th>
						 
						 <th style="border: 1px solid black">Sanforize Qty. (mtr.)  </th>
						 <th style="border: 1px solid black">Re-Sanforize Qty. (mtr.)  </th>
						 <th style="border: 1px solid black">2nd-Re-Sanforize Qty. (mtr.)  </th>
						 <th style="border: 1px solid black">3rd-Re-Sanforize Qty. (mtr.)  </th>
						 <th style="border: 1px solid black">4th-Re-Sanforize Qty. (mtr.)  </th>

						 <th style="border: 1px solid black">TPQ (mtr.)</th>
						 <th style="border: 1px solid black">S/E  (TPQ - PPQ) (mtr.)</th>
						 <th style="border: 1px solid black">S/E (TPQ - GIQ) (mtr.)</th>

						 <th style="border: 1px solid black">Process completion date  </th>
						 <th style="border: 1px solid black">Reprocess Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Reprocess (%) </th>
						 <th style="border: 1px solid black">Inspection & Folding  Qty. (mtr.)  </th>
						 
						 <th style="border: 1px solid black">Folding Completion Date </th>
						 <th style="border: 1px solid black">PP Closing Date </th>
						 <th style="border: 1px solid black">Short/ Excess (Total Process qty vs Folding Qty. (mtr.)</th>
						 <th style="border: 1px solid black">Delivery  Qty. (mtr.)  </th>
						 <th style="border: 1px solid black">Short/ Excess (Folding vs Deivery Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Delivery completion Date  </th>
						 <th style="border: 1px solid black">Defective Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Defective % </th>
						 <th style="border: 1px solid black">Rejection Qty. (mtr.) </th>
						 <th style="border: 1px solid black">Rejection % </th>
						 <th style="border: 1px solid black">Chemical cost BDT/sq.mtr </th>
						 <th style="border: 1px solid black">Remarks </th>
						 </tr>
			            </thead>


			            <tfoot>
				            <tr>
				             <th style="border: 1px solid black">PP</th>
			                 
				            </tr>
				       </tfoot>

			            <tbody>';
		
		/*$sql = "SELECT
					ppi.pp_number
					,ppi.pp_creation_date
					,ppi.week_in_year
					,ppi.customer_id
					,ppi.customer_name
					,ppi.design

				From process_program_info ppi 
				WHERE 1=1'"	;*/


				 $sql = "SELECT DISTINCT 
						ppi.pp_number, date_format(ppi.pp_creation_date, '%d-%m-%Y')  pp_creation_date, ppi.week_in_year, ppi.customer_id,
						ppi.customer_name, ppi.design
						From process_program_info ppi 
						LEFT JOIN pp_wise_version_creation_info pwvci ON ppi.pp_number=pwvci.pp_number
						LEFT JOIN  adding_process_to_version adptv ON ppi.pp_number=adptv.pp_number
						LEFT JOIN  pp_monitoring pm ON ppi.pp_number=pm.pp_number
				        WHERE 1=1
				        ".$sub_query."";			
	    /*echo $sql;*/
	     
		
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 
		 $total_ppq_value = 0.0;
		 $total_gic_value = 0.0;
		 $total_greige_short_excess_qty = 0.0;

		 $total_singeing_qty = 0.0;
		 $total_re_singeing_qty = 0.0;
		 $total_2nd_re_singeing_qty = 0.0;
		 $total_3rd_re_singeing_qty = 0.0;
		 $total_4th_re_singeing_qty = 0.0;

		 $total_desizing_qty = 0.0;
		 $total_re_desizing_qty = 0.0;
		 $total_2nd_re_desizing_qty = 0.0;
		 $total_3rd_re_desizing_qty = 0.0;
		 $total_4th_re_desizing_qty = 0.0;


		 $total_signe_desize_qty = 0.0;
		 $total_re_signe_desize_qty = 0.0;
		 $total_2nd_re_signe_desize_qty = 0.0;
		 $total_3rd_re_signe_desize_qty = 0.0;
		 $total_4th_re_signe_desize_qty = 0.0;

		 $total_scouring_qty = 0.0;
		 $total_re_scouring_qty = 0.0;
		 $total_2nd_re_scouring_qty = 0.0;
		 $total_3rd_re_scouring_qty = 0.0;
		 $total_4th_re_scouring_qty = 0.0;

		 $total_bleaching_qty = 0.0;
		 $total_re_bleaching_qty = 0.0;
		 $total_2nd_re_bleaching_qty = 0.0;
		 $total_3rd_re_bleaching_qty = 0.0;
		 $total_4th_re_bleaching_qty = 0.0;

		 $total_souring_bleaching_qty = 0.0;
		 $total_re_souring_bleaching_qty = 0.0;
		 $total_2nd_re_souring_bleaching_qty = 0.0;
		 $total_3rd_re_souring_bleaching_qty = 0.0;
		 $total_4th_re_souring_bleaching_qty = 0.0;

		 $total_ready_for_mercherize_qty = 0.0;
		 $total_re_ready_for_mercherize_qty = 0.0;
		 $total_2nd_re_ready_for_mercherize_qty = 0.0;
		 $total_3rd_re_ready_for_mercherize_qty = 0.0;
		 $total_4th_re_ready_for_mercherize_qty = 0.0;

		 $total_mercherize_qty = 0.0;
		 $total_re_mercherize_qty = 0.0;
		 $total_2nd_re_mercherize_qty = 0.0;
		 $total_3rd_re_mercherize_qty = 0.0;
		 $total_4th_re_mercherize_qty = 0.0;

		 $total_ready_for_print_qty = 0.0;
		 $total_re_ready_for_print_qty = 0.0;
		 $total_2nd_re_ready_for_print_qty = 0.0;
		 $total_3rd_re_ready_for_print_qty = 0.0;
		 $total_4th_re_ready_for_print_qty = 0.0;

		 $total_print_qty = 0.0;
		 $total_re_print_qty = 0.0;
		 $total_2nd_re_print_qty = 0.0;
		 $total_3rd_re_print_qty = 0.0;
		 $total_4th_re_print_qty = 0.0;

		 $total_curing_qty = 0.0;
		 $total_re_curing_qty = 0.0;
		 $total_2nd_re_curing_qty = 0.0;
		 $total_3rd_re_curing_qty = 0.0;
		 $total_4th_re_curing_qty = 0.0;

		 $total_steaming_qty = 0.0;
		 $total_re_steaming_qty = 0.0;
		 $total_2nd_re_steaming_qty = 0.0;
		 $total_3rd_re_steaming_qty = 0.0;
		 $total_4th_re_steaming_qty = 0.0;

		 $total_ready_for_dyeing_qty = 0.0;
		 $total_re_ready_for_dyeing_qty = 0.0;
		 $total_2nd_re_ready_for_dyeing_qty = 0.0;
		 $total_3rd_re_ready_for_dyeing_qty = 0.0;
		 $total_4th_re_ready_for_dyeing_qty = 0.0;

		 $total_dyeing_qty = 0.0;
		 $total_re_dyeing_qty = 0.0;
		 $total_2nd_re_dyeing_qty = 0.0;
		 $total_3rd_re_dyeing_qty = 0.0;
		 $total_4th_re_dyeing_qty = 0.0;

		 $total_ready_for_raising_qty = 0.0;
		 $total_re_ready_for_raising_qty = 0.0;
		 $total_2nd_re_ready_for_raising_qty = 0.0;
		 $total_3rd_re_ready_for_raising_qty = 0.0;
		 $total_4th_re_ready_for_raising_qty = 0.0;

		 $total_raising_qty = 0.0;
		 $total_re_raising_qty = 0.0;
		 $total_2nd_re_raising_qty = 0.0;
		 $total_3rd_re_raising_qty = 0.0;
		 $total_4th_re_raising_qty = 0.0;

		 $total_washing_qty = 0.0;
		 $total_re_washing_qty = 0.0;
		 $total_2nd_re_washing_qty = 0.0;
		 $total_3rd_re_washing_qty = 0.0;
		 $total_4th_re_washing_qty = 0.0;

		 $total_finishing_qty = 0.0;
		 $total_re_finishing_qty = 0.0;
		 $total_2nd_re_finishing_qty = 0.0;
		 $total_3rd_re_finishing_qty = 0.0;
		 $total_4th_re_finishing_qty = 0.0;

		 $total_calendering_qty = 0.0;
		 $total_re_calendering_qty = 0.0;
		 $total_2nd_re_calendering_qty = 0.0;
		 $total_3rd_re_calendering_qty = 0.0;
		 $total_4th_re_calendering_qty = 0.0;

		 $total_sanforizing_qty = 0.0;
		 $total_re_sanforizing_qty = 0.0;
		 $total_2nd_re_sanforizing_qty = 0.0;
		 $total_3rd_re_sanforizing_qty = 0.0;
		 $total_4th_re_sanforizing_qty = 0.0;

		 $total_process_qty = 0.0;
		 $total_process_short_excess_qty = 0.0;
		 $total_greige_process_short_excess_qty = 0.0;
		 $total_reprocess_qty = 0.0;

		 while( $row = mysqli_fetch_array( $result))
		 {      

                $last_batcher_qty =0.0;
				$total_pp_quantity =0.0;
				$greige_total_quantity =0.0;
				$process_completetion_date ='';
				$reprocess_quantity =0.0;

                $value_for_pp=$row['pp_number'];
				$table .='<tr class="data">
			                 <td style="border: 1px solid black" onClick="get_pp_status_report(&quot;'.$value_for_pp.'&quot;)">'.$row['pp_number'].'</td>
			                 <td style="border: 1px solid black">'.$row['pp_creation_date'].'</td>
			                 <td style="border: 1px solid black">'.$row['week_in_year'].'</td>
			                 <td style="border: 1px solid black">'.$row['customer_name'].'</td>
			                 <td style="border: 1px solid black">'.$row['design'].'</td>
							 ';
			$sql_for_all_process="SELECT  process_name,process_serial_no  from adding_process_to_version apv
								 where 1=1  
									 and pp_number ='".$row['pp_number']."'
									order by process_serial_no asc";
		$result_for_all_process= mysqli_query($con,$sql_for_all_process) or die(mysqli_error($con));

		 while( $row_for_all_process = mysqli_fetch_array( $result_for_all_process))
		 {
			$data_for_all_process[] = $row_for_all_process['process_name'];
		 }
	// Greige receiving				
			$sql_for_Greige_Receiving="SELECT * ,ptftri.greige_qty - pwvci.pp_quantity_pwvci short_excess 
										from 
										(SELECT pp_number,sum(pp_quantity) pp_quantity_pwvci 
										from pp_wise_version_creation_info where pp_number='".$row['pp_number']."') pwvci 
										LEFT JOIN
										(SELECT ptri.pp_number
										, date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') greige_issue_date 
										,sum(after_trolley_or_batcher_qty) greige_qty ,'' as greige_completetion_date 
										from partial_test_for_test_result_info ptri 
										where pp_number='".$row['pp_number']."' and ptri.process_name='Greige Receiving') ptftri 
										on  ptftri.pp_number = pwvci.pp_number" ;
			//	echo 	$sql_for_Greige_Receiving			;
			 $result_Greige_Receiving= mysqli_query($con,$sql_for_Greige_Receiving) or die(mysqli_error($con));

			while($row_Greige_Receiving = mysqli_fetch_array( $result_Greige_Receiving))
			{    
		     
              $table .='	  <td style="border: 1px solid black">'.$row_Greige_Receiving['pp_quantity_pwvci'].'</td>
			                  <td style="border: 1px solid black">'.$row_Greige_Receiving['greige_issue_date'].'</td>
			                  <td style="border: 1px solid black">'.$row_Greige_Receiving['greige_qty'].'</td>
			                  <td style="border: 1px solid black">'.$row_Greige_Receiving['greige_completetion_date'].'</td>
			                  <td style="border: 1px solid black">'.$row_Greige_Receiving['short_excess'].'</td>
			                ';



			                $total_pp_quantity = $row_Greige_Receiving['pp_quantity_pwvci'];
			                $greige_total_quantity = $row_Greige_Receiving['greige_qty'];
							$greige_short_excess_qty = $row_Greige_Receiving['short_excess'];

			}
			
			$sql_for_first_process = "SELECT partial_test_for_test_result_id, partial_test_for_test_result_creation_date from 
			(select DISTINCT partial_test_for_test_result_id, partial_test_for_test_result_creation_date
			from partial_test_for_test_result_info WHERE pp_number = '".$row['pp_number']."' 
			ORDER BY partial_test_for_test_result_id asc limit 2) as partial_test_id 
			ORDER BY partial_test_for_test_result_id DESC limit 1";  
				
			$result_for_first_process = mysqli_query($con,$sql_for_first_process) or die(mysqli_error($con));
			$row_for_first_process = mysqli_fetch_array( $result_for_first_process);
			
			$partial_test_for_test_result_creation_date = $row_for_first_process['partial_test_for_test_result_creation_date'];
		
			$process_start_date = date("m-d-Y", strtotime($partial_test_for_test_result_creation_date));
			if($process_start_date == '01-01-1970')
			{
				$table .='<td style="border: 1px solid black"></td>';
			}
			else
			{
				$table .='<td style="border: 1px solid black">'.$process_start_date.'</td>';
			}
			 
	

				/////////////////////////////////// Singeing ///////////////////////////////////

				$sql_Singeing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.process_name,ptri.style,ptri.finish_width_in_inch,
									ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
									date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
									,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
									
									From partial_test_for_test_result_info ptri 
									where ptri.process_id='proc_21'
									and ptri.process_name='Singeing'
									and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_Singeing = mysqli_query($con,$sql_Singeing) or die(mysqli_error($con));
	
				while( $row_Singeing = mysqli_fetch_array( $result_Singeing))
				{  
					
					$table .='<td style="border: 1px solid black">'.$row_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Singeing['after_trolley_or_batcher_qty'];			
					}
					$singeing_qty = $row_Singeing['after_trolley_or_batcher_qty'];

					if($row_Singeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Singeing['process_start_date'];
					}	

				
					if($row_Singeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Singeing['pp_number'];
						$version_number_for_folding = $row_Singeing['version_number'];
						$process_name_for_folding = $row_Singeing['process_name'];
						$style_name_for_folding = $row_Singeing['style'];
						$finish_width_in_inch_for_folding = $row_Singeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Singeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Singeing['after_trolley_number_or_batcher_number'];

					}
					
				}
	
				// Re-Singeing
				$sql_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.process_name,ptri.finish_width_in_inch,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
							date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
							,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
							From partial_test_for_test_result_info ptri 
							where ptri.process_id='proc_21'
							and ptri.process_name='Re-Singeing'
							and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Singeing = mysqli_query($con,$sql_Re_Singeing) or die(mysqli_error($con));

				while( $row_Re_Singeing = mysqli_fetch_array( $result_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Singeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Singeing['after_trolley_or_batcher_qty'];	
					}
					
					$re_singeing_qty = $row_Re_Singeing['after_trolley_or_batcher_qty'];

					if($row_Re_Singeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Singeing['process_start_date'];
					}	

					if($row_Re_Singeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Singeing['pp_number'];
						$version_number_for_folding = $row_Re_Singeing['version_number'];
						$process_name_for_folding = $row_Re_Singeing['process_name'];
						$style_name_for_folding = $row_Re_Singeing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Singeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Singeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Singeing['after_trolley_number_or_batcher_number'];
					}
					
				}

				// 2nd-Re-Singeing
				$sql_2nd_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.process_name,ptri.finish_width_in_inch,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
							date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
							,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
							From partial_test_for_test_result_info ptri 
							where ptri.process_id='proc_21'
							and ptri.process_name='2nd-Re-Singeing'
							and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Singeing = mysqli_query($con,$sql_2nd_Re_Singeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Singeing = mysqli_fetch_array( $result_2nd_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Singeing['after_trolley_or_batcher_qty'];			
					}
					$second_re_singeing_qty = $row_2nd_Re_Singeing['after_trolley_or_batcher_qty'];
					
					if($row_2nd_Re_Singeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Singeing['process_start_date'];
					}	
					if($row_2nd_Re_Singeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Singeing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Singeing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Singeing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Singeing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Singeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Singeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Singeing['after_trolley_number_or_batcher_number'];
					}		
				}

				// 3rd-Re-Singeing
				$sql_3rd_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.process_name,ptri.finish_width_in_inch,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
									date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
									,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
									
									From partial_test_for_test_result_info ptri 
									where ptri.process_id='proc_21'
									and ptri.process_name='3rd-Re-Singeing'
									and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_3rd_Re_Singeing = mysqli_query($con,$sql_3rd_Re_Singeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Singeing = mysqli_fetch_array( $result_3rd_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];	
							$reprocess_quantity+=$row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];
						}	
						$third_re_singeing_qty = $row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];	
						
					if($row_3rd_Re_Singeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Singeing['process_start_date'];
					}	

					if($row_3rd_Re_Singeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Singeing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Singeing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Singeing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Singeing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Singeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Singeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Singeing['after_trolley_number_or_batcher_number'];
					}

				}
	
				// 4th-Re-Singeing 
				$sql_4th_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.process_name,ptri.finish_width_in_inch,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_21'
								and ptri.process_name='4th-Re-Singeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Singeing = mysqli_query($con,$sql_4th_Re_Singeing) or die(mysqli_error($con));

				while( $row_4th_Re_Singeing  = mysqli_fetch_array( $result_4th_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Singeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Singeing['after_trolley_or_batcher_qty'];
					}	
					$forth_re_singeing_qty = $row_4th_Re_Singeing['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Singeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Singeing['process_start_date'];
					}

					if($row_4th_Re_Singeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Singeing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Singeing['version_number'];
						$process_name_for_folding = $row_4th_Re_Singeing['process_name'];
						$style_name_for_folding = $row_4th_Re_Singeing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Singeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Singeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Singeing['after_trolley_number_or_batcher_number'];
					}
		
				}  

				/////////////////////////////////// Desizing ///////////////////////////////////

				$sql_Desizing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.process_name,ptri.style,ptri.finish_width_in_inch,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_Desizing= mysqli_query($con,$sql_Desizing) or die(mysqli_error($con));

				while( $row_Desizing = mysqli_fetch_array( $result_Desizing))
				{  
					$table .='<td style="border: 1px solid black">'.$row_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Desizing['after_trolley_or_batcher_qty'];			
					}
					$desizing_qty = $row_Desizing['after_trolley_or_batcher_qty'];	
					
					if($row_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Desizing['process_start_date'];
					}
					if($row_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Desizing['pp_number'];
						$version_number_for_folding = $row_Desizing['version_number'];
						$process_name_for_folding = $row_Desizing['process_name'];
						$style_name_for_folding = $row_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Desizing['after_trolley_number_or_batcher_number'];
					}	
				}
	
				// Re-Desizing
				$sql_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";	
				
				$result_Re_Desizing= mysqli_query($con,$sql_Re_Desizing) or die(mysqli_error($con));

				while( $row_Re_Desizing = mysqli_fetch_array( $result_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Desizing['after_trolley_or_batcher_qty'];	
					}
					$re_desizing_qty = $row_Re_Desizing['after_trolley_or_batcher_qty'];
									
					if($row_Re_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Desizing['process_start_date'];
					}

					if($row_Re_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Desizing['pp_number'];
						$version_number_for_folding = $row_Re_Desizing['version_number'];
						$process_name_for_folding = $row_Re_Desizing['process_name'];
						$style_name_for_folding = $row_Re_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Desizing['after_trolley_number_or_batcher_number'];
					}
				}
	
				// 2nd-Re-Desizing
				$sql_2nd_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='2nd-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Desizing= mysqli_query($con,$sql_2nd_Re_Desizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Desizing = mysqli_fetch_array( $result_2nd_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Desizing['after_trolley_or_batcher_qty'];			
					}
					$second_re_desizing_qty = $row_2nd_Re_Desizing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Desizing['process_start_date'];
					}
					if($row_2nd_Re_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Desizing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Desizing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Desizing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Desizing['after_trolley_number_or_batcher_number'];
					}
				}
	
				// 3rd-Re-Desizing
				$sql_3rd_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='3rd-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Desizing= mysqli_query($con,$sql_3rd_Re_Desizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Desizing = mysqli_fetch_array( $result_3rd_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';
					if($row_3rd_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];
					}	
					$third_re_desizing_qty = $row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];	
					
					if($row_3rd_Re_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Desizing['process_start_date'];
					}

					if($row_3rd_Re_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Desizing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Desizing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Desizing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Desizing['after_trolley_number_or_batcher_number'];
					}

				}
	
				// 4th-Re-Desizing
				$sql_4th_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='4th-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Desizing= mysqli_query($con,$sql_4th_Re_Desizing) or die(mysqli_error($con));

				while( $row_4th_Re_Desizing = mysqli_fetch_array( $result_4th_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Desizing['after_trolley_or_batcher_qty'];
					}	
					$forth_re_desizing_qty = $row_4th_Re_Desizing['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Desizing['process_start_date'];
					}

					if($row_4th_Re_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Desizing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Desizing['version_number'];
						$process_name_for_folding = $row_4th_Re_Desizing['process_name'];
						$style_name_for_folding = $row_4th_Re_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Desizing['after_trolley_number_or_batcher_number'];
					}
	
				}   

				/////////////////////////////////// Singeing & Desizing ///////////////////////////////////

				$sql_Singeing_Desizing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.process_name,
								ptri.style,ptri.finish_width_in_inch,ptri.before_trolley_number_or_batcher_number, 
								ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Singeing_Desizing= mysqli_query($con,$sql_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_Singeing_Desizing = mysqli_fetch_array( $result_Singeing_Desizing))
				{ 
					$table .='<td style="border: 1px solid black">'.$row_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Singeing_Desizing['after_trolley_or_batcher_qty'];			
					}
					$signe_desize_qty = $row_Singeing_Desizing['after_trolley_or_batcher_qty'];		
					
					if($row_Singeing_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Singeing_Desizing['process_start_date'];
					}

					if($row_Singeing_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Singeing_Desizing['pp_number'];
						$version_number_for_folding = $row_Singeing_Desizing['version_number'];
						$process_name_for_folding = $row_Singeing_Desizing['process_name'];
						$style_name_for_folding = $row_Singeing_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_Singeing_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Singeing_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Singeing_Desizing['after_trolley_number_or_batcher_number'];
					}

				}

				// Re-Singeing & Desizing
				$sql_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Singeing_Desizing= mysqli_query($con,$sql_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_Re_Singeing_Desizing = mysqli_fetch_array( $result_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
					}
					
					$re_signe_desizing_qty = $row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];

					if($row_Re_Singeing_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Singeing_Desizing['process_start_date'];
					}

					if($row_Re_Singeing_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Singeing_Desizing['pp_number'];
						$version_number_for_folding = $row_Re_Singeing_Desizing['version_number'];
						$process_name_for_folding = $row_Re_Singeing_Desizing['process_name'];
						$style_name_for_folding = $row_Re_Singeing_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Singeing_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Singeing_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Singeing_Desizing['after_trolley_number_or_batcher_number'];
					}
									
				}

				// 2nd-Re-Singeing & Desizing
				$sql_2nd_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='2nd-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Singeing_Desizing= mysqli_query($con,$sql_2nd_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Singeing_Desizing = mysqli_fetch_array( $result_2nd_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];			
					}
					$second_re_signe_desizing_qty = $row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Singeing_Desizing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Singeing_Desizing['process_start_date'];
					}

					if($row_2nd_Re_Singeing_Desizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Singeing_Desizing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Singeing_Desizing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Singeing_Desizing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Singeing_Desizing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Singeing_Desizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Singeing_Desizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Singeing_Desizing['after_trolley_number_or_batcher_number'];
					}
									
				}

				// 3rd-Re-Singeing & Desizing
				$sql_3rd_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='3rd-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Singeing_Desizing= mysqli_query($con,$sql_3rd_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Singeing_Desizing = mysqli_fetch_array( $result_3rd_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
							$reprocess_quantity+=$row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						}	
						
						$third_re_signe_desizing_qty = $row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
						
						if($row_3rd_Re_Singeing_Desizing['process_start_date']!= '')
						{
							$process_completetion_date = $row_3rd_Re_Singeing_Desizing['process_start_date'];
						}

						if($row_3rd_Re_Singeing_Desizing['process_name'] != '')
						{		
							$pp_number_for_folding = $row_3rd_Re_Singeing_Desizing['pp_number'];
							$version_number_for_folding = $row_3rd_Re_Singeing_Desizing['version_number'];
							$process_name_for_folding = $row_3rd_Re_Singeing_Desizing['process_name'];
							$style_name_for_folding = $row_3rd_Re_Singeing_Desizing['style'];
							$finish_width_in_inch_for_folding = $row_3rd_Re_Singeing_Desizing['finish_width_in_inch'];
							$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Singeing_Desizing['before_trolley_number_or_batcher_number'];
							$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Singeing_Desizing['after_trolley_number_or_batcher_number'];
						}		
									

				}

				// 4th-Re-Singeing & Desizing
				$sql_4th_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='4th-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Singeing_Desizing= mysqli_query($con,$sql_4th_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_4th_Re_Singeing_Desizing = mysqli_fetch_array( $result_4th_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
							$reprocess_quantity+=$row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						}	
						$forth_re_signe_desizing_qty = $row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
						
						if($row_4th_Re_Singeing_Desizing['process_start_date']!= '')
						{
							$process_completetion_date = $row_4th_Re_Singeing_Desizing['process_start_date'];
						}

						if($row_4th_Re_Singeing_Desizing['process_name'] != '')
						{					
							$pp_number_for_folding = $row_4th_Re_Singeing_Desizing['pp_number'];
							$version_number_for_folding = $row_4th_Re_Singeing_Desizing['version_number'];
							$process_name_for_folding = $row_4th_Re_Singeing_Desizing['process_name'];
							$style_name_for_folding = $row_4th_Re_Singeing_Desizing['style'];
							$finish_width_in_inch_for_folding = $row_4th_Re_Singeing_Desizing['finish_width_in_inch'];
							$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Singeing_Desizing['before_trolley_number_or_batcher_number'];
							$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Singeing_Desizing['after_trolley_number_or_batcher_number'];
						}
		
				}   

				////////////////////////////////// Scouring //////////////////////////////////

				$sql_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Scouring= mysqli_query($con,$sql_Scouring) or die(mysqli_error($con));

				while( $row_Scouring = mysqli_fetch_array( $result_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Scouring['after_trolley_or_batcher_qty'];
					}
					$scouring_qty = $row_Scouring['after_trolley_or_batcher_qty'];	
					
					if($row_Scouring['process_start_date']!= '')
						{
							$process_completetion_date = $row_Scouring['process_start_date'];
						}

					if($row_Scouring['process_name'] != '')
					{						
						$pp_number_for_folding = $row_Scouring['pp_number'];
						$version_number_for_folding = $row_Scouring['version_number'];
						$process_name_for_folding = $row_Scouring['process_name'];
						$style_name_for_folding = $row_Scouring['style'];
						$finish_width_in_inch_for_folding = $row_Scouring['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Scouring['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Scouring['after_trolley_number_or_batcher_number'];
					}
				}

				// Re-Scouring
				$sql_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Scouring= mysqli_query($con,$sql_Re_Scouring) or die(mysqli_error($con));

				while( $row_Re_Scouring = mysqli_fetch_array( $result_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$re_scouring_qty = $row_Re_Scouring['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Scouring['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Scouring['process_start_date'];
					}

					if($row_Re_Scouring['process_name'] != '')
					{								
						$pp_number_for_folding = $row_Re_Scouring['pp_number'];
						$version_number_for_folding = $row_Re_Scouring['version_number'];
						$process_name_for_folding = $row_Re_Scouring['process_name'];
						$style_name_for_folding = $row_Re_Scouring['style'];
						$finish_width_in_inch_for_folding = $row_Re_Scouring['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Scouring['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Scouring['after_trolley_number_or_batcher_number'];
					}
				}

				// 2nd-Re-Scouring
				$sql_2nd_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='2nd-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Scouring= mysqli_query($con,$sql_2nd_Re_Scouring) or die(mysqli_error($con));

				while( $row_2nd_Re_Scouring = mysqli_fetch_array( $result_2nd_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$second_re_scouring_qty = $row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Scouring['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Scouring['process_start_date'];
					}

					if($row_2nd_Re_Scouring['process_name'] != '')
					{								
						$pp_number_for_folding = $row_2nd_Re_Scouring['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Scouring['version_number'];
						$process_name_for_folding = $row_2nd_Re_Scouring['process_name'];
						$style_name_for_folding = $row_2nd_Re_Scouring['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Scouring['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Scouring['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Scouring['after_trolley_number_or_batcher_number'];
					}
				}

				// 3rd-Re-Scouring
				$sql_3rd_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='3rd-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Scouring= mysqli_query($con,$sql_3rd_Re_Scouring) or die(mysqli_error($con));

				while( $row_3rd_Re_Scouring = mysqli_fetch_array( $result_3rd_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$third_re_scouring_qty = $row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];	
					
					if($row_3rd_Re_Scouring['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Scouring['process_start_date'];
					}

					if($row_3rd_Re_Scouring['process_name'] != '')
					{										
						$pp_number_for_folding = $row_3rd_Re_Scouring['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Scouring['version_number'];
						$process_name_for_folding = $row_3rd_Re_Scouring['process_name'];
						$style_name_for_folding = $row_3rd_Re_Scouring['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Scouring['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Scouring['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Scouring['after_trolley_number_or_batcher_number'];
					}
				}

				// 4th-Re-Scouring
				$sql_4th_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='4th-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Scouring= mysqli_query($con,$sql_4th_Re_Scouring) or die(mysqli_error($con));

				while( $row_4th_Re_Scouring = mysqli_fetch_array( $result_4th_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$forth_re_scouring_qty = $row_4th_Re_Scouring['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Scouring['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Scouring['process_start_date'];
					}

					if($row_4th_Re_Scouring['process_name'] != '')
					{										
						$pp_number_for_folding = $row_4th_Re_Scouring['pp_number'];
						$version_number_for_folding = $row_4th_Re_Scouring['version_number'];
						$process_name_for_folding = $row_4th_Re_Scouring['process_name'];
						$style_name_for_folding = $row_4th_Re_Scouring['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Scouring['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Scouring['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Scouring['after_trolley_number_or_batcher_number'];
					}
				}

				////////////////////////////////// Bleaching //////////////////////////////////

				$sql_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Bleaching= mysqli_query($con,$sql_Bleaching) or die(mysqli_error($con));

				while( $row_Bleaching = mysqli_fetch_array( $result_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Bleaching['after_trolley_or_batcher_qty'];
					}
					$bleaching_qty = $row_Bleaching['after_trolley_or_batcher_qty'];
					
					if($row_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_Bleaching['process_start_date'];
					}

					if($row_Bleaching['process_name'] != '')
					{											
						$pp_number_for_folding = $row_Bleaching['pp_number'];
						$version_number_for_folding = $row_Bleaching['version_number'];
						$process_name_for_folding = $row_Bleaching['process_name'];
						$style_name_for_folding = $row_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Bleaching['after_trolley_number_or_batcher_number'];
					}
				}

				// Re-Bleaching
				$sql_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Bleaching= mysqli_query($con,$sql_Re_Bleaching) or die(mysqli_error($con));

				while( $row_Re_Bleaching = mysqli_fetch_array( $result_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$re_bleaching_qty = $row_Re_Bleaching['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Bleaching['process_start_date'];
					}

					if($row_Re_Bleaching['process_name'] != '')
					{												
						$pp_number_for_folding = $row_Re_Bleaching['pp_number'];
						$version_number_for_folding = $row_Re_Bleaching['version_number'];
						$process_name_for_folding = $row_Re_Bleaching['process_name'];
						$style_name_for_folding = $row_Re_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_Re_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Bleaching['after_trolley_number_or_batcher_number'];
					}
				}

				// 2nd-Re-Bleaching
				$sql_2nd_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='2nd-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Bleaching= mysqli_query($con,$sql_2nd_Re_Bleaching) or die(mysqli_error($con));

				while( $row_2nd_Re_Bleaching = mysqli_fetch_array( $result_2nd_Re_Bleaching))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$second_re_bleaching_qty = $row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Bleaching['process_start_date'];
					}

					if($row_2nd_Re_Bleaching['process_name'] != '')
					{											
						$pp_number_for_folding = $row_2nd_Re_Bleaching['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Bleaching['version_number'];
						$process_name_for_folding = $row_2nd_Re_Bleaching['process_name'];
						$style_name_for_folding = $row_2nd_Re_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Bleaching['after_trolley_number_or_batcher_number'];
					}
				}

				// 3rd-Re-Bleaching
				$sql_3rd_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='3rd-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Bleaching= mysqli_query($con,$sql_3rd_Re_Bleaching) or die(mysqli_error($con));

				while( $row_3rd_Re_Bleaching = mysqli_fetch_array( $result_3rd_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$third_re_bleaching_qty = $row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Bleaching['process_start_date'];
					}
					if($row_3rd_Re_Bleaching['process_name'] != '')
					{	
						$pp_number_for_folding = $row_3rd_Re_Bleaching['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Bleaching['version_number'];
						$process_name_for_folding = $row_3rd_Re_Bleaching['process_name'];
						$style_name_for_folding = $row_3rd_Re_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Bleaching['after_trolley_number_or_batcher_number'];
					}
				}

				// 4th-Re-Bleaching
				$sql_4th_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='4th-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Bleaching= mysqli_query($con,$sql_4th_Re_Bleaching) or die(mysqli_error($con));

				while( $row_4th_Re_Bleaching = mysqli_fetch_array( $result_4th_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$forth_re_bleaching_qty = $row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Bleaching['process_start_date'];
					}

					if($row_4th_Re_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Bleaching['pp_number'];
						$version_number_for_folding = $row_4th_Re_Bleaching['version_number'];
						$process_name_for_folding = $row_4th_Re_Bleaching['process_name'];
						$style_name_for_folding = $row_4th_Re_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Bleaching['after_trolley_number_or_batcher_number'];
							
					}
					
				}
			
				////////////////////////////////// Scouring & Bleaching //////////////////////////////////
				$sql_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Scouring_Bleaching= mysqli_query($con,$sql_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_Scouring_Bleaching = mysqli_fetch_array( $result_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$scouring_bleaching_qty = $row_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					
					if($row_Scouring_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_Scouring_Bleaching['process_start_date'];
					}

					if($row_Scouring_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_Scouring_Bleaching['pp_number'];
						$version_number_for_folding = $row_Scouring_Bleaching['version_number'];
						$process_name_for_folding = $row_Scouring_Bleaching['process_name'];
						$style_name_for_folding = $row_Scouring_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_Scouring_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Scouring_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Scouring_Bleaching['after_trolley_number_or_batcher_number'];
							
					}	
					
				}

				// Re-Scouring & Bleaching
				$sql_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Scouring_Bleaching= mysqli_query($con,$sql_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_Re_Scouring_Bleaching = mysqli_fetch_array( $result_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$re_scouring_bleaching_qty = $row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					
					if($row_Re_Scouring_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Scouring_Bleaching['process_start_date'];
					}
					if($row_Re_Scouring_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Scouring_Bleaching['pp_number'];
						$version_number_for_folding = $row_Re_Scouring_Bleaching['version_number'];
						$process_name_for_folding = $row_Re_Scouring_Bleaching['process_name'];
						$style_name_for_folding = $row_Re_Scouring_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_Re_Scouring_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Scouring_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Scouring_Bleaching['after_trolley_number_or_batcher_number'];
							
					}
					
		
				}

				// 2nd-Re-Scouring_Bleaching
				$sql_2nd_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='2nd-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Scouring_Bleaching= mysqli_query($con,$sql_2nd_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_2nd_Re_Scouring_Bleaching = mysqli_fetch_array( $result_2nd_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$second_re_scouring_bleaching_qty = $row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Scouring_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Scouring_Bleaching['process_start_date'];
					}

					if($row_2nd_Re_Scouring_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Scouring_Bleaching['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Scouring_Bleaching['version_number'];
						$process_name_for_folding = $row_2nd_Re_Scouring_Bleaching['process_name'];
						$style_name_for_folding = $row_2nd_Re_Scouring_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Scouring_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Scouring_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Scouring_Bleaching['after_trolley_number_or_batcher_number'];
							
			
					}
					
			
				}

				// 3rd-Re-Scouring_Bleaching
				$sql_3rd_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='3rd-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Scouring_Bleaching= mysqli_query($con,$sql_3rd_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_3rd_Re_Scouring_Bleaching = mysqli_fetch_array( $result_3rd_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
							$reprocess_quantity+=$row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						}
					$third_re_scouring_bleaching_qty = $row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];	
					
					if($row_3rd_Re_Scouring_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Scouring_Bleaching['process_start_date'];
					}

					if($row_3rd_Re_Scouring_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Scouring_Bleaching['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Scouring_Bleaching['version_number'];
						$process_name_for_folding = $row_3rd_Re_Scouring_Bleaching['process_name'];
						$style_name_for_folding = $row_3rd_Re_Scouring_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Scouring_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Scouring_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Scouring_Bleaching['after_trolley_number_or_batcher_number'];
							
					}
					
		
			
			
				}

				// 4th-Re-Scouring_Bleaching
				$sql_4th_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='4th-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Scouring_Bleaching= mysqli_query($con,$sql_4th_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_4th_Re_Scouring_Bleaching = mysqli_fetch_array( $result_4th_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$forth_re_scouring_bleaching_qty = $row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Scouring_Bleaching['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Scouring_Bleaching['process_start_date'];
					}
					if($row_4th_Re_Scouring_Bleaching['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Scouring_Bleaching['pp_number'];
						$version_number_for_folding = $row_4th_Re_Scouring_Bleaching['version_number'];
						$process_name_for_folding = $row_4th_Re_Scouring_Bleaching['process_name'];
						$style_name_for_folding = $row_4th_Re_Scouring_Bleaching['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Scouring_Bleaching['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Scouring_Bleaching['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Scouring_Bleaching['after_trolley_number_or_batcher_number'];
							
					}
					
		
									
				}
				
				////////////////////////// Ready Fro Mercerize //////////////////////////

				$sql_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Mercerize= mysqli_query($con,$sql_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_Ready_For_Mercerize = mysqli_fetch_array( $result_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
					}			
					$Ready_For_Mercerize_qty = $row_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					
					if($row_Ready_For_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_Ready_For_Mercerize['process_start_date'];
					}
					if($row_Ready_For_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_Ready_For_Mercerize['pp_number'];
						$version_number_for_folding = $row_Ready_For_Mercerize['version_number'];
						$process_name_for_folding = $row_Ready_For_Mercerize['process_name'];
						$style_name_for_folding = $row_Ready_For_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_Ready_For_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Mercerize['after_trolley_number_or_batcher_number'];
								
					}
					
		
				}

				//Re-Ready For Mercerize
				$sql_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Mercerize= mysqli_query($con,$sql_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
					}			
					$re_Ready_For_Mercerize_qty = $row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Ready_For_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Ready_For_Mercerize['process_start_date'];
					}
					if($row_Re_Ready_For_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Ready_For_Mercerize['pp_number'];
						$version_number_for_folding = $row_Re_Ready_For_Mercerize['version_number'];
						$process_name_for_folding = $row_Re_Ready_For_Mercerize['process_name'];
						$style_name_for_folding = $row_Re_Ready_For_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_Re_Ready_For_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				//2nd-Re-Ready For Mercerize
				$sql_2nd_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date,
								sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='2nd-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Mercerize= mysqli_query($con,$sql_2nd_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_2nd_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];

					}			
					$second_re_Ready_For_Mercerize_qty = $row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Ready_For_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Ready_For_Mercerize['process_start_date'];
					}

					if($row_2nd_Re_Ready_For_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Ready_For_Mercerize['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Ready_For_Mercerize['version_number'];
						$process_name_for_folding = $row_2nd_Re_Ready_For_Mercerize['process_name'];
						$style_name_for_folding = $row_2nd_Re_Ready_For_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Ready_For_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
		
				}

				//3rd-Re-Ready For Mercerize
				$sql_3rd_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='3rd-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Mercerize= mysqli_query($con,$sql_3rd_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_3rd_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$third_re_Ready_For_Mercerize_qty = $row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Ready_For_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Ready_For_Mercerize['process_start_date'];
					}

					if($row_3rd_Re_Ready_For_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Ready_For_Mercerize['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Ready_For_Mercerize['version_number'];
						$process_name_for_folding = $row_3rd_Re_Ready_For_Mercerize['process_name'];
						$style_name_for_folding = $row_3rd_Re_Ready_For_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Ready_For_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Mercerize['after_trolley_number_or_batcher_number'];
							
					}	
					
		

				}

				//4th-Re-Ready For Mercerize
				$sql_4th_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='4th-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Mercerize= mysqli_query($con,$sql_4th_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_4th_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					}			
					$forth_re_Ready_For_Mercerize_qty = $row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Ready_For_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Ready_For_Mercerize['process_start_date'];
					}
					if($row_4th_Re_Ready_For_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Ready_For_Mercerize['pp_number'];
						$version_number_for_folding = $row_4th_Re_Ready_For_Mercerize['version_number'];
						$process_name_for_folding = $row_4th_Re_Ready_For_Mercerize['process_name'];
						$style_name_for_folding = $row_4th_Re_Ready_For_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Ready_For_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
							
					
		
		
				}

				//////////////////////////// Mercerize //////////////////////////

				 $sql_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
				 							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Mercerize= mysqli_query($con,$sql_Mercerize) or die(mysqli_error($con));

				while( $row_Mercerize = mysqli_fetch_array( $result_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$mercerize_qty = $row_Mercerize['after_trolley_or_batcher_qty'];	
					
					if($row_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_Mercerize['process_start_date'];
					}
					if($row_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_Mercerize['pp_number'];
						$version_number_for_folding = $row_Mercerize['version_number'];
						$process_name_for_folding = $row_Mercerize['process_name'];
						$style_name_for_folding = $row_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
			
				}

				// Re-Mercerize
				$sql_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Mercerize= mysqli_query($con,$sql_Re_Mercerize) or die(mysqli_error($con));

				while( $row_Re_Mercerize = mysqli_fetch_array( $result_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';
					if($row_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$re_mercerize_qty = $row_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
					if($row_Re_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Mercerize['process_start_date'];
					}

					if($row_Re_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Mercerize['pp_number'];
						$version_number_for_folding = $row_Re_Mercerize['version_number'];
						$process_name_for_folding = $row_Re_Mercerize['process_name'];
						$style_name_for_folding = $row_Re_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_Re_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// 2nd-Re-Mercerize
				$sql_2nd_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='2nd-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Mercerize= mysqli_query($con,$sql_2nd_Re_Mercerize) or die(mysqli_error($con));

				while( $row_2nd_Re_Mercerize = mysqli_fetch_array( $result_2nd_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';
					if($row_2nd_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}	
					$second_re_mercerize_qty = $row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
					if($row_2nd_Re_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Mercerize['process_start_date'];
					}
					if($row_2nd_Re_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Mercerize['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Mercerize['version_number'];
						$process_name_for_folding = $row_2nd_Re_Mercerize['process_name'];
						$style_name_for_folding = $row_2nd_Re_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// 3rd-Re-Mercerize
				$sql_3rd_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='3rd-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Mercerize= mysqli_query($con,$sql_3rd_Re_Mercerize) or die(mysqli_error($con));

				while( $row_3rd_Re_Mercerize = mysqli_fetch_array( $result_3rd_Re_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_3rd_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}		
					$third_re_mercerize_qty = $row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
					if($row_3rd_Re_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Mercerize['process_start_date'];
					}
					if($row_3rd_Re_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Mercerize['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Mercerize['version_number'];
						$process_name_for_folding = $row_3rd_Re_Mercerize['process_name'];
						$style_name_for_folding = $row_3rd_Re_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// 4th-Re-Mercerize
				$sql_4th_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='4th-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Mercerize= mysqli_query($con,$sql_4th_Re_Mercerize) or die(mysqli_error($con));

				while( $row_4th_Re_Mercerize = mysqli_fetch_array( $result_4th_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_4th_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_4th_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}			
					$forth_re_mercerize_qty = $row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
					if($row_4th_Re_Mercerize['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Mercerize['process_start_date'];
					}

					if($row_4th_Re_Mercerize['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Mercerize['pp_number'];
						$version_number_for_folding = $row_4th_Re_Mercerize['version_number'];
						$process_name_for_folding = $row_4th_Re_Mercerize['process_name'];
						$style_name_for_folding = $row_4th_Re_Mercerize['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Mercerize['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Mercerize['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Mercerize['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				/////////////////////////// Ready For Print ///////////////////////////////

				$sql_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Print= mysqli_query($con,$sql_Ready_For_Print) or die(mysqli_error($con));

				while( $row_Ready_For_Print = mysqli_fetch_array( $result_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Print['after_trolley_or_batcher_qty'];
					}
					$Ready_For_Print_qty = $row_Ready_For_Print['after_trolley_or_batcher_qty'];
					
					if($row_Ready_For_Print['process_start_date']!= '')
					{
						$process_completetion_date = $row_Ready_For_Print['process_start_date'];
					}

					if($row_Ready_For_Print['process_name'] != '')
					{
						$pp_number_for_folding = $row_Ready_For_Print['pp_number'];
						$version_number_for_folding = $row_Ready_For_Print['version_number'];
						$process_name_for_folding = $row_Ready_For_Print['process_name'];
						$style_name_for_folding = $row_Ready_For_Print['style'];
						$finish_width_in_inch_for_folding = $row_Ready_For_Print['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Print['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Print['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// Re-Ready For Print
				$sql_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Print= mysqli_query($con,$sql_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Print = mysqli_fetch_array( $result_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}				
					$re_Ready_For_Print_qty = $row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Ready_For_Print['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Ready_For_Print['process_start_date'];
					}
					if($row_Re_Ready_For_Print['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Ready_For_Print['pp_number'];
						$version_number_for_folding = $row_Re_Ready_For_Print['version_number'];
						$process_name_for_folding = $row_Re_Ready_For_Print['process_name'];
						$style_name_for_folding = $row_Re_Ready_For_Print['style'];
						$finish_width_in_inch_for_folding = $row_Re_Ready_For_Print['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Print['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Print['after_trolley_number_or_batcher_number'];
							
					}
					
		
				}

				// 2nd-Re-Ready For Print
				$sql_2nd_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='2nd-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Print= mysqli_query($con,$sql_2nd_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Print = mysqli_fetch_array( $result_2nd_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}
					$second_re_Ready_For_Print_qty = $row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];		
		
					if($row_2nd_Re_Ready_For_Print['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Ready_For_Print['process_start_date'];
					}

					if($row_2nd_Re_Ready_For_Print['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Ready_For_Print['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Ready_For_Print['version_number'];
						$process_name_for_folding = $row_2nd_Re_Ready_For_Print['process_name'];
						$style_name_for_folding = $row_2nd_Re_Ready_For_Print['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Ready_For_Print['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Print['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Print['after_trolley_number_or_batcher_number'];
								
					}
					
				}


				// 3rd-Re-Ready For Print
				$sql_3rd_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='3rd-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."'
								";
				
				$result_3rd_Re_Ready_For_Print= mysqli_query($con,$sql_3rd_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Print = mysqli_fetch_array( $result_3rd_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';
					if($row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}			
					$third_re_Ready_For_Print_qty = $row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];	
					
					if($row_3rd_Re_Ready_For_Print['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Ready_For_Print['process_start_date'];
					}
					if($row_3rd_Re_Ready_For_Print['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Ready_For_Print['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Ready_For_Print['version_number'];
						$process_name_for_folding = $row_3rd_Re_Ready_For_Print['process_name'];
						$style_name_for_folding = $row_3rd_Re_Ready_For_Print['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Ready_For_Print['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Print['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Print['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// 4th-Re-Ready For Print
				$sql_4th_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='4th-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Print= mysqli_query($con,$sql_4th_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Print = mysqli_fetch_array( $result_4th_Re_Ready_For_Print))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}		
					$forth_re_Ready_For_Print_qty = $row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					
						
					if($row_4th_Re_Ready_For_Print['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Ready_For_Print['process_start_date'];
					}
					if($row_4th_Re_Ready_For_Print['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Ready_For_Print['pp_number'];
						$version_number_for_folding = $row_4th_Re_Ready_For_Print['version_number'];
						$process_name_for_folding = $row_4th_Re_Ready_For_Print['process_name'];
						$style_name_for_folding = $row_4th_Re_Ready_For_Print['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Ready_For_Print['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Print['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Print['after_trolley_number_or_batcher_number'];
							
					}
					
					
				}

				// printing
				$sql_Printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='Printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Printing= mysqli_query($con,$sql_Printing) or die(mysqli_error($con));

				while( $row_Printing = mysqli_fetch_array( $result_Printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Printing['after_trolley_or_batcher_qty'];	
					}		
					$Print_qty = $row_Printing['after_trolley_or_batcher_qty'];	
					
					if($row_Printing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Printing['process_start_date'];
					}
					if($row_Printing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Printing['pp_number'];
						$version_number_for_folding = $row_Printing['version_number'];
						$process_name_for_folding = $row_Printing['process_name'];
						$style_name_for_folding = $row_Printing['style'];
						$finish_width_in_inch_for_folding = $row_Printing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Printing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Printing['after_trolley_number_or_batcher_number'];
							
					}
					
				
				}

				// Re-printing
				$sql_Re_Printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='Re-Printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Printing= mysqli_query($con,$sql_Re_Printing) or die(mysqli_error($con));

				while( $row_Re_Printing = mysqli_fetch_array($result_Re_Printing))
				{  
					  
					$table .='<td style="border: 1px solid black">'.$row_Re_Printing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Printing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Printing['after_trolley_or_batcher_qty'];
					}			
					$re_Print_qty = $row_Re_Printing['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Printing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Printing['process_start_date'];
					}
					if($row_Re_Printing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Printing['pp_number'];
						$version_number_for_folding = $row_Re_Printing['version_number'];
						$process_name_for_folding = $row_Re_Printing['process_name'];
						$style_name_for_folding = $row_Re_Printing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Printing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Printing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Printing['after_trolley_number_or_batcher_number'];
							
					}
					
				
				}

				// 2nd-Re-printing
				$sql_2nd_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='2nd-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_printing= mysqli_query($con,$sql_2nd_Re_printing) or die(mysqli_error($con));

				while( $row_2nd_Re_printing = mysqli_fetch_array( $result_2nd_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_printing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_printing['after_trolley_or_batcher_qty'];	
					}		
					$second_re_Print_qty = $row_2nd_Re_printing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_printing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_printing['process_start_date'];
					}
					if($row_2nd_Re_printing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_printing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_printing['version_number'];
						$process_name_for_folding = $row_2nd_Re_printing['process_name'];
						$style_name_for_folding = $row_2nd_Re_printing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_printing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_printing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_printing['after_trolley_number_or_batcher_number'];
								
					}
					
				
				}

				// 3rd-Re-printing
				$sql_3rd_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='3rd-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_printing= mysqli_query($con,$sql_3rd_Re_printing) or die(mysqli_error($con));

				while( $row_3rd_Re_printing = mysqli_fetch_array( $result_3rd_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_printing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_printing['after_trolley_or_batcher_qty'];			
					}
					$third_re_Print_qty = $row_3rd_Re_printing['after_trolley_or_batcher_qty'];	
					
						
					if($row_3rd_Re_printing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_printing['process_start_date'];
					}
					if($row_3rd_Re_printing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_printing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_printing['version_number'];
						$process_name_for_folding = $row_3rd_Re_printing['process_name'];
						$style_name_for_folding = $row_3rd_Re_printing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_printing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_printing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_printing['after_trolley_number_or_batcher_number'];
							
					}
					

		
				}

				// 4th-Re-printing
				$sql_4th_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='4th-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_printing= mysqli_query($con,$sql_4th_Re_printing) or die(mysqli_error($con));

				while( $row_4th_Re_printing = mysqli_fetch_array( $result_4th_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_printing['after_trolley_or_batcher_qty'];	

						$reprocess_quantity+=$row_4th_Re_printing['after_trolley_or_batcher_qty'];		
					}
					$forth_re_Print_qty = $row_4th_Re_printing['after_trolley_or_batcher_qty'];
					
							
					if($row_4th_Re_printing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_printing['process_start_date'];
					}
					if($row_4th_Re_printing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_printing['pp_number'];
						$version_number_for_folding = $row_4th_Re_printing['version_number'];
						$process_name_for_folding = $row_4th_Re_printing['process_name'];
						$style_name_for_folding = $row_4th_Re_printing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_printing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_printing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_printing['after_trolley_number_or_batcher_number'];
							
					}
				

				}

				// Curing
				$sql_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Curing= mysqli_query($con,$sql_Curing) or die(mysqli_error($con));

				while( $row_Curing = mysqli_fetch_array( $result_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Curing['after_trolley_or_batcher_qty'];	
					}		
					$curing_qty = $row_Curing['after_trolley_or_batcher_qty'];		

					if($row_Curing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Curing['process_start_date'];
					}
					if($row_Curing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Curing['pp_number'];
						$version_number_for_folding = $row_Curing['version_number'];
						$process_name_for_folding = $row_Curing['process_name'];
						$style_name_for_folding = $row_Curing['style'];
						$finish_width_in_inch_for_folding = $row_Curing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Curing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Curing['after_trolley_number_or_batcher_number'];
							
					}
					
				
				}

				// Re-Curing
				$sql_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Curing= mysqli_query($con,$sql_Re_Curing) or die(mysqli_error($con));

				while( $row_Re_Curing = mysqli_fetch_array( $result_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$re_curing_qty = $row_Re_Curing['after_trolley_or_batcher_qty'];
					
					if($row_Re_Curing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Curing['process_start_date'];
					}
					if($row_Re_Curing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Curing['pp_number'];
						$version_number_for_folding = $row_Re_Curing['version_number'];
						$process_name_for_folding = $row_Re_Curing['process_name'];
						$style_name_for_folding = $row_Re_Curing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Curing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Curing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Curing['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// 2nd-Re-Curing
				$sql_2nd_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='2nd-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Curing= mysqli_query($con,$sql_2nd_Re_Curing) or die(mysqli_error($con));

				while( $row_2nd_Re_Curing = mysqli_fetch_array( $result_2nd_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$second_re_curing_qty = $row_2nd_Re_Curing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Curing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Curing['process_start_date'];
					}

					if($row_2nd_Re_Curing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Curing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Curing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Curing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Curing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Curing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Curing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Curing['after_trolley_number_or_batcher_number'];
							
					}
				

				}

				// 3rd-Re-Curing
				$sql_3rd_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='3rd-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Curing= mysqli_query($con,$sql_3rd_Re_Curing) or die(mysqli_error($con));

				while( $row_3rd_Re_Curing = mysqli_fetch_array( $result_3rd_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$third_re_curing_qty = $row_3rd_Re_Curing['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Curing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Curing['process_start_date'];
					}
					if($row_3rd_Re_Curing['process_name'] != '')
					{
									
						$pp_number_for_folding = $row_3rd_Re_Curing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Curing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Curing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Curing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Curing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Curing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Curing['after_trolley_number_or_batcher_number'];
							

					}
					
				}

				// 4th-Re-Curing
				$sql_4th_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='4th-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Curing= mysqli_query($con,$sql_4th_Re_Curing) or die(mysqli_error($con));

				while( $row_4th_Re_Curing = mysqli_fetch_array( $result_4th_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Curing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$forth_re_curing_qty = $row_4th_Re_Curing['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Curing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Curing['process_start_date'];
					}
					if($row_4th_Re_Curing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Curing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Curing['version_number'];
						$process_name_for_folding = $row_4th_Re_Curing['process_name'];
						$style_name_for_folding = $row_4th_Re_Curing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Curing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Curing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Curing['after_trolley_number_or_batcher_number'];
							
	
					}
								
				

				}

				// Steaming
				$sql_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_name='Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Steaming= mysqli_query($con,$sql_Steaming) or die(mysqli_error($con));

				while( $row_Steaming = mysqli_fetch_array( $result_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Steaming['after_trolley_or_batcher_qty'];	
					}		
					$Steaming_qty = $row_Steaming['after_trolley_or_batcher_qty'];
					
					if($row_Steaming['process_start_date']!= '')
					{
						$process_completetion_date = $row_Steaming['process_start_date'];
					}

					if($row_Steaming['process_name'] != '')
					{
						$pp_number_for_folding = $row_Steaming['pp_number'];
						$version_number_for_folding = $row_Steaming['version_number'];
						$process_name_for_folding = $row_Steaming['process_name'];
						$style_name_for_folding = $row_Steaming['style'];
						$finish_width_in_inch_for_folding = $row_Steaming['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Steaming['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Steaming['after_trolley_number_or_batcher_number'];
							
					}			
					

				}

				// Re-Steaming
				$sql_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_name='Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Steaming= mysqli_query($con,$sql_Re_Steaming) or die(mysqli_error($con));

				while( $row_Re_Steaming = mysqli_fetch_array( $result_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Steaming['after_trolley_or_batcher_qty'];	
					}	
					$re_Steaming_qty = $row_Re_Steaming['after_trolley_or_batcher_qty'];
					
						
					if($row_Re_Steaming['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Steaming['process_start_date'];
					}

					if($row_Re_Steaming['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Steaming['pp_number'];
						$version_number_for_folding = $row_Re_Steaming['version_number'];
						$process_name_for_folding = $row_Re_Steaming['process_name'];
						$style_name_for_folding = $row_Re_Steaming['style'];
						$finish_width_in_inch_for_folding = $row_Re_Steaming['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Steaming['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Steaming['after_trolley_number_or_batcher_number'];
							
					}			
					


				}

				// 2nd-Re-Steaming
				$sql_2nd_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_name='2nd-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Steaming= mysqli_query($con,$sql_2nd_Re_Steaming) or die(mysqli_error($con));

				while( $row_2nd_Re_Steaming = mysqli_fetch_array( $result_2nd_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Steaming['after_trolley_or_batcher_qty'];			
					}
					$second_re_Steaming_qty = $row_2nd_Re_Steaming['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Steaming['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Steaming['process_start_date'];
					}
					if($row_2nd_Re_Steaming['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Steaming['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Steaming['version_number'];
						$process_name_for_folding = $row_2nd_Re_Steaming['process_name'];
						$style_name_for_folding = $row_2nd_Re_Steaming['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Steaming['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Steaming['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Steaming['after_trolley_number_or_batcher_number'];
							
					}
					


				}

				// 3rd-Re-Steaming
				$sql_3rd_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_name='3rd-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Steaming= mysqli_query($con,$sql_3rd_Re_Steaming) or die(mysqli_error($con));

				while( $row_3rd_Re_Steaming = mysqli_fetch_array( $result_3rd_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];
					}			
					$third_re_Steaming_qty = $row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];	
					
							
					if($row_3rd_Re_Steaming['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Steaming['process_start_date'];
					}
					if($row_3rd_Re_Steaming['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Steaming['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Steaming['version_number'];
						$process_name_for_folding = $row_3rd_Re_Steaming['process_name'];
						$style_name_for_folding = $row_3rd_Re_Steaming['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Steaming['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Steaming['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Steaming['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				// 4th-Re-Steaming
				$sql_4th_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_name='4th-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Steaming= mysqli_query($con,$sql_4th_Re_Steaming) or die(mysqli_error($con));

				while( $row_4th_Re_Steaming = mysqli_fetch_array( $result_4th_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Steaming['after_trolley_or_batcher_qty'];		
					}
					$forth_re_Steaming_qty = $row_4th_Re_Steaming['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Steaming['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Steaming['process_start_date'];
					}
					if($row_4th_Re_Steaming['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Steaming['pp_number'];
						$version_number_for_folding = $row_4th_Re_Steaming['version_number'];
						$process_name_for_folding = $row_4th_Re_Steaming['process_name'];
						$style_name_for_folding = $row_4th_Re_Steaming['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Steaming['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Steaming['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Steaming['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				//Ready For Dyeing
				$sql_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Dyeing= mysqli_query($con,$sql_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_Ready_For_Dyeing = mysqli_fetch_array( $result_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
					}		
					$Ready_For_Dyeing_qty = $row_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					
					if($row_Ready_For_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Ready_For_Dyeing['process_start_date'];
					}
					if($row_Ready_For_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Ready_For_Dyeing['pp_number'];
						$version_number_for_folding = $row_Ready_For_Dyeing['version_number'];
						$process_name_for_folding = $row_Ready_For_Dyeing['process_name'];
						$style_name_for_folding = $row_Ready_For_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_Ready_For_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				//Re-Ready For Dyeing
				$sql_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Dyeing= mysqli_query($con,$sql_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$re_Ready_For_Dyeing_qty = $row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Ready_For_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Ready_For_Dyeing['process_start_date'];
					}
					if($row_Re_Ready_For_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Ready_For_Dyeing['pp_number'];
						$version_number_for_folding = $row_Re_Ready_For_Dyeing['version_number'];
						$process_name_for_folding = $row_Re_Ready_For_Dyeing['process_name'];
						$style_name_for_folding = $row_Re_Ready_For_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Ready_For_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				//2nd-Re-Ready For Dyeing
				$sql_2nd_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='2nd-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Dyeing= mysqli_query($con,$sql_2nd_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_2nd_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}
					$second_re_Ready_For_Dyeing_qty = $row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Ready_For_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Ready_For_Dyeing['process_start_date'];
					}
					if($row_2nd_Re_Ready_For_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Ready_For_Dyeing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Ready_For_Dyeing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Ready_For_Dyeing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Ready_For_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Ready_For_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Dyeing['after_trolley_number_or_batcher_number'];
								
					}
				
				}

				//3rd-Re-Ready For Dyeing
				$sql_3rd_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='3rd-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Dyeing= mysqli_query($con,$sql_3rd_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_3rd_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$third_re_Ready_For_Dyeing_qty = $row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Ready_For_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Ready_For_Dyeing['process_start_date'];
					}
					if($row_3rd_Re_Ready_For_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Ready_For_Dyeing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Ready_For_Dyeing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Ready_For_Dyeing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Ready_For_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Ready_For_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					

				}


				//4th-Re-Ready For Dyeing
				$sql_4th_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,ptri.process_name,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='4th-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Dyeing= mysqli_query($con,$sql_4th_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_4th_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$forth_re_Ready_For_Dyeing_qty = $row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Ready_For_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Ready_For_Dyeing['process_start_date'];
					}
					if($row_4th_Re_Ready_For_Dyeing['process_name'] != '')
					{	
						$pp_number_for_folding = $row_4th_Re_Ready_For_Dyeing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Ready_For_Dyeing['version_number'];
						$process_name_for_folding = $row_4th_Re_Ready_For_Dyeing['process_name'];
						$style_name_for_folding = $row_4th_Re_Ready_For_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Ready_For_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Dyeing['after_trolley_number_or_batcher_number'];
							
							
					}
				

				}


				// Dyeing
				$sql_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Dyeing= mysqli_query($con,$sql_Dyeing) or die(mysqli_error($con));

				while( $row_Dyeing = mysqli_fetch_array( $result_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$Dyeing_qty = $row_Dyeing['after_trolley_or_batcher_qty'];
					
					if($row_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Dyeing['process_start_date'];
					}
					if($row_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Dyeing['pp_number'];
						$version_number_for_folding = $row_Dyeing['version_number'];
						$process_name_for_folding = $row_Dyeing['process_name'];
						$style_name_for_folding = $row_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Dyeing['after_trolley_number_or_batcher_number'];
							
		
					}
				
				}

				//Re-Dyeing
				$sql_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Dyeing= mysqli_query($con,$sql_Re_Dyeing) or die(mysqli_error($con));

				while( $row_Re_Dyeing = mysqli_fetch_array( $result_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$re_Dyeing_qty = $row_Re_Dyeing['after_trolley_or_batcher_qty'];
					
						
					if($row_Re_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Dyeing['process_start_date'];
					}
					if($row_Re_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Dyeing['pp_number'];
						$version_number_for_folding = $row_Re_Dyeing['version_number'];
						$process_name_for_folding = $row_Re_Dyeing['process_name'];
						$style_name_for_folding = $row_Re_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					

				}


				//2nd-Re-Dyeing
				$sql_2nd_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='2nd-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Dyeing= mysqli_query($con,$sql_2nd_Re_Dyeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Dyeing = mysqli_fetch_array( $result_2nd_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$second_re_Dyeing_qty = $row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];	
					
									
					if($row_2nd_Re_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Dyeing['process_start_date'];
					}
					if($row_2nd_Re_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Dyeing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Dyeing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Dyeing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Dyeing['after_trolley_number_or_batcher_number'];
							
	
					}
					
				}

				//3rd-Re-Dyeing
				$sql_3rd_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='3rd-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Dyeing= mysqli_query($con,$sql_3rd_Re_Dyeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Dyeing = mysqli_fetch_array( $result_3rd_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$third_re_Dyeing_qty = $row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];
					
											
					if($row_3rd_Re_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Dyeing['process_start_date'];
					}
					if($row_3rd_Re_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Dyeing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Dyeing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Dyeing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					


				}

				//4th-Re-Dyeing
				$sql_4th_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='4th-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Dyeing= mysqli_query($con,$sql_4th_Re_Dyeing) or die(mysqli_error($con));

				while( $row_4th_Re_Dyeing = mysqli_fetch_array( $result_4th_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];	
					}		
					$forth_re_Dyeing_qty = $row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];
					
													
					if($row_4th_Re_Dyeing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Dyeing['process_start_date'];
					}
					if($row_4th_Re_Dyeing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Dyeing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Dyeing['version_number'];
						$process_name_for_folding = $row_4th_Re_Dyeing['process_name'];
						$style_name_for_folding = $row_4th_Re_Dyeing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Dyeing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Dyeing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Dyeing['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				// Washing
				$sql_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= 'Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Washing= mysqli_query($con,$sql_Washing) or die(mysqli_error($con));

				while( $row_Washing = mysqli_fetch_array( $result_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Washing['after_trolley_or_batcher_qty'];
					}			
					$washing_qty = $row_Washing['after_trolley_or_batcher_qty'];	
					
					if($row_Washing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Washing['process_start_date'];
					}
					if($row_Washing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Washing['pp_number'];
						$version_number_for_folding = $row_Washing['version_number'];
						$process_name_for_folding = $row_Washing['process_name'];
						$style_name_for_folding = $row_Washing['style'];
						$finish_width_in_inch_for_folding = $row_Washing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Washing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Washing['after_trolley_number_or_batcher_number'];
							
					}
					
				}

				// Re-Washing
				$sql_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= 'Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Washing= mysqli_query($con,$sql_Re_Washing) or die(mysqli_error($con));

				while( $row_Re_Washing = mysqli_fetch_array( $result_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Washing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$re_washing_qty = $row_Re_Washing['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Washing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Washing['process_start_date'];
					}
					if($row_Re_Washing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Washing['pp_number'];
						$version_number_for_folding = $row_Re_Washing['version_number'];
						$process_name_for_folding = $row_Re_Washing['process_name'];
						$style_name_for_folding = $row_Re_Washing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Washing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Washing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Washing['after_trolley_number_or_batcher_number'];
						
					}
					

					
				}

				// 2nd-Re-Washing
				$sql_2nd_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '2nd-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Washing= mysqli_query($con,$sql_2nd_Re_Washing) or die(mysqli_error($con));

				while( $row_2nd_Re_Washing = mysqli_fetch_array( $result_2nd_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$second_re_washing_qty = $row_2nd_Re_Washing['after_trolley_or_batcher_qty'];
					
					if($row_2nd_Re_Washing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Washing['process_start_date'];
					}
					if($row_2nd_Re_Washing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Washing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Washing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Washing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Washing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Washing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Washing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Washing['after_trolley_number_or_batcher_number'];
						
					}
					

				}

				// 3rd-Re-Washing
				$sql_3rd_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '3rd-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Washing= mysqli_query($con,$sql_3rd_Re_Washing) or die(mysqli_error($con));

				while( $row_3rd_Re_Washing = mysqli_fetch_array( $result_3rd_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$third_re_washing_qty = $row_3rd_Re_Washing['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Washing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Washing['process_start_date'];
					}
					if($row_3rd_Re_Washing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Washing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Washing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Washing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Washing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Washing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Washing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Washing['after_trolley_number_or_batcher_number'];
						
	
					}
				
				}

				// 4th-Re-Washing
				$sql_4th_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '4th-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Washing= mysqli_query($con,$sql_4th_Re_Washing) or die(mysqli_error($con));

				while( $row_4th_Re_Washing = mysqli_fetch_array( $result_4th_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Washing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$forth_re_washing_qty = $row_4th_Re_Washing['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Washing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Washing['process_start_date'];
					}
					if($row_4th_Re_Washing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Washing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Washing['version_number'];
						$process_name_for_folding = $row_4th_Re_Washing['process_name'];
						$style_name_for_folding = $row_4th_Re_Washing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Washing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Washing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Washing['after_trolley_number_or_batcher_number'];
						
					}
					
					

				}
				
				// Ready For Raising
				$sql_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_name='Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Raising= mysqli_query($con,$sql_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_Ready_For_Raising = mysqli_fetch_array( $result_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Raising['after_trolley_or_batcher_qty'];			
					}
					$Ready_For_Raising_qty = $row_Ready_For_Raising['after_trolley_or_batcher_qty'];	
					
					if($row_Ready_For_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_Ready_For_Raising['process_start_date'];
					}

					
					if($row_Ready_For_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_Ready_For_Raising['pp_number'];
						$version_number_for_folding = $row_Ready_For_Raising['version_number'];
						$process_name_for_folding = $row_Ready_For_Raising['process_name'];
						$style_name_for_folding = $row_Ready_For_Raising['style'];
						$finish_width_in_inch_for_folding = $row_Ready_For_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Ready_For_Raising['after_trolley_number_or_batcher_number'];
							
					}
					

				}

				// Re-Ready For Raising
				$sql_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,ptri.process_name,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_name='Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Raising= mysqli_query($con,$sql_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Raising = mysqli_fetch_array( $result_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
					}	
					$re_Ready_For_Raising_qty = $row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Ready_For_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Ready_For_Raising['process_start_date'];
					}

					if($row_Re_Ready_For_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Ready_For_Raising['pp_number'];
						$version_number_for_folding = $row_Re_Ready_For_Raising['version_number'];
						$process_name_for_folding = $row_Re_Ready_For_Raising['process_name'];
						$style_name_for_folding = $row_Re_Ready_For_Raising['style'];
						$finish_width_in_inch_for_folding = $row_Re_Ready_For_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Ready_For_Raising['after_trolley_number_or_batcher_number'];
							
					}		
					

				}

				// 2nd-Re-Ready For Raising
				$sql_2nd_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_name='2nd-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Raising= mysqli_query($con,$sql_2nd_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Raising = mysqli_fetch_array( $result_2nd_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
					}		
					$second_re_Ready_For_Raising_qty = $row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Ready_For_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Ready_For_Raising['process_start_date'];
					}
					if($row_2nd_Re_Ready_For_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Ready_For_Raising['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Ready_For_Raising['version_number'];
						$process_name_for_folding = $row_2nd_Re_Ready_For_Raising['process_name'];
						$style_name_for_folding = $row_2nd_Re_Ready_For_Raising['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Ready_For_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Ready_For_Raising['after_trolley_number_or_batcher_number'];
						
					}
					
				}

				// 3rd-Re-Ready For Raising
				$sql_3rd_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_name='3rd-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Raising= mysqli_query($con,$sql_3rd_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Raising = mysqli_fetch_array( $result_3rd_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];			
					}
					$third_re_Ready_For_Raising_qty = $row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Ready_For_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Ready_For_Raising['process_start_date'];
					}
					if($row_3rd_Re_Ready_For_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Ready_For_Raising['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Ready_For_Raising['version_number'];
						$process_name_for_folding = $row_3rd_Re_Ready_For_Raising['process_name'];
						$style_name_for_folding = $row_3rd_Re_Ready_For_Raising['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Ready_For_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Ready_For_Raising['after_trolley_number_or_batcher_number'];
						
					}
					
				}

				// 4th-Re-Ready For Raising
				$sql_4th_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_name='4th-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Raising= mysqli_query($con,$sql_4th_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Raising = mysqli_fetch_array( $result_4th_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
					}	
					$forth_re_Ready_For_Raising_qty = $row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];
					
						
					if($row_4th_Re_Ready_For_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Ready_For_Raising['process_start_date'];
					}
					if($row_4th_Re_Ready_For_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Ready_For_Raising['pp_number'];
						$version_number_for_folding = $row_4th_Re_Ready_For_Raising['version_number'];
						$process_name_for_folding = $row_4th_Re_Ready_For_Raising['process_name'];
						$style_name_for_folding = $row_4th_Re_Ready_For_Raising['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Ready_For_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Ready_For_Raising['after_trolley_number_or_batcher_number'];
						
					}
					
				}
				
				// Raising
				$sql_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_15'
								and ptri.process_name = 'Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Raising= mysqli_query($con,$sql_Raising) or die(mysqli_error($con));

				while( $row_Raising = mysqli_fetch_array( $result_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Raising['after_trolley_or_batcher_qty'];	
					}		
					$Raising_qty = $row_Raising['after_trolley_or_batcher_qty'];
					
					if($row_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_Raising['process_start_date'];
					}
					if($row_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_Raising['pp_number'];
						$version_number_for_folding = $row_Raising['version_number'];
						$process_name_for_folding = $row_Raising['process_name'];
						$style_name_for_folding = $row_Raising['style'];
						$finish_width_in_inch_for_folding = $row_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Raising['after_trolley_number_or_batcher_number'];
						
					}
					

				}
				
				// Re-Raising
				$sql_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_name='Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Raising= mysqli_query($con,$sql_Re_Raising) or die(mysqli_error($con));

				while( $row_Re_Raising = mysqli_fetch_array( $result_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Raising['after_trolley_or_batcher_qty'];	
					}		
					$re_Raising_qty = $row_Re_Raising['after_trolley_or_batcher_qty'];	
					
						
					if($row_Re_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Raising['process_start_date'];
					}
					if($row_Re_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Raising['pp_number'];
						$version_number_for_folding = $row_Re_Raising['version_number'];
						$process_name_for_folding = $row_Re_Raising['process_name'];
						$style_name_for_folding = $row_Re_Raising['style'];
						$finish_width_in_inch_for_folding = $row_Re_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Raising['after_trolley_number_or_batcher_number'];
						
					}
					
				}

				// 2nd-Re-Raising
				$sql_2nd_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_name='2nd-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Raising= mysqli_query($con,$sql_2nd_Re_Raising) or die(mysqli_error($con));

				while( $row_2nd_Re_Raising = mysqli_fetch_array( $result_2nd_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Raising['after_trolley_or_batcher_qty'];
					}			
					$second_re_Raising_qty = $row_2nd_Re_Raising['after_trolley_or_batcher_qty'];	
								
					if($row_2nd_Re_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Raising['process_start_date'];
					}	

					if($row_2nd_Re_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Raising['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Raising['version_number'];
						$process_name_for_folding = $row_2nd_Re_Raising['process_name'];
						$style_name_for_folding = $row_2nd_Re_Raising['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Raising['after_trolley_number_or_batcher_number'];
						
					}
					

				}

				// 3rd-Re-Raising
				$sql_3rd_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_name='3rd-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Raising= mysqli_query($con,$sql_3rd_Re_Raising) or die(mysqli_error($con));

				while( $row_3rd_Re_Raising = mysqli_fetch_array( $result_3rd_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Raising['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Raising['after_trolley_or_batcher_qty'];	
					}		
					$third_re_Raising_qty = $row_3rd_Re_Raising['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Raising['process_start_date'];
					}
					if($row_3rd_Re_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Raising['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Raising['version_number'];
						$process_name_for_folding = $row_3rd_Re_Raising['process_name'];
						$style_name_for_folding = $row_3rd_Re_Raising['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Raising['after_trolley_number_or_batcher_number'];
						
					}
					
				}

				// 4th-Re-Raising
				$sql_4th_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_name='4th-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Raising= mysqli_query($con,$sql_4th_Re_Raising) or die(mysqli_error($con));

				while( $row_4th_Re_Raising = mysqli_fetch_array( $result_4th_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Raising['after_trolley_or_batcher_qty'];	
					}	
					$forth_re_Raising_qty = $row_4th_Re_Raising['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Raising['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Raising['process_start_date'];
					}
					if($row_4th_Re_Raising['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Raising['pp_number'];
						$version_number_for_folding = $row_4th_Re_Raising['version_number'];
						$process_name_for_folding = $row_4th_Re_Raising['process_name'];
						$style_name_for_folding = $row_4th_Re_Raising['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Raising['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Raising['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Raising['after_trolley_number_or_batcher_number'];
						
					}
					

				}

				// Finishing
				$sql_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name = 'Finishing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1 ";
				
				$result_Finishing= mysqli_query($con,$sql_Finishing) or die(mysqli_error($con));

				while( $row_Finishing = mysqli_fetch_array( $result_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Finishing['after_trolley_or_batcher_qty'];	
					}

					if($row_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Finishing['process_start_date'];
					}		
					$finishing_qty = $row_Finishing['after_trolley_or_batcher_qty'];		
			
					if($row_Finishing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Finishing['pp_number'];
						$version_number_for_folding = $row_Finishing['version_number'];
						$process_name_for_folding = $row_Finishing['process_name'];
						$style_name_for_folding = $row_Finishing['style'];
						$finish_width_in_inch_for_folding = $row_Finishing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Finishing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Finishing['after_trolley_number_or_batcher_number'];
						
					}
					
				}
				
				// Re-Finishing
				$sql_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= 'Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_Re_Finishing= mysqli_query($con,$sql_Re_Finishing) or die(mysqli_error($con));

				while( $row_Re_Finishing = mysqli_fetch_array( $result_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Finishing['process_start_date'];
					}			
					$re_finishing_qty = $row_Re_Finishing['after_trolley_or_batcher_qty'];	
					
					if($row_Re_Finishing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Finishing['pp_number'];
						$version_number_for_folding = $row_Re_Finishing['version_number'];
						$process_name_for_folding = $row_Re_Finishing['process_name'];
						$style_name_for_folding = $row_Re_Finishing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Finishing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Finishing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Finishing['after_trolley_number_or_batcher_number'];
						
					}
					

				}

				// 2nd-Re-Finishing
				$sql_2nd_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '2nd-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_2nd_Re_Finishing= mysqli_query($con,$sql_2nd_Re_Finishing) or die(mysqli_error($con));

				while( $row_2nd_Re_Finishing = mysqli_fetch_array( $result_2nd_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Finishing['process_start_date'];
					}				
					$second_re_finishing_qty = $row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];		
					
					if($row_2nd_Re_Finishing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Finishing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Finishing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Finishing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Finishing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Finishing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Finishing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Finishing['after_trolley_number_or_batcher_number'];
						
					}

					

				}


				// 3rd-Re-Finishing
				$sql_3rd_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '3rd-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Finishing= mysqli_query($con,$sql_3rd_Re_Finishing) or die(mysqli_error($con));

				while( $row_3rd_Re_Finishing = mysqli_fetch_array( $result_3rd_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_3rd_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Finishing['process_start_date'];
					}			
					$third_re_finishing_qty = $row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];	
					
					if($row_3rd_Re_Finishing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Finishing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Finishing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Finishing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Finishing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Finishing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Finishing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Finishing['after_trolley_number_or_batcher_number'];
						
					}
					
			
				}

				// 4th-Re-Finishing
				$sql_4th_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '4th-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_4th_Re_Finishing= mysqli_query($con,$sql_4th_Re_Finishing) or die(mysqli_error($con));

				while( $row_4th_Re_Finishing = mysqli_fetch_array( $result_4th_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_4th_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Finishing['process_start_date'];
					}			
					$forth_re_finishing_qty = $row_4th_Re_Finishing['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Finishing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Finishing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Finishing['version_number'];
						$process_name_for_folding = $row_4th_Re_Finishing['process_name'];
						$style_name_for_folding = $row_4th_Re_Finishing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Finishing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Finishing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Finishing['after_trolley_number_or_batcher_number'];
						
					}
					

				}
				


				// Dyeing-Finish
				$sql_dyeing_finish = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_23'
								and ptri.process_name = 'Dyeing-Finish'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1 ";
				
				$result_dyeing_finish= mysqli_query($con,$sql_dyeing_finish) or die(mysqli_error($con));

				while( $row_dyeing_finish = mysqli_fetch_array( $result_dyeing_finish))
				{    
					$table .='<td style="border: 1px solid black">'.$row_dyeing_finish['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_dyeing_finish['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_dyeing_finish['after_trolley_or_batcher_qty'];	
					}

					if($row_dyeing_finish['process_start_date']!= '')
					{
						$process_completetion_date = $row_dyeing_finish['process_start_date'];
					}		
					$finishing_qty = $row_dyeing_finish['after_trolley_or_batcher_qty'];	
					
					if($row_dyeing_finish['process_name'] != '')
					{
						$pp_number_for_folding = $row_dyeing_finish['pp_number'];
						$version_number_for_folding = $row_dyeing_finish['version_number'];
						$process_name_for_folding = $row_dyeing_finish['process_name'];
						$style_name_for_folding = $row_dyeing_finish['style'];
						$finish_width_in_inch_for_folding = $row_dyeing_finish['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_dyeing_finish['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_dyeing_finish['after_trolley_number_or_batcher_number'];
						
					}
					

			
				}
				
				// Re-Dyeing-Finish
				$sql_Re_dyeing_finish = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_23'
								and ptri.process_name= 'Re-Dyeing-Finish'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_Re_dyeing_finish= mysqli_query($con,$sql_Re_dyeing_finish) or die(mysqli_error($con));

				while( $row_Re_dyeing_finish = mysqli_fetch_array( $result_Re_dyeing_finish))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_dyeing_finish['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_dyeing_finish['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_dyeing_finish['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_dyeing_finish['after_trolley_or_batcher_qty'];
					}

					if($row_Re_dyeing_finish['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_dyeing_finish['process_start_date'];
					}			
					$re_finishing_qty = $row_Re_dyeing_finish['after_trolley_or_batcher_qty'];	
					
					if($row_Re_dyeing_finish['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_dyeing_finish['pp_number'];
						$version_number_for_folding = $row_Re_dyeing_finish['version_number'];
						$process_name_for_folding = $row_Re_dyeing_finish['process_name'];
						$style_name_for_folding = $row_Re_dyeing_finish['style'];
						$finish_width_in_inch_for_folding = $row_Re_dyeing_finish['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_dyeing_finish['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_dyeing_finish['after_trolley_number_or_batcher_number'];
						
					}
					

				}

				// 2nd-Re-dyeing_finish
				$sql_2nd_Re_dyeing_finish = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_23'
								and ptri.process_name= '2nd-Re-Dyeing-Finish'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_2nd_Re_dyeing_finish= mysqli_query($con,$sql_2nd_Re_dyeing_finish) or die(mysqli_error($con));

				while( $row_2nd_Re_dyeing_finish = mysqli_fetch_array( $result_2nd_Re_dyeing_finish))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_dyeing_finish['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_dyeing_finish['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_dyeing_finish['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_dyeing_finish['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_dyeing_finish['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_dyeing_finish['process_start_date'];
					}				
					$second_re_finishing_qty = $row_2nd_Re_dyeing_finish['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_dyeing_finish['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_dyeing_finish['pp_number'];
						$version_number_for_folding = $row_2nd_Re_dyeing_finish['version_number'];
						$process_name_for_folding = $row_2nd_Re_dyeing_finish['process_name'];
						$style_name_for_folding = $row_2nd_Re_dyeing_finish['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_dyeing_finish['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_dyeing_finish['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_dyeing_finish['after_trolley_number_or_batcher_number'];
						
					}
					
			
				}


				// 3rd-Re-dyeing_finish
				$sql_3rd_Re_dyeing_finish = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_23'
								and ptri.process_name= '3rd-Re-Dyeing-Finish'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_dyeing_finish= mysqli_query($con,$sql_3rd_Re_dyeing_finish) or die(mysqli_error($con));

				while( $row_3rd_Re_dyeing_finish = mysqli_fetch_array( $result_3rd_Re_dyeing_finish))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_dyeing_finish['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_dyeing_finish['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_dyeing_finish['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_dyeing_finish['after_trolley_or_batcher_qty'];
					}

					if($row_3rd_Re_dyeing_finish['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_dyeing_finish['process_start_date'];
					}			
					$third_re_finishing_qty = $row_3rd_Re_dyeing_finish['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_dyeing_finish['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_dyeing_finish['pp_number'];
						$version_number_for_folding = $row_3rd_Re_dyeing_finish['version_number'];
						$process_name_for_folding = $row_3rd_Re_dyeing_finish['process_name'];
						$style_name_for_folding = $row_3rd_Re_dyeing_finish['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_dyeing_finish['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_dyeing_finish['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_dyeing_finish['after_trolley_number_or_batcher_number'];
						
					}
					
			
				}

				// 4th-Re-dyeing_finish
				$sql_4th_Re_dyeing_finish = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_23'
								and ptri.process_name= '4th-Re-Dyeing-Finish'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_4th_Re_dyeing_finish= mysqli_query($con,$sql_4th_Re_dyeing_finish) or die(mysqli_error($con));

				while( $row_4th_Re_dyeing_finish = mysqli_fetch_array( $result_4th_Re_dyeing_finish))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_dyeing_finish['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_dyeing_finish['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_dyeing_finish['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_dyeing_finish['after_trolley_or_batcher_qty'];
					}

					if($row_4th_Re_dyeing_finish['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_dyeing_finish['process_start_date'];
					}			
					$forth_re_finishing_qty = $row_4th_Re_dyeing_finish['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_dyeing_finish['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_dyeing_finish['pp_number'];
						$version_number_for_folding = $row_4th_Re_dyeing_finish['version_number'];
						$process_name_for_folding = $row_4th_Re_dyeing_finish['process_name'];
						$style_name_for_folding = $row_4th_Re_dyeing_finish['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_dyeing_finish['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_dyeing_finish['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_dyeing_finish['after_trolley_number_or_batcher_number'];
						
					}
					

				}


				// Calander
				$sql_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name = 'Calander'
								and ptri.pp_number = '".$row['pp_number']."' 
								LIMIT 1";
				

				$result_Calander= mysqli_query($con,$sql_Calander) or die(mysqli_error($con));

				while( $row_Calander = mysqli_fetch_array( $result_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Calander['after_trolley_or_batcher_qty'];	
					}
						
					if($row_Calander['process_start_date']!= '')
					{
						$process_completetion_date = $row_Calander['process_start_date'];
					}
					$calender_qty = $row_Calander['after_trolley_or_batcher_qty'];
					
					if($row_Calander['process_name'] != '')
					{
						$pp_number_for_folding = $row_Calander['pp_number'];
						$version_number_for_folding = $row_Calander['version_number'];
						$process_name_for_folding = $row_Calander['process_name'];
						$style_name_for_folding = $row_Calander['style'];
						$finish_width_in_inch_for_folding = $row_Calander['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Calander['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Calander['after_trolley_number_or_batcher_number'];
						
					}
					
			
				}


				// Re-Calander
				$sql_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= 'Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  
								LIMIT 1 ";
				
				$result_Re_Calander= mysqli_query($con,$sql_Re_Calander) or die(mysqli_error($con));

				while( $row_Re_Calander = mysqli_fetch_array( $result_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Calander['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Calander['after_trolley_or_batcher_qty'];
					}

					if($row_Re_Calander['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Calander['process_start_date'];
					}
					$re_calender_qty = $row_Re_Calander['after_trolley_or_batcher_qty'];		
					
					if($row_Re_Calander['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Calander['pp_number'];
						$version_number_for_folding = $row_Re_Calander['version_number'];
						$process_name_for_folding = $row_Re_Calander['process_name'];
						$style_name_for_folding = $row_Re_Calander['style'];
						$finish_width_in_inch_for_folding = $row_Re_Calander['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Calander['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Calander['after_trolley_number_or_batcher_number'];
						
					}
					
				
				}

				// 2nd-Re-Calander
				$sql_2nd_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '2nd-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  
								LIMIT 1 ";
				
				$result_2nd_Re_Calander= mysqli_query($con,$sql_2nd_Re_Calander) or die(mysqli_error($con));

				while( $row_2nd_Re_Calander = mysqli_fetch_array( $result_2nd_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Calander['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Calander['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_2nd_Re_Calander['process_start_date'];
					}		
					$second_re_calender_qty = $row_2nd_Re_Calander['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Calander['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Calander['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Calander['version_number'];
						$process_name_for_folding = $row_2nd_Re_Calander['process_name'];
						$style_name_for_folding = $row_2nd_Re_Calander['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Calander['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Calander['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Calander['after_trolley_number_or_batcher_number'];
						
					}
					
				}

				// 3rd-Re-Calander
				$sql_3rd_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '3rd-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Calander= mysqli_query($con,$sql_3rd_Re_Calander) or die(mysqli_error($con));

				while( $row_3rd_Re_Calander = mysqli_fetch_array( $result_3rd_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Calander['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Calander['after_trolley_or_batcher_qty'];
					}	

					if($row_3rd_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_3rd_Re_Calander['process_start_date'];
					}		
					$third_re_calender_qty = $row_3rd_Re_Calander['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Calander['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Calander['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Calander['version_number'];
						$process_name_for_folding = $row_3rd_Re_Calander['process_name'];
						$style_name_for_folding = $row_3rd_Re_Calander['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Calander['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Calander['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Calander['after_trolley_number_or_batcher_number'];
						
					}
					
		
				}

				// 4th-Re-Calander
				$sql_4th_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '4th-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_4th_Re_Calander= mysqli_query($con,$sql_4th_Re_Calander) or die(mysqli_error($con));

				while( $row_4th_Re_Calander = mysqli_fetch_array( $result_4th_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Calander['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Calander['after_trolley_or_batcher_qty'];	
					}

					if($row_4th_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_4th_Re_Calander['process_start_date'];
					}			
					$forth_re_calender_qty = $row_4th_Re_Calander['after_trolley_or_batcher_qty'];
					
					if($row_4th_Re_Calander['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Calander['pp_number'];
						$version_number_for_folding = $row_4th_Re_Calander['version_number'];
						$process_name_for_folding = $row_4th_Re_Calander['process_name'];
						$style_name_for_folding = $row_4th_Re_Calander['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Calander['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Calander['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Calander['after_trolley_number_or_batcher_number'];
						
					}
					
		
				}
				

				// Sanforizing
				 $sql_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
				 							ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= 'Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";

				$result_Sanforizing= mysqli_query($con,$sql_Sanforizing) or die(mysqli_error($con));

				while( $row_Sanforizing = mysqli_fetch_array( $result_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Sanforizing['after_trolley_or_batcher_qty']!= '')  
					{
						$last_batcher_qty = $row_Sanforizing['after_trolley_or_batcher_qty'];
					}	

					if($row_Sanforizing['process_start_date']!= '' || $row_Sanforizing['process_start_date']!= NULL ) 
					{

						$process_completetion_date = $row_Sanforizing['process_start_date'];	
					}
					$sanforizing_qty = $row_Sanforizing['after_trolley_or_batcher_qty'];	
					
					if($row_Sanforizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Sanforizing['pp_number'];
						$version_number_for_folding = $row_Sanforizing['version_number'];
						$process_name_for_folding = $row_Sanforizing['process_name'];
						$style_name_for_folding = $row_Sanforizing['style'];
						$finish_width_in_inch_for_folding = $row_Sanforizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Sanforizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Sanforizing['after_trolley_number_or_batcher_number'];
						
					}		
					
				
				}

				// Re-Sanforizing
				$sql_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= 'Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_Re_Sanforizing= mysqli_query($con,$sql_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_Re_Sanforizing = mysqli_fetch_array( $result_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Sanforizing['after_trolley_or_batcher_qty']!= '')  
					{
						$last_batcher_qty = $row_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}
					if($row_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_Re_Sanforizing['process_start_date'];	
					}	
					$re_sanforizing_qty = $row_Re_Sanforizing['after_trolley_or_batcher_qty'];

					if($row_Re_Sanforizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_Re_Sanforizing['pp_number'];
						$version_number_for_folding = $row_Re_Sanforizing['version_number'];
						$process_name_for_folding = $row_Re_Sanforizing['process_name'];
						$style_name_for_folding = $row_Re_Sanforizing['style'];
						$finish_width_in_inch_for_folding = $row_Re_Sanforizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_Re_Sanforizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_Re_Sanforizing['after_trolley_number_or_batcher_number'];
						
					}
					
			
				}
				
				// 2nd-Re-Sanforizing
				$sql_2nd_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '2nd-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_2nd_Re_Sanforizing= mysqli_query($con,$sql_2nd_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Sanforizing = mysqli_fetch_array( $result_2nd_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_2nd_Re_Sanforizing['process_start_date'];		
					}	
					$second_re_sanforizing_qty = $row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];	
					
					if($row_2nd_Re_Sanforizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_2nd_Re_Sanforizing['pp_number'];
						$version_number_for_folding = $row_2nd_Re_Sanforizing['version_number'];
						$process_name_for_folding = $row_2nd_Re_Sanforizing['process_name'];
						$style_name_for_folding = $row_2nd_Re_Sanforizing['style'];
						$finish_width_in_inch_for_folding = $row_2nd_Re_Sanforizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Sanforizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_2nd_Re_Sanforizing['after_trolley_number_or_batcher_number'];
						
					}		
					
		
				}

				// 3rd-Re-Sanforizing
				$sql_3rd_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '3rd-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Sanforizing= mysqli_query($con,$sql_3rd_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Sanforizing = mysqli_fetch_array( $result_3rd_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];	
					}	

					if($row_3rd_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_3rd_Re_Sanforizing['process_start_date'];	
					}
					$third_re_sanforizing_qty = $row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];
					
					if($row_3rd_Re_Sanforizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_3rd_Re_Sanforizing['pp_number'];
						$version_number_for_folding = $row_3rd_Re_Sanforizing['version_number'];
						$process_name_for_folding = $row_3rd_Re_Sanforizing['process_name'];
						$style_name_for_folding = $row_3rd_Re_Sanforizing['style'];
						$finish_width_in_inch_for_folding = $row_3rd_Re_Sanforizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Sanforizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_3rd_Re_Sanforizing['after_trolley_number_or_batcher_number'];
						
					}
					
				
				}

			
				$sql_4th_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,ptri.process_name,
											ptri.before_trolley_number_or_batcher_number, ptri.after_trolley_number_or_batcher_number,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '4th-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Sanforizing= mysqli_query($con,$sql_4th_Re_Sanforizing) or die(mysqli_error($con));
				while( $row_4th_Re_Sanforizing = mysqli_fetch_array( $result_4th_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_4th_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}			

					if($row_4th_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_4th_Re_Sanforizing['process_start_date'];	
					}
					$forth_re_sanforizing_qty = $row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];	
					
					if($row_4th_Re_Sanforizing['process_name'] != '')
					{
						$pp_number_for_folding = $row_4th_Re_Sanforizing['pp_number'];
						$version_number_for_folding = $row_4th_Re_Sanforizing['version_number'];
						$process_name_for_folding = $row_4th_Re_Sanforizing['process_name'];
						$style_name_for_folding = $row_4th_Re_Sanforizing['style'];
						$finish_width_in_inch_for_folding = $row_4th_Re_Sanforizing['finish_width_in_inch'];
						$before_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Sanforizing['before_trolley_number_or_batcher_number'];
						$after_trolley_number_or_batcher_number_for_folding = $row_4th_Re_Sanforizing['after_trolley_number_or_batcher_number'];
	
					}
					
				}

				// total process quantity calculation
				
				$total_process_quantity = 0;

				$sql_total_process_quantity = "SELECT partial_test_for_test_result_info.* FROM partial_test_for_test_result_info, 
				(SELECT MAX(partial_test_for_test_result_id) lastid 
				from partial_test_for_test_result_info where pp_number = '".$row['pp_number']."' GROUP BY version_id) last_id 
				where   
					partial_test_for_test_result_info.partial_test_for_test_result_id = last_id.lastid;";
				
				$result_total_process_quantity= mysqli_query($con,$sql_total_process_quantity) or die(mysqli_error($con));

				while( $row_total_process_quantity = mysqli_fetch_array( $result_total_process_quantity))
				{
					$total_process_quantity = $total_process_quantity + $row_total_process_quantity['after_trolley_or_batcher_qty'];
				}


				$process_short_excess_qty = $total_process_quantity - $total_pp_quantity;

				
				$greige_process_short_excess_qty = $total_process_quantity - $greige_total_quantity;

				if($reprocess_quantity ==0)
				{
					$reprocess_qty = '';
				}
				else
				{
					$reprocess_qty = $reprocess_quantity;
				}

				$percentage_of_reprocess_quantity = '';

				if($reprocess_quantity >0)
				{
					$percentage_of_reprocess_quantity = ($total_process_quantity/$reprocess_quantity) *100;
					$percentage_of_reprocess_quantity .='%';
				}

				$sql_for_inspection = "SELECT quantity inspection_folding_qty, folding_quantity folding_delivery_qty, reworkable_quantity, rejected_quantity,
										DATE_FORMAT(DATE(recording_time),'%d-%m-%Y') folding_completion_date FROM inspection_and_folding 
										WHERE pp_number = '$pp_number_for_folding' AND version_number = '$version_number_for_folding' AND 
										finish_width = '$finish_width_in_inch_for_folding' AND style_name = '$style_name_for_folding' and 
										before_trolley_number = '$before_trolley_number_or_batcher_number_for_folding' AND 
										trolly_number = '$after_trolley_number_or_batcher_number_for_folding' AND 
										process_name = '$process_name_for_folding'";

				$result_for_inspection = mysqli_query($con, $sql_for_inspection) or die(mysqli_error($con));

				$row_for_inspection = mysqli_fetch_array($result_for_inspection);

				$inspection_folding_qty = $row_for_inspection['inspection_folding_qty'];
				$folding_delivery_qty = $row_for_inspection['folding_delivery_qty'];
				$folding_completion_date = $row_for_inspection['folding_completion_date'];
				$reworkable_quantity = $row_for_inspection['reworkable_quantity'];
				$rejected_quantity = $row_for_inspection['rejected_quantity'];

				$percentage_of_reworkable_quantity = '';
				if($reworkable_quantity >0)
				{
					$percentage_of_reworkable_quantity = ($inspection_folding_qty/$reworkable_quantity) *100;
					$percentage_of_reworkable_quantity .='%';
				}

				$percentage_of_rejected_quantity = '';
				if($rejected_quantity >0)
				{
					$percentage_of_rejected_quantity = ($inspection_folding_qty/$rejected_quantity) *100;
					$percentage_of_rejected_quantity .='%';
				}

				$short_excess_for_folding = $total_process_quantity - $inspection_folding_qty;

				$short_excess_for_delivery = $inspection_folding_qty - $folding_delivery_qty;

		   
				$table .='<td style="border: 1px solid black">'.$total_process_quantity.'</td>
				<td style="border: 1px solid black">'.$process_short_excess_qty.'</td>
				<td style="border: 1px solid black">'.$greige_process_short_excess_qty.'</td>
				<td style="border: 1px solid black">'.$process_completetion_date.'</td>	                 
				
				
				<td style="border: 1px solid black">'.$reprocess_qty.'</td>
				<td style="border: 1px solid black">'.$percentage_of_reprocess_quantity.'</td>
				<td style="border: 1px solid black">'.$inspection_folding_qty.'</td>
				<td style="border: 1px solid black">'.$folding_completion_date.'</td>
				<td style="border: 1px solid black">'.$process_completetion_date.'</td>
				<td style="border: 1px solid black">'.$short_excess_for_folding.'</td>
				<td style="border: 1px solid black">'.$folding_delivery_qty.'</td>
				<td style="border: 1px solid black">'.$short_excess_for_delivery.'</td>
				<td style="border: 1px solid black">'.$folding_completion_date.'</td>
				<td style="border: 1px solid black">'.$reworkable_quantity.'</td>
				<td style="border: 1px solid black">'.$percentage_of_reworkable_quantity.'</td>
				<td style="border: 1px solid black">'.$rejected_quantity.'</td>
				<td style="border: 1px solid black">'.$percentage_of_rejected_quantity.'</td>
				<td style="border: 1px solid black">a</td>
				<td style="border: 1px solid black">a </td>
				';
			
		 $table.='</tr>';

		 		
		 		$total_ppq_value +=$total_pp_quantity;
				$total_gic_value +=$greige_total_quantity;
				$total_greige_short_excess_qty += $greige_short_excess_qty;

				$total_singeing_qty += $singeing_qty;
				$total_re_singeing_qty += $re_singeing_qty;
				$total_2nd_re_singeing_qty += $second_re_singeing_qty;
				$total_3rd_re_singeing_qty += $third_re_singeing_qty;
				$total_4th_re_singeing_qty += $forth_re_singeing_qty;

				$total_desizing_qty += $desizing_qty;
				$total_re_desizing_qty += $re_desizing_qty;
				$total_2nd_re_desizing_qty += $second_re_desizing_qty;
				$total_3rd_re_desizing_qty += $third_re_desizing_qty;
				$total_4th_re_desizing_qty += $forth_re_desizing_qty;

				$total_signe_desize_qty += $signe_desize_qty;
				$total_re_signe_desize_qty += $re_signe_desizing_qty;
				$total_2nd_re_signe_desize_qty += $second_re_signe_desizing_qty;
				$total_3rd_re_signe_desize_qty += $third_re_signe_desizing_qty;
				$total_4th_re_signe_desize_qty += $forth_re_signe_desizing_qty;
	   
				$total_scouring_qty += $scouring_qty;
				$total_re_scouring_qty += $re_scouring_qty;
				$total_2nd_re_scouring_qty += $second_re_scouring_qty;
				$total_3rd_re_scouring_qty += $third_re_scouring_qty;
				$total_4th_re_scouring_qty += $forth_re_scouring_qty;
				
				$total_bleaching_qty += $bleaching_qty;
				$total_re_bleaching_qty += $re_bleaching_qty;
				$total_2nd_re_bleaching_qty += $second_re_bleaching_qty;
				$total_3rd_re_bleaching_qty += $third_re_bleaching_qty;
				$total_4th_re_bleaching_qty += $forth_re_bleaching_qty;

				$total_souring_bleaching_qty += $scouring_bleaching_qty;
				$total_re_souring_bleaching_qty += $re_scouring_bleaching_qty;
				$total_2nd_re_souring_bleaching_qty += $second_re_scouring_bleaching_qty;
				$total_3rd_re_souring_bleaching_qty += $third_re_scouring_bleaching_qty;
				$total_4th_re_souring_bleaching_qty += $forth_re_scouring_bleaching_qty;
	   
				$total_ready_for_mercherize_qty +=$Ready_For_Mercerize_qty;
				$total_re_ready_for_mercherize_qty += $re_Ready_For_Mercerize_qty;
				$total_2nd_re_ready_for_mercherize_qty += $second_re_Ready_For_Mercerize_qty;
				$total_3rd_re_ready_for_mercherize_qty += $third_re_Ready_For_Mercerize_qty;
				$total_4th_re_ready_for_mercherize_qty += $forth_re_Ready_For_Mercerize_qty;
	   
				$total_mercherize_qty += $mercerize_qty;
				$total_re_mercherize_qty += $re_mercerize_qty;
				$total_2nd_re_mercherize_qty += $second_re_mercerize_qty;
				$total_3rd_re_mercherize_qty += $third_re_mercerize_qty;
				$total_4th_re_mercherize_qty += $forth_re_mercerize_qty;
	   
				$total_ready_for_print_qty += $Ready_For_Print_qty;
				$total_re_ready_for_print_qty += $re_Ready_For_Print_qty;
				$total_2nd_re_ready_for_print_qty += $second_re_Ready_For_Print_qty;
				$total_3rd_re_ready_for_print_qty += $third_re_Ready_For_Print_qty;
				$total_4th_re_ready_for_print_qty += $forth_re_Ready_For_Print_qty;
	   
				$total_print_qty += $Print_qty;
				$total_re_print_qty += $re_Print_qty;
				$total_2nd_re_print_qty += $second_re_Print_qty;
				$total_3rd_re_print_qty += $third_re_Print_qty;
				$total_4th_re_print_qty += $forth_re_Print_qty;
	   
						
				$total_curing_qty += $curing_qty;
				$total_re_curing_qty += $re_curing_qty;
				$total_2nd_re_curing_qty += $second_re_curing_qty;
				$total_3rd_re_curing_qty += $third_re_curing_qty;
				$total_4th_re_curing_qty += $forth_re_curing_qty;
	   
				$total_steaming_qty += $Steaming_qty;
				$total_re_steaming_qty += $re_Steaming_qty;
				$total_2nd_re_steaming_qty += $second_re_Steaming_qty;
				$total_3rd_re_steaming_qty += $third_re_Steaming_qty;
				$total_4th_re_steaming_qty += $forth_re_Steaming_qty;
	   
				$total_ready_for_dyeing_qty += $Ready_For_Dyeing_qty;
				$total_re_ready_for_dyeing_qty += $re_Ready_For_Dyeing_qty;
				$total_2nd_re_ready_for_dyeing_qty += $second_re_Ready_For_Dyeing_qty;
				$total_3rd_re_ready_for_dyeing_qty += $third_re_Ready_For_Dyeing_qty;
				$total_4th_re_ready_for_dyeing_qty += $forth_re_Ready_For_Dyeing_qty;
	   
				$total_dyeing_qty += $Dyeing_qty;
				$total_re_dyeing_qty += $re_Dyeing_qty;
				$total_2nd_re_dyeing_qty += $second_re_Dyeing_qty;
				$total_3rd_re_dyeing_qty += $third_re_Dyeing_qty;
				$total_4th_re_dyeing_qty += $forth_re_Dyeing_qty;
	   
				$total_ready_for_raising_qty += $Ready_For_Raising_qty;
				$total_re_ready_for_raising_qty += $re_Ready_For_Raising_qty;
				$total_2nd_re_ready_for_raising_qty += $second_re_Ready_For_Raising_qty;
				$total_3rd_re_ready_for_raising_qty += $third_re_Ready_For_Raising_qty;
				$total_4th_re_ready_for_raising_qty += $forth_re_Ready_For_Raising_qty;
	   
				$total_raising_qty += $Raising_qty;
				$total_re_raising_qty += $re_Raising_qty;
				$total_2nd_re_raising_qty += $second_re_Raising_qty;
				$total_3rd_re_raising_qty += $third_re_Raising_qty;
				$total_4th_re_raising_qty += $forth_re_Raising_qty;
	   
				$total_washing_qty += $washing_qty;
				$total_re_washing_qty += $re_washing_qty;
				$total_2nd_re_washing_qty += $second_re_washing_qty;
				$total_3rd_re_washing_qty += $third_re_washing_qty;
				$total_4th_re_washing_qty += $forth_re_washing_qty;
	   
				$total_finishing_qty += $finishing_qty;
				$total_re_finishing_qty += $re_finishing_qty;
				$total_2nd_re_finishing_qty += $second_re_finishing_qty;
				$total_3rd_re_finishing_qty += $third_re_finishing_qty;
				$total_4th_re_finishing_qty += $forth_re_finishing_qty;
	   
				$total_calendering_qty += $calender_qty;
				$total_re_calendering_qty += $re_calender_qty;
				$total_2nd_re_calendering_qty += $second_re_calender_qty;
				$total_3rd_re_calendering_qty += $third_re_calender_qty;
				$total_4th_re_calendering_qty += $forth_re_calender_qty;
	   
				$total_sanforizing_qty += $sanforizing_qty;
				$total_re_sanforizing_qty += $re_sanforizing_qty;
				$total_2nd_re_sanforizing_qty += $second_re_sanforizing_qty;
				$total_3rd_re_sanforizing_qty += $third_re_sanforizing_qty;
				$total_4th_re_sanforizing_qty += $forth_re_sanforizing_qty;
	   
				$total_process_qty += $total_process_quantity;
				$total_process_short_excess_qty += $process_short_excess_qty;
				$total_greige_process_short_excess_qty += $greige_process_short_excess_qty;
				$total_reprocess_qty += $reprocess_quantity;
		 }


		 if( $total_ppq_value == 0)
		 {
			$total_ppq_value = '';
		 }
		 if( $total_gic_value == 0)
		 {
			$total_gic_value = '';
		 }
		 if( $total_greige_short_excess_qty == 0)
		 {
			$total_greige_short_excess_qty = '';
		 }

		 if( $total_singeing_qty == 0)
		 {
			$total_singeing_qty = '';
		 }
		 if( $total_re_singeing_qty == 0)
		 {
			$total_re_singeing_qty = '';
		 }
		 if( $total_2nd_re_singeing_qty == 0)
		 {
			$total_2nd_re_singeing_qty = '';
		 }
		 if( $total_3rd_re_singeing_qty == 0)
		 {
			$total_3rd_re_singeing_qty = '';
		 }
		 if( $total_4th_re_singeing_qty == 0)
		 {
			$total_4th_re_singeing_qty = '';
		 }

		 if( $total_desizing_qty == 0)
		 {
			$total_desizing_qty = '';
		 }
		 if( $total_re_desizing_qty == 0)
		 {
			$total_re_desizing_qty = '';
		 }
		 if( $total_2nd_re_desizing_qty == 0)
		 {
			$total_2nd_re_desizing_qty = '';
		 }
		 if( $total_3rd_re_desizing_qty == 0)
		 {
			$total_3rd_re_desizing_qty = '';
		 }
		 if( $total_4th_re_desizing_qty == 0)
		 {
			$total_4th_re_desizing_qty = '';
		 }


		 if( $total_signe_desize_qty == 0)
		 {
			$total_signe_desize_qty = '';
		 }
		 if( $total_re_signe_desize_qty == 0)
		 {
			$total_re_signe_desize_qty = '';
		 }
		 if( $total_2nd_re_signe_desize_qty == 0)
		 {
			$total_2nd_re_signe_desize_qty = '';
		 }
		 if( $total_3rd_re_signe_desize_qty == 0)
		 {
			$total_3rd_re_signe_desize_qty = '';
		 }
		 if( $total_4th_re_signe_desize_qty == 0)
		 {
			$total_4th_re_signe_desize_qty = '';
		 }

		 if( $total_scouring_qty == 0)
		 {
			$total_scouring_qty = '';
		 }
		 if( $total_re_scouring_qty == 0)
		 {
			$total_re_scouring_qty = '';
		 }
		 if( $total_2nd_re_scouring_qty == 0)
		 {
			$total_2nd_re_scouring_qty = '';
		 }
		 if( $total_3rd_re_scouring_qty == 0)
		 {
			$total_3rd_re_scouring_qty = '';
		 }
		 if( $total_4th_re_scouring_qty == 0)
		 {
			$total_4th_re_scouring_qty = '';
		 }

		 if( $total_bleaching_qty == 0)
		 {
			$total_bleaching_qty = '';
		 }
		 if( $total_re_bleaching_qty == 0)
		 {
			$total_re_bleaching_qty = '';
		 }
		 if( $total_2nd_re_bleaching_qty == 0)
		 {
			$total_2nd_re_bleaching_qty = '';
		 }
		 if( $total_3rd_re_bleaching_qty == 0)
		 {
			$total_3rd_re_bleaching_qty = '';
		 }
		 if( $total_4th_re_bleaching_qty == 0)
		 {
			$total_4th_re_bleaching_qty = '';
		 }

		 
		 if( $total_souring_bleaching_qty == 0)
		 {
			$total_souring_bleaching_qty = '';
		 }
		 if( $total_re_souring_bleaching_qty == 0)
		 {
			$total_re_souring_bleaching_qty = '';
		 }
		 if( $total_2nd_re_souring_bleaching_qty == 0)
		 {
			$total_2nd_re_souring_bleaching_qty = '';
		 }
		 if( $total_3rd_re_souring_bleaching_qty == 0)
		 {
			$total_3rd_re_souring_bleaching_qty = '';
		 }
		 if( $total_4th_re_souring_bleaching_qty == 0)
		 {
			$total_4th_re_souring_bleaching_qty = '';
		 }

		 
		 if( $total_ready_for_mercherize_qty == 0)
		 {
			$total_ready_for_mercherize_qty = '';
		 }
		 if( $total_re_ready_for_mercherize_qty == 0)
		 {
			$total_re_ready_for_mercherize_qty = '';
		 }
		 if( $total_2nd_re_ready_for_mercherize_qty == 0)
		 {
			$total_2nd_re_ready_for_mercherize_qty = '';
		 }
		 if( $total_3rd_re_ready_for_mercherize_qty == 0)
		 {
			$total_3rd_re_ready_for_mercherize_qty = '';
		 }
		 if( $total_4th_re_ready_for_mercherize_qty == 0)
		 {
			$total_4th_re_ready_for_mercherize_qty = '';
		 }

		 
		 if( $total_mercherize_qty == 0)
		 {
			$total_mercherize_qty = '';
		 }
		 if( $total_re_mercherize_qty == 0)
		 {
			$total_re_mercherize_qty = '';
		 }
		 if( $total_2nd_re_mercherize_qty == 0)
		 {
			$total_2nd_re_mercherize_qty = '';
		 }
		 if( $total_3rd_re_mercherize_qty == 0)
		 {
			$total_3rd_re_mercherize_qty = '';
		 }
		 if( $total_4th_re_mercherize_qty == 0)
		 {
			$total_4th_re_mercherize_qty = '';
		 }

		 if( $total_ready_for_print_qty == 0)
		 {
			$total_ready_for_print_qty = '';
		 }
		 if( $total_re_ready_for_print_qty == 0)
		 {
			$total_re_ready_for_print_qty = '';
		 }
		 if( $total_2nd_re_ready_for_print_qty == 0)
		 {
			$total_2nd_re_ready_for_print_qty = '';
		 }
		 if( $total_3rd_re_ready_for_print_qty == 0)
		 {
			$total_3rd_re_ready_for_print_qty = '';
		 }
		 if( $total_4th_re_ready_for_print_qty == 0)
		 {
			$total_4th_re_ready_for_print_qty = '';
		 }

		 
		 if( $total_print_qty == 0)
		 {
			$total_print_qty = '';
		 }
		 if( $total_re_print_qty == 0)
		 {
			$total_re_print_qty = '';
		 }
		 if( $total_2nd_re_print_qty == 0)
		 {
			$total_2nd_re_print_qty = '';
		 }
		 if( $total_3rd_re_print_qty == 0)
		 {
			$total_3rd_re_print_qty = '';
		 }
		 if( $total_4th_re_print_qty == 0)
		 {
			$total_4th_re_print_qty = '';
		 }

		 if( $total_curing_qty == 0)
		 {
			$total_curing_qty = '';
		 }
		 if( $total_re_curing_qty == 0)
		 {
			$total_re_curing_qty = '';
		 }
		 if( $total_2nd_re_curing_qty == 0)
		 {
			$total_2nd_re_curing_qty = '';
		 }
		 if( $total_3rd_re_curing_qty == 0)
		 {
			$total_3rd_re_curing_qty = '';
		 }
		 if( $total_4th_re_curing_qty == 0)
		 {
			$total_4th_re_curing_qty = '';
		 }

		 if( $total_steaming_qty == 0)
		 {
			$total_steaming_qty = '';
		 }
		 if( $total_re_steaming_qty == 0)
		 {
			$total_re_steaming_qty = '';
		 }
		 if( $total_2nd_re_steaming_qty == 0)
		 {
			$total_2nd_re_steaming_qty = '';
		 }
		 if( $total_3rd_re_steaming_qty == 0)
		 {
			$total_3rd_re_steaming_qty = '';
		 }
		 if( $total_4th_re_steaming_qty == 0)
		 {
			$total_4th_re_steaming_qty = '';
		 }

		 if( $total_ready_for_dyeing_qty == 0)
		 {
			$total_ready_for_dyeing_qty = '';
		 }
		 if( $total_re_ready_for_dyeing_qty == 0)
		 {
			$total_re_ready_for_dyeing_qty = '';
		 }
		 if( $total_2nd_re_ready_for_dyeing_qty == 0)
		 {
			$total_2nd_re_ready_for_dyeing_qty = '';
		 }
		 if( $total_3rd_re_ready_for_dyeing_qty == 0)
		 {
			$total_3rd_re_ready_for_dyeing_qty = '';
		 }
		 if( $total_4th_re_ready_for_dyeing_qty == 0)
		 {
			$total_4th_re_ready_for_dyeing_qty = '';
		 }

		 
		 if( $total_dyeing_qty == 0)
		 {
			$total_dyeing_qty = '';
		 }
		 if( $total_re_dyeing_qty == 0)
		 {
			$total_re_dyeing_qty = '';
		 }
		 if( $total_2nd_re_dyeing_qty == 0)
		 {
			$total_2nd_re_dyeing_qty = '';
		 }
		 if( $total_3rd_re_dyeing_qty == 0)
		 {
			$total_3rd_re_dyeing_qty = '';
		 }
		 if( $total_4th_re_dyeing_qty == 0)
		 {
			$total_4th_re_dyeing_qty = '';
		 }


		 if( $total_ready_for_raising_qty == 0)
		 {
			$total_ready_for_raising_qty = '';
		 }
		 if( $total_re_ready_for_raising_qty == 0)
		 {
			$total_re_ready_for_raising_qty = '';
		 }
		 if( $total_2nd_re_ready_for_raising_qty == 0)
		 {
			$total_2nd_re_ready_for_raising_qty = '';
		 }
		 if( $total_3rd_re_ready_for_raising_qty == 0)
		 {
			$total_3rd_re_ready_for_raising_qty = '';
		 }
		 if( $total_4th_re_ready_for_raising_qty == 0)
		 {
			$total_4th_re_ready_for_raising_qty = '';
		 }


		 if( $total_raising_qty == 0)
		 {
			$total_raising_qty = '';
		 }
		 if( $total_re_raising_qty == 0)
		 {
			$total_re_raising_qty = '';
		 }
		 if( $total_2nd_re_raising_qty == 0)
		 {
			$total_2nd_re_raising_qty = '';
		 }
		 if( $total_3rd_re_raising_qty == 0)
		 {
			$total_3rd_re_raising_qty = '';
		 }
		 if( $total_4th_re_raising_qty == 0)
		 {
			$total_4th_re_raising_qty = '';
		 }

		 
		 if( $total_washing_qty == 0)
		 {
			$total_washing_qty = '';
		 }
		 if( $total_re_washing_qty == 0)
		 {
			$total_re_washing_qty = '';
		 }
		 if( $total_2nd_re_washing_qty == 0)
		 {
			$total_2nd_re_washing_qty = '';
		 }
		 if( $total_3rd_re_washing_qty == 0)
		 {
			$total_3rd_re_washing_qty = '';
		 }
		 if( $total_4th_re_washing_qty == 0)
		 {
			$total_4th_re_washing_qty = '';
		 }


		 if( $total_finishing_qty == 0)
		 {
			$total_finishing_qty = '';
		 }
		 if( $total_re_finishing_qty == 0)
		 {
			$total_re_finishing_qty = '';
		 }
		 if( $total_2nd_re_finishing_qty == 0)
		 {
			$total_2nd_re_finishing_qty = '';
		 }
		 if( $total_3rd_re_finishing_qty == 0)
		 {
			$total_3rd_re_finishing_qty = '';
		 }
		 if( $total_4th_re_finishing_qty == 0)
		 {
			$total_4th_re_finishing_qty = '';
		 }

		 
		 if( $total_calendering_qty == 0)
		 {
			$total_calendering_qty = '';
		 }
		 if( $total_re_calendering_qty == 0)
		 {
			$total_re_calendering_qty = '';
		 }
		 if( $total_2nd_re_calendering_qty == 0)
		 {
			$total_2nd_re_calendering_qty = '';
		 }
		 if( $total_3rd_re_calendering_qty == 0)
		 {
			$total_3rd_re_calendering_qty = '';
		 }
		 if( $total_4th_re_calendering_qty == 0)
		 {
			$total_4th_re_calendering_qty = '';
		 }


		 if( $total_sanforizing_qty == 0)
		 {
			$total_sanforizing_qty = '';
		 }
		 if( $total_re_sanforizing_qty == 0)
		 {
			$total_re_sanforizing_qty = '';
		 }
		 if( $total_2nd_re_sanforizing_qty == 0)
		 {
			$total_2nd_re_sanforizing_qty = '';
		 }
		 if( $total_3rd_re_sanforizing_qty == 0)
		 {
			$total_3rd_re_sanforizing_qty = '';
		 }
		 if( $total_4th_re_sanforizing_qty == 0)
		 {
			$total_4th_re_sanforizing_qty = '';
		 }
		 


		 if( $total_process_qty == 0)
		 {
			$total_process_qty = '';
		 }
		 if( $total_process_short_excess_qty == 0)
		 {
			$total_process_short_excess_qty = '';
		 }
		 if( $total_greige_process_short_excess_qty == 0)
		 {
			$total_greige_process_short_excess_qty = '';
		 }
		 if( $total_reprocess_qty == 0)
		 {
			$total_reprocess_qty = '';
		 }


		 $table .='</tbody>';
			
		 $table .='<tr>

		 <td style="border: 1px solid black; border-width: 1px 0px 1px 1px;"></td>
		 <td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
		 <td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
		 <td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
		 <td  style="border: 1px solid black;border-width: 1px 1px 1px 0px;" text-align:right; font-weight: bold;">Total Quantity :</td>
		 <td style="border: 1px solid black">'.$total_ppq_value.'</td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black">'.$total_gic_value.'</td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black">'.$total_greige_short_excess_qty.'</td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black">'.$total_singeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_singeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_singeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_singeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_singeing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_desizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_desizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_desizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_desizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_desizing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_signe_desize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_signe_desize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_signe_desize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_signe_desize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_signe_desize_qty.'</td>

		 <td style="border: 1px solid black">'.$total_scouring_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_scouring_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_scouring_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_scouring_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_scouring_qty.'</td>

		 <td style="border: 1px solid black">'.$total_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_bleaching_qty.'</td>

		 <td style="border: 1px solid black">'.$total_souring_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_souring_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_souring_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_souring_bleaching_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_souring_bleaching_qty.'</td>

		 <td style="border: 1px solid black">'.$total_ready_for_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_ready_for_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_ready_for_mercherize_qty.'</td>

		 <td style="border: 1px solid black">'.$total_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_mercherize_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_mercherize_qty.'</td>

		 <td style="border: 1px solid black">'.$total_ready_for_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_ready_for_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_ready_for_print_qty.'</td>

		 <td style="border: 1px solid black">'.$total_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_print_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_print_qty.'</td>
		 
		 <td style="border: 1px solid black">'.$total_curing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_curing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_curing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_curing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_curing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_steaming_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_steaming_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_steaming_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_steaming_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_steaming_qty.'</td>

		 <td style="border: 1px solid black">'.$total_ready_for_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_ready_for_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_ready_for_dyeing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_dyeing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_dyeing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_ready_for_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_ready_for_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_ready_for_raising_qty.'</td>

		 <td style="border: 1px solid black">'.$total_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_raising_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_raising_qty.'</td>

		 <td style="border: 1px solid black">'.$total_washing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_washing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_washing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_washing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_washing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_finishing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_finishing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_finishing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_finishing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_finishing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_calendering_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_calendering_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_calendering_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_calendering_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_calendering_qty.'</td>

		 <td style="border: 1px solid black">'.$total_sanforizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_re_sanforizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_2nd_re_sanforizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_3rd_re_sanforizing_qty.'</td>
		 <td style="border: 1px solid black">'.$total_4th_re_sanforizing_qty.'</td>

		 <td style="border: 1px solid black">'.$total_process_qty.'</td>
		 <td style="border: 1px solid black">'.$total_process_short_excess_qty.'</td>
		 <td style="border: 1px solid black">'.$total_greige_process_short_excess_qty.'</td>
		 <td style="border: 1px solid black"></td>
		
		 <td style="border: 1px solid black">'.$total_reprocess_qty.'</td>
		
		
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>
		 <td style="border: 1px solid black"></td>

		</tr>';

		$table .='</table> </div>';
		 echo $table;


?> 

