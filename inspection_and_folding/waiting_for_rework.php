<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("d-m-Y");
$all_data = $_POST['all_data'];
// echo $all_data;

$user_name=$_SESSION['user_name'];

        //  $sql_for_rework = "SELECT lab_appr.trf_no, lab_appr.pp_number, lab_appr.shift, lab_appr.week_in_year, lab_appr.customer_name,lab_appr.design_name,
        //  lab_appr.version_number, lab_appr.style_name, lab_appr.color, lab_appr.construction_name, ptftri.process_id, lab_appr.process_name,lab_appr.before_trolley_number, lab_appr.trolly_number, 
        //  lab_appr.finish_width, lab_appr.quantity, lab_appr.remarks, folding.inspection_report_status, folding.folding_quantity, lab_appr.recording_time, 
        //  folding.rejected_quantity, folding.reworkable_quantity 
        //  from inspection_and_folding_table_for_lab_approval as lab_appr 
        //  LEFT JOIN inspection_and_folding as folding on lab_appr.pp_number = folding.pp_number AND lab_appr.version_number = folding.version_number AND 
        //  lab_appr.finish_width = folding.finish_width AND lab_appr.trolly_number = folding.trolly_number
        //  LEFT JOIN partial_test_for_test_result_info AS ptftri ON lab_appr.pp_number = ptftri.pp_number AND lab_appr.version_number = ptftri.version_number AND 
        //  lab_appr.finish_width = ptftri.finish_width_in_inch AND lab_appr.trolly_number = ptftri.after_trolley_number_or_batcher_number
        //  where folding.reworkable_quantity != 0 OR lab_appr.inspection_status = 'inspection for rework'";

        $sql_for_rework = "SELECT lab_appr.trf_no, lab_appr.pp_number, lab_appr.shift, lab_appr.week_in_year, lab_appr.customer_name,lab_appr.design_name, 
        lab_appr.version_number, lab_appr.style_name, lab_appr.color, lab_appr.construction_name, ptftri.process_id, 
        lab_appr.process_name, lab_appr.before_trolley_number,lab_appr.trolly_number, lab_appr.finish_width, lab_appr.quantity, lab_appr.remarks, 
        folding.inspection_report_status, folding.folding_quantity, lab_appr.recording_time, folding.rejected_quantity, folding.reworkable_quantity,lab_appr.inspection_status
        from inspection_and_folding_table_for_lab_approval as lab_appr 
        LEFT JOIN inspection_and_folding as folding on lab_appr.pp_number = folding.pp_number AND lab_appr.version_number = folding.version_number AND 
        lab_appr.finish_width = folding.finish_width AND lab_appr.trolly_number = folding.trolly_number and lab_appr.before_trolley_number = folding.before_trolley_number
        LEFT JOIN partial_test_for_test_result_info AS ptftri ON lab_appr.pp_number = ptftri.pp_number AND lab_appr.version_number = ptftri.version_number 
        AND lab_appr.finish_width = ptftri.finish_width_in_inch AND lab_appr.trolly_number = ptftri.after_trolley_number_or_batcher_number 
        and lab_appr.before_trolley_number = ptftri.before_trolley_number_or_batcher_number 
        where lab_appr.inspection_status = 'inspection for rework'";

$result_for_rework= mysqli_query($con,$sql_for_rework) or die(mysqli_error($con));


?>
<div class="col-sm-12 col-md-12 col-lg-12">

<div class="panel panel-default" id="div_table">

