<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

?>
<script type='text/javascript' src='process_program/pp_wise_version_creation_info_form_validation.js'></script>

                 
                    <!-- for auto complete drop down box -->
   


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

 function sending_data_for_delete(version_id)
 {
    var confirm_msg = confirm('Are you sure!!!   You want to Delete.');
	  if(confirm_msg == true)
	  {
            var url_encoded_form_data = 'version_id='+version_id;

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
      }



 }//End of function sending_data_for_delete()


 function pagination(clicked_id) {
     let id=clicked_id;
     var l= document.getElementById(clicked_id).value;
     var search= document.getElementById("search").value;
     if(id>=0) {


         if (!search || search.trim() === "" || (search.trim()).length === 0) {
             //document.getElementById("pagination_number").value=l;
             $.ajax({
                 url: "process_program/pp_wise_version_creation_info_pagination.php",
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
         } else {

             // alert("no heelo")

             //document.getElementById("pagination_number").value=l;
             $.ajax({
                 url: "process_program/pp_wise_version_creation_info_pagination.php",
                 type: "get", //send it through get method
                 data: {
                     offset: id,
                     pagi: l,
                     search: search

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
            
         }
         else
             {
                 var url_encoded_form_data = $("#search_for_item").serialize(); //This will read all control elements value of the form

                 $.ajax({
                 url: 'process_program/pp_wise_version_creation_search_pagination.php',
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



/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.pp_wise_version_creation').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/

</script>

<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->


      <div id="element">

				<div class="panel-heading" style="color:#191970;"><b>PP Wise Version Creation Info</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					    <li class="breadcrumb-item"><a onclick="load_page('process_program/pp_wise_version_creation_info.php')">Add PP Wise Version Creation Info</a></li>
					  </ol>
				 </nav>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="pp_wise_version_creation_info_form" id="pp_wise_version_creation_info_form">
                          
					<div class="form-group form-group-sm" id="form-group_for_pp_number">

							  
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:<span style="color:red"> *</span></label> 
							<div class="col-sm-6">
								<select  class="form-control pp_wise_version_creation" style="width: 430px" id="pp_number" name="pp_number">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												 $sql = 'select * from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'?fs?'.$row['pp_num_id'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
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
                        <label class="control-label col-sm-3" for="style_name_label" style="color:#00008B;">Style Name:<span style="color:red"> </span></label>
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
									<option select="selected" value="select">Select Construction Name</option>
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


        <div  id="pagination" class="form-group form-group-sm">

        <form class="form-inline" action="" style="margin-top:10px;" name="search_for_item" id="search_for_item">

    <div class="form-group mx-sm-3 mb-2">
        <input type="text" class="form-control" id="search" name="search" placeholder="Search">
        

    </div>
    <button type="button" class="btn btn-primary btn-xs" onClick="sending_data()">Search</button>


    </form>

    <table  class="table table-striped table-bordered">
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
                 <th>Fiber Content</th>
                 <th>PP Quantity</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody>
            <?php 
                            $s1 = 1;
                            // $sql_for_color = "SELECT * FROM pp_wise_version_creation_info pwvci
                            // LEFT JOIN process_program_info ppi ON ppi.pp_number = pwvci.pp_number
                            // ORDER BY pwvci.row_id ASC";
                                  $sql_for_color = "SELECT * FROM pp_wise_version_creation_info pwvci
                                  LEFT JOIN process_program_info ppi ON ppi.pp_number = pwvci.pp_number
                                  ORDER BY pwvci.row_id ASC limit 0,10";

                            $res_for_color = mysqli_query($con, $sql_for_color);

                            while ($row = mysqli_fetch_assoc($res_for_color)) 
                            {
                                $date=date_create($row['pp_creation_date']);
								$trf_creation_date = date_format($date,"Y-m-d");
                                ?>

                                <tr >
                                    <td width="10"><?php echo $s1; ?></td> 
                                    <td ><?php echo $trf_creation_date; ?></td>
                                    <td ><?php echo $row['pp_number']; ?></td>
                                    <td ><?php echo $row['version_name']; ?></td>
                                    <td><?php echo $row['style_name']; ?></td>
                                    <td><?php echo $row['color']; ?></td>
                                    <td><?php echo $row['construction_name']; ?></td>
                                    <td><?php echo $row['greige_width_in_inch']; ?></td>
                                    <td><?php echo $row['finish_width_in_inch']; ?></td>
                                    <td><?php echo $row['process_technique_name']; ?></td>
                                    <td>
                                        <?php
                                        if($row['percentage_of_cotton_content']!= ' ' && $row['percentage_of_cotton_content'] != 0)
                                        {
                                            echo 'Cotton: '.$row['percentage_of_cotton_content'].'% ';
                                        }
                                        if($row['percentage_of_polyester_content']!= ' ' && $row['percentage_of_polyester_content'] != 0)
                                        {
                                            echo 'Polyester: '.$row['percentage_of_polyester_content'].'% ';
                                        }
                                        if($row['percentage_of_other_fiber_content']!= ' ' && $row['percentage_of_other_fiber_content'] != 0)
                                        {
                                            echo $row['other_fiber_in_yarn'].': '.$row['percentage_of_other_fiber_content'].'% ';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['pp_quantity']; ?></td>
                                    
                                    <td>
                      
                        
                                       
                                        <?php
                                        $pp_number = $row['pp_number'];
                                        $version_id = $row['version_id'];
                                        $sql_for_add_process_to_version ="SELECT * FROM adding_process_to_version WHERE pp_number = '$pp_number' AND version_id = '$version_id'";
                                        $result_for_add_process_to_version =  mysqli_query($con, $sql_for_add_process_to_version);

                                        $row_number_for_add_process_to_version = mysqli_num_rows($result_for_add_process_to_version);

                                        if($row_number_for_add_process_to_version >0)
                                        {
                                            ?>
                                                <!-- <button type="button" id="add_process_info" name="add_process_info"  class="btn btn-success btn-xs" onclick="load_page('process_program/version_wise_process_info_creation_from_pp.php?all_data=<?php echo $row['pp_number'].'?fs?'.$row['version_id'] ?>')"> Add Process  </button> -->
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button type="button" id="edit_pp_info" name="edit_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_pp_wise_version_creation_info.php?version_id=<?php echo $row['version_id'] ?>')"> Edit </button>
                                                <span>  </span>
                                    
                                            <button type="button" id="add_process_info" name="add_process_info"  class="btn btn-success btn-xs" onclick="load_page('process_program/version_wise_process_info_creation_from_pp.php?all_data=<?php echo $row['pp_number'].'?fs?'.$row['version_id'] ?>')"> Add Process  </button>
                                        
                                            <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['version_id'] ?>')"> Delete </button>
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

                                 $cout="SELECT COUNT(row_id) as count FROM `pp_wise_version_creation_info` WHERE 1";
                                //  $sql_for_color = "SELECT * FROM pp_wise_version_creation_info pwvci
                                //  LEFT JOIN process_program_info ppi ON ppi.pp_number = pwvci.pp_number
                                //  ORDER BY pwvci.row_id ASC limit 0,10";
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


              document.onreadystatechange = function(e)
              {
                  if (document.readyState === 'complete')
                  {
                      alert('waiting');
                      //dom is ready, window.onload fires later
                  }
                  else
                  {
                     alert('watiing');
                  }
              };
              window.onload = function(e)
              {
                alert('waiting');
                  //document.readyState will be complete, it's one of the requirements for the window.onload event to be fired
                  //do stuff for when everything is loaded
              };
          </script>

        </div>  <!-- End of <div class="panel panel-default"> -->

    </div>  <!--  End of <div id="element"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->