<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("Y-m-d");


$user_name=$_SESSION['user_name'];


?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" 
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" 
        crossorigin="anonymous" 
        referrerpolicy="no-referrer">
</script>

<script>

    function Remove_Value_Of_This_Element(element_name)
    {

        document.getElementById(element_name).value='';
        var alternate_field_of_date = "alternate_"+element_name;

        if(typeof(alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
        {
            document.getElementById(alternate_field_of_date).value='';
        }

    }

    function Reset_Radio_Button(radio_element)
    {

        var radio_btn = document.getElementsByName(radio_element);
        for(var i=0;i<radio_btn.length;i++)
        {
            radio_btn[i].checked = false;
        }


    }


    function get_machine_wise_summary()
    {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;


        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;
        // alert(from_date);
        // alert(to_date);
        if(to_date == today)
        {
            document.getElementById('machine_wise_summary_full_div').style.display = 'none';
            document.getElementById('machine_wise_summary_full_div_To_date').style.display = 'none';
            document.getElementById('machine_wise_summary_full_div_current_date').style.display = 'block';
            // document.getElementById('date_massege_filter_cur_Date').innerText = 'Date : '+from_date+' To '+to_date;
            var total_date = 'From '+from_date+' To '+to_date;
            // alert(total_date);

             //alert(document.getElementById('from_date').value);

            var url_encoded_form_data = $("#machine_wise_production_summary_for_folding_form").serialize(); //This will read all control elements value of the form

            //  alert(url_encoded_form_data);

            $.ajax({
                url: 'machine_wise_production_summary/machine_and_process_wise_production_summary_for_current_date_data_table.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    // alert(data);
                    var splitted_data = data.split("??fs??");
                    var form_data = splitted_data[0];
                    var response_data = splitted_data[1];
                    document.getElementById('machine_wise_summary_full_div_current_date').innerHTML=form_data;
                    // alert(response_data);
                    // scripting_table();


                    // alert(response_data);

                    obj = JSON.parse(response_data);
                    machine_name_for_array = obj.machine_name_for_array;
                    value_for_today  = obj.today_qty_for_array;
                    value_for_todate_total  = obj.todate_total_qty_for_array;
                    value_for_current_avg_day  = obj.avg_per_day_qty_for_array;

                    // alert(machine_name_for_array);

                    var keyCount_for_machine  = Object.keys(machine_name_for_array).length;
                    // alert(keyCount_for_machine);

                    if(keyCount_for_machine <= 14)
                    {
                        machine_name_items = machine_name_for_array;
                        value_for_today_items = value_for_today;
                        value_for_todate_total_items = value_for_todate_total;
                        value_for_current_avg_day_items = value_for_current_avg_day;

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_1').getContext('2d');

                        chart_maker(ctx, machine_name_items, value_for_today_items, value_for_todate_total_items, value_for_current_avg_day_items, total_date);

                    }

                    if(keyCount_for_machine >= 14)
                    {
                        var size = 14;
                        machine_name_items = machine_name_for_array.slice(0, size);
                        value_for_today_items = value_for_today.slice(0, size);
                        value_for_todate_total_items = value_for_todate_total.slice(0, size);
                        value_for_current_avg_day_items = value_for_current_avg_day.slice(0, size);

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_1').getContext('2d');

                        chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items, total_date);

                    }
                    if(keyCount_for_machine >= 14 && keyCount_for_machine < 28)
                    {
                        var size = 28;
                        machine_name_items = machine_name_for_array.slice(14, size);
                        value_for_today_items = value_for_today.slice(14, size);
                        value_for_todate_total_items = value_for_todate_total.slice(14, size);
                        value_for_current_avg_day_items = value_for_current_avg_day.slice(14, size);

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_2').getContext('2d');

                        chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items, total_date);
                    }


                },
                error: function( jqXhr, textStatus, errorThrown )
                {
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            }); // End of $.ajax({
        }
        else
        {
            // date_wise_productivity_chart(response_data);

            document.getElementById('machine_wise_summary_full_div').style.display = 'none';
            document.getElementById('machine_wise_summary_full_div_current_date').style.display = 'none';
            document.getElementById('machine_wise_summary_full_div_To_date').style.display = 'block';
            // document.getElementById('date_massege_filter_to_date').innerText = 'Date : '+from_date+' To '+to_date;
            var total_date = 'From '+from_date+' To '+to_date;
            // alert(total_date);

            var url_encoded_form_data = $("#machine_wise_production_summary_for_folding_form").serialize(); //This will read all control elements value of the form

            //  alert(url_encoded_form_data);

            $.ajax({
                url: 'machine_wise_production_summary/machine_and_process_wise_production_summary_for_to_date_data_table.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                {
                    // alert(data);
                    var splitted_data = data.split("??fs??");
                    var form_data = splitted_data[0];
                    var response_data = splitted_data[1];
                    document.getElementById('machine_wise_summary_full_div_To_date').innerHTML=form_data;
                    // alert(response_data);
                    // scripting_table();


                    // alert(response_data);

                    obj = JSON.parse(response_data);
                    machine_name_for_array = obj.machine_name_for_array;
                    value_for_today  = obj.today_qty_for_array;
                    value_for_todate_total  = obj.todate_total_qty_for_array;
                    value_for_current_avg_day  = obj.avg_per_day_qty_for_array;

                    // alert(machine_name_for_array);

                    var keyCount_for_machine  = Object.keys(machine_name_for_array).length;
                    // alert(keyCount_for_machine);

                    if(keyCount_for_machine <= 14)
                    {
                        machine_name_items = machine_name_for_array;
                        value_for_today_items = value_for_today;
                        value_for_todate_total_items = value_for_todate_total;
                        value_for_current_avg_day_items = value_for_current_avg_day;

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_1').getContext('2d');

                        chart_maker(ctx, machine_name_items, value_for_today_items, value_for_todate_total_items, value_for_current_avg_day_items, total_date);

                    }

                    if(keyCount_for_machine >= 14)
                    {
                        var size = 14;
                        machine_name_items = machine_name_for_array.slice(0, size);
                        value_for_today_items = value_for_today.slice(0, size);
                        value_for_todate_total_items = value_for_todate_total.slice(0, size);
                        value_for_current_avg_day_items = value_for_current_avg_day.slice(0, size);

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_1').getContext('2d');

                        chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items, total_date);

                    }
                    if(keyCount_for_machine >= 14 && keyCount_for_machine < 28)
                    {
                        var size = 28;
                        machine_name_items = machine_name_for_array.slice(14, size);
                        value_for_today_items = value_for_today.slice(14, size);
                        value_for_todate_total_items = value_for_todate_total.slice(14, size);
                        value_for_current_avg_day_items = value_for_current_avg_day.slice(14, size);

                        // alert(value_for_current_avg_day_items);
                        var ctx = document.getElementById('myChart_2').getContext('2d');

                        chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items, total_date);
                    }


                },
                error: function( jqXhr, textStatus, errorThrown )
                {
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            }); // End of $.ajax({
        }

    }

    function active_for_to_date()
    {
        document.getElementById('to_date_for_production').style.display = 'block';
        document.getElementById("to_date").readOnly = false;
        document.getElementById("to_date").value = '';
        document.getElementById("to_date").placeholder = "Please Provide To Date";


    }
    function active_for_current_date()
    {
        document.getElementById('to_date_for_production').style.display = 'block';
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;
        
        document.getElementById('to_date').value = today;
        document.getElementById("to_date").readOnly = true;
       
        // alert('Current Date : '+today);
    }

