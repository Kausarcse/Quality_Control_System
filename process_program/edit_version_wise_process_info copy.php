<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysql_query($sql) or die(mysqli_error()());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
if(isset($_GET['update_value']))
{
	 $update_value = $_GET['update_value'];
	$spiltted_data = explode('?fs?', $update_value);

	$pp_number = $spiltted_data[0];
	$version_id = $spiltted_data[1];
	$version_name = $spiltted_data[2];
	$color = $spiltted_data[3];
	$finish_width_in_inch = $spiltted_data[4];
}

if(isset($_GET['pp_number']))
{
	$pp_number=$_GET['pp_number'];
	$split_pp_number=explode('?dataseperator?',$pp_number);
	$pp_number=$split_pp_number[0];
	$version_id_name=$split_pp_number[1];
	$split_version_id_name = explode('?fds?',$version_id_name);
	$version_id = $split_version_id_name[0];
	$version_name = $split_version_id_name[1];
	$color = $split_version_id_name[2];
	$finish_width_in_inch = $split_version_id_name[3];
}

if(isset($_GET['pp_and_version']))
{
	$pp_and_version=$_GET['pp_and_version'];
	$split_pp_and_version=explode('?fs?',$pp_and_version);
	$pp_number=$split_pp_and_version[0];
	$version_name=$split_pp_and_version[1];
	$version_id=$split_pp_and_version[2];
	$color=$split_pp_and_version[3];
	$finish_width_in_inch=$split_pp_and_version[4];
}

$sql = "select DISTINCT * from adding_process_to_version where pp_number = '$pp_number' and version_id = '$version_id' and version_name = '$version_name' and finish_width_in_inch = '$finish_width_in_inch'";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
$row_for_select = mysqli_fetch_array( $result);



?>
<script type='text/javascript' src='process_program/version_wise_process_info_form_validation.js'></script>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>
//document.getElementById('version_name').value='<?php //echo $version_name ?>';

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

 function deleting_specific_row_of_process_adding_table(row_number)
 {
	 
	
	 var table=document.getElementById("process_adding_table");
/*
	 var child_element = table.rows[row_number].cells[1].childNodes[1].id;
	 var child = document.getElementById(child_element);
	 table.rows[row_number].cells[1].removeChild(child);
	 
	 child_element = table.rows[row_number].cells[2].childNodes[1].id;
	 child = document.getElementById(child_element);
	 table.rows[row_number].cells[2].removeChild(child);
*/	 
	 table.deleteRow(row_number);
	 
	 var total_rows=table.rows.length;
   	 for(var i=1; i<total_rows; i++ ) // New Serial Number Creating
   	 {

    	table.rows[i].cells[0].innerHTML  = i;

	 }

	 
 } // End of function deleting_specific_row_of_process_adding_table(row_number)
 
 function adding_specific_row_of_process_adding_table(row_number)
 {
	 var table=document.getElementById("process_adding_table");

	 //var total_rows = table.rows.length;    // Finding total number of Rows in this table.
	 var total_rows = document.getElementById("total_row").value;    // Finding total number of Rows in this table.
	 var total_columns = table.rows[0].cells.length; // Finding total number of Cells/Columns in this table.

	//  alert(total_columns);
	//  alert(total_rows);

	 //alert(total_rows);
	 var new_row_position = row_number+1;

	 var new_row = table.insertRow(new_row_position); // This will insert new row in this table.

	 for(var i=0;i<total_columns;i++) // Adding All Columns to New Row.  
	 {

		var new_cell = new_row.insertCell(i);
		
	 }
	 
	

	adding_new_form_elements_in_process_adding_table(row_number);

	 var last_cell=total_columns-1;
	 /*var last_cell=total_columns+1;*/
	 table.rows[new_row_position].cells[last_cell].setAttribute("align","center");
	 table.rows[new_row_position].cells[last_cell].setAttribute("style","padding-left:0px; padding-right:0px;");
	 
	 table.rows[new_row_position].cells[last_cell].innerHTML='<button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button> <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>';

	 for(var i=1; i<= total_rows ; i++ ) // New Serial Number Creating
   	 {
    	table.rows[i].cells[0].innerHTML  = i;
		
	 }
	 //alert(i);
	 for(var i=1; i<= total_rows ; i++ ) // New Serial Number Creating
   	 {
    	table.rows[i].cells[0].innerHTML  = i;
	 }
	 
	 // adding_new_form_elements_in_process_adding_table(row_number);
} // End of function adding_specific_row_of_process_adding_table(row_number)

