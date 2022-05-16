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

$result=mysql_query($sql) or die(mysqli_error());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
?>




<script type='text/javascript' src='process_program/defining_qc_standard_for_finishing_process_form_validation.js'></script>
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

function reset_dropdown(select_element)
{

	  document.getElementById(select_element).selectedIndex = 0;

}
</script>

<script>

function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		/*url: 'process_program/returning_version_number_details.php',*/
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
*/  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('greige_width').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('standard_for_which_process').value='Finishing'; 
}/* End of function fill_up_qc_standard_additional_info(version_details)*/


 function sending_data_of_defining_qc_standard_for_finishing_process_form_for_saving_in_database()
 {


       var validate = Finishing_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_finishing_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_finishing_process_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_finishing_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Finishing Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_finishing_process_form" id="defining_qc_standard_for_finishing_process_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
						<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
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
						<label class="control-label col-sm-4" for="version_number" style="margin-right:0px; color:#00008B;">Version Number:</label>
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
							<label class="control-label col-sm-4" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
							<input  type="text" class="form-control"  id="standard_for_which_process" name="standard_for_which_process"  value="" readonly>
							</div>
						</div> 
<!-- 
				    <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
						<label class="control-label col-sm-4" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
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
						</div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process"> -->
						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

	<div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_dry_value">
		     <label class="control-label col-sm-4" for="cf_to_rubbing_dry_value" style="color:#00008B; margin-top:23px;">Color Fastness to Rubbing Dry :</label>
			
			<div class="col-sm-1 text-center">
				<label for="color_fastness_to_rubbing_dry_value" style="font-size:12px; color:#000066;">Value</label>
				
		            <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		        
			</div>
			 
			 <div class="col-sm-1 text-center" style="margin:0px; padding:0px;">
		     <label for="color_fastness_to_rubbing_dry_value" style="font-size:12px; color:#000066;opacity: 0.0;">Math Op.</label>
		      
                <select  class="form-control" id="cf_to_rubbing_dry_tolerance_range_math_operator" name="cf_to_rubbing_dry_tolerance_range_math_operator" onchange="cf_to_rubbing_dry_cal()">
                      <option select="selected" value="select">Select Color Fastness to Rubbing Dry Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->  
		     </div>
		        
		         
	          <div class="col-sm-1 text-center">
	              <label for="cf_to_rubbing_dry_tolerance_value" style="font-size:12px; color:#000066;">Tolerance</label>
	              <input type="text" class="form-control" id="cf_to_rubbing_dry_tolerance_value" name="cf_to_rubbing_dry_tolerance_value" placeholder="Enter Color Fastness to Rubbing Dry Value"  required onchange="cf_to_rubbing_dry_cal()">
	            </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
		          <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
		            <!--  For Creating 1 Span Blank Space -->
		          </div>
		          
		          <div class="col-sm-1 text-center">
		              <label for="cf_to_rubbing_dry_value" style="font-size:12px; color:#000066;">Minimum</label>
		              
		              <input type="text" class="form-control" id="cf_to_rubbing_dry_min_value" name="cf_to_rubbing_dry_min_value" placeholder="Enter Color Fastness to Rubbing Dry Min Value" required>
		            </div>
		            
		               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		        
		          <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
		            <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
		            
		          </div>
		          
		          <div class="col-sm-1 text-center">
		              <label for="color_fastness_to_rubbing_dry_max_value" style="font-size:12px; color:#000066;">Maximum</label>
		            
		              <input type="text" class="form-control" id="cf_to_rubbing_dry_max_value" name="cf_to_rubbing_dry_max_value" placeholder="Enter Color Fastness to Rubbing Dry Max Value" required>
		            </div>
		            
		               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
		          
		          <div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
		          
		            <!-- Remaining 2 Span of Bootstrap -->
		          
		          </div>
		            <input type="hidden" id="uom_of_cf_to_rubbing_dry" name="uom_of_cf_to_rubbing_dry"  value="uom_of_cf_to_rubbing_dry">

     </div><!-- End of <div class="form-group form-group-sm" id="form-group_for_color_fastness_to_rubbing_dry_max_value"> -->

						
  <div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_wet_value">
            
                <label class="control-label col-sm-4" for="cf_to_rubbing_wet" style="color:#00008B;">Color Fastness to Rubbing Wet :</label>
                  <div class="col-sm-1 text-center" for="value">
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>
                
                      
            <!-- < class="form-group form-group-sm" id="form-group_for_uom_of_cf_to_rubbing_wet">
                <label class="control-label col-sm-4" for="uom_of_cf_to_rubbing_wet" style="color:#00008B;">Uom Of Bowing And Skew:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="uom_of_cf_to_rubbing_wet" name="uom_of_cf_to_rubbing_wet" placeholder="Enter Uom Of Bowing And Skew" required>
                </div>
              
            </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_cf_to_rubbing_wet"> -->

            <div class="col-sm-1 text-center" for="group_for_cf_to_rubbing_wet_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="cf_to_rubbing_wet_tolerance_range_math_operator" name="cf_to_rubbing_wet_tolerance_range_math_operator" onchange="cf_to_rubbing_wet_cal()">
                      <option select="selected" value="select">Select Color Fastness to Rubbing Wet Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_wet_tolerance_range_math_operator"> -->

  
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="cf_to_rubbing_wet_tolerance_value" name="cf_to_rubbing_wet_tolerance_value" placeholder="Enter Tolerance Value" onchange="cf_to_rubbing_wet_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_cf_to_rubbing_wet_min_value">
                
                  <input type="text" class="form-control" id="cf_to_rubbing_wet_min_value" name="cf_to_rubbing_wet_min_value" placeholder="Enter Color Fastness to Rubbing Wet Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_wet_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_cf_to_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="cf_to_rubbing_wet_max_value" name="cf_to_rubbing_wet_max_value" placeholder="Enter Color Fastness to Rubbing Wet Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_wet_max_value"> -->
                  <input type="hidden" name="uom_of_cf_to_rubbing_wet" id="uom_of_cf_to_rubbing_wet" value="Berger">
          </div>   <!-- End of   <div class="form-group form-group-sm" id="form-group_for_cf_to_rubbing_wet_value"> -->

						<!-- For change_in_warp_for_washing_before_iron Start -->

				<div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_washing_before_iron">
					 <label class="control-label col-sm-4" for="change_in_warp_for_washing_before_iron" style="color:#00008B;">Change in Warp for Washing Before Iron :</label>
					 							
					<div class="col-sm-1 text-center" for="value">
						<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
						
					</div>
					<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
						<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
						<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
						
					</div>

					<!-- <input type="hidden" name="uom_of_change_in_warp_for_washing_before_iron" id="uom_of_change_in_warp_for_washing_before_iron" value="Berger"> -->
					<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
						<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
						<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
						
					</div>
					<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
						<!--  For Creating 1 Span Blank Space -->
					</div>
					
					<div class="col-sm-1 text-center" for="minimum_value">
						<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
						<input type="text" class="form-control" id="change_in_warp_for_washing_before_iron_min_value" name="change_in_warp_for_washing_before_iron_min_value" placeholder="Enter Change in Wrp for Washing Before Iron Value Min Value" required>
						
					</div>
					
					<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
						<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
						<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
						
					</div>
					
					<div class="col-sm-1 text-center" for="maximum_value">
						<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
						<input type="text" class="form-control" id="change_in_warp_for_washing_before_iron_max_value" name="change_in_warp_for_washing_before_iron_max_value" placeholder="Enter Wrp for Washing Before Iron  Max Value" required>
						
					</div>
					
					<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
					
						<!-- Remaining 2 Span of Bootstrap -->
					
					</div>

					<input type="hidden" id="uom_of_change_in_warp_for_washing_before_iron" name="uom_of_change_in_warp_for_washing_before_iron" value="Celcius">
					
				</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_washing_before_iron_max_value"> -->


                <!-- For change_in_weft_for_washing_before_iron Start -->

						<div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_washing_before_iron">
							 <label class="control-label col-sm-4" for="change_in_weft_for_washing_before_iron" style="color:#00008B;">Change in weft for Washing Before Iron :</label>
							 							
							<div class="col-sm-1 text-center" for="value">
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

							<!-- <input type="hidden" name="uom_of_change_in_weft_for_washing_before_iron" id="uom_of_change_in_weft_for_washing_before_iron" value="Berger"> -->
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center" for="minimum_value">
								
								<input type="text" class="form-control" id="change_in_weft_for_washing_before_iron_min_value" name="change_in_weft_for_washing_before_iron_min_value" placeholder="Enter Change in weft for Washing Before Iron Value Min Value" required>
								
							</div>
							
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="maximum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="change_in_weft_for_washing_before_iron_max_value" name="change_in_weft_for_washing_before_iron_max_value" placeholder="Enter Wrp for Washing Before Iron  Max Value" required>
								
							</div>
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>

							<input type="hidden" id="uom_of_change_in_weft_for_washing_before_iron" name="uom_of_change_in_weft_for_washing_before_iron" value="Celcius">
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_washing_before_iron_max_value"> -->

  
                
                  <!-- Start change_in_warp_for_washing_after_iron -->
                  <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_washing_after_iron_value">
							
					        <label class="control-label col-sm-4" for="change_in_warp_for_washing_after_iron" style="color:#00008B;">Change in warp for Washing After Iron :</label>
							
							 <div class="col-sm-1 text-center" for="value">
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

							<!-- <input type="hidden" name="uom_of_change_in_warp_for_washing_before_iron" id="uom_of_change_in_warp_for_washing_before_iron" value="Berger"> -->
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>							
							<div class="col-sm-1 text-center" for="maximum_value" id="form_change_in_warp_for_washing_after_iron_min_value">
									
									
									<input type="text" class="form-control" id="change_in_warp_for_washing_after_iron_min_value" name="change_in_warp_for_washing_after_iron_min_value" placeholder="Enter change_in_warp_for_washing_after_iron Min Value" required>
							</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
						
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="minumum_value" id="form-change_in_warp_for_washing_after_iron_max_value">
									
									<input type="text" class="form-control" id="change_in_warp_for_washing_after_iron_max_value" name="change_in_warp_for_washing_after_iron_max_value" placeholder="Enter change_in_warp_for_washing_after_iron Max Value" required>
							</div>
								
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>
						
						    <input type="hidden" id="uom_of_change_in_warp_for_washing_after_iron" name="uom_of_change_in_warp_for_washing_after_iron"  value="uom_of_change_in_warp_for_washing_after_iron">
						</div><!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_washing_after_iron_max_value"> -->




<!-- oldd -->       <!--  Start change_in_weft_for_washing_afer_iron -->
                        

                        <div class="form-group form-group-sm" id="form-change_in_weft_for_washing_afer_iron">
						
								<label class="control-label col-sm-4" for="change_in_weft_for_washing_afer_iron" style="color:#00008B;">Change in Weft for Washing After Iron :</label>
							    
						    <div class="col-sm-1 text-center" for="value">
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

							<!-- <input type="hidden" name="uom_of_change_in_warp_for_washing_before_iron" id="uom_of_change_in_warp_for_washing_before_iron" value="Berger"> -->
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_change_in_weft_for_washing_afer_iron">
								
							<input type="text" class="form-control" id="change_in_weft_for_washing_after_iron_min_value" name="change_in_weft_for_washing_after_iron_min_value" placeholder="Enter Change in Weft for Washing After Iron Min Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_washing_before_iron_min_value"> -->

					    <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_change_in_weft_for_washing_before_iron_max_value">
								
							<input type="text" class="form-control" id="change_in_weft_for_washing_after_iron_max_value" name="change_in_weft_for_washing_after_iron_max_value" placeholder="Enter Change in Weft for Washing Before Iron Max Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_washing_before_iron_max_value"> -->
                         <input type="hidden" name="uom_of_change_in_weft_for_washing_after_iron" id="uom_of_change_in_weft_for_washing_after_iron" value="uom_of_change_in_weft_for_washing_after_iron">
                  </div>
<!--                      end of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_washing_after_iron_value">
 -->
                  


						
                  <!-- Start <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_dry_cleaning"> -->

                  <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_dry_cleaning">
							 <label class="control-label col-sm-4" for="change_in_warp_for_dry_cleaning" style="color:#00008B;">Change in Warp for Dry Cleaning:</label>
							 							
							<div class="col-sm-1 text-center" for="value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1 text-center" for="mathematical_operator" style="margin:0px; padding:0px;">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>								
								
							</div>

							<!-- <input type="hidden" name="uom_of_change_in_warp_for_dry_cleaning" id="uom_of_change_in_warp_for_dry_cleaning" value="Berger"> -->
							<div class="col-sm-1 text-center" for="tolerance">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
							<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
								<!--  For Creating 1 Span Blank Space -->
							</div>
							
							<div class="col-sm-1 text-center" for="minimum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="change_in_warp_for_dry_cleaning_min_value" name="change_in_warp_for_dry_cleaning_min_value" placeholder="Enter change_in_warp_for_dry_cleaning Min Value" required>
								
							</div>
							
							<div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>
							
							<div class="col-sm-1 text-center" for="maximum_value">
								<!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
								<input type="text" class="form-control" id="change_in_warp_for_dry_cleaning_max_value" name="change_in_warp_for_dry_cleaning_max_value" placeholder="Enter change_in_warp_for_dry_cleaning  Max Value" required>
								
							</div>
							
							<div class="col-sm-2" for="remaining_two_spans_of_bootstrap">
							
								<!-- Remaining 2 Span of Bootstrap -->
							
							</div>

							<input type="hidden" id="uom_of_change_in_warp_for_dry_cleaning" name="uom_of_change_in_warp_for_dry_cleaning" value="Celcius">
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_warp_for_dry_cleaning_max_value"> -->

                   
                   <!-- Start <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_value"> -->

                       <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_value">
						
								<label class="control-label col-sm-4" for="change_in_weft_for_dry_cleaning" style="color:#00008B;">Change in Weft for Dry Cleaning:</label>
							    <div class="col-sm-1 text-center" for="value">
									<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								</div>
								
                        
						

						<div class="col-sm-1 text-center" for="group_for_change_in_weft_for_dry_cleaning_tolerance_range_math_operator" style="margin:0px; padding:0px;">
						    <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
							
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_tolerance_range_math_operator"> -->

						 
						<div class="col-sm-1 text-center" for="tolerance">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
					         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
						</div>
                    
						<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
							<!--  For Creating 1 Span Blank Space -->
						</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form_group_for_change_in_weft_for_dry_cleaning_min_value">
								
						   <input type="text" class="form-control" id="change_in_weft_for_dry_cleaning_min_value" name="change_in_weft_for_dry_cleaning_min_value" placeholder="Enter Weft Yarn Count Min Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_min_value"> -->

					    <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_change_in_weft_for_dry_cleaning_max_value">
								
									<input type="text" class="form-control" id="change_in_weft_for_dry_cleaning_max_value" name="change_in_weft_for_dry_cleaning_max_value" placeholder="Enter Weft Yarn Count Max Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_max_value"> -->
							<input type="hidden" name="uom_of_change_in_weft_for_dry_cleaning" id="uom_of_change_in_weft_for_dry_cleaning" value="uom_of_change_in_weft_for_dry_cleaning">

                  </div>




						
<!--  start of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_value">
 -->

            <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_value">
            
                <label class="control-label col-sm-4" for="warp_yarn_count_value" style="color:#00008B;">Warp Yarn Count :</label>
                  <div class="col-sm-1 text-center" for="value">
                   <input type="text" class="form-control" id="warp_yarn_count_value" name="warp_yarn_count_value" placeholder="Enter Warp Yarn Count Value" onchange="warp_yarn_count_cal()" required>
                </div>
                
            

            <div class="col-sm-1 text-center" for="group_for_warp_yarn_count_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="warp_yarn_count_tolerance_range_math_operator" name="warp_yarn_count_tolerance_range_math_operator" onchange="warp_yarn_count_cal()">
                      <option select="selected" value="select">Select Warp Yarn CountTolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="+/-">+/-</option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_tolerance_range_math_operator"> -->

            
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="warp_yarn_count_tolerance_value" name="warp_yarn_count_tolerance_value" placeholder="Enter Tolerance Value" onchange="warp_yarn_count_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              
                <select  class="form-control" id="uom_of_warp_yarn_count_value" name="uom_of_warp_yarn_count_value">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tensile Properties</option>
                      <option value="Ne">Ne</option>
                      <option value="NM">NM</option>
                      <option value="DEN">DEN</option>
                      <option value="TEX">TEX</option>
                      <option value="DTEX">DTEX</option>
                </select>
              
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_warp_yarn_count_min_value">
                
                  <input type="text" class="form-control" id="warp_yarn_count_min_value" name="warp_yarn_count_min_value" placeholder="Enter Warp Yarn CountMin Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_warp_yarn_count_max_value">
                
                  <input type="text" class="form-control" id="warp_yarn_count_max_value" name="warp_yarn_count_max_value" placeholder="Enter Warp Yarn CountMax Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_max_value"> -->
<!--                         <input type="hidden" name="uom_of_warp_yarn_count" id="uom_of_warp_yarn_count" value="uom_of_warp_yarn_count">
 -->
        </div>  <!-- end -->
                          
                          
<!--  start of <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count_value">
 -->

            <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count_value">
            
                <label class="control-label col-sm-4" for="weft_yarn_count_value" style="color:#00008B;">Weft Yarn Count :</label>
                  <div class="col-sm-1 text-center" for="value">
                   <input type="text" class="form-control" id="weft_yarn_count_value" name="weft_yarn_count_value" placeholder="Enter weft Yarn Count Value" onchange="weft_yarn_count_cal()" required>
                </div>
                
            

            <div class="col-sm-1 text-center" for="group_for_weft_yarn_count_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="weft_yarn_count_tolerance_range_math_operator" name="weft_yarn_count_tolerance_range_math_operator" onchange="weft_yarn_count_cal()">
                      <option select="selected" value="select">Select weft Yarn CountTolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="+/-">+/-</option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count_tolerance_range_math_operator"> -->

            
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="weft_yarn_count_tolerance_value" name="weft_yarn_count_tolerance_value" placeholder="Enter Tolerance Value" onchange="weft_yarn_count_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              
                <select  class="form-control" id="uom_of_weft_yarn_count_value" name="uom_of_weft_yarn_count_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tensile Properties</option>
                      <option value="Ne">Ne</option>
                      <option value="NM">NM</option>
                      <option value="DEN">DEN</option>
                      <option value="TEX">TEX</option>
                      <option value="DTEX">DTEX</option>
                </select>
              
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_weft_yarn_count_min_value">
                
                  <input type="text" class="form-control" id="weft_yarn_count_min_value" name="weft_yarn_count_min_value" placeholder="Enter weft Yarn CountMin Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_weft_yarn_count_max_value">
                
                  <input type="text" class="form-control" id="weft_yarn_count_max_value" name="weft_yarn_count_max_value" placeholder="Enter weft Yarn CountMax Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count_max_value"> -->
<!--                         <input type="hidden" name="uom_of_weft_yarn_count" id="uom_of_weft_yarn_count" value="uom_of_weft_yarn_count">
 -->
           </div>  <!-- end -->         





					      <!--  Start <div class="form-group form-group-sm" id="form-group_for_mass_per_unit_per_area_value"> -->


       <div class="form-group form-group-sm" id="form-group_for_mass_per_unit_per_area_value">
            
                <label class="control-label col-sm-4" for="mass_per_unit_per_area_value" style="color:#00008B;">Mass Per Unit per Area :</label>
                  <div class="col-sm-1 text-center" for="value">
                   <input type="text" class="form-control" id="mass_per_unit_per_area_value" name="mass_per_unit_per_area_value" placeholder="Mass Per Area Value" onchange="mass_per_unit_per_area_cal()" required>
                </div>
                
            

            <div class="col-sm-1 text-center" for="group_for_mass_per_unit_per_area_tolerance_range_math_operator" style="margin:0px; padding:0px;">

            	<input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_range_math_operator" name="mass_per_unit_per_area_tolerance_range_math_operator" onchange="mass_per_unit_per_area_cal()" placeholder="For +" required>
            
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_tolerance_range_math_operator"> -->

            
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_value" name="mass_per_unit_per_area_tolerance_value" onchange="mass_per_unit_per_area_cal()" placeholder="For -" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              
                <select  class="form-control" id="uom_of_mass_per_unit_per_area_value" name="uom_of_mass_per_unit_per_area_value">
                      <option select="selected" value="select">Select Uom Of Mass Per Unit per Area </option>
                      <option value="Ne">Ne</option>
                      <option value="NM">NM</option>
                      <option value="DEN">DEN</option>
                      <option value="TEX">TEX</option>
                      <option value="DTEX">DTEX</option>
                </select>
              
            </div>  <!-- End of <div class="form-group form-group-sm" id="form-group_for_mass_per_unit_per_area_value"> -->

                     <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_mass_per_unit_per_area_min_value">
                
                  <input type="text" class="form-control" id="mass_per_unit_per_area_min_value" name="mass_per_unit_per_area_min_value" placeholder="Enter Mass Per Unit per Area Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_mass_per_unit_per_area_max_value">
                
                  <input type="text" class="form-control" id="mass_per_unit_per_area_max_value" name="mass_per_unit_per_area_max_value" placeholder="Enter Mass Per Unit per Area Max Value" required>

                     </div>

                     <input type="hidden" name="uom_of_mass_per_unit_per_area" id="uom_of_mass_per_unit_per_area" value="uom_of_mass_per_unit_per_area">
                  </div><!--  End of  mass_per_unit_per_area -->


<!--  Start of no_of_threads_in_warp -->

              <div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_warp_value">
            
                <label class="control-label col-sm-4" for="no_of_threads_in_warp_value" style="color:#00008B;">No of Threads in Warp :</label>
                  <div class="col-sm-1 text-center" for="value">
                  <input type="text" class="form-control" id="no_of_threads_in_warp_value" name="no_of_threads_in_warp_value" placeholder="Enter No of Threads in Warp Yarn Count" onchange="no_of_threads_in_warp_cal()" required>
                </div>
                
            

            <div class="col-sm-1 text-center" for="group_for_no_of_threads_in_warp_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="no_of_threads_in_warp_tolerance_range_math_operator" name="no_of_threads_in_warp_tolerance_range_math_operator" onchange="no_of_threads_in_warp_cal()">
                      <option select="selected" value="select">Select No of Threads Count Tolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="+/-">+/-</option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_tolerance_range_math_operator"> -->

            
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="no_of_threads_in_warp_tolerance_value" name="no_of_threads_in_warp_tolerance_value" placeholder="Enter Tolerance Value" onchange="no_of_threads_in_warp_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              
                <select  class="form-control" id="uom_of_no_of_threads_in_warp_value" name="uom_of_no_of_threads_in_warp_value">
                      <option select="selected" value="select">Select Uom Of No of Threads in Warp Properties</option>
                      <option value="th/inch">th/inch</option>
                      <option value="th/cm">th/cm</option>
                      
                </select>
              
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_no_of_threads_in_warp_min_value">
                
                  <input type="text" class="form-control" id="no_of_threads_in_warp_min_value" name="no_of_threads_in_warp_min_value" placeholder="Enter No of  Threads in Warp Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_no_of_threads_in_warp_max_value">
                
              <input type="text" class="form-control" id="no_of_threads_in_warp_max_value" name="no_of_threads_in_warp_max_value" placeholder="Enter No of Threads in Warp Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_max_value"> -->
<!--                         <input type="hidden" name="uom_of_warp_yarn_count" id="uom_of_warp_yarn_count" value="uom_of_warp_yarn_count">
 -->               <input type="hidden" name="uom_of_mass_per_unit_per_area" id="uom_of_warp_yarn_count" value="uom_of_warp_yarn_count">
                  </div>  <!-- End of no of warp threads -->




					<!--  Start of no_of_threads_in_weft -->

              <div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_weft_value">
            
                <label class="control-label col-sm-4" for="no_of_threads_in_weft_value" style="color:#00008B;">No of Threads in Weft :</label>
                  <div class="col-sm-1 text-center" for="value">
                  <input type="text" class="form-control" id="no_of_threads_in_weft_value" name="no_of_threads_in_weft_value" placeholder="Enter No of Threads in Warp Yarn Count" onchange="no_of_threads_in_weft_cal()" required>
                </div>
                
            

            <div class="col-sm-1 text-center" for="group_for_no_of_threads_in_weft_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="no_of_threads_in_weft_tolerance_range_math_operator" name="no_of_threads_in_weft_tolerance_range_math_operator" onchange="no_of_threads_in_weft_cal()">
                      <option select="selected" value="select">Select No of Threads Count Tolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="+/-">+/-</option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_tolerance_range_math_operator"> -->

            
            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="no_of_threads_in_weft_tolerance_value" name="no_of_threads_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="no_of_threads_in_weft_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              
                <select  class="form-control" id="uom_of_no_of_threads_in_weft_value" name="uom_of_no_of_threads_in_weft_value" >
                      <option select="selected" value="select">Select Uom Of No of Threads in Weft Properties</option>
                      <option value="th/inch">th/inch</option>
                      <option value="th/cm">th/cm</option>
                      
                </select>
              
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_no_of_threads_in_weft_min_value">
                
                  <input type="text" class="form-control" id="no_of_threads_in_weft_min_value" name="no_of_threads_in_weft_min_value"  placeholder="Enter No of  Threads in Weft Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_no_of_threads_in_weft_max_value">
                
                  <input type="text" class="form-control" id="no_of_threads_in_weft_max_value" name="no_of_threads_in_weft_max_value" placeholder="Enter No of Threads in Weft Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count_max_value"> -->
<!--                         <input type="hidden" name="uom_of_warp_yarn_count" id="uom_of_warp_yarn_count" value="uom_of_warp_yarn_count">
 -->              <input type="hidden" name="uom_of_no_of_threads_in_weft" id="uom_of_no_of_threads_in_weft" value="uom_of_no_of_threads_in_weft">
                  </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_weft_value"> -->




					<!-- Start <div class="form-group form-group-sm" id="form-group_for_surface_fuzzing_and_pilling_value"> -->

					<div class="form-group form-group-sm" id="form-group_for_surface_fuzzing_and_pilling_value">
						
								<label class="control-label col-sm-4" for="rubbing_wet" style="color:#00008B;">Surface Fuzzing and Pilling :</label>
							    
						  <div class="col-sm-1 text-center" for="line_creation">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
							</div>	
						<!-- < class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry">
								<label class="control-label col-sm-4" for="uom_of_rubbing_dry" style="color:#00008B;">Uom Of Rubbing Wet:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="uom_of_rubbing_dry" name="uom_of_rubbing_dry" placeholder="Enter Uom Of Rubbing Wet" required>
								</div>
							
						</div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry"> -->

						 <div class="col-sm-1 text-center" for="group_for_surface_fuzzing_and_pilling_tolerance_range_math_operator" style="margin:0px; padding:0px;">
							
									<select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_range_math_operator" name="surface_fuzzing_and_pilling_tolerance_range_math_operator" onchange="surface_fuzzing_and_pilling_cal()">
												<option select="selected" value="select">Select Surface Fuzzing and Pilling Tolerance Range Math Operator</option>
												<option value="≥">≥</option>
												<option value="≤"> ≤ </option>
									</select>
								
						 </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->

                       

						<div class="col-sm-1 text-center" for="tolerance">
									 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
									 <!-- <input type="text" class="form-control" id="surface_fuzzing_and_pilling_tolerance_value" name="surface_fuzzing_and_pilling_tolerance_value" placeholder="Enter Tolerance Value" required>
 -->
									 <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_value" name="surface_fuzzing_and_pilling_tolerance_value" onchange="surface_fuzzing_and_pilling_cal()">
												<option select="selected" value="select">Select Surface Fuzzing and Pilling Tolerance Value</option>
												<option value="1.0">1</option>
												<option value="1.5">1-2</option>
												<option value="2.0"> 2 </option>
												<option value="2.5"> 2-3 </option>
												<option value="3.0">3</option>
												<option value="3.5">3-4</option>
												<option value="4.0"> 4 </option>
												<option value="4.5"> 4-5 </option>
												<option value="5.0"> 5 </option>
									</select>
						</div>
                    
						<div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
							<!--  For Creating 1 Span Blank Space -->
							=
						</div>


						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_surface_fuzzing_and_pilling_min_value">
								
									<input type="text" class="form-control" id="surface_fuzzing_and_pilling_min_value" name="surface_fuzzing_and_pilling_min_value" placeholder="Enter Surface Fuzzing and Pilling Min Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

					    <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
								<!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
								<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
								
						</div>

						<div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_rubbing_wet_max_value">
								
									<input type="text" class="form-control" id="surface_fuzzing_and_pilling_max_value" name="surface_fuzzing_and_pilling_max_value" placeholder="Enter Surface Fuzzing and Pilling Max Value" required>
								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                         <input type="hidden" name="uom_of_surface_fuzzing_and_pilling_value" id="uom_of_surface_fuzzing_and_pilling_value" value="uom_of_surface_fuzzing_and_pilling">
                  </div>    <!-- end of surface_fuzzing_and_pilling -->
                   
                  


          <div class="form-group form-group-sm" id="form-group_for_warp_yarn_tensile_properties_tolerance_value">

          	 <label class="control-label col-sm-4" for="rubbing_wet" style="color:#00008B;">Warp Yarn Tensile Properties  :</label>

          	 <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
			 <div class="col-sm-1 text-center" for="group_for_warp_yarn_tensile_properties_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="tensile_properties_in_warp_value_tolerance_range_math_operator" name="tensile_properties_in_warp_value_tolerance_range_math_operator" onchange="tensile_properties_in_warp()">
                      <option select="selected" value="select">Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="tensile_properties_in_warp_value_tolerance_value" name="tensile_properties_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tensile_properties_in_warp()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_mass_per_unit_per_area_properties" name="uom_of_mass_per_unit_per_area_properties">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tensile Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_warp_yarn_tensile_properties_min_value">
                
                  <input type="text" class="form-control" id="tensile_properties_in_warp_value_min_value" name="tensile_properties_in_warp_value_min_value" placeholder="Enter Warp Yarn Tensile Properties Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="tensile_properties_in_warp_value_max_value" name="tensile_properties_in_warp_value_max_value" placeholder="Enter Warp Yarn Tensile Properties Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                         <input type="hidden" name="uom_of_tensile_properties_in_warp_value" id="uom_of_tensile_properties_in_warp_value" value="uom_of_tensile_properties_in_warp_value">
           </div>    <!-- end of warp_yarn_tensile_properties -->

          

            <div class="form-group form-group-sm" id="form-group_for_weft_yarn_tensile_properties_tolerance_value">

             <label class="control-label col-sm-4" for="weft_yarn_tensile_properties" style="color:#00008B;">Weft Yarn Tensile Properties  :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="group_for_weft_yarn_tensile_properties_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="tensile_properties_in_weft_value_tolerance_range_math_operator" name="tensile_properties_in_weft_value_tolerance_range_math_operator" onchange="tensile_properties_in_weft()">
                      <option select="selected" value="select">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="tensile_properties_in_weft_value_tolerance_value" name="tensile_properties_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tensile_properties_in_weft()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_mass_per_unit_per_area_properties" name="uom_of_mass_per_unit_per_area_properties">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tensile Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_weft_yarn_tensile_properties_min_value">
                
                  <input type="text" class="form-control" id="tensile_properties_in_weft_value_min_value" name="tensile_properties_in_weft_value_min_value" placeholder="Enter weft Yarn Tensile Properties Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="tensile_properties_in_weft_value_max_value" name="tensile_properties_in_weft_value_max_value" placeholder="Enter weft Yarn Tensile Properties Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                         <input type="hidden" name="uom_of_tensile_properties_in_weft_value" id="uom_of_tensile_properties_in_weft_value" value="uom_of_tensile_properties_in_weft_value">
           </div>    <!-- end of weft_yarn_tensile_properties -->




						  <!-- Start <div class="form-group form-group-sm" id="form-group_for_tear_force_in_warp_value"> -->

           <div class="form-group form-group-sm" id="form-group_for_tear_force_in_warp_value">
            
                <label class="control-label col-sm-4" for="tear_force_in_warp_tolerance" style="color:#00008B;">Warp Yarn Tear Force:</label>
                  
              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>  
            <!-- < class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry">
                <label class="control-label col-sm-4" for="uom_of_rubbing_dry" style="color:#00008B;">Uom Of Rubbing Wet:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="uom_of_rubbing_dry" name="uom_of_rubbing_dry" placeholder="Enter Uom Of Rubbing Wet" required>
                </div>
              
            </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry"> -->

            <div class="col-sm-1 text-center" for="group_for_tear_force_in_warp_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="tear_force_in_warp_value_tolerance_range_math_operator" name="tear_force_in_warp_value_tolerance_range_math_operator" onchange="tear_force_in_warp_cal()">
                      <option select="selected" value="select">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->

                       

            <div class="col-sm-1 text-center" for="tear_force_in_warp_value_tolerance_value">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="tear_force_in_warp_value_tolerance_value" name="tear_force_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tear_force_in_warp_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_tear_force_in_warp_value" name="uom_of_tear_force_in_warp_value">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tear Force Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_tear_force_in_warp_value_min_value">
                
                  <input type="text" class="form-control" id="tear_force_in_warp_value_min_value" name="tear_force_in_warp_value_min_value" placeholder="Enter Warp Yarn Tear Force Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="tear_force_in_warp_value_max_value" name="tear_force_in_warp_value_max_value" placeholder="Enter Warp Yarn Tear ForceMax Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                      
         </div>    <!-- end of tear_force_in_warp -->

					  <!-- Start <div class="form-group form-group-sm" id="form-group_for_tear_force_in_warp_value"> -->

             <!-- Start <div class="form-group form-group-sm" id="form-group_for_tear_force_in_weft_value"> -->

           <div class="form-group form-group-sm" id="form-group_for_tear_force_in_weft_value">
            
                <label class="control-label col-sm-4" for="tear_force_in_weft_tolerance" style="color:#00008B;">Weft Yarn Tear Force:</label>
                  
              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
              </div>  
            <!-- < class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry">
                <label class="control-label col-sm-4" for="uom_of_rubbing_dry" style="color:#00008B;">Uom Of Rubbing Wet:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="uom_of_rubbing_dry" name="uom_of_rubbing_dry" placeholder="Enter Uom Of Rubbing Wet" required>
                </div>
              
            </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry"> -->

            <div class="col-sm-1 text-center" for="group_for_tear_force_in_weft_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="tear_force_in_weft_value_tolerance_range_math_operator" name="tear_force_in_weft_value_tolerance_range_math_operator" onchange="tear_force_in_weft_cal()">
                      <option select="selected" value="select">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->

                       

            <div class="col-sm-1 text-center" for="tear_force_in_weft_value_tolerance_value">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="tear_force_in_weft_value_tolerance_value" name="tear_force_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tear_force_in_weft_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_tear_force_in_weft_value" name="uom_of_tear_force_in_weft_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tear Force Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_tear_force_in_weft_value_min_value">
                
                  <input type="text" class="form-control" id="tear_force_in_weft_value_min_value" name="tear_force_in_weft_value_min_value" placeholder="Enter weft Yarn Tear Force Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="tear_force_in_weft_value_max_value" name="tear_force_in_weft_value_max_value" placeholder="Enter weft Yarn Tear Force Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                      
         </div>    <!-- end of tear_force_in_weft -->

						  <!-- Start <div class="form-group form-group-sm" id="form-group_for_seam_strength_in_warp_value"> -->

           <div class="form-group form-group-sm" id="form-group_for_seam_strength_in_warp_value">
            
                <label class="control-label col-sm-4" for="seam_strength_in_warp_tolerance" style="color:#00008B;">Seam Strength in Warp:</label>
                  
              <div class="col-sm-1 text-center" for="seam_strength_in_warp_value_tolerance_value">
                
                
              </div>  
            <!-- < class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry">
                <label class="control-label col-sm-4" for="uom_of_rubbing_dry" style="color:#00008B;">Uom Of Rubbing Wet:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="uom_of_rubbing_dry" name="uom_of_rubbing_dry" placeholder="Enter Uom Of Rubbing Wet" required>
                </div>
              
            </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry"> -->

            <div class="col-sm-1 text-center" for="group_for_seam_strength_in_warp_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="seam_strength_in_warp_value_tolerance_range_math_operator" name="seam_strength_in_warp_value_tolerance_range_math_operator" onchange="seam_strength_in_warp_cal()">
                      <option select="selected" value="select">Select Seam Strength in Warp Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->

                       

            <div class="col-sm-1 text-center" for="seam_strength_in_warp_value_tolerance_value">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="seam_strength_in_warp_value_tolerance_value" name="seam_strength_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_strength_in_warp_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_seam_strength_in_warp_value" name="uom_of_seam_strength_in_warp_value">
                      <option select="selected" value="select">Select Uom Of Seam Strength in Warp Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_seam_strength_in_warp_value_min_value">
                
                  <input type="text" class="form-control" id="seam_strength_in_warp_value_min_value" name="seam_strength_in_warp_value_min_value" placeholder="Enter Seam Strength in Warp Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="seam_strength_in_warp_value_max_value" name="seam_strength_in_warp_value_max_value" placeholder="Enter Seam Strength in Warp Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                      
         </div>    <!-- end of seam_strength_in_warp -->




				  <!-- Start <div class="form-group form-group-sm" id="form-group_for_seam_strength_in_weft_value"> -->

           <div class="form-group form-group-sm" id="form-group_for_seam_strength_in_weft_value">
            
                <label class="control-label col-sm-4" for="seam_strength_in_weft_tolerance" style="color:#00008B;">Seam Strength in Weft:</label>
                  
              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                
                
              </div>  
            <!-- < class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry">
                <label class="control-label col-sm-4" for="uom_of_rubbing_dry" style="color:#00008B;">Uom Of Rubbing Wet:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="uom_of_rubbing_dry" name="uom_of_rubbing_dry" placeholder="Enter Uom Of Rubbing Wet" required>
                </div>
              
            </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_uom_of_rubbing_dry"> -->

            <div class="col-sm-1 text-center" for="group_for_seam_strength_in_weft_tolerance_range_math_operator" style="margin:0px; padding:0px;">
            
                <select  class="form-control" id="seam_strength_in_weft_value_tolerance_range_math_operator" name="seam_strength_in_weft_value_tolerance_range_math_operator" onchange="seam_strength_in_weft_cal()">
                      <option select="selected" value="select">Select Seam Strength in weft Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->

                       

            <div class="col-sm-1 text-center" for="seam_strength_in_weft_value_tolerance_value">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                   <input type="text" class="form-control" id="seam_strength_in_weft_value_tolerance_value" name="seam_strength_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_strength_in_weft_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_seam_strength_in_weft_value" name="uom_of_seam_strength_in_weft_value" >
                      <option select="selected" value="select">Select Uom Of Seam Strength in weft Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_seam_strength_in_weft_value_min_value">
                
                  <input type="text" class="form-control" id="seam_strength_in_weft_value_min_value" name="seam_strength_in_weft_value_min_value" placeholder="Enter Seam Strength in weft Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

              <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="seam_strength_in_weft_value_max_value" name="seam_strength_in_weft_value_max_value" placeholder="Enter Seam Strength in weft Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                      
         </div>    <!-- end of seam_strength_in_weft -->



		<div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_c_change_value_value">

             <label class="control-label col-sm-4" for="abrasion_resistance_c_change_value" style="color:#00008B;">Abrasion Resistance</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="group_for_abrasion_resistance_c_change_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="abrasion_resistance_c_change_value_math_op" name="abrasion_resistance_c_change_value_math_op" onchange="abrasion_resistance_c_change_cal()">
                      <option select="selected" value="select">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="abrasion_resistance_c_change_value_tolerance_value" name="abrasion_resistance_c_change_value_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="abrasion_resistance_c_change_value_tolerance_value" name="abrasion_resistance_c_change_value_tolerance_value" onchange="abrasion_resistance_c_change_cal()">
					<option select="selected" value="select">Select Surface Fuzzing and Pilling Tolerance Value</option>
					<option value="1">1</option>
					<option value="1.5">1.5</option>
					<option value="2"> 2 </option>
					<option value="2.5"> 2.5 </option>
					<option value="3">3</option>
					<option value="3.5">3.5</option>
					<option value="4"> 4 </option>
					<option value="4.5"> 4.5 </option>
					<option value="5"> 5 </option>
				</select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              <select  class="form-control" id="uom_of_abrasion_resistance_c_change_value" name="uom_of_abrasion_resistance_c_change_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tensile Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_for_abrasion_resistance_c_change_value_min_value">
                
                  <input type="text" class="form-control" id="abrasion_resistance_c_change_value_min_value" name="abrasion_resistance_c_change_value_min_value" placeholder="Enter Abrasion Resistance S.Change Value Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_for_rubbing_wet_max_value">
                
                  <input type="text" class="form-control" id="abrasion_resistance_c_change_value_max_value" name="abrasion_resistance_c_change_value_max_value" placeholder="Enter Abrasion Resistance S.Change Value Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                        
           </div>    <!-- end of abrasion_resistance_c_change_value -->




						<div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_thread_break">
								<label class="control-label col-sm-4" for="abrasion_resistance_thread_break" style="color:#00008B;">Abrasion Resistance Thread Break:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="abrasion_resistance_thread_break" name="abrasion_resistance_thread_break" placeholder="Enter Abrasion Resistance Thread Break" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('abrasion_resistance_thread_break')" style="margin-top:6px;"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->







						<div class="form-group form-group-sm" id="form-group_for_revolution">
								<label class="control-label col-sm-4" for="revolution" style="color:#00008B;">Revolution:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="revolution" name="revolution" placeholder="Enter Revolution" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('revolution')" style="margin-top:6px;"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_print_durability">
								<label class="control-label col-sm-4" for="print_durability" style="color:#00008B;">Print Durability:</label>
								<div class="col-sm-5" style="padding-right:4px;">
								 <select  class="form-control" id="print_durability" name="print_durability">
					                      <option select="selected" value="select">Select Print Duribilty</option>
					                      <option value="No">No</option>
					                      <option value="Negligible">Negligible</option>
					                      <option value="Slight">Slight</option>
					                      <option value="Distinct/Complete">Distinct/Complete</option>
					                      
					              </select>
								</div>
								 <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('print_durability')" style="margin-top:6px;"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

		<div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_c_change_value_value">

             <label class="control-label col-sm-4" for="mass_loss_in_abrasion_test_value" style="color:#00008B;">Mass Loss In Abrasion Test :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="group_for_mass_loss_in_abrasion_test_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="mass_loss_in_abrasion_test_value_tolerance_range_math_operator" name="mass_loss_in_abrasion_test_value_tolerance_range_math_operator" onchange="mass_loss_in_abrasion_cal()">
                      <option select="selected" value="select">Select Mass Loss In Abrasion Test Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="mass_loss_in_abrasion_test_value_tolerance_value" name="mass_loss_in_abrasion_test_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="mass_loss_in_abrasion_cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_mass_loss_in_abrasion_test_value_min_value">
                
                  <input type="text" class="form-control" id="mass_loss_in_abrasion_test_value_min_value" name="mass_loss_in_abrasion_test_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_mass_loss_in_abrasion_test_value_max_value">
                
                  <input type="text" class="form-control" id="mass_loss_in_abrasion_test_value_max_value" name="mass_loss_in_abrasion_test_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_mass_loss_in_abrasion_test_value" name="uom_of_mass_loss_in_abrasion_test_value" value="%" >
           </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_c_change_value_value">-->




			<div class="form-group form-group-sm" id="form-group_for_formaldehyde_content_value">

             <label class="control-label col-sm-4" for="formaldehyde_content_value" style="color:#00008B;">Formaldehyde Content :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="formaldehyde_content_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="formaldehyde_content_tolerance_range_math_operator" name="formaldehyde_content_tolerance_range_math_operator" onchange="formaldehyde_content_Cal()">
                      <option select="selected" value="select">Select Formaldehyde Content Tolerance Range Math Operator</option>
                      <option value=">"> > </option>
                      <option value="<"> < </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="formaldehyde_content_tolerance_value" name="formaldehyde_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="formaldehyde_content_Cal()" required>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
                <select  class="form-control" id="uom_of_formaldehyde_content" name="uom_of_formaldehyde_content">
                      <option select="selected" value="select">Select uom_of_formaldehyde_content </option>
                      <option value="PPM">PPM</option>
                      <option value="Mg/Kg">Mg/Kg</option>
					                   
		       </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_formaldehyde_content_min_value">
                
                  <input type="text" class="form-control" id="formaldehyde_content_min_value" name="formaldehyde_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_formaldehyde_content_max_value">
                
                
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                 
           </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_c_change_value_value">-->




		<div class="form-group form-group-sm" id="form-group_for_cf_to_dry_cleaning_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_dry_cleaning_color_change_value" style="color:#00008B;">CF To Dry Cleaning Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" name="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" onchange="cf_to_dry_cleaning_color_change_cal()">
                      <option select="selected" value="select">Select CF To Dry Cleaning Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_dry_cleaning_color_change_tolerance_value" name="cf_to_dry_cleaning_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="cf_to_dry_cleaning_color_change_tolerance_value" name="cf_to_dry_cleaning_color_change_tolerance_value" onchange="cf_to_dry_cleaning_color_change_cal()">
			          <option select="selected" value="select">Select Tolerance Value</option>
			          <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_dry_cleaning_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_color_change_min_value" name="cf_to_dry_cleaning_color_change_min_value" placeholder="Enter  Min Value" onchange="cf_to_dry_cleaning_color_change_cal()" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_dry_cleaning_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_color_change_max_value" name="cf_to_dry_cleaning_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_dry_cleaning_color_change" name="uom_of_cf_to_dry_cleaning_color_change" value="value" >
           </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_abrasion_resistance_c_change_value_value">-->




				  <div class="form-group form-group-sm" id="form-group_for_cf_to_dry_cleaning_staining_tolerance_value_value">

             <label class="control-label col-sm-4" for="cf_to_dry_cleaning_staining_tolerance_value" style="color:#00008B;">CF To Dry Cleaning Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_dry_cleaning_staining_tolerance_range_math_operator" name="cf_to_dry_cleaning_staining_tolerance_range_math_operator" onchange="cf_to_dry_cleaning_staining_cal()">
                      <option select="selected" value="select">Select CF To Dry Cleaning Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_dry_cleaning_staining_tolerance_value" name="cf_to_dry_cleaning_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="cf_to_dry_cleaning_staining_tolerance_value" name="cf_to_dry_cleaning_staining_tolerance_value" onchange="cf_to_dry_cleaning_staining_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
				          <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_dry_cleaning_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_staining_min_value" name="cf_to_dry_cleaning_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_dry_cleaning_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_staining_max_value" name="cf_to_dry_cleaning_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_dry_cleaning_staining" name="uom_of_cf_to_dry_cleaning_staining" value="value" >
           </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_dry_cleaning_staining_tolerance_value_value">-->




		 <div class="form-group form-group-sm" id="form-group_for_cf_to_washing_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_washing_color_change_value" style="color:#00008B;">CF To Washing Color Change : </label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
       <div class="col-sm-1 text-center" for="cf_to_washing_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_washing_color_change_tolerance_range_math_operator" name="cf_to_washing_color_change_tolerance_range_math_operator" onchange="cf_to_washing_color_change_cal()">
                      <option select="selected" value="select">Select CF To Washing Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_washing_color_change_tolerance_value" name="cf_to_washing_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_washing_color_change_tolerance_value" name="cf_to_washing_color_change_tolerance_value" onchange="cf_to_washing_color_change_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
		                 <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_washing_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_washing_color_change_min_value" name="cf_to_washing_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_washing_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_washing_color_change_max_value" name="cf_to_washing_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_washing_color_change" name="uom_of_cf_to_washing_color_change" value="value" >
          </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_washing_color_change_tolerance_value_value">-->




		 <div class="form-group form-group-sm" id="form-group_for_cf_to_washing_staining_change_value">

             <label class="control-label col-sm-4" for="cf_to_washing_staining_change_value" style="color:#00008B;">CF To Washing Staining Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_washing_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_washing_staining_tolerance_range_math_operator" name="cf_to_washing_staining_tolerance_range_math_operator" onchange="cf_to_washing_staining_cal()">
                      <option select="selected" value="select">Select CF To Dry Cleaning Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_washing_staining_tolerance_value" name="cf_to_washing_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="cf_to_washing_staining_tolerance_value" name="cf_to_washing_staining_tolerance_value" onchange="cf_to_washing_staining_cal()">
		                  <option select="selected" value="select">Select Tolerance Value</option>
		                 <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_washing_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_washing_staining_min_value" name="cf_to_washing_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_washing_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_washing_staining_max_value" name="cf_to_washing_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_washing_staining" name="uom_of_cf_to_washing_staining" value="value" >
          </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_washing_staining_tolerance_value_value">-->




		<div class="form-group form-group-sm" id="form-group_for_cf_to_washing_staining_change_value">

             <label class="control-label col-sm-4" for="cf_to_washing_staining_change_value" style="color:#00008B;">CF To Perspiration Acid Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_perspiration_acid_color_change_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_perspiration_acid_color_change_tolerance_range_math_op" name="cf_to_perspiration_acid_color_change_tolerance_range_math_op" onchange="cf_to_perspiration_acid_color_change_cal()">
                      <option select="selected" value="select">Select CF To Perspiration Acid Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                 <!--  <input type="text" class="form-control" id="cf_to_perspiration_acid_color_change_tolerance_value" name="cf_to_perspiration_acid_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="cf_to_perspiration_acid_color_change_tolerance_value" name="cf_to_perspiration_acid_color_change_tolerance_value" onchange="cf_to_perspiration_acid_color_change_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
		                <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_perspiration_acid_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_acid_color_change_min_value" name="cf_to_perspiration_acid_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_perspiration_acid_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_acid_color_change_max_value" name="cf_to_perspiration_acid_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_acid_color_change" name="uom_of_cf_to_perspiration_acid_color_change" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_perspiration_acid_color_change_tolerance_value_value">-->




	  <div class="form-group form-group-sm" id="form-group_for_cf_to_washing_staining_value">

             <label class="control-label col-sm-4" for="cf_to_washing_staining_value" style="color:#00008B;">CF To Perspiration Acid Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_perspiration_acid_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_perspiration_acid_staining_tolerance_range_math_operator" name="cf_to_perspiration_acid_staining_tolerance_range_math_operator" onchange="cf_to_perspiration_acid_staining_cal()">
                      <option select="selected" value="select">Select CF To Perspiration Acid Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                 <!--  <input type="text" class="form-control" id="cf_to_perspiration_acid_staining_value" name="cf_to_perspiration_acid_staining_value" placeholder="Enter Tolerance Value" required>
 -->
                  <select  class="form-control" id="cf_to_perspiration_acid_staining_value" name="cf_to_perspiration_acid_staining_value" onchange="cf_to_perspiration_acid_staining_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
		                <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_perspiration_acid_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_acid_staining_min_value" name="cf_to_perspiration_acid_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_perspiration_acid_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_acid_staining_max_value" name="cf_to_perspiration_acid_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_acid_staining" name="uom_of_cf_to_perspiration_acid_staining" value="value" >
       </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_perspiration_acid_staining_value_value">-->




		<div class="form-group form-group-sm" id="form-group_for_cf_to_perspiration_alkali_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_perspiration_alkali_color_change_value" style="color:#00008B;">CF To Perspiration Alkali Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_perspiration_alkali_color_change_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_perspiration_alkali_color_change_tolerance_range_math_op" name="cf_to_perspiration_alkali_color_change_tolerance_range_math_op" onchange="cf_to_perspiration_alkali_color_change_cal()">
                      <option select="selected" value="select">Select CF To Perspiration Alkali Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_perspiration_alkali_color_change_tolerance_value" name="cf_to_perspiration_alkali_color_change_tolerance_value" placeholder="Enter Tolerance Value" required>
 -->
                  <select  class="form-control" id="cf_to_perspiration_alkali_color_change_tolerance_value" name="cf_to_perspiration_alkali_color_change_tolerance_value" onchange="cf_to_perspiration_alkali_color_change_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
		                <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_perspiration_alkali_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_color_change_min_value" name="cf_to_perspiration_alkali_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_perspiration_alkali_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_color_change_max_value" name="cf_to_perspiration_alkali_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_alkali_color_change" name="uom_of_cf_to_perspiration_alkali_color_change" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_perspiration_alkali_color_change_tolerance_value_value">-->



	   <div class="form-group form-group-sm" id="form-group_for_cf_to_water_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_water_color_change_value" style="color:#00008B;">CF To Water Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_water_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_water_color_change_tolerance_range_math_operator" name="cf_to_water_color_change_tolerance_range_math_operator" onchange="cf_to_water_color_change_cal()">
                      <option select="selected" value="select">Select CF To Water Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_water_color_change_tolerance_value" name="cf_to_water_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->

                  <select  class="form-control" id="cf_to_water_color_change_tolerance_value" name="cf_to_water_color_change_tolerance_value" onchange="cf_to_water_color_change_cal()">
		                <option select="selected" value="select">Select Tolerance Value</option>
		                <option value="1.0">1</option>
				          <option value="1.5">1-2</option>
				          <option value="2.0"> 2 </option>
				          <option value="2.5"> 2-3 </option>
				          <option value="3.0">3</option>
				          <option value="3.5">3-4</option>
				          <option value="4.0"> 4 </option>
				          <option value="4.5"> 4-5 </option>
				          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_water_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_water_color_change_min_value" name="cf_to_water_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_water_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_water_color_change_max_value" name="cf_to_water_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_water_color_change" name="uom_of_cf_to_water_color_change" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_water_color_change_tolerance_value_value">-->




	  <div class="form-group form-group-sm" id="form-group_for_cf_to_water_staining_value">

             <label class="control-label col-sm-4" for="cf_to_water_staining_value" style="color:#00008B;">CF To Water Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_water_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_water_staining_tolerance_range_math_operator" name="cf_to_water_staining_tolerance_range_math_operator" onchange="cf_to_water_staining_cal()">
                      <option select="selected" value="select">Select CF To Water Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_water_staining_tolerance_value" name="cf_to_water_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_water_staining_tolerance_value" name="cf_to_water_staining_tolerance_value" onchange="cf_to_water_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_water_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_water_staining_min_value" name="cf_to_water_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_water_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_water_staining_max_value" name="cf_to_water_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_water_staining" name="uom_of_cf_to_water_staining" value="value" >
           </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_water_staining_tolerance_value_value">-->





        <div class="form-group form-group-sm" id="form-group_for_cf_to_water_sotting_staining_value">

             <label class="control-label col-sm-4" for="cf_to_water_sotting_staining_value" style="color:#00008B;">CF To Water Sotting Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_water_sotting_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_water_sotting_staining_tolerance_range_math_operator" name="cf_to_water_sotting_staining_tolerance_range_math_operator" onchange="cf_to_water_sotting_staining_cal()">
                      <option select="selected" value="select">Select CF To Water Sotting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_water_sotting_staining_tolerance_value" name="cf_to_water_sotting_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_water_sotting_staining_tolerance_value" name="cf_to_water_sotting_staining_tolerance_value" onchange="cf_to_water_sotting_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_water_sotting_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_water_sotting_staining_min_value" name="cf_to_water_sotting_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_water_sotting_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_water_sotting_staining_max_value" name="cf_to_water_sotting_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_water_sotting_staining" name="uom_of_cf_to_water_sotting_staining" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_water_sotting_staining_tolerance_value_value">-->



		<div class="form-group form-group-sm" id="form-group_for_cf_to_surface_wetting_staining_value">

             <label class="control-label col-sm-4" for="cf_to_surface_wetting_staining_value" style="color:#00008B;">Cf CF To Surface Wetting Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_surface_wetting_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_surface_wetting_staining_tolerance_range_math_operator" name="cf_to_surface_wetting_staining_tolerance_range_math_operator" onchange="cf_to_surface_wetting_staining_cal()">
                      <option select="selected" value="select">Select CF To Surface Wetting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_surface_wetting_staining_tolerance_value" name="cf_to_surface_wetting_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_surface_wetting_staining_tolerance_value" name="cf_to_surface_wetting_staining_tolerance_value" onchange="cf_to_surface_wetting_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_surface_wetting_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_surface_wetting_staining_min_value" name="cf_to_surface_wetting_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_surface_wetting_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_surface_wetting_staining_max_value" name="cf_to_surface_wetting_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_surface_wetting_staining" name="uom_of_cf_to_surface_wetting_staining" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_surface_wetting_staining_tolerance_value_value">-->



		 <div class="form-group form-group-sm" id="form-group_for_cf_to_hydrolysis_of_reactive_dyes_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_hydrolysis_of_reactive_dyes_color_change_value" style="color:#00008B;">CF To Hydrolysis Of Reactive Dyes Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op" name="cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op" onchange="cf_to_hydrolysis_of_reactive_dyes_cal()">
                      <option select="selected" value="select">Select CF To Surface Wetting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" onchange="cf_to_hydrolysis_of_reactive_dyes_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                     <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_hydrolysis_of_reactive_dyes_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_min_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_hydrolysis_of_reactive_dyes_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_max_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change" name="uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value_value">-->






    
	    <div class="form-group form-group-sm" id="form-group_for_cf_to_hydrolysis_of_reactive_dyes_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_hydrolysis_of_reactive_dyes_color_change_value" style="color:#00008B;">CF To Hydrolysis Of Reactive Dyes Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op" name="cf_to_hydrolysis_of_reactive_dyes_staining_toler_range_math_op" onchange="cf_to_hydrolysis_of_reactive_dyes_staining_cal()">
                      <option select="selected" value="select">Select CF To Hydrolysis Of Reactive Dyes Staining Tolerrance Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
              <!-- calculate_all(this.value, document.getElementById('cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value').value,  document.getElementById('cf_to_hydrolysis_of_reactive_dyes_staining_min_value').value, document.getElementById('cf_to_hydrolysis_of_reactive_dyes_staining_max_value').value) -->
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value" name="cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value" name="cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value" onchange="cf_to_hydrolysis_of_reactive_dyes_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
	                <option value="1.5">1.5</option>
	                <option value="2"> 2 </option>
	                <option value="2.5"> 2.5 </option>
	                <option value="3">3</option>
	                <option value="3.5">3.5</option>
	                <option value="4"> 4 </option>
	                <option value="4.5"> 4.5 </option>
	                <option value="5"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_hydrolysis_of_reactive_dyes_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_staining_min_value" name="cf_to_hydrolysis_of_reactive_dyes_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_hydrolysis_of_reactive_dyes_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_staining_max_value" name="cf_to_hydrolysis_of_reactive_dyes_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_hydrolysis_of_reactive_dyes_staining" name="uom_of_cf_to_hydrolysis_of_reactive_dyes_staining" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_hydrolysis_of_reactive_dyes_staining_tolerance_value_value">-->





	    <div class="form-group form-group-sm" id="form-group_for_cf_to_oidative_bleach_damage_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_oidative_bleach_damage_color_change_value" style="color:#00008B;">CF To Oidative Bleach Damage Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op" name="cf_to_oidative_bleach_damage_color_change_tolerance_range_mat_op" onchange="cf_to_oidative_bleach_damage_color_change_cal()">
                      <option select="selected" value="select">Select CF To Oidative Bleach Damage Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_oidative_bleach_damage_color_change_tolerance_value" name="cf_to_oidative_bleach_damage_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_oidative_bleach_damage_color_change_tolerance_value" name="cf_to_oidative_bleach_damage_color_change_tolerance_value" onchange="cf_to_oidative_bleach_damage_color_change_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_oidative_bleach_damage_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_oidative_bleach_damage_color_change_min_value" name="cf_to_oidative_bleach_damage_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_oidative_bleach_damage_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_oidative_bleach_damage_color_change_max_value" name="cf_to_oidative_bleach_damage_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_oidative_bleach_damage_color_change" name="uom_of_cf_to_oidative_bleach_damage_color_change" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_oidative_bleach_damage_color_change_tolerance_value_value">-->


	    <div class="form-group form-group-sm" id="form-group_for_cf_to_phenolic_yellowing_staining_value">

             <label class="control-label col-sm-4" for="cf_to_phenolic_yellowing_staining_value" style="color:#00008B;">CF To Phenolic Yellowing Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="cf_to_phenolic_yellowing_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_phenolic_yellowing_staining_tolerance_range_math_operator" name="cf_to_phenolic_yellowing_staining_tolerance_range_math_operator" onchange="cf_to_phenolic_yellowing_staining_cal()">
                      <option select="selected" value="select">Select CF To Phenolic Yellowing Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_phenolic_yellowing_staining_tolerance_value" name="cf_to_phenolic_yellowing_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_phenolic_yellowing_staining_tolerance_value" name="cf_to_phenolic_yellowing_staining_tolerance_value" onchange="cf_to_phenolic_yellowing_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_phenolic_yellowing_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_phenolic_yellowing_staining_min_value" name="cf_to_phenolic_yellowing_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_phenolic_yellowing_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_phenolic_yellowing_staining_max_value" name="cf_to_phenolic_yellowing_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_phenolic_yellowing_staining" name="uom_of_cf_to_phenolic_yellowing_staining" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_phenolic_yellowing_staining_tolerance_value_value">-->






    

    <div class="form-group form-group-sm" id="form-group_for_cf_to_saliva_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_saliva_color_change_value" style="color:#00008B;">CF To Saliva Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
             <div class="col-sm-1 text-center" for="cf_to_saliva_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_saliva_color_change_tolerance_range_math_operator" name="cf_to_saliva_color_change_tolerance_range_math_operator" onchange="cf_to_saliva_color_change_cal()">
                      <option select="selected" value="select">Select CF To Saliva Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_pvc_migration_staining_tolerance_value" name="cf_to_pvc_migration_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_saliva_color_change_tolerance_value" name="cf_to_saliva_color_change_tolerance_value" onchange="cf_to_saliva_color_change_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_saliva_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_saliva_color_change_min_value" name="cf_to_saliva_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_saliva_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_saliva_color_change_max_value" name="cf_to_saliva_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_saliva_color_change" name="uom_of_cf_to_saliva_color_change" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_pvc_migration_staining_tolerance_value_value">-->






    <div class="form-group form-group-sm" id="form-group_for_cf_to_pvc_migration_staininge_value">

             <label class="control-label col-sm-4" for="cf_to_pvc_migration_staininge_value" style="color:#00008B;">CF To Pvc Migration Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
         <div class="col-sm-1 text-center" for="cf_to_pvc_migration_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_pvc_migration_staining_tolerance_range_math_operator" name="cf_to_pvc_migration_staining_tolerance_range_math_operator" onchange="cf_to_pvc_migration_staining_cal()">
                      <option select="selected" value="select">Select CF To Pvc Migration Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_saliva_color_change_tolerance_value" name="cf_to_saliva_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_pvc_migration_staining_tolerance_value" name="cf_to_pvc_migration_staining_tolerance_value" onchange="cf_to_pvc_migration_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_pvc_migration_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_pvc_migration_staining_min_value" name="cf_to_pvc_migration_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_pvc_migration_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_pvc_migration_staining_max_value" name="cf_to_pvc_migration_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_pvc_migration_staining" name="uom_of_cf_to_pvc_migration_staining" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_saliva_color_change_tolerance_value_value">-->


	     <div class="form-group form-group-sm" id="form-group_for_cf_to_saliva_staining_value">

             <label class="control-label col-sm-4" for="cf_to_saliva_staining_value" style="color:#00008B;">CF To Saliva Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_saliva_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_saliva_staining_tolerance_range_math_operator" name="cf_to_saliva_staining_tolerance_range_math_operator" onchange="cf_to_saliva_staining_cal()">
                      <option select="selected" value="select">Select CF To Saliva Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_saliva_staining_tolerance_value" name="cf_to_saliva_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_saliva_staining_tolerance_value" name="cf_to_saliva_staining_tolerance_value" onchange="cf_to_saliva_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_saliva_staining_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_saliva_staining_staining_min_value" name="cf_to_saliva_staining_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_saliva_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_saliva_staining_max_value" name="cf_to_saliva_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_saliva_staining" name="uom_of_cf_to_saliva_staining" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_saliva_staining_tolerance_value_value">-->






    

    <div class="form-group form-group-sm" id="form-group_for_cf_to_chlorinated_water_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_chlorinated_water_color_change_value" style="color:#00008B;">CF To Chlorinated Water Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_chlorinated_water_color_change_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_chlorinated_water_color_change_tolerance_range_math_op" name="cf_to_chlorinated_water_color_change_tolerance_range_math_op" onchange="cf_to_chlorinated_water_color_change_cal()">
                      <option select="selected" value="select">Select CF To Chlorinated Water Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_chlorinated_water_color_change_tolerance_value" name="cf_to_chlorinated_water_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_chlorinated_water_color_change_tolerance_value" name="cf_to_chlorinated_water_color_change_tolerance_value" onchange="cf_to_chlorinated_water_color_change_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_chlorinated_water_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_chlorinated_water_color_change_min_value" name="cf_to_chlorinated_water_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_chlorinated_water_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_chlorinated_water_color_change_max_value" name="cf_to_chlorinated_water_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_chlorinated_water_color_change" name="uom_of_cf_to_chlorinated_water_color_change" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_chlorinated_water_color_change_tolerance_value_value">-->






    

    <div class="form-group form-group-sm" id="form-group_for_cf_to_chlorinated_water_staining_value">

             <label class="control-label col-sm-4" for="cf_to_chlorinated_water_staining_value" style="color:#00008B;">CF To Chlorinated Water Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_chlorinated_water_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_chlorinated_water_staining_tolerance_range_math_operator" name="cf_to_chlorinated_water_staining_tolerance_range_math_operator" onchange="cf_to_chlorinated_water_staining_cal()">
                      <option select="selected" value="select">Select CF To Chlorinated Water Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_chlorinated_water_staining_tolerance_value" name="cf_to_chlorinated_water_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_chlorinated_water_staining_tolerance_value" name="cf_to_chlorinated_water_staining_tolerance_value" onchange="cf_to_chlorinated_water_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_chlorinated_water_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_chlorinated_water_staining_min_value" name="cf_to_chlorinated_water_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_chlorinated_water_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_chlorinated_water_staining_max_value" name="cf_to_chlorinated_water_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_chlorinated_water_staining" name="uom_of_cf_to_chlorinated_water_staining" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_chlorinated_water_staining_tolerance_value_value">-->






    
    <div class="form-group form-group-sm" id="form-group_for_cf_to_cholorine_bleach_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_cholorine_bleach_color_change_value" style="color:#00008B;">CF To Cholorine Bleach Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_cholorine_bleach_color_change_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_cholorine_bleach_color_change_tolerance_range_math_op" name="cf_to_cholorine_bleach_color_change_tolerance_range_math_op" onchange="cf_to_cholorine_bleach_color_change_cal()">
                      <option select="selected" value="select">Select CF To Cholorine Bleach Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_cholorine_bleach_color_change_tolerance_value" name="cf_to_cholorine_bleach_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_cholorine_bleach_color_change_tolerance_value" name="cf_to_cholorine_bleach_color_change_tolerance_value" onchange="cf_to_cholorine_bleach_color_change_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_cholorine_bleach_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_cholorine_bleach_color_change_min_value" name="cf_to_cholorine_bleach_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_cholorine_bleach_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_cholorine_bleach_color_change_max_value" name="cf_to_cholorine_bleach_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_cholorine_bleach_color_change" name="uom_of_cf_to_cholorine_bleach_color_change" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_cholorine_bleach_color_change_tolerance_value_value">-->






    <div class="form-group form-group-sm" id="form-group_for_cf_to_cholorine_bleach_staining_value">

             <label class="control-label col-sm-4" for="cf_to_cholorine_bleach_staining_value" style="color:#00008B;">CF To Cholorine Bleach Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="cf_to_cholorine_bleach_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_cholorine_bleach_staining_tolerance_range_math_operator" name="cf_to_cholorine_bleach_staining_tolerance_range_math_operator" onchange="cf_to_cholorine_bleach_staining_cal()">
                      <option select="selected" value="select">Select CF To Cholorine Bleach Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_cholorine_bleach_staining_tolerance_value" name="cf_to_cholorine_bleach_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_cholorine_bleach_staining_tolerance_value" name="cf_to_cholorine_bleach_staining_tolerance_value" onchange="cf_to_cholorine_bleach_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_cholorine_bleach_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_cholorine_bleach_staining_min_value" name="cf_to_cholorine_bleach_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_cholorine_bleach_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_cholorine_bleach_staining_max_value" name="cf_to_cholorine_bleach_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_cholorine_bleach_staining" name="uom_of_cf_to_cholorine_bleach_staining" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_cholorine_bleach_staining_tolerance_value_value">-->





       <div class="form-group form-group-sm" id="form-group_for_cf_to_peroxide_bleach_color_change_value">

             <label class="control-label col-sm-4" for="cf_to_peroxide_bleach_color_change_value" style="color:#00008B;">CF To Peroxide Bleach Color Change :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_peroxide_bleach_color_change_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_peroxide_bleach_color_change_tolerance_range_math_operator" name="cf_to_peroxide_bleach_color_change_tolerance_range_math_operator" onchange="cf_to_peroxide_bleach_cal()">
                      <option select="selected" value="select">Select CF To Peroxide Bleach Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_peroxide_bleach_color_change_tolerance_value" name="cf_to_peroxide_bleach_color_change_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_peroxide_bleach_color_change_tolerance_value" name="cf_to_peroxide_bleach_color_change_tolerance_value" onchange="cf_to_peroxide_bleach_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_peroxide_bleach_color_change_min_value">
                
                  <input type="text" class="form-control" id="cf_to_peroxide_bleach_color_change_min_value" name="cf_to_peroxide_bleach_color_change_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_peroxide_bleach_color_change_max_value">
                
                  <input type="text" class="form-control" id="cf_to_peroxide_bleach_color_change_max_value" name="cf_to_peroxide_bleach_color_change_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_peroxide_bleach_color_change" name="uom_of_cf_to_peroxide_bleach_color_change" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_peroxide_bleach_color_change_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_cf_to_peroxide_bleach_staining_value">

             <label class="control-label col-sm-4" for="cf_to_peroxide_bleach_staining_value" style="color:#00008B;">CF To Peroxide Bleach Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cf_to_peroxide_bleach_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_peroxide_bleach_staining_tolerance_range_math_operator" name="cf_to_peroxide_bleach_staining_tolerance_range_math_operator" onchange="cf_to_peroxide_bleach_staining_cal()">
                      <option select="selected" value="select">Select CF To Peroxide Bleach Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_peroxide_bleach_staining_tolerance_value" name="cf_to_peroxide_bleach_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_peroxide_bleach_staining_tolerance_value" name="cf_to_peroxide_bleach_staining_tolerance_value" onchange="cf_to_peroxide_bleach_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_peroxide_bleach_staining_min_value">
                
                  <input type="text" class="form-control" id="cf_to_peroxide_bleach_staining_min_value" name="cf_to_peroxide_bleach_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_peroxide_bleach_staining_max_value">
                
                  <input type="text" class="form-control" id="cf_to_peroxide_bleach_staining_max_value" name="cf_to_peroxide_bleach_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_peroxide_bleach_staining" name="uom_of_cf_to_peroxide_bleach_staining" value="value" >
       </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_peroxide_bleach_staining_tolerance_value_value">-->






    <div class="form-group form-group-sm" id="form-group_for_cross_staining_value">

             <label class="control-label col-sm-4" for="cross_staining_value" style="color:#00008B;">Cross Staining :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="cross_staining_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cross_staining_tolerance_range_math_operator" name="cross_staining_tolerance_range_math_operator" onchange="cross_staining_cal()">
                      <option select="selected" value="select">Select Cross Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cross_staining_tolerance_value" name="cross_staining_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cross_staining_tolerance_value" name="cross_staining_tolerance_value" onchange="cross_staining_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cross_staining_min_value">
                
                  <input type="text" class="form-control" id="cross_staining_min_value" name="cross_staining_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cross_staining_max_value">
                
                  <input type="text" class="form-control" id="cross_staining_max_value" name="cross_staining_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cross_staining" name="uom_of_cross_staining" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cross_staining_tolerance_value_value">-->






    <div class="form-group form-group-sm" id="form-group_for_water_absorption_value">

             <label class="control-label col-sm-4" for="water_absorption_value" style="color:#00008B;">Water Absorption :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="water_absorption_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="water_absorption_value_tolerance_range_math_operator" name="water_absorption_value_tolerance_range_math_operator" onchange="water_absorption_value_cal()">
                      <option select="selected" value="select">Select Water Absorption Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="water_absorption_value_tolerance_value" name="water_absorption_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="water_absorption_value_cal()" required>
                  
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
                <select  class="form-control" id="uom_of_water_absorption_value" name="uom_of_water_absorption_value">
                      <option select="selected" value="select">Select Uom Water Absorption Value</option>
                      <option value="sec">sec</option>
                      <option value="mm"> mm </option>
                      <option value="%"> % </option>
                </select>
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_water_absorption_value_min_value">
                
                  <input type="text" class="form-control" id="water_absorption_value_min_value" name="water_absorption_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_water_absorption_value_max_value">
                
                  <input type="text" class="form-control" id="water_absorption_value_max_value" name="water_absorption_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_water_absorption_value_tolerance_value_value">-->






    <div class="form-group form-group-sm" id="form-group_for_spirality_value">

             <label class="control-label col-sm-4" for="spirality_value" style="color:#00008B;">Spirality :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="spirality_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="spirality_value_tolerance_range_math_operator" name="spirality_value_tolerance_range_math_operator" onchange="spirality_value_cal()" >
                      <option select="selected" value="select">Select Spirality Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
              
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="spirality_value_tolerance_value" name="spirality_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="spirality_value_cal()" required>
                  
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_spirality_value_min_value">
                
                  <input type="text" class="form-control" id="spirality_value_min_value" name="spirality_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_spirality_value_max_value">
                
                  <input type="text" class="form-control" id="spirality_value_max_value" name="spirality_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_spirality_value" name="uom_of_spirality_value" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_spirality_value_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_durable_press_value">

             <label class="control-label col-sm-4" for="durable_press_value" style="color:#00008B;">Durable Press :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="durable_press_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="durable_press_value_tolerance_range_math_operator" name="durable_press_value_tolerance_range_math_operator" onchange="durable_press_value_cal()">
                      <option select="selected" value="select">Select Durable Press Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="durable_press_value_tolerance_value" name="durable_press_value_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="durable_press_value_tolerance_value" name="durable_press_value_tolerance_value" onchange="durable_press_value_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_durable_press_value_min_value">
                
                  <input type="text" class="form-control" id="durable_press_value_min_value" name="durable_press_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_durable_press_value_max_value">
                
                  <input type="text" class="form-control" id="durable_press_value_max_value" name="durable_press_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_durable_press_value" name="uom_of_durable_press_value" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_durable_press_value_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_ironability_of_woven_fabric_value">

             <label class="control-label col-sm-4" for="ironability_of_woven_fabric_value" style="color:#00008B;">Ironability of Woven Fabric :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="ironability_of_woven_fabric_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="ironability_of_woven_fabric_value_tolerance_range_math_operator" name="ironability_of_woven_fabric_value_tolerance_range_math_operator" onchange="ironability_of_woven_fabric_value_cal()">
                      <option select="selected" value="select">Select Ironability Of Woven Fabric Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="ironability_of_woven_fabric_value_tolerance_value" name="ironability_of_woven_fabric_value_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="ironability_of_woven_fabric_value_tolerance_value" name="ironability_of_woven_fabric_value_tolerance_value" onchange="ironability_of_woven_fabric_value_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_ironability_of_woven_fabric_value_min_value">
                
                  <input type="text" class="form-control" id="ironability_of_woven_fabric_value_min_value" name="ironability_of_woven_fabric_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_ironability_of_woven_fabric_value_max_value">
                
                  <input type="text" class="form-control" id="ironability_of_woven_fabric_value_max_value" name="ironability_of_woven_fabric_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_ironability_of_woven_fabric_value" name="uom_of_ironability_of_woven_fabric_value" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_ironability_of_woven_fabric_value_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_cf_to_artificial_light_value">

             <label class="control-label col-sm-4" for="cf_to_artificial_light_value" style="color:#00008B;">CF To Artificial Light :</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="cf_to_artificial_light_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="cf_to_artificial_light_value_tolerance_range_math_operator" name="cf_to_artificial_light_value_tolerance_range_math_operator" onchange="cf_to_artificial_light_value_cal()">
                      <option select="selected" value="select">Select CF To Artificial Light Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="cf_to_artificial_light_value_tolerance_value" name="cf_to_artificial_light_value_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <select  class="form-control" id="cf_to_artificial_light_value_tolerance_value" name="cf_to_artificial_light_value_tolerance_value" onchange="cf_to_artificial_light_value_cal()">
                    <option select="selected" value="select">Select Tolerance Value</option>
                      <option value="1.0">1</option>
			          <option value="1.5">1-2</option>
			          <option value="2.0"> 2 </option>
			          <option value="2.5"> 2-3 </option>
			          <option value="3.0">3</option>
			          <option value="3.5">3-4</option>
			          <option value="4.0"> 4 </option>
			          <option value="4.5"> 4-5 </option>
			          <option value="5.0"> 5 </option>
                  </select>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_cf_to_artificial_light_value_min_value">
                
                  <input type="text" class="form-control" id="cf_to_artificial_light_value_min_value" name="cf_to_artificial_light_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_cf_to_artificial_light_value_max_value">
                
                  <input type="text" class="form-control" id="cf_to_artificial_light_value_max_value" name="cf_to_artificial_light_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_cf_to_artificial_light_value" name="uom_of_cf_to_artificial_light_value" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_cf_to_artificial_light_value_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_moisture_content_in_percentage">

             <label class="control-label col-sm-4" for="moisture_content_in_percentage" style="color:#00008B;">Moisture Content in Percentage:</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
            <div class="col-sm-1 text-center" for="moisture_content_in_percentage_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="moisture_content_in_percentage_tolerance_value" name="moisture_content_in_percentage_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_moisture_content_in_percentage_min_value">
                
                  <input type="text" class="form-control" id="moisture_content_in_percentage_min_value" name="moisture_content_in_percentage_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_moisture_content_in_percentage_max_value">
                
                  <input type="text" class="form-control" id="moisture_content_in_percentage_max_value" name="moisture_content_in_percentage_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_moisture_content_in_percentage" name="uom_of_moisture_content_in_percentage" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_moisture_content_in_percentage_tolerance_value_value">-->






    
    <div class="form-group form-group-sm" id="form-group_for_evaporation_rate_in_percentage">

             <label class="control-label col-sm-4" for="evaporation_rate_in_percentage" style="color:#00008B;">Evaporation Rate in Percentage:</label>

             <div class="col-sm-1 text-center" for="line_creation">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="evaporation_rate_in_percentage_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="evaporation_rate_in_percentage_tolerance_value" name="evaporation_rate_in_percentage_tolerance_value" placeholder="Enter Tolerance Value" required> -->
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_evaporation_rate_in_percentage_min_value">
                
                  <input type="text" class="form-control" id="evaporation_rate_in_percentage_min_value" name="evaporation_rate_in_percentage_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_evaporation_rate_in_percentage_max_value">
                
                  <input type="text" class="form-control" id="evaporation_rate_in_percentage_max_value" name="evaporation_rate_in_percentage_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_evaporation_rate_in_percentage" name="uom_of_evaporation_rate_in_percentage" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_evaporation_rate_in_percentage_tolerance_value_value">-->





    <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_cotton_content">

             <label class="control-label col-sm-4" for="percentage_of_total_cotton_content" style="color:#00008B;">Percentage of Total Cotton Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_total_cotton_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <input type="text" class="form-control" id="percentage_of_total_cotton_content_value" name="percentage_of_total_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_total_cotton_content_cal()" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_total_cotton_content_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                <select  class="form-control" id="percentage_of_total_cotton_content_tolerance_range_math_operator" name="percentage_of_total_cotton_content_tolerance_range_math_operator" onchange="percentage_of_total_cotton_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total Cotton Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_total_cotton_content_tolerance_value" name="percentage_of_total_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_cotton_content_cal()" required>
                 
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_total_cotton_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_cotton_content_min_value" name="percentage_of_total_cotton_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_total_cotton_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_cotton_content_max_value" name="percentage_of_total_cotton_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_total_cotton_content" name="uom_of_percentage_of_total_cotton_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_cotton_content_tolerance_value_value">-->


      
        <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_polyester_content">

             <label class="control-label col-sm-4" for="percentage_of_total_polyester_content" style="color:#00008B;">Percentage of Total Polyester Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_total_polyester_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                 <input type="text" class="form-control" id="percentage_of_total_polyester_content_value" name="percentage_of_total_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_total_polyester_content_cal()" required>
                
            </div>
            <div class="col-sm-1 text-center" for="percentage_of_total_polyester_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_total_polyester_content_tolerance_range_math_op" name="percentage_of_total_polyester_content_tolerance_range_math_op" onchange="percentage_of_total_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total Polyester Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_total_polyester_content_tolerance_value" name="percentage_of_total_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_polyester_content_cal()" required>
                  
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_total_polyester_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_polyester_content_min_value" name="percentage_of_total_polyester_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_total_polyester_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_polyester_content_max_value" name="percentage_of_total_polyester_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_total_polyester_content" name="uom_of_percentage_of_total_polyester_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_polyester_content_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_other_fiber_content_content">

             <label class="control-label col-sm-4" for="percentage_of_total_other_fiber_content_content" style="color:#00008B;">Percentage of Total Other Fiber Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_total_other_fiber_content_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_value" name="percentage_of_total_other_fiber_content_value" placeholder="Enter  Value" onchange="percentage_of_total_other_fiber_content_cal()" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_total_other_fiber_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_total_other_fiber_content_tolerance_range_math_op" name="percentage_of_total_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_total_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total Other Fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_tolerance_value" name="percentage_of_total_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_other_fiber_content_cal()" required>
                  
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_total_other_fiber_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_min_value" name="percentage_of_total_other_fiber_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_total_other_fiber_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_max_value" name="percentage_of_total_other_fiber_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_total_other_fiber_content" name="uom_of_percentage_of_total_other_fiber_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_total_other_fiber_content_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_cotton_content">

             <label class="control-label col-sm-4" for="percentage_of_warp_cotton_content" style="color:#00008B;">Percentage of Warp Cotton Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_warp_cotton_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_warp_cotton_content_value" name="percentage_of_warp_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_warp_cotton_content_cal()" required>
                
            </div>
            <div class="col-sm-1 text-center" for="percentage_of_warp_cotton_content_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_warp_cotton_content_tolerance_range_math_operator" name="percentage_of_warp_cotton_content_tolerance_range_math_operator" onchange="percentage_of_warp_cotton_content_cal()" required>
                      <option select="selected" value="select">Select Percentage of Warp Cotton Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_warp_cotton_content_tolerance_value" name="percentage_of_warp_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_cotton_content_cal()" required required>
                  <!-- <select  class="form-control" id="percentage_of_warp_cotton_content_tolerance_value" name="percentage_of_warp_cotton_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_warp_cotton_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_cotton_content_min_value" name="percentage_of_warp_cotton_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_warp_cotton_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_cotton_content_max_value" name="percentage_of_warp_cotton_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_cotton_content" name="uom_of_percentage_of_warp_cotton_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_cotton_content_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_polyester_content">

             <label class="control-label col-sm-4" for="percentage_of_warp_polyester_content" style="color:#00008B;">Percentage of Warp Polyester Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_warp_polyester_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_warp_polyester_content_value" name="percentage_of_warp_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_warp_polyester_content_cal()" required>
                
            </div>
            <div class="col-sm-1 text-center" for="percentage_of_warp_polyester_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_warp_polyester_content_tolerance_range_math_op" name="percentage_of_warp_polyester_content_tolerance_range_math_op" onchange="percentage_of_warp_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Warp Cotton Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_warp_polyester_content_tolerance_value" name="percentage_of_warp_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_polyester_content_cal()" required>
                  <!-- <select  class="form-control" id="percentage_of_warp_polyester_content_tolerance_value" name="percentage_of_warp_polyester_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_warp_polyester_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_polyester_content_min_value" name="percentage_of_warp_polyester_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_warp_polyester_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_polyester_content_max_value" name="percentage_of_warp_polyester_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_polyester_content" name="uom_of_percentage_of_warp_polyester_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_polyester_content_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_polyester_content">

             <label class="control-label col-sm-4" for="percentage_of_warp_polyester_content" style="color:#00008B;">Percentage of Warp Other Fiber Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_warp_polyester_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_value" name="percentage_of_warp_other_fiber_content_value" placeholder="Enter Value" onchange="percentage_of_warp_other_fiber_content_cal()" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_warp_other_fiber_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_range_math_op" name="percentage_of_warp_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_warp_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of Warp Other Fiber Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_value" name="percentage_of_warp_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value"  onchange="percentage_of_warp_other_fiber_content_cal()" required>
                  <!-- <select  class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_value" name="percentage_of_warp_other_fiber_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_warp_other_fiber_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_min_value" name="percentage_of_warp_other_fiber_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_warp_other_fiber_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_max_value" name="percentage_of_warp_other_fiber_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_other_fiber_content" name="uom_of_percentage_of_warp_other_fiber_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_warp_other_fiber_content_tolerance_value_value">-->

 <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_cotton_content">

             <label class="control-label col-sm-4" for="percentage_of_weft_cotton_content" style="color:#00008B;">Percentage of Weft Cotton Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_weft_cotton_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_weft_cotton_content_value" name="percentage_of_weft_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_weft_cotton_content_cal()" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_weft_cotton_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_weft_cotton_content_tolerance_range_math_op" name="percentage_of_weft_cotton_content_tolerance_range_math_op" onchange="percentage_of_weft_cotton_content_cal()">
                      <option select="selected" value="select">Select Percentage of Weft cotton Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_weft_cotton_content_tolerance_value" name="percentage_of_weft_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_cotton_content_cal()" required>
                  <!-- <select  class="form-control" id="percentage_of_weft_cotton_content_tolerance_value" name="percentage_of_weft_cotton_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_weft_cotton_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_cotton_content_min_value" name="percentage_of_weft_cotton_content_min_value" placeholder="Enter  Min Value" onchange="percentage_of_weft_cotton_content" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_weft_cotton_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_cotton_content_max_value" name="percentage_of_weft_cotton_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_cotton_content" name="uom_of_percentage_of_weft_cotton_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_cotton_content_tolerance_value_value">-->





 <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_polyester_content">

             <label class="control-label col-sm-4" for="percentage_of_weft_polyester_content" style="color:#00008B;">Percentage of Weft Polyester Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_weft_polyester_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_weft_polyester_content_value" name="percentage_of_weft_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_weft_polyester_content_cal()" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_weft_polyester_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_weft_polyester_content_tolerance_range_math_op" name="percentage_of_weft_polyester_content_tolerance_range_math_op" onchange="percentage_of_weft_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Weft Polyester Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_weft_polyester_content_tolerance_value" name="percentage_of_weft_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_polyester_content_cal()" required>
                  <!-- <select  class="form-control" id="percentage_of_weft_polyester_content_tolerance_value" name="percentage_of_weft_polyester_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_weft_polyester_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_polyester_content_min_value" name="percentage_of_weft_polyester_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_weft_polyester_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_polyester_content_max_value" name="percentage_of_weft_polyester_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_polyester_content" name="uom_of_percentage_of_weft_polyester_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_polyester_content_tolerance_value_value">-->




 <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_other_fiber_content">

             <label class="control-label col-sm-4" for="percentage_of_weft_other_fiber_content" style="color:#00008B;">Percentage of Weft Other Fiber Content :</label>

             <div class="col-sm-1 text-center" for="form_group_for_percentage_of_weft_other_fiber_content_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_value" name="percentage_of_weft_other_fiber_content_value" onchange="percentage_of_weft_other_fiber_content_cal()" placeholder="Enter Tolerance Value" required>
                
            </div>
           <div class="col-sm-1 text-center" for="percentage_of_weft_other_fiber_content_tolerance_range_math_op" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_range_math_op" name="percentage_of_weft_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_weft_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of Weft Other Fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_value" name="percentage_of_weft_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_other_fiber_content_cal()" required>
                  <!-- <select  class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_value" name="percentage_of_weft_other_fiber_content_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_percentage_of_weft_other_fiber_content_min_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_min_value" name="percentage_of_weft_other_fiber_content_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_percentage_of_weft_other_fiber_content_max_value">
                
                  <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_max_value" name="percentage_of_weft_other_fiber_content_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_other_fiber_content" name="uom_of_percentage_of_weft_other_fiber_content" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_percentage_of_weft_other_fiber_content_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_seam_slippage_resistance_in_warp">

             <label class="control-label col-sm-4" for="seam_slippage_resistance_in_warp" style="color:#00008B;">Seam Slippage Resistance in Warp :</label>

             <div class="col-sm-1 text-center" for="form_group_for_seam_slippage_resistance_in_warp_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="seam_slippage_resistance_in_warp_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="seam_slippage_resistance_in_warp_tolerance_range_math_operator" name="seam_slippage_resistance_in_warp_tolerance_range_math_operator" onchange="seam_slippage_resistance_in_warp_cal()">
                      <option select="selected" value="select">Select Seam Slippage Resistance in Warp Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_tolerance_value" name="seam_slippage_resistance_in_warp_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_slippage_resistance_in_warp_cal()" required>
                  <!-- <select  class="form-control" id="seam_slippage_resistance_in_warp_tolerance_value" name="seam_slippage_resistance_in_warp_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_seam_slippage_resistance_in_warp_min_value">
                
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_min_value" name="seam_slippage_resistance_in_warp_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_seam_slippage_resistance_in_warp_max_value">
                
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_max_value" name="seam_slippage_resistance_in_warp_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_seam_slippage_resistance_in_warp" name="uom_of_seam_slippage_resistance_in_warp" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_seam_slippage_resistance_in_warp_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_seam_slippage_resistance_in_weft">

             <label class="control-label col-sm-4" for="seam_slippage_resistance_in_weft" style="color:#00008B;">Seam Slippage Resistance in Weft :</label>

             <div class="col-sm-1 text-center" for="form_group_for_seam_slippage_resistance_in_weft_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="seam_slippage_resistance_in_weft_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="seam_slippage_resistance_in_weft_tolerance_range_math_operator" name="seam_slippage_resistance_in_weft_tolerance_range_math_operator" onchange="seam_slippage_resistance_in_weft_cal()">
                      <option select="selected" value="select">Select Seam Slippage Resistance In Weft Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_tolerance_value" name="seam_slippage_resistance_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_slippage_resistance_in_weft_cal()" required>
                  <!-- <select  class="form-control" id="seam_slippage_resistance_in_weft_tolerance_value" name="seam_slippage_resistance_in_weft_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_seam_slippage_resistance_in_weft_min_value">
                
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_min_value" name="seam_slippage_resistance_in_weft_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_seam_slippage_resistance_in_weft_max_value">
                
                  <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_max_value" name="seam_slippage_resistance_in_weft_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_seam_slippage_resistance_in_weft" name="uom_of_seam_slippage_resistance_in_weft" value="value" >
        </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_seam_slippage_resistance_in_weft_tolerance_value_value">-->




    <div class="form-group form-group-sm" id="form-group_for_ph_value">

             <label class="control-label col-sm-4" for="ph_value" style="color:#00008B;">P<sup>H</sup> :</label>

             <div class="col-sm-1 text-center" for="form_group_for_ph_value">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>
           <div class="col-sm-1 text-center" for="ph_value_tolerance_range_math_operator" style="margin:0px; padding:0px;">
               
                 <select  class="form-control" id="ph_value_tolerance_range_math_operator" name="ph_value_tolerance_range_math_operator" onchange="ph_value_cal_without_value()">
                      <option select="selected" value="select">Select Ph Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                </select>
              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_tolerance_range_math_operator"> -->
           
                       

            <div class="col-sm-1 text-center" for="tolerance">
                   <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <input type="text" class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="ph_value_cal_without_value()" required>
                  <!-- <select  class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value">
                    <option select="selected" value="select">Select Tolerance Value</option>
                    <option value="1">1</option>
                    <option value="2"> 2 </option>
                    <option value="3">3</option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                  </select> -->
            </div>
                    
            <div class="col-sm-1" for="gap_creation" style="padding:0px; margin:0px; width:6%;">
              <!--  For Creating 1 Span Blank Space -->
              
            </div>


            <div class="col-sm-1 text-center" for="minimum_value" id="form-group_ph_value_min_value">
                
                  <input type="text" class="form-control" id="ph_value_min_value" name="ph_value_min_value" placeholder="Enter  Min Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_min_value"> -->

             <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">
                <!-- <span style="padding-left:2px;" class="form-control"><b>-</b></span> -->
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                
            </div>

            <div class="col-sm-1 text-center" for="maximum_value" id="form-group_ph_value_max_value">
                
                  <input type="text" class="form-control" id="ph_value_max_value" name="ph_value_max_value" placeholder="Enter  Max Value" required>
                
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_rubbing_wet_max_value"> -->
                  <input type="hidden" class="form-control" id="uom_of_ph_value" name="uom_of_ph_value" value="value" >
         </div>    <!-- end of <div class="form-group form-group-sm" id="form-group_for_ph_value_tolerance_value_value">-->




						<div class="form-group form-group-sm">
								<div class="col-sm-offset-4 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_finishing_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->