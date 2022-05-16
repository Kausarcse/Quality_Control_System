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

<script>

function sending_data_for_inspection_and_folding_delete(inspection_folding_id)
 {
      
       var url_encoded_form_data = 'inspection_folding_id='+inspection_folding_id;
       
         $.ajax({
          url: 'inspection_and_folding/deleting_inspection_and_folding_info.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: url_encoded_form_data,
          success: function( data, textStatus, jQxhr )
          {
              alert(data);
              $("#div_full_page_for_folding").load("inspection_and_folding/inspection_and_folding_report.php");
          },
          error: function( jqXhr, textStatus, errorThrown )
          {
              //console.log( errorThrown );
              alert(errorThrown);
          }
       }); // End of $.ajax({

 }//End of function sending_data_for_inspection_and_folding_delete()


 function inspection_for_folding_rework(rework_info)
    {
        // var returing_quantity = returing_quantity;
        
        var splitted_data = rework_info.split("//");
        var folding_id = splitted_data[0];
        var returning_quantity = splitted_data[1];
        if(returning_quantity > 0)
        {
            $.ajax({
			 		url: 'inspection_and_folding/rework_data_table.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {
                         folding_id: folding_id
                        },
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				// alert(data);
                             $('#rework_div').show();
                            document.getElementById("rework_div").innerHTML=data;
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({
        }
            
           
    }
   
		function sending_data_of_approved_for_rework_form_for_saving_in_database()
			{
               
                var trf_id_for_rework = document.getElementById('trf_id_for_rework').value;
				var pp_number_for_rework = document.getElementById('pp_number_for_rework').value;
				var customer_name_for_rework = document.getElementById('customer_name_for_rework').value;
				var design_for_rework = document.getElementById('design_for_rework').value;
				var version_number_for_rework = document.getElementById('version_number_for_rework').value;
				var style_name_for_rework = document.getElementById('style_name_for_rework').value;
				var color_for_rework = document.getElementById('color_for_rework').value;
				var construction_name_for_rework = document.getElementById('construction_name_for_rework').value;
				var process_name_for_rework = document.getElementById('process_name_for_rework').value;
				var trolly_for_rework = document.getElementById('trolly_for_rework').value;
				var finish_width_for_rework = document.getElementById('finish_width_for_rework').value;
				var quantity_for_rework = document.getElementById('quantity_for_rework').value;
				var for_reason_of_rework = document.getElementById('for_reason_of_rework').value;
				var for_corrective_action_of_rework = document.getElementById('for_corrective_action_of_rework').value;
				
                $.ajax({
			 		url: 'inspection_and_folding/inspection_and_folding_info_for_rework_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {
                        trf_id_for_rework : trf_id_for_rework,
                        pp_number_for_rework : pp_number_for_rework,
                        customer_name_for_rework : customer_name_for_rework,
                        design_for_rework : design_for_rework,
                        version_number_for_rework : version_number_for_rework,
                        style_name_for_rework : style_name_for_rework,
                        color_for_rework : color_for_rework,
                        construction_name_for_rework : construction_name_for_rework,
                        process_name_for_rework : process_name_for_rework,
                        trolly_for_rework : trolly_for_rework,
                        finish_width_for_rework : finish_width_for_rework,
                        quantity_for_rework : quantity_for_rework,
                        for_reason_of_rework : for_reason_of_rework,
                        for_corrective_action_of_rework : for_corrective_action_of_rework
                     },
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
                            $('#rework_div').hide();
                            $('#folding_div').show();
                           
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			    }); // End of $.ajax({

			}
 
</script>






<div id="div_full_page_for_folding">


</div>

<div class="col-sm-12 col-md-12 col-lg-12">

    <div class="panel panel-default" id="div_table">

        <div class="form-group form-group-sm" id="div_inspection_and_folding_summary">
      
            <form class="form-horizontal" action="" method="POST" name="inspection_and_folding_summary_form" id="inspection_and_folding_summary_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9" style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                               Daily Inspection and Folding Summary
                            </td>
                        </tr>
                    </thead>
                </table>

                <div id="div_inspection_and_folding_details" >
                    <table id="datatable-buttons" class="table table-hover table-bordered">
                        <thead>
                           
                                    <tr>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>PP Number</th>
                                    <th>Week</th>
                                    <th>Design</th>
                                    <th>Version</th>
                                    <th>Style</th>
                                    <th>Color</th>
                                    <th>Construction</th>
                                    <th>Final Process</th>
                                    <th>Finish Width (Inch)</th>
                                    <th>Trolly number</th>
                                    <th>Final Process Qty (mtr.)</th>
                                    <th>Inspection Report Status</th>
                                    <th>Returing Quantity (mtr.)</th>
                                    <th>Rejection Quantity (mtr.)</th>
                                    <th>Deliverable Folding Quantity (mtr.)</th>
                                    <th>Remarks</th>
                                   
                                </tr>

                            
                        </thead>
                        <tbody id="data_table">
                        <?php
                                                        
                            $sql_for_folding = "SELECT * FROM inspection_and_folding";

                            $result_for_folding = mysqli_query($con, $sql_for_folding) or die(mysqli_errno($con));

                            while($row_for_folding = mysqli_fetch_assoc($result_for_folding))
                                {
                        ?>
                            <tr>
                                <td><?php echo $row_for_folding['recording_time'] ?></td>
                                <td><?php echo $row_for_folding['customer_name'] ?></td>
                                <td><?php echo $row_for_folding['pp_number'] ?></td>
                                <td><?php echo $row_for_folding['week_in_year'] ?></td>
                                <td><?php echo $row_for_folding['design_name'] ?></td>
                                <td><?php echo $row_for_folding['version_number'] ?></td>
                                <td><?php echo $row_for_folding['style_name'] ?></td>
                                <td><?php echo $row_for_folding['color'] ?></td>
                                <td><?php echo $row_for_folding['construction_name'] ?></td>
                                <td><?php echo $row_for_folding['process_name'] ?></td>
                                <td><?php echo $row_for_folding['finish_width'] ?></td>
                                <td><?php echo $row_for_folding['trolly_number'] ?></td>
                                <td><?php echo $row_for_folding['quantity'] ?></td>
                                <td><?php echo $row_for_folding['inspection_report_status'] ?></td>
                                <td><?php echo $row_for_folding['reworkable_quantity'] ?></td>
                                <td><?php echo $row_for_folding['rejected_quantity'] ?></td>
                                <td><?php echo $row_for_folding['folding_quantity'] ?></td>
                                <td><?php echo $row_for_folding['remarks'] ?></td>
                               
                            </tr>
                            
                        <?php
                            }
                        ?>
                            
                        </tbody>
                    </table>

                </div>

            </form>   <!-- End of form for name="inspection_and_folding_summary_form" --> 
        </div>      <!--End of div for id="div_inspection_and_folding_summary" -->

<div id="rework_div">

    
</div>


<div id="folding_div" style="display: none;">

    
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
            </script>