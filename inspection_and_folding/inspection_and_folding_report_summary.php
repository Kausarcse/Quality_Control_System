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
  
    function filtering_customer_from_pp_number(pp_number)
    {
        
       // alert(pp_number);

        $.ajax({
                url: 'inspection_and_folding/returning_data_from_filtering_pp_number_for_folding.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {pp_number : pp_number},
                      
                success: function( data, textStatus, jQxhr )
                {       
                      
                    //  alert(data);
                     var splitted_data= data.split('?fs?');
                     var customer_name = splitted_data[0];
                     var week = splitted_data[1];
                    // alert(customer_name);
                    // alert(week);
                    document.getElementById('folding_customer').value=customer_name;
                    document.getElementById('folding_week').value=week;

                    
                    
                },
                error: function( jqXhr, textStatus, errorThrown )
                {       
                    //console.log( errorThrown );
                    alert(errorThrown);
                }
            }); // End of $.ajax({
    
    }

    


    function get_inspection_and_folding_summary_for_filtering()
    {
        
        var folding_date = document.getElementById('folding_date').value;
        var folding_pp_number = document.getElementById('folding_pp_number').value;
        var folding_customer = document.getElementById('folding_customer').value;
        var folding_week = document.getElementById('folding_week').value;

      // alert(folding_date);
    //   alert(folding_pp_number);
    //   alert(folding_customer);
    //   alert(folding_week);

                  $.ajax({
                         url: 'inspection_and_folding/inspection_and_folding_report_summarry_filtering.php',
                         dataType: 'text',
                         type: 'post',
                         contentType: 'application/x-www-form-urlencoded',
                         data: {
                             folding_date : folding_date,
                             folding_pp_number : folding_pp_number,
                             folding_customer : folding_customer,
                             folding_week : folding_week
                        },
                         success: function( data, textStatus, jQxhr )
                         {
                                var splitted_data_for_filter = data.split('?fs?');
                                var table_data = splitted_data_for_filter[0];
                                var quantity_data = splitted_data_for_filter[1];

                                 //alert(data);
     
                                document.getElementById('data_table').style.display="none";
                               
                                document.getElementById('data_table_for_filtering').innerHTML=table_data;

                                document.getElementById('total_quantity_data').style.display="none";
                               
                                document.getElementById('total_quantity_data_for_filtering').innerHTML=quantity_data;
                                //   scripting_table();
                                 
                         },
                         error: function( jqXhr, textStatus, errorThrown )
                         {
                                 //console.log( errorThrown );
                                 alert(errorThrown);
                         }
                  }); // End of $.ajax({
     

    }
</script>


