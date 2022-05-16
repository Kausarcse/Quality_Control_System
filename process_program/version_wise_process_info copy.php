<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();




$pp_number=$_GET['pp_number'];
$split_pp_number=explode('?dataseperator?',$pp_number);
$pp_number=$split_pp_number[0];
$version_number=$split_pp_number[1];


?>
<script type='text/javascript' src='process_program/version_wise_process_info_form_validation.js'></script>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>


 document.getElementById('version_name').innerHTML='<?php echo $version_number ?>';


 function pagination(clicked_id) {
     let id=clicked_id;
     var l= document.getElementById(clicked_id).value;
     var search= document.getElementById("search").value;
     if (!search || search.trim() === "" || (search.trim()).length === 0) {
         //document.getElementById("pagination_number").value=l;
         $.ajax({
             url: "process_program/version_wise_process_info_pagination.php",
             type: "get", //send it through get method
             data: {
                 offset: id,
                 pagi: l,

             },
             success: function (response) {
                 document.getElementById("pagination").innerHTML = response;

             },
             error: function (xhr) {
                 //Do Something to handle error
             }
         });
     }
     else {


         //document.getElementById("pagination_number").value=l;
         $.ajax({
             url: "process_program/version_wise_process_info_pagination.php",
             type: "get", //send it through get method
             data: {
                 offset: id,
                 pagi: l,
                 search:search

             },
             success: function (response) {
                 document.getElementById("pagination").innerHTML = response;

             },
             error: function (xhr) {
                 //Do Something to handle error
             }
         });
     }



 }

 function sending_data(){
     let search=$('#search').val();
    //  alert(search)

         // Test whether strValue is empty
         if (!search || search.trim() === "" || (search.trim()).length === 0) {
            //  alert("Empty")
         }
         else
             {
                 var url_encoded_form_data = $("#search_for_item").serialize(); //This will read all control elements value of the form

                 $.ajax({
                 url: 'process_program/version_wise_process_info_search_pagination.php',
                 dataType: 'text',
                 type: 'post',
                 contentType: 'application/x-www-form-urlencoded',
                 data: url_encoded_form_data,
                 success: function( data, textStatus, jQxhr )
                 {
                     document.getElementById("pagination").innerHTML=data;
                    //  alert(data);
                 },
                 error: function( jqXhr, textStatus, errorThrown )
                 {
                     //console.log( errorThrown );
                     alert(errorThrown);
                 }
             });

         }
     }








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
    
	 var total_rows = table.rows.length;    // Finding total number of Rows in this table.
	 var total_columns = table.rows[0].cells.length; // Finding total number of Cells/Columns in this table.
	 
	//  alert(total_columns);
	//  alert(total_rows);

	 var new_row_position = row_number+1;
	 var new_row = table.insertRow(new_row_position); // This will insert new row in this table.

	 for(var i=0;i<total_columns;i++) // Adding All Columns to New Row.  
	 {
		var new_cell = new_row.insertCell(i);
	 }
    //  adding_new_form_elements_in_process_adding_table(row_number);

	 
	 for(var i=1; i<= total_rows ; i++ ) // New Serial Number Creating
   	 {

    	 table.rows[i].cells[0].innerHTML  = i;

	 }

        var last_cell=total_columns-1;
        table.rows[new_row_position].cells[last_cell].setAttribute("align","center");
        table.rows[new_row_position].cells[last_cell].setAttribute("style","padding-left:0px; padding-right:0px;");
        
        table.rows[new_row_position].cells[last_cell].innerHTML='<button type="button" class="btn-primary" style="padding-top:1px;" onClick="adding_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Add</button> <button type="button" class="btn-primary" style="padding-top:1px;" onClick="deleting_specific_row_of_process_adding_table(this.parentNode.parentNode.rowIndex)">Del</button>';
        
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
	var splitted_all_process_list = all_process_list.split("?proc?");


    for(var i=0;i<splitted_all_process_list.length-1;i++)
	{
		option_elements = document.createElement("option");
		option_elements.setAttribute("value",splitted_all_process_list[i].trim());

		
	    var all_process_list_for_process_name = splitted_all_process_list[i].split("?fs?");

		text = document.createTextNode(all_process_list_for_process_name[0].trim());
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
			var split_pp_number=pp_number_for_searching.split('?fs?');
			var pp_number=split_pp_number[0];
			var value_for_data= 'pp_number_value='+pp_number;

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


      var url_encoded_form_data = $("#version_wise_process_info_form").serialize(); ///This will read all control elements value of the form
     
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



  function sending_data_for_update(get_all_data)
 {
      
      var get_all_data=get_all_data;

       $('#div_full_form').load("process_program/edit_version_wise_process_info.php?update_value="+encodeURIComponent(get_all_data));

 }



/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/




</script>
<div class="col-sm-12 col-md-12 col-lg-12">


    <div id="div_full_form">
		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Adding Process to Version Form</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item active" aria-current="page" >Home</li>
						    <li class="breadcrumb-item"><a onclick="load_page('process_program/version_wise_process_info.php')">Adding Process to Version</a></li>
						  </ol>
			    </nav>
			    
				<form class="form-horizontal" action="" style="margin-top:10px;" name="version_wise_process_info_form" id="version_wise_process_info_form">

					

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
									<select  class="form-control for_auto_complete" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field_For_Searching(this.value)">
											<option  value="<?php echo $pp_number?>" selected><?php echo $pp_number?></option>
											<?php 
												 $sql = 'select pp_number,pp_num_id from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'?fs?'.$row['pp_num_id'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->
                         


                         <input type="hidden" name="finish_width_in_inch" id="finish_width_in_inch" value="">
                         <input type="hidden" name="customer_name" id="customer_name" value="">
                         <input type="hidden" name="style_name" id="style_name" value="">


						<div class="form-group form-group-sm" id="form-group_for_version_name">
								<label class="control-label col-sm-3" for="version_name" style="color:#00008B;">Version :</label>
								<div class="col-sm-5">
									<select  class="form-control" id="version_name" name="version_name" >
											<option  value="select" selected>Select Version Name</option>
											<?php 
												 $sql = 'select DISTINCT version_name from `pp_wise_version_creation_info`,`process_program_info` where `pp_wise_version_creation_info`.pp_num_id= `process_program_info`.pp_num_id ';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
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
                              	 <td>13</td>
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
                                    <td align="center"><input type="text" class="form-control"  id="process_serial_20" name="process_serial_20" value="20"></td>
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
				
            
				
		</div> <!-- End of <div class="panel panel-default"> -->
           
        <div class="panel panel-default" id="version_wise_process_info_list">

        	
             <div  id="pagination" class="form-group form-group-sm" id="form-group_for_test_method_name">
                 <form class="form-inline" action="" style="margin-top:10px;" name="search_for_item" id="search_for_item">

                     <div class="form-group mx-sm-3 mb-2">
                         <input type="text" id="search" name="search" placeholder="Search">
                     </div>
                     <button type="button" class="btn btn-primary btn-xs" onClick="sending_data()">Submit</button>


                 </form>

                 <table  class="table table-striped table-bordered">
                     <thead>
                     <tr>
                         <th>SI</th>
                         <th>PP Number</th>
                         <th>Version Name</th>
                         <th>Style Name</th>
                         <th>Color</th>
                         <th>Finish Width</th>
                         <th>Process Name</th>
                         <th>Process Serial</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody><?php


                     $s1 = 0;

                     $sql_for_color = "SELECT * FROM adding_process_to_version ORDER BY row_id ASC limit 0,10";

                     $res_for_color = mysqli_query($con, $sql_for_color);

                     while ($row = mysqli_fetch_assoc($res_for_color))
                     {
                         $s1=$s1+1;
                     ?>
                     <tr>
                         <td><?php echo $s1; ?></td>
                         <td><?php echo $row['pp_number']; ?></td>
                         <td><?php echo $row['version_name']; ?></td>
                         <td><?php echo $row['style_name']; ?></td>
                         <td><?php echo $row['color']; ?></td>
                         <td><?php echo $row['finish_width_in_inch']; ?></td>
                         <td><?php echo $row['process_name']; ?></td>
                         <td><?php echo $row['process_serial_no']; ?></td>
                         <td>
                             <?php
                             $value=$row['process_id']."?fs?".$row['version_id'];
                             $update_value=$row['pp_number']."?fs?".$row['version_id']."?fs?".$row['version_name']."?fs?".$row['color']."?fs?".$row['finish_width_in_inch'];
                             ?>

                             <button type="button" id="" name="update_pp_info"  class="btn btn-info btn-xs" onclick="sending_data_for_update('<?php echo $update_value; ?>')"> Edit </button>
                             <?php
                             $version_id = $row['version_id'];
                             $pp_number = $row['pp_number'];
                             $finish_width_in_inch = $row['finish_width_in_inch'];
                             $style_name = $row['style_name'];
                             $color = $row['color'];
                             $process_name = $row['process_name'];
                             $process_id = $row['process_id'];


                             if($process_id == 'proc_20')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_greige_receiving_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_1')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_singe_and_desize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_2')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_scouring_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_3')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_bleaching_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_4')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_scouring_bleaching_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_5')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_mercerize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_6')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_mercerize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_7')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_printing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_8')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_printing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_9')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_curing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_11')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_dying_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_13')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_washing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_14')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_raising_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_15')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_raising_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_16')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_finishing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_17')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_calendering_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             else if($process_id == 'proc_18')
                             {
                                 $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_sanforizing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                                 $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                 $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                 if($row_number_for_pp_wise_version >0)
                                 {

                                 }
                                 else
                                 {
                                     ?>
                                     <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                                     <?php
                                 }
                             }

                             ?>



                         </td>
                     </tr>
                     <?php
                     }

                         ?>
                         <nav aria-label="Page navigation example">
                             <ul class="pagination">
                                 <li class="page-item">
                                     <a class="page-link" href="#" aria-label="Previous">
                                         <span aria-hidden="true">&laquo;</span>
                                     </a>
                                 </li>
                                 <?php

                                 $cout="SELECT COUNT(row_id) as count FROM `adding_process_to_version` WHERE 1";
                                 $count_f=mysqli_query($con,$cout);
                                 while ($count_row=mysqli_fetch_assoc($count_f)){
                                     $count=$count_row['count'];
                                 }
                                 $l=1;
                                 $k=10;

                                 for ($i=0;$i<=100;$i=$i+10) {
                                 ?>
                                 <li id="<?php echo $k?>" value="<?php echo $l?>" class="page-item" onclick="pagination(this.id)"><a  class="page-link" href="#"
                                                          ><?php echo $l?></a></li>
                                     <?php
                                     $l++;
                                     $k=$k+10;
                                 }
                                 ?>

                                 <li class="page-item" id="<?php echo ($k)?>" value="<?php echo ($l)?>" class="page-item" onclick="pagination(this.id)" >
                                     <a class="page-link" href="#" aria-label="Next">
                                         <span aria-hidden="true">&raquo;</span>
                                     </a>
                                 </li>
                             </ul>
                         </nav>


                     </tbody>
                 </table>
             </div>
        </div>
    </div>
</div>
