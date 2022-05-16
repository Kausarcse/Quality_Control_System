<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


?>

<script>

/*******************************************For Table***************************************/

	/*$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable-buttons thead tr').clone(true).appendTo( '#data_table_for_pp thead' );
 
    var table = $('#datatable-buttons').DataTable( {
       scrollY:        "600px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: '20%', targets: 0 }
        ],
        fixedColumns: false
    } );
} );*/




$(document).ready(function() {
	
	$('table').each(function(a, tbl) {
									var currentTableRows = $(tbl).find('tbody tr').length;
									$(tbl).find('th').each(function(i) {
										var remove = 0;
										var currentTable = $(this).parents('table');

										var tds = currentTable.find('tr td:nth-child(' + (i + 1) + ')');
										tds.each(function(j) { if ($(this).text().trim() === '') remove++; });

										if (remove == currentTableRows) {
											$(this).hide();
											tds.hide();
										}
									});
							});

  var table = $('#datatable-buttons').DataTable( {
										       scrollY:        "500px",
										        scrollX:        true,
										        scrollCollapse: true,
										        paging:         false,
										        columnDefs: [
										            { width: '0%', targets: 0 }
										        ],
										        /*dom: 'Bfrtip',
										        buttons: [
										            'copy', 'csv', 'excel', 'pdf', 'print'
										        ],*/
										      fixedColumns: false,
										      fixedHeader: false,
										         initComplete: function () {
													            this.api().columns().every( function () {
													                var column = this;
													                var select = $('<select><option value=""></option></select>')
													                    .appendTo( $(column.footer()).empty() )
													                    .on( 'change', function () {
													                        var val = $.fn.dataTable.util.escapeRegex(
													                            $(this).val()
													                        );
													 
													                        column
													                            .search( val ? '^'+val+'$' : '', true, false )
													                            .draw();
													                    } );
													 
													                column.data().unique().sort().each( function ( d, j ) {
													                    select.append( '<option value="'+d+'">'+d+'</option>' )
													                } );
													            } );
													        }

										    } );	

     
   /*$('#datatable-buttons').DataTable( {
							        initComplete: function () {
							            this.api().columns().every( function () {
							                var column = this;
							                var select = $('<select><option value=""></option></select>')
							                    .appendTo( $(column.footer()).empty() )
							                    .on( 'change', function () {
							                        var val = $.fn.dataTable.util.escapeRegex(
							                            $(this).val()
							                        );
							 
							                        column
							                            .search( val ? '^'+val+'$' : '', true, false )
							                            .draw();
							                    } );
							 
							                column.data().unique().sort().each( function ( d, j ) {
							                    select.append( '<option value="'+d+'">'+d+'</option>' )
							                } );
							            } );
							        }
							    } );*/
} );


/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/

	function exportF(elem) 
		{
			var table = document.getElementById("for_pp_progress_report_table");
			var html = table.innerHTML;
			var url = 'data:application/vnd.ms-excel,' + escape(html); // Set your html table into url 
			elem.setAttribute("href", url);
			elem.setAttribute("download", "PP_Progress_Report.xls"); // Choose the file name
			return false;
		}

    function export_table()
    {
    	$(document).ready(function () {
		    $("#datatable-buttons").table2excel({
		        filename: "PP_Progress_Report.xls"
		    });
		 });
    }

	function scripting_table()
	{


							 $('table').each(function(a, tbl) {
									var currentTableRows = $(tbl).find('tbody tr').length;
									$(tbl).find('th').each(function(i) {
										var remove = 0;
										var currentTable = $(this).parents('table');

										var tds = currentTable.find('tr td:nth-child(' + (i + 1) + ')');
										tds.each(function(j) { if ($(this).text().trim() === '') remove++; });

										if (remove == currentTableRows) {
											$(this).hide();
											tds.hide();
										}
									});
							});

							 /*$('#datatable-buttons').ddTableFilter(); */

							 
							   /* $('#datatable-buttons').DataTable( {
							        
							    } );*/
					
                            
                        
							
							    
							    var table = $('#datatable-buttons').DataTable( {
										       scrollY:        "500px",
										        scrollX:        true,
										        scrollCollapse: true,
										        paging:         false,
										        columnDefs: [
										            { width: '0%', targets: 0 }
										        ],
										        /*dom: 'Bfrtip',
										        buttons: [
										            'copy', 'csv', 'excel', 'pdf', 'print'
										        ],*/
										      fixedColumns: false,
										      fixedHeader: false,
										         initComplete: function () {
													            this.api().columns().every( function () {
													                var column = this;
													                var select = $('<select><option value=""></option></select>')
													                    .appendTo( $(column.footer()).empty() )
													                    .on( 'change', function () {
													                        var val = $.fn.dataTable.util.escapeRegex(
													                            $(this).val()
													                        );
													 
													                        column
													                            .search( val ? '^'+val+'$' : '', true, false )
													                            .draw();
													                    } );
													 
													                column.data().unique().sort().each( function ( d, j ) {
													                    select.append( '<option value="'+d+'">'+d+'</option>' )
													                } );
													            } );
													        }

										    } );
										
													
				      
	}

	function get_pp_progress_data()
	{ 
		//alert(document.getElementById('from_date').value);

		 var url_encoded_form_data = $("#filter_form_for_pp_progress").serialize(); //This will read all control elements value of the form	
     


		  	 $.ajax({
			 		url: 'pp_progress_report/pp_progress_data_table.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				/*alert(data);*/
			 			  
			 				document.getElementById('pp_progress_table_div').innerHTML=data;
			 				scripting_table();
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)
	
	
	function get_pp_status_report(pp_number)
	{   /*alert(pp_number);*/

		$('#full_container').load('pp_progress_report/pp_status_report.php?all_data='+encodeURIComponent(pp_number));
	}
</script>

                <div class="post-search-panel">
                      
                  	
                                                 
                </div>
    
<div class="container" id="full_container">
	<div id="panel-default">
        <table id="pp_progress">
        	<tr id="for_label"></tr>
        	<td style="border: 1px solid black"><label id="for_pp_progress_report"><h1>PP Progres Report</h1></label></td>

        </table>

        <div id="filter_div">
        	

        	<form id="filter_form_for_pp_progress" name="filter_form_for_pp_progress">
        		
               
               <div class="form-group form-group-sm" id="form-group_for_pp_number">
                        <label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number :</label>
                            <div class="col-sm-5">
                                <select  class="form-control for_auto_complete" id="pp_number" name="pp_number">
                                            <option select="selected" value="select">Select PP Number</option>
                                            <?php 
                                                 $sql = 'select DISTINCT pp_number from `pp_wise_version_creation_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

                                                 }

                                             ?>
                                </select>
                                
                            </div>
                     </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

        	

        	    <div class="form-group form-group-sm" id="form-group_for_feom_date" style="margin-right:0px; color:#00008B;">
                            <label class="control-label col-sm-4" for="from_date">From Date :</label>
                             <div class="col-sm-5" style="padding-right: 0">
							 <input type="text" class="form-control" id="from_date" name="from_date">
							

							</div>

							<div class="col-sm-1" style="padding-left: 0">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
                </div>

                 <div class="form-group form-group-sm" id="form-group_for_to_date" style="margin-right:0px; color:#00008B;">
                            <label class="control-label col-sm-4 " for="to_date">To Date :</label>
							<div class="col-sm-5" style="padding-right: 0">
								 <input type="text" id="to_date" class="form-control" name="to_date">

								<!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> -->
							</div>

							<div class="col-sm-1" style="padding-left: 0px">
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




					 <div class="form-group form-group-sm" id="form-group_for_current_state">
						<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Status:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="current_state" name="current_state" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select PP Current Status</option>
											<?php 
												 $sql = 'select Distinct current_state from `pp_monitoring`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array($result))
												 {
													//  if($row['current_state'] == 'Wait for greige issuance')
													//  {
													// 	 $current_state = 'Partial Greige Issued';
													//  }
													//  else
													//  {
													// 	 $current_state = $row['current_state'];
													//  }
													?>
													<option value="<?php echo $row['current_state'];?>"><?php echo $row['current_state'];?></option>
													<?php
												 }

											 ?>
								</select>
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_current_stauts"> -->

                  




				  <div class="form-group form-group-sm" id="form-group_for_week">
						<label class="control-label col-sm-4" for="from_week" style="margin-right:0px; color:#00008B;">From Week:</label>
							<div class="col-sm-5">
								<!--  <input class="form-control" type='text' id='from_week' name='from_week' value='' placeholder='' class='form-control col-md-7 col-xs-12'> -->

								 <select  class="form-control for_auto_complete" id="from_week" name="from_week">
											<option select="selected" value="select">Select From Week</option>
											<?php 
												 $sql = 'select DISTINCT week_in_year from `process_program_info`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['week_in_year'].'">'.$row['week_in_year'].'</option>';

												 }

											 ?>
								</select>
								
								
							</div>


							<label class="control-label col-sm-4" for="to_week" style="margin-right:0px; color:#00008B;">To Week:</label>
							<div class="col-sm-5">
								 <!-- <input type='text' id='to_week' name='to_week' value='' placeholder='' class='form-control col-md-7 col-xs-12'> -->

								<select  class="form-control for_auto_complete" id="to_week" name="to_week">
											<option select="selected" value="select">Select To Week</option>
											<?php 
												 $sql = 'select DISTINCT week_in_year from `process_program_info`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['week_in_year'].'">'.$row['week_in_year'].'</option>';

												 }

											 ?>
								</select>
								
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week"> -->







				   <div class="form-group form-group-sm" id="form-group_for_customer">
						<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">customer:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="customer" name="customer">
											<option select="selected" value="select">Select Customer</option>
											<?php 
												 $sql = 'select DISTINCT customer_id,customer_name from `process_program_info`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['customer_id'].'">'.$row['customer_name'].'</option>';

												 }

											 ?>
								</select>
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer"> -->


				 <div class="form-group form-group-sm" id="form-group_for_process_type">
						<label class="control-label col-sm-4" for="process_type" style="margin-right:0px; color:#00008B;">Process Type:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="process_type" name="process_type" >
											<option select="selected" value="select">Select Process Type</option>
											<option select="" value="'Yarn Dyed', 'Pigment dyed', 'Reactive Dyed', 'Disperse Dyed', 'Vat Dyed', 'White Finish'">Dyed</option>
											<option select="" value="'Pigment Print', 'Reactive Print', 'Discharge Print'">Printed</option>
											
								</select>
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_type"> -->



				<div class="form-group form-group-sm" id="form-group_for_process_technique">
						<label class="control-label col-sm-4" for="process_technique" style="margin-right:0px; color:#00008B;">Process technique / Program Type:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="process_technique" name="process_technique" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select Process tenique</option>
											<?php 
												 $sql = 'select process_technique_name from `process_technique_or_program_type`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_technique_name'].'">'.$row['process_technique_name'].'</option>';

												 }

											 ?>
								</select>
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_technique"> -->


					<div class="form-group form-group-sm" id="form-group_for_construction_name">
                        <label class="control-label col-sm-4" for="construction_name" style="margin-right:0px; color:#00008B;">Construction :</label>
                            <div class="col-sm-5">
                                <select  class="form-control for_auto_complete" id="construction_name" name="construction_name" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
                                            <option select="selected" value="select">Select Construction</option>
                                            <?php 
                                                 $sql = 'select DISTINCT construction_name from `pp_wise_version_creation_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['construction_name'].'">'.$row['construction_name'].'</option>';

                                                 }

                                             ?>
                                </select>
                                
                            </div>
                     </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_construction_name"> -->



				   <div class="form-group form-group-sm" id="form-group_for_process_or_reprocess">
						<label class="control-label col-sm-4" for="process_or_reprocess" style="margin-right:0px; color:#00008B;">Process/Reprocess:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="process_or_reprocess" name="process_or_reprocess" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select Process/ Reprocess</option>
											<?php 
												 $sql = 'select Distinct process_or_reprocess from `adding_process_to_version`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_or_reprocess'].'">'.$row['process_or_reprocess'].'</option>';

												 }

											 ?>
								</select>
								
							</div>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_or_reprocess"> -->

                    


                    <button name="submit" type="button" class="btn btn-info" onclick="get_pp_progress_data()">Filter</button> 
					<button type="reset" name="reset" id="reset" class="btn btn-primary">Reset</button>

					<button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export Data</a></button>




			    </form>  <!--  End of <form id="filter_form_for_pp_progress"> -->

            </div>   <!-- End of filter_div -->
	 
    </div>

    <br>


