<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$sub_query='';
$date = date("d-m-Y");

$user_name=$_SESSION['user_name'];

if(isset($_POST['folding_id']))
{   
  
   $folding_id=$_POST['folding_id'];

   

}

		 
$table =' <table class="table table-bordered">
<thead>
	<tr>
		<td colspan="9"
			style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
			Waiting For Rework</td>
	</tr>
</thead>
</table>
<div id="overflow_rework" style="overflow: auto;">                        
<table id="datatable_for_rework" class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2">Date</th>    
			<th rowspan="2">Shift</th>
			<th rowspan="2">TRF No.</th>
			<th rowspan="2">PP</th>
			<th rowspan="2">Customer</th>
			<th rowspan="2">Design</th>
			<th rowspan="2">Version</th>
			<th rowspan="2">Style</th>
			<th rowspan="2">Color</th>
			<th rowspan="2">Construction</th>
			<th rowspan="2">Process Step</th>
			<th rowspan="2">Trolly</th>
			<th rowspan="2">Finish Width (Inch)</th>
			<th rowspan="2">Quantity (mtr.)</th>
			<th rowspan="2">Authorized By</th>
			<th colspan="2" style="text-align: center;">Action</th>
			<th rowspan="2">Confirm Action</th>
			<th rowspan="2">Status</th>
		</tr>
		<tr>
			<th>Reason of Rework</th>
			<th>Corrective Action</th>
			
		</tr>
	</thead>';


 $sql_for_rework = "SELECT * FROM inspection_and_folding where folding_id = '$folding_id'";

$result_for_rework = mysqli_query($con, $sql_for_rework) or die(mysqli_errno($con));

$row_for_rework = mysqli_fetch_assoc($result_for_rework);

	$table.=' <form class="form-horizontal" action="" method="POST" name="rework_form" id="rework_form">
			<tbody>
			<td>'.$date.'</td>
			<td></td>
			<td><input type="text" size="10" style="border: none;" id="trf_id_for_rework" name="trf_id_for_rework" value="'.$row_for_rework['trf_no'].'"</td>
			<td><input type="text" size="15" style="border: none;" id="pp_number_for_rework" name="pp_number_for_rework" value="'.$row_for_rework['pp_number'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="customer_name_for_rework" name="customer_name_for_rework" value="'.$row_for_rework['customer_name'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="design_for_rework" name="design_for_rework" value="'.$row_for_rework['design'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="version_number_for_rework" name="version_number_for_rework" value="'.$row_for_rework['version_number'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="style_name_for_rework" name="style_name_for_rework" value="'.$row_for_rework['style_name'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="color_for_rework" name="color_for_rework" value="'.$row_for_rework['color'].'"</td>
			<td><input type="text" size="6" style="border: none;" id="construction_name_for_rework" name="construction_name_for_rework" value="'.$row_for_rework['construction_name'].'"></td>
			<td><input type="text" size="6" style="border: none;" id="process_name_for_rework" name="process_name_for_rework" value="'.$row_for_rework['process_name'].'"</td>
			<td><input type="text" size="4" style="border: none;" id="trolly_for_rework" name="trolly_for_rework" value="'.$row_for_rework['after_trolley_number_or_batcher_number'].'"></td>
			<td><input type="text" size="4" style="border: none;" id="finish_width_for_rework" name="finish_width_for_rework" value="'.$row_for_rework['finish_width'].'"></td>
			<td><input type="text" size="4" style="border: none;" id="quantity_for_rework" name="quantity_for_rework" value="'.$row_for_rework['returing_quantity'].'"></td>
			<td>'.$user_name.'</td>
			<td><input type="text" size="4" style="border: none;" id="for_reason_of_rework" name="for_reason_of_rework"></td>
			<td><input type="text" size="4" style="border: none;" id="for_corrective_action_of_rework" name="for_corrective_action_of_rework"></td>
			<td>
				<button type="button" class="btn btn-primary" onClick="sending_data_of_approved_for_rework_form_for_saving_in_database()">Approved</button>
			</td>
	</tbody>
</table>
</div>    
</form>  ';
		
		
		 echo $table;


?> 

