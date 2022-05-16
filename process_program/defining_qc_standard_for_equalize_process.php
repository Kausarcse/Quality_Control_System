<?php
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$pp_number = $_GET['pp_number'];
$version_id = $_GET['version_number'];

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_equalize_process_form_validation.js'></script>
<script type='text/javascript' src='process_program/calculate_data_for_standards.js'></script>

<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

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

function Reset_Checkbox(checkbox_element)
{
		for(var i=0;i<checkbox_element.length;i++)
		{

				checkbox_element[i].checked = false;

		}
}
</script>

<script>

function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		url: 'process_program/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

                            /*var splitted_data= data.split('?fs?');*/
			 			    /*document.getElementById('customer_name').value=splitted_data[0]; 
			 			    document.getElementById('color').value=splitted_data[1]; 
			 			    document.getElementById('finish_width_in_inch').value=splitted_data[2]; 
			 			    document.getElementById('version_number').innerHTML=splitted_data[3]; */
			 				document.getElementById('version_number').innerHTML=data;
			 				
							
							//document.getElementById('test').innerHTML=data;
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

function fill_up_qc_standard_additional_info(version_details)
{  

  var splitted_version_details= version_details.split('?fs?');

/*  document.getElementById('version_name').value=splitted_version_details[0];
*/ document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('standard_for_which_process').value='Equalize'; 
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

 function sending_data_of_defining_qc_standard_for_equalize_process_form_for_saving_in_database()
 {


       var validate = Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_equalize_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_equalize_process_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_defining_qc_standard_for_equalize_process_form_for_saving_in_database()


 $(document).ready(function() {
	              $('#datatable-buttons').DataTable( {
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
	            } );
				
</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Equalize Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_equalize_process_form" id="defining_qc_standard_for_equalize_process_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option value="">Select PP Number</option>
											<?php 
												 $sql = 'select pp_number from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_version_number">
						<label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number" name="version_number" onchange="fill_up_qc_standard_additional_info(this.value)">
											<option value="">Select Version Number</option>
											<?php 
												 $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->
          

                        <input type="hidden" id="customer_name" name="customer_name" value="">
						<input type="hidden" id="color" name="color" value="" >
						<input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">

						<div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
							<label class="control-label col-sm-3" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
							<input  type="text" class="form-control"  id="standard_for_which_process" name="standard_for_which_process"  value="" readonly>
							</div>
						</div> 

				    <!-- <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
						<label class="control-label col-sm-3" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="standard_for_which_process" name="standard_for_which_process">
											<option value="">Select Standard For Which Process</option>
											<?php 
												 $sql = 'select process_name from `adding_process_to_version` order by `process_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process"> -->
	
						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

						

                       

						<div class="form-group form-group-sm" id="form-group_for_whiteness_value">
							
							<label class="control-label col-sm-3" for="whiteness_value" style="color:#00008B; margin-top:23px;">Whiteness (Barger):</label>
							
							<div class="col-sm-1 text-center">
								<label for="whiteness_value" style="font-size:12px; color:#000066;">Value</label>
								<input type="text" class="form-control" id="whiteness_value" name="whiteness_value"  placeholder="Enter whiteness Value" onchange="whiteness_cal_equalize()" required>
							</div>
								

							<div class="col-sm-1 text-center" style="margin:0px; padding:0px;">
								<label for="whiteness_tolerance_range_math_operator" style="font-size:12px; color:#000066;opacity: 0.0;">Math Op.</label>

								<select  class="form-control" id="whiteness_tolerance_range_math_operator" name="whiteness_tolerance_range_math_operator" onchange="whiteness_cal_equalize()">
											<option value="">Select Whiteness Tolerance Range Math Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>
								 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								
							</div>
							<div class="col-sm-1 text-center">
									<label for="whiteness_tolerance_value_in_percentage" style="font-size:12px; color:#000066;">Tolerance</label>
									<input type="text" class="form-control" id="whiteness_tolerance_value_in_percentage" name="whiteness_tolerance_value_in_percentage" placeholder="Enter Whiteness Value" onchange="whiteness_cal_equalize()" required>
								</div>
							
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center">
									<label for="whiteness_min_value" style="font-size:12px; color:#000066;">Minimum</label>
									
									<input type="text" class="form-control" id="whiteness_min_value" name="whiteness_min_value" placeholder="Enter Whiteness Min Value" required>
								</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
						
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center">
									<label for="whiteness_max_value" style="font-size:12px; color:#000066;">Maximum</label>
								
									<input type="text" class="form-control" id="whiteness_max_value" name="whiteness_max_value" placeholder="Enter Whiteness Max Value" required>
								</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>
						
						   
							<input type="hidden" id="uom_of_whiteness" name="uom_of_whiteness"  value="Berger">
						
						</div><!-- End of <div class="form-group form-group-sm" id="form-group_for_whiteness_max_value"> -->


					<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (End))*********************************** -->	

						<div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_value">
						
								<label class="control-label col-sm-3" for="bowing_and_skew_value" style="color:#00008B;">Bowing And Skew :</label>
							    <div class="col-sm-1 text-center" for="value">
									<input type="text" class="form-control" id="bowing_and_skew_value" name="bowing_and_skew_value" placeholder="Enter Bowing And Skew Value" onchange="bowing_and_skew_cal()" required>
								</div>
								
                        
						<!-- < class="form-group form-group-sm" id="form-group_for_uom_of_bowing_and_skew">
								<label class="control-label col-sm-3" for="uom_of_bowing_and_skew" style="color:#00008B;">Uom Of Bowing And Skew:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="uom_of_bowing_and_skew" name="uom_of_bowing_and_skew" placeholder="Enter Uom Of Bowing And Skew" required>
								</div>
							
						</div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_bowing_and_skew"> -->

						<div class="col-sm-1 text-center" for="group_for_bowing_and_skew_tolerance_range_math_operator" style="margin:0px; padding:0px;">
						
								<select  class="form-control" id="bowing_and_skew_tolerance_range_math_operator" name="bowing_and_skew_tolerance_range_math_operator" onchange="bowing_and_skew_cal()">
											<option value="">Select Bowing And Skew Tolerance Range Math Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_tolerance_range_math_operator"> -->

						<!-- <div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_tolerance_value_in_percentage">
								<label class="control-label col-sm-3" for="bowing_and_skew_tolerance_value_in_percentage" style="color:#00008B;">Bowing And Skew Tolerance Value In Percentage:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="bowing_and_skew_tolerance_value_in_percentage" name="bowing_and_skew_tolerance_value_in_percentage" placeholder="Enter Bowing And Skew Tolerance Value In Percentage" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('bowing_and_skew_tolerance_value_in_percentage')"></i>
						</div>  End of <div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_tolerance_value_in_percentage"> --> 
						<div class="col-sm-1 text-center" for="tolerance">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
									 <input type="text" class="form-control" id="bowing_and_skew_tolerance_value_in_percentage" name="bowing_and_skew_tolerance_value_in_percentage" placeholder="Enter Tolerance Value" onchange="bowing_and_skew_cal()" required>
						</div>
                    
						<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
							<!--  For Creating 1 Span Blank Space -->
						</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_bowing_and_skew_min_value">
								
									<input type="text" class="form-control" id="bowing_and_skew_min_value" name="bowing_and_skew_min_value" placeholder="Enter Bowing And Skew Min Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_min_value"> -->

					    <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_bowing_and_skew_max_value">
								
									<input type="text" class="form-control" id="bowing_and_skew_max_value" name="bowing_and_skew_max_value" placeholder="Enter Bowing And Skew Max Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_bowing_and_skew_max_value"> -->
                          <input type="hidden" name="uom_of_bowing_and_skew" id="uom_of_bowing_and_skew" value="%">
                  </div>
                   
                        <!-- For PH Start -->

						<div class="form-group form-group-sm" id="form-group_for_ph">
							 <label class="control-label col-sm-3" for="ph" style="color:#00008B;">P<sup>H </sup> :</label>
							 							
							<div class="col-sm-1 text-center" for="value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="ph_value" name="ph_value" placeholder="Enter PH Value" onchange="ph_value_equalize_cal()" required>
								
							</div>
							<div class="col-sm-1 text-center" for="mathematical_operator" style="margin:0px; padding:0px;">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<select  class="form-control" id="ph_tolerance_range_math_operator" name="ph_tolerance_range_math_operator" onchange="ph_value_equalize_cal()">
											<option value="">Select Mathematical Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>								
								
							</div>

							<!-- <input type="hidden" name="uom_of_ph" id="uom_of_ph" value="Berger"> -->
							<div class="col-sm-1 text-center" for="tolerance">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="ph_tolerance_value_in_percentage" name="ph_tolerance_value_in_percentage" placeholder="Enter PH  Tolerance Value" onchange="ph_value_equalize_cal()" required>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center" for="minimum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="ph_min_value" name="ph_min_value" placeholder="Enter PH Min Value" required>
								
							</div>
							
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="maximum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="ph_max_value" name="ph_max_value" placeholder="Enter PH  Max Value" required>
								
							</div>
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>

							<input type="hidden" id="uom_of_ph" name="uom_of_ph" value="Celcius">
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_ph_max_value"> -->

<!-- oldd -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_equalize_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->