function adding_new_form_elements_in_process_adding_table(row_number)
{
	var possible_number_of_process = document.getElementById("possible_number_of_process").value;
	var new_possible_number_of_process = parseInt(possible_number_of_process) + 1;
	document.getElementById("possible_number_of_process").value = new_possible_number_of_process;
	//alert(new_possible_number_of_process);
	
	var table=document.getElementById("process_adding_table");
	//var total_rows = table.rows.length;    // Finding total number of Rows in this table.
	var total_rows = document.getElementById("total_row").value;
	var new_row_position = row_number+1;

	var select_elements_of_all_process_names = document.createElement("select");
	select_elements_of_all_process_names.setAttribute("class","form-control");
	select_elements_of_all_process_names.setAttribute("id","process_name_"+new_possible_number_of_process);
	select_elements_of_all_process_names.setAttribute("name","process_name_"+new_possible_number_of_process);
	
	table.rows[new_row_position].cells[1].appendChild(select_elements_of_all_process_names);
	

	var option_elements = document.createElement("option");
	option_elements.setAttribute("selected", "selected");
	option_elements.setAttribute("value", "select");
	var text = document.createTextNode("Select Process Name");
	option_elements.appendChild(text);
	new_select_element = "process_name_"+new_possible_number_of_process;
	document.getElementById(new_select_element).appendChild(option_elements);

	var all_process_list = document.getElementById('all_process_names').innerHTML;

	var splitted_all_process_list = all_process_list.split("?proc?");


    for(var i=0;i<splitted_all_process_list.length-1;i++)
	{
		option_elements = document.createElement("option");
		option_elements.setAttribute("value",splitted_all_process_list[i].trim());

		
	    var all_process_list_for_process_name = splitted_all_process_list[i].split("?fs?");
	    /*alert(all_process_list_for_process_name[0]);*/

		
        
	    var text1 = all_process_list_for_process_name[0].replaceAll("&amp;", "&");
	    text = document.createTextNode(text1.trim());
		

		option_elements.appendChild(text);
		new_select_element = "process_name_"+new_possible_number_of_process;
		document.getElementById(new_select_element).appendChild(option_elements);

	
	}
	table.rows[new_row_position].cells[2].innerHTML='<input type="text" class="form-control"  id="process_serial_'+new_possible_number_of_process+'" name="process_serial_'+new_possible_number_of_process+'">';

	table.rows[new_row_position].cells[3].innerHTML='<select  class="form-control" id="process_or_reprocess_'+new_possible_number_of_process+'" name="process_or_reprocess_'+new_possible_number_of_process+'">'
											+'<option value="process" select="selected">Process</option>'
											+'<option value="re-process">Re-Process</option>'
											+'<option value="2nd-Re-Process">2nd-Re-Process</option>'
											+'<option value="3rd-Re-Process">3rd-Re-Process</option>'
											+'<option value="4th-Re-Process">4th-Re-Process</option>'
								            +' </select>';
	
	
} // End of function adding_new_form_elements_in_process_adding_table(row_number)


