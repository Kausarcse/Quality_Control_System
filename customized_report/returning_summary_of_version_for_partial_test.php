<?php
error_reporting(0);
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$sub_query='';
$i=1;
/*$pp_number=$_POST['pp_number_value'];
$version_number=$_POST['version_number_value'];
$color_value=$_POST['color_value'];
$design=$_POST['design'];
$process_name=$_POST['process_name'];*/


if(isset($_POST['pp_number_value']))
{
    $pp_number=$_POST['pp_number_value'];

    $sub_query.="and  pwvc.pp_number='".$pp_number."'";

}

if(isset($_POST['version_number_value']) && $_POST['version_number_value']!='select')
{
    $version_name=$_POST['version_number_value'];

    $sub_query.="and  pwvc.version_name='".$version_name."' ";

}

if(isset($_POST['version_id']))
{
    $version_id=$_POST['version_id'];

    $sub_query.="and  pwvc.version_id='".$version_id."' ";

}

/*if(isset($_POST['design']))
{
    $design=$_POST['design'];

    $sub_query.="and  atftr.design='".$design."' ";

} */

if(isset($_POST['process_name']))
{
    $process_name=$_POST['process_name'];

    $sub_query.="and  atftr.process_name='".$process_name."' ";

} 
$table ='<div><label class="form-control">Summary Information</label> </div>

			         <table id="datatable-buttons" class="table table-striped table-bordered">
			         	<thead>
			                 <tr>
			                 
			                 <th>PP</th>
			                 <th>Customer Name</th>
			                 <th>Design</th>
			                 <th>Version</th>
			                 <th>Style</th>
			                 <th>Color</th>
			                 <th style="display:none;">Row ID</th>
			                 <th style="display:none;">Version ID</th>
			                 <th>G.W.</th>
			                 <th>F.W.</th>
			                 <th>PP QTY</th>
			                 <th>Process Quantity</th>
			                 <th>Balance</th>
			                 
			                 </tr>
			            </thead>
			            <tbody>';
		/*$sql = "SELECT * FROM 
					pp_wise_version_creation_info pwvc, partial_test_for_test_result_info atftr
					 where 1=1
					and pwvc.version_name = atftr.version_number	
					and pwvc.pp_number = atftr.pp_number
					".$sub_query."
					 order by row_id ASC";*/

					 $sql = "SELECT pwvc.pp_number,atftr.customer_name,pwvc.style_name,pwvc.color,atftr.design,pwvc.version_name,atftr.partial_test_for_test_result_id,atftr.version_id,pwvc.greige_width_in_inch,pwvc.finish_width_in_inch,pwvc.pp_quantity,atftr.after_trolley_or_batcher_qty

                    ,round(((atftr.after_trolley_or_batcher_qty) - (pwvc.pp_quantity)),2) short_or_excess
					  FROM 
					pp_wise_version_creation_info pwvc, partial_test_for_test_result_info atftr
					 where 1=1
					and pwvc.version_name = atftr.version_number	
					and pwvc.pp_number = atftr.pp_number
					and pwvc.style_name = atftr.style
					and pwvc.finish_width_in_inch = atftr.finish_width_in_inch
					".$sub_query."
					 order by row_id ASC";
	/* echo $sql;*/
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
              $table .='<tr>
			                 <td onclick="find_details(&quot;'.$i.'&quot;)" id="pp_number_color_change">'.$row['pp_number'].'</td>
			                 <td>'.$row['customer_name'].'</td>
			                 <td>'.$row['design'].'</td>
			                 <td>'.$row['version_name'].'</td>
			                 <td>'.$row['style_name'].'</td>
			                 <td>'.$row['color'].'</td>
			                 <td style="display: none;"  id="table_row_id'.$i.'">'.$row['partial_test_for_test_result_id'].'</td>
			                 <td style="display: none;"  id="table_version_id'.$i.'">'.$row['version_id'].'</td>
			                 
			                 <td>'.$row['greige_width_in_inch'].'</td>
			                 <td>'.$row['finish_width_in_inch'].'</td>
			                 <td>'.$row['pp_quantity'].'</td>
							 <td>'.$row['after_trolley_or_batcher_qty'].'</td>
			                 <td id="process_quantity">'.($row['short_or_excess']).'</td>
			                 
			                 </tr>';

			                 $i++;
		 }
		 
		 // $table .='<tr>
			                 // <td>Total</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // <td>'.$row[''].'</td>
			                 // </tr>';
			$table .='				 </tbody>
			         </table>';

		
		 echo $table;


?>