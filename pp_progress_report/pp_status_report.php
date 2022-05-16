        <style>
            table, th, td {
                text-align: center;
            }
        </style>
        <?php
        session_start();
        error_reporting(0);
        include('../login/db_connection_class.php');
        $obj = new DB_Connection_Class();
        $obj->connection();

        $pp_number=$_GET['all_data'];
        $process_loss_gain = 0.0;
        $process_loss_gain_with_greige = 0.0;
        $process_loss_gain_with_pp = 0.0;
        $process_completion_date='';



                // $sql_for_pp = "select distinct ppi.pp_num_id, ppi.pp_number, ppi.pp_creation_date, ppi.customer_id, ppi.customer_name, ppi.week_in_year, ppi.design,
                // group_concat( distinct pwvci.construction_name, ',') construction_name,pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, pwvci.percentage_of_other_fiber_content, pwvci.other_fiber_in_yarn, 
                // sum(pwvci.pp_quantity) pp_quantity ,pwvci.greige_width_in_inch,
                // pwvci.finish_width_in_inch, group_concat(distinct pwvci.process_technique_name, ', ') process_technique_name,
                // (select date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri

                // where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_issue_date, 
                // (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                // where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_completion_date,
                //                             (select sum(ptftri.after_trolley_or_batcher_qty) total_process_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                //                             where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_id = aptv.process_id 
                //                             and ptftri.version_id = aptv.version_id  and aptv.process_or_reprocess = 'process') tot_process_qty,
                //                             (select sum(ptftri.after_trolley_or_batcher_qty) total_reprocess_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                //                             where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_name = aptv.process_name 
                //                             and ptftri.version_id = aptv.version_id  and (aptv.process_or_reprocess = 're-process' or aptv.process_or_reprocess = '2nd-Re-Process' or aptv.process_or_reprocess = '3rd-Re-Process' or aptv.process_or_reprocess = '4th-Re-Process')) tot_reprocess_qty
                // from process_program_info ppi, pp_wise_version_creation_info pwvci
                // where ppi.pp_number = pwvci.pp_number and ppi.pp_number = '$pp_number'";

                $sql_for_pp = "select distinct ppi.pp_num_id, ppi.pp_number, date_format(ppi.pp_creation_date, '%d-%b-%Y') start_date, ppi.customer_id, ppi.customer_name, ppi.week_in_year, ppi.design,
                group_concat( distinct pwvci.construction_name, ',') construction_name,pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, 
                                pwvci.percentage_of_other_fiber_content, pwvci.other_fiber_in_yarn, pwvci.greige_width_in_inch, pwvci.finish_width_in_inch, 
                                group_concat(distinct pwvci.process_technique_name, ', ') process_technique_name, sum(pwvci.pp_quantity) pp_quantity,
                        
                                (select SUM(after_trolley_or_batcher_qty) from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') total_greige_qty,

                (select date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_issue_date, 

                (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_completion_date,

                                (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where ptftri.pp_number = '$pp_number') process_completion_date,

                (SELECT SUM(ptftri_2.after_trolley_or_batcher_qty) FROM partial_test_for_test_result_info ptftri_2,(SELECT MAX(partial_test_for_test_result_id) lastid 
                                from partial_test_for_test_result_info where pp_number = '$pp_number' GROUP BY version_id) last_id where ptftri_2.partial_test_for_test_result_id = last_id.lastid) tot_process_qty,
                
                                (select sum(ptftri.after_trolley_or_batcher_qty) total_reprocess_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version  aptv 
                 where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_name = aptv.process_name and ptftri.version_id = aptv.version_id  
                                 and (aptv.process_or_reprocess = 're-process' or aptv.process_or_reprocess = '2nd-Re-Process' or aptv.process_or_reprocess = '3rd-Re-Process' or 
                                 aptv.process_or_reprocess = '4th-Re-Process')) tot_reprocess_qty from process_program_info ppi, pp_wise_version_creation_info pwvci 
                                where ppi.pp_number = pwvci.pp_number and ppi.pp_number = '$pp_number'";

            $result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
            $row_for_pp=mysqli_fetch_array($result_for_pp);


            $process_loss_gain_with_pp = $row_for_pp['tot_process_qty'] - $row_for_pp['pp_quantity'];
            $process_loss_gain_with_greige =   $row_for_pp['tot_process_qty'] - $row_for_pp['total_greige_qty'];

            $serial='';

            $process_start_date = $row_for_pp['greige_issue_date'];
            $process_end_date = $row_for_pp['process_completion_date'];

            $difference_In_Time = strtotime($process_end_date) - strtotime($process_start_date);

            // To calculate the no. of days between two dates
            $difference_In_Days = ($difference_In_Time + 86400) / (3600 * 24);

            $serial='';

        ?>

        <style>

            tr
            {
                border: 1px solid;
            }
            td
            {
                border: 1px solid;
            }
            th
            {
                border: 1px solid;
            }
        .form-group

        /* This is for reducing Gap among Form's Fields */
            {
            margin-bottom: 5px;
        }
        </style>

        <script>
        /*function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }*/
        </script>


    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">
            <br />
            <!-- <label class="col-sm-12" for="name" style="font-size: 20px; text-align: center;">Processing Program Status</label> -->
            <br />
            <div id="pp_status_report_summary">
                <form class="form-horizontal" action="" name="trf_pass_fail_form" id="trf_pass_fail_form">
                    <table class="table table-bordered" id='table_for_pp_status'>
                        <thead>
                            <tr>
                                <td colspan="9"
                                    style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                    Processing Program Status</td>
                            </tr>
                        </thead>
                    </table>
                    <!-- <br /> -->
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">PP Issue Date:</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['start_date'];?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Week</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['week_in_year'];?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">PP No.</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['pp_number'];?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Construction</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['construction_name'];?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2;text-align:left;">Customer</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['customer_name'];?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Fiber Content</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['percentage_of_cotton_content'].'% Cotton '.$row_for_pp['percentage_of_polyester_content'].'% Polyester';if($row_for_pp['other_fiber_in_yarn']=='Null'){echo '';}else{echo ' '.$row_for_pp['percentage_of_other_fiber_content'].'% '.' '.$row_for_pp['other_fiber_in_yarn'];} ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Design</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['design'];?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Process Technique(s)</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['process_technique_name'];?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">PP Qty.(mtr.)</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['pp_quantity'];?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Process Loss/Gain Qty(mtr.) with PP</td>
                                <!-- <td style="text-align:left;"><span id='loss_gain_with_pp'><?php //echo $process_loss_gain_with_pp; ?></span></td> -->
                                <td style="text-align:left;"><?php echo $process_loss_gain_with_pp; ?></td>

                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Greige Issue Date</td>
                                <td style="text-align:left;"><span id='greige_issue_date'><?php echo $row_for_pp['greige_issue_date'];?></span></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Process Loss/Gain Qty(mtr.) with Greige</td>
                                <td style="text-align:left;"><?php echo $process_loss_gain_with_greige; ?></td>
                                
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Greige Issuance Completion Date</td>
                                <td style="text-align:left;"><span><?php echo $row_for_pp['greige_completion_date'];?></span></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Total Process Qty</td>
                                <!-- <td style="text-align:left;"><?php //echo $row_for_pp['tot_process_qty'];?></td> -->
                                <td style="text-align:left;"><?php echo $row_for_pp['tot_process_qty']; ?></td>

                                
                            </tr>
                            <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Process Completion Date</td>
                                <td style="text-align:left;"><?php echo $process_end_date;?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Total Reprocess Qty</td>
                                <td style="text-align:left;"><?php echo $row_for_pp['tot_reprocess_qty'];?></td>
                            
                            </tr>
                        <tr>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;">Process Lead Time(day)</td>
                                <td style="text-align:left;"><?php echo $difference_In_Days;?></td>
                                <td style="font-weight: bold; background-color: #F2F2F2; text-align:left;"></td>
                                <td style="text-align:left;"></td>
                                
                            </tr>
                        </tbody>
                    </table>


                    <?php

                    /******************************************For Selecting Process ************************************************/
                    $sql_for_select_process="SELECT DISTINCT ptftri.process_id from partial_test_for_test_result_info  ptftri
                                            where  ptftri.pp_number = '$pp_number'";

                    $result_for_select_process= mysqli_query($con,$sql_for_select_process) or die(mysqli_error($con));
                    while($row_for_select_process=mysqli_fetch_array($result_for_select_process)) { 

                    ?>
                    <!-- ********************************************Start Greige Issuance (Process No - 20)************************************************ -->

                    <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">1. Greige Issuance (Start -  End)</label>  -->

                    <?php 
                    $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
                    date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
                    from partial_test_for_test_result_info  ptftri
                    where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'  
                        ";

                    $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
                    while($row = mysqli_fetch_array($result_for_greige))  
                    {  

                        if($row['end_date']!= '') 
                        {
                            $process_completion_date = $row['end_date'];
                        }

                                            /*********************************Create Greige Receiving Table**********************************/
                        if($row_for_select_process["process_id"] == "proc_20")
                        {
                            ?>
                            <table class="table">
                                <thead>
                                    <tr >
                                        <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                            <?php echo $Serial+=1; ?>.
                                            Greige Issuance (<?php echo  $row["start_date"].' - '.$row["end_date"].'	'; ?>)
                                        </td>
                                    </tr>
                                </thead>
                            </table>

                             <table class="table table-bordered">
                                <thead>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col">Date</th>
                                        <th scope="col">Version</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Style</th>
                                        <th scope="col">Greige Width (inch)</th>
                                        <th scope="col">Finish Width (inch)</th>
                                        <th scope="col">Received qty. (mtr.)</th>
                                        <th scope="col">Process/Reprocess</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                   
                                    <?php 
                                    $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name,  pp.gw, pp.fw, 
                                    pp.pp_quantity, result.process_qty, result.date, result.process_or_reprocess
                                    from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, 
                                            pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.pp_quantity  
                                            from pp_wise_version_creation_info pwvci 
                                            where  pwvci.pp_number = '$pp_number'
                                        )pp
                                    INNER JOIN (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, 
                                                    ptftri.version_id, ptftri.version_number, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, 
                                                    pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty process_qty,	
                                                    ptftri.after_trolley_number_or_batcher_number, ptftri.after_trolley_or_batcher_qty, 
                                                    ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess
                                                from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv
                                                where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                                and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                                and ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id 
                                                and ptftri.style=aptv.style_name and ptftri.finish_width_in_inch=aptv.finish_width_in_inch 
                                                and ptftri.process_id=aptv.process_id and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                                )result
                                    on pp.pp_number = result.pp_number	and pp.version_id = result.version_id
                                    order by pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";

                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                    while($row = mysqli_fetch_array($result_for_greige))  
                                    {  					
                                        echo ' <tr>
                                        <td>'.$row["date"].'</td>	
                                        <td>'.$row["version_number"].'</td>
                                        <td>'.$row["color"].'</td>
                                        <td>'.$row["style_name"].'</td>
                                        <td>'.$row["gw"].'</td>
                                        <td>'.$row["fw"].'</td>
                                        <td>'.$row["process_qty"].'</td>    
                                        <td>'.$row["process_or_reprocess"].'</td>    
                                        </tr> ';	
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="8" style="text-align: center;">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="8"
                                            style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                            Width Summary</td>
                                    </tr>
                                    <thead>
                                        <tr style="background-color: #D8D8D8;">
                                            <th scope="col">Greige Width (inch)</th>
                                            <th scope="col">Finish Width (inch)</th>
                                            <th scope="col">PP Quantity</th>
                                            <th scope="col">Received Quantity (mtr.)</th>
                                            <th scope="col" colspan="2">Short/ Excess From PP Qty (mtr)</th>
                                            <th scope="col" colspan="2">Short/ Excess From PP Qty (%)</th>
                                        </tr>
                                    </thead>
                                    <tr>
                            <?php 
                                $sql_for_greige = "select pp.pp_number,  pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                                (result.process_qty-pp.pp_quantity) short_excess_qty,
                                round((((result.process_qty-pp.pp_quantity)/result.process_qty)*100),2) short_qty_percent 
                            from 
                            (
                            select distinct pwvci.pp_number,  pwvci.finish_width_in_inch fw, 
                            pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                            from pp_wise_version_creation_info	pwvci
                            where  pwvci.pp_number = '$pp_number' 
                            group by pwvci.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch
                            )pp
                            INNER JOIN
                            (
                            select distinct  ptftri.pp_number, pwvci.finish_width_in_inch fw, 
                                pwvci.greige_width_in_inch gw,  sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                                from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                                where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch
                            )result                         
                            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw order by pp.pp_number, pp.gw, pp.fw";
                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                    while($row = mysqli_fetch_array($result_for_greige))  
                                    {  
                                    echo '
                                        <td>'.$row["gw"].'</td>	
                                        <td>'.$row["fw"].'</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td colspan="2">'.$row["short_excess_qty"].'</td>
                                        <td colspan="2">'.$row["short_qty_percent"].'</td>      
                                        </tr>						    		  
                                    ';	
                                    }
                                ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" colspan="2" style="text-align: center;">Version Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Style</th>
                                <th scope="col">PP Quantity</th>
                                <th scope="col">Received Quantity (mtr.)</th>
                                <th scope="col">Short/ Excess From PP Qty (mtr)</th>
                                <th scope="col">Short/ Excess From PP Qty (%)</th>
                            </tr>
                        </thead>
                        <?php 
                            $sql_for_greige = "select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                            (result.process_qty-pp.pp_quantity) short_greige_qty,
                            round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_greige_per 
                            from 
                            (
                            select distinct pwvci.pp_number,  pwvci.version_name, pwvci.finish_width_in_inch fw, 
                            pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(pwvci.pp_quantity) pp_quantity 
                            from pp_wise_version_creation_info	pwvci
                            where  pwvci.pp_number = '$pp_number' 
                            group by pwvci.pp_number, pwvci.version_name
                            )pp
                            INNER JOIN
                            (
                            select distinct  ptftri.pp_number, ptftri.version_number, pwvci.finish_width_in_inch fw, 
                            pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                            from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                            where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                            and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                            and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number
                            )result
                            on pp.pp_number = result.pp_number and pp.version_name = result.version_number";
                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                echo '
                                    <tr>
                                    <td colspan="2">'.$row["version_name"].'</td>
                                    <td>'.$row["color"].'</td>
                                    <td>'.$row["style_name"].'</td>
                                    <td>'.$row["pp_quantity"].'</td>
                                    <td>'.$row["process_qty"].'</td>
                                    <td>'.$row["short_greige_qty"].'</td>
                                    <td>'.$row["short_greige_per"].'</td>      
                                    </tr>						    		  
                                ';	
                                }
                            ?>
                        <?php 
                                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                                -- sum(total.short_greige_qty) short_greige_qty ,  sum(total.short_greige_per) short_excess_qty,
                                (sum(total.process_qty)- sum(total.pp_quantity)) short_excess_qty,
                                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_qty_percent
                                from
                                (
                                select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                                (result.process_qty-pp.pp_quantity) short_greige_qty,
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_greige_per 
                                from 
                                (
                                select distinct pwvci.pp_number,  pwvci.version_name, pwvci.finish_width_in_inch fw, 
                                pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(pwvci.pp_quantity) pp_quantity 
                                from pp_wise_version_creation_info	pwvci
                                where  pwvci.pp_number = '$pp_number' 
                                group by pwvci.pp_number, pwvci.version_name
                                )pp, 
                                (
                                select distinct  ptftri.pp_number, ptftri.version_number, pwvci.finish_width_in_inch fw, 
                                pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                                from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                                where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number
                                )result
                                where pp.pp_number = result.pp_number and pp.version_name = result.version_number) total";
                                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                    while($row = mysqli_fetch_array($result_for_greige))  
                                                    {  
                                                    echo '
                                                        <tr style="color: black; font-weight: bold;">
                                                        <td colspan="4">Greige Total Qty.(mtr.)</td>
                                                        <td>'.$row["pp_quantity"].'</td>
                                                        <td>'.$row["process_qty"].'</td>
                                                        <td>'.$row["short_excess_qty"].'</td>
                                                        <td>'.$row["short_qty_percent"].'</td>      
                                                        </tr>						    		  
                                                    ';
                                                    if($row['short_excess_qty']!= '') 
                                                        {
                                                            $process_loss_gain+=$row['short_excess_qty'];
                                                        }
                                                        
                                                    $Total_pp_quantity = $row['pp_quantity'];
                                                    $Total_greige_quantity = $row['process_qty'];
                                                    }
                                                    
                                                ?>
                    </tbody>
                </table>
                <?php } 	
                    }							
                ?>



                <!-- ******************************* Singing Process (Process No- 21) ************************************ -->

                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">2. Singing & Desizing (Start -  End)</label> -->
                <?php 
                $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
                date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
                from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'  
                    ";

                $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                {  
                    if($row['end_date']!= '') $process_completion_date = $row['end_date'];

                    if($row_for_select_process["process_id"] == "proc_21")
                    {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                        <?php echo $Serial+=1 ?>.Singeing (<?php echo  $row["start_date"].'-'.$row["end_date"].'	'; ?>)
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Date</th>
                                    <th scope="col">Version</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Style</th>
                                    <th scope="col">Greige Width (inch)</th>
                                    <th scope="col">Finish Width (inch)</th>
                                    <th scope="col">After.Batcher No.</th>
                                    <th scope="col">Process Qty.(mtr.)</th>
                                    <th scope="col" colspan="2">Process/Reprocess</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                    
                                        $sql_for_singeing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                                        result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                                        (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                                        round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                                        from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                                        pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                                        
                                        INNER JOIN 
                                        (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                                        pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                                        ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                                        
                                        from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                                        
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                                        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_21'
                                        and ptftri.pp_number = '$pp_number')result 
                                        
                                        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                                        
                                        $result_for_singeing= mysqli_query($con,$sql_for_singeing) or die(mysqli_error($con));
                                        while($row = mysqli_fetch_array($result_for_singeing))  
                                        {  
                                            echo '
                                                <td>'.$row["date"].'</td>	
                                                <td>'.$row["version_number"].'</td>
                                                <td>'.$row["color"].'</td>
                                                <td>'.$row["style_name"].'</td>
                                                <td>'.$row["gw"].'</td>
                                                <td>'.$row["fw"].'</td>     
                                                <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                                                <td>'.$row["after_trolley_or_batcher_qty"].'</td>  
                                                <td  colspan="2">'.$row["process_or_reprocess"].'</td>             
                                                </tr>						    		  
                                            ';	
                                        }
                                        ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Width Summary</td>
                                </tr>
                                <thead>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col" rowspan="2">Greige Width (inch)</th>
                                        <th scope="col" rowspan="2">Finish Width (inch)</th>
                                        <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                        <th scope="col" colspan="2">Short/ Excess From PP</th>
                                        <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    </tr>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                        <th scope="col" colspan="2">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tr>
                                <?php 
                    
                                    $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                                    (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                                    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                                        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                                        from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                                        pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                                    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                        ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                    FROM
                                    partial_test_for_test_result_info ptftri_1
                                        inner join (
                                    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                        ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                    and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_id = p.version_id
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    group by process_id,pp_number, fw,  gw)result 
                                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                    order by pp.pp_number, pp.gw, pp.fw";



                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                    
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                    <td>'.$row["gw"].'</td>	
                                    <td>'.$row["fw"].'</td>
                                    <td>'.$row["pp_quantity"].'</td>
                                    <td>'.$row["before_process_qty"].'</td>
                                    <td>'.$row["process_qty"].'</td>
                                    <td>'.$row["short_pp_qty"].'</td>
                                    <td>'.$row["short_pp_percent"].'</td>
                                    <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                                    <td>'.$row["short_gre_rcv_percent"].'</td>     
                                    </tr>						    		  
                                    ';	
                                }
                                                ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Version Summary</td>
                                </tr>
                                <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col" rowspan="2">Version Name</th>
                                    <th scope="col" rowspan="2">Color</th>
                                    <th scope="col" rowspan="2">Style</th>
                                    <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                    <th scope="col" colspan="2">Short/Excess From PP</th>
                                    <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                </tr>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                </tr>
                                </thead>
                                <tr>
                                <?php 
                        
                                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                (result.process_qty-pp.pp_quantity) short_pp, 
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
                    
                                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
                    
                                INNER JOIN 
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result 
                    
                                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                order by pp.pp_number, pp.version_name";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <td>'.$row["version_number"].'</td>
                                        <td>'.$row["color"].'</td>
                                        <td>'.$row["style_name"].'</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp"].'</td>  
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>   
                                        </tr>						    		  
                                    ';	
                                }

                                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
                        
                                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                                result.gray_process_qty from 
                                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
                        
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                ";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <tr style="color: black; font-weight: bold;">
                                        <td colspan="3">Singeing Total Qty.(mtr.)</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp_qty"].'</td>
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>       
                                        </tr>						    		  
                                    ';	
                                    if($row['short_gre_rcv_qty']!= '') 
                                    $process_loss_gain += $row['short_gre_rcv_qty'];	
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php 
                    } 
                }       // End Singing process
                ?>    

                <!-- ******************************* Desizing Process (Process No- 22) ************************************ -->

                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">2. Singing & Desizing (Start -  End)</label> -->
                <?php 
                $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
                date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
                from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'  
                    ";

                $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                {  
                    if($row['end_date']!= '') $process_completion_date = $row['end_date'];

                    if($row_for_select_process["process_id"] == "proc_22")
                    {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                        <?php echo $Serial+=1 ?>.Desizing (<?php echo  $row["start_date"].'-'.$row["end_date"].'	'; ?>)
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Date</th>
                                    <th scope="col">Version</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Style</th>
                                    <th scope="col">Greige Width (inch)</th>
                                    <th scope="col">Finish Width (inch)</th>
                                    <th scope="col">After.Batcher No.</th>
                                    <th scope="col">Process Qty.(mtr.)</th>
                                    <th scope="col" colspan="2">Process/Reprocess</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                    
                                        $sql_for_desizing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                                        result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                                        (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                                        round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                                        from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                                        pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                                        
                                        INNER JOIN 
                                        (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                                        pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                                        ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                                        
                                        from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                                        
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                                        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_22'
                                        and ptftri.pp_number = '$pp_number')result 
                                        
                                        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                                        
                                        $result_for_desizing= mysqli_query($con,$sql_for_desizing) or die(mysqli_error($con));
                                        while($row = mysqli_fetch_array($result_for_desizing))  
                                        {  
                                            echo '
                                                <td>'.$row["date"].'</td>	
                                                <td>'.$row["version_number"].'</td>
                                                <td>'.$row["color"].'</td>
                                                <td>'.$row["style_name"].'</td>
                                                <td>'.$row["gw"].'</td>
                                                <td>'.$row["fw"].'</td>     
                                                <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                                                <td>'.$row["after_trolley_or_batcher_qty"].'</td>  
                                                <td  colspan="2">'.$row["process_or_reprocess"].'</td>             
                                                </tr>						    		  
                                            ';	
                                        }
                                        ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Width Summary</td>
                                </tr>
                                <thead>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col" rowspan="2">Greige Width (inch)</th>
                                        <th scope="col" rowspan="2">Finish Width (inch)</th>
                                        <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                        <th scope="col" colspan="2">Short/ Excess From PP</th>
                                        <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    </tr>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                        <th scope="col" colspan="2">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tr>
                                <?php 
                    
                                    $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                                    (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                                    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                                        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                                        from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                                        pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                                    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                        ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                    FROM
                                    partial_test_for_test_result_info ptftri_1
                                        inner join (
                                    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                        ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                    and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_id = p.version_id
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    group by process_id,pp_number, fw,  gw)result 
                                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                    order by pp.pp_number, pp.gw, pp.fw";



                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                    
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                    <td>'.$row["gw"].'</td>	
                                    <td>'.$row["fw"].'</td>
                                    <td>'.$row["pp_quantity"].'</td>
                                    <td>'.$row["before_process_qty"].'</td>
                                    <td>'.$row["process_qty"].'</td>
                                    <td>'.$row["short_pp_qty"].'</td>
                                    <td>'.$row["short_pp_percent"].'</td>
                                    <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                                    <td>'.$row["short_gre_rcv_percent"].'</td>     
                                    </tr>						    		  
                                    ';	
                                }
                                                ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Version Summary</td>
                                </tr>
                                <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col" rowspan="2">Version Name</th>
                                    <th scope="col" rowspan="2">Color</th>
                                    <th scope="col" rowspan="2">Style</th>
                                    <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                    <th scope="col" colspan="2">Short/Excess From PP</th>
                                    <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                </tr>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                </tr>
                                </thead>
                                <tr>
                                <?php 
                        
                                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                (result.process_qty-pp.pp_quantity) short_pp, 
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
                    
                                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
                    
                                INNER JOIN 
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result 
                    
                                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                order by pp.pp_number, pp.version_name";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <td>'.$row["version_number"].'</td>
                                        <td>'.$row["color"].'</td>
                                        <td>'.$row["style_name"].'</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp"].'</td>  
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>   
                                        </tr>						    		  
                                    ';	
                                }

                                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
                        
                                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                                result.gray_process_qty from 
                                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
                        
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                ";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <tr style="color: black; font-weight: bold;">
                                        <td colspan="3">Desizing Total Qty.(mtr.)</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp_qty"].'</td>
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>       
                                        </tr>						    		  
                                    ';	
                                    if($row['short_gre_rcv_qty']!= '') 
                                    $process_loss_gain += $row['short_gre_rcv_qty'];	
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php 
                    } 
                }       // End Desizing process
                ?>    




                <!-- ******************************* Singing & Desizing (Process No- 1) ************************************ -->

                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">2. Singing & Desizing (Start -  End)</label> -->
                <?php 
                $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
                date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
                from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'  
                    ";

                $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                {  
                    if($row['end_date']!= '') $process_completion_date = $row['end_date'];

                    if($row_for_select_process["process_id"] == "proc_1")
                    {
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                        <?php echo $Serial+=1 ?>.Singeing & Desizing (<?php echo  $row["start_date"].'-'.$row["end_date"].'	'; ?>)
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Date</th>
                                    <th scope="col">Version</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Style</th>
                                    <th scope="col">Greige Width (inch)</th>
                                    <th scope="col">Finish Width (inch)</th>
                                    <th scope="col">After.Batcher No.</th>
                                    <th scope="col">Process Qty.(mtr.)</th>
                                    <th scope="col" colspan="2">Process/Reprocess</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                    
                                        $sql_for_singe_desize = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                                        result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                                        (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                                        round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                                        from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                                        pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                                        
                                        INNER JOIN 
                                        (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                                        pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                                        ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                                        
                                        from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                                        
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                                        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_1'
                                        and ptftri.pp_number = '$pp_number')result 
                                        
                                        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                                        
                                        $result_for_singe_desize= mysqli_query($con,$sql_for_singe_desize) or die(mysqli_error($con));
                                        while($row = mysqli_fetch_array($result_for_singe_desize))  
                                        {  
                                            echo '
                                                <td>'.$row["date"].'</td>	
                                                <td>'.$row["version_number"].'</td>
                                                <td>'.$row["color"].'</td>
                                                <td>'.$row["style_name"].'</td>
                                                <td>'.$row["gw"].'</td>
                                                <td>'.$row["fw"].'</td>     
                                                <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                                                <td>'.$row["after_trolley_or_batcher_qty"].'</td>  
                                                <td  colspan="2">'.$row["process_or_reprocess"].'</td>             
                                                </tr>						    		  
                                            ';	
                                        }
                                        ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Width Summary</td>
                                </tr>
                                <thead>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col" rowspan="2">Greige Width (inch)</th>
                                        <th scope="col" rowspan="2">Finish Width (inch)</th>
                                        <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                        <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                        <th scope="col" colspan="2">Short/ Excess From PP</th>
                                        <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    </tr>
                                    <tr style="background-color: #D8D8D8;">
                                        <th scope="col">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                        <th scope="col" colspan="2">Qty (mtr.)</th>
                                        <th scope="col">%</th>
                                    </tr>
                                </thead>
                                <tr>
                                <?php 
                    
                                    $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                                    (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                                    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                                        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                                        from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                                        pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                                    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                        ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                    FROM
                                    partial_test_for_test_result_info ptftri_1
                                        inner join (
                                    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                        ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                    and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_id = p.version_id
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    group by process_id,pp_number, fw,  gw)result 
                                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                    order by pp.pp_number, pp.gw, pp.fw";



                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                    
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                    <td>'.$row["gw"].'</td>	
                                    <td>'.$row["fw"].'</td>
                                    <td>'.$row["pp_quantity"].'</td>
                                    <td>'.$row["before_process_qty"].'</td>
                                    <td>'.$row["process_qty"].'</td>
                                    <td>'.$row["short_pp_qty"].'</td>
                                    <td>'.$row["short_pp_percent"].'</td>
                                    <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                                    <td>'.$row["short_gre_rcv_percent"].'</td>     
                                    </tr>						    		  
                                    ';	
                                }
                                                ?>
                                <tr>
                                    <td colspan="10" style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">Version Summary</td>
                                </tr>
                                <thead>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col" rowspan="2">Version Name</th>
                                    <th scope="col" rowspan="2">Color</th>
                                    <th scope="col" rowspan="2">Style</th>
                                    <th scope="col" rowspan="2">PP Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                    <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                    <th scope="col" colspan="2">Short/Excess From PP</th>
                                    <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                </tr>
                                <tr style="background-color: #D8D8D8;">
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                    <th scope="col">Qty (mtr.)</th>
                                    <th scope="col">%</th>
                                </tr>
                                </thead>
                                <tr>
                                <?php 
                        
                                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                (result.process_qty-pp.pp_quantity) short_pp, 
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
                    
                                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
                    
                                INNER JOIN 
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result 
                    
                                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                order by pp.pp_number, pp.version_name";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <td>'.$row["version_number"].'</td>
                                        <td>'.$row["color"].'</td>
                                        <td>'.$row["style_name"].'</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp"].'</td>  
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>   
                                        </tr>						    		  
                                    ';	
                                }

                                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
                        
                                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                                result.gray_process_qty from 
                                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
                        
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                ";

                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($result_for_greige))  
                                {  
                                    echo '
                                        <tr style="color: black; font-weight: bold;">
                                        <td colspan="3">Singeing & Desizing Total Qty.(mtr.)</td>
                                        <td>'.$row["pp_quantity"].'</td>
                                        <td>'.$row["before_process_qty"].'</td>
                                        <td>'.$row["process_qty"].'</td>
                                        <td>'.$row["short_pp_qty"].'</td>
                                        <td>'.$row["short_pp_percent"].'</td>
                                        <td>'.$row["short_gre_rcv_qty"].'</td>
                                        <td>'.$row["short_gre_rcv_percent"].'</td>       
                                        </tr>						    		  
                                    ';	
                                    if($row['short_gre_rcv_qty']!= '') 
                                    $process_loss_gain += $row['short_gre_rcv_qty'];	
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php 
                    } 
                }
                ?>
            



            <!-- ****************  Scouring (Process No- 2) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Scouring (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_2"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Scouring (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            
                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_2'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                        $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                        (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                        from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                        pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                        ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                    FROM
                    partial_test_for_test_result_info ptftri_1
                        inner join (
                    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                        ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                    and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
                        group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                    where  1=1
                    and ptftri_1.process_id = p.process_id
                    and ptftri_1.pp_number = p.pp_number
                    and ptftri_1.version_id = p.version_id
                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                    group by process_id,pp_number, fw,  gw)result 
                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                    order by pp.pp_number, pp.gw, pp.fw";




                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
        
                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
        
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Scouring Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>



                <!-- ****************  Bleaching (Process No- 3) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Bleaching (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_3"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Bleaching (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_3'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
                

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            
            $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
    
            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            result.gray_process_qty from 
            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
    
            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
            inner join (
            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";

                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Bleaching Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>

    



                <!-- ****************  Scouring & Bleaching (Process No- 4) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Scouring & Bleaching (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_4"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Scouring & Bleaching (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_4'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
        

        //----------------------------------------new query--------------------------------------------------------

        $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
        (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
        from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
        pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
        ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
    FROM
    partial_test_for_test_result_info ptftri_1
        inner join (
    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
        ,max(ptftri.partial_test_for_test_result_creation_date) max_date
    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
        where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
    and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
        group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
    where  1=1
    and ptftri_1.process_id = p.process_id
    and ptftri_1.pp_number = p.pp_number
    and ptftri_1.version_id = p.version_id
    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
    group by process_id,pp_number, fw,  gw)result 
    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
    order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td  colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            result.gray_process_qty from 
            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
            inner join (
            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Scouring & Bleaching Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php 
                }
        }
                ?>



                <!-- ****************  Ready For Mercerize (Process No- 5) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Ready For Mercerize (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_5"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Ready For Mercerize (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_5'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_id = p.version_id
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                group by process_id,pp_number, fw,  gw)result 
                on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                
                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            result.gray_process_qty from 
            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
            inner join (
            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Ready For Mercerize Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>


                <!-- ****************  Mercerize (Process No- 6) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Mercerize (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_6"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Mercerize (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            
                
                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_6'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            
                                //----------------------------------------new query--------------------------------------------------------

                                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                                INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_id = p.version_id
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                group by process_id,pp_number, fw,  gw)result 
                                on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                order by pp.pp_number, pp.gw, pp.fw";

                                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            result.gray_process_qty from 
            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
            inner join (
            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Mercerize Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>

            <!-- ****************  Ready for Print (Process No- 7) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Ready for Print (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date = $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_7"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Ready for Print (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_7'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col"rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
                            
                                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";


                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th >Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            
                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

            $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            result.gray_process_qty from 
            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
            inner join (
            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Ready for Print Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>


                <!-- ****************  Printing (Process No- 8) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Printing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_8"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Printing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_8'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                    
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            
                    //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td >'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            
                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Printing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>



        <!-- ****************  Steaming (Process No- 10) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Curing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_10"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Steaming (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                                
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_10'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 


                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
    
                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
    
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Steaming Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>    

                <!-- ****************  Curing (Process No- 9) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Curing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_9"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Curing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                                
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_9'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 


                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
    
                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
    
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Curing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>




                <!-- ****************  Ready For Dyeing (Process No- 11) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Ready For Dyeing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_11"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Ready For Dyeing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            </th>
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            
                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_11'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_id = p.version_id
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                group by process_id,pp_number, fw,  gw)result 
                on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Ready For Dyeing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>





            <!-- ****************  Dyeing (Process No- 12) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Dyeing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_12"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Dyeing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_12'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                    
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                    
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                            //--------------------------------------new query ------------------------------------------
                            $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                            (result.process_qty-pp.pp_quantity) short_pp, 
                            round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                            (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
                
                            from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
                
                            INNER JOIN 
                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result 
                
                            on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                            order by pp.pp_number, pp.version_name";
                
                
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                

                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Dyeing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>










            <!-- ****************  Washing (Process No- 13) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Washing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_13"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Washing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_13'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                    
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                            //-----------------------------------------------new query -------------------------------------------------

                            $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
                
                            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                            result.gray_process_qty from 
                            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
                
                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                            ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Washing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>


                <!-- ****************  Ready For Raising (Process No- 14) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Ready For Raising (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_14"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Ready For Raising (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                                
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_14'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>

                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>

                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_id = p.version_id
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                group by process_id,pp_number, fw,  gw)result 
                on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                

                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Ready For Raising Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>




                <!-- ****************  Raising (Process No- 15) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Raising (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_15"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Raising (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                
                            </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                //---------------------------------------------------new query----------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_15'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
    
                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
    
                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 
    
                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                
                
                //-----------------------------------------------new query -------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                            result.gray_process_qty from 
                            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                            ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Raising Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];
                }
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>

                <!-- ****************  Finishing (Process No- 16) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Finishing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_16"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Finishing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                //---------------------------------------------------new query----------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_16'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                        <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
        

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                
                //-------------------------------------------------new query-----------------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                            result.gray_process_qty from 
                            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                            ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Finishing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td colspan="2">'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];

                $process_loss_gain_with_greige=
                    $row['short_gre_rcv_qty'];

                    $process_loss_gain_with_pp=
                    $row['short_pp_qty'];
                    
                    $final_process_qty = $row['process_qty'];
            
                    
                    }
                    $process_loss_gain_with_pp = $Total_pp_quantity - $final_process_qty;
                    $process_loss_gain_with_greige = $Total_greige_quantity - $final_process_qty;
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>


    <!-- ****************  Dyeing-Finish (Process No- 23) *****************-->

        <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_23"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Dyeing-Finish (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
            

                //---------------------------------------------------new query----------------------------------------

                $sql_for_greige = "SELECT pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_23'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                        <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                    
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
        

                //--------------------------------------new query ------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                (result.process_qty-pp.pp_quantity) short_pp, 
                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                INNER JOIN 
                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_number = p.version_name
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                group by process_id,pp_number, version_name)result 

                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                order by pp.pp_number, pp.version_name";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
                
                //-------------------------------------------------new query-----------------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                            result.gray_process_qty from 
                            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                            ";
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Dyeing-Finish Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td colspan="2">'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];

                $process_loss_gain_with_greige=
                    $row['short_gre_rcv_qty'];

                    $process_loss_gain_with_pp=
                    $row['short_pp_qty'];
                    
                    $final_process_qty = $row['process_qty'];
            
                    
                    }
                    $process_loss_gain_with_pp = $Total_pp_quantity - $final_process_qty;
                    $process_loss_gain_with_greige = $Total_greige_quantity - $final_process_qty;
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>

                <!-- ****************  Calender (Process No- 17) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Calender (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'  
            ";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_17"){?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Calender (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                                
                            <th scope="col" rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                

                //----------------------------------------------new query---------------------------------------------------
                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                    pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_17'
                    and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                    
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                            <th colspan="2">Qty (mtr.)</th>
                            <th>%</th>
                            <th colspan="2">Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------new query-------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            FROM
            partial_test_for_test_result_info ptftri_1
                inner join (
            SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_id = p.version_id
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            group by process_id,pp_number, fw,  gw)result 
            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            order by pp.pp_number, pp.gw, pp.fw";
            
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["gw"].'</td> 
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["pp_quantity"].'</td>
                        <td>'.$row["before_process_qty"].'</td>
                        <td>'.$row["process_qty"].'</td>
                        <td>'.$row["short_pp_qty"].'</td>
                        <td>'.$row["short_pp_percent"].'</td>
                        <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                        <td>'.$row["short_gre_rcv_percent"].'</td>  
                        <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                        <td>'.$row["short_pre_proc_percent"].'</td>    
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                    
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
            

                //----------------------------------------------------new query----------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                (result.process_qty-pp.pp_quantity) short_pp, 
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

                                INNER JOIN 
                                (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                                sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                                sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                                (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                                max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1=1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id,pp_number, version_name)result 

                                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                order by pp.pp_number, pp.version_name";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td  colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                //---------------------------------------------------new query-------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                            sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                            (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                            round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                            (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                            round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                            (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                            round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                            from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                            result.gray_process_qty from 
                            ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                            sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                            (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                            sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                            sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                            (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                            FROM
                            partial_test_for_test_result_info ptftri_1
                            inner join (
                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                            max(ptftri.partial_test_for_test_result_creation_date) max_date
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                            and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_number = p.version_name
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                            ";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Calender Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td  colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                    $row['short_gre_rcv_qty'];

                $process_loss_gain_with_greige=
                    $row['short_gre_rcv_qty'];

                    $process_loss_gain_with_pp=
                    $row['short_pp_qty'];
                    
                    $final_process_qty = $row['process_qty'];
            
                    
                    }
                    $process_loss_gain_with_pp = $Total_pp_quantity - $final_process_qty;
                    $process_loss_gain_with_greige = $Total_greige_quantity - $final_process_qty;
            ?>
                    </tbody>
                </table>
                <?php }
        }
                ?>
    <br>
                <!-- ****************  Sanforizing (Process No- 18) *****************-->
                <!-- <label class="col-sm-12" for="name" style="font-size: 20px; font-weight: bold">7. Sanforizing (Start -  End)</label> -->
                <?php 
            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'";

            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') $process_completion_date =
                        $row['end_date'];
                        
                if($row_for_select_process["process_id"] == "proc_18")
                {
                    ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="4" style="text-align: left; font-size: 20px; color: black; font-weight: bold;">
                                <?php echo $Serial+=1; ?>.
                                Sanforizing (<?php echo  $row["start_date"].'-'.$row["end_date"].'  '; ?>)</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #D8D8D8;">
                            <th scope="col" rowspan="2">Date</th>
                            <th scope="col" rowspan="2">Version</th>
                            <th scope="col" rowspan="2">Color</th>
                            <th scope="col" rowspan="2">Style</th>
                            <th scope="col" rowspan="2">Greige Width (inch)</th>
                            <th scope="col" rowspan="2">Finish Width (inch)</th>
                            <th scope="col" rowspan="2">B.Batcher No.</th>
                            <th scope="col" rowspan="2">B.Process qty.(mtr.)</th>
                            <th scope="col" rowspan="2">After. Batcher No.</th>
                            <th scope="col" rowspan="2">Process qty. (mtr.)</th>
                            <th scope="col" colspan="2">Short/ Excess From Previous Process</th>
                            
                            <th scope="col"  rowspan="2">Process/Reprocess</th>
                        </tr>
                        <tr style="background-color: #D8D8D8;">
                            <th>Qty (mtr.)</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
                INNER JOIN 
                (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_18'
                and ptftri.pp_number = '$pp_number')result 
                
                on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                    echo '
                        <td>'.$row["date"].'</td> 
                        <td>'.$row["version_number"].'</td>
                        <td>'.$row["color"].'</td>
                        <td>'.$row["style_name"].'</td>
                        <td>'.$row["gw"].'</td>
                        <td>'.$row["fw"].'</td>
                        <td>'.$row["before_trolley_number_or_batcher_number"].'</td> 
                        <td>'.$row["before_trolley_or_batcher_qty"].'</td>      
                        <td>'.$row["after_trolley_number_or_batcher_number"].'</td>      
                        <td>'.$row["after_trolley_or_batcher_qty"].'</td> 
                        <td>'.$row["short_proc"].'</td> 
                        <td>'.$row["short_percent"].'</td>   
                    <td>'.$row["process_or_reprocess"].'</td>         
                    </tr>                     
                ';  
                    }
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Width Summary</td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Greige Width (inch)</th>
                                <th scope="col" rowspan="2">Finish Width (inch)</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/ Excess From PP</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
                            
                
                //----------------------------------------new query--------------------------------------------------------

                $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                where  ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                FROM
                partial_test_for_test_result_info ptftri_1
                inner join (
                SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                where  1=1
                and ptftri_1.process_id = p.process_id
                and ptftri_1.pp_number = p.pp_number
                and ptftri_1.version_id = p.version_id
                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                group by process_id,pp_number, fw,  gw)result 
                on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                order by pp.pp_number, pp.gw, pp.fw";



            
                
                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {
                            
                                echo '
                                <td>'.$row["gw"].'</td> 
                                <td>'.$row["fw"].'</td>
                                <td>'.$row["pp_quantity"].'</td>
                                <td>'.$row["before_process_qty"].'</td>
                                <td>'.$row["process_qty"].'</td>
                                <td>'.$row["short_pp_qty"].'</td>
                                <td>'.$row["short_pp_percent"].'</td>
                                <td colspan="2">'.$row["short_gre_rcv_qty"].'</td> 
                                <td>'.$row["short_gre_rcv_percent"].'</td>  
                                <td colspan="2">'.$row["short_pre_proc_qty"].'</td> 
                                <td>'.$row["short_pre_proc_percent"].'</td>    
                            </tr>                     
                        ';  
                        
                    }
                    
                ?>
                        <tr>
                            <td colspan="15" style="text-align: center;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15"
                                style="text-align: center; background-color: #D8D8D8; color: black; font-weight: bold;">
                                Version Summary
                            </td>
                        </tr>
                        <thead>
                            <tr style="background-color: #D8D8D8;">
                                <th scope="col" rowspan="2">Version Name</th>
                                <th scope="col" rowspan="2">Color</th>
                                <th scope="col" rowspan="2">Style</th>
                                <th scope="col" rowspan="2">PP Quantity</th>
                                <th scope="col" rowspan="2">Before Process Quantity (mtr.)</th>
                                <th scope="col" rowspan="2">Process Quantity (mtr.)</th>
                                <th scope="col" colspan="2">Short/Excess From PP</th>
                                
                                <th scope="col" colspan="2">Short/Excess From Greige Receiving</th>
                                
                                <th scope="col" colspan="3">Short/Excess From Previous Process</th>
                                
                            </tr>
                            <tr style="background-color: #D8D8D8;">
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th>Qty (mtr.)</th>
                                <th>%</th>
                                <th colspan="2">Qty (mtr.)</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tr>
                            <?php 
                

                                $sql_for_greige = " select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                (result.process_qty-pp.pp_quantity) short_pp, 
                                round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

                                from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' 
                                                            group by pwvci.pp_number, pwvci.version_name )pp 

                                INNER JOIN 
                                (SELECT distinct ptftri_1.process_id, ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch
                                ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                FROM
                                partial_test_for_test_result_info ptftri_1
                                inner join (
                                SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch
                                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                where  1 = 1
                                and ptftri_1.process_id = p.process_id
                                and ptftri_1.pp_number = p.pp_number
                                and ptftri_1.version_number = p.version_name
                                and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                group by process_id , pp_number, version_name)result 
                                on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                order by pp.pp_number, pp.version_name";


                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <td>'.$row["version_number"].'</td>
                    <td>'.$row["color"].'</td>
                    <td>'.$row["style_name"].'</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp"].'</td>  
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td>  
                    <td  colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>   
                    </tr>                     
                ';  
                }
            ?>
                            <?php 
            

                //-------------------------------------------------new query-----------------------------------------------------------

                $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 

                from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                result.gray_process_qty from 
                ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,

                (SELECT distinct ptftri_1.process_id, ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch
                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                    ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                    where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                    FROM
                    partial_test_for_test_result_info ptftri_1
                    inner join (
                    SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch
                    ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                    where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                    and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                    and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                    where  1 = 1
                    and ptftri_1.process_id = p.process_id
                    and ptftri_1.pp_number = p.pp_number
                    and ptftri_1.version_number = p.version_name
                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                    group by process_id , pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";

                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                echo '
                    <tr style="color: black; font-weight: bold;">
                    <td colspan="3">Sanforizing Total Qty.(mtr.)</td>
                    <td>'.$row["pp_quantity"].'</td>
                    <td>'.$row["before_process_qty"].'</td>
                    <td>'.$row["process_qty"].'</td>
                    <td>'.$row["short_pp_qty"].'</td>
                    <td>'.$row["short_pp_percent"].'</td>
                    <td>'.$row["short_gre_rcv_qty"].'</td>
                    <td>'.$row["short_gre_rcv_percent"].'</td> 
                    <td  colspan="2">'.$row["short_pre_proc_qty"].'</td>
                    <td>'.$row["short_pre_proc_percent"].'</td>        
                    </tr>                     
                ';  
                if($row['short_gre_rcv_qty']!= '') $process_loss_gain += $row['short_gre_rcv_qty'];

                $process_loss_gain_with_greige=
                    $row['short_gre_rcv_qty'];

                    $process_loss_gain_with_pp=
                    $row['short_pp_qty'];
                    $final_process_qty = $row['process_qty'];
            
                    
                }
                    $process_loss_gain_with_pp = $final_process_qty - $Total_pp_quantity;
                    $process_loss_gain_with_greige =   $final_process_qty - $Total_greige_quantity;
            ?>
                    </tbody>
                </table>
                <?php 
            }
        }
                ?>


                <?php


    }  /*ENd of while($row_for_select_process=mysqli_fetch_array($result_for_select_process))*/

    ?>
                <button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export to excel</a></button>

                <!-- <button class="btn btn-success" id="print" onclick="pdf_print()">Print</button> -->

                <a href="pp_progress_report/pdf_file_for_pp_status_report_landscape.php?all_data=<?php echo $pp_number; ?>" target="_blank">
                            <button type="button" id="pdf_for_pp_status_report" name="pdf_for_pp_status_report"  class="btn btn-primary btn-xs">Generate pdf file</button>
                    </a>

                

            </form>
            </div>
        </div>
    </div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->




    <script>
    function exportF(elem) {
        var table = document.getElementById("trf_pass_fail_form");
        var html = table.innerHTML;
        var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
        elem.setAttribute("href", url);
        elem.setAttribute("download", "pp_status_report.xls"); // Choose the file name
        return false;
    }

    function pdf_print()
        {
        //     console.log(document.getElementById("trf_pass_fail_form").innerHTML);

        var divContents = document.getElementById("pp_status_report_summary").innerHTML;
                var a = window.open('', '', 'height=500, width=500');
                a.document.write('<html>');
                a.document.write('<body > ');
                a.document.write(divContents);
                a.document.write('</body></html>');
                a.document.close();
                a.print();



            
        
                            
        }


    </script>




    <script>
    // document.getElementById("total_process_qty").innerHTML = "<?php echo $final_process_qty ?>";

    // document.getElementById("loss_gain_with_greige").innerHTML = "<?php echo $process_loss_gain_with_greige ?>";
    // document.getElementById("loss_gain_with_pp").innerHTML = "<?php echo $process_loss_gain_with_pp ?>";
    // document.getElementById("process_completion_date").innerHTML = "<?php echo $process_completion_date ?>";

    // var process_start_date = document.querySelector('#greige_issue_date').innerHTML;
    //         var process_end_date = document.querySelector('#process_completion_date').innerHTML;

    //         var date1 = new Date(process_start_date);
    //         var date2 = new Date(process_end_date);

    //         var Difference_In_Time = date2.getTime() - date1.getTime();

    //         // To calculate the no. of days between two dates
    //         var Difference_In_Days = (Difference_In_Time + 86400000) / (1000 * 3600 * 24);
    //         document.getElementById("process_lead_time").innerHTML = Difference_In_Days;
    //         console.log(Difference_In_Time);
            
    // var Difference_In_Days = (Difference_In_Time + 86400000) / (1000 * 3600 * 24);
    // document.getElementById("process_lead_time").innerHTML = Difference_In_Days;

    $(document).ready(function() {

            var elements = document.querySelectorAll('tr, td, th');

            for (let element of elements) {
                element.style.border = '1px solid';
            }

    } );
    </script>