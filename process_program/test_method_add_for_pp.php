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


function change_up_down_arrow_icon_1(icon_lcation)
{
	
	
	//alert(icon_lcation);
	var class_name = $('#'+icon_lcation).attr('class');
    //alert(class_name);
	if(class_name=="glyphicon glyphicon-chevron-up text-right")
	{
		$('#'+icon_lcation).removeClass();
		$('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-down text-right");
	}
	else
	{
		$('#'+icon_lcation).removeClass();
		$('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-up text-right");
		
	}
	
	
} // End of function change_up_down_arrow_icon_1(icon_lcation)

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
			 			    document.getElementById('color').value=splitted_data[1]; 
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

  //var value_for_data='version_value='+splitted_version_details[0];
  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  
  document.getElementById('customer_id').value=splitted_version_details[5];
  var value_for_data='customer_id='+splitted_version_details[5]; 
   var p1=splitted_version_details[5];
   document.getElementById('form-group_for_test_method_name').style.visibility='visible';

   $.ajax({
			 		url: 'process_program/test_method_for_pp_table.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			  alert(data);
			 			  /*document.getElementById("yarn-consumption-table").innerHTML = data;*/
			 				/*$("#defining_qc_standard_for_process_form_new").load("process_program/view_qc_standard_for_process.php");*/
			 				$('#laod_table_for_test_method').html(data);
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({


  //document.getElementById('process_name').value='Bleaching'; 
}/* End of function fill_up_qc_standard_additional_info(version_details)*/   



/*function fill_customer_value(customer_id)
{
	var value_for_data= 'customer_id='+customer_id;
            $.ajax({
			 		url: 'process_program/get_table_value_for_customer.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

			 				document.getElementById('version_number').innerHTML=data;
			 				
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); 
}*/

 function sending_data_of_defining_qc_standard_for_process_form_for_saving_in_database()
 {


       
       var url_encoded_form_data = $("#defining_qc_standard_for_process_form").serialize(); //This will read all control elements value of the form	
     
		  	 $.ajax({
			 		url: 'process_program/test_method_add_for_pp_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				// $("#test_method_for_pp_table").append(data);
			 			
			 				
			 				
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({


 }//End of function sending_data_of_defining_qc_standard_for_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Add Test For a PP version</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->


				 <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_process_form" id="defining_qc_standard_for_process_form">

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
						<input type="hidden" id="customer_id" name="customer_id" value="" >
						<input type="hidden" id="color" name="color" value="" >
						<input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">

						<div class="form-group form-group-sm" id="form-group_for_process_name">
							<label class="control-label col-sm-4" for="process_name" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
							<div class="col-sm-5">
							<!-- <input  type="text" class="form-control"  id="process_name" name="process_name"  value="" readonly> -->


							<select  class="form-control" id="process_name" name="process_name" onchange="fill_customer_value(this.value)">
											<option select="selected" value="select">Select Standard</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error());
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

							</div>
						</div> 

						<br/>


                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->
       


				<div class="form-group form-group-sm" id="form-group_for_test_method_name" >
                          <div class="col-sm-3">
                           <!-- For spacing -->
                           </div>
                          <div class="col-sm-6"  id="laod_table_for_test_method" class="laod_table_for_test_method">
                          
                          
                        </div> <!-- End of <div class="col-sm-6"> -->
					</div>  <!-- End of <div class="form-group form-group-sm" id="form-group_for_test_method_name"> -->


				<!-- <div class="col-sm-3 text-center">
					<label for="test_name_and_method" style="font-size:12px; color:#000066;">Test Name & Method</label>
					
			          
				</div>
			 
				 <div class="col-sm-1 text-center">
		              <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label>
		              
		         </div>

	           <div class="col-sm-1 text-center">
		         
		       </div>
		         
		        <div class="col-sm-1 text-center">
		              <label for="value" style="font-size:12px; color:#000066;">Value</label>
		              
		        </div>
	          
	               
		         
			   <div class="col-sm-1 text-center">
			         <label for="math_op_value" style="font-size:12px; color:#000066;">Math OP.</label>
			            
			   </div>
		            
		               
		        
	          <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">

	          	<label for="tolerance_value" style="font-size:12px; color:#000066;">Tolerance</label>
	            
	            
	          </div>
		          
	          <div class="col-sm-1 text-center">
	              <label for="min_value" style="font-size:12px; color:#000066;">Unit</label>
	            
	          </div>
		            
		          
		          
	          
	          <div class="col-sm-1" for="remaining_two_spans_of_bootstrap">
	          
	             <label for="max_value" style="font-size:12px; color:#000066;">Minimum</label>
	          
	          </div>

	          <div class="col-sm-1">
	          
	             <label for="max_value" style="font-size:12px; color:#000066;">Maximum</label>
	          
	          </div>
		          

       </div> -->   <!-- End of <div class="form-group form-group-sm"  -->

						

                       

		<!-- <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="test_name"> </span> - <span id="test_method_name"> </span> </label>

	         <input type="text" class="form-control" id="test_name" name="test_name" style="visibility: hidden;" value="" readonly>
	         <input type="hidden" class="form-control" id="test_id" name="test_id" value="">
	         
	         <input type="text" class="form-control" id="test_method_name" name="test_method_name" style="visibility: hidden;" value="" readonly>
	         <input type="hidden" class="form-control" id="test_method_id" name="test_method_id" value="">
	      </div>
	       
	       <div class="col-sm-2 text-center">
	   
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="text" class="form-control" id="description_or_type" name="description_or_type" style="visibility: hidden;" value="">
	                
	           </div>

	       

	           <div class="col-sm-1 text-center">
	                 <input type="text" class="form-control" id="field_for_value" name="field_for_value" style="visibility: hidden;" value="">
	             
	         </div>
	            
	             
	          <div class="col-sm-1 text-center">
	                <input type="text" class="form-control" id="field_for_math_operator" name="field_for_math_operator" style="visibility: hidden;" value="">
	              
	           </div>
	            
	           
	              
	          <div class="col-sm-1" for="tolerance">

	             <input type="hidden" class="form-control" id="field_for_tolerance" name="field_for_tolerance" value="">
	          </div>

	          <div class="col-sm-1" for="unit">

	            <input type="text" id="field_for_uom" name="field_for_uom" style="visibility: hidden;"  value="">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	            <input type="text" class="form-control" id="field_for_minimum_value" name="field_for_minimum_value" style="visibility: hidden;" value="">

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="field_for_maximum_value" name="field_for_maximum_value" style="visibility: hidden;" value="">

	         </div>
                
       
     </div> -->  <!-- End of <div class="form-group form-group-sm" whiteness_max_value-->
						

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
		                       </div>
						</div>

		</form>



		</div> <!-- End of <div class="panel panel-default"> -->



</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->




