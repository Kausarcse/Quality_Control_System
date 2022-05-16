<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


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
 function sending_data_of_customer_form_for_saving_in_database()
 {


       //var validate = Customer_Form_Validation();
       var url_encoded_form_data = $("#customer_form").serialize(); //This will read all control elements value of the form	
    //    if(validate != false)
	   // {


	  	 $.ajax({
		 		url: 'settings/problems_of_machine_stopage_saving.php',
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

      // }//End of if(validate != false)

 }//End of function sending_data_of_customer_form_for_saving_in_database()


 function sending_data_for_delete(customer_id)
 {
      
       var url_encoded_form_data = 'customer_id='+customer_id;
       
		  	 $.ajax({
			 		url: 'settings/customer_deleting.php',
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



 }//End of function sending_data_for_delete()
 


/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.add_customer').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/
</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Problems of Machine Stopage</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				 <nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="customer_form" id="customer_form">

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
								<label class="control-label col-sm-3" for="problem" style="color:#00008B;">Problem:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="problem" name="problem" placeholder="Enter Problem Name" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('problem')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_address">
								<label class="control-label col-sm-3" for="description" style="color:#00008B;">Description:</label>
								<div class="col-sm-5">
									<textarea class='form-control' id='description' name='description' rows='5' placeholder="Enter Description"></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('description')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_address"> -->

						<div class="form-group form-group-sm" id="form-group_for_country_of_origin">
						<label class="control-label col-sm-3" for="problem_type" style="margin-right:0px; color:#00008B;">Problem Type:</label>
							<div class="col-sm-5">
								<select  class="form-control problem_type" id="problem_type" name="problem_type">
									<option select="selected" value="select">Select Problem Type</option>
									<option value="Electrical">Electrical</option>
									<option value="Mechanical">Mechanical</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->

						<div class="form-group form-group-sm" id="form-group_for_country_of_origin">
						<label class="control-label col-sm-3" for="problem_group" style="margin-right:0px; color:#00008B;">Problem Group:</label>
							<div class="col-sm-5">
								<select  class="form-control problem_group" id="problem_group" name="problem_group">
									<option select="selected" value="select">Select Problem Group</option>
									<option value="Machine Breakdown">Machine Breakdown</option>
									<option value="Change Over Time">Change Over Time</option>
									<option value="Schedule Maintanance">Schedule Maintanance</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_country_of_origin"> -->


						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_customer_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->




		<div class="panel panel-default">


	       
		       <div class="form-group form-group-sm">
			            

			   <div class="form-group form-group-sm">
						<label class="control-label col-sm-12" style="font-size: 25px; text-align:center; padding-top:10px" for="search">Problems of Machine Stopage</label>
					</div> 
			   </div> <!-- End of <div class="form-group form-group-sm" -->



        <div class="form-group form-group-sm">

			         <table id="datatable-buttons" class="table table-striped table-bordered">
			         	<thead>
			                 <tr>
			                 <th>SI</th>
			                 <th>Problem</th>
			                 <th>Description</th>
			                 <th>Problem Type</th>
			                 <th>Problem Group</th>
			                 <th>Action</th>
			                 </tr>
			            </thead>
			            <tbody>
			            <?php 
	                            $s1 = 1;
	                            $sql_for_color = "SELECT * FROM problems_of_machine_stopage ORDER BY id DESC";

	                            $res_for_color = mysqli_query($con, $sql_for_color);

	                            while ($row = mysqli_fetch_assoc($res_for_color)) 
	                            {
			             ?>

			             <tr>
			                <td><?php echo $s1; ?></td>
			                <td><?php echo $row['problem']; ?></td>
			                <td><?php echo $row['description']; ?></td>
			                <td><?php echo $row['problem_type']; ?></td>
			                <td><?php echo $row['problem_group']; ?></td>
			                <td>
			                      
			                        <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('settings/edit_problems_of_machine_stopage.php?id=<?php echo $row['id']?>')"> Edit </button>
			                    
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

        </div>  <!-- end of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->