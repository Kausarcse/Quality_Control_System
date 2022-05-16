<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("Y-m-d");


$user_name=$_SESSION['user_name'];


$all_data=$_GET['all_data'];

$split_all_data=explode("?fs?", $all_data);


$process_name=$split_all_data[1];
// echo $process_name;
?>
<script type='text/javascript' src='process_program/process_program_info_form_validation.js'></script>

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
        //alert(document.getElementById('from_date').value);

        var url_encoded_form_data = $("#machine_wise_production_summary_for_folding_form").serialize(); //This will read all control elements value of the form

// alert(url_encoded_form_data);

        $.ajax({
            url: 'machine_wise_production_summary/machine_wise_production_summary_data_table.php',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: url_encoded_form_data,
            success: function( data, textStatus, jQxhr )
            {
                /*alert(data);*/



                document.getElementById('machine_wise_summary_full_div').style.display="none";

                document.getElementById('machine_wise_summary_filtered_div').innerHTML=data;
                // scripting_table();



            },
            error: function( jqXhr, textStatus, errorThrown )
            {
                //console.log( errorThrown );
                alert(errorThrown);
            }
        }); // End of $.ajax({

    }//End of if(validate != false)

</script>



<div class="col-sm-12 col-md-12 col-lg-12" id="myscroll" style="overflow: scroll; height: 750px;">
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
            <div class="form-group form-group-sm" id="div_machine_wise_production_summary_for_folding">
                <form class="form-horizontal" action="" method="POST" name="machine_wise_production_summary_for_folding_form" id="machine_wise_production_summary_for_folding_form">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Machine Wise Monthly Produciton Summary
                            </td>

                        </tr>
                        </thead>
                    </table>

                    <div class="form-group form-group-sm" id="form-group_for_feom_date" style="margin-right:0px; color:#00008B;">
                        <label class="control-label col-sm-4" for="from_date"> Date :</label>
                        <div class="col-sm-3" style="padding-right: 0">

                            <input type="text" class="form-control" id="from_date" name="from_date" placeholder="Please Provide From Date">


                        </div>


                        <div class="col-sm-3" style="padding-right: 0">


                            <input type="text" id="to_date" class="form-control" name="to_date" placeholder="Please Provide To Date">


                        </div>

                        <div class="col-sm-1" style="padding-left: 0">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>







                    <script>
                        $( function() {
                            //$( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
                            $( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

                        } );

                        $( function() {
                            $( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });


                        } );
                    </script>




                    <label class="control-label col-sm-4" for="process" style="margin-right:0px; color:#00008B;">Process:</label>
                    <div class="col-sm-5">
                        <!-- <input type='text' id='process_name' name='process_name' value='' placeholder='' class='form-control col-md-7 col-xs-12'> -->

                        <select  class="form-control for_auto_complete" id="process_name" name="process_name" onchange="process_wise_machine_name(this.value)">
                            <option select="selected" value="select">Select process</option>
                            <?php
                            $sql = 'select * from `process_name` order by row_id ASC';
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                            while( $row = mysqli_fetch_array( $result))
                            {
                                // echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';
                                echo '<option value="'.$row['process_id'].'?fs?'.$row['process_name'].'">'.$row['process_name'].'</option>';

                            }

                            ?>
                        </select>


                    </div>
                    <script>
                        function process_wise_machine_name(process_name)
                        {
                            var value_for_data= 'process_name_value='+process_name+'?fs?';
                            //alert(process_name);
                            $.ajax({
                                url: 'machine_wise_production_summary/returning_machine_name_from_process.php',
                                dataType: 'text',
                                type: 'post',
                                contentType: 'application/x-www-form-urlencoded',
                                data: value_for_data,

                                success: function( data, textStatus, jQxhr )
                                {

                                    // alert(data);

                                    document.getElementById('machine_name').innerHTML=data;


                                },
                                error: function( jqXhr, textStatus, errorThrown )
                                {
                                    //console.log( errorThrown );
                                    alert(errorThrown);
                                }
                            }); // End of $.ajax({
                        }
                    </script>






                    <label class="control-label col-sm-4" for="machine" style="margin-right:0px; color:#00008B;">Machine:</label>
                    <div  class="col-sm-5">

                        <select  class="form-control for_auto_complete" id="machine_name" name="machine_name">
                            <option select="selected" value="select">Select Machine</option>
                            <?php
                            $sql = 'select machine_name from `machine_name` ';
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                            while( $row = mysqli_fetch_array( $result))
                            {

                                echo '<option value="'.$row['machine_name'].'">'.$row['machine_name'].'</option>';

                            }

                            ?>
                        </select>


                    </div>


                    <div class="col-sm-6" style="float: right; padding-top: 8px;">
                        <button name="submit" type="button" class="btn btn-info" onclick="get_machine_wise_summary()">Filter</button>
                    </div>



                    <table class="table">
                        <thead>
                        <tr>
                            <td style="text-align: center; font-size: 25px; color: black; font-weight: bold; ">
                                Machine Wise Monthly Production Report
                            </td>

                        </tr>
                        </thead>
                    </table>

                    <div id="machine_wise_summary_filtered_div">

                    </div>


            </div>

            <div id="machine_wise_summary_full_div" >



                <table id="target_table" class="table table-bordered" id="table_data_for_machine_wise_production" class="display" cellspacing="0" style="border: 2px solid black;">
                    <thead>

                    <tr style="background-color: #C0C0C0; border: 2px solid black;">

                        <th colspan="2" style="border: 1px solid">Process wise Machines</th>
                        <th style="border: 1px solid">Today (Yesterday)</th>
                        <th style="border: 1px solid">To Date (Day 1 to yesterday)</th>
                        <th style="border: 1px solid">Target (30 days)</th>
                        <th style="border: 1px solid">Remaining (-)</th>
                        <th style="border: 1px solid">Current Daily Average</th>
                        <th style="border: 1px solid">Required Daily Average</th>
                        <th style="border: 1px solid">Re-process Today (Yesterday)</th>
                        <th style="border: 1px solid">Re-process To date</th>
                    </tr>

                    </thead>

                    <tbody>
                    <?php


                    /////////////////////////////// For greige receiving Process ////////////////////////////////////
                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

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
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        // $total_qty = $today_total_qty + $total_till_yesterday_qty;

                        $sql_for_machine_wise_monthly_target = "SELECT process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target 
                                                                from machine_name WHERE process_name = '$process_name'";

                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        // $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black;  background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid" ><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php


                    }

                    //////////////////////// For Singeing Process ////////////////////////////////////////////////////////////

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, 
                                        COUNT(partial_test_for_test_result_creation_date) AS count  
                                        from partial_test_for_test_result_info 
                                        WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') and process_id = 'proc_21' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                             from partial_test_for_test_result_info 
                                             where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "SELECT process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target 
                                                                from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name 
                                            INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                from partial_test_for_test_result_info where process_id ='$process_id' AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                from partial_test_for_test_result_info
                                                where process_id = '$process_id' AND machine_name = '$machine_name' AND 
                                                partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }
                    }

                    //////////////////////// For Desizing Process ////////////////////////////////////////////////////////////

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, 
                                        COUNT(partial_test_for_test_result_creation_date) AS count  
                                        from partial_test_for_test_result_info 
                                        WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                        partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                        from partial_test_for_test_result_info WHERE process_id= 'proc_20') and process_id = 'proc_22' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                             from partial_test_for_test_result_info 
                                             where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "SELECT process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target 
                                                                from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name 
                                            INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "SELECT SUM(after_trolley_or_batcher_qty) as today_qty 
                                                from partial_test_for_test_result_info where process_id ='$process_id' AND 
                                                machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "SELECT SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count 
                                                from partial_test_for_test_result_info
                                                where process_id = '$process_id' AND machine_name = '$machine_name' AND 
                                                partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND 
                                                partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date 
                                                from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }
                    }

                    // for process Singeing & Desizing .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                 and process_id = 'proc_1' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                        where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                      AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }




                    // for process Scouring & Bleaching .......................................
                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                      and process_id = 'proc_4' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                               where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                             AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }

                    // for process Ready For Mercerize  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_5' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                   where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }

                    // for process  Mercerize  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                       and process_id = 'proc_6' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                               where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                             AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }


                    // for process  Ready for Print  .......................................
                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                        and process_id = 'proc_7' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                        where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                      AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }


                    // for process  Printing  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_8' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                        where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                      AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }


                    // for process  Washing  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_13' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                   where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }


                    // for process  Curing  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_9' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                        where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                      AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }

                    // for process  Finishing  .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_16' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                   where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }

                    // for process  Calander     .......................................

                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                          and process_id = 'proc_17' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"></td>
                            <td style="border: 1px solid"></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                   where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count =$counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"></td>
                                <td style="border: 1px solid"></td>
                            </tr>

                            <?php
                        }


                    }


                    // for process  Sanforizing    .......................................
                    $counter_today =0;
                    $today_total_qty =0;
                    $total_till_yesterday_qty =0;
                    $total_qty_for_machine_wise_monthly_target=0;
                    $total_remaining_qty=0;
                    $total_current_daily_avg=0;
                    $total_required_avg =0;

                    $sql_for_process = "SELECT process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')
                                         and process_id = 'proc_18' ";
                    $res_for_process = mysqli_query($con, $sql_for_process);

                    while ($row_for_process = mysqli_fetch_assoc($res_for_process))
                    {
                        $process_name = $row_for_process['process_name'];
                        $process_id = $row_for_process['process_id'];
                        $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                        $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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
                            $daily_avg_count =$counter_today + 0;
                        }

                        $today_total_qty += $today_qty;

                        $total_till_yesterday_qty =$row_for_process['total_qty'];

                        //  $total_qty = $today_total_qty + $total_till_yesterday_qty;




                        $sql_for_machine_wise_monthly_target = "select process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                        $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                        $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                        $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];

                        //  $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                        $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                        $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                        $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                        $sql_for_reprocess_today = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE process_id = 'proc_18' AND process_name LIKE '%Re%' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                        $res_for_reprocess_today = mysqli_query($con, $sql_for_reprocess_today) or die(mysqli_error($con));
                        $row_for_reprocess_today = mysqli_fetch_assoc($res_for_reprocess_today);

                        $sql_for_reprocess = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE process_id = 'proc_18' AND process_name LIKE '%Re%' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
                        $res_for_reprocess = mysqli_query($con, $sql_for_reprocess) or die(mysqli_error($con));
                        $row_for_reprocess = mysqli_fetch_assoc($res_for_reprocess);

                        ?>
                        <!-- <tr><td></td></tr> -->
                        <tr style="border: 2px solid black; background-color: #E0DDDD">
                            <td colspan="2" style="font-weight: bold; border: 1px solid"><?php echo $row_for_process['process_name']; ?></td>
                            <td style="border: 1px solid"><?php echo $today_total_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_till_yesterday_qty ?></td>
                            <td style="border: 1px solid"><?php echo $total_qty_for_machine_wise_monthly_target ?></td>
                            <td style="border: 1px solid"><?php echo $total_remaining_qty ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_current_daily_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo number_format($total_required_avg, 2) ?></td>
                            <td style="border: 1px solid"><?php echo $row_for_reprocess_today['qty_for_reprocess']; ?></td>
                            <td style="border: 1px solid"><?php echo $row_for_reprocess['qty_for_reprocess']; ?></td>

                        </tr>
                        <?php
                        $counter_today=0;
                        $total_monthly_terget = 0;
                        $remaining_qty =0;
                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_id = process_name.process_id and process_name.process_id = '$process_id'";
                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                        {
                            $machine_name = $row_for_machine['machine_name'];
                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);

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

                            $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                where process_id = '$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                              AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                            if($row_for_total_qty['total_qty']!=null)
                            {
                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                            }
                            else
                            {
                                $till_yesterday_qty = 0;
                            }
                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                            // $total_qty = $today_qty + $till_yesterday_qty;
                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                            // $total_remaining_qty += $remaining_qty;

                            if($row_for_total_qty['count']!=null)
                            {
                                $daily_avg_count = $row_for_total_qty['count'];
                            }
                            else
                            {
                                $daily_avg_count = $counter_today;
                            }

                            $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                            //  $total_daily_avg_count += $daily_avg_count;

                            $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                            $sql_for_reprocess_today = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE machine_name = '$machine_name' AND process_name LIKE '%Re%' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_reprocess_today = mysqli_query($con, $sql_for_reprocess_today) or die(mysqli_error($con));
                            $row_for_reprocess_today = mysqli_fetch_assoc($res_for_reprocess_today);

                            $sql_for_reprocess_till_yesterday = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE machine_name = '$machine_name' AND process_name LIKE '%Re%' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
                            $res_for_reprocess_till_yesterday = mysqli_query($con, $sql_for_reprocess_till_yesterday) or die(mysqli_error($con));
                            $row_for_reprocess_till_yesterday = mysqli_fetch_assoc($res_for_reprocess_till_yesterday);

                            ?>
                            <tr>
                                <td colspan="2" style="border: 1px solid"><?php echo $row_for_machine['machine_name']; ?></td>
                                <td style="border: 1px solid"><?php echo $today_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $till_yesterday_qty; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_machine['machine_wise_monthly_target']; ?></td>
                                <td style="border: 1px solid"><?php echo $remaining_qty?></td>
                                <td style="border: 1px solid"><?php echo number_format($current_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo number_format($required_daily_avg, 2)?></td>
                                <td style="border: 1px solid"><?php echo $row_for_reprocess_today['qty_for_reprocess']; ?></td>
                                <td style="border: 1px solid"><?php echo $row_for_reprocess_till_yesterday['qty_for_reprocess']; ?></td>
                            </tr>

                            <?php
                        }


                    }
                    ?>
                    </tr>

                    </tbody>
                </table>

            </div>  <!-- End of   <div id="machine_wise_summary_full_div"></div> -->
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
            <!-- <label for="" style="text-align: center;" style="border: brown;">** All Quantity is in meter. **  </label> -->
        </div>  <!-- <div class="form-group form-group-sm" id="div_machine_wise_production_summary_for_folding"> -->

    </div>
    <div class="col-sm-6">
        <!-- <button id="print" class="btn btn-primary" name="print" onclick="generate_pdf_for_machine_wise_production_summary(this)">Print</button> -->
        <button class="btn btn-success" onclick="pdf_print()">Print</button>

    </div>

</div>  <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->

<script>
    //   $(document).ready(function() {

    //        var table = $('#table_data_for_machine_wise_production').DataTable( {
    //            scrollY:        "1000px",
    //            scrollCollapse: true,
    //            paging:         false,
    //            columnDefs: [
    //                { width: '0%', targets: 0 }
    //            ],
    //            fixedColumns:   {
    //                                leftColumns: 2,
    //                                rightColumns: 1
    //                            }

    //        } );
    //    } );

</script>


<script>

    // function generate_pdf_for_machine_wise_production_summary(){

    //      let nbPages = 1;
    //     let sourceHtml = $('#element');


    //     html2pdf(sourceHtml[0], {
    //       margin: 1,
    //       filename: 'machine_wise_production_summary.pdf',
    //       image: { type: 'jpeg', quality: 1.0 },

    //       html2canvas: { dpi: 800, letterRendering: true, width: 4000, height: 3000  },
    //       jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }
    //     });
    // }


    function pdf_print()
    {

        var divContents = document.getElementById("machine_wise_production_summary_for_folding_form").innerHTML;
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
