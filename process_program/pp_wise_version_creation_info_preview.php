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

$result=mysqli_query($con,$sql) or die(mysqli_error());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
$version_id=$_GET['version_id'];
$sql_for_pp_wise_version_info="select * from pp_wise_version_creation_info where `version_id`='$version_id'";
$result_for_pp_wise_version_info= mysqli_query($con,$sql_for_pp_wise_version_info) or die(mysqli_error($con));
$row_for_pp_wise_version_info = mysqli_fetch_array( $result_for_pp_wise_version_info);
?>
<script type='text/javascript' src='process_program/pp_wise_version_creation_info_form_validation.js'></script>

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
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_pp_wise_version_creation_info_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>PP Wise Version Creation Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('process_program/pp_wise_version_creation_info.php')">Add PP Wise Version Creation Info</a></li>
                        <li class="breadcrumb-item"><a >Preview PP Wise Version Creation</a></li>
                      </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="pp_wise_version_creation_info_form" id="pp_wise_version_creation_info_form">
                          
						<div class="form-group form-group-sm" id="form-group_for_pp_number">
							  
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:<span style="color:red"> *</span></label> 
							<div class="col-sm-5">
								<select  class="form-control" id="pp_number" name="pp_number" readonly>
                        
                         <?php
                                      $pp_num_id = $row_for_pp_wise_version_info['pp_num_id'];

                                      $sql = 'select * from `process_program_info` order by `row_id`';
                                     $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                     while( $row_for_pp = mysqli_fetch_array( $result))
                                     {
                                          ?>

                                          <option <?php if($row_for_pp['pp_num_id'] == $pp_num_id ){echo "selected";}?> value="<?php echo $row_for_pp['pp_number'].'?fs?'.$row_for_pp['pp_num_id'];?>"> <?php echo $row_for_pp['pp_number'];?>
                                            
                                </option>

                                      <?php
                                        }
                                      ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->
						<div class="form-group form-group-sm" id="form-group_for_version_name">
						<label class="control-label col-sm-3" for="version_name" style="margin-right:0px; color:#00008B;">Version :<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_name" name="version_name" readonly>
                                <option value="<?php echo $row_for_pp_wise_version_info['version_name'] ?>" selected><?php echo $row_for_pp_wise_version_info['version_name'] ?></option>
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
                           <input type="text" class="form-control" id="style_name" name="style_name" value="<?php echo $row_for_pp_wise_version_info['style_name'];?>" readonly>
                        </div>
                        <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('style_name')"></i>
           </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_style_name"> -->

						<div class="form-group form-group-sm" id="form-group_for_color">
						<label class="control-label col-sm-3" for="color" style="margin-right:0px; color:#00008B;">Color:<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control" id="color" name="color" readonly>
                      <option value="<?php echo $row_for_pp_wise_version_info['color'] ?>" selected><?php echo $row_for_pp_wise_version_info['color'] ?></option>
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
								<select  class="form-control" id="construction_name" name="construction_name" readonly>
                                <option value="<?php echo $row_for_pp_wise_version_info['construction_name'] ?>" selected><?php echo $row_for_pp_wise_version_info['construction_name'] ?></option>
								
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
								<select  class="hidden" id="no_of_weft_yarn_picking" name="no_of_weft_yarn_picking" readonly>
                      <option value="<?php echo $row_for_pp_wise_version_info['no_of_weft_yarn_picking'] ?>" selected><?php echo $row_for_pp_wise_version_info['no_of_weft_yarn_picking'] ?></option>
											<option select="selected" value="SPI_DPI">Select No Of Weft Yarn Picking</option>
											<option value="SPI">SPI</option>
											<option value="DPI">DPI</option>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_no_of_weft_yarn_picking"> -->

						<div class="form-group form-group-sm" id="form-group_for_greige_width_in_inch">
								<label class="control-label col-sm-3" for="greige_width_in_inch" style="color:#00008B;">Greige Width(Inch):<span style="color:red"> *</span></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="greige_width_in_inch" name="greige_width_in_inch" value="<?php echo $row_for_pp_wise_version_info['greige_width_in_inch']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('greige_width_in_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_greige_width_in_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
								<label class="control-label col-sm-3" for="finish_width_in_inch" style="color:#00008B;">Finish Width(Inch):<span style="color:red"> *</span></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" value="<?php echo $row_for_pp_wise_version_info['finish_width_in_inch']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('finish_width_in_inch')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch"> -->

						<div class="form-group form-group-sm" id="form-group_for_process_technique_name">
						<label class="control-label col-sm-3" for="process_technique_name" style="margin-right:0px; color:#00008B;">Process Technique Name:<span style="color:red"> *</span></label>
							<div class="col-sm-5">
								<select  class="form-control" id="process_technique_name" name="process_technique_name" readonly>
                                <option value="<?php echo $row_for_pp_wise_version_info['process_technique_name'] ?>" selected><?php echo $row_for_pp_wise_version_info['process_technique_name'] ?></option>
											<option select="selected" value="select">Select Process Technique Name</option>
											<?php 
												 $sql = 'select process_technique_name from `process_technique_or_program_type` order by `process_technique_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error);
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
									<input type="text" class="form-control" id="percentage_of_cotton_content" name="percentage_of_cotton_content" value="<?php echo $row_for_pp_wise_version_info['percentage_of_cotton_content']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_cotton_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_cotton_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content">
								<label class="control-label col-sm-3" for="percentage_of_polyester_content" style="color:#00008B;">Percentage of Polyester Content:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="percentage_of_polyester_content" name="percentage_of_polyester_content" value="<?php echo $row_for_pp_wise_version_info['percentage_of_polyester_content']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_polyester_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_polyester_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_other_fiber_in_yarn">
						<label class="control-label col-sm-3" for="other_fiber_in_yarn" style="margin-right:0px; color:#00008B;">Other Fiber Name:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="other_fiber_in_yarn" name="other_fiber_in_yarn" readonly>
                      <option value="<?php echo $row_for_pp_wise_version_info['other_fiber_in_yarn'] ?>" selected><?php echo $row_for_pp_wise_version_info['other_fiber_in_yarn'] ?></option>
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
									<input type="text" class="form-control" id="percentage_of_other_fiber_content" name="percentage_of_other_fiber_content"  value="<?php echo $row_for_pp_wise_version_info['percentage_of_other_fiber_content']?>" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('percentage_of_other_fiber_content')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_percentage_of_other_fiber_content"> -->

						<div class="form-group form-group-sm" id="form-group_for_pp_quantity">
								<label class="control-label col-sm-3" for="pp_quantity" style="color:#00008B;">PP Quantity:<span style="color:red"> *</span> </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="pp_quantity" name="pp_quantity" value="<?php echo $row_for_pp_wise_version_info['pp_quantity']?>"  onclick="calculate_fiber_cotent()" readonly>
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('pp_quantity')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_quantity"> -->

					

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->


  

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->