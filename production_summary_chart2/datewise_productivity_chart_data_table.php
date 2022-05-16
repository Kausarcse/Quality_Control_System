<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$from_date = date_format(date_create($_POST['from_date']),"Y-m-d");
$to_date = date_format(date_create($_POST['to_date']),"Y-m-d");


$sql_for_production_date = "SELECT * from datewise_productivity_productive_time_downtime WHERE production_date BETWEEN '$from_date' AND '$to_date'";

$result_for_production_date= mysqli_query($con,$sql_for_production_date) or die(mysqli_error($con));

$production_date = array();
$value_for_change_overtime = array();
$value_for_breakdown_time = array();
$value_for_schedule_maintanance_time = array();
$value_for_production_time = array();
$value_for_production_quantity = array();

while($row_for_production_date=mysqli_fetch_array($result_for_production_date))
{
    $production_date[] = date_format(date_create($row_for_production_date['production_date']),"M-d");

    if($row_for_production_date['change_over_time'] != 0)
    {
        $value_for_change_overtime[] = $row_for_production_date['change_over_time'];
    }
    else
    {
        $value_for_change_overtime[] = '';
    }

    if($row_for_production_date['breakdown_time'] != 0)
    {
        $value_for_breakdown_time[] = $row_for_production_date['breakdown_time'];
    }
    else
    {
        $value_for_breakdown_time[] = '';
    }

    if($row_for_production_date['schedule_maintanance_time'] != 0)
    {
        $value_for_schedule_maintanance_time[] = $row_for_production_date['schedule_maintanance_time'];
    }
    else
    {
        $value_for_schedule_maintanance_time[] = '';
    }

    if($row_for_production_date['production_time'] != 0)
    {
        $value_for_production_time[] = $row_for_production_date['production_time'];
    }
    else
    {
        $value_for_production_time[] = '';
    }

    $value_for_production_quantity[] = $row_for_production_date['production_quantity'];

}


$response = array(
    'production_date'  => $production_date,
    'value_for_change_overtime' => $value_for_change_overtime,
    'value_for_breakdown_time'  => $value_for_breakdown_time,
    'value_for_schedule_maintanance_time' => $value_for_schedule_maintanance_time,
    'value_for_production_time'  => $value_for_production_time,
    'value_for_production_quantity' => $value_for_production_quantity,
);

//$value = $value_for_change_overtime.'?fs?'.$value_for_breakdown_time.'?fs?'.$value_for_schedule_maintanance_time.'?fs?'.$value_for_production_time.'?fs?'.$value_for_production_quantity;
echo json_encode($response);

?>