</script>



<div class="col-sm-12 col-md-12 col-lg-12" id="myscroll" style="height: 750px;">
    <table class="table table-bordered show_table" id="" style="display:none;position: fixed;border: 2px solid black;width: 1131px;" cellspacing="0">
        <thead>
        <tr style="background-color: #C0C0C0; border: 2px solid black;">
            <th colspan="2" style="border: 1px solid;width: 103px;">Process wise Machines</th>

            <!--            <th style="">Process wise Machines</th>-->
            <th style="border: 1px solid;width: 115px;">Today (Yesterday)</th>
            <th style="/*! border: wheat; */border: 1px solid;width: 151px;">To Date (Day 1 to yesterday)</th>
            <th style="border: 1px solid;width: 99.5px;">Target (30 days)</th>
            <th style="border: 1px solid;width: 98.3px;">Remaining (-)</th>
            <th style="border: 1px solid;width: 120.07px;">Current Daily Average</th>
            <th style="border: 1px solid;width: 133px;">Required Daily Average</th>
            <th style="border: 1px solid;width: 160px;">Re-process Today (Yesterday)</th>
            <th style="border: 1px solid;width: 111.7px;">Re-process To date</th>

        </tr>
        </thead>
    </table>

    <table class="table table-bordered show_table_big" id="" style="display:none;position: fixed;border: 2px solid black;width: 1382px;" cellspacing="0">
        <thead>
        <tr style="background-color: #C0C0C0; border: 2px solid black;">
            <th colspan="2" style="border: 1px solid;width: 100px;">Process wise Machines</th>

            <!--            <th style="">Process wise Machines</th>-->
            <th style="border: 1px solid;width: 132px;">Today (Yesterday)</th>
            <th style="/*! border: wheat; */border: 1px solid;width: 193px;">To Date (Day 1 to yesterday)</th>
            <th style="border: 1px solid;width: 118px;">Target (30 days)</th>
            <th style="border: 1px solid;width: 105px;">Remaining (-)</th>
            <th style="border: 1px solid;width: 155px;">Current Daily Average</th>
            <th style="border: 1px solid;width: 165px;">Required Daily Average</th>
            <th style="border: 1px solid;width: 205px;">Re-process Today (Yesterday)</th>
            <th style="border: 1px solid;width: 139px;">Re-process To date</th>

        </tr>
        </thead>
    </table>

    <div class="panel panel-default" id="div_table">
        <div id="element">
            <div class="form-group form-group-sm" id="datewise_filter_machines">
                <form class="form-horizontal" action="" method="POST" name="machine_wise_production_summary_for_folding_form" id="machine_wise_production_summary_for_folding_form">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Machine & Process Wise Production Summary
                            </td>

                        </tr>
                        </thead>
                    </table>

                    <div class="form-group form-group-sm" id="form-group_for_feom_date" style="margin-right:0px; color:#00008B;">
                        <div class="form-group form-group-sm" id="from_date_for_production" style="margin-right:0px; color:#00008B;">
                            <label class="control-label col-sm-4" for="date"> From Date : </label>
                            <div class="col-sm-4" style="padding-right: 0">
                                <input type="text" class="form-control" id="from_date" name="from_date" placeholder="Please Provide From Date">
                            </div>
                            <div class="col-sm-1" style="padding-left: 0">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>

                        <div class="form-group form-group-sm" id="" style="margin-right:0px; color:#00008B;">
                            <label class="control-label col-sm-4" for="date"> To Date : </label>
                            <div class="col-sm-2" style="padding-right: 0px; padding-left:15px; text-align:left">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="radio" id="current_date" name="to_date_active" onchange="active_for_current_date()">
                                        <label for="date"> Till Now </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="radio" id="to_date_active" name="to_date_active" onchange="active_for_to_date()">
                                        <label for="date"> To Date </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div id="to_date_for_production" style=" color:#00008B; display:none">
                                    <div class="col-sm-2" style="padding-right: 0">
                                        <input type="text" class="form-control" id="to_date" name="to_date" placeholder="Please Provide To Date">
                                    </div>
                                    <div class="col-sm-1" style="padding-left: 0">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            
                            
                        </div>
                        

                        <!-- <div class="form-group form-group-sm" id="" style="margin-right:0px; color:#00008B;">
                            <label class="control-label col-sm-4" for="date"> Current Date : </label>
                            <div class="col-sm-1" style="padding-right: 0">
                                <input type="radio" class="form-control" id="current_date" name="to_date_active" style="width: 20px;height:20px" onchange="active_for_current_date()">
                            </div>
                            <div id="current_date_for_production" style=" color:#00008B">
                                <div class="col-sm-3" style="padding-right: 0">
                                    <input type="text" class="form-control" id="current_date_value" name="current_date_value" placeholder="Please Provide current Date" readonly>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="form-group form-group-sm" id="ssd" style="margin-right:0px; color:#00008B">
                            <label class="control-label col-sm-4" for="date"> To Date : </label>
                            <div class="col-sm-1" style="padding-right: 0">
                                <input type="radio" class="form-control" style="width: 20px;height:20px" id="to_date_active" name="to_date_active" onchange="active_for_to_date()">
                            </div>
                            
                            <div id="to_date_for_production" style=" color:#00008B;display:none">
                                <div class="col-sm-2" style="padding-right: 0">
                                    <input type="text" class="form-control" id="to_date" name="to_date" placeholder="Please Provide To Date">
                                </div>
                                <div class="col-sm-1" style="padding-left: 0">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                            
                        </div> -->
                     
                       
                    </div>

                    <script>
                        $( function() {
                            //$( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
                            $( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });

                        } );

                        $( function() {
                            $( "#to_date" ).datepicker({ dateFormat: 'dd-mm-yy' });


                        } );


                      
                    </script>
                     <div class="col-sm-12" style="float: center; padding-top: 8px;">
                        <button name="submit" type="button" class="btn btn-info" onclick="get_machine_wise_summary()">Filter</button>
                    </div>
                </form>
            </div>
            <div id="machine_wise_summary_full_div">
                <form class="form-horizontal" action="" name="machine_and_process_wise_production_summary_form" id="machine_and_process_wise_production_summary_form">
                    <div class="row">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; ">
                                        Machine & Process Wise Production Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;padding-left:15px; font-size: 16px; color: black;border-top: none;" id="date_massege_filter_to_date">

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
                                
                                <tbody>

                                    <?php



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
                                                            WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                            partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                            from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                                            and process_name = 'Greige Receiving' ";

                                        $res_for_process = mysqli_query($con, $sql_for_process);

                                        while ($row_for_process = mysqli_fetch_array($res_for_process))
                                        {
                                            $process_name = $row_for_process['process_name'];

                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                from partial_test_for_test_result_info 
                                                                where  process_name = '$process_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";

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
                                    ?>
                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                        <th colspan="5" style="text-align: center;"><?php echo 'Greige Receiving' ?></th>
                                    </tr>
                                    <tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Greige Issue' ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                    </tr>
                                    <?php 
                                        /////////////////////////// End For greige receiving Process ////////////////////////////////////////////////
                                
                                        //////////////////////// Start For Singeing & Desizing Process ////////////////////////////////////////////////////////////
                                    ?>
                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                        <th colspan="5" style="text-align: center;"><?php echo 'Singeing & Desizing' ?></th>
                                    </tr>
                                    <?php
                                        $today_qty = 0;
                                        $today_total_qty = 0;
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
                                            $machine_name = $row_for_machine['machine_name'];

                                            // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                from partial_test_for_test_result_info where (process_id = 'proc_1' OR process_id = 'proc_21' OR process_id = 'proc_22') AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20')";

                                            $res_for_process = mysqli_query($con, $sql_for_process);

                                            $row_for_process = mysqli_fetch_array($res_for_process);

                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                from partial_test_for_test_result_info 
                                                                where  (process_id = 'proc_1' OR process_id = 'proc_21' OR process_id = 'proc_22') AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";

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


                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                            </tr>
                                            <?php
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
                                    
                                    ?>
                                    <tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                    </tr>
                                    <?php 
                                            //////////////////////// End For Singeing & Desizing Process ////////////////////////////////////////////////////////////
                                
                                            //////////////////////// Start For Scouring & Bleaching Process ////////////////////////////////////////////////////////////
                                    ?>
                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                        <th colspan="5" style="text-align: center;"><?php echo 'Scouring & Bleaching' ?></th>
                                    </tr>
                                    <?php
                                        $today_qty = 0;
                                        $today_total_qty = 0;
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
                                            $machine_name = $row_for_machine['machine_name'];

                                            // $machine_name_for_array[] .= $row_for_machine['machine_name'];

                                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                from partial_test_for_test_result_info where (process_id = 'proc_2' OR process_id = 'proc_3' OR process_id = 'proc_4') AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20')";

                                            $res_for_process = mysqli_query($con, $sql_for_process);

                                            $row_for_process = mysqli_fetch_array($res_for_process);

                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                from partial_test_for_test_result_info 
                                                                where  (process_id = 'proc_2' OR process_id = 'proc_3' OR process_id = 'proc_4') AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";

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

                                        

                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                            </tr>
                                            <?php
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
                                    
                                        
                                    ?>
                                    <tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                    </tr>
                                    <?php 
                                            //////////////////////// End For Scouring & Bleaching Process ////////////////////////////////////////////////////////////
                                    
                                            //////////////////////// Start For Equalize Process ////////////////////////////////////////////////////////////
                                            ?>
                                            <tr style="background-color: #EBECF0; border: 2px solid black;">
                                                <th colspan="5" style="text-align: center;"><?php echo 'Equalize' ?></th>
                                            </tr>
                                            <?php
                                                $today_qty = 0;
                                                $today_total_qty = 0;
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
                                                    $machine_name = $row_for_machine['machine_name'];
        
                                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                        from partial_test_for_test_result_info where (process_id = 'proc_5' OR process_id = 'proc_7' OR process_id = 'proc_11' OR process_id = 'proc_14') AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
        
                                                    $res_for_process = mysqli_query($con, $sql_for_process);
        
                                                    $row_for_process = mysqli_fetch_array($res_for_process);
        
                                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                        from partial_test_for_test_result_info 
                                                                        where  (process_id = 'proc_5' OR process_id = 'proc_7' OR process_id = 'proc_11' OR process_id = 'proc_14') AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
        
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
                                                    
                                                

                                                    ?>
                                                    <tr style="border: 2px solid black;">
                                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                                    </tr>
                                                    <?php
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
                                            
                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                            </tr>
                                            <?php 
                                                    //////////////////////// End For Equalize Process ////////////////////////////////////////////////////////////
                                        
                                            //////////////////////// Start For Prining Process ////////////////////////////////////////////////////////////
                                            ?>
                                            <tr style="background-color: #EBECF0; border: 2px solid black;">
                                                <th colspan="5" style="text-align: center;"><?php echo 'Printing' ?></th>
                                            </tr>
                                            <?php
                                                $today_qty = 0;
                                                $today_total_qty = 0;
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
                                                    $machine_name = $row_for_machine['machine_name'];
        
                                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                        from partial_test_for_test_result_info where process_id = 'proc_8' AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
        
                                                    $res_for_process = mysqli_query($con, $sql_for_process);
        
                                                    $row_for_process = mysqli_fetch_array($res_for_process);
        
                                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                        from partial_test_for_test_result_info 
                                                                        where  process_id = 'proc_8' AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
        
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
                                                    
                                            

                                                    ?>
                                                    <tr style="border: 2px solid black;">
                                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                                    </tr>
                                                    <?php
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

                                        

                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                            </tr>
                                            <?php 
                                                    //////////////////////// End For Printing Process ////////////////////////////////////////////////////////////
                                            
                                                    //////////////////////// Start For Raising Process ////////////////////////////////////////////////////////////
                                            ?>
                                            <tr style="background-color: #EBECF0; border: 2px solid black;">
                                                <th colspan="5" style="text-align: center;"><?php echo 'Raising' ?></th>
                                            </tr>
                                            <?php
                                                $today_qty = 0;
                                                $today_total_qty = 0;
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
                                                    $machine_name = $row_for_machine['machine_name'];
        
                                                    // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                                    $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                        from partial_test_for_test_result_info where process_id = 'proc_15' AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
        
                                                    $res_for_process = mysqli_query($con, $sql_for_process);
        
                                                    $row_for_process = mysqli_fetch_array($res_for_process);
        
                                                    $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                        from partial_test_for_test_result_info 
                                                                        where  process_id = 'proc_15' AND 
                                                                        machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
        
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
                                                    
                                            

                                                    ?>
                                                    <tr style="border: 2px solid black;">
                                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                                    </tr>
                                                    <?php
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

                                    

                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                            </tr>
                                            <?php 
                                                    //////////////////////// End For Raising Process ////////////////////////////////////////////////////////////

                                                //////////////////////// Start For Washing Process ////////////////////////////////////////////////////////////
                                                ?>
                                                <tr style="background-color: #EBECF0; border: 2px solid black;">
                                                    <th colspan="5" style="text-align: center;"><?php echo 'Washing' ?></th>
                                                </tr>
                                                <?php
                                                    $today_qty = 0;
                                                    $today_total_qty = 0;
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
                                                        $machine_name = $row_for_machine['machine_name'];
            
                                                        //    $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                                        $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                            from partial_test_for_test_result_info where process_id = 'proc_13' AND 
                                                                            machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                            partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                            from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
            
                                                        $res_for_process = mysqli_query($con, $sql_for_process);
            
                                                        $row_for_process = mysqli_fetch_array($res_for_process);
            
                                                        $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                            from partial_test_for_test_result_info 
                                                                            where  process_id = 'proc_13' AND 
                                                                            machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
            
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

                                                        
                                                        
                                                        ?>
                                                        <tr style="border: 2px solid black;">
                                                            <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                            <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                            <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                            <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                                        </tr>
                                                        <?php
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

                                                    
                                                ?>
                                                <tr style="border: 2px solid black;">
                                                    <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                                    <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                                    <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                                    <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                                </tr>
                                                <?php 
                                                        //////////////////////// End For Washing Process ////////////////////////////////////////////////////////////
                                                    
                                                        //////////////////////// Start For Curing Process ////////////////////////////////////////////////////////////
                                                    ?>
                                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                                        <th colspan="5" style="text-align: center;"><?php echo 'Curing' ?></th>
                                                    </tr>
                                                    <?php
                                                        $today_qty = 0;
                                                        $today_total_qty = 0;
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
                                                            $machine_name = $row_for_machine['machine_name'];
                
                                                            //  $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                                from partial_test_for_test_result_info where process_id = 'proc_9' AND 
                                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
                
                                                            $res_for_process = mysqli_query($con, $sql_for_process);
                
                                                            $row_for_process = mysqli_fetch_array($res_for_process);
                
                                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                                from partial_test_for_test_result_info 
                                                                                where  process_id = 'proc_9' AND 
                                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                
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
                                                            
                                                            
                                                            ?>
                                                            <tr style="border: 2px solid black;">
                                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                                            </tr>
                                                            <?php
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

                                                        

                                                    ?>
                                                    <tr style="border: 2px solid black;">
                                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                                    </tr>
                                                    <?php 
                                                            //////////////////////// End For Curing Process ////////////////////////////////////////////////////////////
                                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6" style="padding-left: 6px;">
                            <table class="table table-bordered" cellspacing="0">
                                <thead>
                                    <tr style="background-color: #C0C0C0; border: 2px solid black;">
                                        <th colspan="2" style="border: 1px solid">Process wise Machines</th>
                                        <th style="border: 1px solid">Today</th>
                                        <th style="border: 1px solid">To Date</th>
                                        <th style="border: 1px solid">Avg / Day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        //////////////////////// Start For Calender Process ////////////////////////////////////////////////////////////
                                    ?>
                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                        <th colspan="5" style="text-align: center;"><?php echo 'Calender' ?></th>
                                    </tr>
                                    <?php
                                        $today_qty = 0;
                                        $today_total_qty = 0;
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
                                            $machine_name = $row_for_machine['machine_name'];
                
                                            // $machine_name_for_array[] .= $row_for_machine['machine_name'];


                                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                from partial_test_for_test_result_info where process_id = 'proc_17' AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20')";

                                            $res_for_process = mysqli_query($con, $sql_for_process);

                                            $row_for_process = mysqli_fetch_array($res_for_process);

                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                from partial_test_for_test_result_info 
                                                                where  process_id = 'proc_17' AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";

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

                                            
                                                            
                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                            </tr>
                                            <?php
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


                                    ?>
                                    <tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                    </tr>
                                    <?php 
                                            //////////////////////// End For Calender Process ////////////////////////////////////////////////////////////
                                    
                                            //////////////////////// Start For Sanforizing Process ////////////////////////////////////////////////////////////
                                    ?>
                                    <tr style="background-color: #EBECF0; border: 2px solid black;">
                                        <th colspan="5" style="text-align: center;"><?php echo 'Sanforizing' ?></th>
                                    </tr>
                                    <?php
                                        $today_qty = 0;
                                        $today_total_qty = 0;
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
                                            $machine_name = $row_for_machine['machine_name'];

                                            $sql_for_process = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                                from partial_test_for_test_result_info where process_id = 'proc_18' AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20')";

                                            $res_for_process = mysqli_query($con, $sql_for_process);

                                            $row_for_process = mysqli_fetch_array($res_for_process);

                                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                                from partial_test_for_test_result_info 
                                                                where  process_id = 'proc_18' AND 
                                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";

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

                                            
                                            
                                                            
                                            ?>
                                            <tr style="border: 2px solid black;">
                                                <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo $machine_name ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty ?></td>
                                                <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg, 0) ?></td>
                                            </tr>
                                            <?php
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

                                        

                                    ?>
                                    <tr style="border: 2px solid black;">
                                        <td colspan="2" style="font-weight: bold; border: 1px solid; text-align:center" ><?php echo 'Total Process Qty.' ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $today_total_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo $total_till_yesterday_qty_for_process ?></td>
                                        <td style="border: 1px solid; text-align:center"><?php echo number_format($total_current_daily_avg_for_process, 0) ?></td>
                                    </tr>
                                    <?php 
                                            //////////////////////// End For Sanforizing Process ////////////////////////////////////////////////////////////
                                    ?>


                                </tbody>
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
                    <!-- <button type="button" class="btn btn-primary" onclick="date_wise_productivity_chart()">Machine wise productivity chart</button> -->
                </div>
            </div>
            <div id="machine_wise_summary_full_div_current_date" style="display: none;">
                  
            </div> 
            <div id="machine_wise_summary_full_div_To_date" style="display: none;">
                
            </div> 
            

                    <?php
                            $response = array(
                                'machine_name_for_array' => $machine_name_for_array,
                                'today_qty_for_array' => $today_qty_for_array,
                                'todate_total_qty_for_array' => $todate_total_qty_for_array,
                                'avg_per_day_qty_for_array' => $avg_per_day_qty_for_array,

                            );
                            //  echo json_encode($response);
                        
                            $response_value = json_encode($response);
                    ?>
           
                
            </div> 
            <div>
                
                <canvas id="myChart_1" aria-label="chart" role="img" width="100" height="40"></canvas>

            </div> 
            <div>
                
                <canvas id="myChart_2" aria-label="chart" role="img" width="100" height="40"></canvas>

            </div> 
            <div>
                
                <canvas id="myChart_3" aria-label="chart" role="img" width="100" height="40"></canvas>

            </div> 
            <div>
                
                <canvas id="myChart_4" aria-label="chart" role="img" width="100" height="40"></canvas>

            </div> 

        </div>
        

    </div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->



