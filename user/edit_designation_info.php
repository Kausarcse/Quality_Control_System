<?php
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

  $id=$_GET['designation_id'];

  $select_designation="select * from `designation_info` where `id`='$id'";
  $result = mysqli_query($con,$select_designation) or die(mysqli_error($con));
  $row = mysqli_fetch_array( $result);
?>
<script type='text/javascript' src='user/designation_info_form_validation.js'></script>

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
 function sending_data_of_designation_info_form_for_saving_in_database()
 {


       var validate = designation_Form_Validation();
       var url_encoded_form_data = $("#designation_info_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'user/edit_designation_info_saving.php',
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

 }//End of function sending_data_of_designation_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Designation Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					     <li class="breadcrumb-item active" aria-current="page">Home</li>
					     <li class="breadcrumb-item"><a onclick="load_page('user/designation_info.php')">Edit Designation Info</a></li>
					     <li class="breadcrumb-item"><a >Edit Designation Info</a></li>
					  </ol>
				</nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="designation_info_form" id="designation_info_form">

						<div class="form-group form-group-sm" id="form-group_for_designation_name">
								<label class="control-label col-sm-3" for="designation_name" style="color:#00008B;">Designation Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="designation_name" name="designation_name" value="<?php echo $row['designation'] ?>" required>
                                    <input type="hidden" class="form-control" id="designation_id" name="designation_id" value="<?php echo $row['id'] ?>">

								</div>
                                <div class="col-sm-1">
								    <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('designation_name')"></i>
                                </div>						
                            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_designation_name"> -->

                            <div class="form-group form-group-sm" id="form-group_for_designation_name">
								<label class="control-label col-sm-3" for="designation_short_name" style="color:#00008B;">Short Form:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="designation_short_name" name="designation_short_name" value="<?php echo $row['short_form'] ?>" required>
								</div>
                                <div class="col-sm-1">
								    <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('designation_short_name')"></i>
                                </div>						
                        </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_designation_short_name"> -->
						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_designation_info_form_for_saving_in_database()">Submit</button>
								</div>
						</div>

				</form>
		</div> <!-- End of <div class="panel panel-default"> -->

		<div class="panel panel-default">

<div class="form-group form-group-sm">
	<label class="control-label col-sm-12" style="font-size: 25px; text-align:center; padding-top:10px" for="search">Designation List</label>
</div> <!-- End of <div class="form-group form-group-sm" -->


<div class="form-group form-group-sm">
 <table id="datatable-buttons" class="table table-striped table-bordered">
	 <thead>
		 <tr>
		 <th>SI</th>
		 <th>Designation Name</th>
		 <th>Short Form</th>
		 <th>Action</th>
		 </tr>
	</thead>
	<tbody>
	<?php 
					$s1 = 1;
					$sql_for_designation = "SELECT * FROM designation_info ORDER BY designation ASC";

					$res_for_designation = mysqli_query($con, $sql_for_designation);

					while ($row = mysqli_fetch_assoc($res_for_designation)) 
					{
						?>

						<tr>
							<td><?php echo $s1; ?></td>
							<td><?php echo $row['designation']; ?></td>
							<td><?php echo $row['short_form']; ?></td>
							<td>
								<button type="button" id="edit_designation" name="edit_designation"  class="btn btn-primary btn-xs" onclick="load_page('user/edit_designation_info.php?designation_id=<?php echo $row['id'] ?>')"> Edit </button>              
								<button type="button" id="delete_designation" name="delete_designation"  class="btn btn-danger btn-xs" onclick="load_page('user/designation_info_deleting.php?designation_id=<?php echo $row['id'] ?>')"> Delete </button>
							</td>
							<?php
										
							$s1++;
						 }
		 ?> 
	 </tr>
	</tbody>
   </table>


  </div> <!-- End of <div class="form-group form-group-sm" -->

	 <script>
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

</div> <!-- End of <div class="panel panel-default"> -->



</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->