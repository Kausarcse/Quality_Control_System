<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("d-m-Y");


$user_name=$_SESSION['user_name'];

    $sql_for_folding = "SELECT DISTINCT lab_appr.trf_no, lab_appr.pp_number, lab_appr.shift, lab_appr.week_in_year, lab_appr.customer_name,lab_appr.design_name,lab_appr.version_number, 
                            lab_appr.style_name, lab_appr.color, lab_appr.construction_name, lab_appr.process_name, lab_appr.before_trolley_number, lab_appr.trolly_number, 
                            lab_appr.finish_width, lab_appr.quantity, lab_appr.test_status, lab_appr.remarks, lab_appr.recording_time, lab_appr.lab_approval_id, 
                            folding.folding_quantity 
                            from inspection_and_folding_table_for_lab_approval as lab_appr 
                            left JOIN inspection_and_folding as folding on lab_appr.pp_number = folding.pp_number and lab_appr.version_number = folding.version_number and 
                            lab_appr.style_name = folding.style_name AND lab_appr.finish_width = folding.finish_width AND lab_appr.trolly_number = folding.trolly_number 
                            where lab_appr.inspection_status = 'inspection for folding'
                            order by lab_appr.lab_approval_id desc";

$result_for_folding= mysqli_query($con,$sql_for_folding) or die(mysqli_error($con));


?>
<div class="col-sm-12 col-md-12 col-lg-12">

<div class="panel panel-default" id="div_table">

