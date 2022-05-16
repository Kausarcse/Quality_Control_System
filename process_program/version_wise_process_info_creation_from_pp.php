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

$result=mysql_query($sql) or die(mysqli_error($con)());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/


$all_data=$_GET['all_data'];
$splitted_receiving_date= explode("?fs?",$all_data);
$pp_number= $splitted_receiving_date[0];
$version_id= $splitted_receiving_date[1];


 $sql_for_row_id = "SELECT * FROM `pp_wise_version_creation_info`, `process_program_info` 
							WHERE `process_program_info`.`pp_number`='$pp_number' AND `pp_wise_version_creation_info`.`version_id`='$version_id'";

$res_for_id = mysqli_query($con, $sql_for_row_id);

$row_for_id = mysqli_fetch_assoc($res_for_id);
?>
<script type='text/javascript' src='process_program/version_wise_process_info_form_validation.js'></script>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

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

	 var total_rows = table.rows.length;    // Finding total number of Rows in this table.
	 var total_columns = table.rows[0].cells.length; // Finding total number of Cells/Columns in this table.
	 //alert(total_rows);
	 var new_row_position = row_number+1;
	 var new_row = table.insertRow(new_row_position); // This will insert new row in this table.
	 
	 for(var i=0;i<total_columns;i++) // Adding All Columns to New Row.  
	 {

		var new_cell = new_row.insertCell(i);
		
	 }
	 var last_cell=total_columns-1;
	 table.rows[new_row_position].cells[last_cell].setAttribute("align","center");
	 table.rows[new_row_position].cells[last_cell].setAttribute("style","padding-left:0px; padding-right:0px;");
	 
	 table.rows[new_row_position].cells[last_cell].innerHTML='<button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button> <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>';
	 
	 for(var i=1; i<= total_rows ; i++ ) // New Serial Number Creating
   	 {

    	 table.rows[i].cells[0].innerHTML  = i;

	 }
	 
	 adding_new_form_elements_in_process_adding_table(row_number);
} // End of function adding_specific_row_of_process_adding_table(row_number)