<script>

// function date_wise_productivity_chart()
// {
//     var response_data = '<?php echo  $response_value ?>';
//     // alert(response_data);

//     obj = JSON.parse(response_data);
//     machine_name_for_array = obj.machine_name_for_array;
//     value_for_today  = obj.today_qty_for_array;
//     value_for_todate_total  = obj.todate_total_qty_for_array;
//     value_for_current_avg_day  = obj.avg_per_day_qty_for_array;

//     // alert(machine_name_for_array);

//     var keyCount_for_machine  = Object.keys(machine_name_for_array).length;
//     // alert(keyCount_for_machine);

//     if(keyCount_for_machine <= 14)
//     {
//         machine_name_items = machine_name_for_array;
//         value_for_today_items = value_for_today;
//         value_for_todate_total_items = value_for_todate_total;
//         value_for_current_avg_day_items = value_for_current_avg_day;

//         // alert(value_for_current_avg_day_items);
//         var ctx = document.getElementById('myChart_1').getContext('2d');

//         chart_maker(ctx, machine_name_items, value_for_today_items, value_for_todate_total_items, value_for_current_avg_day_items);

//     }

//     if(keyCount_for_machine >= 14)
//     {
//         var size = 14;
//         machine_name_items = machine_name_for_array.slice(0, size);
//         value_for_today_items = value_for_today.slice(0, size);
//         value_for_todate_total_items = value_for_todate_total.slice(0, size);
//         value_for_current_avg_day_items = value_for_current_avg_day.slice(0, size);

