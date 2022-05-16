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

$result=mysqli_query($con,$sql) or die(mysqli_error($con));
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/

$pp_num_id=$_GET['pp_num_id'];
$sql_for_pp_info="select * from process_program_info where `pp_num_id`='$pp_num_id'";

$result_for_pp_info= mysqli_query($con,$sql_for_pp_info) or die(mysqli_error($con));
$row_for_pp_info = mysqli_fetch_array( $result_for_pp_info);
 $row_for_pp_info['pp_num_id'];
?>
<script type='text/javascript' src='process_program/pp_wise_version_creation_info_form_validation.js'></script>


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


 
       var url_encoded_form_data = $("#process_program_info_form").serialize(); //This will read all control elements value of the form	
      

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


 }//End of function sending_data_of_process_program_info_form_for_saving_in_database()


</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Process Program Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('process_program/process_program_info.php')">PP Creation</a></li>
                        <li class="breadcrumb-item"><a >Preview Process Program Info</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="process_program_info_form" id="process_program_info_form">

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
								<label class="control-label col-sm-3" for="pp_creation_date" style="color:#00008B;">PP Issue Date:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<?php

									$split_date=explode('-', $row_for_pp_info['pp_creation_date']);

									$date=$split_date[2].'-'.$split_date[1].'-'.$split_date[0];

									?>
									<input type="text" class="form-control" id="pp_creation_date" name="pp_creation_date" value="<?php echo $date?>"  readonly>
                                     
                                   
									
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_number">
								<label class="control-label col-sm-3" for="pp_number" style="color:#00008B;">PP Number:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="pp_number" name="pp_number" value="<?php echo $row_for_pp_info['pp_number']?>"  readonly>
                                     
                                   
									
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_number')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_description">
								<label class="control-label col-sm-3" for="pp_description" style="color:#00008B;">PP Description:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<textarea class='form-control' id='pp_description' name='pp_description' rows='5' value="<?php echo $row_for_pp_info['pp_description']?>" readonly><?php echo $row_for_pp_info['pp_description']?></textarea>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_description')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_description"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
						<label class="control-label col-sm-3" for="customer_name" style="margin-right:0px; color:#00008B;">Customer Name:<span style="color:red"> *</span></label>
							<div class="col-sm-6">
								<select  class="form-control" id="customer_name" name="customer_name" readonly>


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
									<input type="text" class="form-control" id="greige_demand_no" name="greige_demand_no" value="<?php echo $row_for_pp_info['greige_demand_no']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_demand_no')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_demand_no"> -->

						<div class="form-group form-group-sm" id="form-group_for_week_in_year">
								<label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;" onmouseover="mouseover()" onmouseout="mouseout()">Week :<span id="span_id" style="display:none"> Week In Year</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="week_in_year" name="week_in_year" value="<?php echo $row_for_pp_info['week_in_year']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->

						<div class="form-group form-group-sm" id="form-group_for_design">
								<label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:<span style="color:red"> *</span></label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="design" name="design" value="<?php echo $row_for_pp_info['design']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->

						

				</form>



				<div class="panel panel-default" id="div_table">

			        
			</div> <!-- End of <div class="panel panel-default"> -->

            

	 

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->





<!-- For Version Wise Process Program info -->



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