<div class="form-group form-group-sm" id="div_waiting_for_rework">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_rework_form" id="waiting_for_rework_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Rework</td>
                        </tr>
                    </thead>
                </table>

                    <div id="overflow_for_waiting_for_lab_approval"> 
                        <table id="datatable_for_waiting_for_rework" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="font-weight: bold; border: 1px solid black">Date</th>    
                                <th style="font-weight: bold; border: 1px solid black">Shift</th>
                                <th style="font-weight: bold; border: 1px solid black">TRF No.</th>
                                <th style="font-weight: bold; border: 1px solid black">PP No.</th>
                                <th style="font-weight: bold; border: 1px solid black">Week</th>
                                <th style="font-weight: bold; border: 1px solid black">Customer</th>
                                <th style="font-weight: bold; border: 1px solid black">Design</th>
                                <th style="font-weight: bold; border: 1px solid black">Version</th>
                                <th style="font-weight: bold; border: 1px solid black">Style</th>
                                <th style="font-weight: bold; border: 1px solid black">Color</th>
                                <th style="font-weight: bold; border: 1px solid black">Construction</th>
                                <th style="font-weight: bold; border: 1px solid black">Process Step</th>
                                <th style="font-weight: bold; border: 1px solid black">Trolly</th>
                                <th style="font-weight: bold; border: 1px solid black">Finish Width (Inch)</th>
                                <th style="font-weight: bold; border: 1px solid black">Quantity (mtr.)</th>
                                <th style="font-weight: bold; border: 1px solid black">Authorized By</th>
                                <th style="font-weight: bold; border: 1px solid black">Reason of Rework</th>
                                <!-- <th colspan="2" style="font-weight: bold; border: 1px solid black" style="text-align: center;">Action</th> -->
                                <th style="font-weight: bold; border: 1px solid black">Confirm Action</th>
                                <th style="font-weight: bold; border: 1px solid black">Status</th>
                            </tr>
                            <!-- <tr>
                                
                                
                                <th style="font-weight: bold; border: 1px solid black">Corrective Action</th>
                            </tr> -->
                            </thead>

                            <tbody>
                               
                                    <?php
                                    $counter = 1;
                                    while($row_for_rework=mysqli_fetch_array($result_for_rework))
                                    {
                                        $folding_date = $row_for_rework['recording_time'];

                                        $new_folding_date = date('d-m-Y',strtotime($folding_date));
                                        $new_folding_time = date('h:i:s A',strtotime($folding_date));

                                        $new_folding_hour = date('H',strtotime($folding_date));

                                        if($new_folding_hour>= 6 && $new_folding_hour<14)
                                        {
                                            $shift = 'A';
                                        }
                                        else if($new_folding_hour>= 14 && $new_folding_hour<22)
                                        {
                                            $shift = 'B';
                                        }
                                        else
                                        {
                                            $shift = 'C';
                                        }

                                        // $shift = $row_for_rework['shift'];
                                        $trf_id = $row_for_rework['trf_no'];
                                        $pp_number = $row_for_rework['pp_number'];
                                        $week = $row_for_rework['week_in_year'];
                                        $customer_name = $row_for_rework['customer_name'];
                                        $design = $row_for_rework['design_name'];
                                        $version_number = $row_for_rework['version_number'];
                                        $style_name = $row_for_rework['style_name'];
                                        $color = $row_for_rework['color'];
                                        $construction_name = $row_for_rework['construction_name'];
                                        $process_id = $row_for_rework['process_id'];
                                        $process_name = $row_for_rework['process_name'];
                                        $before_trolley_number = $row_for_rework['before_trolley_number'];
                                        $trolly_number = $row_for_rework['trolly_number'];
                                        $finish_width = $row_for_rework['finish_width'];
                                        $quantity = $row_for_rework['quantity'];
                                       
                                        $reworkable_quantity = $row_for_rework['reworkable_quantity'];
                                        $remarks_for_lab_approval = $row_for_rework['remarks'];
                                        $all_data = $new_folding_date.'?fs?'.$shift.'?fs?'.$trf_id.'?fs?'.$pp_number.'?fs?'.$week.'?fs?'.$customer_name.'?fs?'.$design.'?fs?'.$version_number.'?fs?'.$style_name.'?fs?'.$color
                                        .'?fs?'.$construction_name.'?fs?'.$process_name.'?fs?'.$before_trolley_number.'?fs?'.$trolly_number.'?fs?'.$finish_width.'?fs?'.$quantity.'?fs?'.$reworkable_quantity;
                                    

                                        $sql_for_version = "SELECT DISTINCT version_id, version_name from adding_process_to_version where version_name = '$version_number' and pp_number = '$pp_number' and finish_width_in_inch = '$finish_width'";
                                        $result_for_version= mysqli_query($con,$sql_for_version) or die(mysqli_error($con));
                                        $row_for_version=mysqli_fetch_array($result_for_version);
                                        $version_id = $row_for_version['version_id'];
                                        $version_name = $row_for_version['version_name'];

                                        
                                        $update_value = $pp_number.'?fs?'.$version_id.'?fs?'.$version_name.'?fs?'.$color.'?fs?'.$finish_width;
                                      
                                        ?>
                                       
                                        <tr id="row_for_rework_table_<?php echo $counter ?>">
                                            <td style="border: 1px solid black"><?php echo date("d-M-Y", strtotime($new_folding_date)); ?></td>
                                            <td style="border: 1px solid black"><?php echo $shift ?></td>
                                            <td style="border: 1px solid black"><?php if($trf_id == 'select' || $trf_id == '') {echo ' ';} else {echo $trf_id;} ?></td>
                                            <td style="border: 1px solid black"><?php echo $pp_number ?></td>
                                            <td style="border: 1px solid black"><?php echo $week ?></td>
                                            <td style="border: 1px solid black"><?php echo $customer_name ?></td>
                                            <td style="border: 1px solid black"><?php echo $design ?></td>
                                            <td style="border: 1px solid black"><?php echo $version_number ?></td>
                                            <td style="border: 1px solid black"><?php echo $style_name ?></td>
                                            <td style="border: 1px solid black"><?php echo $color ?></td>
                                            <td style="border: 1px solid black"><?php echo $construction_name ?></td>
                                            <td style="border: 1px solid black"><?php echo $process_name ?></td>
                                            <td style="border: 1px solid black"><?php echo $trolly_number ?></td>
                                            <td style="border: 1px solid black"><?php echo $finish_width ?></td>
                                            <td style="border: 1px solid black"><?php if($reworkable_quantity != '') {echo $reworkable_quantity;} else {echo $quantity;}  ?></td>
                                            <td style="border: 1px solid black"><?php echo $user_name ?></td>

                                            <td style="border: 1px solid black"><input type="text" size="30" id="reason_of_rework_<?php echo $counter ?>" name="reason_of_rework_<?php echo $counter ?>" value="<?php echo $remarks_for_lab_approval ?>"></td>
                                            <!-- <td style="border: 1px solid black"><select name="corrective_action_<?php echo $counter ?>" id="corrective_action_<?php echo $counter ?>">
                                            <option select="selected" value="">Select Process Name</option>
                                                <?php 
                                                    // $sql = "SELECT DISTINCT ptftri.process_name from adding_process_to_version as apv
                                                    // INNER JOIN partial_test_for_test_result_info as ptftri ON apv.pp_number = ptftri.pp_number AND apv.version_name = ptftri.version_number
                                                    // WHERE ptftri.pp_number = '$pp_number' AND ptftri.version_number = '$version_number'";

                                                    // $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                    // while( $row = mysqli_fetch_array( $result))
                                                    // {

                                                    //     // $trf_id=$row['trf_id'];
                                                    //     // $process_id=$row['process_id'];
                                                    //     $process_name=$row['process_name'];
                                                       
                                                    //     echo '<option value="'.$process_name.'">'.$process_name.'</option>';
                                                
                                                    // }
                                             ?>
                                            </select></td> -->
                                            <!-- <td><input type="button" class="btn btn-primary" style="border: none;" id="corrective_action_<?php echo $counter ?>" name="corrective_action_<?php echo $counter ?>" value=""></td> -->
                                                                                   
                                            <td style="border: 1px solid black">
                                                <input type="button" class="btn btn-success" style="text-align: center" id="rework_btn_<?php echo $counter ?>" name="rework_btn_<?php echo $counter ?>" value="rework"  onclick="sending_data_into_database_for_rework('<?php echo $all_data; ?>','<?php echo $update_value;?>', '<?php echo $counter; ?>')">
                                            </td>
                                            <td style="border: 1px solid black">
                                                    <?php
                                                        

                                                       $sql_for_reprocess_added_in_process_route = "SELECT * FROM adding_process_to_version 
                                                                                                    WHERE pp_number = '$pp_number' AND version_id = '$version_id' AND color = '$color' AND finish_width_in_inch = '$finish_width' AND process_id = '$process_id' 
                                                                                                    AND (process_or_reprocess = 're-process' OR process_or_reprocess = '2nd-Re-Process' OR process_or_reprocess = '3rd-Re-Process' OR process_or_reprocess = '4th-Re-Process')";
                                                                                                    $result_for_reprocess_added_in_process_route= mysqli_query($con,$sql_for_reprocess_added_in_process_route) or die(mysqli_error($con));
                                                        
                                                        $row_for_reprocess_added_in_process_route = mysqli_fetch_assoc($result_for_reprocess_added_in_process_route);
                                                        $re_process_name = $row_for_reprocess_added_in_process_route['process_name'];

                                                        $sql_for_trf_submission = "SELECT * FROM partial_test_for_trf_info 
                                                                                    WHERE pp_number = '$pp_number' AND version_id = '$version_id' AND finish_width_in_inch = '$finish_width' AND process_name = '$re_process_name' and style = '$style_name'";
                                                                                    $result_for_trf_submission= mysqli_query($con,$sql_for_trf_submission) or die(mysqli_error($con));
                                                                                    $row_for_trf_submission = mysqli_fetch_assoc($result_for_trf_submission);
                                                                                    $trf_id_for_re_process = $row_for_trf_submission['trf_id'];

                                                        $sql_for_lab_approval = "SELECT * FROM partial_test_for_test_result_info 
                                                                                    WHERE pp_number = '$pp_number' AND version_id = '$version_id' AND finish_width_in_inch = '$finish_width' AND process_name = '$re_process_name' and style = '$style_name'";
                                                                                    $result_for_lab_approval= mysqli_query($con,$sql_for_lab_approval) or die(mysqli_error($con));
                                                                                    $row_for_lab_approval = mysqli_fetch_assoc($result_for_lab_approval);

                                                        
                                                        if($row_for_lab_approval)
                                                        {
                                                            ?>
                                                            <input type="text" style="border: none;" size="30" id="status_for_rework_<?php echo $counter ?>" name="status_for_rework_<?php echo $counter ?>" value="Waiting for lab approval for folding" readonly>
                                                           <?php //echo "Waiting for lab approval for folding";
                                                          
                                                        }
                                                        else if($row_for_trf_submission)
                                                        {
                                                            ?>
                                                            <input type="text" style="border: none;" size="30" id="status_for_rework_<?php echo $counter ?>" name="status_for_rework_<?php echo $counter ?>" value="TRF Submitted for Process Name" readonly>
                                                           <?php
                                                            //echo "TRF Submitted for Process Name";
                                                        }
                                                        else if($row_for_reprocess_added_in_process_route)
                                                        {
                                                            ?>
                                                            <input type="text" style="border: none;" size="30" id="status_for_rework_<?php echo $counter ?>" name="status_for_rework_<?php echo $counter ?>" value="Reprocess Added in Process Route" readonly>
                                                           <?php
                                                           // echo "Reprocess Added in Process Route";
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <input type="text" style="border: none;" size="30" id="status_for_rework_<?php echo $counter ?>" name="status_for_rework_<?php echo $counter ?>" value="Process for Rework" readonly>
                                                           <?php
                                                            //echo "Process for Rework";
                                                        }
                                                        

                                                    ?>
                                            </td>
                                        </tr>
                                        
                                        <script>
                                                         
                                                function sending_data_into_database_for_rework(all_data, update_value, counter)
                                                    {
                                              
                                                        var reason_of_rework = document.getElementById('reason_of_rework_'+counter).value;
                                                       var status_for_rework = document.getElementById('status_for_rework_'+counter).value;
                                                       
                                                        // alert(update_value);
                                                        // exit();
                                                        $.ajax({
                                                            url: 'inspection_and_folding/waiting_for_rework_saving.php',
                                                            dataType: 'text',
                                                            type: 'post',
                                                            contentType: 'application/x-www-form-urlencoded',
                                                            data: {
                                                                all_data  : all_data,
                                                                reason_of_rework : reason_of_rework,
                                                                 status_for_rework : status_for_rework
                                                                
                                                                },
                                                            success: function( data, textStatus, jQxhr )
                                                            {
                                                                    alert(data); 
                                                                  
                                                                   $('#for_rework_div').load('process_program/edit_version_wise_process_info.php?update_value=' + encodeURIComponent(update_value));
                                                                  
                                                            },
                                                            error: function( jqXhr, textStatus, errorThrown)
                                                            {
                                                                    //console.log( errorThrown );
                                                                    alert(errorThrown);
                                                            }
                                                        }); // End of $.ajax({
                                                       
                                                    }
                                        
                                        </script>


                                    <?php
                                        
                             
                                    $counter++;
                                    }
                                    ?>
                            </tbody>
                        </table>
                </div>
            </form>
        </div>

        <div id="for_rework_div">
            
        </div>

  </div>  <!-- End of <div class="panel panel-default"> -->

</div>

       <script>
                  $(document).ready(function() {
                       
                        var table = $('#datatable_for_waiting_for_rework').DataTable( {
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
   