//         // alert(value_for_current_avg_day_items);
//         var ctx = document.getElementById('myChart_1').getContext('2d');

//         chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items);

//     }
//     if(keyCount_for_machine >= 14 && keyCount_for_machine < 28)
//     {
//         var size = 28;
//         machine_name_items = machine_name_for_array.slice(14, size);
//         value_for_today_items = value_for_today.slice(14, size);
//         value_for_todate_total_items = value_for_todate_total.slice(14, size);
//         value_for_current_avg_day_items = value_for_current_avg_day.slice(14, size);

//         // alert(value_for_current_avg_day_items);
//         var ctx = document.getElementById('myChart_2').getContext('2d');

//         chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items);

//     }

//     if(keyCount_for_machine >= 28 && keyCount_for_machine < 42)
//     {
//         var size = 42;
//         machine_name_items = machine_name_for_array.slice(29, size);
//         value_for_today_items = value_for_today.slice(29, size);
//         value_for_todate_total_items = value_for_todate_total.slice(29, size);
//         value_for_current_avg_day_items = value_for_current_avg_day.slice(29, size);

//         // alert(value_for_current_avg_day_items);
//         var ctx = document.getElementById('myChart_3').getContext('2d');

//         chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items);

//     }

//     if(keyCount_for_machine >= 42)
//     {
//         var size = 56;
//         machine_name_items = machine_name_for_array.slice(42, size);
//         value_for_today_items = value_for_today.slice(42, size);
//         value_for_todate_total_items = value_for_todate_total.slice(42, size);
//         value_for_current_avg_day_items = value_for_current_avg_day.slice(42, size);