<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default" id="div_table">

        <div class="form-group form-group-sm" id="div_inspection_and_folding_summary">
      
            <form class="form-horizontal" action="" method="POST" name="inspection_and_folding_summary_form" id="inspection_and_folding_summary_form">
                <table class="table table-bordered">
                    <thead>
                        <!-- <tr>
                           
                            <td style="text-align: center; font-size: 40px; color: black; font-weight: bold; border: 1px solid">
                            <img src="img/ZnZ.jpg" style="width: 50px; height:50px; margin-bottom: 4px; background: #ffffff;" class="img-rounded"/>
                            Zaber & Zubair Fabrics Ltd. <br> <p style="font-size: 15px;">Pagar, Tongi, Gazipur</p>                            
                        </td>
                        </tr> -->
                        <tr>
                            <td colspan="9" style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                               Daily Inspection and Folding Summary
                            </td>
                        </tr>
                    </thead>
                </table>


                <div id="inspection_folding_filtering">
                    <div class="form-group form-group-sm" id="inspection_folding_filtering_date" style="margin-right:0px; color:#00008B;">
                        <label class="control-label col-sm-4" for="date">Date : </label>
                        <div class="col-sm-3" style="padding-right: 0">
                                <input type="date" class="form-control" id="folding_date" name="folding_date"> 
                            </div>
                    </div>

                    <script>
                        //   $( function() {
                        //     //$( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
                        //     $( "#folding_date" ).datepicker({ dateFormat: 'dd-mm-yy'});
                        //   } );
                    </script>

                    <div class="form-group form-group-sm" id="inspection_folding_filtering_pp_number" style="margin-right:0px; color:#00008B;">
                        <label class="control-label col-sm-4" for="date">PP Number : </label>
                        <div class="col-sm-3" style="padding-right: 0">
                                <!-- <input type="text" class="form-control" id="folding_pp_number" name="folding_pp_number">  -->
                                <select class="form-control" id="folding_pp_number" name="folding_pp_number" onchange="filtering_customer_from_pp_number(this.value)">
                                    <option select="selected" value="select">Select pp number</option>
                                    <?php 
                                          $sql_for_pp_number = "SELECT distinct pp_number FROM inspection_and_folding";

                                          $result_for_pp_number = mysqli_query($con, $sql_for_pp_number) or die(mysqli_error($con));
              
                                          while($row_for_pp_number = mysqli_fetch_assoc($result_for_pp_number))
                                              {
                                              echo '<option value="'.$row_for_pp_number['pp_number'].'">'.$row_for_pp_number['pp_number'].'</option>';
                                                }
                                     ?>
                                </select>

                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="inspection_folding_filtering_customer" style="margin-right:0px; color:#00008B;">
                        <label class="control-label col-sm-4" for="date">Customer : </label>
                        <div class="col-sm-3" style="padding-right: 0">
                                <input type="text" class="form-control" id="folding_customer" name="folding_customer" readonly> 
                            </div>
                    </div>

                    <div class="form-group form-group-sm" id="inspection_folding_filtering_week" style="margin-right:0px; color:#00008B;">
                        <label class="control-label col-sm-4" for="date">Week : </label>
                        <div class="col-sm-3" style="padding-right: 0">
                                <input type="text" class="form-control" id="folding_week" name="folding_week" readonly> 
                            </div>
                    </div>

                    <div class="col-sm-12" style="float: center; padding-top: 5px;">
                        <button name="submit" type="button" class="btn btn-info" onclick="get_inspection_and_folding_summary_for_filtering()">Filter</button> 
                    </div>

               </div>

               

                <div id="div_inspection_and_folding_details" >
                <table class="table table-bordered" style="display: none;">
                    <thead>
                        <tr>
                            <td colspan="9" style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                               Daily Inspection and Folding Summary
                            </td>
                        </tr>
                    </thead>
                </table>
                
                <table id="datatable-buttons" class="table table-hover table-bordered">
                        <thead>
                           
                                    <tr>
                                    <th style="font-weight: bold; border: 1px solid black">Delivery Date</th>
                                    <th style="font-weight: bold; border: 1px solid black">Customer</th>
                                    <th style="font-weight: bold; border: 1px solid black">PP Number</th>
                                    <th style="font-weight: bold; border: 1px solid black">Week</th>
                                    <th style="font-weight: bold; border: 1px solid black">Design</th>
                                    <th style="font-weight: bold; border: 1px solid black">Version</th>
                                    <th style="font-weight: bold; border: 1px solid black">Style</th>
                                    <th style="font-weight: bold; border: 1px solid black">Color</th>
                                    <th style="font-weight: bold; border: 1px solid black">Construction</th>
                                    <th style="font-weight: bold; border: 1px solid black">Final Process</th>
                                    <th style="font-weight: bold; border: 1px solid black">Finish Width (Inch)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Trolly number</th>
                                    <th style="font-weight: bold; border: 1px solid black">Final Process Qty (mtr.)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Inspection Report</th>
                                    <th style="font-weight: bold; border: 1px solid black">Returing Quantity (mtr.)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Rejection Quantity (mtr.)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Deliverable Folding Quantity (mtr.)</th>
                                    <th style="font-weight: bold; border: 1px solid black">Remarks</th>
                                   
                                </tr>

                            
                        </thead>
                        <tbody id="data_table">
                        <?php
                            $final_process_quantity = 0;
                            $reworkable_quantity = 0;
                            $rejected_quantity = 0;
                            $folding_quantity = 0;

                            $sql_for_folding = "SELECT * FROM inspection_and_folding order by folding_id desc";

                            $result_for_folding = mysqli_query($con, $sql_for_folding) or die(mysqli_error($con));

                            while($row_for_folding = mysqli_fetch_assoc($result_for_folding))
                                {
                        ?>
                            <tr>
                                <td style="border: 1px solid black"><?php echo date("d-M-Y", strtotime($row_for_folding['recording_time']));?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['customer_name'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['pp_number'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['week_in_year'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['design_name'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['version_number'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['style_name'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['color'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['construction_name'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['process_name'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['finish_width'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['trolly_number'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['quantity'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['inspection_report_status'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['reworkable_quantity'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['rejected_quantity'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['folding_quantity'] ?></td>
                                <td style="border: 1px solid black"><?php echo $row_for_folding['remarks'] ?></td>
                               
                            </tr>
                            
                        <?php
                            $final_process_quantity += $row_for_folding['quantity'];
                            $reworkable_quantity += $row_for_folding['reworkable_quantity'];
                            $rejected_quantity += $row_for_folding['rejected_quantity'];
                            $folding_quantity += $row_for_folding['folding_quantity'];
                            }
                        ?>
                           
                        </tbody>
                        <tbody id="data_table_for_filtering">

                        </tbody>

                        <tr id="total_quantity_data">
                              
                                <td colspan="12" style="border: 1px solid black; text-align:right; font-weight: bold;">Total Quantity : </td>
                                <td style="border: 1px solid black"><?php echo $final_process_quantity; ?></td>
                                <td style="border: 1px solid black"></td>
                                <td style="border: 1px solid black"><?php echo $reworkable_quantity; ?></td>
                                <td style="border: 1px solid black"><?php echo $rejected_quantity; ?></td>
                                <td style="border: 1px solid black"><?php echo $folding_quantity; ?></td>
                                <td style="border: 1px solid black"></td>
                            
                            </tr>
                            <tr id="total_quantity_data_for_filtering">

                            </tr>
                    </table>

                </div>
               
            </form>   <!-- End of form for name="inspection_and_folding_summary_form" --> 
            
           
        </div>      <!--End of div for id="div_inspection_and_folding_summary" -->

        <div class="col-sm-6">
        <button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export to excel</a></button>

                </div>

    </div>          <!-- class="panel panel-default" id="div_table" -->

</div>              <!-- class="col-sm-12 col-md-12 col-lg-12" -->

<script>
                  $(document).ready(function() {
                       
                        var table = $('#datatable-buttons').DataTable( {
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



function exportF(elem) {
    var table = document.getElementById("div_inspection_and_folding_details");
    var html = table.innerHTML;
    var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
    elem.setAttribute("href", url);
    elem.setAttribute("download", "inspection_and_folding_summary.xls"); // Choose the file name
    return false;
}
</script>