function calculate_fiber_cotent()
{
  var cotton=parseFloat(document.getElementById('percentage_of_cotton_content').value);

  var polyester=parseFloat(document.getElementById('percentage_of_polyester_content').value);
  var other_fiber=parseFloat(document.getElementById('percentage_of_other_fiber_content').value);

  var calculate= parseFloat(cotton+polyester+other_fiber);
 
  if(calculate!=100)
  {
  	alert("Fiber Content Value Must be 100 : Plaese Give Data Again Or Leave It Blank");
  	document.getElementById('percentage_of_cotton_content').value="0";
  	document.getElementById('percentage_of_polyester_content').value="0";
  	document.getElementById('percentage_of_other_fiber_content').value="0";
  	

  
  	
  }
  else
  {
     
  }

}
 function sending_data_of_pp_wise_version_creation_info_form_for_saving_in_database()
 {


       var validate = PP_Wise_Version_Creation_Form_Validation();
       var url_encoded_form_data = $("#pp_wise_version_creation_info_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/pp_wise_version_creation_info_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
              		if(data== "Data is successfully saved.")
                      {  
                          var url_encoded_form_data = $("#pp_wise_version_creation_info_form").serialize();

                          $.ajax({
                          url: 'process_program/returning_version_id_for_pp_wise_version_creation__info.php',
                          dataType: 'text',
                          type: 'post',
                          contentType: 'application/x-www-form-urlencoded',
                          data: url_encoded_form_data,
                          success: function( data, textStatus, jQxhr )
                          { 


                            // alert(data);
                            /*$('#element').load('process_program/pp_wise_version_creation_info_preview.php?version_id='+data);
                            $('#div_table').hide();*/

                              
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

 }//End of function sending_data_of_pp_wise_version_creation_info_form_for_saving_in_database()

 function sending_data_for_delete_for_version_wise_pp_nfo(row_id)
 {
      
       var url_encoded_form_data = 'row_id='+row_id;
       
         $.ajax({
          url: 'process_program/deleting_pp_wise_version_creation_info.php',
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



 }//End of function sending_data_for_delete_for_version_wise_pp_nfo()


/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.pp_wise_version_creation').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/

</script>

<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->


      <div id="element">

				<div class="panel-heading" style="color:#191970;"><b>PP Wise Version Creation Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->


				<form class="form-horizontal" action="" style="margin-top:10px;" name="pp_wise_version_creation_info_form" id="pp_wise_version_creation_info_form">
                          
					<div class="form-group form-group-sm" id="form-group_for_pp_number">

							  
					
							<div class="col-sm-6">


								
								 <input type="hidden" class="form-control" id="pp_number" name="pp_number"value="<?php echo $row_for_pp_info['pp_number'].'?fs?'.$row_for_pp_info['pp_num_id']; ?>" >
								 
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_version_name">
						<label class="control-label col-sm-3" for="version_name" style="margin-right:0px; color:#00008B;">Version :<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control  pp_wise_version_creation" id="version_name" name="version_name">
											<option select="selected" value="select">Select Version Name</option>
											<?php 
												 $sql = 'select version_name from `version_name` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_name"> -->


            <div class="form-group form-group-sm" id="form-group_for_style_name">
                        <label class="control-label col-sm-3" for="style_name_label" style="color:#00008B;">Style Name:<span style="color:red"> *</span></label>
                        <div class="col-sm-5">
                           <input type="text" class="form-control" id="style_name" name="style_name" placeholder="Enter Style Name" required>
                        </div>
                        <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('style_name')"></i>
           </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_style_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_color">
						<label class="control-label col-sm-3" for="color" style="margin-right:0px; color:#00008B;">Color:<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control pp_wise_version_creation" id="color" name="color">
											<option select="selected" value="select">Select Color</option>
											<?php 
												 $sql = 'select color_name from `color` order by `color_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['color_name'].'">'.$row['color_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_color"> -->

						<div class="form-group form-group-sm" id="form-group_for_construction_name">
						<label class="control-label col-sm-3" for="construction_name" style="margin-right:0px; color:#00008B;">Construction :<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control pp_wise_version_creation" id="construction_name" name="construction_name">
									<option select="selected" value="">Select Construction Name</option>
									<?php
		                                  $construction_sql = "SELECT * FROM construction_for_version";
		                                  $construction_res = mysqli_query($con, $construction_sql) or die(mysqli_error($con));
		                                  while ($construction_row = mysqli_fetch_assoc($construction_res)) 
		                                  {
		                              $yarn_count_warp_total = "";
                                      $yarn_count_weft_total = "";
                                      $thread_count_warp_insertion_total = "";
                                      $yarn_count_warp_total = "";

                                      $yarn_count_warp_ply = $construction_row['no_of_ply_for_warp_yarn'];
                                      $yarn_count_weft_ply = $construction_row['no_of_ply_for_weft_yarn'];
                                      $thread_count_warp_insertion = $construction_row['warp_insertion'];
                                      $thread_count_weft_insertion = $construction_row['weft_insertion'];
                                      $uom_of_warp_yarn = $construction_row['uom_of_warp_yarn'];
                                      $uom_of_weft_yarn = $construction_row['uom_of_weft_yarn'];
                                      if($uom_of_warp_yarn=="Ne" && $uom_of_weft_yarn=="Ne")

                                      {
                                        if ($yarn_count_warp_ply == '1') 
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count'].".";
                                      }

                                      else
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."^".$construction_row['no_of_ply_for_warp_yarn'].".";
                                      }

                                      if ($yarn_count_weft_ply == '1') 
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."/";
                                      }

                                      else
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."^".$construction_row['no_of_ply_for_weft_yarn']."/";
                                      }



                                      if ($thread_count_warp_insertion == '1') 
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp'].".";
                                      }

                                      else
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp']."(".$construction_row['warp_insertion'].").";
                                      }

                                      if ($thread_count_weft_insertion == '1') 
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft'];
                                      }

                                      else
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft']."(".$construction_row['weft_insertion'].")";
                                      }

                                      echo $display = $yarn_count_warp_total. $yarn_count_weft_total. $thread_count_warp_insertion_total . $thread_count_weft_insertion_total;
                                  }

                                  else if($uom_of_warp_yarn=="Ne" && $uom_of_weft_yarn!="Ne")
                                  {
                                    if ($yarn_count_warp_ply == '1') 
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count'].".";
                                      }

                                      else
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."^".$construction_row['no_of_ply_for_warp_yarn'].".";
                                      }

                                      if ($yarn_count_weft_ply == '1') 
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."(".$construction_row['uom_of_weft_yarn'].")/";
                                      }

                                      else
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."(".$construction_row['uom_of_weft_yarn'].")^".$construction_row['no_of_ply_for_weft_yarn']."/";
                                      }



                                      if ($thread_count_warp_insertion == '1') 
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp'].".";
                                      }

                                      else
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp']."(".$construction_row['warp_insertion'].").";
                                      }

                                      if ($thread_count_weft_insertion == '1') 
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft'];
                                      }

                                      else
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft']."(".$construction_row['weft_insertion'].")";
                                      }

                                      echo $display = $yarn_count_warp_total. $yarn_count_weft_total. $thread_count_warp_insertion_total . $thread_count_weft_insertion_total;
                                  }

                                  else if($uom_of_warp_yarn!="Ne" && $uom_of_weft_yarn!="Ne")
                                  {
                                    if ($yarn_count_warp_ply == '1') 
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."(".$construction_row['uom_of_warp_yarn'].").";
                                      }

                                      else
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."^".$construction_row['no_of_ply_for_warp_yarn']."(".$construction_row['uom_of_warp_yarn'].").";
                                      }


                                      if ($yarn_count_weft_ply == '1') 
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."(".$construction_row['uom_of_weft_yarn'].")/";
                                      }

                                      else
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."^".$construction_row['no_of_ply_for_weft_yarn'].""."(".$construction_row['uom_of_weft_yarn'].")/";
                                      }




                                      if ($thread_count_warp_insertion == '1') 
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp'].".";
                                      }

                                      else
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp']."(".$construction_row['warp_insertion'].").";
                                      }

                                      if ($thread_count_weft_insertion == '1') 
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft'];
                                      }

                                      else
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft']."(".$construction_row['weft_insertion'].")";
                                      }

                                      echo $display = $yarn_count_warp_total. $yarn_count_weft_total. $thread_count_warp_insertion_total . $thread_count_weft_insertion_total;
                                  }



                                  else if($uom_of_warp_yarn!="Ne" && $uom_of_weft_yarn=="Ne")
                                  {
                                    if ($yarn_count_warp_ply == '1') 
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."(".$construction_row['uom_of_warp_yarn'].").";
                                      }

                                      else
                                      {
                                          $yarn_count_warp_total = $construction_row['warp_yarn_count']."(".$construction_row['uom_of_warp_yarn'].")^".$construction_row['no_of_ply_for_warp_yarn'].".";
                                      }

                                      if ($yarn_count_weft_ply == '1') 
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."/";
                                      }

                                      else
                                      {
                                          $yarn_count_weft_total = $construction_row['weft_yarn_count']."^".$construction_row['no_of_ply_for_weft_yarn']."/";
                                      }




                                      if ($thread_count_warp_insertion == '1') 
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp'].".";
                                      }

                                      else
                                      {
                                          $thread_count_warp_insertion_total = $construction_row['no_of_threads_per_inch_in_warp']."(".$construction_row['warp_insertion'].").";
                                      }

                                      if ($thread_count_weft_insertion == '1') 
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft'];
                                      }

                                      else
                                      {
                                          $thread_count_weft_insertion_total = $construction_row['no_of_threads_per_inch_in_weft']."(".$construction_row['weft_insertion'].")";
                                      }

                                      echo $display = $yarn_count_warp_total. $yarn_count_weft_total. $thread_count_warp_insertion_total . $thread_count_weft_insertion_total;
                                  }


		                                      /*echo "<option value='".$construction_row['construction_id']."'>";*/
		                                      echo "<option value='".$display."'>";
		                                      
		                                      echo $display;
		                                      echo "</option>";
		                                  }
		                                ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_construction_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_no_of_weft_yarn_picking">
						<label class="hidden" for="no_of_weft_yarn_picking" style="margin-right:0px; color:#00008B;">No of Weft Yarn Picking:</label>
							<div class="col-sm-5">
								<select  class="hidden" id="no_of_weft_yarn_picking" name="no_of_weft_yarn_picking">
											<option select="selected" value="SPI_DPI">Select No Of Weft Yarn Picking</option>
											<option value="SPI">SPI</option>
											<option value="DPI">DPI</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_no_of_weft_yarn_picking"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_width_in_inch">
								<label class="control-label col-sm-3" for="greige_width_in_inch" style="color:#00008B;">Greige Width(Inch):<span style="color:red"> *</span></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="greige_width_in_inch" name="greige_width_in_inch" placeholder="Enter Greige Width In Inch" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_width_in_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_width_in_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
								<label class="control-label col-sm-3" for="finish_width_in_inch" style="color:#00008B;">Finish Width(Inch):<span style="color:red"> *</span></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" placeholder="Enter Finish Width In Inch" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('finish_width_in_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_process_technique_name">
						<label class="control-label col-sm-3" for="process_technique_name" style="margin-right:0px; color:#00008B;">Process Technique Name:<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control pp_wise_version_creation" id="process_technique_name" name="process_technique_name">
											<option select="selected" value="select">Select Process Technique Name</option>
											<?php 
												 $sql = 'select process_technique_name from `process_technique_or_program_type` order by `process_technique_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['process_technique_name'].'">'.$row['process_technique_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_technique_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_cotton_content">
								<label class="control-label col-sm-3" for="percentage_of_cotton_content" style="color:#00008B;">Percentage of Cotton Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_cotton_content" name="percentage_of_cotton_content" placeholder="Enter Percentage Of Cotton Content" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_cotton_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_cotton_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content">
								<label class="control-label col-sm-3" for="percentage_of_polyester_content" style="color:#00008B;">Percentage of Polyester Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_polyester_content" name="percentage_of_polyester_content" placeholder="Enter Percentage Of Polyester Content" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_polyester_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_other_fiber_in_yarn">
						<label class="control-label col-sm-3" for="other_fiber_in_yarn" style="margin-right:0px; color:#00008B;">Other Fiber Name:</label>
							<div class="col-sm-5">
								<select  class="form-control pp_wise_version_creation" id="other_fiber_in_yarn" name="other_fiber_in_yarn">
											<option select="selected" value="Null">Select Other Fiber Name</option>
											<option value="Tencel">Tencel</option>
											<option value="Lycra">Lycra</option>
											<option value="Linen">Linen</option>
											<option value="Bamboo">Bamboo</option>
											<option value="Recycled Cotton">Recycled Cotton</option>
											<option value="Recycled Polyester">Recycled Polyester</option>
											<option value="Jute">Jute</option>
											<option value="Tencel">Tencel</option>
											<option value="Modal">Modal</option>
											<option value="Rayon">Rayon</option>
											<option value="Lyocell">Lyocell</option>
                      <option value="Viscose">Viscose</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_other_fiber_in_yarn"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_other_fiber_content">
								<label class="control-label col-sm-3" for="percentage_of_other_fiber_content" style="color:#00008B;">Percentage of Other Fiber Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_other_fiber_content" name="percentage_of_other_fiber_content" placeholder="Enter Percentage Of Other Fiber Content"  required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_other_fiber_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_other_fiber_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_quantity">
								<label class="control-label col-sm-3" for="pp_quantity" style="color:#00008B;">PP Quantity:<span style="color:red"> *</span> </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="pp_quantity" name="pp_quantity" placeholder="Enter PP Quantity"  onclick="calculate_fiber_cotent()" required>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_quantity')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_quantity"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_pp_wise_version_creation_info_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->


    

    <div class="panel panel-default" id="div_table">

         <div class="form-group form-group-sm">
            <label class="control-label col-sm-5" for="search">PP Wise Version List</label>
        </div> <!-- End of <div class="form-group form-group-sm" -->


        <div class="form-group form-group-sm">

         <table id="datatable-buttons" class="table table-striped table-bordered">
          <thead>
                <tr>

                 <th>Sl.</th> 
				 <th>PP Creation Date</th>
                 <th>PP Number</th>
                 <th>Version </th>
                 <th>Style </th>
                 <th>Color</th>
                 <th>Construction Name</th>
                 <th>Greige Width</th>
                 <th>Finish Width</th>
                 <th>Process Technique</th>
                 <th>PP Quantity</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody>
            <?php 
                            $s1 = 1;
                            // $sql_for_color = "SELECT * FROM pp_wise_version_creation_info where pp_num_id='$pp_num_id 'ORDER BY row_id ASC";

							 $sql_for_color = "SELECT * FROM pp_wise_version_creation_info pwvci
                            LEFT JOIN process_program_info ppi ON ppi.pp_number = pwvci.pp_number
                            where pwvci.pp_num_id='$pp_num_id'
							ORDER BY pwvci.row_id ASC";

                            $res_for_color = mysqli_query($con, $sql_for_color);

                            while ($row = mysqli_fetch_assoc($res_for_color)) 
                            {
								$date=date_create($row['pp_creation_date']);
								$trf_creation_date = date_format($date,"d/m/Y");
             ?>

             <tr >
                <td width="10"><?php echo $s1; ?></td> 
				<td width="50"><?php echo $trf_creation_date; ?></td>
                <td width="50"><?php echo $row['pp_number']; ?></td>
                <td width="50"><?php echo $row['version_name']; ?></td>
                <td><?php echo $row['style_name']; ?></td>
                <td><?php echo $row['color']; ?></td>
                <td><?php echo $row['construction_name']; ?></td>
                <td><?php echo $row['greige_width_in_inch']; ?></td>
                <td><?php echo $row['finish_width_in_inch']; ?></td>
                <td><?php echo $row['process_technique_name']; ?></td>
                <td><?php echo $row['pp_quantity']; ?></td>
                
                <td>
                      
                        
                        <button type="submit" id="delete_pp_info" name="delete_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_pp_wise_version_creation_info.php?row_id=<?php echo $row['row_id'] ?>')"> Edit </button>
                       <span>  </span>
                       
                       
                        <button type="submit" id="add_process_info" name="add_process_info"  class="btn btn-success btn-xs" onclick="load_page('process_program/version_wise_process_info_creation_from_pp.php?row_id=<?php echo $row['row_id'].'?fs?'.$row['pp_number'] ?>')"> Add Process  </button>

                         <button type="submit" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete_for_version_wise_pp_nfo('<?php echo $row['row_id'] ?>')"> Delete </button>
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
                	dom: 'Bfrtip',
			        buttons: [
			              'excel', 'pdf', 'print'
			        ],
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

    </div>  <!--  End of <div id="element"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->