//         // alert(value_for_current_avg_day_items);
//         var ctx = document.getElementById('myChart_4').getContext('2d');

//         chart_maker(ctx, machine_name_items,value_for_today_items,value_for_todate_total_items, value_for_current_avg_day_items);

//     }

//     // exit();


// }

function chart_maker(ctx, machine_name_for_array,value_for_today,value_for_todate_total,value_for_current_avg_day, total_date)
{

    // Setup Block
    const data = {
        
        labels: machine_name_for_array,
            datasets: [
                        {
                            data: value_for_today,
                            backgroundColor: [
                                'rgba(0,128,0)',
                            ],
                            hoverOffset: 5,
                            borderWidth: 1,               
                            label: 'Today',
                            yAxisID: 'today',

                            datalabels:  {
                                    labels: {
                                    title: {
                                        color: 'brown',
                                        anchor: 'end',
                                        align: 'top',
                                        offset: -45,

                                    }
                                },
                                // backgroundColor: 'yellow',
                                // boderColor: 'red',
                                borderWidth: 1,
                                // borderRadius: 5,
                                font: {weight: 'bold'},
                                padding: 0,
                                rotation: 270,
                                // backgroundColor: 'yellow',

                            }
                        },
                        {
                            data: value_for_todate_total,
                            backgroundColor: [
                                'rgba(56, 123, 225)',
                            ],
                            hoverOffset: 5,
                            borderWidth: 1,
                            label: 'Todate Total',
                            yAxisID: 'todateTotal',
                            datalabels:  {
                                    labels: {
                                    title: {
                                        color: 'black',
                                        anchor: 'center',
                                        align: 'center',
                                        offset: -40,

                                    }
                                },
                                // backgroundColor: 'yellow',
                                // boderColor: 'red',
                                borderWidth: 1,
                                // borderRadius: 5,
                                font: {weight: 'bold'},
                                padding: 0,
                                rotation: 270,
                                // backgroundColor: 'yellow',

                            }
                        },
                        {
                            data: value_for_current_avg_day,
                            backgroundColor: [
                                'rgba(160,82,45)',
                            ],
                            hoverOffset: 5,
                            borderWidth: 1,
                            label: 'Current Avg/Day',
                            yAxisID: 'today',
                            datalabels:  {
                            
                                    labels: {
                                    title: {
                                        color: 'white',
                                        anchor: 'end',
                                        align: 'top',
                                        offset: -45,

                                    }
                                },
                                // backgroundColor: 'yellow',
                                // borderColor: 'red',
                                borderWidth: 2,
                                borderRadius: 5,

                                font: {
                                    weight: 'bold',
                                },
                                padding: 0,
                                rotation: 270,
                            }
                        }
            ]
    };

    // logoImage Plugins Block

    const logo = new Image();
    logo.src = 'img/znz_home_logo.jpg';

    const logoImage = {
        id: 'logoImage',
        beforeDraw(chart, args, options){
            const {ctx, chartArea: {top, bottom, left, right}} = chart;
            console.log(ctx.canvas.offsetWidth);
            console.log(ctx.canvas.offsetHeight);

            const logoWidth = 100;
            const logoHeight = 90;
            ctx.save();
            if(logo.complete)
            {
                // ctx.drawImage(logo, 10, position y, width img, height img)
                ctx.drawImage(logo, 1240, 40, logoWidth, logoHeight);
            }
            else
            {
                logo.onload = () => chart.draw();
            }
            ctx.restore();
        }
    };

    // Config Block

    const config = {
        type: 'bar',
            data,
            plugins: [ChartDataLabels, logoImage],

            options: {
                responsive: true,
                layout: {
                    padding: {
                        left: 50,
                        top: 50,
                        right:50,
                        bottom:50
                    },
                },
                interaction: {
                    mode: 'index',
                },
                tooltips: {
                    enabled: true,
                },
                scales: {
                    today: {
                            title: {
                                display: true,
                                text: "Meters.",
                            },
                            scaleLabel:{
                                display: true,
                                labelString: 'today'
                            },
                            type: 'linear',
                            position: 'left',
                            // grid: {display: false},
                            ticks: {
                                beginAtZero: false,
                                // max: 200000,
                                min: 0,
                                stepSize: 1000
                            },
                        },
                        todateTotal: {
                            title: {
                                display: true,
                                text: "Meters.",
                            },
                            scaleLabel:{
                                display: true,
                                labelString: 'TodateTotal'
                            },
                            type: 'linear',
                            position: 'right',
                            grid: {display: false},
                            ticks: {
                                beginAtZero: false,
                            
                                // max: 1600000,
                                min: 0,
                                stepSize: 200000
                            }
                        },
                },
            
                plugins:{
                    subtitle: {
                        display: true,
                        // text: ['User Name: <?php //echo $user_name; ?>', 'Date: <?php //echo $date; ?>'],
                        text: ['Date : '+total_date],

                        position: "top",
                        align: 'start',
                        color: 'green',
                        padding: {
                                    top: 10,
                                    bottom: 20
                                },
                        font: {
                                size: 18
                            }
                    },
                
                    title: {
                        display: true,
                        text: 'M/C Wise Production Summary',

                        position: "top",

                        font: {
                                size: 32
                            }
                    },
                
                
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                },
            }
    };

    // Render Block
                        
    const myChart = new Chart(ctx, config);

   
}

function exportF(elem) 
		{
			var table = document.getElementById("machine_and_process_wise_production_summary_form");
			var html = table.innerHTML;
			var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
			elem.setAttribute("href", url);
			elem.setAttribute("download", "machine_wise_summary_full_div.xls"); // Choose the file name
			return false;
		}

    function pdf_print()
    {

        var divContents = document.getElementById("machine_wise_summary_full_div_current_date").innerHTML;
        var a = window.open('', '', 'height=500, width=500, border=1px');
        a.document.write('<html>');
        a.document.write('<body > ');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }

    var myscroll = document.getElementById("myscroll");


    if (screen.width<=1300)
    {

        myscroll.onscroll = function(e) {
            var y = $(this).scrollTop();
            if (y > 280) {
                $('.show_table').fadeIn();
            } else {
                $('.show_table').fadeOut();
            }
        };
    }
    else if(screen.width>=1300)
    {
        myscroll.onscroll = function(e) {
            var y = $(this).scrollTop();
            if (y > 280) {
                $('.show_table_big').fadeIn();
            } else {
                $('.show_table_big').fadeOut();
            }

        };

    }
    // calculate max scroll top position (go back to top once reached)


    // var target = document.querySelector('#target_table');
</script>