function Fill_Value_Of_Version_Number_Field_For_Searching(pp_number_for_searching)
{
    		//alert();
			//alert(pp_number_for_searching);
			var value_for_data= 'pp_number_value='+pp_number_for_searching;

            $.ajax({
			 		url: 'process_program/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    
                            
			 				document.getElementById('version_name').innerHTML=data;

			 				var splitted_data_for_customer=data.split('?fs?');
			 				document.getElementById('finish_width_in_inch').value=splitted_data_for_customer[2];			 				
			 				document.getElementById('customer_name').value=splitted_data_for_customer[3];			 				
			 				document.getElementById('style_name').value=splitted_data_for_customer[6];			 				
							
							//document.getElementById('test').innerHTML=data;
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

 function sending_data_of_version_wise_process_info_form_for_saving_in_database()
 {

		
	   var validate = Form_Validation();


      var url_encoded_form_data = $("#edit_version_wise_process_info_form").serialize(); ///This will read all control elements value of the form
    


       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/edit_version_wise_process_info_saving.php',
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


 function sending_data_for_delete(value)
 {
      
       var url_encoded_form_data = 'process_id='+value;
       
		  	 $.ajax({
			 		url: 'process_program/deleting_version_wise_process_info.php',
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





</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Process to Version Form</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item active" aria-current="page" >Home</li>
						    <li class="breadcrumb-item"><a onclick="load_page('process_program/version_wise_process_info.php')">Adding Process to Version</a></li>
						    <li class="breadcrumb-item"><a>Edit Process to Version</li>
						  </ol>
			    </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="edit_version_wise_process_info_form" id="edit_version_wise_process_info_form">

					

						<div class="form-group form-group-sm" id="form-group_for_pp_number">

							<label><span id="show"></span></label>
                                
							    <?php 
							                    /* for pp number id*/
												 $sql_for_pp = 'select pp_num_id from `process_program_info`';
												 $result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
												 while( $row_for_pp = mysqli_fetch_array( $result_for_pp))
												 {

													 echo ' <input type="hidden" name="pp_num_id" id="pp_num_id" value="'.$row_for_pp['pp_num_id'].'">';

												 }

								?>

								 <?php 
							                    /* for version id*/
												 $sql_for_pp = 'select DISTINCT version_id from `version_name`';
												 $result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
												 while( $row_for_pp = mysqli_fetch_array( $result_for_pp))
												 {

													 echo ' <input type="hidden" name="version_id" id="version_id" value="'.$row_for_pp['version_id'].'">';

												 }

								?>
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:</label>
								<div class="col-sm-5">

									<input class="form-control" type="text" name="pp_number" id="pp_number" value="<?php echo $pp_number; ?>" readonly>
									<input class="form-control" type="hidden" name="pp_num_id" id="pp_num_id" value="<?php echo $row_for_select['pp_num_id']; ?>" readonly>

									
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->
                         


                         <input type="hidden" name="finish_width_in_inch" id="finish_width_in_inch" value="<?php echo $row_for_select['finish_width_in_inch'] ?>">
                         <input type="hidden" name="customer_name" id="customer_name" value="<?php echo $row_for_select['customer_name'] ?>">
                         <input type="hidden" name="style_name" id="style_name" value="<?php echo $row_for_select['style_name'] ?>">
                         <input type="hidden" name="version_id" id="version_id" value="<?php echo $version_id ?>">
                         <input type="hidden" name="color" id="color" value="<?php echo $row_for_select['color'] ?>">
						
					
						<div class="form-group form-group-sm" id="form-group_for_version_name">
								<label class="control-label col-sm-3" for="version_name" style="color:#00008B;">Version :</label>
								<div class="col-sm-5">
									<input type="text"  class="form-control" name="version_name" id="version_name" value="<?php echo $row_for_select['version_name'] ?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('version_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_name"> -->


					<input type="hidden" id="possible_number_of_process" name="possible_number_of_process" value="20">
						
					
					<div class="form-group form-group-sm">
                         <div class="col-sm-2">
                         
                            <!-- This is for creating Gap in Left Side Before Table -->
                         
                         </div>
					  <div class="col-sm-7"> <!-- This will hold table in the form -->
											
						   <br> 
                        <table id="process_adding_table" class="table table-striped table-bordered" style="padding:0px; margin:0px;">
                             <thead>
                                   <tr>
                                     <th style="width:10px;">SI</th>
                                     <th style='text-align:center;'>Process Name</th>
                                     <th style="width:130px; text-align:center" >Process Sl No.</th>
                                     <th style="width:100px;text-align:center;" >Procress/Reprocess</th>
                                     <th style="width:100px;text-align:center;" >Action</th>
                                     
        
                                   </tr>
                             </thead>
                                
                             <tbody>

                               <?php 
                               		/* for process*/
									 $sql_for_process = "select * from adding_process_to_version where pp_number = '$pp_number' and version_id = '$version_id' and version_name = '$version_name' and color = '$color' and finish_width_in_inch = '$finish_width_in_inch'";
									 $result_for_process= mysqli_query($con,$sql_for_process) or die(mysqli_error($con));
									 $sl = 1;
									 while( $row_for_process = mysqli_fetch_array( $result_for_process))
									 {

									 	 ?>
									 	 <tr>
									 	 	<td><?php echo $sl; ?></td>

									 	 	<td>  
												<select  class="form-control" id="process_name_<?php echo $sl;?>" name="process_name_<?php echo $sl;?>">
													<option  value="select">Select Process Name</option>
													<?php 
														 $select_process = $row_for_process['process_id'];

														 $sql = 'select * from `process_name` order by `row_id`';
														 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
														 while( $row = mysqli_fetch_array( $result))
														 {

														 	if ($row['process_id'] == $select_process) 
														 	{
														 		echo '<option selected value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';
														 	}

															else
															{
																echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';
															}

														 }

													 ?>
												</select>
			                         		</td>

			                         		<td align="center">
			                                 	<input type="text" class="form-control"  id="process_serial_<?php echo $sl;?>" name="process_serial_<?php echo $sl;?>" value="<?php echo $sl;?>">
			                                 </td>

			                                 <td>
			                                 	<select  class="form-control" id="process_or_reprocess_<?php echo $sl;?>" name="process_or_reprocess_<?php echo $sl;?>">
												 <?php
														 $select_process_or_reprocess = $row_for_process['process_or_reprocess'];

														 $sql_process_or_reprocess = "select distinct process_or_reprocess from adding_process_to_version where pp_number = '$pp_number' and version_name = '$version_name' and color = '$color' and finish_width_in_inch = '$finish_width_in_inch'";
														 $result_process_or_reprocess= mysqli_query($con,$sql_process_or_reprocess) or die(mysqli_error($con));
														 while( $row_process_or_reprocess = mysqli_fetch_array( $result_process_or_reprocess))
														 {

														 	if ($row_process_or_reprocess['process_or_reprocess'] == $select_process_or_reprocess) 
														 	{
														 		echo '<option selected value="'.$row_process_or_reprocess['process_or_reprocess'].'">'.$row_process_or_reprocess['process_or_reprocess'].'</option>';
														 	}
														 }
				                                ?>
												 		<option value="process">Process</option>
														<option value="re-process">Re-Process</option>
														<option value="2nd-Re-Process">2nd-Re-Process</option>
														<option value="3rd-Re-Process">3rd-Re-Process</option>
														<option value="4th-Re-Process">4th-Re-Process</option>
											   </select>
			                                 </td>

			                                 <td align="center" style="padding-left:0px; padding-right:0px;">

			                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
			                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
			                              	</td>
			                              <tr>

									 	 <?php

										 $sl++;
									 }
                               ?>

                          </tbody>
                        </table>

						</div>  <!-- End of <div class="col-sm-7"> <-- This will hold table in the form --> 
						<input type="hidden" name="total_row" id="total_row" value="<?php echo $sl; ?>">
					</div>
					
					<div class="form-group form-group-sm" id='form-group_div_for_submit_button'>
								<div class="col-sm-offset-2 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_version_wise_process_info_form_for_saving_in_database()">Save</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
					</div> <!-- End of <div class="form-group form-group-sm" id='form-group_div_for_submit_button'> -->
				</form>
            
				
		</div> <!-- End of <div class="panel panel-default"> -->


<div id='all_process_names' style="visibility:hidden;">

               
                <?php 
                        $sql = 'select * from `process_name` order by `process_name`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                        while( $row = mysqli_fetch_array( $result))
                        {
                           
                            echo $row['process_name']."?fs?".$row['process_id']."?proc?";
                           
    
                        }
    
                ?>



</div>