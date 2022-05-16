<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

echo $customer_id= $_POST['customer_id'];
echo $customer_name= $_POST['customer_name'];
echo $version_number= $_POST['version_number'];
echo $color_name= $_POST['color_name'];
echo $process_id= $_POST['process_id'];
echo $process_name= $_POST['process_name'];
echo $process_serial= $_POST['process_serial'];
echo $process_technique_name= $_POST['process_technique_name'];

echo '<br>';
if ( $process_name == 'Greige Receiving') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_greige_receiving_process.php";
}
else if ( $process_name == 'Singeing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_singeing_process.php";
}
else if ( $process_name == 'Desizing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_desizing_process.php";
}
else if ( $process_name == 'Singeing & Desizing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_singe_and_desize_process.php";
}
else if ( $process_name == 'Scouring') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_scouring_process.php";
}
else if ( $process_name == 'Bleaching') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_bleaching_process.php";
}
else if ( $process_name == 'Scouring & Bleaching') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_scouring_bleaching_process.php";
}
else if ( $process_name == 'Ready For Mercerize') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_ready_for_mercerize_process.php";
}
else if ( $process_name == 'Mercerize') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_mercerize_process.php";
}
else if ( $process_name == 'Ready For Print') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_ready_for_print_process.php";
}
else if ( $process_name == 'Printing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_printing_process.php";
}
else if ( $process_name == 'Curing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_curing_process.php";
}
else if ( $process_name == 'Ready For Dyeing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_ready_for_dyeing_process.php";
}
else if ( $process_name == 'Washing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_washing_process.php";
}
else if ( $process_name == 'Ready For Raising') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_ready_for_raising_process.php";
}
else if ( $process_name == 'Raising') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_raising_process.php";
}
else if ( $process_name == 'Finishing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_finishing_process.php";
}
else if ( $process_name == 'Calander') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_calendering_process.php";
}
else if ( $process_name == 'Sanforizing') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_sanforizing_process.php";
}
else if ( $process_name == 'Dyeing-Finish') 
{
	//echo $_SERVER['PHP_SELF'];
	require_once "../process_program/defining_qc_standard_for_dyeing_finish_process.php";
}

?>