<div id="pp_progress_table_div" style="margin-left: -70px;">



	

      
               
 <?php
/*if (isset($_POST['submit'])) {
    $from_date = $_POST['from_date'];
    
    echo $from_date;

  }*/



$current_process_index=-1;
$previous_process="";
$after_process="";
$data_for_all_process = array();



		 
$table ='      <div class="form-group form-group-sm" id="for_pp_progress_report_table" style="width: 1280px">

                     <table id="pp_progress_header" class="table table-bordered" style="display: none;">
						<thead>
								<tr>
									<td colspan="9" style="text-align: center; font-size: 30px; color: black; font-weight: bold; border: 1px solid">
										PP Progress Report
									</td>
								</tr>
						</thead>
			         </table>
                     
			         <table id="datatable-buttons" class="table table-striped table-bordered" border=1>
			         	<thead>
			                 <tr>
			                 <th style="border: 1px solid black">PP</th>
			                 <th style="border: 1px solid black">PP Issue Date</th>
			                 <th style="border: 1px solid black">Week</th>
			                 <th style="border: 1px solid black">Customer</th>
			                 <th style="border: 1px solid black">Design</th>
			                 <th style="border: 1px solid black">PPQ (mtr.) </th>
			                 <th style="border: 1px solid black">Greige Issue Date</th>
			                 <th style="border: 1px solid black">GIQ (mtr.)</th>
			                 <th style="border: 1px solid black">Greige Issuance Completaion date</th>
			                 <th style="border: 1px solid black">S/E  (GIQ - PPQ) (mtr.)</th>
			                 <th style="border: 1px solid black">Process Starting Date</th>
			                 
							 <th style="border: 1px solid black">Singeing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Singeing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Singeing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Singeing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Singeing Qty. (mtr.)</th>

							 <th style="border: 1px solid black">Desizing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Desizing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Desizing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Desizing Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Desizing Qty. (mtr.)</th>

			                 <th style="border: 1px solid black">Singe & Desize Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Singe & Desize Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Singe & Desize Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Singe & Desize Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Singe & Desize Qty. (mtr.)</th>
			              
							 <th style="border: 1px solid black">Scouring Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Scouring Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Scouring Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Scouring Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Scouring Qty. (mtr.)</th>

							 <th style="border: 1px solid black">Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Bleaching Qty. (mtr.)</th>

			                 <th style="border: 1px solid black">Scouring & Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Re-Scouring & Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">2nd-Re-Scouring & Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">3rd-Re-Scouring & Bleaching Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">4th-Re-Scouring & Bleaching Qty. (mtr.)</th>
			                 
			                 <th style="border: 1px solid black">Ready for Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Ready for Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Ready for Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Ready for Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Ready for Mercerize Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Mercerize Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Mercerize Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Ready for Print Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Ready for Print Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Ready for Print Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Ready for Print Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Ready for Print Qty. (mtr.) </th>

			                 <th style="border: 1px solid black"> Printing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Printing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Printing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Printing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Printing Qty. (mtr.) </th>
			                 
			                
			                 <th style="border: 1px solid black">Curing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Curing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Curing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Curing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Curing Qty. (mtr.) </th>
			                
			                 <th style="border: 1px solid black">Steaming Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Steaming Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Steaming Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Steaming Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Steaming Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Ready for Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Ready for Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Ready for Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Ready for Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Ready for Dyeing Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Dyeing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Dyeing Qty. (mtr.) </th>
			                
							 <th style="border: 1px solid black">Washing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Washing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Washing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Washing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Washing Qty. (mtr.) </th>

			                 <th style="border: 1px solid black">Ready for Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Ready for Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Ready for Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Ready for Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Ready for Raising Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Raising Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Raising Qty. (mtr.) </th>

			                 <th style="border: 1px solid black">Finishing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Finishing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2nd-Re-Finishing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Finishing Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Finishing Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Calender Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Re-Calender Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">2d Re-Calender Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">3rd-Re-Calender Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">4th-Re-Calender Qty. (mtr.) </th>
			                 
			                 <th style="border: 1px solid black">Sanforize Qty. (mtr.)  </th>
			                 <th style="border: 1px solid black">Re-Sanforize Qty. (mtr.)  </th>
			                 <th style="border: 1px solid black">2nd-Re-Sanforize Qty. (mtr.)  </th>
			                 <th style="border: 1px solid black">3rd-Re-Sanforize Qty. (mtr.)  </th>
			                 <th style="border: 1px solid black">4th-Re-Sanforize Qty. (mtr.)  </th>

			                 <th style="border: 1px solid black">TPQ (mtr.)</th>
			                 <th style="border: 1px solid black">S/E  (TPQ - PPQ) (mtr.)</th>
			                 <th style="border: 1px solid black">S/E (TPQ - GIQ) (mtr.)</th>

			                 <th style="border: 1px solid black">Process completion date  </th>
			                 <th style="border: 1px solid black">Reprocess Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Reprocess (%) </th>
			                 <th style="border: 1px solid black">Inspection & Folding  Qty. (mtr.)  </th>
			                 
			                 
			                 <th style="border: 1px solid black">Folding Completion Date </th>
			                 <th style="border: 1px solid black">PP Closing Date </th>
			                 <th style="border: 1px solid black">Short/ Excess (Total Process qty vs Folding Qty. (mtr.)</th>
			                 <th style="border: 1px solid black">Delivery  Qty. (mtr.)  </th>
			                 <th style="border: 1px solid black">Short/ Excess (Folding vs Deivery Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Delivery completion Date  </th>
			                 <th style="border: 1px solid black">Defective Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Defective % </th>
			                 <th style="border: 1px solid black">Rejection Qty. (mtr.) </th>
			                 <th style="border: 1px solid black">Rejection % </th>
			                 <th style="border: 1px solid black">Chemical cost BDT/sq.mtr </th>
			                 <th style="border: 1px solid black">Remarks </th>
			                 </tr>
			            </thead>


			            <tfoot>
				            <tr>
				             <th style="border: 1px solid black"></th>
			               
				            </tr>
				       </tfoot>


			            <tbody>';
		
		$sql = "SELECT
					ppi.pp_number
					, date_format(ppi.pp_creation_date, '%d-%m-%Y')  pp_creation_date
					,ppi.week_in_year
					,ppi.customer_id
					,ppi.customer_name
					,ppi.design

				From process_program_info ppi ";			
		
		 $result= mysqli_query($con,$sql) or die(mysqli_error($con));

		 $total_ppq_value = 0.0;
		 $total_gic_value = 0.0;
		 $total_greige_short_excess_qty = 0.0;

		 $total_singeing_qty = 0.0;
		 $total_re_singeing_qty = 0.0;
		 $total_2nd_re_singeing_qty = 0.0;
		 $total_3rd_re_singeing_qty = 0.0;
		 $total_4th_re_singeing_qty = 0.0;

		 $total_desizing_qty = 0.0;
		 $total_re_desizing_qty = 0.0;
		 $total_2nd_re_desizing_qty = 0.0;
		 $total_3rd_re_desizing_qty = 0.0;
		 $total_4th_re_desizing_qty = 0.0;

		 $total_signe_desize_qty = 0.0;
		 $total_re_signe_desize_qty = 0.0;
		 $total_2nd_re_signe_desize_qty = 0.0;
		 $total_3rd_re_signe_desize_qty = 0.0;
		 $total_4th_re_signe_desize_qty = 0.0;

		 $total_scouring_qty = 0.0;
		 $total_re_scouring_qty = 0.0;
		 $total_2nd_re_scouring_qty = 0.0;
		 $total_3rd_re_scouring_qty = 0.0;
		 $total_4th_re_scouring_qty = 0.0;

		 $total_bleaching_qty = 0.0;
		 $total_re_bleaching_qty = 0.0;
		 $total_2nd_re_bleaching_qty = 0.0;
		 $total_3rd_re_bleaching_qty = 0.0;
		 $total_4th_re_bleaching_qty = 0.0;

		 $total_scouring_bleaching_qty = 0.0;
		 $total_re_scouring_bleaching_qty = 0.0;
		 $total_2nd_re_scouring_bleaching_qty = 0.0;
		 $total_3rd_re_scouring_bleaching_qty = 0.0;
		 $total_4th_re_scouring_bleaching_qty = 0.0;

		 $total_ready_for_mercherize_qty = 0.0;
		 $total_re_ready_for_mercherize_qty = 0.0;
		 $total_2nd_re_ready_for_mercherize_qty = 0.0;
		 $total_3rd_re_ready_for_mercherize_qty = 0.0;
		 $total_4th_re_ready_for_mercherize_qty = 0.0;

		 $total_mercherize_qty = 0.0;
		 $total_re_mercherize_qty = 0.0;
		 $total_2nd_re_mercherize_qty = 0.0;
		 $total_3rd_re_mercherize_qty = 0.0;
		 $total_4th_re_mercherize_qty = 0.0;

		 $total_ready_for_print_qty = 0.0;
		 $total_re_ready_for_print_qty = 0.0;
		 $total_2nd_re_ready_for_print_qty = 0.0;
		 $total_3rd_re_ready_for_print_qty = 0.0;
		 $total_4th_re_ready_for_print_qty = 0.0;

		 $total_print_qty = 0.0;
		 $total_re_print_qty = 0.0;
		 $total_2nd_re_print_qty = 0.0;
		 $total_3rd_re_print_qty = 0.0;
		 $total_4th_re_print_qty = 0.0;

		 $total_curing_qty = 0.0;
		 $total_re_curing_qty = 0.0;
		 $total_2nd_re_curing_qty = 0.0;
		 $total_3rd_re_curing_qty = 0.0;
		 $total_4th_re_curing_qty = 0.0;

		 $total_steaming_qty = 0.0;
		 $total_re_steaming_qty = 0.0;
		 $total_2nd_re_steaming_qty = 0.0;
		 $total_3rd_re_steaming_qty = 0.0;
		 $total_4th_re_steaming_qty = 0.0;

		 $total_ready_for_dyeing_qty = 0.0;
		 $total_re_ready_for_dyeing_qty = 0.0;
		 $total_2nd_re_ready_for_dyeing_qty = 0.0;
		 $total_3rd_re_ready_for_dyeing_qty = 0.0;
		 $total_4th_re_ready_for_dyeing_qty = 0.0;

		 $total_dyeing_qty = 0.0;
		 $total_re_dyeing_qty = 0.0;
		 $total_2nd_re_dyeing_qty = 0.0;
		 $total_3rd_re_dyeing_qty = 0.0;
		 $total_4th_re_dyeing_qty = 0.0;

		 $total_washing_qty = 0.0;
		 $total_re_washing_qty = 0.0;
		 $total_2nd_re_washing_qty = 0.0;
		 $total_3rd_re_washing_qty = 0.0;
		 $total_4th_re_washing_qty = 0.0;

		 $total_ready_for_raising_qty = 0.0;
		 $total_re_ready_for_raising_qty = 0.0;
		 $total_2nd_re_ready_for_raising_qty = 0.0;
		 $total_3rd_re_ready_for_raising_qty = 0.0;
		 $total_4th_re_ready_for_raising_qty = 0.0;

		 $total_raising_qty = 0.0;
		 $total_re_raising_qty = 0.0;
		 $total_2nd_re_raising_qty = 0.0;
		 $total_3rd_re_raising_qty = 0.0;
		 $total_4th_re_raising_qty = 0.0;

		 $total_finishing_qty = 0.0;
		 $total_re_finishing_qty = 0.0;
		 $total_2nd_re_finishing_qty = 0.0;
		 $total_3rd_re_finishing_qty = 0.0;
		 $total_4th_re_finishing_qty = 0.0;

		 $total_calendering_qty = 0.0;
		 $total_re_calendering_qty = 0.0;
		 $total_2nd_re_calendering_qty = 0.0;
		 $total_3rd_re_calendering_qty = 0.0;
		 $total_4th_re_calendering_qty = 0.0;

		 $total_sanforizing_qty = 0.0;
		 $total_re_sanforizing_qty = 0.0;
		 $total_2nd_re_sanforizing_qty = 0.0;
		 $total_3rd_re_sanforizing_qty = 0.0;
		 $total_4th_re_sanforizing_qty = 0.0;

		 $total_process_qty = 0.0;
		 $total_process_short_excess_qty = 0.0;
		 $total_greige_process_short_excess_qty = 0.0;
		 $total_reprocess_qty = 0.0;

		 while( $row = mysqli_fetch_array($result))
		 	{      

                $last_batcher_qty =0.0;
				$total_pp_quantity =0.0;
				$greige_total_quantity =0.0;
				$process_completetion_date ='';
				$reprocess_quantity =0.0;

                $value_for_pp=$row['pp_number'];
				$table .='<tr class="data">
			                 <td style="border: 1px solid black" onClick="get_pp_status_report(&quot;'.$value_for_pp.'&quot;)">'.$row['pp_number'].'</td>
			                 <td style="border: 1px solid black">'.$row['pp_creation_date'].'</td>
			                 <td style="border: 1px solid black">'.$row['week_in_year'].'</td>
			                 <td style="border: 1px solid black">'.$row['customer_name'].'</td>
			                 <td style="border: 1px solid black">'.$row['design'].'</td>';

				$sql_for_all_process="SELECT  process_name,process_serial_no  from adding_process_to_version apv
								 		where 1=1 and pp_number ='".$row['pp_number']."' order by process_serial_no asc";

				$result_for_all_process= mysqli_query($con,$sql_for_all_process) or die(mysqli_error($con));

				while( $row_for_all_process = mysqli_fetch_array( $result_for_all_process))
				{
					$data_for_all_process[] = $row_for_all_process['process_name'];
				}

				////////////////////////////////// Greige Receiving	//////////////////////////////////

				$sql_for_Greige_Receiving="SELECT * ,ptftri.greige_qty - pwvci.pp_quantity_pwvci short_excess 
												from 
												(SELECT pp_number,sum(pp_quantity) pp_quantity_pwvci 
												from pp_wise_version_creation_info where pp_number='".$row['pp_number']."') pwvci 
												LEFT JOIN
												(SELECT ptri.pp_number
												, date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') greige_issue_date 
												,sum(after_trolley_or_batcher_qty) greige_qty ,'' as greige_completetion_date 
												from partial_test_for_test_result_info ptri 
												where pp_number='".$row['pp_number']."' and ptri.process_name='Greige Receiving') ptftri 
												on  ptftri.pp_number = pwvci.pp_number" ;
					
				$result_Greige_Receiving= mysqli_query($con,$sql_for_Greige_Receiving) or die(mysqli_error($con));
				while($row_Greige_Receiving = mysqli_fetch_array( $result_Greige_Receiving))
				{    
					$greige_qty = $row_Greige_Receiving['greige_qty'];
					if($greige_qty == 0)
					{
						$greige_qty = '';
					}

					$short_excess = $row_Greige_Receiving['short_excess'];
					if($short_excess == 0)
					{
						$short_excess = '';
					}

					$table .='	<td style="border: 1px solid black">'.$row_Greige_Receiving['pp_quantity_pwvci'].'</td>
								<td style="border: 1px solid black">'.$row_Greige_Receiving['greige_issue_date'].'</td>
								<td style="border: 1px solid black">'.$greige_qty.'</td>
								<td style="border: 1px solid black">'.$row_Greige_Receiving['greige_completetion_date'].'</td>
								<td style="border: 1px solid black">'.$short_excess.'</td>';

					$total_pp_quantity = $row_Greige_Receiving['pp_quantity_pwvci'];
					
					$greige_total_quantity = $row_Greige_Receiving['greige_qty'];
					$greige_short_excess_qty = $row_Greige_Receiving['short_excess'];
				}

				$sql_for_first_process = "select partial_test_for_test_result_id, partial_test_for_test_result_creation_date from 
				(select DISTINCT partial_test_for_test_result_id, partial_test_for_test_result_creation_date
				from partial_test_for_test_result_info WHERE pp_number = '".$row['pp_number']."' ORDER BY partial_test_for_test_result_id asc limit 2) as partial_test_id 
				ORDER BY partial_test_for_test_result_id DESC limit 1;";  
					
				$result_for_first_process = mysqli_query($con,$sql_for_first_process) or die(mysqli_error($con));
				$row_for_first_process = mysqli_fetch_array( $result_for_first_process);
				
				$partial_test_for_test_result_creation_date = $row_for_first_process['partial_test_for_test_result_creation_date'];
			
				$process_start_date = date("m-d-Y", strtotime($partial_test_for_test_result_creation_date));
				if($process_start_date == '01-01-1970')
				{
					$table .='<td style="border: 1px solid black"></td>';
				}
				else
				{
					$table .='<td style="border: 1px solid black">'.$process_start_date.'</td>';
				}
				
			
					

				/////////////////////////////////// Singeing ///////////////////////////////////

				// $sql_Singeing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
				// 					date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
				// 					,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
				// 					,sum(ptri.after_trolley_or_batcher_qty) - IFNULL((SELECT sum(after_trolley_or_batcher_qty) from partial_test_for_test_result_info pt
				// 					where '".$row['pp_number']."'= pt.pp_number
				// 					and pt.process_name = 'Greige Receiving'),$last_batcher_qty) Singeing_short
				// 					From partial_test_for_test_result_info ptri 
				// 					where ptri.process_id='proc_21'
				// 					and ptri.process_name='Singeing'
				// 					and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$sql_Singeing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
									date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
									,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
									From partial_test_for_test_result_info ptri 
									where ptri.process_id='proc_21'
									and ptri.process_name='Singeing'
									and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_Singeing = mysqli_query($con,$sql_Singeing) or die(mysqli_error($con));
	
				while( $row_Singeing = mysqli_fetch_array( $result_Singeing))
				{  
					
					$table .='<td style="border: 1px solid black">'.$row_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Singeing['after_trolley_or_batcher_qty'];			
					}
					$singeing_qty = $row_Singeing['after_trolley_or_batcher_qty'];				
				}
	
				// Re-Singeing
				$sql_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
							date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
							,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							From partial_test_for_test_result_info ptri 
							where ptri.process_id='proc_21'
							and ptri.process_name='Re-Singeing'
							and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Singeing = mysqli_query($con,$sql_Re_Singeing) or die(mysqli_error($con));

				while( $row_Re_Singeing = mysqli_fetch_array( $result_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Singeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Singeing['after_trolley_or_batcher_qty'];	
					}
					
					$re_singeing_qty = $row_Re_Singeing['after_trolley_or_batcher_qty'];
									
				}

				// 2nd-Re-Singeing
				$sql_2nd_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
							date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
							,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							From partial_test_for_test_result_info ptri 
							where ptri.process_id='proc_21'
							and ptri.process_name='2nd-Re-Singeing'
							and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Singeing = mysqli_query($con,$sql_2nd_Re_Singeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Singeing = mysqli_fetch_array( $result_2nd_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Singeing['after_trolley_or_batcher_qty'];			
					}
					$second_re_singeing_qty = $row_2nd_Re_Singeing['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Singeing
				$sql_3rd_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
									date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
									,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
									From partial_test_for_test_result_info ptri 
									where ptri.process_id='proc_21'
									and ptri.process_name='3rd-Re-Singeing'
									and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_3rd_Re_Singeing = mysqli_query($con,$sql_3rd_Re_Singeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Singeing = mysqli_fetch_array( $result_3rd_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];	
							$reprocess_quantity+=$row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];
						}	
						$third_re_singeing_qty = $row_3rd_Re_Singeing['after_trolley_or_batcher_qty'];		

				}
	
				// 4th-Re-Singeing 
				$sql_4th_Re_Singeing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_21'
								and ptri.process_name='4th-Re-Singeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Singeing = mysqli_query($con,$sql_4th_Re_Singeing) or die(mysqli_error($con));

				while( $row_4th_Re_Singeing  = mysqli_fetch_array( $result_4th_Re_Singeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Singeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Singeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Singeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Singeing['after_trolley_or_batcher_qty'];
					}	
					$forth_re_singeing_qty = $row_4th_Re_Singeing['after_trolley_or_batcher_qty'];		
		
				}  

				/////////////////////////////////// Desizing ///////////////////////////////////

				$sql_Desizing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
					
				$result_Desizing= mysqli_query($con,$sql_Desizing) or die(mysqli_error($con));

				while( $row_Desizing = mysqli_fetch_array( $result_Desizing))
				{  
					$table .='<td style="border: 1px solid black">'.$row_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Desizing['after_trolley_or_batcher_qty'];			
					}
					$desizing_qty = $row_Desizing['after_trolley_or_batcher_qty'];				
				}
	
				// Re-Desizing
				$sql_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";	
				
				$result_Re_Desizing= mysqli_query($con,$sql_Re_Desizing) or die(mysqli_error($con));

				while( $row_Re_Desizing = mysqli_fetch_array( $result_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Desizing['after_trolley_or_batcher_qty'];	
					}
					$re_desizing_qty = $row_Re_Desizing['after_trolley_or_batcher_qty'];
									
				}
	
				// 2nd-Re-Desizing
				$sql_2nd_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='2nd-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Desizing= mysqli_query($con,$sql_2nd_Re_Desizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Desizing = mysqli_fetch_array( $result_2nd_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Desizing['after_trolley_or_batcher_qty'];			
					}
					$second_re_desizing_qty = $row_2nd_Re_Desizing['after_trolley_or_batcher_qty'];		
				}
	
				// 3rd-Re-Desizing
				$sql_3rd_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='3rd-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Desizing= mysqli_query($con,$sql_3rd_Re_Desizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Desizing = mysqli_fetch_array( $result_3rd_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';
					if($row_3rd_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];
					}	
					$third_re_desizing_qty = $row_3rd_Re_Desizing['after_trolley_or_batcher_qty'];		

				}
	
				// 4th-Re-Desizing
				$sql_4th_Re_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_22'
								and ptri.process_name='4th-Re-Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Desizing= mysqli_query($con,$sql_4th_Re_Desizing) or die(mysqli_error($con));

				while( $row_4th_Re_Desizing = mysqli_fetch_array( $result_4th_Re_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Desizing['after_trolley_or_batcher_qty'];
					}	
					$forth_re_desizing_qty = $row_4th_Re_Desizing['after_trolley_or_batcher_qty'];		
	
				}   

				/////////////////////////////////// Singeing & Desizing ///////////////////////////////////

				$sql_Singeing_Desizing = "SELECT ptri.partial_test_for_test_result_id, ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Singeing_Desizing= mysqli_query($con,$sql_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_Singeing_Desizing = mysqli_fetch_array( $result_Singeing_Desizing))
				{ 
					$table .='<td style="border: 1px solid black">'.$row_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Singeing_Desizing['after_trolley_or_batcher_qty'];			
					}
					$signe_desize_qty = $row_Singeing_Desizing['after_trolley_or_batcher_qty'];				
				}

				// Re-Singeing & Desizing
				$sql_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Singeing_Desizing= mysqli_query($con,$sql_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_Re_Singeing_Desizing = mysqli_fetch_array( $result_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
					}
					
					$re_signe_desizing_qty = $row_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
									
				}

				// 2nd-Re-Singeing & Desizing
				$sql_2nd_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='2nd-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Singeing_Desizing= mysqli_query($con,$sql_2nd_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Singeing_Desizing = mysqli_fetch_array( $result_2nd_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];			
					}
					$second_re_signe_desizing_qty = $row_2nd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Singeing & Desizing
				$sql_3rd_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='3rd-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Singeing_Desizing= mysqli_query($con,$sql_3rd_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Singeing_Desizing = mysqli_fetch_array( $result_3rd_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];	
							$reprocess_quantity+=$row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						}	
						
						$third_re_signe_desizing_qty = $row_3rd_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];		

				}

				// 4th-Re-Singeing & Desizing
				$sql_4th_Re_Singeing_Desizing = "SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_1'
								and ptri.process_name='4th-Re-Singeing & Desizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Singeing_Desizing= mysqli_query($con,$sql_4th_Re_Singeing_Desizing) or die(mysqli_error($con));

				while( $row_4th_Re_Singeing_Desizing = mysqli_fetch_array( $result_4th_Re_Singeing_Desizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
							$reprocess_quantity+=$row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];
						}	
						$forth_re_signe_desizing_qty = $row_4th_Re_Singeing_Desizing['after_trolley_or_batcher_qty'];		
		
				}   

				////////////////////////////////// Scouring //////////////////////////////////

				$sql_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Scouring= mysqli_query($con,$sql_Scouring) or die(mysqli_error($con));

				while( $row_Scouring = mysqli_fetch_array( $result_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Scouring['after_trolley_or_batcher_qty'];
					}
					$scouring_qty = $row_Scouring['after_trolley_or_batcher_qty'];		
				}

				// Re-Scouring
				$sql_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Scouring= mysqli_query($con,$sql_Re_Scouring) or die(mysqli_error($con));

				while( $row_Re_Scouring = mysqli_fetch_array( $result_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$re_scouring_qty = $row_Re_Scouring['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Scouring
				$sql_2nd_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='2nd-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Scouring= mysqli_query($con,$sql_2nd_Re_Scouring) or die(mysqli_error($con));

				while( $row_2nd_Re_Scouring = mysqli_fetch_array( $result_2nd_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$second_re_scouring_qty = $row_2nd_Re_Scouring['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Scouring
				$sql_3rd_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='3rd-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Scouring= mysqli_query($con,$sql_3rd_Re_Scouring) or die(mysqli_error($con));

				while( $row_3rd_Re_Scouring = mysqli_fetch_array( $result_3rd_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$third_re_scouring_qty = $row_3rd_Re_Scouring['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Scouring
				$sql_4th_Re_Scouring = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_2'
								and ptri.process_name='4th-Re-Scouring'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Scouring= mysqli_query($con,$sql_4th_Re_Scouring) or die(mysqli_error($con));

				while( $row_4th_Re_Scouring = mysqli_fetch_array( $result_4th_Re_Scouring))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Scouring['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Scouring['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Scouring['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Scouring['after_trolley_or_batcher_qty'];
					}
					$forth_re_scouring_qty = $row_4th_Re_Scouring['after_trolley_or_batcher_qty'];		
				}

				////////////////////////////////// Bleaching //////////////////////////////////

				$sql_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Bleaching= mysqli_query($con,$sql_Bleaching) or die(mysqli_error($con));

				while( $row_Bleaching = mysqli_fetch_array( $result_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Bleaching['after_trolley_or_batcher_qty'];
					}
					$bleaching_qty = $row_Bleaching['after_trolley_or_batcher_qty'];		
				}

				// Re-Bleaching
				$sql_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Bleaching= mysqli_query($con,$sql_Re_Bleaching) or die(mysqli_error($con));

				while( $row_Re_Bleaching = mysqli_fetch_array( $result_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$re_bleaching_qty = $row_Re_Bleaching['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Bleaching
				$sql_2nd_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='2nd-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Bleaching= mysqli_query($con,$sql_2nd_Re_Bleaching) or die(mysqli_error($con));

				while( $row_2nd_Re_Bleaching = mysqli_fetch_array( $result_2nd_Re_Bleaching))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$second_re_bleaching_qty = $row_2nd_Re_Bleaching['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Bleaching
				$sql_3rd_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='3rd-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Bleaching= mysqli_query($con,$sql_3rd_Re_Bleaching) or die(mysqli_error($con));

				while( $row_3rd_Re_Bleaching = mysqli_fetch_array( $result_3rd_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$third_re_bleaching_qty = $row_3rd_Re_Bleaching['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Bleaching
				$sql_4th_Re_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_3'
								and ptri.process_name='4th-Re-Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Bleaching= mysqli_query($con,$sql_4th_Re_Bleaching) or die(mysqli_error($con));

				while( $row_4th_Re_Bleaching = mysqli_fetch_array( $result_4th_Re_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];
					}
					$forth_re_bleaching_qty = $row_4th_Re_Bleaching['after_trolley_or_batcher_qty'];		
				}
			
				////////////////////////////////// Scouring & Bleaching //////////////////////////////////
				$sql_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Scouring_Bleaching= mysqli_query($con,$sql_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_Scouring_Bleaching = mysqli_fetch_array( $result_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$scouring_bleaching_qty = $row_Scouring_Bleaching['after_trolley_or_batcher_qty'];		
				}

				// Re-Scouring & Bleaching
				$sql_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_Re_Scouring_Bleaching= mysqli_query($con,$sql_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_Re_Scouring_Bleaching = mysqli_fetch_array( $result_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$re_scouring_bleaching_qty = $row_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];		
		
				}

				// 2nd-Re-Scouring_Bleaching
				$sql_2nd_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='2nd-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_2nd_Re_Scouring_Bleaching= mysqli_query($con,$sql_2nd_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_2nd_Re_Scouring_Bleaching = mysqli_fetch_array( $result_2nd_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$second_re_scouring_bleaching_qty = $row_2nd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];		
			
				}

				// 3rd-Re-Scouring_Bleaching
				$sql_3rd_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='3rd-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_3rd_Re_Scouring_Bleaching= mysqli_query($con,$sql_3rd_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_3rd_Re_Scouring_Bleaching = mysqli_fetch_array( $result_3rd_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
						{
							$last_batcher_qty = $row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
							$reprocess_quantity+=$row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						}
					$third_re_scouring_bleaching_qty = $row_3rd_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];		
			
				}

				// 4th-Re-Scouring_Bleaching
				$sql_4th_Re_Scouring_Bleaching = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_4'
								and ptri.process_name='4th-Re-Scouring & Bleaching'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";

				$result_4th_Re_Scouring_Bleaching= mysqli_query($con,$sql_4th_Re_Scouring_Bleaching) or die(mysqli_error($con));

				while( $row_4th_Re_Scouring_Bleaching = mysqli_fetch_array( $result_4th_Re_Scouring_Bleaching))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];
					}
					$forth_re_scouring_bleaching_qty = $row_4th_Re_Scouring_Bleaching['after_trolley_or_batcher_qty'];		
									
				}
				
				////////////////////////// Ready Fro Mercerize //////////////////////////

				$sql_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Mercerize= mysqli_query($con,$sql_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_Ready_For_Mercerize = mysqli_fetch_array( $result_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
					}			
					$Ready_For_Mercerize_qty = $row_Ready_For_Mercerize['after_trolley_or_batcher_qty'];		
				}

				//Re-Ready For Mercerize
				$sql_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Mercerize= mysqli_query($con,$sql_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
					}			
					$re_Ready_For_Mercerize_qty = $row_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];		
				}

				//2nd-Re-Ready For Mercerize
				$sql_2nd_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='2nd-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Mercerize= mysqli_query($con,$sql_2nd_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_2nd_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];

					}			
					$second_re_Ready_For_Mercerize_qty = $row_2nd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				//3rd-Re-Ready For Mercerize
				$sql_3rd_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='3rd-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Mercerize= mysqli_query($con,$sql_3rd_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_3rd_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$third_re_Ready_For_Mercerize_qty = $row_3rd_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];		

				}

				//4th-Re-Ready For Mercerize
				$sql_4th_Re_Ready_For_Mercerize = " SELECT ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_5'
								and ptri.process_name='4th-Re-Ready For Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Mercerize= mysqli_query($con,$sql_4th_Re_Ready_For_Mercerize) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Mercerize = mysqli_fetch_array( $result_4th_Re_Ready_For_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];	
					}			
					$forth_re_Ready_For_Mercerize_qty = $row_4th_Re_Ready_For_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				//////////////////////////// Mercerize //////////////////////////

				 $sql_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Mercerize= mysqli_query($con,$sql_Mercerize) or die(mysqli_error($con));

				while( $row_Mercerize = mysqli_fetch_array( $result_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$mercerize_qty = $row_Mercerize['after_trolley_or_batcher_qty'];		
			
				}

				// Re-Mercerize
				$sql_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Mercerize= mysqli_query($con,$sql_Re_Mercerize) or die(mysqli_error($con));

				while( $row_Re_Mercerize = mysqli_fetch_array( $result_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';
					if($row_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Mercerize['after_trolley_or_batcher_qty'];			
					}
					$re_mercerize_qty = $row_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				// 2nd-Re-Mercerize
				$sql_2nd_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='2nd-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Mercerize= mysqli_query($con,$sql_2nd_Re_Mercerize) or die(mysqli_error($con));

				while( $row_2nd_Re_Mercerize = mysqli_fetch_array( $result_2nd_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';
					if($row_2nd_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}	
					$second_re_mercerize_qty = $row_2nd_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				// 3rd-Re-Mercerize
				$sql_3rd_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='3rd-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Mercerize= mysqli_query($con,$sql_3rd_Re_Mercerize) or die(mysqli_error($con));

				while( $row_3rd_Re_Mercerize = mysqli_fetch_array( $result_3rd_Re_Mercerize))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_3rd_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}		
					$third_re_mercerize_qty = $row_3rd_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				// 4th-Re-Mercerize
				$sql_4th_Re_Mercerize = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_6'
								and ptri.process_name='4th-Re-Mercerize'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Mercerize= mysqli_query($con,$sql_4th_Re_Mercerize) or die(mysqli_error($con));

				while( $row_4th_Re_Mercerize = mysqli_fetch_array( $result_4th_Re_Mercerize))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_4th_Re_Mercerize['after_trolley_or_batcher_qty'].'</td> ';

					if($row_4th_Re_Mercerize['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];	
					}			
					$forth_re_mercerize_qty = $row_4th_Re_Mercerize['after_trolley_or_batcher_qty'];		
		
				}

				/////////////////////////// Ready For Print ///////////////////////////////

				$sql_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Print= mysqli_query($con,$sql_Ready_For_Print) or die(mysqli_error($con));

				while( $row_Ready_For_Print = mysqli_fetch_array( $result_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Print['after_trolley_or_batcher_qty'];
					}
					$Ready_For_Print_qty = $row_Ready_For_Print['after_trolley_or_batcher_qty'];		
				}

				// Re-Ready For Print
				$sql_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty

								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Print= mysqli_query($con,$sql_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Print = mysqli_fetch_array( $result_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}				
					$re_Ready_For_Print_qty = $row_Re_Ready_For_Print['after_trolley_or_batcher_qty'];		
		
				}

				// 2nd-Re-Ready For Print
				$sql_2nd_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='2nd-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Print= mysqli_query($con,$sql_2nd_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Print = mysqli_fetch_array( $result_2nd_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';

					if($row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}
					$second_re_Ready_For_Print_qty = $row_2nd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];		
		
				}


				// 3rd-Re-Ready For Print
				$sql_3rd_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='3rd-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."'
								";
				
				$result_3rd_Re_Ready_For_Print= mysqli_query($con,$sql_3rd_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Print = mysqli_fetch_array( $result_3rd_Re_Ready_For_Print))
				{    
					$table .=' <td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td> ';
					if($row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}			
					$third_re_Ready_For_Print_qty = $row_3rd_Re_Ready_For_Print['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Ready For Print
				$sql_4th_Re_Ready_For_Print = "SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_7'
								and ptri.process_name='4th-Re-Ready For Print'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Print= mysqli_query($con,$sql_4th_Re_Ready_For_Print) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Print = mysqli_fetch_array( $result_4th_Re_Ready_For_Print))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];
					}		
					$forth_re_Ready_For_Print_qty = $row_4th_Re_Ready_For_Print['after_trolley_or_batcher_qty'];		
				}

				// printing
				$sql_Printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='Printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Printing= mysqli_query($con,$sql_Printing) or die(mysqli_error($con));

				while( $row_Printing = mysqli_fetch_array( $result_Printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Printing['after_trolley_or_batcher_qty'];	
					}		
					$Print_qty = $row_Printing['after_trolley_or_batcher_qty'];		
				
				}

				// Re-printing
				$sql_Re_Printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='Re-Printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Printing= mysqli_query($con,$sql_Re_Printing) or die(mysqli_error($con));

				while( $row_Re_Printing = mysqli_fetch_array($result_Re_Printing))
				{  
					  
					$table .='<td style="border: 1px solid black">'.$row_Re_Printing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Printing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Printing['after_trolley_or_batcher_qty'];
					}			
					$re_Print_qty = $row_Re_Printing['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-printing
				$sql_2nd_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='2nd-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_printing= mysqli_query($con,$sql_2nd_Re_printing) or die(mysqli_error($con));

				while( $row_2nd_Re_printing = mysqli_fetch_array( $result_2nd_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_printing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_printing['after_trolley_or_batcher_qty'];	
					}		
					$second_re_Print_qty = $row_2nd_Re_printing['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-printing
				$sql_3rd_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='3rd-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_printing= mysqli_query($con,$sql_3rd_Re_printing) or die(mysqli_error($con));

				while( $row_3rd_Re_printing = mysqli_fetch_array( $result_3rd_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_printing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_printing['after_trolley_or_batcher_qty'];			
					}
					$third_re_Print_qty = $row_3rd_Re_printing['after_trolley_or_batcher_qty'];		
		
				}

				// 4th-Re-printing
				$sql_4th_Re_printing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_8'
								and ptri.process_name='4th-Re-printing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_printing= mysqli_query($con,$sql_4th_Re_printing) or die(mysqli_error($con));

				while( $row_4th_Re_printing = mysqli_fetch_array( $result_4th_Re_printing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_printing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_printing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_printing['after_trolley_or_batcher_qty'];	

						$reprocess_quantity+=$row_4th_Re_printing['after_trolley_or_batcher_qty'];		
					}
					$forth_re_Print_qty = $row_4th_Re_printing['after_trolley_or_batcher_qty'];		
				}

				// Curing
				$sql_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Curing= mysqli_query($con,$sql_Curing) or die(mysqli_error($con));

				while( $row_Curing = mysqli_fetch_array( $result_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Curing['after_trolley_or_batcher_qty'];	
					}		
					$curing_qty = $row_Curing['after_trolley_or_batcher_qty'];		
				
				}

				// Re-Curing
				$sql_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Curing= mysqli_query($con,$sql_Re_Curing) or die(mysqli_error($con));

				while( $row_Re_Curing = mysqli_fetch_array( $result_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$re_curing_qty = $row_Re_Curing['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Curing
				$sql_2nd_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='2nd-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Curing= mysqli_query($con,$sql_2nd_Re_Curing) or die(mysqli_error($con));

				while( $row_2nd_Re_Curing = mysqli_fetch_array( $result_2nd_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$second_re_curing_qty = $row_2nd_Re_Curing['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Curing
				$sql_3rd_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
							
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='3rd-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Curing= mysqli_query($con,$sql_3rd_Re_Curing) or die(mysqli_error($con));

				while( $row_3rd_Re_Curing = mysqli_fetch_array( $result_3rd_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Curing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$third_re_curing_qty = $row_3rd_Re_Curing['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Curing
				$sql_4th_Re_Curing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_9'
								and ptri.process_name='4th-Re-Curing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Curing= mysqli_query($con,$sql_4th_Re_Curing) or die(mysqli_error($con));

				while( $row_4th_Re_Curing = mysqli_fetch_array( $result_4th_Re_Curing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Curing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Curing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Curing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Curing['after_trolley_or_batcher_qty'];
					}		
					$forth_re_curing_qty = $row_4th_Re_Curing['after_trolley_or_batcher_qty'];		
				}

				// Steaming
				$sql_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_id='Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Steaming= mysqli_query($con,$sql_Steaming) or die(mysqli_error($con));

				while( $row_Steaming = mysqli_fetch_array( $result_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Steaming['after_trolley_or_batcher_qty'];	
					}		
					$Steaming_qty = $row_Steaming['after_trolley_or_batcher_qty'];		
				}

				// Re-Steaming
				$sql_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_id='Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Steaming= mysqli_query($con,$sql_Re_Steaming) or die(mysqli_error($con));

				while( $row_Re_Steaming = mysqli_fetch_array( $result_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Steaming['after_trolley_or_batcher_qty'];	
					}	
					$re_Steaming_qty = $row_Re_Steaming['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Steaming
				$sql_2nd_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_id='2nd-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Steaming= mysqli_query($con,$sql_2nd_Re_Steaming) or die(mysqli_error($con));

				while( $row_2nd_Re_Steaming = mysqli_fetch_array( $result_2nd_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Steaming['after_trolley_or_batcher_qty'];			
					}
					$second_re_Steaming_qty = $row_Re_Steaming['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Steaming
				$sql_3rd_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_id='3rd-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Steaming= mysqli_query($con,$sql_3rd_Re_Steaming) or die(mysqli_error($con));

				while( $row_3rd_Re_Steaming = mysqli_fetch_array( $result_3rd_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];
					}			
					$third_re_Steaming_qty = $row_3rd_Re_Steaming['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Steaming
				$sql_4th_Re_Steaming = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_10'
								and ptri.process_id='4th-Re-Steaming'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Steaming= mysqli_query($con,$sql_4th_Re_Steaming) or die(mysqli_error($con));

				while( $row_4th_Re_Steaming = mysqli_fetch_array( $result_4th_Re_Steaming))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Steaming['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Steaming['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Steaming['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Steaming['after_trolley_or_batcher_qty'];		
					}
					$forth_re_Steaming_qty = $row_4th_Re_Steaming['after_trolley_or_batcher_qty'];		
				}

				//Ready For Dyeing
				$sql_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Dyeing= mysqli_query($con,$sql_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_Ready_For_Dyeing = mysqli_fetch_array( $result_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
					}		
					$Ready_For_Dyeing_qty = $row_Ready_For_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//Re-Ready For Dyeing
				$sql_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Dyeing= mysqli_query($con,$sql_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$re_Ready_For_Dyeing_qty = $row_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//2nd-Re-Ready For Dyeing
				$sql_2nd_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='2nd-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Dyeing= mysqli_query($con,$sql_2nd_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_2nd_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}
					$second_re_Ready_For_Dyeing_qty = $row_2nd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//3rd-Re-Ready For Dyeing
				$sql_3rd_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='3rd-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Dyeing= mysqli_query($con,$sql_3rd_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_3rd_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$third_re_Ready_For_Dyeing_qty = $row_3rd_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];		
				}


				//4th-Re-Ready For Dyeing
				$sql_4th_Re_Ready_For_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_11'
								and ptri.process_name='4th-Re-Ready For Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Dyeing= mysqli_query($con,$sql_4th_Re_Ready_For_Dyeing) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Dyeing = mysqli_fetch_array( $result_4th_Re_Ready_For_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$forth_re_Ready_For_Dyeing_qty = $row_4th_Re_Ready_For_Dyeing['after_trolley_or_batcher_qty'];		
				}


				// Dyeing
				$sql_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Dyeing= mysqli_query($con,$sql_Dyeing) or die(mysqli_error($con));

				while( $row_Dyeing = mysqli_fetch_array( $result_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Dyeing['after_trolley_or_batcher_qty'];
					}			
					$Dyeing_qty = $row_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//Re-Dyeing
				$sql_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Dyeing= mysqli_query($con,$sql_Re_Dyeing) or die(mysqli_error($con));

				while( $row_Re_Dyeing = mysqli_fetch_array( $result_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$re_Dyeing_qty = $row_Re_Dyeing['after_trolley_or_batcher_qty'];		
				}


				//2nd-Re-Dyeing
				$sql_2nd_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='2nd-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Dyeing= mysqli_query($con,$sql_2nd_Re_Dyeing) or die(mysqli_error($con));

				while( $row_2nd_Re_Dyeing = mysqli_fetch_array( $result_2nd_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$second_re_Dyeing_qty = $row_2nd_Re_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//3rd-Re-Dyeing
				$sql_3rd_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='3rd-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Dyeing= mysqli_query($con,$sql_3rd_Re_Dyeing) or die(mysqli_error($con));

				while( $row_3rd_Re_Dyeing = mysqli_fetch_array( $result_3rd_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];
					}		
					$third_re_Dyeing_qty = $row_3rd_Re_Dyeing['after_trolley_or_batcher_qty'];		
				}

				//4th-Re-Dyeing
				$sql_4th_Re_Dyeing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_12'
								and ptri.process_name='4th-Re-Dyeing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Dyeing= mysqli_query($con,$sql_4th_Re_Dyeing) or die(mysqli_error($con));

				while( $row_4th_Re_Dyeing = mysqli_fetch_array( $result_4th_Re_Dyeing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Dyeing['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Dyeing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];	
					}		
					$forth_re_Dyeing_qty = $row_4th_Re_Dyeing['after_trolley_or_batcher_qty'];		
				}

				// Washing
				$sql_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= 'Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Washing= mysqli_query($con,$sql_Washing) or die(mysqli_error($con));

				while( $row_Washing = mysqli_fetch_array( $result_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Washing['after_trolley_or_batcher_qty'];
					}			
					$washing_qty = $row_Washing['after_trolley_or_batcher_qty'];		
				}

				// Re-Washing
				$sql_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= 'Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Washing= mysqli_query($con,$sql_Re_Washing) or die(mysqli_error($con));

				while( $row_Re_Washing = mysqli_fetch_array( $result_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Washing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$re_washing_qty = $row_Re_Washing['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Washing
				$sql_2nd_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '2nd-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Washing= mysqli_query($con,$sql_2nd_Re_Washing) or die(mysqli_error($con));

				while( $row_2nd_Re_Washing = mysqli_fetch_array( $result_2nd_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$second_re_washing_qty = $row_2nd_Re_Washing['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Washing
				$sql_3rd_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '3rd-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Washing= mysqli_query($con,$sql_3rd_Re_Washing) or die(mysqli_error($con));

				while( $row_3rd_Re_Washing = mysqli_fetch_array( $result_3rd_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Washing['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$third_re_washing_qty = $row_3rd_Re_Washing['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Washing
				$sql_4th_Re_Washing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_13'
								and ptri.process_name= '4th-Re-Washing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Washing= mysqli_query($con,$sql_4th_Re_Washing) or die(mysqli_error($con));

				while( $row_4th_Re_Washing = mysqli_fetch_array( $result_4th_Re_Washing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Washing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Washing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Washing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Washing['after_trolley_or_batcher_qty'];
					}			
					$forth_re_washing_qty = $row_4th_Re_Washing['after_trolley_or_batcher_qty'];		
				}
				
				// Ready For Raising
				$sql_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_id='Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Ready_For_Raising= mysqli_query($con,$sql_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_Ready_For_Raising = mysqli_fetch_array( $result_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Ready_For_Raising['after_trolley_or_batcher_qty'];			
					}
					$Ready_For_Raising_qty = $row_Ready_For_Raising['after_trolley_or_batcher_qty'];		
				}

				// Re-Ready For Raising
				$sql_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_id='Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Ready_For_Raising= mysqli_query($con,$sql_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_Re_Ready_For_Raising = mysqli_fetch_array( $result_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
					}	
					$re_Ready_For_Raising_qty = $row_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Ready For Raising
				$sql_2nd_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_id='2nd-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Ready_For_Raising= mysqli_query($con,$sql_2nd_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_2nd_Re_Ready_For_Raising = mysqli_fetch_array( $result_2nd_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
					}		
					$second_re_Ready_For_Raising_qty = $row_2nd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Ready For Raising
				$sql_3rd_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_id='3rd-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Ready_For_Raising= mysqli_query($con,$sql_3rd_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_3rd_Re_Ready_For_Raising = mysqli_fetch_array( $result_3rd_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];			
					}
					$third_re_Ready_For_Raising_qty = $row_3rd_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Ready For Raising
				$sql_4th_Re_Ready_For_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_14'
								and ptri.process_id='4th-Re-Ready For Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Ready_For_Raising= mysqli_query($con,$sql_4th_Re_Ready_For_Raising) or die(mysqli_error($con));

				while( $row_4th_Re_Ready_For_Raising = mysqli_fetch_array( $result_4th_Re_Ready_For_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
					}	
					$forth_re_Ready_For_Raising_qty = $row_4th_Re_Ready_For_Raising['after_trolley_or_batcher_qty'];		
				}
				
				// Raising
				$sql_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_15'
								and ptri.process_name = 'Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Raising= mysqli_query($con,$sql_Raising) or die(mysqli_error($con));

				while( $row_Raising = mysqli_fetch_array( $result_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Raising['after_trolley_or_batcher_qty'];	
					}		
					$Raising_qty = $row_Raising['after_trolley_or_batcher_qty'];		
				}
				
				// Re-Raising
				$sql_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_id='Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_Re_Raising= mysqli_query($con,$sql_Re_Raising) or die(mysqli_error($con));

				while( $row_Re_Raising = mysqli_fetch_array( $result_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Raising['after_trolley_or_batcher_qty'].'</td>';

					if($row_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Raising['after_trolley_or_batcher_qty'];	
					}		
					$re_Raising_qty = $row_Re_Raising['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Raising
				$sql_2nd_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_id='2nd-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_2nd_Re_Raising= mysqli_query($con,$sql_2nd_Re_Raising) or die(mysqli_error($con));

				while( $row_2nd_Re_Raising = mysqli_fetch_array( $result_2nd_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Raising['after_trolley_or_batcher_qty'];
					}			
					$second_re_Raising_qty = $row_2nd_Re_Raising['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Raising
				$sql_3rd_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_name='3rd-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_3rd_Re_Raising= mysqli_query($con,$sql_3rd_Re_Raising) or die(mysqli_error($con));

				while( $row_3rd_Re_Raising = mysqli_fetch_array( $result_3rd_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Raising['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Raising['after_trolley_or_batcher_qty'];	
					}		
					$third_re_Raising_qty = $row_3rd_Re_Raising['after_trolley_or_batcher_qty'];		
				}

				// 4th-Re-Raising
				$sql_4th_Re_Raising = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id='proc_15'
								and ptri.process_id='4th-Re-Raising'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Raising= mysqli_query($con,$sql_4th_Re_Raising) or die(mysqli_error($con));

				while( $row_4th_Re_Raising = mysqli_fetch_array( $result_4th_Re_Raising))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Raising['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Raising['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Raising['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_4th_Re_Raising['after_trolley_or_batcher_qty'];	
					}	
					$forth_re_Raising_qty = $row_4th_Re_Raising['after_trolley_or_batcher_qty'];		
				}

				// Finishing
				$sql_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name = 'Finishing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1 ";
				
				$result_Finishing= mysqli_query($con,$sql_Finishing) or die(mysqli_error($con));

				while( $row_Finishing = mysqli_fetch_array( $result_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Finishing['after_trolley_or_batcher_qty'];	
					}

					if($row_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Finishing['process_start_date'];
					}		
					$finishing_qty = $row_Finishing['after_trolley_or_batcher_qty'];		
			
				}
				
				// Re-Finishing
				$sql_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= 'Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_Re_Finishing= mysqli_query($con,$sql_Re_Finishing) or die(mysqli_error($con));

				while( $row_Re_Finishing = mysqli_fetch_array( $result_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Finishing['process_start_date'];
					}			
					$re_finishing_qty = $row_Re_Finishing['after_trolley_or_batcher_qty'];		
				}

				// 2nd-Re-Finishing
				$sql_2nd_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '2nd-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_2nd_Re_Finishing= mysqli_query($con,$sql_2nd_Re_Finishing) or die(mysqli_error($con));

				while( $row_2nd_Re_Finishing = mysqli_fetch_array( $result_2nd_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_2nd_Re_Finishing['process_start_date'];
					}				
					$second_re_finishing_qty = $row_2nd_Re_Finishing['after_trolley_or_batcher_qty'];		
			
				}


				// 3rd-Re-Finishing
				$sql_3rd_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '3rd-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Finishing= mysqli_query($con,$sql_3rd_Re_Finishing) or die(mysqli_error($con));

				while( $row_3rd_Re_Finishing = mysqli_fetch_array( $result_3rd_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_3rd_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_3rd_Re_Finishing['process_start_date'];
					}			
					$third_re_finishing_qty = $row_3rd_Re_Finishing['after_trolley_or_batcher_qty'];		
			
				}

				// 4th-Re-Finishing
				$sql_4th_Re_Finishing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_16'
								and ptri.process_name= '4th-Re-Finishing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_4th_Re_Finishing= mysqli_query($con,$sql_4th_Re_Finishing) or die(mysqli_error($con));

				while( $row_4th_Re_Finishing = mysqli_fetch_array( $result_4th_Re_Finishing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Finishing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Finishing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Finishing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Finishing['after_trolley_or_batcher_qty'];
					}

					if($row_4th_Re_Finishing['process_start_date']!= '')
					{
						$process_completetion_date = $row_4th_Re_Finishing['process_start_date'];
					}			
					$forth_re_finishing_qty = $row_4th_Re_Finishing['after_trolley_or_batcher_qty'];		
				}
				
				// Calander
				$sql_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name = 'Calander'
								and ptri.pp_number = '".$row['pp_number']."' 
								LIMIT 1";
				

				$result_Calander= mysqli_query($con,$sql_Calander) or die(mysqli_error($con));

				while( $row_Calander = mysqli_fetch_array( $result_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Calander['after_trolley_or_batcher_qty'];	
					}
						
					if($row_Calander['process_start_date']!= '')
					{
						$process_completetion_date = $row_Calander['process_start_date'];
					}
					$calender_qty = $row_Calander['after_trolley_or_batcher_qty'];		
			
				}


				// Re-Calander
				$sql_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= 'Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  
								LIMIT 1 ";
				
				$result_Re_Calander= mysqli_query($con,$sql_Re_Calander) or die(mysqli_error($con));

				while( $row_Re_Calander = mysqli_fetch_array( $result_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_Re_Calander['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_Re_Calander['after_trolley_or_batcher_qty'];
					}

					if($row_Re_Calander['process_start_date']!= '')
					{
						$process_completetion_date = $row_Re_Calander['process_start_date'];
					}
					$re_calender_qty = $row_Re_Calander['after_trolley_or_batcher_qty'];		
				
				}

				// 2nd-Re-Calander
				$sql_2nd_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '2nd-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  
								LIMIT 1 ";
				
				$result_2nd_Re_Calander= mysqli_query($con,$sql_2nd_Re_Calander) or die(mysqli_error($con));

				while( $row_2nd_Re_Calander = mysqli_fetch_array( $result_2nd_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Calander['after_trolley_or_batcher_qty'];	
						$reprocess_quantity+=$row_2nd_Re_Calander['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_2nd_Re_Calander['process_start_date'];
					}		
					$second_re_calender_qty = $row_2nd_Re_Calander['after_trolley_or_batcher_qty'];		
				}

				// 3rd-Re-Calander
				$sql_3rd_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '3rd-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Calander= mysqli_query($con,$sql_3rd_Re_Calander) or die(mysqli_error($con));

				while( $row_3rd_Re_Calander = mysqli_fetch_array( $result_3rd_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Calander['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Calander['after_trolley_or_batcher_qty'];
					}	

					if($row_3rd_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_3rd_Re_Calander['process_start_date'];
					}		
					$third_re_calender_qty = $row_3rd_Re_Calander['after_trolley_or_batcher_qty'];		
		
				}

				// 4th-Re-Calander
				$sql_4th_Re_Calander = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_17'
								and ptri.process_name= '4th-Re-Calander'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_4th_Re_Calander= mysqli_query($con,$sql_4th_Re_Calander) or die(mysqli_error($con));

				while( $row_4th_Re_Calander = mysqli_fetch_array( $result_4th_Re_Calander))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Calander['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_4th_Re_Calander['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Calander['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Calander['after_trolley_or_batcher_qty'];	
					}

					if($row_4th_Re_Calander['process_start_date']!= '') 
					{
						$process_completetion_date = $row_4th_Re_Calander['process_start_date'];
					}			
					$forth_re_calender_qty = $row_4th_Re_Calander['after_trolley_or_batcher_qty'];		
		
				}
				

				// Sanforizing
				 $sql_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= 'Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";

				$result_Sanforizing= mysqli_query($con,$sql_Sanforizing) or die(mysqli_error($con));

				while( $row_Sanforizing = mysqli_fetch_array( $result_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Sanforizing['after_trolley_or_batcher_qty']!= '')  
					{
						$last_batcher_qty = $row_Sanforizing['after_trolley_or_batcher_qty'];
					}	

					if($row_Sanforizing['process_start_date']!= '' || $row_Sanforizing['process_start_date']!= NULL ) 
					{

						$process_completetion_date = $row_Sanforizing['process_start_date'];	
					}
					$sanforizing_qty = $row_Sanforizing['after_trolley_or_batcher_qty'];		
				
				}

				// Re-Sanforizing
				$sql_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= 'Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_Re_Sanforizing= mysqli_query($con,$sql_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_Re_Sanforizing = mysqli_fetch_array( $result_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_Re_Sanforizing['after_trolley_or_batcher_qty']!= '')  
					{
						$last_batcher_qty = $row_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}
					if($row_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_Re_Sanforizing['process_start_date'];	
					}	
					$re_sanforizing_qty = $row_Re_Sanforizing['after_trolley_or_batcher_qty'];		
			
				}
				
				// 2nd-Re-Sanforizing
				$sql_2nd_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '2nd-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1";
				
				$result_2nd_Re_Sanforizing= mysqli_query($con,$sql_2nd_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_2nd_Re_Sanforizing = mysqli_fetch_array( $result_2nd_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}

					if($row_2nd_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_2nd_Re_Sanforizing['process_start_date'];		
					}	
					$second_re_sanforizing_qty = $row_2nd_Re_Sanforizing['after_trolley_or_batcher_qty'];		
		
				}

				// 3rd-Re-Sanforizing
				$sql_3rd_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '3rd-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."'  LIMIT 1 ";
				
				$result_3rd_Re_Sanforizing= mysqli_query($con,$sql_3rd_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_3rd_Re_Sanforizing = mysqli_fetch_array( $result_3rd_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
						
					if($row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];	
					}	

					if($row_3rd_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_3rd_Re_Sanforizing['process_start_date'];	
					}
					$third_re_sanforizing_qty = $row_3rd_Re_Sanforizing['after_trolley_or_batcher_qty'];		
				
				}

				// 4th-Re-Sanforizing
				$sql_4th_Re_Sanforizing = " SELECT  ptri.pp_number,ptri.version_number,ptri.style,ptri.finish_width_in_inch,
								date_format(ptri.partial_test_for_test_result_creation_date, '%d-%m-%Y') process_start_date
								,sum(ptri.after_trolley_or_batcher_qty ) after_trolley_or_batcher_qty
								
								From partial_test_for_test_result_info ptri 
								where ptri.process_id = 'proc_18'
								and ptri.process_name= '4th-Re-Sanforizing'
								and ptri.pp_number = '".$row['pp_number']."' LIMIT 1";
				
				$result_4th_Re_Sanforizing= mysqli_query($con,$sql_4th_Re_Sanforizing) or die(mysqli_error($con));

				while( $row_4th_Re_Sanforizing = mysqli_fetch_array( $result_4th_Re_Sanforizing))
				{    
					$table .='<td style="border: 1px solid black">'.$row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'].'</td>';
					
					if($row_4th_Re_Sanforizing['after_trolley_or_batcher_qty']!= '') 
					{
						$last_batcher_qty = $row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];
						$reprocess_quantity+=$row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];
					}			

					if($row_4th_Re_Sanforizing['process_start_date']!= '') 
					{
						$process_completetion_date = $row_4th_Re_Sanforizing['process_start_date'];	
					}
					$forth_re_sanforizing_qty = $row_4th_Re_Sanforizing['after_trolley_or_batcher_qty'];		
			
				}

				// total process quantity calculation
				
				$total_process_quantity = 0;

				$sql_total_process_quantity = "SELECT partial_test_for_test_result_info.* FROM partial_test_for_test_result_info, 
											(SELECT MAX(partial_test_for_test_result_id) lastid 
											from partial_test_for_test_result_info where pp_number = '".$row['pp_number']."' GROUP BY version_id) last_id 
											where   
											partial_test_for_test_result_info.partial_test_for_test_result_id = last_id.lastid";
				
				$result_total_process_quantity= mysqli_query($con,$sql_total_process_quantity) or die(mysqli_error($con));

				while( $row_total_process_quantity = mysqli_fetch_array( $result_total_process_quantity))
				{
					$total_process_quantity = $total_process_quantity + $row_total_process_quantity['after_trolley_or_batcher_qty'];
				}

				$process_short_excess_qty = $total_process_quantity - $total_pp_quantity;

				$greige_process_short_excess_qty = $total_process_quantity - $greige_total_quantity;

				$table .='	 <td style="border: 1px solid black">'.$total_process_quantity.'</td>
									<td style="border: 1px solid black">'.$process_short_excess_qty.'</td>
									<td style="border: 1px solid black">'.$greige_process_short_excess_qty.'</td>
									<td style="border: 1px solid black">'.$process_completetion_date.'</td>	                 
									
									<td style="border: 1px solid black">'.$reprocess_quantity.'</td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"></td>
									<td style="border: 1px solid black"> </td>
									';

				$table.='</tr>';
				 
				$total_ppq_value +=$total_pp_quantity;
				$total_gic_value +=$greige_total_quantity;
				$total_greige_short_excess_qty += $greige_short_excess_qty;

				$total_singeing_qty += $singeing_qty;
				$total_re_singeing_qty += $re_singeing_qty;
				$total_2nd_re_singeing_qty += $second_re_singeing_qty;
				$total_3rd_re_singeing_qty += $third_re_singeing_qty;
				$total_4th_re_singeing_qty += $forth_re_singeing_qty;

				$total_desizing_qty += $desizing_qty;
				$total_re_desizing_qty += $re_desizing_qty;
				$total_2nd_re_desizing_qty += $second_re_desizing_qty;
				$total_3rd_re_desizing_qty += $third_re_desizing_qty;
				$total_4th_re_desizing_qty += $forth_re_desizing_qty;

				$total_signe_desize_qty += $signe_desize_qty;
				$total_re_signe_desize_qty += $re_signe_desizing_qty;
				$total_2nd_re_signe_desize_qty += $second_re_signe_desizing_qty;
				$total_3rd_re_signe_desize_qty += $third_re_signe_desizing_qty;
				$total_4th_re_signe_desize_qty += $forth_re_signe_desizing_qty;
	   
				$total_scouring_qty += $scouring_qty;
				$total_re_scouring_qty += $re_scouring_qty;
				$total_2nd_re_scouring_qty += $second_re_scouring_qty;
				$total_3rd_re_scouring_qty += $third_re_scouring_qty;
				$total_4th_re_scouring_qty += $forth_re_scouring_qty;
				
				$total_bleaching_qty += $bleaching_qty;
				$total_re_bleaching_qty += $re_bleaching_qty;
				$total_2nd_re_bleaching_qty += $second_re_bleaching_qty;
				$total_3rd_re_bleaching_qty += $third_re_bleaching_qty;
				$total_4th_re_bleaching_qty += $forth_re_bleaching_qty;

				$total_scouring_bleaching_qty += $scouring_bleaching_qty;
				$total_re_scouring_bleaching_qty += $re_scouring_bleaching_qty;
				$total_2nd_re_scouring_bleaching_qty += $second_re_scouring_bleaching_qty;
				$total_3rd_re_scouring_bleaching_qty += $third_re_scouring_bleaching_qty;
				$total_4th_re_scouring_bleaching_qty += $forth_re_scouring_bleaching_qty;
	   
				$total_ready_for_mercherize_qty +=$Ready_For_Mercerize_qty;
				$total_re_ready_for_mercherize_qty += $re_Ready_For_Mercerize_qty;
				$total_2nd_re_ready_for_mercherize_qty += $second_re_Ready_For_Mercerize_qty;
				$total_3rd_re_ready_for_mercherize_qty += $third_re_Ready_For_Mercerize_qty;
				$total_4th_re_ready_for_mercherize_qty += $forth_re_Ready_For_Mercerize_qty;
	   
				$total_mercherize_qty += $mercerize_qty;
				$total_re_mercherize_qty += $re_mercerize_qty;
				$total_2nd_re_mercherize_qty += $second_re_mercerize_qty;
				$total_3rd_re_mercherize_qty += $third_re_mercerize_qty;
				$total_4th_re_mercherize_qty += $forth_re_mercerize_qty;
	   
				$total_ready_for_print_qty += $Ready_For_Print_qty;
				$total_re_ready_for_print_qty += $re_Ready_For_Print_qty;
				$total_2nd_re_ready_for_print_qty += $second_re_Ready_For_Print_qty;
				$total_3rd_re_ready_for_print_qty += $third_re_Ready_For_Print_qty;
				$total_4th_re_ready_for_print_qty += $forth_re_Ready_For_Print_qty;
	   
				$total_print_qty += $Print_qty;
				$total_re_print_qty += $re_Print_qty;
				$total_2nd_re_print_qty += $second_re_Print_qty;
				$total_3rd_re_print_qty += $third_re_Print_qty;
				$total_4th_re_print_qty += $forth_re_Print_qty;
	   
						
				$total_curing_qty += $curing_qty;
				$total_re_curing_qty += $re_curing_qty;
				$total_2nd_re_curing_qty += $second_re_curing_qty;
				$total_3rd_re_curing_qty += $third_re_curing_qty;
				$total_4th_re_curing_qty += $forth_re_curing_qty;
	   
				$total_steaming_qty += $Steaming_qty;
				$total_re_steaming_qty += $re_Steaming_qty;
				$total_2nd_re_steaming_qty += $second_re_Steaming_qty;
				$total_3rd_re_steaming_qty += $third_re_Steaming_qty;
				$total_4th_re_steaming_qty += $forth_re_Steaming_qty;
	   
				$total_ready_for_dyeing_qty += $Ready_For_Dyeing_qty;
				$total_re_ready_for_dyeing_qty += $re_Ready_For_Dyeing_qty;
				$total_2nd_re_ready_for_dyeing_qty += $second_re_Ready_For_Dyeing_qty;
				$total_3rd_re_ready_for_dyeing_qty += $third_re_Ready_For_Dyeing_qty;
				$total_4th_re_ready_for_dyeing_qty += $forth_re_Ready_For_Dyeing_qty;
	   
				$total_dyeing_qty += $Dyeing_qty;
				$total_re_dyeing_qty += $re_Dyeing_qty;
				$total_2nd_re_dyeing_qty += $second_re_Dyeing_qty;
				$total_3rd_re_dyeing_qty += $third_re_Dyeing_qty;
				$total_4th_re_dyeing_qty += $forth_re_Dyeing_qty;
	   
				$total_ready_for_raising_qty += $Ready_For_Raising_qty;
				$total_re_ready_for_raising_qty += $re_Ready_For_Raising_qty;
				$total_2nd_re_ready_for_raising_qty += $second_re_Ready_For_Raising_qty;
				$total_3rd_re_ready_for_raising_qty += $third_re_Ready_For_Raising_qty;
				$total_4th_re_ready_for_raising_qty += $forth_re_Ready_For_Raising_qty;
	   
				$total_raising_qty += $Raising_qty;
				$total_re_raising_qty += $re_Raising_qty;
				$total_2nd_re_raising_qty += $second_re_Raising_qty;
				$total_3rd_re_raising_qty += $third_re_Raising_qty;
				$total_4th_re_raising_qty += $forth_re_Raising_qty;
	   
				$total_washing_qty += $washing_qty;
				$total_re_washing_qty += $re_washing_qty;
				$total_2nd_re_washing_qty += $second_re_washing_qty;
				$total_3rd_re_washing_qty += $third_re_washing_qty;
				$total_4th_re_washing_qty += $forth_re_washing_qty;
	   
				$total_finishing_qty += $finishing_qty;
				$total_re_finishing_qty += $re_finishing_qty;
				$total_2nd_re_finishing_qty += $second_re_finishing_qty;
				$total_3rd_re_finishing_qty += $third_re_finishing_qty;
				$total_4th_re_finishing_qty += $forth_re_finishing_qty;
	   
				$total_calendering_qty += $calender_qty;
				$total_re_calendering_qty += $re_calender_qty;
				$total_2nd_re_calendering_qty += $second_re_calender_qty;
				$total_3rd_re_calendering_qty += $third_re_calender_qty;
				$total_4th_re_calendering_qty += $forth_re_calender_qty;
	   
				 $total_sanforizing_qty += $sanforizing_qty;
				$total_re_sanforizing_qty += $re_sanforizing_qty;
				$total_2nd_re_sanforizing_qty += $second_re_sanforizing_qty;
				$total_3rd_re_sanforizing_qty += $third_re_sanforizing_qty;
				$total_4th_re_sanforizing_qty += $forth_re_sanforizing_qty;
	   
				$total_process_qty += $total_process_quantity;
				$total_process_short_excess_qty += $process_short_excess_qty;
				$total_greige_process_short_excess_qty += $greige_process_short_excess_qty;
				$total_reprocess_qty += $reprocess_quantity;
		 	}

			 if( $total_ppq_value == 0)
			 {
				$total_ppq_value = '';
			 }
			 if( $total_gic_value == 0)
			 {
				$total_gic_value = '';
			 }
			 if( $total_greige_short_excess_qty == 0)
			 {
				$total_greige_short_excess_qty = '';
			 }

			 if( $total_singeing_qty == 0)
			 {
				$total_singeing_qty = '';
			 }
			 if( $total_re_singeing_qty == 0)
			 {
				$total_re_singeing_qty = '';
			 }
			 if( $total_2nd_re_singeing_qty == 0)
			 {
				$total_2nd_re_singeing_qty = '';
			 }
			 if( $total_3rd_re_singeing_qty == 0)
			 {
				$total_3rd_re_singeing_qty = '';
			 }
			 if( $total_4th_re_singeing_qty == 0)
			 {
				$total_4th_re_singeing_qty = '';
			 }

			 if( $total_desizing_qty == 0)
			 {
				$total_desizing_qty = '';
			 }
			 if( $total_re_desizing_qty == 0)
			 {
				$total_re_desizing_qty = '';
			 }
			 if( $total_2nd_re_desizing_qty == 0)
			 {
				$total_2nd_re_desizing_qty = '';
			 }
			 if( $total_3rd_re_desizing_qty == 0)
			 {
				$total_3rd_re_desizing_qty = '';
			 }
			 if( $total_4th_re_desizing_qty == 0)
			 {
				$total_4th_re_desizing_qty = '';
			 }


			 if( $total_signe_desize_qty == 0)
			 {
				$total_signe_desize_qty = '';
			 }
			 if( $total_re_signe_desize_qty == 0)
			 {
				$total_re_signe_desize_qty = '';
			 }
			 if( $total_2nd_re_signe_desize_qty == 0)
			 {
				$total_2nd_re_signe_desize_qty = '';
			 }
			 if( $total_3rd_re_signe_desize_qty == 0)
			 {
				$total_3rd_re_signe_desize_qty = '';
			 }
			 if( $total_4th_re_signe_desize_qty == 0)
			 {
				$total_4th_re_signe_desize_qty = '';
			 }

			 if( $total_scouring_qty == 0)
			 {
				$total_scouring_qty = '';
			 }
			 if( $total_re_scouring_qty == 0)
			 {
				$total_re_scouring_qty = '';
			 }
			 if( $total_2nd_re_scouring_qty == 0)
			 {
				$total_2nd_re_scouring_qty = '';
			 }
			 if( $total_3rd_re_scouring_qty == 0)
			 {
				$total_3rd_re_scouring_qty = '';
			 }
			 if( $total_4th_re_scouring_qty == 0)
			 {
				$total_4th_re_scouring_qty = '';
			 }

			 if( $total_bleaching_qty == 0)
			 {
				$total_bleaching_qty = '';
			 }
			 if( $total_re_bleaching_qty == 0)
			 {
				$total_re_bleaching_qty = '';
			 }
			 if( $total_2nd_re_bleaching_qty == 0)
			 {
				$total_2nd_re_bleaching_qty = '';
			 }
			 if( $total_3rd_re_bleaching_qty == 0)
			 {
				$total_3rd_re_bleaching_qty = '';
			 }
			 if( $total_4th_re_bleaching_qty == 0)
			 {
				$total_4th_re_bleaching_qty = '';
			 }
			 
			 if( $total_scouring_bleaching_qty == 0)
			 {
				$total_scouring_bleaching_qty = '';
			 }
			 if( $total_re_scouring_bleaching_qty == 0)
			 {
				$total_re_scouring_bleaching_qty = '';
			 }
			 if( $total_2nd_re_scouring_bleaching_qty == 0)
			 {
				$total_2nd_re_scouring_bleaching_qty = '';
			 }
			 if( $total_3rd_re_scouring_bleaching_qty == 0)
			 {
				$total_3rd_re_scouring_bleaching_qty = '';
			 }
			 if( $total_4th_re_scouring_bleaching_qty == 0)
			 {
				$total_4th_re_scouring_bleaching_qty = '';
			 }

			 
			 if( $total_ready_for_mercherize_qty == 0)
			 {
				$total_ready_for_mercherize_qty = '';
			 }
			 if( $total_re_ready_for_mercherize_qty == 0)
			 {
				$total_re_ready_for_mercherize_qty = '';
			 }
			 if( $total_2nd_re_ready_for_mercherize_qty == 0)
			 {
				$total_2nd_re_ready_for_mercherize_qty = '';
			 }
			 if( $total_3rd_re_ready_for_mercherize_qty == 0)
			 {
				$total_3rd_re_ready_for_mercherize_qty = '';
			 }
			 if( $total_4th_re_ready_for_mercherize_qty == 0)
			 {
				$total_4th_re_ready_for_mercherize_qty = '';
			 }

			 
			 if( $total_mercherize_qty == 0)
			 {
				$total_mercherize_qty = '';
			 }
			 if( $total_re_mercherize_qty == 0)
			 {
				$total_re_mercherize_qty = '';
			 }
			 if( $total_2nd_re_mercherize_qty == 0)
			 {
				$total_2nd_re_mercherize_qty = '';
			 }
			 if( $total_3rd_re_mercherize_qty == 0)
			 {
				$total_3rd_re_mercherize_qty = '';
			 }
			 if( $total_4th_re_mercherize_qty == 0)
			 {
				$total_4th_re_mercherize_qty = '';
			 }

			 if( $total_ready_for_print_qty == 0)
			 {
				$total_ready_for_print_qty = '';
			 }
			 if( $total_re_ready_for_print_qty == 0)
			 {
				$total_re_ready_for_print_qty = '';
			 }
			 if( $total_2nd_re_ready_for_print_qty == 0)
			 {
				$total_2nd_re_ready_for_print_qty = '';
			 }
			 if( $total_3rd_re_ready_for_print_qty == 0)
			 {
				$total_3rd_re_ready_for_print_qty = '';
			 }
			 if( $total_4th_re_ready_for_print_qty == 0)
			 {
				$total_4th_re_ready_for_print_qty = '';
			 }

			 
			 if( $total_print_qty == 0)
			 {
				$total_print_qty = '';
			 }
			 if( $total_re_print_qty == 0)
			 {
				$total_re_print_qty = '';
			 }
			 if( $total_2nd_re_print_qty == 0)
			 {
				$total_2nd_re_print_qty = '';
			 }
			 if( $total_3rd_re_print_qty == 0)
			 {
				$total_3rd_re_print_qty = '';
			 }
			 if( $total_4th_re_print_qty == 0)
			 {
				$total_4th_re_print_qty = '';
			 }

			 if( $total_curing_qty == 0)
			 {
				$total_curing_qty = '';
			 }
			 if( $total_re_curing_qty == 0)
			 {
				$total_re_curing_qty = '';
			 }
			 if( $total_2nd_re_curing_qty == 0)
			 {
				$total_2nd_re_curing_qty = '';
			 }
			 if( $total_3rd_re_curing_qty == 0)
			 {
				$total_3rd_re_curing_qty = '';
			 }
			 if( $total_4th_re_curing_qty == 0)
			 {
				$total_4th_re_curing_qty = '';
			 }

			 if( $total_steaming_qty == 0)
			 {
				$total_steaming_qty = '';
			 }
			 if( $total_re_steaming_qty == 0)
			 {
				$total_re_steaming_qty = '';
			 }
			 if( $total_2nd_re_steaming_qty == 0)
			 {
				$total_2nd_re_steaming_qty = '';
			 }
			 if( $total_3rd_re_steaming_qty == 0)
			 {
				$total_3rd_re_steaming_qty = '';
			 }
			 if( $total_4th_re_steaming_qty == 0)
			 {
				$total_4th_re_steaming_qty = '';
			 }

			 if( $total_ready_for_dyeing_qty == 0)
			 {
				$total_ready_for_dyeing_qty = '';
			 }
			 if( $total_re_ready_for_dyeing_qty == 0)
			 {
				$total_re_ready_for_dyeing_qty = '';
			 }
			 if( $total_2nd_re_ready_for_dyeing_qty == 0)
			 {
				$total_2nd_re_ready_for_dyeing_qty = '';
			 }
			 if( $total_3rd_re_ready_for_dyeing_qty == 0)
			 {
				$total_3rd_re_ready_for_dyeing_qty = '';
			 }
			 if( $total_4th_re_ready_for_dyeing_qty == 0)
			 {
				$total_4th_re_ready_for_dyeing_qty = '';
			 }

			 
			 if( $total_dyeing_qty == 0)
			 {
				$total_dyeing_qty = '';
			 }
			 if( $total_re_dyeing_qty == 0)
			 {
				$total_re_dyeing_qty = '';
			 }
			 if( $total_2nd_re_dyeing_qty == 0)
			 {
				$total_2nd_re_dyeing_qty = '';
			 }
			 if( $total_3rd_re_dyeing_qty == 0)
			 {
				$total_3rd_re_dyeing_qty = '';
			 }
			 if( $total_4th_re_dyeing_qty == 0)
			 {
				$total_4th_re_dyeing_qty = '';
			 }


			 if( $total_ready_for_raising_qty == 0)
			 {
				$total_ready_for_raising_qty = '';
			 }
			 if( $total_re_ready_for_raising_qty == 0)
			 {
				$total_re_ready_for_raising_qty = '';
			 }
			 if( $total_2nd_re_ready_for_raising_qty == 0)
			 {
				$total_2nd_re_ready_for_raising_qty = '';
			 }
			 if( $total_3rd_re_ready_for_raising_qty == 0)
			 {
				$total_3rd_re_ready_for_raising_qty = '';
			 }
			 if( $total_4th_re_ready_for_raising_qty == 0)
			 {
				$total_4th_re_ready_for_raising_qty = '';
			 }


			 if( $total_raising_qty == 0)
			 {
				$total_raising_qty = '';
			 }
			 if( $total_re_raising_qty == 0)
			 {
				$total_re_raising_qty = '';
			 }
			 if( $total_2nd_re_raising_qty == 0)
			 {
				$total_2nd_re_raising_qty = '';
			 }
			 if( $total_3rd_re_raising_qty == 0)
			 {
				$total_3rd_re_raising_qty = '';
			 }
			 if( $total_4th_re_raising_qty == 0)
			 {
				$total_4th_re_raising_qty = '';
			 }

			 
			 if( $total_washing_qty == 0)
			 {
				$total_washing_qty = '';
			 }
			 if( $total_re_washing_qty == 0)
			 {
				$total_re_washing_qty = '';
			 }
			 if( $total_2nd_re_washing_qty == 0)
			 {
				$total_2nd_re_washing_qty = '';
			 }
			 if( $total_3rd_re_washing_qty == 0)
			 {
				$total_3rd_re_washing_qty = '';
			 }
			 if( $total_4th_re_washing_qty == 0)
			 {
				$total_4th_re_washing_qty = '';
			 }


			 if( $total_finishing_qty == 0)
			 {
				$total_finishing_qty = '';
			 }
			 if( $total_re_finishing_qty == 0)
			 {
				$total_re_finishing_qty = '';
			 }
			 if( $total_2nd_re_finishing_qty == 0)
			 {
				$total_2nd_re_finishing_qty = '';
			 }
			 if( $total_3rd_re_finishing_qty == 0)
			 {
				$total_3rd_re_finishing_qty = '';
			 }
			 if( $total_4th_re_finishing_qty == 0)
			 {
				$total_4th_re_finishing_qty = '';
			 }

			 
			 if( $total_calendering_qty == 0)
			 {
				$total_calendering_qty = '';
			 }
			 if( $total_re_calendering_qty == 0)
			 {
				$total_re_calendering_qty = '';
			 }
			 if( $total_2nd_re_calendering_qty == 0)
			 {
				$total_2nd_re_calendering_qty = '';
			 }
			 if( $total_3rd_re_calendering_qty == 0)
			 {
				$total_3rd_re_calendering_qty = '';
			 }
			 if( $total_4th_re_calendering_qty == 0)
			 {
				$total_4th_re_calendering_qty = '';
			 }


			 if( $total_sanforizing_qty == 0)
			 {
				$total_sanforizing_qty = '';
			 }
			 if( $total_re_sanforizing_qty == 0)
			 {
				$total_re_sanforizing_qty = '';
			 }
			 if( $total_2nd_re_sanforizing_qty == 0)
			 {
				$total_2nd_re_sanforizing_qty = '';
			 }
			 if( $total_3rd_re_sanforizing_qty == 0)
			 {
				$total_3rd_re_sanforizing_qty = '';
			 }
			 if( $total_4th_re_sanforizing_qty == 0)
			 {
				$total_4th_re_sanforizing_qty = '';
			 }
			 


			 if( $total_process_qty == 0)
			 {
				$total_process_qty = '';
			 }
			 if( $total_process_short_excess_qty == 0)
			 {
				$total_process_short_excess_qty = '';
			 }
			 if( $total_greige_process_short_excess_qty == 0)
			 {
				$total_greige_process_short_excess_qty = '';
			 }
			 if( $total_reprocess_qty == 0)
			 {
				$total_reprocess_qty = '';
			 }

			 $table .='</tbody>';
			
			 $table .='<tr>
					<td style="border: 1px solid black; border-width: 1px 0px 1px 1px;"></td>
					<td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
					<td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
					<td style="border: 1px solid black;border-width: 1px 0px 1px 0px;"></td>
					 <td  style="border: 1px solid black;border-width: 1px 1px 1px 0px;" text-align:right; font-weight: bold;">Total Quantity :</td>
					 <td style="border: 1px solid black">'.$total_ppq_value.'</td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black">'.$total_gic_value.'</td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black">'.$total_greige_short_excess_qty.'</td>
					 <td style="border: 1px solid black"></td>

					 <td style="border: 1px solid black">'.$total_singeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_singeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_singeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_singeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_singeing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_desizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_desizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_desizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_desizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_desizing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_signe_desize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_signe_desize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_signe_desize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_signe_desize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_signe_desize_qty.'</td>

					 <td style="border: 1px solid black">'.$total_scouring_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_scouring_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_scouring_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_scouring_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_scouring_qty.'</td>

					 <td style="border: 1px solid black">'.$total_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_bleaching_qty.'</td>

					 <td style="border: 1px solid black">'.$total_scouring_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_scouring_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_scouring_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_scouring_bleaching_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_scouring_bleaching_qty.'</td>

					 <td style="border: 1px solid black">'.$total_ready_for_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_ready_for_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_ready_for_mercherize_qty.'</td>

					 <td style="border: 1px solid black">'.$total_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_mercherize_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_mercherize_qty.'</td>

					 <td style="border: 1px solid black">'.$total_ready_for_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_ready_for_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_ready_for_print_qty.'</td>

					 <td style="border: 1px solid black">'.$total_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_print_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_print_qty.'</td>
					 
					 <td style="border: 1px solid black">'.$total_curing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_curing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_curing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_curing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_curing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_steaming_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_steaming_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_steaming_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_steaming_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_steaming_qty.'</td>

					 <td style="border: 1px solid black">'.$total_ready_for_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_ready_for_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_ready_for_dyeing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_dyeing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_dyeing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_ready_for_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_ready_for_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_ready_for_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_ready_for_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_ready_for_raising_qty.'</td>

					 <td style="border: 1px solid black">'.$total_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_raising_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_raising_qty.'</td>

					 <td style="border: 1px solid black">'.$total_washing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_washing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_washing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_washing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_washing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_finishing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_finishing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_finishing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_finishing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_finishing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_calendering_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_calendering_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_calendering_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_calendering_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_calendering_qty.'</td>
					 
					 <td style="border: 1px solid black">'.$total_sanforizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_re_sanforizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_2nd_re_sanforizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_3rd_re_sanforizing_qty.'</td>
					 <td style="border: 1px solid black">'.$total_4th_re_sanforizing_qty.'</td>

					 <td style="border: 1px solid black">'.$total_process_qty.'</td>
					 <td style="border: 1px solid black">'.$total_process_short_excess_qty.'</td>
					 <td style="border: 1px solid black">'.$total_greige_process_short_excess_qty.'</td>
					 <td style="border: 1px solid black"></td>
					
					 <td style="border: 1px solid black">'.$total_reprocess_qty.'</td>
					
					
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>
					 <td style="border: 1px solid black"></td>

					</tr>';
	
		 $table .='</table>
			         </div>';

		 echo $table;


?>       


</div>  <!-- End of <div id="pp_proress_table_div"> -->




		          </div>  <!-- End of <div class="panel panel-default"> -->
    </div> <!-- End of  <div id="panel-default"> -->
  </div>    
                 

                 

