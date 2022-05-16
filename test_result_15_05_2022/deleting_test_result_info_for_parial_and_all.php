<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_deleteion_hampering = "No";


$all_data = $_POST['all_data'];

$split_all_data=explode("?fs?", $all_data);
//$split_all_data=preg_split("@[\s+　]@u", $all_data);;

$partial_test_for_test_result_id = $split_all_data[0];
$process_id=$split_all_data[1];
$pp_number=$split_all_data[2]; 
$version_number=$split_all_data[3];
$finish_width_in_inch=$split_all_data[4];
$version_id = $split_all_data[5];
$before_trolley_number_or_batcher_number = $split_all_data[6];
$after_trolley_number_or_batcher_number = $split_all_data[7];
$after_trolley_or_batcher_qty = $split_all_data[8];

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));



	$delete_sql_statement="DELETE FROM `partial_test_for_test_result_info` WHERE `partial_test_for_test_result_id`='$partial_test_for_test_result_id'";

	mysqli_query($con,$delete_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
		$data_deleteion_hampering = "Yes";
	}

	else
	{
		if($process_id == 'proc_20')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_greige_receiving_process` 
											WHERE pp_number = '$pp_number' and version_number = '$version_number' and finish_width_in_inch = '$finish_width_in_inch' and 
											before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and 
											after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and 
											received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_1')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_singe_and_desize_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_2')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_scouring_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_3')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_bleaching_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'  
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_4')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_scouring_bleaching_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_5')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_ready_for_mercerize_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'  
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_6')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_mercerize_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_7')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_ready_for_printing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_8')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_printing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_9')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_curing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_10')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_steaming_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and 
			after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_11')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_ready_for_dying_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'  
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_12')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_dyeing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'  
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and 
			after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and received_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_13')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_washing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_14')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_ready_for_raising_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'  
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_15')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_raising_process` WHERE pp_number = '$pp_number' and version_number = '$version_number'
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_16')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_finishing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_17')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_calendering_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_18')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_sanforizing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_21')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_singeing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and 
			after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_22')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_desizing_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
		else if($process_id == 'proc_23')
		{
			$delete_sql_statement_second="DELETE FROM `qc_result_for_dyeing_finish_process` WHERE pp_number = '$pp_number' and version_number = '$version_number' 
			and finish_width_in_inch = '$finish_width_in_inch' and before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number'  and 
			after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number' and total_quantity_in_meter = '$after_trolley_or_batcher_qty' ";

			mysqli_query($con,$delete_sql_statement_second) or die(mysqli_error($con));

			if(mysqli_affected_rows($con)<>1)
			{
			
				$data_deleteion_hampering = "Yes";
			
			}
		}
	}

if($data_deleteion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo " Test Result Info is successfully Deleted.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo " Test Result Info is not successfully Deleted.";

}

$obj->disconnection();

?>
