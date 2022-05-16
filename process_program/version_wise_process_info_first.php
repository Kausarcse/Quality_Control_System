<?php
session_start();
include('../login/db_connection_class.php');
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
<script type='text/javascript' src='process_program/version_wise_process_info_form_validation.js'></script>

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
 function sending_data_of_version_wise_process_info_form_for_saving_in_database()
 {


       var validate = Form_Validation();
       var url_encoded_form_data = $("#version_wise_process_info_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/version_wise_process_info_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{      /*document.getElementById("form-group_for_pp_number").innerHTML=data;*/
			 				alert(data);
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_version_wise_process_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Adding Process to Version</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="version_wise_process_info_form" id="version_wise_process_info_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:</label>
								<div class="col-sm-5">
									<select  class="form-control" id="pp_number" name="pp_number">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												 $sql = 'select pp_number from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error);
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_version_name">
								<label class="control-label col-sm-3" for="version_name" style="color:#00008B;">Version Name:</label>
								<div class="col-sm-5">
									<select  class="form-control" id="version_name" name="version_name">
											<option select="selected" value="select">Select Version Name</option>
											<?php 
												 $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error);
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('version_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_name"> -->

						<!-- <div class="form-group form-group-sm" id="form-group_for_process_name">
						<label class="control-label col-sm-3" for="process_name" style="margin-right:15px;color:#00008B;">Process Name:</label>
								<input type="checkbox" class="form-check-input"  value="Singe & Desize" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Singe & Desize</label>
								<input type="checkbox" class="form-check-input"  value="Bleaching" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Bleaching</label>
								<input type="checkbox" class="form-check-input"  value="Ready For Mercerize" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Ready For Mercerize</label>
								<input type="checkbox" class="form-check-input"  value="Mercerize" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Mercerize</label>
								<input type="checkbox" class="form-check-input"  value="Equalize" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Equalize</label>
								<input type="checkbox" class="form-check-input"  value="Printing" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Printing</label>
								<input type="checkbox" class="form-check-input"  value="Curing" id="process_name" name="process_name[]">
								<label class="form-check-label control-label" for="process_name" style="margin-right:15px;">Curing</label>
								<i class="glyphicon glyphicon-remove" onclick="Reset_Checkbox(document.version_wise_process_info_form.process_name)"></i>
						</div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->

						

					<div class="form-group form-group-sm">
					 <div class="col-sm-2">
					 </div>
						<div class="col-sm-8">
											
							  <br> 
  
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>SI</th>
                                <th>Proces Name</th>
                                <th>Selection</th>

                              </tr>
                            </thead>
                            
                            <tbody>
                              <?php                                
                                $s1 = 1;
                                $process_name_check= $row['process_name'] ;
                                $sql_for_process = "SELECT * FROM process_name";
                                $res_for_process = mysqli_query($con, $sql_for_process);

                                while ($row = mysqli_fetch_assoc($res_for_process)) 
                                {
                              ?>
                          <tr>
                                                             
                                <td><?php echo $s1;?></td>
                                <td><?php echo $row['process_name'] ?></td>
                                <td>Add Text Field Here After Confirmation</td>

                               <td> <input id="process_name" class="form-check-input" type="checkbox"  name="process_name[]" value="<?php echo $row['process_name'];?>" 

                                  <?php     
                                    $save_name_check=$row['process_name'];

                                   $sql_for_duplicate = "SELECT * FROM `version_wise_process_info` WHERE `process_name`='$save_name_check'"; 
                                    $res_for_duplicate = mysqli_query($con, $sql_for_duplicate);
                                    $row_for_duplicate = mysqli_num_rows($res_for_duplicate);

                                       if ($row_for_duplicate >= 1) 
                                        {
                                          echo "checked='checked'";
                                    

                                        }
                                        else{
                                         
                                        }

                                   ?>
                                   >
                                   
                                </td> 
                           </tr>

                              <?php 
                                ++$s1;
                               }

                              ?> 
                             
                            </tbody>
                          </table>

						</div>
					</div>
					
					<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_version_wise_process_info_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>
				</form>
            
				
		</div> <!-- End of <div class="panel panel-default"> -->

  

    

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->