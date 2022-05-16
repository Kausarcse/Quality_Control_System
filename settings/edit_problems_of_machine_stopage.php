<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$id=$_GET['id'];
$sql = "select * from `problems_of_machine_stopage` WHERE `id`='$id'";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_array( $result);
?>
<script type='text/javascript' src='settings/customer_form_validation.js'></script>

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
 function sending_data_of_customer_edit_form_for_saving_in_database()
 {

       var url_encoded_form_data = $("#customer_form").serialize(); 

  	 $.ajax({
	 		url: 'settings/edit_problems_of_machine_saving.php',
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

 }//End of function sending_data_of_customer_edit_form_for_saving_in_database()
/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.add_customer').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/
</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Machine Stopage Problem</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('settings/add_problems_of_machine_stopage.php')">Add New Machine Stopage Problem</a></li>
					    <li class="breadcrumb-item"><a>Edit Machine Stopage Problem</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="customer_form" id="customer_form">

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
								<label class="control-label col-sm-3" for="problem" style="color:#00008B;">Problem:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="problem" name="problem" placeholder="Enter problem Name" value="<?php echo $row['problem']?>" required>
									<input type="hidden" type="text" class="form-control" id="id" name="id" value="<?php echo $row['id']?>" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('problem')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_address">
								<label class="control-label col-sm-3" for="description" style="color:#00008B;">Description:</label>
								<div class="col-sm-5">
									<textarea class='form-control' id='description' name='description' rows='5' value=""><?php echo $row['description']?></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('description')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_address"> -->


						<div class="form-group form-group-sm" id="form-group_for_customer_type">
						<label class="control-label col-sm-3" for="problem_type" style="margin-right:0px; color:#00008B;">Problem Type:</label>
							<div class="col-sm-5">
								<select  class="form-control problem_type" id="problem_type" name="problem_type">
													
								<option value="" >Select Problem type</option>
		                                <?php
		                                  echo $problem_type = $row['problem_type'];
		                                ?>

		                                    <option <?php if( 'Electrical' == $problem_type){echo "selected";}?> value="Electrical">Electrical</option>

								<option <?php if( 'Mechanical' == $problem_type){echo "selected";}?> value="Mechanical">Mechanical</option>

		                                      
								</select>
							</div>
							                
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_type"> -->


						<div class="form-group form-group-sm" id="form-group_for_customer_type">
						<label class="control-label col-sm-3" for="problem_group" style="margin-right:0px; color:#00008B;">Problem Group:</label>
							<div class="col-sm-5">
								<select  class="form-control problem_group" id="problem_group" name="problem_group">
													
								<option value="" >Select Problem Group</option>
		                                <?php
		                                  $problem_group = $row['problem_group'];
		                                ?>

								<option <?php if( 'Machine Breakdown' == $problem_group){echo "selected";}?> value="Machine Breakdown">Machine Breakdown</option>

								<option <?php if( 'Change Over Time' == $problem_group){echo "selected";}?> value="Change Over Time">Change Over Time</option>

								<option <?php if( 'Schedule Maintanance' == $problem_group){echo "selected";}?> value="Schedule Maintanance">Schedule Maintanance</option>

		                                      
								</select>
							</div>
							                
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_type"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_customer_edit_form_for_saving_in_database()">Update</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->





</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->