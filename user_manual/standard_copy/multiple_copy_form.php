<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

?>
<!-- <script type='text/javascript' src='process_program/pp_wise_version_creation_info_form_validation.js'></script> -->

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

function select_attached_proces_of_version()
{
			
	var pp_number = document.getElementById('old_pp_number').value;
	var version_value = document.getElementById('old_version_name').value;
	var splitted_version_value = version_value.split("?fs?");
	var version_name = splitted_version_value[0];
	var color = splitted_version_value[1];
	var version_id = splitted_version_value[4];
    $.ajax({
	 		url: 'process_program/returning_attached_proces_of_version.php',
	 		dataType: 'text',
	 		type: 'post',
	 		contentType: 'application/x-www-form-urlencoded',
	 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color},
	 		      
	 		success: function( data, textStatus, jQxhr )
	 		{       
	 			document.getElementById('old_version_name').innerHTML=data;
	 		},
	 		error: function( jqXhr, textStatus, errorThrown )
	 		{       
	 				//console.log( errorThrown );
	 				alert(errorThrown);
	 		}
	}); // End of $.ajax({
	
	
}

function Fill_Value_Of_Version_Number_Field_For_Searching(old_pp_number)
{
	//alert();
	//alert(pp_number_for_searching);
	var value_for_data= 'pp_number_value='+old_pp_number;

    $.ajax({
	 		url: 'copy/returning_version_number_details.php',
	 		dataType: 'text',
	 		type: 'post',
	 		contentType: 'application/x-www-form-urlencoded',
	 		data: value_for_data,
	 		      
	 		success: function( data, textStatus, jQxhr )
	 		{       
	 			document.getElementById('old_version_name').innerHTML=data;
	 		},
	 		error: function( jqXhr, textStatus, errorThrown )
	 		{       
	 				//console.log( errorThrown );
	 				alert(errorThrown);
	 		}
	}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/


function Fill_Value_Of_Version_Number_Field_For_Searching_In_Table(new_pp_number)
{
	//alert();
	//alert(pp_number_for_searching);
	var value_for_data= 'pp_number_value='+new_pp_number;

    $.ajax({
	 		url: 'standard_copy/returning_version_number_details_in_table.php',
	 		dataType: 'text',
	 		type: 'post',
	 		contentType: 'application/x-www-form-urlencoded',
	 		data: value_for_data,
	 		      
	 		success: function( data, textStatus, jQxhr )
	 		{   
                
	 			document.getElementById('version_in_table').innerHTML=data;
	 			var customer_data='customer_data='+document.getElementById('customer_id').value+'?fs?'+document.getElementById('process_technique_name').value+'?fs?'+document.getElementById('construction_name').value+'?fs?'+document.getElementById('version_name').value;

               
	 			$.ajax({
			 		url: 'standard_copy/returning_pp_number.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: customer_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			
			 			document.getElementById('old_pp_number').innerHTML=data;
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	 		},
	 		error: function( jqXhr, textStatus, errorThrown )
	 		{       
	 				//console.log( errorThrown );
	 				alert(errorThrown);
	 		}
	}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

</script>

<script>

function calculate_fiber_cotent()
{
  var cotton=parseFloat(document.getElementById('percentage_of_cotton_content').value);

  var polyester=parseFloat(document.getElementById('percentage_of_polyester_content').value);
  var other_fiber=parseFloat(document.getElementById('percentage_of_other_fiber_content').value);

  var calculate= parseFloat(cotton+polyester+other_fiber);
 
  if(calculate!=100)
  {
  	alert("Fiber Content Value Must be 100 : Plaese Give Data Again Or Leave It Blank");
  	document.getElementById('percentage_of_cotton_content').value="0";
  	document.getElementById('percentage_of_polyester_content').value="0";
  	document.getElementById('percentage_of_other_fiber_content').value="0";
  	

  
  	
  }
  else
  {
     
  }

}
 function sending_data_of_copy_form_previous_pp_for_saving_in_database()
 {

       var url_encoded_form_data = $("#copy_form_previous_pp").serialize(); 

		  	 $.ajax({
			 		url: 'copy/multiple_copy_from_previous_pp.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				document.getElementById('show_info').innerHTML=data;
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

 }
function search_pp_with_design(design)
{
	//alert();
	//alert(pp_number_for_searching);
	var value_for_data= 'design='+design;

    $.ajax({
	 		url: 'standard_copy/returning_pp_for_design.php',
	 		dataType: 'text',
	 		type: 'post',
	 		contentType: 'application/x-www-form-urlencoded',
	 		data: value_for_data,
	 		      
	 		success: function( data, textStatus, jQxhr )
	 		{      

	 		   /*alert(data); */
	 			document.getElementById('old_pp_number').innerHTML=data;
	 		},
	 		error: function( jqXhr, textStatus, errorThrown )
	 		{       
	 				//console.log( errorThrown );
	 				alert(errorThrown);
	 		}
	}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/


/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/


</script>
<div class="col-sm-12 col-md-12 col-lg-12">


		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Copy Standard</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="copy_form_previous_pp" id="copy_form_previous_pp">



					    <h5 class="text-center">New Process Program</h5>  
			            <div class="form-group form-group-sm" id="form-group_for_pp_number">

			                                    <?php 
			                         $sql = 'select pp_num_id from `process_program_info`';
			                         $result= mysqli_query($con,$sql) or die(mysqli_error);
			                         while( $row = mysqli_fetch_array( $result))
			                         {

			                           echo ' <input type="hidden" name="pp_num_id" id="pp_num_id" value="'.$row['pp_num_id'].'">';

			                         }

			                       ?>
			                
			            <label class="control-label col-sm-3" for="new_pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label> 
			              <div class="col-sm-5">
			                <select  class="form-control for_auto_complete" id="new_pp_number" name="new_pp_number" onchange="Fill_Value_Of_Version_Number_Field_For_Searching_In_Table(this.value)">
			                      <option select="selected" value="select">Select PP Number</option>
			                      <?php 
			                         $sql = 'select * from `process_program_info` order by `pp_number`';
			                         $result= mysqli_query($con,$sql) or die(mysqli_error);
			                         while( $row = mysqli_fetch_array( $result))
			                         {
			                           echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';
			                         }

			                       ?>
			                </select>
			              </div>
			            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

			            <div class="container">
			            	<div id="version_in_table"></div>
			            </div>


			            

           				<h5 class="text-center">Copy from Process Program</h5>              
						<div class="form-group form-group-sm" id="form-group_for_pp_number">

                                    <?php 
										 $sql = 'select pp_num_id from `process_program_info`';
										 $result= mysqli_query($con,$sql) or die(mysqli_error);
										 while( $row = mysqli_fetch_array( $result))
										 {

											 echo ' <input type="hidden" name="pp_num_id" id="pp_num_id" value="'.$row['pp_num_id'].'">';

										 }

									?>

					     <div class="form-group form-group-sm" id="form-group_for_design">
						    <label class="control-label col-sm-3" for="design" style="margin-right:0px; color:#00008B;">Design(optional):</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="design" name="design" onchange="search_pp_with_design(this.value)">
											<option select="selected" value="select">Select Design</option>
											<?php 
												 $sql = 'select * from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['design'].'">'.$row['design'].'</option>';

												 }

											 ?>
								</select>

							</div> <!-- End of <div class="col-sm-5"> -->
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->
							  
						<div class="form-group form-group-sm" id="form-group_for_pp_number_for_searching">
						    <label class="control-label col-sm-3" for="old_pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="old_pp_number" name="old_pp_number" onchange="Fill_Value_Of_Version_Number_Field_For_Searching(this.value)">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												 $sql = 'select * from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>

							</div> <!-- End of <div class="col-sm-5"> -->
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->


						<div class="form-group form-group-sm" id="form-group_for_version_number_for_searching">
						<label class="control-label col-sm-3" for="old_version_name" style="margin-right:0px; color:#00008B;">Version Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="old_version_name" name="old_version_name">
											<option select="selected" value="select">Select Version Number</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->


						

						<div id="show_info"></div>


						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_copy_form_previous_pp_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->


  

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->