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
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_bleaching_process_form_validation.js'></script>
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
			 			    document.getElementById('bleaching').value=splitted_data[1]; 
			 			    document.getElementById('finish_width_in_inch').value=splitted_data[2]; 
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
*/ document.getElementById('bleaching').value=splitted_version_details[1];
   document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
   document.getElementById('customer_name').value=splitted_version_details[3]; 
   
   document.getElementById('standard_for_which_process').value='Bleaching'; 
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

 function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()
 {


       var validate = Bleaching_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_bleaching_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_bleaching_process_form_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()

</script>





	<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form_new" id="defining_qc_standard_for_bleaching_process_form_new">

	   <div class="panel panel-default">
		         <table id="datatable-buttons" class="table table-striped table-bordered">
		         	<thead>
		                 <tr>
		                 <th>SI</th>
		                 <th>PP Number</th>
		                 <th>Version ID</th>
		                 </tr>
		            </thead>
		            <tbody>
		            <?php 
		                            $s1 = 1;
		                            $standard_for_which_process='Bleaching';
		                            $sql_for_bleaching = "SELECT * FROM `defining_qc_standard_for_bleaching_process` WHERE `standard_for_which_process`='$standard_for_which_process' ORDER BY id ASC";

		                            $res_for_bleaching = mysqli_query($con, $sql_for_bleaching);

		                            while ($row = mysqli_fetch_assoc($res_for_bleaching)) 
		                            {
		             ?>

		             <tr>
		                <td><?php echo $s1; ?></td>
		                <td><?php echo $row['pp_number']; ?></td>
		                <td><?php echo $row['version_id']; ?></td>
		                <td>
		                      
		                        
		                        <!-- <button type="submit" id="edit_bleaching" name="edit_bleaching"  class="btn btn-primary btn-xs" onclick="load_page('settings/edit_bleaching.php?bleaching_id=<?php echo $row['id'] ?>')"> Edit </button>
		                       <span>  </span>
		              
		                       
		                         <button type="submit" id="delete_bleaching" name="delete_bleaching"  class="btn btn-danger btn-xs" onclick="load_page('settings/bleaching_deleting.php?bleaching_id=<?php echo $row['id'] ?>')"> Delete </button> -->
		                 </td>
		                <?php
		                              
		                $s1++;
		                                 }
		                 ?> 
		             </tr>
		          </tbody>
		         </table>

          </div>

	</form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form"> -->
