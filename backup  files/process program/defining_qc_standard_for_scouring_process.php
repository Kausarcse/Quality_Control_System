<?php
session_start();
require_once("../login/session.php");
include('db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysqli_query($con,$sql) or die(mysqli_error()());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_scouring_process_form_validation.js'></script>
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
			 			    document.getElementById('greige_width').value=splitted_data[2]; 
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
  document.getElementById('greige_width').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('standard_for_which_process').value='Scouring'; 
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

 function sending_data_of_defining_qc_standard_for_scouring_process_form_for_saving_in_database()
 {


       var validate = Scouring_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_scouring_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_scouring_process_form_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_scouring_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Scouring Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_scouring_process_form" id="defining_qc_standard_for_scouring_process_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select PP Number</option>
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
											<option select="selected" value="select">Select Version Number</option>
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
						<input type="hidden" id="greige_width" name="greige_width"  value="">

						<div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
							<label class="control-label col-sm-3" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
							<input  type="text" class="form-control"  id="standard_for_which_process" name="standard_for_which_process"  value="" readonly>
							</div>
						</div> 
<!-- 
				    <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
						<label class="control-label col-sm-3" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="standard_for_which_process" name="standard_for_which_process">
											<option select="selected" value="select">Select Standard For Which Process</option>
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


						<!-- Start  <div class="form-group form-group-sm" id="form-group_for_absorbency_value"> -->

						<div class="form-group form-group-sm" id="form-group_for_absorbency_value">
							
							<label class="control-label col-sm-3" for="absorbency_value" style="color:#00008B; margin-top:23px;">Absorbency :</label>
							
							<div class="col-sm-1 text-center">
								<label for="absorbency_value" style="font-size:12px; color:#000066;">Value</label>
								<input type="text" class="form-control" id="absorbency_value" name="absorbency_value"  placeholder="Enter absorbency Value" onchange="absorbency_cal()"  required>
							</div>
								

							<input type="hidden" id="uom_of_absorbency" name="uom_of_absorbency"  value="Berger">
						
							<div class="col-sm-1 text-center" style="margin:0px; padding:0px;">
								<label for="absorbency_tolerance_range_math_operator" style="font-size:12px; color:#000066;opacity: 0.0;">Math Op.</label>

								<select  class="form-control" id="absorbency_tolerance_range_math_operator" name="absorbency_tolerance_range_math_operator" onchange="absorbency_cal()">
											<option select="selected" value="select">Select Absorbency Tolerance Range Math Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>
								 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								
							</div>
							<div class="col-sm-1 text-center">
									<label for="absorbency_tolerance_value" style="font-size:12px; color:#000066;">Tolerance</label>
									<input type="text" class="form-control" id="absorbency_tolerance_value" name="absorbency_tolerance_value" placeholder="Enter absorbency Value" onchange="absorbency_cal()" required>
								</div>
							
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center">
									<label for="absorbency_min_value" style="font-size:12px; color:#000066;">Minimum</label>
									
									<input type="text" class="form-control" id="absorbency_min_value" name="absorbency_min_value" placeholder="Enter absorbency Min Value" onchange="absorbency_cal()" required>
								</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
						
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center">
									<label for="absorbency_max_value" style="font-size:12px; color:#000066;">Maximum</label>
								
									<input type="text" class="form-control" id="absorbency_max_value" name="absorbency_max_value" placeholder="Enter absorbency Max Value" required>
								</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>
						
						
						</div><!-- End of <div class="form-group form-group-sm" id="form-group_for_absorbency_max_value"> -->



                         <!-- For residual_sizing_material_tolerance Start -->

						<div class="form-group form-group-sm" id="form-group_for_residual_sizing_material_tolerance">
							 <label class="control-label col-sm-3" for="residual_sizing_material_tolerance" style="color:#00008B;">Residual Sizing material Tolerance :</label>
							 							
							<div class="col-sm-1 text-center" for="value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="residual_sizing_material_value" name="residual_sizing_material_value" placeholder="Enter residual_sizing_material_tolerance Value" onchange="residual_sizing_material_cal()" required>
								
							</div>
							<div class="col-sm-1 text-center" for="mathematical_operator" style="margin:0px; padding:0px;">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<select  class="form-control" id="residual_sizing_material_tolerance_range_math_operator" name="residual_sizing_material_tolerance_range_math_operator" onchange="residual_sizing_material_cal()">
											<option select="selected" value="select">Select Mathematical Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>								
								
							</div>

							<!-- <input type="hidden" name="uom_of_residual_sizing_material_tolerance" id="uom_of_residual_sizing_material_tolerance" value="Berger"> -->
							<div class="col-sm-1 text-center" for="tolerance">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="residual_sizing_material_tolerance_value" name="residual_sizing_material_tolerance_value" placeholder="Enter residual_sizing_material_tolerance  Value" onchange="residual_sizing_material_cal()" required>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center" for="minimum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="residual_sizing_material_min_value" name="residual_sizing_material_min_value" placeholder="Enter residual_sizing_material Min Value" required>
								
							</div>
							
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="maximum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="residual_sizing_material_max_value" name="residual_sizing_material_max_value" placeholder="Enter residual_sizing_material_tolerance  Max Value" required>
								
							</div>
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>

							<input type="hidden" id="uom_of_residual_sizing_material" name="uom_of_residual_sizing_material" value="Celcius">
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_residual_sizing_material_tolerance_max_value"> -->



						<div class="form-group form-group-sm" id="form-group_for_pilling_iso_12945_2">
						
							<label class="control-label col-sm-3" for="pilling_iso_12945_2" style="color:#00008B;">Pilling (Iso 12945-2) :</label>							
							<div class="col-sm-1 text-center" for="value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="pilling_iso_12945_2_value" name="pilling_iso_12945_2_value" placeholder="Enter pilling_iso_12945_2_value" onchange="pilling_iso_12945_2_cal()" required>
								
							</div>
							<div class="col-sm-1 text-center" for="mathematical_operator" style="margin:0px; padding:0px;">
								 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								 <select  class="form-control" id="pilling_iso_12945_2_tolerance_range_math_operator" name="pilling_iso_12945_2_tolerance_range_math_operator" onchange="pilling_iso_12945_2_cal()">
											<option select="selected" value="select"> Select Tolerance Range Math Operator:</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>
							</div>
							<div class="col-sm-1 text-center" for="tolerance">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
									 <input type="text" class="form-control" id="pilling_iso_12945_2_tolerance_value" name="pilling_iso_12945_2_tolerance_value" onchange="pilling_iso_12945_2_cal()" placeholder="Enter pilling_iso_12945_2 Tolerance Value" required>
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center" for="minimum_value">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
									 <input type="text" class="form-control" id="pilling_iso_12945_2_min_value" name="pilling_iso_12945_2_min_value" placeholder="Enter pilling_iso_12945_2 Min Value" required>
							</div>
							
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="maximum_value">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
									 <input type="text" class="form-control" id="pilling_iso_12945_2_max_value" name="pilling_iso_12945_2_max_value" placeholder="Enter pilling_iso_12945_2 Max Value" required>
							</div>
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>
						
							<input type="hidden"  id="uom_of_pilling_iso_12945_2" name="uom_of_pilling_iso_12945_2" value="Meter/Minute">
						
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pilling_iso_12945_2"> -->

					 <!-- For PH Start -->

						<div class="form-group form-group-sm" id="form-group_for_ph">
							 <label class="control-label col-sm-3" for="ph" style="color:#00008B;">P<sup>H</sup> :</label>
							 							
							<div class="col-sm-1 text-center" for="value">
								<input type="text" class="form-control" id="ph_value" name="ph_value" placeholder="Enter PH Value" onchange="ph_value_cal()"  required>
								
							</div>
							<div class="col-sm-1 text-center" for="mathematical_operator" style="margin:0px; padding:0px;">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<select  class="form-control" id="ph_tolerance_range_math_operator" name="ph_tolerance_range_math_operator" onchange="ph_value_cal()" >
											<option select="selected" value="select">Select Mathematical Operator</option>
											<option value="+">+</option>
											<option value="-">-</option>
											<option value="+/-">+/-</option>
								</select>								
								
							</div>

							<!-- <input type="hidden" name="uom_of_ph" id="uom_of_ph" value="Berger"> -->
							<div class="col-sm-1 text-center" for="tolerance">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="ph_tolerance_value" name="ph_tolerance_value" placeholder="Enter PH  Tolerance Value" onchange="ph_value_cal()"  required>
								
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

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_scouring_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
		                       </div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->