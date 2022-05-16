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
		document.getElementById('div_for_exprot_data_for_pp_progress_report').style.display = 'block';
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
	{   
		// alert(pp_number);
		$('#full_container').load('pp_progress_report/pp_status_report.php?all_data='+encodeURIComponent(pp_number));
	}


	
function change_up_down_arrow_icon(icon_lcation)
{
	
	
	//alert(icon_lcation);
	var class_name = $('#'+icon_lcation).attr('class');
    //alert(class_name);
	if(class_name=="glyphicon glyphicon-chevron-up text-right")
	{
		$('#'+icon_lcation).removeClass();
		$('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-down text-right");
	}
	else
	{
		$('#'+icon_lcation).removeClass();
		$('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-up text-right");
		
	}
	
	
} // End of function change_up_down_arrow_icon(icon_lcation)

</script>

<div id="full_container">

	<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default" id="panel_load_for_full_form">
		
			<div class="panel-heading" style="color:#191970;font-size:20px;font-weight:bold">
				<div class="row"  data-toggle="collapse" data-target="#search_form_collpapsible_div" onClick="change_up_down_arrow_icon(this.childNodes[5].childNodes[1].id)"> <!-- Row for Panel Heading and Chevron Up Alingment -->
					<span class="col-sm-11" style="text-align:center;"><b>PP Progres Report</b></span>
					<div  style="text-align:right; padding-right:10px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon'></i></div>
				</div> 
			</div> <!-- End of <div class="panel-heading" style="color:#191970;"> -->

			<div id='search_form_collpapsible_div' class="collapse in"> <!-- For Making Collapsible Section -->

				<div id="filter_div">
				
					<form id="filter_form_for_pp_progress" name="filter_form_for_pp_progress" >
						
					<div class="form-group form-group-sm" id="form-group_for_pp_number" >
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
							</div>

							<div class="col-sm-1" style="padding-left: 0px">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>

						<script>
							$( function() 
							{
								//$( "#from_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
								$( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
							} );

							$( function() 
							{
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
												?>
												<option value="<?php echo $row['current_state'];?>"><?php echo $row['current_state'];?></option>
												<?php
											}
										?>
								</select>
										
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_current_stauts"> -->

						<div class="form-group form-group-sm" id="form-group_for_from_week">
							<label class="control-label col-sm-4" for="from_week" style="margin-right:0px; color:#00008B;">From Week:</label>
							<div class="col-sm-5">
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

						<div class="form-group form-group-sm" id="form-group_for_to_week">
							<label class="control-label col-sm-4" for="to_week" style="margin-right:0px; color:#00008B;">To Week:</label>
							<div class="col-sm-5">
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
								<select class="form-control for_auto_complete" id="customer" name="customer">
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
								<select class="form-control for_auto_complete" id="construction_name" name="construction_name" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
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

						<div style="display: none;" id="div_for_exprot_data_for_pp_progress_report">
							<button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export Data</a></button>
						</div>

						<div class="form-group form-group-sm" id="form-group_for_process_type">
							<div class="col-sm-9">
								<br>
							</div>
						</div>

						<div class="form-group form-group-sm" id="form-group_for_process_type">
							<div class="col-sm-5">

							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-info" name="submit" onclick="get_pp_progress_data()">Filter</button> 
							</div>
							<div class="col-sm-1">
								<button type="reset" name="reset" id="reset" class="btn btn-primary">Reset</button>
							</div>
							<div class="col-sm-3">

							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_type"> -->

					</form>  <!--  End of <form id="filter_form_for_pp_progress"> -->
					
				</div>   <!-- End of filter_div -->
			</div>

			
		</div>   <!-- End of <div class="panel panel-default"> -->
		
		<div id="pp_progress_table_div" >
			<!-- style="margin-left: -70px;" -->
			</div>  <!-- End of <div id="pp_proress_table_div"> -->
		
	</div>  
</div>
      

                 

