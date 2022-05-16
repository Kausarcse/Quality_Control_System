<?php
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysql_query($sql) or die(mysqli_error($con));
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/

      $process_id=$_GET['process_id'];
      $sql = "select * from `process_name` WHERE `process_id`='$process_id'";
	  $result= mysqli_query($con,$sql) or die(mysqli_error($con));
	  $row = mysqli_fetch_array( $result);
?>
<script type='text/javascript' src='settings/process_name_form_validation.js'></script>

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
 function sending_data_of_process_name_form_for_saving_in_database()
 {


       var validate = Form_Validation();
       var url_encoded_form_data = $("#process_name_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'settings/edit_process_name_saving.php',
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

 }//End of function sending_data_of_process_name_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Process Name</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('settings/process_name.php')">Process Name</a></li>
					    <li class="breadcrumb-item"><a>Edit Process Name</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="process_name_form" id="process_name_form">

						<div class="form-group form-group-sm" id="form-group_for_process_name">
								<label class="control-label col-sm-3" for="process_name" style="color:#00008B;">Process Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="process_name" name="process_name" placeholder="Enter Process Name" value="<?php echo $row['process_name']?>"  readonly>
									<input type="hidden" class="form-control" id="process_id" name="process_id"  value="<?php echo $row['process_id']?>">
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('process_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_description_of_process">
								<label class="control-label col-sm-3" for="description_of_process" style="color:#00008B;">Description Of Process:</label>
								<div class="col-sm-5">
									<textarea class='form-control' id='description_of_process' name='description_of_process' rows='5' ><?php echo $row['description_of_process']?></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('description_of_process')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_description_of_process"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_process_name_form_for_saving_in_database()">Save</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->



</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->