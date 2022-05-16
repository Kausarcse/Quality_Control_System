<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysqli_query($con,$sql) or die(mysqli_error()());
if(mysqli_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
?>
<script type='text/javascript' src='greige_receiving/greige_receiving_form_validation.js'></script>

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

function calculate_fiber_cotent()
{
  var cotton=parseFloat(document.getElementById('percentage_of_cotton_content').value);

  var polyester=parseFloat(document.getElementById('percentage_of_polyester_content').value);
  var other_fiber=parseFloat(document.getElementById('percentage_of_other_fiber_content').value);

  var calculate= parseFloat(cotton+polyester+other_fiber);
 
  if(calculate!=100)
  {
  	alert("Fiber Content Value Must be 100 : Plaese Give Data Again.");
  	document.getElementById('percentage_of_cotton_content').value="";
  	document.getElementById('percentage_of_polyester_content').value="";
  	document.getElementById('percentage_of_other_fiber_content').value="";

    exit();
  	
  }
  else
  {
     
  }

}

function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		url: 'greige_receiving/returning_version_number_details.php',
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
			 				document.getElementById('version_name').innerHTML=data;
			 				
							
							//document.getElementById('test').innerHTML=data;
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/
 function sending_data_of_greige_receiving_form_for_saving_in_database()
 {


       var validate = Greige_Receiving_Form_Validation();
       var url_encoded_form_data = $("#greige_receiving_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'greige_receiving/greige_receiving_saving.php',
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

 }//End of function sending_data_of_greige_receiving_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Greige Receiving</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="greige_receiving_form" id="greige_receiving_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												 $sql = 'select DISTINCT pp_number from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_version_name">
						<label class="control-label col-sm-3" for="version_name" style="margin-right:0px; color:#00008B;">Version Name:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_name" name="version_name">
											<option select="selected" value="select">Select Version Name</option>
											<?php 
												 $sql = 'select DISTINCT version_name from  `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_receiving_date">
								<label class="control-label col-sm-3" for="greige_receiving_date" style="color:#00008B;">Greige Receiving Date:</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="greige_receiving_date" name="greige_receiving_date" placeholder="Enter Greige Receiving Date" required>
								</div>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="alternate_greige_receiving_date" name="alternate_greige_receiving_date" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_receiving_date')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_receiving_date"> -->
								<script>
									$( function()
									{
										$( "#greige_receiving_date" ).datepicker(
										{
											showWeek: true, // This is for Showing Week in Datepicker Calender.
											altField: "#alternate_greige_receiving_date", // This is for Descriptive Date Showing in Alternative Field.
											altFormat: "DD, d MM, yy" // This is for Descriptive Date Format in Alternative Field.
										}
										); // End of $( "#greige_receiving_date" ).datepicker(

										$( "#greige_receiving_date" ).datepicker( "option", "dateFormat", "dd/mm/yy" ); // This is for Date Format in Actual Date Field.
										$( "#greige_receiving_date" ).datepicker( "option", "showAnim", "drop" ); // This is for Datepicker Calender Animation in Actual Date Field.
									}
									); // End of $( function()
								</script>

						<div class="form-group form-group-sm" id="form-group_for_received_quantity">
								<label class="control-label col-sm-3" for="received_quantity" style="color:#00008B;">Received Quantity:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="received_quantity" name="received_quantity" placeholder="Enter Received Quantity" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('received_quantity')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_received_quantity"> -->

						<div class="form-group form-group-sm" id="form-group_for_warp_yarn_count">
								<label class="control-label col-sm-3" for="warp_yarn_count" style="color:#00008B;">Warp Yarn Count:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="warp_yarn_count" name="warp_yarn_count" placeholder="Enter Warp Yarn Count" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('warp_yarn_count')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_warp_yarn_count"> -->

						<div class="form-group form-group-sm" id="form-group_for_weft_yarn_count">
								<label class="control-label col-sm-3" for="weft_yarn_count" style="color:#00008B;">Weft Yarn Count:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="weft_yarn_count" name="weft_yarn_count" placeholder="Enter Weft Yarn Count" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('weft_yarn_count')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_weft_yarn_count"> -->

						<div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_warp_in_thread_per_inch">
								<label class="control-label col-sm-3" for="no_of_threads_in_warp_in_thread_per_inch" style="color:#00008B;">No Of Threads In Warp In Thread Per Inch:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="no_of_threads_in_warp_in_thread_per_inch" name="no_of_threads_in_warp_in_thread_per_inch" placeholder="Enter No Of Threads In Warp In Thread Per Inch" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('no_of_threads_in_warp_in_thread_per_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_warp_in_thread_per_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_weft_in_thread_per_inch">
								<label class="control-label col-sm-3" for="no_of_threads_in_weft_in_thread_per_inch" style="color:#00008B;">No Of Threads In Weft In Thread Per Inch:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="no_of_threads_in_weft_in_thread_per_inch" name="no_of_threads_in_weft_in_thread_per_inch" placeholder="Enter No Of Threads In Weft In Thread Per Inch" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('no_of_threads_in_weft_in_thread_per_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_no_of_threads_in_weft_in_thread_per_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_gsm">
								<label class="control-label col-sm-3" for="gsm" style="color:#00008B;">Gsm:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="gsm" name="gsm" placeholder="Enter Gsm" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('gsm')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_gsm"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_cotton_content">
								<label class="control-label col-sm-3" for="percentage_of_cotton_content" style="color:#00008B;">Percentage Of Cotton Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_cotton_content" name="percentage_of_cotton_content" placeholder="Enter Percentage Of Cotton Content" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_cotton_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_cotton_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content">
								<label class="control-label col-sm-3" for="percentage_of_polyester_content" style="color:#00008B;">Percentage Of Polyester Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_polyester_content" name="percentage_of_polyester_content" placeholder="Enter Percentage Of Polyester Content" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_polyester_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_name_of_other_fiber_in_yarn">
						<label class="control-label col-sm-3" for="name_of_other_fiber_in_yarn" style="margin-right:0px; color:#00008B;">Name Of Other Fiber In Yarn:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="name_of_other_fiber_in_yarn" name="name_of_other_fiber_in_yarn">
											<option select="selected" value="select">Select Name Of Other Fiber In Yarn</option>
											<option value="Viscose">Viscose</option>
											<option value="Lyotell">Lyotell</option>
											<option value="Bamboo">Bamboo</option>
											<option value="Banana">Banana</option>
											<option value="Recycle Cotton">Recycle Cotton</option>
											<option value="Recycle Polyester">Recycle Polyester</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_name_of_other_fiber_in_yarn"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_other_fiber_content">
								<label class="control-label col-sm-3" for="percentage_of_other_fiber_content" style="color:#00008B;">Percentage Of Other Fiber Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_other_fiber_content" name="percentage_of_other_fiber_content" placeholder="Enter Percentage Of Other Fiber Content" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_other_fiber_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_other_fiber_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_width">
								<label class="control-label col-sm-3" for="greige_width" style="color:#00008B;">Greige Width:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="greige_width" name="greige_width" placeholder="Enter Greige Width" onclick="calculate_fiber_cotent()" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_width')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_width"> -->

						<div class="form-group form-group-sm" id="form-group_for_status">
						<label class="control-label col-sm-3" for="status" style="margin-right:15px;color:#00008B;">Status:</label>
								<input type="radio" class="form-check-input"  value="OK" id="status" name="status">
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">OK</label>
								<input type="radio" class="form-check-input"  value="Not OK" id="status" name="status">
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">Not OK</label>
								<i class="glyphicon glyphicon-remove" onclick="Reset_Radio_Button('status')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_status"> -->

						<div class="form-group form-group-sm" id="form-group_for_remarks">
								<label class="control-label col-sm-3" for="remarks" style="color:#00008B;">Remarks:</label>
								<div class="col-sm-5">
									<textarea class='form-control' id='remarks' name='remarks' rows='5' placeholder="Enter Remarks"></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('remarks')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_remarks"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_greige_receiving_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->