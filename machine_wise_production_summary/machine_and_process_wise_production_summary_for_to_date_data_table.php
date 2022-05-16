
<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("Y-m-d");



$sub_query='';

if(isset($_POST['to_date']) && isset($_POST['from_date']) && $_POST['to_date']!='')
{   
    
  $from_date= date_format(date_create($_POST['from_date']),"Y-m-d");

  $to_date=date_format(date_create($_POST['to_date']),"Y-m-d");

 $sub_query.=" and  (partial_test_for_test_result_creation_date between '".$from_date."' and '".$to_date."')";

}


$table ='    

        <form class="form-horizontal" action="" name="machine_and_process_wise_production_summary_form" id="machine_and_process_wise_production_summary_form">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; ">
                            Machine & Process Wise Production Summary
                        </td>
                    </tr>
                   
                </thead>
            </table>
        </div>
        
        <div class="row" >
            <div class="col-sm-6" style="padding-right: 6px;">
                <table class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr style="background-color: #C0C0C0; border: 2px solid black;">
                            <th colspan="2" style="border: 1px solid; text-align:center">Process wise Machines</th>
                            <th style="border: 1px solid; text-align:center">Today</th>
                            <th style="border: 1px solid; text-align:center">To Date</th>
                            <th style="border: 1px solid; text-align:center">Avg / Day</th>
                        </tr>
                    </thead>
                    
                    <tbody>';

                    
                    /////////////////////////////// Start For greige receiving Process ////////////////////////////////////

                    $today_qty = 0;
                    $today_total_qty = 0;
                    $total_till_yesterday_qty = 0;
                    $daily_avg_count = 0;
                    $total_current_daily_avg = 0;
                    $counter_today = 0;
                    $today_total_qty_for_process = 0;
                    $total_till_yesterday_qty_for_process = 0;
                    $total_current_daily_avg_for_process = 0;


                    $sql_for_process = "SELECT process_name, SUM(after_trolley_or_batcher_qty) as total_qty, 
                                        COUNT(partial_test_for_test_result_creation_date) AS count  
                                        from partial_test_for_test_result_info 
                                        WHERE partial_test_for_test_result_creation_date <= '$to_date' AND 
                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                        and process_name = 'Greige Receiving' ".$sub_query." ";

                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_array($res_for_process))
                    {
                        $today_qty = 0;
                        $today_total_qty = 0;

                        $process_name = $row_for_process['process_name'];

                        $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                            from partial_test_for_test_result_info 
                                            where  process_name = '$process_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                        $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                        if($row_for_today_qty['today_qty']!= null)
                        {
                            $today_qty = $row_for_today_qty['today_qty'];
                            $counter_today +=1;
                        }
                        else
                        {
                            $today_qty=0;
                            $counter_today =0;
                        }

                        if($row_for_process['count']!=null)
                        {
                            $daily_avg_count = $row_for_process['count'];
                        }
                        else
                        {
                            $daily_avg_count = $counter_today;
                        }

                        $today_total_qty += $today_qty;

                        if($row_for_process['total_qty'] !=null)
                        {
                            $total_till_yesterday_qty = $row_for_process['total_qty'];
                        }
                        else
                        {
                            $total_till_yesterday_qty = 0;
                        }

                        if($total_till_yesterday_qty > 0)
                        {
                            $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                        }
                        else
                        {
                            $total_current_daily_avg = 0;
                        }                                        }
                        
                        $table .='<tr style="background-color: #EBECF0; border: 2px solid black;">
                            <th colspan="5" style="text-align: center;">Greige Receiving</th>
                        </tr>';
                        
                        $table .='<tr style="border: 2px solid black;">
                            <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Greige Issue</td>
                            <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                            <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                            <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                        </tr>';
                            /////////////////////////// End For greige receiving Process ////////////////////////////////////////////////

                            //////////////////////// Start For Singeing & Desizing Process ////////////////////////////////////////////////////////////
                      
                        $table .='<tr style="background-color: #EBECF0; border: 2px solid black;">
                            <th colspan="5" style="text-align: center;">Singeing & Desizing</th>
                        </tr>';

                        
                        $total_till_yesterday_qty = 0;
                        $daily_avg_count = 0;
                        $total_current_daily_avg = 0;
                        $counter_today = 0;
                        $today_total_qty_for_process = 0;
                        $total_till_yesterday_qty_for_process = 0;
                        $total_current_daily_avg_for_process = 0;

                        $machine_name_for_array = array();
                        $today_qty_for_array = array();
                        $todate_total_qty_for_array = array();
                        $avg_per_day_qty_for_array = array();

                        $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                WHERE process_id = 'proc_1' OR process_id = 'proc_21' OR process_id = 'proc_22'";
                        
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $today_qty = 0;
                            $today_total_qty = 0;

                            $machine_name = $row_for_machine['machine_name'];

                            // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                from partial_test_for_test_result_info where (process_id = 'proc_1' OR process_id = 'proc_21' OR process_id = 'proc_22') AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                            $res_for_process = mysqli_query($con, $sql_for_process);

                            $row_for_process = mysqli_fetch_array($res_for_process);

                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                from partial_test_for_test_result_info 
                                                where  (process_id = 'proc_1' OR process_id = 'proc_21' OR process_id = 'proc_22') AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                            $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                            if($row_for_today_qty['today_qty']!= null)
                            {
                                $today_qty = $row_for_today_qty['today_qty'];
                                $counter_today +=1;
                            }
                            else
                            {
                                $today_qty=0;
                                $counter_today =0;
                            }

                            if($row_for_process['count']!=null)
                            {
                                $daily_avg_count = $row_for_process['count'];
                            }
                            else
                            {
                                $daily_avg_count = $counter_today;
                            }

                            $today_total_qty += $today_qty;

                            if($row_for_process['total_qty'] !=null)
                            {
                                $total_till_yesterday_qty = $row_for_process['total_qty'];
                            }
                            else
                            {
                                $total_till_yesterday_qty = 0;
                            }

                            if($total_till_yesterday_qty > 0)
                            {
                                $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                            }
                            else
                            {
                                $total_current_daily_avg = 0;
                            }

                            $table .= '<tr style="border: 2px solid black;">
                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                            </tr>';
                           

                            $today_total_qty_for_process += $today_total_qty;
                            $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                            $total_current_daily_avg_for_process += $total_current_daily_avg;

                            if($today_total_qty == 0)
                            {
                                $today_total_qty = '';
                            }
                            if($total_till_yesterday_qty == 0)
                            {
                                $total_till_yesterday_qty = '';
                            }
                            if($total_current_daily_avg == 0)
                            {
                                $total_current_daily_avg = '';
                            }

                            if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                            {

                            }
                            else
                            {
                                $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                
                                $today_qty_for_array[] .= $today_total_qty;

                                $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                            }
                        }

                        $table .= '<tr style="border: 2px solid black;">
                            <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                            <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                            <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                            <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                        </tr>';

                        // echo $table;
                        // exit();

                            //////////////////////// End For Singeing & Desizing Process ////////////////////////////////////////////////////////////

                            //////////////////////// Start For Scouring & Bleaching Process ////////////////////////////////////////////////////////////

                        $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                            <th colspan="5" style="text-align: center;">Scouring & Bleaching</th>
                        </tr>';

                       
                        $total_till_yesterday_qty = 0;
                        $daily_avg_count = 0;
                        $total_current_daily_avg = 0;
                        $counter_today = 0;
                        $today_total_qty_for_process = 0;
                        $total_till_yesterday_qty_for_process = 0;
                        $total_current_daily_avg_for_process = 0;
                        $machine_name_for_scouring_and_bleaching = array();

                        $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                WHERE process_id = 'proc_2' OR process_id = 'proc_3' OR process_id = 'proc_4'";
                        
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $today_qty = 0;
                            $today_total_qty = 0;

                            $machine_name = $row_for_machine['machine_name'];

                            // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                from partial_test_for_test_result_info where (process_id = 'proc_2' OR process_id = 'proc_3' OR process_id = 'proc_4') AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                            $res_for_process = mysqli_query($con, $sql_for_process);

                            $row_for_process = mysqli_fetch_array($res_for_process);

                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                from partial_test_for_test_result_info 
                                                where  (process_id = 'proc_2' OR process_id = 'proc_3' OR process_id = 'proc_4') AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                            $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                            if($row_for_today_qty['today_qty']!= null)
                            {
                                $today_qty = $row_for_today_qty['today_qty'];
                                $counter_today +=1;
                            }
                            else
                            {
                                $today_qty=0;
                                $counter_today =0;
                            }

                            if($row_for_process['count']!=null)
                            {
                                $daily_avg_count = $row_for_process['count'];
                            }
                            else
                            {
                                $daily_avg_count = $counter_today;
                            }

                            $today_total_qty += $today_qty;

                            if($row_for_process['total_qty'] !=null)
                            {
                                $total_till_yesterday_qty = $row_for_process['total_qty'];
                            }
                            else
                            {
                                $total_till_yesterday_qty = 0;
                            }

                            if($total_till_yesterday_qty > 0)
                            {
                                $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                            }
                            else
                            {
                                $total_current_daily_avg = 0;
                            }


                            $table .= '<tr style="border: 2px solid black;">
                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                            </tr>';

                            $today_total_qty_for_process += $today_total_qty;
                            $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                            $total_current_daily_avg_for_process += $total_current_daily_avg;

                            if($today_total_qty == 0)
                            {
                                $today_total_qty = '';
                            }
                            if($total_till_yesterday_qty == 0)
                            {
                                $total_till_yesterday_qty = '';
                            }
                            if($total_current_daily_avg == 0)
                            {
                                $total_current_daily_avg = '';
                            }

                            if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                            {

                            }
                            else
                            {
                                $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                
                                $today_qty_for_array[] .= $today_total_qty;

                                $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                            }
                        }

                        $table .= '<tr style="border: 2px solid black;">
                            <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                            <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                            <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                            <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                        </tr>';

                                //////////////////////// End For Scouring & Bleaching Process ////////////////////////////////////////////////////////////

                                //////////////////////// Start For Equalize Process ////////////////////////////////////////////////////////////
                              
                              
                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Equalize</th>
                                </tr>';

                               
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_5' OR process_id = 'proc_7' OR process_id = 'proc_11' OR process_id = 'proc_14'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                        from partial_test_for_test_result_info where (process_id = 'proc_5' OR process_id = 'proc_7' OR process_id = 'proc_11' OR process_id = 'proc_14') AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                    $res_for_process = mysqli_query($con, $sql_for_process);

                                    $row_for_process = mysqli_fetch_array($res_for_process);

                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                        from partial_test_for_test_result_info 
                                                        where  (process_id = 'proc_5' OR process_id = 'proc_7' OR process_id = 'proc_11' OR process_id = 'proc_14') AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                    $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                    $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                    if($row_for_today_qty['today_qty']!= null)
                                    {
                                        $today_qty = $row_for_today_qty['today_qty'];
                                        $counter_today +=1;
                                    }
                                    else
                                    {
                                        $today_qty=0;
                                        $counter_today =0;
                                    }

                                    if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count = $counter_today;
                                    }

                                    $today_total_qty += $today_qty;

                                    if($row_for_process['total_qty'] !=null)
                                    {
                                        $total_till_yesterday_qty = $row_for_process['total_qty'];
                                    }
                                    else
                                    {
                                        $total_till_yesterday_qty = 0;
                                    }

                                    if($total_till_yesterday_qty > 0)
                                    {
                                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                    }
                                    else
                                    {
                                        $total_current_daily_avg = 0;
                                    }  
                
                                    $table .= '<tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                    </tr>';
               
                                    $today_total_qty_for_process += $today_total_qty;
                                    $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                    $total_current_daily_avg_for_process += $total_current_daily_avg;

                                    if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                        
                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }
                                }
        
                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';
       
                                
                                    //////////////////////// End For Equalize Process ////////////////////////////////////////////////////////////
                        
                                    //////////////////////// Start For Prining Process ////////////////////////////////////////////////////////////
       
       
                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Printing</th>
                                </tr>';
        
                                
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_8'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                        from partial_test_for_test_result_info where process_id = 'proc_8' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                    $res_for_process = mysqli_query($con, $sql_for_process);

                                    $row_for_process = mysqli_fetch_array($res_for_process);

                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                        from partial_test_for_test_result_info 
                                                        where  process_id = 'proc_8' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                    $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                    $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                    if($row_for_today_qty['today_qty']!= null)
                                    {
                                        $today_qty = $row_for_today_qty['today_qty'];
                                        $counter_today +=1;
                                    }
                                    else
                                    {
                                        $today_qty=0;
                                        $counter_today =0;
                                    }

                                    if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count = $counter_today;
                                    }

                                    $today_total_qty += $today_qty;

                                    if($row_for_process['total_qty'] !=null)
                                    {
                                        $total_till_yesterday_qty = $row_for_process['total_qty'];
                                    }
                                    else
                                    {
                                        $total_till_yesterday_qty = 0;
                                    }

                                    if($total_till_yesterday_qty > 0)
                                    {
                                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                    }
                                    else
                                    {
                                        $total_current_daily_avg = 0;
                                    }    
                
                                    $table .= '<tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                    </tr>';

                                    $today_total_qty_for_process += $today_total_qty;
                                    $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                    $total_current_daily_avg_for_process += $total_current_daily_avg;

                                    if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                        
                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }
                                }

                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';

                                //////////////////////// End For Printing Process ////////////////////////////////////////////////////////////
        
                                //////////////////////// Start For Raising Process ////////////////////////////////////////////////////////////
      
                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Raising</th>
                                </tr>';
      
                                
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_15'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                    from partial_test_for_test_result_info where process_id = 'proc_15' AND 
                                                    machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                    partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                    from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                $res_for_process = mysqli_query($con, $sql_for_process);

                                $row_for_process = mysqli_fetch_array($res_for_process);

                                $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                    from partial_test_for_test_result_info 
                                                    where  process_id = 'proc_15' AND 
                                                    machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                if($row_for_today_qty['today_qty']!= null)
                                {
                                    $today_qty = $row_for_today_qty['today_qty'];
                                    $counter_today +=1;
                                }
                                else
                                {
                                    $today_qty=0;
                                    $counter_today =0;
                                }

                                if($row_for_process['count']!=null)
                                {
                                    $daily_avg_count = $row_for_process['count'];
                                }
                                else
                                {
                                    $daily_avg_count = $counter_today;
                                }

                                $today_total_qty += $today_qty;

                                if($row_for_process['total_qty'] !=null)
                                {
                                    $total_till_yesterday_qty = $row_for_process['total_qty'];
                                }
                                else
                                {
                                    $total_till_yesterday_qty = 0;
                                }

                                if($total_till_yesterday_qty > 0)
                                {
                                    $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                }
                                else
                                {
                                    $total_current_daily_avg = 0;
                                }   
                
                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                </tr>';
               
                                $today_total_qty_for_process += $today_total_qty;
                                $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                $total_current_daily_avg_for_process += $total_current_daily_avg;

                                if($today_total_qty == 0)
                                {
                                    $today_total_qty = '';
                                }
                                if($total_till_yesterday_qty == 0)
                                {
                                    $total_till_yesterday_qty = '';
                                }
                                if($total_current_daily_avg == 0)
                                {
                                    $total_current_daily_avg = '';
                                }

                                if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                {

                                }
                                else
                                {
                                    $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                    
                                    $today_qty_for_array[] .= $today_total_qty;

                                    $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                    $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                }
                            }

                            $table .= '<tr style="border: 2px solid black;">
                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                            </tr>';
      
                                //////////////////////// End For Raising Process ////////////////////////////////////////////////////////////

                                //////////////////////// Start For Washing Process ////////////////////////////////////////////////////////////
           
           
                            $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                <th colspan="5" style="text-align: center;">Washing</th>
                            </tr>';
        
                            
                            $total_till_yesterday_qty = 0;
                            $daily_avg_count = 0;
                            $total_current_daily_avg = 0;
                            $counter_today = 0;
                            $today_total_qty_for_process = 0;
                            $total_till_yesterday_qty_for_process = 0;
                            $total_current_daily_avg_for_process = 0;

                            $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                WHERE process_id = 'proc_13'";
                            
                            $res_for_machine = mysqli_query($con, $sql_for_machine);
                            while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                            {
                                $today_qty = 0;
                                $today_total_qty = 0;

                                $machine_name = $row_for_machine['machine_name'];

                                //    $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                    from partial_test_for_test_result_info where process_id = 'proc_13' AND 
                                                    machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                    partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                    from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                $res_for_process = mysqli_query($con, $sql_for_process);

                                $row_for_process = mysqli_fetch_array($res_for_process);

                                $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                    from partial_test_for_test_result_info 
                                                    where  process_id = 'proc_13' AND 
                                                    machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                if($row_for_today_qty['today_qty']!= null)
                                {
                                    $today_qty = $row_for_today_qty['today_qty'];
                                    $counter_today +=1;
                                }
                                else
                                {
                                    $today_qty=0;
                                    $counter_today =0;
                                }

                                if($row_for_process['count']!=null)
                                {
                                    $daily_avg_count = $row_for_process['count'];
                                }
                                else
                                {
                                    $daily_avg_count = $counter_today;
                                }

                                $today_total_qty += $today_qty;

                                if($row_for_process['total_qty'] !=null)
                                {
                                    $total_till_yesterday_qty = $row_for_process['total_qty'];
                                }
                                else
                                {
                                    $total_till_yesterday_qty = 0;
                                }

                                if($total_till_yesterday_qty > 0)
                                {
                                    $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                }
                                else
                                {
                                    $total_current_daily_avg = 0;
                                }

                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name .'</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                </tr>';

                                $today_total_qty_for_process += $today_total_qty;
                                $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                $total_current_daily_avg_for_process += $total_current_daily_avg;

                                if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                        
                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }
                                }

                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';

                                    //////////////////////// End For Washing Process ////////////////////////////////////////////////////////////
                                
                                    //////////////////////// Start For Curing Process ////////////////////////////////////////////////////////////
             
                                    
                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Curing</th>
                                </tr>';
            
                               
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_9'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    //  $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                        from partial_test_for_test_result_info where process_id = 'proc_9' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                    $res_for_process = mysqli_query($con, $sql_for_process);

                                    $row_for_process = mysqli_fetch_array($res_for_process);

                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                        from partial_test_for_test_result_info 
                                                        where  process_id = 'proc_9' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                    $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                    $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                    if($row_for_today_qty['today_qty']!= null)
                                    {
                                        $today_qty = $row_for_today_qty['today_qty'];
                                        $counter_today +=1;
                                    }
                                    else
                                    {
                                        $today_qty=0;
                                        $counter_today =0;
                                    }

                                    if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count = $counter_today;
                                    }

                                    $today_total_qty += $today_qty;

                                    if($row_for_process['total_qty'] !=null)
                                    {
                                        $total_till_yesterday_qty = $row_for_process['total_qty'];
                                    }
                                    else
                                    {
                                        $total_till_yesterday_qty = 0;
                                    }

                                    
                                    if($total_till_yesterday_qty > 0)
                                    {
                                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                    }
                                    else
                                    {
                                        $total_current_daily_avg = 0;
                                    }
                       
                                    $table .= '<tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                    </tr>';

                                    $today_total_qty_for_process += $today_total_qty;
                                    $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                    $total_current_daily_avg_for_process += $total_current_daily_avg;

                                    if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                        
                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }

                                }

                                $table .='<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';
               
                                    //////////////////////// End For Curing Process ////////////////////////////////////////////////////////////
  
  
                                $table .='</tbody>
                                </table>
                                </div>';

                                $table .= '<div class="col-sm-6" style="padding-left: 6px;">
                                    <table class="table table-bordered" cellspacing="0">
                                        <thead>
                                            <tr style="background-color: #C0C0C0; border: 2px solid black;">
                                                <th colspan="2" style="border: 1px solid">Process wise Machines</th>
                                                <th style="border: 1px solid">Today</th>
                                                <th style="border: 1px solid">To Date</th>
                                                <th style="border: 1px solid">Avg / Day</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                            
                                    //////////////////////// Start For Calender Process ////////////////////////////////////////////////////////////


                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Calender</th>
                                </tr>';
                              
                               
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_17'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                        from partial_test_for_test_result_info where process_id = 'proc_17' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                    $res_for_process = mysqli_query($con, $sql_for_process);

                                    $row_for_process = mysqli_fetch_array($res_for_process);

                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                        from partial_test_for_test_result_info 
                                                        where  process_id = 'proc_17' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                    $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                    $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                    if($row_for_today_qty['today_qty']!= null)
                                    {
                                        $today_qty = $row_for_today_qty['today_qty'];
                                        $counter_today +=1;
                                    }
                                    else
                                    {
                                        $today_qty=0;
                                        $counter_today =0;
                                    }

                                    if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count = $counter_today;
                                    }

                                    $today_total_qty += $today_qty;

                                    if($row_for_process['total_qty'] !=null)
                                    {
                                        $total_till_yesterday_qty = $row_for_process['total_qty'];
                                    }
                                    else
                                    {
                                        $total_till_yesterday_qty = 0;
                                    }

                                    if($total_till_yesterday_qty > 0)
                                    {
                                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                    }
                                    else
                                    {
                                        $total_current_daily_avg = 0;
                                    }

        
                                    $table .= '<tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                    </tr>';

                                    $today_total_qty_for_process += $today_total_qty;
                                    $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                    $total_current_daily_avg_for_process += $total_current_daily_avg;

                                    if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }
                                }


                                
                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';

                                //////////////////////// End For Calender Process ////////////////////////////////////////////////////////////

                                //////////////////////// Start For Sanforizing Process ////////////////////////////////////////////////////////////

                                $table .= '<tr style="background-color: #EBECF0; border: 2px solid black;">
                                    <th colspan="5" style="text-align: center;">Sanforizing</th>
                                </tr>';

                                
                                $total_till_yesterday_qty = 0;
                                $daily_avg_count = 0;
                                $total_current_daily_avg = 0;
                                $counter_today = 0;
                                $today_total_qty_for_process = 0;
                                $total_till_yesterday_qty_for_process = 0;
                                $total_current_daily_avg_for_process = 0;

                                $sql_for_machine = "SELECT DISTINCT machine_name from machine_name 
                                                    WHERE process_id = 'proc_18'";
                                
                                $res_for_machine = mysqli_query($con, $sql_for_machine);
                                while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                {
                                    $today_qty = 0;
                                    $today_total_qty = 0;

                                    $machine_name = $row_for_machine['machine_name'];

                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                        from partial_test_for_test_result_info where process_id = 'proc_18' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' AND 
                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') ".$sub_query." ";

                                    $res_for_process = mysqli_query($con, $sql_for_process);

                                    $row_for_process = mysqli_fetch_array($res_for_process);

                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                        from partial_test_for_test_result_info 
                                                        where  process_id = 'proc_18' AND 
                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = '$to_date'";

                                    $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);

                                    $row_for_today_qty = mysqli_fetch_array($res_for_today_qty);

                                    if($row_for_today_qty['today_qty']!= null)
                                    {
                                        $today_qty = $row_for_today_qty['today_qty'];
                                        $counter_today +=1;
                                    }
                                    else
                                    {
                                        $today_qty=0;
                                        $counter_today =0;
                                    }

                                    if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count = $counter_today;
                                    }

                                    $today_total_qty += $today_qty;

                                    if($row_for_process['total_qty'] !=null)
                                    {
                                        $total_till_yesterday_qty = $row_for_process['total_qty'];
                                    }
                                    else
                                    {
                                        $total_till_yesterday_qty = 0;
                                    }

        
                                    if($total_till_yesterday_qty > 0)
                                    {
                                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;
                                    }
                                    else
                                    {
                                        $total_current_daily_avg = 0;
                                    }

                                    $table .= '<tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >'.$machine_name.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$today_total_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty.'</td>
                                        <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg, 0).'</td>
                                    </tr>';
        
                                    $today_total_qty_for_process += $today_total_qty;
                                    $total_till_yesterday_qty_for_process += $total_till_yesterday_qty;
                                    $total_current_daily_avg_for_process += $total_current_daily_avg;


                                    if($today_total_qty == 0)
                                    {
                                        $today_total_qty = '';
                                    }
                                    if($total_till_yesterday_qty == 0)
                                    {
                                        $total_till_yesterday_qty = '';
                                    }
                                    if($total_current_daily_avg == 0)
                                    {
                                        $total_current_daily_avg = '';
                                    }

                                    if($today_total_qty == '' && $total_till_yesterday_qty == '' && $total_current_daily_avg == '')
                                    {

                                    }
                                    else
                                    {
                                        $machine_name_for_array[] .= $row_for_machine['machine_name'];
                                        $today_qty_for_array[] .= $today_total_qty;

                                        $todate_total_qty_for_array[] .= $total_till_yesterday_qty;

                                        $avg_per_day_qty_for_array[] .= number_format($total_current_daily_avg, 0, '.', '');
                                    }
                                }

                                $table .= '<tr style="border: 2px solid black;">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" >Total Process Qty.</td>
                                    <td style="border: 1px solid; text-align:center">'.$today_total_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.$total_till_yesterday_qty_for_process.'</td>
                                    <td style="border: 1px solid; text-align:center">'.number_format($total_current_daily_avg_for_process, 0).'</td>
                                </tr>';

                                //////////////////////// End For Sanforizing Process ////////////////////////////////////////////////////////////

                                $table .= '</tbody>
                            </table>
                        </div>  
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <td style="text-align: center; font-size: 15px; color: red; font-weight: bold; padding: 0;">
                            ** All Quantity is in meter. **
                            </td>
                        </tr>
                    </thead>
                </table>
            <div>
                <button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export Data</a></button>
            </div>';


        $response = array(
            'machine_name_for_array' => $machine_name_for_array,
            'today_qty_for_array' => $today_qty_for_array,
            'todate_total_qty_for_array' => $todate_total_qty_for_array,
            'avg_per_day_qty_for_array' => $avg_per_day_qty_for_array,

        );
        //  echo json_encode($response);
    
        $response_value = json_encode($response);

        $table .= '??fs??'.$response_value;

        echo $table;

?>

