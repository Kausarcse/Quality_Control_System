<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
?>

<script>

function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		url: 'customized_report/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			   alert(data);
			 				document.getElementById('version_number').innerHTML=data;
			 				var splitted_data_value = data.split("?fs?");
			 				/*alert(document.getElementById('design').innerHTML=splitted_data_value[6]);*/
			 				/*$('#design').html(splitted_data_value[6]);*/
			 				$('#design').val(splitted_data_value[6]);
			 				
							
							//document.getElementById('test').innerHTML=data;
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

function select_attached_proces_of_version()
{
	
			
			//alert('Here');
			//innerHTML=splitted_data[3];
			var pp_number = document.getElementById('pp_number').value;
			var version_value = document.getElementById('version_number').value;
			var splitted_version_value = version_value.split("?fs?");
			var version_name = splitted_version_value[0];
			var color = splitted_version_value[1];
			var version_id = splitted_version_value[4];
			//alert(pp_number+" "+version_number);
            $.ajax({
			 		url: '../znzQC/customized_report/returning_attached_proces_of_version.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

			 				document.getElementById('process').innerHTML=data;

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	
	
}


function find_summary()
{
	
			
			//alert('Here');
			//innerHTML=splitted_data[3];
			var pp_number = document.getElementById('pp_number').value;
			var version_value = document.getElementById('version_number').value;
			var splitted_version_value = version_value.split("?fs?");
			var version_name = splitted_version_value[0];
			var color = splitted_version_value[1];
			var version_id = splitted_version_value[4];
			var design = document.getElementById("design").value
			var process_name = document.getElementById("process").value
			//alert(pp_number+" "+version_number);
            $.ajax({
			 		url: 'customized_report/returning_summary_of_version_for_all_test.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color,design:design,process_name:process_name},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    
                           
			 				document.getElementById('summary_result').innerHTML=data;

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	
	
}

function find_details()
{
	
			
			//alert('Here');
			//innerHTML=splitted_data[3];
			var pp_number = document.getElementById('pp_number').value;
			var version_value = document.getElementById('version_number').value;
			var process_name = document.getElementById('process').value;
			var splitted_version_value = version_value.split("?fs?");
			var version_name = splitted_version_value[0];
			var color = splitted_version_value[1];
			var version_id = splitted_version_value[4];
			//alert(pp_number+" "+version_number);
            $.ajax({
			 		url: 'customized_report/returning_details_of_version_for_all_test.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color,process_name:process_name},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

			 				document.getElementById('details_result_based_on_pp').innerHTML=data;

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	
	
}


</script>






	   <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

                <div class="panel-heading" style="color:#191970;"><b>Customized Report</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                   <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form">


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

						<div class="form-group form-group-sm" id="form-group_for_design">
                           <label class="control-label col-sm-4" for="design" style="margin-right:0px; color:#00008B;">Design: <span id=""></span></label>
                           <div class="col-sm-5"> 
                            
                             <input type="text" class="form-control" name="design" id="design" value="" readonly="">
                           </div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->


						<div class="form-group form-group-sm" id="form-group_for_version_number">
						<label class="control-label col-sm-4" for="version_number" style="margin-right:0px; color:#00008B;">Version Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number" name="version_number" onchange="select_attached_proces_of_version()">
											<option select="selected" value="select">Select Version Number</option>
											<?php 
												 // $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 // $result= mysqli_query($con,$sql) or die(mysqli_error());
												 // while( $row = mysqli_fetch_array( $result))
												 // {

													 // echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 // }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->
						
						
						
						<div class="form-group form-group-sm" id="form-group_for_process">
						<label class="control-label col-sm-4" for="process" style="margin-right:0px; color:#00008B;">Process:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="process" name="process" onchange="find_summary()">
											<option select="selected" value="select">Select Process</option>
											<?php 
												 // $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 // $result= mysqli_query($con,$sql) or die(mysqli_error());
												 // while( $row = mysqli_fetch_array( $result))
												 // {

													 // echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 // }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process"> -->
						
						<div class="row" id="summary_result" >
						   
							<!-- This is Display Section. --> 
							<div align="center" style=" margin-top:140px;"> </div>
							
							   
										 
						</div> <!-- End of <div id="summary_result"> -->
						
						<div class="row" id="details_result_based_on_pp" >
						   
							<!-- This is Display Section. --> 
							<div align="center" style=" margin-top:140px;"> </div>
							   
										 
						</div> <!-- End of <div id="summary_result"> -->


						<input type="hidden" id="customer_name" name="customer_name" value="">
						<input type="hidden" id="customer_id" name="customer_id" value="">
						<input type="hidden" id="color" name="color" value="" >
						<input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
						<input type="hidden" id="process_id" name="process_id"  value="">
						<input type="hidden" id="test_method_id" name="test_method_id"  value="">
						

						<input type="hidden" id="checking_data" name="checking_data"  value="">

                 </form>

             </div> <!-- end of <div class="panel panel-default"> -->

          