function adding_new_form_elements_in_process_adding_table(row_number)
{
	
	var possible_number_of_process = document.getElementById("possible_number_of_process").value;
	var new_possible_number_of_process = parseInt(possible_number_of_process) + 1;
	document.getElementById("possible_number_of_process").value = new_possible_number_of_process;
	//alert(new_possible_number_of_process);
	
	var table=document.getElementById("process_adding_table");
	var total_rows = table.rows.length;    // Finding total number of Rows in this table.
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
	var splitted_all_process_list = all_process_list.split("?fs?");

	for(var i=0;i<splitted_all_process_list.length-1;i++)
	{
		option_elements = document.createElement("option");
		option_elements.setAttribute("value",splitted_all_process_list[i].trim());
		text = document.createTextNode(splitted_all_process_list[i].trim());
		option_elements.appendChild(text);
		new_select_element = "process_name_"+new_possible_number_of_process;
		document.getElementById(new_select_element).appendChild(option_elements);
	}
	table.rows[new_row_position].cells[2].innerHTML='<input type="text" class="form-control"  id="process_serial_'+new_possible_number_of_process+'" name="process_serial_'+new_possible_number_of_process+'">';

	table.rows[new_row_position].cells[3].innerHTML='<select  class="form-control" id="process_or_reprocess_'+new_possible_number_of_process+'" name="process_or_reprocess_'+new_possible_number_of_process+'">'
											+'<option value="process" select="selected">Process</option>'
											+'<option value="re-process">Re-Process</option>'
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

				<div class="panel-heading" style="color:#191970;"><b>Adding Process to Version Form</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item active" aria-current="page" >Home</li>
						    <li class="breadcrumb-item"><a onclick="load_page('process_program/pp_wise_version_creation_info.php')">PP Wise Verdion Creation Info</a></li>
						    <li class="breadcrumb-item" onclick="load_page('process_program/pp_wise_version_creation_info.php')"><a>Adding Process to Version</a></li>
						  </ol>
			    </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="version_wise_process_info_form" id="version_wise_process_info_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
                                
							    <?php 
							                    /* for pp number id*/
												/* $sql_for_pp = 'select pp_num_id from `process_program_info`';
												 $result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
												 while( $row_for_pp = mysqli_fetch_array( $result_for_pp))
												 {
*/
													/* echo ' <input type="hidden" name="pp_num_id" id="pp_num_id" value="'.$row_for_pp['pp_num_id'].'">';*/
													 
													 echo ' <input type="hidden" name="pp_num_id" id="pp_num_id" value="'.$row_for_id['pp_num_id'].'">';

												 /*}*/

								?>

								 <?php 
							                    /* for version id*/
												 $sql_for_pp = 'select version_id from `version_name`';
												 $result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
												 while( $row_for_pp = mysqli_fetch_array( $result_for_pp))
												 {

													 echo ' <input type="hidden" name="version_id" id="version_id" value="'.$row_for_id['version_id'].'">';

												 }

								?>
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:</label>
								<div class="col-sm-5">
									<!-- <select  class="form-control" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field_For_Searching(this.value)">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												//  $sql = 'select pp_number from `process_program_info` order by `pp_number`';
												//  $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												//  while( $row = mysqli_fetch_array( $result))
												//  {

												// 	 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												//  }

											 ?>
								</select> -->


								 <input type="text" class="form-control"  value="<?php echo $row_for_id['pp_number'];?>" readonly>

								 <input type="hidden" class="form-control" name="pp_number" id="pp_number" value="<?php echo $row_for_id['pp_number'].'?fs?'.$row_for_id['pp_num_id'];?>">


								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_version_name">
								<label class="control-label col-sm-3" for="version_name" style="color:#00008B;">Version :</label>
								<div class="col-sm-5">
									<!-- <select  class="form-control" id="version_name" name="version_name" >
											<option select="selected" value="select">Select Version Name</option>
											<?php 
												//  $sql = 'select DISTINCT version_name from `pp_wise_version_creation_info`,`process_program_info` where `pp_wise_version_creation_info`.pp_num_id= `process_program_info`.pp_num_id ';
												//  $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												//  while( $row = mysqli_fetch_array( $result))
												//  {

												// 	 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												//  }

											 ?>
								</select> -->

								<!-- <input type="text" class="form-control" name="version_name" id="version_name" value="<?php //echo $row_for_id['version_name']?>" readonly> -->
								<input type="text" class="form-control"  value="<?php echo $row_for_id['version_name'];?>" readonly>


								<input type="hidden" class="form-control" name="version_name" id="version_name" value="<?php echo $row_for_id['version_name']."?fs?".$row_for_id['color']."?fs?".$row_for_id['finish_width_in_inch']."?fs?".$row_for_id['customer_name']."?fs?".$row_for_id['version_id']."?fs?".$row_for_id['customer_id']."?fs?".$row_for_id['style_name'].'?fs?';?>">
								
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('version_name')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_name"> -->


					<input type="hidden" id="possible_number_of_process" name="possible_number_of_process" value="30">
						
					
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
                                 
                 
                              <tr id='row_for_process_01'>
                              	 <td>1</td>
                              	 <td>
                           			 <!-- <input type="text" class="form-control"  id="process_name_1" name="process_name_1" value="'.'Greige Receiving'.'?fs?'.'proc_20'.'"> -->
									<select  class="form-control" id="process_name_1" name="process_name_1">
												<option  value="select">Select Process Name </option>
												<?php 
												 $sql = "select * from `process_name` Where `row_id`='20'";
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.'Greige Receiving'.'?fs?'.'proc_20'.'">'.'Greige Receiving'.'</option>';

												 }

											 ?>
								</select>
							
						
                         </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_1" name="process_serial_1" value="1">
                                 
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_1" name="process_or_reprocess_1">
											<option value="process" select="selected">Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>2</td>
                              	 <td>

								<select  class="form-control" id="process_name_2" name="process_name_2">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_2" name="process_serial_2" value="2">
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_2" name="process_or_reprocess_2">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>

                               <tr>
                              	 <td>3</td>
                              	 <td>

								<select  class="form-control" id="process_name_3" name="process_name_3">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_3" name="process_serial_3" value="3">
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_3" name="process_or_reprocess_3">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                               <tr>
                              	 <td>4</td>
                              	 <td>

								<select  class="form-control" id="process_name_4" name="process_name_4">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_4" name="process_serial_4" value="4">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_4" name="process_or_reprocess_4">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>

                               <tr>
                              	 <td>5</td>
                              	 <td>

								<select  class="form-control" id="process_name_5" name="process_name_5">
											<option  value="select">Select Process Name</option>
											select  class="form-control" id="process_name_5" name="process_name_5">
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_5" name="process_serial_5" value="5">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_5" name="process_or_reprocess_5">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>6</td>
                              	 <td>

								<select  class="form-control" id="process_name_6" name="process_name_6">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_6" name="process_serial_6" value="6">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_6" name="process_or_reprocess_6">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>7</td>
                              	 <td>

								<select  class="form-control" id="process_name_7" name="process_name_7">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_7" name="process_serial_7" value="7">
                                 
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_7" name="process_or_reprocess_7">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>
                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>8</td>
                              	 <td>

								<select  class="form-control" id="process_name_8" name="process_name_8">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_8" name="process_serial_8" value="8">
                                 
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_8" name="process_or_reprocess_8">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               


                               <tr>
                              	 <td>9</td>
                              	 <td>

								<select  class="form-control" id="process_name_9" name="process_name_9">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>


                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_9" name="process_serial_9" value="9">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_9" name="process_or_reprocess_9">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>

                               <tr>
                              	 <td>10</td>
                              	 <td>

								<select  class="form-control" id="process_name_10" name="process_name_10">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_10" name="process_serial_10" value="10">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_10" name="process_or_reprocess_10">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>11</td>
                              	 <td>

								<select  class="form-control" id="process_name_11" name="process_name_11">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 
                                 <input type="text" class="form-control"  id="process_serial_11" name="process_serial_11" value="11">
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_11" name="process_or_reprocess_11">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>12</td>
                              	 <td>

								<select  class="form-control" id="process_name_12" name="process_name_12">
											<option  value="select">Select Process Name </option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>



                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_12" name="process_serial_12" value="12">
                                 
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_12" name="process_or_reprocess_12">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>
                               <tr>
                              	 <td>13</td>
                              	 <td>

								<select  class="form-control" id="process_name_13" name="process_name_13">
											<option  value="select">Select Process Name</option>
											<?php 
												 $sql = 'select  * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>

                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_13" name="process_serial_13" value="13">
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_13" name="process_or_reprocess_13">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              </tr>

                              <tr>
                              	 <td>12</td>
                              	 <td>

								<select  class="form-control" id="process_name_14" name="process_name_14">
											<option  value="select">Select Process Name </option>
											<?php 
												 $sql = 'select * from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>



                              	 </td>
                              	 <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_14" name="process_serial_14" value="14">
                                 
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_14" name="process_or_reprocess_14">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                              	 <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                              	</td>
                              	 
                              </tr>

                              <tr>
                                  <td>15</td>
                                  <td>

                        <select  class="form-control" id="process_name_15" name="process_name_15">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_15" name="process_serial_15" value="15">
                                 
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_15" name="process_or_reprocess_15">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>

                              <tr>
                                  <td>16</td>
                                  <td>

                        <select  class="form-control" id="process_name_16" name="process_name_16" value="16">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_16" name="process_serial_16" value="16">
                                 
                                 </td>
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_16" name="process_or_reprocess_16">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>

                               <tr>
                                  <td>17</td>
                                  <td>

                        <select  class="form-control" id="process_name_17" name="process_name_17" value="17">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_17" name="process_serial_17" value="17">
                                 
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_17" name="process_or_reprocess_17">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>

                              <tr>
                                  <td>18</td>
                                  <td>

                        <select  class="form-control" id="process_name_18" name="process_name_18" value="18">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_18" name="process_serial_18" value="18">
                                 
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_18" name="process_or_reprocess_18">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>


                          <tr>
                                  <td>19</td>
                                  <td>

                        <select  class="form-control" id="process_name_19" name="process_name_19">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_19" name="process_serial_19" value="19">
                                 
                                 </td>

                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_19" name="process_or_reprocess_19">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>

                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>


                               <tr>
                                  <td>20</td>
                                  <td>

                        <select  class="form-control" id="process_name_20" name="process_name_20">
                                 <option  value="select">Select Process Name </option>
                                 <?php 
                                     $sql = 'select * from `process_name` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row = mysqli_fetch_array( $result))
                                     {

                                        echo '<option value="'.$row['process_name']."?fs?".$row['process_id'].'">'.$row['process_name'].'</option>';

                                     }

                                  ?>
                        </select>



                                  </td>


                                  
                                  <td align="center">
                                 <input type="text" class="form-control"  id="process_serial_20" name="process_serial_20" value="20">
                                 
                                 </td>


                                 
                                 <td>
                                 	<select  class="form-control" id="process_or_reprocess_20" name="process_or_reprocess_20">
											
											<option value="process" selected>Process</option>
											<option value="re-process">Re-Process</option>
								   </select>
                                 </td>
                               
                                  <td align="center" style="padding-left:0px; padding-right:0px;">

                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button>
                                      <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>
                                 </td>
                                  
                              </tr>

                              

                          </tbody>
                        </table>

						</div>  <!-- End of <div class="col-sm-7"> <-- This will hold table in the form --> 
                        
					</div>
					
					<div class="form-group form-group-sm" id='form-group_div_for_submit_button'>
								<div class="col-sm-offset-2 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_version_wise_process_info_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
					</div> <!-- End of <div class="form-group form-group-sm" id='form-group_div_for_submit_button'> -->
				</form>
            
		          </div>  <!-- End of <div class="panel panel-default"> -->
					        
					     

	    </div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->

<div id='all_process_names' style="visibility:hidden;">


                <?php 
                        $sql = 'select * from `process_name` order by `process_name`';
                        $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                        while( $row = mysqli_fetch_array( $result))
                        {
    
                            echo $row['process_name']."?fs?";
    
                        }
    
                ?>



</div>


						<script>
			              function my_function() {
			                var input, filter, table, tr, td, i, txtValue;
			                input = document.getElementById("my_input");
			                filter = input.value.toUpperCase();
			                table = document.getElementById("datatable-buttons");
			                tr = table.getElementsByTagName("tr");
			                for (i = 0; i < tr.length; i++) {
			                  td = tr[i].getElementsByTagName("td")[2];
			                  if (td) {
			                    txtValue = td.textContent || td.innerText;
			                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
			                      tr[i].style.display = "";
			                    } else {
			                      tr[i].style.display = "none";
			                    }
			                  }       
			                }
			              }
				     	</script>