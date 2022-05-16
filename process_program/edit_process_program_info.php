<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$pp_id=$_GET['pp_id'];
$sql_for_pp_info="select * from process_program_info where `row_id`='$pp_id'";

$result_for_pp_info= mysqli_query($con,$sql_for_pp_info) or die(mysqli_error($con));
$row_for_pp_info = mysqli_fetch_array( $result_for_pp_info);

?>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}
.row.no-gutter {
  margin-left: 0;
  margin-right: 0;
}

</style>
<script type='text/javascript' src='process_program/edit_process_program_info_form_validation.js'></script>
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

function mouseover()
{
  document.getElementById("span_id").style.display="block";
}
function mouseout()
{
  document.getElementById("span_id").style.display="none";
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
  
}/* End of function fill_up_qc_standard_additional_info(version_details)*/
 function sending_data_of_process_program_info_form_for_saving_in_database()
 {

       var validate = Edit_Process_Program_Info_Form_Validation();
 
       var url_encoded_form_data = $("#process_program_info_form").serialize(); //This will read all control elements value of the form	
        if(validate != false)
	   {

		  	 $.ajax({
			 		url: 'process_program/edit_process_program_info_saving.php',
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

 }//End of function sending_data_of_process_program_info_form_for_saving_in_database()


 function sending_data_for_delete(row_id)
 {
	var confirm_msg = confirm('Are you sure!!!   You want to Delete.');
	  if(confirm_msg == true)
	  {
			var url_encoded_form_data = 'row_id='+row_id;
       
	   		$.ajax({
						url: 'process_program/deleting_process_program_info.php',
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
	  }
       
 }//End of function sending_data_for_delete()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Process Program Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('process_program/process_program_info.php')">PP Creation</a></li>
                        <li class="breadcrumb-item"><a >Edit Process Program Info</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="process_program_info_form" id="process_program_info_form">

						

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="pp_number" name="pp_number" value="<?php echo $row_for_pp_info['pp_number']?>"  required readonly>
                                     
                                    <input type="hidden" class="form-control" id="pp_id" name="pp_id" value="<?php echo $pp_id?>"  required>
									
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_description">
								<label class="control-label col-sm-3" for="pp_description" style="color:#00008B;">PP Description:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<textarea class='form-control' id='pp_description' name='pp_description' rows='5' value="<?php echo $row_for_pp_info['pp_description']?>"><?php echo $row_for_pp_info['pp_description']?></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_description')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_description"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
						<label class="control-label col-sm-3" for="customer_name" style="margin-right:0px; color:#00008B;">Customer Name:<span style="color:red"> *</span></label>
							<div class="col-sm-6">
								<select  class="form-control" id="customer_name" name="customer_name">


		                                <?php
		                                  $customer_id = $row_for_pp_info['customer_id'];

		                                  

		                                  $sql = 'select * from `customer` order by `customer_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row_for_cusotmer = mysqli_fetch_array( $result))
												 {
		                                      ?>

		                                      <option <?php if($row_for_cusotmer['customer_id'] == $customer_id ){echo "selected";}?> value="<?php echo $row_for_cusotmer['customer_name'].'?fs?'.$row_for_cusotmer['customer_id'];?>"> <?php echo $row_for_cusotmer['customer_name'];?>
		                                      	
		                            </option>

			                                <?php
			                                  }
			                                ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_demand_no">
								<label class="control-label col-sm-3" for="greige_demand_no" style="color:#00008B;">Greige Demand No:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="greige_demand_no" name="greige_demand_no" value="<?php echo $row_for_pp_info['greige_demand_no']?>" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_demand_no')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_demand_no"> -->

						<div class="form-group form-group-sm" id="form-group_for_week_in_year">
								<label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;" onmouseover="mouseover()" onmouseout="mouseout()">Week :<span id="span_id" style="display:none"> Week In Year</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="week_in_year" name="week_in_year" value="<?php echo $row_for_pp_info['week_in_year']?>" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->

						<div class="form-group form-group-sm" id="form-group_for_design">
								<label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="design" name="design" value="<?php echo $row_for_pp_info['design']?>" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->

						<div class="form-group form-group-sm" id="form-group_for_remarks">
			                <label class="control-label col-sm-3" for="remarks" style="color:#00008B;">Remarks :<span style="color:red"> *</span> </label>
			                <div class="col-sm-6">
			                  <textarea type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $row_for_pp_info['remarks']?>" required><?php echo $row_for_pp_info['remarks']?></textarea>
			                </div>
			                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('remarks')"></i>
			            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_quantity"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-6">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_process_program_info_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->


		<div class="panel panel-default" id="div_table">

	  	
<div class="form-group form-group-sm">
	  <label class="control-label col-sm-5" for="search">Process Program Info List</label>
</div> <!-- End of <div class="form-group form-group-sm" -->


<div class="form-group form-group-sm">
 <table id="datatable-buttons" class="table table-striped table-bordered">
	 <thead>
		 <tr>
		 <th>Sl</th>
		 <th>PP Creation Date</th>
		 <th>PP Number</th>
		 <th>PP Description</th>
		 <th>Customer Name</th>
		 <th>Greige Demand</th>
		 <th>Week in Year</th>
		 <th>Design</th>
		 <th>Action</th>
		 </tr>
	</thead>
	<tbody>
	<?php 
					$s1 = 1;
					$sql_for_color = "SELECT * FROM process_program_info ORDER BY row_id ASC";

					$res_for_color = mysqli_query($con, $sql_for_color);

					while ($row = mysqli_fetch_assoc($res_for_color)) 
					{
						$date=date_create($row['pp_creation_date']);
						$trf_creation_date = date_format($date,"d/m/Y");
	 ?>

	 <tr>
		<td width="10"><?php echo $s1; ?></td>
		<td width="50"><?php echo $trf_creation_date; ?></td>
		<td width="75"><?php echo $row['pp_number']; ?></td>
		<td width="300"><?php echo $row['pp_description']; ?></td>
		<td width="75"><?php echo $row['customer_name']; ?></td>
		<td width="60"><?php echo $row['greige_demand_no']; ?></td>
		<td width="50"><?php echo $row['week_in_year']; ?></td>
		<td width="150"><?php echo $row['design']; ?></td>
		<td>
			  
				
				<button type="submit" id="delete_pp_info" name="delete_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_process_program_info.php?pp_id=<?php echo $row['row_id'] ?>')"> Edit </button>
			   <span>  </span>


				<button type="submit" id="view_pp_info" name="view_pp_info"  class="btn btn-info btn-xs" onclick="load_page('process_program/process_program_info_preview.php?pp_num_id=<?php echo $row['pp_num_id'] ?>')"> View </button>
			   <span>  </span>
			   			<?php
					   		   $pp_number = $row['pp_number'];
							   $sql_for_pp_wise_version ="SELECT * FROM `pp_wise_version_creation_info` WHERE pp_number = '$pp_number'";
							   $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

							   $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

							   if($row_number_for_pp_wise_version >0)
							   {
									
							   }
							   else
							   {
								   ?>
										<button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['row_id'] ?>')"> Delete </button>
									<?php
							   }

					    ?>
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

</div>  <!-- End of <div class="panel panel-default"> -->

	 

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->