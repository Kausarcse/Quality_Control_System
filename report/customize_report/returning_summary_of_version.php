<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$sub_query='';
$pp_number=$_POST['pp_number_value'];
$version_number=$_POST['version_number_value'];
$color_value=$_POST['color_value'];
$design=$_POST['design'];
$process_name=$_POST['process_name'];


if(isset($_POST['pp_number_value']))
{
    $pp_number=$_POST['pp_number_value'];

    $sub_query+="and  pwvc.pp_number='$pp_number' ";

}

if(isset($_POST['version_number_value']))
{
    $version_number=$_POST['version_number_value'];

    $sub_query+="and  pwvc.version_number='$version_number' ";

}
if(isset($_POST['pp_number_value']))
{
    $pp_number=$_POST['pp_number_value'];

    $sub_query+="and  pwvc.pp_number='$pp_number' ";

}
if(isset($_POST['design']))
{
    $design=$_POST['design'];

    $sub_query+="and  pwvc.design='$design' ";

} 

if(isset($_POST['process_name']))
{
    $process_name=$_POST['process_name'];

    $sub_query+="and  pwvc.process_name='$process_name' ";

} 
$table ='
			         <table id="datatable-buttons" class="table table-striped table-bordered">
			         	<thead>
			                 <tr>
			                 <th>PP</th>
			                 <th>Design</th>
			                 <th>Version</th>
			                 <th>G.W.</th>
			                 <th>F.W.</th>
			                 <th>PP QTY</th>
			                 <th>Process Quantity</th>
			                 <th>Balance</th>
			                 <th>Remarks</th>
			                 </tr>
			            </thead>
			            <tbody>';
		$sql = "SELECT * FROM 
					pp_wise_version_creation_info pwvc, all_test_for_test_result_info atftr
					 where 1=1
					and pwvc.version_name = atftr.version_number	
					and pwvc.pp_number = atftr.pp_number
					".$sub_query.";
					 order by row_id ASC";
	//  echo $sql;
	//  exit();
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 while( $row = mysqli_fetch_array( $result))
		 {    
              $table .='<tr>
			                 <td onclick="find_details()">'.$row['pp_number'].'</td>
			                 <td>'.$row['version_name'].'</td>
			                 <td>'.$row['design'].'</td>
			                 <td>'.$row['greige_width_in_inch'].'</td>
			                 <td>'.$row['finish_width_in_inch'].'</td>
			                 <td>'.$row['pp_quantity'].'</td>
							 <td>'.$row['qty'].'</td>
			                 <td>'.$row['qty']-$row['pp_quantity'].'</td>
			                 <td></td>
			                 </tr>';
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