<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

?>
<script type='text/javascript' src='process_program/process_program_info_form_validation.js'></script>

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

function pagination(clicked_id) {
     let id=clicked_id;
    if(id>=0){


     var l= document.getElementById(clicked_id).value;
     var search= document.getElementById("search").value;
     if (!search || search.trim() === "" || (search.trim()).length === 0) {
         //document.getElementById("pagination_number").value=l;
         $.ajax({
             url: "process_program/process_program_info_pagination.php",
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
             url: "process_program/process_program_info_pagination.php",
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


 }

 function sending_data(){
     let search=$('#search').val();
    

         // Test whether strValue is empty
         if (!search || search.trim() === "" || (search.trim()).length === 0) {
            //  alert("Empty")
         }
         else
             {
                 var url_encoded_form_data = $("#search_for_item").serialize(); //This will read all control elements value of the form

                 $.ajax({
					url: "process_program/process_program_info_search_pagination.php",
                 dataType: 'text',
                 type: 'post',
                 contentType: 'application/x-www-form-urlencoded',
                 data: url_encoded_form_data,
                 success: function( data, textStatus, jQxhr )
                 {
                    //alert(data);
                   document.getElementById("pagination").innerHTML=data;
                     

                 },
                 error: function( jqXhr, textStatus, errorThrown )
                 {
                     //console.log( errorThrown );
                     alert(errorThrown);
                 }
             });

         }
     }







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


       var validate = Process_Program_Info_Form_Validation();
       var url_encoded_form_data = $("#process_program_info_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/process_program_info_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				 if(data== "Data is successfully saved.")
				              {  
					                var url_encoded_form_data = $("#process_program_info_form").serialize();

					                $.ajax({
					                url: 'process_program/returning_row_id_for_process_program_info.php',
					                dataType: 'text',
					                type: 'post',
					                contentType: 'application/x-www-form-urlencoded',
					                data: url_encoded_form_data,
					                success: function( data, textStatus, jQxhr )
					                { 


					                  /*alert(data);*/
					                  $('#element').load('process_program/process_program_info_preview.php?pp_num_id='+data);
					                  $('#div_table').hide();

					                    
					                },
					                error: function( jqXhr, textStatus, errorThrown )
					                {
					       
					                    alert(errorThrown);
					                }
					             }); // End of $.ajax({
				              }
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


 /***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/



</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

            <div id="element">

				<div class="panel-heading" style="color:#191970;"><b>Process Program Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('process_program/process_program_info.php')">PP Creation</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="process_program_info_form" id="process_program_info_form">

						<div class="form-group form-group-sm " id="form-group_for_pp_creation_date">
								<label class="control-label col-sm-3" for="pp_creation_date" style="color:#00008B;">PP Issue(Creation) Date:<span style="color:red"> *</span></label>
								
								<div class="col-sm-3">
									<input type="text" class="form-control" id="pp_creation_date" name="pp_creation_date" placeholder="Enter PP Creation Date" required>
								</div>
								<div class="col-sm-3 row nopadding">
									<input type="text" class="form-control" id="alternate_pp_creation_date" name="alternate_pp_creation_date" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_creation_date')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->
								<script>
									$( function()
									{
										$( "#pp_creation_date" ).datepicker(
										{
											showWeek: true, // This is for Showing Week in Datepicker Calender.
											altField: "#alternate_pp_creation_date", // This is for Descriptive Date Showing in Alternative Field.
											altFormat: "DD, d MM, yy" // This is for Descriptive Date Format in Alternative Field.
										}
										); // End of $( "#pp_creation_date" ).datepicker(

										$( "#pp_creation_date" ).datepicker( "option", "dateFormat", "dd/mm/yy" ); // This is for Date Format in Actual Date Field.
										$( "#pp_creation_date" ).datepicker( "option", "showAnim", "drop" ); // This is for Datepicker Calender Animation in Actual Date Field.
									}
									); // End of $( function()
								</script>

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="pp_number" name="pp_number" placeholder="Enter PP Number" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_description">
								<label class="control-label col-sm-3" for="pp_description" style="color:#00008B;">PP Description:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<textarea class='form-control' id='pp_description' name='pp_description' rows='5' placeholder="Enter PP Description"></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_description')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_description"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
						<label class="control-label col-sm-3" for="customer_name" style="margin-right:0px; color:#00008B;">Customer Name:<span style="color:red"> *</span></label>
							<div class="col-sm-6">
								<select  class="form-control for_auto_complete" id="customer_name" name="customer_name">
											<option select="selected" value="select">Select Customer Name</option>
											<?php 
												 $sql = 'select * from `customer` order by `customer_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['customer_name'].'?fs?'.$row['customer_id'].'">'.$row['customer_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_demand_no">
								<label class="control-label col-sm-3" for="greige_demand_no" style="color:#00008B;">Greige Demand No:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="greige_demand_no" name="greige_demand_no" placeholder="Enter Greige Demand No" required>
									<!-- <input type="text" class="form-control" id="greige_demand_no" name="greige_demand_no" placeholder="Enter Greige Demand No" required> -->
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_demand_no')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_demand_no"> -->

						<div class="form-group form-group-sm" id="form-group_for_week_in_year">
								<label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;" onmouseover="mouseover()" onmouseout="mouseout()">Week :<span id="span_id" style="display:none"> Week In Year</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="week_in_year" name="week_in_year" placeholder="Enter Week In Year" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->

						<div class="form-group form-group-sm" id="form-group_for_design">
								<label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="design" name="design" placeholder="Enter Design" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->

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
				
		<div  id="pagination" class="form-group form-group-sm">
                 <form class="form-inline" action="" style="margin-top:10px;" name="search_for_item" id="search_for_item">

                     <div class="form-group mx-sm-3 mb-2">
                         <input type="text" id="search" name="search" placeholder="Search">
                     </div>
                     <button type="button" class="btn btn-primary btn-xs" onClick="sending_data()">Submit</button>


                 </form>
		<table  class="table table-striped table-bordered">

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
                 <th>Total Quantity</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody>
            <?php 
                            $s1 = 1;
                            $sql_for_color = "SELECT * FROM process_program_info ORDER BY row_id ASC limit 0,10";

                            $res_for_color = mysqli_query($con, $sql_for_color);

                            while ($row = mysqli_fetch_assoc($res_for_color)) 
                            {
								$date=date_create($row['pp_creation_date']);
								$trf_creation_date = date_format($date,"Y-m-d");
             ?>

             <tr>
                <td><?php echo $s1; ?></td>
				<td><?php echo $trf_creation_date; ?></td>
                <td><?php echo $row['pp_number']; ?></td>
                <td><?php echo $row['pp_description']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['greige_demand_no']; ?></td>
                <td><?php echo $row['week_in_year']; ?></td>
                <td><?php echo $row['design']; ?></td>

                <td>
                		
            		<?php 
            			$pp_number = $row['pp_number'];
                        $sql_for_color2 = "SELECT SUM(pp_quantity) total_quantity FROM pp_wise_version_creation_info WHERE pp_number = '$pp_number'";

                        $res_for_color2 = mysqli_query($con, $sql_for_color2);

                        $row2 = mysqli_fetch_assoc($res_for_color2);

                        echo $total_quantity = $row2['total_quantity'];
         			?>

                </td>

                <td>
                      
                        
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_process_program_info.php?pp_id=<?php echo $row['row_id'] ?>')"> Edit </button>
                       <span>  </span>


                        <button type="button" id="view_pp_info" name="view_pp_info"  class="btn btn-info btn-xs" onclick="load_page('process_program/process_program_info_preview.php?pp_num_id=<?php echo $row['pp_num_id'] ?>')"> View </button>
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
			 <nav aria-label="Page navigation example">
                             <ul class="pagination">
                                 <li class="page-item">
                                     <a class="page-link" href="#" aria-label="Previous">
                                         <span aria-hidden="true">&laquo;</span>
                                     </a>
                                 </li>
                                 <?php

                                 $cout="SELECT COUNT(row_id) as count FROM `process_program_info` WHERE 1";
                                 $count_f=mysqli_query($con,$cout);
                                 while ($count_row=mysqli_fetch_assoc($count_f)){
                                     $count=$count_row['count'];
                                     $maincount=$count_row['count'];

                                     if($count>90){
                                         $count=90;
                                     }
                                 }
                                 $l=1;
                                 $k=10;

                                 for ($i=0;$i<=$count;$i=$i+10) {
                                 ?>
                                 <li id="<?php echo $k?>" value="<?php echo $l?>" class="page-item" onclick="pagination(this.id)"><a  class="page-link" href="#"
                                                          ><?php echo $l?></a></li>
                                     <?php
                                     $l++;
                                     $k=$k+10;
                                 }
                                 ?>

                                 <li class="page-item" id="<?php echo ($k)?>" value="<?php echo ($l)?>" class="page-item" onclick="pagination(this.id)" >
                                     <?php
                                     if($maincount>90)
                                     {
                                     ?>
                                         <a class="page-link" href="#" aria-label="Next">
                                             <span aria-hidden="true">&raquo;</span>
                                         </a>
                                     <?php
                                     }

                                     ?>

                                 </li>
                             </ul>
                         </nav> 
           </tbody>
          </table>
								</div>
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


      </div> <!-- End of  <div id="element"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->