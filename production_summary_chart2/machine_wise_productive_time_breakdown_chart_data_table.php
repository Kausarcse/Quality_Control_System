<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$from_date = date_format(date_create($_POST['from_date']),"Y-m-d");
$to_date = date_format(date_create($_POST['to_date']),"Y-m-d");

//days calculation part
$date1=date_create($from_date);
$date2=date_create($to_date);
$diff=date_diff($date1,$date2);
$different = $diff->format("%R%a");
$total_days_hour = $different * 24;

$machines = mysqli_real_escape_string($con, $_POST['machine']);
$arr = explode(',', $machines);
$count = count($arr);
$ids = join("','",$arr);   


$production_date = array();
$machine_name = array();

$value_for_change_overtime_arr = array();
$value_for_breakdown_time_arr = array();
$value_for_schedule_maintanance_time_arr = array();
$value_for_total_time_arr = array();
$value_for_production_time_arr = array();
$value_for_production_quantity_arr = array();

$value_for_change_overtime = 0;
$value_for_breakdown_time = 0;
$value_for_schedule_maintanance_time = 0;
$value_for_production_time = 0;


$sql_for_production_date = "SELECT machine_name, SUM(problem) problem_time, problem_group from machine_wise_productive_time_breakdown
WHERE partial_test_for_test_result_creation_date BETWEEN '$from_date' AND '$to_date'
AND  machine_name IN ('$ids')
GROUP BY process_name, machine_name, problem_group";

$result_for_production_date= mysqli_query($con,$sql_for_production_date) or die(mysqli_error($con));


while($row_for_production_date=mysqli_fetch_array($result_for_production_date))
{

    if (in_array($row_for_production_date['machine_name'], $machine_name))
    {
        //finding problem group
        //Change Over Time
        if($row_for_production_date['problem_group'] == 'Change Over Time')
        {
            $value_for_change_overtime += $row_for_production_date['problem_time'];
            $value_for_production_time = end($value_for_production_time_arr);
            $value_for_production_time = ($value_for_production_time - $value_for_change_overtime);

            array_pop($value_for_change_overtime_arr);
            array_push($value_for_change_overtime_arr, $value_for_change_overtime);
            $value_for_change_overtime = 0;

            array_pop($value_for_production_time_arr);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }

        //Machine Breakdown
        if($row_for_production_date['problem_group'] == 'Machine Breakdown')
        {
            $value_for_breakdown_time += $row_for_production_date['problem_time'];

            $value_for_production_time = end($value_for_production_time_arr);
            $value_for_production_time = ($value_for_production_time - $value_for_breakdown_time);

            array_pop($value_for_breakdown_time_arr);
            array_push($value_for_breakdown_time_arr, $value_for_breakdown_time);
            $value_for_breakdown_time = 0;

            array_pop($value_for_production_time_arr);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }

        //Schedule Maintanance
        if($row_for_production_date['problem_group'] == 'Schedule Maintanance')
        {
            $value_for_schedule_maintanance_time += $row_for_production_date['problem_time'];

            $value_for_production_time = end($value_for_production_time_arr);
            $value_for_production_time = ($value_for_production_time - $value_for_schedule_maintanance_time);

            array_pop($value_for_schedule_maintanance_time_arr);
            array_push($value_for_schedule_maintanance_time_arr, $value_for_schedule_maintanance_time);
            $value_for_schedule_maintanance_time = 0;

            array_pop($value_for_production_time_arr);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }
    }
    else
    {
        array_push($machine_name, $row_for_production_date['machine_name']);

        //finding problem group
        //Change Over Time
        if($row_for_production_date['problem_group'] == 'Change Over Time')
        {
            $value_for_change_overtime += $row_for_production_date['problem_time'];
            $value_for_production_time = ( $total_days_hour - $value_for_production_time - $value_for_change_overtime);
            array_push($value_for_change_overtime_arr, $value_for_change_overtime);
            $value_for_change_overtime = 0;
            array_push($value_for_breakdown_time_arr, '');
            array_push($value_for_schedule_maintanance_time_arr, '');
            array_push($value_for_total_time_arr, $total_days_hour);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }

        //Machine Breakdown
        if($row_for_production_date['problem_group'] == 'Machine Breakdown')
        {
            $value_for_breakdown_time += $row_for_production_date['problem_time'];
            $value_for_production_time = ($total_days_hour - $value_for_production_time - $value_for_breakdown_time);
            array_push($value_for_breakdown_time_arr, $value_for_breakdown_time);
            $value_for_breakdown_time = 0;
            array_push($value_for_change_overtime_arr, '');
            array_push($value_for_schedule_maintanance_time_arr, '');
            array_push($value_for_total_time_arr, $total_days_hour);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }

        //Schedule Maintanance
        if($row_for_production_date['problem_group'] == 'Schedule Maintanance')
        {
            $value_for_schedule_maintanance_time += $row_for_production_date['problem_time'];
            $value_for_production_time = ($total_days_hour - $value_for_production_time - $value_for_schedule_maintanance_time);
            array_push($value_for_schedule_maintanance_time_arr, $value_for_schedule_maintanance_time);
            $value_for_schedule_maintanance_time = 0;
            array_push($value_for_change_overtime_arr, '');
            array_push($value_for_breakdown_time_arr, '');
            array_push($value_for_total_time_arr, $total_days_hour);
            array_push($value_for_production_time_arr, $value_for_production_time);
            $value_for_production_time = 0;
        }
    }

}

$response = array(
            'machine_name'  => $machine_name,
            'value_for_change_overtime' => $value_for_change_overtime_arr,
            'value_for_breakdown_time'  => $value_for_breakdown_time_arr,
            'value_for_schedule_maintanance_time' => $value_for_schedule_maintanance_time_arr,
            'value_for_production_time'  => $value_for_production_time_arr,
            'value_for_total_time' => $value_for_total_time_arr,
        );

//$value = $value_for_change_overtime.'?fs?'.$value_for_breakdown_time.'?fs?'.$value_for_schedule_maintanance_time.'?fs?'.$value_for_production_time.'?fs?'.$value_for_production_quantity;
echo json_encode($response);

?>
