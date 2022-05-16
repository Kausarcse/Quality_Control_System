<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("d-m-Y");


$user_name=$_SESSION['user_name'];


?>
<script type='text/javascript' src='process_program/process_program_info_form_validation.js'></script>

<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}
.row.no-gutter {
  margin-left: 0;
  margin-right: 0;
}

</style>

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

</script>

                            

<div class="col-sm-12 col-md-12 col-lg-12">

	  <div class="panel panel-default" id="div_table">

        <div class="form-group form-group-sm" id="div_waiting_for_lab_approval_for_folding">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_lab_approval_for_folding_form" id="waiting_for_lab_approval_for_folding_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Lab Approval For Folding</td>
                        </tr>
                    </thead>
                </table>

                    <div id="overflow_for_waiting_for_lab_approval"> 
                        <table id="datatable_for_waiting_for_lab_approval" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Date</th>    
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Shift</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">TRF No.</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">PP No.</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Week</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Customer</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Design</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Version</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Style</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Color</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Construction</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Process Step</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Trolly</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Finish Width (Inch)</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Quantity (mtr.)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Test Status</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Remarks</th>
                                    <th rowspan="2" style="font-weight: bold; border: 1px solid black">Authorized By</th>
                                    <th colspan="2" style="font-weight: bold; border: 1px solid black; text-align: center;">Action</th>
                                </tr>
                                <tr>
                                    <th style="font-weight: bold; border: 1px solid black">Pass/Fail</th>
                                    <th style="font-weight: bold; border: 1px solid black">Approved</th>
                                    <th style="font-weight: bold; border: 1px solid black">Rework</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                                                        
                                        // $select_sql_for_duplicacy="select * from inspection_and_folding_table_for_lab_approval";

                                        // $select_result_duplicacy = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

                                        // while($row_for_select_duplicacy = mysqli_fetch_array($select_result_duplicacy))
                                        // {
                                        //  $trf_id = $row_for_select_duplicacy['trf_no'];
                                        //     $version_number = $row_for_select_duplicacy['version_number'];
                                        //     $pp_number = $row_for_select_duplicacy['pp_number'];
                                        //     $process_name = $row_for_select_duplicacy['process_name'];
                                        //     $customer_name = $row_for_select_duplicacy['customer_name'];
                                        //     $style_name = $row_for_select_duplicacy['style_name'];
                                        //     $design_name = $row_for_select_duplicacy['design_name'];
                                        //     $trolly_number = $row_for_select_duplicacy['trolly_number'];
                                        // }
                                        
                                        $sql_for_pp_state = "SELECT DISTINCT ppm.pp_number, ppm.version_number, ppm.style_name, ppm.finish_width_in_inch, 
                                                            (SELECT process_name FROM partial_test_for_test_result_info 
                                                            WHERE pp_number = ppm.pp_number and version_name = ppm.version_number and finish_width_in_inch = ppm.finish_width_in_inch AND style = apv.style_name
                                                            ORDER BY partial_test_for_test_result_id DESC LIMIT 1) as process_name
                                                            FROM pp_monitoring ppm
                                                            INNER JOIN adding_process_to_version apv ON ppm.pp_number = apv.pp_number AND ppm.version_number = apv.version_name 
                                                            AND ppm.style_name = apv.style_name AND ppm.finish_width_in_inch = apv.finish_width_in_inch
                                                            WHERE ppm.current_state = 'PP Completed' ORDER BY ppm.pp_monitoring_id DESC";

                                        $result_for_pp_state= mysqli_query($con,$sql_for_pp_state) or die(mysqli_error($con));
                                        $counter=1;
                                        while($row_for_pp_state=mysqli_fetch_assoc($result_for_pp_state))
                                        {
                                            $pp_number_monitoring = $row_for_pp_state['pp_number'];
                                            $version_number_monitoring = $row_for_pp_state['version_number'];
                                            $style_name_monitoring = $row_for_pp_state['style_name'];
                                            $finished_width_monitoring = $row_for_pp_state['finish_width_in_inch'];
                                            $process_name_monitoring = $row_for_pp_state['process_name'];

                                            // $process_step = $row_for_pp_state['current_status'];
                                            // $splitted_process_step = explode(' ',$process_step);
                                            //  $process_name_monitoring = $splitted_process_step[0];
                                       
                                             $sql_for_lab_approval_folding = "SELECT ptftri.partial_test_for_test_result_creation_date, ptftri.shift, ptftri.trf_id, ptftri.pp_number, 
                                                                        ptftri.week_in_year, ptftri.customer_id, ptftri.customer_name, ptftri.design, ptftri.version_id,ptftri.version_number, pwvci.style_name, pwvci.color, 
                                                                        pwvci.construction_name, ptftri.process_id, ptftri.process_name, ptftri.before_trolley_number_or_batcher_number, ptftri.after_trolley_number_or_batcher_number, 
                                                                        ptftri.finish_width_in_inch, ptftri.after_trolley_or_batcher_qty from partial_test_for_test_result_info ptftri
                                                                        INNER JOIN pp_wise_version_creation_info  pwvci on ptftri.pp_number=pwvci.pp_number and ptftri.version_id=pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                                                        WHERE ptftri.pp_number = '$pp_number_monitoring' and ptftri.process_name = '$process_name_monitoring' and ptftri.version_number = '$version_number_monitoring' and
                                                                        pwvci.style_name = '$style_name_monitoring' and ptftri.finish_width_in_inch = '$finished_width_monitoring'";
                                        
                                            $result_for_lab_approval_folding= mysqli_query($con,$sql_for_lab_approval_folding) or die(mysqli_error($con));
                                            // $row_for_lab_approval_folding=mysqli_fetch_array($result_for_lab_approval_folding);
                                    
                                            while($row_for_lab_approval_folding=mysqli_fetch_assoc($result_for_lab_approval_folding))
                                            {
                                    
                                                $partial_test_for_test_result_creation_date = $row_for_lab_approval_folding['partial_test_for_test_result_creation_date'];
                                                
                                                $shift = $row_for_lab_approval_folding['shift'];
                                                $trf_id = $row_for_lab_approval_folding['trf_id'];
                                                $pp_number = $row_for_lab_approval_folding['pp_number'];
                                                $week = $row_for_lab_approval_folding['week_in_year'];
                                                $customer_name = $row_for_lab_approval_folding['customer_name'];
                                                $design = $row_for_lab_approval_folding['design'];
                                                $version_number = $row_for_lab_approval_folding['version_number'];
                                                $style_name = $row_for_lab_approval_folding['style_name'];
                                                $color = $row_for_lab_approval_folding['color'];
                                                $construction_name = $row_for_lab_approval_folding['construction_name'];
                                                $process_id = $row_for_lab_approval_folding['process_id'];
                                                $process_name = $row_for_lab_approval_folding['process_name'];
                                                $before_trolley_number_or_batcher_number = $row_for_lab_approval_folding['before_trolley_number_or_batcher_number'];
                                                $after_trolley_number_or_batcher_number = $row_for_lab_approval_folding['after_trolley_number_or_batcher_number'];
                                                $finish_width_in_inch = $row_for_lab_approval_folding['finish_width_in_inch'];
                                                $after_trolley_or_batcher_qty = $row_for_lab_approval_folding['after_trolley_or_batcher_qty'];

                                                $sql_for_lab_approval_table = "SELECT * FROM inspection_and_folding_table_for_lab_approval where pp_number = '$pp_number' and 
                                                process_name = '$process_name_monitoring' and version_number = '$version_number' and finish_width = '$finish_width_in_inch' and style_name = '$style_name'
                                                and trolly_number = '$after_trolley_number_or_batcher_number'";

                                                $result_for_lab_approval_table = mysqli_query($con, $sql_for_lab_approval_table) or die(mysqli_error($con));
                                                $row_for_lab_approval_table = mysqli_fetch_assoc($result_for_lab_approval_table);
                                        
                                                //    $pp_number_for_inspection = $row_for_lab_approval_table['pp_number'];
                                                if($row_for_lab_approval_table == false)
                                                {
                                                    
                                                    $all_data = $partial_test_for_test_result_creation_date.'?fs?'.$shift.'?fs?'.$trf_id.'?fs?'.$pp_number.'?fs?'.$week.'?fs?'.$customer_name.'?fs?'.$design.'?fs?'.$version_number.'?fs?'.$style_name.'?fs?'.$color
                                                    .'?fs?'.$construction_name.'?fs?'.$process_name.'?fs?'.$before_trolley_number_or_batcher_number.'?fs?'.$after_trolley_number_or_batcher_number.'?fs?'.$finish_width_in_inch.'?fs?'.$after_trolley_or_batcher_qty;
                                                
                                                    ?>
                                    
                                                    <tr id="waiting_for_lab_approval_row_<?php echo $counter ?>">
                                                        <td style="border: 1px solid black"><?php echo date("d-M-Y", strtotime($partial_test_for_test_result_creation_date));?></td>
                                                        <td style="border: 1px solid black"><?php echo $shift?></td>
                                                        <td style="border: 1px solid black"><?php if($trf_id == 'select'){} else {echo $trf_id;}?></td>
                                                        <td style="border: 1px solid black"><?php echo $pp_number?></td>
                                                        <td style="border: 1px solid black"><?php echo $week?></td>
                                                        <td style="border: 1px solid black"><?php echo $customer_name?></td>
                                                        <td style="border: 1px solid black"><?php echo $design?></td>
                                                        <td style="border: 1px solid black"><?php echo $version_number?></td>
                                                        <td style="border: 1px solid black"><?php echo $style_name?></td>
                                                        <td style="border: 1px solid black"><?php echo $color?></td>
                                                        <td style="border: 1px solid black"><?php echo $construction_name?></td>
                                                        <td style="border: 1px solid black"><?php echo $process_name?></td>
                                                        <td style="border: 1px solid black"><?php echo $after_trolley_number_or_batcher_number?></td>
                                                        <td style="border: 1px solid black"><?php echo $finish_width_in_inch?></td>
                                                        <td style="border: 1px solid black"><?php echo $after_trolley_or_batcher_qty ?></td>
                                                        <td style="border: 1px solid black">
                                                        <!-- <label id="pass" name="pass" style="display: none; padding: 0; margin: 0;" >Pass</label>
                                                        <label id="fail" name="fail" style="display: none; padding: 0; margin: 0;" >Fail</label>-->

                                                    <div class="col-sm-11">
                                                    <?php
                                                    $trf_id_for_table=$row_for_lab_approval_folding['trf_id'];

                                                    $pp_number_for_table = $row_for_lab_approval_folding['pp_number'];

                                                    $customer_name_for_table = $row_for_lab_approval_folding['customer_name'];

                                                    $version_id_for_table = $row_for_lab_approval_folding['version_id'];

                                                    $version_number_for_table = $row_for_lab_approval_folding['version_number'];
                
                                                    $style_name_for_table = $row_for_lab_approval_folding['style_name'];
                
                                                    $process_id_for_table = $row_for_lab_approval_folding['process_id'];
                
                                                    $process_name_for_table = $row_for_lab_approval_folding['process_name'];
                
                                                    $before_trolley_number_or_batcher_number_for_table = $row_for_lab_approval_folding['before_trolley_number_or_batcher_number'];
                
                                                    $after_trolley_number_or_batcher_number_for_table = $row_for_lab_approval_folding['after_trolley_number_or_batcher_number'];
                
                                                    $finish_width_in_inch_for_table = $row_for_lab_approval_folding['finish_width_in_inch'];
                                            
                                                    $all_data_for_table = $trf_id_for_table.'?fs?'.$version_id_for_table.'?fs?'.$pp_number_for_table.'?fs?'.$process_id_for_table.'?fs?'.$process_name_for_table.'?fs?'.$style_name_for_table.'?fs?'.$finish_width_in_inch_for_table.'?fs?'.$before_trolley_number_or_batcher_number_for_table.'?fs?'.$after_trolley_number_or_batcher_number_for_table;

                                                    $sql_for_for_table = "SELECT * FROM partial_test_for_test_result_info ptftri 
                                                                        LEFT JOIN pp_wise_version_creation_info pwvci on ptftri.pp_number=pwvci.pp_number and ptftri.version_id=pwvci.version_id and 
                                                                        ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                                                        LEFT JOIN process_program_info ppi on ptftri.pp_number=ppi.pp_number 
                                                                        where ptftri.pp_number = '$pp_number_for_table' AND ptftri.version_number = '$version_number_for_table' AND ptftri.style = '$style_name_for_table' AND 
                                                                        ptftri.before_trolley_number_or_batcher_number = '$before_trolley_number_or_batcher_number_for_table' AND 
                                                                        ptftri.after_trolley_number_or_batcher_number = '$after_trolley_number_or_batcher_number_for_table' AND ptftri.finish_width_in_inch = '$finish_width_in_inch_for_table' AND 
                                                                        ptftri.process_id = '$process_id_for_table'";

                                                    $result_for_table= mysqli_query($con,$sql_for_for_table) or die(mysqli_error($con));
                                                    $row_for_table=mysqli_fetch_array($result_for_table);

                                                    $version_number=$row_for_table['version_number'];
                                                    $customer_name=$row_for_table['customer_name'];

                                                    $version_wise_process_id=$row_for_table['process_id'];  

                                                    $version_wise_process_name=$row_for_table['process_name'];  

                                                    // if($version_wise_process_name=='Calander' || $version_wise_process_name == 'Re-Calander' || $version_wise_process_name=='2nd-Re-Calander' || $version_wise_process_name == '3rd-Re-Calander' || $version_wise_process_name == '4th-Re-Calander')
                                                
                                                    if($version_wise_process_id == 'proc_18')                       // Sanforizing Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                        include('../report/pass_fail_report_for_sanforizing_process.php'); 
                                                    
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                                         
                                                            <?php
                                                            //echo "Pass"; 
                                                            echo "<script>$('#sanforizing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                          
                                                            <?php
                                                                //echo "Fail";
                                                            echo "<script>$('#sanforizing_table').hide();</script>";
                                                        }

                                                    }
                                                    else if($version_wise_process_id == 'proc_17')                      // Calendering Process
                                                    {    
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                        include('../report/pass_fail_report_for_calendering_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                                     
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#calender_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                                <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                    <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                                </a> 
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#calender_table').hide();</script>";
                                                        }

                                                    }
                                                    else if($version_wise_process_id == 'proc_16')                  // Finishing Process
                                                    {   
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];
                                                        include('../report/pass_fail_report_for_finishing_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_all_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                             
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#finishing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_all_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                          
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#finishing_table').hide();</script>";
                                                        }

                                                    } 
                                                    else if($version_wise_process_id == 'proc_23')                      // Dyeing-Finish
                                                    {   
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];
                                                        include('../report/pass_fail_report_for_dyeing_finish_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                             
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#dyeing_finish_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                          
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#dyeing_finish_table').hide();</script>";
                                                        }

                                                    }
                                                    else if($version_wise_process_id == 'proc_9')               // Curing Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_curing_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#curing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#curing_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_1')                       // Singeing & Desizing
                                                    {
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_singe_and_desize_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                                         
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#singeing_desizing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                          
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#singeing_desizing_table').hide();</script>";
                                                        }
                                                    }
                                                    else if($version_wise_process_id == 'proc_21')                       // Singeing Process
                                                    {
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                  
                                                        include('../report/pass_fail_report_for_singeing_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                                         
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#singeing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                          
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#singeing_table').hide();</script>";
                                                        }
                                                    }
                                                    else if($version_wise_process_id == 'proc_22')                       // Desizing Process
                                                    {
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                  
                                                        include('../report/pass_fail_report_for_desizing_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>                                                                         
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#desizing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                          
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#desizing_table').hide();</script>";
                                                        }
                                                    }
                                                    else if($version_wise_process_id == 'proc_2')           // Scouring Process
                                                    {
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_scouring_process.php'); 
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                                <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                    <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                                </a>                                                                <?php
                                                            // echo "Pass";
                                                                echo "<script>$('#scouring_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                                <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?customer_id=<?php echo $trf_id_for_table; ?>">
                                                                    <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                                </a>                                                              <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#scouring_table').hide();</script>";
                                                        }

                                                    }
                                                    else if($version_wise_process_id == 'proc_3')               // Bleaching Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_bleaching_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#bleaching_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#bleaching_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id=='proc_4')			//------------------------Scouring & Bleaching------------------------------
                                                    {
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                    

                                                        include('../report/pass_fail_report_for_scouring_bleaching_process.php'); 

                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#scouring_bleaching_table').hide();</script>";
                                                        }
                                                        else
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#scouring_bleaching_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_5')               // Ready For Mercerize Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_ready_for_mercerize_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#ready_for_mercerize_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#ready_for_mercerize_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_6')               // Mercerize Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_mercerize_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#mercerize_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#mercerize_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_7')               // Ready For Print Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_ready_for_printing_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#ready_for_print_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#ready_for_print_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_8')               // Printing Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_printing_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#printing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#printing_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_11')               // Ready For Dyeing Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_ready_for_dying_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#ready_for_dyeing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#ready_for_dyeing_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_13')               // Washing Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_washing_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#washing_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#washing_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_14')               // Ready For Raising Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_ready_for_raising_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#ready_for_raising_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#ready_for_raising_table').hide();</script>";
                                                        }    
                                                    }
                                                    else if($version_wise_process_id == 'proc_15')               // Raising Process
                                                    { 
                                                        $_GET['pp_number']=$row_for_table['pp_number']; 
                                                        $_GET['version_number']=$row_for_table['version_number']; 
                                                        $_GET['customer_name']=$row_for_table['customer_name']; 
                                                        $_GET['customer_id']=$row_for_lab_approval_folding['customer_id'];
                                                        $_GET['style']=$row_for_table['style']; 
                                                        $_GET['finish_width_in_inch']=$row_for_table['finish_width_in_inch'];
                                                        $_GET['before_trolley_number_or_batcher_number']=$row_for_table['before_trolley_number_or_batcher_number'];
                                                        $_GET['after_trolley_number_or_batcher_number']=$row_for_table['after_trolley_number_or_batcher_number'];   
                                                
                                                        include('../report/pass_fail_report_for_raising_process.php'); 
                                                        // echo $total_test;
                                                        if($total_test == $p)
                                                        {  
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Pass"; ?>">               
                                                            </a>
                                                            
                                                            <?php
                                                            // echo "Pass";
                                                            echo "<script>$('#raising_table').hide();</script>";
                                                        }
                                                        else
                                                        {   
                                                            ?>
                                                            <a href="report/pdf_file_for_pass_fail_report_for_partial_test.php?all_data=<?php echo urlencode($all_data_for_table); ?>" target="_blank">
                                                                <input type="button" class="btn btn-default" style="border: none;" id="test_result_for_trf_<?php echo $counter ?>" name="test_result_for_trf_<?php echo $counter ?>" value="<?php echo "Fail"; ?>">               
                                                            </a>                                                                
                                                            <?php
                                                            //echo "Fail";
                                                            echo "<script>$('#raising_table').hide();</script>";
                                                        }    
                                                    }
                                                    
                                                   
                                                        ?>
                                                    </div>   <!-- End of div -->   
                                            
                                                        </td>
                                                        <td style="border: 1px solid black">
                                                            
                                                            <input type="text" size="30" id="remark_for_lab_approval_<?php echo $counter ?>" name="remark_for_lab_approval_<?php echo $counter ?>">
                                                        </td>
                                                        <td style="border: 1px solid black"><?php echo $user_name?></td>
                                                        <td style="border: 1px solid black"><input type="button" class="btn btn-success" style="text-align: center" id="approved_check" name="approved" value="approved"  onclick="approved_for_folding('<?php echo $all_data; ?>', '<?php echo $counter; ?>')"></td>
                                                        <td style="border: 1px solid black"><input type="button" class="btn btn-primary" style="text-align: center" id="rework_check" name="rework" value="rework" onclick="rework_for_lab_approval('<?php echo $all_data; ?>', '<?php echo $counter; ?>')"> </td>
                                                    
                                                    </tr>
                                                    <script>
                                                        function approved_for_folding(all_data, counter)
                                                        {
                                                            //   alert(all_data);
                                                            var test_result = document.getElementById('test_result_for_trf_'+counter).value;
                                                            var remark_for_lab_approval = document.getElementById('remark_for_lab_approval_'+counter).value;
                                                            var inspection_status = 'inspection for folding';
                                                            //  alert(test_result);
                                                            //  exit();
                                                            if(test_result == 'Fail' && remark_for_lab_approval == '')
                                                            {
                                                                //alert('This is not possible to folding. Please try to process rework');
                                                                alert('Please enter remarks.');
                                                            }
                                                            else
                                                            {
                                                   
                                                                //var remark_for_lab_approval = document.getElementById('remark_for_lab_approval_'+counter).value;

                                                                $.ajax({
                                                                    url: 'inspection_and_folding/waiting_for_lab_approval_for_folding_saving.php',
                                                                    dataType: 'text',
                                                                    type: 'post',
                                                                    contentType: 'application/x-www-form-urlencoded',
                                                                    data: {
                                                                        all_data  :all_data,
                                                                        remark_for_lab_approval : remark_for_lab_approval,
                                                                        test_result : test_result,
                                                                        inspection_status : inspection_status
                                                                        // counter:counter
                                                                        },
                                                                        success: function( data, textStatus, jQxhr )
                                                                        {
                                                                                alert(data);
                                                                                // load_page('inspection_and_folding/waiting_for_lab_approval_for_folding.php');	 
                                                                                //$('waiting_for_lab_approval_row_<?php //echo $counter ?>').hide();
                                                                            
                                                                        },
                                                                        error: function( jqXhr, textStatus, errorThrown )
                                                                        {
                                                                                //console.log( errorThrown );
                                                                                alert(errorThrown);
                                                                        }
                                                                    }); // End of $.ajax({
                                                            }
                                              
                                                        }


                                                function rework_for_lab_approval(all_data, counter)
                                                {
                                                    var test_result = document.getElementById('test_result_for_trf_'+counter).value;
                                                        
                                                        //  if(test_result == 'Fail')
                                                        //   {
                                                    var remark_for_lab_approval = document.getElementById('remark_for_lab_approval_'+counter).value;
                                                    var inspection_status = 'inspection for rework';
                                                    // alert(remark_for_lab_approval);
                                                    // alert(counter);
                                                    // exit();
                                                    if(test_result == 'Fail' && remark_for_lab_approval == '')
                                                    {
                                                        //alert('This is not possible to folding. Please try to process rework');
                                                        alert('Please enter remarks.');
                                                    }
                                                    else
                                                    {
                                                
                                                        $.ajax({
                                                            url: 'inspection_and_folding/waiting_for_lab_approval_for_folding_saving.php',
                                                            dataType: 'text',
                                                            type: 'post',
                                                            contentType: 'application/x-www-form-urlencoded',
                                                            data: {
                                                                all_data  :all_data,
                                                                remark_for_lab_approval : remark_for_lab_approval,
                                                                test_result : test_result,
                                                                inspection_status : inspection_status
                                                                    // counter:counter
                                                                },
                                                            success: function( data, textStatus, jQxhr )
                                                                {
                                                                    alert(data);  
                                                                    // load_page('inspection_and_folding/waiting_for_lab_approval_for_folding.php');	 

                                                                },
                                                                error: function( jqXhr, textStatus, errorThrown )
                                                                {
                                                                        //console.log( errorThrown );
                                                                        alert(errorThrown);
                                                                }
                                                            }); // End of $.ajax({
                                                        
                                                    // }
                                                    //   else
                                                    //   {
                                                    //     alert('Please try to process folding approval');
                                                    //   } 
                                                }   
                                            }
                                            </script>
                                            <?php
                                            
                                            }     
                                        }
                                        //echo $counter;
                                     $counter++;  
                                
                            }
      
                                ?>
                            </tbody>
                        </table>
                </div>

                  <input type="hidden" name="counter" id="counter" value="<?php echo $counter ?>">
            </form>
        </div>  <!-- <div class="form-group form-group-sm" id="div_waiting_for_lab_approval_for_folding"> -->

        <div id="for_rework_div">
            <?php

          
            ?>
        </div>
                      
      </div>   	  <!-- <div class="panel panel-default" id="div_table">                       -->

</div>     <!-- <div class="col-sm-12 col-md-12 col-lg-12"> -->

                       


       <script>
                  $(document).ready(function() {
                       
                        var table = $('#datatable_for_waiting_for_lab_approval').DataTable( {
                            scrollY:        "500px",
                            scrollX:        true,
                            scrollCollapse: true,
                            paging:         false,
                            columnDefs: [
                                { width: '0%', targets: 0 }
                            ],
                            fixedColumns:   {
                                                leftColumns: 2,
                                                rightColumns: 1
                                            }

                        } );
                    } );
            </script>       
    