<div class="form-group form-group-sm" id="div_waiting_for_inspection_and_folding">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_inspection_and_folding_form" id="waiting_for_inspection_and_folding_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Folding and Inspection</td>
                        </tr>
                    </thead>
                </table>

                    <div id="overflow_for_waiting_for_lab_approval"> 
                        <table id="datatable_for_waiting_for_inspection_and_folding" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Approval Date</th>  
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Approval Time</th>      
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
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">After Trolley/Batcher</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Finish Width (Inch)</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black"> Inspection & Folding Quantity (mtr.)</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Authorized By</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Inspection Report Status</th>
                                <th colspan="3" style="font-weight: bold; border: 1px solid black; text-align: center;">Action</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Remarks</th>
                                <th rowspan="2" style="font-weight: bold; border: 1px solid black">Confirm Action</th>
                            </tr>
                            <tr>
                                
                                <th style="font-weight: bold; border: 1px solid black">Deliverable Folding Quantity (mtr.) </th>
                                <th style="font-weight: bold; border: 1px solid black">Rejected Quantity (mtr.)</th>
                                <th style="font-weight: bold; border: 1px solid black">Reworkable  Quantity (mtr.)</th>
                            </tr>
                            </thead>

                            <tbody>
                               
                                    <?php
                                    $counter = 1;
                                    while($row_for_folding=mysqli_fetch_array($result_for_folding))
                                    {
                                        $lab_approval_date_time = $row_for_folding['recording_time'];
                                        $lab_approval_date = date('d-m-Y',strtotime($lab_approval_date_time));
                                        $lab_approval_time = date('h:i:s A',strtotime($lab_approval_date_time));

                                        $lab_approval_hour = date('H',strtotime($lab_approval_date_time));

                                        if($lab_approval_hour>= 6 && $lab_approval_hour<14)
                                        {
                                            $shift = 'A';
                                        }
                                        else if($lab_approval_hour>= 14 && $lab_approval_hour<22)
                                        {
                                            $shift = 'B';
                                        }
                                        else
                                        {
                                            $shift = 'C';
                                        }

                                        // $shift = $row_for_folding['shift'];
                                        $trf_id = $row_for_folding['trf_no'];
                                        $pp_number = $row_for_folding['pp_number'];
                                        $week = $row_for_folding['week_in_year'];
                                        $customer_name = $row_for_folding['customer_name'];
                                        $design = $row_for_folding['design_name'];
                                        $version_number = $row_for_folding['version_number'];
                                        $style_name = $row_for_folding['style_name'];
                                        $color = $row_for_folding['color'];
                                        $construction_name = $row_for_folding['construction_name'];
                                        $process_name = $row_for_folding['process_name'];
                                        $before_trolley_number = $row_for_folding['before_trolley_number'];
                                        $trolly_number = $row_for_folding['trolly_number'];
                                        $finish_width = $row_for_folding['finish_width'];
                                        $quantity = $row_for_folding['quantity'];
                                        $lab_approval_remarks = $row_for_folding['remarks'];
                                         $folding_quantity = $row_for_folding['folding_quantity'];
                                            
                                        $all_data = $lab_approval_date.'?fs?'.$shift.'?fs?'.$trf_id.'?fs?'.$pp_number.'?fs?'.$week.'?fs?'.$customer_name.'?fs?'.$design.'?fs?'.$version_number.'?fs?'.$style_name.'?fs?'.$color
                                        .'?fs?'.$construction_name.'?fs?'.$process_name.'?fs?'.$before_trolley_number.'?fs?'.$trolly_number.'?fs?'.$finish_width.'?fs?'.$quantity;
                                    
                                        if($folding_quantity == '')
                                        {
                                        
                                        ?>
                                        <tr id="row_for_folding_table_<?php echo $counter ?>">
                                            <td style="border: 1px solid black"><?php echo date("d-M-Y", strtotime($lab_approval_date)); ?></td>
                                            <td style="border: 1px solid black"><?php echo $lab_approval_time ?></td>
                                            <td style="border: 1px solid black"><?php echo $shift ?></td>
                                            <td style="border: 1px solid black"><?php if($trf_id == 'select'){} else {echo $trf_id;} ?></td>
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
                                            <td style="border: 1px solid black"><?php echo $quantity ?></td>
                                            <td style="border: 1px solid black"><?php echo $user_name ?></td>

                                            <td style="border: 1px solid black"><input type="text" size="10" id="inspection_report_for_folding_<?php echo $counter ?>" name="inspection_report_for_folding_<?php echo $counter ?>"></td>
                                            <td style="border: 1px solid black"><input type="text" size="10" id="folding_quantity_<?php echo $counter ?>" name="folding_quantity_<?php echo $counter ?>"></td>
                                            <td style="border: 1px solid black"><input type="text" size="10" id="rejacted_quantity_<?php echo $counter ?>" name="rejacted_quantity_<?php echo $counter ?>"></td>
                                            <td style="border: 1px solid black"><input type="text" size="10" id="reworkable_quantity_<?php echo $counter ?>" name="reworkable_quantity_<?php echo $counter ?>"></td>
                                        
                                            <td style="border: 1px solid black"><input type="text" size="30" id="remark_for_folding_<?php echo $counter ?>" name="remark_for_folding_<?php echo $counter ?>" value="<?php echo $lab_approval_remarks ?>"></td>
                                           
                                            <td style="border: 1px solid black"><input type="button" class="btn btn-success" style="text-align: center" id="approved_btn_<?php echo $counter ?>" name="approved_btn" value="approved"  onclick="sending_data_into_database_for_folding('<?php echo $all_data; ?>', '<?php echo $counter; ?>')"></td>
                                                <!-- <button type="button" class="btn btn-primary" onClick="for_rework()">Rework</button> -->
                                              
                                        </tr>
                                        
                                        <script>
                                           // $('#approved_btn_<?php //echo $counter ?>').on('click', function(){
                                                         
                                                function sending_data_into_database_for_folding(all_data, counter)
                                                    {
                                              
                                                        var inspection_report_for_folding = document.getElementById('inspection_report_for_folding_'+counter).value;
                                                        var folding_quantity = document.getElementById('folding_quantity_'+counter).value;
                                                        var rejected_quantity = document.getElementById('rejacted_quantity_'+counter).value;
                                                        var reworkable_quantity = document.getElementById('reworkable_quantity_'+counter).value;
                                                        var remark_for_folding = document.getElementById('remark_for_folding_'+counter).value;
                                                       
                                              
                                                        $.ajax({
                                                            url: 'inspection_and_folding/waiting_for_inspection_and_folding_saving.php',
                                                            dataType: 'text',
                                                            type: 'post',
                                                            contentType: 'application/x-www-form-urlencoded',
                                                            data: {
                                                                all_data  : all_data,
                                                                inspection_report_for_folding : inspection_report_for_folding,
                                                                folding_quantity : folding_quantity,
                                                                rejected_quantity : rejected_quantity,
                                                                reworkable_quantity : reworkable_quantity,
                                                                remark_for_folding : remark_for_folding
                                                                // counter:counter
                                                                },
                                                            success: function( data, textStatus, jQxhr )
                                                            {
                                                                    alert(data); 
                                                                    // load_page('inspection_and_folding/waiting_for_inspection_and_folding.php');	 

                                                            },
                                                            error: function( jqXhr, textStatus, errorThrown )
                                                            {
                                                                    //console.log( errorThrown );
                                                                    alert(errorThrown);
                                                            }
                                                        }); // End of $.ajax({
                                                    }
                                                    
                                                   //$('#row_for_folding_table_<?php //echo $counter ?>').hide();  
                                          //  });
                                           
                                            
                                        </script>


                                    <?php
                                        
                                    }
                                    $counter++;
                                    }
                                    ?>
                            </tbody>
                        </table>
                </div>
            </form>
        </div>

  </div>  <!-- End of <div class="panel panel-default"> -->

</div>

       <script>
                  $(document).ready(function() {
                       
                        var table = $('#datatable_for_waiting_for_inspection_and_folding').DataTable( {
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
   